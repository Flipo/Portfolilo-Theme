<?php
/**
 * @package WordPress
 * @subpackage WP-Skeleton
 */
?>


<?php get_header(); ?>   

<div class="content">
     <div class="sixteen columns">

	   <?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
       <h2 class="portfoliotitle"><?php the_title(); ?> </h2>               
       <div class="four columns alpha portfolio">
       
      <?php $project_notes = get_post_meta($post->ID, "_portfolilo_notes_value", true); ?>
					<?php echo wpautop(do_shortcode($project_notes)); ?>
       </div>
       
       
       
       <div class="offset-by-one eleven columns omega portfolio"> 
                <?php the_content(); ?>    
       </div>  <!-- End Main -->


        <?php endwhile; ?><!--  End the Loop -->  
      

     </div>  <!-- End two-thirds column -->
   </div><!-- End Content -->



<?php  get_footer(); ?> 
    
                               