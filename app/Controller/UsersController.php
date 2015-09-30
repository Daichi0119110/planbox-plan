<?php 
App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class UsersController extends AppController {
	public $helper = array('HTML', 'form');

	public function setting($id) {
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

	public function signup() {
			if($this->request->is('post')){
			$this->User->save($this->request->data);
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
			var_dump($this->request->data);
			$mail=$this->request->data["User"]["mail"];
		
		$email = new CakeEmail('gmail');
		$email->from('example@gmail.com');
		//仮登録(あらたなテーブルを作成)して、フラグを立てる(24時間以内、あるいは改ざんの防止)
		$hashed_mail=crypt($mail,'$2y$04$GP9aBSZyYevt7Sdeb9HrJj');//
		$data=array('User'=>array('hashed_mail'=>$hashed_mail));
		$this->User->save($data);
		$email->to($mail);
		$email->subject($name);
		//メール送信する
		$email->send("http://".$_SERVER["HTTP_HOST"]."/users/add/".$hashed_mail);
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
			var_dump($data);
			//signupに飛ばすなりなんなりする
		}	
	}
}