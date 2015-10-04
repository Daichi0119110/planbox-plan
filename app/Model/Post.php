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

	function AddPosts($text,$time,$user_id,$medias){
	//	var_dump($medias);
		date_default_timezone_set('Asia/Tokyo');
		App::import('Model','Couple');
		$Couple=new Couple;
		$cid=$Couple->getcidfromuid($user_id);

		App::import('Model','Date');
		App::import('Model','Post');
		$Date=new Date;
		$Dateid=$Date->getRecentDate($time,$cid);

 		/*	$data=array('Post',array(
 				'date_id'=>$Dateid,
 				'content'=>$text,
 			));*/
	//		if($this->CheckDouble($text,$Dateid)==0){echo "3return";return;}
			$data['Post']=array(
 				'date_id'=>$Dateid,
 				'content'=>$text,);
		//	var_dump($data);
			if($this->CheckDouble($text,$Dateid,$time)==0){echo "4return";return;}
			$this->create();
			echo "saved!!!";
 			$this->save($data);
 		

 	//	echo $this->getDataSource()->getLog();
 		//	var_dump($data);
		echo "確認";
		$mypostid=$this->GetRecentPostid($Dateid);
		App::import('Model','Photo');
 			$Photo=new Photo;
 			var_dump($medias);
 			foreach ($medias as $value) {

 				$Photo->loadgraphs($mypostid,$value->media_url);
 			}

		$Date->updatebyNewPost($time,$Dateid);
	}
	function CheckDouble($text,$date_id,$time)
	{
		$status=array(
			'conditions'=>array(
				'OR'=>array(
					'content'=>$text,
					'created'=>$time->format('Y-m-d H:i:s')),
				'date_id'=>$date_id,
				));
		$data=$this->find('first',$status);
	//	var_dump($data);
		if(empty($data)){
		//echo "empty";
		return 1;}
		//echo "notempty";
		return 0;
	}
	function GetRecentPostid($date_id)
	{
		$status=array(
			'order'=>'created DESC',
			'conditions'=>array(
				'date_id'=>$date_id,
				//finished=> 0
				//上は追加のコメントとかを付けたときに1にして、そうすると検索結果から外れる
				)
			);
		$data=$this->find('first',$status);
		return $data['Post']['id'];
	}

	function getlocation($date_id){
		$status=array(
			'conditions'=>array('date_id'=>$date_id),
			'fields'=>array('location')
		);
		$a = $this->find('first',$status);
		return $a['Post']['location'];
	}

}