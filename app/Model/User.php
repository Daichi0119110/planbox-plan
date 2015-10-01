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

	public function isexistname($name){
		$status=array(
			'conditions' => 
			array('name'=>$name)
		);
		$data=$this->find('first',$status);
		if(empty($data)){return 0;}
		else{return $data["User"]["id"];}

		
	}
	
}