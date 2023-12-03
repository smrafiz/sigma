<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ThemeStarter\Signature
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php
		if ( 'post' === get_post_type() ) {
			?>
			<div class="entry-meta">
				<?php
				sd_signature()->postedOn();
				sd_signature()->postedBy();
				?>
			</div><!-- .entry-meta -->
			<?php
		}
		?>
	</header><!-- .entry-header -->

	<?php
	sd_signature()->postThumbnail();
	?>

	<div class="entry-summary">
		<?php
		the_excerpt();
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php
		sd_signature()->entryFooter();
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
