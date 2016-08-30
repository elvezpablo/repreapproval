<!-- Parallax -->
<?php $SelectTopfoot=mysql_fetch_assoc(mysql_query("select * from top_footer where status='1'"));?>
  <div id="parallax-one" class="parallax" style="background-image:url(/userfiles/<?php echo stripslashes($SelectTopfoot['image']);?>);">
    <div class="footer-promo">
      <div class="container">
        <div class="row">
          <div class="col-md-12" style="background:#93CE52;border:1px solid #fff;">
            <h2><?php echo stripslashes($SelectTopfoot['title']);?></h2>
            <h4><?php echo stripslashes($SelectTopfoot['subtitle']);?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Parallax End -->
  <div class="footer-info">
    <div class="container">
      <div class="row">

        <div class="col-md-3 col-sm-6"><a class="twitter-timeline" href="https://twitter.com/repreapproval" data-widget-id="487747378162585601" data-chrome="nofooter" data-tweet-limit="1">Tweets by @RePreApproval</a></div>
        <div class="col-md-3 col-sm-6">
        <h6>Get Social</h6>
        <ul class="list-5">
            <li><a href="https://www.linkedin.com/company/repreapproval?trk=company_name"> LinkedIn </a></li>
            <li><a href="https://www.facebook.com/repreapproval"> Facebook </a></li>
            <li><a href="https://twitter.com/RePreApproval"> Twitter </a></li>
            <li><a href="https://plus.google.com/u/0/b/100117020883308068199/100117020883308068199/about"> Google+</a></li>
            <li><a href="https://www.youtube.com/user/repreapproval"> YouTube</a></li>
            <li><a href="https://www.vimeo.com/channels/repreapproval"> Vimeo</a></li>
        </ul>
        </div>
        <div class="col-md-3 col-sm-6">
        <h6>Quick Links</h6>
        <ul>
            <li><a href="/contact.php"> Contact </a></li>
            <li><a href="/signup.php"> Sign Up</a></li>
            <li><a href="/events.php"> Events</a></li>
            <li><a href="/faq.php"> FAQ</a></li>
            <li><a href="/tutorials.php"> Tutorials</a></li>
            <li><a href="/security.php"> Security</a></li>
        </ul>
        </div>
        <div class="col-md-3 col-sm-6">
          <h6>Previews of how it works</h6>
          <div class="flickr">
            <?php
              $SelPreview=mysql_query("select * from footer_preview where status='1' order by order_id");
  		        while($preview=mysql_fetch_assoc($SelPreview))
  		            {
  		      ?>
              <a href="<?php echo stripslashes($preview['url']);?>">
                <img src="/userfiles/<?php echo $preview['image'];?>" alt="<?php echo stripslashes($preview['img_alt']);?>" title="<?php echo stripslashes($preview['img_title']);?>">
              </a>
            <?php }?>
          </div>
          <div class="space30"></div>
        </div>
      </div>
    </div>
  </div>
