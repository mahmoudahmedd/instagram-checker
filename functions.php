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
			<div  class='registration-form'>
                <div class='form-group'>
                    <label class='sr-only' for='form-about-yourself'>Name of the list (e.g. test.txt)</label>
                    <input 
                    		  type='text'
                    		  name='usernames' 
                    		  placeholder='Name of the list (e.g. test.txt)' 
                              class='form-about-yourself form-control' 
                              id='usernames'></input>
                </div>
                <button  onclick='postUsernames();getCount();' class='btn'>Check now!</button>
            </div>
			";
	
	echo $res;
}

function register()
{
	$res = "
			<div  class='registration-form'>
                <div class='form-group'>
                    <label class='sr-only' for='form-about-yourself'>Name of the list (e.g. Valid users.txt)</label>
                    <input 
                    		  type='text'
                    		  name='usernames' 
                    		  placeholder='Name of the list (e.g. Valid users.txt)' 
                    		  value='Valid users.txt'
                              class='form-about-yourself form-control' 
                              id='usernames'></input>
                </div>
                <button  onclick='registerUsernames();' class='btn'>Register now!</button>
            </div>
			";
	echo $res;
}
?>
