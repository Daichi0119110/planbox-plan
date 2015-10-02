<?php 
class Date extends AppModel {
	/*public $hasMany=array(
		'Post','Favorite'
	);*/
	public $name='Date';
	public $useTable='dates';

	function getdate($id){
		$status=array(
			'conditions'=>
			array('id'=>$id)
		);
		return $this->find('all',$status);
	}

	function getdatesfromcouple($couple_ids){
		$status=array(
			'conditions'=>
			array('couple_id'=>$couple_ids)
		);
		return $this->find('all',$status);
	}

	function getnewdate(){
		$status=array(
			'conditions' => array('couple_id'=>$couple_ids),
			'order' => array('created'=> "desc"),
			'limit' => 5
		);
		return $this->find('all',$status);
	}
}