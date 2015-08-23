<? 
require_once('config.php');
require_once('function.php');

if ($_GET['id']) {
    $couple_id = $_GET['id'];
} else {
    $couple_id = 1;
}

//データベースに接続
$dbh = connectDb();

//カップルの取得
$couple = getcouple($couple_id);
$dates = getdates($couple_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>カップルページ</title>

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


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="vertical-timeline/js/modernizr.js"></script> <!-- Modernizr -->

    </head>

    <body>

        <div class="brand">Couple</div>

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
                    <ul class="nav navbar-nav " style="width:100%;">
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
                                <button type="submit" class="btn btn-default">検索</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
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
                            <p> 7/12 09:43 @  </p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="imgOverlay">
                        <img class="img-responsive img-full" src="img/slide-2.jpg" alt="">
                        <div class="overlayText">
                            <p> 7/12 10:26 @  </p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="imgOverlay">
                        <img class="img-responsive img-full" src="img/slide-3.jpg" alt="">
                        <div class="overlayText">
                            <p> 7/12 13:11 @  </p>
                        </div>
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

        <div class="container ">
            <div class="row">
                <div class="col-sm-5 userDescription">
                    <div class="box">
                        <div class="row">
                            <div class="col-sm-6">
                                <img class="userIcon" src="user_images/<?php echo getuser($couple['male_id'])['photo']; ?>" alt="">
                                    <p><?php echo getuser($couple['male_id'])['name'];?></p>
                                    <p><?php print date("Y/n/j", strtotime(getuser($couple['male_id'])['birthday'])); ?></p>
                            </div>
                            <div class="col-sm-6">
                                <img class="userIcon" src="user_images/<?php echo getuser($couple['female_id'])['photo']; ?>" alt="">
                                    <p><?php echo getuser($couple['female_id'])['name'];?></p>
                                    <p><?php print date("Y/n/j", strtotime(getuser($couple['female_id'])['birthday'])); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                <br>
                    <div class="box">
                    <ul class="" style="width:100%;">
                        <li class="">
                            <span style="font-size:20px;font-weight: bold;">よく行く地域 :  <?php echo $couple['often_area']; ?></span>
                        </li>           
                        <li class="">
                            <span style="font-size:20px;font-weight: bold;">よく行くデートスポット :　<?php echo $couple['often_place']; ?></span>
                        </li>
                        <li class="">
                            <span style="font-size:20px;font-weight: bold;">二人の関係 :  <?php echo $couple['relationship']; ?></span>
                        </li>     
                        <li class="">
                            <i class="fa fa-heart"></i>
                            <span style="font-size:20px;font-weight: bold;">カップル記念日 :  <?php echo $couple['anniversary']?></span>
                        </li>     
                    </ul>
                    </div>      
                </div>
            </div>
            </div>
        </div>



        <section id="cd-timeline" class="cd-container tweets">
            <div class="container">
                <?php foreach ($dates as $date) { ?>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture" style="margin-left:-44px;">
                        <img src="vertical-timeline/img/cd-icon-picture.svg" alt="Picture">
                    </div> <!-- cd-timeline-img -->
                    <a href="https://www.google.com/"　style="">
                        <div class="cd-timeline-content"  style="width:90%!important;">
                            <div class="row">
                                <div class="box">
                                    <div class="col-lg-12" style="">
                                        <div class="row"　style="position: relative;">
                                            <div class="col-sm-5" style="width: 400px;
                                            height: 380px; ">
                                            <img class="img-responsive img-border img-left" src="images/<?php echo getphotos(getposts($date["id"])[0]["id"])[0]["filename"] ?>" alt="" style="width:auto;height:220px;position: absolute;top: 0;bottom: 0;margin: auto 0 auto 30px;">
                                        </div>
                                        <div class="col-sm-7">
                                            <hr>
                                            <h3 class="intro-text text-center">
                                                <i class="fa fa-map-marker fa-2x"></i>
                                                <?php echo $date['name']; ?>
                                            </h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">
                                                    <p>
                                                        <?php echo $date['description']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5 text-center">
                                                    <i class="fa fa-map-marker fa-2x"></i>
                                                    <span style="font-size:20px;font-weight: bold;">
                                                        <?php echo getlocation($date['id']); ?>
                                                    </span>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fa fa-jpy fa-2x"></i>
                                                        <span style="font-size:20px;font-weight: bold;">
                                                            <?php echo $date['budget']; ?>
                                                        </span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <i class="fa fa-heart fa-2x"></i>
                                                            <span style="font-size:20px;font-weight: bold;">
                                                               行きたい <span class="badge" style="font-size:18px">4</span>
                                                           </span>
                                                       </div>
                                                   </div>
                                                   <br>
                                                   <div class="row" style="margin-top:10px;">
                                                    <a href="user.php?id=<?php echo $couple['id'] ;?>">
                                                        <div class="col-sm-offset-2 col-sm-5">
                                                            <img class="img-responsive img-border img-left" src="user_images/<?php echo getuser($couple['male_id'])['photo']; ?>" alt="" style="width:60px;height:auto; 
                                                            ">
                                                            <span style="font-size:20px;font-weight: bold; margin:12px auto 12px 0; display:block;">
                                                                <?php echo getuser($couple['male_id'])['name'];?></span>

                                                            </div>
                                                            <div class="col-sm-5">
                                                                <img class="img-responsive img-border img-left" src="user_images/<?php echo getuser($couple['female_id'])['photo']; ?>" alt="" style="width:60px;height:auto; 
                                                                ">
                                                                <span style="font-size:20px;font-weight: bold; margin:12px auto; display:block;">
                                                                    <?php echo getuser($couple['female_id'])['name'];?></span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="cd-date" style=" font-weight:bold;color:white;">Jan 14</span>
                                </div> <!-- cd-timeline-content -->
                            </a>
                        </div> <!-- cd-timeline-block -->
                        <?php } ?>

                    </div>
                </section>
                <!-- /.container -->



                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script src="vertical-timeline/js/main.js"></script> <!-- Resource jQuery -->
                <!-- jQuery -->
                <script src="js/jquery.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="js/bootstrap.min.js"></script>

                <!-- Script to Activate the Carousel -->
                <script>
                    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
                </script>

            </body>

            </html>
