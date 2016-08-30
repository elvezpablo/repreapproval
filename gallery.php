<?php include('admin/config.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<title>RePreApproval Photo Gallery</title>
<meta name="description" content="RePreApproval's phot gallery showing events, screenshots and more">
<meta name="keywords" content="preapproval system for realtors, repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
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
<h1>Projects</h1>
<ol class="breadcrumb"><li class="active"><a href="signup.php">Get started today!</a></li></ol>
</div>  
</div> 
</div> 
</div>
<div class="space20"></div>
<div id="gallery" class="gallery">
<div class="container">
<div class="row">
      <div class="col-md-12">
  		  <ul id="portfolio-filter">
          <li class="act"><a href="#" class="filter" data-filter="*">All</a></li>
          <?php $SelTab=mysql_query("select * from gallery_tab where status='1' order by order_id ");
		  $t=0;
		  while($Tab=mysql_fetch_assoc($SelTab))
		  {
			  $t++;
		  ?>
          <li ><a href="#" class="filter" data-filter=".filter_<?php echo $Tab['id'];?>"><?php echo stripslashes($Tab['tabname']);?></a></li>
          <?php }?>
  			 <!-- <li><a href="#" class="filter" data-filter=".screenshots">Screenshots</a></li>
  			  <li><a href="#" class="filter" data-filter=".events">Events</a></li> 
          <li><a href="#" class="filter" data-filter=".news">News</a></li> 
          <li><a href="#" class="filter" data-filter=".clients">Clients</a></li>              
          <li><a href="#" class="filter" data-filter=".other">Other</a></li>-->
  		  </ul>                    
      </div> 
    </div>
<section id="portfolio-items">            
      <ul class="row portfolio popup-gallery">   
<?php $SelGallery=mysql_query("select * from gallery_image where status='1' order by order_id");
while($Gallery=mysql_fetch_assoc( $SelGallery))
{
?>
        <li> 
          <article class="col-md-3 col-sm-4 col-xs-6 project" data-tags="<?php echo $Gallery['image_cat'];?>">
            <div class="container-image">
                            <img src="userfiles/<?php echo $Gallery['image'];?>" alt="<?php echo stripslashes($Gallery['img_alt']);?>">
					    <a href="userfiles/<?php echo $Gallery['image'];?>" title="<?php echo stripslashes($Gallery['img_title']);?>">
                <i class="fa fa-search"></i>
              </a>
            </div>
          </article>
                  </li> 
                  <?php }?>
            
     
      </ul>              
    </section>
  </div>
</div> 
<div class="space60"></div>
<footer class="footer">
<?php include("includes/topfooter.php");?>
<?php include("includes/footer.php");?>  
</footer>     
<?php include("includes/javascript.php");?>  
</body>
</html>   