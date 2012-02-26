<?php /*
Template Name: Portfolio
*/ ?>

<?php get_header(); ?>     

   <div class="content">
     <div class="sixteen columns">
		
		<?php if ( of_get_option('slider1') ) { ?>
		<div class="flexslider">
  			<ul class="slides">
						<li>
						<a href="<?php echo of_get_option('sliderlink1', 'no entry'); ?>"><img src="<?php echo of_get_option('slider1'); ?>" alt="" /></a>
						</li>
						<li>
                        <a href="<?php echo of_get_option('sliderlink2', 'no entry'); ?>"><img src="<?php echo of_get_option('slider2'); ?>" alt="" /></a>
                        </li>
                        <li>
                        <a href="<?php echo of_get_option('sliderlink3', 'no entry'); ?>"><img src="<?php echo of_get_option('slider3'); ?>" alt="" /></a>
                        </li>
                        <li>
                        <a href="<?php echo of_get_option('sliderlink4', 'no entry'); ?>"><img src="<?php echo of_get_option('slider4'); ?>" alt="" /></a>
                        </li>
                        <li>
                        <a href="<?php echo of_get_option('sliderlink5', 'no entry'); ?>"><img src="<?php echo of_get_option('slider5'); ?>" alt="" /></a>
                        </li>
                       				
		</div> 
		<?php } ?>




       <div class="homeMessage">
       	<h2 class="hometext sixteen columns">
       	<?php echo of_get_option('example_textarea', 'no entry' ); ?>
       	</h2>
       </div>
       <div class="main"> 

		<?php $loop = new WP_Query( array( 'post_type' => 'projects', 'posts_per_page' => 100 ) ); ?>

		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

       
         <article id="post-<?php the_ID(); ?>" class="postthumb">
         
         	<a href="<?php the_permalink(); ?>">
         	
         	<?php the_post_thumbnail('post-thumb'); ?> 
			</a>
           	<div class="title">            
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<h2><?php the_title(); ?></h2></a>
     			<p><?php echo get_the_term_list( $post->ID, 'tag', '', ', ' ) ?></p>
     		</div>

          </article>

       <?php endwhile;?>

     
     
        </div>  <!-- End Main -->
     </div>  <!-- End two-thirds column -->
   </div><!-- End Content -->
    
     
            
<?php  get_footer(); ?>   
   
                       
           
