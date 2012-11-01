<?php
/*
Template Name: Focus Area Template
* This is the template to be used for Category Pages.
* Storm Drainage, Centreplex, Ft Hawkins, Infrastructure, Debt Retirement 
*/
?>

<?php get_header(); ?>

<div id="maincontainer" class="projectPage" >

<?php the_post_thumbnail(); ?>
<div class="articleHolder">
  <h3>Description</h3>
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div class="content-text">
      <?php // this pulls out image tags from the_content so that only the text appears in this div
      ob_start();
      the_content('Read the full post',true);
      $postOutput = preg_replace('/<img[^>]+./','', ob_get_contents());
      ob_end_clean();
      echo $postOutput;
      ?>
    </div>
  </div><!-- end holder -->
              
  <div class="articleHolder">
    <h3>Location & Quick Stats</h3>
      <div id="stats" ></div>
      <div id="map" class="fullmap"><img class="spinner" src="/wp-content/themes/wp-splost/fbi_spinner.gif"></div>
      <div class="clear"></div>
  </div><!-- end holder -->

  <div class="articleHolder">
    <h3>Category Funding Comparison</h3>
      <p>Below, a funds comparison between the projects in <?php echo get_the_title($post->post_parent) ?>.</p>
      <div id="holder"></div>
  </div><!-- end holder -->

  <div class="articleHolder">
    <h3>Funding Schedule</h3>
      <p>The projected dispersal of funds for <?php the_title(); ?>.</p>
      <div id="table"></div>
  </div><!-- end holder -->

  <!-- only if this project has a report -->
  <div class="articleHolder">
    <div id="monthly"></div>
  </div><!-- end holder -->

  <div class="articleHolder">
    <div id="pagePhotos">
      <?php // check if post has gallery, if so, display it
        if (strpos($post->post_content,'[gallery') === false){
        $gallery = 0;}
        else {
        $gallery = 1;}

        if ($gallery === 1) {
        echo "<h3>Project Photos</h3>";
        echo do_shortcode('[gallery option1="value1" columns="5"]'); }
      ?>
    
    <div class="content-img">
      <?php // if a photo is added not in a gallery
      preg_match_all("/(<img [^>]*>)/",get_the_content(),$matches,PREG_PATTERN_ORDER);
      for( $i=0; isset($matches[1]) && $i < count($matches[1]); $i++ ) {
        $beforeEachImage = '<a href="#">';
        $afterEachImage = '</a>';
        echo $beforeEachImage . $matches[1][$i] . $afterEachImage;}?>
    </div>
    </div><!-- end photos -->
  </div><!-- end holder -->
                  
  <div class="articleHolder">              
  <div class="wholemilk">
      <h3>Related News Posts</h3>
      <p>Recent news entries about <?php the_title(); ?>. You can also subscribe to the <a href="http://www.splost.info/?tag=<?php echo the_slug() ?>&feed=rss2">RSS Feed</a> for updates on <?php the_title() ?>, or if you'd like, this <a href="http://www.splost.info/feed=rss2">RSS Feed</a> for all SPLOST updates.
        <div id="relevantPosts">
          <?php
          // The Query
          $page_title = the_slug();
          $args = array( 'numberposts' => 5, 'order'=> 'DESC', 'orderby' => 'post_date', 'tag' => $page_title );
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
            wp_reset_query();?>
        </div>
    <!-- incase you want to add a section for documents
    <div class="halfmilk">
      <h3>Relevant Documents</h3>
         // what if docs were individual posts that didn't come up in feed but you can query? -->
    </div>
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

  <!-- navigating between pages, uses plugin -->
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
    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
  </span>

<?php endwhile; ?>

</div><!-- end #maincontainer -->

<script id="monthly" type="text/html">
<h3>Monthly Expenditure Report</h3>
  <p>Each month we publish a report on our expenses and tax/bond revenue with active projects. 
    If this project is active, the chart below will be populated with expenses related to <?php the_title(); ?> . 
    You can find an archive of reports <a href="http://splost.codeforamerica.org/?s=monthly+report">here</a>.</p>
  <h6 class="fleft">Monthly Report for:</h6> 
  <p><span class="statHighlight">  {{reportmonth}} / {{reportyear}}</span></p>

  <table class="monthlytable">
  <thead>
  <tr class="tableheader">
  <th>FOCUS AREA</th><th>PROJECT</th><th>BUDGET</th><th>ACTUAL</th><th>STATUS</th>
  </tr>
  </thead>
  {{#rows}}
    <tr>
    <td>{{focusarea}}</td><td >{{project}}</td><td class="yrdolls">{{budget}}</td><td class="yrdolls total">{{ptdactual}}</td><td class-"tright">{{status}}</td></tr>
  {{/rows}}
  </table>
</script>
    
    
<script id="stats" type="text/html">
 <h5><?php the_title(); ?> has <span class="statHighlight">{{numberItemizedProjects}}</span> projects, <span class="statHighlight">{{numberInProgress}}</span> of which labeled in progress.</h5>
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
     window.tabletopData = tabletop       

     accounting.settings.currency.precision = 0
     var pageParent = "<?php echo get_the_title($post->post_parent) ?>"
     var pageName = "<?php the_title(); ?>"
     var thePageParent = getType(data, pageParent)
     var thePageName  = getProject(data, pageName)

     // make map 

     var map = loadMap()
     thePageName.forEach(function (thePageName){
       displayAddress(map, thePageName)
     })

     // make bar chart

     function pushBits(element) {
        values.push(parseInt(element.total))
        labels.push(element.focusarea)
        hexcolors.push(element.hexcolor)
      }

      // -- axis variables

      var noProjsInCat = thePageParent.length 
      var chartHeight = noProjsInCat * 40
      var axisY =  chartHeight

      function makeAxisLength() {
        if (noProjsInCat > 2)
        var axisLength = chartHeight * .8
        else axisLength = chartHeight * .5 
          return axisLength
      }

      // -- set up chart
          
      var r = Raphael("holder")
      var values = []
      var labels = []
      var hexcolors = []
          thePageParent.forEach(pushBits)
               
      // (paper, x, y, width, height, values, opts)
      r.g.hbarchart(170, 20, 480, chartHeight, values, {stacked: true, type: "soft", colors: hexcolors, gutter: "10"}).hoverColumn(
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
      // (x, y, length, from, to, steps, orientation, labels, type, dashsize, paper)
      axis = r.g.axis(160, axisY, makeAxisLength(), noProjsInCat, null,noProjsInCat - 1,1, labels.reverse(), null, 1);
      axis.text.attr({font:"12px Arvo", "font-weight": "regular", "fill": "#333333"});     
      
      // variables to fill in tables 

      // -- quick stats table
      var itemizedArea = getActualsArea(tabletop.sheets("actuals").all(), pageName)
      var inProgress = getInProgress(itemizedArea)
      var sumInProgress = inProgressSpent(itemizedArea)

      // -- monthly expense table
      var monthlyrev = getActualsArea(tabletop.sheets("actuals").all(), pageName)
      var reportmonth = getCurrentMonth() - 1
      var reportyear = getCurrentYear()


      // These define the tables 

      var stats = ich.stats({
        "numberItemizedProjects": itemizedArea.length,
        "numberInProgress": inProgress.length,
        "sumInProgress": accounting.formatMoney(sumInProgress),
        "currentDate": getCurrentYear()
      })

      var schedule = ich.schedule({
        "rows": turnCurrency(thePageName)
      }) 

      var monthly = ich.monthly({
        "rows": turnReportCurrency(monthlyrev),
        "reportyear": reportyear,
        "reportmonth": reportmonth
      })
    
      document.getElementById('stats').innerHTML = stats; 
      document.getElementById('table').innerHTML = schedule;
      document.getElementById('monthly').innerHTML = monthly;
   }
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>