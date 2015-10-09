<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {
	public $uses = array('Date','Follow','Favorite','Post','User','Photo');

	public function index(){
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/pages/index_sp');
			exit();
		} else {
			// PCだったら
			$this->redirect('/pages/index_pc');
			exit();
		}
	}

	public function index_pc(){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		// フィード
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
			$dates_follow = $this->Date->getdatesfromcouple($this->Follow->getcoupleids($b));
			$a[$i] = $this->_date_road($dates_follow);
		}
		$this->set('dates_follow', $a);

		// おすすめ
		$couple_ids = $this->Follow->getcoupleids($user_id);
		$user_ids = $this->User->getuseridfromcoupleids($couple_ids);
		$date_ids_recommend = $this->Favorite->getfavodateid($user_ids);
		$dates_recommend = $this->Date->getdate($date_ids_recommend);
		$this->_date_set('dates_recommend', $dates_recommend);

		// ランキング
		$ranking_dates = $this->ranking();
		$this->_date_set('ranking_dates', $ranking_dates);

		// 新着
		$dates_new = $this->Date->getnewdate();
		$this->_date_set('dates_new', $dates_new);

		$this->set('title', 'トップページ ');
	}

		public function index_sp(){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		// フィード
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
			$dates_follow = $this->Date->getdatesfromcouple($this->Follow->getcoupleids($b));
			$a[$i] = $this->_date_road($dates_follow);
		}
		$this->set('dates_follow', $a);

		// おすすめ
		$couple_ids = $this->Follow->getcoupleids($user_id);
		$user_ids = $this->User->getuseridfromcoupleids($couple_ids);
		$date_ids_recommend = $this->Favorite->getfavodateid($user_ids);
		$dates_recommend = $this->Date->getdate($date_ids_recommend);
		$this->_date_set('dates_recommend', $dates_recommend);

		// ランキング
		$ranking_dates = $this->ranking();
		$this->_date_set('ranking_dates', $ranking_dates);

		// 新着

		$this->set('title', 'トップページ ');
	}

	// いいね数・場所・カップル・写真の読み込み、viewにセット
	function _date_set($name, $dates){
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
		$this->set($name, $dates);
		return true;
	}

	// いいね数・場所・カップル・写真の読み込みのみ
	function _date_road($dates){
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

	// ランキングの作成
	function ranking(){
		$date_ids = $this->Date->getalldateids();
		$ranking_date_id = array();
		foreach ($date_ids as $date_id) {
			$ranking_date_id += array($date_id => $this->Favorite->getfavonumber($date_id));
		}
		arsort($ranking_date_id);
		return $this->Date->getdate(array_keys($ranking_date_id));
	}
}
