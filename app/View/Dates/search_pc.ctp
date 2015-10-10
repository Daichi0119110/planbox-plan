<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="pickup header">
            <ul>
                <div class="pickup" style="font-size:30px; text-decoration: underline;">検索結果</div>
            </ul>
        </div>
        </div>

        <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">
          <div class="search-box" style="border:1px solid #ccc;">
            <div class="search-title" style="font-size:20px; border:2px solid #ccc; width:180px">
            デートプラン検索
            </div>
            <form class="navbar-form" method='post' action="/planbox-plan/dates/search">
                <div class="form-group">
                     <input type="text" class="form-control" placeholder="検索してください" size="100%">
                </div>
                    <button type="submit" class="btn btn-default">検索</button>
            </form>
            </div>
            <?php foreach ($results as $date) {?>
        <div class="recommend-list">
                <a href="">
                <div style="width:300px; height: 700px; float:left; border:1px solid #ccc; margin: 10px 5px;">
                    <div style="overflow:hidden; width:350px; height:260px; display: table-cell; vertical-align: middle; text-align: center;">
                    <?php echo $this->Html->image($date['Date']['photo'], array('alt' => $date['Date']['name'], 'style'=>"width:300px; height: auto; vertical-align:middle;"));?>
                    </div>
                    <table class="table">
                        <tr><td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;"><?php echo $date['Date']['name']; ?></td></tr>
                        <tr><td colspan="3" style="text-align: center;"><?php echo $date['Date']['description']; ?></td></tr>
                        <tr><!--３行目:デートの場所、日時、予算-->
                            <td style="text-align:center;" class="fa fa-map-marker"><?php echo $date['Date']['city']; ?></td>
                            <td style="text-align:center;" class="fa fa-jpy"><?php echo $date['Date']['budget']; ?></td>
                            <td style="text-align:center;" class="fa fa-calendar"><?php echo $date['Date']['created']; ?></td>
                        </tr>
                        <tr><!--４行目：カップルの一人目-->

                            <td class="table-image"><!--写真-->
                            <?php echo $this->Html->image($date['Date']['user'][0]['photo'], array('alt' =>$date['Date']['user'][0]['name']));?>
                            <br><?php echo $date['Date']['user'][0]['name']; ?> (<?php echo $date['Date']['user'][0]['age']; ?>歳)

                          </td>
                              <td class="table-image"><!--写真-->
                            <?php echo $this->Html->image($date['Date']['user'][1]['photo'], array('alt' =>$date['Date']['user'][1]['name']));?>
                            <br><?php echo $date['Date']['user'][1]['name']; ?> (<?php echo $date['Date']['user'][1]['age']; ?>歳)

                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr><td><?php echo $date['Date']['num_view']; ?>View</td><td colspan="2" style="text-align: right;">行きたい!!:<?php echo $date['Date']['favo']; ?></td></tr>
                    </table>
                </div>
                </a>
                
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>