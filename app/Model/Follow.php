<?php 
class Follow extends AppModel {
	public $name='Follow';
	public $useTable='follows';

	function getcoupleid($id){
		$status=array(
			'conditions'=>
			array('user_id'=>$id),
			'fields'=>
			array('couple_id')
		);
		return $this->find('all', $status);
	}
}