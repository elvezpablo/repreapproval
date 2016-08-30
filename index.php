<?php include('admin/config.php'); ?>
    <!DOCTYPE html>
    <!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
    <!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
    <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
    <!--[if (gte IE 9)|!(IE)]><!-->
    <html class="not-ie" lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>Get Your Real Estate Clients Pre Approved Online</title>
        <meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
        <meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
        <?php include("includes/head.php");?>
    </head>

    <body>
        <?php include_once("analyticstracking.php") ?>
            <header>
                <?php include("includes/header.php");?>
                <?php include("includes/slider.php"); ?>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Welcome to <b>RePreApproval</b>!</h1></div>
                </div>
            </div>
            <div class="space10"></div>
            <div class="container">
                <div class="row">
                    <?php
                      $selTopContent=mysql_query("select * from home_topcontent where status='1' order by order_id");
                      $i=0;
                      while($TopContent=mysql_fetch_assoc($selTopContent)) {
	                        $i++;
                    ?>
                        <div class="col-md-3">
                            <div class="service">
                                <h4><?php echo stripslashes($TopContent['title']); ?></h4>
                                <p>
                                    <?php echo stripslashes($TopContent['content']); ?>
                                </p>
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
                </div>
            </div>
            <div class="space20"></div>
            <div class="container">
                <div class="row">
                    <?php $selCol1=mysql_fetch_assoc(mysql_query("select * from home_column1 where status='1' order by order_id"));?>
                        <div class="col-md-3">
                            <!-- Client Says -->
                            <h5><?php echo stripslashes($selCol1['title']); ?></h5>
                            <div class="client-says">
                                <div class="client-text">
                                    <?php echo stripslashes($selCol1['content']); ?>
                                </div>
                                <div class="client-name">
                                    <i class="fa fa-quote-right"></i><strong><?php echo stripslashes($selCol1['text1']); ?></strong>
                                    <br>
                                    <?php echo stripslashes($selCol1['text2']); ?>
                                </div>
                            </div>
                            <!-- Client Says End -->
                            <div class="space40"></div>
                        </div>
                        <div class="col-md-6">
                            <!-- Progress Bar -->
                            <?php $SelCol3=mysql_fetch_assoc(mysql_query("select * from home_column3 where status='1' order by order_id"));?>
                                <h5><?php echo stripslashes($SelCol3['title']);?></h5>
                                <div class="progress-bar-shortcode">
                                    <?php echo stripslashes($SelCol3['content']);?>
                                </div>
                                <!-- Progress Bar End -->
                                <div class="space40"></div>
                        </div>
                        <div class="col-md-3">
                            <!-- Accordion -->
                            <h5>Why <b>RePreApproval</b>?</h5>
                            <div class="accordion" id="accordion2">
                                <?php $selWhy=mysql_query("select * from why_repreaproval where status='1' order by order_id");
	  $w=0;
	  while($Why=mysql_fetch_assoc($selWhy))
	  {
		  $w++;
	  ?>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne_<?php echo $w; ?>">
                                                <?php echo stripslashes($Why['title']) ?>
                                            </a>
                                        </div>
                                        <div id="collapseOne_<?php echo $w; ?>" class="accordion-body collapse <?php if($w==1){echo " ";} ?>">
                                            <div class="accordion-inner">
                                                <?php echo stripslashes($Why['content']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                            </div>
                            <!-- Accordion End -->
                            <div class="space40"></div>
                        </div>
                </div>
            </div>
            <div class="space20"></div>
            <div class="space10"></div>
            <div class="container">
                <div class="row">
                      <?php
                        $SelScreenshot=mysql_query("select * from  home_scrrenshot where status='1' order by order_id");
                        while($screenShot=mysql_fetch_assoc($SelScreenshot)) {
                      ?>
                        <div class="col-md-3 col-sm-6">

                            <div class="item-box">
                                <div class="media-container">
                                    <a href="<?php echo stripslashes($screenShot['url']) ?>"><img src="userfiles/<?php echo $screenShot['image'] ?>" class="img-responsive" alt="<?php echo stripslashes($screenShot['img_alt']) ?>" title="<?php echo stripslashes($screenShot['img_title']) ?>"></a>
                                </div>
                                <div class="info-container">
                                    <h3><?php echo stripslashes($screenShot['title']) ?></h3>
                                    <h4><?php echo stripslashes($screenShot['subtitle']) ?></h4>
                                    <p>
                                        <a href="<?php echo stripslashes($screenShot['url']) ?>">
                                            <?php echo stripslashes($screenShot['urltext']) ?> >></a>
                                    </p>
                                </div>
                            </div>
                            <div class="space40"></div>
                        </div>
                        <?php }?>
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
