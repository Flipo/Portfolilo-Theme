<?php get_header(); ?>     

   <div class="content">
     <div class="sixteen columns">
			
			<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
 			
 			<div class="pagepost ten columns alpha">
 			<h2><?php the_title(); ?></h2>
 			
 			
 			<?php the_content(); ?>
 			</div>
 			<div class="pageimage offset-by-one five columns omega">
 			<?php the_post_thumbnail('page-thumb'); ?> 
 			</div>
 			
 			
 			<?php endwhile; ?><!--  End the Loop -->  
     </div>  <!-- End two-thirds column -->
   </div><!-- End Content -->
    
     
            
<?php  get_footer(); ?>   
   
                       
           
