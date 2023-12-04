<?php defined( 'ABSPATH' ) or die( "you do not have access to this page!" );
if ( ! class_exists( "burst_endpoint" ) ) {
	class burst_endpoint {
		private static $_this;

		public function __construct() {
			if ( isset( self::$_this ) ) {
				wp_die( burst_sprintf( '%s is a singleton class and you cannot create a second instance.',
					get_class( $this ) ) );
			}

			self::$_this = $this;
			// actions and filters
			add_action( 'plugins_loaded', array( $this, 'install' ) );
			add_action( 'init', array( $this, 'update_endpoint' ) );
			add_action( 'burst_on_premium_upgrade', array( $this, 'update' ) );
			// on deactivation, delete the endpoint file
			register_deactivation_hook( burst_plugin_file, array( $this, 'delete_endpoint_file' ) );
		}

		/**
		 * Install the endpoint
		 *
		 * @return void
		 */
		public function install(): void {
			$endpoint_installed = (bool) get_transient( 'burst_install_endpoint' ); // casts strings 'true' & 'false' to bool true
			if ( ! $endpoint_installed ) {
				set_transient( 'burst_install_endpoint', 'true', HOUR_IN_SECONDS );
				$endpoint_status = $this->install_endpoint_file();
				update_option( 'burst_endpoint_status', $endpoint_status, false );
			}
		}

		/**
		 * If option 'burst_update_endpoint' is set to true, update the endpoint
		 * @hooked init
		 * @return void
		 */
		public function update_endpoint() {
			if ( get_option('burst_update_endpoint' ) == true ) {
				$this->update();
				delete_option( 'burst_update_endpoint' );
			}
		}

		/**
		 * Delete the endpoint file
		 *
		 * @return void
		 */
		public function delete_endpoint_file(): void {
			if ( file_exists( ABSPATH . '/burst-statistics-endpoint.php' ) ) {
				unlink( ABSPATH . '/burst-statistics-endpoint.php' );
			}
		}

		/**
		 * Update the endpoint
		 *
		 * @return void
		 */
		public function update(): void {
			set_transient( 'burst_install_endpoint', 'true', HOUR_IN_SECONDS );
			if ( file_exists( ABSPATH . '/burst-statistics-endpoint.php' ) ) {
				unlink( ABSPATH . '/burst-statistics-endpoint.php' );
			}

			$endpoint_status = $this->install_endpoint_file();
			update_option( 'burst_endpoint_status', $endpoint_status, false );
		}

		/**
		 * @return burst_endpoint
		 */
		public static function this(): burst_endpoint {
			return self::$_this;
		}

		/**
		 * Install the endpoint file
		 *
		 * @return bool
		 */
		public function install_endpoint_file($force = false): bool {
			$file = ABSPATH . '/burst-statistics-endpoint.php';
			if ( ! file_exists( $file ) || $force ) {
				$success = @file_put_contents( $file, $this->get_endpoint_file_contents() );
				if ( $success === false ) {
					return false;
				}
				return $this->endpoint_test_request();
			}
			return true;
		}

		/**
		 * Get the endpoint file contents
		 *
		 * @return string
		 */
		public function get_endpoint_file_contents(): string {
			$ua_parser_filename =  'plugins/' . trailingslashit(burst_plugin_folder) . 'helpers/php-user-agent/UserAgentParser.php';
			$tracking_pro_filename  =  'plugins/' . trailingslashit(burst_plugin_folder) . 'pro/tracking/tracking.php';
			$tracking_filename  =  'plugins/' . trailingslashit(burst_plugin_folder) . 'tracking/tracking.php';


			// Indentation is important here for PHP 7.2 compatibility: https://wiki.php.net/rfc/flexible_heredoc_nowdoc_syntaxes
			if ( burst_is_pro() ) {
				return <<<EOT
<?php
/**
 * Burst Statistics endpoint for collecting hits
 */
define( 'SHORTINIT', true );
require_once __DIR__ . '/wp-load.php';
require_once trailingslashit(WP_CONTENT_DIR) . '$ua_parser_filename';
require_once trailingslashit(WP_CONTENT_DIR) . '$tracking_pro_filename';
require_once trailingslashit(WP_CONTENT_DIR) . '$tracking_filename';

burst_beacon_track_hit();
EOT;
			} else {
				return <<<EOT
<?php
/**
 * Burst Statistics endpoint for collecting hits
 */
define( 'SHORTINIT', true );
require_once __DIR__ . '/wp-load.php';
require_once trailingslashit(WP_CONTENT_DIR) . '$ua_parser_filename';
require_once trailingslashit(WP_CONTENT_DIR) . '$tracking_filename';

burst_beacon_track_hit();
EOT;
			}
		}




		/**
		 * Get tracking status
		 *
		 * @return array
		 */
		public function get_tracking_status_and_time(): array {
			$status    = get_option( 'burst_tracking_status' );
			$last_test = get_transient( 'burst_ran_test' ); // casts strings 'true' & 'false' to bool true
			if ( $last_test < 1 || $last_test === false ) {
				$status = $this->test_tracking_status();
				$last_test = time();
				set_transient( 'burst_ran_test', $last_test, HOUR_IN_SECONDS );
			}
			return [
				'status' => $status,
				'last_test' => $last_test,
			];
		}

		/**
		 * Get tracking status
		 *
		 * @return string
		 */
		public function get_tracking_status(): string {
			$tracking = $this->get_tracking_status_and_time();
			return $tracking['status'];
		}

		/**
		 * Test tracking status
		 * Only returns 'error', 'rest', 'beacon'
		 * @return string
		 */
		public function test_tracking_status(): string {
			$endpoint = $this->endpoint_test_request(); // true or false
			if ( $endpoint ) {
				$status = 'beacon';
			} else {
				$rest_api = $this->rest_api_test_request(); // true or false
				$status   = $rest_api ? 'rest' : 'error';
			}

			update_option( 'burst_tracking_status', $status, true );

			return $status;
		}

		/**
		 * Test endpoint
		 *
		 * @return bool
		 */
		public function endpoint_test_request(): bool {
			$url  = burst_get_beacon_url();
			$data = array( 'request' => 'test' );

			$response = wp_remote_post( $url, array(
				'method'      => 'POST',
				'headers'     => array( "Content-type" => "application/x-www-form-urlencoded" ),
				'body'        => $data,
				'sslverify'   => false
			));
			$status = false;
			if ( !is_wp_error( $response ) && !empty( $response['response']['code'] ) ) {
				$status = $response['response']['code'];
			}
			if ( $status === 200 ) {
				return true;
			}
			// otherwise try with file_get_contents

			// use key 'http' even if you send the request to https://...
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query( $data ),
				),
				"ssl" => array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);
			$context = stream_context_create( $options );
			@file_get_contents( $url, false, $context );
			$status_line = $http_response_header[0] ?? '';

			$status = false;
			if ( preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $matches) ) {
				$status = $matches[1];
			}

			return $status === 200;
		}

		/**
		 * Test REST API
		 *
		 * @return bool
		 */
		public function rest_api_test_request(): bool {
			$url      = get_rest_url( null, 'burst/v1/track' );
			$data = '{"request":"test"}';
			$response = wp_remote_post( $url, array(
				'headers'     => array( 'Content-Type' => 'application/json; charset=utf-8' ),
				'method'      => 'POST',
				'body'        => json_encode( $data ),
				'data_format' => 'body',
				'timeout'     => 5,
			) );
			if ( is_wp_error( $response ) ) {
				return false;
			}
			if ( $response['response']['code'] === 200 ) {
				return true;
			}

			return false;
		}
	}
}