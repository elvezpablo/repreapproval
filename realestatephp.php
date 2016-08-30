<?php include("admin/config.php");
$pagename= basename($_SERVER['PHP_SELF']);
$PageInfo=mysql_fetch_assoc(mysql_query("select * from new_page where pagename='".$pagename."'"));
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo stripslashes($PageInfo['metatitle']); ?></title>
<meta name="description" content="<?php echo stripslashes($PageInfo['metadescription']); ?>">
<meta name="keywords" content="<?php echo stripslashes($PageInfo['metakeyword']); ?>">
<?php include("includes/head.php");?>
</head>       
<body>
<?php include_once("analyticstracking.php") ?>
<header> 
<?php include("includes/header.php");?>
</header>
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1><?php echo stripslashes($PageInfo['pagetitle']); ?></h1>
          <ol class="breadcrumb"><li class="active"><a href="<?php echo stripslashes($PageInfo['url']); ?>"><?php echo stripslashes($PageInfo['smallcontent']); ?></a></li>
          </ol>
        </div>  
      </div> 
    </div> 
  </div>
<div class="space20"></div>
<div class="container">
<div class="row">
<div class="col-md-8">

<p><b><?php echo stripslashes($PageInfo['pagesubtitle']); ?></b></p>
<?php echo stripslashes($PageInfo['content']); ?>
</div>
<div class="col-md-4">
<?php if($PageInfo['rightcontent']!=''){
	 echo stripslashes($PageInfo['rightcontent']);
} else {
	$DefaultContent=mysql_fetch_assoc(mysql_query("select * from default_right_cont where status='1'"));
	echo stripslashes($DefaultContent['content']);
	}?>
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