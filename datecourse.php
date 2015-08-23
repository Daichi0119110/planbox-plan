<? 
require_once('config.php');
require_once('function.php');

if ($_GET['id']) {
    $date_id = $_GET['id'];
} else {
    $date_id = 1;
}

//データベースに接続
$dbh = connectDb();

//post情報の取得
$posts = getposts($date_id);

$i = 0;
$j = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>デートプラン詳細</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="vertical-timeline/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="vertical-timeline/css/style.css"> <!-- Resource style -->

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">


    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/footerFixed.js"></script>
    <script type="text/javascript" src="js/fixed.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="vertical-timeline/js/modernizr.js"></script> <!-- Modernizr -->

    </head>

    <body>

        <div class="brand">Date Plan</div>
        <div class="address-bar">気になるデートを詳しくチェック！</div>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" >
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                    <a class="navbar-brand" href="index.html">Business Casual</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" style="width:100%;">
                        <li class="active">
                            <a href="index.php">Feed</a>
                        </li>
                        <li>
                            <a href="planlist.php">Plan List</a>
                        </li>
                        <li>
                            <a href="memory.php">Memory</a>
                        </li>
                        <li>
                            <a href="recommend.php">Recommend</a>
                        </li>
                        <li>
                            <a href="column.php">Column</a>
                        </li>
                        <li>
                            <a href="setting.php">Setting</a>
                        </li>
                        <li style="float:right;">
                            <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <div class="container">


            <div class="row">
                <div class="box">
                    <div class="col-lg-12 text-center">
                        <h1 class="intro-text text-center">
                            <i class="fa fa-calendar"></i>
                            <?php print date("Y, n, j", strtotime(getdatefromid($date_id)['created'])); ?>
                        </h1>
                    </br>
                    <h1 class="intro-text text-center">
                        <?php getdatefromid($date_id)['name']; ?>
                    </h1>
                </br>
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators hidden-xs">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="imgOverlay">
                                <img class="img-responsive img-full" src="img/slide-1.jpg" alt="">
                                <div class="overlayText">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="imgOverlay">
                                <img class="img-responsive img-full" src="img/slide-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="item">
                            <div class="imgOverlay">
                                <img class="img-responsive img-full" src="img/slide-3.jpg" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="icon-next"></span>
                    </a>
                </div>
                <div class="col-lg-12">
                </br>
                <div class="col-lg-6">
                    <h2 class="intro-text text-center">
                        <i class="fa fa-clock-o"></i>
                        当日のスケジュール
                    </h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <?php foreach($posts as $post) { ?>
                    <?php $i = $i + 1; ?>
                    <p><a href="#tweet<?php echo $i;?>"><?php print date("n/j G:i", strtotime($post['created']));?> @ <?php echo $post['location']; ?> </a></p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="col-sm-12 btn-group" role="group">
                    <button type="button" class="col-sm-4 btn btn-default"><i class="fa fa-heart"></i>行きたい！</button>
                    <button type="button" class="col-sm-4 btn btn-default">フォロー</button>
                    <button type="button" class="col-sm-4 btn btn-default">コメント</button>
                </div>
                            
                </div>
            </div>
        </div>
        <section id="cd-timeline" class="cd-container">

            <?php foreach ($posts as $post) { ?>
            <?php $j = $j + 1; ?>
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-picture" style="margin-left:-32px;">
                    <img src="vertical-timeline/img/cd-icon-picture.svg" alt="Picture">
                </div> <!-- cd-timeline-img -->
                <a href="https://www.google.com/">
                    <div class="cd-timeline-content"  style="width:90%!important;">

                        <div class="row" id="tweet<?php echo $j;?>">
                            <div class="box">
                                <div class="col-lg-12" style="">
                                    <div class="row"　style="position: relative;">
                                        <div class="col-sm-5" style="width: 330px;
                                        height: 250px; ">
                                        <img class="img-responsive img-border img-left" src="<?php echo getphotos($post['id'])[0]['filename']; ?>" alt="" style="width:auto;height:220px;
                                        position: absolute;
                                        top: 0;
                                        bottom: 0;
                                        margin: auto 0 auto 10px;

                                        ">
                                    </div>
                                    <div class="col-sm-7">

                                        <div class="row">
                                            <div class="col-sm-offset-1 text-center col-sm-offset-1">
                                                <p>
                                                    <?php echo $post['content']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-offset-3  col-sm-offset-3">
                                                <i class="fa fa-map-marker fa-2x"></i>
                                                <span style="font-size:20px;font-weight: bold;">
                                                    <?php echo $post['location']; ?>
                                                </span>
                                                <i class="fa fa-clock-o fa-2x"></i>
                                                <span style="font-size:20px;font-weight: bold;">
                                                    <?php print date("n/j G:i", strtotime($post['created'])); ?></span>
                                                </div>
                                            </div>
                                            <br>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- cd-timeline-content -->
                </a>
            </div> <!-- cd-timeline-block -->
            <?php } ?>
        </section>


    </div>
    <!-- /.container -->

    

    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="width:100%;">
                    <li class="col-sm-4">
                        <p><form action="fav.php" method="post">
                            <input type="hidden" name="user_id" value="1"></input>
                            <input type="hidden" name="date_id" value="<?php echo $date_id; ?>"></input>
                            <input type="submit" value="行きたい！"></input></form></p>
                    </li >
                    <li class="col-sm-4">
                        <p><form action="follow.php" method="post">
                            <input type="hidden" name="user_id" value="1"></input>
                            <input type="hidden" name="date_id" value="<?php echo $date_id; ?>"></input>
                            <input type="submit" value="フォロー"></input></form></p>
                    </li>
                    <li class="col-sm-4">
                        <p>コメント</p>
                    </li>
        </div>
    </nav>


                <!-- jQuery -->
                <script src="js/jquery.js"></script>
                <script src="vertical-timeline/js/main.js"></script> <!-- Resource jQuery -->

                <!-- Bootstrap Core JavaScript -->
                <script src="js/bootstrap.min.js"></script>

                <!-- Script to Activate the Carousel -->
                <script>
                    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
                </script>
                <script >
                    $(function(){
                        $('a[href^=#]').click(function(){ 
            var speed = 500; //移動完了までの時間(sec)を指定
            var href= $(this).attr("href"); 
            var target = $(href == "#" || href == "" ? 'html' : href);
            var position = target.offset().top;
            $("html, body").animate({scrollTop:position}, speed, "swing");
            return false;
        });
                    });
                </script>
            </body>

            </html>
