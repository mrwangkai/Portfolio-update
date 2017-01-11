<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package Keratin
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

	<?php keratin_post_thumbnail(); ?>

	<div class="entry-meta entry-meta-header">
		<ul>
			<?php if ( is_single() ) : ?>
			<li><i class="fa fa-user"></i> <?php keratin_posted_by(); ?></li>
			<?php endif; ?>
			<li><i class="fa fa-clock-o"></i> <?php keratin_posted_on(); ?></li>
			<li>
				<i class="fa fa-link"></i>
				<span class="entry-format">
					<a href="<?php echo esc_url( get_post_format_link( 'link' ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'All %s Posts', 'keratin' ), get_post_format_string( 'link' ) ) ); ?>">
						<?php echo get_post_format_string( 'link' ); ?>
					</a>
				</span>
			</li>
		</ul>
	</div><!-- .entry-meta -->

	<header class="entry-header">
		<?php
		// Extract the first URL from the content.
		$post_title_link = get_permalink();
		$url_in_content = get_url_in_content( get_the_content() );
		if( ! empty( $url_in_content ) && false !== $url_in_content ) {
			$post_title_link = $url_in_content;
		}
		?>

		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h1 class="entry-title"><a href="' . esc_url( $post_title_link ) . '" rel="bookmark">', '</a></h1>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'keratin' ) ); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'keratin' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ) : ?>
	<footer class="entry-meta entry-meta-footer">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'keratin' ) );
			if ( $categories_list && keratin_categorized_blog() ) :
		?>
		<span class="cat-links">
			<?php printf( __( 'Posted in %1$s', 'keratin' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'keratin' ) );
			if ( $tags_list ) :
		?>
		<span class="tags-links">
			<?php printf( __( 'Tagged %1$s', 'keratin' ), $tags_list ); ?>
		</span>
		<?php endif; // End if $tags_list ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'keratin' ), __( '1 Comment', 'keratin' ), __( '% Comments', 'keratin' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'keratin' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	<?php endif; ?>

</article><!-- #post-## -->