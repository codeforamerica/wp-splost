<?php
/*
Template Name: Revenue Page Template
* This is to be used for the one instance page showing revenue
* 
*/
?>

<?php get_header(); ?>
 <div id="maincontainer" class="overview" >
   <h3>Overview Description</h3>
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

   					<?php if ( is_front_page() ) { ?>
   						<!-- ><h2><?php the_title(); ?></h2> -->
   					<?php } else { ?>	
   					<!--	<h1><?php the_title(); ?></h1> -->
   					<?php } ?>				

   						<?php the_content(); ?>

  <h3>Quick Stats</h3>
    <div id="stats"></div>  
  <h3>Category Funding Comparison</h3>
    <p>Below, a funds comparison between this category's projects.</p>
	  <div id="holder"></div>

  <h3>Economic Development Monthly Revenue</h3>
    <div id="monthly"></div>

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
    
    
   <script id="stats" type="text/html">
     <p><span class="statHighlight">{{numberActive}} of {{numberTotalProjects}}</span> projects are active</p>
     <p><span class="statHighlight">{{numberCompletedProjects}}</span> projects are completed</p>
     <p><span class="statHighlight">{{totalSpent}}</span> has been spent as of {{currentDate}} </p>
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
        <td>{{subtype}}</td><td >{{status}}</td><td class="tright">{{budget}}</td><td class="tright">{{ytd_actual}}</td></tr>
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
         

      //    function pushBits(element) {
      //       values.push(parseInt(element.total))
      //       labels.push(element.project)
      //       hexcolors.push(element.hexcolor)
      //     }
              
      //     var r = Raphael("holder")
      //     var values = []
      //     var labels = []
      //     var hexcolors = []
      //         thePageParent.forEach(pushBits)

      // // (paper, x, y, width, height, values, opts)
      // r.g.hbarchart(170, 15, 480, 90, values, {stacked: true, type: "soft", colors: hexcolors, gutter: "20%"}).hoverColumn(
      //   function() { 
      //     var y = []
      //     var res = []

      //         for (var i = this.bars.length; i--;) {
      //             y.push(this.bars[i].y);
      //             res.push(this.bars[i].value || "0");
      //         }
      //         this.flag = r.g.popup(this.bars[0].x, Math.min.apply(Math, y), res.join(", ")).insertBefore(this);
      // }, function() {
      //       this.flag.animate({opacity: 0}, 1500, ">", function () {this.remove();});
      // });
      // // (x, y, length, from, to, steps, orientation, labels, type, dashsize, paper)
      // axis = r.g.axis(160,80,45,null, null,1,1, labels.reverse(), null, 1);
      // axis.text.attr({font:"12px Arvo", "font-weight": "regular", "fill": "#333333"}); 
          

      var numberActive = getActiveProjects(thePageParent).length
      var numberTotalProjects = 2
      var numberCompletedProjects = completedProjects(thePageParent)
      var totalSpent = amountSpent(thePageParent)

      var monthlyrev = getType(tabletop.sheets("actuals").all(), pageName)
      console.log(monthlyrev)
      var reportmonth = getCurrentMonth()
      var reportyear = getCurrentYear()
      //These populate the page's tables 



      var stats = ich.stats({
        "numberActive": numberActive,
        "numberTotalProjects": numberTotalProjects,
        "numberCompletedProjects": numberCompletedProjects,
        "totalSpent": accounting.formatMoney(totalSpent),
        "currentDate": getCurrentYear()
      })


      var monthly = ich.monthly({
        "rows": monthlyrev,
        "reportyear": reportyear,
        "reportmonth": reportmonth
      })

         document.getElementById('monthly').innerHTML = monthly; 
         document.getElementById('stats').innerHTML = stats; 

       }
    </script>



<?php get_sidebar(); ?>
<?php get_footer(); ?>