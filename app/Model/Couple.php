<?php 
class Couple extends AppModel {

//	public $hasMany="Date";
	public $name='Couple';
	public $useTable='couples';

	function getcouple($id){
		$status=array(
			'conditions'=>
			array('id'=>$id)
		);
	return $this->find('all',$status);
	}

	function getcidfromuid($user_id){
		$status=array(
			'conditions'=>array(
				'OR'=>array(
					'male_id'=>$user_id,
					'female_id'=>$user_id,
					))
			);
		$data=$this->find('first',$status);
		return $data['Couple']['id'];
	}

	function makecouple($male_id,$female_id){
		$this->create();
		$data=array();
		$data['Couple']=array('male_id'=>$male_id,'female_id'=>$female_id);
		$this->save($data);
	}
}