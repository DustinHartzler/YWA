<?php
global $wpdb;
global $post;
?>
<style>
@font-face {
font-family: "Bebas";
src: url("<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/fonts/BEBAS.ttf") /* TTF file for CSS3 browsers */
}
@font-face {
    font-family: 'League';
    src: url('../fonts/league_gothic-webfont.eot');
    src: url('../fonts/league_gothic-webfont.eot?#iefix') format('embedded-opentype'),
         url('../fonts/league_gothic-webfont.woff') format('woff'),
         url('../fonts/league_gothic-webfont.ttf') format('truetype'),
         url('../fonts/league_gothic-webfont.svg#LeagueGothicRegular') format('svg');
    font-weight: normal;
    font-style: normal;
}
H1,H2,H3,H4,H5,H6
{
font-family:<?php echo get_option("oapmp_global_font_family") ;?> !important;
color:<?php echo get_option("oapmp_global_color") ;?> !important;
}
<?php 
if((get_post_meta($post->ID,'_oap_sidebar_position',true)=='Disabled') && (get_option("oapmp_sidebar_enable_load")!="on") ){?>
 		  #oapsidebar{ display:none; !important; } 
		  .oap-post 
		  {
		  	width: 100%;
		  	box-sizing: border-box;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
		  }
 		 <?php } ?>
  <?php if((get_option("oapmp_sidebar_enable_load")=="on") && (get_option("oapmp_sidebar_enable")=='Disabled')){?>
		   #oapsidebar{ display:none; !important; } 
		  .oap-post 
		  {
		  	width: 100%;
		  	box-sizing: border-box;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
		  }
 		<?php } ?>
<?php
 if(get_option("oapmp_lesson_title_setting_load")=='on'){
 if(get_option("oapmp_lesson_title_setting")=='Disabled'){
 ?>
 .posttitle_title H1
{
display:none !important;
min-height:20px;
}
h2.lessontitle
{
display:none !important;
}
 <?php
 }
 }
 else
 {
 if((get_post_meta($post->ID,'_oap_lesson_title_setting',true)=='Disabled')){?>
.posttitle_title H1
{
display:none !important;
min-height:20px;
}
h2.lessontitle
{
display:none !important;
}
<?php } }
if(get_option("oapmp_lesson_number_setting_load")=='on'){
 if(get_option("oapmp_lesson_number_setting")=='Disabled'){
 ?>
h6.mpctitle
{
	display:none !important;
}
h4.lesson_number
{
display:none !important;
}
 <?php
 }
 }
 else
 {
if((get_post_meta($post->ID,'_oap_lesson_number_setting',true)=='Disabled')){ ?>
h6.mpctitle
{
	display:none !important;
}
h4.lesson_number
{
display:none !important;
}
<?php } } ?>	
DIV.post_title
{
width: 98% !important;
	
	<?php
	
	if(get_option("oapmp_title_lessonnumber_setting_load")=="on")
	{
	if(get_option("oapmp_title_lessonnumber_setting")=='TLeft')
	{
	
	?>
	padding: 10px;
	margin-top: 10px;
	text-align: left;
	<?php }
	else if(get_option("oapmp_title_lessonnumber_setting")=='MLeft')
	{ 
	?>
	text-align: left;
	<?php
	}
	else if(get_option("oapmp_title_lessonnumber_setting")=='TCenter')
	{
	?>
	padding: 10px;
	margin-top: 10px;
	text-align: center;
	<?php } 
	else if(get_option("oapmp_title_lessonnumber_setting")=='MCenter')
	{
	
	?>
	text-align: center;
	<?php
	}
	else if(get_option("oapmp_title_lessonnumber_setting")=='TRight')
	{
	?>
	padding: 10px;
	margin-top: 10px;
	text-align: right;
	<?php }
	else if(get_option("oapmp_title_lessonnumber_setting")=='MRight')
	{
	?>
	text-align: right;
	<?php }
	else { ?>
	text-align: center;
	<?php }
	
	}
	else
	{
	if(get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TLeft')
	{
	
	?>
	padding: 10px;
	margin-top: 10px;
	text-align: left;
	<?php }
	else if(get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='MLeft')
	{ 
	?>
	text-align: left;
	<?php
	}
	else if(get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TCenter')
	{
	?>
	padding: 10px;
	margin-top: 10px;
	text-align: center;
	<?php } 
	else if(get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='MCenter')
	{
	
	?>
	text-align: center;
	<?php
	}
	else if(get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='TRight')
	{
	?>
	padding: 10px;
	margin-top: 10px;
	text-align: right;
	<?php }
	else if(get_post_meta( $post->ID, '_oap_title_lessonnumber_setting', true )=='MRight')
	{
	?>
	text-align: right;
	<?php }
	else { ?>
	text-align: center;
	<?php } 
	}?>
	
}
.icon_pos
{
	float:left;width:35px;height:25px;padding-top:10px;
}
.s4fblike
{
max-width:60px;
}
@media \0screen {
.s4fblike
{
width:60px;
}
}
.s4fbshare
{
max-width:56px;
}
.s4twitter
{
max-width:80px;
}
@media \0screen {
.s4twitter
{
width:80px;
}
}
#headerbox .hright
{
<?php if(get_option('oapmp_post_template_load')=='on') { ?>
    <?php if(get_option('oapmp_fullvideo_shared_position')=='Full Width' && get_option('oapmp_fullvideo_shared_position_load')=='on'){?>
	width: 100% !important;
	height: 450px;
	float: left;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	margin: 0!important;
	padding: 1.25%;
    <?php }?>
    <?php if(get_option('oapmp_fullvideo_shared_position')=='720 by 420' && get_option('oapmp_fullvideo_shared_position_load')=='on'){?>
	width: 720px!important;	
	margin:auto !important;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
    <?php }?>
    <?php if(get_option('oapmp_fullvideo_shared_position')=='Shared' && get_option('oapmp_fullvideo_shared_position_load')=='on'){?>
	width: 60%;
	height: auto;
	float: left;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
    <?php }?>
<?php } else { ?>
    <?php if(get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='Full Width'){?>
	width: 100% !important;
	height: 450px;
	float: left;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	margin: 0!important;
	padding: 1.25%;
    <?php }?>
	    
    <?php if(get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='720 by 420'){?>
	width: 720px!important;	
	margin:auto !important;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
    <?php } else { ?>
	width: 60%;
	height: auto;
	float: left;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
    <?php } ?>
    
<?php } ?>
/*float: right !important;*/
}
#headerbox .hleft
{
<?php if(get_option('oapmp_post_template_load')=='on') { ?>
    <?php if(get_option('oapmp_fullvideo_shared_position')=='Full Width' && get_option('oapmp_fullvideo_shared_position_load')=='on'){?>
	display:none;
    <?php }?>
    <?php if(get_option('oapmp_fullvideo_shared_position')=='720 by 420' && get_option('oapmp_fullvideo_shared_position_load')=='on'){?>
	display:none;
    <?php }?>
    <?php if(get_option('oapmp_fullvideo_shared_position')=='Shared' && get_option('oapmp_fullvideo_shared_position_load')=='on'){?>
	width: 35%;
	float: left;
	margin: 0 1.25%;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
    <?php }?>
    
<?php } else { ?>
    <?php if(get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='Full Width'){?>
	display:none;
    <?php }?>
	    
    <?php if(get_post_meta( $post->ID, '_oap_fullvideo_shared_position', true )=='720 by 420'){?>
	display:none;
    <?php } else { ?>
	width: 35%;
	float: left;
	margin: 0 1.25%;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
    <?php } ?>
    
<?php } ?>
}

</style>
<!--[if IE]>
<style>
@font-face {
font-family: "Bebas";
src: url("<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/fonts/BEBAS.eot") /* EOT file for IE */
}
</style>
<![endif]-->
<!-- Stylesheet Used for Dyanmic css -->
<?php
$global_oaptemplate_override_load = get_option("oapmp_template_override_load");
$global_oaptemplate_override = get_option("oapmp_template_override");
$global_maxheight_load = get_option("oapmp_template_override_height_load");
$global_maxheight = get_option("oapmp_template_max_height");
$global_maxwidth_load = get_option("oapmp_template_override_width_load");
$global_maxwidth = get_option("oapmp_template_max_width");
$image_width=get_option('template_width');
$oaptemplate_override = get_post_meta( $post->ID, '_oap_template_override', true );
$maxheight= get_post_meta( $post->ID, '_oap_template_max_height', true );
$maxwidth = get_post_meta( $post->ID, '_oap_template_max_width', true );
$global_template_background_color_load = get_option("oapmp_template_background_color_load");
$global_template_background_color = get_option("oapmp_template_background_color");
$global_template_custom_css_load = get_option("oapmp_template_custom_css_load");
$global_media_template_custom_css = get_option("oapmp_media_template_custom_css");
$global_text_template_custom_css = get_option("oapmp_text_template_custom_css"); 
$page_background_color= get_post_meta( $post->ID, '_oap_page_background_color', true );
$media_template_custom_css = get_post_meta( $post->ID, '_oap_media_template_custom_css', true );
$text_template_custom_css = get_post_meta( $post->ID, '_oap_text_template_custom_css', true );
$onoff_advanced_setting = get_post_meta( $post->ID, '_on_off_advanced_setting', true );
$onoff_global_setting = get_option("oapmp_on_off_advanceSetting");
if($onoff_advanced_setting == 'ON' || $onoff_global_setting == 'ON')
{
if($oaptemplate_override == 'Enabled' || $global_oaptemplate_override != 'Disabled' || ($global_oaptemplate_override_load == 'on' && $global_oaptemplate_override == 'Enabled'))
{
	if($global_maxwidth_load == "on" && $global_oaptemplate_override_load == "on" && $global_oaptemplate_override == 'Enabled' && $onoff_global_setting == 'ON')
	{
	
	$imgwidth=((int)$image_width*60)/100;
		if($global_maxwidth != "")
		{
		
		$media_maxwidth = $global_maxwidth;
		}
		if(strripos($media_maxwidth,'px') >0)
		{
		$media_maxwidth=$media_maxwidth;
		}
		else
		{
		$media_maxwidth=$media_maxwidth."px";
		}
	}
	else 
	{	
	$imgwidth=((int)$image_width*60)/100;
		
		if($oaptemplate_override == 'Enabled' && $maxwidth != "")
		{
		$media_maxwidth = $maxwidth;
		}
		if(strripos($media_maxwidth,'px') >0)
		{
		$media_maxwidth=$media_maxwidth;
		}
		else
		{
		$media_maxwidth=$media_maxwidth."px";
		}
	}
	if($global_maxheight_load == "on" && $global_oaptemplate_override_load == "on" && $global_oaptemplate_override == 'Enabled' && $onoff_global_setting == 'ON')
	{
		if($global_maxheight != "")
		{
		$media_maxheight= $global_maxheight;
		}
		if(strripos($media_maxheight,'px') >0)
		{
		$media_maxheight=$media_maxheight;
		}
		else
		{
		$media_maxheight=$media_maxheight."px";
		}
		
	}
	else
	{
		if($oaptemplate_override == 'Enabled' && $maxheight != "")
		{
		$media_maxheight= $maxheight;
		}
		if(strripos($media_maxheight,'px') >0)
		{
		$media_maxheight=$media_maxheight;
		}
		else
		{
		$media_maxheight=$media_maxheight."px";
		}
	}
	
	if($global_template_background_color_load == "on" && $global_oaptemplate_override_load == "on" && $global_oaptemplate_override == 'Enabled' && $onoff_global_setting == 'ON')
	{
	
		$template_background_color = $global_template_background_color;
	}
	else 
	{	
		$template_background_color = $page_background_color;
	}
	if($global_template_custom_css_load == "on" && $global_oaptemplate_override_load == "on" && $global_oaptemplate_override == 'Enabled' && $onoff_global_setting == 'ON')
	{
	
		if(get_option("oapmp_post_template") == "Media Template" || get_post_meta( $post->ID, '_oap_media_text_template', true ) == "Media Template")
		{
		$template_custom_css = $global_media_template_custom_css;
		}
		if(get_option("oapmp_post_template") == "Text Template" || get_post_meta($post->ID, '_oap_media_text_template', true ) == "Text Template")
		{
		$template_custom_css = $global_text_template_custom_css;
		}
	}
	else 
	{	
		if(get_post_meta($post->ID, '_oap_media_text_template', true ) == "Media Template")
		{
		$template_custom_css = $media_template_custom_css;
		}
		if(get_post_meta($post->ID, '_oap_media_text_template', true ) == "Text Template")
		{
		$template_custom_css = $text_template_custom_css;
		}
	}
	
	
	
} }
else
{
$imgwidth=((int)$image_width*60)/100;
}
?>
<style>
#oap_content_media
{
<?php
if($onoff_advanced_setting == 'ON' || $onoff_global_setting == 'ON')
{
?>
height:<?php echo $media_maxheight; ?> !important;
background-color:<?php echo $template_background_color; ?> !important;
<?php echo $template_custom_css; ?>
<?php
}
else
	{
	$theme_namee = get_current_theme();
		?>
	margin: <?php if ($theme_namee != 'OptimizePress') { echo 'auto'; } else { echo '0px auto 20px'; } ?> !important;
	padding: 20px 0 30px 0px;
	overflow:hidden;
	background-color:<?php if ($theme_namee == 'OptimizePress') { echo 'white'; } ?> !important;
	
	<?php
	}
	 ?>
	
}
#oap_content_media-inn
{
}
#oap-content-text
{
<?php
if($onoff_advanced_setting == 'ON' || $onoff_global_setting == 'ON')
{
?>
height:<?php echo $media_maxheight; ?> !important;
width:<?php echo $media_maxwidth; ?> !important;
background-color:<?php echo $template_background_color; ?> !important;
<?php echo $template_custom_css; ?>
<?php
}
	else {
	 ?>
	 margin:<?php if ($theme_namee != 'OptimizePress') { echo 'auto'; } else { echo '0px auto 20px'; } ?> !important;
	width: auto;
	padding: 0px 0 30px 0px;
	overflow:hidden;
	width:<?php if ($theme_namee != 'OptimizePress') { echo 'auto'; } else { echo '1050px'; } ?> !important;
	background-color:<?php if ($theme_namee == 'OptimizePress') { echo 'white'; } ?> !important;
	 <?php } ?>
	
}
<?php
// Coading for outer Frame
$global_outer_oaptemplate_override_load = get_option("oapmp_outer_template_override_load");
$global_outer_oaptemplate_override = get_option("oapmp_outer_template_override");
$global_outer_maxheight_load = get_option("oapmp_outer_template_override_height_load");
$global_outer_maxheight = get_option("oapmp_outer_template_max_height");
$global_outer_maxwidth_load = get_option("oapmp_outer_template_background_color_load");
$global_outer_maxwidth = get_option("oapmp_outer_template_max_width");
$outer_page_background_color= get_post_meta($post->ID, '_oap_outer_page_background_color', true );
$outer_oaptemplate_override = get_post_meta( $post->ID, '_oap_outer_template_override', true );
$outer_maxheight= get_post_meta( $post->ID, '_oap_outer_template_max_height', true );
$outer_maxwidth = get_post_meta( $post->ID, '_oap_outer_template_max_width', true );
$global_outer_template_background_color_load = get_option("oapmp_outer_template_background_color_load");
$global_outer_template_background_color = get_option("oapmp_outer_template_background_color");
$global_outer_template_custom_css_load = get_option("oapmp_outer_template_custom_css_load");
$global_outer_media_template_custom_css = get_option("oapmp_outer_media_template_custom_css");
$global_outer_text_template_custom_css = get_option("oapmp_outer_text_template_custom_css"); 
$outer_page_background_color= get_post_meta( $post->ID, '_oap_outer_page_background_color', true );
$outer_media_template_custom_css = get_post_meta( $post->ID, '_oap_outer_media_template_custom_css', true );
$outer_text_template_custom_css = get_post_meta( $post->ID, '_oap_outer_text_template_custom_css', true );
if($onoff_advanced_setting == 'ON' || $onoff_global_setting == 'ON')
{
if($outer_oaptemplate_override == 'Enabled' || $global_outer_oaptemplate_override != 'Disabled' || ($global_outer_oaptemplate_override_load == 'on' && $global_outer_oaptemplate_override == 'Enabled'))
{
	if($global_outer_maxwidth_load == "on" && $global_outer_oaptemplate_override_load == 'on' && $global_outer_oaptemplate_override == 'Enabled')
	{
	
		if($global_outer_maxwidth != "")
		{
		$outer_media_maxwidth = $global_outer_maxwidth;
		}
		if(strripos($outer_media_maxwidth,'px') >0)
		{
		$outer_media_maxwidth=$outer_media_maxwidth;
		}
		else
		{
		$outer_media_maxwidth=$outer_media_maxwidth."px";
		}
		
	}
	else 
	{	
		
	if($outer_oaptemplate_override == "Enabled" && $outer_maxwidth != "")
		{
		$outer_media_maxwidth = $outer_maxwidth;
		}
		if(strripos($outer_media_maxwidth,'px') >0)
		{
		$outer_media_maxwidth=$outer_media_maxwidth;
		}
		else
		{
		$outer_media_maxwidth=$outer_media_maxwidth."px";
		}
	}
	if($global_outer_maxheight_load == "on" && $global_outer_oaptemplate_override_load == "on" && $global_outer_oaptemplate_override == "Enabled")
	{
		if($global_outer_maxheight != "")
		{
		$outer_media_maxheight= $global_outer_maxheight;
		}
		if(strripos($outer_media_maxheight,'px') >0)
		{
		$outer_media_maxheight=$outer_media_maxheight;
		}
		else
		{
		$outer_media_maxheight=$outer_media_maxheight."px";
		}
			
	}
	else
	{
		if($outer_oaptemplate_override == 'Enabled' && $outer_maxheight != "")
		{
		$outer_media_maxheight= $outer_maxheight;
		}
		if(strripos($outer_media_maxheight,'px') >0)
		{
		$outer_media_maxheight=$outer_media_maxheight;
		}
		else
		{
		$outer_media_maxheight=$outer_media_maxheight."px";
		}
	}
	if($global_outer_template_background_color_load == "on" && $global_outer_oaptemplate_override_load == "on" && $global_outer_oaptemplate_override == "Enabled")
	{
	
		$outer_template_background_color = $global_outer_template_background_color;
	}
	else 
	{	
		$outer_template_background_color = $outer_page_background_color;
	}
	if($global_outer_template_custom_css_load == "on" && $global_outer_oaptemplate_override_load == "on" && $global_outer_oaptemplate_override == "Enabled")
	{
	 
		if(get_option("oapmp_post_template") == "Media Template" || get_post_meta( $post->ID, '_oap_media_text_template', true ) == "Media Template")
		{
		$outer_template_custom_css = $global_outer_media_template_custom_css;
		}
		if(get_option("oapmp_post_template") == "Text Template" || get_post_meta( $post->ID, '_oap_media_text_template', true ) == "Text Template")
		{
		$outer_template_custom_css = $global_outer_text_template_custom_css;
		}
	}
	else 
	{	
		if(get_post_meta( $post->ID, '_oap_media_text_template', true ) == "Media Template")
		{
		$outer_template_custom_css = $outer_media_template_custom_css;
		}
		if(get_post_meta( $post->ID, '_oap_media_text_template', true ) == "Text Template")
		{
		$outer_template_custom_css = $outer_text_template_custom_css;
		}
	}
 }
}
?>
#oap_theme_wrapper
{
max-height:<?php echo $outer_media_maxheight; ?> !important;
width:<?php echo $outer_media_maxwidth; ?> !important;
background-color:<?php echo $outer_template_background_color; ?> !important;
<?php echo $outer_template_custom_css; ?>
}
</syle>
<?php if(get_option('oapmp_global_styling_option')=='I want to customize the style below'){?>
<style>
		.oap-heading{
		     font-size:<?php echo get_option("oapmp_overview_font_size") ;?>px !important; 
		     font-family:<?php echo get_option("oapmp_overview_font_family") ;?> !important;
		     color:<?php echo get_option("oapmp_overview_title_color") ;?> !important;
		   }
		
			
			
	
		    <?php if(get_option("oapmp_infobox_border")=='Enabled') {?>
		     .oapInfobox{
							
			     border:10px solid  <?php echo get_option("oapmp_infobox_border_color") ;?> !important;
			     text-align:center;
			  }
			  <?php } ?>
		  .oapoverviewtitle{
		  	font-family:<?php echo get_option("oapmp_overview_font_family") ;?> !important;
		    font-size:21px;
		    color:<?php echo get_option("oapmp_overview_title_color") ;?> !important;
		  }	
		  .oapLessonText{
		  font-size:<?php echo get_option("oapmp_membership_menu_itemlength_font_size") ;?>px !important;
		  }
		  
		#oapsidebar UL LI .box P
		{
		 font-size:<?php echo get_option("oapmp_membership_menu_itemlength_font_size") ;?>px !important;
		}
		
		
		<?php if(get_option("oapmp_on_off_main_content") == 'ON')
{ ?>
		#oap-main h4
		{
		  color:<?php echo get_option("oapmp_membership_menu_item_link_color") ;?> !important;
		}
		  
		  .oap-post-title h2 {
		  font-family:<?php echo get_option("oapmp_post_title_font_family") ;?> !important;
		    font-size:<?php echo get_option("oapmp_post_title_font_size") ;?>px !important;
		    color:<?php echo get_option("oapmp_post_titles_color") ;?> !important;
			min-height:20px;
			
		  }
		  .post_title h1
		  {
		   font-family:<?php echo get_option("oapmp_post_title_font_family") ;?> !important;
		   font-size:<?php echo get_option("oapmp_post_title_font_size") ;?>px !important;
		   color:<?php echo get_option("oapmp_post_titles_color") ;?> !important;
		  }
			
		.lesson_number
		{
		  color:<?php echo get_option("oapmp_post_titles_color") ;?> !important;
		  font-family:<?php echo get_option("oapmp_post_title_font_family") ;?> !important;
		}
		  .oapcontent p a{
		    color:<?php echo get_option("oapmp_membership_content_links_color") ;?> !important;
			}
		.oapcontent a{
		    color:<?php echo get_option("oapmp_membership_content_links_color") ;?> !important;
			}
			<?php 
			}
			if(get_option("oapmp_on_off_infobox_download") == 'ON')
{ ?>
		/** Infobox and Download section**/
		  .oapDownloadListing a{
		     color:<?php echo get_option("oapmp_download_link_color") ;?> !important;
		  
		  } 
		 
		  .leftwhite h2,.oapInfoBox h2,.oapDownloadList h2{
		    font-family:<?php echo get_option("oapmp_infobox_title_font_family") ;?> !important;
		    font-size:<?php echo get_option("oapmp_infobox_title_font_size") ;?>px !important;
		    color:<?php echo get_option("oapmp_infobox_titles_color") ;?> !important;
			min-height:20px;
			}
			.oap-infobox-fullvideo h2,.oap-download-fullvideo h2{
		    font-family:<?php echo get_option("oapmp_infobox_title_font_family") ;?> !important;
		    font-size:<?php echo get_option("oapmp_infobox_title_font_size") ;?>px !important;
		    color:<?php echo get_option("oapmp_infobox_titles_color") ;?> !important;
			min-height:20px;
			}
			.dlitem_text a
			{
			color:<?php echo get_option("oapmp_download_link_color"); ?> !important;
			}
		  <?php if(get_option('oapmp_download_link_color_load')=='on'){?>
			  #mycarousel li a{
			     color:<?php echo get_option("oapmp_download_link_color") ;?> !important;
			  }  
		  <?php }?>
		  
<?php } ?>
		  <?php if((get_post_meta($post->ID,'_on_off_info_box',true)=='') && (get_post_meta( $post->ID, '_on_off_download', true )=='') ){?>
		 		 .oapMediaFullWidth{float:left;/*width:80%;background-color:#000;*/text-align:center;} 
		  <?php } ?>
		  
		   <?php if((get_post_meta($post->ID,'_on_off_main_media',true)=='') ){?>
		 		 .oapInfoBoxFullWidth{float:left; /*width:79% !important;background-color:#000;*/text-align:center;} 
		  <?php } ?> 
		
		
		  /*** Sidebar Menu css *****/  
<?php if(get_option("oapmp_on_off_menuitems") == 'ON')
{ ?>
		.oapposttitle{
		  	font-family:<?php echo get_option("oapmp_membership_menu_itemtitle_font_family") ;?> !important;
		    font-size:<?php echo get_option("oapmp_membership_menuitemtiltle_font_size") ;?>px !important;
		    color:<?php echo get_option("oapmp_membership_menu_item_link_color") ;?> !important;
			}
			.oapposttitle:hover{
		  	color:<?php echo get_option("oapmp_membership_menu_item_link_hover_color");?> !important;
			}
		  .oapposttitle:visited{
		 	    color:<?php echo get_option("oapmp_membership_menu_item_link_visited_color");?> !important; 
		 	}
		.oap-picture{
		   /* thick solid #000; */
		    border:<?php echo get_option("oapmp_membership_menu_image_border_width") ;?>px <?php echo get_option("oapmp_membership_menu_image_border_style") ;?> <?php echo get_option("oapmp_membership_menu_image_border_color") ;?> ;
		   -moz-border-radius: 5px;
		   -webkit-border-radius: 5px;
		    border-radius: 5px;
		   
		   }
		 .oap-smallimage IMG{
			border:<?php echo get_option("oapmp_membership_menu_image_border_width") ;?>px <?php echo get_option("oapmp_membership_menu_image_border_style") ;?> <?php echo get_option("oapmp_membership_menu_image_border_color") ;?> ;
			-moz-border-radius: 5px;
		    -webkit-border-radius: 5px;
		     border-radius: 5px;
		    }
		 	.oap-smallimage-sidebar
			{
			border:<?php echo get_option("oapmp_membership_menu_image_border_width") ;?>px <?php echo get_option("oapmp_membership_menu_image_border_style") ;?> <?php echo get_option("oapmp_membership_menu_image_border_color") ;?> ;
		   -moz-border-radius: 5px;
		   -webkit-border-radius: 5px;
		    border-radius: 5px;
			}
		 	
		 	.oapmenutitle h2{
		 	   color:<?php echo get_option("oapmp_membership_menu_item_link_color") ;?> !important;
			   min-height:20px;
		 	}
		 	.oapmenutitle h2 a{
		 	   color:<?php echo get_option("oapmp_membership_menu_item_link_color") ; ?> !important; 
		 	   font-family:<?php echo get_option("oapmp_membership_menu_itemtitle_font_family") ;?> !important;
		 	   font-size:<?php echo get_option("oapmp_membership_menuitemtiltle_font_size");?>px !important;
		 	    	} 
		 	.oapmenutitle h2 a:hover{
		 	    color:<?php echo get_option("oapmp_membership_menu_item_link_hover_color");?> !important;
		 	}
		 	
		 	.oapmenutitle h2 a:visited{
		 	    color:<?php echo get_option("oapmp_membership_menu_item_link_visited_color");?> !important; 
		 	}
	A.lessoncolor
	{
	color:<?php echo get_option('oapmp_membership_content_links_color'); ?> !important;
	 font-family:<?php echo get_option("oapmp_post_title_font_family") ;?> !important;
	}
	A.lessoncolor:hover{
		 	    color:<?php echo get_option("oapmp_membership_menu_item_link_hover_color");?> !important;
				font-family:<?php echo get_option("oapmp_post_title_font_family") ;?> !important;
		 	}
	A.lessoncolor:visited{
		 	    color:<?php echo get_option("oapmp_membership_menu_item_link_visited_color");?> !important; 
				font-family:<?php echo get_option("oapmp_post_title_font_family") ;?> !important;
		 	}
			
			
		#oapsidebar UL LI
		{
		 padding-bottom:<?php echo get_option("oapmp_membership_menu_bottom_padding") ;?>px !important;
		}
		
		LI.overviewlistitems
		{
		 padding-bottom:<?php echo get_option("oapmp_membership_menu_bottom_padding_overview") ;?>px !important;
		}
		
		#pic ul li
		{
		 padding-bottom:<?php echo get_option("oapmp_membership_menu_bottom_padding_overview") ;?>px !important;
		}
             <?php } ?>  
	
</style>   
<?php  } ?>
<?php if(get_option('oapmp_global_styling_option')=='Use the OAP Template Defaults'){?>
	<style>
	
	.oapoverviewtitle{
	     font-size:30px;
	     font-family:League;
	   } 
	.oapposttitle{
	   font-family:League;
	   color:#000 !important;
	   font-weight:bold;
	   font-size:18px;
	
	}
	.oapLessonText{
	   font-size:12px;
	
	}  
.oapLessonNumber a{
	  color:#000;
	} 
	
	#oap-main h4{
	   color:#000;
	   font-size:18px;
	   font-family:League;
	}
	#oap-main p.txt{
	  color:#666 !important;
	} 
	   
	.oap-picture{
	    border:8px solid black;
	   -moz-border-radius: 5px;
	   -webkit-border-radius: 5px;
	    border-radius: 5px;
	    height:207px;
	    width:207px;
	   }
		#oapsidebar ul li .box h2 a{
		    color:#000;
		}	   
		.oapcontent p{
		  color:#666;
		}	
		.sleft h2{
		 color:#000;
		} 
		.oap-top-text p{
		   color:#666;
		}
		#scroll .sleft a{
		color:#000;
		} 
		.oap-htmlcontent{
		 color:#666;
		}  
	  
	
	    
	    
	  .oapDownloadListing a{
		   color:#000;
		   font-weight:bold;
	   
	   }
	   .oapInfoBox p{
	      color:#666;
	   }
	   .leftwhite h2{
	   	  font-family: League;
          font-size: 20px;
	   }
	   .oapInfoBox h2{
	      font-family: League;
	      font-size:14px;
	   
	   }
	 
	    <?php if((get_post_meta($post->ID,'_on_off_info_box',true)=='ON')){ ?>
	      #headerbox .hleft{
			
	      border:10px solid black !important;
	      height:366px !important;
	   }
	  <?php }//end if on/off info box?> 
	</style>   
 <?php } //oap template defaults Ends ?>   
 <style>
<?php
 if((get_post_meta($post->ID,'_oap_lesson_menu_position',true)=='Left') && (get_option("oapmp_post_content_menu_position_load")!="on")){?>
 		 .oap-post{
	 		 float:right !important;
	 		
 		 } 
   <?php } ?>
<?php if((get_option("oapmp_post_content_menu_position_load")=="on") && (get_option("oapmp_post_content_menu_position")=='Left')){?>
 		 .oap-post{
	 		 float:right !important;
	 		
 		 } 
   <?php } ?>
<?php if((get_post_meta($post->ID,'_oap_lesson_menu_position',true)=='Right') && (get_option("oapmp_post_content_menu_position_load")!="on")){?>
 		 
 		  #oapsidebar{ float:right !important; } 
 		
  <?php } ?>
<?php if((get_option("oapmp_post_content_menu_position_load")=="on") && (get_option("oapmp_post_content_menu_position")=='Right')){?>
 		 #oapsidebar{ float:right !important; } 
   <?php } ?>
<?php if(get_post_meta( $post->ID, '_on_off_custom_html', true )=='ON' ){?>
.oap-htmlcontent
{
    display: inline-block;
    width: 100%;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    padding:20px 0 20px 0px;
}
  <?php } ?>
.imageicon{
	float:left;	
	background-image:url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/image.png);
	background-repeat:no-repeat;
	width:32px;
	height:32px;
	padding:0 10px 0 0px;
}
.pdficon{
	float:left;
	background-image:url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/pdf.png);
	background-repeat:no-repeat;
	width:32px;
	height:32px;
	padding:0 10px 0 0px;
}
.movieicon{
	float:left;	
	background-image:url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/movie.png);
	background-repeat:no-repeat;
	width:32px;
	height:32px;
	padding:0 10px 0 0px;
	
} 
/**
* Gloabal post settings CSS
*/
<?php if((get_option('oapmp_membership_content_links_color_load')=='on') && get_option('oapmp_global_styling_option')!='Use my current theme stylesheet'){ ?>
        #oapsidebar ul li p a{
            color:<?php echo get_option('oapmp_membership_content_links_color'); ?> !important;
        }
		
		.mainbox p a{
            color:<?php echo get_option('oapmp_membership_content_links_color'); ?> !important;
        }
<?php } ?>
<?php if((get_post_meta($post->ID,'_on_off_info_box',true)=='ON')){ ?>
        .oap-top-text{
            height:307px;
        }
		
		
<?php } ?>
<?php if(get_option('oapmp_global_styling_option')=='Use my current theme stylesheet'){ ?>
<?php 
if((get_post_meta($post->ID,'_oap_sidebar_position',true)=='Disabled') && (get_option("oapmp_sidebar_enable_load")!="on") ){?>
 		 
 		  #oapsidebar{ display:none; !important; } 
		  .oap-post 
		  {
		  	width:100%;
		  	box-sizing: border-box;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
		  }
 		
  <?php } 

  	if((get_option("oapmp_sidebar_enable_load")=="on") && (get_option("oapmp_sidebar_enable")=='Disabled'))
  	{
  	?>
 		  #oapsidebar{ display:none; !important; } 
		  .oap-post 
		  {
		  	width:100%;
		  	box-sizing: border-box;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
		  }
  		<?php 
		} 
	}

/** Over-ride Option **/
	if((get_option('oapmp_all_links_color_load')=='on') && get_option('oapmp_global_styling_option')!='Use my current theme stylesheet')
	{ ?>
		a
		{
			color:<?php echo get_option('oapmp_all_links_color'); ?> !important;
		}
	<?php 
	}

	if(get_option('oapmp_global_font_family_load')=='on')
	{ ?>
  		body
  		{
  			font-family:<?php echo get_option('oapmp_global_font_family'); ?> !important;
		}
	<?php 
	}

	if(get_option('oapmp_global_color_load')=='on'){ ?>
		body
		{
			color:<?php echo get_option('global_color'); ?> !important;
  		}
	<?php 
	}
	
	if(get_post_type( $post->ID ) != 'oaplesson')
	{ ?>
		#oapsidebar .viewport
		{
			height:<?php echo get_option('oap_height_widget'); ?> !important;
			overflow: hidden;
		}
	<?php 
	} ?>
/*** Scrollbar for top Text ****/
	
#oap-infobox-fullvideo
{
float:left;width:100%;
}
#oap-download-fullvideo
{
float:left;width:100%;
}
#oap-top-text { width:100%; margin: 5px 0 10px;float:left; overflow: hidden; }
#oap-top-text .viewport { width: 80%; height: 360px; overflow: hidden; position: relative; }
#oap-top-text .overview { display: inline-block; width: 100%; box-sizing: border-box; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; list-style: none; left: 0; top: 0; padding: 0; margin: 0; }
#oap-top-text .scrollbar{ background: transparent url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/bg-scrollbar-track-y.png) no-repeat 0 0; position: relative; background-position: 0 0; float: right; width: 15px; }
/* #scrollbar1 .track { background: transparent url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/bg-scrollbar-trackend-y.png) no-repeat 0 100%; height: 100%; width:15px; position: relative; } */
#oap-top-text .thumb { background: transparent url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/bg-scrollbar-thumb-y.png) no-repeat 50% 100%; height: 200px; width: 25px; cursor: pointer; overflow: hidden; position: absolute; top: 0; left: -5px; }
#oap-top-text .thumb .end { background: transparent url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/bg-scrollbar-thumb-y.png) no-repeat 50% 0; overflow: hidden; height: 5px; width: 25px; }
#oap-top-text .disable { display: none; }	
/*** Scrollbar for Download Listing in front end ****/
#scrollbar1 { width: 100%; margin: 5px 0 10px;float:left; }
#scrollbar1 .viewport { width: 80%; height: 90px; overflow: hidden; position: relative; }
#scrollbar1 .overview { list-style: none; position: absolute; left: 0; top: 0; padding: 0; margin: 0; }
#scrollbar1 .scrollbar{ background: transparent url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/bg-scrollbar-track-y.png) no-repeat 0 0; position: relative; background-position: 0 0; float: right; width: 15px; }
/* #scrollbar1 .track { background: transparent url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/bg-scrollbar-trackend-y.png) no-repeat 0 100%; height: 100%; width:15px; position: relative; } */
#scrollbar1 .thumb { background: transparent url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/bg-scrollbar-thumb-y.png) no-repeat 50% 100%; height: 200px; width: 25px; cursor: pointer; overflow: hidden; position: absolute; top: 0; left: -5px; }
#scrollbar1 .thumb .end { background: transparent url(<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/bg-scrollbar-thumb-y.png) no-repeat 50% 0; overflow: hidden; height: 5px; width: 25px; }
#scrollbar1 .disable { display: none; }	
/** Scrollbar for Lessons Right Listing  overflow: hidden;**/	
#mycarousel { margin:0px;padding:0px;}
#mycarousel li {width:80%;float:left;list-style: none;}
#mycarousel li { float:left;width:100%;}
#mycarousel li a{ padding-top:10px; float: left;
    height: 25px;}
#container-5 IMG[alt]
{
	float:left;
}
#container-5 OBJECT
{
	float:left;
	margin-bottom:5px;
}
</style>