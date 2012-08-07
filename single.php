<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
  <div id="maincontainer" class="single">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			
					<h2><?php the_title(); ?></h2>

					<p class="post-date"><?php twentyten_posted_on(); ?></p>

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
							<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by %s &rarr;', 'twentyten' ), get_the_author() ); ?>
							</a>
<?php endif; ?>
<p class="single-meta">
						<?php twentyten_posted_in(); ?></p>
					
		
				<?php comments_template( '', true ); ?>
				<div id="post-to-fro">
					<span class="button" style="float: left;">		<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?></span>
  				<span class="button" style="float: right;">		<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?></span></div>
          <span class="button wpedit">
					<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?></span>

<?php endwhile; // end of the loop. ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>