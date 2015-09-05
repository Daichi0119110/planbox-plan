<?php 
class Photo extends AppModel {
	public $name='Photo';
	public $useTable='photos';

	function getposts($post_id){
	$status=array(
			'conditions'=>
			array('post_id'=>$post_id)
		);
	return $this->find('all',$status);
	}
}