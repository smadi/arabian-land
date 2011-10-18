<div class="buttons">
  <div class="right"><a id="button-confirm" class="button"><span><?php echo $button_confirm; ?></span></a></div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	
	$.ajax({ 
		type: 'GET',
		url: 'index.php?route=payment/cod/confirm',
		dataType: 'json',
		success: function(data) {						
			location = '<?php echo $continue; ?>';
		}		
	});
});

function orderComplete() {
	
}
//--></script>