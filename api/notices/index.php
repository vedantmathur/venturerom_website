<?php

$noticefile = 'notice';

if (file_exists($noticefile)) {
	$lines = file($noticefile);
	$numlines = count($lines);
	$numnotices = $numlines / 3;
	for($i=0;$i<$numlines;$i++)
	{
		$notice_priority = preg_replace('/priority : /', '', trim(preg_replace('/\s\s+/', ' ', array_shift($lines))));
		$notice_date = preg_replace('/date : /', '', trim(preg_replace('/\s\s+/', ' ', array_shift($lines))));
		$notice_data = preg_replace('/notice : /', '', trim(preg_replace('/\s\s+/', ' ', array_shift($lines))));
		$json_Array[] = array('priority'=>$notice_priority,'date'=>$notice_date,'notice'=>$notice_data);
		$i++;
		$i++;
	}
	header('Content-type: application/json');
	echo("{\"notices\":\"" . $numnotices . "\",\"data\":" . json_encode($json_Array, JSON_UNESCAPED_SLASHES) . "}");
} else {
	echo json_encode('null');
}
?>
