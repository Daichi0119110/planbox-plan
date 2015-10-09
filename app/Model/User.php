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
			'conditions'=>array('id'=>$id),
			'fields'=>array('couple_id')
		);
		$data=$this->find('first',$status);
		return $data['User']['couple_id'];
	}

	public function isexistname($name){
		$status=array(
			'conditions' => 
			array('name'=>$name)
		);
		$data=$this->find('first',$status);
		if(empty($data)){return 0;}
		else{return $data["User"]["id"];}

		
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

	public function getuserfromcouple($couple_id){
		$status=array(
			'conditions'=>array('couple_id'=>$couple_id),
			'order'=>array('gender')
		);
		return $this->find('all',$status);
	}

	public function getuseridfromhash($hashed_mail){
		$status=array(
			'conditions'=>array('hashed_mail'=>$hashed_mail)
			);
		$data=$this->find('first',$status);
		return $data['User']['id'];
	}
	public function getlover($user_id){
		$status=array('conditions'=>array('id'=>$user_id));
		$data=$this->find('first',$status);
		$status=array(
			'conditions'=>array(
				'couple_id'=>$data['User']['couple_id'],
				'id !='=>$user_id
			)

		);
		$user=$this->find('first',$status);
		return $user;
	}
}