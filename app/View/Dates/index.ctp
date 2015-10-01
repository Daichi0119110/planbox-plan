
<?php foreach($dates as $date) { ?>
<p>
	<li><?php echo $date['Date']['name']; ?></li>
	<li>いいね数→<span id="favo_<?php echo h($date['Date']['id']); ?>"><?php echo $date['Date']['favo']; ?></span></li>
	<li>View数→<?php echo $date['Date']['num_view']; ?></li>
	<button id="button_<?php echo h($date['Date']['id']); ?>" class="favo" data-date-id="<?php echo $date['Date']['id']?>">行きたい！</button>
</p>
<?php } ?>

<script>
$(function() {
	$.post('/planbox-plan/favorites/ready/',
		{'user_id':1}
		,function(res){
			$.each(res,function(){
				$('#button_'+this).html('登録済み！');	
			});
		}, "json");

	$('button.favo').click(function(e){
		$.post('/planbox-plan/favorites/change/',
			{'date_id':$(this).data('date-id'), 'user_id':1}
			,function(res){
				if($('#button_'+res.id).html() == "行きたい！"){
					$('#button_'+res.id).html('登録済み！');
				} else{
					$('#button_'+res.id).html('行きたい！');
				}
				$('#favo_'+res.id).html(res.favo);
		}, "json");
	});
});
</script>