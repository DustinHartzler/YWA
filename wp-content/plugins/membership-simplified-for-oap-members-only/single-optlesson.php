<?php get_header(); ?>
<?php
if($customcss) {
echo '<style>'; 
echo stripslashes($customcss); 
echo '</style>';}
?>
<style>
	    #launchheader{<?php echo ($membershipheaderheight) ? "height:".$membershipheaderheight."px" : ""; ?>;background-image:url(<?php echo $membershipheader; ?>);margin:0px auto;}
	.launchheaderlogo{background-position:<?php echo $logo_align; ?> center;background-image:url(<?php echo $membershiplogo; ?>);<?php echo ($membershipheaderheight) ? "height:".$membershipheaderheight."px" : ""; ?>;width:977px;background-repeat:no-repeat;}
#headertext{<?php echo ($membershipheaderheight) ? "line-height:".$membershipheaderheight."px" : ""; ?>;text-align:center;width:977px;<?php echo ($membershipheaderheight) ? "height:".$membershipheaderheight."px" : ""; ?>;font-size:<?php echo ($postcustom['_launchpage_headertextsize']) ? $postcustom['_launchpage_headertextsize'][0].'px' : '48px'; ?>;letter-spacing:-2px;font-weight:normal;}
#headerfullwidth{<?php echo ($membershipheaderbg) ? "background-image:url(".$membershipheaderbg.");" : ""; ?>margin:0px auto;}
.menu LI { display:inline-block; }
#access UL.sub-menu { width: 250px; position: absolute; left: auto !important; top: auto !important; }
</style>
<div id="headerfullwidth">
	<div id="launchheader"<?php echo ($postcustom['_launchpage_showheaderhyperlink']) ? ' onclick="location.href=\''.$postcustom['_launchpage_headerhyperlink'][0].'\';" style="cursor: pointer;"' : ''; ?>>
	<?php echo ($postcustom['_launchpage_showlogo']) ? '<div class="launchheaderlogo"></div>' : ''; ?>
	<?php echo ($postcustom['_launchpage_headertext']) ? '<div id="headertext">'.stripslashes($postcustom['_launchpage_headertext'][0]).'</div>' : ''; ?>
	</div>
</div>
<!--close headerfullwidth-->
<div id="membersnavbarbk">
<div id="membersnavbar">
<div id="access" style="float:left;">
<?php wp_nav_menu( array('menu' => 'Membership Menu' )); ?>
</div>
</div>
</div>
<?php oapMediaOrText();?>
<?php get_footer(); ?>