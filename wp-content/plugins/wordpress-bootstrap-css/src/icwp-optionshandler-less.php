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

if ( !class_exists('ICWP_WPTB_FeatureHandler_Less') ):

class ICWP_WPTB_FeatureHandler_Less extends ICWP_WPTB_FeatureHandler_Base {

	const TwitterVersion			= '3.2.0'; //should reflect the Bootstrap version folder name
	const TwitterVersionLegacy		= '2.3.2'; //should reflect the Bootstrap version folder name

	const LessOptionsPrefix = 'less_';
	/**
	 * @var ICWP_WPTB_LessProcessor
	 */
	protected $oFeatureProcessor;
	/**
	 * @param $oPluginVo
	 */
	public function __construct( $oPluginVo ) {
		$this->sFeatureName = _wptb__('Bootstrap LESS');
		$this->sFeatureSlug = 'bootstrapless';
		parent::__construct( $oPluginVo );
	}

	/**
	 * @return ICWP_WPTB_LessProcessor|null
	 */
	protected function loadFeatureProcessor() {
		if ( !isset( $this->oFeatureProcessor ) ) {
			require_once( dirname(__FILE__).'/icwp-processor-less.php' );
			$this->oFeatureProcessor = new ICWP_WPTB_LessProcessor( $this );
		}
		return $this->oFeatureProcessor;
	}

	/**
	 * @return string
	 */
	public function getTwitterBootstrapVersion() {
		if ( $this->getOpt( 'less_bootstrap_version' ) == 'twitter-legacy' ) {
			return self::TwitterVersionLegacy;
		}
		return self::TwitterVersion;
	}

	/**
	 * @return mixed
	 */
	public function getIsMainFeatureEnabled() {
		return $this->getOpt( 'less_bootstrap_version' ) != 'none';
	}

	/**
	 */
	public function displayFeatureConfigPage( ) {
		if ( !apply_filters( $this->doPluginPrefix( 'has_permission_to_view' ), true ) ) {
			$this->displayViewAccessRestrictedPage();
			return;
		}

		$aData = array(
			'aSummaryData'		=> isset( $aPluginSummaryData ) ? $aPluginSummaryData : array(),
			'nOptionsPerRow'	=> 2
		);
		$aData = array_merge( $this->getBaseDisplayData(), $aData );
		$this->display( $aData );
	}

	public function handleFormSubmit() {
		if ( parent::handleFormSubmit() ) {
			$this->deleteLessCompiledCss();
		}
	}

	/**
	 */
	protected function deleteLessCompiledCss() {
		$oWpFs = $this->loadFileSystemProcessor();
		$oWpFs->deleteFile( $this->getPathToCss('bootstrap.less.css') );
		$oWpFs->deleteFile( $this->getPathToCss('bootstrap.less.min.css') );
	}


	public function getPath_TargetLessFileStem() {
		return $this->getPathToCss( 'bootstrap.less' );
	}

	public function getOptionsDefinitions(){

		$aBootstrapOptions = array( 'select',
			array( 'none', 				'None' ),
			array( 'twitter',			'Twitter Bootstrap CSS v'.self::TwitterVersion ),
			array( 'twitter-legacy',	'Twitter Bootstrap CSS v'.self::TwitterVersionLegacy )
		);

		$aBase = array(
			'section_title' => 'Enable or Disable The LESS Compiler Feature',
			'section_options' => array(
				array(
					'less_bootstrap_version',
					'',
					'none',
					$aBootstrapOptions,
					'Bootstrap Option',
					'Choose Your Preferred Bootstrap Version',
					"You should turn off this option completely if you're not using the LESS Compiler - set to 'none'"
					.'<br /><strong>'."When changing this option you will lose the LESS options you've currently selected.".'</strong>'
				)
			)
		);

		$aLess = array();
		if ( $this->getOpt('less_bootstrap_version') == 'twitter' ) {
			$aLess = $this->getLessOptions();
		}
		else if ( $this->getOpt('less_bootstrap_version') == 'twitter-legacy' ) {
			$aLess = $this->getLessOptionsLegacy();
		}
		return array_merge( array( $aBase ), $aLess );
	}

	/**
	 * This is the point where you would want to do any options verification
	 */
	protected function doPrePluginOptionsSave() { }

	/**
	 * @return array
	 */
	protected function getLessOptionsLegacy() {
		return array(
			array(
				'section_title' => 'Grays',
				'section_options' => array(
					array( self::LessOptionsPrefix.'black', 		'', '#000',	'less_color',	'Black',		'@black' ),
					array( self::LessOptionsPrefix.'grayDarker',	'', '#222',	'less_color',	'Darker Gray',	'@grayDarker' ),
					array( self::LessOptionsPrefix.'grayDark',		'', '#333',	'less_color',	'Dark Gray',	'@grayDark' ),
					array( self::LessOptionsPrefix.'gray',			'', '#555',	'less_color',	'Gray',			'@gray' ),
					array( self::LessOptionsPrefix.'grayLight',		'', '#999',	'less_color',	'Light Gray',	'@grayLight' ),
					array( self::LessOptionsPrefix.'grayLighter',	'', '#eee',	'less_color',	'Lighter Gray',	'@grayLighter' ),
					array( self::LessOptionsPrefix.'white',			'', '#fff',	'less_color',	'White',		'@white' )
				)
			),

			array(
				'section_title' => 'Fonts, Colours & Links',
				'section_options' => array(
					array( self::LessOptionsPrefix.'bodyBackground',	'', '@white',			'less_color',		'Body Background Colour',			'@bodyBackground' ), //@white
					array( self::LessOptionsPrefix.'textColor',			'', '@grayDark',		'less_color',		'Text Colour',						'@textColor' ),
					array( self::LessOptionsPrefix.'linkColor',			'', '#08c',				'less_color',		'Link Colour',						'@linkColor' ),
					array( self::LessOptionsPrefix.'linkColorHover', 	'', 'darken(@linkColor, 15%)',			'less_color',	'Link Hover Colour',	'@linkColorHover' ), //darken(@linkColor, 15%)
					array( self::LessOptionsPrefix.'blue', 				'', '#049cdb',			'less_color',		'Blue',								'@blue' ),
					array( self::LessOptionsPrefix.'blueDark',			'', '#0064cd',			'less_color',		'Dark Blue',						'@blueDark' ),
					array( self::LessOptionsPrefix.'green',				'', '#46a546',			'less_color',		'Green',							'@green' ),
					array( self::LessOptionsPrefix.'red',				'', '#9d261d',			'less_color',		'Red',								'@red' ),
					array( self::LessOptionsPrefix.'yellow',			'', '#ffc40d',			'less_color',		'Yellow',							'@yellow' ),
					array( self::LessOptionsPrefix.'orange',			'', '#f89406',			'less_color',		'Orange',							'@orange' ),
					array( self::LessOptionsPrefix.'pink', 				'', '#c3325f',			'less_color',		'Pink',								'@pink' ),
					array( self::LessOptionsPrefix.'purple', 			'', '#7a43b6',			'less_color',		'Purple',							'@purple' ),
					array( self::LessOptionsPrefix.'baseFontSize',		'', '13px',				'less_size',			'Font Size',						'@baseFontSize' ),
					array( self::LessOptionsPrefix.'baseLineHeight', 	'', '18px',				'less_size',			'Base Line Height',					'@baseLineHeight' ),
					array( self::LessOptionsPrefix.'baseFontFamily',	'', '"Helvetica Neue", Helvetica, Arial, sans-serif',	'less_font',	'Fonts',	'@baseFontFamily' ),
					array( self::LessOptionsPrefix.'altFontFamily',		'', 'Georgia, "Times New Roman", Times, serif',	'less_font',	'Alternative Fonts',	'@altFontFamily' ),
				)
			),

			array(
				'section_title' => 'Button Styling',
				'section_options' => array(
					array( self::LessOptionsPrefix.'btnBackground', 				'', '@white',							'less_color',	'Background' ),				//@white
					array( self::LessOptionsPrefix.'btnBackgroundHighlight',		'', 'darken(@white, 10%)',				'less_color',	'Background Highlight' ),	//darken(@white, 10%);
					array( self::LessOptionsPrefix.'btnPrimaryBackground',			'', '@linkColor',						'less_color',	'Primary Btn Background' ),	//@linkColor
					array( self::LessOptionsPrefix.'btnPrimaryBackgroundHighlight',	'', 'spin(@btnPrimaryBackground, 15%)',	'less_color',	'Primary Btn Highlight' ),	//spin(@btnPrimaryBackground, 15%)
					array( self::LessOptionsPrefix.'btnInfoBackground',				'', '#5bc0de',							'less_color',	'Info Btn Background' ),
					array( self::LessOptionsPrefix.'btnInfoBackgroundHighlight',	'', '#2f96b4',							'less_color',	'Info Btn Highlight' ),
					array( self::LessOptionsPrefix.'btnSuccessBackground',			'', '#62c462',							'less_color',	'Success Btn Background' ),
					array( self::LessOptionsPrefix.'btnSuccessBackgroundHighlight',	'', '#51a351',							'less_color',	'Success Btn Highlight' ),
					array( self::LessOptionsPrefix.'btnWarningBackground',			'', 'lighten(@orange, 15%)',			'less_color',	'Warning Btn Background' ),	//lighten(@orange, 15%)
					array( self::LessOptionsPrefix.'btnWarningBackgroundHighlight',	'', '@orange',							'less_color',	'Warning Btn Highlight' ),	//@orange
					array( self::LessOptionsPrefix.'btnDangerBackground',			'', '#ee5f5b',							'less_color',	'Danger Btn Background' ),
					array( self::LessOptionsPrefix.'btnDangerBackgroundHighlight',	'', '#bd362f',							'less_color',	'Danger Btn Highlight' ),
					array( self::LessOptionsPrefix.'btnInverseBackground',			'', '@gray',							'less_color',	'Inverse Btn Background' ),	//@gray
					array( self::LessOptionsPrefix.'btnInverseBackgroundHighlight',	'', '@grayDarker',						'less_color',	'Inverse Btn Highlight' ),	//@grayDarker
					array( self::LessOptionsPrefix.'btnBorder',						'', 'darken(@white, 20%)',				'less_color',	'Button Border' ),			//darken(@white, 20%)
				)
			),

			array(
				'section_title' => 'Alerts and Form States',
				'section_options' => array(
					array( self::LessOptionsPrefix.'warningText', 		'', '#c09853',			'less_color',	'Warning Text Colour' ),
					array( self::LessOptionsPrefix.'warningBackground',	'', '#fcf8e3',			'less_color',	'Warning Background Colour' ),
					array( self::LessOptionsPrefix.'warningBorder',		'', 'darken(spin(@warningBackground, -10), 3%)',			'less_color',	'Warning Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'errorText', 		'', '#b94a48',			'less_color',	'Error Text Colour' ),
					array( self::LessOptionsPrefix.'errorBackground',	'', '#f2dede',			'less_color',	'Error Background Colour' ),
					array( self::LessOptionsPrefix.'errorBorder',		'', 'darken(spin(@errorBackground, -10), 3%)',			'less_color',	'Error Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'successText', 		'', '#468847',			'less_color',	'Success Text Colour' ),
					array( self::LessOptionsPrefix.'successBackground',	'', '#dff0d8',			'less_color',	'Success Background Colour' ),
					array( self::LessOptionsPrefix.'successBorder',		'', 'darken(spin(@successBackground, -10), 5%)',			'less_color',	'Success Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'infoText', 			'', '#3a87ad',			'less_color',	'Info Text Colour' ),
					array( self::LessOptionsPrefix.'infoBackground',	'', '#d9edf7',			'less_color',	'Info Background Colour' ),
					array( self::LessOptionsPrefix.'infoBorder',		'', 'darken(spin(@infoBackground, -10), 7%)',			'less_color',	'Info Border Colour' ),
					array( 'spacer' )
				)
			),

			array(
				'section_title' => 'The Grid',
				'section_options' => array(
					array( self::LessOptionsPrefix.'gridColumns', 		'', '12',			'less_text',	'Grid Columns' ),
					array( self::LessOptionsPrefix.'gridColumnWidth',	'', '60px',			'less_size',	'Grid Column Width' ),
					array( self::LessOptionsPrefix.'gridGutterWidth',	'', '20px',			'less_size',	'Grid Gutter Width' ),
					array( self::LessOptionsPrefix.'gridRowWidth',		'', '(@gridColumns * @gridColumnWidth) + (@gridGutterWidth * (@gridColumns - 1))',	'less_size',	'Grid Row Width' )
				)
			)
		);
	}

	/**
	 * @return array
	 */
	protected function getLessOptions() {
		$aLessOptions = array(
			array(
				'section_title' => 'Grays',
				'section_options' => array(
					array( self::LessOptionsPrefix.'gray-darker',	'', 'lighten(#000, 13.5%)',	'less_color',	'Darker Gray',	'@grayDarker' ),
					array( self::LessOptionsPrefix.'gray-dark',		'', 'lighten(#000, 20%)',	'less_color',	'Dark Gray',	'@grayDark' ),
					array( self::LessOptionsPrefix.'gray',			'', 'lighten(#000, 33.5%)',	'less_color',	'Gray',			'@gray' ),
					array( self::LessOptionsPrefix.'gray-light',	'', 'lighten(#000, 60%)',	'less_color',	'Light Gray',	'@grayLight' ),
					array( self::LessOptionsPrefix.'gray-lighter',	'', 'lighten(#000, 93.5%)',	'less_color',	'Lighter Gray',	'@grayLighter' ),
				)
			),

			array(
				'section_title' => 'Brand Colours',
				'section_options' => array(
					array( self::LessOptionsPrefix.'brand-primary', 	'', '#428bca',		'less_color',	'Colour: Primary',		'@brand-primary' ),				//@white
					array( self::LessOptionsPrefix.'brand-success', 	'', '#5cb85c',		'less_color',	'Colour: Success',		'@brand-success' ),				//@white
					array( self::LessOptionsPrefix.'brand-warning', 	'', '#f0ad4e',		'less_color',	'Colour: Success',		'@brand-warning' ),				//@white
					array( self::LessOptionsPrefix.'brand-danger', 		'', '#d9534f',		'less_color',	'Colour: Success',		'@brand-danger' ),				//@white
					array( self::LessOptionsPrefix.'brand-info', 		'', '#5bc0de',		'less_color',	'Colour: Success',		'@brand-info' ),				//@white
				)
			),

			array(
				'section_title' => 'Fonts, Colours & Links',
				'section_options' => array(
					array( self::LessOptionsPrefix.'body-bg',					'', '#fff',												'less_color',	'Body Background Colour',		'@body-bg' ), //@white
					array( self::LessOptionsPrefix.'text-color',				'', '@gray-dark',										'less_color',	'Text Colour',					'@text-color' ),
					array( self::LessOptionsPrefix.'link-color',				'', '@brand-primary',									'less_color',	'Link Colour',					'@link-color' ),
					array( self::LessOptionsPrefix.'link-hover-color',		 	'', 'darken(@link-color, 15%)',							'less_color',	'Link Hover Colour',			'@link-hover-color' ), //darken(@linkColor, 15%)
					array( self::LessOptionsPrefix.'font-size-base',			'', '14px',												'less_size',	'Font Size Base',				'@baseFontSize' ),
					array( self::LessOptionsPrefix.'font-size-large',			'', 'ceil(@font-size-base * 1.25)',						'less_size',	'Font Size Large',				'@baseFontSize' ),
					array( self::LessOptionsPrefix.'font-size-small',			'', 'ceil(@font-size-base * 0.85)',						'less_size',	'Font Size Small',				'@baseFontSize' ),
					array( self::LessOptionsPrefix.'line-height-base', 			'', '1.428571429',										'less_size',	'Base Line Height',				'@baseLineHeight' ),
					array( self::LessOptionsPrefix.'font-family-sans-serif',	'', '"Helvetica Neue", Helvetica, Arial, sans-serif',	'less_font',	'Fonts: Sans Serif',			'@font-family-sans-serif' ),
					array( self::LessOptionsPrefix.'font-family-serif',			'', 'Georgia, "Times New Roman", Times, serif',			'less_font',	'Fonts: Serif',					'@font-family-serif' ),
					array( self::LessOptionsPrefix.'font-family-monospace',		'', 'Monaco, Menlo, Consolas, "Courier New", monospace','less_font',	'Fonts: Monospace',				'@font-family-monospace' ),
					array( self::LessOptionsPrefix.'font-family-base',			'', '@font-family-sans-serif',							'less_font',	'Fonts: Base',					'@font-family-base' ),
				)
			),

			array(
				'section_title' => 'Button Styling',
				'section_options' => array(
					array( self::LessOptionsPrefix.'btn-default-color', 			'', '#333',								'less_color',	'Default Colour',			'@btn-default-color' ),
					array( self::LessOptionsPrefix.'btn-default-bg',				'', '#fff',								'less_color',	'Default Background',		'@btn-default-bg' ),
					array( self::LessOptionsPrefix.'btn-default-border',			'', '#ccc',								'less_color',	'Default Border Colour',	'@btn-default-border' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'btn-primary-color', 			'', '#fff',								'less_color',	'Primary Colour',			'@btn-primary-color' ),
					array( self::LessOptionsPrefix.'btn-primary-bg',				'', '@brand-primary',					'less_color',	'Primary Background',		'@btn-primary-bg' ),
					array( self::LessOptionsPrefix.'btn-primary-border',			'', 'darken(@btn-primary-bg, 5%)',		'less_color',	'Primary Border Colour',	'@btn-primary-border' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'btn-success-color', 			'', '#fff',								'less_color',	'Success Colour',			'@btn-success-color' ),
					array( self::LessOptionsPrefix.'btn-success-bg',				'', '@brand-success',					'less_color',	'Success Background',		'@btn-success-bg' ),
					array( self::LessOptionsPrefix.'btn-success-border',			'', 'darken(@btn-success-bg, 5%)',		'less_color',	'Success Border Colour',	'@btn-success-border' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'btn-warning-color', 			'', '#fff',								'less_color',	'Warning Colour',			'@btn-warning-color' ),
					array( self::LessOptionsPrefix.'btn-warning-bg',				'', '@brand-warning',					'less_color',	'Warning Background',		'@btn-warning-bg' ),
					array( self::LessOptionsPrefix.'btn-warning-border',			'', 'darken(@btn-warning-bg, 5%)',		'less_color',	'Warning Border Colour',	'@btn-warning-border' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'btn-danger-color', 				'', '#fff',								'less_color',	'Danger Colour',			'@btn-danger-color' ),
					array( self::LessOptionsPrefix.'btn-danger-bg',					'', '@brand-danger',					'less_color',	'Danger Background',		'@btn-danger-bg' ),
					array( self::LessOptionsPrefix.'btn-danger-border',				'', 'darken(@btn-danger-bg, 5%)',		'less_color',	'Danger Border Colour',		'@btn-danger-border' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'btn-info-color', 				'', '#fff',								'less_color',	'Info Colour',				'@btn-info-color' ),
					array( self::LessOptionsPrefix.'btn-info-bg',					'', '@brand-info',						'less_color',	'Info Background',			'@btn-info-bg' ),
					array( self::LessOptionsPrefix.'btn-info-border',				'', 'darken(@btn-info-bg, 5%)',			'less_color',	'Info Border Colour',		'@btn-info-border' ),

					array( self::LessOptionsPrefix.'btn-link-disabled-color',		'', '@gray-light',						'less_color',	'Disabled Link Colour',		'@btn-link-disabled-color' )
				)
			),

			array(
				'section_title' => 'Alerts and Form States',
				'section_options' => array(
					array( self::LessOptionsPrefix.'state-warning-text', 		'', '#c09853',			'less_color',			'Warning Text Colour' ),
					array( self::LessOptionsPrefix.'state-warning-bg',			'', '#fcf8e3',			'less_color',			'Warning Background Colour' ),
					array( self::LessOptionsPrefix.'state-warning-border',		'', 'darken(spin(@state-warning-bg, -10), 3%)',			'less_color',	'Warning Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'state-danger-text', 		'', '#b94a48',			'less_color',	'Error Text Colour' ),
					array( self::LessOptionsPrefix.'state-danger-bg',			'', '#f2dede',			'less_color',	'Error Background Colour' ),
					array( self::LessOptionsPrefix.'state-danger-border',		'', 'darken(spin(@state-danger-bg, -10), 3%)',			'less_color',	'Error Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'state-success-text', 		'', '#468847',			'less_color',	'Success Text Colour' ),
					array( self::LessOptionsPrefix.'state-success-bg',			'', '#dff0d8',			'less_color',	'Success Background Colour' ),
					array( self::LessOptionsPrefix.'state-success-border',		'', 'darken(spin(@state-success-bg, -10), 5%)',			'less_color',	'Success Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'state-info-text', 			'', '#3a87ad',			'less_color',	'Info Text Colour' ),
					array( self::LessOptionsPrefix.'state-info-bg',				'', '#d9edf7',			'less_color',	'Info Background Colour' ),
					array( self::LessOptionsPrefix.'state-info-border',			'', 'darken(spin(@state-info-bg, -10), 7%)',			'less_color',	'Info Border Colour' ),
					array( 'spacer' )
				)
			),

			array(
				'section_title' => 'Code',
				'section_options' => array(
					array( self::LessOptionsPrefix.'code-color', 		'', '#c7254e',			'less_color',			'Code Colour' ),
					array( self::LessOptionsPrefix.'code-bg',			'', '#f9f2f4',			'less_color',			'Code Background Colour' ),
					array( self::LessOptionsPrefix.'pre-color', 		'', '@gray-dark',		'less_color',			'PRE Colour' ),
					array( self::LessOptionsPrefix.'pre-bg',			'', '#f5f5f5',			'less_color',			'PRE Background Colour' ),
					array( self::LessOptionsPrefix.'pre-border-color',	'', '#ccc',				'less_color',			'PRE Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'state-danger-text', 		'', '#b94a48',			'less_color',	'Error Text Colour' ),
					array( self::LessOptionsPrefix.'state-danger-bg',			'', '#f2dede',			'less_color',	'Error Background Colour' ),
					array( self::LessOptionsPrefix.'state-danger-border',		'', 'darken(spin(@state-danger-bg, -10), 3%)',			'less_color',	'Error Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'state-success-text', 		'', '#468847',			'less_color',	'Success Text Colour' ),
					array( self::LessOptionsPrefix.'state-success-bg',			'', '#dff0d8',			'less_color',	'Success Background Colour' ),
					array( self::LessOptionsPrefix.'state-success-border',		'', 'darken(spin(@state-success-bg, -10), 5%)',			'less_color',	'Success Border Colour' ),
					array( 'spacer' ),
					array( self::LessOptionsPrefix.'state-info-text', 			'', '#3a87ad',			'less_color',	'Info Text Colour' ),
					array( self::LessOptionsPrefix.'state-info-bg',				'', '#d9edf7',			'less_color',	'Info Background Colour' ),
					array( self::LessOptionsPrefix.'state-info-border',			'', 'darken(spin(@state-info-bg, -10), 7%)',			'less_color',	'Info Border Colour' ),
					array( 'spacer' )
				)
			),

			array(
				'section_title' => 'Media Queries Breakpoints',
				'section_options' => array(
					array( self::LessOptionsPrefix.'screen-xs', 	'', '480px',	'less_text',	'Extra small screen' ),
					array( self::LessOptionsPrefix.'screen-sm',		'', '768px',	'less_size',	'Small screen' ),
					array( self::LessOptionsPrefix.'screen-md',		'', '992px',	'less_size',	'Medium screen' ),
					array( self::LessOptionsPrefix.'screen-lg',		'', '1200px',	'less_size',	'Large screen' )
				)
			),

			array(
				'section_title' => 'The Grid',
				'section_options' => array(
					array( self::LessOptionsPrefix.'grid-columns', 				'', '12',				'less_text',	'Grid Columns' ),
					array( self::LessOptionsPrefix.'grid-gutter-width',			'', '30px',				'less_size',	'Grid Gutter Width' ),
					array( self::LessOptionsPrefix.'grid-float-breakpoint',		'', '@screen-sm',		'less_size',	'Navbar stops collapsing' )
				)
			)
		);
		return $aLessOptions;
	}

	protected function updateHandler() {
		if ( $this->getIsUpgrading() ) {
			$this->deleteLessCompiledCss();
		}

		if ( version_compare( $this->getVersion(), '3.2.0', '<' ) ) {
			$oWp = $this->loadWpFunctionsProcessor();
			$sOldKey = 'hlt_bootstrapcss_plugin_options';
			$aCurrentSettings = $oWp->getOption( $sOldKey );

			// The version of the LESS CSS is determined now within the less section, but we migrate from the old way
			// where we implied the version from that selected in the CSS page.
			if ( $aCurrentSettings['use_compiled_css'] == 'Y' ) {
				$this->setOpt( 'less_bootstrap_version', $aCurrentSettings['option'] );
			}
			else {
				$this->setOpt( 'less_bootstrap_version', 'none' );
			}

			$sOldLessOptionsKey = 'hlt_bootstrapcss_all_less_options';
			$aCurrentLessSettings = $oWp->getOption( $sOldLessOptionsKey );

			if ( empty( $aCurrentLessSettings ) ) {
				return;
			}

			foreach( $aCurrentLessSettings as $aSection ) {
				$aSectionOptions = $aSection['section_options'];
				foreach( $aSectionOptions as $aSubOptions ) {
					$this->setOpt( $aSubOptions[0], $aSubOptions[1] );
				}
			}
		}
	}
}

endif;