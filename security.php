<?php include('admin/config.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Tour RePreApproval - Get Your Real Estate Clients Pre Approved Online</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php");?>
</head>       
<body>
<?php include_once("analyticstracking.php") ?>
<header> 
<?php include("includes/header.php");?>
</header>
<?php $SecurityCont=mysql_fetch_assoc(mysql_query("select * from security_cont where status='1'")); ?>
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1><?php echo stripslashes($SecurityCont['page_title']); ?></h1>
          <!--<ol class="breadcrumb"><li class="active">Quick, efficient and powerful!</li>-->
          </ol>
        </div>  
      </div> 
    </div> 
  </div>
<div class="space20"></div>
<div class="container">
<div class="row">
<div class="col-md-8">
<?php echo stripslashes($SecurityCont['page_content']); ?>
</div>
<div class="col-md-4">
<p><img src="userfiles/<?php echo stripslashes($SecurityCont['image']); ?>" alt="<?php echo stripslashes($SecurityCont['img_alt']); ?>" title="<?php echo stripslashes($SecurityCont['img_title']); ?>" class="repreaaproval" /></p>
</div>          
</div> 
</div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer">
<?php include("includes/topfooter.php");?>
<?php include("includes/footer.php");?>  
</footer>     
<?php include("includes/javascript.php");?>  
</body>
</html>   