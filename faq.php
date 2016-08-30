<?php include('admin/config.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>RePreApproval FAQ</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval faq, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
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
          <h1>Frequently Asked Questions</h1>
          <ol class="breadcrumb">
            <li class="active"><a href="/contact/">Email us if you have additional questions</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
<div class="space20"></div>
  <!-- Accordion -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="accordion" id="accordion2">
        <?php $selFaq=mysql_query("select * from faq where status='1' order by order_id");
		$i=0;
		while($Faq=mysql_fetch_assoc($selFaq))
		{
			$i++;
		?>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne_<?php echo $i; ?>"><?php echo stripslashes($Faq['quest']) ?></a>
            </div>
            <div id="collapseOne_<?php echo $i; ?>" class="accordion-body collapse <?php if($i==1) {?>in<?php }?>">
              <div class="accordion-inner">
<?php echo stripslashes($Faq['ans']) ?>
              </div>
            </div>
          </div>
          <?php }?>

       </div>

      </div>
    </div>
  </div>
  <!-- Accordion End -->
<div class="space60"></div>
</div>
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
