<?php
/*
Template Name: Press Page Template
*/
?>

<?php get_header(); ?>

 <div id="maincontainer" class="pressPage" >
  <h3>Recent Press on Macon's SPLOST</h3>

   <?php the_post_thumbnail(); ?>
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   					
    <?php
      $posttext = $post->post_content;
      $regex = '~<img [^\>]*\ />~';
      preg_match_all($regex, $posttext, $images);
      $posttext = preg_replace($regex, '', $posttext); 
      $noOfImgs = count($images[0]); ?>

      <div id="thePostText">
      <?php echo $posttext; ?>
      </div> 

     <?php 
        if ( $noOfImgs > 0 ) {
          echo '<h3>Project Photos</h3>'; 
          echo '<div id="thePostImages">';
          foreach ( $images[0] as $image ) {
          echo '<p class="aPostImage">' . $image . '</p>'; 
          } 
          echo '</div>';
        }
    ?>

      <span class="button wpedit">
      <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?></span>

      <?php comments_template( '', true ); ?>

   <?php endwhile; ?>

  </div><!-- end #maincontainer -->
    

<?php get_sidebar(); ?>
<?php get_footer(); ?>
