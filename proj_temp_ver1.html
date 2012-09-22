<?php
/*
Template Name: Displays gallery, assumes there is a gallery.
*/
?>

<?php get_header(); ?>

 <div id="maincontainer" class="projectPage" >

   <?php the_post_thumbnail(); ?>
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   					
  <div class="content-text">
  <?php
  ob_start();
  the_content('Read the full post',true);
  $postOutput = preg_replace('/<img[^>]+./','', ob_get_contents());
  ob_end_clean();
  echo $postOutput;
  ?>
</div>
<div class="content-img">
  <?php
  preg_match_all("/(<img [^>]*>)/",get_the_content(),$matches,PREG_PATTERN_ORDER);
  for( $i=0; isset($matches[1]) && $i < count($matches[1]); $i++ ) {
    $beforeEachImage = '<a href="#">';
    $afterEachImage = '</a>';
    echo $beforeEachImage . $matches[1][$i] . $afterEachImage;}?>

</div>
              
      <h3>Project Location & Quick Stats</h3>
        <div id="map" class="halfmap"></div>
        <div id="stats" class="halfstats"></div>
        <div class="clear"></div>

      <h3>Category Funding Comparison</h3>
        <p>Below, a funds comparison between this category's projects.</p>

    	 <div id="holder"></div>

      <h3>Project Funding Schedule</h3>
        <div id="table"></div>

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

       <?php 

       if (strpos($post->post_content,'[gallery') === false){
  $gallery = 0;
}else{
  $gallery = 1;
}
      if ($gallery = 1) {
      echo "<h3>Project Photos</h3>";
       echo do_shortcode('[gallery option1="value1"]'); }?>


    <h3>Related News Posts</h3>
    <h3>Relevant Documents</h3>


    <?php
$tags = array(
    'tag__in' => "map",
);
if ($tags) {
  $tag_ids = array();
  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

  $args=array(
    'tag__in' => $tag_ids,
    'post__not_in' => array($post->ID),
    'showposts'=>5, // Number of related posts that will be shown.
    'caller_get_posts'=>1
  );
  $my_query = new wp_query($args);
  if( $my_query->have_posts() ) {
    echo '<h3>Related Posts</h3><ul>';
    while ($my_query->have_posts()) {
      $my_query->the_post();
    ?>
      <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
    <?php
    }
    echo '</ul>';
  }
}
?>

<div id="sharing">
  <p>Share this page: </p>
  <a href="https://twitter.com/share" class="twitter-share-button" data-via="MayorReichert" data-hashtags="MaconSPLOST">Tweet</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];
    if(!d.getElementById(id)){js=d.createElement(s);
    js.id=id; js.src="//platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js,fjs);}
    }(document,"script","twitter-wjs");</script>
  <g:plusone size="medium"></g:plusone>
  <div class="fb-like" data-send="true" data-layout="button_count" data-width="100" data-show-faces="false"></div>
</div>

<!--nextpage-->
<div id="post-nav">
  <span class="prevPageNav">
    <?php 
    echo previous_page_not_post('', true, ''); ?> 
  </span>  
  <span class="nextPageNav" >
    <?php 
    echo next_page_not_post('', true, '' ); 
?> 
  </span>
  

</div>

      <span class="button wpedit">
      <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?></span>

      <?php comments_template( '', true ); ?>

   <?php endwhile; ?>

  </div><!-- end #maincontainer -->
    
    
  <script id="stats" type="text/html">
     <h5>Project Status: </h5>
     <p><span class="statHighlight">{{isCompleted}}</span></p>
     <h5>Total Spent as of {{currentDate}}:</h5>
     <p><span class="statHighlight">{{totalSpent}}</span> of <span class="statHighlight">{{categoryTotal}}</span></p>
   </script>
    
   <script id="schedule" type="text/html">
      <table>
      <thead>
      <tr class="tableheader">
      <th>PROJECT</th><th>TOTAL</th><th>2012</th><th>2013</th><th>2014</th><th>2015</th><th>2016</th><th>2017</th><th>2018</th><th>2019</th>
      </tr>
      </thead>
      {{#rows}}
        <tr><td class = "project">{{project}}</td><td class="total">{{total}}</td><td class="yrdolls">{{year2012}}</td><td class="yrdolls">{{year2013}}</td><td class="yrdolls">{{year2014}}</td><td class="yrdolls">{{year2015}}</td><td class="yrdolls">{{year2016}}</td><td class="yrdolls">{{year2017}}</td><td class="yrdolls">{{year2018}}</td><td class="yrdolls">{{year2019}}</td></tr>
      {{/rows}}
      </table>
    </script>
  
    <script type="text/javascript">    
      document.addEventListener('DOMContentLoaded', function() {
         loadSpreadsheet(showInfo)
       })    

       function showInfo(data, tabletop) {
               
         accounting.settings.currency.precision = 0

         var edProjects = getType(data, "Economic Development")
         var drProjects = getType(data, "Debt Retirement")
         var raProjects = getType(data, "Rec & Cultural Arts")
         var psProjects = getType(data, "Public Safety")
		 		 var downtownC  = getProject(data, "Downtown Corridor")
				 
			 	function getProjectTotal(project) {
			 		var tot = "total"
			 		var projectTotal = project[tot]
			 		return projectTotal
			 	}
				 
				console.log(getProjectTotal(downtownC))
		 
		 		var theCombo = comboArrays(downtownC, edProjects)

         var map = loadMap()
         downtownC.forEach(function (downtownC){
           displayAddress(map, downtownC)
         })

         function pushBits(element) {
            values.push(parseInt(element.total))
            labels.push(element.project)
            hexcolors.push(element.hexcolor)
          }
              
          var r = Raphael("holder")
          var values = []
          var labels = []
          var hexcolors = []
              theCombo.forEach(pushBits)
                   
          pie = r.piechart(230, 230, 170, values, { 
            legend: labels, 
            legendpos: "east", 
            href: ["#", "#"],
            colors: hexcolors
            })

          pie.hover(function () {
              this.sector.stop();
              this.sector.scale(1.1, 1.1, this.cx, this.cy);
                    

              if (this.label) {
                  this.label[0].stop();
                  this.label[0].attr({ r: 9.5 }); //changed radius of the label's marker
                  this.label[1].attr({ "font-weight": 800 });
              }
          }, function () {
              this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

              if (this.label) {
                  this.label[0].animate({ r: 5 }, 500, "bounce");
                  this.label[1].attr({ "font-weight": 400 });
              }
          });    
          
         var numberActive = getActiveProjects(downtownC).length
         var numberTotalProjects = 14
         var numberCompletedProjects = completedProjects(downtownC)
         var totalSpent = amountSpent(downtownC)
		 		 var catTotal = getCatTotal(edProjects)
		 
         var schedule = ich.schedule({
           "rows": turnCurrency(downtownC)
         })

         var stats = ich.stats({
			 		 "projectTotal":		accounting.formatMoney(),
		  		 "categoryTotal": 			accounting.formatMoney(catTotal),
		  		 "isCompleted": 				isComplete(downtownC),
           "numberActive": 				numberActive,
           "numberTotalProjects": 		numberTotalProjects,
           "numberCompletedProjects": 	numberCompletedProjects,
           "totalSpent": 				accounting.formatMoney(totalSpent),
           "currentDate": 				getCurrentYear()
		   
         })

         document.getElementById('table').innerHTML = schedule;
         document.getElementById('stats').innerHTML = stats; 

       }
    </script>

    <!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
