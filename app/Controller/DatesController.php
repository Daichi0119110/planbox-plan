<?php 

class DatesController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date', 'Follow','Favorite');

	public function favorite() {

	}

	public function feature() {
		$this->set('dates',$this->Date->getdatesfromcouple(1));
	}

	public function index($id = null) {
		//couple_ids,デートプランの取得
		$couple_ids = array();
		$a = $this->Follow->getcoupleid(1);
		foreach ($a as $b) {
			array_push($couple_ids, array_shift($b['Follow']));
		}
		$dates = $this->Date->getdatesfromcouple($couple_ids);

		//いいね数の取得
		for ($i=0; $i < count($dates); $i++) { 
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']);
		}
		$this->set('dates',$dates);

	}

	public function memory() {
		
	}

	public function recommend() {

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