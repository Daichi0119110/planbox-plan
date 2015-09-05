<?php 

class Date extends AppModel {
	public $name='Date';
	public $useTable='dates';

	function getdates($id){
	$status=array(
			'conditions'=>
			array('id'=>$id)
		);
	return $this->find('first',$status);
	}

	function getdatesfromcouple($Couple_id){
		$status=array(
			'conditions'=>
			array('couple_id'=>$Couple_id)
		);
		return $this->find('all',$status);
	}
}