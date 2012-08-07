<?php
/*
Template Name: Project
*/
?>

<?php get_header(); ?>
 <div id="maincontainer" class="project" >
  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<?php if ( is_front_page() ) { ?>
						<!-- ><h2><?php the_title(); ?></h2> -->
					<?php } else { ?>	
					<!--	<h1><?php the_title(); ?></h1> -->
					<?php } ?>				

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
						<span class="button wpedit">
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?></span>

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>