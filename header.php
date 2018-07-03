<!DOCTYPE html>
<html lang="en">

    <head>
        <script type="text/javascript">
            function postUsernames() {
                var usernames = $('#usernames').val();
                if(usernames.length > 0)
                {
                    $("#load-bar").html('<div class="preloader preloader-center"></div>');
                
               
                    $.ajax({
                        type:  "POST",
                        url:   "/requests/post_usernames.php",
                        data:  "usernames="+usernames, 
                        cache: false,
                        success: function(html) {
                            if(html != '0')
                            {
                                $("#load-bar").html("<center><font color='green'>Done!</font></center>");
                                $("#valid-usernames-count").html("The number of valid usernames: " + html);
                            }
                            else
                            {
                                $("#load-bar").html("<center><font color='red'>Error!</font></center>");
                                $("#valid-usernames-count").html("Please... Enter the name of the list (e.g. test.txt)");
                            }
                            
                        }
                    });
                }
                else
                {
                    $("#load-bar").html('');
                    $("#valid-usernames-count").html('');
                }
            }

            function registerUsernames() {
                var usernames = $('#usernames').val();
                if(usernames.length > 0)
                {
                    $("#load-bar").html('<div class="preloader preloader-center"></div>');
                
               
                    $.ajax({
                        type:  "POST",
                        url:   "/requests/register_usernames.php",
                        data:  "usernames="+usernames, 
                        cache: false,
                        success: function(html) {
                            if(html != '0')
                            {
                                $("#load-bar").html("<center><font color='green'>Done!</font></center>");
                                $("#valid-usernames-count").html("The number of valid usernames: " + html);
                            }
                            else
                            {
                                $("#load-bar").html("<center><font color='red'>Error!</font></center>");
                                $("#valid-usernames-count").html("Please... Enter the name of the list (e.g. test.txt)");
                            }
                            
                        }
                    });
                }
                else
                {
                    $("#load-bar").html('');
                    $("#valid-usernames-count").html('');
                }
            }
            
            function getCount() {
                var usernames = $('#usernames').val();
                $.ajax({
                    type:  "POST",
                    url:   "/requests/get_usernames_count.php",
                    data:  "usernames="+usernames, 
                    cache: false,
                    success: function(html) {
                        if(usernames.length > 0 &&  html != '0')
                        {
                            $("#usernames-count").html("The number of usernames in list: " + html);
                        }
                        else
                        {
                            $("#usernames-count").html("");
                        }
                    }
                });
            }
        </script>
 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Instagram</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
    </head>

    <body>