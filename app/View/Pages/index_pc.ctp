<?php echo $this->Html->script('hoge', array('inline' => false)); ?>
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
                <div style="width:350px; height: auto; float:left; border:1px solid #ccc;">
                    <?php echo $this->Html->image($date_recommend['Date']['photo'], array('alt' => 'baz', 'width'=>'350'));?>
                    <table class="table" style="word-break: break-all;">
                        <tr><td style="text-align: center;"><?php echo $date_recommend['Date']['name']; ?></td></tr>
                        <tr><td style="text-align: center; "><?php echo $date_recommend['Date']['description']; ?></td></tr>
                        <tr><td style="text-align: center;"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"><?php echo $date_recommend['Date']['location']; ?></i></td></tr>
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
    <div class="tabbox">
    <p class="tabs">
      <a href="#tab1" class="tab1" onclick="ChangeTab('tab1'); return false;">カップル</a>
      <a href="#tab2" class="tab2" onclick="ChangeTab('tab2'); return false;">自分</a>
      <a href="#tab3" class="tab3" onclick="ChangeTab('tab3'); return false;">相手</a>
   </p>
   <div id="tab1" class="tab">
    <div class="col-sm-8">
    <div class="follow-list" style="border:1px solid #ccc;">
        <?php foreach($dates_follow as $date_follow) { ?>
        <article>
            <a href="">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="row">
                            <?php echo $this->Html->image($date_follow['Date']['photo'], array('alt' => 'baz', 'width'=>'200'));?>
                        </div>
                    </div>
                    <div class="col-sm-7">
                    <table class="table">
                        <tr><td style="text-align: center;"><?php echo $date_follow['Date']['name']; ?></td></tr>
                        <tr><td style="text-align: center;"><?php echo $date_follow['Date']['description']; ?></td></tr>
                        <tr><td style="text-align: center;"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"></i><?php echo $date_follow['Date']['location']; ?></td></tr>
                        <tr><td style="text-align: right;">行きたい!!:<?php echo $date_follow['Date']['favo']; ?></td></tr>
                    </table>
                    </div>
                </div>
            </a>
        </article>
        <?php } ?>
    </div>
    </div>
    </div>
    <div id="tab2" class="tab">
    <div class="col-sm-8">
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
                        <tr><td style="text-align: center;">タイトル</td></tr>
                        <tr><td style="text-align: center;">内容</td></tr>
                        <tr><td style="text-align: center;"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"></i>渋谷</td></tr>
                        <tr><td style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                    </table>
                    </div>
                </div>
            </a>
        </article>
    </div>
    </div>
    </div>
    <div id="tab3" class="tab">
    <div class="col-sm-8">
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
                        <tr><td style="text-align: center;">タイトル</td></tr>
                        <tr><td style="text-align: center;">内容</td></tr>
                        <tr><td style="text-align: center;"><i class="fa fa-map-marker" style="font-size:16px;font-weight:bold;"></i>渋谷</td></tr>
                        <tr><td style="text-align: right;">行きたい!!:(行きたい数)</td></tr>
                    </table>
                    </div>
                </div>
            </a>
        </article>
    </div>
    </div>
    </div>
</div>
</div>
</div>
</div>
