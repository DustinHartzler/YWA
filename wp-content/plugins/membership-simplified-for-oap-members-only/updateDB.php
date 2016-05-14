<?php
require_once("../../../wp-config.php");

global $wpdb;
$table_name = $wpdb->prefix . "download_listing";
$media_table_name = $wpdb->prefix . "media_listing";			
$action = $_POST['action'];
$updateRecordsArray = $_POST['recordsArray'];
$mediaupdateRecordsArray = $_POST['mediaRecordsArray'];

if($_POST['action'] == 'caltempwth') 
{
	update_option("template_width",$_POST['tempwidth']);
}

if ($action == "updateRecordsListings") 
{
	$listingCounter = 1;
	
	foreach ($updateRecordsArray as $recordIDValue) 
	{
		$query = "UPDATE $table_name SET recordListingID = " . $listingCounter . " WHERE recordID = " . $recordIDValue;
		$wpdb->query($query) or die('Error, update query failed');	
		$listingCounter = $listingCounter + 1;	
	}
	
	$output = '<pre>' . $updateRecordsArray . '</pre>If you refresh the page, you will see that records will stay just as you modified.';
	echo $output;

}

if($action == 'delete') 
{
	$upload_base_dir = wp_upload_dir();
	$upload_dir =  $upload_base_dir['basedir'];
	$path= $upload_dir.'/membership-simplified-for-oap-members-only/';

	$fileName = $wpdb->get_row("select fileName from $table_name where recordId= ".$_POST['recordId']."");
	@unlink($path.$fileName->fileName);

	$query= "delete from $table_name where recordId= '".$_POST['recordId']."' "; 
	$wpdb->query($query) or die('Error, delete query failed');	
}

if ($action == "media_updateRecordsListings")
{
	$listingCounter = 1;
	foreach ($mediaupdateRecordsArray as $recordIDValue) 
	{
     	$query = "UPDATE $media_table_name SET recordListingID = " . $listingCounter . " WHERE recordID = " . $recordIDValue;
     	$wpdb->query($query) or die('Error, update query failed');
		// mysql_query($query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;
	}

	$output = '<pre>' . $updateRecordsArray . '</pre>If you refresh the page, you will see that records will stay just as you modified.';
	echo $output;
}

if($action == 'delete_media')
{
	$upload_base_dir = wp_upload_dir();
	$upload_dir = $upload_base_dir['basedir'];
	$path = $upload_dir.'/membership-simplified-for-oap-members-only/';
	$fileName = $wpdb->get_row("select fileName from $media_table_name where recordId= ".$_POST['recordId']."");
	//@unlink($path.$fileName->fileName);
	$query= "delete from $media_table_name where recordId= '".$_POST['recordID']."' ";
	
	
	$wpdb->query($query) or die('Error, delete query failed');
}

if($action == 'caltempwth')
{
	update_option("template_width",$_POST['tempwidth']);
}