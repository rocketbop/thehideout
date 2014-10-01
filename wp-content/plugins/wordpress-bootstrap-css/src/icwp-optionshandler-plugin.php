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

require_once( dirname(__FILE__).'/icwp-optionshandler-base.php' );

if ( !class_exists('ICWP_WPTB_FeatureHandler_Plugin') ):

class ICWP_WPTB_FeatureHandler_Plugin extends ICWP_WPTB_FeatureHandler_Base {

	const Default_AccessKeyTimeout = 30;
	
	/**
	 * @var ICWP_WPTB_PluginProcessor
	 */
	protected $oFeatureProcessor;

	public function __construct( $oPluginVo ) {
		$this->sFeatureName = _wptb__('Dashboard');
		$this->sFeatureSlug = 'plugin';
		parent::__construct( $oPluginVo, 'plugin' );

		add_filter( $this->doPluginPrefix( 'report_email_address' ), array( $this, 'getPluginReportEmail' ) );
	}

	/**
	 * @return ICWP_WPTB_PluginProcessor|null
	 */
	protected function loadFeatureProcessor() {
		if ( !isset( $this->oFeatureProcessor ) ) {
			require_once( dirname(__FILE__).'/icwp-processor-plugin.php' );
			$this->oFeatureProcessor = new ICWP_WPTB_PluginProcessor( $this );
		}
		return $this->oFeatureProcessor;
	}

	/**
	 * @return mixed
	 */
	public function getIsMainFeatureEnabled() {
		return true;
	}

	/**
	 * @param array $aSummaryData
	 * @return array
	 */
	public function filter_getFeatureSummaryData( $aSummaryData ) {
		return $aSummaryData;
	}

	/**
	 */
	public function displayFeatureConfigPage( ) {

		if ( !apply_filters( $this->doPluginPrefix( 'has_permission_to_view' ), true ) ) {
			$this->displayViewAccessRestrictedPage();
			return;
		}

		$aPluginSummaryData = apply_filters( $this->doPluginPrefix( 'get_feature_summary_data' ), array() );

		$aData = array(
			'aAllOptions'		=> $this->getOptions(),
			'all_options_input'	=> $this->collateAllFormInputsForAllOptions(),
			'aSummaryData'		=> $aPluginSummaryData
		);
		$aData = array_merge( $this->getBaseDisplayData(), $aData );
		$this->display( $aData );
	}

	/**
	 * @param $sEmail
	 * @return string
	 */
	public function getPluginReportEmail( $sEmail ) {
		$sReportEmail = $this->getOpt( 'block_send_email_address' );
		if ( !empty( $sReportEmail ) && is_email( $sReportEmail ) ) {
			$sEmail = $sReportEmail;
		}
		return $sEmail;
	}

	/**
	 * @return array
	 */
	protected function getOptionsDefinitions() {
		$aGeneral = array(
			'section_title' => _wptb__( 'General Plugin Options' ),
			'section_options' => array(
				array(
					'auto_update_minor_releases',
					'',
					'Y',
					'checkbox',
					'Automatic Updates',
					'Plugin Automatically Updates For Minor Releases',
					'When enabled, will only update the plugin for minor releases (typically bug-fixes) - that is, releases where the Twitter Bootstrap version does not change.'
				),
				array(
					'hide_dashboard_rss_feed',
					'',
					'N',
					'checkbox',
					'Hide RSS News Feed',
					'Hide the iControlWP Blog news feed from the Dashboard',
					'Hides our news feed from inside your Dashboard.'
				),
				array(
					'enable_upgrade_admin_notice',
					'',
					'Y',
					'checkbox',
					_wptb__( 'Plugin Notices' ),
					_wptb__( 'Display Notices For Updates' ),
					_wptb__( 'Disable this option to hide certain plugin admin notices about available updates and post-update notices' )
				),
				array(
					'delete_on_deactivate',
					'',
					'N',
					'checkbox',
					_wptb__( 'Delete Plugin Settings' ),
					_wptb__( 'Delete All Plugin Settings Upon Plugin Deactivation' ),
					_wptb__( 'Careful: Removes all plugin options when you deactivate the plugin' )
				)
			)
		);

		$aOptionsDefinitions = array(
			$aGeneral
		);
		return $aOptionsDefinitions;
	}

	/**
	 * @return array
	 */
	protected function getNonUiOptions() {
		$aNonUiOptions = array(
			'installation_time',
			'feedback_admin_notice',
			'update_success_tracker'
		);
		return $aNonUiOptions;
	}
	
	/**
	 * This is the point where you would want to do any options verification
	 */
	protected function doPrePluginOptionsSave() {
		$nInstalledAt = $this->getOpt( 'installation_time' );
		if ( empty($nInstalledAt) || $nInstalledAt <= 0 ) {
			$this->setOpt( 'installation_time', time() );
		}
	}

	protected function updateHandler() {
		parent::updateHandler();
		if ( version_compare( $this->getVersion(), '3.2.0', '<' ) ) {
			$oWp = $this->loadWpFunctionsProcessor();
			$sOldKey = 'hlt_bootstrapcss_plugin_options';
			$aCurrentSettings = $oWp->getOption( $sOldKey );
			$aOptionsToMigrate = array(
				'hide_dashboard_rss_feed',
				'delete_on_deactivate'
			);
			foreach( $aOptionsToMigrate as $sOptionKey ) {
				$this->setOpt( $sOptionKey, $aCurrentSettings[$sOptionKey] );
			}
		}
	}
}

endif;