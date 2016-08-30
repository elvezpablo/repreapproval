<div class="sidebar-scroll">
  <div id="sidebar" class="nav-collapse collapse"> 
    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
    <div class="navbar-inverse">
      <form class="navbar-search visible-phone">
        <input type="text" class="search-query" placeholder="Search" />
      </form>
    </div>
    <!-- END RESPONSIVE QUICK SEARCH FORM --> 
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="sidebar-menu">
      <li class="sub-menu "> <a class="" href="dashboard.php" style="background:#93CE52 !important;font-weight:bold;"> <i class="icon-dashboard"></i> <span>DASHBOARD</span> </a> </li>
      <li class="sub-menu <?php if($page=='change-pwd.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-book"></i> <span>Account </span> <span class="arrow"></span> </a>
        <ul class="sub ">
          <li class=""><a class="" href="change-pwd.php">Account Details</a></li>
        </ul>
      </li>
      <li class="sub-menu <?php if($page=='menu.php' or $page=='submenu.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Menus</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="menu.php">Top Menus</a></li>
          <li><a class="" href="submenu.php">Sub Menus</a></li>
           <li><a class="" href="sub_submenu.php">Sub Sub Menus</a></li>
           </ul>
           </li>
      
      <li class="sub-menu <?php if($page=='style-one.php' or $page=='style-two.php' or $page=='default-rightcont.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Standard Pages</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="style-one.php">Style One Pages</a></li>
          <li><a class="" href="style-two.php">Style Two Pages</a></li>
          <li><a class="" href="default-rightcont.php" >Default Right Content</a></li>
           <li><a class="" href="instructions.pdf" target="_blank">CMS Instructions</a></li>
</ul>
           </li>
      
               
               <li class="sub-menu <?php if($page=='slider-images.php' or $page=='top-content.php' or $page=='why.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Homepage</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="slider-images.php">Home - Slider</a></li>
     <!--     <li><a class="" href="top-content.php">Home - 4 columns</a></li>-->
          <li><a class="" href="home-column1.php">Home - Column 1</a></li>
          <li><a class="" href="home-column3.php">Home - Column 2</a></li>
             <li><a class="" href="why.php">Home - Column 3</a></li>
       <li><a class="" href="home-screenshot.php">Home - Bottom screenshots</a></li>
           </ul>
           </li>
      <li>
        <a href="" style="background:#93CE52 !important;font-size: 12px;padding: 5px 15px;text-align: left;width: 150px;color:#fff;font-weight:bold;">
          <i class="icon-dashboard"></i>
          <span>ORIGINAL PAGES</span>
        </a>
      </li>
           
        <li class="sub-menu <?php if($page=='service-tab.php' or $page=='service-top-cont.php' or $page=='service-left-text.php' or $page=='service-right-img.php' or $page=='service-screenshot.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Services</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="service-top-cont.php">Services - At a glance</a></li>
          <li><a class="" href="service-left-text.php">Services - Left text</a></li>
          <li><a class="" href="service-right-img.php">Services - Right image</a></li>
          <li><a class="" href="service-screenshot.php">Services - Screenshots</a></li>
           <li><a class="" href="service-list.php">Services - List</a></li>
          <li><a class="" href="service-tab.php">Services - Tabs</a></li>

        </ul>
           </li>
           <li class="sub-menu <?php if($page=='testimonial.php' or $page=='testimonial-image.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Testimonials</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="testimonial.php">Testimonials</a></li>
          <li><a class="" href="testimonial-image.php">Right Image</a></li>
          
           </ul>
           </li>
           
           <li class="sub-menu <?php if($page=='gallery-tab.php' or $page=='gallery-image.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Manage Gallery</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="gallery-tab.php">Manage Categories</a></li>
          <li><a class="" href="gallery-image.php">Manage Images</a></li>
          
           </ul>
           </li>
           
               <li class="sub-menu <?php if($page=='faq-content.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>FAQ</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="faq-content.php">FAQ Content</a></li>
        
           </ul>
           </li>       
           <li class="sub-menu <?php if($page=='tour-content.php' or $page=='tour-image.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Take a Tour</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="tour-content.php">Left - Content</a></li>
          <li><a class="" href="tour-image.php">Right - Images</a></li>
          
           </ul>
           </li>
           
           <li class="sub-menu <?php if($page=='security-content.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Security Page</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="security-content.php">Security Content</a></li>
        
           </ul>
           </li>
           

           
           <li class="sub-menu <?php if($page=='qickleft-content.php' or $page=='qickright-content.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Quick Letters</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="qickleft-content.php">Left Content</a></li>
           <li><a class="" href="qickright-content.php">Right Content</a></li>
        
           </ul>
           </li>
           
           <li class="sub-menu <?php if($page=='eficientleft-content.php' or $page=='eficientright-content.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Efficient Letters</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="eficientleft-content.php">Left Content</a></li>
           <li><a class="" href="eficientright-content.php">Right Content</a></li>
        
           </ul>
           </li>
           
           <li class="sub-menu <?php if($page=='powerleft-content.php' or $page=='powerright-content.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Powerful Letters</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="powerleft-content.php">Left Content</a></li>
           <li><a class="" href="powerright-content.php">Right Content</a></li>
        
           </ul>
           </li>
           
           <li class="sub-menu <?php if($page=='aboutus-content.php' or $page=='about-bottom-cont.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>About Us</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="aboutus-content.php">About Us Content</a></li>
           <li><a class="" href="about-bottom-cont.php">Bottom Content</a></li>
        
           </ul>
           </li>
           
           <li class="sub-menu <?php if($page=='event-content.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Upcomming Events</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="event-content.php">Events Content</a></li>
           
        
           </ul>
           </li>
<li class="sub-menu <?php if($page=='stripe.php' or $page=='top-footer.php' or $page=='preview-img.php' or $page=='footer-cont.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Manage Footer</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="stripe.php">Bottom Images Strip</a></li>
           <li><a class="" href="top-footer.php">Top Footer </a></li>
           <li><a class="" href="preview-img.php">Previews Images </a></li>
        <li><a class="" href="footer-cont.php">Footer Content </a></li>
           </ul>
           </li>

        <li class="sub-menu <?php if($page=='manage_code.php') {?>active<?php }?>"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>Promo Codes</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="manage_code.php">Codes</a></li>
           
        
           </ul>
           </li>
           
      <li class="sub-menu" <?php if($page=='manage_lender.php' or $page=='manage_realtor.php' or $page=='manage_homebuyer.php') {?>active<?php }?>"> <a href="javascript:;" class="" style="background:#93CE52 !important;font-weight:bold;">
          <i class="icon-dashboard"></i><span>MEMBERSHIP</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub">
          <li><a class="" href="manage-resource.php">Manage Resources Page</a></li>
<li><a class="" href="manage_lender.php">Manage Lenders</a></li>
          <li><a class="" href="manage_realtor.php">Manage Realtors</a></li>
          <li><a class="" href="manage_homebuyer.php">Manage Home Buyers</a></li>

        </ul>
      </li>
      
      
        </ul>
    
      </li>
    </ul>
  
  </div>
</div>
