<?php 

class CouplesController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses=array('Couple','Date');
	public function couple($id) {
		
		//$this->set('couples', $this->Couple->find('all'));
		$this->set('couples',$this->Couple->getcouple($id));
		$this->set('mydate',$this->Date->getdatesfromcouple($id));//ここから記事の投稿数もとれる？
	}

	public function mypage($id) {
		
		//$this->set('couples', $this->Couple->find('all'));
		$this->set('couples',$this->Couple->getcouple($id));
		$this->set('mydate',$this->Date->getdatesfromcouple($id));//ここから記事の投稿数もとれる？
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
	$this->Date->deleateAll(array('Date.couple_id' => $id));	//投稿している記事も削除
	$this->Couple->deleate($id,false);//ユーザ情報は削除しない
	}

	public function signup() {
		if($this->request->is('post')){
			$this->Couple->save($this->request->data);
		}
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
	public function deleatemydate($date_id)
	{
		$this->date->deleate($date_id);
	}
	public function couple_pc() {

	}
	public function couple_sp() {

	}
}