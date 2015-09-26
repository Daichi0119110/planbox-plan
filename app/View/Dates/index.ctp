
<?php foreach($dates as $date) { ?>
<p>
	<li><?php echo $date['Date']['name'].'/いいね数→'.$date['Date']['favo']; ?></li>
	<button id="<?php echo h($date['Date']['id']); ?>" class="favo" data-date-id="<?php echo $date['Date']['id']?>">行きたい！</button>
</p>
<?php } ?>

<script>
$(function() {
	$.post('/planbox-plan/favorites/ready/',
		{'user_id':1}
		,function(res){
			$.each(res,function(){
				$('#'+this).css('color', 'red');
				$('#'+this).html('登録済み！');	
			});
		}, "json");

	$('button.favo').click(function(e){
		$.post('/planbox-plan/favorites/plus/',
			{'date_id':$(this).data('date-id'), 'user_id':1}
			,function(res){
				if($('#'+res.id).html() == "行きたい！"){
					$('#'+res.id).css('color', 'red');
					$('#'+res.id).html('登録済み！');
				} else{
					$('#'+res.id).css('color', 'black');
					$('#'+res.id).html('行きたい！');
				}
		}, "json");
	});
});
</script>