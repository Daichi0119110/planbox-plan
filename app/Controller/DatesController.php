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
    	$this->set('title', '検索 ');
  	}

	public function search_sp(){
		$this->Prg->commonProcess();
   		$this->paginate = array(
   			'conditions' => $this->Date->parseCriteria($this->passedArgs),
        );
   	    $this->set('results', $this->paginate());
   	    $this->set('title', '検索 ');
	}
  	//ここから上が検索・・・
	public function favorite() {
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/dates/favorite_sp');
			exit();
		} else {
			// PCだったら
			$this->redirect('/dates/favorite_pc');
			exit();
		}
	}

	public function favorite_pc(){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		for ($i=1; $i<4; $i++) { 
			switch ($i) {
				case 1: // カップル
					$lover = $this->User->getlover($user_id);
					$b = array();
					array_push($b, $user_id);
					array_push($b, $lover['User']['id']);
					break;
				case 2: // 自分
					$b = $user_id;
					break;		
				case 3: // 相手
					$lover = $this->User->getlover($user_id);
					$b = $lover['User']['id'];
					break;				
			}
			$date_ids = $this->Favorite->getfavodateid($b);
			$dates[$i] = $this->Date->getdate($date_ids);
			$dates[$i] = $this->_date_road($dates[$i]);
		}
		$this->set('dates', $dates);

		$this->set('title', 'お気に入り ');
	}

	public function favorite_sp(){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		for ($i=1; $i<4; $i++) { 
			switch ($i) {
				case 1: // カップル
					$lover = $this->User->getlover($user_id);
					$b = array();
					array_push($b, $user_id);
					array_push($b, $lover['User']['id']);
					break;
				case 2: // 自分
					$b = $user_id;
					break;		
				case 3: // 相手
					$lover = $this->User->getlover($user_id);
					$b = $lover['User']['id'];
					break;				
			}
			$date_ids = $this->Favorite->getfavodateid($b);
			$dates[$i] = $this->Date->getdate($date_ids);
			$dates[$i] = $this->_date_road($dates[$i]);
		}
		$this->set('dates', $dates);

		$this->set('title', 'お気に入り ');
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
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		$currenturl = Router::url( NULL, true );
		$this->set('currenturl', $currenturl);
		


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

		$this->set('title', 'デートの詳細 ');
	}

	public function date_sp($date_id) {
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

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

		$this->set('title', 'デートの詳細 ');
	}

	public function _date_road($dates){
		for ($i=0; $i < count($dates); $i++) {
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']); // いいね数の取得
			$dates[$i]['Date']['location'] = $this->Post->getlocation($dates[$i]['Date']['id']); // 位置情報の取得
			
			// カップルの読み込み
			$couple_id = $this->Date->getcoupleid($dates[$i]['Date']['id']);
			$users = $this->User->getuserfromcouple($couple_id);
			$a = array();
			for ($j=0; $j < 2; $j++) { 
				$users[$j]['User']['photo'] = $this->Photo->getuserphoto($users[$j]['User']['id']);
				$dates[$i]['Date']['user'][$j] = $users[$j]['User'];
			}

			// 写真の読み込み
			$posts = $this->Post->getpostids($dates[$i]['Date']['id']);
			$photos = $this->Photo->getpostallphotos($posts);
			if(!$photos){
				$dates[$i]['Date']['photo'] = null;
				continue;
			}
			$dates[$i]['Date']['photo'] = $photos[0];
		}
		return $dates;
	}
}