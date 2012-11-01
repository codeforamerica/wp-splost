<?php
/*
Template Name: SPLOST Overview Template
* To be used in one instance as the overview page for all of SPLOST
*/
?>

<?php get_header(); ?>
 <div id="maincontainer" class="overview">
    <h3>Description</h3>
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php if ( is_front_page() ) { ?>
					<!-- ><h2><?php the_title(); ?></h2> -->
				<?php } else { ?>	
				<!--	<h1><?php the_title(); ?></h1> -->
				<?php } ?>				
				<?php the_content(); ?>

    <h3>Quick Stats</h3>
      <div id="stats"></div>
    <h3>Project Locations</h3>
      <div id="map" class="fullmap"><img class="spinner" src="/wp-content/themes/wp-splost/fbi_spinner.gif"></div>
    <h3>Category Funding Comparison</h3>
      <p>A comparison of each project's funding.</p>
	    <div id="splostHolder"></div>
    <h3>Project Funding Schedule</h3>
      <div id="table"></div><!-- end #table -->

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

  <!--nav between pages, uses plugin-->
  <div id="post-nav">
    <span class="prevPageNav"> <?php echo previous_page_not_post('', true, ''); ?> </span>  
    <span class="nextPageNav"> <?php echo next_page_not_post('', true, '' );  ?> </span>
  </div>

  <span class="button wpedit">
    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
  </span>


    <?php endwhile; ?>
  </div><!-- end #maincontainer -->
    
    
<script id="stats" type="text/html">
 <h5><?php echo get_the_title($post->post_parent) ?> has <span class="statHighlight">{{numberFocusAreas}}</span> Focus Areas with a combined <span class="statHighlight">{{numberItemizedProjects}}</span> projects.</h5>
 <h5><span class="statHighlight">{{numberInProgress}}</span> of these projects are labeled in progress.</h5>
 <h5>To date, <span class="statHighlight">{{sumInProgress}}</span> has been spent on the projects in progress.</h5>
</script>

<script id="schedule" type="text/html">
  <table>
  <thead>
  <tr class="tableheader">
  <th>FOCUS AREA</th><th>TOTAL</th><th>2012</th><th>2013</th><th>2014</th><th>2015</th><th>2016</th><th>2017</th><th>2018</th><th>2019</th>
  </tr>
  </thead>
  {{#rows}}
    <tr><td class = "project">{{focusarea}}</td><td class="total">{{total}}</td><td class="yrdolls">{{year2012}}</td><td class="yrdolls">{{year2013}}</td><td class="yrdolls">{{year2014}}</td><td class="yrdolls">{{year2015}}</td><td class="yrdolls">{{year2016}}</td><td class="yrdolls">{{year2017}}</td><td class="yrdolls">{{year2018}}</td><td class="yrdolls">{{year2019}}</td></tr>
  {{/rows}}
  </table>
</script>
    
    
<script type="text/javascript">    
  document.addEventListener('DOMContentLoaded', function() {
     loadSpreadsheet(showInfo)
   })    

   function showInfo(data, tabletop) {
           
           
     accounting.settings.currency.precision = 0

     var pageParent = "<?php echo get_the_title($post->post_parent) ?>"
     var pageName = "<?php the_title(); ?>"     
     var thePageParent = getType(data, pageParent)
     var thePageName  = getProject(data, pageName)

     var map = loadMap()
     data.forEach(function (data){
       displayAddress(map, data)
     })

     function pushBits(element) {
        values.push(parseInt(element.total))
        labels.push(element.focusarea)
        hexcolors.push(element.hexcolor)
      }
          
      var r = Raphael("splostHolder")
      var values = []
      var labels = []
      var hexcolors = []
          data.forEach(pushBits)

      r.g.hbarchart(170, 15, 480, 480, values, {stacked: true, type: "soft", colors: hexcolors, gutter: "50%"}).hoverColumn(
        function() { 
          var y = []
          var res = []

              for (var i = this.bars.length; i--;) {
                  y.push(this.bars[i].y);
                  res.push(this.bars[i].value || "0");
              }
              this.flag = r.g.popup(this.bars[0].x, Math.min.apply(Math, y), res.join(", ")).insertBefore(this);
      }, function() {
            this.flag.animate({opacity: 0}, 1500, ">", function () {this.remove();});
      });
 
      axis = r.g.axis(160,470,435,null, null,13,1, labels.reverse(), null, 1);
      axis.text.attr({font:"12px Arvo", "font-weight": "regular", "fill": "#333333"});   
      
    var numberFocusAreas = data.length
    var itemizedArea = tabletop.sheets("actuals").all()
    var inProgress = getInProgress(itemizedArea)
    var sumInProgress = inProgressSpent(itemizedArea)

     var schedule = ich.schedule({
       "rows": turnCurrency(data)
     })

     var stats = ich.stats({
      "numberItemizedProjects": itemizedArea.length,
      "numberInProgress": inProgress.length,
      "sumInProgress": accounting.formatMoney(sumInProgress),
      "currentDate": getCurrentYear(),
      "numberFocusAreas": numberFocusAreas

     })

     document.getElementById('table').innerHTML = schedule;
     document.getElementById('stats').innerHTML = stats; 
   }
</script>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div id="fb-root"></div>
<script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
