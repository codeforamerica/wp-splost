  <div id="footer">

<div class="footerThird">
  <h4>Built by Code for America in partnership with Macon, Georgia.</h4>
  <img src="/wp-content/themes/wp-splost/logos.png" width="275px" />
</div>
<div class="footerThird">
	<?php

// Your twitter username.
$username = "mayorreichert";

$prefix = "<h3><a href=\"http://www.twitter.com/MayorReichert\">@MayorReichert</a>'s Latest Tweet</h3><div id='tweet'><p>";

$suffix = "</p></div>";

$feed = "http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=1";

function parse_feed($feed) {
    $stepOne = explode("<content type=\"html\">", $feed);
    $stepTwo = explode("</content>", $stepOne[1]);
    $tweet = $stepTwo[0];
    $tweet = str_replace("&lt;", "<", $tweet);
    $tweet = str_replace("&gt;", ">", $tweet);
    $tweet = str_replace("&amp;", "&", $tweet);
    return $tweet;
}

$twitterFeed = file_get_contents($feed);
echo stripslashes($prefix) . parse_feed($twitterFeed) . stripslashes($suffix);
?>
</div>
<div class="footerThird">
<h4>Latest Posts</h4>
<?php
$args = array( 'numberposts' => 3, 'order'=> 'DESC', 'orderby' => 'post_date' );
$postslist = get_posts( $args );
foreach ($postslist as $post) :  setup_postdata($post); ?> 
	<div class="oneLatestPost">
		<h6><?php the_date(); ?></h6>
		<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	</div>
<?php endforeach; ?>

</div>


    </div><!-- #footer end -->

</div><!-- #pagewrapper end -->

<script type="text/javascript">
  //makes g+ button
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div id="fb-root"></div>
<script>
  // makes facebook button
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<?php wp_footer(); ?>
</body>
</html>