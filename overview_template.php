<?php
/*
Template Name: Overview
*/
?>

<?php get_header(); ?>
 <div id="maincontainer" class="overview" >
   <h3>Project Description</h3>
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

   					<?php if ( is_front_page() ) { ?>
   						<!-- ><h2><?php the_title(); ?></h2> -->
   					<?php } else { ?>	
   					<!--	<h1><?php the_title(); ?></h1> -->
   					<?php } ?>				

   						<?php the_content(); ?>
   						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
   						<span class="button wpedit">
   						<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?></span>

   				<?php comments_template( '', true ); ?>

   <?php endwhile; ?>
   <h3>Economic Development Quick Stats</h3>
   <div id="stats"></div>
   <h3>Project Locations</h3>
   
    <div id="map"></div>
    <h3>Project Funding Schedule</h3>
    
  <div id="table"></div><!-- end #table -->
    </div><!-- end #maincontainer -->
    
    
    <script id="stats" type="text/html">
       <p><span class="statHighlight">{{numberActive}} of {{numberTotalProjects}}</span> projects are active</p>
       <p><span class="statHighlight">{{numberCompletedProjects}}</span> projects are completed</p>
       <p><span class="statHighlight">{{totalSpent}}</span> has been spent as of {{currentDate}} </p>
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

         var map = loadMap()
         edProjects.forEach(function (edProject){
           displayAddress(map, edProject)
         })


         var numberActive = getActiveProjects(edProjects).length
         var numberTotalProjects = 2
         var numberCompletedProjects = completedProjects(edProjects)
         var totalSpent = amountSpent(edProjects)

         var schedule = ich.schedule({
           "rows": turnCurrency(edProjects)
         })

         var stats = ich.stats({
           "numberActive": numberActive,
           "numberTotalProjects": numberTotalProjects,
           "numberCompletedProjects": numberCompletedProjects,
           "totalSpent": accounting.formatMoney(totalSpent),
           "currentDate": getCurrentYear()
         })

         document.getElementById('table').innerHTML = schedule;
         document.getElementById('stats').innerHTML = stats; 

       }
    </script>


<?php get_sidebar(); ?>
<?php get_footer(); ?>