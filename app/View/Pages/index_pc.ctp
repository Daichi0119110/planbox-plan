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
        <div class="thumb-wrapper" style="margin:20px; padding: 10px 20px; background-color:#; overflow:visible; position: relative;">
          <div id="thumbNails">
            <?php foreach ($dates_recommend as $date_recommend) { ?>
            <div style="width:350px; height: auto; float:left; border:1px solid #ccc;">
              <a href="/planbox-plan/dates/date/<?php echo $date_recommend['Date']['id']; ?>">
              <?php echo $this->Html->image($date_recommend['Date']['photo'], array('alt' => 'baz', 'width'=>'350'));?>
              <table class="table" style="word-break: break-all;">
                <tr><td style="text-align: center;"><?php echo $date_recommend['Date']['name']; ?></td></tr>
                <tr><td style="text-align: center; "><?php echo $date_recommend['Date']['description']; ?></td></tr>
                <tr><td style="text-align: center;"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"><?php echo $date_recommend['Date']['location']; ?></i></td></tr>
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

    <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">
      <div class="search-box" style="border:1px solid #ccc; margin-bottom: 30px;">
        <div class="search-title" style="font-size:20px; border:2px solid #ccc; width:180px">
          デートプラン検索
        </div>
        <form class="navbar-form" action="search">
          <div class="form-group">
           <input type="text" class="form-control" placeholder="検索してください" size="100%">
         </div>
         <button type="submit" class="btn btn-default">検索</button>
       </form>
     </div>
   </div>

   <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">

    <div class="search-title" style="font-size:20px; border:2px solid #ccc; width:400px">
      フォローしているカップルのデートプラン
    </div>

  </div>

  <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">
    <div class="row">
      <div class="tabbox">
        <p class="tabs">
          <a href="#tab1" class="tab1" onclick="ChangeTab('tab1'); return false;">カップル</a>
          <a href="#tab2" class="tab2" onclick="ChangeTab('tab2'); return false;">自分</a>
          <a href="#tab3" class="tab3" onclick="ChangeTab('tab3'); return false;">相手</a>
        </p>
        <div class="col-sm-8">
          <!-- タブ開始 -->
          <?php for ($i=1; $i < 4; $i++) { ?>
          <div id="tab<?php echo $i; ?>" class="tab">
            <div class="follow-list" style="border:1px solid #ccc;">
              <?php foreach($dates_follow[$i] as $date_follow) { ?>
              <article>
                <!-- <a href=""> -->
                  <div class="row">
                    <a href='/planbox-plan/dates/date/<?php echo $date_follow['Date']['id']; ?>'>
                    <div class="col-sm-5">
                      <div class="row">
                        <?php echo $this->Html->image($date_follow['Date']['photo'], array('alt' => 'baz', 'width'=>'200'));?>
                      </div>
                    
                    </div>
                    <div class="col-sm-7">
                    <table class="table">
                      <tr><td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;"><?php echo $date_follow['Date']['name']; ?></td></tr>
                      <tr><td colspan="3" style="text-align: center;"><?php echo $date_follow['Date']['description']; ?></td></tr>
                      <tr><!--３行目:デートの場所、日時、予算-->
                        <td style="text-align:center;" class="fa fa-map-marker"><?php echo $date_follow['Date']['location']; ?></td>
                        <td style="text-align:center;" class="fa fa-jpy"><?php echo $date_follow['Date']['budget']; ?></td>
                        <td style="text-align:center;" class="fa fa-calendar"><?php echo $date_follow['Date']['created']; ?></td>
                      </tr>
                      </a>
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
                </article>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <!-- タブ終了 -->

          </div>
        </div>
        <!-- フォローしているリスト終了-->

        <!--サイドバー開始-->
        <div class="col-sm-offset-1 col-sm-3" style="border:1px solid #ccc;">
          <h4 style="text-align:center">今週のデートランキング</h4>
          <?php $i = 1; ?>
          <?php foreach ($ranking_dates as $ranking_date) { ?>
          <!--ランキングプラン-->
          <hr>
          <h4 style="font-style: italic;"><?php echo $i; ?>位</h4>
          <a href="/planbox-plan/dates/date/<?php echo $ranking_date['Date']['id']; ?>"><!--このデートプランに飛ぶリンク-->
            <div style="background-color:#FFDAB9; padding:5px;">
              <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                 <?php echo $this->Html->image($ranking_date['Date']['photo'], array('alt' => $ranking_date['Date']['name']));?>
              </div>
              <h4 ><?php echo $ranking_date['Date']['name']; ?></h4>
              <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;"><?php echo $ranking_date['Date']['location']; ?></p>
              </a>
              <p><?php echo $ranking_date['Date']['favo']; ?>行きたい！</p>
            </div>
          <hr>
          <!--ランキングプラン終了-->
          <?php $i=$i+1 ;?>
          <?php } ?>
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
</script>