<?php include("admin/config.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>About RePreApproval</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="about repreapproval, how to have preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php");?>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<header>
<?php include("includes/header.php");?>
</header>
<?php $SelAboutContent=mysql_fetch_assoc(mysql_query("select * from about_us where status='1'"));

?>
<div class="breadcrumb-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><?php echo stripslashes($SelAboutContent['page_title']); ?></h1>
        <ol class="breadcrumb">
          <li class="active"><a href="/contact/">Contact us today!</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="space20"></div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4><?php echo stripslashes($SelAboutContent['page_sub_title']); ?></h4>
    </div>
  </div>
</div>

<div class="space20"></div>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <p><?php echo stripslashes($SelAboutContent['content']); ?>
      </p>
      <div class="space20"></div>
      <div class="divider"></div>
      <div class="space40"></div>

    </div>
    <div class="col-md-4">

      <!-- Client Says -->
      <div class="client-says">
        <div class="client-text">
            "<?php echo stripslashes($SelAboutContent['founder_msg']); ?>"
        </div>
        <div class="client-name">
          <i class="fa fa-quote-right"></i><strong>Tim Rangel</strong>, Founder
        </div>
      </div>
      <!-- Client Says End -->
      <div class="space40"></div>

    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4>We provide mortgage lenders and realtors with the latest tools for quick pre-approved letters.</h4>
    </div>
  </div>
</div>

<div class="space20"></div>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <?php $SelBottom=mysql_fetch_assoc(mysql_query("select * from about_bott_cont where status='1'"));?>
      <!-- Blockquote -->
      <blockquote>
        <h4><?php echo stripslashes($SelBottom['title']); ?></h4>
          <?php echo stripslashes($SelBottom['content']); ?>
      </blockquote>
      <!-- Blockquote End -->
      <div class="space40"></div>

    </div>
    <div class="col-md-6">

       <div class="item-box-2">
        <div class="media-container">
          <!--<img src="images/tim-rangel.jpg" alt="online pre approval letters for real estate">
          <a href="contact.php" class="icon-left"><i class="fa fa-chain"></i></a>-->
          <iframe class="repreapproval" width="600" height="427" src="<?php echo stripslashes($SelAboutContent['vedio']); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="info-container">
          <h3>Tim Rangel</h3>
          <h4>Founder</h4>
          <!--<div class="social-container">
            <div class="social-2">
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-google-plus"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
              <a href="#"><i class="fa fa-pinterest"></i></a>
            </div>
          </div>-->
        </div>
      </div>
      <div class="space40"></div>

    </div>
  </div>
</div>

<div class="space20"></div>


<div class="space40"></div>

<?php include("includes/strip.php");?>
<div class="space60"></div>
<footer class="footer">
<?php include("includes/topfooter.php");?>
<?php include("includes/footer.php");?>
</footer>
<?php include("includes/javascript.php");?>
</body>
</html>
