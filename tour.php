<?php include('admin/config.php');?>
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
  <div class="breadcrumb-container">
  <?php $selTour=mysql_fetch_assoc(mysql_query("select * from take_tour where status='1'")); ?>
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1><?php echo stripslashes($selTour['title']); ?></h1>
          <ol class="breadcrumb"><li class="active">Learn about ReReApproval</li>
          </ol>
        </div>  
      </div> 
    </div> 
  </div>
<div class="space20"></div>
<div class="container">
<div class="row">
<div class="col-md-8">
<?php echo stripslashes($selTour['content']); ?>
<!--<h3>You'll wish someone had thought of this a long time ago.</h3>
<p>Keeping our PreApproved Pipeline fresh can be a challenge. <span class="letters">RePreApproval</span> will keep all your files fresh by alerting you, the loan officer, the realtor, and the buyer/client/borrower with PreApprovalRequests and expired credit approvals.</p>
<p><b>Automate What's Important!</b></p>
<p>Every Lender and Realtor knows the stress of being there for their clients when it's crunch time - when the bid is going in and every wants an "edge" for their clients to come out the winner. In today's heated seller's market, it's even more important that you have the tools necessary to separate your company from everyone else in the marketplace.</p>
<h3><span class="letters">RePreApproval</span> is one of those tools.</h3>
<p class="lenders" style="background:#93CE52;border:1px solid #888;padding:5px">All Access + Instant Customization + Precision = Offer Accepted.</p>
<p>Look at how it makes life easier for Realtors, Lenders and Clients:</p>
<h4>Benefits for Realtors:</h4>
<ul>
<li class="repre">Customized pre-approval letters makes it possible to negotiate from a stronger position, no need to show sellers how high you are willing to go!</li>
<li class="repre">Access to multiple letters for multiple offers keeping all offers automatically organized and in on time.</li>
<li class="repre">No nervous waiting for you and your clients while you try to contact the lender for a new pre-approval letter because another new bid came in AGAIN.</li>
<li class="repre">Offer your clients a service that they won't get from other Realtors.</li>
<li class="repre">Easy to use, so no fumbling or figuring out or special training required.</li>
</ul>
<h4>Benefits for Lenders:</h4>
<ul>
<li class="repre">No weekend or late night calls for another pre-approval letter.</li>
<li class="repre">Give your loan clients that extra service to get the deal done and get another loan closed for you.</li>
<li class="repre">Offer prospective borrowers a service that they won't get from other lenders, one that will help make them more successful homebuyers.</li>
<li class="repre">Offer a service to realtors that will help them close more deals too. (They'll love you for it and send more borrowers your way.)</li>
<li class="repre">Easy administrative interface makes it simple to offer this service.</li>
<li class="repre">Organized PreApproved client/borrower pipeline</li>
<li class="repre">Auto alerts - 30, 60, and 90 day check-up. Maintain client relations throughout their home purchasing experience, build a stronger relationship, close more deals, and get more referrals!</li>
</ul>-->
</div>
<div class="col-md-4">
<h3>Real Estate Innovation!</h3>
<?php $tourImage=mysql_query("select * from take_tour_img where status='1' order by order_id");
while($image=mysql_fetch_assoc($tourImage)){
 ?>
<p><img src="userfiles/<?php echo $image['image'] ?>" alt="<?php echo stripslashes($image['img_alt']) ?>" title="<?php echo stripslashes($image['img_title']) ?>" class="repreaaproval" /></p>
<?php }?>

<!--<p><img src="images/toolsforrealtors.jpg" alt="online preapproval letters" title="Helping lenders and realtors achieve their goals" class="repreaaproval" /></p>

<p><img src="images/real-estate-tools.jpg" alt="online mortgage preapproval letter" title="Tools for the professional lender and real estate agent" class="repreaaproval" /></p>-->
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