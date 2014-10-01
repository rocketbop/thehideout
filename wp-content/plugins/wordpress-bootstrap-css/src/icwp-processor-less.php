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

require_once( dirname(__FILE__).'/icwp-base-processor.php' );

if ( !class_exists('ICWP_WPTB_LessProcessor_V1') ):

class ICWP_WPTB_LessProcessor_V1 extends ICWP_WPTB_BaseProcessor {

	/**
	 * @const string
	 */
	const LessOptionsPrefix = 'less_';

	/**
	 * @param ICWP_WPTB_FeatureHandler_Less $oFeatureOptions
	 */
	public function __construct( ICWP_WPTB_FeatureHandler_Less $oFeatureOptions ) {
		parent::__construct( $oFeatureOptions );
	}

	/**
	 */
	public function run() {
		add_action( 'init', array( $this, 'onWpInit' ) );
	}

	/**
	 */
	public function onWpInit() {
		//check for existence of LESS file
		$oWpFs = $this->loadFileSystemProcessor();
		if ( !$oWpFs->exists( $this->oFeatureOptions->getPath_TargetLessFileStem().'.css' ) ) {
			$this->buildLessFiles();
		}
	}

	/**
	 */
	protected function buildLessFiles() {
		// 1) backup variables.less
		$this->backupVariableOrig();

		// 2) Read contents of files and replace with custom vars.  Then write.
		$this->rewriteVariablesLess();

		// 3) compile the less and write.
		$this->compileLess();
	}

	/**
	 * @param $fUseOriginalLessFile - boolean on whether to use the original less file as the template or not. Defaults to TRUE
	 * @return boolean
	 */
	public function rewriteVariablesLess( $fUseOriginalLessFile = true ) {
		$oWpFs = $this->loadFileSystemProcessor();

		$sVariablesContents = $oWpFs->getFileContent( $this->getPath_VariablesLessFile( $fUseOriginalLessFile ) );
		if ( !$sVariablesContents ) {
			//The Variable.less file couldn't be read: bail!
			return false;
		}

		$nPrefixLength = strlen( self::LessOptionsPrefix );
		foreach( $this->oFeatureOptions->loadStoredOptionsValues() as $sKey => $sLessValue ) {

			$nPos = strpos( $sKey, self::LessOptionsPrefix );
			if ( $nPos === 0 ) {
				$sLessKey = substr_replace( $sKey, '', $nPos, $nPrefixLength );
				$sVariablesContents = preg_replace(
					'/^\s*(@'.$sLessKey.':\s*)([^;]+)(;.*)$/ium',
					'${1}'.$sLessValue.'${3}',
					$sVariablesContents
				);
			}
		}

		return $oWpFs->putFileContent( $this->getPath_VariablesLessFile(), $sVariablesContents );
	}

	public function compileLess() {
		$oWpFs = $this->loadFileSystemProcessor();

		$this->loadLessLibrary();
		$sFilePathToLess = $this->getPath_BootstrapDir().'less'.ICWP_DS.'bootstrap.less';
		$sTargetCssFileStem = $this->oFeatureOptions->getPath_TargetLessFileStem();

		// Write normal CSS
		$oLessCompiler = new Less_Parser();
		$oLessCompiler->parseFile( $sFilePathToLess );
		$sCompiledCss = $oLessCompiler->getCss();
		$oWpFs->putFileContent( $sTargetCssFileStem.'.css', $sCompiledCss );

		// Write compressed CSS - it doesn't work to use the SetOption and recompile
		$aCompileOptions = array( 'compress' => true );
		$oLessCompiler = new Less_Parser( $aCompileOptions );
		$oLessCompiler->parseFile( $sFilePathToLess );
		$sCompiledCss = $oLessCompiler->getCss();
		return $oWpFs->putFileContent( $sTargetCssFileStem.'.min.css', $sCompiledCss );
	}

	/**
	 */
	protected function backupVariableOrig() {
		$oWpFs = $this->loadFileSystemProcessor();
		if ( is_admin() ) {
			if ( !$oWpFs->exists( $this->getPath_VariablesLessFile( true ) ) ) {
				copy( $this->getPath_VariablesLessFile(), $this->getPath_VariablesLessFile( true ) );
			}
		}
	}

	protected function loadLessLibrary() {
		require_once ( $this->oFeatureOptions->getPathToInc( 'Less.php/Autoloader.php' ) );
		Less_Autoloader::register();
	}

	/**
	 * @return string
	 */
	protected function getPath_BootstrapDir() {
		return $this->oFeatureOptions->getResourcesDir( 'bootstrap-'.$this->oFeatureOptions->getTwitterBootstrapVersion().ICWP_DS );
	}

	/**
	 * @param boolean $fOrigBackup
	 * @return string
	 */
	protected function getPath_VariablesLessFile( $fOrigBackup = false ) {
		return $this->getPath_BootstrapDir().'less'.ICWP_DS.'variables.less' .($fOrigBackup ? '.orig' : '');
	}

}

endif;

if ( !class_exists('ICWP_WPTB_LessProcessor') ):
	class ICWP_WPTB_LessProcessor extends ICWP_WPTB_LessProcessor_V1 { }
endif;