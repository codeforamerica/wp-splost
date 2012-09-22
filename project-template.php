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



    <?php // check if post has gallery, if so, display it
      if (strpos($post->post_content,'[gallery') === false){
      $gallery = 0;}
      else {
      $gallery = 1;}

      if ($gallery === 1) {
      echo "<h3>Project Photos</h3>";
      echo do_shortcode('[gallery option1="value1"]'); }
    ?>

                   


<div class="wholemilk">
  <div class="halfmilk">
<h3>Related News Posts</h3>
<div id="relevantPosts">

<?php

// The Query
$args = array( 'numberposts' => 5, 'order'=> 'DESC', 'orderby' => 'post_date', 'tag' => 'map' );
query_posts( $args );
// The Loop
while ( have_posts() ) : the_post();
  echo '<h6>';
  the_date(); ?>
  </h6><h5> 
  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
<?php
endwhile;

// Reset Query
wp_reset_query();

?>
</div>
</div>
<div class="halfmilk">
<h3>Relevant Documents</h3>
<!-- what if docs were individual posts that didn't come up in feed but you can query? -->
</div>
</div>

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
      <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
      </span>

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
              data.forEach(pushBits)
                   
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
           "projectTotal":    accounting.formatMoney(),
           "categoryTotal":       accounting.formatMoney(catTotal),
           "isCompleted":         isComplete(downtownC),
           "numberActive":        numberActive,
           "numberTotalProjects":     numberTotalProjects,
           "numberCompletedProjects":   numberCompletedProjects,
           "totalSpent":        accounting.formatMoney(totalSpent),
           "currentDate":         getCurrentYear()
       
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