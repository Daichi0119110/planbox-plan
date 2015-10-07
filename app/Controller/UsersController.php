<?php 
App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class UsersController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('User', 'Date','Couple','Photo');

	public function setting($id) {
		$this->autoRender = false;
		$this->autoLayout = false;

		// スマホかPCを判別して振り分け
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(iPhone|Android.*Mobile|Windows.*Phone)/', $ua)) {
			// スマホだったら
			$this->redirect('/users/setting_sp/'.$id);
			exit();
		} else {
			// PCだったら
			$this->redirect('/users/setting_pc/'.$id);
			exit();
		}
	}

	public function setting_pc($id){
		$this->set('user',$this->User->getuser($id));
	}

	public function setting_sp($id){
		$this->set('user',$this->User->getuser($id));
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
			$myid=$this->User->isexistname($this->request->data['name']);
			if($isinvited==null){
				return $this->redirect(
        			array('controller' => 'Users', 'action' => 'invite',$myid));
			}
			else{
				$this->Couple->MakeCouple($myid,$this->User->getuseridfromhash($isinvited));
			}
		}	
		
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
		$email->from('example@gmail.com');
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
			//signupに飛ばすなりなんなりする
		}	
	}
}