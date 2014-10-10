<?php

function formatSizeUnits($bytes)
{
	if ($bytes >= 1073741824) { $bytes = number_format($bytes / 1073741824, 2) . ' GB'; }
	elseif ($bytes >= 1048576) { $bytes = number_format($bytes / 1048576, 2) . ' MB'; }
	elseif ($bytes >= 1024) { $bytes = number_format($bytes / 1024, 2) . ' KB'; }
	elseif ($bytes > 1) { $bytes = $bytes . ' bytes'; }
	elseif ($bytes == 1) { $bytes = $bytes . ' byte'; }
	else { $bytes = '0 bytes'; }
	return $bytes;
}

$device = $_REQUEST['device'];

	$devicedir = "/srv/http/venturerom.com/get.venturerom.com/" . $device . "/";
	if (file_exists($devicedir)) {
	$webRoot = "http://get.venturerom.com/" . $device;

	$json_array = array();

	// Open a known directory, and proceed to read its contents
	foreach (glob("$devicedir/*.zip") as $file) {
		$filename = basename($file);

		if ($device == "m8") {
			$filesubversion = preg_replace('/m8/', '', $filename);
			$fileversion = preg_replace('#\D#', '', $filesubversion);
		} elseif ($device == "i9100") { 
			$fileversion = preg_replace('/i9100/', '', $filename);
			$fileversion = preg_replace('#\D#', '', $fileversion);
		} else {
			$fileversion = preg_replace('#\D#', '', $filename);
		}

		$filesize = formatSizeUnits(filesize($file));

		$turl = $webRoot. "/" . $filename;
		$url = str_replace('\/', "/", $turl);
		//echo($url);

		//get date on which each folder was created.
		// $fileDate = date("mdY", filectime($file));   

		$filesum = md5_file($file);

		$json_Array[] = array('name'=>$filename,'version'=>$fileversion,'size'=>$filesize,'url'=>$url,'md5'=>$filesum);

	}

	header('Content-type: application/json');
	echo("{\"device\":\"" . $device . "\",\"updates\":" . json_encode($json_Array, JSON_UNESCAPED_SLASHES) . "}");
} else {
	header('Content-type: application/json');
	echo("{\"error\":\"This device doesn't exist\"}");
}	
?>
