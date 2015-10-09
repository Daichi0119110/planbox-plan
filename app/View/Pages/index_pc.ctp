<?php echo $this->Html->script('hoge', array('inline' => false)); ?>
<div class="container" data-user-id='<?php echo $user_id; ?>'>
  <div class="row">
    <div class="col-sm-12">
      <div class="pickup header">
        <ul>
          <div class="pickup" style="font-size:30px; text-decoration: underline;">PickUp!!</div>
        </ul>
      </div>

      <div class="recommend-list">
        <div class="thumb-wrapper" style="margin:20px; padding: 10px 20px; background-color:#; overflow:hidden; position: relative;">
          <div id="thumbNails">
            <?php foreach ($dates_recommend as $date_recommend) { ?>
            <div style="width:350px; height: 400px; float:left; border:1px solid #ccc;">
              <a href="/planbox-plan/dates/date/<?php echo $date_recommend['Date']['id']; ?>">
              <div style="overflow:hidden; width:350px; height:260px;">
              <?php echo $this->Html->image($date_recommend['Date']['photo'], array('alt' => 'baz', 'width'=>'350'));?>
              </div>
              <table class="table" style="word-break: break-all;">
                <tr><td style="text-align: center;"><?php echo $date_recommend['Date']['name']; ?></td></tr>
                <tr><td style="text-align: center; "><?php echo $date_recommend['Date']['description']; ?></td></tr>
                <tr><td style="text-align: center;"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"><?php echo $date_recommend['Date']['city']; ?></i></td></tr>
                <tr><td style="text-align: right;">行きたい!!:<?php echo $date_recommend['Date']['favo']; ?></td></tr>
              </table>
              </a>
            </div>
            <?php } ?>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

    </div>

    <div class="col-sm-12">
      <div class="search-box" style="border:1px solid #ccc; margin-bottom: 30px;">
        <div class="search-title" style="font-size:20px; border:2px solid #ccc; width:180px;">
          デートプラン検索
        </div>
            <?php echo $this->Form->create('Date', array('action'=>'search', 'class' => 'navbar-form')); ?>
            <?php echo $this->Form->input('keyword', array('label' => false, 'size' => '150%', 'empty' => true, 'div' => array(
        'class' => 'form-group'),'class' => 'form-control',)); ?>
            <?php echo $this->Form->end(array('label' => '検索','class' => 'btn btn-default')); ?>
     </div>
   </div>
   

   <div class="container">
    <div class="row">
   

   <div class="col-sm-12">

    <div class="search-title" style="font-size:20px; border:2px solid #ccc; width:400px">
      フォローしているカップルのデートプラン
    </div>
  </div>

      <div class="tabbox">
        <p class="tabs">
          <a href="#tab1" class="tab1" onclick="ChangeTab('tab1'); return false;">カップル</a>
          <a href="#tab2" class="tab2" onclick="ChangeTab('tab2'); return false;">自分</a>
          <a href="#tab3" class="tab3" onclick="ChangeTab('tab3'); return false;">相手</a>
        </p>
        <div class="col-sm-9">
          <!-- タブ開始 -->
          <?php for ($i=1; $i < 4; $i++) { ?>
          <div id="tab<?php echo $i; ?>" class="tab">
            <div class="follow-list" style="border:1px solid #ccc;">
              <?php foreach($dates_follow[$i] as $date_follow) { ?>
                <!-- <a href=""> -->
                  <div class="row" style="margin-top:20px;">
                    <div class="col-sm-5">
                      <a href='/planbox-plan/dates/date/<?php echo $date_follow['Date']['id']; ?>'>
                      <div class="row" style="height:200px;width:300px;overflow:hidden;margin:30px 0 0 15px;">
                        <?php echo $this->Html->image($date_follow['Date']['photo'], array('alt' => $date_follow['Date']['name'], 'width'=>'300px'));?>
                      </div>
                      </a>
                    </div>
                    <div class="col-sm-7">
                    <table class="table">
                      <tr>
                        <td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;"><a href='/planbox-plan/dates/date/<?php echo $date_follow['Date']['id']; ?>'><?php echo $date_follow['Date']['name']; ?></a></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align: center;"><?php echo $date_follow['Date']['description']; ?></td>
                      </tr>
                      <tr><!--３行目:デートの場所、日時、予算-->
                        <td style="text-align:center;" class="fa fa-map-marker"><?php echo $date_follow['Date']['city']; ?></td>
                        <td style="text-align:center;" class="fa fa-jpy"><?php echo $date_follow['Date']['budget']; ?></td>
                        <td style="text-align:center;" class="fa fa-calendar"><?php echo $date_follow['Date']['created']; ?></td>
                      </tr>
                      <tr><!--４行目：カップルの一人目-->
                        <td class="table-image"><!--写真-->
                          <a href="/planbox-plan/couples/couple/<?php echo $date_follow['Date']['couple_id'];?>">
                          <?php echo $this->Html->image($date_follow['Date']['user'][0]['photo'], array('alt' => $date_follow['Date']['user'][0]['name']));?>
                        </a>
                        </td>
                        <td class="table-image"><!--写真-->
                          <a href="/planbox-plan/couples/couple/<?php echo $date_follow['Date']['couple_id'];?>">
                          <?php echo $this->Html->image($date_follow['Date']['user'][1]['photo'], array('alt' => $date_follow['Date']['user'][1]['name']));?>
                        </a>
                        </td>
                        <td>
                          <a href="/planbox-plan/couples/couple/<?php echo $date_follow['Date']['couple_id'];?>">
                          <?php echo $date_follow['Date']['user'][0]['name']; ?> (<?php echo $date_follow['Date']['user'][0]['age']; ?>歳)<br>
                          <?php echo $date_follow['Date']['user'][1]['name']; ?> (<?php echo $date_follow['Date']['user'][1]['age']; ?>歳)
                          </a>
                          </td>
                          </tr>
                          <tr>
                            <td><?php echo $date_follow['Date']['num_view']; ?>View</td>
                            <td><button id="favo_feed<?php echo $date_follow['Date']['id']; ?>" type="button" class="btn btn-warning feed" data-date-id="<?php echo $date_follow['Date']['id']; ?>">行きたい！</button></td>
                            <td style="text-align: right;">行きたい!!:<span id='favo_num_feed<?php echo $date_follow['Date']['id']; ?>'><?php echo $date_follow['Date']['favo']; ?></span></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  <!-- </a> -->
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <!-- タブ終了 -->

          </div>
        </div>
        <!-- フォローしているリスト終了-->

        <!--サイドバー開始-->
        <div class="col-sm-offset-1 col-sm-2" style="padding:0;">
          <!--ランキング開始-->
          <div style="border:1px solid #ccc;margin:5px;">
          <h4 style="text-align:center">今週のデートランキング</h4>
          <?php $i = 1; ?>
          <?php foreach ($ranking_dates as $ranking_date) { ?>
          <!--ランキングプラン-->
          <div class="ranking">
          <hr>
          <h4 style="font-style: italic;" ><?php echo $i; ?>位</h4>
          <a href="/planbox-plan/dates/date/<?php echo $ranking_date['Date']['id']; ?>"><!--このデートプランに飛ぶリンク-->
            <div style="background-color:#FFDAB9; padding:5px;">
              <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                 <?php echo $this->Html->image($ranking_date['Date']['photo'], array('alt' => $ranking_date['Date']['name']));?>
              </div>
              <h4 ><?php echo $ranking_date['Date']['name']; ?></h4>
              <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;"><?php echo $ranking_date['Date']['city']; ?></p>
              </a>
              <p><?php echo $ranking_date['Date']['description']; ?></p>
            </div>
          </div>
          <!--ランキングプラン終了-->
          <?php $i=$i+1 ;?>
          <?php } ?>
          </div>
          <!--ランキング終了-->
          <br>
          <!--新着開始-->
          <div style="border:1px solid #ccc;margin:5px;">
          <h4 style="text-align:center">新着のデート</h4>
          <?php foreach ($dates_new as $date_new) { ?>
          <!--新着プラン-->
          <div class="ranking">
          <hr>
          <a href="/planbox-plan/dates/date/<?php echo $date_new['Date']['id']; ?>"><!--このデートプランに飛ぶリンク-->
            <div style="background-color:#FFDAB9; padding:5px;">
              <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                 <?php echo $this->Html->image($date_new['Date']['photo'], array('alt' => $date_new['Date']['name']));?>
              </div>
              <h4 ><?php echo $date_new['Date']['name']; ?></h4>
              <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;"><?php echo $date_new['Date']['city']; ?></p>
              </a>
              <p><?php echo $date_new['Date']['description']; ?></p>
            </div>
          </div>
          <!--新着プラン終了-->
          <?php } ?>
          </div>
          <!--新着終了-->
        </div>        
        <!--サイドバー終了-->
      </div>
  
</div>
 </div>
   </div>
</div>

<script>
$(function() {
  $.post('/planbox-plan/favorites/ready_favorite/',
    {'user_id':$('div.container').data('user-id')}
    ,function(res){
      $.each(res, function(){
          $('#favo_feed'+this).html('Planbox済！');
      });
    }, "json");

  // feedの行きたいボタン押したら
  $('button.feed').click(function(e){
    $.post('/planbox-plan/favorites/change_favorite/',
      {'date_id':$(this).data('date-id'), 'user_id':$('div.container').data('user-id')}
      ,function(res){
        if($('#favo_feed'+res.id).html() == "行きたい！"){
          $('#favo_feed'+res.id).html('Planbox済！');
        } else{
          $('#favo_feed'+res.id).html('行きたい！');
        }
        $('#favo_num_feed'+res.id).html(res.favo);
    }, "json");
  });
});


$('.ranking:eq(4)').nextAll().hide();
$('.ranking:eq(4)').append('<a id="open_ranking" class="btn btn-warning feed">▽▽もっと見る▽▽</a>');
$('#open_ranking').css('cssText','width:80%;margin:10px auto 10px 20px');
$('#open_ranking').click(function() {
  $('.ranking:eq(4)').nextAll().show("slow");
  $('#open_ranking').hide();
});
</script>