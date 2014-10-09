<?php
/*
PekeUpload
Copyright (c) 2013 Pedro Molina
*/

// Define a destination
$targetDevice = $_POST['data'];
$targetFolder = '/srv/http/venturerom.com/get.venturerom.com/' . $targetDevice; // Relative to the root


if (!empty($_FILES)) {
	$tempFile = $_FILES['file']['tmp_name'];
	$targetPath = $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','zip','apk'); // File extensions
	$fileParts = pathinfo($_FILES['file']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo "File successfully uploaded: " . $_FILES['file']['name'];
	} else {
		echo 'Invalid file type.';
	}
}
?>