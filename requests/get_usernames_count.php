<?php
if(isset($_POST['usernames']))
{
	$filename = "../" . $_POST['usernames'];
	// Open the file
	$fp = @fopen($filename, 'r'); 

	// Add each line to an array
	if ($fp) 
	{
		$usernames = explode("\n", fread($fp, filesize($filename)));
		echo count($usernames);
	}
	else
	{
		echo 0;
	}
}
?>