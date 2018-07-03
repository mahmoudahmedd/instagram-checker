<?php
if(isset($_POST['usernames']))
{
	$filename = "../" . $_POST['usernames'];
	
	// Open the file
	$fp = @fopen($filename, 'r'); 

	// Add each line to an array
	if($fp) 
	{
		$usernames = explode("\r\n", fread($fp, filesize($filename)));
		$fichier = fopen("../Final data.txt", "a+");  

		
		$instagram = curl_init(); 
		curl_setopt($instagram, CURLOPT_URL, "https://www.instagram.com/accounts/web_create_ajax/"); 
		curl_setopt($instagram, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($instagram, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($instagram, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($instagram, CURLOPT_HTTPHEADER, array(
		'Host: www.instagram.com',
		'X-CSRFToken: cQuttWAy94U2Hw9y7fak8dAjRFnhVqNA',
		'X-Instagram-AJAX: 1',
		'X-Requested-With: XMLHttpRequest',
		'Referer: https://www.instagram.com/',
		'Cookie: mid=WzTsdwAEAAHFK94v1VilHk3fItRi; shbid=11635; rur=ATN; mcd=3; fbm_124024574287414=base_domain=.instagram.com; csrftoken=cQuttWAy94U2Hw9y7fak8dAjRFnhVqNA;'
		));
		curl_setopt($instagram, CURLOPT_HEADER, 0);
		curl_setopt($instagram, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

		foreach($usernames as $username)
		{
			$username = $username;
			$password = "012345678910";
			$email    = $username."5dsxzxcxfbvcnbmkjh"."@gmail.com";
			$name     = "test".$username;
			curl_setopt($instagram, CURLOPT_POSTFIELDS, "email=$email&password=$password&username=$username&first_name=$name");
			

			$response = curl_exec($instagram);
			$pos      = strpos($response, '"account_created": true');

			if($pos == true)
			{
				fputs($fichier, "$username".PHP_EOL);
				fputs($fichier, "$password".PHP_EOL);
				fputs($fichier, "$email".PHP_EOL);
				fputs($fichier, "####################".PHP_EOL);
			}

			echo "<pre>";
			print_r($response);
			echo "</pre>";

			sleep(2);
		}
		curl_close($instagram);
		fclose($fichier);  
	}
	else
	{
		echo 0;
	}
}			
?>