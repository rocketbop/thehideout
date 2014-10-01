<?php
/*
Plugin Name: WordPress Twitter Bootstrap CSS
Plugin URI: http://www.icontrolwp.com/wordpress-twitter-bootstrap-css-plugin-home/
Description: Link Twitter Bootstrap CSS and Javascript files before all others regardless of your theme.
Version: 3.2.0-4
Author: iControlWP
Author URI: http://icwp.io/v
*/

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

require_once( dirname(__FILE__).'/src/icwp-base.php' );

if ( !class_exists('ICWP_Wordpress_Twitter_Bootstrap_Plugin') ):

	class ICWP_Wordpress_Twitter_Bootstrap_Plugin extends ICWP_Wordpress_Plugin {

		/**
		 * @var ICWP_Wordpress_Twitter_Bootstrap_Plugin
		 */
		public static $oInstance;

		/**
		 * @return ICWP_Wordpress_Twitter_Bootstrap_Plugin
		 */
		public static function GetInstance() {
			if ( !isset( self::$oInstance ) ) {
				self::$oInstance = new self();
			}
			return self::$oInstance;
		}

		/**
		 */
		protected function __construct() {
			if ( empty( self::$sRootFile ) ) {
				self::$sRootFile = __FILE__;
			}
			self::$aFeatures = array(
				'plugin',
				'css',
				'less'
			);
			self::$sVersion = '3.2.0-4';
			self::$sPluginSlug = 'wptb';
			self::$sHumanName = 'WordPress Twitter Bootstrap';
			self::$sMenuTitleName = 'Twitter Bootstrap';
			self::$sTextDomain = 'wordpress-bootstrap-css';
			self::$fLoggingEnabled = false;
		}
	}

endif;

if ( !function_exists( '_wptb_e' ) ) {
	function _wptb_e( $insStr ) {
		_e( $insStr, ICWP_Wordpress_Twitter_Bootstrap_Plugin::GetTextDomain() );
	}
}
if ( !function_exists( '_wptb__' ) ) {
	function _wptb__( $insStr ) {
		return __( $insStr, ICWP_Wordpress_Twitter_Bootstrap_Plugin::GetTextDomain() );
	}
}

require_once( dirname(__FILE__).'/src/icwp-wptb-main.php' );
$oHLT_BootstrapCss = new ICWP_WPTB_BootstrapCss(  ICWP_Wordpress_Twitter_Bootstrap_Plugin::GetInstance() );
