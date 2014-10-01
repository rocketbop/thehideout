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
 *
 */

if ( !class_exists('ICWP_WPTB_DataProcessor_V3') ):

	class ICWP_WPTB_DataProcessor_V3 {

		/**
		 * @var ICWP_WPTB_DataProcessor_V3
		 */
		protected static $oInstance = NULL;

		/**
		 * @var bool
		 */
		public static $fUseFilterInput = false;

		/**
		 * @var string
		 */
		protected static $sIpAddress;

		/**
		 * @var integer
		 */
		protected static $nRequestTime;

		/**
		 * @return int
		 */
		public static function GetRequestTime() {
			if ( empty( self::$nRequestTime ) ) {
				self::$nRequestTime = time();
			}
			return self::$nRequestTime;
		}

		/**
		 * Cloudflare compatible.
		 *
		 * @param boolean $fAsLong
		 * @return bool|integer - visitor IP Address as IP2Long
		 */
		public static function GetVisitorIpAddress( $fAsLong = true ) {

			if ( !empty( self::$sIpAddress ) ) {
				return $fAsLong? ip2long( self::$sIpAddress ) : self::$sIpAddress;
			}

			$aAddressSourceOptions = array(
				'HTTP_CF_CONNECTING_IP',
				'HTTP_CLIENT_IP',
				'HTTP_X_FORWARDED_FOR',
				'HTTP_X_FORWARDED',
				'HTTP_FORWARDED',
				'REMOTE_ADDR'
			);
			$fCanUseFilter = function_exists( 'filter_var' ) && defined( 'FILTER_FLAG_NO_PRIV_RANGE' ) && defined( 'FILTER_FLAG_IPV4' );

			foreach( $aAddressSourceOptions as $sOption ) {

				$sIpAddressToTest = self::FetchServer( $sOption );
				if ( empty( $sIpAddressToTest ) ) {
					continue;
				}

				$aIpAddresses = explode( ',', $sIpAddressToTest ); //sometimes a comma-separated list is returned
				foreach( $aIpAddresses as $sIpAddress ) {

					if ( $fCanUseFilter && !self::IsAddressInPublicIpRange( $sIpAddress ) ) {
						continue;
					}
					else {
						self::$sIpAddress = $sIpAddress;
						return $fAsLong? ip2long( self::$sIpAddress ) : self::$sIpAddress;
					}
				}
			}
			return false;
		}

		/**
		 * For now will return true when it's a valid IPv4 or IPv6 address and you have access to filter_var()
		 *
		 * otherwise, if it's Ipv6 it'll return false always or will attempt to manually parse IPv4.
		 *
		 * @param string
		 * @return boolean
		 */
		public static function GetIsValidIpAddress( $sIpAddress ) {
			if ( function_exists('filter_var') && defined('FILTER_VALIDATE_IP') && defined('FILTER_FLAG_IPV4') && defined('FILTER_FLAG_IPV6') ) {

				if ( filter_var( $sIpAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
					return true;
				}
				else {
					return filter_var( $sIpAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 );
				}
			}

			if ( preg_match( '/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $sIpAddress ) ) { //It's a valid IPv4 format, now check components
				$aParts = explode( '.', $sIpAddress );
				foreach ( $aParts as $sPart ) {
					$sPart = intval( $sPart );
					if ( $sPart < 0 || $sPart > 255 ) {
						return false;
					}
				}
				return true;
			}

			return false;
		}

		/**
		 * Assumes a valid IPv4 address is provided as we're only testing for a whether the IP is public or not.
		 *
		 * @param string $sIpAddress
		 * @uses filter_var
		 * @return boolean
		 */
		public static function IsAddressInPublicIpRange( $sIpAddress ) {
			return function_exists('filter_var') && filter_var( $sIpAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE );
		}

		/**
		 * @param string $sAddresses
		 * @return Ambigous|array|unknown
		 */
		static public function ExtractIpAddresses( $sAddresses = '' ) {

			$aRawAddresses = array();

			if ( empty( $sAddresses ) ) {
				return $aRawAddresses;
			}
			$aRawList = array_map( 'trim', explode( "\n", $sAddresses ) );

			foreach( $aRawList as $sKey => $sRawAddressLine ) {

				if ( empty( $sRawAddressLine ) ) {
					continue;
				}

				// Each line can have a Label which is the IP separated with a space.
				$aParts = explode( ' ', $sRawAddressLine, 2 );
				if ( count( $aParts ) == 1 ) {
					$aParts[] = '';
				}
				$aRawAddresses[ $aParts[0] ] = trim( $aParts[1] );
			}
			return self::Add_New_Raw_Ips( array(), $aRawAddresses );
		}

		/**
		 * @param string $sRawList
		 * @return array
		 */
		static public function ExtractCommaSeparatedList( $sRawList = '' ) {

			$aRawList = array();
			if ( empty( $sRawList ) ) {
				return $aRawList;
			}

			$aRawList = array_map( 'trim', preg_split( '/\r\n|\r|\n/', $sRawList ) );
			$aNewList = array();
			$fHadStar = false;
			foreach( $aRawList as $sKey => $sRawLine ) {

				if ( empty( $sRawLine ) ) {
					continue;
				}
				$sRawLine = str_replace( ' ', '', $sRawLine );
				$aParts = explode( ',', $sRawLine, 2 );
				// we only permit 1x line beginning with *
				if ( $aParts[0] == '*' ) {
					if ( $fHadStar ) {
						continue;
					}
					$fHadStar = true;
				}
				else {
					//If there's only 1 item on the line, we assume it to be a global
					// parameter rule
					if ( count( $aParts ) == 1 || empty( $aParts[1] ) ) { // there was no comma in this line in the first place
						array_unshift( $aParts, '*' );
					}
				}

				$aParams = empty( $aParts[1] )? array() : explode( ',', $aParts[1] );
				$aNewList[ $aParts[0] ] = $aParams;
			}
			return $aNewList;
		}

		/**
		 * Given a list of new IPv4 address ($inaNewRawAddresses) it'll add them to the existing list
		 * ($inaCurrent) where they're not already found
		 *
		 * @param array $inaCurrent			- the list to which to add the new addresses
		 * @param array $inaNewRawAddresses	- the new IPv4 addresses
		 * @param int $outnNewAdded			- the count of newly added IPs
		 * @return unknown|Ambigous <multitype:multitype: , string>
		 */
		public static function Add_New_Raw_Ips( $inaCurrent, $inaNewRawAddresses, &$outnNewAdded = 0 ) {

			$outnNewAdded = 0;

			if ( empty( $inaNewRawAddresses ) ) {
				return $inaCurrent;
			}

			if ( !array_key_exists( 'ips', $inaCurrent ) ) {
				$inaCurrent['ips'] = array();
			}
			if ( !array_key_exists( 'meta', $inaCurrent ) ) {
				$inaCurrent['meta'] = array();
			}

			foreach( $inaNewRawAddresses as $sRawIpAddress => $sLabel ) {
				$mVerifiedIp = self::Verify_Ip( $sRawIpAddress );
				if ( $mVerifiedIp !== false && !in_array( $mVerifiedIp, $inaCurrent['ips'] ) ) {
					$inaCurrent['ips'][] = $mVerifiedIp;
					if ( empty($sLabel) ) {
						$sLabel = 'no label';
					}
					$inaCurrent['meta'][ md5( $mVerifiedIp ) ] = $sLabel;
					$outnNewAdded++;
				}
			}
			return $inaCurrent;
		}

		/**
		 * @param array $inaCurrent
		 * @param array $inaRawAddresses - should be a plain numerical array of IPv4 addresses
		 * @return array:
		 */
		public static function Remove_Raw_Ips( $inaCurrent, $inaRawAddresses ) {
			if ( empty( $inaRawAddresses ) ) {
				return $inaCurrent;
			}

			if ( !array_key_exists( 'ips', $inaCurrent ) ) {
				$inaCurrent['ips'] = array();
			}
			if ( !array_key_exists( 'meta', $inaCurrent ) ) {
				$inaCurrent['meta'] = array();
			}

			foreach( $inaRawAddresses as $sRawIpAddress ) {
				$mVerifiedIp = self::Verify_Ip( $sRawIpAddress );
				if ( $mVerifiedIp === false ) {
					continue;
				}
				$mKey = array_search( $mVerifiedIp, $inaCurrent['ips'] );
				if ( $mKey !== false ) {
					unset( $inaCurrent['ips'][$mKey] );
					unset( $inaCurrent['meta'][ md5( $mVerifiedIp ) ] );
				}
			}
			return $inaCurrent;
		}

		/**
		 * @param string $sIpAddress
		 * @return bool|int|string
		 */
		public static function Verify_Ip( $sIpAddress ) {

			$sAddress = self::Clean_Ip( $sIpAddress );

			// Now, determine if this is an IP range, or just a plain IP address.
			if ( strpos( $sAddress, '-' ) === false ) { //plain IP address
				return self::Verify_Ip_Address( $sAddress );
			}
			else {
				return self::Verify_Ip_Range( $sAddress );
			}
		}

		/**
		 * @param string $insRawAddress
		 * @return mixed
		 */
		public static function Clean_Ip( $insRawAddress ) {
			$insRawAddress = preg_replace( '/[a-z\s]/i', '', $insRawAddress );
			$insRawAddress = str_replace( '.', 'PERIOD', $insRawAddress );
			$insRawAddress = str_replace( '-', 'HYPEN', $insRawAddress );
			$insRawAddress = preg_replace( '/[^a-z0-9]/i', '', $insRawAddress );
			$insRawAddress = str_replace( 'PERIOD', '.', $insRawAddress );
			$insRawAddress = str_replace( 'HYPEN', '-', $insRawAddress );
			return $insRawAddress;
		}

		/**
		 * Taken from http://www.phacks.net/detecting-search-engine-bot-and-web-spiders/
		 */
		public static function IsSearchEngineBot() {

			$sUserAgent = self::FetchServer( 'HTTP_USER_AGENT' );
			if ( empty( $sUserAgent ) ) {
				return false;
			}

			$sBots = 'Googlebot|bingbot|Twitterbot|Baiduspider|ia_archiver|R6_FeedFetcher|NetcraftSurveyAgent'
				.'|Sogou web spider|Yahoo! Slurp|facebookexternalhit|PrintfulBot|msnbot|UnwindFetchor|urlresolver|Butterfly|TweetmemeBot';

			return ( preg_match( "/$sBots/", $sUserAgent ) > 0 );
		}

		/**
		 * Returns IP Address as long if verified.
		 *
		 * @param string $sIpAddress
		 * @return bool|int
		 */
		public static function Verify_Ip_Address( $sIpAddress ) {
			return self::GetIsValidIpAddress( $sIpAddress ) ? ip2long( $sIpAddress ) : false;
		}

		/**
		 * The only ranges currently accepted are a.b.c.d-f.g.h.j
		 *
		 * @param string $sIpAddressRange
		 * @return string|boolean
		 */
		public static function Verify_Ip_Range( $sIpAddressRange ) {

			list( $sIpRangeStart, $sIpRangeEnd ) = explode( '-', $sIpAddressRange, 2 );

			if ( $sIpRangeStart == $sIpRangeEnd ) {
				return self::Verify_Ip_Address( $sIpRangeStart );
			}
			else if ( self::Verify_Ip_Address( $sIpRangeStart ) && self::Verify_Ip_Address( $sIpRangeEnd ) ) {
				$nStart = ip2long( $sIpRangeStart );
				$nEnd = ip2long( $sIpRangeEnd );

				// do our best to order it
				if (
					( $nStart > 0 && $nEnd > 0 && $nStart > $nEnd )
					|| ( $nStart < 0 && $nEnd < 0 && $nStart > $nEnd )
				) {
					$nTemp = $nStart;
					$nStart = $nEnd;
					$nEnd = $nTemp;
				}
				return $nStart.'-'.$nEnd;
			}
			return false;
		}

		/**
		 * @param $sRawKeys
		 * @return array
		 */
		public static function CleanYubikeyUniqueKeys( $sRawKeys ) {
			$aKeys = explode( "\n", $sRawKeys );
			foreach( $aKeys as $nIndex => $sUsernameKey ) {
				if ( empty( $sUsernameKey ) ) {
					unset( $aKeys[$nIndex] );
					continue;
				}
				$aParts = array_map( 'trim', explode( ',', $sUsernameKey ) );
				if ( empty( $aParts[0] ) || empty( $aParts[1] ) || strlen( $aParts[1] ) < 12 ) {
					unset( $aKeys[$nIndex] );
					continue;
				}
				$aParts[1] = substr( $aParts[1], 0, 12 );
				$aKeys[$nIndex] = array( $aParts[0] => $aParts[1] );
			}
			return $aKeys;
		}

		/**
		 * @param integer $nLength
		 * @param boolean $fBeginLetter
		 * @return string
		 */
		static public function GenerateRandomString( $nLength = 10, $fBeginLetter = false ) {
			$aChars = array( 'abcdefghijkmnopqrstuvwxyz' );
			$aChars[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';

			$sCharset = implode( '', $aChars );
			if ( $fBeginLetter ) {
				$sPassword = $sCharset[ ( rand() % strlen( $sCharset ) ) ];
			}
			else {
				$sPassword = '';
			}
			$sCharset .= '023456789';

			for ( $i = $fBeginLetter? 1 : 0; $i < $nLength; $i++ ) {
				$sPassword .= $sCharset[ ( rand() % strlen( $sCharset ) ) ];
			}
			return $sPassword;
		}

		/**
		 * @return bool
		 */
		static public function GetIsRequestPost() {
			return ( self::GetRequestMethod() == 'post' );
		}

		/**
		 * Returns the current request method as an all-lower-case string
		 *
		 * @return bool|string
		 */
		static public function GetRequestMethod() {
			$sRequestMethod = self::FetchServer( 'REQUEST_METHOD' );
			return ( empty( $sRequestMethod ) ? false : strtolower( $sRequestMethod ) );
		}

		/**
		 * @return string|null
		 */
		static public function GetScriptName() {
			$sScriptName = self::FetchServer( 'SCRIPT_NAME' );
			return !empty( $sScriptName )? $sScriptName : self::FetchServer( 'PHP_SELF' );
		}

		/**
		 * @return bool
		 */
		static public function GetUseFilterInput() {
			return self::$fUseFilterInput && function_exists( 'filter_input' );
		}

		/**
		 * @param array $aArray
		 * @param string $sKey		The array key to fetch
		 * @param mixed $mDefault
		 * @return mixed|null
		 */
		public static function ArrayFetch( &$aArray, $sKey, $mDefault = null ) {
			if ( empty( $aArray ) || !isset( $aArray[$sKey] ) ) {
				return $mDefault;
			}
			return $aArray[$sKey];
		}

		/**
		 * @param string $sKey		The $_COOKIE key
		 * @param mixed $mDefault
		 * @return mixed|null
		 */
		public static function FetchCookie( $sKey, $mDefault = null ) {
			if ( self::GetUseFilterInput() && defined( 'INPUT_COOKIE' ) ) {
				$mPossible = filter_input( INPUT_COOKIE, $sKey );
				if ( !empty( $mPossible ) ) {
					return $mPossible;
				}
			}
			return self::ArrayFetch( $_COOKIE, $sKey, $mDefault );
		}

		/**
		 * @param string $sKey
		 * @param mixed $mDefault
		 * @return mixed|null
		 */
		public static function FetchEnv( $sKey, $mDefault = null ) {
			if ( self::GetUseFilterInput() && defined( 'INPUT_ENV' ) ) {
				$sPossible = filter_input( INPUT_ENV, $sKey );
				if ( !empty( $sPossible ) ) {
					return $sPossible;
				}
			}
			return self::ArrayFetch( $_ENV, $sKey, $mDefault );
		}
		/**
		 * @param string $sKey
		 * @param mixed $mDefault
		 * @return mixed|null
		 */
		public static function FetchGet( $sKey, $mDefault = null ) {
			if ( self::GetUseFilterInput() && defined( 'INPUT_GET' ) ) {
				$mPossible = filter_input( INPUT_GET, $sKey );
				if ( !empty( $mPossible ) ) {
					return $mPossible;
				}
			}
			return self::ArrayFetch( $_GET, $sKey, $mDefault );
		}
		/**
		 * @param string $sKey		The $_POST key
		 * @param mixed $mDefault
		 * @return mixed|null
		 */
		public static function FetchPost( $sKey, $mDefault = null ) {
			if ( self::GetUseFilterInput() && defined( 'INPUT_POST' ) ) {
				$mPossible = filter_input( INPUT_POST, $sKey );
				if ( !empty( $mPossible ) ) {
					return $mPossible;
				}
			}
			return self::ArrayFetch( $_POST, $sKey, $mDefault );
		}
		/**
		 * @param string $sKey
		 * @param boolean $infIncludeCookie
		 * @param mixed $mDefault
		 * @return mixed|null
		 */
		public static function FetchRequest( $sKey, $infIncludeCookie = true, $mDefault = null ) {
			$mFetchVal = self::FetchPost( $sKey );
			if ( is_null( $mFetchVal ) ) {
				$mFetchVal = self::FetchGet( $sKey );
				if ( is_null( $mFetchVal && $infIncludeCookie ) ) {
					$mFetchVal = self::FetchCookie( $sKey );
				}
			}
			return is_null( $mFetchVal )? $mDefault : $mFetchVal;
		}

		/**
		 * @param string $sKey
		 * @param mixed $mDefault
		 * @return mixed|null
		 */
		public static function FetchServer( $sKey, $mDefault = null ) {
			if ( self::GetUseFilterInput() && defined( 'INPUT_SERVER' ) ) {
				$sPossible = filter_input( INPUT_SERVER, $sKey );
				if ( !empty( $sPossible ) ) {
					return $sPossible;
				}
			}
			return self::ArrayFetch( $_SERVER, $sKey, $mDefault );
		}
	}
endif;

if ( !class_exists('ICWP_WPTB_DataProcessor') ):

	class ICWP_WPTB_DataProcessor extends ICWP_WPTB_DataProcessor_V3 {
		/**
		 * @return ICWP_WPTB_DataProcessor
		 */
		public static function GetInstance() {
			if ( is_null( self::$oInstance ) ) {
				self::$oInstance = new self();
			}
			return self::$oInstance;
		}
	}
endif;