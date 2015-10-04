<?php 
class Photo extends AppModel {
	public $name='Photo';
	public $useTable='photos';

	function getphotos($post_id){
		$status=array(
				'conditions'=>array('post_id'=>$post_id),
				'fields'=>array('filename')
			);
		return $this->find('all',$status);
	}

	function getuserphoto($user_id){
		$status=array(
				'conditions'=>array('user_id'=>$user_id),
				'order'=>array('modified'=> "desc"),
				'fields'=>array('filename')
			);
		$photo = $this->find('first',$status);
		return $photo['Photo']['filename'];
	}

	function getpostallphotos($post_id){
		$status=array(
				'conditions'=>array('post_id'=>$post_id),
				'fields'=>array('filename')
			);
		$a = $this->find('all',$status);
		$photos = array();
		foreach ($a as $b) {
			array_push($photos, $b['Photo']['filename']);
		}
		return $photos;
	}
}