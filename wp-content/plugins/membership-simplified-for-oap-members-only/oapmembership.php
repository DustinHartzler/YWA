<?php
/* 
Plugin Name: Membership Simplified
Plugin URI: http://membership.officeautopilot.com
Description: Membership Simplified allows you to generate membership lessons with templated content to create a unified look and feel throughout your courses. It also provides the inner workings such as navigation options, a login widget, and tinymce buttons to use when protecting any post or page content. Additionally, it sits on top of PilotPress, thus allowing you to use videos from the video manager, downloadable files from the file manager, and much more. Super easy to setup and manage! (Requires an OfficeAutopilot account and PilotPress installed)
Author: William.DeAngelis, ONTRAPORT
Version: Beta 1.57
Release date: 12/30/2014
Author URI: http://membership.officeautopilot.com
*/

/*************** Admin function ***************/ 
require_once('functions.php');

/*************** file icon function ***************/ 
require_once('FileIcon.inc.php');

/**
 * Function to Create the table
 * @return download listing table
 */

function oap_plugin_create_table()
{
	global $wpdb;
	$table_name = $wpdb->prefix . "download_listing";
	$table2_name = $wpdb->prefix . "media_listing";

	if ($wpdb->get_var("show tables like '$table_name'") != $table_name) 
	{
		$sql = "CREATE TABLE IF NOT EXISTS $table_name 
	      ( recordID int(11) NOT NULL AUTO_INCREMENT,
	      	postID int(11) NOT NULL, 
	        recordListingID int(11) NOT NULL, 
	        recordText varchar(100) NOT NULL,
	        fileType varchar(100) NOT NULL,
	        fileName varchar(255)   NOT NULL,  
	        PRIMARY KEY (recordID) );"; 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$wpdb->query($sql);
	}
	else
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$wpdb->query( "ALTER TABLE " . $wpdb->prefix . "download_listing ADD COLUMN fileType varchar(100) NOT NULL AFTER recordText" );
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '$table2_name'") != $table2_name) 
	{
		$sql2 = "CREATE TABLE IF NOT EXISTS $table2_name 
	      ( recordID int(11) NOT NULL AUTO_INCREMENT,
	      	postID int(11) NOT NULL, 
	        recordListingID int(11) NOT NULL, 
	        recordText varchar(100) NOT NULL,
	        fileName varchar(255)   NOT NULL,  
	        PRIMARY KEY (recordID) );"; 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$wpdb->query($sql2);
	}
	else
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$wpdb->query( "ALTER TABLE " . $wpdb->prefix . "media_listing change fileName fileName VARCHAR(255)" );
	}
}

// This hook will cause our creation function to run when the plugin is activated
register_activation_hook( __FILE__, 'oap_plugin_create_table' );

// To enable plugin by default on plugin Activation
add_action('init', 'enable_plugin_default');
register_activation_hook( __FILE__, 'enable_plugin_default' );


function enable_plugin_default()
{
	global $wpdb;
	if (get_option("oapmp_enable_or_disable")=="")
	{
		add_option('oapmp_enable_or_disable','Enabled','', 'yes');
	}
}

/**
 * Check whether single page exists and also the name of the theme
 * @return single-oaplesson.php in the current themes folder.
 * @return also adds support for certain themes by adding different sets of code depending upon the theme
 * Chec
 */

$abspath = get_template_directory(); 
$plugpath = plugin_dir_path(__FILE__);
$filename = $abspath.'/single-oaplesson.php';
$theme_namee = get_current_theme();

if (is_writable($abspath))
{
	if ((!file_exists($filename)) && ($theme_namee != 'OptimizePress')) 
	{
		copy("{$plugpath}/single-oaplesson.php", $filename);
	} 
	else if ($theme_namee == 'OptimizePress') 
	{
		copy("{$plugpath}/single-optlesson.php", $filename);
	} 
	else if ($theme_namee == 'Thesis') 
	{
		copy("{$plugpath}/single-thesis.php", $filename);
	} 
	else 
	{
		//do nothing
	}
}
else
{
	echo 'Sorry... your server will not let us create the new template file necessary to display membership lessons. Please change the permissions for this plugin\'s directory to allow writing.';
}
	
					
/**
 * Import Admin settings 12/24/2011
 * @return inludes oap import admin settings
 */
function oap_admin() 
{
	include('oap_import_admin.php');
}


/**
 * Adds Settings Submenu to Membership Content Main Admin Menu item
 * Author: William DeAngelis (william@sendpepper.com)
 */
function oap_admin_actions() 
{
	add_submenu_page( 'edit.php?post_type=oaplesson', 'OAP Membership Setting', 'Settings', 1, 'manage_oap_options', 'oap_admin');
}
add_action('admin_menu', 'oap_admin_actions');	

 /**
 * Register Oap-post type
 * @return lesson post type
 */
add_theme_support('post-thumbnails');
add_action('init', 'oaplesson_register');


function oaplesson_register()
{
	$labels = array(
	'name' => _x('Membership Lessons', 'post type general name'),
	'singular_name' => _x('Item', 'post type singular name'),
	'add_new' => _x('Add New Lesson', 'Item'),
	'add_new_item' => __('Add New Lesson'),
	'edit_item' => __('Edit this Lesson'),
	'new_item' => __('New Lesson'),
	'all_items' => __('All Lessons'),
	'view_item' => __('View this Lesson'),
	'search_items' => __('Search Lessons'),
	'not_found' =>  __('Lesson not found'),
	'not_found_in_trash' => __('Lesson not found in Trash'), 
	'parent_item_colon' => '',
	'menu_name' => 'Membership Content'
	);
  	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'm'),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments','OAP Membership Settings'),
		'taxonomies'=>array('mprogram')
	);
	register_post_type('oaplesson',$args);
}


/*
 * Add Submenu Help Item
 * Author: William DeAngelis
 * Author @: william@sendpepper.com
 */
add_action('admin_menu', 'register_mc_help');
function register_mc_help() 
{
	add_submenu_page( 'edit.php?post_type=oaplesson' , 'Help' , 'Help' , 'manage_options' , 'mc-help' , 'mc_help' );
}
function mc_help() 
{
	include('mc_help.php');
}

	
/*
*Function Name: homeRightContent
*Returns: home page right contents
*/
class oap_lesson_widget extends WP_Widget
{
	function __construct() 
	{
		parent::__construct(
			'oap_lesson_widget', // Base ID
			__('Membership Lesson Sidebar', 'lesson_sidebar'), // Name
			array( 'description' => __( 'A Membership Lesson Sidebar', 'lesson_sidebar' ), ) // Args
		);
	}

	function widget($args = false, $instance = false)
	{
		wp_reset_query(); 
		global $post,$pilotpress; ?>
		
		<script>		
		jQuery(document).ready(function() 
		{
			// Manages adjustable layouts depending upon the width of the containing div
			var $sidebarwidth = jQuery('#oapsidebar .overview').width();

			if ($sidebarwidth < 290)
			{
				jQuery('.oap-smallimage-sidebar').width('100%');
				jQuery('.viewport .oapmenutitle').width('100%');
			}

			// Manages the scrollbar / height depending upon 
			var viewportheight = jQuery('#oapsidebar .viewport').height();
			var contentheight = jQuery('.oap-post').height();

			if (viewportheight > contentheight && contentheight > 100 )
			{
				jQuery('#oapsidebar .viewport').height(contentheight);
				jQuery('#oapsidebar .viewport').mouseover(function()
				{
					jQuery(this).css('overflow-y', 'scroll');
					jQuery(this).css('overflow-x', 'hidden');
				});
				jQuery('#oapsidebar .viewport').mouseout(function()
				{
					jQuery(this).css('overflow-y', 'hidden');
					jQuery(this).css('overflow-x', 'hidden');
				});
			}
			else
			{
				if (contentheight < 100)
				{
					contentheight = 280;
				}
				jQuery('#oapsidebar .viewport').height(contentheight);
				jQuery('#oapsidebar .viewport').mouseover(function()
				{
					jQuery(this).css('overflow-y', 'scroll');
					jQuery(this).css('overflow-x', 'hidden');
				});
				jQuery('#oapsidebar .viewport').mouseout(function()
				{
					jQuery(this).css('overflow-y', 'hidden');
					jQuery(this).css('overflow-x', 'hidden');
				});
			}
		});
		</script>
		
		<div id="oapsidebar">
			<div class="viewport <?php if (get_post_type( $post->ID ) != 'oaplesson') { echo 'reg-sidebar-widget'; } ?>" id="viewportA">
				<div class="overview entry-content" >
					<ul>
						<?php
						$post_sidebar=0;
						if (get_post_type( $post->ID ) != 'oaplesson')
						{
							$selected_categoryID_for_sidebar= get_option('oap_select_cat');
						} 
						else 
						{
							if (get_option("oapmp_lesson_menu_category_load")=="on")
							{ 
								$selected_categoryID_for_sidebar = get_option("oapmp_lesson_menu_category");
							} 
							else 
							{ 
								$selected_categoryID_for_sidebar = get_post_meta($post->ID, '_oap_lesson_menu_category', true );
							}
						}
						$args=array(
						    'post_type' => 'oaplesson',
						    'post_status' => 'publish',
						    'posts_per_page' => -1,
						    'tax_query' => array(
									 array(
										'taxonomy' => 'mprogram',
										'terms' => $selected_categoryID_for_sidebar
										)
									 ),
						    'orderby'=>'menu_order',
						    'order'=>'asc'
						    );
						query_posts($args);
						if ( have_posts() ) while ( have_posts() ) : the_post(); 

						$post_sidebar++;
						
						//Determine if they have the PP if they do check if they have the right permission
						if (class_exists("PilotPress") && is_object($pilotpress)) 
						{
							//plugin is activated
							if (!$pilotpress->is_viewable($post->ID))
							{
								continue;
							}
						}

						if (get_post_meta($post->ID,'lesson_menu_order', true) == "") 
						{ 
							update_post_meta($post->ID, 'lesson_menu_order', $post_sidebar); 
						}
						
						$meta = get_post_meta($post->ID, _oap_overview_image, true);
						$imgpath=plugins_url()."/membership-simplified-for-oap-members-only/images/noimg.png"; ?>
						<li>
							<?php 
							if (get_option('oapmp_membership_menu_image')!='Disabled')
							{ ?>
								<div class="oap-smallimage-sidebar">
									<?php 
									if ($meta != '') 
									{ ?>
										<a href="<?php the_permalink(); ?>">
											<?php echo wp_get_attachment_image( $meta, array(120,120), true); ?>
										</a>
									<?php 
									} 
									else 
									{ 
										echo '<img src="'.$imgpath.'"/>'; 
									} ?>
								</div>
							<?php 
							} ?>
						
							<div class="box oapmenutitle">
								<h2>
									<a href="<?php the_permalink() ;?>"><?php the_title(); ?></a>
								</h2>
								<h6 class="typetitle" <?php if (get_option('oapmp_lesson_number_setting')=='Disabled' && get_option('oapmp_lesson_number_setting_load')=='on'){ echo 'style="display:none;"'; }?>>
									<a href="<?php echo get_permalink(); ?>" class="lessoncolor"><?php if (get_post_meta($post->ID,'type', true) != ""){ echo rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s"); } else { echo "Lesson ";  } ?><?php echo $post->menu_order; // echo get_post_meta($post->ID,'lesson_menu_order', true);// $post->menu_order+1; ?></a>
								</h6>
								<p>
									<?php echo limit_words(get_post_meta( $post->ID, '_oap_overview_text', true ),30); ?>
								</p>
							</div>
						</li>
						<?php endwhile; wp_reset_query(); // end of the loop. ?>
					</ul>
				</div>
			</div>
		</div>

	<?php  
	} //End Function right content

	public function form($instance)
	{
		$data = get_option('oap_menu_category');
		$oap_selected= $data['oap_widgetcat_option'];
		?>
		<p><label>Please select the content you would like to display </label></p>
		<?php wp_dropdown_categories("show_option_none=Please Select&show_option_all=Display All&id=oap_select_widget&name=oap_select_widget&hide_empty=0&title_li=&taxonomy=mprogram&selected=$oap_selected");

	     if (isset($_POST['oap_select_widget'])){
		$data['oap_widgetcat_option'] = attribute_escape($_POST['oap_select_widget']);
		update_option('oap_menu_category', $data);
		}
	}

	public function update( $new_instance, $old_instance ) 
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} //end class


function widget_homeRightContent($args) 
{
	extract($args);
	echo $before_widget;
	echo $before_title;
	echo $after_title;
	widget();
	echo $after_widget;
}

	
function homeRightContent_init()
{
	register_sidebar_widget(__('OAP Membership Menu Items'), array('oap_lesson_widget','widget'));
	register_widget_control('OAP Membership Menu Items', array('oap_lesson_widget', 'form'));
}
	
//add_action("plugins_loaded", "homeRightContent_init");
add_shortcode( 'oaphomerightcontent', 'widget' );


/**
 * Multiinstance Menues class
  * @returns sidebar Menu List
 */
class WP_Widget_Oap extends WP_Widget 
{
	function __construct() 
	{
		parent::__construct(
			'widget_categories_oap', // Base ID
			__('Membership Lessons', 'oap_lesson_sidebar'), // Name
			array( 'description' => __( 'A scrolling sidebar menu for all of the lessons in the program of your choice.', 'oap_lesson_sidebar' ), ) // Args
		);
	}
		
	function widget( $args, $instance ) 
	{
		extract( $args );
		$title = $instance['title'];
		// $title = apply_filters('oap_select_cat', empty( $instance['oap_select_cat'] ) ? __( 'Categories' ) : $instance['oap_select_cat'], $instance, $this->id_base);
		//$before_widget='<div class="oap-lesson-widget widget">';
		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;
		oap_lesson_widget::widget();
		//$after_widget='</div>';
		echo $after_widget;
	}
		
	function update( $new_instance, $old_instance ) 
	{
		update_option('oap_select_cat', $_REQUEST['oap_select_cat']);
		update_option('oap_height_widget', $_REQUEST['oap_height_widget']);
		$instance = $old_instance;
		$instance['title'] =  $new_instance['title'] ;
		$instance['oap_select_cat'] = strip_tags($new_instance['oap_select_cat']);
		return $instance;
	}
	
	function form( $instance ) 
	{
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'oap_select_cat' => '') );
		$title = esc_attr( $instance['oap_select_cat'] ); ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
		<textarea id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" style="width:100%;"><?php echo $instance['title']; ?></textarea>
		<label for="<?php // echo $this->get_field_id('title'); ?>"><?php _e( 'Please select the program for the lesson menu items you would like to display:' ); ?></label>
		<?php $oap_selected =  get_option('oap_select_cat'); //echo $this->get_field_id('oap_select_cat');
		$oap_widget_height =  get_option('oap_height_widget');
		if ( $oap_widget_height == null ) {
			$oap_widget_height = '250';
		}
		if ( strpos($oap_widget_height, 'px') === false ) {
			$oap_widget_height = $oap_widget_height . 'px';
		}
		
		wp_dropdown_categories("show_option_none=Please Select&id=oap_select_cat&name=oap_select_cat&hide_empty=0&title_li=&taxonomy=mprogram&selected=".$oap_selected);
		echo "<p>Height: (In Px) <input type='text' name='oap_height_widget' id='oap_height_widget' value='".$oap_widget_height ."'/></p>";
	}
} //end class


function wp_oap_widgets_init() 
{
	register_widget('WP_Widget_Oap');
}
add_action('init', 'wp_oap_widgets_init', 1);


//Multiinstance Menues ends
/*
 * Function to get all posts on homepage
 * Altered to return the results instead of echo
 * @Returns Template 1 Contents
 * @author Unknown, Altered by Pin Chen <pin@sendpepper.com>
 *
*/

function oapHomeAllContent($atts)
{
	global $post,$pilotpress;
	extract(shortcode_atts(array( "cat" => '',"pref_template" => '',"type" => '' ), $atts));
	$returnBuffer = '<div id="oap-main"><h4>';
	$returnBuffer .= $type;
	$returnBuffer .= '</h4>';
	$returnBuffer .= <<<DATA
<div id="pic"><ul>

DATA;

	// $square_order=0;
	remove_action( 'pre_get_posts', 'et_custom_posts_per_page' ); //camaleon Fix    
	$action = get_permalink($post->ID);
	$paged = $_REQUEST['paged'] ? $_REQUEST['paged'] : 1;
	$per_page = $_REQUEST['oaplessoncount'] ? $_REQUEST['oaplessoncount'] : 20; 

	/* $args= array(
	    'post_type'=>'oaplesson',
		'posts_per_page'=>$per_page,
			'cat'=>$cat,
			'paged' => $paged,
			'orderby'=>'menu_order',
			'order'=>'asc',
	); */
	$args=array(
		'post_type' => 'oaplesson',
		'post_status' => 'publish',
		'posts_per_page'=>$per_page,
		'paged' => $paged,
		'tax_query' => array(
					array(
					 	'taxonomy' => 'mprogram',
					 	'terms' => $cat
					)
				),
		'orderby'=>'menu_order',
		'order'=>'asc'
	);
	query_posts($args);

	if ( have_posts() ) while ( have_posts() )
	{
		the_post();
		// $square_order++;
		//Determine if they have the PP if they do check if they have the right permission
		if (class_exists("PilotPress") && is_object($pilotpress)) 
		{
			//plugin is activated
			if (!$pilotpress->is_viewable($post->ID))
			{
				continue;
			}
		}
		update_post_meta($post->ID, 'type', $type);
		
		/* if (get_post_meta($post->ID,'lesson_menu_order', true) == "") {
			update_post_meta($post->ID, 'lesson_menu_order', $square_order); 
		} */
		$returnBuffer .= '<li>';
		$meta = get_post_meta($post->ID, _oap_overview_image, true);
		
		if (get_option('oapmp_membership_menu_image  ')!='Disabled')
		{
			$returnBuffer .= '<div class="oap-picture">';
			if ($meta != "")
			{
				$returnBuffer .= '<a href="' . get_permalink() . '">'.wp_get_attachment_image( $meta, 'medium', true).'</a>'; 
			}
			else
			{
				$imgpath=plugins_url()."/membership-simplified-for-oap-members-only/images/noimg.png";
				$returnBuffer .= '<img src="'.$imgpath.'"/>';
			}
			$returnBuffer .= '</div>';
		}
	         	$returnBuffer .= '<div class="txt"><div class="oaptitlediv"><h2>';
	         	$returnBuffer .= '<a href="'. get_permalink() .'" class="oapposttitle"> ' . get_the_title() . '</a></h2></div>';
		$returnBuffer .= '<div class="oapLessonNumber"> <h6 class="mpctitle"><a href="' . get_permalink() . '" class="lessoncolor">';
		$returnBuffer .= rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s");
		$returnBuffer .= '&nbsp;';
		$returnBuffer .= $post->menu_order;;
		$returnBuffer .= '</a></h6></div>';
		
		if (get_option('oapmp_membership_content_length')=='Enabled')
		{
			$returnBuffer .= '<div class="oapLessonLength">  <span>  ' . get_post_meta( $post->ID, '_oap_wywtl_length', true ) . '</span></div>';
		}

		$returnBuffer .= '<div class="oapLessonText">';
		$returnBuffer .= limit_words(get_post_meta( $post->ID, '_oap_overview_text', true ),40);
		$returnBuffer .= '</div></div></li>';
	} // end of the loop.
		
		$returnBuffer .= '</ul></div><div class="oaplessonnumber"><form action="' . $action . '" method="post">';
		$oap_cpt = wp_count_posts('oaplesson');
		$oap_cpt_publish = $oap_cpt->publish;
		$returnBuffer .= '<select name="oaplessoncount" id="oaplessoncount" onchange="this.form.submit();">';
		$value=  $_REQUEST['oaplessoncount'] ? $_REQUEST['oaplessoncount'] : 20;
		
		for($i=20;$i<=40;$i=$i+20)
		{
			if ($i==$value)
			{
				$selected='selected=selected';
			} 
			else 
			{
				$selected='';
			}
			$returnBuffer .= '<option value="' .  $i  . '"' . $selected  . '>' .  $i . '</option>';
		}
		if ($oap_cpt_publish==$_REQUEST['oaplessoncount'])
		{
			$selected='selected=selected';
		} 
		else 
		{
			$selected='';
		}
		$returnBuffer .= '<option value="' . $oap_cpt_publish . '" ' . $selected . '>All</option></select>&nbsp;Items Displayed</form> </div><div class="oappaginate">';
		if (function_exists('wp_paginate')) 
		{
			ob_start();
			wp_paginate();
			$returnBuffer .= ob_get_clean();
		}
		wp_reset_query(); 
		$returnBuffer .= '</div></div>';
		return $returnBuffer;
} //End Function
add_shortcode( 'oaphomeallcontent', 'oapHomeAllContent' );

/*
 * Function to get all Details posts
 * Altered to return the results instead of echo
 * @Returns Rectangles Content
 * @author Unknown, Altered by Pin Chen <pin@sendpepper.com>
 *  */
function oapAllContentDetail($atts){ 
	global $post,$pilotpress; 
	extract(shortcode_atts(array( "cat" => '',"pref_template" => '',"type" => '' ), $atts)); 
	$returnBuffer = <<<DATA
	<div id="oap-content">
DATA;
	$returnBuffer .= "<div id='oap-main'><h4>";
	$returnBuffer .= $type;
	$returnBuffer .= '</h4>';
	$returnBuffer .= <<<DATA
	<div id="slide"><ul>
DATA;
	// $rec_order=0;

	remove_action( 'pre_get_posts', 'et_custom_posts_per_page' ); //cemeleon Fix  
	wp_reset_query();    
	$action = get_permalink($post->ID);
	$paged = $_REQUEST['paged'] ? $_REQUEST['paged'] : 1;
	$per_page = $_POST['oaplessoncount'] ? $_POST['oaplessoncount'] : 20; 
	/* $args= array(
	    'post_type'=>'oaplesson',
			'posts_per_page'=>$per_page,
			'cat'=>$cat,
			'paged' => $paged,
			'orderby'=>'menu_order',
			'order'=>'asc'
	); */
	 $args=array(
		     'post_type' => 'oaplesson',
		     'post_status' => 'publish',
		     'posts_per_page'=>$per_page,
		     'paged' => $paged,
		     'tax_query' => array(
					  array(
						 'taxonomy' => 'mprogram',
						 'terms' => $cat
						 )
					  ),
		     'orderby'=>'menu_order',
		     'order'=>'asc'
);
	query_posts($args);
	if ( have_posts() ) 
	while ( have_posts() ){
		the_post(); 
		// $rec_order++;	
		//Determine if they have the PP if they do check if they have the right permission
		if (class_exists("PilotPress") && is_object($pilotpress)) {
			//plugin is activated
			if (!$pilotpress->is_viewable($post->ID)){
				continue;
			}
		}
		
		update_post_meta($post->ID, 'type', $type);
		/* if (get_post_meta($post->ID,'lesson_menu_order', true) == "") {
			update_post_meta($post->ID, 'lesson_menu_order', $rec_order);
		}
		*/

		$returnBuffer .= '<li class="overviewlistitems"><div class="overviewlistitems">';
		$meta = get_post_meta($post->ID, _oap_overview_image, true);
		if (get_option('oapmp_membership_menu_image')!='Disabled'){
			$returnBuffer .= '<div class="oap-smallimage">';
			if ($meta != ""){
				$returnBuffer .= '<a href="' . get_permalink() . '">'.wp_get_attachment_image( $meta, 'medium', true).'</a>';
			}
			else {
				$imgpath=plugins_url()."/membership-simplified-for-oap-members-only/images/noimg.png";
				$returnBuffer .= '<img src="'.$imgpath.'"/>';
			}
			$returnBuffer .= '</div>';
		}
		
		$returnBuffer .= '<div class="mainbox entry-content"><div class="overviewtitles"><h2><a href="' . get_permalink() . '" class="oapposttitle"> ' . get_the_title() . '</a></h2></div>
		<div class="lessonnumber"><h6 class="mpctitle"><a href="' . get_permalink() . '" class="lessoncolor">';
		$returnBuffer .= rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s");
		$returnBuffer .= " "; 
		$returnBuffer .= $post->menu_order;
		$returnBuffer .= '</a></h6></div> 
		<div class="overviewtext"><span class="overviewtextp">';
		
		if (get_option('oapmp_membership_content_length')=='Enabled'){
			$returnBuffer .= get_post_meta( $post->ID, '_oap_wywtl_length', true ); 
		}
		$returnBuffer .= '</span>';
		$returnBuffer .= limit_words(get_post_meta( $post->ID, '_oap_overview_text', true ),40);
		$returnBuffer .= '</div></div></div></li>';
	}
	$returnBuffer .= '</ul> </div><div class="oaplessonnumber">';
	$returnBuffer .= '<form method="post" action="' . $action . '">';
	$oap_cpt = wp_count_posts('oaplesson'); 
	$oap_cpt_publish = $oap_cpt->publish;
	$returnBuffer .= '<select name="oaplessoncount" id="oaplessoncount" onchange="this.form.submit();">';
	$value=  $_POST['oaplessoncount'] ? $_POST['oaplessoncount'] : 20;
	
	for($i=20;$i<=40;$i=$i+20){
		if ($i==$value){
			$selected='selected=selected';
		} else {
			$selected='';
		}
		$returnBuffer .= '<option value="' . $i . '"' . $selected . '>' .  $i . '</option>';
	}
	
	if ($oap_cpt_publish==$_POST['oaplessoncount']){
			$selected='selected=selected';
	} else {
		$selected='';
	}
	
	$returnBuffer .= '<option value="' . $oap_cpt_publish .'"' . $selected . '>All</option></select>&nbsp;  Items Displayed</form></div><div class="oappaginate">';
	
	if (function_exists('wp_paginate')) {
		ob_start();
		wp_paginate();
		$returnBuffer .= ob_get_clean();
	}
	wp_reset_query();
	$returnBuffer .= '</div></div></div>';
	return $returnBuffer;

} //function Ends all contnt Details 
add_shortcode( 'oapallcontentdetail', 'oapAllContentDetail' );


/**
@brief oapcontent() is a function that returns overview content in one of two templates

##Overview

After checking to make sure the plugin and pilotpress are both activated and properly setup, this function checks the users preferred template for displaying lesson overview content. It gets loaded by

~~~{.php}
add_shortcode( 'oapcontent', 'oapcontent' );
~~~

@warning This function returns one of two templates to display lesson overview content
@param $atts string This string passes the users desired template setting to the function
@return array An assortment of other functions mixed up with html (I know... not the best)
@author William DeAngelis <william@ontraport.com>
 */
function oapcontent($atts)
{
	global $post;
	if (get_option('oapmp_enable_or_disable')=='Enabled' && class_exists("PilotPress")){
		if ($atts['pref_template']=='Rectangles'){
			return oapAllContentDetail($atts);
		} else {
			return oapHomeAllContent($atts);
		}
	}
}
add_shortcode( 'oapcontent', 'oapcontent' );


/* Function For Single Page with Media Template
 **@return Single page Media Template 
 */
function oapSingleMedia() 
{
	wp_reset_query();
	global $post; ?>
	
	<script>
	jQuery(document).ready(function()
	{
		var fullmedia=jQuery('#fullmedia').val();
		if (fullmedia == "420px")
		{
			jQuery('#container-5 div a').css('height','');
			jQuery('#container-5 div a').css("height",fullmedia);
			//jQuery('#container-5 div a IMG:first').css('height','');
			//jQuery('#container-5 div a IMG:first').css("height",fullmedia);
			jQuery('#container-5 div a IMG:last').css("left","42%");
			jQuery('#container-5 div a IMG:last').css("top","46%");
			jQuery('#container-5 div a IMG').css("text-align","center");
			jQuery('#container-5 div object').removeAttr("width");
			jQuery('#container-5 div object').removeAttr("height");
			jQuery('#container-5 div embed').removeAttr("width");
			jQuery('#container-5 div embed').removeAttr("height");
			jQuery('#container-5 div object').attr("width","100%");
			jQuery('#container-5 div object').attr("height","420");
			jQuery('#container-5 div embed').attr("width","100%");
			jQuery('#container-5 div embed').attr("height","420");
			jQuery('#container-5 div iframe').attr("width","100%");
			jQuery('#container-5 div iframe').attr("height","420");
		} 
		else 
		{
			jQuery('#container-5 div a').css('height','');
			jQuery('#container-5 div a').css("height",fullmedia);
			jQuery('#container-5 div object').removeAttr("width");
			jQuery('#container-5 div object').removeAttr("height");
			jQuery('#container-5 div embed').removeAttr("width");
			jQuery('#container-5 div embed').removeAttr("height");
			jQuery('#container-5 div object').attr("width","100%");
			jQuery('#container-5 div object').attr("height","320");
			jQuery('#container-5 div embed').attr("width","100%");
			jQuery('#container-5 div embed').attr("height","320");
			jQuery('#container-5 div iframe').attr("width","100%");
			jQuery('#container-5 div iframe').attr("height","320");
		}
		
		var video_container=jQuery('#container-5').width();
		var video_width=video_container+"px";
		jQuery('#container-5 div a').css('width','100%');
		//jQuery('#container-5 div a').css("width",video_width);
		jQuery('#container-5 IMG:first').css('width','');
		jQuery('#container-5 IMG:first').css("width",video_width);
		
		var template_width_notpx=jQuery('#header').outerWidth();
		var template_width=template_width_notpx -20 +"px";
		var templatewidth=jQuery('#templatewidth').val();
		var pluginurl=jQuery('#pluginurl').val();
		var temp_lesson_width=jQuery('#temp_lesson_width').val();
		var temp_global_width_load=jQuery('#temp_global_width_load').val();
		//if (temp_lesson_width == "" && temp_global_width_load != "on")
		//{
		//jQuery( "#oap_content_media" ).css( "width",template_width);
		//}
		if (templatewidth == "")
		{
			jQuery.ajax({
				url: pluginurl+"/membership-simplified-for-oap-members-only/updateDB.php", 
				type: "POST",       
				data: "action=caltempwth&tempwidth="+template_width,
				success: function (res) 
				{
				}
			});
		}
		
		
		jQuery("#oap-top-text .thumb").css('opacity','0');
		jQuery('#oap-top-text').mouseover(function() 
		{
			jQuery("#oap-top-text .thumb").css('opacity','9');
		});
		jQuery('#oap-top-text').mouseout(function()
		{
			jQuery("#oap-top-text .thumb").css('opacity','0');
		});

		var vidoffset = jQuery('.ontravideo').offset();
		var vidoffset = vidoffset['top'];
		var infooffset = jQuery('.oapInfobox').offset();
		var infooffset = infooffset['top'];
		var sidebaroffset = jQuery('#oapsidebar').offset();
		var sidebaroffset = sidebaroffset['top'];
		var contentoffset = jQuery('.oap-post').offset();
		var contentoffset = contentoffset['top'];

		var div1 = jQuery('.ontravideo');
		var div2 = jQuery('.oapInfobox');
		var tdiv1 = div1.clone();
		var tdiv2 = div2.clone();

		var div3 = jQuery('#oapsidebar');
		var div4 = jQuery('.oap-post');
		var tdiv3 = div3.clone();
		var tdiv4 = div4.clone();

		if ( jQuery(window).width() < 500 )
		{
			if ( vidoffset > infooffset )
			{
				div1.replaceWith(tdiv2);
    				div2.replaceWith(tdiv1);
			}

			if ( sidebaroffset < contentoffset )
			{
				div3.replaceWith(tdiv4);
    				div4.replaceWith(tdiv3);
			}
		}
	});
	</script>
	
	<div id="oap_content_media">
		<input type="hidden" name="templatewidth" id="templatewidth" value="<?php echo get_option('template_width');?>" />
		<input type="hidden" name="pluginurl" id="pluginurl" value="<?php echo plugins_url();?>" />
		<input type="hidden" name="temp_lesson_width" id="temp_lesson_width" value="<?php echo get_post_meta($post->ID,'_oap_template_max_width', true);?>" />
		<input type="hidden" name="temp_global_width_load" id="temp_global_width_load" value="<?php echo get_option('oapmp_template_override_width_load');?>" />
		<?php // wp_reset_query();//  query_posts(''); ?>
		<?php 
		if (have_posts()) : 
			while (have_posts()) : the_post(); ?>
		
				<!-- start header -->
				<?php
				if (wp_nav_menu( array( 'theme_location' => 'membership', 'fallback_cb' => 'false') )) 
				{
					echo wp_nav_menu(array(
						'sort_column' => 'menu_order',
						'menu' => 'Membership',
						'container_class' => 'membership-menu',
						'container_id' => 'membershipmenu',
						'fallback_cb' => 'false',
						'theme_location'  => 'membership',
						'items_wrap' => '<ul id="oapmembership" class="oapmembership">%3$s</ul>',
						'depth' => '0'
						)
					);
				}
				else 
				{
					// there's no custom menu created.
				} ?>
				
				<div class="oap-htmlcontent">
					<?php 
					if (get_post_meta($post->ID, '_on_off_custom_html', true)=='ON')
					{
						echo get_post_meta($post->ID,'_oap_custom_html', true);
					} ?>
				</div>
				
				<?php 
				if (get_option("oapmp_title_lessonnumber_setting_load")=="on")
				{
					if (get_option("oapmp_title_lessonnumber_setting")=='TLeft' || get_option("oapmp_title_lessonnumber_setting")=='TCenter' || get_option("oapmp_title_lessonnumber_setting")=='TRight')
					{ ?>
						<div class="post_title">
							<div class="posttitle_title">
								<h1><?php the_title(); ?></h1>
							</div>
							<div class="lesson_number">
								<h4 class="lesson_number">
									<?php 
									if (get_post_meta($post->ID,'type', true) != "")
									{ 
										echo rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s"); 
									} 
									else 
									{ 
										echo "Lesson";  
									} 
									echo ' ' . $post->menu_order; // echo get_post_meta($post->ID,'lesson_menu_order', true);//$post->menu_order+1; 
									?>
								</h4>
							</div>
						</div>
					<?php 
					} 
				}
				else 
				{
					if (get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TLeft' || get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TCenter' || get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TRight')
					{ ?>
						<div class="post_title">
							<div class="posttitle_title">
								<h1><?php the_title(); ?></h1>
							</div>
							<div class="lesson_number">
								<h4 class="lesson_number">
									<?php 
									if (get_post_meta($post->ID,'type', true) != "")
									{ 
										echo rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s"); 
									} 
									else 
									{ 
										echo "Lesson";  
									} 
									echo ' ' . $post->menu_order; // echo get_post_meta($post->ID,'lesson_menu_order', true);//$post->menu_order+1; 
									?>
								</h4>
							</div>
						</div>
					<?php 
					}
				} ?>
				
				<div id="headerbox">
					<?php
					/*
					  * Function To Get Left text on Media Template Under Header Section
					  * @returns Left Section
					*/
					function oapMediaTopLeft()
					{
						global $post;
						if (get_post_meta($post->ID,'_on_off_info_box',true)=='ON' || get_post_meta($post->ID,'_on_off_download', true)=='ON')
						{ ?>
						
						<div class="hleft oapInfobox oapInfoBoxFullWidth">
							<div class="leftwhite">
								<div class="oap-top-text" id="oap-top-text">
									<div class="overview oapmenucolor entry-content" >
										<?php 
										if (get_post_meta($post->ID,'_on_off_info_box',true)=='ON')
										{
											if (get_post_meta($post->ID,'_on_off_info_box',true)=='ON'):
												if (get_post_meta($post->ID,'_oap_wywtl_yesno',true)=='On'): ?>
													<h2><?php echo get_post_meta($post->ID,'_oap_infobox_heading', true) ;?></h2>
													<p><?php echo get_post_meta($post->ID,'_oap_wywtl_text', true); ?></p>
												<?php 
												endif;
												if (get_post_meta($post->ID,'_oap_length_yesno', true)=='On') : ?>
													<h2><?php echo get_post_meta($post->ID,'_oap_infobox_length', true);?></h2>
													<p><?php echo get_post_meta($post->ID,'_oap_wywtl_length', true); ?></p>
												<?php	
												endif;
											endif;
										}
										if (get_post_meta($post->ID,'_on_off_download', true)=='ON')
										{
											if (function_exists('oapHeaderDownloadList'))
											{ 
												oapHeaderDownloadList(); 
											}
										} ?>
									</div>
								</div>
							</div>
						</div>
						<?php 
						} //end of hide the infobox
					} //End Function 

					/*
					* parse_youtube_url() PHP function
					* Author: takien
					* URL: http://takien.com */
					function parse_youtube_url($url,$return='embed',$width='',$height='',$rel=0)
					{
						$urls = parse_url($url);
						if ($urls['host'] == 'youtu.be') $id = ltrim($urls['path'],'/');
						else if (strpos($urls['path'],'embed') == 1) $id = end(explode('/',$urls['path']));
						else if (strpos($url,'/')===false) $id = $url;
						else {
							parse_str($urls['query']);
							$id = $v;
							}
						if ($return == 'embed') return '<iframe width="'.($width?$width:560).'" height="'.($height?$height:349).'" src="http://www.youtube.com/embed/'.$id.'?rel='.$rel.'" frameborder="0" allowfullscreen></iframe>';
						else if ($return == 'thumb') return 'http://i1.ytimg.com/vi/'.$id.'/default.jpg';
						else if ($return == 'hqthumb') return 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg';
						else return $id;
					}
					
					/* Function to get header Media and data
					* @returns video or Image
					* Updated 8/23/13 by WD to add support for iOS
					* */
					function oapMediaTopRight()
					{
						global $post;
						if (get_post_meta( $post->ID, '_on_off_main_media', true )=='ON' || get_option('oapmp_post_template_load')=='on')
						{ ?>

							<div class="hright oapInfobox oapMediaFullWidth ontravideo">
								<?php 
								if ((get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='Full Width' || get_option('oapmp_fullvideo_shared_position')=='Full Width') || get_option('oapmp_fullvideo_shared_position')=='720 by 420' || (get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='720 by 420'))
								{ ?>
								<input type="hidden" name="fullmedia" id="fullmedia" value="420px" />
								<?php 
								} 
								else 
								{ 
								?>
								<input type="hidden" name="fullmedia" id="fullmedia" value="320px" />
								<?php 
								} ?>
								
								<script src="<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/js/jquery.tabs.pack.js"></script>
								<script type="text/javascript" src="<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/flowplayer/flowplayer.min.js"></script>
								<script type="text/javascript" src="<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/js/flowplayer.ipad-3.2.12.min.js"></script>
								<link rel="stylesheet" href="<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/css/jquery.tabs.css" type="text/css" media="print, projection, screen">
								
								<div id="container-5">
									<?php 
									global $wpdb;
									global $post;

									if (get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='Full Width' || get_option('oapmp_fullvideo_shared_position')=='Full Width' || get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='720 by 420')
									{
										$height="420px";
										$novideo_padding="200px";
									}
									else
									{
										$height="320px";
										$novideo_padding="150px";
									}
									$v=0;
									$table_name = $wpdb->prefix . "media_listing";
									$query = "select * from $table_name where postID='".$post->ID."' order by recordListingId";
									$results = $wpdb->get_results($query);

									if (count($results) > 0) 
									{
										foreach($results as $listing)
										{ 
											$v++; ?>
									
											<div id="fragment-<?php echo $v;?>">
												<?php //$vidurl= get_post_meta($post->ID, '_oap_mmi_video', true);
												$vidurl= $listing->fileName;
												$vidext= substr($vidurl,-3);
												$vidembed= substr($vidurl,-9);
												$viddata = PilotPress::get_oap_video($vidurl);
												$viddataurl = $viddata["url"];
												$viddataurlstrip = substr($viddataurl, 36);
												$viddataurlstripped = substr($viddataurlstrip, 0, -4);
												$viddatathumb = get_post_meta($post->ID, $listing->recordID.'_oap_video_thumbnail', true );
												$vidplayer = get_post_meta($post->ID, $listing->recordID.'_oap_video_player', true );
												$getvidplayer = get_post_meta($post->ID, '_oap_video_player', true );
												$hidden = 'https://s3.amazonaws.com/oap_flow/hidden.swf';
												$player1 = 'https://s3.amazonaws.com/oap_flow/player1.swf';
												$player2 = 'https://s3.amazonaws.com/oap_flow/player2.swf';
												$player3 = 'https://s3.amazonaws.com/oap_flow/player3.swf'; 
												$nonios = 'mp4:' . $viddataurlstripped; 
												$ios = $viddataurl; 

												if ($vidext=='flv' || $vidext=='mp4' || $vidext=='mov')
												{ ?>
													<script src="<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/flowplayer/flowplayer.min.js"></script>
													<?php 
													$ua = $_SERVER['HTTP_USER_AGENT'];
													$idevice = (strpos($ua,"iPad") !== false || strpos($ua,"iPhone") !== false);

													if (is_callable("PilotPress::get_oap_video")) 
													{
														$viddata = PilotPress::get_oap_video($vidurl);
														$viddataurl = $viddata["url"];
														
														$ua = $_SERVER['HTTP_USER_AGENT'];
														$idevice = (strpos($ua,"iPad") !== false || strpos($ua,"iPhone") !== false);	    
														if (!$idevice)
														{ ?>
															<a id="player-<?php echo $v;?>" href="<?php echo $vidurl; ?>" style="display:block;position:relative;width:100%;"><img style="width: 100%; height: 100%; border: 0px; background-color: #000;" src="<?php echo $viddatathumb; ?>" alt="" /><img style="position: absolute; left: 41%; bottom: 45%;" src="<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/images/playbutton.png" alt="Press Play!" /></a>
															<script>
																flowplayer("player-<?php echo $v;?>", "<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/flowplayer/flowplayer.swf");
															</script>
														<?php 
														} 
														else 
														{ ?>
															<a id="player-<?php echo $v;?>" href="<?php echo $vidurl; ?>" style="display:block;position:relative;width:100%;"><img style="width: 100%; height: 100%; border: 0px; background-color: #000;" src="<?php echo $viddatathumb; ?>" alt="" /><img style="position: absolute; left: 41%; bottom: 45%;" src="<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/images/playbutton.png" alt="Press Play!" /></a>
															<script>
																$f("player-<?php echo $v;?>", "<?php if ($vidplayer == 'hidden') { echo $hidden; } else if ($vidplayer == 'player1') { echo $player1; } else if ($vidplayer == 'player2') { echo $player2; } else if ($vidplayer == 'player3') { echo $player3; } else echo $player1; ?>", { 
															    	key: '#$a7ff13c94e064d176b4'
																}).ipad();
															</script>
														<?php 
														}
													} 

												} 
												else if ($vidembed == "</object>" || $vidembed == "</iframe>")
												{
													echo stripslashes_deep($vidurl);
												}
												else if (is_numeric($vidurl)) 
												{
													if (is_callable("PilotPress::get_oap_video")) 
													{
														if (empty($viddatathumb)) 
														{
															$viddatathumb = $viddata["thumbnail"];
														}
													
														$ua = $_SERVER['HTTP_USER_AGENT'];
														$idevice = (strpos($ua,"iPad") !== false || strpos($ua,"iPhone") !== false);						    
														if (!$idevice) 
														{ 
															$thevid = $nonios;
														} 
														else 
														{
															$thevid = $ios;
														} 
													?>

													<a class="rtmp" style="display: block; width: 100%; height: 100%; text-align: center; cursor: pointer; position: relative;" href="<?php echo $thevid; ?>">
														<img style="width: 100%; height: 100%; border: 0px; opacity: .7;" src="<?php echo $viddatathumb; ?>" alt="PLAY ME" />
														<img style="position: absolute; left: 41%; bottom: 45%;" src="<?php echo plugins_url();  ?>/membership-simplified-for-oap-members-only/images/playbutton.png" alt="Press Play!" />
													</a>

													<?php 
													}
												}
												else 
												{
													$pieces = explode(".", $vidurl);
													$w = $pieces[1];
													$wistiavid=substr($vidurl, -10);
													$vidext = $pieces[0];
													$pos= strpos($vidurl,'=');
													$pieces = explode("/", $vidurl);
													$vimeovideo= $pieces[3];
														
													if (($vidext=='http://vimeo') || ($vidext=='https://vimeo'))
													{ ?>
														<iframe src="http://player.vimeo.com/video/<?php echo $vimeovideo; ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
													<?php 
													} 
													else if ( $w == 'wistia' )
													{
														echo '<iframe src="//fast.wistia.net/embed/iframe/' . $wistiavid . '" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="100%" height="100%"></iframe><script type="text/javascript">
														jQuery(document).ready(function()
														{
															var vidheight = jQuery(".ms-videocomments-video iframe").width() * 9 / 16;
															jQuery(".ms-videocomments-video").height(vidheight);
														});
														</script>';
													}
													else 
													{
														echo parse_youtube_url($vidurl);
													}

												} ?>
											</div>
										<?php 
										}
									}
									else 	
									{
										echo "<div style='height:".$height.";' class='novideo_div'><p style='padding-top:".$novideo_padding.";'>Please Add Your Videos </p> </div>";
									} 
									?>
										
									<ul>
										<?php
										$h=0; 
										foreach($results as $listing)
										{ 
											$h++; ?>

											<li id="tab-<?php echo $h;?>">
												<a href="#fragment-<?php echo $h;?>"><span><?php echo stripslashes($listing->recordText); ?></span></a>
											</li>
										<?php 
										} ?>
									</ul>

								</div>
								<script type="text/javascript">
								var a=jQuery.noConflict();
								a(function() 
								{
									a('#container-5').tabs({ fxSlide: false, fxFade: true, fxSpeed: 'normal' });
								});

								jQuery(document).ready(function()
								{
									var vidheight = jQuery("#fragment-1").width() * 9 / 16;
									jQuery(".ui-tabs-panel a").height(vidheight);
									jQuery(".ui-tabs-panel iframe").height(vidheight);
									jQuery('#player-1').next('img').height(vidheight);
								});
								</script>

								<?php 
								$ua = $_SERVER['HTTP_USER_AGENT'];
								$idevice = (strpos($ua,"iPad") !== false || strpos($ua,"iPhone") !== false);
								
								if (!$idevice)
							   	{ ?>
									<script>
									$f("a.rtmp", "<?php if ($vidplayer == 'hidden') { echo $hidden; } else if ($vidplayer == 'player1') { echo $player1; } else if ($vidplayer == 'player2') { echo $player2; } else if ($vidplayer == 'player3') { echo $player3; } else echo $player1; ?>", { key: '#$a7ff13c94e064d176b4', clip: { provider: 'rtmp', autoPlay: true }, plugins: { rtmp: { url: 'https://s3.amazonaws.com/clientvids/flowplayer.rtmp-3.2.3.swf', netConnectionUrl: 'rtmp://s2pbm3c8fi1raj.cloudfront.net/cfx/st' } } });
									</script>
								<?php 
								} 
								else 
								{ ?>
									<script>
									$f("a.rtmp", "<?php if ($vidplayer == 'hidden') { echo $hidden; } else if ($vidplayer == 'player1') { echo $player1; } else if ($vidplayer == 'player2') { echo $player2; } else if ($vidplayer == 'player3') { echo $player3; } else echo $player1; ?>", { 
									    key: '#$a7ff13c94e064d176b4'
									}).ipad();
									</script>
								<?php 
								} ?>
							</div>
						<?php 
						} //If Ends
					} //Function Top Right Ends


					if (get_option("oapmp_post_video_or_image_position_load")=="on")
					{
						if (get_option("oapmp_post_video_or_image_position")=="Left")
						{
							oapMediaTopRight();
							oapMediaTopLeft();
						}
						if (get_option("oapmp_post_video_or_image_position")=="Right")
						{
							oapMediaTopLeft();
							oapMediaTopRight();
						}
					}
					else 
					{
						if (get_post_meta( $post->ID, '_oap_video_image_position', true )=='Left')
						{
							oapMediaTopRight();
							oapMediaTopLeft();
						}
						if (get_post_meta( $post->ID, '_oap_video_image_position', true )=='Right')
						{
							oapMediaTopLeft();
							oapMediaTopRight();
						}
					}
					wp_reset_query(); ?>
				</div><!--headerbox end here-->
				<script type="text/javascript">
				jQuery(".viewport").css({'height':(jQuery(".bottom_section").height()+'px')});
				</script>
				
				<div class="bottom_section entry-content" id="bottomSec">
					<?php 
					if (get_option("oapmp_post_content_menu_position_load")=="on") 
					{
						if (get_option("oapmp_post_content_menu_position")=="Left")
						{
							oap_lesson_widget::widget();
						}
					} 
					else 
					{
						if (get_post_meta($post->ID, '_oap_lesson_menu_position', true)=='Left')
						{
							oap_lesson_widget::widget();
						}
					} ?>
					
					<div class="oap-post">
						<?php 
						if (get_option("oapmp_title_lessonnumber_setting_load")=="on")
						{
							if (get_option("oapmp_title_lessonnumber_setting")=='MLeft' || get_option("oapmp_title_lessonnumber_setting")=='MCenter' || get_option("oapmp_title_lessonnumber_setting")=='MRight')
							{ ?>
								<div class="post_title">
									<div class="posttitle_title">
										<h1><?php the_title(); ?></h1>
									</div>
									<div class="lesson_number">
										<h4 class="lesson_number">
											<?php 
											if (get_post_meta($post->ID,'type', true) != "")
											{ 
												echo rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s"); 
											} 
											else 
											{ 
												echo "Lesson";  
											}
											echo ' ' . $post->menu_order;
											// echo get_post_meta($post->ID,'lesson_menu_order', true);//$post->menu_order+1;
											?>
										</h4>
									</div>
								</div>
							<?php	
							}
						} 
						else 
						{
							if (get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='MLeft' || get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='MCenter' || get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='MRight')
							{ ?>
								<div class="post_title">
									<div class="posttitle_title">
										<h1><?php the_title(); ?></h1>
									</div>
									<div class="lesson_number">
										<h4 class="lesson_number">
											<?php 
											if (get_post_meta($post->ID,'type', true) != "")
											{ 
												echo rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s"); 
											} 
											else 
											{ 
												echo "Lesson";  
											}
											echo ' ' . $post->menu_order;
											// echo get_post_meta($post->ID,'lesson_menu_order', true);//$post->menu_order+1;
											?>
										</h4>
									</div>
								</div>
							<?php 
							}
						}

						if (get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='Full Width' || get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='720 by 420')
						{ ?>
							<div class="oap-infobox-fullvideo entry-content" id="oap-infobox-fullvideo">
								<?php 
								if (get_post_meta($post->ID,'_on_off_info_box',true)=='ON')
								{
									if (get_post_meta($post->ID,'_on_off_info_box',true)=='ON') :
										if (get_post_meta($post->ID,'_oap_wywtl_yesno',true)=='On') : ?>
											<h2><?php echo get_post_meta($post->ID,'_oap_infobox_heading', true) ;?></h2>
											<p><?php echo get_post_meta($post->ID,'_oap_wywtl_text', true); ?></p>
										<?php 
										endif;
										if (get_post_meta($post->ID,'_oap_length_yesno', true)=='On') : ?>
											<h2><?php echo get_post_meta($post->ID,'_oap_infobox_length', true);?></h2>
											<p><?php echo get_post_meta($post->ID,'_oap_wywtl_length', true);?></p>
										<?php  
										endif;
									endif;
								} ?>
							</div>
						<?php 
						} ?>

						<div class="oapcontent">
							<?php the_content();?>
						</div>
						<?php 
						if (get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='Full Width' || get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='720 by 420')
						{ ?>
							<div class="oap-download-fullvideo" id="oap-download-fullvideo">
								<?php
								if (get_post_meta($post->ID,'_on_off_download', true)=='ON')
								{
									if (function_exists('oapHeaderDownloadList'))
									{ 
										oapHeaderDownloadList();
									}
								} ?>
							</div>
						<?php 
						} ?>

						<div class="oap-social-icons">
							<?php
							if (function_exists('display_social4i'))
							{
								if (get_option('oapmp_socials_facebook_like')=='on')
								{
									echo  display_social4i("small","float-left","s4_fblike");
								}
								if (get_option('oapmp_socials_facebook_share')=='on')
								{ 
									echo display_social4i("small","float-left","s4_fbshare"); 
								}
								if (get_option('oapmp_socials_twitter')=='on')
								{
									echo display_social4i("small","float-left","s4_twitter");
								}
								if (get_option('oapmp_socials_google_plus')=='on')
								{
									echo display_social4i("small","float-left","s4_plusone");
								}
							} ?>
						</div>
						<div class="oap_comments">
							<?php comments_template(); ?>
						</div>
					</div>
				
					<?php 
					if (get_option("oapmp_post_content_menu_position_load")=="on")
					{
						if (get_option("oapmp_post_content_menu_position")=="Right")
						{
							oap_lesson_widget::widget();
						}
					}
					else 
					{
						if (get_post_meta($post->ID, '_oap_lesson_menu_position', true)=='Right')
						{
							oap_lesson_widget::widget();
						}
					} ?>
				</div>

			<?php 
			endwhile; 
		else : ?>
			<h2>Not Found</h2>
			<p>Sorry, but you are looking for something that isn't here.</p>
		<?php 
		endif;
		 ?>
	</div><!--/content -->
<?php 
}


/** Function For Single Page with Text Template  *********************************
 ** @return single page text template data
 */
function oapSingleText()
{
	global $post;
	;?>
	<script>
	jQuery(document).ready(function()
	{
		var template_width_notpx=jQuery('#header').outerWidth();
		var template_width=template_width_notpx -20 +"px";
		var templatewidth=jQuery('#templatewidth').val();
		var pluginurl=jQuery('#pluginurl').val();
		var temp_lesson_width=jQuery('#temp_lesson_width').val();
		var temp_global_width_load=jQuery('#temp_global_width_load').val();
		if (templatewidth == "")
		{
			jQuery.ajax({
			url: pluginurl+"/membership-simplified-for-oap-members-only/updateDB.php", 
			type: "POST",       
			data: "action=caltempwth&tempwidth="+template_width,
			success: function (res) 
			{
			}
			});
		}
	});
	</script>
	<div id="oap-content-text" class="bottom_section entry-content text-template">
		<input type="hidden" name="templatewidth" id="templatewidth" value="<?php echo get_option('template_width');?>" />
		<input type="hidden" name="pluginurl" id="pluginurl" value="<?php echo plugins_url();?>" />
		<input type="hidden" name="temp_lesson_width" id="temp_lesson_width" value="<?php echo get_post_meta($post->ID,'_oap_template_max_width', true);?>" />
		<input type="hidden" name="temp_global_width_load" id="temp_global_width_load" value="<?php echo get_option('oapmp_template_override_width_load');?>" />
		
		<?php  
		wp_reset_query();//  query_posts('');
		if (have_posts()) : 
			while (have_posts()) : the_post(); ?>
				<div class="oap-htmlcontent">
					<?php
					if (wp_nav_menu( array( 'theme_location' => 'membership', 'fallback_cb' => 'false') )) 
					{
						echo wp_nav_menu(array(
							'sort_column' => 'menu_order',
							'menu' => 'Membership',
							'container_class' => 'membership-menu',
							'container_id' => 'membershipmenu',
							'fallback_cb' => 'false',
							'theme_location'  => 'membership',
							'items_wrap' => '<ul id="oapmembership" class="oapmembership">%3$s</ul>',
							'depth' => '0'
							)
						);
					}
					else
					{
						// there's no custom menu created.
					}
			
					if (get_post_meta($post->ID, '_on_off_custom_html', true)=='ON')
					{
						echo get_post_meta($post->ID,'_oap_custom_html', true);
					}
					?>
				</div>

				<?php
				if (get_option("oapmp_post_content_menu_position_load")=="on")
				{
					if (get_option("oapmp_post_content_menu_position")=="Left")
					{
						oap_lesson_widget::widget();
					}
				}
				else
				{
					if (get_post_meta($post->ID, '_oap_lesson_menu_position', true)=='Left')
					{
						oap_lesson_widget::widget();
					}
				}
				?>

				<div class="oap-post">
					<div class="oap-post-title oapmenucolor">
						<?php 
						if (get_option("oapmp_title_lessonnumber_setting_load")=="on")
						{
							if (get_option("oapmp_title_lessonnumber_setting")=='TLeft' || get_option("oapmp_title_lessonnumber_setting")=='TCenter' || get_option("oapmp_title_lessonnumber_setting")=='TRight')
							{ ?>
								<div class="post_title">
									<div class="posttitle_title">
										<h1><?php the_title(); ?></h1>
									</div>
									<div class="lesson_number">
										<h4 class="lesson_number">
											<?php
											if (get_post_meta($post->ID,'type', true) != "")
											{ 
												echo rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s");
											} 
											else 
											{ 
												echo "Lesson";  
											}
											echo ' ' . $post->menu_order;
											// echo get_post_meta($post->ID,'lesson_menu_order', true);//$post->menu_order+1;
											?>
										</h4>
									</div>
								</div>
							<?php 
							}
						}
						else
						{
							if (get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TLeft' || get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TCenter' || get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TRight')
							{ ?>
								<div class="post_title">
									<div class="posttitle_title">
										<h1><?php the_title(); ?></h1>
									</div>
									<div class="lesson_number">
										<h4 class="lesson_number">
										<?php 
										if (get_post_meta($post->ID,'type', true) != "")
										{ 
											echo rtrim(lesson_type(get_post_meta($post->ID,'type', true)), "s"); 
										} 
										else 
										{ 
											echo "Lesson";  
										} 
										echo ' ' . $post->menu_order; // echo get_post_meta($post->ID,'lesson_menu_order', true);//$post->menu_order+1; 
										?>
										</h4>
									</div>
								</div>
							<?php 
							}
						} ?>
					</div>

					<?php 
					if (get_post_meta($post->ID,'_on_off_info_box',true)=='ON') : ?>
						<div class="oapInfoBox">
							<?php 
							if (get_post_meta($post->ID,'_oap_wywtl_yesno',true)=='On') : ?>
								<div class="oapbox1">
									<h2><?php echo get_post_meta($post->ID,'_oap_infobox_heading', true) ;?></h2>
									<p><?php echo get_post_meta($post->ID,'_oap_wywtl_text', true); ?></p>
								</div>
							<?php 
							endif;
							if (get_post_meta($post->ID,'_oap_length_yesno', true)=='On') : ?>
								<div class="oapbox2">
									<h2><?php echo get_post_meta($post->ID,'_oap_infobox_length', true);?></h2>
									<p><?php echo get_post_meta($post->ID,'_oap_wywtl_length', true);?></p>
								</div>
							<?php 
							endif; 
							?>
						</div>
					<?php 
					endif;
					?>

					<div class="oapcontent entry-content">
						<?php the_content();?>
					</div>
					<div class="downloadsection">
						<?php if (get_post_meta($post->ID,'_on_off_download',true)=='ON'):?>
						<?php oapDownloadList(); ?>
						<?php endif;?>
					</div>
					<div class="oap-social-icons">
						<?php
						if (function_exists('display_social4i'))
						{
							if (get_option('oapmp_socials_facebook_like')=='on')
							{
								echo  display_social4i("small","float-left","s4_fblike");
							}
						}
						if (function_exists('display_social4i'))
						{
							if (get_option('oapmp_socials_facebook_share')=='on')
							{ 
								echo display_social4i("small","float-left","s4_fbshare"); 
							}
							if (get_option('oapmp_socials_twitter')=='on')
							{
								echo display_social4i("small","float-left","s4_twitter");
							}
							if (get_option('oapmp_socials_google_plus')=='on')
							{
								echo display_social4i("small","float-left","s4_plusone");
							}
						}
						?>
					</div>
					<div class="oap_comments">
						<?php comments_template(); ?>
					</div>
				</div>
			<?php 
			endwhile; 
		else : ?>
			<h2>Not Found</h2>
			<p>Sorry, but you are looking for something that isn't here.</p>
		<?php 
		endif;

		if (get_option("oapmp_post_content_menu_position_load")=="on")
		{
			if (get_option("oapmp_post_content_menu_position")=="Right")
			{
				oap_lesson_widget::widget();
			}
		}
		else
		{
			if (get_post_meta($post->ID, '_oap_lesson_menu_position', true)=='Right')
			{
				oap_lesson_widget::widget();
			}
		}
		?>
	</div>
<?php 
} // End function Text Template

/**
* Function to show download listing on Text Template
*
* @return Download Listing
*/
function oapDownloadList()
{ ?>
	<div class="oapDownloadList oapmenucolor">
		<h2>Downloads</h2>
		<div class="downloadcontainer">
			<ul id="mycarousel">
				<?php
				global $wpdb;
				global $post;
				$download_list = array();
				$table_name = $wpdb->prefix . "download_listing";
				$query = "select * from $table_name where postID= $post->ID order by recordListingId";
				$results = $wpdb->get_results($query);
				if (is_callable("PilotPress::get_oap_items")) 
				{
					if (!get_transient("oap_items")) 
					{
						set_transient("oap_items", PilotPress::get_oap_items(), 60*60*1);
					}
					$GLOBBALS["oap"] = get_transient("oap_items");
				}
				if (count($GLOBALS["oap"]["files"]["list"]) > 0)
				{
					foreach($GLOBALS["oap"]["files"]["list"] as $index => $item) 
					{
						$download_list[$item["name"]] = $item["path"];
					}
				}

				foreach($results as $listing)
				{ ?>
					<li class="oapDownloadListing">
						<?php 
						$filename=array();
						$filename=explode(",", $listing->fileName);
						$file_name=$filename[0];
						if (isset($download_list[$file_name])) {
							$file_url=$download_list[$file_name]; //hack to make shift
						}
						else
						{
							$file_url=$filename[1];
						}
						$ext = end(explode(".", $file_name));
						?>
						<div class="downloaditems_container">
							<div class="icon_pos">
								<?php $file = new FileIcon($ext); echo $file -> displayIcon(); ?>
							</div>

							<?php 
							if ($listing->fileType == 'Download Link')
							{
								echo 
								'<div class="dlitem_text download-link">
									<a href="' . $listing->fileName . '">
										' . $listing->recordText . '
									</a>
								</div>';
							}
							else if ($listing->fileType == 'Uploaded Item')
							{
								echo 
								'<div class="dlitem_text uploaded-item">
									<a href="' . plugins_url() . '/membership-simplified-for-oap-members-only/download.php?download_file=' . $listing->fileName . '">
										' . stripslashes($listing->recordText) . '
									</a>
								</div>';
							}
							else if ($listing->fileType == 'OAP Hosted Item')
							{
								if (substr($file_url, 0, 12) == "https://www1" OR substr($file_url, 0, 11) == "http://www1") 
								{ 
									echo 
									'<div class="dlitem_text oap-hosted-item">
										<a href="' . $file_url . '">
											' . stripslashes(trim($listing->recordText)) . '
										</a>
									</div>';
								}
								else if (substr($file_url, 0, 11) != "http://www1" && substr($listing->fileName, 0, 7) == "http://") 
								{ 
									echo 
									'<div class="dlitem_text oap-hosted-item">
										<a href="' . $listing->fileName . '">
											' . stripslashes(trim($listing->recordText)) . '
										</a>
									</div>';
								}
							}
							else
							{
								if (substr($file_url, 0, 12) == "https://www1" OR substr($file_url, 0, 11) == "http://www1") 
								{ 
									echo 
									'<div class="dlitem_text oap-hosted-item">
										<a href="' . $file_url . '">
											' . stripslashes(trim($listing->recordText)) . '
										</a>
									</div>';
								}
								else if (substr($file_url, 0, 11) != "http://www1" && substr($listing->fileName, 0, 7) == "http://") 
								{ 
									echo 
									'<div class="dlitem_text oap-hosted-item">
										<a href="' . $listing->fileName . '">
											' . stripslashes(trim($listing->recordText)) . '
										</a>
									</div>';
								}
								else if (strstr($listing->fileName, '/') == false)
								{
									echo 
									'<div class="dlitem_text uploaded-item">
										<a href="' . plugins_url() . '/membership-simplified-for-oap-members-only/download.php?download_file=' . $listing->fileName . '">
											' . stripslashes($listing->recordText) . '
										</a>
									</div>';
								}
								else
								{
									echo 
									'<div class="dlitem_text download-link">
										<a href="' . $listing->fileName . '">
											' . $listing->recordText . '
										</a>
									</div>';
								}
							} ?>
						</div>
					</li>
				<?php 
				} ?>
			</ul>
		</div>
	</div>
 <?php 
} //function Download Listing Ends 


/**
* Function to Show Download Listing on Media Template Header 
** @return unknown_type
*/ 
 function oapHeaderDownloadList()
 {
	global $post;
	if (get_post_meta( $post->ID, '_on_off_download', true )=='ON')
	{ ?>
		<h2>Downloads</h2>
		<div class="downloadcontainer">
			<ul id="mycarousel">
				<?php
				global $wpdb;
				global $post;
				$table_name = $wpdb->prefix . "download_listing";
				$query = "select * from $table_name where postID= $post->ID order by recordListingId";
				$results = $wpdb->get_results($query);
				foreach($results as $listing)
				{ ?>
				<li>
					<?php
					$filename=array();
					$filename=explode(",", $listing->fileName);
					$file_name=$filename[0];
					$file_url=$filename[1];
					$ext=  end(explode(".", $file_name));
					?>
					<div class="downloaditems_container">
						<div class="icon_pos">
							<?php $file = new FileIcon($ext); echo $file -> displayIcon(); ?>
						</div>

						<?php 
						if ($listing->fileType == 'Download Link')
						{
							echo 
							'<div class="dlitem_text download-link">
								<a href="' . $listing->fileName . '">
									' . $listing->recordText . '
								</a>
							</div>';
						}
						else if ($listing->fileType == 'Uploaded Item')
						{
							echo 
							'<div class="dlitem_text uploaded-item">
								<a href="' . plugins_url() . '/membership-simplified-for-oap-members-only/download.php?download_file=' . $listing->fileName . '">
									' . stripslashes($listing->recordText) . '
								</a>
							</div>';
						}
						else if ($listing->fileType == 'OAP Hosted Item')
						{
							if (substr($file_url, 0, 12) == "https://www1" OR substr($file_url, 0, 11) == "http://www1") 
							{ 
								echo 
								'<div class="dlitem_text oap-hosted-item">
									<a href="' . $file_url . '">
										' . stripslashes(trim($listing->recordText)) . '
									</a>
								</div>';
							}
							else if (substr($file_url, 0, 11) != "http://www1" && substr($listing->fileName, 0, 7) == "http://") 
							{ 
								echo 
								'<div class="dlitem_text oap-hosted-item">
									<a href="' . $listing->fileName . '">
										' . stripslashes(trim($listing->recordText)) . '
									</a>
								</div>';
							}
							else
							{
								echo 
								'<div class="dlitem_text oap-hosted-item">
									<a href="' . $file_url . '">
										' . stripslashes(trim($listing->recordText)) . '
									</a>
								</div>';								
							}
						}
						else
						{
							if (substr($file_url, 0, 12) == "https://www1" OR substr($file_url, 0, 11) == "http://www1") 
							{ 
								echo 
								'<div class="dlitem_text oap-hosted-item">
									<a href="' . $file_url . '">
										' . stripslashes(trim($listing->recordText)) . '
									</a>
								</div>';
							}
							else if (substr($file_url, 0, 11) != "http://www1" && substr($listing->fileName, 0, 7) == "http://") 
							{ 
								echo 
								'<div class="dlitem_text oap-hosted-item">
									<a href="' . $listing->fileName . '">
										' . stripslashes(trim($listing->recordText)) . '
									</a>
								</div>';
							}
							else if (strstr($listing->fileName, '/') == false)
							{
								echo 
								'<div class="dlitem_text uploaded-item">
									<a href="' . plugins_url() . '/membership-simplified-for-oap-members-only/download.php?download_file=' . $listing->fileName . '">
										' . stripslashes($listing->recordText) . '
									</a>
								</div>';
							}
							else
							{
								echo 
								'<div class="dlitem_text download-link">
									<a href="' . $listing->fileName . '">
										' . $listing->recordText . '
									</a>
								</div>';
							}
						} ?>
					</div>
				</li>
				<?php 
				} ?>
			</ul>
		</div>
		<?php 
	} 
} 


/**
 * Check Whether Media or Text Template 
 ** @return oaptemplate 
 */
function oapMediaOrText()
{
	echo "<script  type='text/javascript'>jQuery('body').attr('id','oap_theme_wrapper');</script>";
	global $post;
	wp_reset_query();
	if (class_exists("PilotPress")) 
	{
		if (get_option('oapmp_enable_or_disable')=='Enabled')
		{
			if (get_option("oapmp_post_template_load")=="on")
			{
				if (get_option("oapmp_post_template")=="Media Template")
				{
					if (function_exists('oapSingleMedia'))
					{
						oapSingleMedia();
					}
				}
				if (get_option("oapmp_post_template")=="Text Template")
				{
					if (function_exists('oapSingleText'))
					{
						oapSingleText();
					}
				}
				if (get_option("oapmp_post_template")=="Video Comments")
				{
					video_comments_template();
				}
			}
			else 
			{
				if (get_post_meta($post->ID, '_oap_media_text_template', true)=='Media Template')
				{
					if (function_exists('oapSingleMedia'))
					{
						oapSingleMedia();
					}
				}
				if (get_post_meta($post->ID, '_oap_media_text_template', true)=='Text Template')
				{
					if (function_exists('oapSingleText'))
					{
						oapSingleText();
					}
				}
				if (get_post_meta($post->ID, '_oap_media_text_template', true)=='Video Comments')
				{
					video_comments_template();
				}
			}
		}//end Disable or Enable Plugin    
	}
}//End Function
add_shortcode('oaptemplate','oapMediaOrText');