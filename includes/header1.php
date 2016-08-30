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
</script>
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="top-container">
<a href="index.php" class="logo" title="Home"><img src="images/logo2.png " alt="online pre approval letters for real estate" title="welcome to RePreApproval!"></a>                     
<ul class="top-items">
<li><i class="fa fa-phone"></i>Phone: 1-800-000-0000</li>
<li class="red"><i class="fa fa-envelope-o"></i><a href="mailto:info@repreapproval.com" class="red">info@repreapproval.com</a></li>
</ul>
</div>
</div> 
</div> 
</div> 
<!-- Nav -->
<?php $page= basename($_SERVER['PHP_SELF']); ?>
<nav class="navbar" role="navigation">
<div class="navbar-inner">
<div class="container">     
<!-- Menu -->
<ul class="nav navbar-nav" id="nav">
<?php $SelMenu=mysql_query("select * from main_menu where status='1' order by order_id");
while($menu=mysql_fetch_assoc($SelMenu))
{
$selSubmenuforarray=mysql_query("select url from sub_menu where main_menu_id='3' and status='1' order by order_id");
$pagearray=array();
while($pagename=mysql_fetch_assoc($selSubmenuforarray))
{
$pagearray[]=$pagename['url'];
}
	
?>
<li class="<?php if(in_array($page,$pagearray)) {echo "selected";}?>"><a href="<?php echo $menu['link'] ?>"><?php echo stripslashes($menu['menu']) ?></a>
<?php
$selSubmenu=mysql_query("select * from sub_menu where main_menu_id='".$menu['id']."' and status='1' order by order_id"); 
$CountSubmenu=mysql_num_rows($selSubmenu); 
if($CountSubmenu>0)
{
?>
<ul>
<?php while($submenu=mysql_fetch_assoc($selSubmenu)) {?>
<li><a href="<?php echo $submenu['url'] ?>"><?php echo stripslashes($submenu['sub_menu']) ?></a></li>
<?php }?>
<!--<li><a href="security.php">About security</a></li>
<li><a href="faq.php">FAQ</a></li>
<li><a href="quickpreapprovalletters.php">Quick Letters</a></li>
<li><a href="efficientpreapprovalletters.php">Efficient Letters</a></li>
<li><a href="powerfulpreapprovalletters.php">Powerful Letters</a></li> --> 
</ul>
<?php }?>
</li>
 <?php }?>
<?php
if(isset($_SESSION['logge']))
 {
   ?><li class="<?php if($page=='logout.php') {echo "selected";}?>"><a href="logout.php">Log Out</a></li>
  <li class="<?php if($page=='lenderdashboard.php') {echo "selected";}?>"><a href="lenderdashboard.php">Back to Dashboard</a></li>
  <?php
 }

elseif(isset($_SESSION['REAL_VEER']))
 {
   ?><li class="<?php if($page=='logout.php') {echo "selected";}?>"><a href="logout.php">Log Out</a></li>
  <li class="<?php if($page=='realtordashboard.php') {echo "selected";}?>"><a href="realtordashboard.php">Back to Dashboard</a></li>
  <?php
 }

elseif(isset($_SESSION['BUY_SANT']))
 {
   ?><li class="<?php if($page=='logout.php') {echo "selected";}?>"><a href="logout.php">Log Out</a></li>
  <li class="<?php if($page=='lenderdashboard.php') {echo "selected";}?>"><a href="lenderdashboard.php">Back to Dashboard</a></li>
  <?php
 }

else
 {
   ?><li class="<?php if($page=='signup.php') {echo "selected";}?>"><a href="signup.php">
   <span style="border-bottom:3px solid #045D92">Sign up!</span></a></li>
   <li class="<?php if($page=='login.php') {echo "selected";}?>"><a href="login.php">Login</a></li>
   
   <li><a href="">Miscellaneous Coder Pages</a>
<ul>
<li><a href="signup.php">LENDERS</a>
<ul>
<li><a href="signup.php">1- LE Register</a></li>
<li><a href="plans.php">2- LE Plans</a></li>
<li><a href="emailtext.php#uponregistration">3- LE Registration Email</a></li>
<li><a href="lenderdashboard.php">4- LE Dashboard</a></li>
<li><a href="login.php">5- LE Login</a></li>
<li><a href="forget.php">6- LE Password Recovery</a></li>
<li><a href="passwordsent.php">7- LE Password Sent</a></li>  
<li><a href="emailtext.php#password">8- LE Password Email</a></li>
<li><a href="addletter.php">9- LE Adding a letter</a></li>
<li><a href="letterbasic.php">10- LE Letter Format Basic</a></li>
<li><a href="letterexpert.php">11- LE Letter Format Expert</a></li>
</ul>
</li>

<li><a href="">REALTORS</a>
<ul>
<li><a href="realtordashboard.php">1- RE Dashboard</a></li>
<li><a href="">2- RE</a></li>
<li><a href="">3- RE</a></li>
<li><a href="">4- RE</a></li>
</ul>
</li> 
 

  
</ul>
</li>
<?php
 }
?></ul>
<!-- Menu End -->     
<!-- Social Top --> 
<div class="social-top social-6">
<a href="contact.php" title="Contact our support Team"><i class="fa fa-envelope"></i></a>
<!--<a href="#"><i class="fa fa-google-plus"></i></a>
<a href="#"><i class="fa fa-linkedin"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-facebook"></i></a>-->
<a class="gl" title="Share RePreapproval in google" onclick="window.open('https://plus.google.com/share?url=http://www.repreapproval.com', 'Google-share-dialog', 'width=626,height=436'); return false;" href="#"><i class="fa fa-google-plus"></i></a>


<a class="lin" title="Share RePreapproval in LinkedIn" id="btn_li" href="#"><i class="fa fa-linkedin"></i></a>


<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> 

<a class="tw" onclick="window.open('https://twitter.com/share', 'Twitter-share-dialog', 'width=626,height=436'); return false;" href="#" data-via="RePreapproval" title="Share RePreapproval in Twitter"><i class="fa fa-twitter"></i></a>

<a class="fb" href="#" title="Share RePreapproval in facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;"><i class="fa fa-facebook"></i></a>

</div>  
<!-- Social Top End -->  
</div> 
</div>  
</nav>
<!-- Nav End -->