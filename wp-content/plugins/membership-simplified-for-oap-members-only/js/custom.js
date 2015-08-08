jQuery(document).ready(function()
{

	/*
	 * To update the download list in admin
	 */
	jQuery(function() 
	{
		jQuery("#contentDragDrop ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = jQuery(this).sortable("serialize") + '&action=updateRecordsListings';
			jQuery.post("../wp-content/plugins/membership-simplified-for-oap-members-only/updateDB.php", order, function(theResponse){
				jQuery("#contentRight").html(theResponse);
			});
		}
		});
	});
	/*
	 * To update the download list in admin
	 */
	jQuery(function() 
	{
		jQuery("#contentDragDropMedia ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = jQuery(this).sortable("serialize") + '&action=media_updateRecordsListings';
			jQuery.post("../wp-content/plugins/membership-simplified-for-oap-members-only/updateDB.php", order, function(theResponse){
				jQuery("#contentRightMedia").html(theResponse);
			});
		}
		});
	});
	/*
	 * To delete the Download Listing
	 * 
	 */
	jQuery('.deldownload').click(function() 
	{
		var recordId= jQuery(this).attr('href');
		$ele = jQuery(this);
		jQuery.post("../wp-content/plugins/membership-simplified-for-oap-members-only/updateDB.php", {recordId:recordId, action:"delete"}, function(){
			$ele.parent().parent().remove();
		});
	return false;
	});
	/*
	 * To delete the Media Listing
	 * 
	 */
	jQuery('.delmedia').click(function() 
	{
		var recId= jQuery(this).attr('href');
		$ele = jQuery(this);
		jQuery.post("../wp-content/plugins/membership-simplified-for-oap-members-only/updateDB.php", {recordID:recId, action:"delete_media"}, function(){
			$ele.parent().parent().remove();
		});
	return false;
	});

	// Checks to make sure that the correct data is being filled on download items
	jQuery('#adddownload').click( function()
	{
		var oap_download_name = jQuery('#oap_download_name').val();
		if(oap_download_name == '') 
		{
			jQuery('#download_msg').html('Please enter the download name.');
		   	jQuery('#oap_download_name').focus();
		   	return false;
		}
	});
		
	jQuery('#addmedia').click( function()
	{
		var oap_media_name = jQuery('#oap_media_name').val();
	   	if(oap_media_name =='')
	   	{
	   		jQuery('#media_msg').html('Please enter the media name.');
	   		jQuery('#oap_media_name').focus();
	   	return false;
	    	}
	});

	/* Condition for media or Text Template*/
	// Enable colorview for background
	// TODO - Figure out why this is breaking the ability to press enter in the HTML text section
	// jQuery('._on_off_advanced_setting').click(function()
	// {
	// 	jQuery('#_oap_page_background_color').modcoder_excolor();	
	// 	jQuery('#_oap_outer_page_background_color').modcoder_excolor();
	// });			

	// Default Shared Template
	var full_shared = jQuery('#_oap_fullvideo_shared_position').val();	
	if(full_shared == 'Full Width')
	{
		jQuery('#video_image_position').hide();
	}
	if(full_shared == '720 by 420')
	{
		jQuery('#video_image_position').hide();
	}

	// Default Text Template
	var tempalte = jQuery('#_oap_media_text_template').val();	
	if(tempalte == 'Text Template')
	{
		jQuery('#video_image_position').hide();
	    	jQuery('#fullvideo_shared_position').hide();
		jQuery('#_oap_media_template_custom_css').hide();
		jQuery('#_oap_text_template_custom_css').show();
		jQuery('.mainmediadiv').slideUp("slow");
		jQuery('#_oap_outer_media_template_custom_css').hide();
		jQuery('#_oap_outer_text_template_custom_css').show();
		jQuery('#mleft').hide();
		jQuery('#mcenter').hide();
		jQuery('#mright').hide();
	}

	// Default Sidebar Disable
	var sidebar_pos = jQuery('#_oap_sidebar_position').val();
	if(sidebar_pos == 'Disabled')
	{
		jQuery('#sidebar_nav_cat').hide();
	    	jQuery('#sidebar_nav_pos').hide();
	}

	// Default Inner Template Override
	var template_override = jQuery('#_oap_template_override').val();
	if(template_override == 'Disabled')
	{
		jQuery('#temp_override_height').hide();
	    	jQuery('#temp_override_width').hide();
		jQuery('#page_background_color').hide();
		jQuery('#oap_template_custom_css').hide();
	}

	// Default outer Template Override
	var template_override = jQuery('#_oap_outer_template_override').val();
	if(template_override == 'Disabled')
	{
		jQuery('#outer_temp_override_height').hide();
	    	jQuery('#outer_temp_override_width').hide();
		jQuery('#outer_page_background_color').hide();
		jQuery('#oap_outer_template_custom_css').hide();
		
	}
	var onchange_checkbox = jQuery('._on_off_main_media :checkbox').iphoneStyle();
	if(jQuery('._on_off_main_media :checkbox').attr('checked')=='checked')
	{
		jQuery('.mainmediadiv').show();
	}


	if ( jQuery('#_oap_media_text_template').val() == 'Video Comments' )
	{
		jQuery('#comment_status').prop('checked', true);
		jQuery('#fullvideo_shared_position').hide();
		jQuery('#video_image_position').hide();
		jQuery('.sidebar-settings-row').hide();
		jQuery('.title-settings-row').hide();
		jQuery('li.ms-download-files').hide();
		jQuery('li.ms-custom-html').hide();
		jQuery('.dlfiles-sep').hide();
		jQuery('.ibtctable2').hide();
		jQuery('.dloadsright label').append('<div class="ms-vid-comments-notice" style="display: inline-block; width: 100%; color: #c13130;">This template uses only 1 video. The top video in this list is the one that will be displayed.');
		onchange_checkbox.attr('checked', !onchange_checkbox.is(':checked')).iphoneStyle("refresh");
	}
	else
	{
		jQuery('#fullvideo_shared_position').show();
		jQuery('#video_image_position').show();
		jQuery('.sidebar-settings-row').show();
		jQuery('.title-settings-row').show();
		jQuery('li.ms-download-files').show();
		jQuery('li.ms-custom-html').show();
		jQuery('.dlfiles-sep').show();
		jQuery('.ibtctable2').show();
		jQuery('.ms-vid-comments-notice').remove();
	}


	jQuery('#_oap_media_text_template').change(function()
	{
		if ( jQuery(this).val() == 'Video Comments' )
		{
			jQuery('#comment_status').prop('checked', true);
			jQuery('#fullvideo_shared_position').hide();
			jQuery('#video_image_position').hide();
			jQuery('.sidebar-settings-row').hide();
			jQuery('.title-settings-row').hide();
			jQuery('li.ms-download-files').hide();
			jQuery('li.ms-custom-html').hide();
			jQuery('.dlfiles-sep').hide();
			jQuery('.ibtctable2').hide();
			jQuery('.dloadsright label').append('<div class="ms-vid-comments-notice" style="display: inline-block; width: 100%; color: #c13130;">This template uses only 1 video. The top video in this list is the one that will be displayed.');
			onchange_checkbox.attr('checked', !onchange_checkbox.is(':checked')).iphoneStyle("refresh");
		}
		else
		{
			jQuery('#fullvideo_shared_position').show();
			jQuery('#video_image_position').show();
			jQuery('.sidebar-settings-row').show();
			jQuery('.title-settings-row').show();
			jQuery('li.ms-download-files').show();
			jQuery('li.ms-custom-html').show();
			jQuery('.dlfiles-sep').show();
			jQuery('.ibtctable2').show();
			jQuery('.ms-vid-comments-notice').remove();
		}
	});

	// Media or text template changed
	jQuery('#_oap_media_text_template').change(function () 
	{
		if(jQuery(this).val()  == 'Media Template' || jQuery(this).val()  == 'Video Comments')
		{
			if (jQuery(this).val()  == 'Media Template')
			{
				jQuery('#fullvideo_shared_position').show();
				jQuery('#video_image_position').show();
			}

			jQuery('#_oap_media_template_custom_css').show();
			jQuery('#_oap_text_template_custom_css').hide();
			jQuery('.mainmediadiv').slideDown("slow");
			onchange_checkbox.attr('checked', !onchange_checkbox.is(':checked')).iphoneStyle("refresh");
			jQuery('._on_off_main_media label.iPhoneCheckLabelOn').css("width","54px");
			jQuery('._on_off_main_media label.iPhoneCheckLabelOff span').css("margin-right","-500px");
			jQuery('._on_off_main_media label.iPhoneCheckLabelOn span').css("margin-left","0px");
			jQuery('._on_off_main_media DIV.iPhoneCheckHandle').css("left","50px");
			jQuery('#_oap_outer_media_template_custom_css').show();
			jQuery('#_oap_outer_text_template_custom_css').hide();
			jQuery('#mleft').show();
			jQuery('#mcenter').show();
			jQuery('#mright').show();		
			// this.form.submit();
		}
		else
		{
			jQuery('#video_image_position').hide();
		  	jQuery('#fullvideo_shared_position').hide();
			jQuery('#_oap_media_template_custom_css').hide();
			jQuery('#_oap_text_template_custom_css').show();
			jQuery('.mainmediadiv').slideUp("slow");
			onchange_checkbox.removeAttr('checked', !onchange_checkbox.is(':checked')).iphoneStyle("refresh");
			jQuery('._on_off_main_media label.iPhoneCheckLabelOn').css("width","4px");
			jQuery('._on_off_main_media label.iPhoneCheckLabelOff span').css("margin-right","0px");
			jQuery('._on_off_main_media label.iPhoneCheckLabelOn span').css("margin-left","-50px");
			jQuery('._on_off_main_media DIV.iPhoneCheckHandle').css("left","0px");
			jQuery('#_oap_outer_media_template_custom_css').hide();
			jQuery('#_oap_outer_text_template_custom_css').show();
			jQuery('#mleft').hide();
			jQuery('#mcenter').hide();
			jQuery('#mright').hide();
		}
   	});

	// Full Width or Shared Option Adjustments (Takes away or adds options based upon another options selection.)
	jQuery('#_oap_fullvideo_shared_position').change(function () 
	{
		if(jQuery(this).val()  == 'Full Width')
		{
			jQuery('#video_image_position').hide();
		}
		 
		if(jQuery(this).val()  == '720 by 420')
		{
			jQuery('#video_image_position').hide();
		}
		
		if(jQuery(this).val()  == 'Shared')
		{
			jQuery('#video_image_position').show();
		}
	 });

	// sidebar posiotion changed
	jQuery('#_oap_sidebar_position').change(function () 
	{
		if(jQuery(this).val()  == 'Enabled')
		{
			jQuery('#sidebar_nav_cat').show();
	    		jQuery('#sidebar_nav_pos').show();
		}
		else
		{
			jQuery('#sidebar_nav_cat').hide();
	    		jQuery('#sidebar_nav_pos').hide();
		}
   	});

	// Inner Template Override changed
	jQuery('#_oap_template_override').change(function () 
	{
		if(jQuery(this).val()  == 'Enabled')
		{
			jQuery('#temp_override_height').show();
		    	jQuery('#temp_override_width').show();
			jQuery('#page_background_color').show();
			jQuery('#oap_template_custom_css').show();
		}
		else
		{
			jQuery('#temp_override_height').hide();
	    		jQuery('#temp_override_width').hide();
			jQuery('#page_background_color').hide();
			jQuery('#oap_template_custom_css').hide();
		}
   	});

	// Outer Template Override changed
	jQuery('#_oap_outer_template_override').change(function() 
	{
		if(jQuery(this).val()  == 'Enabled')
		{
			jQuery('#outer_temp_override_height').show();
		    	jQuery('#outer_temp_override_width').show();
			jQuery('#outer_page_background_color').show();
			jQuery('#oap_outer_template_custom_css').show();
		}
		else
		{
			jQuery('#outer_temp_override_height').hide();
		    	jQuery('#outer_temp_override_width').hide();
			jQuery('#outer_page_background_color').hide();
			jQuery('#oap_outer_template_custom_css').hide();
		}
   	});

	/*
	 * iphone Style On Off Buttons in post Section
	 * 
	 */
	 // Individual Post - Add Info Text On / Off Button
	jQuery('._on_off_info_box :checkbox').iphoneStyle();
	if(jQuery('._on_off_info_box :checkbox').attr('checked')=='checked')
	{
		jQuery('.infoboxdiv').show();
	}
	jQuery('._on_off_info_box :checkbox').change(function () 
	{
		var checked = jQuery(this).attr('checked');
		if(checked)
		{
			jQuery('.infoboxdiv').slideDown("slow");
			
		}
		else
		{
			jQuery('.infoboxdiv').slideUp("slow");
		}
   	});

	// Individual Post - Add Downloadable Files On / Off Button
	jQuery('._on_off_download :checkbox').iphoneStyle();	
	if(jQuery('._on_off_download :checkbox').attr('checked')=='checked')
	{
		jQuery('.downloaddiv').show();
	}
	jQuery('._on_off_download :checkbox').change(function () 
	{
		var checked = jQuery(this).attr('checked');
		if(checked)
		{
			jQuery('.downloaddiv').slideDown("slow");
		}
		else
		{
			
			jQuery('.downloaddiv').slideUp("slow");
		}
   	});
	
	// Individual Post - Add Videos On / Off Button
	if(jQuery('._on_off_main_media :checkbox').attr('checked')=='checked')
	{
		jQuery('.mainmediadiv').show();
	}
	jQuery('._on_off_main_media :checkbox').change(function () 
	{
		var checked = jQuery(this).attr('checked');
		if(checked)
		{
			//jQuery("#_oap_media_text_template option[value='Media Template']").attr("selected", "selected");
			jQuery('.mainmediadiv').slideDown("slow");
			jQuery('#video_image_position').show();
	        		jQuery('#fullvideo_shared_position').show();			
		}
		else
		{
			
			jQuery("#_oap_media_text_template option[value='Text Template']").attr("selected", "selected");
			jQuery('.mainmediadiv').slideUp("slow");
			jQuery('#video_image_position').hide();
	        		jQuery('#fullvideo_shared_position').hide();
		}
   	});
	
	// Individual Post - Add Custom HTML On / Off Button
    	jQuery('._on_off_custom_html :checkbox').iphoneStyle();
    	if (jQuery('._on_off_custom_html :checkbox').attr('checked')=='checked')
    	{
    		jQuery('#slidehtml').show();
    	}
	jQuery('._on_off_custom_html :checkbox').change(function () 
	{
		var checked = jQuery(this).attr('checked');
		if(checked)
		{
			jQuery('#slidehtml').slideDown("slow");
		}
		else
		{
			jQuery('#slidehtml').slideUp("slow");
		}
	});
	
	// Individual Post - Advanced Settings On / Off Button
    	jQuery('._on_off_advanced_setting :checkbox').iphoneStyle();
    	if (jQuery('._on_off_advanced_setting :checkbox').attr('checked')=='checked')
    	{
    		jQuery('#template_override').show();
    	}
	jQuery('._on_off_advanced_setting :checkbox').change(function () 
	{
		var checked = jQuery(this).attr('checked');
		if(checked)
		{
			jQuery('#template_override').slideDown("slow");
		}
		else
		{
		
			jQuery('#template_override').slideUp("slow");
		}
	});
	
});
/** 
 * Forcly refresh the Addd New Category Page
 */
/*
jQuery(document).ready(function()
{
	jQuery('#submit').click(function() 
	{	
		if (jQuery("#submit").attr('value', 'Add New Category'))
		{
			var tagname=jQuery("#tag-name").val();
			if(tagname == "")
			{
			}
			else
			{
				//location.reload();
				window.location.reload();
			}
		}		
	});
});*/
function videotype(type)
{
	if(type == 'oapvideo')
	{
		jQuery('#hosted_video').hide();
		jQuery('#url_video').show();
		jQuery('#amazons3_url_video').hide();
		jQuery('#embeded_video').hide();
	}
	if(type == 'oapvideohosted')
	{
		jQuery('#hosted_video').show();
		jQuery('#url_video').hide();
		jQuery('#amazons3_url_video').hide();
		jQuery('#embeded_video').hide();
	}
	if(type == 'oapamazons3video')
	{
		jQuery('#amazons3_url_video').show();
		jQuery('#hosted_video').hide();
		jQuery('#url_video').hide();
		jQuery('#embeded_video').hide();
	}
	if(type == 'oapembededvideo')
	{
		jQuery('#hosted_video').hide();
		jQuery('#url_video').hide();
		jQuery('#amazons3_url_video').hide();
		jQuery('#embeded_video').show();
	}
	//alert(type);
}
function downloadtype(type)
{
if(type == 'download_manualtype')
	{
		jQuery('#download_hosted_video').hide();
		jQuery('#download_stream_video').hide();
		jQuery('#download_manual_video').show();
	}
	if(type == 'download_hostedtype')
	{
		jQuery('#download_stream_video').hide();
		jQuery('#download_manual_video').hide();
		jQuery('#download_hosted_video').show();
	}
	if(type == 'download_streamtype')
	{
		jQuery('#download_hosted_video').hide();
		jQuery('#download_manual_video').hide();
		jQuery('#download_stream_video').show();
	}
	//alert(type);
}