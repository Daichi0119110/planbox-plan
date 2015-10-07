<?php echo $this->Html->script('hoge', array('inline' => false)); ?>
<div class="container">
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
                <div id="tab1" class="tab">
                    <div class="follow-list" style="border:1px solid #ccc;">
                    <a href="">
                         <div style="width:300px; height: auto; float:left; border:1px solid #ccc; margin: 10px 5px;">
                            <img src="img/aragaki.jpg" style="width:300px; height: auto;">
                            <table class="table">
                                <tr><td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;">タイトル</td></tr>
                                <tr><td colspan="3" style="text-align: center;">内容</td></tr>
                                <tr><!--３行目:デートの場所、日時、予算-->
                                    <td style="text-align:center;" class="fa fa-map-marker">渋谷</td>
                                    <td style="text-align:center;" class="fa fa-jpy">4000</td>
                                    <td style="text-align:center;" class="fa fa-calendar">2015年10月9日</td>
                                </tr>
                                <tr><!--４行目：カップルの一人目-->

                                    <td class="table-image"><!--写真-->
                                    <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>
                                    <br>新居航平 (２２歳 / 学生)

                                  </td>
                                      <td class="table-image"><!--写真-->
                                    <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'kohei'));?>
                                    <br>新垣結衣 (２５歳 / 社会人)

                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr><td>1023View</td><td colspan="2" style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                            </table>
                        </div>
                    </a>
                    </div>
                </div>
                <div id="tab2" class="tab">
                <div class="follow-list" style="border:1px solid #ccc;">
                    <a href="">
                            <div style="width:300px; height: auto; float:left; border:1px solid #ccc; margin: 10px 5px;">
                                <img src="img/aragaki.jpg" style="width:300px; height: auto;">
                                <table class="table">
                                    <tr><td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;">タイトル</td></tr>
                                    <tr><td colspan="3" style="text-align: center;">内容</td></tr>
                                    <tr><!--３行目:デートの場所、日時、予算-->
                                        <td style="text-align:center;" class="fa fa-map-marker">渋谷</td>
                                        <td style="text-align:center;" class="fa fa-jpy">4000</td>
                                        <td style="text-align:center;" class="fa fa-calendar">2015年10月9日</td>
                                    </tr>
                                    <tr><!--４行目：カップルの一人目-->

                                        <td class="table-image"><!--写真-->
                                        <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>
                                        <br>新居航平 (２２歳 / 学生)

                                      </td>
                                          <td class="table-image"><!--写真-->
                                        <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'kohei'));?>
                                        <br>新垣結衣 (２５歳 / 社会人)

                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr><td>1023View</td><td colspan="2" style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                                </table>
                            </div>
                            </a>
                </div>
                </div>
                <div id="tab3" class="tab">
                <div class="follow-list" style="border:1px solid #ccc;">
                    <a href="">
                            <div style="width:300px; height: auto; float:left; border:1px solid #ccc; margin: 10px 5px;">
                                <img src="img/aragaki.jpg" style="width:300px; height: auto;">
                                <table class="table">
                                    <tr><td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;">相手が行きたいリスト</td></tr>
                                    <tr><td colspan="3" style="text-align: center;">内容</td></tr>
                                    <tr><!--３行目:デートの場所、日時、予算-->
                                        <td style="text-align:center;" class="fa fa-map-marker">渋谷</td>
                                        <td style="text-align:center;" class="fa fa-jpy">4000</td>
                                        <td style="text-align:center;" class="fa fa-calendar">2015年10月9日</td>
                                    </tr>
                                    <tr><!--４行目：カップルの一人目-->

                                        <td class="table-image"><!--写真-->
                                        <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>
                                        <br>新居航平 (２２歳 / 学生)

                                      </td>
                                          <td class="table-image"><!--写真-->
                                        <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'kohei'));?>
                                        <br>新垣結衣 (２５歳 / 社会人)

                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr><td>1023View</td><td colspan="2" style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                                </table>
                            </div>
                            </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
