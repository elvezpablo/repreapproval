<div id="header" class="navbar navbar-inverse navbar-fixed-top">
   <div class="navbar-inner">
       <div class="container-fluid">
           <div class="sidebar-toggle-box hidden-phone">
               <div class="icon-reorder tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
           </div>
           <a class="brand" href="../index.php" target="_blank">
               <img src="../images/logo.png" alt="Metro Lab" />
           </a>
           <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="arrow"></span>
           </a>
           <?php  $result = mysql_fetch_assoc(mysql_query("select * from userthree where accounttype='ADMIN'")); ?>
           <div class="top-nav ">
               <ul class="nav pull-right top-menu" >
                   <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <img src="img/avatar1_small.jpg" alt="">
                           <span class="username"><?php echo $result['email']; ?></span>
                           <b class="caret"></b>
                       </a>
                       <ul class="dropdown-menu extended logout">
                           <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
                       </ul>
                   </li>
               </ul>
           </div>
       </div>
   </div>
</div>
