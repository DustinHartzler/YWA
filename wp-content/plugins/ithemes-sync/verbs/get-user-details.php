<?php

/*
Implementation of the get-user-details verb.
Written by Chris Jean for iThemes.com
Version 1.0.0

Version History
	1.0.0 - 2014-06-02 - Chris Jean
		Initial version
*/


class Ithemes_Sync_Verb_Get_User_Details extends Ithemes_Sync_Verb {
	public static $name = 'get-user-details';
	public static $description = 'Retrieve details about the site\'s users.';
	public static $status_element_name = 'users';
	public static $show_in_status_by_default = false;
	
	private $default_arguments = array(
		'args' => array(),
	);
	
	
	public function run( $arguments ) {
		$arguments = Ithemes_Sync_Functions::merge_defaults( $arguments, $this->default_arguments );
		
		$users = get_users( $arguments['args'] );
		
		return $users;
	}
}
