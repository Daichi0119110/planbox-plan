<button id="button_follow" class="follow" data-couple-id="<?php echo $date['Date']['couple_id']?>">フォロー！</button>

<script>
$(function() {
	$.post('/planbox-plan/follows/ready/',
		{'user_id':1, 'couple_id':$('#button_follow').data('couple-id')}
		,function(res){
			if(res == 1){
				$('#button_follow').html('登録済み');
			}
		}, "json");

	$('button.follow').click(function(e){
		$.post('/planbox-plan/follows/change/',
			{'user_id':1, 'couple_id':$('#button_follow').data('couple-id')}
			,function(res){
				if($('#button_follow').html() == "フォロー！"){
					$('#button_follow').html('登録済み');
				} else{
					$('#button_follow').html('フォロー！');
				}
		}, "json");
	});
});
</script>