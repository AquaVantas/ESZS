<?php

	//gets the database we'll be working with
	require_once("../../Internal/editors_database.php");
		
	if(isset($_GET['user'])) {
		//delete previous roles
		editors::deleteAdminRoles($_GET['user']);

		//adding user roles to the last person added
		foreach(editors::getAdminRoles() as $role) {
			if(isset($_POST[strtolower(str_replace(" ", "_", $role["title"]))])) {
				editors::addRolesToAdmin($_GET['user'], $role['role_id']);
			}		
		}	
	}

	header('Location:../../cpanel.php?tab=user_list');
?>