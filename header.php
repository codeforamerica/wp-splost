<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage SPLOST
 * @since Starkers 3.0
 */
?>
<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]--> 
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700|Open+Sans:400' rel='stylesheet' type='text/css'>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" type="text/css" />

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="stylesheet" href="/wp-content/themes/wp-splost/leaflet.css" />

    <script src="/wp-content/themes/wp-splost/sheetsee.js?0"></script>
    <script type="text/javascript" src="/wp-content/themes/wp-splost/jquery-1.8.2.min.js"></script>

    <script src="/wp-content/themes/wp-splost/tabletop.js" type="text/javascript"></script> 
    <script src="/wp-content/themes/wp-splost/ICanHaz.js" type="text/javascript"></script> 
    <script src="/wp-content/themes/wp-splost/accounting.js" type="text/javascript"></script>
    <script src="/wp-content/themes/wp-splost/leaflet.js"></script>

    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js?2.6.0"></script>
    <script type="text/javascript" src="/wp-content/themes/wp-splost/modernizr.custom.33965.js"></script>

<?php
  /* We add some JavaScript to pages with the comment form
   * to support sites with threaded comments (when in use).
   */
  if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

  /* Always have wp_head() just before the closing </head>
   * tag of your theme, or you will break many plugins, which
   * generally use this hook to add elements to <head> such
   * as styles, scripts, and meta tags.
   */
  wp_head();
?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35167634-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body <?php body_class(); ?>>
  <div id="pagewrapper">
    <div id="header">
      <p class="top-menu"><a href="<?php echo home_url(); ?>">HOME</a> / <a href="/splost/about-splost/">ABOUT SPLOST</a> / <a href="/splost/about/">ABOUT SITE</a> / <a href="/splost/contact/">CONTACT</a> / <a href="/tag/press/">PRESS</a> / <a href="/splost/updates/">UPDATES</a> </p> 
      <div id="title_container">
        <!-- <p class="subtitle">Macon-Bibb County</p> --> <div style="clear:both;"></div>
      <h1 class="tright">Macon-Bibb County 2012 SPLOST</h1>
      
      </div>

    </div><!-- #header END -->

     <div id="bread_box">
      <div id="breadcrumbs"><!-- changes the breadcrumbs depending on the page type -->
        <?php if (is_page()) :  ?>
          <div class="left"><p><?php
          $parent_title = get_the_title($post->post_parent);
          echo $parent_title;?></p></div>
          <div class="right"><p><?php the_title(); ?></p></div>
        <?php endif; ?>
        
         <?php if (is_archive()) :  ?>
             <div class="left"><p>SPLOST</p></div>
             <div class="right"><p>Archive</p></div>
          <?php endif; ?>
          
          <?php if (is_404()) :  ?>
              <div class="left"><p>Uh oh.</p></div>
              <div class="right"><p>404</p></div>
            <?php endif; ?>
          
          <?php if (is_search()) :  ?>
              <div class="left"><p>SPLOST</p></div>
              <div class="right"><p>Search Results</p></div>
            <?php endif; ?>
        
        <?php if (is_single()) :  ?>
           <div class="left"><p><a href="<?php echo get_home_url(); ?>/news">News</a></p></div>
           <div class="right"><p><?php the_title(); ?></p></div>
        <?php endif; ?>
        
        <?php if (is_home()) :  ?>
             <div class="left"><p>SPLOST</p></div>
             <div class="right"><p>News</p></div>
        <?php endif; ?>
 
      </div><!-- #breadcrumbs END -->
     </div><!-- #bread_box END -->

<div id="printHeader">
  <h1>Your Macon 2012 SPLOST Report</h1>
  <h6>Category/Project:</h6>
  <h2><?php the_title(); ?> / <?php echo $parent_title ?></h2>
</div>

