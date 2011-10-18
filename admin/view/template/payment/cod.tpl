<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td><input type="text" name="cod_total" value="<?php echo $cod_total; ?>" /></td>
          </tr>        
          <tr>
            <td><?php echo $entry_order_status; ?></td>
            <td><select name="cod_order_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $cod_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="cod_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $cod_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="cod_status">
                <?php if ($cod_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="cod_sort_order" value="<?php echo $cod_sort_order; ?>" size="1" /></td>
          </tr>
          
          <tr>
            <td><?php echo $entry_cod_limit; ?></td>
            <td><input type="text" name="cod_limit" value="<?php echo $cod_limit; ?>" /></td>            
          </tr>
                    
          <tr>
            <td><?php echo $entry_cod_last_date; ?></td>
            <td><input type="text" name="cod_last_date" value="<?php echo $cod_last_date; ?>" /></td>            
          </tr>
          
          <tr>
            <td><?php echo $entry_cod_current_value; ?></td>
            <td>
            	<input type="text" name="cod_current_value" value="<?php echo $cod_current_value; ?>" />
            	&nbsp; 
            	<label for="cod_reset_current_value_id">Reset Current Value</label>
            	<input type="checkbox" id="cod_reset_current_value_id" name="cod_reset_current_value"/>
            	
            </td>            
          </tr>
                    
          <tr>    
            <td><?php echo $entry_cod_limit_period; ?></td>
            <td><select name="cod_limit_period">
                <option value="daily" <?php if ($cod_limit_period == 'daily') echo 'selected="selected"';?> ><?php echo $entry_cod_limit_daily;?></option>
                <option value="weekly" <?php if ($cod_limit_period == 'weekly') echo 'selected="selected"';?> ><?php echo $entry_cod_limit_weekly;?></option>
                <option value="monthly" <?php if ($cod_limit_period == 'monthly') echo 'selected="selected"';?> ><?php echo $entry_cod_limit_monthly;?></option>
                </select></td>
          </tr>    
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 