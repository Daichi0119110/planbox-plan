<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="pickup header" style="margin-top:60px;">
            <ul>
                <div class="pickup" style="font-size:30px; text-decoration: underline;">PickUp!!</div>
            </ul>
        </div>

        <div class="recommend-list">
        <div class="thumb-wrapper" style="margin:20px; padding: 10px 20px; background-color:#; overflow:visible; position: relative;">
            <div id="thumbNails">
                <?php foreach ($dates_recommend as $date_recommend) { ?>
                <div style="width:350px height: auto; float:left; border:1px solid #ccc;">
                    <img src="img/aragaki.jpg" style="width:350px; height: auto;">
                    <table class="table">
                        <tr><td style="text-align: center;"><?php echo $date_recommend['Date']['name']; ?></td></tr>
                        <tr><td style="text-align: center;"><?php echo $date_recommend['Date']['description']; ?></td></tr>
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
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">

    <div class="search-title" style="font-size:20px; border:2px solid #ccc; width:400px">
            フォローしているカップルのデートプラン
    </div>

    </div>

    <div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">

    <table class="table">
        <tr>
            <td><a href="">カップル</a></td>
            <td><a href="">自分</a></td>
            <td><a href="">相手</a></td>
        </tr>
    </table>

    <div class="col-sm-8">
    <div class="follow-list" style="border:1px solid #ccc;">
        <article>
            <a href="">
                <img src="img/photo2.jpg" style="float: left; width: 30%">
                <img src="img/photo2.jpg" style="float: left; width: 30%">
                <img src="img/photo2.jpg" style="float: left; width: 30%; clear: both;">
                <img src="img/photo2.jpg" style="float: left; width: 30%">
                <div class="title-area" style="float: right;">
                    <table class="table">
                        <tr><td style="text-align: center;">タイトル</td></tr>
                        <tr><td style="text-align: center;">内容</td></tr>
                        <tr><td style="text-align: center;"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"></i>渋谷</td></tr>
                        <tr><td style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                    </table>
                </div>
            </a>
        </article>
    </div>
    </div>
    </div>
    </div>
    </div>
  <script>
    $(function(){
        var carouObj = new Object();
        carouObj.width = 1050;
        carouObj.items = 3;
        carouObj.auto = 5000;
        carouObj.prev = ".left.carousel-control";
        carouObj.next = ".right.carousel-control";
        $("#thumbNails").carouFredSel(carouObj);
    });
  </script>
</body>