<?php 
include("config.php");
if(!empty($_SESSION['pin123']))
 {
  header("location:dashboard.php");
 }
$msg='';
if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Login')
 {
  $username=$_REQUEST['username'];
  $password=$_REQUEST['password'];
  //echo "select * from userthree where email ='".$username."' and password='".$password."' and accounttype='ADMIN'";die;
  $Select=mysql_query("select * from userthree where email ='".$username."' and password='".$password."' and accounttype='ADMIN'");
  $count=mysql_num_rows($Select);
  if($count>0)
   { 
	$result=mysql_fetch_assoc($Select);
	$_SESSION['pin123']=$result['email'];
	header("LOCATION:dashboard.php");
   }
  else
   {
	$msg='error';
	// header("location:index.php");
   }
}
?><!DOCTYPE html>
  <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
  <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
  <!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
  <!-- BEGIN HEAD -->
  <head>
	 <meta charset="utf-8" />
	 <title>Login</title>
	 <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	 <meta content="" name="description" />
	 <meta content="" name="author" />
	 <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	 <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	 <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	 <link href="css/style.css" rel="stylesheet" />
	 <link href="css/style-responsive.css" rel="stylesheet" />
	 <link href="css/style-default.css" rel="stylesheet" id="style_color" />
	  <script src="js/jquery-1.8.3.min.js"></script>
  </head>
  <script type="text/ecmascript">
  $(document).ready(function(){
  $('#submit').click(function(){
  var i=0;
  var username=$('#username').val();
  var password=$('#password').val();
  if(username=='')
  {
	  $('#username').addClass('error');
	  $('#username').attr('placeholder','Username');
	  i++;
  }
  if(password=='')
  {
	  $('#password').addClass('error');
	  $('#password').attr('placeholder','Password');
	  i++;
  }
  if(i>0)
  {
	  return false;
  }
  });
  $('.input').focus(function(){
	  $('#errormsg').hide();
	  id=this.id;
	  $('#'+id).val('');
	  $('#'+id).removeClass('error');
	  });
	  });
  </script>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body class="lock">
	  <div class="lock-header">
		  <!-- BEGIN LOGO -->
		  <a class="center" id="logo" href="../index.php">
			  <img class="center" alt="logo" src="../images/logo.png">
		  </a>
		  <!-- END LOGO -->
	  </div>
      
	  <div class="login-wrap">
      <?php if($msg!='') {?>
		  <div class="alert alert-error" id="errormsg">
		   <strong>Error!</strong> Either username or password is wrong.
			  </div>
			  <?php }?>
		  <div class="metro single-size red">
			  <div class="locked">
				  <i class="icon-lock"></i>
				  <span>Login</span>
			  </div>
		  </div>
		  <form action="index.php" method="post">
		  <div class="metro double-size green">
				  <div class="input-append lock-input">
					  <input type="text" class="input" placeholder="Email Id" name="username" id="username">
				  </div>
		  </div>
		  <div class="metro double-size yellow">
				  <div class="input-append lock-input">
					  <input type="password" class="input" placeholder="Password" name="password" id="password">
				  </div>
					  </div>
		  <div class="metro single-size terques login">
				  <button type="submit" class="btn login-btn" name="submit" id="submit" value="Login">
					  Login
					  <i class=" icon-long-arrow-right"></i>
				  </button>
			 		  </div> 
		  </form>  
		  <div class="login-footer">          
            <div class="forgot-hint pull-right">
                <a id="forget-password" class="" href="forgetpassword.php">Forgot Password?</a>
            </div>
        </div>
		  
	  </div>
  </body>
  <!-- END BODY -->
  <!-- Mirrored from thevectorlab.net/metrolab/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 10 Oct 2013 05:39:42 GMT -->
  </html>