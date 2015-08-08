<?php

function udpate_or_add_option($option_name, $option_value){
	global $table_prefix;
	global $wpdb;
	$row = $wpdb->get_row( $wpdb->prepare( "SELECT option_name FROM $wpdb->options WHERE option_name = %s LIMIT 1", $option_name ) );
	if ( is_object( $row ) ) {
		update_option($option_name, $option_value);
	}
	else {
		add_option($option_name,$option_value);
	}
}
if(isset($_REQUEST["Save"]) && $_REQUEST["Save"]=="SAVE MY SETTINGS!"){
// echo "<pre>";print_r($_POST);die;
// echo $_POST['on_off_main_content'];die;
	foreach($_POST as $key => $value){
	udpate_or_add_option("oapmp_".$key,$value);
	}
	
	udpate_or_add_option("oapmp_on_off_menuitems", $_POST['oapmp_on_off_menuitems']);
	udpate_or_add_option("oapmp_on_off_infobox_download", $_POST['oapmp_on_off_infobox_download']);
	udpate_or_add_option("oapmp_on_off_main_content", $_POST['oapmp_on_off_main_content']);
	if(!isset($_POST["socials_facebook_share"])) udpate_or_add_option("oapmp_socials_facebook_share", "off");
	if(!isset($_POST["socials_facebook_like"])) udpate_or_add_option("oapmp_socials_facebook_like", "off");
	if(!isset($_POST["socials_twitter"])) udpate_or_add_option("oapmp_socials_twitter", "off");
	if(!isset($_POST["socials_google_plus"])) udpate_or_add_option("oapmp_socials_google_plus", "off");
}
if(isset($_REQUEST["Layout"]) && $_REQUEST["Layout"]=="SET THE LAYOUT!"){
	if(isset($_POST["media_template_max_width"])) udpate_or_add_option("oapmp_media_template_max_width",$_POST['media_template_max_width']);
	if(isset($_POST["media_template_max_height"])) udpate_or_add_option("oapmp_media_template_max_height",$_POST['media_template_max_height']);
	if(isset($_POST["text_template_max_width"])) udpate_or_add_option("oapmp_text_template_max_width",$_POST['text_template_max_width']);
	if(isset($_POST["text_template_max_height"])) udpate_or_add_option("oapmp_text_template_max_height",$_POST['text_template_max_height']);
}
//echo "<PRE>"; print_r($_REQUEST); echo "<PRE>";		
if(isset($_REQUEST["override_button"]) && $_REQUEST["override_button"]=="OVER-RIDE"){
	global $post;
	global $wpdb;
/** ON/Off Checkboxes **/
	udpate_or_add_option("oapmp_post_template_load",$_POST['oapmp_post_template_load']);
	update_option("oapmp_fullvideo_shared_position_load",$_POST['oapmp_fullvideo_shared_position_load']);
	udpate_or_add_option("oapmp_post_video_or_image_position_load",$_POST['oapmp_post_video_or_image_position_load']);
	
	udpate_or_add_option("oapmp_lesson_title_setting_load",$_POST['oapmp_lesson_title_setting_load']);
	
	update_option("oapmp_lesson_number_setting_load",$_POST['oapmp_lesson_number_setting_load']);
	udpate_or_add_option("oapmp_title_lessonnumber_setting_load",$_POST['oapmp_title_lessonnumber_setting_load']);		
	
	udpate_or_add_option("oapmp_sidebar_enable_load",$_POST['oapmp_sidebar_enable_load']);
	
	udpate_or_add_option("oapmp_lesson_menu_category_load",$_POST['oapmp_lesson_menu_category_load']);
	
	udpate_or_add_option("oapmp_post_content_menu_position_load",$_POST['oapmp_post_content_menu_position_load']);
	
	// Code for load Outer Frame Override 	
	udpate_or_add_option("oapmp_on_off_advanceSetting",$_POST['oapmp_on_off_advanceSetting']);
	
	udpate_or_add_option("oapmp_outer_template_override_load",$_POST['oapmp_outer_template_override_load']);
	
	udpate_or_add_option("oapmp_outer_template_override_height_load",$_POST['oapmp_outer_template_override_height_load']);
	
	udpate_or_add_option("oapmp_outer_template_override_width_load",$_POST['oapmp_outer_template_override_width_load']);
	
	update_option("oapmp_outer_template_background_color_load",$_POST['oapmp_outer_template_background_color_load']);
	
	update_option("oapmp_outer_template_custom_css_load",$_POST['oapmp_outer_template_custom_css_load']);
	
	// Code for load Inner Frame Override 	
	udpate_or_add_option("oapmp_template_override_load",$_POST['oapmp_template_override_load']);
	
	udpate_or_add_option("oapmp_template_override_height_load",$_POST['oapmp_template_override_height_load']);
	
	udpate_or_add_option("oapmp_template_override_width_load",$_POST['oapmp_template_override_width_load']);
	
	update_option("oapmp_template_background_color_load",$_POST['oapmp_template_background_color_load']);
	
	update_option("oapmp_template_custom_css_load",$_POST['oapmp_template_custom_css_load']);
	
	// Code for Load Global feature 
	udpate_or_add_option("oapmp_global_color_load",$_POST['oapmp_global_color_load']);
	udpate_or_add_option("oapmp_global_font_family_load",$_POST['oapmp_global_font_family_load']);
	udpate_or_add_option("oapmp_all_links_color_load",$_POST['oapmp_all_links_color_load']);
	update_option("oapmp_post_template",$_POST['oapmp_post_template']);
	update_option("oapmp_post_video_or_image_position",$_POST['oapmp_post_video_or_image_position']);
	
	update_option("oapmp_fullvideo_shared_position",$_POST['oapmp_fullvideo_shared_position']);
	
	update_option("oapmp_lesson_title_setting",$_POST['oapmp_lesson_title_setting']);
	update_option("oapmp_lesson_number_setting",$_POST['oapmp_lesson_number_setting']);
	
	update_option("oapmp_title_lessonnumber_setting",$_POST['oapmp_title_lessonnumber_setting']);	
	
	update_option("oapmp_sidebar_enable",$_POST['oapmp_sidebar_enable']);
	
	update_option("oapmp_lesson_menu_category",$_POST['oapmp_lesson_menu_category']);
	
	update_option("oapmp_post_content_menu_position",$_POST['oapmp_post_content_menu_position']);
	
	// Code for Outer Frame Override 	
	update_option("oapmp_outer_template_override",$_POST['oapmp_outer_template_override']);
	
	update_option("oapmp_outer_template_max_height",$_POST['oapmp_outer_template_max_height']);
	
	update_option("oapmp_outer_template_max_width",$_POST['oapmp_outer_template_max_width']);
	
	update_option("oapmp_outer_template_background_color",$_POST['oapmp_outer_template_background_color']);
	
	update_option("oapmp_outer_media_template_custom_css",$_POST['oapmp_outer_media_template_custom_css']);
	
	update_option("oapmp_outer_text_template_custom_css",$_POST['oapmp_outer_text_template_custom_css']);	
	
	// Code for Inner Frame Override 	
	update_option("oapmp_template_override",$_POST['oapmp_template_override']);
	
	update_option("oapmp_template_max_height",$_POST['oapmp_template_max_height']);
	
	update_option("oapmp_template_max_width",$_POST['oapmp_template_max_width']);
	
	update_option("oapmp_template_background_color",$_POST['oapmp_template_background_color']);
	
	update_option("oapmp_media_template_custom_css",$_POST['oapmp_media_template_custom_css']);
	
	update_option("oapmp_text_template_custom_css",$_POST['oapmp_text_template_custom_css']);
	
	// Code for Global feature 
	update_option("oapmp_global_color",$_POST['oapmp_global_color']);
	update_option("oapmp_global_font_family",$_POST['oapmp_global_font_family']);
	update_option("oapmp_all_links_color",$_POST['oapmp_all_links_color']);
	
	if($_POST['oapmp_global_color_load']=='on'){	
		   update_option('oapmp_overview_title_color',$_POST['oapmp_global_color']);
		   update_option('oapmp_membership_title_color',$_POST['oapmp_global_color']);
		   update_option('oapmp_membership_menu_image_border_color',$_POST['oapmp_global_color']);
		   update_option('oapmp_infobox_border_color',$_POST['oapmp_global_color']);
		   update_option('oapmp_infobox_titles_color',$_POST['oapmp_global_color']);
		   update_option('oapmp_post_titles_color',$_POST['oapmp_global_color']);
		   }//GLOBAL COLOR ENDS	
		   
		   if($_POST['oapmp_all_links_color_load']=='on'){	
		   update_option('oapmp_membership_menu_item_link_color',$_POST['oapmp_all_links_color']);
		   update_option('oapmp_membership_menu_item_link_hover_color',$_POST['oapmp_all_links_color']);
		   update_option('oapmp_membership_menu_item_link_visited_color',$_POST['oapmp_all_links_color']);
		   update_option('oapmp_download_link_color',$_POST['oapmp_all_links_color']);
		   update_option('oapmp_membership_content_links_color',$_POST['oapmp_all_links_color']);
		   }//GLOBAL COLOR ENDS
	if($_POST['oapmp_global_font_family_load']=='on'){	
		   update_option('oapmp_overview_font_family',$_POST['oapmp_global_font_family']);
		   update_option('oapmp_membership_menu_itemtitle_font_family',$_POST['oapmp_global_font_family']);
		   update_option('oapmp_membership_menu_itemtitle_font_family',$_POST['oapmp_global_font_family']);
		   update_option('oapmp_infobox_title_font_family',$_POST['oapmp_global_font_family']);
		   update_option('oapmp_post_title_font_family',$_POST['oapmp_global_font_family']);
	}//GLOBAL FONT FAMILY ENDS
	} //Main if Ends
	// Create page and post for sample
	if(isset($_REQUEST["Install_sample"]) && $_REQUEST["Install_sample"]=="Install Sample Data?"){
	global $wpdb;
	global $pagesTitle;
	$pages = get_pages();
/**
  *To Create Category 
  * @return download listing table
  */
foreach ($pages as $page) {
	 $pagesTitle[] = $page->post_title;
}
		if($pagesTitle == NULL)
		{
		$pagesTitle[]='Smaple Page';
		}
		    if (!in_array('Cancellation Page' , $pagesTitle)) { 
		    	$cancellation_page = array(
		            'post_title' => "Cancellation Page",
		            'post_content' => "<p>This is your cancellation page. There's no big surprise here. This is the page you will use to allow your members to cancel. All you really need on this page is some consolation text and a form that will submit their cancellation request to you. <em>(Hook this form up to a cancellation sequence where you will get notified about the cancellation and get tasked to remove the open order from the sales tab and membership permission levels from their contact record. This comes standard with the '<a title=\"KickStart Kits\" href=\"http://ps.zreply.com/kickstartkits\" target=\"_blank\">Pro Services membership package.</a>')</em></p>",
		            'post_status' => "publish",
		    		'post_type'   => "page",
		            
              );
		 	$cancellation_page_id = wp_insert_post($cancellation_page);
		 	}
			if (!in_array('Login or Upgrade Now' , $pagesTitle)) { 
		    	$login_upgrade_page = array(
		            'post_title' => "Login or Upgrade Now",
		            'post_content' => "<p>This is the error page that you will use in PilotPress for when your users don't have the right permission levels. This is what people will see when they try to access a page for which they don't have sufficient membership privileges. This page should include a login form, a link to your sales page (for non-members), and if your membership program is on a drip sequence (lessons 'dripped' out over time) you should include text information about what might have happened. Generally there are only two situations that could cause this to happen. Either a non member has tried to view a protected membership page or a member tried to reach a page without the proper level of permissions.</p><p>To create this type of page, use the following steps.</p><ol><li>Go to pages</li><li>Create a new page (Or edit this one. It's titled 'Login or Upgrade Now.'</li><li>On this page, add your title. (We recommend something like ('Whoops! Your permissions are Incorrect.')</li><li>The text for this page should go something like this:</li><ol><li>'Whoops, looks like you don't have the proper permissions to access this page. If you are a logged in member, you don't seem to have the proper permission levels just yet. Either contact your site administrator or upgrade here (add your upgrade link here.)</li><li>If you are a member but have not yet logged in, just use the form below. (Add the following shortcode to the page and it will turn into a login form on your page: [login_page] - O<em>n the front end this will look like a login form. When seen in the editor window, you will see the shortcode to use for login forms.)</em></li><li>If you are not yet a member, sign up for such-and-such program here (Add your link to the sales page).</li></ol></ol>",
		            'post_status' => "publish",
		    		'post_type'   => "page",
		            
              );
		 	$login_upgrade_page_id = wp_insert_post($login_upgrade_page);
		 	}
			if (!in_array('Membership Overview Page' , $pagesTitle)) { 
		    	$member_overview_page = array(
		            'post_title' => "Membership Overview Page",
		            'post_content' => "<p>The Membership Overview Page is the first or second thing your members will see when they log in. (If you only have one program, its best to redirect your members directly to their overview page rather that the Welcome Page. If you have multiple programs, its best to redirect first to the Welcome Page. To manage where your site will redirect your members on login, go to PilotPress in the settings section and set the 'customer login' page.)  </p><p>So for instance, when Susan (who is a Gold member) logs in she'll see a page with an overview description of the Gold membership program (what she'll be learning, benefits of the course, etc.) along with links to each of the different lessons available to her. When she clicks a lesson, she's taken to that particular lesson's page. Don't worry, your lessons will appear on this page automatically.<strong><strong></strong></strong></p><p>Here's how to create your overview pages:</p><ol><li>Click 'Pages' on the left. (In the backend of WordPress)</li><li>Click 'Add New' (Or click on 'Membership Overview Page' to edit this page.)</li><li>Type out your overview text: this is a description of the membership program. You might include benefits, what's they'll be learning, what to expect, etc.</li><li>Click the little black and white lock <a href=\"http://screencast.com/t/aFRkRRoPihn\">icon</a> in the tool bar.</li><li>Change the settings in there to suit your fancy.</li><li>Create a new overview page for each of your programs.</li></ol><div></div>",
		            'post_status' => "publish",
		    		'post_type'   => "page",
		            
              );
		 	$member_overview_page_id = wp_insert_post($member_overview_page);
		 	}
			if (!in_array('Membership Welcome Page' , $pagesTitle)) { 
		    	$member_welcome_page = array(
		            'post_title' => "Membership Welcome Page",
		            'post_content' => "<p><strong><strong>Create your welcome page. This is the first thing your people see when they login!</strong></strong></p><p><strong><strong></strong></strong>1. Here's how to create it</p><ol><ol><li>Go to Pages and add a new page. (or modify this one by clicking on the 'Membership Welcome Page')</li><li>Title the page 'Welcome Members' or something to that effect.</li><li>Add any welcome text that tells your members about their program/s.</li><li>List all of the membership programs that you are offering, and link each title to its respective overview page.</li></ol></ol><div></div><p dir='ltr'>2. Advanced Use (Optional) - If you want to be super slick, you can use this page as an 'Ultimate Overview page' where you can add all of your membership program's overview sections and protect them with PilotPress show / if tags. By wrapping the sections in the show / if tags and setting the permissions properly, your members will only see the overview section that they have the proper permissions for. For more information on show / if tags, check out the 'Showing / Hiding Sections of Content on a Page' section of <a href='http://wiki.sendpepper.com/w/page/32144093/WordPress%20Integration#Showing/HidingSectionsofContentonaPage'>this article</a>. (There are a ton of shortcodes that will do different things, so its important to read this doc.) Here is an example of what the code would look like:</p><p dir='ltr'><img class='alignnone size-full wp-image-57' title='showifcode' src='http://mem.affcntr.com/wp-content/uploads/2012/03/showifcode.png' alt='' width='553' height='212' /></p><p dir='ltr'>On the front end, this code would display three overview sections to an admin with all permissions. However, this would only display the overview sections that a member has permissions for when they login.</p><p dir='ltr'><a href='http://mem.affcntr.com/wp-content/uploads/2012/03/ultimateoverviewpage.png'><img class='alignnone  wp-image-58' title='ultimateoverviewpage' src='http://mem.affcntr.com/wp-content/uploads/2012/03/ultimateoverviewpage.png' alt='' width='900' height='2100' /></a></p>",
		            'post_status' => "publish",
		    		'post_type'   => "page",
		            
              );
		 	$member_welcome_page_id = wp_insert_post($member_welcome_page);
		 	}
			if (!in_array('OptIn Page' , $pagesTitle)) { 
		    	$optin_page = array(
		            'post_title' => "OptIn Page",
		            'post_content' => "<p>This is your OptIn Page. The purpose of an opt-in page is to generate interest in your membership program, products, and a variety of other similar items. By creating a compelling reason for your potential clients to give you their email address or other contact information, you have the ability to follow up with your leads and to keep them informed about things that might eventually spark their interest in making a purchase. We recommend giving away something that your leads will get true value from as integrity definitely helps in converting leads to clients. Some people will create multi page eBooks while others simply give free trial membership offers or discounts on making a purchase. Whatever it might be, place all the necessary information and promotional assets like images, videos, and/or testimonials on this page along with a form or 'Connect with Facebook' button from your OfficeAutopilot account.</p><p><em>(Hook this form up to a lead generation sequence where you will get notified about the new lead and get tasked to follow up with them. This comes standard with the Build a List '<a title=\"KickStart Kits\" href=\"http://ps.zreply.com/kickstartkits\" target=\"_blank\">Pro Services membership package.</a>')</em></p>",
		            'post_status' => "publish",
		    		'post_type'   => "page",
		            
              );
		 	$optin_page_id = wp_insert_post($optin_page);
		 	}
			if (!in_array('Thank You page' , $pagesTitle)) { 
		    	$thanks_page = array(
		            'post_title' => "Thank You page",
		            'post_content' => "<p>This is the thank you page. This is where you can thank your members for their purchase of your membership program and inform them that they will get their download via email shortly. This can additionally be a great place to advertise any promotions or additional similar products etc.</p>",
		            'post_status' => "publish",
		    		'post_type'   => "page",
		            
              );  
		 	$thanks_page_id = wp_insert_post($thanks_page);
		 	}
			
			$textlayout_count = $wpdb->get_var( $wpdb->query( "SELECT COUNT(*) FROM $wpdb->posts where post_type='oaplesson' and post_title='Text Layout'" ) );
			$sharedlayout_count = $wpdb->get_var( $wpdb->query( "SELECT COUNT(*) FROM $wpdb->posts where post_type='oaplesson' and post_title='Shared Video Layout'" ) );
			$fulllvideolayout_count = $wpdb->get_var( $wpdb->query( "SELECT COUNT(*) FROM $wpdb->posts where post_type='oaplesson' and post_title='Full Width Video Layout'" ) );
			if ($textlayout_count < 1 && $sharedlayout_count < 1 && $fulllvideolayout_count < 1) { 
			wp_insert_term('Basic','mprogram',array('description'=>'Oap Membership Category'));
			}
			if ($textlayout_count < 1) { 
			
			$cat_name = 'Basic';
		   	$sample_lesson1 = array(
		            'post_title' => "Text Layout",
		            'post_content' => "<p> <em>(This is the main content area of your lesson. This is where you can add text, videos, images, forms, and whatever else your heart desires.)</em></p><h3> </h3><h3>About the Text Layout</h3><p>This is the Text Layout. Since it's a template, it enables you to create text based lesson pages without being a programmer.  This text layout template is often used for those lessons that don't have videos in them. You can easily add the following items to your lessons:</p><ul><li>Your lesson title in 6 different positions</li><li>One or two sections of info-text (eg what you will learn, how long the lesson takes, or anything else you want to type)</li><li>Your main content that can contain text, images, videos (although videos would be better placed in the video module section), or any html code</li><li>Downloadable items with corresponding icons from your OfficeAutopilot file manager, a web URL, or manually uploaded to your site (including pdf's, docs, mp3's, etc.)</li><li>Sidebar navigation to your other lessons</li></ul><p>&nbsp;</p><h3>Creating New Lessons</h3><p>This is an individual lesson. To create individual lessons, follow these steps:</p><ol><li>Log into the backend your wordpress site. (Your site domain followed by a /wp-admin)</li><li>Under the 'Membership Content' menu on the left, click '<a title=\"Add New Lesson\" href=\"http://screencast.com/t/6wk2FzCj\" target=\"_blank\">Add New Lesson</a>'.</li><li>Add your <a title=\"Title\" href=\"http://screencast.com/t/rSjHfsHY8ou\" target=\"_blank\">title</a> at the top and your <a title=\"Main Content\" href=\"http://screencast.com/t/rSjHfsHY8ou\" target=\"_blank\">main content</a> in the section just below. (You can add text, images, video, or HTML code here.)</li><li>Then scroll down to the '<a title=\"Membership - Lesson Settings Module\" href=\"http://screencast.com/t/TgBOfEZdW1j\" target=\"_blank\">Membership - Lesson Settings module</a>. (If you don't see it, at the very top right of the page click on '<a title=\"Screen Options\" href=\"http://screencast.com/t/YGHjphvWx\" target=\"_blank\">Screen Options</a>,' then select 'Membership - Lesson Settings, and then click the 'Screen Options' again.')</li><li>Start by setting up your membership <a title=\"Menu Item\" href=\"http://screencast.com/t/a8Tb40W9ps\" target=\"_blank\">Menu Item</a> with an Image, Lesson Number, &amp; Item Description. </li><li>Then set your <a title=\"Page Layout\" href=\"http://screencast.com/t/46cFEx2VH6\" target=\"_blank\">page layout</a>.</li><li>Next, add your membership <a title=\"Content Items\" href=\"http://www.diigo.com/item/image/1bf77/ty1c\" target=\"_blank\">content items</a>.</li><li>Finally, set which <a title=\"Membership Levels\" href=\"http://screencast.com/t/jxA5YVhF\" target=\"_blank\">membership level(s)</a> will have access to this lesson, and add it to one or multiple <a title=\"Membership Programs\" href=\"http://screencast.com/t/ONvLt3wvjQCv\" target=\"_blank\">membership programs</a>.</li><li>Set the <a title=\"Publish Settings\" href=\"http://screencast.com/t/oKMCqrP3L9\" target=\"_blank\">publish settings</a> where you can save it as a draft till you are ready to finish it later, set a password for the lesson / make it private just to you, and select the date when you want it to begin publishing.</li></ol><p>If you have a question at any time, feel free to click on the little <a title=\"Help Icons\" href=\"http://screencast.com/t/3nhRogqWHQ\" target=\"_blank\">help icons</a> next to anything you have questions about. </p><p><strong>*Please note</strong> - You can download our three help docs to help you get completely setup. <a title=\"Membership Simplified\" href=\"http://officeautopilot.com/mp/helpfiles/membershipsimplified.pdf\" target=\"_blank\">'Membership, Simplified.'</a> offers information on getting the plugin configured, adding your content, and getting the majority of WordPress setup, whereas <a title=\"How to Charge for Access to Your Site\" href=\"http://officeautopilot.com/mp/helpfiles/howtocharge.pdf\" target=\"_blank\">'How to Charge for Access to Your Site'</a> addresses the things you need to do to set drip content releases, automated permission changes, and other OfficeAutopilot 'system' settings and options. Additionally, you might find it very helpful to download the <a title=\"Membership Planning Worksheet\" href=\"http://officeautopilot.com/mp/helpfiles/membershipplanningworksheet.pdf\" target=\"_blank\">Membership Planning Worksheet</a> as it will help you plan out the content for your site.</p><p><strong>**Please also note</strong> - If you have trouble with the layout of your site, click here to learn more about the <a title=\"Advanced Settings\" href=\"http://officeautopilot.com/mp/helpfiles/advancedsettingsoptions.pdf\" target=\"_blank\">Advanced Settings options</a> and how they can be used to fix theme incompatibilities or even to customize your lesson layout further.</p>",
		            'post_status' => "publish",
		    		'post_type'   => "oaplesson",
		            
              );
		 	$sample_lesson_id1 = wp_insert_post($sample_lesson1);
			wp_set_object_terms($sample_lesson_id1, $cat_name, 'mprogram');
			$tablename= $wpdb->prefix."posts";
			$downloadtable=$wpdb->prefix . "download_listing";
			$term = get_term_by('name', 'Basic', 'mprogram');
			$category_ID= $term->term_id;
			$wpdb->query("update $tablename set menu_order = '1' where ID= $sample_lesson_id1");
update_post_meta( $sample_lesson_id1, '_oap_overview_text', "This is the Text Layout. While it doesn't offer video, it does offer a duplicate layout with the possibility of adding your title, info-text, main text, downloads, and sidebar navigation!" );
update_post_meta( $sample_lesson_id1, '_oap_media_text_template', 'Text Template' );
update_post_meta( $sample_lesson_id1, '_oap_lesson_title_setting', 'Enabled' );
update_post_meta( $sample_lesson_id1, '_oap_lesson_number_setting', 'Enabled' );
update_post_meta( $sample_lesson_id1, '_oap_title_lessonnumber_setting', 'TLeft' );
update_post_meta( $sample_lesson_id1, '_oap_sidebar_position', 'Enabled' );
update_post_meta( $sample_lesson_id1, '_oap_lesson_menu_category', $category_ID );
update_post_meta( $sample_lesson_id1, '_oap_lesson_menu_position', 'Left' );
update_post_meta( $sample_lesson_id1, '_on_off_info_box', 'ON' );
update_post_meta( $sample_lesson_id1, '_oap_wywtl_yesno', 'On' );
update_post_meta( $sample_lesson_id1, '_oap_infobox_heading', '1st Text Area - Title' );
update_post_meta( $sample_lesson_id1, "_oap_wywtl_text", "This is the frist info text area. You can set this in the back end by going to the 'Add Info Text' section,turn on the 1st text area, and filling out the title and text area fields." );
update_post_meta( $sample_lesson_id1, '_oap_length_yesno', 'On' );
update_post_meta( $sample_lesson_id1, '_oap_infobox_length', '2nd Text Area - Title' );
update_post_meta( $sample_lesson_id1, "_oap_wywtl_length", "This is the second info text area. You can set this in the back end by going to the 'Add Info Text' section,turn on the 2nd text area, and filling out the title and text area fields." );
update_post_meta( $sample_lesson_id1, '_on_off_download', 'ON' );
$data= array(
							 'postId'=>$sample_lesson_id1,	
						     'recordText' =>'Sample Download',
							 'fileName'=> site_url().'/wp-content/plugins/membership-simplified-for-oap-members-only/images/rectangular.png'
								        );
		                      $wpdb->insert( $downloadtable, $data, $format=null );
update_post_meta( $sample_lesson_id1, '_on_off_main_media', '' );	
update_post_meta( $sample_lesson_id1, '_on_off_custom_html', 'ON' );
update_post_meta( $sample_lesson_id1, '_oap_custom_html', "<div style='background-color:#FFFFFF;color:#000000;padding:30px;text-align:center;'><h2>This is the Text Layout</h2><br /><p>This is the Custom HTML section. You can use it to add header banners or whatever else you might like.</p></div>" );
			
		 	}
			
			if ($sharedlayout_count < 1) { 
			
			$cat_name = 'Basic';
		   	$sample_lesson2 = array(
		            'post_title' => "Shared Video Layout",
		            'post_content' => "<p><em>(This is the main content area of your lesson. This is where you can add text, videos, images, forms, and whatever else your heart desires.)</em></p><h3> </h3><h3>About the Shared Video Layout</h3><p>This is an example of a shared width video layout template. Since it's a template, it enables you to have a video based layout. The video takes up about 2/3 of the space at the top of the page (versus the full width video layout which takes up 100%) at any time without having to be a programmer. Additionally, you can easily add multiple videos to your lessons from: </p><ul><li>OfficeAutopilot</li><li>Vimeo or Youtube</li><li>Amazon S3, HDDN, other content delivery providers or your own server</li><li>or anywhere else on the web that provides video embed code for you to use. </li></ul><p>In addition to adding videos, you can add:</p><ul><li>Your title in 6 different positions</li><li>One or two sections of info-text (eg what you will learn, how long the lesson takes, or anything else you want to type)</li><li>Your main content that can contain text, images, videos (although videos would be better placed in the video module section), or any html code </li><li>Downloadable items with corresponding icons from your OfficeAutopilot file manager, a web URL, or manually uploaded to your site (including pdf's, docs, mp3's, etc.)</li><li>Sidebar navigation to your other lessons</li></ul><p>&nbsp;</p><h3>Creating New Lessons</h3><p>This is an individual lesson. To create individual lessons, follow these steps:</p><ol><li>Log into the backend your wordpress site. (Your site domain followed by a /wp-admin)</li><li>Under the 'Membership Content' menu on the left, click '<a title=\"Add New Lesson\" href=\"http://screencast.com/t/6wk2FzCj\" target=\"_blank\">Add New Lesson</a>'.</li><li>Add your <a title=\"Title\" href=\"http://screencast.com/t/rSjHfsHY8ou\" target=\"_blank\">title</a> at the top and your <a title=\"Main Content\" href=\"http://screencast.com/t/rSjHfsHY8ou\" target=\"_blank\">main content</a> in the section just below. (You can add text, images, video, or HTML code here.)</li><li>Then scroll down to the '<a title=\"Membership - Lesson Settings Module\" href=\"http://screencast.com/t/TgBOfEZdW1j\" target=\"_blank\">Membership - Lesson Settings module</a>. (If you don't see it, at the very top right of the page click on '<a title=\"Screen Options\" href=\"http://screencast.com/t/YGHjphvWx\" target=\"_blank\">Screen Options</a>,' then select 'Membership - Lesson Settings, and then click the 'Screen Options' again.')</li><li>Start by setting up your membership <a title=\"Menu Item\" href=\"http://screencast.com/t/a8Tb40W9ps\" target=\"_blank\">Menu Item</a> with an Image, Lesson Number, &amp; Item Description. </li><li>Then set your <a title=\"Page Layout\" href=\"http://screencast.com/t/46cFEx2VH6\" target=\"_blank\">page layout</a>.</li><li>Next, add your membership <a title=\"Content Items\" href=\"http://www.diigo.com/item/image/1bf77/ty1c\" target=\"_blank\">content items</a>.</li><li>Finally, set which <a title=\"Membership Levels\" href=\"http://screencast.com/t/jxA5YVhF\" target=\"_blank\">membership level(s)</a> will have access to this lesson, and add it to one or multiple <a title=\"Membership Programs\" href=\"http://screencast.com/t/ONvLt3wvjQCv\" target=\"_blank\">membership programs</a>.</li><li>Set the <a title=\"Publish Settings\" href=\"http://screencast.com/t/oKMCqrP3L9\" target=\"_blank\">publish settings</a> where you can save it as a draft till you are ready to finish it later, set a password for the lesson / make it private just to you, and select the date when you want it to begin publishing.</li></ol><p>If you have a question at any time, feel free to click on the little <a title=\"Help Icons\" href=\"http://screencast.com/t/3nhRogqWHQ\" target=\"_blank\">help icons</a> next to anything you have questions about. </p><p><strong>*Please note</strong> - You can download our three help docs to help you get completely setup. <a title=\"Membership Simplified\" href=\"http://officeautopilot.com/mp/helpfiles/membershipsimplified.pdf\" target=\"_blank\">'Membership, Simplified.'</a> offers information on getting the plugin configured, adding your content, and getting the majority of WordPress setup, whereas <a title=\"How to Charge for Access to Your Site\" href=\"http://officeautopilot.com/mp/helpfiles/howtocharge.pdf\" target=\"_blank\">'How to Charge for Access to Your Site'</a> addresses the things you need to do to set drip content releases, automated permission changes, and other OfficeAutopilot 'system' settings and options. Additionally, you might find it very helpful to download the <a title=\"Membership Planning Worksheet\" href=\"http://officeautopilot.com/mp/helpfiles/membershipplanningworksheet.pdf\" target=\"_blank\">Membership Planning Worksheet</a> as it will help you plan out the content for your site.</p><p><strong>**Please also note</strong> - If you have trouble with the layout of your site, click here to learn more about the <a title=\"Advanced Settings\" href=\"http://officeautopilot.com/mp/helpfiles/advancedsettingsoptions.pdf\" target=\"_blank\">Advanced Settings options</a> and how they can be used to fix theme incompatibilities or even to customize your lesson layout further.</p>",
		            'post_status' => "publish",
		    		'post_type'   => "oaplesson",
		            
              );
		 	$sample_lesson_id2 = wp_insert_post($sample_lesson2);
		
			wp_set_object_terms($sample_lesson_id2, $cat_name, 'mprogram');
			$tablename= $wpdb->prefix."posts";
			$downloadtable=$wpdb->prefix . "download_listing";
			$media_table = $wpdb->prefix . "media_listing";
			$term = get_term_by('name', 'Basic', 'mprogram');
			$category_ID= $term->term_id;
			$wpdb->query("update $tablename set menu_order = '2' where ID= $sample_lesson_id2");
update_post_meta( $sample_lesson_id2, '_oap_overview_text', "This is the Shared width video layout. This offers a duplicate video based  layout with a video module that takes up 65% of the space and infobox that takes up the rest." );
update_post_meta( $sample_lesson_id2, '_oap_media_text_template', 'Media Template' );
update_post_meta( $sample_lesson_id2, '_oap_fullvideo_shared_position', 'Shared' );
update_post_meta( $sample_lesson_id2, '_oap_video_image_position', 'Right' );
update_post_meta( $sample_lesson_id2, '_oap_lesson_title_setting', 'Enabled' );
update_post_meta( $sample_lesson_id2, '_oap_lesson_number_setting', 'Enabled' );
update_post_meta( $sample_lesson_id2, '_oap_title_lessonnumber_setting', 'TLeft' );
update_post_meta( $sample_lesson_id2, '_oap_sidebar_position', 'Enabled' );
update_post_meta( $sample_lesson_id2, '_oap_lesson_menu_category', $category_ID );
update_post_meta( $sample_lesson_id2, '_oap_lesson_menu_position', 'Left' );
update_post_meta( $sample_lesson_id2, '_on_off_info_box', 'ON' );
update_post_meta( $sample_lesson_id2, '_oap_wywtl_yesno', 'On' );
update_post_meta( $sample_lesson_id2, '_oap_infobox_heading', '1st Text Area - Title' );
update_post_meta( $sample_lesson_id2, "_oap_wywtl_text", "This is the frist info text area. You can set this in the back end by going to the 'Add Info Text' section,turn on the 1st text area, and filling out the title and text area fields." );
update_post_meta( $sample_lesson_id2, '_oap_length_yesno', 'On' );
update_post_meta( $sample_lesson_id2, '_oap_infobox_length', '2nd Text Area - Title' );
update_post_meta( $sample_lesson_id2, "_oap_wywtl_length", "This is the second info text area. You can set this in the back end by going to the 'Add Info Text' section,turn on the 2nd text area, and filling out the title and text area fields." );
update_post_meta( $sample_lesson_id2, '_on_off_download', 'ON' );
$data= array(
							 'postId'=>$sample_lesson_id2,	
						     'recordText' =>'Sample Download',
							 'fileName'=> site_url().'/wp-content/plugins/membership-simplified-for-oap-members-only/images/rectangular.png'
								        );
		                      $wpdb->insert( $downloadtable, $data, $format=null );
update_post_meta( $sample_lesson_id2, '_on_off_main_media', 'ON' );	
$data= array(
							 'postId'=>$sample_lesson_id2,	
						     'recordText' =>'Sample Shared Video',
							 'fileName'=> 'http://vimeo.com/34134308'
								        );
		                      $wpdb->insert( $media_table, $data, $format=null );					
update_post_meta( $sample_lesson_id2, '_on_off_custom_html', 'ON' );
update_post_meta( $sample_lesson_id2, '_oap_custom_html', "<div style='background-color:#FFFFFF;color:#000000;padding:30px;text-align:center;'><h2>This is the Shared Video Layout</h2><br /><p>This is the Custom HTML section. You can use it to add header banners or whatever else you might like.</p></div>" );
		 	}
		
			if ($fulllvideolayout_count < 1) { 
			
			$cat_name = 'Basic';
		   	$sample_lesson3 = array(
		            'post_title' => "Full Width Video Layout",
		            'post_content' => "<p><em>(This is the main content area of your lesson. This is where you can add text, videos, images, forms, and whatever else your heart desires.)</em></p><p>&nbsp;</p><h3>About the Full Width Video Layout</h3><p>This is a full width video template. Since it's a template, it enables you to have a video based layout with a full width video at the top at any time without having to be a programmer. Additionally, you can easily add multiple videos to your lessons from:</p><ul><li>OfficeAutopilot</li><li>Vimeo or Youtube</li><li>Amazon S3, HDDN, other content delivery providers or your own server</li><li>Anywhere else on the web that provides video embed code for you to use. </li></ul><p>In addition to adding videos, you can add:</p><ul><li>Your lesson title in 6 different positions</li><li>One or two sections of info text (eg what you will learn, how long the lesson takes, or anything else you want to type)</li><li>Your main content that can contain text, images, videos (although videos would be better placed in the video module section), or any html code</li><li>Downloadable items with corresponding icons from your OfficeAutopilot file manager, a web URL, or manually uploaded to your site (including pdf's, docs, mp3's, etc.)</li><li>Sidebar navigation to your other lessons</li></ul><h3> </h3><h3>Creating New Lessons</h3><p>This is an individual lesson. To create individual lessons, follow this procedure:</p><ol><li>Log into the backend your wordpress site. (Your site domain followed by a /wp-admin)</li><li>Under the 'Membership Content' menu on the left, click '<a title=\"Add New Lesson\" href=\"http://screencast.com/t/6wk2FzCj\" target=\"_blank\">Add New Lesson</a>'.</li><li>Add your <a title=\"Title\" href=\"http://screencast.com/t/rSjHfsHY8ou\" target=\"_blank\">title</a> at the top and your <a title=\"Main Content\" href=\"http://screencast.com/t/rSjHfsHY8ou\" target=\"_blank\">main content</a> in the section just below. (You can add text, images, video, or HTML code here.)</li><li>Then scroll down to the '<a title=\"Membership - Lesson Settings Module\" href=\"http://screencast.com/t/TgBOfEZdW1j\" target=\"_blank\">Membership - Lesson Settings module</a>. (If you don't see it, at the very top right of the page click on '<a title=\"Screen Options\" href=\"http://screencast.com/t/YGHjphvWx\" target=\"_blank\">Screen Options</a>,' then select 'Membership - Lesson Settings, and then click the 'Screen Options' again.')</li><li>Start by setting up your membership <a title=\"Menu Item\" href=\"http://screencast.com/t/a8Tb40W9ps\" target=\"_blank\">Menu Item</a> with an Image, Lesson Number, &amp; Item Description. </li><li>Then set your <a title=\"Page Layout\" href=\"http://screencast.com/t/46cFEx2VH6\" target=\"_blank\">page layout</a>.</li><li>Next, add your membership <a title=\"Content Items\" href=\"http://www.diigo.com/item/image/1bf77/ty1c\" target=\"_blank\">content items</a>.</li><li>Finally, set which <a title=\"Membership Levels\" href=\"http://screencast.com/t/jxA5YVhF\" target=\"_blank\">membership level(s)</a> will have access to this lesson, and add it to one or multiple <a title=\"Membership Programs\" href=\"http://screencast.com/t/ONvLt3wvjQCv\" target=\"_blank\">membership programs</a>.</li><li>Set the <a title=\"Publish Settings\" href=\"http://screencast.com/t/oKMCqrP3L9\" target=\"_blank\">publish settings</a> where you can save it as a draft till you are ready to finish it later, set a password for the lesson / make it private just to you, and select the date when you want it to begin publishing.</li></ol><p>If you have a question at any time, feel free to click on the little <a title=\"Help Icons\" href=\"http://screencast.com/t/3nhRogqWHQ\" target=\"_blank\">help icons</a> next to anything you have questions about. </p><p><strong>*Please note</strong> - You can download our three help docs to help you get completely setup. <a title=\"Membership Simplified\" href=\"http://officeautopilot.com/mp/helpfiles/membershipsimplified.pdf\" target=\"_blank\">'Membership, Simplified.'</a> offers information on getting the plugin configured, adding your content, and getting the majority of WordPress setup, whereas <a title=\"How to Charge for Access to Your Site\" href=\"http://officeautopilot.com/mp/helpfiles/howtocharge.pdf\" target=\"_blank\">'How to Charge for Access to Your Site'</a> addresses the things you need to do to set drip content releases, automated permission changes, and other OfficeAutopilot 'system' settings and options. Additionally, you might find it very helpful to download the <a title=\"Membership Planning Worksheet\" href=\"http://officeautopilot.com/mp/helpfiles/membershipplanningworksheet.pdf\" target=\"_blank\">Membership Planning Worksheet</a> as it will help you plan out the content for your site.</p><p><strong>**Please also note</strong> - If you have trouble with the layout of your site, click here to learn more about the <a title=\"Advanced Settings\" href=\"http://officeautopilot.com/mp/helpfiles/advancedsettingsoptions.pdf\" target=\"_blank\">Advanced Settings options</a> and how they can be used to fix theme incompatibilities or even to customize your lesson layout further.</p>",
		            'post_status' => "publish",
		    		'post_type'   => "oaplesson",
		            
              );
		 	
			$sample_lesson_id3 = wp_insert_post($sample_lesson3);
			wp_set_object_terms($sample_lesson_id3, $cat_name, 'mprogram');
			$tablename= $wpdb->prefix."posts";
			$downloadtable=$wpdb->prefix . "download_listing";
			$media_table = $wpdb->prefix . "media_listing";
			$term = get_term_by('name', 'Basic', 'mprogram');
			$category_ID= $term->term_id;
			$wpdb->query("update $tablename set menu_order = '3' where ID= $sample_lesson_id3");
update_post_meta( $sample_lesson_id3, '_oap_overview_text', "This is full width video template. It demonstrate the layout of a full width video, info text,downloads, and no sidebar." );
update_post_meta( $sample_lesson_id3, '_oap_media_text_template', 'Media Template' );
update_post_meta( $sample_lesson_id3, '_oap_fullvideo_shared_position', 'Full Width' );
update_post_meta( $sample_lesson_id3, '_oap_video_image_position', 'Right' );
update_post_meta( $sample_lesson_id3, '_oap_lesson_title_setting', 'Enabled' );
update_post_meta( $sample_lesson_id3, '_oap_lesson_number_setting', 'Enabled' );
update_post_meta( $sample_lesson_id3, '_oap_title_lessonnumber_setting', 'MCenter' );
update_post_meta( $sample_lesson_id3, '_oap_sidebar_position', 'Disabled' );
update_post_meta( $sample_lesson_id3, '_on_off_info_box', 'ON' );
update_post_meta( $sample_lesson_id3, '_oap_wywtl_yesno', 'On' );
update_post_meta( $sample_lesson_id3, '_oap_infobox_heading', '1st Text Area - Title' );
update_post_meta( $sample_lesson_id3, "_oap_wywtl_text", "This is the frist info text area. You can set this in the back end by going to the 'Add Info Text' section,turn on the 1st text area, and filling out the title and text area fields." );
update_post_meta( $sample_lesson_id3, '_oap_length_yesno', 'On' );
update_post_meta( $sample_lesson_id3, '_oap_infobox_length', '2nd Text Area - Title' );
update_post_meta( $sample_lesson_id3, "_oap_wywtl_length", "This is the second info text area. You can set this in the back end by going to the 'Add Info Text' section,turn on the 2nd text area, and filling out the title and text area fields." );
update_post_meta( $sample_lesson_id3, '_on_off_download', 'ON' );
$data= array(
							 'postId'=>$sample_lesson_id3,	
						     'recordText' =>'Sample Download',
							 'fileName'=> site_url().'/wp-content/plugins/membership-simplified-for-oap-members-only/images/rectangular.png'
								        );
		                      $wpdb->insert( $downloadtable, $data, $format=null );
update_post_meta( $sample_lesson_id3, '_on_off_main_media', 'ON' );	
$data= array(
							 'postId'=>$sample_lesson_id3,	
						     'recordText' =>'Sample Full Width Video',
							 'fileName'=> 'http://vimeo.com/34134308'
								        );
		                      $wpdb->insert( $media_table, $data, $format=null );					
update_post_meta( $sample_lesson_id3, '_on_off_custom_html', 'ON' );
update_post_meta( $sample_lesson_id3, '_oap_custom_html', "<div style='background-color:#FFFFFF;color:#000000;padding:30px;text-align:center;'><h2>This is the Full Width Video Layout</h2><p>This is the Custom HTML section. You can use it to add header banners or whatever else you might like.</p></div>" );
		 	}
			$success= "Sample Data has successfully installed.";
   }
?>
<div class="wrap"><script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#oapmp_global_color').modcoder_excolor({
			callback_on_ok : function() { //Change color of other color boxes when global_color is changed
				jQuery('#overview_title_color, #membership_title_color, #membership_menu_image_border_color,#infobox_border_color, #infobox_titles_color, #post_titles_color, #oapmp_global_color').val(jQuery('#oapmp_global_color').val());
				jQuery('#overview_title_color, #membership_title_color, #membership_menu_image_border_color, #infobox_border_color, #infobox_titles_color, #post_titles_color, #oapmp_global_color').attr("background-color",jQuery('#oapmp_global_color').val());
			}
			
});
	
jQuery('#oapmp_all_links_color').modcoder_excolor({
			callback_on_ok : function() { //Change color of other color boxes when global_color is changed
				jQuery('#membership_menu_item_link_color , #membership_menu_item_link_hover_color ,#membership_menu_item_link_visited_color, #download_link_color, #membership_content_links_color, #oapmp_all_links_color').val(jQuery('#oapmp_all_links_color').val());
				jQuery('#membership_menu_item_link_color , #membership_menu_item_link_hover_color ,#membership_menu_item_link_visited_color, #download_link_color, #membership_content_links_color ,#oapmp_all_links_color').attr("background-color",jQuery('#oapmp_all_links_color').val());
			}
});
jQuery('#overview_title_color, #membership_title_color, #membership_menu_image_border_color, #membership_menu_item_link_color , #membership_menu_item_link_hover_color ,#membership_menu_item_link_visited_color, #download_link_color, #membership_content_links_color, #infobox_border_color, #infobox_titles_color, #post_titles_color, #oapmp_template_background_color, #oapmp_outer_template_background_color').modcoder_excolor();
	jQuery('#oapmp_global_color, #overview_title_color, #membership_title_color, #membership_menu_image_border_color, #membership_menu_item_link_color , #membership_menu_item_link_hover_color ,#membership_menu_item_link_visited_color , #download_link_color, #infobox_border_color, #infobox_titles_color, #post_titles_color, #all_links_color').css("color", '#FFFFFF');
	jQuery('#oapmp_global_color, #overview_title_color, #membership_title_color, #membership_menu_image_border_color,#membership_menu_item_link_color , #membership_menu_item_link_hover_color ,#membership_menu_item_link_visited_color, #download_link_color, #infobox_border_color, #infobox_titles_color, #post_titles_color, #all_links_color').css("text-shadow", '-1px -1px FFF, 1px 1px #FFF');
jQuery("#global_styling_option").change(function () {
         jQuery("#global_styling_option option:selected").each(function () {
               if(jQuery("#global_styling_option").val()=="Use my current theme stylesheet"){
		   		   /* jQuery('#global_color').attr('disabled', true);jQuery('#global_color').closest('td').addClass("faded");*/ 
					    jQuery('#main_template_setting').closest('td').addClass("faded");
		   		    jQuery('#global_font_family').attr('disabled', true);jQuery('#global_font_family').closest('td').addClass("faded");
		   			jQuery('#media_template_max_width').attr('disabled', true);jQuery('#media_template_max_width').closest('td').addClass("faded");
					jQuery('#media_template_max_height').attr('disabled', true);jQuery('#media_template_max_height').closest('td').addClass("faded");
					jQuery('#text_template_max_width').attr('disabled', true);jQuery('#text_template_max_width').closest('td').addClass("faded");
					jQuery('#text_template_max_height').attr('disabled', true);jQuery('#text_template_max_height').closest('td').addClass("faded");
					jQuery('#membership_menu_image').attr('disabled', true);jQuery('#membership_menu_image').closest('td').addClass("faded");
					jQuery('#membership_title_color').attr('disabled', true);jQuery('#membership_title_color').closest('td').addClass("faded");
					jQuery('#membership_menu_image_border_width').attr('disabled', true);jQuery('#membership_menu_image_border_width').closest('td').addClass("faded");
					jQuery('#membership_menu_image_border_style').attr('disabled', true);jQuery('#membership_menu_image_border_style').closest('td').addClass("faded");
					jQuery('#membership_menu_image_border_color').attr('disabled', true);jQuery('#membership_menu_image_border_color').closest('td').addClass("faded");
					jQuery('#membership_menu_item_link_color').attr('disabled', true);jQuery('#membership_menu_item_link_color').closest('td').addClass("faded");
					jQuery('#membership_menu_item_link_hover_color').attr('disabled', true);jQuery('#membership_menu_item_link_hover_color').closest('td').addClass("faded");
					jQuery('#membership_menu_item_link_visited_color').attr('disabled', true);jQuery('#membership_menu_item_link_visited_color').closest('td').addClass("faded");
					jQuery('#membership_menuitemtiltle_font_size').attr('disabled', true);jQuery('#membership_menuitemtiltle_font_size').closest('td').addClass("faded");
					jQuery('#membership_menu_itemnumber_font_size').attr('disabled', true);jQuery('#membership_menu_itemnumber_font_size').closest('td').addClass("faded");
					
					jQuery('#membership_menu_bottom_padding').attr('disabled', true);jQuery('#membership_menu_bottom_padding').closest('td').addClass("faded");
					
					jQuery('#membership_menu_bottom_padding_overview').attr('disabled', true);jQuery('#membership_menu_bottom_padding_overview').closest('td').addClass("faded");
					jQuery('#membership_menu_itemlength_font_size').attr('disabled', true);jQuery('#membership_menu_itemlength_font_size').closest('td').addClass("faded");
					jQuery('#membership_menu_itemtitle_font_family').attr('disabled', true);jQuery('#membership_menu_itemtitle_font_family').closest('td').addClass("faded");
					jQuery('#download_link_color').attr('disabled', true);jQuery('#download_link_color').closest('td').addClass("faded");  
                	jQuery('#oapmp_infobox_border').attr('disabled', true);jQuery('#infobox_border').closest('td').addClass("faded");
					jQuery('#infobox_border_color').attr('disabled', true);jQuery('#infobox_border_color').closest('td').addClass("faded");
					jQuery('#infobox_title_font_family').attr('disabled', true);jQuery('#infobox_title_font_family').closest('td').addClass("faded");
					jQuery('#infobox_title_font_size').attr('disabled', true);jQuery('#infobox_title_font_size').closest('td').addClass("faded");
					jQuery('#infobox_titles_color').attr('disabled', true);jQuery('#infobox_titles_color').closest('td').addClass("faded");
					jQuery('#post_title_font_family').attr('disabled', true);jQuery('#post_title_font_family').closest('td').addClass("faded");
					jQuery('#post_title_font_size').attr('disabled', true);jQuery('#post_title_font_size').closest('td').addClass("faded");
					jQuery('#post_titles_color').attr('disabled', true);jQuery('#post_titles_color').closest('td').addClass("faded");
					jQuery('#membership_content_links_color').attr('disabled', true);jQuery('#membership_content_links_color').closest('td').addClass("faded");
					jQuery('.modcoder_excolor_clrbox').closest('input:text').attr('disabled',true);
					
			   }
				if(jQuery("#global_styling_option").val()=="Use the OAP Template Defaults"){
			    	 /* jQuery('#global_color').attr('disabled', true);jQuery('#global_color').parent().parent('p').addClass("faded"); */
					 jQuery('#main_template_setting').closest('td').addClass("faded"); 
			    	jQuery('#global_font_family').attr('disabled', true);jQuery('#global_font_family').closest('td').addClass("faded"); 
			    	jQuery('#media_template_max_width').attr('disabled', true);jQuery('#media_template_max_width').closest('td').addClass("faded");
					jQuery('#media_template_max_height').attr('disabled', true);jQuery('#media_template_max_height').closest('td').addClass("faded");
					jQuery('#text_template_max_width').attr('disabled', true);jQuery('#text_template_max_width').closest('td').addClass("faded");
					jQuery('#text_template_max_height').attr('disabled', true);jQuery('#text_template_max_height').closest('td').addClass("faded");
					jQuery('#membership_menu_image').attr('disabled', true);jQuery('#membership_menu_image').closest('td').addClass("faded");
					jQuery('#membership_title_color').attr('disabled', true);jQuery('#membership_title_color').closest('td').addClass("faded");
					jQuery('#membership_menu_image_border_width').attr('disabled', true);jQuery('#membership_menu_image_border_width').closest('td').addClass("faded");
					jQuery('#membership_menu_image_border_style').attr('disabled', true);jQuery('#membership_menu_image_border_style').closest('td').addClass("faded");
					jQuery('#membership_menu_image_border_color').attr('disabled', true);jQuery('#membership_menu_image_border_color').closest('td').addClass("faded");
					jQuery('#membership_menu_item_link_color').attr('disabled', true);jQuery('#membership_menu_item_link_color').closest('td').addClass("faded");
					jQuery('#membership_menu_item_link_hover_color').attr('disabled', true);jQuery('#membership_menu_item_link_hover_color').closest('td').addClass("faded");
					jQuery('#membership_menu_item_link_visited_color').attr('disabled', true);jQuery('#membership_menu_item_link_visited_color').closest('td').addClass("faded");
					jQuery('#membership_menuitemtiltle_font_size').attr('disabled', true);jQuery('#membership_menuitemtiltle_font_size').closest('td').addClass("faded");
					jQuery('#membership_menu_itemnumber_font_size').attr('disabled', true);jQuery('#membership_menu_itemnumber_font_size').closest('td').addClass("faded");
					jQuery('#membership_menu_bottom_padding').attr('disabled', true);jQuery('#membership_menu_bottom_padding').closest('td').addClass("faded");
					
					jQuery('#membership_menu_bottom_padding_overview').attr('disabled', true);jQuery('#membership_menu_bottom_padding_overview').closest('td').addClass("faded");
					
					jQuery('#membership_menu_itemlength_font_size').attr('disabled', true);jQuery('#membership_menu_itemlength_font_size').closest('td').addClass("faded");
					jQuery('#membership_menu_itemtitle_font_family').attr('disabled', true);jQuery('#membership_menu_itemtitle_font_family').closest('td').addClass("faded");
					jQuery('#download_link_color').attr('disabled', true);jQuery('#download_link_color').closest('td').addClass("faded");
                	jQuery('#infobox_border').attr('disabled', true);jQuery('#infobox_border').closest('td').addClass("faded");
        			jQuery('#infobox_border_color').attr('disabled', true);jQuery('#infobox_border_color').closest('td').addClass("faded");
					jQuery('#infobox_title_font_family').attr('disabled', true);jQuery('#infobox_title_font_family').closest('td').addClass("faded");
					jQuery('#infobox_title_font_size').attr('disabled', true);jQuery('#infobox_title_font_size').closest('td').addClass("faded");
					jQuery('#infobox_titles_color').attr('disabled', true);jQuery('#infobox_titles_color').closest('td').addClass("faded");
					jQuery('#post_title_font_family').attr('disabled', true);jQuery('#post_title_font_family').closest('td').addClass("faded");
					jQuery('#post_title_font_size').attr('disabled', true);jQuery('#post_title_font_size').closest('td').addClass("faded");
					jQuery('#post_titles_color').attr('disabled', true);jQuery('#post_titles_color').closest('td').addClass("faded");
					jQuery('#membership_content_links_color').attr('disabled', true);jQuery('#membership_content_links_color').closest('td').addClass("faded");
					jQuery('.modcoder_excolor_clrbox').closest('input:text').attr('disabled',true);
					
				}
				if(jQuery("#global_styling_option").val()=="I want to customize the style below"){
				   jQuery('#main_template_setting').closest('td').removeClass("faded"); jQuery('#global_font_family').removeAttr('disabled');jQuery('#global_font_family').closest('td').removeClass("faded");
			   		jQuery('#global_color').removeAttr('disabled');jQuery('#global_color').closest('td').removeClass("faded");
					jQuery('#media_template_max_width').removeAttr('disabled');jQuery('#media_template_max_width').closest('td').removeClass("faded");
					jQuery('#media_template_max_height').removeAttr('disabled');jQuery('#media_template_max_height').closest('td').removeClass("faded");
					jQuery('#text_template_max_width').removeAttr('disabled');jQuery('#text_template_max_width').closest('td').removeClass("faded");
					jQuery('#text_template_max_height').removeAttr('disabled');jQuery('#text_template_max_height').closest('td').removeClass("faded");
					jQuery('#overview_font_size').removeAttr('disabled');jQuery('#overview_font_size').closest('td').removeClass("faded");
					jQuery('#overview_font_family').removeAttr('disabled');jQuery('#overview_font_family').closest('td').removeClass("faded");
					jQuery('#overview_title_color').removeAttr('disabled');jQuery('#overview_title_color').closest('td').removeClass("faded");
					jQuery('#overview_textarea').removeAttr('disabled');jQuery('#overview_textarea').closest('td').removeClass("faded");
					jQuery('#membership_title_color').removeAttr('disabled');jQuery('#membership_title_color').closest('td').removeClass("faded");
					jQuery('#membership_content_length').removeAttr('disabled');jQuery('#membership_content_length').closest('td').removeClass("faded");
					jQuery('#membership_menu_image').removeAttr('disabled');jQuery('#membership_menu_image').closest('td').removeClass("faded");
					jQuery('#membership_menu_image_border_width').removeAttr('disabled');jQuery('#membership_menu_image_border_width').closest('td').removeClass("faded");
					jQuery('#membership_menu_image_border_style').removeAttr('disabled');jQuery('#membership_menu_image_border_style').closest('td').removeClass("faded");
					jQuery('#membership_menu_image_border_color').removeAttr('disabled');jQuery('#membership_menu_image_border_color').closest('td').removeClass("faded");
					jQuery('#membership_menu_item_link_color').removeAttr('disabled');jQuery('#membership_menu_item_link_color').closest('td').removeClass("faded");
					jQuery('#membership_menu_item_link_hover_color').removeAttr('disabled');jQuery('#membership_menu_item_link_hover_color').closest('td').removeClass("faded");
					jQuery('#membership_menu_item_link_visited_color').removeAttr('disabled');jQuery('#membership_menu_item_link_visited_color').closest('td').removeClass("faded");
					jQuery('#load_setting').removeAttr('disabled');jQuery('#load_setting').closest('td').removeClass("faded");
					jQuery('#socials_facebook_share').removeAttr('disabled');jQuery('#socials_facebook_share').closest('td').removeClass("faded");
					jQuery('#socials_facebook_like').removeAttr('disabled');jQuery('#socials_facebook_like').closest('td').removeClass("faded");
					jQuery('#socials_twitter').removeAttr('disabled');jQuery('#socials_twitter').closest('td').removeClass("faded");
					jQuery('#socials_google_plus').removeAttr('disabled');jQuery('#socials_google_plus').closest('td').removeClass("faded");
					jQuery('#post_template').removeAttr('disabled');jQuery('#post_template').closest('td').removeClass("faded");
					jQuery('#post_video_or_image_position').removeAttr('disabled');jQuery('#post_video_or_image_position').closest('td').removeClass("faded");
					//jQuery('#oapmp_all_links_color').removeAttr('disabled');
					jQuery('#oapmp_all_links_color').closest('td').removeClass("faded");
					jQuery('#post_content_menu_position').removeAttr('disabled');
					jQuery('#post_content_menu_position').closest('td').removeClass("faded");
					jQuery('#membership_menuitemtiltle_font_size').removeAttr('disabled');jQuery('#membership_menuitemtiltle_font_size').closest('td').removeClass("faded");
					jQuery('#membership_menu_itemnumber_font_size').removeAttr('disabled');jQuery('#membership_menu_itemnumber_font_size').closest('td').removeClass("faded");
					
					jQuery('#membership_menu_bottom_padding').removeAttr('disabled');jQuery('#membership_menu_bottom_padding').closest('td').removeClass("faded");
					
					jQuery('#membership_menu_bottom_padding_overview').removeAttr('disabled');jQuery('#membership_menu_bottom_padding_overview').closest('td').removeClass("faded");
					jQuery('#membership_menu_itemlength_font_size').removeAttr('disabled');jQuery('#membership_menu_itemlength_font_size').closest('td').removeClass("faded");
					jQuery('#membership_menu_itemtitle_font_family').removeAttr('disabled');jQuery('#membership_menu_itemtitle_font_family').closest('td').removeClass("faded");
					jQuery('#download_link_color').removeAttr('disabled');
					 jQuery('#download_link_color').closest('td').removeClass("faded");
					jQuery('#infobox_border').removeAttr('disabled'); 
					jQuery('#infobox_border').closest('td').removeClass("faded");
					jQuery('#infobox_border_color').removeAttr('disabled'); 
					jQuery('#infobox_border_color').closest('td').removeClass("faded");
					jQuery('#infobox_title_font_family').removeAttr('disabled'); 
					jQuery('#infobox_title_font_family').closest('td').removeClass("faded");
					jQuery('#infobox_title_font_size').removeAttr('disabled'); 
					jQuery('#infobox_title_font_size').closest('td').removeClass("faded");
					jQuery('#infobox_titles_color').removeAttr('disabled'); 
					jQuery('#infobox_titles_color').closest('td').removeClass("faded");
					jQuery('#post_title_font_family').removeAttr('disabled'); 
					jQuery('#post_title_font_family').closest('td').removeClass("faded");
					jQuery('#post_title_font_size').removeAttr('disabled'); 
					jQuery('#post_title_font_size').closest('td').removeClass("faded");
					jQuery('#post_titles_color').removeAttr('disabled'); 
					jQuery('#post_titles_color').closest('td').removeClass("faded");
					jQuery('#oapmp_all_link_color').removeAttr('disabled'); jQuery('#oapmp_all_link_color').closest('td').removeClass("faded");
					jQuery('#membership_content_links_color').removeAttr('disabled'); jQuery('#membership_content_links_color').closest('td').removeClass("faded");
					
					jQuery('.modcoder_excolor_clrbox').closest('input:text').removeAttr('disabled');
				  }  
              });
        })
        .trigger('change');
       jQuery("form :input:disabled[disabled='true']").css("color", "#000");
       jQuery("form :input:parent[p]").css("opacity", "0.3");   
});
</script>
<script>
/** Checkbox Enable/Disable ***/
jQuery(document).ready(function() {

	jQuery('#override_success').click(function() {
		jQuery("#oap_form_post").append("<input type='hidden' name='override_button' value='OVER-RIDE' />");
	  	jQuery('#oap_form_post').submit();
	});

	jQuery('#override_close').click(function() {
		jQuery.fancybox.close();
	});

	jQuery('#sample_data_override_success').click(function() {
		jQuery("#oap_form_post").append("<input type='hidden' name='Install_sample' value='Install Sample Data?' />");
  		jQuery('#oap_form_post').submit();
  	});

  	jQuery('#oap_form_post input[type="checkbox"]').each (function() {
  		var ele = jQuery(this).parent().parent().find('input,select,textarea');
  		if(jQuery(this).is('input:checkbox:checked')){
  			ele.css("opacity", "1");
  		}
  		else
		{
			ele.css("opacity", "0.6");
		}
	});

	 jQuery("#oap_form_post input:checkbox").change(function () {
		 var ele = jQuery(this).parent().parent().find('input,select,textarea');
		 if(jQuery(this).attr('checked') == "checked") {
			 ele.removeAttr('disabled');
			ele.css("opacity", "1");
			ele.css("color","#000");
		 }else {
			 ele.attr('disabled','disabled');
			ele.css("opacity", "0.6");
			 jQuery(this).removeAttr('disabled');
		 }
	 });

	 // default template
	 var full_shared = jQuery('#oapmp_fullvideo_shared_position').val();	
	if(full_shared == 'Full Width')
	{
		jQuery('#video_img_position').hide();
	}

	// Full Width or Shared changed
	jQuery('#oapmp_fullvideo_shared_position').change(function () {
		if(jQuery(this).val()  == 'Full Width'){
		jQuery('#video_img_position').hide();
		 }
		 if(jQuery(this).val()  == 'Shared'){
		jQuery('#video_img_position').show();
		 }
	 });

	 // start coading for check vodeo and text template
	jQuery("#oapmp_post_template_load").change(function () {
		if (jQuery(this).attr('checked') == "checked") {
			jQuery("#oapmp_fullvideo_shared_position_load").attr('checked',true); 
			jQuery("#oapmp_fullvideo_shared_position_load").css("opacity", "1");
			jQuery("#oapmp_post_video_or_image_position_load").attr('checked',true); 
			jQuery("#oapmp_post_video_or_image_position_load").css("opacity", "1");
			jQuery("#oapmp_fullvideo_shared_position").removeAttr('disabled'); 
			jQuery("#oapmp_fullvideo_shared_position").css("opacity", "1");
			jQuery("#oapmp_post_video_or_image_position").removeAttr('disabled'); 
			jQuery("#oapmp_post_video_or_image_position").css("opacity", "1");
		}
		else 
		{
			jQuery("#oapmp_fullvideo_shared_position_load").attr('checked',false); 
			jQuery("#oapmp_fullvideo_shared_position_load").css("opacity", "0.6");
			jQuery("#oapmp_post_video_or_image_position_load").attr('checked',false); 
			jQuery("#oapmp_post_video_or_image_position_load").css("opacity", "0.6");
			jQuery("#oapmp_fullvideo_shared_position").attr('disabled',true); 
			jQuery("#oapmp_fullvideo_shared_position").css("opacity", "0.6");
			jQuery("#oapmp_post_video_or_image_position").attr('disabled',true); 
			jQuery("#oapmp_post_video_or_image_position").css("opacity", "0.6");
		 }
	});

	 // start coading for Sidebar Nav - Enabled or Disabled
	jQuery("#oapmp_sidebar_enable_load").change(function () {
		if(jQuery(this).attr('checked') == "checked") {
			jQuery("#oapmp_lesson_menu_category_load").attr('checked',true); 
			jQuery("#oapmp_lesson_menu_category_load").css("opacity", "1");
			jQuery("#oapmp_post_content_menu_position_load").attr('checked',true); 
			jQuery("#oapmp_post_content_menu_position_load").css("opacity", "1");
			jQuery("#oapmp_lesson_menu_category").removeAttr('disabled'); 
			jQuery("#oapmp_lesson_menu_category").css("opacity", "1");
			jQuery("#oapmp_post_content_menu_position").removeAttr('disabled'); 
			jQuery("#oapmp_post_content_menu_position").css("opacity", "1");
		}
		else 
		{
			jQuery("#oapmp_lesson_menu_category_load").attr('checked',false); 
			jQuery("#oapmp_lesson_menu_category_load").css("opacity", "0.6");
			jQuery("#oapmp_post_content_menu_position_load").attr('checked',false); 
			jQuery("#oapmp_post_content_menu_position_load").css("opacity", "0.6");
			jQuery("#oapmp_lesson_menu_category").attr('disabled',true); 
			jQuery("#oapmp_lesson_menu_category").css("opacity", "0.6");
			jQuery("#oapmp_post_content_menu_position").attr('disabled',true); 
			jQuery("#oapmp_post_content_menu_position").css("opacity", "0.6");
		}
	});
});
	/** check template setting for min/max height **/
jQuery(document).ready(function(){
				
	// Default Text Template
	var tempalte = jQuery('#oapmp_post_template').val();	
	if(tempalte == 'Text Template')
	{
		jQuery('#video_img_position').hide();
		jQuery('#video_shared_position').hide();
		jQuery('#oapmp_text_template_custom_css').show();
		jQuery('#oapmp_media_template_custom_css').hide();
		jQuery('#oapmp_outer_text_template_custom_css').show();
		jQuery('#oapmp_outer_media_template_custom_css').hide();
		jQuery('#mleft').hide();
		jQuery('#mcenter').hide();
		jQuery('#mright').hide();
	}

	// Default Sidebar Disable
	var sidebar_pos = jQuery('#oapmp_sidebar_enable').val();
	if(sidebar_pos == 'Disabled')
	{
		jQuery('#sidebar_nav_cat').hide();
	    jQuery('#sidebar_nav_pos').hide();
	}

	// Outer Template Override Default
	var outer_template_override = jQuery('#oapmp_outer_template_override').val();
	if(outer_template_override == 'Disabled')
	{
		jQuery('#outer_temp_override_height').hide();
		jQuery('#outer_temp_override_width').hide();
		jQuery('#outer_template_background_color').hide();
	   	jQuery('#outer_template_custom_css').hide();
	}

	// Inner Template Override Default
	var template_override = jQuery('#oapmp_template_override').val();
	if(template_override == 'Disabled')
	{
		jQuery('#temp_override_height').hide();
	    	jQuery('#temp_override_width').hide();
		jQuery('#temp_background_color_load').hide();
	    	jQuery('#temp_custom_css').hide();
	}
	
	// Media or text template changed
	jQuery('#oapmp_post_template').change(function () {	
		if (jQuery(this).val()  == 'Media Template'){
			jQuery('#video_img_position').show();
			jQuery('#video_shared_position').show();
			jQuery("#oapmp_fullvideo_shared_position_load").attr('checked',true); 
			jQuery("#oapmp_fullvideo_shared_position_load").css("opacity", "1");
			jQuery("#oapmp_post_video_or_image_position_load").attr('checked',true); 
			jQuery("#oapmp_post_video_or_image_position_load").css("opacity", "1");
			jQuery("#oapmp_fullvideo_shared_position").removeAttr('disabled'); 
			jQuery("#oapmp_fullvideo_shared_position").css("opacity", "1");
			jQuery("#oapmp_post_video_or_image_position").removeAttr('disabled'); 
			jQuery("#oapmp_post_video_or_image_position").css("opacity", "1");
			jQuery('#oapmp_media_template_custom_css').show();
			jQuery('#oapmp_text_template_custom_css').hide();
			jQuery('#oapmp_outer_media_template_custom_css').show();
			jQuery('#oapmp_outer_text_template_custom_css').hide();
			jQuery('#mleft').show();
			jQuery('#mcenter').show();
			jQuery('#mright').show();
		}
		else
		{
			jQuery('#video_img_position').hide();
			jQuery('#video_shared_position').hide();
			jQuery('#oapmp_text_template_custom_css').show();
			jQuery('#oapmp_media_template_custom_css').hide();
			jQuery('#oapmp_outer_text_template_custom_css').show();
			jQuery('#oapmp_outer_media_template_custom_css').hide();
			jQuery('#mleft').hide();
			jQuery('#mcenter').hide();
			jQuery('#mright').hide();
		}
	});

	// sidebar posiotion changed
	jQuery('#oapmp_sidebar_enable').change(function () {
		if(jQuery(this).val()  == 'Enabled'){
			jQuery('#sidebar_nav_cat').show();
		    	jQuery('#sidebar_nav_pos').show();
		}
		else
		{
			jQuery('#sidebar_nav_cat').hide();
		    	jQuery('#sidebar_nav_pos').hide();
		}
   	});
   // Outer Template Override changed
	jQuery('#oapmp_outer_template_override').change(function () {	
		if(jQuery(this).val()  == 'Enabled'){
			jQuery('#outer_temp_override_height').show();
		    	jQuery('#outer_temp_override_width').show();
			jQuery('#outer_template_background_color').show();
		    	jQuery('#outer_template_custom_css').show();
		}
		else
		{
			jQuery('#outer_temp_override_height').hide();
			jQuery('#outer_temp_override_width').hide();
			jQuery('#outer_template_background_color').hide();
		    	jQuery('#outer_template_custom_css').hide();
		}
   	});

	// Inner Template Override changed
	jQuery('#oapmp_template_override').change(function () {
		if(jQuery(this).val()  == 'Enabled'){
			jQuery('#temp_override_height').show();
		    	jQuery('#temp_override_width').show();
			jQuery('#temp_background_color_load').show();
		   	jQuery('#temp_custom_css').show();
		}
		else
		{
			jQuery('#temp_override_height').hide();
		    	jQuery('#temp_override_width').hide();
			jQuery('#temp_background_color_load').hide();
		    	jQuery('#temp_custom_css').hide();
		}
   	});
});
</script>
    
<script type="text/javascript">
jQuery(document).ready(function() {
	/*
		Simple image gallery. Uses default settings
	*/
	//jQuery('.fancybox').fancybox();
	/*
		Different effects
	*/
	// Change title type, overlay opening speed and opacity
	// jQuery(".fancybox-effects-a").fancybox({
	// 	helpers: {
	// 		title : {
	// 			type : 'outside'
	// 		},
	// 		overlay : {
	// 			speedIn : 800,
	// 			opacity : 0.95
	// 		}
	// 	}
	// });
	// // Disable opening and closing animations, change title type
	// jQuery(".fancybox-effects-b").fancybox({
	// 	openEffect  : 'none',
	// 	closeEffect	: 'none',
	// 	helpers : {
	// 		title : {
	// 			type : 'over'
	// 		}
	// 	}
	// });
	// // Set custom style, close if clicked, change title type and overlay color
	// jQuery(".fancybox-effects-c").fancybox({
	// 	wrapCSS    : 'fancybox-custom',
	// 	closeClick : true,
	// 	helpers : {
	// 		title : {
	// 			type : 'inside'
	// 		},
	// 		overlay : {
	// 			css : {
	// 				'background-color' : '#eee'	
	// 			}
	// 		}
	// 	}
	// });
	// // Remove padding, set opening and closing animations, close if clicked and disable overlay
	// jQuery(".fancybox-effects-d").fancybox({
	// 	padding: 0,
	// 	openEffect : 'elastic',
	// 	openSpeed  : 150,
	// 	closeEffect : 'elastic',
	// 	closeSpeed  : 150,
	// 	closeClick : true,
	// 	helpers : {
	// 		overlay : null
	// 	}
	// });
	
	
	// /*
	// 	Open manually
	// */
	// jQuery("#fancybox-manual-a").click(function() {
	// 	jQuery.fancybox.open('1_b.jpg');
	// });
	// jQuery("#fancybox-manual-b").click(function() {
	// 	jQuery.fancybox.open({
	// 		href : 'iframe.html',
	// 		type : 'iframe',
	// 		padding : 5
	// 	});
	// });
	// jQuery("#fancybox-manual-c").click(function() {
	// 	jQuery.fancybox.open([
	// 		{
	// 			href : '1_b.jpg',
	// 			title : 'My title'
	// 		}, {
	// 			href : '2_b.jpg',
	// 			title : '2nd title'
	// 		}, {
	// 			href : '3_b.jpg'
	// 		}
	// 	], {
	// 		helpers : {
	// 			thumbs : {
	// 				width: 75,
	// 				height: 50	
	// 			}
	// 		}	
	// 	});
	// });
});
</script>       
<form name="oap_form" method="post" id="oap_form" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<div class="plugin_title">
		<?php 
			echo "<h2>" . __( 'Membership - Settings', 'oap_trdom' ) . "</h2>"; 
		?>
	</div>
	<div class="sample_data">
		<?php 
		if(isset($success)) 
		{ 
			echo '<h3 class="success" style="color: red;">' . $success . '</h3>';
		} 
		else 
		{ 
		?>
			<a href="#sample_data_overide_section" id="sample_inline" >
				<input type='button' name='Install_sample' value='<?php _e('Install Sample Data?'); ?>' id='installbutton' />
			</a> 
		<?php 
		} 
		?>
		<div class="ihm-overlay" style="display: none;">
			<div class="inlinehelpmenu">
				<a href="javascript://" class="close-this">Close</a>
				<div id="sample_data_overide_section">
					<h1 style="font-family:League!important;color:#000;background-image:none!important;margin-bottom:0px;font-size:36px;">Install Sample Data?</h1>
					<p>'You are about to install the sample data for this plugin. This includes 7 supporting pages, 3 sample lessons, and 1 sample membership program. All of these items are easy to delete or edit. The intention of these items are to help you get up and running faster than if you started from scratch. We highly recommend installing these if you are a beginner or have no idea where to start.'</br></br>Would you like to install the sample data?</p>
					<div id="sampleDataoverrideButtons">
						<a class="green buttonn" id="sample_data_override_success">Yes<span></span></a>
						<a class="red buttonn" id="sample_data_override_close">No<span></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php if(!is_callable("PilotPress::get_oap_items")) { ?>
<div class="updated" style="padding-top: 5px; padding-bottom: 5px;">Please enable <a href=''>PilotPress</a> to enable communication with OfficeAutoPilot.</div>
<?php } ?>
<table class="widefat">
	<tbody>
	
		<tr>
			<td colspan="2">
			<h3>General&nbsp; Settings</h3>
			</td>
			<td><input type='submit' name='Save' value='<?php _e('SAVE MY SETTINGS!'); ?>' id='submitbutton' /> <input	type="hidden" name="oap_hidden" value="Y"></td>
		</tr>
		<tr>
			<td>
			<p><div class="possession"><strong>Plugin Enabled / Disabled </strong>
            <span style="float:right;"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/pluginenableddisabled.html" id="jtipone" name="Plugin Enabled / Disabled">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
         <select name="enable_or_disable" id="enable_or_disable" style="width: 100%"<?
         	if (!class_exists("PilotPress")) {
			    //plugin is activated
			    echo "disabled=\"disabled\"";
			}
         ?>>
         		<option value="Disabled" <?php if(get_option("oapmp_enable_or_disable")=="Disabled" || !class_exists("Pilotpress")) echo ' selected="selected"';?>>Disabled</option>
				
         		<? if (class_exists("PilotPress")){ ?>
         			<option value="Enabled" <?php if(get_option("oapmp_enable_or_disable")=="Enabled") echo ' selected="selected"';?>>Enabled</option>
         		<? } ?>
				
			</select></p>
			</td>
			<td>
			<p><div class="possession"><strong>Global Styling Options </strong>
            <span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/globalstylingoptions.html" class="fancybox fancybox-iframe" id="jtiptwo" name="Global Styling Options">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
 <select name="global_styling_option" id="global_styling_option" style="width: 100%">
<option value="Use my current theme stylesheet"	<?php if(get_option("oapmp_global_styling_option")=="Use my current theme stylesheet") echo ' selected="selected"';?>>Use my current theme's style</option>
<!--option value="Use the OAP Template Defaults" <?php // if(get_option("oapmp_global_styling_option")=="Use the OAP Template Defaults") echo ' selected="selected"';?>>Use	the OAP Template Defaults</option -->
<option value="I want to customize the style below" <?php if(get_option("oapmp_global_styling_option")=="I want to customize the style below") echo ' selected="selected"';?>>I	want to customize the style - (Advanced)</option>
</select></p>
			</td>
		<td colspan="1">
            
            <p><div class="possession"><strong>Social Icons - </strong><i>(Requires the <a href="/wp-admin/plugin-install.php?tab=plugin-information&plugin=only-tweet-like-share-and-google-1&TB_iframe=true&width=640&height=769" class="fancybox fancybox-iframe" target="_blank">'Tweet, Like, Google +1 & Share Plugin'</a> )</i><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/socialicons.html" class="fancybox fancybox-iframe" id="jtiptwentythree" name="Socials Icons" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<?php if(function_exists('display_social4i')){ ?>
			<input name="socials_facebook_share" id="socials_facebook_share"
				type="checkbox" value="on"
				<?php if(get_option("oapmp_socials_facebook_share")=="on") echo ' checked="checked"';?> />
			&nbsp;Facebook Share &nbsp;&nbsp; <input name="socials_facebook_like"
				id="socials_facebook_like" type="checkbox" value="on"
				<?php if(get_option("oapmp_socials_facebook_like")=="on") echo ' checked="checked"';?> />
			&nbsp;Facebook Like &nbsp;&nbsp; <input name="socials_twitter"
				id="socials_twitter" type="checkbox" value="on"
				<?php if(get_option("oapmp_socials_twitter")=="on") echo ' checked="checked"';?> />
			&nbsp;Twitter Retweet &nbsp;&nbsp; &nbsp;&nbsp;<input name="socials_google_plus"
				id="socials_google_plus" type="checkbox" value="on"
				<?php if(get_option("oapmp_socials_google_plus")=="on") echo ' checked="checked"';?> />
			&nbsp;Google +1</p>  <?php } ?>
      		</td>
			</tr>
        <tr>
			
	</tr>
	<tr>
			<td colspan="3" style="padding:0px;" class="" id="main_template_setting">
			<table width="100%">
	
		<tr>
			<td colspan="3">
			<div class="seperator">&nbsp;</div>
			</td>
		</tr>
		<?php /*<!--tr>
			<td colspan="2">
			<h3> Layout of Media and Text Template</h3>
			</td>
			<td align="right"><input type='submit' name='Layout' value='<?php _e('SET THE LAYOUT!'); ?>' id='layoutbutton' /></td>
		</tr>
		<tr>
			<td>
			<p><div class="possession"><strong>Select Your Template Type  </strong>
            <span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/template_type.html" class="fancybox fancybox-iframe" id="jtipsix" name="Select Your - (Template Type) ">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
		<select name="template_set_media" id="template_set_media" onchange="check_temp(this.value);" style="width:100%;">
			<option value="Media">Media</option>
			<option value="Text">Text</option>
		</select>
		
	</p>
			</td>
			<td>
			<p><div class="possession"><strong>Max Width (in px) <i></i> </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/maxwidth.html" class="fancybox fancybox-iframe" id="jtipseven" name="Max width - (Media/Text Template) ">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<input type="text" name="media_template_max_width" id="media_template_max_width" value="<?php echo get_option("oapmp_media_template_max_width"); ?>" style="width: 100%;">
		<input type="text" name="text_template_max_width" id="text_template_max_width" value="<?php echo get_option("oapmp_text_template_max_width"); ?>" style="width: 100%;display:none;">
	
			</p>
			</td>
			<td>
			<p><div class="possession"><strong>Max Height (in px)  <i> </i></strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/maxheight.html" class="fancybox fancybox-iframe" id="jtipeight" name="Max height - (Media/Text Template) " style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
		<input type="text" name="media_template_max_height" id="media_template_max_height" value="<?php echo get_option("oapmp_media_template_max_height"); ?>" style="width: 100%;">
		<input type="text" name="text_template_max_height" id="text_template_max_height" value="<?php echo get_option("oapmp_text_template_max_height"); ?>" style="width: 100%;display:none;">
		
			</p>
			</td>
		</tr>
		
        <tr>
			<td colspan="3">
			<div class="seperator">&nbsp;</div>
			</td>
		</tr-->*/?>
		
		<tr>
			<td colspan="2">
			<h3>Menu Items (Sidebar & Overview) </h3>
			</td>
			<td align="right"> 
			<table>
        <tr class="_on_off_menuItemSetting">
              <td align="right" style="padding-right:0px!important;"> 
			 <div style="padding:10px 0 0 10px;background-color:#efefef;width:100px;height:37px;text-align:center;">
		  <?php
		  global $wpdb;
		  $global_count = $wpdb->get_var( "SELECT COUNT(option_name) FROM $wpdb->options where option_name='oapmp_on_off_menuitems'" );
			
           if($global_count > 0){ 
		$onoffmenuitems = get_option("oapmp_on_off_menuitems");
          if($onoffmenuitems=='ON'){ $checked='checked="checked"'; }else{ $checked='';}
		  }
		  ?>
		  <input type="checkbox" name="oapmp_on_off_menuitems" id="oapmp_on_off_menuitems" <?php echo $checked; ?> value="ON"/>
		  
		 
		  </div></td></tr></table>
			</td>
		</tr>
		<tr>
			<td colspan="3" id="global_menuitem_sidebar" style="width:100%;padding-left:0px;padding-right:0px;display:none;">
				<table width="100%">
		<tr>
			
			<td>
			<p><div class="possession"><strong>Menu Image </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuimage.html" class="fancybox fancybox-iframe" id="jtipfifteen" name="Menu Image">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="membership_menu_image" id="membership_menu_image" style="width: 100%">
<option value="Enabled" <?php if(get_option("oapmp_membership_menu_image")=="Enabled") echo ' selected="selected"';?>>Enabled</option>
<option value="Disabled" <?php if(get_option("oapmp_membership_menu_image")=="Disabled") echo ' selected="selected"';?>>Disabled</option>
			</select></p>
			</td>
			<td>
<p><div class="possession"><strong>Menu Image - Border Width </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuimageborderwidth.html" class="fancybox fancybox-iframe" id="jtipsixteen" name="Menu Image - Border Width">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="membership_menu_image_border_width" id="membership_menu_image_border_width" style="width: 100%">
<?php
				$value=  get_option("oapmp_membership_menu_image_border_width");
				for($i=1;$i<=100;$i++){ ?>
				<?php
				if($i==$value){$selected='selected=slelected';}else{$selected='';} ?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php } ?>
			</select></p>
			</td>
			<td><p><div class="possession"><strong>Menu Image - Border Style </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuimageborderstyle.html" class="fancybox fancybox-iframe" id="jtipseventeen" name="Menu Image - Border Style">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="membership_menu_image_border_style" id="membership_menu_image_border_style" style="width: 100%">
<option value="none"  <?php if(get_option("oapmp_membership_menu_image_border_style")=="none") echo ' selected="selected"';?>>none</option>
<option value="hidden" <?php if(get_option("oapmp_membership_menu_image_border_style")=="hidden") echo ' selected="selected"';?>>hidden</option>
<option value="dotted"  <?php if(get_option("oapmp_membership_menu_image_border_style")=="dotted") echo ' selected="selected"';?>>dotted</option>
<option value="dashed"  <?php if(get_option("oapmp_membership_menu_image_border_style")=="dashed") echo ' selected="selected"';?>>dashed</option>
<option value="solid" <?php if(get_option("oapmp_membership_menu_image_border_style")=="solid") echo ' selected="selected"';?>>solid</option>
<option value="double" <?php if(get_option("oapmp_membership_menu_image_border_style")=="double") echo ' selected="selected"';?>>double</option>
			</select></p>
			
			</td>
		</tr>
		<tr>
			<td>
<p><div class="possession"><strong>Menu Image - Border Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuimagebordercolor.html" class="fancybox fancybox-iframe" id="jtipeightteen" name="Menu Image - Border Color" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="membership_menu_image_border_color" id="membership_menu_image_border_color" value="<?php echo get_option('oapmp_membership_menu_image_border_color');?>" size="30" style="width:80%;  background-color:<?php echo get_option('oapmp_membership_menu_image_border_color');?>" />
			</p>
			</td>
			<td>
<p><div class="possession"><strong>Menu Item - Link Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuitemlinkcolor.html" class="fancybox fancybox-iframe" id="jtipnineteen" name="Menu Item - Link Color">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="membership_menu_item_link_color" id="membership_menu_item_link_color" value="<?php echo get_option('oapmp_membership_menu_item_link_color');?>" size="30" style="width:80%;  background-color:<?php echo get_option('oapmp_membership_menu_item_link_color');?>" />
			</p>
			</td>
			<td>
	<p><div class="possession"><strong>Menu Item - Link Hover Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuitemlinkhovercolor.html" class="fancybox fancybox-iframe" id="jtiptwenty" name="Menu Item - Link Hover Color">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="membership_menu_item_link_hover_color" id="membership_menu_item_link_hover_color" value="<?php echo get_option('oapmp_membership_menu_item_link_hover_color');?>" size="30" style="width:80%;  background-color:<?php echo get_option('oapmp_membership_menu_item_link_hover_color');?>" />
			</p>
		
			</td>
		</tr>
		<tr> 
			<td>
<p><div class="possession"><strong>Menu Item - Link Visited Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuitemlinkvisitedcolor.html" class="fancybox fancybox-iframe" id="jtiptwentyone" name="Menu Item - Link Visited Color" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="membership_menu_item_link_visited_color" id="membership_menu_item_link_visited_color" value="<?php echo get_option('oapmp_membership_menu_item_link_visited_color');?>" size="30" style="width:80%;  background-color:<?php echo get_option('oapmp_membership_menu_item_link_visited_color');?>" />
			</p>
			</td>
			<td>
<p><div class="possession"><strong>Menu Item Title - Font Size </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuitemtitlefontsize.html" class="fancybox fancybox-iframe" id="jtipmitfsize" name="Menu Item Title - Font Size">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="membership_menuitemtiltle_font_size" id="membership_menuitemtiltle_font_size" style="width: 100%">
<?php
				$value=  get_option("oapmp_membership_menuitemtiltle_font_size");
				if($value != "")
				{
				for($i=2;$i<=100;$i++){ ?>
				<?php
				if($i==$value){$selected='selected=slelected';}else{$selected='';} ?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php }
				}
				else
				{
				for($i=2;$i<=100;$i++){
				if($i==16){$selected='selected=slelected';}else{$selected='';} 
				?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php
				} }
				 ?>
		</select></p>
		
			</td>
			<td>
<p><div class="possession"><strong>Menu Item Text - Font Size </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuitemtextarea2fontsize.html" class="fancybox fancybox-iframe" id="jtipmitlfsize" name="Menu Item Length - Font Size" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="membership_menu_itemlength_font_size" id="membership_menu_itemlength_font_size" style="width: 100%">
<?php
				$value=  get_option("oapmp_membership_menu_itemlength_font_size");
				if($value != "")
				{
				for($i=2;$i<=100;$i++){ ?>
				<?php
				if($i==$value){$selected='selected=slelected';}else{$selected='';} ?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php }
				}
				else
				{
				for($i=2;$i<=100;$i++){
				if($i==14){$selected='selected=slelected';}else{$selected='';} 
				?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php
				} }
				 ?>
			</select></p>		
			
			</td>
		</tr>
				
		<tr>
			<td>
			<p><div class="possession"><strong>Menu Item Title - Font Family </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuitemtitlefontfamily.html" class="fancybox fancybox-iframe" id="jtipmitffamily" name="Menu Item Title - Font Family">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="membership_menu_itemtitle_font_family" id="membership_menu_itemtitle_font_family" style="width: 100%">
<option value="Arial" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="Arial") echo ' selected="selected"';?>>Arial</option>
<option value="bookman old style" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="bookman old style") echo ' selected="selected"';?>>Bookman Old Style</option>
<option value="century gothic" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="century gothic") echo ' selected="selected"';?>>Century Gothic</option>
<option value="Geneva"<?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="Geneva") echo ' selected="selected"';?>>Geneva</option>
<option value="Georgia" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="Georgia") echo ' selected="selected"';?>>Georgia</option>
<option value="Helvetica" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="Helvetica") echo ' selected="selected"';?>>Helvetica</option>
<option value="Inherit"<?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="Inherit") echo ' selected="selected"';?>>Inherit</option>	
<option value="League"<?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="League") echo ' selected="selected"';?>>League</option>
<option value="lucida" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="lucida") echo ' selected="selected"';?>>Lucida</option>
<option value="new york" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="new york") echo ' selected="selected"';?>>New York</option>
<option value="palatino" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="palatino") echo ' selected="selected"';?>>Palatino</option>
<option value="Tahoma" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="Tahoma") echo ' selected="selected"';?>>Tahoma</option>
<option value="times" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="times") echo ' selected="selected"';?>>Times</option>
<option value="times new roman" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="times new roman") echo ' selected="selected"';?>>Times New Roman</option>
<option value="Trebuchet" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="Trebuchet") echo ' selected="selected"';?>>Trebuchet</option>
<option value="Verdana" <?php if(get_option("oapmp_membership_menu_itemtitle_font_family")=="Verdana") echo ' selected="selected"';?>>Verdana</option>
</select></p>
			
			</td>
			<td>
			
				<p><div class="possession"><strong>Sidebar Menu Item - Bottom Spacing </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/menuitembottomspacing.html" class="fancybox fancybox-iframe" id="jtipbottomspacing" name="Sidebar Menu Item - Bottom Spacing">
				<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
	     
				</a></span></div>
				<select name="membership_menu_bottom_padding" id="membership_menu_bottom_padding" style="width: 100%">
				
				<?php
				$value=  get_option("oapmp_membership_menu_bottom_padding");
				if($value != "")
				{
				for($i=0;$i<=100;$i++){ ?>
				<?php
				if($i==$value){$selected='selected=slelected';}else{$selected='';} ?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php }
				}
				else
				{
				for($i=0;$i<=100;$i++){
				if($i==14){$selected='selected=slelected';}else{$selected='';} 
				?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				
				<?php
				} }
				 ?>
				 
				</p>
				
				</select>
			
			</td>
			<td>
			
			<p><div class="possession"><strong>Overview Item - Bottom Spacing </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/overviewitembottomspacing.html" class="fancybox fancybox-iframe" id="jtipoverviewbottomspacing" name="Overview Item - Bottom Spacing">
				<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
	     
				</a></span></div>
				<select name="membership_menu_bottom_padding_overview" id="membership_menu_bottom_padding_overview" style="width: 100%">
				
				<?php
				$value=  get_option("oapmp_membership_menu_bottom_padding_overview");
				if($value != "")
				{
				for($i=0;$i<=100;$i++){ ?>
				<?php
				if($i==$value){$selected='selected=slelected';}else{$selected='';} ?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php }
				}
				else
				{
				for($i=0;$i<=100;$i++){
				if($i==14){$selected='selected=slelected';}else{$selected='';} 
				?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				
				<?php
				} }
				 ?>
				 
				</p>
				
				</select>
			</td>
		</tr>
		</table>
		</td></tr>
	
		<tr>
			<td colspan="3">
			<div class="seperator">&nbsp;</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<h3>Info Box Text & Downloads</h3>
			</td>
			<td align="right"> 
			<table>
        <tr class="_on_off_infoboxDownload">
              <td align="right" style="padding-right:0px!important;"> 
			 <div style="padding:10px 0 0 10px;background-color:#efefef;width:100px;height:37px;text-align:center;">
		  <?php
		  
		  $global_infobox_count = $wpdb->get_var( "SELECT COUNT(option_name) FROM $wpdb->options where option_name='oapmp_on_off_infobox_download'" );
			
           if($global_infobox_count > 0){ 
			$onoff_infobox_downlaod = get_option("oapmp_on_off_infobox_download");
          if($onoff_infobox_downlaod=='ON'){ $checked='checked="checked"'; }else{ $checked='';}
		  }
		  ?>
		  <input type="checkbox" name="oapmp_on_off_infobox_download" id="oapmp_on_off_infobox_download" <?php echo $checked; ?> value="ON"/>
		  
		 
		  </div></td></tr></table>
			</td>
		</tr>
		<tr>
			<td colspan="3" id="global_infobox_download" style="width:100%;padding-left:0px;padding-right:0px;display:none;">
				<table width="100%">
		
				<tr>
			<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Download Text - Link Color </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/downloadtextlinkcolor.html" class="fancybox fancybox-iframe" id="jtiptwentyseven" name="Download Text Link Color">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="download_link_color" id="download_link_color" value="<?php echo get_option("oapmp_download_link_color");?>" size="30" style="width:80%; background-color:<?php echo get_option('oapmp_download_link_color');?>" <?php if(get_option("oapmp_download_link_color_load")=="") echo 'disabled="disabled"' ?>/>
			</p>
			</td>
			<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Info Box - Border </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/infoboxborder.html" class="fancybox fancybox-iframe" id="jtiptwentyeight" name="Info Box Border">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
  <select name="infobox_border" id="infobox_border" style="width: 100%" <?php if(get_option("oapmp_infobox_border_load")=="") echo 'disabled="disabled"' ?>> 
 <option value="Enabled" <?php if(get_option("oapmp_infobox_border")=="Enabled") echo ' selected="selected"';?>>Enabled</option>
 <option value="Disabled" <?php if(get_option("oapmp_infobox_border")=="Disabled") echo ' selected="selected"';?>>Disabled</option>
			</select></p>
			</td>
			<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Info Box - Border Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/infoboxbordercolor.html" class="fancybox fancybox-iframe" id="jtiptwentynine" name="Infobox Border Color" style="float:none;" >
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="infobox_border_color" id="infobox_border_color" value="<?php echo get_option('oapmp_infobox_border_color');?>" size="30" style="width:80%; background-color:<?php echo get_option('oapmp_infobox_border_color');?>" <?php if(get_option("oapmp_infobox_border_color_load")=="") echo 'disabled="disabled"' ?>/>
			</p>
			</td>
		</tr>
		<tr>
			<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Info Box Titles - Font Family </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/infoboxtitlesfontfamily.html" class="fancybox fancybox-iframe" id="jtipthirty" name="Infobox Titles Font - Family">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
	<select name="infobox_title_font_family" id="infobox_title_font_family" style="width: 100%" <?php if(get_option("oapmp_infobox_title_font_family_load")=="") echo 'disabled="disabled"' ?>>
<option value="Arial" <?php if(get_option("oapmp_infobox_title_font_family")=="Arial") echo ' selected="selected"';?>>Arial</option>
<option value="bookman old style" <?php if(get_option("oapmp_infobox_title_font_family")=="bookman old style") echo ' selected="selected"';?>>Bookman Old Style</option>
<option value="century gothic" <?php if(get_option("oapmp_infobox_title_font_family")=="century gothic") echo ' selected="selected"';?>>Century Gothic</option>
<option value="Geneva"<?php if(get_option("oapmp_infobox_title_font_family")=="Geneva") echo ' selected="selected"';?>>Geneva</option>
<option value="Georgia" <?php if(get_option("oapmp_infobox_title_font_family")=="Georgia") echo ' selected="selected"';?>>Georgia</option>
<option value="Helvetica" <?php if(get_option("oapmp_infobox_title_font_family")=="Helvetica") echo ' selected="selected"';?>>Helvetica</option>
<option value="Inherit"<?php if(get_option("oapmp_infobox_title_font_family")=="Inherit") echo ' selected="selected"';?>>Inherit</option>	
<option value="League"<?php if(get_option("oapmp_infobox_title_font_family")=="League") echo ' selected="selected"';?>>League</option>
<option value="lucida" <?php if(get_option("oapmp_infobox_title_font_family")=="lucida") echo ' selected="selected"';?>>Lucida</option>
<option value="new york" <?php if(get_option("oapmp_infobox_title_font_family")=="new york") echo ' selected="selected"';?>>New York</option>
<option value="palatino" <?php if(get_option("oapmp_infobox_title_font_family")=="palatino") echo ' selected="selected"';?>>Palatino</option>
<option value="Tahoma" <?php if(get_option("oapmp_infobox_title_font_family")=="Tahoma") echo ' selected="selected"';?>>Tahoma</option>
<option value="times" <?php if(get_option("oapmp_infobox_title_font_family")=="times") echo ' selected="selected"';?>>Times</option>
<option value="times new roman" <?php if(get_option("oapmp_infobox_title_font_family")=="times new roman") echo ' selected="selected"';?>>Times New Roman</option>
<option value="Trebuchet" <?php if(get_option("oapmp_infobox_title_font_family")=="Trebuchet") echo ' selected="selected"';?>>Trebuchet</option>
<option value="Verdana" <?php if(get_option("oapmp_infobox_title_font_family")=="Verdana") echo ' selected="selected"';?>>Verdana</option>
</select></p>
			</td>
			<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Info Box Titles - Font Size </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/infoboxtitlesfontsize.html" class="fancybox fancybox-iframe" id="jtipthirtyone" name="Infobox Titles Font - Size">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<select name="infobox_title_font_size" id="infobox_title_font_size" style="width: 100%" <?php if(get_option("oapmp_infobox_title_font_size_load")=="") echo 'disabled="disabled"' ?>>
				<?php
				$value=  get_option("oapmp_infobox_title_font_size");
				if($value != "")
				{
				for($i=2;$i<=100;$i++){ ?>
				<?php
				if($i==$value){$selected='selected=slelected';}else{$selected='';} ?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php }
				}
				else
				{
				for($i=2;$i<=100;$i++){
				if($i==14){$selected='selected=slelected';}else{$selected='';} 
				?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php
				} }
				 ?>
			</select></p>
			</td>
			<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Info Box Titles - Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/infoboxtitlescolor.html" class="fancybox fancybox-iframe" id="jtipthirtytwo" name="Infobox Titles - Color" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="infobox_titles_color" id="infobox_titles_color" value="<?php echo get_option('oapmp_infobox_titles_color');?>" size="30" style="width:80%; background-color:<?php echo get_option('oapmp_infobox_titles_color');?>" <?php if(get_option("oapmp_infobox_titles_color_load")=="") echo 'disabled="disabled"' ?>/>
			</p>
			</td>
		</tr>
	</table>
		</td>
		</tr>
		
		<tr>
			<td colspan="3">
			<div class="seperator">&nbsp;</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<h3> Main Content </h3>
			</td>
			<td align="right"> 
			<table>
        <tr class="_on_off_mainContent">
              <td align="right" style="padding-right:0px!important;"> 
			 <div style="padding:10px 0 0 10px;background-color:#efefef;width:100px;height:37px;text-align:center;">
		  <?php
		  $global_maincontent_count = $wpdb->get_var( "SELECT COUNT(option_name) FROM $wpdb->options where option_name='oapmp_on_off_main_content'" );
			
           if($global_maincontent_count > 0){ 
		$onoffmaincontent = get_option("oapmp_on_off_main_content");
          if($onoffmaincontent=='ON'){ $checked='checked="checked"'; }else{ $checked='';}
		  }
		  ?>
		  <input type="checkbox" name="oapmp_on_off_main_content" id="oapmp_on_off_main_content" <?php echo $checked; ?> value="ON"/>
		  
		 
		  </div></td></tr></table>
			</td>
		</tr>
		<tr>
			<td colspan="3" id="global_main_content" style="width:100%;padding-left:0px;padding-right:0px;display:none;">
			<table width="100%">
				<tr>
					<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Lesson Title & Number - Font Family </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/posttitlesfontfamily.html" class="fancybox fancybox-iframe" id="jtipthirtythree" name="Post Titles Font - Family">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
	  <select name="post_title_font_family" id="post_title_font_family" style="width: 100%" <?php if(get_option("oapmp_post_title_font_family_load")=="") echo 'disabled="disabled"' ?>>
	    <option value="Arial" <?php if(get_option("oapmp_post_title_font_family")=="Arial") echo ' selected="selected"';?>>Arial</option>
<option value="bookman old style" <?php if(get_option("oapmp_post_title_font_family")=="bookman old style") echo ' selected="selected"';?>>Bookman Old Style</option>
<option value="century gothic" <?php if(get_option("oapmp_post_title_font_family")=="century gothic") echo ' selected="selected"';?>>Century Gothic</option>
<option value="Geneva"<?php if(get_option("oapmp_post_title_font_family")=="Geneva") echo ' selected="selected"';?>>Geneva</option>
<option value="Georgia" <?php if(get_option("oapmp_post_title_font_family")=="Georgia") echo ' selected="selected"';?>>Georgia</option>
<option value="Helvetica" <?php if(get_option("oapmp_post_title_font_family")=="Helvetica") echo ' selected="selected"';?>>Helvetica</option>
<option value="Inherit"<?php if(get_option("oapmp_post_title_font_family")=="Inherit") echo ' selected="selected"';?>>Inherit</option>	
<option value="League"<?php if(get_option("oapmp_post_title_font_family")=="League") echo ' selected="selected"';?>>League</option>
<option value="lucida" <?php if(get_option("oapmp_post_title_font_family")=="lucida") echo ' selected="selected"';?>>Lucida</option>
<option value="new york" <?php if(get_option("oapmp_post_title_font_family")=="new york") echo ' selected="selected"';?>>New York</option>
<option value="palatino" <?php if(get_option("oapmp_post_title_font_family")=="palatino") echo ' selected="selected"';?>>Palatino</option>
<option value="Tahoma" <?php if(get_option("oapmp_post_title_font_family")=="Tahoma") echo ' selected="selected"';?>>Tahoma</option>
<option value="times" <?php if(get_option("oapmp_post_title_font_family")=="times") echo ' selected="selected"';?>>Times</option>
<option value="times new roman" <?php if(get_option("oapmp_post_title_font_family")=="times new roman") echo ' selected="selected"';?>>Times New Roman</option>
<option value="Trebuchet" <?php if(get_option("oapmp_post_title_font_family")=="Trebuchet") echo ' selected="selected"';?>>Trebuchet</option>
<option value="Verdana" <?php if(get_option("oapmp_post_title_font_family")=="Verdana") echo ' selected="selected"';?>>Verdana</option>
  </select></p>
			</td>
			<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Post Titles - Font Size </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/posttitlesfontsize.html" class="fancybox fancybox-iframe" id="jtipthirtyfour" name="Post Titles Font - Size">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<select name="post_title_font_size" id="post_title_font_size" style="width: 100%" <?php if(get_option("oapmp_post_title_font_size_load")=="") echo 'disabled="disabled"' ?>>
				<?php
				$value=  get_option("oapmp_post_title_font_size");
				if($value != "")
				{
				for($i=2;$i<=100;$i++){ ?>
				<?php
				if($i==$value){$selected='selected=slelected';}else{$selected='';} ?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php }
				}
				else
				{
				for($i=2;$i<=100;$i++){
				if($i==20){$selected='selected=slelected';}else{$selected='';} 
				?>
				<option value="<?php echo $i ?>" <?php echo $selected ;?>><?php echo $i;?>px</option>
				<?php
				} }
				 ?>
		 </select></p>
			</td>
			<td>
			<p><div class="possession">
					<strong title="Check to Enable!">Post Titles - Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/posttitlescolor.html" class="fancybox fancybox-iframe" id="jtipthirtyfive" name="Post Titles - Color" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="post_titles_color" id="post_titles_color" value="<?php echo get_option('oapmp_post_titles_color');?>" size="30" style="width:80%; background-color:<?php echo get_option('oapmp_post_titles_color');?>" <?php if(get_option("oapmp_post_titles_color_load")=="") echo 'disabled="disabled"' ?>/>
			</p>
			</td></tr>
			<tr>
		<td>
			<p><div class="possession">
			<strong title="Check to Enable!">Membership Content Links - Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/membershipcontentlinkscolor.html" class="fancybox fancybox-iframe" id="jtipthirtysix" name="Membership Content Links - Color">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="membership_content_links_color" id="membership_content_links_color" value="<?php echo get_option('oapmp_membership_content_links_color');?>" size="30" style="width:80%; background-color:<?php echo get_option('oapmp_membership_content_links_color');?>" <?php if(get_option("oapmp_membership_content_links_color_load")=="") echo 'disabled="disabled"' ?> />
			</p>
			</td>
		</tr>
		<tr>
			<td colspan="3">
			<div class="">&nbsp;</div>
			</td>
		</tr>
		</table>
			</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
	  	</form>
		
	 <form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" name="oap_form_post" id="oap_form_post">
		<table class="widefat">
		<tr>
			<td colspan="2">
			<h3>Global&nbsp; Posts&nbsp; Settings</h3>
			</td>
			<td>
				<a href="#overide_section" id="inline" ><input type="button" value="SAVE MY SETTINGS!" name="override_button" id="override_button"/> </a>

				<div class="ihm-overlay" style="display: none;">
					<div class="inlinehelpmenu"><a href="javascript://" class="close-this">Close</a>
						<div id="overide_section">
							<h1 style="font-family:League!important;color:#000;background-image:none!important;margin-bottom:0px;font-size:36px;">Global Post Settings Override!</h1>
							<p>The changes about to be made will affect ALL content items.<br> Are you sure you want to apply these settings to ALL of your membership post items?</p>
							<div id="overrideButtons">
								<a class="button blue" id="override_success">Yes</a>
								<a class="button gray" id="override_close">No</a>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<?php /*<tr>
			<td>
			<p><div class="possession">
			<input type="checkbox" name="oapmp_global_load" id="oapmp_global_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_global_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Load the same post setting as:</strong>
			<span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/loadthesamepostsettingas.html" class="fancybox fancybox-iframe" id="jtiptwentytwo" name="Load the same post setting as">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<select name="oapmp_load_setting" id="oapmp_load_setting" <?php if(get_option("oapmp_post_template_load")=="on") echo 'disabled="disabled"' ?>style="width:100%;float:left;">
			 <option value="">Select Lesson</option>
        <?php
            $oaploadsettings= get_option("oapmp_load_setting");
			query_posts('post_type=oaplesson&order=asc');
		if ( have_posts() ) while ( have_posts() ) : the_post();
			$title= get_the_title();
			if($title==$oaploadsettings){$selected='selected'; }else{$selected='';} ?>
        			<option value="<?php the_title();?>" <?php echo $selected ; ?>>
        			<?php the_title();?>
        			</option>
        <?php  endwhile;  wp_reset_query(); // end of the loop. ?>
			</select></p>
			<!--<input type="submit" name="submitload" value="Load" id="submitload" >-->
			</td>
			
			<td>&nbsp;</td>
		</tr>*/?>
		<tr>
			<td>
			<p><div class="possession"><input type="checkbox" name="oapmp_post_template_load" id="oapmp_post_template_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_post_template_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Video or Text Template </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/mediaortexttemplate.html" class="fancybox fancybox-iframe" id="jtiptwentyfour" name="Media or Text Template">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="oapmp_post_template" id="oapmp_post_template" style="width: 100%" <?php if(get_option("oapmp_post_template_load")=="") echo 'disabled="disabled"' ?>>
<option value="Media Template" <?php if(get_option("oapmp_post_template")=="Media Template") echo ' selected="selected"';?>>Video Template</option>
<option	value="Text Template" <?php if(get_option("oapmp_post_template")=="Text Template") echo ' selected="selected"';?>>Text Template</option>
			</select></p>
			</td>
			<td id="video_shared_position"><p><div class="possession"><input type="checkbox" name="oapmp_fullvideo_shared_position_load" id="oapmp_fullvideo_shared_position_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_fullvideo_shared_position_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Full Width Video or Shared </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/mediaortexttemplate.html" class="fancybox fancybox-iframe" id="jtiptwentyfour" name="Media or Text Template">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<select id="oapmp_fullvideo_shared_position" name="oapmp_fullvideo_shared_position" class="selection" style="width:100%;" <?php if(get_option("oapmp_post_template_load")=="") echo 'disabled="disabled"' ?>/>
       <option value="Full Width" <?php if(get_option("oapmp_fullvideo_shared_position")=="Full Width") echo ' selected="selected"';?>>Full Width</option>
        <option value="Shared" <?php if(get_option("oapmp_fullvideo_shared_position")=="Shared") echo ' selected="selected"';?>>Shared</option>
		<option value="720 by 420" <?php if(get_option("oapmp_fullvideo_shared_position")=="720 by 420") echo ' selected="selected"';?>>720 by 420</option>
        </select>
        </select> </p>
			</td>
			<td id="video_img_position">
			<p><div class="possession"><input type="checkbox" name="oapmp_post_video_or_image_position_load" id="oapmp_post_video_or_image_position_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_post_video_or_image_position_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Video Position </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/mediaitemposition.html" class="fancybox fancybox-iframe" id="jtiptwentyfive" name="Video or Image Position">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="oapmp_post_video_or_image_position" id="oapmp_post_video_or_image_position" style="width: 100%" <?php if(get_option("oapmp_post_video_or_image_position_load")=="") echo 'disabled="disabled"' ?>>
<option value="Left" <?php if(get_option("oapmp_post_video_or_image_position")=="Left") echo ' selected="selected"';?>>Left</option>
<option value="Right" <?php if(get_option("oapmp_post_video_or_image_position")=="Right") echo ' selected="selected"';?>>Right</option>
			</select></p>
			</td>
		</tr>
		<tr>
			<td>
			<p><div class="possession"><input type="checkbox" name="oapmp_lesson_title_setting_load" id="oapmp_lesson_title_setting_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_lesson_title_setting_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Title On / Off</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/sidebarposition.html" class="fancybox fancybox-iframe" id="jtipsidebarpos" name="Enabled/Disabled Sidebar Nav">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select id="oapmp_lesson_title_setting"
				name="oapmp_lesson_title_setting" class="selection" style="width:100%;" <?php if(get_option("oapmp_lesson_title_setting")=="") echo 'disabled="disabled"' ?>/>
        
        <option value="Enabled"
				<?php if(get_option("oapmp_lesson_title_setting")=='Enabled'){echo 'selected';}?>>Enabled</option>
        <option value="Disabled"
				<?php if(get_option("oapmp_lesson_title_setting")=='Disabled'){echo 'selected';}?>>Disabled</option>
        </select>
</p>
			</td>
			<td id="lesson_number_setting">
			<p><div class="possession"><input type="checkbox" name="oapmp_lesson_number_setting_load" id="oapmp_lesson_number_setting_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_lesson_number_setting_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Lesson Number On / Off</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/lessonmenucategory.html" class="fancybox fancybox-iframe" id="jtipcategory" name="Select program for sidebar menu">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
 <select id="oapmp_lesson_number_setting" name="oapmp_lesson_number_setting" class="selection" style="width:100%;"/>
       <option value="Enabled"
				<?php if(get_option("oapmp_lesson_number_setting")=='Enabled'){echo 'selected';}?>>Enabled</option>
        <option value="Disabled"
				<?php if(get_option("oapmp_lesson_number_setting")=='Disabled'){echo 'selected';}?>>Disabled</option>
        </select>
</p>
			</td>
			<td id="title_lessonnumber_setting">
		<p><div class="possession"><input type="checkbox" name="oapmp_title_lessonnumber_setting_load" id="oapmp_title_lessonnumber_setting_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_title_lessonnumber_setting_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Title & Lesson Number - Position</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/membershipcontentmenuposition.html" class="fancybox fancybox-iframe" id="jtiptwentysix" name="Membership Content Menu Positon" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
      
      <select id="oapmp_title_lessonnumber_setting" name="oapmp_title_lessonnumber_setting" class="selection" style="width:100%;"/>
				
			<option value="TLeft" <?php if(get_option("oapmp_title_lessonnumber_setting")=='TLeft'){echo 'selected';}?>>Top Left</option>
				
			<option value="TCenter" <?php if(get_option("oapmp_title_lessonnumber_setting")=='TCenter'){echo 'selected';}?>>Top Center</option>
				
			<option value="TRight" <?php if(get_option("oapmp_title_lessonnumber_setting")=='TRight'){echo 'selected';}?>>Top Right</option>
		 
			<option value="MLeft" id="mleft" <?php if(get_option("oapmp_title_lessonnumber_setting")=='MLeft'){echo 'selected';}?>>Main Left</option>
			
			<option value="MCenter"	id="mcenter" <?php if(get_option("oapmp_title_lessonnumber_setting")=='MCenter'){echo 'selected';}?>>Main Center</option>
			
			<option value="MRight" id="mright" <?php if(get_option("oapmp_title_lessonnumber_setting")=='MRight'){echo 'selected';}?>>Main Right</option>
			
        </select></p>
			
			</td>
		</tr>
		<tr>
			<td>
			<p><div class="possession"><input type="checkbox" name="oapmp_sidebar_enable_load" id="oapmp_sidebar_enable_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_sidebar_enable_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Sidebar Nav - Enabled/Disabled</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/sidebarposition.html" class="fancybox fancybox-iframe" id="jtipsidebarpos" name="Enabled/Disabled Sidebar Nav">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select id="oapmp_sidebar_enable"
				name="oapmp_sidebar_enable" class="selection" style="width:100%;" <?php if(get_option("oapmp_sidebar_enable")=="") echo 'disabled="disabled"' ?>/>
        
        <option value="Enabled"
				<?php if(get_option("oapmp_sidebar_enable")=='Enabled'){echo 'selected';}?>>Enabled</option>
        <option value="Disabled"
				<?php if(get_option("oapmp_sidebar_enable")=='Disabled'){echo 'selected';}?>>Disabled</option>
        </select>
</p>
			</td>
			<td id="sidebar_nav_cat">
			<p><div class="possession"><input type="checkbox" name="oapmp_lesson_menu_category_load" id="oapmp_lesson_menu_category_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_lesson_menu_category_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Sidebar Nav - Program </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/lessonmenucategory.html" class="fancybox fancybox-iframe" id="jtipcategory" name="Select program for sidebar menu">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
  <?php $cats_array = get_categories(array('taxonomy' => 'mprogram','hide_empty' => 0)); $oaplessonmenucategory=get_option("oapmp_lesson_menu_category"); ?>
        <select id="oapmp_lesson_menu_category" name="oapmp_lesson_menu_category" style="width:100%;" <?php if(get_option("oapmp_lesson_menu_category")=="") echo 'disabled="disabled"' ?>>
          <?php foreach ( $cats_array as $category ) { ?>
          <option value="<?php echo $category->cat_ID; ?>" <?php if($category->cat_ID == $oaplessonmenucategory){ echo "selected=selected"; } ?>><?php echo $category->cat_name; ?></option>
          <?php } ?>
        </select>
</p>
			</td>
			<td id="sidebar_nav_pos">
		<p><div class="possession"><input type="checkbox" name="oapmp_post_content_menu_position_load" id="oapmp_post_content_menu_position_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_post_content_menu_position_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Sidebar Nav - Position</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/membershipcontentmenuposition.html" class="fancybox fancybox-iframe" id="jtiptwentysix" name="Membership Content Menu Positon" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select name="oapmp_post_content_menu_position" id="oapmp_post_content_menu_position" style="width: 100%" <?php if(get_option("oapmp_post_content_menu_position")=="") echo 'disabled="disabled"' ?>>
<option value="Left" <?php if(get_option("oapmp_post_content_menu_position")=="Left") echo ' selected="selected"';?>>Left</option>
<option value="Right" <?php if(get_option("oapmp_post_content_menu_position")=="Right") echo ' selected="selected"';?>>Right</option>
			</select></p>
			
			</td>
		</tr>
		
		<tr class="bottomoptions">
			<td>
			<p><div class="possession">
<input type="checkbox" name="oapmp_global_color_load" id="oapmp_global_color_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_global_color_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;			
			<strong>Global Color</strong> - <i>(Borders, Titles,etc.)</i> 
            <span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/globalcolor.html" class="fancybox fancybox-iframe" id="jtipthirtyseven" name="Global Color">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
            <input type="text" name="oapmp_global_color" id="oapmp_global_color" size="30" style="width:80%; background-color:<?php echo get_option('oapmp_global_color');?>" value="<?php echo get_option('oapmp_global_color');?>" <?php if(get_option("oapmp_global_color")=="") echo 'disabled="disabled"'; ?>  />
			</p>
			</td>
			<td>
		<p><div class="possession">
     <input type="checkbox" name="oapmp_global_font_family_load" id="oapmp_global_font_family_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_global_font_family_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;       
            <strong>Global - Font Family </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/globalfontfamily.html" class="fancybox fancybox-iframe" id="jtigfamily" name="Global - Font Family">
	<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
  </a></span></div>
<select name="oapmp_global_font_family" id="oapmp_global_font_family" style="width: 100%" <?php if(get_option("oapmp_global_font_family")=="") echo 'disabled="disabled"' ?>>
<option value="Arial" <?php if(get_option("oapmp_global_font_family")=="Arial") echo ' selected="selected"';?>>Arial</option>
<option value="bookman old style" <?php if(get_option("oapmp_global_font_family")=="bookman old style") echo ' selected="selected"';?>>Bookman Old Style</option>
<option value="century gothic" <?php if(get_option("oapmp_global_font_family")=="century gothic") echo ' selected="selected"';?>>Century Gothic</option>
<option value="Geneva"<?php if(get_option("oapmp_global_font_family")=="Geneva") echo ' selected="selected"';?>>Geneva</option>
<option value="Georgia" <?php if(get_option("oapmp_global_font_family")=="Georgia") echo ' selected="selected"';?>>Georgia</option>
<option value="Helvetica" <?php if(get_option("oapmp_global_font_family")=="Helvetica") echo ' selected="selected"';?>>Helvetica</option>
<option value="Inherit"<?php if(get_option("oapmp_global_font_family")=="Inherit") echo ' selected="selected"';?>>Inherit</option>
<option value="League"<?php if(get_option("oapmp_global_font_family")=="League") echo ' selected="selected"';?>>League</option>
<option value="lucida" <?php if(get_option("oapmp_global_font_family")=="lucida") echo ' selected="selected"';?>>Lucida</option>
<option value="new york" <?php if(get_option("oapmp_global_font_family")=="new york") echo ' selected="selected"';?>>New York</option>
<option value="palatino" <?php if(get_option("oapmp_global_font_family")=="palatino") echo ' selected="selected"';?>>Palatino</option>
<option value="Tahoma" <?php if(get_option("oapmp_global_font_family")=="Tahoma") echo ' selected="selected"';?>>Tahoma</option>
<option value="times" <?php if(get_option("oapmp_global_font_family")=="times") echo ' selected="selected"';?>>Times</option>
<option value="times new roman" <?php if(get_option("oapmp_global_font_family")=="times new roman") echo ' selected="selected"';?>>Times New Roman</option>
<option value="Trebuchet" <?php if(get_option("oapmp_global_font_family")=="Trebuchet") echo ' selected="selected"';?>>Trebuchet</option>
<option value="Verdana" <?php if(get_option("oapmp_global_font_family")=="Verdana") echo ' selected="selected"';?>>Verdana</option>
</select></p>            
</td>
			<td>
			<p><div class="possession">
			<input type="checkbox" name="oapmp_all_links_color_load" id="oapmp_all_links_color_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_all_links_color_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">All Links - Color</strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/alllinkscolor.html" class="fancybox fancybox-iframe" id="jtipthirtysix2" name="All Links - Color" style="float:none;">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
			<input type="text" name="oapmp_all_links_color" id="oapmp_all_links_color" value="<?php echo get_option('oapmp_all_links_color');?>" size="30" style="width:80%; background-color:<?php echo get_option('oapmp_all_links_color');?>" <?php if(get_option("oapmp_all_links_color_load")!="on") echo 'disabled'; ?>/>
			</p>
			</td>
		</tr>
		<tr><td colspan="3">
		</td></tr>
		<tr>
			<td colspan="2"><h3>Advanced&nbsp; Settings </h3></td>
			<td align="right"><table>
        <tr class="_on_off_advanceSetting">
              <td align="right" style="padding-right:0px!important;">
		  <div style="padding:10px 0 0 10px;background-color:#efefef;width:100px;height:37px;text-align:center;">
		  <?php
		  global $wpdb;
		  $global_count = $wpdb->get_var( "SELECT COUNT(option_name) FROM $wpdb->options where option_name='oapmp_on_off_advanceSetting'" );
			//var_dump($global_count);
           if($global_count > 0){ 
		$onoffsetting = get_option("oapmp_on_off_advanceSetting");
          if($onoffsetting=='ON'){ $checked='checked="checked"'; }else{ $checked='';}
		  }
		  ?>
		  <input type="checkbox" name="oapmp_on_off_advanceSetting" id="oapmp_on_off_advanceSetting" <?php echo $checked; ?> value="ON"/>
		  
		 
		  </div></td>
        </tr>
      </table></td>
		</tr>
		<tr>
			<td colspan="3" id="global_template_override" style="width:100%;padding-left:0px;padding-right:0px;display:none;">
				<table width="100%">
		<tr>
			<td colspan="3" style="padding-right:0px!important;"><span class="sectionSubTitle">Background (Body)</span></td>
		</tr>
		<tr>
			<td>
			<p><div class="possession"><input type="checkbox" name="oapmp_outer_template_override_load" id="oapmp_outer_template_override_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_outer_template_override_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Background (Body) - 
      Override </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/templateoverride.html" class="fancybox fancybox-iframe" id="jtiptempoverride" name="Template Override Section">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
	<select id="oapmp_outer_template_override" name="oapmp_outer_template_override" class="selection" style="width:100%;" <?php if(get_option("oapmp_outer_template_override")=="") echo 'disabled="disabled"' ?>/>
        
        <option value="Enabled"
				<?php if(get_option("oapmp_outer_template_override")=='Enabled'){echo 'selected';}?>>Enabled</option>
        <option value="Disabled"
				<?php if(get_option("oapmp_outer_template_override")=='Disabled'){echo 'selected';}?>>Disabled</option>
        </select>
</p>
			</td>
			<td id="outer_temp_override_height">
	<p><div class="possession"><input type="checkbox" name="oapmp_outer_template_override_height_load" id="oapmp_outer_template_override_height_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_outer_template_override_height_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
		<strong title="Check to Enable!">Fixed Height </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/fixed_height.html" class="fancybox fancybox-iframe" id="jtipfixedheight" name="Fixed Width - Media or Text Template">
		<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
		</a></span></div>
      <input type="text" name="oapmp_outer_template_max_height" id="oapmp_outer_template_max_height" value="<?php echo get_option("oapmp_outer_template_max_height");?>" placeholder="Start with 1000px and then increase or decrease." class="width_input reset"<?php if(get_option("oapmp_outer_template_override")=="") echo 'disabled="disabled"' ?>>
</p>
		</td>
			<td id="outer_temp_override_width">
				<p><div class="possession"><input type="checkbox" name="oapmp_outer_template_override_width_load" id="oapmp_outer_template_override_width_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_outer_template_override_width_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Fixed Width </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/fixedwidth.html" class="fancybox fancybox-iframe" id="jtipfixedwidth" name="Fixed Width - Media or Text Template">
	<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
	</a></span></div>
  <?php if(get_option("oapmp_outer_template_override") == 'Enabled' && get_option("oapmp_outer_template_max_width") == '')
				{
							$outer_max_width=get_option('template_width');
				}
				else if(get_option("oapmp_outer_template_override_width_load") == 'on' && get_option("oapmp_outer_template_override") == 'Enabled' && get_option("oapmp_outer_template_max_width") != '')
				{
							$outer_max_width=get_option("oapmp_outer_template_max_width");
				}
				else
				{
				$outer_max_width="";
				}
				?>
      <input type="text" name="oapmp_outer_template_max_width" id="oapmp_outer_template_max_width" value="<?php echo $outer_max_width;?>" placeholder="Start with 960px and then increase or decrease." class="width_input reset" <?php if(get_option("oapmp_outer_template_override")=="") echo 'disabled="disabled"'; ?>>
</p>
			</td>
		</tr>
		<tr>
			<td id="outer_template_background_color">
			<p><div class="possession"><input type="checkbox" name="oapmp_outer_template_background_color_load" id="oapmp_outer_template_background_color_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_outer_template_background_color_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Background Color </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/templateoverride.html" class="fancybox fancybox-iframe" id="jtiptempoverride" name="Template Background Color">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
	  <input type="text" name="oapmp_outer_template_background_color" id="oapmp_outer_template_background_color" value="<?php echo get_option("oapmp_outer_template_background_color");?>" style="background-color:<?php echo get_option("oapmp_outer_template_background_color");?>;" <?php if(get_option("oapmp_outer_template_background_color")=="") echo 'disabled="disabled"'; ?>>
</p>
			</td>
			<td id="outer_template_custom_css">
	<p><div class="possession"><input type="checkbox" name="oapmp_outer_template_custom_css_load" id="oapmp_outer_template_custom_css_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_outer_template_custom_css_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
		<strong title="Check to Enable!">Add your own CSS </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/fixed_height.html" class="fancybox fancybox-iframe" id="jtipfixedheight" name="Custom Css - Media or Text Template">
		<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
		</a></span></div>
      <textarea rows="1" name="oapmp_outer_media_template_custom_css" id="oapmp_outer_media_template_custom_css" value="" class="width_input reset"<?php if(get_option("oapmp_outer_media_template_custom_css")=="") echo 'disabled="disabled"' ?>><?php echo get_option("oapmp_outer_media_template_custom_css");?></textarea>
	  <textarea rows="1" name="oapmp_outer_text_template_custom_css" id="oapmp_outer_text_template_custom_css" class="width_input reset"<?php if(get_option("oapmp_outer_text_template_custom_css")=="") echo 'disabled="disabled"' ?> style="display:none;"><?php echo get_option("oapmp_outer_text_template_custom_css");?></textarea>
</p>
		</td>
			<td id="">&nbsp;
				
			</td>
		</tr>
		
		
		<tr>
			<td colspan="3"><span class="sectionSubTitle">Content Area</span></td>
		</tr>
		<tr>
			<td>
			<p><div class="possession"><input type="checkbox" name="oapmp_template_override_load" id="oapmp_template_override_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_template_override_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Content Area - 
      Override </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/templateoverride.html" class="fancybox fancybox-iframe" id="jtiptempoverride" name="Template Override Section">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
<select id="oapmp_template_override"
				name="oapmp_template_override" class="selection" style="width:100%;" <?php if(get_option("oapmp_template_override")=="") echo 'disabled="disabled"' ?>/>
        
        <option value="Enabled"
				<?php if(get_option("oapmp_template_override")=='Enabled'){echo 'selected';}?>>Enabled</option>
        <option value="Disabled"
				<?php if(get_option("oapmp_template_override")=='Disabled'){echo 'selected';}?>>Disabled</option>
        </select>
</p>
			</td>
			<td id="temp_override_height">
	<p><div class="possession"><input type="checkbox" name="oapmp_template_override_height_load" id="oapmp_template_override_height_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_template_override_height_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
		<strong title="Check to Enable!">Fixed Height </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/fixed_height.html" class="fancybox fancybox-iframe" id="jtipfixedheight" name="Fixed Width - Media or Text Template">
		<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
		</a></span></div>
      <input type="text" name="oapmp_template_max_height" id="oapmp_template_max_height" value="<?php echo get_option("oapmp_template_max_height");?>" placeholder="Start with 1000px and then increase or decrease." class="width_input reset"<?php if(get_option("oapmp_template_override")=="") echo 'disabled="disabled"' ?>>
</p>
		</td>
			<td id="temp_override_width">
				<p><div class="possession"><input type="checkbox" name="oapmp_template_override_width_load" id="oapmp_template_override_width_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_template_override_width_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Fixed Width </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/fixedwidth.html" class="fancybox fancybox-iframe" id="jtipfixedwidth" name="Fixed Width - Media or Text Template">
	<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
	</a></span></div>
  <?php if(get_option("oapmp_template_override") == 'Enabled' && get_option("oapmp_template_max_width") == '')
				{
							$max_width=get_option('template_width');
				}
				else if(get_option("oapmp_template_override_width_load") == 'on' && get_option("oapmp_template_override") == 'Enabled' && get_option("oapmp_template_max_width") != '')
				{
							$max_width=get_option("oapmp_template_max_width");
				}
				else
				{
				$max_width="";
				}
				?>
      <input type="text" name="oapmp_template_max_width" id="oapmp_template_max_width" value="<?php echo $max_width;?>" placeholder="Start with 960px and then increase or decrease." class="width_input reset" <?php if(get_option("oapmp_template_override")=="") echo 'disabled="disabled"'; ?>>
</p>
			</td>
		</tr>
		
		
		
		<tr>
			<td id="temp_background_color_load">
			<p><div class="possession"><input type="checkbox" name="oapmp_template_background_color_load" id="oapmp_template_background_color_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_template_background_color_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
			<strong title="Check to Enable!">Background Color </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/templateoverride.html" class="fancybox fancybox-iframe" id="jtiptempoverride" name="Template Background Color">
	           <img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
      </a></span></div>
	  <input type="text" name="oapmp_template_background_color" id="oapmp_template_background_color" value="<?php echo get_option("oapmp_template_background_color");?>" style="background-color:<?php echo get_option("oapmp_template_background_color");?>;" <?php if(get_option("oapmp_template_background_color")=="") echo 'disabled="disabled"'; ?>>
</p>
			</td>
			<td id="temp_custom_css">
	<p><div class="possession"><input type="checkbox" name="oapmp_template_custom_css_load" id="oapmp_template_custom_css_load" title="Check to Enable!" value="on" <?php if(get_option("oapmp_template_custom_css_load")=="on") echo ' checked="checked"';?> />&nbsp;&nbsp;
		<strong title="Check to Enable!">Add your own CSS </strong><span style="float:right;"><a href="http://officeautopilot.com/mp/helpfiles/fixed_height.html" class="fancybox fancybox-iframe" id="jtipfixedheight" name="Custom Css - Media or Text Template">
		<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/question.png" class="oaptooltip" style="float:right" /> 
		</a></span></div>
      <textarea rows="1" name="oapmp_media_template_custom_css" id="oapmp_media_template_custom_css" value="" class="width_input reset"<?php if(get_option("oapmp_media_template_custom_css")=="") echo 'disabled="disabled"' ?>><?php echo get_option("oapmp_media_template_custom_css");?></textarea>
	  <textarea rows="1" name="oapmp_text_template_custom_css" id="oapmp_text_template_custom_css" class="width_input reset"<?php if(get_option("oapmp_text_template_custom_css")=="") echo 'disabled="disabled"' ?> style="display:none;"><?php echo get_option("oapmp_text_template_custom_css");?></textarea>
</p>
		</td>
			<td id="">&nbsp;
				
			</td>
		</tr>
		</table>
			</td>
	</tr>
	</tbody>
</table>
</form>
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


    // Manages the sample data section
    jQuery('#sample_inline').click(function()
    {
        if ( jQuery(this).siblings('div.ihm-overlay').is(":visible") )
        {
            jQuery(this).siblings('.ihm-overlay').fadeOut(300);
        }
        else
        {
            jQuery(this).siblings('.ihm-overlay').fadeIn(300);
        }

        return false;
    });

    var $closebutton = jQuery('.sample_data .close-this');
    $closebutton.click(function()
    {
        jQuery(this).parent('.inlinehelpmenu').parent('.ihm-overlay').fadeOut(300);
    });

    jQuery('#sample_data_override_close').click(function()
    {
    	jQuery(this).parent('#sampleDataoverrideButtons').parent('#sample_data_overide_section').parent('.inlinehelpmenu').parent('.ihm-overlay').fadeOut(300);
    });
});
</script>