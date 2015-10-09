<?php 
$i = 1;
$j = 1;
 ?>

<div class="container" data-user-id='<?php echo $user_id; ?>'>
  <div class="row">
    <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">

      <!--写真のスライドショー-->

      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width:900px; height:500px; margin:60px auto 0 auto;">
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
          <div class="item active carousel-image" style="overflow: hidden;width:900px; height:500px;">
          <?php } else { ?>
          <div class="item carousel-image" style="overflow: hidden;width:900px; height:500px;">
          <?php } ?>
          <?php echo $this->Html->image($photos[$i], array('alt' => 'baz'));?>
            <div class="carousel-caption">
            </div>
          </div>
          <?php $i++ ?>
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
<?php $i = 1;?>
      <!--デート全体説明-->
      <div style="border:1px solid #ccc;">
        <h2 style="text-align:center;"><?php echo $date[0]['Date']['name']; ?></h2>
        <div class="row">
          <div class="col-sm-5">
            <h3 style="text-align:center">デートスケジュール</h3>
            <?php foreach ($posts as $post) { ?>
            <table class="table table-hover">
              <tr><td style="width:200px;height:40px;"><a href="#tweet<?php echo $i; ?>" class="fa fa-clock-o" style="display:block;width:100%;height:100%;"><?php echo $post['Post']['created']; ?></a></td><td style="width:250px;height:40px;"><a href="#tweet<?php echo $i; ?>" class="fa fa-map-marker" style="display:block;width:100%;height:100%;"><?php echo $post['Post']['location']; ?></a></td></tr><!--ページ内リンクを貼り付け-->
              <?php $i++; ?>
              <?php } ?>
            </table>
          </div>
          <div class="col-sm-7">
            <h3 style="text-align:center">デート詳細</h3>

            <div class="row" style="margin:10px 0 10px 0;">
              <div class="col-sm-4">
                <i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"><?php echo $posts[0]['Post']['location']; ?></i>
              </div>
              <div class="col-sm-5">
                <i class="fa fa-calendar" style="font-size:16px;font-weight:bold;"><?php echo $date[0]['Date']['created']; ?></i>
              </div>
              <div class="col-sm-3">
                <i class="fa fa-jpy" style="font-size:16px;font-weight:bold;"><?php echo $date[0]['Date']['budget']; ?></i>
              </div>
            </div>

            <p style="font-weight:bold;"><?php echo $date[0]['Date']['description']; ?></p>
            <a href="/planbox-plan/couples/couple/<?php echo $date[0]['Date']['couple_id']; ?>"><!--カップルページへのリンク-->
              <div class="row">

                <?php foreach ($users as $user) { ?>
                <div class="col-sm-6">
                  <div class="row" style="position: relative;">
                    <div class="col-sm-6 user-image">
                      <?php echo $this->Html->image($user['User']['photo'], array('alt' => 'baz'));?>
                    </div>
                    <div class="col-sm-6" style="position: absolute;top: 20px;left:120px;">
                      <h4><?php echo $user['User']['name']?></h4>
                      <p><?php echo $user['User']['age']?>歳</p>
                    </div>
                  </div>
                </div>
                <?php } ?>

              </div>
            </a>

            <!-- シェアボタン -->
            <div class="social-area-plan">
              <ul class="social-button-plan">
                <!-- Twitter -->
                <li class="sc-tw"><a data-url="<?php echo $currenturl ; ?>" href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-count="vertical" data-dnt="true">ツイート</a></li>

                <!-- Facebook -->
                <li class="sc-fb"><div class="fb-like" data-href="<?php echo $currenturl ; ?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div></li>

                <!-- LINE-->
                <li class="sc-li"><a href="http://line.me/R/msg/text/?<?php echo rawurlencode($currenturl); ?>"><?php echo $this->Html->image('/img//util/linebutton.png', array('alt' => 'LINEに送る','width' => '36','height' => '60','class' => 'sc-li-img')) ; ?></a></li>
              </ul>

            <!-- Facebook用 -->
            <div id="fb-root"></div>

            </div>
            <!-- シェアボタン -->

          </div>
        </div>
      </div> 
      <!--デート全体説明終了--> 

      <!--デート詳細、サイドバー-->

      <div class="row" style="margin-top:40px;">
        <!--デート詳細-->
        <div class="col-sm-8">
          <?php foreach ($posts as $post) { ?>
          <!--一つのツイートの塊-->
          <div class="row" style="border:1px solid #ccc;" id="tweet<?php echo $j; ?>">
            <div class="col-sm-6" >
              <div class="tweet-image" style="width:300px;height:200px; overflow:hidden;">
                <?php echo $this->Html->image($post['Post']['filename'][0], array('alt' => 'baz'));?>
              </div>
            </div>
            <div class="col-sm-6" style="position: relative; width:300px;height:200px;">
              <p style="font-weight:bold;font-size:18px;margin-top:20px;"><?php echo $post['Post']['content']; ?></p>
              <div class="row" style="position: absolute;bottom: 10px; width:300px;">
                <div class="col-sm-6">
                  <i class="fa fa-clock-o" style="font-size:13px;font-weight:bold;"><?php echo $post['Post']['created']; ?></i>
                </div>
                <div class="col-sm-6">
                  <i class="fa fa-map-marker" style="font-size:13px;font-weight:bold;"><?php echo $post['Post']['location']; ?></i>
                </div>
              </div>
            </div>
          </div>
          <!--一つのツイートの塊終了-->
          <?php $j++; ?>
          <?php } ?>
        

        <!--コメントエリア開始-->
        <hr>
        <h3 style="text-align:center">このデートへのコメント</h3>
        <!--１つのコメントの塊開始-->
        <div class="row" style="border:1px solid #ccc;">
          <div class="col-sm-3 comment-image">
            <?php echo $this->Html->image('kohei.jpg', array('alt' => 'baz'));?>
            <div>新居航平</div>       
          </div>
          <div class="col-sm-9">
            <div style="font-size:16px;">
              自由が丘ちょうど行きたかったんですよね！ぜひ参考にさせていただきます！
            </div>
          </div>
        </div>
        <!--１つのコメントの塊終了-->
        
        <!--コメント新規投稿エリア-->
        <hr>
        <h3 style="text-align:center">新規コメント投稿</h3>
        <form>
          <div class="form-group">
            <input type="textarea" id="comment" class="form-control" placeholder="コメントを入力してください" style="height:150px;width:100%;margin:0 auto 0 auto">
          </div>
          <div class="form-group">
            <input type="submit" value="submit" class="btn btn-primary" style="float:right;margin-right:20px;">
          </div>
        </form>


        <!--コメントエリア終了-->

        </div>
        <!--デート詳細終了-->


        <!--サイドバー開始-->
        <div class="col-sm-offset-1 col-sm-3" style="border:1px solid #ccc;">
          <h4 style="text-align:center">似ているプラン</h4>
          <!--似ているプラン-->
          <?php foreach ($dates_suggest as $date_suggest) { ?>
          <hr>
          <a href="/planbox-plan/dates/date/<?php echo $date_suggest['Date']['id']; ?>"><!--このデートプランに飛ぶリンク-->
            <div style="background-color:#FF8C00; padding:5px;">
              <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                <?php echo $this->Html->image($date_suggest['Date']['photo'], array('alt' => 'photo1'));?>
              </div>
              <h4 ><?php echo $date_suggest['Date']['name']; ?></h4>
              <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;">自由が丘</p>
              <p><?php echo $date_suggest['Date']['description']; ?></p>
            </div>
          </a>
          <?php } ?>
          <!--似ているプラン終了-->

        </div>        
        <!--サイドバー終了-->

      </div>
      <!--デート詳細、サイドバー終了-->

    </div>
  </div>
</div>

<nav class="navbar navbar-default navbar-fixed-bottom">
    <ol class="nav navbar-nav list-inline">
      <li style="margin: 0 50px 0 400px;"><button id="button_favo" type="button" class="btn btn-warning btn-lg" data-date-id="<?php echo $date[0]['Date']['id']; ?>" data-user-id="">行きたい！</button></li>
      <li style="margin: 0 200px 0 0;"><span id="favo_num"><?php echo $favo;?></span>人が行きたい<br>と言っています</li>
      <li  style="margin: 0 50px 0 0;"><button id="button_follow" type="button" class="btn btn-warning btn-lg" data-couple-id="<?php echo $date[0]['Date']['couple_id']; ?>" data-user-id="">フォロー！</button></li>
      <li style="margin: 0 200px 0 0;"><span id="follow_num"><?php echo $follow;?></span>人がフォロー<br>しています</li>

    </ol>
</nav>

<script>
$(function() {
  $.post('/planbox-plan/follows/ready_date/',
    {'user_id':$('div.container').data('user-id'), 'couple_id':$('#button_follow').data('couple-id')}
    ,function(res){
      if(res == 1){
        $('#button_follow').html('フォロー済');
      }
    }, "json");

  $.post('/planbox-plan/favorites/ready_date/',
    {'user_id':$('div.container').data('user-id'), 'date_id':$('#button_favo').data('date-id')}
    ,function(res){
      if(res == 1){
        $('#button_favo').html('Planbox済！');
      }
    }, "json");

  // フォローボタン押したら
  $('#button_follow').click(function(e){
    $.post('/planbox-plan/follows/change_date/',
      {'user_id':$('div.container').data('user-id'), 'couple_id':$('#button_follow').data('couple-id')}
      ,function(res){
        if($('#button_follow').html() == "フォロー！"){
          $('#button_follow').html('フォロー済');
        } else{
          $('#button_follow').html('フォロー！');
        }
        $('#follow_num').html(res.follow);
    }, "json");
  });

  // 行きたいボタン押したら
  $('#button_favo').click(function(e){
    $.post('/planbox-plan/favorites/change_date/',
      {'date_id':$('#button_favo').data('date-id'), 'user_id':$('div.container').data('user-id')}
      ,function(res){
        if($('#button_favo').html() == "行きたい！"){
          $('#button_favo').html('Planbox済！');
        } else{
          $('#button_favo').html('行きたい！');
        }
        $('#favo_num').html(res.favo);
    }, "json");
  });
});


/* DOMの読み込み完了後に処理 */
if(window.addEventListener) {
  window.addEventListener( "load" , shareButtonReadSyncer, false );
}else{
  window.attachEvent( "onload", shareButtonReadSyncer );
}

/* シェアボタンを読み込む関数 */
function shareButtonReadSyncer(){

//遅延ロードする場合は次の行と、終わりの方にある行のコメント(//)を外す
//setTimeout(function(){

//Twitter
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));

//Facebook
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

}
</script>

