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

	function AddPosts($text,$time,$user_id){
		date_default_timezone_set('Asia/Tokyo');
		App::import('Model','Couple');
		$Couple=new Couple;
		$cid=$Couple->getcidfromuid($user_id);

		App::import('Model','Date');
		App::import('Model','Post');
		$Date=new Date;
		$Dateid=$Date->getRecentDate($time,$cid);
		$data=array();
		if($Dateid<0){
			$Dateid=-$Dateid;
			if($this->CheckDouble($text,$Dateid)==0){return;}
			

			$data['Post']=array(
 				'date_id'=>$Dateid,
 				'content'=>$text,);
			var_dump($data);

			if($this->CheckDouble($text,$Dateid)==0){return;}
		//	$Date->makenewDate($cid);
			$this->create();
			$this->save($data);
		}
		else{

 		/*	$data=array('Post',array(
 				'date_id'=>$Dateid,
 				'content'=>$text,
 			));*/
			if($this->CheckDouble($text,$Dateid)==0){return;}
			$data['Post']=array(
 				'date_id'=>$Dateid,
 				'content'=>$text,);
		//	var_dump($data);
			if($this->CheckDouble($text,$Dateid)==0){return;}
			$this->create();
 			$this->save($data);
 	//	echo $this->getDataSource()->getLog();
 		//	var_dump($data);
		}
		$Date->updatebyNewPost($time,$Dateid);
	}
	function CheckDouble($text,$date_id)
	{
		$status=array(
			'conditions'=>array(
				'content'=>$text,
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
	function GetRecentPostCreated($date_id)
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
		return $data['Post']['created'];
	}

}