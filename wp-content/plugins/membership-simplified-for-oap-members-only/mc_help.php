<?php 
wp_enqueue_script('jquery');
wp_register_script( 'mousewheel', plugins_url('/js/jquery.mousewheel-3.0.6.pack.js', __FILE__) );
wp_enqueue_script('mousewheel');
wp_register_script( 'easyslider', plugins_url('/js/easySlider1.7.js', __FILE__) );
wp_enqueue_script('easyslider');
?>
<script type="text/javascript">
jQuery(document).ready(function(){	
	jQuery("#slider").easySlider({
		auto: true, 
		continuous: true,
		speed: 1000,
		pause: 4000
	});
});	
</script>
<script type="text/javascript" src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/js/swfobject.js"></script>
<script type="text/javascript">
	var flashvars = {
			xmlPath: "<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/xml/example.xml"				
	};
	var params = {
		  bgcolor: "#0099FF",
      allowFullScreen: "true"			
	};			
	var attributes = {};		
	swfobject.embedSWF("<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/js/main.swf", "gallery", "720", "220", "9.0.0","expressInstall.swf", flashvars, params, attributes);			
</script>
<style type="text/css">
#wrap
{
	margin:0 auto;
	margin-top: 32px;
	width: 720px;
}
p
{
	font-size: 13pt;
	color: #444;
}
	
</style>       
</head>
<body>
<div class="help_top">
	<div id="screen-meta-links">
		<div id="contextual-help-link-wrap" class="hide-if-no-js screen-meta-toggle">
		<a href="#contextual-help-wrap" id="contextual-help-link" class="show-settings">Help</a>
		</div>
		<div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
		<a href="#screen-options-wrap" id="show-settings-link" class="show-settings">Screen Options</a>
		</div>
	</div>
    <div id="icon-edit" class="icon32 icon32-posts-oaplesson"><br></div>
    <h2 class="league heading">Membership Simplified (Beta)</h2>
</div>
<div class="help_wrap" style="margin:10px auto;">
<div class="help_intro">
<div class="intro">
<h1 class="intro_header">
Welcome to the Membership Plugin Set-Up Guide
</h1>
<span class="intro_text Myriad"><p>
Got questions? We have answers! If you recently installed this plugin and haven't yet had the oppertunity to plan out your program, we highly recommend you read and/or download our PDF guides, <a href="http://officeautopilot.com/mp/helpfiles/membershipsimplified.pdf" target="_blank">'Membership, Simplified.'</a> & <a href="http://officeautopilot.com/mp/helpfiles/howtocharge.pdf" target="_blank">'How to charge for access to your membership site.'</a> 'Membership, Simplified' goes into the nuts of bolts of settings up the plugin in WordPress as well as configuring the integration between OfficeAutopilot and your site. 'How to charge for access to your membership site' goes into the configuration of your OfficeAutopilot sequences, the necessary supporting elements, and other similar material. Additionally, we highly recommend that you download our <a href="http://officeautopilot.com/mp/helpfiles/membershipplanningworksheet.pdf" target="_blank">Membership Planning Guide</a> as it will help you plan out and structure your membership programs and then make the process of implementing your content a breeze!</p><p>If you'd rather dive right in, you will find a list of items below that you can use to guide you through the process. Finally, if you need additional help, use the Help icons next to each backend option to get detailed information on that specific option. And of course, you are always more than welcome to contact one of our support heros via chat or phone. All of their details can be found at the bottom right of this page. </p>
</span>
</div>
</div>
<div class="seperator">
<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/seperator.png" />
</div>
<div class="help_steps">
<h3 class="help_subhead">
Follow the Steps!
</h3>
<span class="help_text Myriad">
The following steps have been created to make it super easy to set up your membership program. While its up to you how you use this tool, we have found that this is the best and most efficent method.
</span>
<div class="stepbystep">
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/1.html">
1
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/2.html">
2
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/3.html">
3
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/4.html">
4
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/5.html">
5
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/6.html">
6
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/7.html">
7
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/8.html">
8
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/9.html">
9
</a>
</div>
<div class="numbers">
<a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/numbers/10.html">
10
</a>
</div>
</div>
</div>
<div class="seperator">
<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/seperator.png" />
</div>
<div class="help_categories">
<div class="left_category">
<h3 class="sub_head">
Basic Concepts & Settings
</h3>
<ul>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/concepts/beforeyoubegin.html">
What you need to know BEFORE YOU BEGIN.</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/concepts/necessities.html">
The necessary parts of a good Membership Program.</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/concepts/tools.html">
The tools that are provided and how to use them.</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/concepts/basicsettings.html">
The basic settings you need to get going fast.</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/concepts/terms.html">
Terms & Definitions</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/concepts/faq.html">
FAQ's</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/concepts/troubleshooting.html">
Troubleshooting</a>
</li>
</ul>
</div>
<div class="middle_category">
<h3 class="sub_head">
Create your Content
</h3>
<ul>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/createcontent/sampledata.html">
Import 'Sample Data' for your Membership Program</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/createcontent/blueprint.html">
Create your Membership 'Blueprint'</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/createcontent/programs.html">
Create your 'Membership Programs'</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/createcontent/mcitems.html">
Create your 'Membership Content Items' (aka Lessons, Modules, or Sections)</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/createcontent/overviewpages.html">
Create your 'Membership Overview Page/s'</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/createcontent/supportingassets.html">
Create & Configure Supporting Assets</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/createcontent/settings.html">
Configuring the 'Settings'</a>
</li>
</ul>
</div>
<div class="right_category">
<h3 class="sub_head">
Hook it All Up
</h3>
<ul>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/hookitup/pilotpress.html">
Understanding PilotPress & Permission Levels</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/hookitup/releasetype.html">
Configuring your content for Standard or Drip Release</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/hookitup/showiftags.html">
Adding Show/If tags for redirect pages, to protect only parts of pages, & more</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/hookitup/sequences.html">
Membership Sequences in OfficeAutopilot</a>
</li>
<li class="category_li"><a class="fancybox fancybox-iframe" href="http://officeautopilot.com/mp/helpfiles/categories/hookitup/requestasample.html">
Request to get a sample Membership Content sequence created for you in your OfficeAutopilot Account</a>
</li>
</ul>
</div>
</div>
<div class="seperator">
<img src="<?php echo plugins_url(); ?>/membership-simplified-for-oap-members-only/images/seperator.png" />
</div>
<div class="help_bottom">
<div class="toolsandresources">
<h3 class="sub_head">
Helpful Tools & Resources
</h3>
<span class="help_text Myriad">
The following tools have been created to help you understand the big picture of a 'Membership Program' in addition to the mechanics behind them.
</span>
<div id="slider">
			<ul>				
				<li><a href="http://officeautopilot.com/mp/helpfiles/membershipsiteflowchart.pdf" target="_blank"><img src="http://officeautopilot.com/mp/helpfiles/images/membershipprogramoverview.png" alt="Membership Program Overview" /></a></li>
				
				<li><a href="http://officeautopilot.com/mp/helpfiles/dripmembershipdiagram.pdf" target="_blank"><img src="http://officeautopilot.com/mp/helpfiles/images/dripmembershipdiagram.png" alt="Drip Membership Flowchart" /></a></li>
				
				<li><a href="http://officeautopilot.com/mp/helpfiles/membershipplanningworksheet.pdf" target="_blank"><img src="http://officeautopilot.com/mp/helpfiles/images/membershipplanningguide.png" alt="Membership Planning Guide" /></a></li>
				
				<li><a href="http://officeautopilot.com/mp/helpfiles/membershipsimplified.pdf" target="_blank"><img src="http://officeautopilot.com/mp/helpfiles/images/membershipsimplified.png" alt="Membership, Simplified" /></a></li>
				
				<li><a href="http://officeautopilot.com/mp/helpfiles/howtocharge.pdf" target="_blank"><img src="http://officeautopilot.com/mp/helpfiles/images/howtocharge.png" alt="How to charge for access to your membership site" /></a></li>
			</ul>
</div>
</div>
<div class="documentation">
<h3 class="sub_head">
Further Documentation & Support
</h3>
<span class="help_text Myriad">
To get access to further documentation and support, feel free to use one of the options below.
</span>
<ul>
<li class="doc_li">
More Documentation<br />
<a href="http://support.officeautopilot.com" target="_blank">http://support.officeautopilot.com</a>
</li>
<li class="doc_li">
Live Chat<br />
<a href="http://www.officeautopilot.com" target="_blank">http://www.officeautopilot.com</a>
</li>
<li class="doc_li">
Support Ticket<br />
<a href="http://support.officeautopilot.com" target="_blank">http://support.officeautopilot.com</a>
</li>
<li class="doc_li">
Support Call<br />
<span class="babyblue">805.568.1424</span>
</li>
</ul>
</div>
</div>
</div>
<script>
jQuery(document).ready(function()
{
	jQuery.fn.buildContent = function()
	{
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
});
</script>