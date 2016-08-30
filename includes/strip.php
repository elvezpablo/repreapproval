<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="partners-6">
        <?php $SelStripe=mysql_query("select * from stripe_img where status='1' order by order_id");
  	     while($tripe=mysql_fetch_assoc($SelStripe)) {
        ?>
          <li>
            <img src="/userfiles/<?php echo $tripe['image']?>" alt="<?php echo stripslashes($tripe['img_alt'])?>" title="<?php echo stripslashes($tripe['img_title'])?>">
          </li>
        <?php }?>
      </ul>
    </div>
  </div>
</div>
