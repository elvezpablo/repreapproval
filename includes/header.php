<script>
jQuery(document).ready(function(){
	jQuery("#btn_li").click(function() {
		 var articleUrl = encodeURIComponent('http://www.repreapproval.com');
	     var articleTitle = encodeURIComponent('Meduim');
	     var articleSummary = encodeURIComponent('');
	     var articleSource = encodeURIComponent('Medium');
	     var goto = 'http://www.linkedin.com/shareArticle?mini=true'+
	         '&url='+articleUrl+
	         '&title='+articleTitle+
	         '&summary='+articleSummary+
	         '&source='+articleSource;
	     window.open(goto, "LinkedIn", "width=660,height=400,scrollbars=no;resizable=no");
	   return false;
	  });
});
// twitter
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="top-container">
				<a href="index.php" class="logo" title="Home"><img src="/images/logo2.png " alt="online pre approval letters for real estate" title="welcome to RePreApproval!"></a>
				<ul class="top-items">

						<div class="social-top social-6">
							<a href="contact.php" title="Contact our support Team"><i class="fa fa-envelope"></i></a>
							<a class="gl" title="Share RePreapproval in google" onclick="window.open('https://plus.google.com/share?url=http://www.repreapproval.com', 'Google-share-dialog', 'width=626,height=436'); return false;" href="#"><i class="fa fa-google-plus"></i></a>
							<a class="lin" title="Share RePreapproval in LinkedIn" id="btn_li" href="#"><i class="fa fa-linkedin"></i></a>
							<a class="tw" onclick="window.open('https://twitter.com/share', 'Twitter-share-dialog', 'width=626,height=436'); return false;" href="#" data-via="RePreapproval" title="Share RePreapproval in Twitter"><i class="fa fa-twitter"></i></a>
							<a class="fb" href="#" title="Share RePreapproval in facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;"><i class="fa fa-facebook"></i></a>
						</div>

					<li class="red">
						<i class="fa fa-envelope-o"></i><a href="mailto:admin@repreapproval.com" class="red">admin@repreapproval.com</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- Nav -->

<nav class="navbar" role="navigation">
<div class="navbar-inner">
<div class="container">
<!-- Menu -->
<ul class="nav navbar-nav" id="nav">
<?php $SelMenu=mysql_query("select * from main_menu where status='1' order by order_id");
while($menu=mysql_fetch_assoc($SelMenu))
{
$selSubmenuforarray=mysql_query("select url from sub_menu where main_menu_id='".$menu['id']."' and status='1' order by order_id");
$pagearray=array();
while($pagename=mysql_fetch_assoc($selSubmenuforarray))
{
$pagearray[]=$pagename['url'];
}
?><li class="<?php if(in_array($page,$pagearray) or $page==$menu['link']) {echo "selected";}?>"><a href="/<?php echo $menu['link'] ?>"><?php echo stripslashes($menu['menu']) ?></a>
<?php
$selSubmenu=mysql_query("select * from sub_menu where main_menu_id='".$menu['id']."' and status='1' order by order_id");
$CountSubmenu=mysql_num_rows($selSubmenu);
if($CountSubmenu>0)
{
?><ul><?php
while($submenu=mysql_fetch_assoc($selSubmenu)){
?><li><a href="<?php echo $submenu['url'] ?>"><?php echo stripslashes($submenu['sub_menu']) ?></a><?php
$SelSubsubmenu=mysql_query("select * from sub_sub_menu where sub_menu_id='".$submenu['id']."' and status='1' order by order_id");
$SubsubCount=mysql_num_rows($SelSubsubmenu);
if($SubsubCount>0)
{
?><ul><?php
while($subsubmenu=mysql_fetch_assoc($SelSubsubmenu)){
?><li><a href="/<?php echo $subsubmenu['url'] ?>"><?php echo $subsubmenu['sub_sub_menu'] ?></a></li><?php
}
?></ul><?php
}
?></li><?php
}
?>
</ul><?php
}
?></li><?php
}
?>

<?php if(isset($_SESSION['logge'])) { ?>
	<li class="<?php if($page=='logout.php') {echo "selected";}?>">
		<a href="/logout.php">Log Out</a>
	</li>
  <li class="<?php if($page=='lenderdashboard.php') {echo "selected";}?>">
		<a href="/lenderdashboard.php">Back to Dashboard</a>
	</li>
<?php } elseif(isset($_SESSION['REAL_VEER'])) { ?>
  <li class="<?php if($page=='logout.php') {echo "selected";}?>">
		<a href="/logout.php">Log Out</a>
	</li>
  <li class="<?php if($page=='realtordashboard.php') {echo "selected";}?>">
		<a href="/realtordashboard.php">Back to Dashboard</a>
	</li>
<?php } elseif(isset($_SESSION['BUY_SANT'])) { ?>
	<li class="<?php if($page=='logout.php') {echo "selected";}?>">
		<a href="/logout.php">Log Out</a>
	</li>
  <li class="<?php if($page=='lenderdashboard.php') {echo "selected";}?>">
		<a href="/lenderdashboard.php">Back to Dashboard</a>
	</li>
<?php } else { ?>
	<li class="<?php if($page=='signup.php') {echo "selected";}?>"><a href="/signup.php">
   <span style="border-bottom:3px solid #045D92">Sign up!</span></a></li>
   <li class="<?php if($page=='login.php') {echo "selected";}?>"><a href="/login.php">Login</a></li>
<?php } ?>
</ul>
<!-- Menu End -->
</div>
</div>
</nav>
<!-- Nav End -->
