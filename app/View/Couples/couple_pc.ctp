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
            <div class="col-sm-4" style="height:100px;background-color:#FFFFCC;margin-left:10px;">
            </div>
          </div>
        </div>
        <!--個人写真、カップル情報終了-->

      </div>
    </div>

<!--写真スライドショー、カップル情報終了-->

<!--今までのデート一覧、フォローしているカップル一覧開始-->
<div class="row">
  <!--今までのデート一覧開始-->
  <div class="col-sm-8">






  </div>
  <!--今までのデート一覧終了-->





  <!--フォローしているカップル（サイドバー)開始-->
  <div class="col-sm-offset-1 col-sm-3" style="border:1px solid #ccc;">
          <h4 style="text-align:center">フォローしているカップル一覧</h4>
          <!--フォローしているカップルの一つの塊開始-->
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

  <!--フォローしているカップル（サイドバー)終了-->
  
</div>

<!--今までのデート一覧、フォローしているカップル一覧終了-->


  </div>
