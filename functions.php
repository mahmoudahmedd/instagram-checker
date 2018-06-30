<?php
function main($value)
{
	if($value == "register")
		register();
	else if ($value == "check") 
		check();
}

function check()
{
	$res = "
			<form role='form' action='' method='post' class='registration-form'>
                <div class='form-group'>
                    <label class='sr-only' for='form-about-yourself'>List All User Names.</label>
                    <textarea name='usernames' 
                    		  placeholder='List All User Names.' 
                              class='form-about-yourself form-control' 
                              id='form-about-yourself'></textarea>
                </div>
                <div class='form-check checkbox-info-filled'>
                        <input type='checkbox' id='checkbox17' name='checkbox' class='filled-in form-check-input' checked=''>
                        <label class='form-check-label' for='checkbox17'>Show details</label>
                </div>
                <button type='submit' class='btn'>Check now!</button>

            </form>
			";
	if(isset($_POST['usernames']))
	{

		$username = explode("\r\n", htmlentities($_POST['usernames']));
		$v        = "";
		$arrayName = array();
		
		$login    = curl_init(); 

		curl_setopt($login, CURLOPT_URL, "https://www.instagram.com/accounts/web_create_ajax/attempt/"); 
		curl_setopt($login, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($login, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($login, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($login, CURLOPT_HTTPHEADER, array(
		'Host: www.instagram.com',
		'X-CSRFToken: EJMrAsTOEi1SKiZLHzNf2RMBEZTQkI9I',
		'X-Instagram-AJAX: 1',
		'X-Requested-With: XMLHttpRequest',
		'Referer: https://www.instagram.com/',
		'Cookie: csrftoken=EJMrAsTOEi1SKiZLHzNf2RMBEZTQkI9I;'
		));
		curl_setopt($login, CURLOPT_HEADER, 0);
		curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

		foreach($username as $username)
		{	
			curl_setopt($login, CURLOPT_POSTFIELDS, "username=$username");

			$response = curl_exec($login);


			if (isset($_POST["checkbox"])) 
			{
				echo "<pre>";
				print_r($response);
				echo "</pre>";
			}

			if(eregi("This username isn't available. Please try another.", $response))
			{
				$v.= "<center>
						<font color='red'>
							$username (This username isn't available)<br>
						</font>
					  </center>";
			}
			else if (eregi("This field is required.", $response)) 
			{
				$v.= "<center>
						<font color='red'>
							username (This field is required.)<br>
						</font>
					  </center>";
			}
			else if(eregi("can only use letters, numbers, underscores and periods.",$response))
			{
				$v.= "<center>
						<font color='red'>
							$username (Can only use letters, numbers, underscores and periods.)<br>
						</font>
					  </center>";
			}
			else if(eregi("Please wait a few minutes before you try again.", $response))
			{
				$v.= "<center>
						<font color='blue'>
							$username (Please wait a few minutes before you try again.)<br>
						</font>
					  </center>";
			}
			else
			{
				$v.= "<center>
						<font color='green'>
							$username (Available)<br>
						</font>
					  </center>";
					  
				$arrayName[] = $username;
			}

		} 
		curl_close($login);
		echo "Number of valid usernames: " . count($arrayName) . "<br>";
		echo $v;
		$fichier = fopen("Valid users.txt", "a+");  
		for($i = 0;$i < count($arrayName);$i++)
		{

			fputs($fichier, "$arrayName[$i]".PHP_EOL); 
		} 
 		fclose($fichier);  
	}			
	echo $res;
}

function register()
{
	$res = "
			<form role='form' action='' method='post' class='registration-form'>
                <div class='form-group'>
            		<label class='sr-only' for='form-first-name'>First name</label>
                	<input type='text' name='file_name' value='Valid users.txt' class='form-first-name form-control' id='form-first-name'>
                </div>
                <div class='form-check checkbox-info-filled'>
                        <input type='checkbox' id='checkbox17' name='checkbox' class='filled-in form-check-input' checked=''>
                        <label class='form-check-label' for='checkbox17'>Show details</label>
                </div>
                <button type='submit' class='btn'>Register now!</button>

            </form>
			";
	if(isset($_POST['file_name']))
	{
		$filename = $_POST['file_name'];
		$arrayName = array();
		

		// Open the file
		$fp = @fopen($filename, 'r'); 

		// Add each line to an array
		if($fp) 
		{

			$array = explode("\n", fread($fp, filesize($filename)));

			$v = "";
			
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

			foreach($array as $username)
			{
				$username = $username;
				$password = "012345678910";
				$email    = $username."5"."@gmail.com";
				$name     = "test".$username;
				curl_setopt($instagram, CURLOPT_POSTFIELDS, "email=$email&password=$password&username=$username&first_name=$name");
				

				$response = curl_exec($instagram);

				if (isset($_POST["checkbox"])) 
				{
					echo "<pre>";
					print_r($response);
					echo "</pre>";
				}

				if(eregi("\"account_created\": false", $response))
				{
					$v .= "<center>
						<font color='red'>
							ERROR<br>
						</font>
					  </center>";
				}
				else
				{
					$v.= "<center>
						<font color='green'>
							GOOD<br>
						</font>
					  </center>";
					$arrayName[] = $username . "  " . $email . "  " . $password;
				}
			}
			curl_close($instagram);
			echo $v;
			$fichier = fopen("Valid registerings.txt", "a+");  
			for($i = 0;$i < count($arrayName);$i++)
			{
				fputs($fichier, "$arrayName[$i]".PHP_EOL); 
			} 
	 		fclose($fichier);  

		}

	}			
	echo $res;
}




?>
