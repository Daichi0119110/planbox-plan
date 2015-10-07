<?php 
$i = 1;
$j = 1;
?>

<div class="container-fluid" style="padding-right:0;padding-left:0;"> 
  <h2 style="text-align:center; margin-top:60px;"></h2>
  <!--写真のスライドショー-->

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width:320px; height:200px; margin:5px auto 0 auto;">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <?php for ($i=1; $i < count($photos); $i++) { ?>
      <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>"></li>
      <?php } ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <?php for ($i=0; $i < count($photos); $i++) { ?>
      <?php if($i == 0) {?>
      <div class="item active carousel-image-sp" style="overflow: hidden;width:320px; height:200px;">
        <?php } else { ?>
        <div class="item carousel-image-sp" style="overflow: hidden;width:320px; height:200px;">
          <?php } ?>
          <?php echo $this->Html->image($photos[$i], array('alt' => 'baz'));?>
          <div class="carousel-caption">
          </div>
        </div>
        <?php } ?>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!--写真のスライドショー終了-->

    <!--デート全体説明-->
    <p style="font-weight:bold;padding:10px;"><?php echo $date[0]['Date']['name']; ?></p>
    <hr>
    <div class="row" style="padding-right:10px;padding-left:10px;">
      <div class="col-xs-6"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"> <?php echo $posts[0]['Post']['location']; ?></i></div>
      <div class="col-xs-6"><i class="fa fa-jpy" style="font-size:16px;font-weight:bold;"><?php echo $date[0]['Date']['budget']; ?></i></div>
      <div class="col-xs-12" style="margin-top:10px;"><i class="fa fa-calendar" style="font-size:16px;font-weight:bold;"><?php echo $date[0]['Date']['created']; ?></i></div>
    </div>

    <hr>

    <h3 style="text-align:center">デートスケジュール</h3>
    <?php foreach ($posts as $post) { ?>
    <table class="table table-hover">
      <tr><td style="width:200px;height:40px;"><a href="#tweet<?php echo $i; ?>" class="fa fa-clock-o" style="display:block;width:100%;height:100%;"><?php echo $post['Post']['created']; ?></a></td><td style="width:250px;height:40px;"><a href="#tweet<?php echo $i; ?>" class="fa fa-map-marker" style="display:block;width:100%;height:100%;"><?php echo $post['Post']['location']; ?></a></td></tr><!--ページ内リンクを貼り付け-->
      <?php $i++; ?>
      <?php } ?>
    </table>

    <a href="couple.php"><!--カップルページへのリンク-->


      <div class="row">
        <?php foreach ($users as $user) { ?>
        <div class="col-xs-6 user-image-sp">
          <?php echo $this->Html->image($user['User']['photo'], array('alt' => 'baz'));?>
          <h4 style="text-align:center;"><?php echo $user['User']['name']?></h4>
          <p style="text-align:center;"><?php echo $user['User']['age']?>歳</p>
        </div>
        <?php } ?>
      </div>
    </a>

    <!--デート全体説明終了--> 


    <!--デート詳細-->
    <?php foreach ($posts as $post) { ?>
    <!--一つのツイートの塊-->
    <hr>
    <div id="tweet<?php echo $j; ?>">
      <div class="row">
        <div class="col-xs-6"><i class="fa fa-clock-o" style="font-size:15px;font-weight:bold;"><?php echo $post['Post']['created']; ?></i></div>
        <div class="col-xs-6"><i class="fa fa-map-marker" style="font-size:15px;font-weight:bold;"><?php echo $post['Post']['location']; ?></i></div>
      </div>
      <div class ="tweet-image-sp" style="width:320px;height:220px; overflow:hidden;">
        <?php echo $this->Html->image($post['Post']['filename'][0], array('alt' => 'baz'));?>          
      </div>
      <p style="font-weight:bold;font-size:14px;margin-top:20px;padding-left:10px;padding-right:10px;"><?php echo $post['Post']['content']; ?></p>
    </div>
    <?php } ?>
    <!--一つのツイートの塊終了-->
    <!--デート詳細終了-->




    <!--似ているプラン-->
    <hr>
    <h4 style="text-align:center">似ているプラン</h4>
    <!--似ているプランのひとつ-->
    <hr>
    <?php foreach ($dates_suggest as $date_suggest) { ?>
    <hr>
    <a href="date.php"><!--このデートプランに飛ぶリンク-->
      <div style="background-color:#FF8C00; padding:5px;">
        <div class="sidebar-image-sp" style="overflow:hidden; width:100%; height:180px;">
          <?php echo $this->Html->image($date_suggest['Date']['photo'], array('alt' => 'photo1'));?>
        </div>
        <h4 ><?php echo $date_suggest['Date']['name']; ?></h4>
        <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;">自由が丘周辺</p>
        <p><?php echo $date_suggest['Date']['description']; ?></p>
      </div>
    </a>
    <?php } ?>
    <!--似ているプランのひとつ終了-->     
    <!--似ているプラン終了-->


    <!--コメントの追加開始-->
    <hr>
    <h3 style="text-align:center">このデートへのコメント</h3>
    <div class="row">
      <div class="col-xs-3 comment-image-sp">
        <?php echo $this->Html->image('kohei.jpg', array('alt' => 'baz'));?>
        <div>新居航平</div>       
      </div>
      <div class="col-xs-9">
        <p>
          自由が丘ちょうど行きたかったんですよね！ぜひ参考にさせていただきます！
        </p>
      </div>
    </div>
    <!--コメント新規投稿エリア-->
    <hr>
    <h3 style="text-align:center">新規コメント投稿</h3>
    <form>
      <div class="form-group">
        <input type="textarea" id="comment" class="form-control" placeholder="コメントを入力してください" style="height:150px;width:300px;margin:0 auto 0 auto">
      </div>
      <div class="form-group">
        <input type="submit" value="submit" class="btn btn-primary" style="float:right;margin-right:20px;">
      </div>
    </form>

    <!--コメントの追加終了-->

  </div>
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

