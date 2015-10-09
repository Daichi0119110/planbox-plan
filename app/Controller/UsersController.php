<?php 
App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class UsersController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('User', 'Date','Couple','Photo');

	public function setting() {
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/users/setting_sp');
			exit();
		} else {
			// PCだったら
			$this->redirect('/users/setting_pc');
			exit();
		}
	}

	public function setting_pc(){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');

		$this->set('user',$this->User->getuser($user_id));

		$this->set('title', '設定 ');
	}

	public function setting_sp($user_id){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');

		$this->set('user',$this->User->getuser($user_id));

		$this->set('title', '設定 ');
	}
	
	public function edit($id) {
	//フォームとして送られてくることを想定
		$this->User->id=$id;
		if($this->request->is('post')||$this->request->is('put')){
			$this->User->save($this->request->data);
	//		$this->User->redirect(array('action'=>'./mypage'));
		}else{
			$this->request->data=$this->User->read(null,$id);
		}

	}

	public function signup($isinvited=null) {
		$this->set('title', '新規登録 ');

		if($this->request->is('post')){
			$this->User->save($this->request->data);

			$myid=$this->User->isexistname($this->request->data['User']['name']);
			if($isinvited==null){
				return $this->redirect(
        			array('controller' => 'Users', 'action' => 'setting',$myid));
			}
			else{
				$partner_id=$this->User->getuseridfromhash($isinvited);
				if($this->request->data['User']['gender']==0){
					$this->Couple->MakeCouple($myid,$partner_id);	
				}
				else{
					$this->Couple->MakeCouple($partner_id,$myid);	
				}

				$data=array();
				$this->create();
				$data['User']=array('id'=>$partner_id,'hashed_mail'=>'');
				$this->save($data);
				return $this->redirect(
        			array('controller' => 'Users', 'action' => 'setting',$myid));
			}
		}	
		$this->Session->write('user_id',1); // sessionにuser_idを保存
	}

	public function invite($id)//メール
	{
	//諸所設定はhttp://qiita.com/kazu56/items/cd58366f5fb74881ae06を見て行う
		$mail="";//メールアドレス
		$user=$this->User->getuser($id);
	//var_dump($user[0]["User"]);
		$name=$user[0]["User"]["name"];
		if($this->request->is('post')){
		//	var_dump($this->request->data);
		$mail=$this->request->data["User"]["mail"];
		
		$email = new CakeEmail('gmail');
		$email->from('planbox26@gmail.com');
		//仮登録(あらたなテーブルを作成)して、フラグを立てる(24時間以内、あるいは改ざんの防止)
		$hashed_mail=crypt($mail,'$2y$04$GP9aBSZyYevt7Sdeb9HrJj');//
		$data=array('User'=>array('hashed_mail'=>$hashed_mail));
	//	$this->User->save($data);
		$email->to($mail);
		$email->subject($name);
		//メール送信する
		$email->send("http://".$_SERVER["HTTP_HOST"]."/users/add/".$hashed_mail);

		$userdata['User']=array('id'=>$id,'hashed_mail'=>$hashed_mail);
		$this->User->save($userdata);

		return $this->redirect(
        			array('controller' => 'Users', 'action' => 'setting',$myid));
		}
	}

	public function add($hashed_mail)
	{
		$status=array(
			'conditions'=>
			array('hashed_mail'=>$hashed_mail)
		);
		$data=$this->User->find('all',$status);
		if(empty($data)){

		}else{
			return $this->redirect(
       			array('controller' => 'Users', 'action' => 'signup',$hashed_mail));
		}	
	}

	public function authorize_instagram(){

		// 設定
        $client_id = 'bff070ff8e144cbfb70e344fa5a2f27e' ;       // クライアントID 
        $client_secret = '1f3892ae4dad4350be7921316953cb7e' ;       // クライアントシークレット
		
		$redirect_uri = explode( '?' , ( !isset($_SERVER['HTTPS']) || empty($_SERVER['HTTPS']) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] )[0] ;		// このプログラムを設置するURL
		// $redirect_uri = "http://k0hei.science/planbox_instatest/users/authorize_instagram";
		$scope = 'basic' ;		// スコープ

		// セッションスタート
		session_start() ;
		// モーダル的なメッセージ用
		$message = '' ;

		// [手順2] リクエストトークン($_GET["code"])とアクセストークンの交換
		if( isset($_GET['code']) && !empty($_GET['code']) && isset($_SESSION['state']) && !empty($_SESSION['state']) && isset($_GET['state']) && !empty($_GET['state']) && $_SESSION['state'] == $_GET['state'] )
		{
			// リクエスト用のコンテキストを作成
			$context = array(
				'http' => array(
					'method' => 'POST' ,
					'content' => http_build_query( array(
						'client_id' => $client_id ,
						'client_secret' => $client_secret ,
						'grant_type' => 'authorization_code' ,
						'redirect_uri' => $redirect_uri ,
						'code' => $_GET['code'] ,
					) ) ,
				) ,
			) ;
			// CURLを使ってリクエスト
			$curl = curl_init() ;

			// オプションのセット
			curl_setopt( $curl , CURLOPT_URL , 'https://api.instagram.com/oauth/access_token' ) ;
			curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
			curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , $context['http']['method'] ) ;			// メソッド
			curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;								// 証明書の検証を行わない
			curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
			curl_setopt( $curl , CURLOPT_POSTFIELDS , $context['http']['content'] ) ;			// リクエストボディ
			curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;										// タイムアウトの秒数

			// 実行
			$res1 = curl_exec( $curl ) ;
			$res2 = curl_getinfo( $curl ) ;

			// 終了
			curl_close( $curl ) ;

			// 取得したデータ
			$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
			$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)

			// 取得したJSONをオブジェクトに変換
			$obj = json_decode( $json ) ;

			// エラー判定
			if( !$obj || !isset($obj->user->id) || !isset($obj->user->username) || !isset($obj->user->profile_picture) || !isset($obj->access_token) )
			{
				$error = 'データを上手く取得できませんでした…。後ほど，再度お試しください。' ;
			}

			else
			{
				// 各データを整理
				$insta_id = $obj->user->id;		// ユーザーID
				$user_name = $obj->user->username ;		// ユーザーネーム
				$user_picture = $obj->user->profile_picture ;		// ユーザーアイコン
				$access_token = $obj->access_token ;		// アクセストークン

				$user_id = $this->Session->read('user_id');	


				$user = $this->User->getuser($user_id);
				$pic = $user['photo'];	            

	            if(empty($pic)){
					//登録する値
					$data = array('User' => array('id' => $user_id, 'name_insta' => $user_name, 'photo' => $user_picture,'insta_id' => $insta_id, 'insta_token' => $access_token));
					// 登録するフィールド
					$fields = array('name_insta','photo' ,'insta_id', 'insta_token');
					// 更新
					$this->User->save($data, false, $fields);	            		            		            	
	            }
	            else{

					//登録する値
					$data = array('User' => array('id' => $user_id, 'name_insta' => $user_name, 'insta_id' => $insta_id, 'insta_token' => $access_token));
					// 登録するフィールド
					$fields = array('name_insta','insta_id', 'insta_token');
					// 更新
					$this->User->save($data, false, $fields);	            		            	
	            }

				// セッション終了
				// $_SESSION = array() ; // 他の消す恐れ
				session_destroy() ;


				$this->setting($user_id);
			}
		}
		// [手順1] 初回アクセスの場合、ユーザーをアプリ認証画面へアクセスさせる
		else
		{
			// CSRF対策
			session_regenerate_id( true ) ;
			$state = sha1( uniqid( mt_rand() , true ) ) ;
			$_SESSION['state'] = $state ;
			// リダイレクトさせる
			header( 'Location: https://api.instagram.com/oauth/authorize/?client_id=' . $client_id . '&redirect_uri=' . rawurlencode( $redirect_uri ) . '&scope=' . $scope . '&response_type=code&state=' . $state ) ;

			exit ;
		}

		// エラー時の処理
		if( isset($error) || !empty($error) )
		{
			$message = '<p><mark>' . $error . '</mark>エラーが発生しました。もう一度認証をするには、<a href="' . explode( '?' , $_SERVER['REQUEST_URI'] )[0] . '">こちら</a>をクリックして下さい。</p>' ;
			// モーダル的にメッセージを出す
		}
	}

	public function upload()
	{

	}
}