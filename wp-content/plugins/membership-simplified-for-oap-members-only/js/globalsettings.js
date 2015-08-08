jQuery(document).ready(function()
{       
    // for global Menu Item setting
    jQuery('._on_off_menuItemSetting :checkbox').iphoneStyle();
    if(jQuery('._on_off_menuItemSetting :checkbox').attr('checked')=='checked')
    {
        jQuery('#global_menuitem_sidebar').show();
    }
    jQuery('._on_off_menuItemSetting :checkbox').change(function () 
    {
        var checked = jQuery(this).attr('checked');
        if(checked)
        {
            jQuery('#global_menuitem_sidebar').show();
        }
        else
        {
            jQuery('#global_menuitem_sidebar').hide();
        }
    });

    // for global Infobo and Download setting
    jQuery('._on_off_infoboxDownload :checkbox').iphoneStyle();
    if(jQuery('._on_off_infoboxDownload :checkbox').attr('checked')=='checked')
    {
        jQuery('#global_infobox_download').show();
    }
    jQuery('._on_off_infoboxDownload :checkbox').change(function () 
    {
        var checked = jQuery(this).attr('checked');
        if(checked)
        {
            jQuery('#global_infobox_download').show();
        }
        else
        {
            jQuery('#global_infobox_download').hide();
        }
    });

    // for global Main Content Setting setting
    jQuery('._on_off_mainContent :checkbox').iphoneStyle();
    if(jQuery('._on_off_mainContent :checkbox').attr('checked')=='checked')
    {
        jQuery('#global_main_content').show();
    }
    jQuery('._on_off_mainContent :checkbox').change(function () 
    {
        var checked = jQuery(this).attr('checked');
        if(checked)
        {
            jQuery('#global_main_content').show();
        }
        else
        {
            jQuery('#global_main_content').hide();
        }
    });

        // for global Advanced setting
    jQuery('._on_off_advanceSetting :checkbox').iphoneStyle();
    if (jQuery('._on_off_advanceSetting :checkbox').attr('checked')=='checked')
    {
        jQuery('#global_template_override').show();
    }

    jQuery('._on_off_advanceSetting :checkbox').change(function () 
    {
        var checked = jQuery(this).attr('checked');
        if(checked)
        {
            jQuery('#global_template_override').show();
        }
        else
        {
            jQuery('#global_template_override').hide();
        }
    });

    // Save my settings popup section
    jQuery('#inline').click(function()
    {
        if ( jQuery(this).siblings('div.ihm-overlay').is(":visible") )
        {
            jQuery(this).siblings('div.ihm-overlay').fadeOut(300);
        }
        else
        {
            jQuery(this).siblings('div.ihm-overlay').fadeIn(300);
        }

        return false;
    });

    var $closebutton = jQuery('#inline').siblings('div.ihm-overlay').children('.inlinehelpmenu').children('.close-this');
    $closebutton.click(function()
    {
        jQuery(this).parent('.inlinehelpmenu').parent('.ihm-overlay').fadeOut();
    });

});