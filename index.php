<?php
if( !(isset($_GET['a'])) )
{
    header("Location: index.php?a=check");
}
else
{
    if($_GET['a'] != "check" and $_GET['a'] != "register")
        header("Location: index.php?a=check");
}
include "header.php";
include "functions.php";
?>

<!-- Top content -->
<div class="top-content">
	
    <div class="inner-bg">
        <div class="container">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" style="text-transform: uppercase;" href="index.php?a=checker">Instagram</a>
                </div>
                <ul class="nav navbar-nav">
                  <li><a href="index.php?a=check" >CHECKER</a></li>
                  <li><a href="index.php?a=register">REGISTER</a></li>
                </ul>
              </div>
            </nav>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1>
                        <?php echo strtoupper($_GET['a']); ?>
                    </h1>
                </div>
            </div>
            
            <div class="row">

                <div class="col-sm-12">
                	
                	<div class="form-box">
                		<div class="form-top">
                    		<div class="form-top-left">
                    			<h3 style="padding-top: 12px;
                                           font-size: 50px;
                                           text-transform: uppercase;"><?php echo $_GET['a']; ?> now
                                </h3>
                    		</div>
                    		<div class="form-top-right">
                    			<i class="fa fa-instagram"></i>
                    		</div>
                        </div>
                        <div class="form-bottom">
                            <div id="load-bar"></div>
                            <span id="usernames-count"></span>
                            <br>
                            <span id="valid-usernames-count"></span>
		                    <?php main($_GET['a']) ?>
	                    </div>
                	</div>
                	
                </div>
            </div>
            
        </div>
    </div>
    
</div>

<?php
include "footer.php";
?>

