<?php 

class DatesController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date','Follow','Favorite','Post','Photo','User');
	
	public $components = array(

        'Search.Prg' => array(

        'commonProcess' => array(

          	'paramType' => 'querystring',

          	'filterEmpty' =>  true,

        	),

    	 ),
  	);
  	public $presetVars = true;

  	public function search_pc(){
  		 $this->Prg->commonProcess();
       $this->paginate = array(
            'conditions' => $this->Date->parseCriteria($this->passedArgs),
        );
    $this->set('results', $this->paginate());
  	}

	public function search_sp(){
		$this->Prg->commonProcess();
   		$this->paginate = array(
   			'conditions' => $this->Date->parseCriteria($this->passedArgs),
        );
   	    $this->set('results', $this->paginate());
	}
  	//ここから上が検索・・・
	public function favorite($user_id) {
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/dates/favorite_sp/'.$user_id);
			exit();
		} else {
			// PCだったら
			$this->redirect('/dates/favorite_pc/'.$user_id);
			exit();
		}
	}

	public function favorite_pc($user_id){
		$couple_ids = $this->Follow->getcoupleids($user_id);
		$this->set('dates', $this->Date->getdatesfromcouple($couple_ids));
	}

	public function favorite_sp($user_id){
		$couple_ids = $this->Follow->getcoupleids($user_id);
		$this->set('dates', $this->Date->getdatesfromcouple($couple_ids));
	}

	// 削除してOK
	public function index($id = null) {
		// デートプランの取得
		$dates = $this->Date->getdatesfromcouple($this->Follow->getcoupleids(1));

		//いいね数の取得
		for ($i=0; $i < count($dates); $i++) { 
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']);
		}
		$this->set('dates',$dates);

	}

	public function search(){
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/dates/search_sp');
			exit();
		} else {
			// PCだったら
			$this->redirect('/dates/search_pc');
			exit();
		}
	}

	/*public function search_pc(){

	}*/

/*	public function search_sp(){

	}*/

	public function date($date_id){
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/dates/date_sp/'.$date_id);
			exit();
		} else {
			// PCだったら
			$this->redirect('/dates/date_pc/'.$date_id);
			exit();
		}
	}

	public function date_pc($date_id) {
		$posts = $this->Post->getposts($date_id);
		$this->set('date', $this->Date->getdate($date_id));
		$this->set('date_id', $date_id);
		$this->set('favo', $this->Favorite->getnumber($date_id));
		$couple_id = $this->Date->getcoupleid($date_id);
		$this->set('follow', $this->Follow->getnumber($couple_id));

		// 似ているデートの取得
		$user_ids = $this->Favorite->getuserids($date_id);
		$date_ids_suggest = $this->Favorite->getfavodateid($user_ids);
		$dates_suggest = $this->Date->getdate($date_ids_suggest);
		for ($i=0; $i < count($dates_suggest); $i++) {
			$posts_suggest = $this->Post->getpostids($dates_suggest[$i]['Date']['id']);
			$photos = $this->Photo->getpostallphotos($posts_suggest);
			if(!$photos){
				$dates_suggest[$i]['Date']['photo'] = null;
				continue;
			}
			$dates_suggest[$i]['Date']['photo'] = $photos[0];
		}
		$this->set('dates_suggest', $dates_suggest);

		// カルーセル用の写真の取得
		$post_ids = $this->Post->getpostids($date_id);
		$this->set('photos', $this->Photo->getpostallphotos($post_ids));

		// post配列の中に写真の情報をいれる
		for ($j=0; $j < count($posts); $j++) {
			$a = $this->Photo->getphotos($posts[$j]['Post']['id']);
			$filenames = array();
			foreach ($a as $b) {
				array_push($filenames, $b['Photo']['filename']);
			}
			if(!$filenames){
				$posts[$j]['Post']['filename'] = null;
				continue;
			}
			$posts[$j]['Post']['filename'] = $filenames;
		}
		$this->set('posts', $posts);

		//投稿カップルの写真を取得
		$users = $this->User->getuserfromcouple($couple_id);
		$users[0]['User']['photo'] = $this->Photo->getuserphoto($users[0]['User']['id']);
		$users[1]['User']['photo'] = $this->Photo->getuserphoto($users[1]['User']['id']);
		$this->set('users', $users);
	}

	public function date_sp($date_id) {
		$posts = $this->Post->getposts($date_id);
		$this->set('date', $this->Date->getdate($date_id));
		$this->set('date_id', $date_id);
		$this->set('favo', $this->Favorite->getnumber($date_id));
		$couple_id = $this->Date->getcoupleid($date_id);
		$this->set('follow', $this->Follow->getnumber($couple_id));

		// 似ているデートの取得
		$user_ids = $this->Favorite->getuserids($date_id);
		$date_ids_suggest = $this->Favorite->getfavodateid($user_ids);
		$dates_suggest = $this->Date->getdate($date_ids_suggest);
		for ($i=0; $i < count($dates_suggest); $i++) {
			$posts_suggest = $this->Post->getpostids($dates_suggest[$i]['Date']['id']);
			$photos = $this->Photo->getpostallphotos($posts_suggest);
			if(!$photos){
				$dates_suggest[$i]['Date']['photo'] = null;
				continue;
			}
			$dates_suggest[$i]['Date']['photo'] = $photos[0];
		}
		$this->set('dates_suggest', $dates_suggest);

		// カルーセル用の写真の取得
		$post_ids = $this->Post->getpostids($date_id);
		$this->set('photos', $this->Photo->getpostallphotos($post_ids));

		// post配列の中に写真の情報をいれる
		for ($j=0; $j < count($posts); $j++) {
			$a = $this->Photo->getphotos($posts[$j]['Post']['id']);
			$filenames = array();
			foreach ($a as $b) {
				array_push($filenames, $b['Photo']['filename']);
			}
			if(!$filenames){
				$posts[$j]['Post']['filename'] = null;
				continue;
			}
			$posts[$j]['Post']['filename'] = $filenames;
		}
		$this->set('posts', $posts);

		//投稿カップルの写真を取得
		$users = $this->User->getuserfromcouple($couple_id);
		$users[0]['User']['photo'] = $this->Photo->getuserphoto($users[0]['User']['id']);
		$users[1]['User']['photo'] = $this->Photo->getuserphoto($users[1]['User']['id']);
		$this->set('users', $users);
	}

	// public function viewnum(){ // google analyticsを利用してview数を取る

	// 	// https://syncer.jp/google-analytics-api-tutorialを参考に作成

	// 	// GoogleAnalyticsライブラリを読み込む
	// 	require_once '../Vendor/google-api-php-client/src/Google/autoload.php';
		
	// 	// クライアントIDとビューIDの登録
	// 	$client_id = '588018977183-sc6jkgogoiue1pelqkriogjsd9n7an6v@developer.gserviceaccount.com';
	// 	$view_id = '109105240';
		
	// 	// 秘密キーファイルの読み込み
	// 	$private_key = @file_get_contents('../Vendor/Planbox-a8d29190491c.p12');

	// 	// 取得する期間 (YYYY-MM-DD)
	// 	$from = '2000-11-10';		// 対象開始日
	// 	$to = 'today';		// 対象終了日

	// 	// 取得するデータの組み合わせ (複数の場合は[,]で区切る)
	// 	$dimensions = 'ga:pageTitle, ga:pagePath';		// ディメンション
	// 	$metrics = 'ga:pageviews';		// メトリクス

	// 	//オプション
	// 	$option = array(
	// 	'dimensions' => $dimensions,
	// 	'max-results' => 10,
	// 	'sort' => '-ga:pageviews'
	// 	// 'start-index' => 50, // 取得開始位置
	// 	);

	// 	// トークンのセット
	// 	if(isset($_SESSION['service_token'])){
	// 		$client->setAccessToken($_SESSION['service_token']);
	// 	}
	// 	// スコープのセット (読み込みオンリー)
	// 	$scopes = array('https://www.googleapis.com/auth/analytics.readonly');
	// 	// クレデンシャルの作成
	// 	$credentials = new Google_Auth_AssertionCredentials($client_id, $scopes, $private_key);

	// 	// Googleクライアントのインスタンスを作成
	// 	$client = new Google_Client();
	// 	$client->setAssertionCredentials($credentials);

	// 	// トークンのリフレッシュ
	// 	if($client->getAuth()->isAccessTokenExpired()){
	// 		$client->getAuth()->refreshTokenWithAssertion($credentials);
	// 	}

	// 	// セッションの設定
	// 	$_SESSION['service_token'] = $client->getAccessToken();

	// 	// Analyticsのインスタンスを作成
	// 	$analytics = new Google_Service_Analytics($client);

	// 	// データの取得
	// 	$obj = $analytics->data_ga->get('ga:'.$view_id, $from, $to, $metrics, $option);

	// 	// JSONデータに変換して出力
	// 	echo json_encode($obj);
	// }
}