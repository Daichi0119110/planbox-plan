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
		$photo = $this->find('first', $status);
		if (!$photo){
			return null;
		}
		return $photo['Photo']['filename'];
	}

	function getpostallphotos($post_id){
		$status=array(
				'conditions'=>array('post_id'=>$post_id),
				'fields'=>array('filename')
			);
		$a = $this->find('all',$status);
		if (!$a) {
			return null;
		} else{
			$photos = array();
			foreach ($a as $b) {
				array_push($photos, $b['Photo']['filename']);
			}
			return $photos;
		}
	}

	function loadgraphs($postid,$url){
		var_dump($postid);
		var_dump($url);
		$graph=file_get_contents($url);
		$filename=hash('ripemd160',$url).'.jpg';
		file_put_contents('./img/'.$filename,$graph);
		$data=array();
		$this->create();
		$data['Photo']=array('post_id'=>$postid,'filename'=>$filename);
		$this->save($data);
		
		//var_dump($graph);

	
	
	}
}