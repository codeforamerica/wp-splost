<?php
/*
Template Name: Revenue Page Template
* This is to be used for the one instance page showing revenue
* 
*/
?>

<?php get_header(); ?>
 <div id="maincontainer" class="overview" >
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

  <h3>Revenue Received</h3>
	  <div id="holder"></div>

  <h3>Monthly Revenue</h3>
    <p>Something about fiscal years starting on July 1 and what budgeted and actual mean.</p> 
    <div id="monthly"><img class="spinner" src="/wp-content/themes/wp-splost/fbi_spinner.gif"></div>

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
    <?php comments_template( '', true ); ?>

   <?php endwhile; ?>
</div><!-- end #maincontainer -->
     
<script id="monthly" type="text/html">
  <h6 class="fleft">Monthly Report for:</h6> 
  <p><span class="statHighlight">  {{reportmonth}} / {{reportyear}}</span></p>
  <table class="monthlytable">
  <thead>
  <tr class="tableheader">
  <th>PROJECT</th><th>STATUS</th><th>BUDGET</th><th>Actual</th>
  </tr>
  </thead>
  {{#rows}}
    <tr>
    <td>{{project}}</td><td >{{status}}</td><td class="tright yrdolls">{{budget}}</td><td class="tright yrdolls">{{ptdactual}}</td></tr>
  {{/rows}}
  </table>
</script>
    
<script id="stats" type="text/html">
 <h5>Total Budgeted Revenue: <span class="statHighlight">{{totalBudgeted}}</span> vs Total Actual Revenue: <span class="statHighlight">{{totalActual}}</span></h5>
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

  var monthlyrev = getActualsArea(tabletop.sheets("actuals").all(), pageName)
  var dataLength = monthlyrev.length

  // monthly revenue stacked bar chart in d3 

  function renderRevenueGraph(data, divTown) {

  var margin = {top: 20, right: 20, bottom: 30, left: 70},
      width = 780 - margin.left - margin.right,
      height = 500 - margin.top - margin.bottom;

  var x = d3.scale.ordinal()
      .rangeRoundBands([0, width], .1);

  var y = d3.scale.linear()
      .rangeRound([height, 0]);

  var color = d3.scale.ordinal()
      .range(["#BCEDDC","#e6e6e6","#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

  var xAxis = d3.svg.axis()
      .scale(x)
      .orient("bottom");

  var yAxis = d3.svg.axis()
      .scale(y)
      .orient("left")
      // .tickFormat(d3.format(".2s"));

  var svg = d3.select(divTown).append("svg")
      .attr("width", width + margin.left + margin.right)
      .attr("height", height + margin.top + margin.bottom)
    .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  color.domain(d3.keys(data[0]).filter(function(key) { return key !== "State"; }));

  data.forEach(function(d) {
    var y0 = 0;
    d.ages = color.domain().map(function(name) {
      return {name: name, y0: y0, y1: y0 += +d[name]};
    });
    d.total = d.ages[d.ages.length - 1].y1;
  });

  x.domain(data.map(function(d) { return d.State; }));
  y.domain([0, d3.max(data, function(d) { return d.total; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Dollars");

  var state = svg.selectAll(".state")
      .data(data)
    .enter().append("g")
      .attr("class", "g")
      .attr("transform", function(d) { return "translate(" + x(d.State) + ",0)"; });

  state.selectAll("rect")
      .data(function(d) {
        return d.ages;
      })
    .enter().append("rect")
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.y1); })
      .attr("height", function(d) { return y(d.y0) - y(d.y1); })
      .style("fill", function(d) { return color(d.name); });

  var legend = svg.selectAll(".legend")
      .data(color.domain().slice().reverse())
    .enter().append("g")
      .attr("class", "legend")
      .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

  legend.append("rect")
      .attr("x", width - 18)
      .attr("width", 18)
      .attr("height", 18)
      .style("fill", color);

  legend.append("text")
      .attr("x", width - 24)
      .attr("y", 9)
      .attr("dy", ".35em")
      .style("text-anchor", "end")
      .text(function(d) { return d; });

};

var reformattedData = monthlyrev.map(function(i){
  // this data format comes from http://bl.ocks.org/3886208
  var budget = +i.budget
  var actual = +i.ptdactual
  if (budget < actual) actual = actual - budget
  if (budget > actual) budget = budget - actual
  if (budget === actual) budget = 0

  return { State: i.project, budgeted: budget, actual: actual }
})
 
      if (Modernizr.svg) renderRevenueGraph(reformattedData, "#holder")
      else sorrySVG("#holder")

      function sorrySVG(divTown) {
        $(divTown).text("Sorry, to see the chart you'll need to update your browser.")
      }

      var totalBudgeted = getColumnTotal(monthlyrev, "budget")
      var totalActual = getColumnTotal(monthlyrev, "ptdactual")
      var reportmonth = getCurrentMonth() - 1
      var reportyear = getCurrentYear()

      var theDiff = getDiff(totalBudgeted, totalActual)
      //These populate the page's tables 

      var monthly = ich.monthly({
        "rows": turnReportCurrency(monthlyrev),
        "reportyear": reportyear,
        "reportmonth": reportmonth
      })

      var stats = ich.stats({
        "totalBudgeted": accounting.formatMoney(totalBudgeted),
        "totalActual": accounting.formatMoney(totalActual)
      })

     $('#monthly').html(monthly)
     $('#stats').html(stats)

       }
    </script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>