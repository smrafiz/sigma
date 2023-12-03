<?php
/**
 * Backend Class: Pages
 *
 * This class creates the necessary admin pages.
 *
 * @package ThemeStarter\SignatureCore
 * @since   1.0.0
 */

declare( strict_types=1 );

namespace ThemeStarter\Signature\App\Backend;

use ThemeStarter\Signature\Common\
{
	Abstracts\Base,
	Traits\Singleton,
	Models\AdminPage,
	Functions\Callbacks
};

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Backend Class: Pages
 *
 * @since 1.0.0
 */
class Pages extends Base {
	/**
	 * Singleton trait.
	 *
	 * @see Singleton
	 * @since 1.0.0
	 */
	use Singleton;

	/**
	 * Registers the class.
	 *
	 * This backend class is only being instantiated in the backend
	 * as requested in the Bootstrap class.
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 * @see Bootstrap::registerServices
	 * @see Requester::isAdminBackend()
	 */
	public function register() {
		$this
			->setpage()
			->removePageNotices();
	}

	/**
	 * Set Page.
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setPage() {
		new AdminPage(
			[],
			$this->setSubPages()
		);

		return $this;
	}

	/**
	 * Method to accumulate admin pages list.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function setSubPages() {
		$subPages   = [];
		$subPages[] = [
			'parent_slug' => 'themes.php',
			'page_title'  => esc_html__( 'Easy Demo Importer', 'signature' ),
			'menu_title'  => esc_html__( 'Easy Demo Importer', 'signature' ),
			'capability'  => 'manage_options',
			'menu_slug'   => $this->plugin->data()['demo_import_page'],
			'callback'    => [ Callbacks::class, 'renderDemoImportPage' ],
		];

		$themeConfig     = sd_edi()->getDemoConfig();
		$activeTheme     = sd_edi()->activeTheme();
		$supportedThemes = sd_edi()->supportedThemes();

		if ( ! in_array( $activeTheme, $supportedThemes, true ) ) {
			$themeConfig = [];
		}

		if ( ! empty( $themeConfig ) ) {
			$subPages[] = [
				'parent_slug' => 'themes.php',
				'page_title'  => esc_html__( 'System Status Report', 'signature' ),
				'menu_title'  => esc_html__( 'Easy System Status', 'signature' ),
				'capability'  => 'manage_options',
				'menu_slug'   => $this->plugin->data()['system_status_page'],
				'callback'    => [ Callbacks::class, 'renderServerStatusPage' ],
			];
		}

		return $subPages;
	}

	/**
	 * Remove Admin Notices.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function removePageNotices() {
		global $pagenow;

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

		// Conditionally removing all notices.
		if ( 'themes.php' === $pagenow && ( 'sd-easy-demo-importer' === $page || 'sd-edi-demo-importer-status' === $page ) ) {
			add_action( 'admin_init', [ $this, 'removeAllNotices' ] );
		}
	}

	/**
	 * Removes All Notices.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function removeAllNotices() {
		remove_all_actions( 'admin_notices' );
	}
}
