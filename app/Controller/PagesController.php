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

	public function index_pc($user_id){
		$user_id = 1; // 一旦idを1とする
		// フィード
		$dates_follow = $this->Date->getdatesfromcouple($this->Follow->getcoupleids($user_id));
		$this->_date_road('dates_follow', $dates_follow);

		// おすすめ
		$couple_ids = $this->Follow->getcoupleids($user_id);
		$user_ids = $this->User->getuseridfromcoupleids($couple_ids);
		$date_ids_recommend = $this->Favorite->getfavodateid($user_ids);
		$dates_recommend = $this->Date->getdate($date_ids_recommend);
		$this->_date_road('dates_recommend', $dates_recommend);

		// ランキング
		$date_ids = $this->Date->getalldateids();
		$ranking_date_id = array();
		foreach ($date_ids as $date_id) {
			$ranking_date_id += array($date_id => $this->Favorite->getfavonumber($date_id));
		}
		arsort($ranking_date_id);
		$ranking_dates = $this->Date->getdate(array_keys($ranking_date_id));
		// いいね数の取得
		for ($i=0; $i < count($ranking_dates); $i++) { 
			$ranking_dates[$i]['Date']['favo'] = $this->Favorite->getnumber($ranking_dates[$i]['Date']['id']);
		}
		$this->set('ranking_dates', $ranking_dates);
	}

		public function index_sp($user_id){
		$user_id = 1; // 一旦idを1とする
		// フィード
		$dates_follow = $this->Date->getdatesfromcouple($this->Follow->getcoupleids(1));

		// いいね数の取得
		for ($i=0; $i < count($dates_follow); $i++) { 
			$dates_follow[$i]['Date']['favo'] = $this->Favorite->getnumber($dates_follow[$i]['Date']['id']);
		}
		$this->set('dates_follow', $dates_follow);

		// おすすめ
		$couple_ids = $this->Follow->getcoupleids($user_id);
		$user_ids = $this->User->getuseridfromcoupleids($couple_ids);
		$date_ids_recommend = $this->Favorite->getfavodateid($user_ids);
		$dates_recommend = $this->Date->getdate($date_ids_recommend);

		// いいね数の取得
		for ($i=0; $i < count($dates_recommend); $i++) { 
			$dates_recommend[$i]['Date']['favo'] = $this->Favorite->getnumber($dates_recommend[$i]['Date']['id']);
		}
		$this->set('dates_recommend', $dates_recommend);

		// ランキング
		$date_ids = $this->Date->getalldateids();
		$ranking_date_id = array();
		foreach ($date_ids as $date_id) {
			$ranking_date_id += array($date_id => $this->Favorite->getfavonumber($date_id));
		}
		arsort($ranking_date_id);
		$ranking_dates = $this->Date->getdate(array_keys($ranking_date_id));
		// いいね数の取得
		for ($i=0; $i < count($ranking_dates); $i++) { 
			$ranking_dates[$i]['Date']['favo'] = $this->Favorite->getnumber($ranking_dates[$i]['Date']['id']);
		}
		$this->set('ranking_dates', $ranking_dates);
	}

	// いいね数・場所・写真の読み込み
	function _date_road($name, $dates){
		for ($i=0; $i < count($dates); $i++) {
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']); // いいね数の取得
			$dates[$i]['Date']['location'] = $this->Post->getlocation($dates[$i]['Date']['id']); // 位置情報の取得
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
}
