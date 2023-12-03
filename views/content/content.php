<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ThemeStarter\Signature
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				sd_signature()->postedOn();
				sd_signature()->postedBy();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
	sd_signature()->postThumbnail();
	?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'signature' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			[
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'signature' ),
				'after'  => '</div>',
			]
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		sd_signature()->entryFooter();
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
