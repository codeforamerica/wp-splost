  <div id="footer">

<div class="footerThird">
  <h4>Built by Code for America in partnership with Macon, Georgia.</h4>
  <img src="http://127.0.0.1:8888/wp-content/uploads/2012/07/logos.png" width="275px" />
</div>
<div class="footerThird">
	<h4>Mayor's Twitter Feed</h4>
	<?php

// Your twitter username.
$username = "jllord";

$prefix = "<h3>My last Tweet</h3>";

$suffix = "";

$feed = "http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=1";

function parse_feed($feed) {
    $stepOne = explode("<content type=\"html\">", $feed);
    $stepTwo = explode("</content>", $stepOne[1]);
    $tweet = $stepTwo[0];
    $tweet = str_replace("&lt;", "<", $tweet);
    $tweet = str_replace("&gt;", ">", $tweet);
    return $tweet;
}

$twitterFeed = file_get_contents($feed);
echo stripslashes($prefix) . parse_feed($twitterFeed) . stripslashes($suffix);
?>
</div>
<div class="footerThird">
<h4>Latest Posts</h4>
<?php
$args = array( 'numberposts' => 5, 'order'=> 'ASC', 'orderby' => 'title' );
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

</body>
</html>