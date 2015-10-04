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