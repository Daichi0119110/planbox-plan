<?php echo $this->Html->script('hoge', array('inline' => false)); ?>
<div class="container">
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
              <img src="img/aragaki.jpg" style="width:350px; height: auto;">
              <table class="table" style="word-break: break-all;">
                <tr><td style="text-align: center;"><?php echo $date_recommend['Date']['name']; ?></td></tr>
                <tr><td style="text-align: center; "><?php echo $date_recommend['Date']['description']; ?></td></tr>
                <tr><td style="text-align: center;"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"> 渋谷</i></td></tr>
                <tr><td style="text-align: right;">行きたい!!:<?php echo $date_recommend['Date']['favo']; ?></td></tr>
              </table>
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
        <form class="navbar-form" role="search">
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
          <div id="tab1" class="tab">
            <div class="follow-list" style="border:1px solid #ccc;">
              <article>
                <a href="">
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="row">
                        <div class="col-sm-6">
                          <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                          <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                        </div>
                        <div class="col-sm-6">
                          <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                          <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto ">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <table class="table">
                        <tr><td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;">タイトル１</td></tr>
                        <tr><td colspan="3" style="text-align: center;">内容が無いよう</td></tr>
                        <tr><!--３行目:デートの場所、日時、予算-->
                          <td style="text-align:center;" class="fa fa-map-marker">渋谷</td>
                          <td style="text-align:center;" class="fa fa-jpy">4000</td>
                          <td style="text-align:center;" class="fa fa-calendar">2015年10月9日</td>
                        </tr>
                        <tr><!--４行目：カップルの一人目-->

                          <td class="table-image"><!--写真-->
                            <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>

                          </td>
                          <td class="table-image"><!--写真-->
                            <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'kohei'));?>

                          </td>
                          <td>
                            新居航平 (２２歳 / 学生)<br>
                            新垣結衣 (２５歳 / 社会人)
                            <td>
                            </tr>
                            <tr><td></td><td>1023View</td><td style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                          </table>
                        </div>
                      </div>
                    </a>
                  </article>
                </div>
              </div>
              <div id="tab2" class="tab">
                <div class="follow-list" style="border:1px solid #ccc;">
                  <article>
                    <a href="">
                      <div class="row">
                        <div class="col-sm-5">
                          <div class="row">
                            <div class="col-sm-6">
                              <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                              <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                            </div>
                            <div class="col-sm-6">
                              <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                              <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto ">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-7">
                          <table class="table">
                            <tr><td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;">タイトル</td></tr>
                            <tr><td colspan="3" style="text-align: center;">内容が無いよう</td></tr>
                            <tr><!--３行目:デートの場所、日時、予算-->
                              <td style="text-align:center;" class="fa fa-map-marker">渋谷</td>
                              <td style="text-align:center;" class="fa fa-jpy">4000</td>
                              <td style="text-align:center;" class="fa fa-calendar">2015年10月9日</td>
                            </tr>
                            <tr><!--４行目：カップルの一人目-->

                              <td class="table-image"><!--写真-->
                                <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>

                              </td>
                              <td class="table-image"><!--写真-->
                                <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'kohei'));?>

                              </td>
                              <td>
                                新居航平 (２２歳 / 学生)<br>
                                新垣結衣 (２５歳 / 社会人)
                                <td>
                                </tr>
                                <tr><td></td><td>1023View</td><td style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                              </table>
                            </div>
                          </div>
                        </a>
                      </article>
                    </div>
                  </div>
                  <div id="tab3" class="tab">
                    <div class="follow-list" style="border:1px solid #ccc;">
                      <article>
                        <a href="">
                          <div class="row">
                            <div class="col-sm-5">
                              <div class="row">
                                <div class="col-sm-6">
                                  <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                                  <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                                </div>
                                <div class="col-sm-6">
                                  <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto">
                                  <img src="img/photo2.jpg" style="float: left; width: 200px; height: auto ">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-7">
                              <table class="table">
                                <tr><td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;">タイトル</td></tr>
                                <tr><td colspan="3" style="text-align: center;">内容が無いよう</td></tr>
                                <tr><!--３行目:デートの場所、日時、予算-->
                                  <td style="text-align:center;" class="fa fa-map-marker">渋谷</td>
                                  <td style="text-align:center;" class="fa fa-jpy">4000</td>
                                  <td style="text-align:center;" class="fa fa-calendar">2015年10月9日</td>
                                </tr>
                                <tr><!--４行目：カップルの一人目-->

                                  <td class="table-image"><!--写真-->
                                    <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>

                                  </td>
                                  <td class="table-image"><!--写真-->
                                    <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'kohei'));?>

                                  </td>
                                  <td>
                                    新居航平 (２２歳 / 学生)<br>
                                    新垣結衣 (２５歳 / 社会人)
                                    <td>
                                    </tr>
                                    <tr><td></td><td>1023View</td><td style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                                  </table>
                                </div>
                              </div>
                            </a>
                          </article>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- フォローしているリスト終了-->

                  <!--サイドバー開始-->
                  <div class="col-sm-offset-1 col-sm-3" style="border:1px solid #ccc;">
                    <h4 style="text-align:center">今週のデートランキング</h4>
                    <!--ランキングプラン-->
                    <hr>
                    <h4 style="font-style: italic;">１位</h4>
                    <a href="date.php"><!--このデートプランに飛ぶリンク-->
                      <div style="background-color:#FFDAB9; padding:5px;">
                        <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                          <img src="img/photo2.jpg">
                        </div>
                        <h4 >デートの名前</h4>
                        <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;">自由が丘</p>
                        <p>渋谷</p>
                      </div>
                    </a>
                    <!--ランキングプラン終了-->
                    <hr>
                    <!--ランキングプラン-->
                    <h4 style="font-style: italic;">２位</h4>
                    <a href="date.php"><!--このデートプランに飛ぶリンク-->
                      <div style="background-color:#FFDAB9; padding:5px;">
                        <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                          <img src="img/photo2.jpg">
                        </div>
                        <h4 >デートの名前</h4>
                        <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;">自由が丘</p>
                        <p>渋谷</p>
                      </div>
                    </a>
                    <!--ランキングプラン終了-->
                    <hr>
                    <!--ランキングプラン-->
                    <h4 style="font-style: italic;">３位</h4>
                    <a href="date.php"><!--このデートプランに飛ぶリンク-->
                      <div style="background-color:#FFDAB9; padding:5px;">
                        <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                          <img src="img/photo2.jpg">
                        </div>
                        <h4 >デートの名前</h4>
                        <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;">自由が丘</p>
                        <p>渋谷</p>
                      </div>
                    </a>
                    <!--ランキングプラン終了-->
                    <hr>
                    <h4 style="font-style: italic;">４位</h4>
                    <a href="date.php"><!--このデートプランに飛ぶリンク-->
                      <div style="background-color:#FFDAB9; padding:5px;">
                        <div class="sidebar-image" style="overflow:hidden; width:100%; height:180px;">
                          <img src="img/photo2.jpg">
                        </div>
                        <h4 >デートの名前</h4>
                        <p class="fa fa-map-marker" style="font-size:13px;font-weight:bold;text-align:center;width:100%;">自由が丘</p>
                        <p>渋谷</p>
                      </div>
                    </a>
                    <!--ランキングプラン終了-->

                  </div>        
                  <!--サイドバー終了-->
                </div>
              </div>
            </div>
          </div>
