<?php
/*
Template Name: Press Page Template
* For use on the page with links to press, this has no filters for images and is a basic Wordpress Page
*/
?>

<?php get_header(); ?>

 <div id="maincontainer" class="pressPage" >
  <h3>Media Coverage of our SPLOST Projects</h3>

   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

          <?php if ( is_front_page() ) { ?>
            <!-- ><h2><?php the_title(); ?></h2> -->
          <?php } else { ?> 
          <!--  <h1><?php the_title(); ?></h1> -->
          <?php } ?>        

            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?> </p>
            <span class="button wpedit">
            <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?></span>

        <?php comments_template( '', true ); ?>

<?php endwhile; ?>

  </div><!-- end #maincontainer -->
    

<?php get_sidebar(); ?>
<?php get_footer(); ?>
