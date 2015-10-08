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
	}

	public function setting_sp($user_id){
		// セッションを確認（登録しているか確認）→なければ登録/ログイン画面へ
		if(!$this->Session->check('user_id')){
			$this->redirect('/users/signup');
		}
		$user_id = $this->Session->read('user_id');

		$this->set('user',$this->User->getuser($user_id));
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

	public function upload()
	{

	}
}