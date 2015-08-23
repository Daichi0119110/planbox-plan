<?php
require_once('config.php');
require_once('function.php');

$user_id = $_POST['user_id'];
$date_id = $_POST['date_id'];

$dbh = connectDb();
$sql = "select * from favorites where user_id = ".$user_id." and date_id = ".$date_id;
$stmt = $dbh->query($sql);
$stmt->execute;
$favorite = $stmt->fetch();
if (empty($favorite)) {
  $sql = "insert into favorites (fav_flg, user_id,  date_id, created, modified) values (1, ".$user_id.", ".$date_id.", NOW(), NOW())";
  $stmt = $dbh->query($sql);
  $stmt->execute;
} else {
  if ($favorite["fav_flg"] == 1){
    $sql = "update favorites set fav_flg = 0 where user_id = ".$user_id." and date_id = ".$date_id;;
    $stmt = $dbh->query($sql);
    $stmt->execute;
  } else {
    $sql = "update favorites set fav_flg = 1 where user_id = ".$user_id." and date_id = ".$date_id;;
    $stmt = $dbh->query($sql);
    $stmt->execute;   
 }
}

header("Location: datecourse.php?id=$date_id", true, 301);
exit();
