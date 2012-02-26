<?php 
/**
 * @package WordPress
 * @subpackage WP-Skeleton
 */


add_action('wp_enqueue_scripts', 'wdm_scripts');
function wdm_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('pretty', get_bloginfo('template_url').'/scripts/jquery.prettyPhoto.js', array('jquery'), '2.5.6', false);
    wp_enqueue_script('flex', get_bloginfo('template_url').'/scripts/jquery.flexslider-min.js', array('jquery'), false);
    wp_enqueue_script('totop', get_bloginfo('template_url').'/scripts/jquery.ui.totop.js', array('jquery'), false);
    wp_enqueue_style('pretty', get_bloginfo('template_url').'/scripts/prettyPhoto.css', false, 'all' );
    wp_enqueue_style('flex', get_bloginfo('template_url').'/scripts/flexslider.css', false, 'all' );
}

// drag and drop menu support
register_nav_menu( 'primary', 'Primary Menu' );


//widget support for a right sidebar
register_sidebar(array(
  'name' => 'Right SideBar',
  'id' => 'right-sidebar',
  'description' => 'Widgets in this area will be shown on the right-hand side.',
  'before_widget' => '<div id="%1$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for the footer
register_sidebar(array(
  'name' => 'Footer SideBar',
  'id' => 'footer-sidebar',
  'description' => 'Widgets in this area will be shown in the footer.',
  'before_widget' => '<div id="%1$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

add_image_size( 'post-thumb', 222, 220, true );


//Apply do_shortcode() to widgets so that shortcodes will be executed in widgets
add_filter('widget_text', 'do_shortcode');


/**
 * MANAGE REMOVING OR ADDING STUFF (aka Function Snippets)
 * comment in or out what you want
 */

// remove stuff,  uncomment to enable
//require_once( get_template_directory() . '/snippets/remove-stuff.php' );

// add stuff
//require_once( get_template_directory() . '/snippets/add-stuff.php' );

if ( !function_exists( 'optionsframework_init' ) ) {

	/*-----------------------------------------------------------------------------------*/
	/* Options Framework Theme
	/*-----------------------------------------------------------------------------------*/

	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
	}

	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>

<?php
}

/* 
 * Turns off the default options panel from Twenty Eleven
 */
 
add_action('after_setup_theme','remove_twentyeleven_options', 100);

function remove_twentyeleven_options() {
	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
}


//////////////////////////////////////////////////////////////
// Custom Post Types and Custom Taxonamies
/////////////////////////////////////////////////////////////

add_action( 'init', 'create_post_types' );

function create_post_types() {
	
	$labels = array(
		'name' => __( 'Projects' ),
		'singular_name' => __( 'Project' ),
		'add_new' => __( 'Add New' ),
		'add_new_item' => __( 'Add New Project' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit Project' ),
		'new_item' => __( 'New Project' ),
		'view' => __( 'View Project' ),
		'view_item' => __( 'View Project' ),
		'search_items' => __( 'Search Projects' ),
		'not_found' => __( 'No projects found' ),
		'not_found_in_trash' => __( 'No projects found in Trash' ),
		'parent' => __( 'Parent Project' ),
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,		
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'thumbnail', 'comments', 'revisions', 'excerpt')
	); 	
	
	register_post_type( 'projects' , $args );
	flush_rewrite_rules( false );
}

add_action( 'init', 'create_taxonomies' );
function create_taxonomies() {
	$labels = array(
    	'name' => __( 'Tags' ),
    	'singular_name' => __( 'Tag' ),
    	'search_items' =>  __( 'Search Tags' ),
    	'all_items' => __( 'All Tags' ),
    	'parent_item' => __( 'Parent Tag' ),
    	'parent_item_colon' => __( 'Parent Tag:' ),
    	'edit_item' => __( 'Edit Tag' ),
    	'update_item' => __( 'Update Tag' ),
    	'add_new_item' => __( 'Add New Tag' ),
    	'new_item_name' => __( 'New Tag Name' )
  	); 	

  	register_taxonomy('tag','projects',array(
    	'hierarchical' => false,
    	'labels' => $labels
  	));
	flush_rewrite_rules( false );
}

// List custom post type taxonomies

function portfolilo_get_terms( $id = '' ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $post_taxonomies = array();
    $post_type = get_post_type( $id );
    $taxonomies = get_object_taxonomies( $post_type , 'names' );

    foreach ( $taxonomies as $taxonomy ) {
      $term_links = array();
      $terms = get_the_terms( $id, $taxonomy );

      if ( is_wp_error( $terms ) )
        return $terms;

      if ( $terms ) {
        foreach ( $terms as $term ) {
          $link = get_term_link( $term, $taxonomy );
          if ( is_wp_error( $link ) )
            return $link;
          $term_links[] = '<li><span><a href="'.$link.'">' . $term->name . '</a></span></li>';
        }
      }

      $term_links = apply_filters( "term_links-$taxonomy" , $term_links );
      $post_terms[$taxonomy] = $term_links;
    }
    return $post_terms;
  } else {
    return false;
  }
}

function portfolilo_get_terms_list( $id = '' , $echo = true ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $my_terms = portfolilo_get_terms( $id );
    if ( $my_terms ) {
      $my_taxonomies = array();
      foreach ( $my_terms as $taxonomy => $terms ) {
        $my_taxonomy = get_taxonomy( $taxonomy );
        if ( !empty( $terms ) ) $my_taxonomies[] = implode( $terms);
      }

      if ( !empty( $my_taxonomies ) ) {
	    $output = "";
        foreach ( $my_taxonomies as $my_taxonomy ) {
          $output .= $my_taxonomy . "\n";
        }        
      }

      if ( $echo )
        echo $output;
      else
        return $output;
    } else {
      return;
    }
  } else {
    return false;
  }
}





//////////////////////////////////////////////////////////////
// Meta Box
/////////////////////////////////////////////////////////////

$prefix = "_portfolilo_";

$project_details = array(
	
		"notes" => array(
    	"type" => "textarea",
		"name" => $prefix."notes",
    	"std" => "",
    	"title" => __('Notes','portfolilo'),
    	"description" => __('Enter a description about the project.','portfolilo')),

);



$portfolio_options = array(	
		"notes" => array(
    	"type" => "textarea",
		"name" => $prefix."page_tags",
    	"std" => "",
    	"title" => __('tags','portfolilo'),
    	"description" => __('For use with the Portfolio page template. <br/><br/>Enter the names of the tags (separated by commas) you want shown on this page. If left blank, all tags will be used.','portfolilo'))
);


$meta_box_groups = array($project_details, $home_feature_options, $page_options, $portfolio_options);

function new_meta_box($post, $metabox) {	
	
	$meta_boxes_inputs = $metabox['args']['inputs'];

	foreach($meta_boxes_inputs as $meta_box) {
	
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		if($meta_box_value == "") $meta_box_value = $meta_box['std'];
		
		echo'<div class="meta-field">';
		
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		
		echo'<p><strong>'.$meta_box['title'].'</strong></p>';
		
		if(isset($meta_box['type']) && $meta_box['type'] == 'checkbox') {
		
			if($meta_box_value == 'true') {
				$checked = "checked=\"checked\"";
			} elseif($meta_box['std'] == "true") {	
					$checked = "checked=\"checked\"";	
			} else {
					$checked = "";
			}
		
			echo'<p class="clearfix"><input type="checkbox" class="meta-radio" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="true" '.$checked.' /> ';		
			echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';		
		
		} elseif(isset($meta_box['type']) && $meta_box['type'] == 'textarea')  {			
			
			echo'<textarea rows="4" style="width:98%" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';			
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
		
		} else {
			
			echo'<input style="width:70%"type="text" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" /><br />';		
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
		
		}
		
		echo'</div>';
		
	} // end foreach
		
	echo'<br style="clear:both" />';
	
} // end meta boxes

function create_meta_box() {	
	global $project_details, $home_feature_options, $page_options, $portfolio_options;	
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-boxes-details', __('Project Details','portfolilo'), 'new_meta_box', 'projects', 'normal', 'high', array('inputs'=>$project_details) );		
		add_meta_box( 'new-meta-boxes-portfolio-options', __('Portfolio Options','portfolilo'), 'new_meta_box', 'page', 'side', 'low', array('inputs'=>$portfolio_options) );		
	}
}



function save_postdata( $post_id ) {
global $post, $new_meta_boxes, $meta_box_groups;

if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
	return $post_id;
}

if( defined('DOING_AJAX') && DOING_AJAX ) { //Prevents the metaboxes from being overwritten while quick editing.
	return $post_id;
}

if( ereg('/\edit\.php', $_SERVER['REQUEST_URI']) ) { //Detects if the save action is coming from a quick edit/batch edit.
	return $post_id;
}

foreach($meta_box_groups as $group) {
	foreach($group as $meta_box) {

		// Verify
		if(isset($_POST[$meta_box['name'].'_noncename'])){
			if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
				return $post_id;
			}
		}

		if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
				return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ))
				return $post_id;
		}

		$data = "";
		if(isset($_POST[$meta_box['name'].'_value'])){
			$data = $_POST[$meta_box['name'].'_value'];
		}


		if(get_post_meta($post_id, $meta_box['name'].'_value') == "") 
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
		elseif($data == "" || $data == $meta_box['std'] )
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	
		} // end foreach
	} // end foreach
} // end save_postdata

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

function new_excerpt_more($more) {
       global $post;
	return ' … <a href="'. get_permalink($post->ID) . '" class="readmore">Read the Rest</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

?>