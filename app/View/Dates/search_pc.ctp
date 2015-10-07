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
            <form class="navbar-form" role="search">
                <div class="form-group">
                     <input type="text" class="form-control" placeholder="検索してください" size="100%">
                </div>
                    <button type="submit" class="btn btn-default">検索</button>
            </form>
            </div>

        <div class="recommend-list">
                <a href="">
                <div style="width:300px; height: auto; float:left; border:1px solid #ccc; margin: 10px 5px;">
                    <img src="img/aragaki.jpg" style="width:300px; height: auto;">
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
