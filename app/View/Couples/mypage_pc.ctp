 <?php echo $this->Html->script('hoge', array('inline' => false)); ?>
<div class="container" data-user-id='<?php echo $user_id; ?>'>

  <!--写真スライドショー、カップル情報開始-->
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

        <!--個人写真、カップル情報開始-->
        <div class="">
          <div class="row">
            <div class="col-sm-offset-1 col-sm-3" style="height:420px;margin-top:-150px;background-color:#FFFFCC;">
              <div class="user-image-top" style="height:200px;width:200px;">
                <?php echo $this->Html->image($users[0]['User']['photo'], array('alt' => $users[0]['User']['name']));?>
              </div>
              <div>
                <h4><?php echo $users[0]['User']['name']; ?></h4>

                <p><?php echo $users[0]['User']['age']; ?></p>
                <hr>
                <p>東京都の平和島近くに在住中。好きなデートスポットは落ち着けるカフェとか自然に溢れた場所。海辺などの散歩も好き！</p>
              </div>
            </div>
            <div class="col-sm-3" style="height:420px;margin-top:-150px;background-color:#FFFFCC;">
              <div class="user-image-top" style="height:200px;width:200px;">
                <?php echo $this->Html->image($users[1]['User']['photo'], array('alt' => $users[1]['User']['name']));?>
              </div>
              <div>
                <h4><?php echo $users[1]['User']['name']; ?></h4>

                <p><?php echo $users[1]['User']['age']; ?>歳</p>
                <hr>
                <p>東京都の世田谷区に在住中。好きなデートスポットはおしゃれなバーなど</p>
              </div>


            </div>
            <!--カップル情報開始-->
            <div class="col-sm-4" style="height:;background-color:#FFFFCC;margin-left:10px;padding-top:12px;">
              <!--グレード情報-->
              <div class="clearfix">
                <i class="fa fa-heart fa-5x" style="font-size:120px;float:left;color:pink;"></i><p style="font-size:20px;font-weight:bold;margin-left:10px;margin-top:40px;">ピンクカップル<span style="font-size:12px;">(1076points)</span></p>
              </div>
              <!--カップルの表情報-->
              <table class="table table-hover table-bordered couple-table" style="margin-top:10px;">
               <tr>
                <td>付き合い歴</td>
                <td><?php echo $our[0]['Couple']['anniversary']; ?></td>
              </tr>
              <tr>
                <td>よく行くデート先</td>
                <td><?php echo $our[0]['Couple']['often_area']; ?></td>
              </tr>
              <tr>
                <td>お気に入りのデート</td>
                <td><?php echo $our[0]['Couple']['often_place']; ?></td>
              </tr>
            </table>
          </div>
          <!--カップル情報終了-->

        </div>
      </div>
      <!--個人写真、カップル情報終了-->

    </div>
  </div>
  <!--写真スライドショー、カップル情報終了-->

  <!--今までのデート一覧、フォローしているカップル一覧開始-->
  <div class="row" style="margin-top:30px;">
    <!--今までのデート一覧開始-->
    <div class="col-sm-8">

      <!--未完成のデート開始-->
      <a href="/planbox-plan/dates/date_new/"><button type="button" class="btn btn-warning" style="width:100%;font-size:26px;">未完成のデート<span class="badge">2</span></button></a>
      <!--未完成のデート終了-->
      
      <?php foreach($dates as $date) { ?>
      <!--一つのデートの塊開始-->
      <a href="/planbox-plan/dates/date/<?php echo $date['Date']['id']; ?>"><!--そのデートへ飛ぶリンク-->
       <div class="row" style="border:1px solid #ccc;">
         <div class="col-sm-5 tweet-image" style="width:300px;height:200px; overflow:hidden;margin-top:20px;">
          <?php echo $this->Html->image($date['Date']['photo'], array('alt' => 'kohei'));?>
        </div>
        <div class="col-sm-7">

         <table class="table">
           <tr><!--１行目：タイトル-->
            <td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;"><?php echo $date['Date']['name']; ?></td>
          </tr>
          <tr><!--２行目:説明文-->
            <td colspan="3"><?php echo $date['Date']['description']; ?></td>
          </tr>
          <tr><!--３行目:デートの場所、日時、予算-->
            <td style="text-align:center" class="fa fa-map-marker"><?php echo $date['Date']['city']; ?></td>
            <td style="text-align:center" class="fa fa-jpy"><?php echo $date['Date']['budget']; ?></td>

            <td style="text-align:center" class="fa fa-calendar"><?php echo $date['Date']['created']; ?></td>
          </tr>
          <tr>
            <td></td>
            <td><?php echo $date['Date']['num_view']; ?>View</td>
            <td>行きたい数：<?php echo $date['Date']['favo']; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </a>
  <!--一つのデートの塊終了-->
<?php } ?>

</div>
<!--今までのデート一覧終了-->


<!--フォローしているカップル（サイドバー)開始-->
<div class="col-sm-offset-1 col-sm-3" style="border:1px solid #ccc;">
  <h4 style="text-align:center">フォローしているカップル</h4>
  <p class="tabs">
    <a href="#tab1" class="tab1" onclick="ChangeTab('tab1'); return false;">カップル</a>
    <a href="#tab2" class="tab2" onclick="ChangeTab('tab2'); return false;">自分</a>
    <a href="#tab3" class="tab3" onclick="ChangeTab('tab3'); return false;">相手</a>
  </p>
  <?php for($i=1; $i<4; $i++) { ?>
  <!--カップル二人のフォローが見える開始-->
  <div id="tab<?php echo $i;?>" class="tab"> 

    <!--フォローしているカップルの一つの塊開始-->
    <?php foreach($couples[$i] as $couple) { ?>
    <hr>
    <a href="/planbox-plan/couples/couple/<?php echo $couple['Couple']['id']; ?>"><!--このカップルに飛ぶリンク-->
      <div style="background-color:#FFFFCC; padding:5px;">
        <div class="user-image-side" style="overflow:hidden; width:100%; height:100px;">
          <?php echo $this->Html->image($couple['Couple']['user'][0]['photo'], array('alt' => $couple['Couple']['user'][0]['name']));?>
          <?php echo $this->Html->image($couple['Couple']['user'][1]['photo'], array('alt' => $couple['Couple']['user'][1]['name']));?>

        </div>
        <h4 class="fa fa-heart-o" style="font-size:13px;font-weight:bold;text-align:center;"><?php echo $couple['Couple']['user'][0]['name']; ?>(<?php echo $couple['Couple']['user'][0]['age']; ?>歳)/<?php echo $couple['Couple']['user'][1]['name']; ?>(<?php echo $couple['Couple']['user'][1]['age']; ?>歳)</h4>

        <table class="table table-hover table-bordered">
         <tr>
          <td style="width:;height:;">付き合い歴</td>
          <td style="width:;height:;"><?php echo $couple['Couple']['anniversary']; ?></td>
        </tr>
        <tr>
          <td style="width:;height:;">よく行くデート先</td>
          <td style="width:;height:;"><?php echo $couple['Couple']['often_area']; ?></td>
        </tr>  
      </table>
      </a>
      <button id="follow<?php echo $couple['Couple']['id']; ?>" type="button" class="btn btn-warning btn-lg follow" data-couple-id='<?php echo $couple['Couple']['id']; ?>'>フォローを外す</button>  
    </div>
  <!--フォローしているカップルの一つの塊終了-->
  <?php } ?>
</div>
<!--カップル二人のフォローが見える終了-->
<?php } ?>

</div>
<!--フォローしているカップル（サイドバー)終了-->

</div>
<!--今までのデート一覧、フォローしているカップル一覧終了-->

</div>

<script>
$(function() {
  // サイドバーの「フォローを外すボタン」を押すと
  $('button.follow').click(function(e){
    $.post('/planbox-plan/follows/change_mypage/',
      {'user_id':$('div.container').data('user-id'), 'couple_id':$(this).data('couple-id')}
      ,function(res){
        if($('#follow'+res).html() == "フォローを外す"){
          $('#follow'+res).html('フォロー！');
        } else{
          $('#follow'+res).html('フォローを外す');
        }
    }, "json");
  });
});
</script>