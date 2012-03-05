<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
    
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
        
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if gte IE 9 ]><html class="no-js ie9" lang="en"> <![endif]-->
    
    <title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>
        
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->

	<link rel="stylesheet" href= "<?php echo get_template_directory_uri(); ?>/style.css">
	

	<style>
	
		body {
				 <?php $background = of_get_option('example_background');
                        if ($background) {
                            if ($background['image']) {
                                echo 'background:url('.$background['image'].') '; } 
                             else {
                                echo 'background:'.$background['color'].'';
                            }	
                        } else {
                            echo "no entry";
                        }; ?>
		}
		
		a:hover, a:focus, .current-menu-item a, .blogmeta a:hover {color:  <?php echo of_get_option('example_colorpicker', 'no entry' ); ?> }	
		
		.current-menu-item a, .menu ul a:hover {border-bottom: 3px solid <?php echo of_get_option('example_colorpicker', 'no entry' ); ?>}
		
		.homeMessage {background: <?php echo of_get_option('boxbackground', 'no entry' ); ?>; }
		
	</style>


	<!-- Favicons
	================================================== -->
   <link rel="shortcut icon"  href="<?php echo of_get_option('example_uploader'); ?>" />
                       
	
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png">

	<!-- Javascript
	================================================== -->
	
	<script type="text/javascript">

 	 var _gaq = _gaq || [];
 	 _gaq.push(['_setAccount', '<?php echo of_get_option('goggle'); ?>']);
 	 _gaq.push(['_trackPageview']);

 	 (function() {
 	   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  	  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  	  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
</script>


<?php wp_head(); ?>        
</head>

<body <?php body_class(); ?>><!-- the Body  -->

 <div class="container">

  <div class="header sixteen columns clearfix">  
    
     <div class="five columns alpha"> 
         <div class="logo">
            <a href="<?php echo home_url(); //make logo a home link?>">
            <img src="<?php echo of_get_option('logoupload'); ?>" alt="<?php echo get_bloginfo('name');?>"
            title="<?php echo get_bloginfo('name');?>">
            </a>
         </div>
     </div> 
    
     <div class="eleven columns omega"> 
         <div class="menu offset-by-five"> <!--  the Menu -->
          <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
         </div>
     </div>
    
   </div> 
   <hr class="sixteen columns"><!--  End blog header -->
   
                 
    
 