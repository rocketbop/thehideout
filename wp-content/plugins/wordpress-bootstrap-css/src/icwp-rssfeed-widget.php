<?php
/**
 * Copyright (c) 2014 iControlWP <support@icontrolwp.com>
 * All rights reserved.
 *
 * "WordPress Twitter Bootstrap CSS" is distributed under the GNU General Public License, Version 2,
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
 *
 */

if ( !class_exists('ICWP_DashboardRssWidget') ):

	class ICWP_DashboardRssWidget {

		/**
		 * @return ICWP_DashboardRssWidget
		 */
		public static function GetInstance() {
			if ( is_null( self::$oInstance ) ) {
				self::$oInstance = new self();
			}
			return self::$oInstance;
		}

		/**
		 * @var ICWP_DashboardRssWidget
		 */
		protected static $oInstance = NULL;

		/**
		 * @var array
		 */
		protected $aFeeds;

		public function __construct() {
			$this->aFeeds = array();
			$this->addFeed( 'icontrolwp_blog', 'http://feeds.feedburner.com/icontrolwp/' );
			add_action( 'wp_dashboard_setup', array( $this, 'addNewsWidget' ) );
		}

		/**
		 * @param $sReference
		 * @param $sUrl
		 */
		protected function addFeed( $sReference, $sUrl ) {
			$this->aFeeds[$sReference] = $sUrl;
		}

		/**
		 * @return array
		 */
		protected function getFeeds() {
			return $this->aFeeds;
		}

		public function addNewsWidget() {
			add_meta_box( 'icwp_news_widget', __( 'The iControlWP Blog', 'hlt-wordpress-bootstrap-css' ), array( $this, 'renderNewsWidget' ), 'dashboard', 'normal', 'low' );
		}

		public function renderNewsWidget() {

			$aItems = array();
			$aFeeds = $this->getFeeds();
			$nItemsPerFeed = floor( 6 / count( $aFeeds ) );
			foreach( $aFeeds as $sReference => $sUrl ) {
				$oRss = fetch_feed( $sUrl );
				if ( !is_wp_error( $oRss ) ) {
					$nMaxItems = $oRss->get_item_quantity( $nItemsPerFeed );
					$aItems = $oRss->get_items( 0, $nMaxItems );
				}

			}

			$sRssWidget = '
			<style>
				.hlt_rss_widget {
					font-family: verdana;
					font-size: 9px;
				}
				.hlt_rss_date {
					font-size: smaller;
				}
				.hlt_rss_link {
					font-size: 11px;
					font-family: verdana;
				}
				.hlt_rss_link:hover {
					color: #333333;
				}
			</style>';

			$sRssWidget .= '<div class="hlt_rss_widget"><ul>%s</ul>';

			if ( !empty( $aItems ) ) {
				$sDateFormat = get_option( 'date_format' );
				$sItems = '';
				foreach ( $aItems as $oItem ) {
					$sItems .= '
					<li class="hlt_rss_listitem">
						<a class="hlt_rss_link"
							target="_blank"
							href="'.esc_url( $oItem->get_permalink() ).'"
							title="'.esc_attr( $oItem->get_description() ).'">'.esc_attr( $oItem->get_title() ).'</a>
						<span class="hlt_rss_date">('.esc_attr( $oItem->get_date( $sDateFormat ) ).')</span>
					</li>';
				}
			}
			else {
				$sItems = '<li><a href="'.$this->m_aFeeds['icontrolwp'].'">'.__('Check out The iControlWP Blog', 'hlt-wordpress-bootstrap-css').'</a></li>';
			}

			$sRssWidget = sprintf( $sRssWidget, $sItems );
			$sRssWidget .= '<p>You can turn off this news widget from the <a href="admin.php?page=worpit-wtb-bootstrap-css">Options Page</a>, but we don\'t recommend that because you\'ll miss our latest news ;)</p></div>';
			echo $sRssWidget;
		}
	}

endif;
