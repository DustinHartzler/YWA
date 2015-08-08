(function() {
		  
	var radios = jQuery('input:radio[name=preffered_template]');
    if(radios.is(':checked') === false) {
        radios.filter('[value=Squares]').attr('checked', true);
    }
	jQuery("#oap_select").attr('alt' , '#TB_inline')
	
    tinymce.create('tinymce.plugins.oaplesson', {
        init : function(ed, url) {
    	
    		 jQuery("#oap_select").change(function() {
					var template= jQuery("#preffered_template:checked").val();
					var content_type= jQuery("#content_type").val();
    		     	var catId= jQuery(this).val();
    		     	ed.selection.setContent("");	
    		     	ed.selection.setContent('[oapcontent cat='+catId+' pref_template='+template+' type='+content_type+']'); //set shortcode here
    		     	tb_remove();
    		     });
    	
            ed.addButton('oaplesson', {
            	 title : 'Add a Membership Overview Section', // title of the button
                  image : '../wp-content/plugins/membership-simplified-for-oap-members-only/images/membershipbutton.png',  // path to the button's image
                 onclick : function() {
                    tb_show('Create a Membership Overview Page', '#TB_inline?height=270&width=200&inlineId=oap_inline'); //oap_inline is the id for contents
                    jQuery("#TB_window").css({width :  '500px' , height : '400px'});
                    
                    
                   	//var catId= jQuery("#oap_select :selected").val();
           	    	//  var catId = prompt("Lesson Category", "Enter a category Id");
            	   // ed.selection.setContent('[oaplesson]' + ed.selection.getContent() + '[/oaplesson]');
            	  //ed.selection.setContent('[oapcontent cat='+catId+']'); //set shortcode here
            	
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('oaplesson', tinymce.plugins.oaplesson);
})();