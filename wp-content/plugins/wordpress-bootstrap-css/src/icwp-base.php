<?php

/**
 * Copyright (c) 2014 iControlWP <support@icontrolwp.com>
 * All rights reserved.
 *
 * "WordPress Twitter Bootstrap CSS" (formerly "WordPress Bootstrap CSS") is
 * distributed under the GNU General Public License, Version 2,
 * June 1991. Copyright (C) 1989, 1991 Free Software Foundation, Inc., 51 Franklin
 * St, Fifth Floor, Boston, MA 02110, USA
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

if ( !defined('ICWP_DS') ) {
	define( 'ICWP_DS', DIRECTORY_SEPARATOR );
}

if ( !class_exists('ICWP_Wordpress_Plugin') ):

class ICWP_Wordpress_Plugin {

	/**
	 * @const string
	 */
	const ViewDir				= 'views';

	/**
	 * @const string
	 */
	const SrcDir				= 'src';

	/**
	 * @var string
	 */
	protected static $fLoggingEnabled;

	/**
	 * @var string
	 */
	protected static $sParentSlug	= 'icwp';

	/**
	 * @var string
	 */
	protected static $sPluginSlug;

	/**
	 * @var string
	 */
	protected static $sVersion;

	/**
	 * @var string
	 */
	protected static $sHumanName;

	/**
	 * @var string
	 */
	protected static $sMenuTitleName;

	/**
	 * @var string
	 */
	protected static $sTextDomain;

	/**
	 * @var string
	 */
	protected static $sBasePermissions = 'manage_options';

	/**
	 * @var string
	 */
	protected static $sWpmsNetworkAdminOnly = true;

	/**
	 * @var string
	 */
	protected static $sRootFile;

	/**
	 * @var string
	 */
	protected static $fAutoUpgrade = false;

	/**
	 * @var string
	 */
	protected static $aFeatures;

	/**
	 */
	protected function __construct() {
		if ( empty( self::$sRootFile ) ) {
			self::$sRootFile = __FILE__;
		}
	}

	/**
	 * @return string
	 */
	public function getAdminMenuTitle() {
		return self::$sMenuTitleName;
	}

	/**
	 * @return string
	 */
	public function getBasePermissions() {
		return self::$sBasePermissions;
	}

	/**
	 * @param string
	 * @return string
	 */
	public function getFullPluginPrefix( $sGlue = '-' ) {
		return sprintf( '%s%s%s', self::$sParentSlug, $sGlue, self::$sPluginSlug );
	}

	/**
	 * @param string
	 * @return string
	 */
	public function getFeatures() {
		return self::$aFeatures;
	}

	/**
	 * @param string
	 * @return string
	 */
	public function getOptionStoragePrefix() {
		return $this->getFullPluginPrefix( '_' ).'_';
	}

	/**
	 * @return string
	 */
	public function getHumanName() {
		return self::$sHumanName;
	}

	/**
	 * @return string
	 */
	public function getIsLoggingEnabled() {
		return self::$fLoggingEnabled;
	}

	/**
	 * @return string
	 */
	public function getIsWpmsNetworkAdminOnly() {
		return self::$sWpmsNetworkAdminOnly;
	}

	/**
	 * @return string
	 */
	public function getParentSlug() {
		return self::$sParentSlug;
	}

	/**
	 * @return string
	 */
	public function getPluginSlug() {
		return self::$sPluginSlug;
	}

	/**
	 * get the root directory for the plugin with the trailing slash
	 *
	 * @return string
	 */
	public function getRootDir() {
		return dirname( $this->getRootFile() ).ICWP_DS;
	}

	/**
	 * @return string
	 */
	public function getRootFile() {
		return self::$sRootFile;
	}

	/**
	 * get the directory for the plugin view with the trailing slash
	 *
	 * @return string
	 */
	public function getSourceDir() {
		return $this->getRootDir().self::SrcDir.ICWP_DS;
	}

	/**
	 * @return string
	 */
	public static function GetTextDomain() {
		return self::$sTextDomain;
	}

	/**
	 * @return string
	 */
	public function getVersion() {
		return self::$sVersion;
	}

	/**
	 * get the directory for the plugin view with the trailing slash
	 *
	 * @return string
	 */
	public function getViewDir() {
		return $this->getRootDir().self::ViewDir.ICWP_DS;
	}
}
endif;