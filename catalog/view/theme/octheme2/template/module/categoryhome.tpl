<div class="box">
<div class="box-heading"><?php echo $heading_title; ?></div>
<div class="box-content">
<div class="box-product">
  
<?php foreach ($categoryhome as $categoryhome) { ?>
<div>
      <div class="image"><a href="<?php echo $categoryhome['href']; ?>"><img src="<?php echo $categoryhome['thumb']; ?>" width="100" height="100" title="<?php echo $categoryhome['name']; ?>" alt="<?php echo $categoryhome['name']; ?>" /></a></div>
      <div class="name"><a href="<?php echo $categoryhome['href']; ?>"><?php echo $categoryhome['name']; ?></a></div>
</div>
<?php } ?>
</div>
</div>
</div>