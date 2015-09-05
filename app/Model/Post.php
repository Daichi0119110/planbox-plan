<?php 
class Post extends AppModel {
	public $name='Post';
	public $useTable='posts';
	//public $hasMany='Photo';
	function getposts($date_id){
	$status=array(
			'conditions'=>
			array('date_id'=>$date_id)
		);
	return $this->find('all',$status);
	}
}