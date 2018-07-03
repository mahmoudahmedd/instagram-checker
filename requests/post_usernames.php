<?php
function check($string)
{
	if(preg_match('/^[a-zA-Z0-9.]{3,30}$/',$string))
		return true;
	else
		return false;
}
if(isset($_POST['usernames']))
{
	$filename = "../" . $_POST['usernames'];
	// Open the file
	$fp = @fopen($filename, 'r'); 

	// Add each line to an array
	if ($fp) 
	{
		$usernames = explode("\r\n", fread($fp, filesize($filename)));

		$arrayName = array();

		$login     = curl_init(); 

		curl_setopt($login, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($login, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($login, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($login, CURLOPT_HTTPHEADER, array(
		'Host: www.instagram.com',
		'X-CSRFToken: EJMrAsTOEi1SKiZLHzNf2RMBEZTQkI9I',
		'X-Instagram-AJAX: 1',
		'X-Requested-With: XMLHttpRequest',
		'Referer: https://www.instagram.com/',
		'Cookie: mid=Wzhq1AAEAAHvZOXWDNdi94Wm000h; mcd=3; csrftoken=ipimaOE3UpEM7Y0XwU9IXlpwaIL8DRVm; shbid=11635; ds_user_id=5693111879; sessionid=IGSC393a7c95740c7b1fd159a40af7cf264373c7b5f7fa98064b802a61d2fa211d8b%3AOmcY1v8e9xAcPyyzBxySj5MyVZ6waLBz%3A%7B%22_auth_user_id%22%3A5693111879%2C%22_auth_user_backend%22%3A%22accounts.backends.CaseInsensitiveModelBackend%22%2C%22_auth_user_hash%22%3A%22%22%2C%22_platform%22%3A4%2C%22_token_ver%22%3A2%2C%22_token%22%3A%225693111879%3A6KiVHqQqAim2Xs5WQh4IenLIDw6gJDX7%3A25dc75c9d30dfd041e05df8e53e6257a6645bfa522fb6dbd3c3ea1559ff60ab5%22%2C%22last_refreshed%22%3A1530425265.0537343025%7D; rur=ATN; shbts=1530425300.549505; urlgen="{\"time\": 1530424282\054 \"156.194.53.163\": 8452}:1fZVX2:efFTyylQ1Ak_6Qd2Xl6bZY5eabU"'
		));
		curl_setopt($login, CURLOPT_HEADER, 0);
		curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		

		for($i = 0;$i < count($usernames);$i++)
		{
			if(!check($usernames[$i]))
				continue;
			if(is_numeric($usernames[$i]))
				continue;

			$url = "https://www.instagram.com/".$usernames[$i]."/?__a=1";

			curl_setopt($login, CURLOPT_URL, $url); 

			$response = curl_exec($login);
			$pos = strpos($response, "profilePage_");


			if($pos === false)
				$arrayName[] = $usernames[$i];	  

		} 
		curl_close($login);

		$fichier = fopen("../Valid users.txt", "a+");  
		for($i = 0;$i < count($arrayName);$i++)
		{
			if(($i + 1) == count($arrayName))
				fputs($fichier, "$arrayName[$i]");
			else 
				fputs($fichier, "$arrayName[$i]".PHP_EOL);
		} 
		fclose($fichier);  
	 	echo count($arrayName);
	}	
	else
	{
		echo 0;	
	}		
}
?>