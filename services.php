<?php include('admin/config.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>RePreApproval Services</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
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
        <h1>Services at a glance</h1>
        <ol class="breadcrumb">
          <li class="active"><a href="signup.php">Get started today!</a></li>
        </ol>
      </div>  
    </div> 
  </div> 
</div>
<div class="space20"></div>
<!-- Service --> 
<div class="container">
  <div class="row">
<?php $selTopContent=mysql_query("select * from service_at_glance where status='1' order by order_id"); 
$i=0;
while($TopContent=mysql_fetch_assoc($selTopContent))
{
	$i++;
?>
    <div class="col-md-3">
      <div class="service">  
        <h4><?php echo stripslashes($TopContent['title']); ?></h4>
        <p><?php echo stripslashes($TopContent['content']); ?></p>
        <?php if($i==1) {?>
        <i class="fa fa-bullhorn"></i>
        <?php } else if($i==2){?>
         <i class="fa fa-signal"></i>
        <?php } else if($i==3){?>
        <i class="fa fa-magic"></i>
        <?php } else if($i==4){?>
         <i class="fa fa-trophy"></i>  
        <?php }?>
      </div>
      <div class="space40"></div>    
    </div> 
    <?php }?>
    <!--<div class="col-md-3">
      <div class="service">  
        <h4>Innovation</h4>
        <p>Our online portal is one of the kind and has been trademarked. There is no other website available that will provide you this quick, instant and powerful tool.</p>
        <i class="fa fa-bullhorn"></i>
      </div>
      <div class="space40"></div>    
    </div> 
      
    <div class="col-md-3">
      <div class="service">  
        <h4>Competitive</h4>
        <p>Mortgage lenders and real estate agents continually have to look for new tools and products that will set them apart from the thousands of other realtors.</p>
        <i class="fa fa-signal"></i>
      </div>  
      <div class="space40"></div>   
    </div> 
  
    <div class="col-md-3">
      <div class="service">  
        <h4>Instant</h4>
        <p>Time is of the essence when it comes to making an offer on a house. With our on-the-spot approval letter editor you can match the offer amount and print and share letters 24/7/365.</p>
        <i class="fa fa-magic"></i>
      </div>  
      <div class="space40"></div>   
    </div> 
        
    <div class="col-md-3">
      <div class="service">  
        <h4>Development</h4>
        <p>We are continually developing new tools for lenders and realtors to give you the winning advantage you need in this competitive real estate market.</p>
        <i class="fa fa-trophy"></i>   
      </div>  
      <div class="space40"></div>   
    </div> -->
      
  </div>
</div> 
<!-- Service End --> 

<!-- Modern Box -->         
<div class="container">  
  <div class="row space10"></div>
  <?php $Sellefttext=mysql_fetch_assoc(mysql_query("select * from service_left_con where status='1' order by order_id"));?>
  <div class="row modern-box">
    <div class="col-md-6 center">
      <h2><?php echo stripslashes($Sellefttext['text']);?></strong></h2>
      <a href="<?php echo stripslashes($Sellefttext['url']);?>"><button class="btn"><?php echo stripslashes($Sellefttext['url_text']);?></button></a>
      <div class="row space40"></div>
    </div>
    <div class="col-md-6">
    <?php $RightImage=mysql_fetch_assoc(mysql_query("select * from service_right_img where status='1'"));?>
      <img src="userfiles/<?php echo $RightImage['image']?>" alt="<?php echo stripslashes($RightImage['img_alt']);?>" title="<?php echo stripslashes($RightImage['img_title']);?>">
    </div>
  </div> 
  <div class="row space60"></div>
</div>                            
<!-- Modern Box End --> 

<div class="container">  
  <div class="row">  
    <div class="col-md-12">
      <h4>Screenshots of how RePreApproval works:</h4>   
    </div>  
  </div> 
</div>     

<!-- Recent Works -->
<div class="container popup-gallery">
  <div class="row">
<?php 

$SelScreenshot=mysql_query("select * from service_screenshot where status='1' order by order_id");
while($screenShot=mysql_fetch_assoc($SelScreenshot))
{
?>
    <article class="col-md-3 col-sm-3 boxed-project">
      <div class="img-container">
        <!-- Item Link -->  
        <a href="userfiles/<?php echo $screenShot['image'] ?>" title="<?php echo $screenShot['img_title'] ?>">
          <!-- Image -->
          <img src="userfiles/<?php echo $screenShot['image'] ?>" alt="<?php echo $screenShot['img_alt'] ?>">
          <!-- Icon -->  
          <i class="fa fa-arrows-alt"></i>
        </a>
        <!-- Item Link End -->          
      </div>
      <div class="title">
        <h4><?php echo $screenShot['title'] ?></h4>
        <h6><?php echo $screenShot['subtitle'] ?></h6>
      </div>
    </article> 
    <?php }?>
    
 
  </div>
</div> 
<!-- Recent Works End -->

<div class="space40"></div>
  
<div class="container">
  <div class="row">
    <div class="col-md-6">
      
      <!-- List -->
      <?php $ServiceList=mysql_fetch_assoc(mysql_query("select * from service_list where status='1'"));
	  echo stripslashes($ServiceList['content']);
	  ?>
<!--<ul class="list-3">
<li><a href="#"><i class="fa fa-arrow-right"></i> We offer an incredible new tools for mortgage lenders.</a></li>
<li><a href="#"><i class="fa fa-arrow-right"></i> Realtors are able to take control of the buying process.</a></li>
<li><a href="#"><i class="fa fa-arrow-right"></i> Home buyers have a higher success rate with their offers.</a></li>
<li><a href="#"><i class="fa fa-arrow-right"></i> There is no other online products like ours available.</a></li>
<li><a href="#"><i class="fa fa-arrow-right"></i> We are committed to continually develop our products.</a></li>
</ul>-->
      <!-- List End -->
      <div class="space20"></div>
      <div class="divider"></div>
      <div class="space40"></div>
        
    </div>  
    <div class="col-md-6">
      <!-- Tabs -->
      <div class="tabbable">
        <ul class="nav nav-tabs">
        <?php $Seltitle=mysql_query("select title from service_tab where status='1' order by order_id");
		$t=0;
		while($title=mysql_fetch_assoc($Seltitle))
		{
			$t++;
		?>
          <li class="<?php if($t==1) {echo "active";}?>"><a href="#tab1-<?php echo $t;?>" data-toggle="tab"><i class="fa fa-pencil"></i><?php echo stripslashes($title['title']); ?></a></li>
         <?php }?> 
        </ul>
        <div class="tab-content">
        <?php
		$SelContent=mysql_query("select content from service_tab where status='1' order by order_id");
		$c=0;
		while($content=mysql_fetch_assoc($SelContent))
		{
			$c++;
		 ?>
          <div class="tab-pane <?php if($c==1){echo "active";} ?>" id="tab1-<?php echo $c; ?>">
           <?php echo stripslashes($content['content']); ?>
          </div>
          
          <?php }?>
        </div>
      </div>
      <!-- Tabs End -->
      <div class="space40"></div>
        
    </div>     
  </div>
</div>       
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