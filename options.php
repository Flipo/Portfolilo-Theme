<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
		
	$options = array();
		
	$options[] = array( "name" => "Basic Settings",
						"type" => "heading");
						
							
	$options[] = array( "name" =>  "Set Background",
						"desc" => "Here you can change the background of your site. Set a simple color or upload an image.",
						"id" => "example_background",
						"std" => $background_defaults, 
						"type" => "background");
						
	$options[] = array( "name" => "Favicon Upload",
						"desc" => "Here you can upload your Favicon. Image should be 16x16px and .PNG or .ICO.",
						"id" => "example_uploader",
						"type" => "upload");

	$options[] = array( "name" => "Logo Upload",
						"desc" => "Upload your Logo. Image width must be 280px, Height should be around 65px.",
						"id" => "logoupload",
						"type" => "upload");		
								
	$options[] = array( "name" => "Link Hover Color",
						"desc" => "Here you can set the Link Hover Color.",
						"id" => "example_colorpicker",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Homepage Message",
						"desc" => "Here you can set a Welcome Message for your Portfolio Page.",
						"id" => "example_textarea",
						"std" => "Enter Message here",
						"type" => "textarea"); 
	
	$options[] = array( "name" => "Message Box Color",
						"desc" => "Set the color for the Message Box Background. No color set = transparent",
						"id" => "boxbackground",
						"std" => "#F8F8F8",
						"type" => "color");
						
						
	$options[] = array( "name" => "Insert Google Analytics Tracking-ID",
						"desc" => "Enter your unique Tracking-ID which looks like UA-XXXXXXXX-X",
						"id" => "goggle",
						"std" => "UA-XXXXXXXX-X",
						"class" => "mini",
						"type" => "text");
	
	
	$options[] = array( "name" => "Homepage Slider",
						"type" => "heading");
					
	
	$options[] = array( "name" => "Slider Image 1",
						"desc" => "Upload an image for the homepage slideshow. Image should be 940px wide and all images should have the same height.",
						"id" => "slider1",
						"type" => "upload");
	
	$options[] = array( "name" => "Slider Image 1 Link",
						"desc" => "Enter the Link the first Slider Image should link to on click.",
						"id" => "sliderlink1",
						"type" => "text");
	
	
	$options[] = array( "name" => "Slider Image 2",
						"desc" => "Upload an image for the homepage slideshow. Image should be 940px wide and all images should have the same height.",
						"id" => "slider2",
						"type" => "upload");
	
	$options[] = array( "name" => "Slider Image 2 Link",
						"desc" => "Enter the Link the second Slider Image should link to on click.",
						"id" => "sliderlink2",
						"type" => "text");
	
	$options[] = array( "name" => "Slider Image 3",
						"desc" => "Upload an image for the homepage slideshow. Image should be 940px wide and all images should have the same height.",
						"id" => "slider3",
						"type" => "upload");
	
	$options[] = array( "name" => "Slider Image 3 Link",
						"desc" => "Enter the Link the third Slider Image should link to on click.",
						"id" => "sliderlink3",
						"type" => "text");
											
	$options[] = array( "name" => "Slider Image 4",
						"desc" => "Upload an image for the homepage slideshow. Image should be 940px wide and all images should have the same height.",
						"id" => "slider4",
						"type" => "upload");
						
	$options[] = array( "name" => "Slider Image 4 Link",
						"desc" => "Enter the Link the fourth Slider Image should link to on click.",
						"id" => "sliderlink4",
						"type" => "text");
	
	$options[] = array( "name" => "Slider Image 5",
						"desc" => "Upload an image for the homepage slideshow. Image should be 940px wide and all images should have the same height.",
						"id" => "slider5",
						"type" => "upload");
	
	$options[] = array( "name" => "Slider Image 5 Link",
						"desc" => "Enter the Link the fifth Slider Image should link to on click.",
						"id" => "sliderlink5",
						"type" => "text");
						
			
	return $options;
}