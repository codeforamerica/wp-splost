<?php
/*
Template Name: Category Overview Template
* This is to be used for Area Overviews
* Public Safety, Debt Retirement, Economic Development, Rec & Cultural Arts
*/
?>

<?php get_header(); ?>
 <div id="maincontainer" class="overview" >
    <div class="articleHolder">  
    <h3>Overview Description</h3>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

     					<?php if ( is_front_page() ) { ?>
     						<!-- ><h2><?php the_title(); ?></h2> -->
     					<?php } else { ?>	
     					<!--	<h1><?php the_title(); ?></h1> -->
     					<?php } ?>				

     						<?php the_content(); ?>
  </div><!-- end holder -->

  <div class="articleHolder"> 
    <h3>Quick Stats</h3>
      <div id="stats"></div>
  </div><!-- end holder -->

  <div class="articleHolder"> 
    <h3>Project Locations</h3>
      <div id="map" class="fullmap"><img class="spinner" src="/wp-content/themes/wp-splost/fbi_spinner.gif"></div>  
  </div><!-- end holder -->

  <div class="articleHolder"> 
    <h3>Category Funding Comparison</h3>
      <p>Below, a funds comparison between this category's Focus Areas.</p>
  	  <div id="holder"></div>
  </div><!-- end holder -->

  <div class="articleHolder">
    <h3>Project Funding Schedule</h3>
      <p>This is the funding schedule budget as proposed by the SPLOST bill.<p>
      <div id="table"></div>
  </div><!-- end holder -->

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
      echo next_page_not_post('', true, '' );  ?> 
    </span>
  </div>

  <span class="button wpedit">
    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?></span>

   <?php endwhile; ?>
</div><!-- end #maincontainer -->
    
    
<script id="stats" type="text/html">
 <h5><?php the_title(); ?> has <span class="statHighlight">{{numberFocusAreas}}</span> Focus Areas with a combined <span class="statHighlight">{{numberItemizedProjects}}</span> projects.</h5>
 <h5><span class="statHighlight">{{numberInProgress}}</span> of these projects are labeled in progress and <span class="statHighlight">{{completeProjects}}</span> are complete.</h5>
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

  <script id="monthly" type="text/html">
      <h6 class="fleft">Monthly Report for:</h6> 
      <p><span class="statHighlight">  {{reportmonth}} {{reportyear}}</span></p>
      <table class="monthlytable">
      <thead>
      <tr class="tableheader">
      <th>SUB PROJECT</th><th>ITEM</th><th>Budget</th><th>Actual</th>
      </tr>
      </thead>
      {{#rows}}
        <tr>
        <td>{{subproject}}</td><td >{{item}}</td><td class="tright">{{budgeted}}</td><td class="tright">{{actual}}</td></tr>
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
      
      // make map

      var map = loadMap()
        thePageParent.forEach(function (thePageParent){
          displayAddress(map, thePageParent)
      })

var noProjsInCat = thePageParent.length 

if (Modernizr.svg) renderGraph(thePageParent, noProjsInCat, "#holder") 
else sorrySVG("#holder")

function sorrySVG(divTown) {
  $(divTown).text("Sorry, to see the chart you'll need to update your browser. <a href='https://www.google.com/intl/en/chrome/browser/'>Google Chrome</a> is great.")
}
      // variables to fill in tables 

      // -- stats table
      var numberFocusAreas = getType(data, pageParent).length
      var itemizedArea = getActualsCategory(tabletop.sheets("actuals").all(), pageParent)
      var inProgress = getInProgress(itemizedArea)
      var sumInProgress = inProgressSpent(itemizedArea)
      var completeProjects = getStatusCount(itemizedArea, "Complete")

      var schedule = ich.schedule({
        "rows": turnCurrency(thePageParent)
      })

      var stats = ich.stats({
        "numberItemizedProjects": itemizedArea.length,
        "numberInProgress": inProgress.length,
        "sumInProgress": accounting.formatMoney(sumInProgress),
        "currentDate": getCurrentYear(),
        "numberFocusAreas": numberFocusAreas,
        "completeProjects": completeProjects
      })

     $('#table').html(schedule)
     $('#stats').html(stats)

       }
</script>



<?php get_sidebar(); ?>
<?php get_footer(); ?>