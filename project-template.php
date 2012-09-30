<?php
/*
Template Name: THE Project Template.
*/
?>

<?php get_header(); ?>

 <div id="maincontainer" class="projectPage" >

<!-- save if city decides it wants photo php the_post_thumbnail();  -->
<h3>Project Description</h3>
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
              
  <h3>Project Location & Quick Stats</h3>
    <div id="map" class="halfmap"></div>
    <div id="stats" class="halfstats"></div>
    <div class="clear"></div>

  <h3>Category Funding Comparison</h3>
    <p>Below, a funds comparison between this category's projects.</p>
    <div id="holderEd"></div>

  <h3>Project Funding Schedule</h3>
    <div id="table"></div>

  <h3>Monthly Revenue Report</h3>
    <p>Each month we publish a report on our expenses and tax/bond revenue. Below is an itemization of expenses related to <?php the_title(); ?> . You can find an archive of reports <a href="http://splost.codeforamerica.org/?s=monthly+report">here</a>.</p>
  <div id="monthly"></div>

  <?php // check if post has gallery, if so, display it
    if (strpos($post->post_content,'[gallery') === false){
    $gallery = 0;}
    else {
    $gallery = 1;}

    if ($gallery === 1) {
    echo "<h3>Project Photos</h3>";
    echo do_shortcode('[gallery option1="value1"]'); }
  ?>
  
  <div class="content-img">
    <?php
    preg_match_all("/(<img [^>]*>)/",get_the_content(),$matches,PREG_PATTERN_ORDER);
    for( $i=0; isset($matches[1]) && $i < count($matches[1]); $i++ ) {
      $beforeEachImage = '<a href="#">';
      $afterEachImage = '</a>';
      echo $beforeEachImage . $matches[1][$i] . $afterEachImage;}?>
  </div>
                  
  <div class="wholemilk">
    <div class="halfmilk">
      <h3>Related News Posts</h3>
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
      echo next_page_not_post('', true, '' );  ?> 
    </span>
  </div>

  <span class="button wpedit">
    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
  </span>

<?php endwhile; ?>

</div><!-- end #maincontainer -->

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

     var pageTitle = "<?php echo get_the_title($post->post_parent) ?>"
     // or <?= get_the_title($post->post_parent) ?>
     console.log(pageTitle)

     var edProjects = getType(data, pageTitle)
     var drProjects = getType(data, "Debt Retirement")
     var raProjects = getType(data, "Rec & Cultural Arts")
     var psProjects = getType(data, "Public Safety")
     var downtownC  = getProject(data, "Downtown Corridor")
     
    function getProjectTotal(project) {
      var tot = "total"
      var projectTotal = project[tot]
      return projectTotal
    }
      
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
          
      var r = Raphael("holderEd")
      var values = []
      var labels = []
      var hexcolors = []
          edProjects.forEach(pushBits)
               
  // (paper, x, y, width, height, values, opts)
  r.g.hbarchart(170, 15, 480, 90, values, {stacked: true, type: "soft", colors: hexcolors, gutter: "20%"}).hoverColumn(
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
  axis = r.g.axis(160,80,45,null, null,1,1, labels.reverse(), null, 1);
  axis.text.attr({font:"12px Arvo", "font-weight": "regular", "fill": "#333333"});     
      
   var numberActive = getActiveProjects(downtownC).length
   var numberTotalProjects = 14
   var numberCompletedProjects = completedProjects(downtownC)
   var totalSpent = amountSpent(downtownC)
   var catTotal = getCatTotal(edProjects)

  var monthlyrev = getType(tabletop.sheets("revenue").all(), "Downtown Corridor")

  var reportmonth = "August"
  var reportyear = 2012


    var monthly = ich.monthly({
      "rows": turnMonthlyCurrency(monthlyrev),
      "reportyear": reportyear,
      "reportmonth": reportmonth
    })
 
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

    document.getElementById('monthly').innerHTML = monthly; 
    document.getElementById('table').innerHTML = schedule;
    document.getElementById('stats').innerHTML = stats; 

   }
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>