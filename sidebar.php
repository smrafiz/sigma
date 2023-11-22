<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeStarter\Signature
 */

use ThemeStarter\Signature\Common\Functions\Helpers;
?>

<aside id="secondary" class="widget-area">
	<?php
	if ( is_single() && is_active_sidebar( 'signature-sidebar-blog' ) ) {
		dynamic_sidebar( 'signature-sidebar-blog' );
	} elseif ( Helpers::hasWoocommerce() && is_active_sidebar( 'signature-sidebar-shop' ) && Helpers::insideWoocommerce() ) {
		dynamic_sidebar( 'signature-sidebar-shop' );
	} elseif ( is_home() && is_active_sidebar( 'signature-sidebar-blog' ) ) {
		dynamic_sidebar( 'signature-sidebar-blog' );
	} elseif ( is_archive() && is_active_sidebar( 'signature-sidebar-blog' ) ) {
		dynamic_sidebar( 'signature-sidebar-blog' );
	} else {
		dynamic_sidebar( 'signature-sidebar-general' );
	}
    ?>
</aside><!-- #secondary -->
