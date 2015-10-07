<?php echo $this->Html->script('hoge', array('inline' => false)); ?>
<div class="container">

  <!--写真スライドショー、カップル情報開始-->

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

      <!--個人写真、カップル情報開始-->
      <div class="">
        <div class="row">
          <div class="col-sm-offset-1 col-sm-3" style="height:420px;margin-top:-150px;background-color:#FFFFCC;">
            <div class="user-image-top" style="height:200px;width:200px;">
              <?php echo $this->Html->image('kohei.jpg', array('alt' => 'baz'));?>
            </div>
            <div>
              <h4>新居航平</h4>

              <p>２２歳 / 学生</p>
              <hr>
              <p>東京都の平和島近くに在住中。好きなデートスポットは落ち着けるカフェとか自然に溢れた場所。海辺などの散歩も好き！</p>
            </div>
          </div>
          <div class="col-sm-3" style="height:420px;margin-top:-150px;background-color:#FFFFCC;">
            <div class="user-image-top" style="height:200px;width:200px;">
              <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'baz'));?>
            </div>
            <div>
              <h4>新垣結衣</h4>

              <p>２５歳 / 社会人</p>
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

    <!--一つのデートの塊開始-->
    <a href="date.php"><!--そのデートへ飛ぶリンク-->
     <div class="row" style="border:1px solid #ccc;">
       <div class="col-sm-5 tweet-image" style="width:300px;height:200px; overflow:hidden;margin-top:20px;">
        <?php echo $this->Html->image('photo2.jpg', array('alt' => 'kohei'));?>
      </div>
      <div class="col-sm-7">
        
       <table class="table">
         <tr><!--１行目：タイトル-->
          <td colspan="3" style="text-align: center;font-size:20px;font-weight:bold;">渋谷1日満喫デート</td>
        </tr>
        <tr><!--２行目:説明文-->
          <td colspan="3">渋谷を1日で完全制覇するデートプラン、たくさん歩くプランです。</td>
        </tr>
        <tr><!--３行目:デートの場所、日時、予算-->
          <td style="text-align:center" class="fa fa-map-marker">渋谷</td>
          <td style="text-align:center" class="fa fa-jpy">4000</td>
          
          <td style="text-align:center" class="fa fa-calendar">2015年10月9日</td>
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

            <tr>
              <td></td>
              <td>1023View</td>
              <td>行きたい数：１４</td>
            </tr>
          </table>


        </div>



    </div>
  </a>
  <!--一つのデートの塊終了-->







</div>
<!--今までのデート一覧終了-->





<!--フォローしているカップル（サイドバー)開始-->
<div class="col-sm-offset-1 col-sm-3" style="border:1px solid #ccc;">
  <h4 style="text-align:center">フォローしているカップル一覧</h4>
  <p class="tabs">
          <a href="#tab1" class="tab1" onclick="ChangeTab('tab1'); return false;">カップル</a>
          <a href="#tab2" class="tab2" onclick="ChangeTab('tab2'); return false;">自分</a>
          <a href="#tab3" class="tab3" onclick="ChangeTab('tab3'); return false;">相手</a>
  </p>
  
  <!--カップル二人のフォローが見える開始-->
  <div id="tab1" class="tab">      
  <!--フォローしているカップルの一つの塊開始-->
  <h5>二人のフォロー一覧</h5>
  <hr>
  <a href="couple.php"><!--このカップルに飛ぶリンク-->
    <div style="background-color:#FFFFCC; padding:5px;">
      <div class="user-image-side" style="overflow:hidden; width:100%; height:100px;">
        <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>
        <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'aragaki'));?>

      </div>
      <h4 class="fa fa-heart-o" style="font-size:13px;font-weight:bold;text-align:center;">新居航平(22歳)/新垣結衣(25歳)カップル</h4>

      <table class="table table-hover table-bordered">
       <tr>
        <td style="width:;height:;">付き合い歴</td>
        <td style="width:;height:;">１年２ヶ月</td>
      </tr>
      <tr>
        <td style="width:;height:;">よく行くデート先</td>
        <td style="width:;height:;">渋谷、表参道、お台場</td>
      </tr>      
    </table>
  </div>
　</a>
<!--フォローしているカップルの一つの塊終了-->
  </div>
  <!--カップル二人のフォローが見える終了-->


    <!--自分のフォローが見える開始-->
  <div id="tab2" class="tab">      
  <!--フォローしているカップルの一つの塊開始-->
  <h5>自分のフォロー一覧</h5>
  <hr>
  <a href="couple.php"><!--このカップルに飛ぶリンク-->
    <div style="background-color:#FFFFCC; padding:5px;">
      <div class="user-image-side" style="overflow:hidden; width:100%; height:100px;">
        <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>
        <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'aragaki'));?>

      </div>
      <h4 class="fa fa-heart-o" style="font-size:13px;font-weight:bold;text-align:center;">新居航平(22歳)/新垣結衣(25歳)カップル</h4>

      <table class="table table-hover table-bordered">
       <tr>
        <td style="width:;height:;">付き合い歴</td>
        <td style="width:;height:;">１年２ヶ月</td>
      </tr>
      <tr>
        <td style="width:;height:;">よく行くデート先</td>
        <td style="width:;height:;">渋谷、表参道、お台場</td>
      </tr>      
    </table>
  </div>
　</a>
<!--フォローしているカップルの一つの塊終了-->
  </div>
  <!--自分のフォローが見える終了-->
  
  <!--相手のフォローが見える開始-->
  <div id="tab3" class="tab">      
  <!--フォローしているカップルの一つの塊開始-->
  <h5>相手のフォロー一覧</h5>
  <hr>
  <a href="couple.php"><!--このカップルに飛ぶリンク-->
    <div style="background-color:#FFFFCC; padding:5px;">
      <div class="user-image-side" style="overflow:hidden; width:100%; height:100px;">
        <?php echo $this->Html->image('kohei.jpg', array('alt' => 'kohei'));?>
        <?php echo $this->Html->image('aragaki.jpg', array('alt' => 'aragaki'));?>

      </div>
      <h4 class="fa fa-heart-o" style="font-size:13px;font-weight:bold;text-align:center;">新居航平(22歳)/新垣結衣(25歳)カップル</h4>

      <table class="table table-hover table-bordered">
       <tr>
        <td style="width:;height:;">付き合い歴</td>
        <td style="width:;height:;">１年２ヶ月</td>
      </tr>
      <tr>
        <td style="width:;height:;">よく行くデート先</td>
        <td style="width:;height:;">渋谷、表参道、お台場</td>
      </tr>      
    </table>
  </div>
　</a>
<!--フォローしているカップルの一つの塊終了-->
  </div>
  <!--カップル二人のフォローが見える終了-->


</div>        

<!--フォローしているカップル（サイドバー)終了-->

</div>

<!--今までのデート一覧、フォローしているカップル一覧終了-->


</div>
