<?php
/**
 * @package WordPress
 * @subpackage WP-Skeleton
 */
?>
     <div class="five columns offset-by-one">
          <div class="sidebar"> <!--  the Sidebar -->
              
               <?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?> <?php dynamic_sidebar( 'right-sidebar' ); ?>
                   <?php else : ?><p>You need to drag a widget into your sidebar in the WordPress Admin</p>
	       <?php endif; ?>
                            
          </div>
     </div>
