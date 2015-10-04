<div class="container-fluid" style="padding-right:0;padding-left:0;"> 
  
  <!--写真のスライドショー-->

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width:320px; height:200px; margin:5px auto 0 auto;">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active carousel-image-sp" style="overflow: hidden;width:320px; height:200px;">
        <?php echo $this->Html->image('photo1.jpg', array('alt' => 'baz'));?>
        <div class="carousel-caption">
        </div>
      </div>
      <div class="item carousel-image-sp" style="overflow: hidden;width:320px; height:200px;">
        <?php echo $this->Html->image('photo2.jpg', array('alt' => 'baz'));?>
        <div class="carousel-caption">
        </div>
      </div>
      <div class="item carousel-image-sp" style="overflow: hidden;width:320px; height:200px;">
        <?php echo $this->Html->image('photo3.jpg', array('alt' => 'baz'));?>
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


  <!--ユーザー写真とユーザ情報開始-->
  <div class="row">
    <!--一人目のユーザ情報-->
    <div class="col-xs-offset-1 col-xs-5" style="height:300px;margin-top:-50px;;background-color:#FFFFCC;">

            <div class="user-image-top-sp" style="height:130px;width:100%;">
              <?php echo $this->Html->image('kohei.jpg', array('alt' => 'baz'));?>
            </div>
            <div>
              <h4>新居航平</h4>

              <p>２２歳 / 学生</p>
              <p style="font-size:11px;font-color:gray;">東京都の平和島近くに在住中。好きなデートスポットは落ち着けるカフェとか自然に溢れた場所。海辺などの散歩も好き！</p>
            </div>          


    </div>
    <!--二人目のユーザ情報-->
    <div class="col-xs-5" style="height:300px;margin-top:-50px;;background-color:#FFFFCC;">

            <div class="user-image-top-sp" style="height:130px;width:100%;">
              <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'baz'));?>
            </div>
            <div>
              <h4>新垣結衣</h4>

              <p>２５歳 / 女優</p>
              <p style="font-size:11px;font-color:gray;">東京都の世田谷区に在住中。好きなデートスポットはおしゃれなバーなど</p>
            </div>          


    </div>

  </div>
  <!--ユーザー写真とユーザ情報終了-->

  <!--カップルに関する情報開始-->
  <div class="row">
    <div class="col-xs-offset-1 col-xs-10 col-xs-offset-1" style="background-color:#FFFFCC;">
      <table class="table table-hover table-bordered couple-table-sp" style="margin-top:10px;">
           <tr>
            <td>付き合い歴</td>
            <td>１年２ヶ月</td>
          </tr>
          <tr>
            <td>よく行くデート先</td>
            <td>渋谷、表参道、お台場</td>
          </tr>
          <tr>
            <td>お気に入りのデート</td>
            <td>水族館に行くこと、おしゃれなカフェを散策すること</td>
          </tr>
        </table>
    </div>
  </div>
  <!--カップルに関する情報終了-->
  
  <!--フォローしているカップル開始--><!--通常は表示されていない、ボタン押して表示-->
      <hr>
      <h4 style="text-align:center">フォローしているカップル一覧</h4>
      <!--フォローしているカップルの一つの塊開始-->
      <hr>
      <a href="couple.php"><!--このカップルに飛ぶリンク-->
        <div style="background-color:#FFFFCC; padding:5px;">
          <div class="user-image-side-sp" style="overflow:hidden; width:100%; height:140px;">
            <div class="row">
              <div class="col-xs-6">
                <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'aragaki'));?>
            
              </div>
            </div>
            
          </div>
          <h4 class="fa fa-heart-o" style="font-size:13px;font-weight:bold;text-align:center;">新居航平(22歳)/新垣結衣(25歳)カップル</h4>
          
          <table class="table table-hover table-bordered couple-table-sp">
           <tr>
            <td>付き合い歴</td>
            <td>１年２ヶ月</td>
          </tr>
          <tr>
            <td>よく行くデート先</td>
            <td>渋谷、表参道、お台場</td>
          </tr>      
        </table>

      </div>
    </a>
    <!--フォローしているカップルの一つの塊終了-->
    
  </div>        

  <!--フォローしているカップル終了-->


</div>

