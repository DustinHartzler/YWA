<?php
/**
 * Define Plugin url
 */
if(!defined("WP_FUNCTIONS_INCLUDED")) 
{
	define("WP_FUNCTIONS_INCLUDED", 1);
	if (!defined('WP_CONTENT_URL'))
		define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
	if (!defined('WP_CONTENT_DIR'))
		define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
	if (!defined('WP_PLUGIN_DIR') )
		define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
  /**
   **  Define the custom box
   *  */
  $theme_url=get_bloginfo ( 'template_url' );
  if ( is_admin() ) 
  {
	function add_post_enctype() 
	{
		 if(is_callable("PilotPress::get_oap_items")) 
		 {
			if(!get_transient("oap_items")) 
			{
				set_transient("oap_items", PilotPress::get_oap_items(), 60*60*1);
			}
			$GLOBALS["oap"] = get_transient("oap_items");
		}
		echo "<script type='text/javascript'>
		jQuery(document).ready(function(){
			jQuery('#post').attr('enctype','multipart/form-data');
		});
		</script>";
	}
	add_action('admin_head', 'add_post_enctype');
  }
  //Adding scripts and styles for the main pages in the header
  function oap_scriptz() 
  {
	wp_enqueue_script('jquery');
	wp_register_script( 'tinyscroll', plugins_url('/js/jquery.tinyscrollbar.js', __FILE__) );
	wp_enqueue_script('tinyscroll');
	wp_register_style( 'mainstyle', plugins_url('/css/style.css', __FILE__) );
	wp_enqueue_style( 'mainstyle' );
  }
  add_action('wp_enqueue_scripts', 'oap_scriptz');

  //Adding dynamic css via php to the header
  function oap_dynamic_style() 
  {
	require_once(WP_PLUGIN_DIR.'/membership-simplified-for-oap-members-only/style.php' );
  }
  add_action('wp_head', 'oap_dynamic_style');

  //Adding scripts and styles for the admin pages in the header
  function oap_admin_scriptz() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-tabs');
	wp_register_script( 'uploader_script', plugins_url() .'/membership-simplified-for-oap-members-only/js/uploader-script.js', array('jquery','media-upload','thickbox') );
	wp_enqueue_script('uploader_script');
	wp_register_script( 'excolor', plugins_url('/js/modcoder_excolor/jquery.modcoder.excolor.js', __FILE__) );
	wp_enqueue_script('excolor');
	wp_register_script( 'mousewheel', plugins_url('/js/jquery.mousewheel-3.0.6.pack.js', __FILE__) );
	wp_enqueue_script('mousewheel');
	wp_register_script( 'iphoneckbox', plugins_url('/js/iphone-style-checkboxes.js', __FILE__) );
	wp_enqueue_script('iphoneckbox');
	wp_enqueue_script('tinyscroll');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');

	wp_register_style( 'oapglobalcss', plugins_url('//css/global.css', __FILE__) );
	wp_enqueue_style( 'oapglobalcss' );
	wp_register_style( 'oapfunctionsstyle', plugins_url('/css/functions.css', __FILE__) );
	wp_enqueue_style( 'oapfunctionsstyle' );
	wp_register_style( 'iphone_style', plugins_url('/css/iphone_style.css', __FILE__) );
	wp_enqueue_style( 'iphone_style' );
	wp_register_style( 'oapadminposts', plugins_url('/css/admin_posts.css', __FILE__) );
	wp_enqueue_style( 'oapadminposts' );
	wp_register_style( 'oapadminstyle', plugins_url('/css/admin_style.css', __FILE__) );
	wp_enqueue_style( 'oapadminstyle' );
	wp_register_style( 'confirm', plugins_url('/css/confirm.css', __FILE__) );
	wp_enqueue_style( 'confirm' );
	wp_enqueue_style('thickbox');
  }
  add_action('admin_enqueue_scripts', 'oap_admin_scriptz');

  function customScripts()
  {
	$screen = get_current_screen();
	//var_dump($screen);
	if ($screen->id == 'oaplesson')
	{
		wp_register_script( 'oapcustom', plugins_url('/js/custom.js', __FILE__) );
		wp_enqueue_script( 'oapcustom' );
	}
	else if ($screen->id == 'oaplesson_page_manage_oap_options')
	{
		wp_register_script( 'oapcustom', plugins_url('/js/globalsettings.js', __FILE__) );
		wp_enqueue_script( 'oapcustom' );
	}
  }
  add_action('admin_enqueue_scripts', 'customScripts');

  $prefix = 'oap_';
  // WP 3.0+
  add_action( 'add_meta_boxes', 'oap_add_custom_box' );
  /* Adds a box to the main column on the Post and Page edit screens */

  function oap_add_custom_box() {
	global $metaBox;
	//foreach (array('post','page','oaplesson') as $type)
	foreach (array('oaplesson') as $type) //as we are using only for custom post type
	{
		// add_meta_box('oap_sectionid',__( 'Membership Item Content Settings', 'oap_textdomain' ),'oap_membership_box',$type);
		//add_meta_box($metaBox['id'], $metaBox['title'], 'createOverviewBox', $type, $metaBox['context'], $metaBox['priority']);
		add_meta_box($metaBox['id'], $metaBox['title'], 'oap_membership_box', $type, $metaBox['context'], $metaBox['priority']);
	}
  }
  function is_post_type($type)
  {
	global $wp_query;
	if($type == get_post_type($wp_query->post->ID)) return true;
	return false;
  }

  /**
   * Function to Add a Custom Category for Membership Programs
   * Author: William DeAngelis (william@sendpepper.com)
   */
function create_mprogram_taxonomies() 
{
	register_taxonomy(
		'mprogram',
		array('oaplesson'),
			array(
				'labels' => array(
					'name' => 'Programs',
					'singular_name' => 'Programs',
					'search_items' => 'Search Programs',
					'all_items' => 'All Programs',
					'parent_item' => 'Parent Programs',
					'parent_item_colon' => 'Parent Programs',
					'edit_item' => 'Edit your Program',
					'update_item' => 'Update your Program',
					'add_new_item' => 'Add a New Program',
					'new_item_name' => 'New Program Name',
				),
				'hierarchical' => true,
				'query_var' => true,
				'public' => true,
				'rewrite' => array( 'slug' => 'mprogram' ),
				'label' => 'Programs'
			)
	);
}
add_action('init', 'create_mprogram_taxonomies', 0);
  /*
  ** Prints the box content
  ** Returns: Html for plugin
  */
 function oap_membership_box($post) 
 {
	global $metaBox;

	echo '
	<style>
	.ms-tabbed-sections
	{
		border: none;
	}
	.ms-tabbed-sections ul
	{
		background-image: none;
		background-color: #ffffff;
		border: none;
	}
	.ms-tabbed-sections .ui-tabs-nav li
	{
		border-radius: 0px!important;
		font-size: 11pt;
		background-image: none;
		background-color: #fff;
		border: 1px solid lightgrey!important;
		border-bottom: 1px solid lightgrey!important;
		margin-right: 2px;
	}
	.ms-tabbed-sections .ui-state-active a
	{
		background-color: #10293f!important;
		color: #fff!important;
	}
	</style>
	<div class="ms-tabbed-sections">
	<ul>
		<li class="ms-lesson-number"><a href="#ms-lesson-number">Menu Item</a></li>
		<li class="ms-page-layout"><a href="#ms-page-layout">Page Layout</a></li>
		<li class="ms-info-text"><a href="#ms-info-text">Info Text</a></li>
		<li class="ms-download-files"><a href="#ms-download-files">Downloadable Files</a></li>
		<li class="ms-video-stream"><a href="#ms-video-stream">Video Streaming</a></li>
		<li class="ms-custom-html"><a href="#ms-custom-html">Custom HTML</a></li>
		<li class="ms-advanced-settings"><a href="#ms-advanced-settings">Advanced Settings</a></li>
	</ul>
	<div id="ms-lesson-number" class="ms-tab-sections ms-lesson-number">';
	echo "<table width='100%'>
	<tbody>
	<tr><td>";
		if (function_exists('wp_nonce_field')) 
		{
			wp_nonce_field('awd_nonce_action','awd_nonce_field');
		}
		foreach ($metaBox['fields'] as $field) 
		{
			echo '<div class="awdMetaBox">';
			//get attachment id if it exists.
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) 
			{
				case 'topinfo': ?>
 					<div><br />
	<!--div style="float:right;">
  <a href="http://officeautopilot.com/mp/helpfiles/oapoverviewcontent.html" class="fancybox fancybox-iframe" name="Oap Overview content">
					 <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" />
  </a>
  </div-->
					<?php echo $field['desc']; ?>
  					</div>
  				<?php 
  				break;

				case 'radio':
					$oapoverviewcbx = get_post_meta( $post->ID, '_oap_overview_cbx', true );?>
					<div><br />
					<span style="width: 40%; float: left;"> <?php echo $field['desc']; ?></span>
					<!--input type="radio" name="<?php echo $field['name']; ?>"
					id="<?php echo $field['id']; ?>" value="overviewimagecbx"
					<?php if($oapoverviewcbx=='overviewimagecbx'){echo 'checked';} ?>-->
					</div>
				<?php 
				break;

				case 'media':
					echo $field['desc']; ?>
					<div class="awdMetaImage">
					<div class="meta_upload_buttons" style="margin-bottom: 10px; display: inline-block;">
						<label for="upload_image" style="display: inline-block; margin-bottom: 10px;"><strong>Add a URL or Upload an image</strong></label>
						<input class="upload metaValueField" style="width: 99%;" type="text" id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?>" value="<?php $attachUrl = wp_get_attachment_url($meta); echo $attachUrl; ?>" /><br />
						<input id="upload_image_button" class="upload-button" type="button" value="Upload Image" />
						<input id="remove_image_button" class="removeImageBtn1" type="button" value="Remove Image" />
					</div>
					<?php 
					if ($meta) 
					{
						echo wp_get_attachment_image( $meta, 'thumbnail', true);
						$attachUrl = wp_get_attachment_url($meta);
					//echo '<p class="imgurl">URL: <a target="_blank" href="'.$attachUrl.'">'.$attachUrl.'</a></p>'; 
					}
					else 
					{ echo '<p class="imgurl"><img class="ms-preview-thumb" src="'.plugins_url().'/membership-simplified-for-oap-members-only/images/noimg.png" width="150px" height="150px"></p>'; 
					}
					?>
					</div>
					<!-- end .awdMetaImage -->
				<?php 
				break;

				case 'textarea':
					$oapoverviewtext = get_post_meta( $post->ID, '_oap_overview_text', true ); ?>
					<div class="oap_overview_text">
					<p><span style="float:left; width:auto;"><?php echo $field['desc']; ?></span> <a style="float:right;" name="Overview Text" class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/overviewtext.html"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"> </a> </p>
					<div class="menu_item_desc">
					  <textarea name="<?php echo $field['name']; ?>"
					id="<?php echo $field['id']; ?>" rows="7" cols="27" ><?php echo esc_attr($oapoverviewtext);?></textarea>
					<script type="text/javascript">
					jQuery(document).ready(function() 
					{
					  	jQuery('.removeImageBtn1').click(function() 
					  	{
							jQuery('.upload').val(jQuery('.upload').val() + 'null');
							jQuery("#publish").click();
						});

						var _custom_media = true;
						_orig_send_attachment = wp.media.editor.send.attachment;

						jQuery('#upload_image_button').click(function(e) 
						{
							var send_attachment_bkp = wp.media.editor.send.attachment;
							var button = jQuery(this);
							var id = button.attr('id').replace('_button', '');
							_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment)
							{
								if ( _custom_media ) 
								{
							    		jQuery('#_oap_overview_image').val(attachment.url);

							    		// On URL change... change the preview image
									jQuery('.attachment-thumbnail, .ms-preview-thumb').attr('src', attachment.url);
								} 
								else 
								{
						    			return _orig_send_attachment.apply( this, [props, attachment] );
								};
							}

							wp.media.editor.open(button);
							return false;
						});

						jQuery('.add_media').on('click', function()
						{
							_custom_media = false;
						});

					});
					</script>
					</div>
					</div>
				<?php 
				break;

				case 'text':
					$oaplesson_number = $post->menu_order; ?>
					<div class="oap_lesson_number">
					<span style="float:left; width:auto;"><?php echo $field['desc']; ?></span> <a style="float:right;" href="http://officeautopilot.com/mp/helpfiles/lessonnumber.html" class="fancybox fancybox-iframe" name="Lesson Number"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"> </a>
					<div class="menu_item_desc">
					<input type="text" name="<?php echo $field['name']; ?>"
					id="<?php echo $field['id']; ?>" value="<?php echo esc_attr($oaplesson_number);?>" />
					</div>
					</div>
				<?php 
				break;
  }
  echo '</div> <!-- end .awdMetaBox -->';
		  } //end foreach
   echo "</td></tr></tbody></table>";
	$oaploadsettings= get_post_meta($post->ID, '_oap_load_settings', true );
	$oapfullvideosharedposition= get_post_meta($post->ID, '_oap_fullvideo_shared_position', true );
	$oapvideoimageposition= get_post_meta($post->ID, '_oap_video_image_position', true );
	$oapvideothumbnail= get_post_meta($post->ID, '_oap_video_thumbnail', true );//In Development
	$oapvideoautoplay= get_post_meta($post->ID, '_oap_video_autoplay', true );//In Development
	$oaplessonmenuposition= get_post_meta($post->ID, '_oap_lesson_menu_position', true );
	$oaplessonmenucategory= get_post_meta($post->ID, '_oap_lesson_menu_category', true );
	$oapmediatexttemplate= get_post_meta($post->ID, '_oap_media_text_template', true );
	$oap_lesson_title_setting= get_post_meta($post->ID, '_oap_lesson_title_setting', true );
	$oap_lesson_number_setting= get_post_meta($post->ID, '_oap_lesson_number_setting', true );
	$oaptitlelesson_position= get_post_meta($post->ID, '_oap_title_lessonnumber_setting', true );
	$oapdownloaditem = get_post_meta( $post->ID, 'oap_download_item', true );
	$oapwywtlyesno = get_post_meta( $post->ID, '_oap_wywtl_yesno', true );
	$oaplengthyesno = get_post_meta( $post->ID, '_oap_length_yesno', true );
	$oapinfoboxheading= get_post_meta( $post->ID, '_oap_infobox_heading', true );
	$oapinfoboxlength= get_post_meta( $post->ID, '_oap_infobox_length', true );
	$oapwywtltext = get_post_meta($post->ID, '_oap_wywtl_text', true );
	$oapwywtllength = get_post_meta($post->ID, '_oap_wywtl_length', true );
	$oapmmiimage = get_post_meta( $post->ID, '_oap_mmi_image', true );
	$oapmmivideo = get_post_meta( $post->ID, '_oap_mmi_video', true );
	$oapcustomhtml = get_post_meta( $post->ID, '_oap_custom_html', true);
	$oapsidebarposition = get_post_meta( $post->ID, '_oap_sidebar_position', true );
	// fetch data for Inner Override
	$oaptemplateoverride = get_post_meta( $post->ID, '_oap_template_override', true );
	$template_max_height=  get_post_meta( $post->ID, '_oap_template_max_height', true );
	  $template_max_width=  get_post_meta( $post->ID, '_oap_template_max_width', true );
	$oap_media_template_custom_css = get_post_meta( $post->ID, '_oap_media_template_custom_css', true );
	$oap_text_template_custom_css = get_post_meta( $post->ID, '_oap_text_template_custom_css', true );
	// fetch data for Outer Override
	$oapoutertemplateoverride = get_post_meta( $post->ID, '_oap_outer_template_override', true );
	$template_outer_max_height=  get_post_meta( $post->ID, '_oap_outer_template_max_height', true );
	  $template_outer_max_width=  get_post_meta( $post->ID, '_oap_outer_template_max_width', true );
	$oap_outer_media_template_custom_css = get_post_meta( $post->ID, '_oap_outer_media_template_custom_css', true );
	$oap_outer_text_template_custom_css = get_post_meta( $post->ID, '_oap_outer_text_template_custom_css', true );
	// Use nonce for verification
	wp_nonce_field( 'save_oap_meta', 'oap_nonce' );
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
  ?>
  <script>
  jQuery(document).ready(function() {
  jQuery('#upload_mmi_button').click(function() {
   formfield = jQuery('#_oap_mmi_image').attr('name');
   tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
   window.send_to_editor = function(html){
	 imgurl = jQuery('img',html).attr('src');
	 jQuery('#_oap_mmi_image').val(imgurl);
	 tb_remove();
	};
   return false;
  });
  });
  </script>
  <script>
  jQuery(document).ready(function() {
  jQuery('#upload_mmv_button').click(function() {
   formfield = jQuery('#_oap_mmi_video').attr('name');
   tb_show('', 'media-upload.php?type=video&amp;TB_iframe=true');
   window.send_to_editor = function(html){
	 imgurl = jQuery(html).attr('href');
	 jQuery('#_oap_mmi_video').val(imgurl);
	 tb_remove();
	};
   return false;
  });
  });
  </script>
  <?php 
	if (isset($pilotpress) && $pilotpress instanceof PilotPress){
	  $my_pilotpress = &$pilotpress;
	} else {
	  $my_pilotpress = new PilotPress;
	}
	$all_items = PilotPress::get_oap_items();
	?>
  </div>
  <div id="ms-page-layout" class="ms-tab-sections ms-page-layout">
	<table width="100%">
	<tbody>
	  <tr>
		<th colspan="3" class="tableheader" align="left"><table width="205px"><tbody><tr><td><span class="sectionTitle">Set the Page Layout &nbsp;</span></td><td><a href="http://officeautopilot.com/mp/helpfiles/pagelayout.html" class="fancybox fancybox-iframe" name="Page Layout"><img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip"  /></a></td></tr></tbody></table>
		</th>
	  </tr>
	 <tr>
		<td align="left" class="tabledata left"><label for="_oap_media_text_template" class="sec_l"> <strong style="float:left; width:auto;">Video or Text Template</strong> <a style="float:right; width:auto;" href="http://officeautopilot.com/mp/helpfiles/mediaortexttemplate.html" class="fancybox fancybox-iframe" name="Media Or Text Template"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		  <select id="_oap_media_text_template"
		  name="_oap_media_text_template" class="selection" style="width:100%;"/>
		  <option value="Media Template"
		  <?php if($oapmediatexttemplate=='Media Template'){echo 'selected';}?>>Video Template</option>
		   <option value="Video Comments"
		  <?php if($oapmediatexttemplate=='Video Comments'){echo 'selected';}?>>Video & Comments</option>
		  <option value="Text Template"
		  <?php if($oapmediatexttemplate=='Text Template'){echo 'selected';}?>>Text Template</option>
		  </select></td>
		<td align="left" class="tabledata center" id="fullvideo_shared_position"><label for="_oap_fullvideo_shared_position"class="sec_l"><strong>Full Width Video or Shared</strong> <a href="http://officeautopilot.com/mp/helpfiles/fullwidthvideoorshared.html" class="fancybox fancybox-iframe" name="Full Width Video or Shared"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		  <select id="_oap_fullvideo_shared_position"
		  name="_oap_fullvideo_shared_position" class="selection" style="width:100%;"/>
		 <option value="Full Width"
		  <?php if($oapfullvideosharedposition=='Full Width'){echo 'selected';}?>>Full Width</option>
		  <option value="Shared"
		  <?php if($oapfullvideosharedposition=='Shared'){echo 'selected';}?>>Shared</option>
	  <option value="720 by 420"
		  <?php if($oapfullvideosharedposition=='720 by 420'){echo 'selected';}?>>720 by 420</option>
		  </select>
	  </td>
		<td align="left" class="tabledata right" id="video_image_position" ><label for="_oap_video_image_position"class="sec_l"><strong>Video Position</strong> <a href="http://officeautopilot.com/mp/helpfiles/mediaitemposition.html" class="fancybox fancybox-iframe" name="Video Or Image Position"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		  <select id="_oap_video_image_position"
		  name="_oap_video_image_position" class="selection" style="width:100%;"/>
		 <option value="Left"
		  <?php if($oapvideoimageposition=='Left'){echo 'selected';}?>>Left</option>
		  <option value="Right"
		  <?php if($oapvideoimageposition=='Right'){echo 'selected';}?>>Right</option>
		  </select>
	  </td>
	  </tr>
		<tr><td style="height:25px;">&nbsp;</td></tr>
		<tr class="title-settings-row">
			<td align="left" class="tabledata left">
				<label for="_oap_lesson_title_setting" class="sec_l"> <strong style="float:left; width:auto;">Title On / Off</strong> <a style="float:right; width:auto;" href="http://officeautopilot.com/mp/helpfiles/pagetitle.html" class="fancybox fancybox-iframe" name="Lesson Title"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
				  <select id="_oap_lesson_title_setting" name="_oap_lesson_title_setting" class="selection" style="width:100%;"/>
				  <option value="Enabled"
				  <?php if($oap_lesson_title_setting=='Enabled'){echo 'selected';}?>>Enabled</option>
				  <option value="Disabled"
				  <?php if($oap_lesson_title_setting=='Disabled'){echo 'selected';}?>>Disabled</option>
				  </select>
			</td>
			<td align="left" class="tabledata center">
				<label for="_oap_lesson_number_setting" class="sec_l"><strong>Lesson Number On / Off</strong> <a href="http://officeautopilot.com/mp/helpfiles/lessonnumberenabled.html" class="fancybox fancybox-iframe" name="Lesson Number"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
				  <select id="_oap_lesson_number_setting" name="_oap_lesson_number_setting" class="selection" style="width:100%;"/>
				 <option value="Enabled"
				  <?php if($oap_lesson_number_setting=='Enabled'){echo 'selected';}?>>Enabled</option>
				  <option value="Disabled"
				  <?php if($oap_lesson_number_setting=='Disabled'){echo 'selected';}?>>Disabled</option>
				  </select>
		  	</td>
			<td align="left" class="tabledata right" style="margin-bottom:40px;">
			  <label for="_oap_video_image_position"class="sec_l"><strong>Title & Lesson Number - Position</strong><a href="http://officeautopilot.com/mp/helpfiles/titleandlessonnumberposition.html" class="fancybox fancybox-iframe" name="Video Or Image Position"><img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/></a></label>
				  <select id="_oap_title_lessonnumber_setting" name="_oap_title_lessonnumber_setting" class="selection" style="width:100%;"/>
					<option value="TLeft" <?php if($oaptitlelesson_position=='TLeft'){echo 'selected';}?>>Top Left</option>
					<option value="TCenter" <?php if($oaptitlelesson_position=='TCenter'){echo 'selected';}?>>Top Center</option>
					<option value="TRight" <?php if($oaptitlelesson_position=='TRight'){echo 'selected';}?>>Top Right</option>
					<option value="MLeft" id="mleft" <?php if($oaptitlelesson_position=='MLeft'){echo 'selected';}?>>Main Left</option>
					<option value="MCenter" id="mcenter" <?php if($oaptitlelesson_position=='MCenter'){echo 'selected';}?>>Main Center</option>
					<option value="MRight" id="mright" <?php if($oaptitlelesson_position=='MRight'){echo 'selected';}?>>Main Right</option>
				  </select>
		  	</td>
	  	</tr>
	  	<tr class="sidebar-settings-row">
			<td  class="tabledata left" align="left"><label for="_oap_sidebar_position" class="sec_l"><strong>Sidebar Nav - Enabled/Disabled</strong> <a href="http://officeautopilot.com/mp/helpfiles/sidebarposition.html" class="fancybox fancybox-iframe" name="Enabled/Disabled Sidebar Nav"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
			  <select id="_oap_sidebar_position"
			  name="_oap_sidebar_position" class="selection" style="width:100%;" />
			  <option value="Enabled"
			  <?php if($oapsidebarposition=='Enabled'){echo 'selected';}?>>Enabled</option>
			  <option value="Disabled"
			  <?php if($oapsidebarposition=='Disabled'){echo 'selected';}?>>Disabled</option>
			  </select>
			</td>
			<td align="left" class="tabledata center" id="sidebar_nav_cat"><label for="_oap_lesson_menu_category" class="sec_l"> <strong>Sidebar Nav - Program</strong> <a href="http://officeautopilot.com/mp/helpfiles/lessonmenucategory.html" class="fancybox fancybox-iframe" name="Select program for sidebar menu"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
			  <?php //wp_dropdown_categories('show_option_none=Select program for sidebar');
			  $cats_array = get_categories(array('taxonomy' => 'mprogram','hide_empty' => 0)); ?>
			  <select id="_oap_lesson_menu_category" name="_oap_lesson_menu_category" style="width:100%;">
				<?php foreach ( $cats_array as $category ) { ?>
				<option value="<?php echo $category->cat_ID; ?>" <?php if($category->cat_ID == $oaplessonmenucategory){ echo "selected=selected"; } ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			  </select>
			</td>
			<td align="left" class="tabledata right" id="sidebar_nav_pos"><label for="_oap_lesson_menu_position" class="sec_l"><strong>Sidebar Nav - Position</strong> <a href="http://officeautopilot.com/mp/helpfiles/lessonmenuposition.html" class="fancybox fancybox-iframe" name="Lesson Menu Position"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
			  <select id="_oap_lesson_menu_position"
			  name="_oap_lesson_menu_position" class="selection" style="width:100%;" />
			  <option value="Left"
			  <?php if($oaplessonmenuposition=='Left'){echo 'selected';}?>>Left</option>
			  <option value="Right"
			  <?php if($oaplessonmenuposition=='Right'){echo 'selected';}?>>Right</option>
			  </select>
			</td>
		</tr>
  <!--tr>
	<td align="left" class="tabledata left"><label for="_oap_media_text_template" class="sec_l"> <strong>Template
		Override:</strong> <a href="http://officeautopilot.com/mp/helpfiles/templateoverride.html" class="fancybox fancybox-iframe" name="Template Override Section"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		<select id="_oap_template_override"
		  name="_oap_template_override" class="selection" style="width:100%;" />
		<option value="Disabled"
		  <?php if($oaptemplateoverride=='Disabled'){echo 'selected';}?>>Disabled</option>
	<option value="Enabled"
		  <?php if($oaptemplateoverride=='Enabled'){echo 'selected';}?>>Enabled</option>
		</select></td>
	  <td align="left" class="tabledata center" id="temp_override_height"><label for="_oap_video_image_position" class="sec_l"><strong>Fixed Height:</strong> <a href="http://officeautopilot.com/mp/helpfiles/fixed_height.html" class="fancybox fancybox-iframe" name="Fixed Height- Media or Text Template"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
		<input type="text" name="_oap_template_max_height" id="_oap_template_max_height" value="<?php echo $template_max_height;?>" placeholder="Start with 1000px and then increase or decrease." class="width_input reset">
	  </td>
	  <td align="left" class="tabledata right" id="temp_override_width"><label for="_oap_temp_override_width" class="sec_l"><strong>Fixed Width:</strong> <a href="http://officeautopilot.com/mp/helpfiles/fixedwidth.html" class="fancybox fancybox-iframe" name="Fixed Width - Media or Text Template"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
		<?php if($oaptemplateoverride == 'Enabled' && $template_max_width =="")
		  {
				$max_width=get_option('template_width');
		  }
		  else if($oaptemplateoverride == 'Enabled' && $template_max_width !="")
		  {
				$max_width=$template_max_width;
		  }
		  else
		  {
		  $max_width="";
		  }
		  ?>
		<input type="text" name="_oap_template_max_width" id="_oap_template_max_width" value="<?php echo $max_width;?>" placeholder="Start with 960px and then increase or decrease." class="width_input reset">
	  </td>
	</tr>
	<tr>
	  <td align="left" class="tabledata left" id="page_background_color"><label for="_oap_media_text_template"class="sec_l"> <strong>Background
		Color:</strong> <a href="http://officeautopilot.com/mp/helpfiles/page_background_color.html" class="fancybox fancybox-iframe" name="Media/Text Template Background Color"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		<input type="text" name="_oap_page_background_color" id="_oap_page_background_color" value="<?php echo get_post_meta($post->ID, '_oap_page_background_color', true );?>"></td>
	  <td align="left" class="tabledata center" id="oap_template_custom_css"><label for="_oap_template_custom_css" class="sec_l"><strong>Add your own CSS for this template:</strong> <a href="http://officeautopilot.com/mp/helpfiles/fixed_height.html" class="fancybox fancybox-iframe" name="Write Own CSS"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
	 <textarea name="_oap_media_template_custom_css" id="_oap_media_template_custom_css"><?php echo $oap_media_template_custom_css;?></textarea>
	 <textarea name="_oap_text_template_custom_css" id="_oap_text_template_custom_css" style="display:none;"><?php echo $oap_text_template_custom_css;?></textarea>
	  </td>
	  <td align="left" class="tabledata right">&nbsp;</td>
	</tr-->
  </table>
  </div>

  <div id="ms-info-text" class="ms-tab-sections ms-info-text">
  <table width="100%">
	<tr>
	  <th class="tableheader" vertical-align="top" align="left"><table style="width:auto;"><tbody><tr><td><span class="sectionTitle">Add Info Text &nbsp;</span></td><td><a href="http://officeautopilot.com/mp/helpfiles/infoboxtextcontent.html" class="fancybox fancybox-iframe" name="Info Text"><img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip"  /></a></td></tr></tbody></table></th>
	  <td align="right"><table>
		  <tr class="_on_off_info_box">
			<?php $onoffinfobox = get_post_meta($post->ID, '_on_off_info_box', true );
		 if($onoffinfobox=='ON'){ $checked='checked="checked"';}else{ $checked='';}
			?>
			<td><input type="checkbox" id="_on_off_info_box" name="_on_off_info_box" <?php echo $checked;?> value="ON"/></td>
		  </tr>
		</table></td>
	</tr>
  </table>
  <table width="100%" style="display:inline-table;">
	<tbody class="infoboxdiv" style="display:none;">
	  <tr>
		<td width="48%" style="display: inline-block;min-width: 200px;margin-bottom: 20px;margin-top:15px;margin-right:20px;">
	<table width="100%" cellpadding="0" cellspacing="0" class="ibtctable1">
			<tr>
			  <td class="" align="left">
				<div class="textarealabel"><strong>1st Text Area - Title</strong>
		  <span class="inner_st">&nbsp;<strong>On</strong>
				  <input type="radio" name="_oap_wywtl_yesno" id="_oap_wywtl_yesno" value="On" <?php if($oapwywtlyesno=='On'){echo 'checked';}?>>
				  &nbsp; <strong>Off</strong>
				  <input type="radio" name="_oap_wywtl_yesno" id="_oap_wywtl_yesno" value="Off" <?php if($oapwywtlyesno=='Off'){echo 'checked';}?>>
			 </span>   </div>
			  </td>
			</tr>
			<tr>
			  <td class="tabledata2" valign="top"><input type="text" id="_oap_infobox_heading"
			  name="_oap_infobox_heading"
			  value="<?php echo esc_attr($oapinfoboxheading); ?>"
			  class="ibtextinput"
			  placeholder="Suggestion - What you will Learn." style="width:100%; float:left;"/></td>
			</tr>
			<tr>
			  <td align="left" class="tabledata2"><label>
				<div class="textarealabel"><strong>1st Text Area</strong></div>
				</label>
				<textarea class="ibtextarea" name="_oap_wywtl_text" id="_oap_wywtl_text"><?php echo esc_attr($oapwywtltext);  ?></textarea>
			  </td>
			</tr>
		  </table></td>
		<td width="48%" style="display: inline-block;min-width: 200px;margin-top:15px;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" class="ibtctable2">
			<tr>
			  <td class="" align="left">
				<div class="textarealabel"><strong class="c_lft">2nd Text Area - Title</strong> <span class="inner_st">&nbsp;<strong>On </strong>
				  <input type="radio" name="_oap_length_yesno" id="_oap_length_yesno"
			  value="On" <?php if($oaplengthyesno=='On'){echo 'checked';}?>>
				  &nbsp; <strong>Off</strong>
				  <input type="radio" name="_oap_length_yesno"
			  id="_oap_length_yesno" value="Off"
			  <?php if($oaplengthyesno=='Off'){echo 'checked';}?>>
				</span></div></td>
			</tr>
			<tr>
			  <td class="tabledata2" valign="top"><input type="text" id="_oap_infobox_length" name="_oap_infobox_length"
			  value="<?php echo esc_attr($oapinfoboxlength);  ?>"
			  class="ibtextinput" placeholder="Suggestion - Length" style="float:left;"/></td>
			</tr>
			<tr>
			  <td align="left" class="tabledata2"><label>
				<div class="textarealabel"><strong>2nd Text Area</strong></div>
				</label>
				<textarea id="_oap_wywtl_length" name="_oap_wywtl_length" class="ibtextarea"/><?php echo trim(esc_attr($oapwywtllength));?></textarea>
			  </td>
			</tr>
		  </table></td>
	  </tr>
	</tbody>
  </table>
  </div>

  <div id="ms-download-files" class="ms-tab-sections ms-download-files">
  <table  width="100%">
	<tbody>
	  <tr>
		<th class="tableheader" vertical-align="top" align="left"><table style="width:auto;"><tbody><tr><td><span class="sectionTitle">Add Downloadable Files &nbsp;</span></td><td><a href="http://officeautopilot.com/mp/helpfiles/downloadablefiles.html" class="fancybox fancybox-iframe" name="Downloadable Files"><img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip"  /></a></td></tr></tbody></table></th>
		<td align="right" colspan="2"><table>
			<tr class="_on_off_download">
			  <?php $onoffdownload = get_post_meta( $post->ID, '_on_off_download', true );
		if($onoffdownload=='ON'){ $checked='checked="checked"';}else{ $checked='';}
			?>
			  <td><input type="checkbox" id="_on_off_download" name="_on_off_download" value="ON" <?php echo $checked; ?>/></td>
			</tr>
		  </table></td>
	  </tr>
	  <tr> </tr>
	<tbody class="downloaddiv" style="display:none;">
	<tr>
	<td width="33%" style="min-width:220px; margin-bottom:20px;">
	<div class="dladd_outer">
	  <table class="dladd" cellpadding="0" cellspacing="0">
		<tbody>
		  <tr>
			<td align="left" class="tabledata dloadsleft"><label for="oap_download_name"><!-- <strong><span style="color:#c13130; font-family: League; font-weight: 100; font-size: 20px; float:left; width:auto;">Add Your Download Items here</span></strong> <a style="float:right; width:35px;" href="http://officeautopilot.com/mp/helpfiles/adddownloaditems.html" class="fancybox fancybox-iframe" name="Info Box - Download Items"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a> <br />
			  <br /> -->
			  <span style="float: left;margin-bottom: 20px;display: inline-block; width: 100%; font-style: italic;">Add your downloads here &amp; sort the order on the right.</span>
			  <strong>Title</strong> </label>
			  <div id="download_msg"></div>
			  <input type="text" id="oap_download_name"
				  name="oap_download_name" value="" class="ibtextinput" /></td>
		  </tr>
	  <tr>
			<td class="tabledata dloadsleft"><label for="oap_download_item"><strong>Type of File</strong> </label>
			  <table width="100%">
				<tbody>
				  <tr>
					<td><select name="_oap_download_item" style="width:100%;min-width:222px;" onchange="downloadtype(this.value)">
							<option value="download_hostedtype">ONTRAPORT Hosted File</option>
							<option value="download_streamtype">Link to a File</option>
							<option value="download_manualtype">Upload a File</option>
						  </select>
					</td>
				  </tr>
				</tbody>
			  </table></td>
		  </tr>
		  <tr>
			<td class="tabledata dloadsleft">
		<div id="download_hosted_video">
		<?php  if(count($GLOBALS["oap"]) > 0) { ?>
			  <label for="oap_fm_item"><strong style="float:left; width:auto;">Select a File</strong> <a style="float:right; width:35px;" href="http://officeautopilot.com/mp/helpfiles/oapfilemanageritem.html" class="fancybox fancybox-iframe" name="Oap File Manager Item"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a> </label>
			  <div class="inn_table">
				<table width="100%" cellpadding="0" cellspacing="0">
				  <tbody>
					<tr>
					   <td><select id="oap_lesson_videos" style="float:left;" name="oap_lesson_videos" class="dlselection" />
						<option value="">Select an ONTRAPORT file</option>
					  <?php
						if ( isset($all_items["files"]['list']) ) {
						  foreach($all_items["files"]['list'] as $index => $item) {
							echo "<option value='{$item["name"]},{$item["path"]}'>{$item["name"]}</option>"; 
						  } 
						} ?>
						</select>
					  </td>
					</tr>
				  </tbody>
				</table>
			  </div>
		  <?php } ?></div>
		  <div id="download_stream_video" style="display:none;">
		<label for="oap_download_item"><strong>Enter a URL to Downloadable File</strong> </label>
			  <table width="100%">
				<tbody>
				  <tr>
					<td><input id="_oap_download_item" type="text" size="30" name="_oap_download_item" value="" class="mminput" /></td>
				  </tr>
				</tbody>
			  </table></div>
		<div id="download_manual_video" style="display:none;">
		<label for="oap_download_item"><strong>Downloadable File</strong> </label>
			  <table width="100%">
				<tbody>
				  <tr>
					<td class="uploadfield"><input type="file" id="oap_download_item" name="oap_download_item" value="" class="uploadfield" /></td>
				  </tr>
				</tbody>
			  </table></div>
	  </td>
		</tr>
		<tr>
		  <td class="tabledata dloadsleft"><table width="100%">
			  <tbody>
				<tr>
				  <td valign="top" class="dladditemtext" style="padding: 0px!important;">
					<div align="center">
					  <input class="dladditem" type="submit" id="adddownload" name="adddownload" value="Add Item">
					</div></td>
				</tr>
			  </tbody>
			</table></td>
		</tr>
		</tbody>
	  </table>
	</div>
	</td>
	<td width="3%">&nbsp;</td>
	<td width="58%" valign="top" class="dltablert" style="min-width:220px;" valign="top"><table width="100%" class="dlorder">
		  <tbody>
			<tr>
			  <td class="tabledata dloadsright" valign="top"><!--<label
				  for="oap_download_order"><strong class="c_lft">Download Order</strong><a href="http://officeautopilot.com/mp/helpfiles/downloadorder.html" class="fancybox fancybox-iframe" name="DownLoad Order"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a> </label>
				<br />
				<br />-->
				
				<div class="dllessoninfo" id="contentLeft"><span class="c_lft"><strong>Downloads</strong></span> <!-- <span style="float: right;"><strong>Delete</strong></span> --><br />
				<br />
				</div>
				<div id="contentDragDrop">
				  <!-- Drag and Drop Div -->
				  	<ul>
				 	 <?php
					global $wpdb;
					$table_name = $wpdb->prefix . "download_listing";
					$query = "select * 
					from $table_name 
					where postId = $post->ID 
					order by recordListingID";
					$results = $wpdb->get_results($query);
					if ( is_array($results) )
					{
						foreach ( $results as $row )
						{ ?>
							<li id="recordsArray_<?php echo $row->recordID; ?>" class="sortlisting">
								<span class="block_in_lft"><?php echo stripslashes($row->recordText); ?></span>
								<div class="deletesorting">
									<a href="<?php echo $row->recordID; ?>" class="deldownload"> 
										<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/delete.png" />
									</a>
								</div>
							</li>
						<?php 
						}
					} ?>
					</ul>
				</div>
			</td>
			</tr>
			<tr>
			  <td class="tabledata dloadsright" valign="bottom"><i class="c_lft"><span>Select, drag and drop
				the downloads above into your desired order.</span></i><!-- <span class="c_rt">
				<input type="image"
				  src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/save.png"
				  style="vertical-align: bottom;">
				</span> --></td> 
			</tr>
		  </tbody>
		</table></td>
	  </tbody>
  </table>
  <div id="mmHide">
</div>
</div>

<div id="ms-video-stream" class="ms-tab-sections ms-video-stream">
	<table width="100%">
	  <tr>
		<th class="tableheader" vertical-align="top" align="left"><table style="width:auto;"><tbody><tr><td><span class="sectionTitle">Add Videos &nbsp;</span></td><td><a href="http://officeautopilot.com/mp/helpfiles/addvideos.html" class="fancybox fancybox-iframe" name="Add Videos"><img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" /></a></td></tr></tbody></table>
		</th>
		<th class="tableheader">&nbsp;</th>
		<td align="right" colspan="2"><table>
			<tr class="_on_off_main_media">
			 <td>
		<?php
		$user_count = $wpdb->get_var( "SELECT COUNT(meta_key) FROM $wpdb->postmeta WHERE post_id=$post->ID AND meta_key='_on_off_main_media'" );
			 if($user_count > 0){
		 $onoffmainmedia = get_post_meta( $post->ID, '_on_off_main_media', true );
		 if($onoffmainmedia == 'ON'){$checked='checked="checked"';}else{ $checked='';} ?>
		<input type="checkbox" id="_on_off_main_media" name="_on_off_main_media" value="ON" <?php echo $checked; ?>/>
		<?php } else {?>
		<input type="checkbox" id="_on_off_main_media" name="_on_off_main_media" value="ON" checked="checked"/>
		<?php } ?>
			  </td>
			</tr>
		  </table></td>
	  </tr>
	  <tbody class="mainmediadiv" <?php if($onoffmainmedia != 'ON'){ echo "style='display:none'";}?>>
		<tr>
		  <td class="tabledatafull" colspan="3"></td>
		</tr>
		<tr>
		  <td valign="top" style="width:35%;"><div class="dladd_outer">
			  <table class="dladd" style="display:inline-block;">
				<tbody>
				  <tr>
					<td align="left" class="tabledata dloadsleft"><label for="oap_download_name"><!-- <strong><span style="color:#c13130; font-family: League; font-weight: 100; font-size: 20px; float:left; width:auto;">Add a Video</span></strong> <a style="float:right; width:35px;" href="http://officeautopilot.com/mp/helpfiles/mediaitems.html" class="fancybox fancybox-iframe" name="Info Box - Download Items"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a> <br />
					  <br /> -->
		  <span style="float: left;margin-bottom: 20px;display: inline-block; width: 100%; font-style: italic;">Add your videos here & sort the order on the right.</span>
		  <br />			 <div id="media_msg"></div>
					  <strong>Item Name</strong> </label>
					  <input type="text" id="oap_media_name" name="oap_media_name" value="" class="ibtextinput" />
					</td>
				  </tr>
				  <tr>
					<td class="tabledata dloadsleft"><label for="oap_media_item"><strong>Select a Video Type</strong> </label>
					  <table width="100%">
						<tbody>
						  <tr>
							<td class="selectsize">
		  <select name="_oap_mmi_item" style="width:100%;min-width:222px;" onchange="videotype(this.value)">
			<option value="oapvideohosted">ONTRAPORT Hosted Video</option>
			<option value="oapvideo">Youtube, Vimeo, or Wistia URL</option>
			<option value="oapamazons3video">Amazon S3 or Custom URL</option>
			<!--<option value="oapembededvideo">Add Video Embed Code</option>-->
		  </select>
		  </td>
						  </tr>
						</tbody>
					  </table></td>
				  </tr>
				  <tr>
					<td class="tabledata dloadsleft"><div id="hosted_video">
						<?php if(count($GLOBALS["oap"]) > 0) { ?>
						<label for="oap_fm_item"><strong>Select OAP Hosted Video </strong> </label>
						<table width="100%">
						  <tbody>
							<tr>
							  <td>
		  <select id="oap_mmi_hosted_video" name="oap_mmi_hosted_video" class="mmselectio" style="width:100%;" />
		  <?php 
			if ( isset($all_items["videos"]["list"]) ) { 
			foreach($all_items["videos"]["list"] as $index => $item) { 
			  echo "<option value='{$item["video_id"]}'>{$item["name"]}</option>"; 
			} 
		  }?>
		  </select>
							  </td>
							</tr>
							<!--IN DEVELOPMENT... ADDING AUTOPLAY-->
							<tr style="display:none;">
							  <td>
							  <div id="vid_thumbnail">
								<table width="100%">
								<tbody>
								<tr>
								<td>
								  <div style="width:100%">
								  <br />
									<div class="videoplayer"><b>Video Player</b></div>
									<div class="videopla">
									  <select id="_oap_video_player">
										<option value="hidden">Play Button Only</option>
										<option value="player1">Player 1</option>
										<option value="player2">Player 2</option>
										<option value="player3">Player 3</option>
									  </select>
									</div>
								  </div>
								</td>
								<td>
								  <div style="width:100%">
								  <br />
									<div class="videoautoplay"><b>Autoplay: On or Off</b></div>
									<div class="videoautopla">
									  <select id="_oap_video_autoplay">
										<option value="on">On</option>
										<option value="off">Off</option>
									  </select>
									</div>
								  </div>
								</td>
								</tr>
								</tbody>
								</table>
							  </div>
							  </td>
							</tr>
							<tr>
							  <td>
							  <div id="vid_thumbnail">
								  <br />
									<div class="uploadimage"><strong>Upload a Video Thumbnail</strong></div>
									<div class="meta_upload_buttons">
									  <label for="upload_video_thumbnail">
									  <input id="_oap_video_thumbnail" name="_oap_video_thumbnail" type="text" size="30" class="metaValueField" style="float:left;margin-right:5px;" />
									  <input id="upload_video_thumbnailz" type="button" value="Upload Image"  />
									  </label>
									<script type="text/javascript">
									jQuery(document).ready(function()
									{
										var _custom_media = true;
										_orig_send_attachment = wp.media.editor.send.attachment;

										jQuery('#upload_video_thumbnailz').click(function(e) 
										{
											var send_attachment_bkp = wp.media.editor.send.attachment;
											var button = jQuery(this);
											var id = button.attr('id').replace('_button', '');
											_custom_media = true;
											wp.media.editor.send.attachment = function(props, attachment)
											{
												if ( _custom_media ) 
												{
											    		jQuery('#_oap_video_thumbnail').val(attachment.url);
												} 
												else 
												{
										    			return _orig_send_attachment.apply( this, [props, attachment] );
												};
											}

											wp.media.editor.open(button);
											return false;
										});

										jQuery('.add_media').on('click', function()
										{
											_custom_media = false;
										});
									});
									</script>
									</div>
								 
							  </div>
							  </td>
							</tr>
						  </tbody>
						</table>
						<?php } ?>
					  </div>
					  <div id="url_video" style="display:none;">
						<label for="oap_fm_item"><strong>Enter the Video's URL. </strong> <br />
						</label>
						<table width="100%">
						  <tbody>
							<tr>
							  <td></td>
							  <td><input id="_oap_mmi_video" type="text" size="30" name="_oap_mmi_video" value="" class="mminput" />
							  </td>
							</tr>
						  </tbody>
						</table>
					  </div>
			<div id="amazons3_url_video" style="display:none;">
						<label for="oap_fm_item"><strong>Enter an Amazon S3 or Custom URL. </strong> <br />
						</label>
						<table width="100%">
						  <tbody>
							<tr>
							  <td></td>
							  <td><input id="_oap_mmi_amazons3_video" type="text" size="30" name="_oap_mmi_amazons3_video" value="" class="mminput" />
							  </td>
							</tr>
						  </tbody>
						</table>
					  </div>
			<div id="embeded_video" style="display:none;">
						<label for="oap_fm_item"><strong>Enter Video Embed Code. </strong> <br />
						</label>
						<table width="100%">
						  <tbody>
							<tr>
							  <td><textarea id="_oap_mmi_embed_video" name="_oap_mmi_embed_video" class="mminput" ></textarea>
							  </td>
							</tr>
						  </tbody>
						</table>
					  </div>
					</td>
				  </tr>
				  <tr>
					<td class="tabledata dloadsleft" ><table width="100%">
						<tbody>
						  <tr>
							<td valign="top" class="dladditemtext" style="padding: 0px!important;">
							  <div align="center">
								<input class="dladditem" type="submit" name="addmedia" id="addmedia" value="Add Video">
							  </div></td>
						  </tr>
						</tbody>
					  </table></td>
				  </tr>
				</tbody>
			  </table>
			</div></td>
		  <td width="3%">&nbsp;</td>
		  <td valign="top"><table width="100%" class="dlorder">
			  <tbody>
				<tr>
				  <td class="tabledata dloadsright" valign="top"><label  for="oap_download_order" style="display: inline-block;width: 100%;margin-bottom: 20px;"><strong class="c_lft">Video Order</strong> <a class="fancybox fancybox-iframe c_rt"  href="http://officeautopilot.com/mp/helpfiles/mediaorder.html" name="Media Order"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a> </label>
					<!-- <br />
					<br />
					<div class="dllessoninfo" id="contentLeft"><span class="c_lft"><strong>Item Name</strong></span> <span style="float: right;"><strong>Delete</strong></span><br /> -->
					  <br />
					</div>
					<div id="contentDragDropMedia">
					  <!-- Drag and Drop Div -->
				<ul>
				<?php
				global $wpdb;
				$table_name = $wpdb->prefix . "media_listing";
				$query = "select * 
				from $table_name 
				where postId = $post->ID 
				order by recordListingID";
				$results = $wpdb->get_results($query);
				$aivl = $all_items["videos"]["list"];

				if ( is_array($results) )
				{
					foreach ( $results as $row )
					{
						$rectext = stripslashes($row->recordText); 
						$thefilename = stripslashes($row->fileName); 
						$fileNum = $row->fileName; 
						$timeinmili = $aivl[$fileNum - 1]["duration"];
						$totalseconds = $timeinmili / 1000;
						$mins = (int) $totalseconds / 60;
						$number = explode('.',($mins));
						$mins = $number[0];
						$seconds = $totalseconds % 60;
						$duration = $mins . 'm' . $seconds . 's';
						$filename = $aivl[$fileNum - 1]["name"];
						?>

						<li id="mediaRecordsArray_<?php echo $row->recordID; ?>" class="sortlisting"> 
							<span class="block_in_lft">
								<?php 
								echo $rectext;
								echo '<i>';
								if (isset($filename) ) 
								{ 
									echo ' &nbsp;-&nbsp; ONTRAPORT (Filename: ' . $filename . '  |  Duration: ' . $duration . ')'; 
								} 
								else if (strpos($thefilename,'youtube') !== false)
								{
									echo ' &nbsp;-&nbsp; YouTube'; 
								}
								else if (strpos($thefilename,'vimeo') !== false)
								{
									echo ' &nbsp;-&nbsp; Vimeo'; 
								}
								else if (strpos($thefilename,'wistia') !== false)
								{
									echo ' &nbsp;-&nbsp; Wistia'; 
								}
								else if (strpos($thefilename,'amazon') !== false)
								{
									echo ' &nbsp;-&nbsp; Amazon'; 
								}
								echo '</i>';
								 ?>
							</span>
							<div class="deletesorting"><a href="<?php echo $row->recordID; ?>" class="delmedia"> <img
						src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/delete.png" /> </a></div>
						</li>
					<?php 
					}
				}

				 ?>
				  </ul>
				</div>
				</td>
				</tr>
				<tr>
				  <td class="tabledata dloadsright" valign="bottom"><i><span
				  style="float: left; margin-bottom: 10px;">Select, drag and drop
					the items above into your desired order.</span></i> &nbsp;&nbsp;<span style="float: right;"> </span></td>
				</tr>
			  </tbody>
			</table></td>
		</tr>
	  </tbody>
	</table>

</div>

<div id="ms-custom-html" class="ms-tab-sections ms-custom-html">
  <table style="width: 100%;">
	<tr>
	  <th class="tableheader" id="btm_col" align="left"><table style="width:190px;"><tbody><tr><td><span class="sectionTitle">Add Custom HTML &nbsp;</span></td><td><a href="http://officeautopilot.com/mp/helpfiles/customhtml.html" class="fancybox fancybox-iframe" name="Custom Html"><img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip"  /></a></td></tr></tbody></table></th>
	  <td align="right"><table>
		  <tr class="_on_off_custom_html">
			<?php  $onoffcustomhtml = get_post_meta( $post->ID, '_on_off_custom_html', true );
			if($onoffcustomhtml=='ON'){ $checked='checked="checked"'; }else{ $checked='';} ?>
			<td><input type="checkbox" name="_on_off_custom_html" id="_on_off_custom_html" <?php echo $checked; ?> value="ON"/></td>
		  </tr>
		</table></td>
	</tr>
	<tr id="slidehtml" style="display:none;">
	  <td class="tabledatafull" colspan="3"><textarea
		style="width: 100%; height: 150px;" name="_oap_custom_html"
		id="_oap_custom_html"><?php echo esc_attr($oapcustomhtml); ?></textarea></td>
	</tr>
  </table>
  </div>

  <div id="ms-advanced-settings" class="ms-tab-sections ms-advanced-settings">
  <table width="100%">
	<tbody>
	  <tr>
		<th colspan="2" class="tableheader" align="left"><table width="205px"><tbody><tr><td><span class="sectionTitle">Advanced Settings &nbsp;</span></td><td><a href="http://officeautopilot.com/mp/helpfiles/advancedsettings.html" class="fancybox fancybox-iframe" name="Advanced Settings"><img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip"  /></a></td></tr></tbody></table>
		</th>
	  <th align="right"><table>
		  <tr class="_on_off_advanced_setting">
			<?php  $onoff_advanced_setting = get_post_meta( $post->ID, '_on_off_advanced_setting', true );
			if($onoff_advanced_setting=='ON'){ $checked='checked="checked"'; }else{ $checked='';} ?>
			<td><input type="checkbox" name="_on_off_advanced_setting" id="_on_off_advanced_setting" <?php echo $checked; ?> value="ON"/></td>
		  </tr>
		</table></th>
	  </tr>
	<tr  id="template_override" style="display:none;">
	  <td colspan="3"><table width="100%">
	<tr><td colspan="3" height="40px"><span class="sectionSubTitle">Background (Body)</span></td></tr>
	<tr>
	<td align="left" class="tabledata left"><label for="_oap_media_text_template" class="sec_l"> <strong>Background (Body) -
		Override:</strong> <a href="http://officeautopilot.com/mp/helpfiles/backgroundbodyoverride.html" class="fancybox fancybox-iframe" name="Template Override Section"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		<select id="_oap_outer_template_override"
		  name="_oap_outer_template_override" class="selection" style="width:100%;" />
		<option value="Disabled"
		  <?php if($oapoutertemplateoverride=='Disabled'){echo 'selected';}?>>Disabled</option>
	<option value="Enabled"
		  <?php if($oapoutertemplateoverride=='Enabled'){echo 'selected';}?>>Enabled</option>
		</select></td>
	  <td align="left" class="tabledata center" id="outer_temp_override_height"><label for="_oap_video_image_position" class="sec_l"><strong>Fixed Height:</strong> <a href="http://officeautopilot.com/mp/helpfiles/fixed_height.html" class="fancybox fancybox-iframe" name="Fixed Height- Media or Text Template"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
		<input type="text" name="_oap_outer_template_max_height" id="_oap_outer_template_max_height" value="<?php echo $template_outer_max_height;?>" placeholder="Start with 1000px and then increase or decrease." class="width_input reset">
	  </td>
	  <td align="left" class="tabledata right" id="outer_temp_override_width"><label for="_oap_temp_override_width" class="sec_l"><strong>Fixed Width:</strong> <a href="http://officeautopilot.com/mp/helpfiles/fixedwidth.html" class="fancybox fancybox-iframe" name="Fixed Width - Media or Text Template"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
		<?php if($oapoutertemplateoverride == 'Enabled' && $template_outer_max_width =="")
		  {
				$max_outer_width=get_option('template_width');
		  }
		  else if($oapoutertemplateoverride == 'Enabled' && $template_outer_max_width !="")
		  {
				$max_outer_width=$template_outer_max_width;
		  }
		  else
		  {
		  $max_outer_width="";
		  }
		  ?>
		<input type="text" name="_oap_outer_template_max_width" id="_oap_outer_template_max_width" value="<?php echo $max_outer_width;?>" placeholder="Start with 960px and then increase or decrease." class="width_input reset">
	  </td>
	</tr>
	<tr>
	  <td align="left" class="tabledata left" id="outer_page_background_color"><label for="_oap_outer_media_text_template" class="sec_l"> <strong>Background
		Color:</strong> <a href="http://officeautopilot.com/mp/helpfiles/page_background_color.html" class="fancybox fancybox-iframe" name="Media/Text Template Background Color"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		<input type="text" name="_oap_outer_page_background_color" id="_oap_outer_page_background_color" value="<?php echo get_post_meta($post->ID, '_oap_outer_page_background_color', true );?>" style="background-color:<?php echo get_post_meta($post->ID, '_oap_outer_page_background_color', true );?>;"></td>
	  <td align="left" class="tabledata center" id="oap_outer_template_custom_css"><label for="oap_outer_template_custom_css" class="sec_l"><strong>Add your own CSS for this template:</strong> <a href="http://officeautopilot.com/mp/helpfiles/addyourowncss.html" class="fancybox fancybox-iframe" name="Write Own CSS"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
	 <textarea rows="1" name="_oap_outer_media_template_custom_css" id="_oap_outer_media_template_custom_css"><?php echo $oap_outer_media_template_custom_css;?></textarea>
	 <textarea rows="1" name="_oap_outer_text_template_custom_css" id="_oap_outer_text_template_custom_css" style="display:none;"><?php echo $oap_outer_text_template_custom_css;?></textarea>
	  </td>
	  <td align="left" class="tabledata right">&nbsp;</td>
	</tr>
   <tr><td colspan="3" height="40px"><span class="sectionSubTitle">Content Area</span></td></tr>
   <tr>
	<td align="left" class="tabledata left"><label for="_oap_media_text_template" class="sec_l"> <strong>Content Area -
		Override:</strong> <a href="http://officeautopilot.com/mp/helpfiles/contentareaoverride.html" class="fancybox fancybox-iframe" name="Template Override Section"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		<select id="_oap_template_override" name="_oap_template_override" class="selection" style="width:100%;" />
		<option value="Disabled"
		  <?php if($oaptemplateoverride=='Disabled'){echo 'selected';}?>>Disabled</option>
	<option value="Enabled"
		  <?php if($oaptemplateoverride=='Enabled'){echo 'selected';}?>>Enabled</option>
		</select></td>
	  <td align="left" class="tabledata center" id="temp_override_height"><label for="_oap_video_image_position" class="sec_l"><strong>Fixed Height:</strong> <a href="http://officeautopilot.com/mp/helpfiles/fixed_heightcontent.html" class="fancybox fancybox-iframe" name="Fixed Height- Media or Text Template"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
		<input type="text" name="_oap_template_max_height" id="_oap_template_max_height" value="<?php echo $template_max_height;?>" placeholder="Start with 1000px and then increase or decrease." class="width_input reset">
	  </td>
	  <td align="left" class="tabledata right" id="temp_override_width"><label for="_oap_temp_override_width" class="sec_l"><strong>Fixed Width:</strong> <a href="http://officeautopilot.com/mp/helpfiles/fixedwidthcontent.html" class="fancybox fancybox-iframe" name="Fixed Width - Media or Text Template"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
		<?php if($oaptemplateoverride == 'Enabled' && $template_max_width =="")
		  {
				$max_width=get_option('template_width');
		  }
		  else if($oaptemplateoverride == 'Enabled' && $template_max_width !="")
		  {
				$max_width=$template_max_width;
		  }
		  else
		  {
		  $max_width="";
		  }
		  ?>
		<input type="text" name="_oap_template_max_width" id="_oap_template_max_width" value="<?php echo $max_width;?>" placeholder="Start with 960px and then increase or decrease." class="width_input reset">
	  </td>
	</tr>
	<tr>
	  <td align="left" class="tabledata left" id="page_background_color"><label for="_oap_media_text_template" class="sec_l"> <strong>Background
		Color:</strong> <a href="http://officeautopilot.com/mp/helpfiles/content_background_color.html" class="fancybox fancybox-iframe" name="Media/Text Template Background Color"> <img class="oaptooltip" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png"/> </a> </label>
		<input type="text" name="_oap_page_background_color" id="_oap_page_background_color" value="<?php echo get_post_meta($post->ID, '_oap_page_background_color', true );?>" style="background-color:<?php echo get_post_meta($post->ID, '_oap_page_background_color', true );?>"></td>
	  <td align="left" class="tabledata center" id="oap_template_custom_css"><label for="_oap_template_custom_css" class="sec_l"><strong>Add your own CSS for this template:</strong> <a href="http://officeautopilot.com/mp/helpfiles/addcsscontent.html" class="fancybox fancybox-iframe" name="Write Own CSS"> <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> </a></label>
	 <textarea rows="1" name="_oap_media_template_custom_css" id="_oap_media_template_custom_css"><?php echo $oap_media_template_custom_css;?></textarea>
	 <textarea rows="1" name="_oap_text_template_custom_css" id="_oap_text_template_custom_css" style="display:none;"><?php echo $oap_text_template_custom_css;?></textarea>
	  </td>
	  <td align="left" class="tabledata right">&nbsp;</td>
	</tr>
	</table> </td>
	</tr>
  </table>
  </div>
</div>
<script>
jQuery(document).ready(function()
{
	jQuery.fn.buildContent = function(){
		var helpbuttonlink = jQuery(this).attr('href');
		var helpbuttonname = jQuery(this).attr('name');
		var content = '<div class="ihm-overlay" style="display: none;"><div class="inlinehelpmenu"><a href="javascript://" class="close-this">Close</a><iframe class="help-menu-iframe" src="' + helpbuttonlink + '" name="' + helpbuttonname + '"></iframe></div></div>';

		jQuery(this).append(content);
	};

	jQuery('.fancybox-iframe').click(function()
	{
		if ( jQuery(this).children('.ihm-overlay').is(":visible") )
		{
			jQuery(this).children('.ihm-overlay').fadeOut(300);
		}
		else
		{
			jQuery(this).buildContent();
			jQuery(this).children('.ihm-overlay').fadeIn(300);
		}

		return false;
	});

	var $closebutton = jQuery(this).children('.close-this');
	$closebutton.click(function()
	{
		jQuery(this).parent('.inlinehelpmenu').parent('.ihm-overlay').fadeOut();
	});

	jQuery('.ms-tabbed-sections').tabs();
});
</script>
  <?php } //end of html
  add_action('save_post','oap_postdata_save');
  /* When the post is saved,
  * saves our custom data
  * */
  function oap_postdata_save( $post_id ) {
	global $wpdb;  global $metaBox;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	  return;
	if( !isset( $_POST['oap_nonce'] ) || !wp_verify_nonce( $_POST['oap_nonce'], 'save_oap_meta' ) )
	  return;
	if( !current_user_can( 'edit_post' ) ) return;
	// Check permissions
	if ( 'page' == $_POST['post_type'] )  {
		if ( !current_user_can( 'edit_page', $post_id ) )
	return;
		}else{
	if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	  }
	  foreach ($metaBox['fields'] as $field) {
			$value = $_POST[$field['id']];
			if ($field['type'] == 'media' && !is_numeric($value) ) {
			  //Convert URL to Attachment ID.
			  $value = $wpdb->get_var(
		  "SELECT ID FROM $wpdb->posts
		   WHERE guid = '$value'
		   AND post_type='attachment' LIMIT 1");
			}
			update_post_meta($post_id, $field['id'], $value);
		  }//end foreach
	// OK, we're authenticated: we need to find and save the data
		$upload = wp_upload_dir();
		$src=$_FILES['oap_download_item']['tmp_name'];
		$dest = $upload['basedir'].'/membership-simplified-for-oap-members-only/';
		  if(!file_exists('oapmembership')){ @mkdir($dest,0777);}
		move_uploaded_file($src, $dest.$_FILES['oap_download_item']['name']);
		$tablename= $wpdb->prefix.'posts';
		$maxlesson= $wpdb->get_var('SELECT max(menu_order) as maxlesson FROM '.$tablename.' where post_type="oaplesson"');
		  $ordernumber= $_POST['maxlesson'];
		  if (is_numeric ($ordernumber)){
			  $wpdb->query("update $tablename set menu_order = $ordernumber where ID= $post_id ");
		  }
		  //print_r($_POST);exit;
			  if( isset($_POST['_oap_lesson_number'] ) && $_POST['_oap_lesson_number'] !=''  ) {
			 $menu_order = esc_attr( $_POST['_oap_lesson_number'] );
			 $wpdb->query("update $tablename set menu_order = $menu_order where ID= $post_id ");  }
			 if( isset($_POST['_oap_lesson_title_setting'] ) && $_POST['_oap_lesson_title_setting'] !=''  ) { update_post_meta( $post_id, '_oap_lesson_title_setting', esc_attr( $_POST['_oap_lesson_title_setting'] ) );  }
			 if( isset($_POST['_oap_lesson_number_setting'] ) && $_POST['_oap_lesson_number_setting'] !=''  ) { update_post_meta( $post_id, '_oap_lesson_number_setting', esc_attr( $_POST['_oap_lesson_number_setting'] ) );  }
			  if( isset($_POST['_oap_title_lessonnumber_setting'] ) && $_POST['_oap_title_lessonnumber_setting'] !=''  ) { update_post_meta( $post_id, '_oap_title_lessonnumber_setting', esc_attr( $_POST['_oap_title_lessonnumber_setting'] ) );   }
			if( isset($_POST['_oap_fullvideo_shared_position'] ) && $_POST['_oap_fullvideo_shared_position'] !=''  ) { update_post_meta( $post_id, '_oap_fullvideo_shared_position', esc_attr( $_POST['_oap_fullvideo_shared_position'] ) );  }
			   if( isset($_POST['_oap_video_image_position'] ) && $_POST['_oap_video_image_position'] !=''  ) { update_post_meta( $post_id, '_oap_video_image_position', esc_attr( $_POST['_oap_video_image_position'] ) );  }
			   if( isset($_POST['_oap_sidebar_position'] ) && $_POST['_oap_sidebar_position'] !=''  ) { update_post_meta( $post_id, '_oap_sidebar_position', esc_attr( $_POST['_oap_sidebar_position'] ) );  }
			if( isset($_POST['_oap_lesson_menu_position'] ) && $_POST['_oap_lesson_menu_position'] !='' ) { update_post_meta( $post_id, '_oap_lesson_menu_position', esc_attr( $_POST['_oap_lesson_menu_position'] ) );  }
			if( isset($_POST['_oap_media_text_template'] ) && $_POST['_oap_media_text_template']!= '' ) { update_post_meta( $post_id, '_oap_media_text_template', esc_attr( $_POST['_oap_media_text_template'] ) );  }
			if( isset($_POST['_oap_lesson_menu_category'] ) && $_POST['_oap_lesson_menu_category'] !='' ) { update_post_meta( $post_id, '_oap_lesson_menu_category', esc_attr( $_POST['_oap_lesson_menu_category'] ) );  }
			// start code for Inner Override
			 if( isset($_POST['_oap_template_override'] ) && $_POST['_oap_template_override'] !=''  ) { update_post_meta( $post_id, '_oap_template_override', esc_attr( $_POST['_oap_template_override'] ) );  }
			if( isset($_POST['_oap_template_max_height'] ) ) {  update_post_meta( $post_id, '_oap_template_max_height', esc_attr( $_POST['_oap_template_max_height'] ) );  }
					  if( isset($_POST['_oap_template_max_width'] ) ) {  update_post_meta( $post_id, '_oap_template_max_width', esc_attr( $_POST['_oap_template_max_width'] ) );  }                   if( isset($_POST['_oap_page_background_color'] ) ) {  update_post_meta( $post_id, '_oap_page_background_color', esc_attr( $_POST['_oap_page_background_color'] ) );  }
			if( isset($_POST['_oap_media_template_custom_css'] ) ) {  update_post_meta( $post_id, '_oap_media_template_custom_css', esc_attr( $_POST['_oap_media_template_custom_css'] ) );  }
			if( isset($_POST['_oap_text_template_custom_css'] ) ) {  update_post_meta( $post_id, '_oap_text_template_custom_css', esc_attr( $_POST['_oap_text_template_custom_css'] ) );  }
			// start code for Outer Override
			 if( isset($_POST['_oap_outer_template_override'] ) && $_POST['_oap_outer_template_override'] !=''  ) { update_post_meta( $post_id, '_oap_outer_template_override', esc_attr( $_POST['_oap_outer_template_override'] ) );  }
			if( isset($_POST['_oap_outer_template_max_height'] ) ) {  update_post_meta( $post_id, '_oap_outer_template_max_height', esc_attr( $_POST['_oap_outer_template_max_height'] ) );  }
					  if( isset($_POST['_oap_outer_template_max_width'] ) ) {  update_post_meta( $post_id, '_oap_outer_template_max_width', esc_attr( $_POST['_oap_outer_template_max_width'] ) );  }
			 if( isset($_POST['_oap_outer_page_background_color'] ) ) {  update_post_meta( $post_id, '_oap_outer_page_background_color', esc_attr( $_POST['_oap_outer_page_background_color'] ) );  }
			if( isset($_POST['_oap_outer_media_template_custom_css'] ) ) {  update_post_meta( $post_id, '_oap_outer_media_template_custom_css', esc_attr( $_POST['_oap_outer_media_template_custom_css'] ) );  }
			if( isset($_POST['_oap_outer_text_template_custom_css'] ) ) {  update_post_meta( $post_id, '_oap_outer_text_template_custom_css', esc_attr( $_POST['_oap_outer_text_template_custom_css'] ) );  }
			if( isset($_POST['oap_download_item'] ) ) {  update_post_meta( $post_id, 'oap_download_item', esc_attr( $_POST['oap_download_item'] ) );  }
			if( isset($_POST['_oap_wywtl_yesno'] ) ) {  update_post_meta( $post_id, '_oap_wywtl_yesno', esc_attr( $_POST['_oap_wywtl_yesno'] ) );  }
			if( isset($_POST['_oap_length_yesno'] ) ) {  update_post_meta( $post_id, '_oap_length_yesno', esc_attr( $_POST['_oap_length_yesno'] ) );  }
			if( isset($_POST['_oap_wywtl_text'] ) ) {  update_post_meta($post_id, '_oap_wywtl_text',$_POST['_oap_wywtl_text']);  }
			if( isset($_POST['_oap_wywtl_length'] ) ) {  update_post_meta($post_id, '_oap_wywtl_length',$_POST['_oap_wywtl_length']);  }
			if( isset($_POST['_oap_mmi_image'] ) ) { update_post_meta( $post_id, '_oap_mmi_image',  $_POST['_oap_mmi_image'] ) ;  }
			if( isset($_POST['oap_mmi_hosted_image'] ) ) { update_post_meta( $post_id, 'oap_mmi_hosted_image',  $_POST['oap_mmi_hosted_image'] ) ;  }
			//if( isset($_POST['_oap_mmi_video'] ) ) { update_post_meta( $post_id, '_oap_mmi_video',  $_POST['_oap_mmi_video'] ) ;  }
			//if( isset($_POST['oap_mmi_hosted_video'] ) ) { update_post_meta( $post_id, 'oap_mmi_hosted_video',  $_POST['oap_mmi_hosted_video'] ) ;  }
			if( isset($_POST['oap_custom_html'] )) { update_post_meta( $post_id, 'oap_custom_html',  $_POST['oap_custom_html'] ) ;  }
			if( isset($_POST['_oap_infobox_heading'] ) ) { update_post_meta( $post_id, '_oap_infobox_heading',  $_POST['_oap_infobox_heading'] ) ;  }
			if( isset($_POST['_oap_infobox_length'] ) ) { update_post_meta( $post_id, '_oap_infobox_length',$_POST['_oap_infobox_length']) ;  }
			if( isset($_POST['_oap_overview_text'] ) ) { update_post_meta( $post_id, '_oap_overview_text',$_POST['_oap_overview_text']);  }
			if( isset($_POST['_oap_overview_cbx'] ) ) { update_post_meta( $post_id, '_oap_overview_cbx', esc_attr( $_POST['_oap_overview_cbx'] ) );  }
			update_post_meta( $post_id, '_oap_di', esc_attr( $_POST['_oap_di'] ) );
			update_post_meta( $post_id, '_oap_mmi_item', esc_attr( $_POST['_oap_mmi_item'] ) );
					 update_post_meta( $post_id, '_on_off_info_box', esc_attr( $_POST['_on_off_info_box'] ) );
			   update_post_meta( $post_id, '_on_off_download', esc_attr( $_POST['_on_off_download'] ) );
			   update_post_meta( $post_id, '_on_off_main_media', esc_attr( $_POST['_on_off_main_media'] ) );
			   update_post_meta( $post_id, '_on_off_custom_html', esc_attr( $_POST['_on_off_custom_html'] ) );
			   update_post_meta( $post_id, '_on_off_advanced_setting', esc_attr( $_POST['_on_off_advanced_setting'] ) );
			   update_post_meta( $post_id, '_oap_custom_html',$_POST['_oap_custom_html']);
			if(isset($_POST['oap_btn_load_settings'])=='Load') {
			  update_post_meta( $post_id, '_oap_load_settings', esc_attr( $_POST['_oap_load_settings'] ) );
			  $posttitle = $_POST['_oap_load_settings'];
				$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );
			  $oapsamevideoimageposition= get_post_meta( $postid, '_oap_video_image_position', true );
			  $oapsamelessonmenuposition= get_post_meta( $postid, '_oap_lesson_menu_position', true );
			  $oapsamelessonmenucategory= get_post_meta( $postid, '_oap_lesson_menu_category', true );
			  $oapsamemediatexttemplate= get_post_meta( $postid, '_oap_media_text_template', true );
			  $oapsamecustomhtml= get_post_meta( $postid, '_oap_custom_html', true );
			  update_post_meta( $post_id, '_oap_video_image_position',$oapsamevideoimageposition);
			  update_post_meta( $post_id, '_oap_lesson_menu_position',$oapsamelessonmenuposition);
			  update_post_meta( $post_id, '_oap_media_text_template',$oapsamemediatexttemplate);
			  update_post_meta( $post_id, '_oap_custom_html',$oapsamecustomhtml);
			}

			// Downloads
			if ( isset($_POST['oap_download_name'] )  && $_POST['oap_download_name']!='')
			{
				$table = $wpdb->prefix . "download_listing";
				$oapdownloadname=$_POST['oap_download_name'];

				if (!empty($_POST["oap_lesson_videos"])) 
				{
					$filename = $_POST["oap_lesson_videos"];
					$filetype = 'OAP Hosted Item';
				}
				else if (!empty($_POST["_oap_download_item"])) 
				{
					$filename = $_POST["_oap_download_item"];
					$filetype = 'Download Link';
				}
				else 
				{
					$filename=$_FILES['oap_download_item']['name'];
					$filetype = 'Uploaded Item';
				}

				$data= array(
					'postId'=>$post_id,
					'recordText' =>$oapdownloadname,
					'fileType'=>$filetype,
					'fileName'=> $filename
					);
				$wpdb->insert( $table, $data, $format=null );
			}

			// Video stuffs
			if( isset($_POST['oap_media_name'] )  && $_POST['oap_media_name']!='')
			{
			  $media_table = $wpdb->prefix . "media_listing";
				$oapmedianame=$_POST['oap_media_name'];
			  if(!empty($_POST['_oap_mmi_video'])) {
				$filename = $_POST['_oap_mmi_video'];
			  }
			  else if(!empty($_POST['_oap_mmi_amazons3_video'])) {
				$filename = $_POST['_oap_mmi_amazons3_video'];
			  }
			  else if(!empty($_POST['_oap_mmi_embed_video'])) {
				$filename = $_POST['_oap_mmi_embed_video'];
			  }
			  else
			  {
				$filename = $_POST["oap_mmi_hosted_video"];
			  }
			  $data= array(
				 'postId'=>$post_id,
				   'recordText' =>$oapmedianame,
				 'fileName'=> $filename
						  );
			  $wpdb->insert( $media_table, $data, $format=null );
			  $insert_id = $wpdb->insert_id;
			  update_post_meta( $post_id, $insert_id.'_oap_video_thumbnail',esc_attr( $_POST['_oap_video_thumbnail'] ));//In Development _oap_video_autoplay
			  update_post_meta( $post_id, $insert_id.'_oap_video_autoplay',esc_attr( $_POST['_oap_video_autoplay'] ));
			  update_post_meta( $post_id, $insert_id.'_oap_video_player',esc_attr( $_POST['_oap_video_player'] ));
			  }
  }//End Function Save postdata
  /*
   * Function to limit the words in content
   * @returns content
   *  
	function limitContent($num, $more_link_text = '(more...)') {
	  $theContent = get_the_content($more_link_text);
	  $output = preg_replace('/<img[^>]+./','', $theContent);
	  $limit = $num+1;
	  $content = explode(' ', $output, $limit);
	  array_pop($content);
		$content = implode(" ",$content);
		$content = strip_tags($content, '<p><a><address><a><abbr><acronym><b><big><blockquote><br><caption><cite><class><code><col><del><dd><div><dl><dt><em><font><h1><h2><h3><h4><h5><h6><hr><i><img><ins><kbd><li><ol><p><pre><q><s><span><strike><strong><sub><sup><table><tbody><td><tfoot><tr><tt><ul><var>');
		echo close_tags($content);
		echo "&nbsp; <a href='";
		the_permalink();
		echo "'>".$more_link_text."</a>";
	}
	*/
  /*
   * Find and close unclosed xhtml tags
   * @returns unclosed xhtml
   *  */
	function close_tags($text) {
	  $patt_open    = "%((?<!</)(?<=<)[\s]*[^/!>\s]+(?=>|[\s]+[^>]*[^/]>)(?!/>))%";
	  $patt_close    = "%((?<=</)([^>]+)(?=>))%";
		 if (preg_match_all($patt_open,$text,$matches))
		{
		$m_open = $matches[1];
		if(!empty($m_open))
		  {
		  preg_match_all($patt_close,$text,$matches2);
		  $m_close = $matches2[1];
		  if (count($m_open) > count($m_close))
		  {
			$m_open = array_reverse($m_open);
			  foreach ($m_close as $tag) $c_tags[$tag]++;
				foreach ($m_open as $k => $tag)    if ($c_tags[$tag]--<=0) $text.='</'.$tag.'>';
			  }
			}
		  }
	  return $text;
	}
  function mytheme_content_ad( $content ) {
	if(is_page())
	{
		$contents=get_the_content();
	  $start= strpos($contents, '[oapcontent');
	  $end= strpos($contents, ']', $start+11)+1;
	  $cal = $end - $start;
	  $short_code= substr($contents,$start,$cal);
	  if(!$start && $start !== 0)
	  {
		 return $contents;
	  }
	  else
	  {
		echo substr($contents,0,$start);
		do_shortcode($short_code);
		echo substr($contents,$end);
	  }
	}
	else
	{
	  $contents=get_the_content();
	  return $contents;
	}
  }
  //add_filter( 'the_content', 'mytheme_content_ad' ,100);
  /** Options For Meta Box on Right side
   *
   */
  //Define the metabox attributes.
	 $metaBox = array(
	'id'     => 'my-overview-box',
	'title'    => 'Membership Simplified - Settings',
	'page'     => 'page',
	'post'     => 'post',
	'page'     => 'oaplesson',
	'context'  => 'normal',
	'priority'   => 'high',
	'fields' => array(
		array(
			'name'   => 'Oap Overview Topinfo',
			'desc'   => '<div class="overviewdesc"><table style="width:auto;"><tbody><tr><td><h2 class="overviewdes">Menu Item Options &nbsp;</h2></td><td><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/addmenuitems.html" name="Custom Html"><img src="'.plugins_url().'/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip"  /></a></td></tr></tbody></table></div>',
			'id'  => '_oap_overview_topinfo',  //value is stored with this as key.
			'class' => '_oap_overview_topinfo',
			'type'   =>'topinfo'
			),
			array(
			'name'   => '_oap_overview_image',
			'desc'   => '',
			'id'  => '_oap_overview_image',  //value is stored with this as key.
			'class' => 'image_upload_field',
			'type'   =>'media'
			),
		 array(
			'name'   => '_oap_overview_cbx',
			'desc'   => '',
			'id'  => '_oap_overview_cbx',  //value is stored with this as key.
			'class' => '_oap_overview_cbx',
			'type'   =>'radiouse'
			),
			array(
			'name'   => '_oap_hosted_image',
			'desc'   => '',
			'id'  => '_oap_hosted_image',  //value is stored with this as key.
			'class' => '_oap_hosted_image',
			'type'   =>'select'
			),
			array(
			'name'   => '_oap_lesson_number',
			'desc'   => '<strong>Menu Number</strong>',
			'id'  => '_oap_lesson_number',  //value is stored with this as key.
			'class' => '_oap_overview_text',
			'type'   =>'text'
			),
			array(
			'name'   => '_oap_overview_text',
			'desc'   => '<strong>Menu Item Description</strong>',
			'id'  => '_oap_overview_text',  //value is stored with this as key.
			'class' => '_oap_overview_text',
			'type'   =>'textarea'
			)
		)
	  );
   /***
   **  save order changes button In Admin Section
   **/
  add_action('admin_head', 'savbutton');
  function savbutton(){
	 echo '<style>
	  .save_order{
		  margin:0 30px 0 0px;
	  }
	</style>';
	 if($_GET['post_type']== 'oaplesson') {
		echo "<script>
		  jQuery(function () {
			 var ele = jQuery('<input type=\"button\" />').attr({'value' : 'Save Changes', 'class' : 'save_order'})
			   ele.click(function () {
				 window.location.href = window.location.href;
			   });
			 jQuery('.tablenav-pages .displaying-num').before(ele);
		  });
		  </script>";
		}
	} //end Function
  /***
   * Function to Add sort column numbering in admin
   * @returns Sort Number in opalesson post type
   */
  add_action('manage_oaplesson_posts_columns', 'posts_column_oaplesson', 10);
  add_action('manage_oaplesson_posts_custom_column', 'posts_custom_column_oaplesson', 10, 2);
  add_action('manage_oaplesson_posts_custom_column', 'posts_custom_column_oaplesson_taxonomy', 10, 3);
  function posts_column_oaplesson($defaults){
	  $defaults['post_oaplesson'] = __('Order');
	  $defaults['mprogram'] = __('Program');
	  return $defaults;
  }
  function posts_custom_column_oaplesson($column_name, $post_id){
  global $post;
	  switch($column_name) {
		  case 'post_oaplesson':
				echo  $post->menu_order;
			  break;
	  }
  }
  function posts_custom_column_oaplesson_taxonomy($column_name, $post_id) 
  {
  	$taxonomy = $column_name;
	$post_type = get_post_type($post_id);
	$terms = get_the_terms($post_id, $taxonomy);
	if ( !empty($terms) ) 
	{
		foreach ( $terms as $term )
		{
			$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
			echo join( ' ', $post_terms );
     		}
	}
	 else 
 	{
 		echo '<i>No terms.</i>';
	}
  }
  /***
   * Function to Add button on Visual Editor To add shortcode
   * @returns shortcode
   */
   /**  * Function to get the plugin category Hidden Div don't delete */
function get_memoverview()
{
	$postid = (isset($_GET['post']) ? $_GET['post'] : null);
	$popup = dirname(dirname(__FILE__)) . '/membership-simplified-for-oap-members-only/inc/memoverview.php';
	$popup1 = dirname(dirname(__FILE__)) . '/membership-simplified-for-oap-members-only/inc/memoverview-error.php';
	if (get_post_type($postid)=='page' || $_GET['post_type']=='page')
	{
		include $popup;
	} 
	else if (get_post_type($postid)=='oaplesson' || $_GET['post_type']=='oaplesson')
	{
		  include $popup1;
	}
  }
  add_action('admin_head', 'get_memoverview');
  // Add Buttons To TinyMCE
  add_action('init', 'add_pp_buttons');
  function add_pp_buttons($post) 
  {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_ppshortcode_plugin');
		add_filter('mce_buttons_3', 'register_button');
	}
}
  function register_button($buttons) {
	array_push($buttons, "separator", "separator", "separator", "oaplesson", "separator", "showifhasone", "showifhasall", "showifnotone", "showifnotall", "showifhastag", "showifiscontact", "showifnotcontact");
	 return $buttons;
  }
  function add_ppshortcode_plugin($plugin_array) {
	 $plugin_array['oaplesson'] = plugin_dir_url( __FILE__ ) . 'js/mybuttons.js';
	 $plugin_array['showifhasone'] = plugin_dir_url( __FILE__ ) . 'js/showif.js';
	 $plugin_array['showifhasall'] = plugin_dir_url( __FILE__ ) . 'js/showif.js';
	 $plugin_array['showifnotone'] = plugin_dir_url( __FILE__ ) . 'js/showif.js';
	 $plugin_array['showifnotall'] = plugin_dir_url( __FILE__ ) . 'js/showif.js';
	 $plugin_array['showifhastag'] = plugin_dir_url( __FILE__ ) . 'js/showif.js';
	 $plugin_array['showifiscontact'] = plugin_dir_url( __FILE__ ) . 'js/showif.js';
	 $plugin_array['showifnotcontact'] = plugin_dir_url( __FILE__ ) . 'js/showif.js';
	 return $plugin_array;
  }
  /**
   * Functions For Contextual Help For Oap Membership Plugin
   * @return Help For Admin Section
   */
  function oap_plugin_options(){
	//echo 'oap membership help';
	return false;
  }
  add_action('admin_menu', 'membership_oap_menu');
  function membership_oap_menu() {
	 global $my_plugin_hook;
	 $my_plugin_hook = add_options_page('Oap Plugin Options', '', 'manage_options', 'manage_oap_options', 'oap_plugin_options');
  }
  function mem_oap_help($contextual_help, $screen_id, $screen) {
	global $my_plugin_hook;
	if ($screen_id == $my_plugin_hook) {
	  $contextual_help = '
	  <h2>Oap Membership Plugin Help</h2>
		 <strong>
		 1. Add the Post type in left Sections <br />
		 2. Change the Settings in post sections to display. <br />
		 3. Can change the Global settings of post and display in Front with Oap Membership Plugin. <br />
		 </strong>
	  ';
	}
	return $contextual_help;
  }
  add_filter('contextual_help', 'mem_oap_help', 10, 3);
  /**
   * Function to Limit the words
   * @param $string
   * @param $word_limit
   * @return Limit words
   */
  function limit_words($string, $word_limit)
  {
  $words = explode(" ",$string);
  return implode(" ",array_splice($words,0,$word_limit));
  }
  function lesson_type($string)
  {
  $words = substr($string,0,50);
  return $words;
  }
  /**
   * Function to Get the Category ID From Category Name
   * @param $cat_name
   * @return Category Name
   */
  function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
  }
  /**
   * Error Message For Simple Page Ordering If not Active
   **/
  /* $plugins = get_option('active_plugins');
	   $required_plugin = 'simple-page-ordering/simple-page-ordering.php';
  if(is_admin()) {
	   if (!in_array( $required_plugin , $plugins ) ) {
			  echo '
			  <div class="error" id="oaperrorordering" style="padding-top: 5px; padding-bottom: 5px;height:25px;">
			  <a href="/wp-admin/plugin-install.php?tab=plugin-information&plugin=simple-page-ordering&TB_iframe=true&width=640&height=659" target="_blank">';
		 _e('OAP Membership Content - The Simple Page Ordering plugin Must Be Enabled For Item Numbering and Ordering. Please <span>click here </span>  to install this plugin now');
			  echo '</a></div>';
	   }
  } */
  /**
   * Error Message for wp-paginate If Not Active
   **/
  /*$plugins1 = get_option('active_plugins');
  $required_plugin1 = 'wp-paginate/wp-paginate.php';
  if(is_admin()){
	if (!in_array($required_plugin1,$plugins1)){
		  echo '<div class="error" id="oaperrorpaginate" style="padding-top: 5px; padding-bottom: 5px;height:25px;">
		  <a href="/wp-admin/plugin-install.php?tab=plugin-information&plugin=wp-paginate&TB_iframe=true&width=640&height=659" target="_blank">';
		  _e('OAP Membership Content - The Wp-paginate plugin must be enabled for pagination within the plugin Please <span> click here </span>to install the plugin now');
			  echo'</a></div>';
	  }
   }*/
  /**
   * Widget For Login With Custom Textarea
   *
   */
	add_action( 'widgets_init', 'oap_load_widgets' );
	/**
	* Register our widget.
	* 'Example_Widget' is the widget class used below.
	*
	*/
	function oap_load_widgets() 
	{
		register_widget( 'Oap_Login_Widget' );
	}
	/**
	* Oap Login Widget class.
	* This class handles everything that needs to be handled with the widget:
	* the settings, form, display, and update.  Nice!
	**/
	class Oap_Login_Widget extends WP_Widget 
	{
		/**
		 * Widget setup.
		 */
		function __construct() 
		{
			parent::__construct(
				'oaplogin', // Base ID
				__('Members Login Form', 'oaplogin-widget'), // Name
				array( 'description' => __( 'Adds a login widget for your membership content.', 'oaplogin-widget' ), ) // Args
			);
		}
		/**
		 * How to display the widget on the screen.
		 */
		public function widget( $args, $instance ) 
		{
			echo "<link type='text/css' rel='stylesheet' href='" . plugins_url()."/membership-simplified-for-oap-members-only/css/functions.css' />";
			extract( $args );

			/* Our variables from the widget settings. */
			$title = $instance['title'];
			$not_logged_in = $instance['not_logged_in'];
			$logged_in = $instance['logged_in'];
			//  $title = apply_filters('widget_title', $instance['title'] );
			/* Before widget (defined by themes). */
			$before_widget='<div class="oap-login-widget widget">';
			echo $before_widget;
			/* Display the widget title if one was input (before and after defined by themes). */

			if ( $title )
			{
				echo $before_title . $title . $after_title;
			}
			
			global $post; 
			$redirect = get_permalink($post->ID);

			if (is_user_logged_in())
			{
				echo '<p class="login_msg">'.$logged_in.'</p>'; ?>
					<p style="margin-top:10px;">
						<strong>You are logged in as: <i>
							<a href="/customer_center"><?php $current_user = wp_get_current_user(); echo $current_user->display_name; ?></a>
							</i>
						</strong>
					</p>
					<form name="loginform" id="loginform" action="<?php echo wp_logout_url(); ?>" method="post">
						<p><input type="submit" name="wp-submit" id="wp-logout-submit" value="LOG OUT" /></p>
						<input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>" />
					</form>
				<?php 
			}
			else 
			{
				if ($not_logged_in != '')
				{
					echo "<p class='login_msg'>".$not_logged_in."</p>";
				}
				echo '<form name="loginform" id="loginform" action="'.get_bloginfo('url').'/wp-login.php" method="post">
						<input type="text" name="log" id="user_login" value="Username" size="25" tabindex="10" onfocus="if(this.value==\'Username\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'Username\';"/>
						<input type="password" name="pwd" id="user_pass" value="Password" size="25" tabindex="20" onfocus="if(this.value==\'Password\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'Password\';"/>
						<input type="submit" name="wp-submit" id="oap-wp-submit" style="margin-top:5px;" value="LOG IN"/>
						<p style="clear:both; text-align: right; width: 100%; display: inline-block;">
							<a href="'.get_bloginfo('url').'/wp-login.php?action=lostpassword" class="fancybox fancybox-iframe" style="text-align: right;">Forget your password?</a>
						</p>
						<input type="hidden" name="redirect_to" value="'.$redirect.'" />
						<input type="hidden" name="testcookie" value="1" />
					</form>';
			}
			/* After widget (defined by themes). */
			$after_widget='</div>';
			echo $after_widget;
		}

		/**
		 * Displays the widget settings controls on the widget panel.
		 * Make use of the get_field_id() and get_field_name() function
		 * when creating your form elements. This handles the confusing stuff.
		 */
		public function form( $instance ) 
		{
			/* Set up some default widget settings. */
			$defaults = array( 'title' => __('Member Login', 'example'),'description' => __('Welcome members! Please fill in your information below to login or click on the Forgot my password link to reset your password.', 'plaintext' ));
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
			<!-- Widget Title: Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
				<textarea id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" style="width:100%;"><?php echo $instance['title']; ?></textarea>
				<label for="<?php echo $this->get_field_id( 'not_logged_in' ); ?>"><?php _e('Message - Not Logged in:', 'hybrid'); ?></label>
				<textarea id="<?php echo $this->get_field_id( 'not_logged_in' ); ?>" name="<?php echo $this->get_field_name( 'not_logged_in' ); ?>" style="width:100%;"><?php echo $instance['not_logged_in']; ?></textarea>
				<label for="<?php echo $this->get_field_id( 'logged_in' ); ?>"><?php _e('Message - Logged in:', 'hybrid'); ?></label>
				<textarea id="<?php echo $this->get_field_id( 'logged_in' ); ?>" name="<?php echo $this->get_field_name( 'logged_in' ); ?>" style="width:100%;"><?php echo $instance['logged_in']; ?></textarea>
			</p>
			<?php
		}

		/**
		 * Update the widget settings.
		 */
		public function update( $new_instance, $old_instance ) 
		{
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['title'] =  $new_instance['title'] ;
			$instance['not_logged_in'] =  $new_instance['not_logged_in'] ;
			$instance['logged_in'] =  $new_instance['logged_in'] ;
			return $instance;
		}
	}


	function get_infobox_content()
	{
		global $post;
		if ( get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='Full Width' || 
		get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='720 by 420' )
		{ 
			if (get_post_meta($post->ID,'_on_off_info_box',true)=='ON')
			{
				if (get_post_meta($post->ID,'_oap_wywtl_yesno',true)=='On') 
				{
					$header1 = get_post_meta($post->ID,"_oap_infobox_heading", true);
					$text1 = get_post_meta($post->ID,"_oap_wywtl_text", true);

					$info1header = '<h2>' . $header1 . '</h2>';
					if ( isset($text1) )
					{
						$info1text = '<p>' . $text1 . '</p>';
					}
					else
					{
						$info1text = '';
					}

					return 
					'<div class="ms-headline-text">
						<div class="oap-infobox-fullvideo entry-content" id="oap-infobox-fullvideo">' 
							. $info1header . $info1text .
						'</div>
					</div>';

				}
				
				if (get_post_meta($post->ID,'_oap_length_yesno', true)=='On') 
				{
					$header2 = get_post_meta($post->ID,"_oap_infobox_length", true);
					$text2 = get_post_meta($post->ID,'_oap_wywtl_length', true);

					$info2header = '<h2>' . $header2 . '</h2>';
					if ( isset($text2) )
					{
						$info2text = '<p>' . $text2 . '</p>';
					}
					else
					{
						$info2text = '';
					}

					return 
					'<div class="ms-headline-text">
						<div class="oap-infobox-fullvideo entry-content" id="oap-infobox-fullvideo">' 
							. $info2header . $info2text .						 
						'</div>
					</div>';					
				}

			}
		}
	}


	function youtube_url($url,$return='embed',$width='',$height='',$rel=0)
	{
		$urls = parse_url($url);
		if ($urls['host'] == 'youtu.be') $id = ltrim($urls['path'],'/');
		else if (strpos($urls['path'],'embed') == 1) $id = end(explode('/',$urls['path']));
		else if (strpos($url,'/')===false) $id = $url;
		else {
			parse_str($urls['query']);
			$id = $v;
			}
		if ($return == 'embed') return '<iframe width="100%" height="100%" style="margin: 0px!important;" src="http://www.youtube.com/embed/'.$id.'?rel='.$rel.'" frameborder="0" allowfullscreen></iframe><script type="text/javascript">
				jQuery(document).ready(function()
				{
					var vidheight = jQuery(".ms-videocomments-video iframe").width() * 9 / 16;
					jQuery(".ms-videocomments-video").height(vidheight);
				});
				</script>';
		else if ($return == 'thumb') return 'http://i1.ytimg.com/vi/'.$id.'/default.jpg';
		else if ($return == 'hqthumb') return 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg';
		else return $id;
	}


	function get_video_content()
	{
		global $wpdb;
		global $post;

		$pluginsurl = plugins_url();

		$table_name = $wpdb->prefix . "media_listing";
		$query = "select * from $table_name where postID='".$post->ID."' order by recordListingId";
		$results = $wpdb->get_results($query);

		// First Video Only
		$listing = $results[0];

		// Filename
		$vidurl= $listing->fileName;

		// Video Extension
		$vidext= substr($vidurl,-3);

		// Checks for </object> or </iframe>
		$vidembed= substr($vidurl,-9);

		// Gets video object from PilotPress
		$viddata = PilotPress::get_oap_video($vidurl);

		// Gets the video URL from PilotPress
		$viddataurl = $viddata["url"];

		// Strips off the first and last part of the url from Ontraport video host
		$viddataurlstrip = substr($viddataurl, 36);
		$viddataurlstripped = substr($viddataurlstrip, 0, -4);

		// Video Thumbnail
		$viddatathumb = get_post_meta($post->ID, $listing->recordID.'_oap_video_thumbnail', true );

		// IF OAP VIDEOS
		if ($vidext=='mp4')
		{ 	

			if (is_callable("PilotPress::get_oap_video")) 
			{
				$video = 
				'<div class="flowplayer" data-swf="' . $pluginsurl . '/membership-simplified-for-oap-members-only/flowplayer/html5/flowplayer.min.js" data-ratio="0.5625" style="width: 100%!important;">
					<video>
						<source type="video/mp4" src="' . $vidurl . '">
						Sorry! Your browser does not support mp4 video streaming. Please try viewing this in Chrome, Firefox, Internet Explorer, or Safari. 
					</video>
				</div>
				<script type="text/javascript">
				jQuery(document).ready(function()
				{
					 jQuery(".fp-embed").remove();
				});
				</script>';
			} 

		} 
		else if ($vidembed == "</object>" || $vidembed == "</iframe>")
		{
			$video = stripslashes_deep($vidurl);
		}
		else if (is_numeric($vidurl)) 
		{
			if (is_callable("PilotPress::get_oap_video")) 
			{
				if (empty($viddatathumb)) 
				{
					if ( $viddata["thumbnail"] )
					{	
						$background = 'poster="' . $viddata["thumbnail"] . '"';
					}
					else
					{
						$background = 'style="background-color: #000!important;"';
					}
				}
				else
				{
					$background = 'poster="' . $viddatathumb . '"';
				}

				$video = '<div class="flowplayer" data-swf="' . $pluginsurl . '/membership-simplified-for-oap-members-only/flowplayer/html5/flowplayer.min.js" data-ratio="0.5625" style="width: 100%!important;">
					<video ' . $background . '>
						<source type="video/mp4" src="' . $viddataurl . '">
						Sorry! Your browser does not support mp4 video streaming. Please try viewing this in Chrome, Firefox, Internet Explorer, or Safari. 
					</video>
				</div>';

			}
		}
		else if ( !isset($vidurl) )
		{
			$video = '<div style="height: 350px;" class="novideo_div"><p style="padding-top: 150px;">Please Add Your Video!</p> </div>';
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
			{ 
				$video = '<iframe src="http://player.vimeo.com/video/' . $vimeovideo . '?title=0&amp;byline=0&amp;portrait=0" frameborder="0" width="100%" height="100%" webkitAllowFullScreen allowFullScreen></iframe><script type="text/javascript">
				jQuery(document).ready(function()
				{
					var vidheight = jQuery(".ms-videocomments-video iframe").width() * 9 / 16;
					jQuery(".ms-videocomments-video").height(vidheight);
				});
				</script>';
			} 
			else if ( $w == 'wistia' )
			{
				$video = '<iframe src="//fast.wistia.net/embed/iframe/' . $wistiavid . '" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="100%" height="100%"></iframe><script type="text/javascript">
				jQuery(document).ready(function()
				{
					var vidheight = jQuery(".ms-videocomments-video iframe").width() * 9 / 16;
					jQuery(".ms-videocomments-video").height(vidheight);
				});
				</script>';
			}
			else 
			{
				$video = youtube_url($vidurl);
			}
		}

		return '<link rel="stylesheet" type="text/css" href="' . $pluginsurl . '/membership-simplified-for-oap-members-only/flowplayer/html5/skin/minimalist.css"><script type="text/javascript" src="' . $pluginsurl . '/membership-simplified-for-oap-members-only/flowplayer/html5/flowplayer.min.js"></script>

			<div class="ms-videocomments-video">'
				. $video .
			'</div>';
	}


	function get_comments_template()
	{
		if ( post_password_required() ) 
		{
			return;
		}

		$comments = 'asdf<div id="comments" class="ms-comments-area">';

		if ( have_comments() ) 
		{

			$comments .= '<div id="comments" class="ms-comments-area">';

			if ( have_comments() ) :

				$comments .= '<h2 class="comments-title">';

				$comments .=  get_comments_number() . 'twentyfourteen' . number_format_i18n( get_comments_number() ) . get_the_title();

				$comments .= '</h2>';

				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

					$comments .= '<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
								<h1 class="screen-reader-text">';

						$comments .= _e( 'Comment navigation', 'twentyfourteen' );

						$comments .= '</h1>
						</div>
					</div>
				</div>';

				endif;

			endif;

		}

		return $comments;
	}



	function get_comment_content()
	{
		global $post;

		$id =get_the_ID();

		$comments = get_comments(array(
			'post_id' => $id,
			'status' => 'approve' //Change this to the type of comments to be displayed
		));

		$cform = comment_form();

		

		return '<div class="ms-videocomments-comments">'
			. //Display the list of comments
		wp_list_comments(array(
			'per_page' => 10, //Allow comment pagination
			'reverse_top_level' => false, //Show the latest comments at the top of the list
			'echo' => false
		), $comments) .
		$cform .
		'</div>
		<script type="text/javascript">
		jQuery(document).ready(function()
		{
			var respond = jQuery(".comment-respond");
			var below = jQuery(".ms-videocomments-comments");
			respond.addClass("top-comment-respond-form");
			var topform = jQuery(".top-comment-respond-form");
			topform.remove();
			below.append(respond).show();
		});
</script>';

	}


	function video_comments_template()
	{
		echo 	
		'<div class="msimplified-template video-comments">'
			. 
			get_infobox_content() . 
			get_video_content() .
			get_comment_content()
			.
		'</div>';
	}

  /*** Function To Get the page Id from page Title ***/
  function get_post_by_title($page_title, $output = OBJECT) {
	global $wpdb;
	$post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type='page'", $page_title ));
	if ( $post )
	return $post;
	}
	$theme_namee = get_current_theme();
  if (!in_array('duplicate-post/duplicate-post.php', apply_filters('active_plugins', get_option('active_plugins'))) && ($theme_namee != 'OptimizePress')) {
	define('DUPLICATE_POST_OAP_DOMAIN', 'duplicate-post');
	add_filter("plugin_action_links_".plugin_basename(__FILE__), "duplicate_post_plugin_actions", 10, 4);
	function duplicate_post_plugin_actions( $actions, $plugin_file, $plugin_data, $context ) {
	  array_unshift($actions, "<a href=\"".menu_page_url('duplicatepost', false)."\">".__("Settings")."</a>");
	  return $actions;
	  }
	  require_once (dirname(__FILE__).'/duplicate-post-common.php');
	  if (is_admin()){
		require_once (dirname(__FILE__).'/duplicate-post-admin.php');
	  }
	}
	$theme_namee = get_current_theme();
	if ($theme_namee == 'Thesis') {
	function hide_sidebars() {
	  global $post;
	  if ( 'oaplesson' == get_post_type() )
		return false;
	  else
		return true;
	}
	add_filter('thesis_show_sidebars', 'hide_sidebars');
	function custom_template() {
	  if ( 'oaplesson' == get_post_type() ) { ?>
	  <style>
		DIV.oap_comments
		{
		  display:none;
		}
		DIV.post_box
		{
		  display: none;
		}
	  </style>
	  <div class="format_text entry-content">
	  <?php oapMediaOrText(); ?>
	  </div>
	  <?php
	  }
	}
	add_action('thesis_hook_before_content', 'custom_template');
	}
  }