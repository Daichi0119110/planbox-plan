<?php

function connectDb(){
	try {
		return new PDO(DSN, DB_USER, DB_PASSWORD);
	} catch (PDOException $e){
		echo $e->getMessage();
		exit;
	}
}

function h($s) {
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function setToken() {
	$token = sha1(uniqid(mt_rand(), true));
	$_SESSION['token'] = $token;
}

function checkToken() {
	if (empty($_SESSION['token']) || ($_SESSION['token'] != $_POST['token'])) {
		echo "不正な処理が行われました。";
		exit;
	}
}

function emailExist($email, $dbh){
	$sql = "select * from users where email = :email limit 1";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(":email" => $email));
	$user = $stmt->fetch();
	return $user ? true : false;
}

function getSha1Password($s){
	return (sha1(PASSWORD_KEY.$s));
}

//プランリスト
function getfavcourse($a) {
  $dbh = connectDb();
  $sql = "select date_id from favorites where id = ".$a." and fav_flg = 1";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $date_ids = $stmt->fetch();
  $sql = "select * from dates where id IN (".implode(",",$date_ids).") order by created desc";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $dates;
}

//思い出
function getmemories($a) {
  $dbh = connectDb();
  $sql = "select id from couples where male_id = ".$a." or female_id = ".$a;
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $couple_id = $stmt->fetch();
  $sql = "select * from dates where couple_id = ".$couple_id['id']." order by created desc";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $dates;
}

//Feed
function getfeeds($a) {
  $dbh = connectDb();
  $sql = "select couple_id from follows where user_id = ".$a;
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $couple_ids = $stmt->fetch();
  $sql = "select * from dates where couple_id IN (".implode(",",$couple_ids).") order by created desc";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $dates;
}

//特集
function getspecials($a) {
  $dbh = connectDb();
  $sql = "SELECT *,COUNT(*) 
			FROM dates 
			LEFT JOIN favorites 
			ON dates.id = favorites.date_id 
			GROUP BY favorites.date_id
			ORDER BY COUNT(*) DESC
			LIMIT 20;";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $specials = $stmt->fetch();
  return $specials;
}

//他のカップルの情報取得
function getcouple($a) {
  $dbh = connectDb();
  $sql = "select * from couples where id = ".$a." order by created desc";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $couple = $stmt->fetch(PDO::FETCH_ASSOC);
  return $couple;
}

function getdates($a) {
  $dbh = connectDb();
  $sql = "select * from dates where couple_id = ".$a." order by created desc";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $dates;
}

function getposts($a) {
  $dbh = connectDb();
  $sql = "select * from posts where date_id = ".$a." order by created";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $dates;
}

function getlocation($a) {
  $dbh = connectDb();
  $sql = "select location from posts where date_id = ".$a." limit 1";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $dates = $stmt->fetch();
  return $dates['location'];
}

function getphotos($a) {
  $dbh = connectDb();
  $sql = "select * from photos where post_id = ".$a;
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $photos;
}

function getuser($a) {
  $dbh = connectDb();
  $sql = "select * from users where id = ".$a;
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  return $user;
}

function setPost($name, $text, $created_at, $post_url){
  $dbh = connectDb();
  $sql = "select * from users where name = '$name'";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $user = $stmt->fetch();
  var_dump($user);
  $sql = "select * from couples where male_id = ".$user["id"]." or female_id =".$user["id"];
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $couple = $stmt->fetch();
  var_dump($couple);
  $sql = "select * from dates where couple_id = ".$couple["id"]." and modified >= ( NOW( ) - INTERVAL 1 DAY )";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $date = $stmt->fetch();
  var_dump($date);
  if (empty($date)) {
    $sql = "insert into dates (couple_id,  name, description, created, modified) values (".$couple["id"].",  'hoge', 'hoge', NOW(), NOW())";
    $stmt = $dbh->query($sql);
    $stmt->execute;
    $sql = "select * from dates where couple_id = ".$couple["id"];
    $stmt = $dbh->query($sql);
    $stmt->execute;
    $date = $stmt->fetch();
  }
  $sql = "select * from posts where date_id = ".$date["id"]." and content = '$text'";
  $stmt = $dbh->query($sql);
  $stmt->execute;
  $post = $stmt->fetch();
  var_dump($post);
  if (empty($post)){
    var_dump("hoge");
    $sql = "insert into posts (date_id,  content, created, modified) values (".$date["id"].", '$text', NOW(), NOW())";
    $stmt = $dbh->query($sql);
    $stmt->execute;
    $lastId = $dbh->lastInsertId();
    var_dump($lastId);
    setPhoto($lastId, $post_url);
  }
}

function setPhoto($post_id, $photo_url){
  $dbh = connectDb();
  $sql = "insert into photos (post_id,  filename, created, modified) values ($post_id, '$photo_url', NOW(), NOW())";
  $stmt = $dbh->query($sql);
  $stmt->execute; 
}

function setFavorite($user_id, $date_id){
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
}
