<?php

use WPForms\Helpers\DB;
use WPForms\Helpers\Transient;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle plugin installation upon activation.
 *
 * @since 1.0.0
 */
class WPForms_Install {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// When activated, trigger install method.
		register_activation_hook( WPFORMS_PLUGIN_FILE, [ $this, 'install' ] );
		register_deactivation_hook( WPFORMS_PLUGIN_FILE, [ $this, 'deactivate' ] );

		// Watch for new multisite blogs.
		add_action( 'wp_initialize_site', [ $this, 'new_multisite_blog' ], 10, 2 );

		// Watch for delayed admin install.
		add_action( 'admin_init', [ $this, 'admin' ] );
	}

	/**
	 * Perform certain actions on plugin activation.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $network_wide Whether to enable the plugin for all sites in the network
	 *                           or just the current site. Multisite only. Default is false.
	 */
	public function install( $network_wide = false ) {

		// Check if we are on multisite and network activating.
		if ( is_multisite() && $network_wide ) {

			// Multisite - go through each subsite and run the installer.
			$sites = get_sites(
				[
					'fields' => 'ids',
					'number' => 0,
				]
			);

			foreach ( $sites as $blog_id ) {
				switch_to_blog( $blog_id );
				$this->run();
				restore_current_blog();
			}
		} else {

			// Normal single site.
			$this->run();
		}

		set_transient( 'wpforms_just_activated', wpforms()->is_pro() ? 'pro' : 'lite', 60 );

		// Abort so we only set the transient for single site installs.
		if ( isset( $_GET['activate-multi'] ) || is_network_admin() ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return;
		}

		// Add transient to trigger redirect to the Welcome screen.
		set_transient( 'wpforms_activation_redirect', true, 30 );
	}

	/**
	 * Run manual installation.
	 *
	 * @since 1.5.4.2
	 *
	 * @param bool $silent Silent install, disables welcome page.
	 */
	public function manual( $silent = false ) {

		$this->install( is_plugin_active_for_network( plugin_basename( WPFORMS_PLUGIN_FILE ) ) );

		if ( $silent ) {
			delete_transient( 'wpforms_activation_redirect' );
		}
	}

	/**
	 * Perform certain actions on plugin deactivation.
	 *
	 * @since 1.5.9
	 */
	public function deactivate() {

		// Unschedule all ActionScheduler actions by group.
		wpforms()->get( 'tasks' )->cancel_all();

		// Remove plugin cron jobs.
		wp_clear_scheduled_hook( 'wpforms_email_summaries_cron' );
	}

	/**
	 * Watch for delayed install procedure from WPForms admin.
	 *
	 * @since 1.5.4.2
	 */
	public function admin() {

		if ( ! is_admin() ) {
			return;
		}

		$install = get_option( 'wpforms_install', false );

		if ( empty( $install ) ) {
			return;
		}

		$this->manual( true );

		delete_option( 'wpforms_install' );
	}

	/**
	 * Run the actual installer.
	 *
	 * @since 1.5.4.2
	 */
	protected function run() {

		// Create custom database tables.
		$this->maybe_create_tables();

		// Hook for Pro users.
		do_action( 'wpforms_install' );

		/*
		 * Set current version, to be referenced in future updates.
		 */
		// Used by Pro migrations.
		update_option( 'wpforms_version', WPFORMS_VERSION );
		// Used by Lite migrations.
		update_option( 'wpforms_version_lite', WPFORMS_VERSION );

		// Store the date when the initial activation was performed.
		$type      = class_exists( 'WPForms_Lite', false ) ? 'lite' : 'pro';
		$activated = get_option( 'wpforms_activated', [] );

		if ( empty( $activated[ $type ] ) ) {
			$activated[ $type ] = time();

			update_option( 'wpforms_activated', $activated );
		}
	}

	/**
	 * When a new site is created in multisite, see if we are network activated,
	 * and if so run the installer.
	 *
	 * @since 1.3.0
	 * @since 1.8.4 Added $new_site and $args parameters and removed $blog_id, $user_id, $domain, $path, $site_id,
	 *        $meta parameters.
	 *
	 * @param WP_Site $new_site New site object.
	 * @param array   $args     Arguments for the initialization.
	 *
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function new_multisite_blog( $new_site, $args ) {

		if ( is_plugin_active_for_network( plugin_basename( WPFORMS_PLUGIN_FILE ) ) ) {
			switch_to_blog( $new_site->blog_id );
			$this->run();
			restore_current_blog();
		}
	}

	/**
	 * Create database tables if they do not exist.
	 * It covers new installations.
	 *
	 * @since 1.8.2
	 */
	private function maybe_create_tables() {

		Transient::delete( DB::EXISTING_TABLES_TRANSIENT_NAME );

		array_map(
			static function ( $handler ) {

				if ( ! method_exists( $handler, 'table_exists' ) ) {
					return;
				}

				if ( $handler->table_exists() ) {
					return;
				}

				$handler->create_table();
			},
			[
				wpforms()->get( 'tasks_meta' ),
				wpforms()->get( 'payment' ),
				wpforms()->get( 'payment_meta' ),
				wpforms()->get( 'log' ),
			]
		);
	}
}

new WPForms_Install();
