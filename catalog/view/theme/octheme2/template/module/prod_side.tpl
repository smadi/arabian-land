<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content2">
  <table class="prodside">
        <?php foreach ($products as $product) { ?>
        <tr>
	    <td>      
	    <a  href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a><br />
        <?php if ($product['price']) { ?>
		<span style="font-weight: bold; color: #444;">
        <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span style="color: #ff0000; text-decoration:line-through;"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?></span>
        <?php } ?>
        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
        </td>
        <td>
        <?php if ($product['thumb']) { ?>
        <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" width="40" height="40" style="border: 1px solid #DBDEE1;" alt="<?php echo $product['name']; ?>" /></a>
        <?php } ?></td>
        </tr>
       <?php } ?>
</table>
</div>
</div>
