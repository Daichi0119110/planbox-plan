<?php 
class Post extends AppModel {
	public $name='Post';
	public $useTable='posts';
	//public $hasMany='Photo';

	function getposts($date_id){
		$status=array(
			'conditions'=>array('date_id'=>$date_id)
		);
		return $this->find('all',$status);
	}

	function getpostids($date_id){
		$status=array(
			'conditions'=>array('date_id'=>$date_id),
			'fields'=>array('id')
		);
		$a = $this->find('all',$status);
		$post_ids = array();
		foreach ($a as $b) {
			array_push($post_ids, $b['Post']['id']);
		}
		return $post_ids;
	}
}