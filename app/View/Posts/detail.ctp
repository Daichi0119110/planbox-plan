<h2>デートプラン詳細</h2>

<h3><?php echo $date[0]['Date']['name']; ?>　<span id="favo"><?php echo $favo; ?></span>行きたい！</h3>
<button class="favo" data-date-id="<?php echo $date_id; ?>">行きたい！</button>
<?php foreach($posts as $post) { ?>
<p>
	<li><?php echo $post['Post']['content']; ?></li>
	<li><?php echo $post['Post']['location']; ?></li>
	<li><?php echo $post['Post']['created']; ?></li>
</p>
<?php } ?>

<script>
$(function() {
	$.post('/planbox-plan/favorites/post_detail/',
		{'user_id':1, 'date_id':$('button').data('date-id')}
		,function(res){
			if(res == 1){
				$('button').css('color', 'red');
				$('button').html('登録済み！');
			}	
		}, "json");

	$('button.favo').click(function(e){
		$.post('/planbox-plan/favorites/change/',
			{'user_id':1, 'date_id':$('button').data('date-id')}
			,function(res){
				if($('button').html() == "行きたい！"){
					$('button').css('color', 'red');
					$('button').html('登録済み！');
				} else{
					$('button').css('color', 'black');
					$('button').html('行きたい！');
				}
				$('#favo').html(res.favo);
		}, "json");
	});
});
</script>