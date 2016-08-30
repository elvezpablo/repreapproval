<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->

<header>
  <?php include("includes/header.php");?>
</header>
<div class="breadcrumb-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Password Recovery Assistance</h1><!--<ol class="breadcrumb"><li class="active">Quick, efficient and powerful!</li>-->
      </div>
    </div>
  </div>
</div>
<div class="space20"></div>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="login">
        <form action='' method='post'>
          <div style="float:left;width:100px;">
            <label><span>Username</span><br>
            <br>
            <label><span><i>OR</i> Email</span><br>
            <br></label></label>
          </div><label></label>
          <div>
            <label><input id='log' name='log' placeholder='Enter your username' size='50' type='text' value=''><span class='et_protected_icon'></span></label><br>
            <br>
            <input id='pwd' name='pwd' placeholder='Or your password' size='50' type='password'><span class='et_protected_icon et_protected_password'></span><br>
            <br>
            <input class='btn btn-primary' name='submit' type='submit' value='Recover my password'>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-4">
      <p><img alt="online preapproval from lender" class="repreaaproval" src="images/repreapprovalsecurity.jpg" title="ReReApproval - Realestate Innovation"></p>
    </div>
  </div>
</div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer">
  <?php include("includes/topfooter.php");?>
  <?php include("includes/footer.php");?>
  <?php include("includes/javascript.php");?>
  <?php include_once("analyticstracking.php") ?>
</footer>
