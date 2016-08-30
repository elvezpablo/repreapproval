<?php include("admin/config.php");
$pagename= basename($_SERVER['PHP_SELF']);
$PageInfo=mysql_fetch_assoc(mysql_query("select * from new_page1 where pagename='".$pagename."'"));
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php echo stripslashes($PageInfo['metatitle']); ?></title>
    <meta content="<?php echo stripslashes($PageInfo['metadescription']); ?>"
    name="description">
    <meta content="<?php echo stripslashes($PageInfo['metakeyword']); ?>" name=
    "keywords"><?php include("includes/head.php");?>
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
                    <h1>
                    <?php echo stripslashes($PageInfo['pagetitle']); ?></h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <a href=
                            "%3C?php%20echo%20stripslashes($PageInfo['url']);%20?%3E">
                            <?php echo stripslashes($PageInfo['smallcontent']); ?></a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="space20"></div>
    <div class="container">
        <div class="rowcol-md-12">
            <p>
              <b><?php echo stripslashes($PageInfo['pagesubtitle']); ?></b></p><?php echo stripslashes($PageInfo['content']); ?>
            </p>
        </div>
    </div>
    <div class="space40"></div>
    <div class="space60"></div>
    <footer class="footer">
        <?php include("includes/topfooter.php");?><?php include("includes/footer.php");?>
    </footer><?php include("includes/javascript.php");?>
</body>
</html>
