<?php 

class CouplesController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses=array('Couple','Date','Post','User','Favorite','Follow','Photo');

	public function couple($couple_id) {
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/couples/couple_sp/'.$couple_id);
			exit();
		} else {
			// PCだったら
			$this->redirect('/couples/couple_pc/'.$couple_id);
			exit();
		}
	}

	public function couple_pc($couple_id){
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		// カップル情報の取得
		$our = $this->Couple->getcouple($couple_id);
		$our[0]['Couple']['num_follow'] = $this->Follow->getnumber($our[0]['Couple']['id']);
		$this->set('our',$our);
		$users = $this->User->getuserfromcouple($couple_id);
		$users[0]['User']['photo'] = $this->Photo->getuserphoto($users[0]['User']['id']);
		$users[1]['User']['photo'] = $this->Photo->getuserphoto($users[1]['User']['id']);
		$this->set('users', $users);

		// カルーセル用の写真の取得
		$date_ids = $this->Date->getdateidsfromcouple($couple_id);
		$post_ids = $this->Post->getpostids($date_ids);
		$this->set('photos', $this->Photo->getpostallphotos($post_ids));

		// デートの情報の取得
		$dates = $this->Date->getdatesfromcouple($couple_id);
		for ($i=0; $i < count($dates); $i++) {
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']); // いいね数の取得
			$dates[$i]['Date']['city'] = $this->Post->getlocation($dates[$i]['Date']['id']); // 位置情報の取得

			// 写真の読み込み
			$posts = $this->Post->getpostids($dates[$i]['Date']['id']);
			$photos = $this->Photo->getpostallphotos($posts);
			if(!$photos){
				$dates[$i]['Date']['photo'] = null;
				continue;
			}
			$dates[$i]['Date']['photo'] = $photos[0];
		}
		$this->set('dates', $dates);

		// フォローしているカップルの取得
		$user_ids = array($users[0]['User']['id'], $users[1]['User']['id']);
		$couple_ids = $this->Follow->getcoupleids($user_ids);
		$couples = $this->Couple->getcouple($couple_ids);
		for($i=0; $i < count($couples); $i++){
			$users_follow = $this->User->getuserfromcouple($couples[$i]['Couple']['id']);
			$a = array();
			for ($j=0; $j < 2; $j++) { 
				$users_follow[$j]['User']['photo'] = $this->Photo->getuserphoto($users_follow[$j]['User']['id']);
				$couples[$i]['Couple']['user'][$j] = $users_follow[$j]['User'];
				$couples[$i]['Couple']['user'][$j]['photo'] = $this->Photo->getuserphoto($couples[$i]['Couple']['user'][$j]['id']);
			}
			$couples[$i]['Couple']['num_follow'] = $this->Follow->getnumber($couples[$i]['Couple']['id']);
		}
		$this->set('couples', $couples);

		//グレードの取得
		$points=0;
		$followerscount=$this->Follow->getnumber($couple_id);
		$datecount=count($this->Date->getdatesfromcouple($couple_id));
		for ($i=0; $i < count($dates); $i++) {
			$points+=$dates[$i]['Date']['favo']*5; 
			$points+=$dates[$i]['Date']['num_view'];
		}
		
		$points+=$followerscount*30;
		$points+=$datecount*20;

		$this->set('points',$points);
		//view 1 ikitai 5 toukou 20 follower=30
		$this->set('title', 'カップル ');
	}

	public function couple_sp($couple_id){
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		// カップル情報の取得
		$our = $this->Couple->getcouple($couple_id);
		$our[0]['Couple']['num_follow'] = $this->Follow->getnumber($our[0]['Couple']['id']);
		$this->set('our',$our);
		$users = $this->User->getuserfromcouple($couple_id);
		$users[0]['User']['photo'] = $this->Photo->getuserphoto($users[0]['User']['id']);
		$users[1]['User']['photo'] = $this->Photo->getuserphoto($users[1]['User']['id']);
		$this->set('users', $users);

		// カルーセル用の写真の取得
		$date_ids = $this->Date->getdateidsfromcouple($couple_id);
		$post_ids = $this->Post->getpostids($date_ids);
		$this->set('photos', $this->Photo->getpostallphotos($post_ids));

		// デートの情報の取得
		$dates = $this->Date->getdatesfromcouple($couple_id);
		for ($i=0; $i < count($dates); $i++) {
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']); // いいね数の取得
			$dates[$i]['Date']['city'] = $this->Post->getlocation($dates[$i]['Date']['id']); // 位置情報の取得

			// 写真の読み込み
			$posts = $this->Post->getpostids($dates[$i]['Date']['id']);
			$photos = $this->Photo->getpostallphotos($posts);
			if(!$photos){
				$dates[$i]['Date']['photo'] = null;
				continue;
			}
			$dates[$i]['Date']['photo'] = $photos[0];
		}
		$this->set('dates', $dates);

		// フォローしているカップルの取得
		$user_ids = array($users[0]['User']['id'], $users[1]['User']['id']);
		$couple_ids = $this->Follow->getcoupleids($user_ids);
		$couples = $this->Couple->getcouple($couple_ids);
		for($i=0; $i < count($couples); $i++){
			$users_follow = $this->User->getuserfromcouple($couples[$i]['Couple']['id']);
			$a = array();
			for ($j=0; $j < 2; $j++) { 
				$users_follow[$j]['User']['photo'] = $this->Photo->getuserphoto($users_follow[$j]['User']['id']);
				$couples[$i]['Couple']['user'][$j] = $users_follow[$j]['User'];
				$couples[$i]['Couple']['user'][$j]['photo'] = $this->Photo->getuserphoto($couples[$i]['Couple']['user'][$j]['id']);
			}
			$couples[$i]['Couple']['num_follow'] = $this->Follow->getnumber($couples[$i]['Couple']['id']);
		}
		$this->set('couples', $couples);

		//グレードの取得
		$points=0;
		$followerscount=$this->Follow->getnumber($couple_id);
		$datecount=count($this->Date->getdatesfromcouple($couple_id));
		for ($i=0; $i < count($dates); $i++) {
			$points+=$dates[$i]['Date']['favo']*5; 
			$points+=$dates[$i]['Date']['num_view'];
		}
		
		$points+=$followerscount*30;
		$points+=$datecount*20;

		$this->set('points',$points);
		//view 1 ikitai 5 toukou 20 follower=30
		$this->set('title', 'カップル ');
	}
	
	public function mypage() {
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/couples/mypage_sp');
			exit();
		} else {
			// PCだったら
			$this->redirect('/couples/mypage_pc');
			exit();
		}
	}

	public function mypage_pc(){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		// カップル情報の取得
		$couple_id = $this->User->getcoupleid($user_id);
		$this->set('our',$this->Couple->getcouple($couple_id));
		$users = $this->User->getuserfromcouple($couple_id);
		$users[0]['User']['photo'] = $this->Photo->getuserphoto($users[0]['User']['id']);
		$users[1]['User']['photo'] = $this->Photo->getuserphoto($users[1]['User']['id']);
		$this->set('users', $users);

		// カルーセル用の写真の取得
		$date_ids = $this->Date->getdateidsfromcouple($couple_id);
		$post_ids = $this->Post->getpostids($date_ids);
		$this->set('photos', $this->Photo->getpostallphotos($post_ids));

		// デートの情報の取得
		$dates = $this->Date->getdatesfromcouple($couple_id);
		for ($i=0; $i < count($dates); $i++) {
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']); // いいね数の取得
			$dates[$i]['Date']['city'] = $this->Post->getlocation($dates[$i]['Date']['id']); // 位置情報の取得

			// 写真の読み込み
			$posts = $this->Post->getpostids($dates[$i]['Date']['id']);
			$photos = $this->Photo->getpostallphotos($posts);
			if(!$photos){
				$dates[$i]['Date']['photo'] = null;
				continue;
			}
			$dates[$i]['Date']['photo'] = $photos[0];
		}
		$this->set('dates', $dates);

		// フォローしているカップルの取得
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
			$couple_ids = $this->Follow->getcoupleids($b);
			$couples[$i] = $this->Couple->getcouple($couple_ids);
			for($k=0; $k < count($couples[$i]); $k++){
				$users_follow = $this->User->getuserfromcouple($couples[$i][$k]['Couple']['id']);
				$a = array();
				for ($j=0; $j < 2; $j++) { 
					$users_follow[$j]['User']['photo'] = $this->Photo->getuserphoto($users_follow[$j]['User']['id']);
					$couples[$i][$k]['Couple']['user'][$j] = $users_follow[$j]['User'];
					$couples[$i][$k]['Couple']['user'][$j]['photo'] = $this->Photo->getuserphoto($couples[$i][$k]['Couple']['user'][$j]['id']);
				}
			}
		}
		$this->set('couples', $couples);
		$this->set('title', 'マイページ ');
	}

	public function mypage_sp($user_id){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');
		$this->set('user_id', $user_id);

		// カップル情報の取得
		$couple_id = $this->User->getcoupleid($user_id);
		$this->set('our',$this->Couple->getcouple($couple_id));
		$users = $this->User->getuserfromcouple($couple_id);
		$users[0]['User']['photo'] = $this->Photo->getuserphoto($users[0]['User']['id']);
		$users[1]['User']['photo'] = $this->Photo->getuserphoto($users[1]['User']['id']);
		$this->set('users', $users);

		// カルーセル用の写真の取得
		$date_ids = $this->Date->getdateidsfromcouple($couple_id);
		$post_ids = $this->Post->getpostids($date_ids);
		$this->set('photos', $this->Photo->getpostallphotos($post_ids));

		// デートの情報の取得
		$dates = $this->Date->getdatesfromcouple($couple_id);
		for ($i=0; $i < count($dates); $i++) {
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']); // いいね数の取得
			$dates[$i]['Date']['city'] = $this->Post->getlocation($dates[$i]['Date']['id']); // 位置情報の取得

			// 写真の読み込み
			$posts = $this->Post->getpostids($dates[$i]['Date']['id']);
			$photos = $this->Photo->getpostallphotos($posts);
			if(!$photos){
				$dates[$i]['Date']['photo'] = null;
				continue;
			}
			$dates[$i]['Date']['photo'] = $photos[0];
		}
		$this->set('dates', $dates);

		// フォローしているカップルの取得
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
			$couple_ids = $this->Follow->getcoupleids($b);
			$couples[$i] = $this->Couple->getcouple($couple_ids);
			for($k=0; $k < count($couples[$i]); $k++){
				$users_follow = $this->User->getuserfromcouple($couples[$i][$k]['Couple']['id']);
				$a = array();
				for ($j=0; $j < 2; $j++) { 
					$users_follow[$j]['User']['photo'] = $this->Photo->getuserphoto($users_follow[$j]['User']['id']);
					$couples[$i][$k]['Couple']['user'][$j] = $users_follow[$j]['User'];
					$couples[$i][$k]['Couple']['user'][$j]['photo'] = $this->Photo->getuserphoto($couples[$i][$k]['Couple']['user'][$j]['id']);
				}
			}
		}
		$this->set('couples', $couples);
		$this->set('title', 'マイページ ');
	}

	public function edit($id) {
		//フォームとして送られてくることを想定
		$this->Couple->id=$id;
		if($this->request->is('post')||$this->request->is('put')){
			$this->Couple->save($this->request->data);
	//		$this->Couple->redirect(array('action'=>'Couple'));
		}else{
			$this->request->data=$this->Couple->read(null,$id);
		}
	}
//
	public function delete($id){
	//$this->Date->deleteAll(array('couple_id' => $id));	//投稿している記事の削除
	$this->Couple->delete($id,false);//ユーザ情報は削除しない
	}

	public function signup() {
		if($this->request->is('post')){
			$this->Couple->save($this->request->data);
		}
		$this->set('title', 'サインアップ');
	}
	public function editmydate($date_id)//coupleから飛んでくる？
	{
		$this->Date->id = $date_id;
    if ($this->request->is('post') || $this->request->is('put')) {
      $this->Date->save($this->Date->data);
      $this->redirect(array('action' => 'couple'));
    } else {
      $this->request->data = 
          $this->Date->read(null, $date_id);
    }
		
	}
	public function deletemydate($date_id)
	{
		$this->date->delete($date_id);
	}
}