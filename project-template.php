<?php
/*
Template Name: Focus Area Template
* This is the template to be used for Category Pages.
* Storm Drainage, Centreplex, Ft Hawkins, Debt Retirement 
*/
?>

<?php get_header(); ?>

<div id="maincontainer" class="projectPage" >

<?php the_post_thumbnail();  ?>
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
              
  <h3>Location & Quick Stats</h3>
    <div id="map" class="halfmap"><img class="spinner" src="http://splost.codeforamerica.org/wp-content/uploads/2012/10/fbi_spinner.gif"></div>
    <div id="stats" class="halfstats"></div>
    <div class="clear"></div>

  <h3>Category Funding Comparison</h3>
    <p>Below, a funds comparison between the projects in <?php echo get_the_title($post->post_parent) ?>.</p>
    <div id="holder"></div>

  <h3>Funding Schedule</h3>
    <div id="table"></div>

  <!-- only if this project has a report -->
  <div id="monthly"></div>

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
 <h5>Project Status: </h5>
 <p><span class="statHighlight">{{isActive}}</span></p>
 <h5>Total Spent as of {{currentDate}}:</h5>
 <p><span class="statHighlight">{{totalSpent}}</span></p>
</script>
  
<script id="schedule" type="text/html">
  <table>
  <thead>
  <tr class="tableheader">
  <th>FOCUS AREA</th><th>TOTAL</th><th>2012</th><th>2013</th><th>2014</th><th>2015</th><th>2016</th><th>2017</th><th>2018</th><th>2019</th>
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
     var pageParent = "<?php echo get_the_title($post->post_parent) ?>"
     var pageName = "<?php the_title(); ?>"
     var thePageParent = getType(data, pageParent)
     var thePageName  = getProject(data, pageName)
     // var downtownC  = getProject(data, "Downtown Corridor")

     var map = loadMap()
     thePageName.forEach(function (thePageName){
       displayAddress(map, thePageName)
     })

     function pushBits(element) {
        values.push(parseInt(element.total))
        labels.push(element.project)
        hexcolors.push(element.hexcolor)
      }

      // axis variables
      var noProjsInCat = thePageParent.length 
      var chartHeight = noProjsInCat * 40
      var axisY =  chartHeight

      function makeAxisLength() {
        if (noProjsInCat > 2)
        var axisLength = chartHeight * .8
        else axisLength = chartHeight * .5 
          return axisLength
      }
          
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
      
    var numberActive = getActiveProjects(thePageName).length
    var numberTotalProjects = data.length
    // var numberCompletedProjects = completedProjects(thePageName)
    var totalSpent = amountSpent(thePageName)
    var catTotal = getCatTotal(thePageParent)

    var monthlyrev = getMonthlyType(tabletop.sheets("actuals").all(), pageName)
    console.log(monthlyrev)
    var reportmonth = getCurrentMonth() - 1
    var reportyear = getCurrentYear()


  //These populate the page's tables 

     var stats = ich.stats({
      "projectTotal":    accounting.formatMoney(),
       "categoryTotal":       accounting.formatMoney(catTotal),
       "isActive":         isActive(thePageName),
       "numberActive":        numberActive,
       "numberTotalProjects":     numberTotalProjects,
       // "numberCompletedProjects":   numberCompletedProjects,
      "totalSpent":        accounting.formatMoney(totalSpent),
       "currentDate":         getCurrentYear()
     })

    var schedule = ich.schedule({
       "rows": turnCurrency(thePageName)
    }) 

    var monthly = ich.monthly({
      // "rows": monthlyrev,
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