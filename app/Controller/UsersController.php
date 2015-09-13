<?php 
App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class UsersController extends AppController {
	public $helper = array('HTML', 'form');

	public function mypage($id) {
		//user関数と機能が全く同じ。認証機能などをつけるべき？
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

	public function user($id) {
		$this->set('user',$this->User->getuser($id));
	}
	public function invite($id)//メール
	{
	//諸所設定はhttp://qiita.com/kazu56/items/cd58366f5fb74881ae06を見て行う
		$mail="";
		$name=$this->User->getuser($id)->name;
		if($this->request->is('post')){
			$mail=$this->request->data->mail;

		}
		$email = new CakeEmail('default');
		$email->from('planbox.date@gmail.com');
		//仮登録(あらたなテーブルが必要)して、フラグを立てる(24時間以内、あるいは改ざんの防止)
		$email->to($mail);
		$email->subject($name);
		//メール送信する
		$email->send('メール本文');
		//url作成をする必要。
	}
}