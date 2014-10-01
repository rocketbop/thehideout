<?php
/**
 * Copyright (c) 2014 iControlWP <support@icontrolwp.com>
 * All rights reserved.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

if ( !class_exists('ICWP_WPTB_FeatureHandler_Base_V2') ):

	class ICWP_WPTB_FeatureHandler_Base_V2 {

		/**
		 * @var ICWP_Wordpress_Twitter_Bootstrap_Plugin
		 */
		protected $oPluginVo;

		/**
		 * @var string
		 */
		const CollateSeparator = '--SEP--';
		/**
		 * @var string
		 */
		const PluginVersionKey = 'current_plugin_version';

		/**
		 * @var boolean
		 */
		protected $fNeedSave;

		/**
		 * @var array
		 */
		protected $aOptions;

		/**
		 * These are options that need to be stored, but are never set by the UI.
		 *
		 * @var array
		 */
		protected $aNonUiOptions;

		/**
		 * @var array
		 */
		protected $m_aOptionsValues;

		/**
		 * @var string
		 */
		protected $sOptionsStoreKey;

		/**
		 * @var array
		 */
		protected $aOptionsKeys;

		/**
		 * @var string
		 */
		protected $sFeatureName;
		/**
		 * @var string
		 */
		protected $sFeatureSlug;

		/**
		 * @var string
		 */
		protected static $sPluginBaseFile;

		/**
		 * @var string
		 */
		protected $fShowFeatureMenuItem = true;

		/**
		 * @var ICWP_WPTB_FeatureHandler_Email
		 */
		protected static $oEmailHandler;

		/**
		 * @var ICWP_WPTB_FeatureHandler_Email
		 */
		protected static $oLoggingHandler;

		/**
		 * @var ICWP_WPTB_BaseProcessor
		 */
		protected $oFeatureProcessor;

		public function __construct( $oPluginVo, $sOptionsStoreKey = null ) {
			if ( empty( $oPluginVo ) ) {
				throw new Exception();
			}
			$this->oPluginVo = $oPluginVo;
			$this->sOptionsStoreKey = $this->prefixOptionKey(
				( is_null( $sOptionsStoreKey ) ? $this->getFeatureSlug() : $sOptionsStoreKey )
				.'_options'
			);

			// Handle any upgrades as necessary (only go near this if it's the admin area)
			add_action( 'plugins_loaded', array( $this, 'onWpPluginsLoaded' ) );
			add_action( 'init', array( $this, 'onWpInit' ), 1 );
			add_action( $this->doPluginPrefix( 'form_submit' ), array( $this, 'handleFormSubmit' ) );
			add_filter( $this->doPluginPrefix( 'filter_plugin_submenu_items' ), array( $this, 'filter_addPluginSubMenuItem' ) );
			add_filter( $this->doPluginPrefix( 'get_feature_summary_data' ), array( $this, 'filter_getFeatureSummaryData' ) );
			add_filter( $this->doPluginPrefix( 'flush_logs' ), array( $this, 'filter_flushFeatureLogs' ) );
			add_action( $this->doPluginPrefix( 'plugin_shutdown' ), array( $this, 'action_doFeatureShutdown' ) );

			add_action( $this->doPluginPrefix( 'delete_plugin_options' ), array( $this, 'deletePluginOptions' )  );
			add_filter( $this->doPluginPrefix( 'aggregate_all_plugin_options' ), array( $this, 'aggregateOptionsValues' ) );
		}

		public function override() {
			$oWpFs = $this->loadFileSystemProcessor();
			if ( $oWpFs->fileExistsInDir( 'forceOff', $this->oPluginVo->getRootDir(), false ) ) {
				$this->setIsMainFeatureEnabled( false );
			}
			else if ( $oWpFs->fileExistsInDir( 'forceOn', $this->oPluginVo->getRootDir(), false ) ) {
				$this->setIsMainFeatureEnabled( true );
			}
		}

		/**
		 * A action added to WordPress 'plugins_loaded' hook
		 */
		public function onWpPluginsLoaded() {

			if ( $this->getIsMainFeatureEnabled() ) {
				$oProcessor = $this->loadFeatureProcessor();
				if ( is_object( $oProcessor ) && $oProcessor instanceof ICWP_WPTB_BaseProcessor ) {
					$oProcessor->run();
				}
			}
		}

		/**
		 * A action added to WordPress 'init' hook
		 */
		public function onWpInit() {
			$this->updateHandler();
		}

		/**
		 * Override this and adapt per feature
		 * @return null
		 */
		protected function loadFeatureProcessor() {
			return null;
		}

		/**
		 * @return bool
		 */
		public function getIsUpgrading() {
			return $this->getVersion() != $this->oPluginVo->getVersion();
		}

		/**
		 * Hooked to the plugin's main plugin_shutdown action
		 */
		public function action_doFeatureShutdown() {
			$this->savePluginOptions();

			if ( $this->oPluginVo->getIsLoggingEnabled() ) {
				$aLogData = apply_filters( $this->doPluginPrefix( 'flush_logs' ), array() );
				$oLoggingProcessor = $this->getLoggingProcessor();
				$oLoggingProcessor->addDataToWrite( $aLogData );
				$oLoggingProcessor->commitData();
			}
		}

		/**
		 * @return ICWP_WPTB_BaseProcessor
		 */
		public function getProcessor() {
			return $this->loadFeatureProcessor();
		}

		/**
		 * @return ICWP_WPTB_FeatureHandler_Email
		 */
		public static function GetEmailHandler() {
			if ( is_null( self::$oEmailHandler ) ) {
				self::$oEmailHandler = new ICWP_WPTB_FeatureHandler_Email( ICWP_Wordpress_Simple_Firewall_Plugin::GetInstance() );
			}
			return self::$oEmailHandler;
		}

		/**
		 * @return ICWP_WPTB_EmailProcessor
		 */
		public function getEmailProcessor() {
			return $this->GetEmailHandler()->getProcessor();
		}

		/**
		 * @return ICWP_WPTB_FeatureHandler_Logging
		 */
		public static function GetLoggingHandler() {
			if ( is_null( self::$oLoggingHandler ) ) {
				self::$oLoggingHandler = new ICWP_WPTB_FeatureHandler_Logging( ICWP_Wordpress_Simple_Firewall_Plugin::GetInstance() );
			}
			return self::$oLoggingHandler;
		}

		/**
		 * @return ICWP_WPTB_LoggingProcessor
		 */
		public function getLoggingProcessor() {
			return $this->GetLoggingHandler()->getProcessor();
		}

		/**
		 * @param $fEnable
		 */
		public function setIsMainFeatureEnabled( $fEnable ) {
			$this->setOpt( 'enable_'.$this->getFeatureSlug(), $fEnable ? 'Y' : 'N' );
		}

		/**
		 * @return mixed
		 */
		public function getIsMainFeatureEnabled() {
			$this->override();
			return $this->getOptIs( 'enable_'.$this->getFeatureSlug(), 'Y' );
		}

		/**
		 * @return mixed
		 */
		protected function getMainFeatureName() {
			return $this->sFeatureName;
		}

		/**
		 * @return string
		 */
		public function getPluginBaseFile() {
			if ( !isset( self::$sPluginBaseFile ) ) {
				self::$sPluginBaseFile	= plugin_basename( $this->oPluginVo->getRootFile() );
			}
			return self::$sPluginBaseFile;
		}

		/**
		 * @return string
		 */
		public function getFeatureSlug() {
			return $this->sFeatureSlug;
		}

		/**
		 * with trailing slash
		 * @param string $sSourceFile
		 * @return string
		 */
		public function getResourcesDir( $sSourceFile = '' ) {
			return $this->oPluginVo->getRootDir().'resources'.ICWP_DS.ltrim( $sSourceFile, ICWP_DS );
		}

		/**
		 * with trailing slash
		 * @param string $sSourceFile
		 * @return string
		 */
		public function getPathToInc( $sSourceFile = '' ) {
			return $this->oPluginVo->getRootDir().'inc'.ICWP_DS.ltrim( $sSourceFile, ICWP_DS );
		}

		/**
		 * with trailing slash
		 * @param string $sSourceFile
		 * @return string
		 */
		public function getSrcFile( $sSourceFile = '' ) {
			return $this->oPluginVo->getRootDir().'src'.ICWP_DS.ltrim( $sSourceFile, ICWP_DS );
		}

		/**
		 * with trailing slash by default
		 * @param string $sSubPath
		 * @return string
		 */
		public function getPluginRootUrl( $sSubPath = '' ) {
			return plugins_url( $sSubPath, $this->oPluginVo->getRootFile() );
		}

		/**
		 * @param string $sResource
		 * @return string
		 */
		public function getPathToCss( $sResource = '' ) {
			return $this->getResourcesDir( 'css'.ICWP_DS.ltrim( $sResource, ICWP_DS ) );
		}

		/**
		 * @param string $sResource
		 * @return string
		 */
		public function getPathToJs( $sResource = '' ) {
			return $this->getResourcesDir( 'js'.ICWP_DS.ltrim( $sResource, ICWP_DS ) );
		}

		/**
		 * @param string $sResource
		 * @return string
		 */
		public function getResourceUrl( $sResource = '' ) {
			return $this->getPluginRootUrl( 'resources'.ICWP_DS.ltrim( $sResource, ICWP_DS ) );
		}

		/**
		 *
		 */
		public function filter_flushFeatureLogs( $aLogs ) {
			if ( $this->getIsMainFeatureEnabled() ) {
				$aFeatureLogs = $this->getProcessor()->flushLogData();
				if ( !empty( $aFeatureLogs ) ) {
					$aLogs = array_merge( $aLogs, $aFeatureLogs );
				}
			}
			return $aLogs;
		}

		/**
		 * @param array $aItems
		 * @return array
		 */
		public function filter_addPluginSubMenuItem( $aItems ) {
			if ( !$this->fShowFeatureMenuItem || empty( $this->sFeatureName ) ) {
				return $aItems;
			}
			$sMenuPageTitle = $this->oPluginVo->getHumanName().' - '.$this->getMainFeatureName();
			$aItems[ $sMenuPageTitle ] = array(
				$this->getMainFeatureName(),
				$this->sFeatureSlug,
				array( $this, 'displayFeatureConfigPage' )
			);
			return $aItems;
		}

		/**
		 * @param array $aSummaryData
		 * @return array
		 */
		public function filter_getFeatureSummaryData( $aSummaryData ) {
			if ( !$this->fShowFeatureMenuItem ) {
				return $aSummaryData;
			}

			$aSummaryData[] = array(
				$this->getIsMainFeatureEnabled(),
				$this->getMainFeatureName(),
				$this->doPluginPrefix( $this->sFeatureSlug )
			);

			return $aSummaryData;
		}

		/**
		 * @return bool
		 */
		public function hasPluginManageRights() {
			if ( !current_user_can( $this->oPluginVo->getBasePermissions() ) ) {
				return false;
			}

			$oWpFunc = $this->loadWpFunctionsProcessor();
			if ( is_admin() && !$oWpFunc->isMultisite() ) {
				return true;
			}
			else if ( is_network_admin() && $oWpFunc->isMultisite() ) {
				return true;
			}
			return false;
		}

		/**
		 * @return string
		 */
		public function getVersion() {
			$sVersion = $this->getOpt( self::PluginVersionKey );
			return empty( $sVersion )? '0.0' : $sVersion;
		}

		/**
		 * Gets the array of all possible options keys
		 *
		 * @return array
		 */
		public function getOptionsKeys() {
			$this->setOptionsKeys();
			return $this->aOptionsKeys;
		}

		/**
		 * @return void
		 */
		public function setOptionsKeys() {
			if ( !empty( $this->aOptionsKeys ) ) {
				return;
			}
			$this->buildOptions();
		}

		/**
		 * Determines whether the given option key is a valid option
		 *
		 * @param string
		 * @return boolean
		 */
		public function getIsOptionKey( $sOptionKey ) {
			$this->setOptionsKeys();
			return ( in_array( $sOptionKey, $this->aOptionsKeys ) );
		}

		/**
		 * Sets the value for the given option key
		 *
		 * @param string $insKey
		 * @param mixed $inmValue
		 * @return boolean
		 */
		public function setOpt( $insKey, $inmValue ) {

			if ( !$this->getIsOptionKey( $insKey ) ) {
				return false;
			}

			if ( !isset( $this->m_aOptionsValues ) ) {
				$this->loadStoredOptionsValues();
			}

			if ( $this->getOpt( $insKey ) === $inmValue ) {
				return true;
			}
			$this->m_aOptionsValues[ $insKey ] = $inmValue;
			$this->fNeedSave = true;
			return true;
		}

		/**
		 * @param string $sOptionKey
		 * @param mixed $mDefault
		 * @return mixed
		 */
		public function getOpt( $sOptionKey, $mDefault = false ) {
			if ( !isset( $this->m_aOptionsValues ) ) {
				$this->loadStoredOptionsValues();
			}
			return ( isset( $this->m_aOptionsValues[ $sOptionKey ] )? $this->m_aOptionsValues[ $sOptionKey ] : $mDefault );
		}

		/**
		 * @param $sKey
		 * @param mixed $mValueToTest
		 * @param boolean $fStrict
		 * @return bool
		 */
		public function getOptIs( $sKey, $mValueToTest, $fStrict = false ) {
			$mOptionValue = $this->getOpt( $sKey );
			return $fStrict? $mOptionValue === $mValueToTest : $mOptionValue == $mValueToTest;
		}

		/**
		 * Retrieves the full array of options->values
		 *
		 * @return array
		 */
		public function getOptions() {
			$this->buildOptions();
			return $this->aOptions;
		}

		/**
		 * Saves the options to the WordPress Options store.
		 *
		 * It will also update the stored plugin options version.
		 */
		public function savePluginOptions() {

			$this->doPrePluginOptionsSave();
			$this->cleanOptions();
			$this->updateOptionsVersion();
			if ( !$this->fNeedSave ) {
				return true;
			}

			$oWpFunc = $this->loadWpFunctionsProcessor();
			$oWpFunc->updateOption( $this->sOptionsStoreKey, $this->m_aOptionsValues );
			$this->fNeedSave = false;
			return true;
		}

		/**
		 *
		 */
		protected function cleanOptions() {
			if ( empty( $this->m_aOptionsValues ) || !is_array( $this->m_aOptionsValues ) ) {
				return;
			}
			foreach( $this->m_aOptionsValues as $sKey => $mValue ) {
				if ( !$this->getIsOptionKey( $sKey ) ) {
					unset( $this->m_aOptionsValues[$sKey] );
				}
			}
		}

		/**
		 * @param $aAggregatedOptions
		 * @return array
		 */
		public function aggregateOptionsValues( $aAggregatedOptions ) {
			return array_merge( $aAggregatedOptions, $this->loadStoredOptionsValues() );
		}

		/**
		 * Loads the options and their stored values from the WordPress Options store.
		 */
		public function loadStoredOptionsValues() {
			if ( empty( $this->m_aOptionsValues ) ) {
				$oWpFunc = $this->loadWpFunctionsProcessor();
				$this->m_aOptionsValues = $oWpFunc->getOption( $this->sOptionsStoreKey, array() );
				if ( empty( $this->m_aOptionsValues ) ) {
					$this->fNeedSave = true;
				}
			}
			return $this->m_aOptionsValues;
		}

		/**
		 */
		protected function defineOptions() {
			$this->aOptions = $this->getOptionsDefinitions();

			// All features store the current plugin version.
			$this->aNonUiOptions = array( self::PluginVersionKey );
			$aNonUiOptions = $this->getNonUiOptions();
			if ( !empty( $aNonUiOptions ) || is_array( $aNonUiOptions ) ) {
				$this->aNonUiOptions = array_merge( $this->aNonUiOptions, $aNonUiOptions );
			}
		}

		/**
		 * @return array
		 */
		protected function getOptionsDefinitions() {
			$aMisc = array(
				'section_title' => 'Miscellaneous Plugin Options',
				'section_options' => array(
					array(
						'delete_on_deactivate',
						'',
						'N',
						'checkbox',
						'Delete Plugin Settings',
						'Delete All Plugin Settings Upon Plugin Deactivation',
						'Careful: Removes all plugin options when you deactivite the plugin.'
					),
				),
			);
			$aOptionsDefinitions = array(
				$aMisc
			);
			return $aOptionsDefinitions;
		}

		/**
		 * @return array
		 */
		protected function getNonUiOptions() {
			return array();
		}

		/**
		 * Will initiate the plugin options structure for use by the UI builder.
		 *
		 * It will also fill in $this->m_aOptionsValues with defaults where appropriate.
		 *
		 * It doesn't set any values, just populates the array created in buildOptions()
		 * with values stored.
		 *
		 * It has to handle the conversion of stored values to data to be displayed to the user.
		 */
		public function buildOptions() {

			$this->defineOptions();
			$this->loadStoredOptionsValues();

			$this->aOptionsKeys = array();
			foreach ( $this->aOptions as &$aOptionsSection ) {

				if ( empty( $aOptionsSection ) || !isset( $aOptionsSection['section_options'] ) ) {
					continue;
				}

				foreach ( $aOptionsSection['section_options'] as &$aOptionParams ) {

					if ( $aOptionParams[0] == 'spacer' ) {
						continue;
					}

					list( $sOptionKey, $sOptionValue, $sOptionDefault, $sOptionType ) = $aOptionParams;

					$this->aOptionsKeys[] = $sOptionKey;

					if ( $this->getOpt( $sOptionKey ) === false ) {
						$this->setOpt( $sOptionKey, $sOptionDefault );
					}
					$mCurrentOptionVal = $this->getOpt( $sOptionKey );

					if ( $sOptionType == 'password' && !empty( $mCurrentOptionVal ) ) {
						$mCurrentOptionVal = '';
					}
					else if ( $sOptionType == 'ip_addresses' ) {

						if ( empty( $mCurrentOptionVal ) ) {
							$mCurrentOptionVal = '';
						}
						else {
							$mCurrentOptionVal = implode( "\n", $this->convertIpListForDisplay( $mCurrentOptionVal ) );
						}
					}
					else if ( $sOptionType == 'yubikey_unique_keys' ) {

						if ( empty( $mCurrentOptionVal ) ) {
							$mCurrentOptionVal = '';
						}
						else {
							$aDisplay = array();
							foreach( $mCurrentOptionVal as $aParts ) {
								$aDisplay[] = key($aParts) .', '. reset($aParts);
							}
							$mCurrentOptionVal = implode( "\n", $aDisplay );
						}
					}
					else if ( $sOptionType == 'comma_separated_lists' ) {

						if ( empty( $mCurrentOptionVal ) ) {
							$mCurrentOptionVal = '';
						}
						else {
							$aNewValues = array();
							foreach( $mCurrentOptionVal as $sPage => $aParams ) {
								$aNewValues[] = $sPage.', '. implode( ", ", $aParams );
							}
							$mCurrentOptionVal = implode( "\n", $aNewValues );
						}
					}
					$aOptionParams[1] = $mCurrentOptionVal;
				}
			}

			// Cater for Non-UI options that don't necessarily go through the UI
			if ( isset( $this->aNonUiOptions ) && is_array( $this->aNonUiOptions ) ) {
				foreach( $this->aNonUiOptions as $sOption ) {
					$this->aOptionsKeys[] = $sOption;
					if ( !$this->getOpt( $sOption ) ) {
						$this->setOpt( $sOption, '' );
					}
				}
			}
		}

		/**
		 * This is the point where you would want to do any options verification
		 */
		protected function doPrePluginOptionsSave() { }

		/**
		 */
		protected function updateOptionsVersion() {
			$this->setOpt( self::PluginVersionKey, $this->oPluginVo->getVersion() );
		}

		/**
		 * Deletes all the options including direct save.
		 */
		public function deletePluginOptions() {
			if ( apply_filters( $this->doPluginPrefix( 'has_permission_to_submit' ), true ) ) {
				$oWpFunc = $this->loadWpFunctionsProcessor();
				$oWpFunc->deleteOption( $this->sOptionsStoreKey );

				$this->getProcessor()->deleteAndCleanUp(); // gets rid of the databases used by the processors.

				//prevents resaving
				remove_action( $this->doPluginPrefix( 'plugin_shutdown' ), array( $this, 'action_doFeatureShutdown' ) );
			}
		}

		protected function convertIpListForDisplay( $inaIpList = array() ) {

			$aDisplay = array();
			if ( empty( $inaIpList ) || empty( $inaIpList['ips'] ) ) {
				return $aDisplay;
			}
			foreach( $inaIpList['ips'] as $sAddress ) {
				// offset=1 in the case that it's a range and the first number is negative on 32-bit systems
				$mPos = strpos( $sAddress, '-', 1 );

				if ( $mPos === false ) { //plain IP address
					$sDisplayText = long2ip( $sAddress );
				}
				else {
					//we remove the first character in case this is '-'
					$aParts = array( substr( $sAddress, 0, 1 ), substr( $sAddress, 1 ) );
					list( $nStart, $nEnd ) = explode( '-', $aParts[1], 2 );
					$sDisplayText = long2ip( $aParts[0].$nStart ) .'-'. long2ip( $nEnd );
				}
				$sLabel = $inaIpList['meta'][ md5($sAddress) ];
				$sLabel = trim( $sLabel, '()' );
				$aDisplay[] = $sDisplayText . ' ('.$sLabel.')';
			}
			return $aDisplay;
		}

		/**
		 * @return string
		 */
		protected function collateAllFormInputsForAllOptions() {

			if ( !isset( $this->aOptions ) ) {
				$this->buildOptions();
			}

			$aToJoin = array();
			foreach ( $this->aOptions as $aOptionsSection ) {

				if ( empty( $aOptionsSection ) ) {
					continue;
				}
				foreach ( $aOptionsSection['section_options'] as $aOption ) {
					list($sKey, $fill1, $fill2, $sType) =  $aOption;
					if ( is_array( $sType ) ) {
						$sType = isset( $sType['type'] ) ? $sType['type'] : $sType[0];
					}
					$aToJoin[] = $sType.':'.$sKey;
				}
			}
			return implode( self::CollateSeparator, $aToJoin );
		}

		/**
		 */
		public function handleFormSubmit() {
			if ( !apply_filters( $this->doPluginPrefix( 'has_permission_to_submit' ), true ) ) {
//				TODO: manage how we react to prohibited submissions
				return false;
			}

			// Now verify this is really a valid submission.
			check_admin_referer( $this->oPluginVo->getFullPluginPrefix() );

			$oDp = $this->loadDataProcessor();
			$sAllOptions = $oDp->FetchPost( $this->prefixOptionKey( 'all_options_input' ) );

			if ( empty( $sAllOptions ) ) {
				return true;
			}

			$this->updatePluginOptionsFromSubmit( $sAllOptions ); //it also saves
			return true;
		}

		/**
		 * @param string $sAllOptionsInput - comma separated list of all the input keys to be processed from the $_POST
		 * @return void|boolean
		 */
		public function updatePluginOptionsFromSubmit( $sAllOptionsInput ) {
			if ( empty( $sAllOptionsInput ) ) {
				return;
			}
			$oDp = $this->loadDataProcessor();
			$this->loadStoredOptionsValues();

			$aAllInputOptions = explode( self::CollateSeparator, $sAllOptionsInput );
			foreach ( $aAllInputOptions as $sInputKey ) {
				$aInput = explode( ':', $sInputKey );
				list( $sOptionType, $sOptionKey ) = $aInput;

				if ( !$this->getIsOptionKey( $sOptionKey ) ) {
					continue;
				}


				$sOptionValue = $oDp->FetchPost( $this->prefixOptionKey( $sOptionKey ) );
				if ( is_null( $sOptionValue ) ) {

					if ( $sOptionType == 'text' || $sOptionType == 'email' ) { //if it was a text box, and it's null, don't update anything
						continue;
					}
					else if ( $sOptionType == 'checkbox' ) { //if it was a checkbox, and it's null, it means 'N'
						$sOptionValue = 'N';
					}
					else if ( $sOptionType == 'integer' ) { //if it was a integer, and it's null, it means '0'
						$sOptionValue = 0;
					}
				}
				else { //handle any pre-processing we need to.

					if ( $sOptionType == 'text' || $sOptionType == 'email' ) {
						$sOptionValue = trim( $sOptionValue );
					}
					if ( $sOptionType == 'integer' ) {
						$sOptionValue = intval( $sOptionValue );
					}
					else if ( $sOptionType == 'password' && $this->hasEncryptOption() ) { //md5 any password fields
						$sTempValue = trim( $sOptionValue );
						if ( empty( $sTempValue ) ) {
							continue;
						}
						$sOptionValue = md5( $sTempValue );
					}
					else if ( $sOptionType == 'ip_addresses' ) { //ip addresses are textareas, where each is separated by newline
						$sOptionValue = $oDp->ExtractIpAddresses( $sOptionValue );
					}
					else if ( $sOptionType == 'yubikey_unique_keys' ) { //ip addresses are textareas, where each is separated by newline and are 12 chars long
						$sOptionValue = $oDp->CleanYubikeyUniqueKeys( $sOptionValue );
					}
					else if ( $sOptionType == 'email' && function_exists( 'is_email' ) && !is_email( $sOptionValue ) ) {
						$sOptionValue = '';
					}
					else if ( $sOptionType == 'comma_separated_lists' ) {
						$sOptionValue = $oDp->ExtractCommaSeparatedList( $sOptionValue );
					}
					else if ( $sOptionType == 'multiple_select' ) {
					}
				}
				$this->setOpt( $sOptionKey, $sOptionValue );
			}
			return $this->savePluginOptions();
		}

		/**
		 * Should be over-ridden by each new class to handle upgrades.
		 *
		 * Called upon construction and after plugin options are initialized.
		 */
		protected function updateHandler() {
			if ( version_compare( $this->getVersion(), '3.0.0', '<' ) ) {
				$oWpFunctions = $this->loadWpFunctionsProcessor();
				$sKey = $this->doPluginPrefix( $this->getFeatureSlug().'_processor', '_' );
				$oWpFunctions->deleteOption( $sKey );
			}
		}

		/**
		 * @return boolean
		 */
		public function hasEncryptOption() {
			return function_exists( 'md5' );
			//	return extension_loaded( 'mcrypt' );
		}

		/**
		 * Prefixes an option key only if it's needed
		 *
		 * @param $sKey
		 * @return string
		 */
		protected function prefixOptionKey( $sKey ) {
			return $this->doPluginPrefix( $sKey, '_' );
		}

		/**
		 * Will prefix and return any string with the unique plugin prefix.
		 *
		 * @param string $sSuffix
		 * @param string $sGlue
		 * @return string
		 */
		public function doPluginPrefix( $sSuffix = '', $sGlue = '-' ) {
			$sPrefix = $this->oPluginVo->getFullPluginPrefix( $sGlue );

			if ( $sSuffix == $sPrefix || strpos( $sSuffix, $sPrefix.$sGlue ) === 0 ) { //it already has the prefix
				return $sSuffix;
			}

			return sprintf( '%s%s%s', $sPrefix, empty($sSuffix)? '' : $sGlue, empty($sSuffix)? '' : $sSuffix );
		}

		/**
		 * @param string
		 * @return string
		 */
		public function getOptionStoragePrefix() {
			return $this->oPluginVo->getOptionStoragePrefix();
		}

		/**
		 * @param string $insExistingListKey
		 * @param string $insFilterName
		 * @return array|false
		 */
		protected function processIpFilter( $insExistingListKey, $insFilterName ) {
			$aFilterIps = apply_filters( $insFilterName, array() );
			if ( empty( $aFilterIps ) ) {
				return false;
			}

			$aNewIps = array();
			foreach( $aFilterIps as $mKey => $sValue ) {
				if ( is_string( $mKey ) ) { //it's the IP
					$sIP = $mKey;
					$sLabel = $sValue;
				}
				else { //it's not an associative array, so the value is the IP
					$sIP = $sValue;
					$sLabel = '';
				}
				$aNewIps[ $sIP ] = $sLabel;
			}

			// now add and store the new IPs
			$aExistingIpList = $this->getOpt( $insExistingListKey );
			if ( !is_array( $aExistingIpList ) ) {
				$aExistingIpList = array();
			}

			$oDp = $this->loadDataProcessor();
			$nNewAddedCount = 0;
			$aNewList = $oDp->Add_New_Raw_Ips( $aExistingIpList, $aNewIps, $nNewAddedCount );
			if ( $nNewAddedCount > 0 ) {
				$this->setOpt( $insExistingListKey, $aNewList );
			}
		}

		/**
		 */
		public function displayFeatureConfigPage( ) {

			if ( !apply_filters( $this->doPluginPrefix( 'has_permission_to_view' ), true ) ) {
				$this->displayViewAccessRestrictedPage();
				return;
			}

//		$aPluginSummaryData = apply_filters( $this->doPluginPrefix( 'get_feature_summary_data' ), array() );
			$aData = array(
				'aSummaryData'		=> isset( $aPluginSummaryData ) ? $aPluginSummaryData : array()
			);
			$aData = array_merge( $this->getBaseDisplayData(), $aData );
			$this->display( $aData );
		}

		public function getIsCurrentPageConfig() {
			$oWpFunctions = $this->loadWpFunctionsProcessor();
			return $oWpFunctions->getCurrentWpAdminPage() == $this->doPluginPrefix( $this->sFeatureSlug );
		}

		/**
		 */
		public function displayViewAccessRestrictedPage( ) {
			$aData = $this->getBaseDisplayData();
			$this->display( $aData, 'access_restricted_index' );
		}

		protected function getBaseDisplayData() {
			return array(
				'var_prefix'		=> $this->oPluginVo->getOptionStoragePrefix(),
				'sPluginName'		=> $this->oPluginVo->getHumanName(),
				'sFeatureName'		=> $this->getMainFeatureName(),
				'fShowAds'			=> $this->getIsShowMarketing(),
				'nonce_field'		=> $this->oPluginVo->getFullPluginPrefix(),
				'sFeatureSlug'		=> $this->doPluginPrefix( $this->sFeatureSlug ),
				'form_action'		=> 'admin.php?page='.$this->doPluginPrefix( $this->sFeatureSlug ),
				'nOptionsPerRow'	=> 1,

				'aAllOptions'		=> $this->getOptions(),
				'all_options_input'	=> $this->collateAllFormInputsForAllOptions()
			);
		}

		/**
		 * @return boolean
		 */
		protected function getIsShowMarketing() {
			return apply_filters( $this->doPluginPrefix( 'show_marketing' ), true );
		}

		/**
		 * @param array $aData
		 * @param string $sView
		 * @return bool
		 */
		protected function display( $aData = array(), $sView = '' ) {

			if ( empty( $sView ) ) {
				$oWpFs = $this->loadFileSystemProcessor();
				$sCustomViewSource = $this->oPluginVo->getViewDir().$this->doPluginPrefix( 'config_'.$this->sFeatureSlug.'_index' ).'.php';
				$sNormalViewSource = $this->oPluginVo->getViewDir().$this->doPluginPrefix( 'config_index' ).'.php';
				$sFile = $oWpFs->exists( $sCustomViewSource ) ? $sCustomViewSource : $sNormalViewSource;
			}
			else {
				$sFile = $this->oPluginVo->getViewDir().$this->doPluginPrefix( $sView ).'.php';
			}

			if ( !is_file( $sFile ) ) {
				echo "View not found: ".$sFile;
				return false;
			}

			if ( count( $aData ) > 0 ) {
				extract( $aData, EXTR_PREFIX_ALL, $this->oPluginVo->getParentSlug() ); //slug being 'icwp'
			}

			ob_start();
			include( $sFile );
			$sContents = ob_get_contents();
			ob_end_clean();

			echo $sContents;
			return true;
		}

		/**
		 * @return ICWP_WPTB_DataProcessor
		 */
		public function loadDataProcessor() {
			if ( !class_exists('ICWP_WPTB_DataProcessor') ) {
				require_once( dirname(__FILE__).'/icwp-data-processor.php' );
			}
			return ICWP_WPTB_DataProcessor::GetInstance();
		}

		/**
		 * @return ICWP_WPTB_WpFilesystem
		 */
		public function loadFileSystemProcessor() {
			if ( !class_exists('ICWP_WPTB_WpFilesystem') ) {
				require_once( dirname(__FILE__) . '/icwp-wpfilesystem.php' );
			}
			return ICWP_WPTB_WpFilesystem::GetInstance();
		}
		/**
		 * @return ICWP_WPTB_WpFunctions
		 */
		public function loadWpFunctionsProcessor() {
			require_once( dirname(__FILE__) . '/icwp-wpfunctions.php' );
			return ICWP_WPTB_WpFunctions::GetInstance();
		}

		/**
		 * @return ICWP_Stats_WPTB
		 */
		public function loadStatsProcessor() {
			require_once( dirname(__FILE__) . '/icwp-wpsf-stats.php' );
		}

		/**
		 * @param $sStatKey
		 */
		public function doStatIncrement( $sStatKey ) {
			$this->loadStatsProcessor();
			ICWP_Stats_WPTB::DoStatIncrement( $sStatKey );
		}
	}

endif;

class ICWP_WPTB_FeatureHandler_Base extends ICWP_WPTB_FeatureHandler_Base_V2 { }