<?php echo $this->Html->script('hoge', array('inline' => false)); ?>
<div class="container" data-user-id='<?php echo $user_id; ?>'>
    <div class="row">
      <div class="col-sm-12">
        <div class="pickup header">
            <ul>
                <div class="pickup" style="font-size:30px; text-decoration: underline;">行きたいリスト</div>
            </ul>
        </div>
        </div>

        <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">
           <div class="tabbox">
                <p class="tabs">
                  <a href="#tab1" class="tab1" onclick="ChangeTab('tab1'); return false;">カップル</a>
                  <a href="#tab2" class="tab2" onclick="ChangeTab('tab2'); return false;">自分</a>
                  <a href="#tab3" class="tab3" onclick="ChangeTab('tab3'); return false;">相手</a>
                </p>
                <?php for ($i=1; $i < 4; $i++) { ?>
                <div id="tab<?php echo $i; ?>" class="tab">

                    <?php foreach($dates[$i] as $date){ ?>
                    <div class="follow-list" style="border:1px solid #ccc;">
                         <div style="width:300px; height: auto; float:left; border:1px solid #ccc; margin: 10px 5px;">
                            <a href="/planbox-plan/dates/date/<?php echo $date['Date']['id']; ?>">
                                <?php echo $this->Html->image($date['Date']['photo'], array('alt' => $date['Date']['name'], 'style'=>"width:300px; height: auto;"));?>
                            </a>
                            <table class="table">
                                <tr>
                                    <a href="/planbox-plan/dates/date/<?php echo $date['Date']['id']; ?>">
                                    <td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;"><?php echo $date['Date']['name']; ?></td>
                                    </a>
                                </tr>
                                <tr><td colspan="3" style="text-align: center;"><?php echo $date['Date']['description']; ?></td></tr>
                                <tr><!--３行目:デートの場所、日時、予算-->
                                    <td style="text-align:center;" class="fa fa-map-marker"> <?php echo $date['Date']['city']; ?></td>
                                    <td style="text-align:center;" class="fa fa-jpy"> <?php echo $date['Date']['budget']; ?></td>
                                    <td style="text-align:center;" class="fa fa-calendar"> <?php echo date('Y/n/j',strtotime($date['Date']['modified'])); ?></td>
                                </tr>
                                <tr><!--４行目：カップルの一人目-->

                                    <td class="table-image"><!--写真-->
                                    <a href="/planbox-plan/couples/couple/<?php echo $date['Date']['couple_id']; ?>">
                                    <?php echo $this->Html->image($date['Date']['user'][0]['photo'], array('alt' => $date['Date']['user'][0]['name']));?>
                                    <br><?php echo $date['Date']['user'][0]['name']; ?>(<?php echo $date['Date']['user'][0]['age']; ?>歳)
                                    </a>
                                    </td>
                                      <td class="table-image"><!--写真-->
                                    <a href="/planbox-plan/couples/couple/<?php echo $date['Date']['couple_id']; ?>">
                                    <?php echo $this->Html->image($date['Date']['user'][1]['photo'], array('alt' => $date['Date']['user'][1]['name']));?>
                                    <br><?php echo $date['Date']['user'][1]['name']; ?>(<?php echo $date['Date']['user'][1]['age']; ?>歳)
                                    </a>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr><td><?php echo $date['Date']['num_view']; ?>View</td>
                                    <td><button id="<?php echo $date['Date']['id']; ?>" type="button" class="btn btn-warning button_favo" data-date-id="<?php echo $date['Date']['id']; ?>">行きたい！</button></td>
                                    <td colspan="2" style="text-align: right;">行きたい!!:<span id='favo_num<?php echo $date['Date']['id']; ?>'><?php echo $date['Date']['favo']; ?></span></td></tr>
                            </table>
                        </div>
                    </a>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
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
            $('#'+this).html('Planbox済！');
        });
    }, "json");

  // 行きたいボタン押したら
  $('button').click(function(e){
    $.post('/planbox-plan/favorites/change_favorite/',
      {'date_id':$(this).data('date-id'), 'user_id':$('div.container').data('user-id')}
      ,function(res){
        if($('#'+res.id).html() == "行きたい！"){
          $('#'+res.id).html('Planbox済！');
        } else{
          $('#'+res.id).html('行きたい！');
        }
        $('#favo_num'+res.id).html(res.favo);
    }, "json");
  });
});
</script>

