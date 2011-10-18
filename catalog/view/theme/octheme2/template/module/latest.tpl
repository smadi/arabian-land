<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <div class="mprice"><div class="prick"><?php echo $product['price']; ?></div></div>
		 <?php } else { ?>
          <div class="mprice2"><div class="prick"><span class="price-new"><?php echo $product['special']; ?></span></div></div>
		  <?php } ?>
        </div>
        <?php } ?>
		   <a class="mcart" onclick="addToCart('<?php echo $product['product_id']; ?>');" title="<?php echo $button_cart; ?>" ></a><a class="minfo" href="<?php echo $product['href']; ?>" title="More Info" ></a>
        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
