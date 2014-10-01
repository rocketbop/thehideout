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

if ( !class_exists('ICWP_WPTB_FeatureHandler_Css') ):

class ICWP_WPTB_FeatureHandler_Css extends ICWP_WPTB_FeatureHandler_Base {

	const TwitterVersion			= '3.2.0'; //should reflect the Bootstrap version folder name
	const TwitterVersionLegacy		= '2.3.2'; //should reflect the Bootstrap version folder name
	const NormalizeVersion			= '3.0.1';
	const YUI3Version				= '3.10.0';

	/**
	 * @var ICWP_WPTB_CssProcessor
	 */
	protected $oFeatureProcessor;
	/**
	 * How long the CSS cache will be maintained before it is automatically rebuilt (to ensure files and links work)
	 * @const integer
	 */
	const CssCacheExpire			= 172800; // 48hours

	/**
	 * @param $oPluginVo
	 */
	public function __construct( $oPluginVo ) {
		$this->sFeatureName = _wptb__('Bootstrap CSS');
		$this->sFeatureSlug = 'bootstrapcss';
		parent::__construct( $oPluginVo );
	}

	/**
	 * @return ICWP_WPTB_CssProcessor|null
	 */
	protected function loadFeatureProcessor() {
		if ( !isset( $this->oFeatureProcessor ) ) {
			require_once( dirname(__FILE__).'/icwp-processor-css.php' );
			$this->oFeatureProcessor = new ICWP_WPTB_CssProcessor( $this );
		}
//		ob_start( array( $this->oFeatureProcessor, 'onOutputBufferFlush' ) );
		return $this->oFeatureProcessor;
	}

	public function handleFormSubmit() {
		if ( !parent::handleFormSubmit() ) {
			return false;
		}

		$this->maybeClearIncludesCache( true );
	}

	/**
	 * @return string
	 */
	public function getTwitterBootstrapVersion() {
		if ( $this->getOpt( 'option' ) == 'twitter-legacy' ) {
			return self::TwitterVersionLegacy;
		}
		return self::TwitterVersion;
	}

	public function getNonUiOptions() {
		$aNonUiOptions = array(
			'feedback_admin_notice',
			'includes_list',
			'css_cache_expire',
			'inc_responsive_css'
		);
		return $aNonUiOptions;
	}

	public function getOptionsDefinitions() {

		$aBase = array(
			'section_title' => 'Enable or Disable The CSS Include Feature',
			'section_options' => array(
				array(
					'enable_bootstrapcss',
					'',
					'Y',
					'checkbox',
					'Enable Feature',
					'Enable or Disable The CSS Includes Feature',
					'Checking this will completely enable or disable the CSS includes feature of the plugin.'
					.'<br />'.'Once enabled please select your options below.'
				)
			)
		);

		$aBootstrapOptions = array( 'select',
			array( 'none', 				'None' ),
			array( 'twitter',			'Twitter Bootstrap CSS v'.self::TwitterVersion ),
			array( 'twitter-legacy',	'Twitter Bootstrap CSS v'.self::TwitterVersionLegacy ),
			array( 'twitter-less',		'Customised Twitter Bootstrap CSS Using LESS' ),
			array( 'normalize',			'Normalize CSS v'.self::NormalizeVersion ),
			array( 'yahoo-reset',		'Yahoo UI Reset CSS v2.9.0' ),
			array( 'yahoo-reset-3',		'Yahoo UI Reset CSS v'.self::YUI3Version )
		);

		$aBootstrapSection = 	array(
			'section_title' => 'Choose CSS Include Options',
			'section_options' => array(
				array(
					'option',
					'',
					'none',
					$aBootstrapOptions,
					'Bootstrap Option',
					'Choose Your Preferred Bootstrap Option',
					'If you choose customized LESS, you should use the LESS compiler to create your preferred Twitter Bootstrap settings'
				),
				array(
					'enq_using_wordpress',
					'',
					'N',
					'checkbox',
					'Use WordPress System',
					"Not recommended- Use native WordPress CSS enqueue for Bootstrap files.",
					"This can't guarantee the file will be loaded first (which it should be)."
				),
				array(
					'customcss',
					'',
					'N',
					'checkbox',
					'Custom Reset CSS',
					'Enable custom CSS link',
					'(note: linked after any bootstrap/reset CSS selected above)'
				),
				array(
					'customcss_url',
					'',
					'http://',
					'text',
					'Custom CSS URL',
					'Provide the <strong>full</strong> URL path.',
					''
				)
			)
		);
		$aTwitterBootstrapSection = 	array(
			'section_title' => 'Twitter Bootstrap Javascript Library Options',
			'section_options' => array(
				array(
					'all_js',
					'',
					'none',
					'checkbox',
					'All Javascript Libraries',
					'Include ALL Bootstrap Javascript libraries',
					'This will also include the jQuery library if it is not already included'
				),
				array(
					'js_head',
					'',
					'N',
					'checkbox',
					'JavaScript Placement',
					'Place Javascript in &lt;HEAD&gt;',
					'Only check this option if know you need it.'
				),
			),
		);
		$aExtraTwitterSection = 	array(
			'section_title' => 'Extra Twitter Bootstrap Options',
			'section_options' => array(
				array(
					'useshortcodes',
					'',
					'N',
					'checkbox',
					'Bootstrap Shortcodes',
					'Enable Twitter Bootstrap Shortcodes',
					'Loads WordPress shortcodes for fast use of Twitter Bootstrap Components.'
				),
				array(
					'enable_shortcodes_sidebarwidgets',
					'',
					'N',
					'checkbox',
					'Sidebar Shortcodes',
					'Enable Shortcodes in Sidebar Widgets',
					'Allows you to use Twitter Bootstrap (and any other) shortcodes in your Sidebar Widgets.'
				),
				array(
					'use_minified_css',
					'',
					'N',
					'checkbox',
					'Minified',
					'Use Minified CSS/JS libraries',
					'Uses minified CSS libraries where available.'
				),
				array(
					'use_compiled_css',
					'',
					'N',
					'checkbox',
					'Enabled LESS',
					'Enables LESS Compiler Section',
					'Use the LESS Compiler to customize your Twitter Bootstrap CSS.'
				),
				array(
					'replace_jquery_cdn',
					'',
					'N',
					'checkbox',
					'Replace JQuery',
					'Replace JQuery library with JQuery from CDNJS',
					"In case your WordPress version is too old and doesn't have the necessary JQuery version, this will replace your JQuery with a compatible version served from CDNJS."
				)
			)
		);
		
		$aMiscOptionsSection = 	array(
			'section_title' => 'Miscellaneous Plugin Options',
			'section_options' => array(
				array(
					'use_cdnjs',
					'',
					'N',
					'checkbox',
					'Use CDNJS',
					'Link to CDNJS libraries',
					'Instead of serving libraries locally, use a dedicated CDN to serve files (<a href="http://wordpress.org/extend/plugins/cdnjs/" target="_blank">CDNJS</a>).'
				),
				array(
					'inc_bootstrap_css_in_editor',
					'',
					'N',
					'checkbox',
					'CSS in Editor',
					'Include Twitter Bootstrap CSS in the WordPress Post Editor',
					'Only select this if you want to have Bootstrap styles show in the editor.'
				),
				array(
					'inc_bootstrap_css_wpadmin',
					'',
					'N',
					'checkbox',
					'Admin Bootstrap CSS',
					'Include Twitter Bootstrap CSS in the WordPress Admin',
					'Not a standard Twitter Bootstrap CSS. <a href="http://bit.ly/HgwlZI" target="_blank"><span class="label label-info">more info</span></a>'
				),
				array(
					'prettify',
					'',
					'N',
					'checkbox',
					'Display Code Snippets',
					'Include Google Prettify/Pretty Links Javascript',
					'If you display code snippets or similar on your site, enabling this option will include the Google Prettify Javascript library for use with these code blocks.'
				)
			)
		);

		return array(
			$aBase,
			$aBootstrapSection,
			$aTwitterBootstrapSection,
			$aExtraTwitterSection,
			$aMiscOptionsSection
		);
	}

	/**
	 * This is the point where you would want to do any options verification
	 */
	protected function doPrePluginOptionsSave() {

		$sCustomUrl = $this->getOpt( 'customcss_url' );
		if ( !empty($sCustomUrl) && $this->getOpt( 'customcss' ) == 'Y' ) {

			$oWpFs = $this->loadFileSystemProcessor();
			if ( $oWpFs->getIsUrlValid( $sCustomUrl ) ) {
				$this->setOpt( 'customcss_url', $sCustomUrl );
			}
			else {
				$this->setOpt( 'customcss_url', '' );
			}
		}

		$this->maybeClearIncludesCache();
	}

	/**
	 * Clears the CSS Includes cache if the time has expired.
	 */
	public function maybeClearIncludesCache( $infForce = false ) {
		if ( $infForce || time() - $this->getOpt( 'css_cache_expire' ) > self::CssCacheExpire ) {
			$this->setOpt( 'includes_list', false ); //clear the cached css list
		}
	}

	public function updateHandler() {
		if ( $this->getIsUpgrading() ) {
			$this->maybeClearIncludesCache( true );
		}

		if ( version_compare( $this->getVersion(), '3.2.0', '<' ) ) {
			$oWp = $this->loadWpFunctionsProcessor();
			$sOldKey = 'hlt_bootstrapcss_plugin_options';
			$aCurrentSettings = $oWp->getOption( $sOldKey );
			$aOptionsToMigrate = array(
				'option',
				'enq_using_wordpress',
				'customcss',
				'customcss_url',
				'all_js',
				'js_head',
				'useshortcodes',
				'use_minified_css',
				'use_compiled_css',
				'replace_jquery_cdn',
				'use_cdnjs',
				'enable_shortcodes_sidebarwidgets',
				'inc_bootstrap_css_in_editor',
				'inc_bootstrap_css_wpadmin',
				'prettify'
			);
			foreach( $aOptionsToMigrate as $sOptionKey ) {
				$this->setOpt( $sOptionKey, $aCurrentSettings[$sOptionKey] );
			}

			if ( $aCurrentSettings['use_compiled_css'] == 'Y' ) {
				$this->setOpt( 'option', 'twitter-less' );
			}
		}
	}
}

endif;