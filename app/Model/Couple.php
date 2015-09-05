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
}