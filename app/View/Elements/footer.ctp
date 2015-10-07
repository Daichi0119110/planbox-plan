<nav class="navbar navbar-default navbar-fixed-bottom">
    <ol class="nav navbar-nav list-inline">
      <li style="margin: 0 50px 0 350px;"><button id="button_favo" type="button" class="btn btn-warning btn-lg" data-date-id="<?php echo $date[0]['Date']['id']; ?>">行きたい！</button></li>
      <li style="margin: 0 400px 0 0;" id="favo_num"></li>
      <li><button id="button_follow" type="button_favo" class="btn btn-warning btn-lg">フォロー</button></li>
    </ol>
</nav>

<script>
$(function() {
	$.post('/planbox-plan/favorites/ready/',
		{'user_id':1}
		,function(res){
			$.each(res,function(){
				$('#button_'+this).html('登録済み！');	
			});
		}, "json");

	$('#button_favo').click(function(e){
		$.post('/planbox-plan/favorites/change/',
			{'date_id':$(this).data('date-id'), 'user_id':1}
			,function(res){
				if($('#button_favo').html() == "行きたい！"){
					$('#button_favo').html('登録済み！');
				} else{
					$('#button_favo').html('行きたい！');
				}
				$('#favo_num').html(res.favo);
		}, "json");
	});
});
</script>