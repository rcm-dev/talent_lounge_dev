<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/uploads'; // Relative to the root


// php image manipulation
require_once('../phpimage/php_image_magician.php');

// require database connection
require_once('../recruitment/Connections/conJobsPerak.php');


$current_emp = mysql_real_escape_string($_GET['current_emp']);



if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$name = strtolower(str_replace(" ", "-", $_FILES['Filedata']['name']));
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $name;
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {

		// upload 1st to get file in folder
		move_uploaded_file($tempFile,$targetFile);

		// get image from upload
		$magicianObj = new imageLib('../../uploads/'.$name);

		// thumbnail size
		$magicianObj -> resizeImage(160, 160, array('crop', 'tr'), true);

		// move image to directory
		$magicianObj -> saveImage('../../uploads/160x160-'.$name, 100);

		$thumb = '160x160-'.$name;


		/****************************
		 *
		 * Record Set for InsertMediaPicture 
		 * MySQL Info 
		 * Table Used InsertMediaPicture
		 *
		 ***************************/
		
		$query_rsInsertMediaPicture = "INSERT INTO emp_media (emp_m_id, emp_m_media, media_thumb, emp_m_type, emp_usr_id_fk)
										VALUES ('', '$name', '$thumb', 'photo', '$current_emp')";
		$result_rsInsertMediaPicture = mysql_query($query_rsInsertMediaPicture);
	
		if ($result_rsInsertMediaPicture) {
			echo "Done";
		} else {
			echo mysql_error();
		}


	} else {
		echo 'Invalid file type.';
	}
}
?>