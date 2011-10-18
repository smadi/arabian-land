<div id="marquee">
  <?php if ($marquees) { ?>
    <table class="marquee" cellpadding="0" cellspacing="0">
      <tr>
        <th><?php echo $text_marquee; ?></th>
        <td><ul class="marquee">
            <?php foreach ($marquees as $marquee) { ?>
            <li><?php echo $marquee['description']; ?></li>
            <?php } ?>
          </ul></td>
      </tr>
    </table>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$(document).ready(function (){
	$('.marquee').marquee({
		yScroll:        '<?php echo $scrolling; ?>',
		showSpeed:      <?php echo $show_speed; ?>,
		scrollSpeed:    <?php echo $scroll_speed; ?>,
		pauseSpeed:     <?php echo $pause_speed; ?>
	});
});
//--></script>
