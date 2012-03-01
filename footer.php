<?php
/**
 * @package WordPress
 * @subpackage WP-Skeleton
 */
?>


	
	
  <div class="clear"></div>
    <div class="footer sixteen columns">
       <hr />
          <div class="sixteen columns alpha">
                 <p> &copy; <?php the_time('Y'); ?> <a href="#"><?php echo get_bloginfo('name');?></a>. Powered by WordPress and the <a href="http://portfolilo.philipp-seiffert.com">Portfolilo Theme</a>.</p> 
          </div>
    </div>
            
</div>                                            
<?php wp_footer(); ?>

<script type="text/javascript" charset="utf-8">
  jQuery(window).load(function() {
    jQuery('.flexslider').flexslider({
     	animation: "fade",   //String: Select the sliding direction, "horizontal" or "vertical" 
		slideshow: true,                //Boolean: Animate slider automatically
		slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
		directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
		controlNav: true,               
		keyboardNav: true,   
  });
});
</script>


<script type="text/javascript">  
jQuery(document).ready(function($) {
   $("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
	animationSpeed: 'normal', /* fast/slow/normal */
	padding: 0, /* padding for each side of the picture */
    opacity: 0.55, /* Value betwee 0 and 1 */
	showTitle: true, /* true/false */	
	theme: 'light_square',		
	show_title: false /* true/false */
	});
})
</script>


<script type="text/javascript">
		jQuery(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'moccaUItoTop', // fading element id
				containerHoverClass: 'moccaUIhover', // fading element hover class
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			jQuery().UItoTop({ easingType: 'linear', scrollSpeed: 500 });
			
		});
	</script>
	
<script type="text/javascript">
		
			jQuery(".title").click(function(){
    		 window.location=jQuery(this).find("a").attr("href");
     		return false;
			});
			

	</script>
</body>
</html>