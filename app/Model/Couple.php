<?php 

class Couple extends AppModel {
	public $name='Couple';
	public $useTable='couples';

	function getcouple($id){
		$status=array(
			'conditions'=>
			array('id'=>$id)
		);
return $this->find('first',$status);
	}

	function getAllcouple(){
return $this->find('all');
	}
}