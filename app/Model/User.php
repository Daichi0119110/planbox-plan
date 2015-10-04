<?php 
class User extends AppModel {
//	public $hasMany='Favorite';
	public $name='User';
	public $useTable='users';

	public function getuser($id){
			$status=array(
			'conditions'=>
			array('id'=>$id)
		);
	return $this->find('all',$status);
	}

	public function getcoupleid($id){
		$status=array(
			'conditions'=>
			array('id'=>$id)
		);
		$data=$this->find('all',$status);
		return $data['couple_id'];
	}
	
	public function getuseridfromcoupleids($couple_id){
		$status=array(
			'conditions'=>array('couple_id'=>$couple_id),
			'fields'=>array('id')
		);
		$datas=$this->find('all',$status);
		$user_ids = array();
		foreach ($datas as $data) {
			array_push($user_ids,$data['User']['id']);			
		}
		return $user_ids;
	}
}