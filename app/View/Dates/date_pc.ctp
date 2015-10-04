<style>

</style>


<div class="container">
  <div class="row">
    <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">

      <!--写真のスライドショー-->

      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width:900px; height:500px; margin:60px auto 0 auto;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active carousel-image" style="overflow: hidden;width:900px; height:500px;">
            <?php echo $this->Html->image('photo1.jpg', array('alt' => 'baz'));?>
            <div class="carousel-caption">
            </div>
          </div>
          <div class="item carousel-image" style="overflow: hidden;width:900px; height:500px;">
            <?php echo $this->Html->image('photo2.jpg', array('alt' => 'baz'));?>              
            <div class="carousel-caption">
            </div>
          </div>
          <div class="item carousel-image" style="overflow: hidden;width:900px; height:500px;">
            <?php echo $this->Html->image('photo2.jpg', array('alt' => 'baz'));?>
            <div class="carousel-caption">
            </div>
          </div>
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
      <div style="border:1px solid #ccc;">
        <h2 style="text-align:center;"><?php echo $date[0]['Date']['name']; ?></h2>
        <div class="row">
          <div class="col-sm-5">
            <h3 style="text-align:center">デートスケジュール</h3>
            <?php foreach ($posts as $post) { ?>
            <table class="table table-hover">
              <tr><td style="width:200px;height:40px;"><a href="#tweet1" class="fa fa-clock-o" style="display:block;width:100%;height:100%;"><?php echo $post['Post']['created']; ?></a></td><td style="width:250px;height:40px;"><a href="#tweet1" class="fa fa-map-marker" style="display:block;width:100%;height:100%;"><?php echo $post['Post']['location']; ?></a></td></tr><!--ページ内リンクを貼り付け-->
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
            <a href="couple.php"><!--カップルページへのリンク-->
              <div class="row">
                <div class="col-sm-6">
                  <div class="row" style="position: relative;">
                    <div class="col-sm-6 user-image">
                      <?php echo $this->Html->image('kohei.jpg', array('alt' => 'baz'));?>
                    </div>
                    <div class="col-sm-6" style="position: absolute;top: 20px;left:120px;">
                      <h4>新居航平</h4>
                      <p>２２歳 / 学生</p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="row" style="position: relative;">
                    <div class="col-sm-6 user-image">
                      <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'baz'));?>
                    </div>
                    <div class="col-sm-6" style="position: absolute;top: 20px;left:120px;">
                      <h4>新垣結衣</h4>
                      <p>２５歳 / 女優</p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div> 
      <!--デート全体説明終了--> 
      <button id="button_follow" class="follow" data-couple-id="<?php echo $date[0]['Date']['couple_id']; ?>"> フォロー！</button>
      <!--デート詳細、サイドバー-->

      <div class="row" style="margin-top:40px;">
        <!--デート詳細-->
        <div class="col-sm-8">
          <?php foreach ($posts as $post) { ?>
          <!--一つのツイートの塊-->
          <div class="row" style="border:1px solid #ccc;" id="tweet1">
            <div class="col-sm-6" >
              <div class="tweet-image" style="width:300px;height:200px; overflow:hidden;">
                <?php echo $this->Html->image('photo1.jpg', array('alt' => 'baz'));?>
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
          <a href="date.php"><!--このデートプランに飛ぶリンク-->
            <div style="background-color:#FF8C00; padding:5px;">
              <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                <?php echo $this->Html->image('photo1.jpg', array('alt' => 'photo1'));?>
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

