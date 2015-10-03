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
		App::import('Model','Couple');
		$Couple=new Couple;
		$cid=$Couple->getcidfromuid($user_id);
		$nowdate=date_create_from_format('D M d H:i:s O Y',$time);
		$formated=date_format($nowdate,'Y-m-d H:i:s');
		$formated=strtotime('+9 hour',$formated);
		App::import('Model','Date');
		$Date=new Date;
		$Dateid=$Date->getRecentDate($time,$cid);
		if($Dateid<0){
			$Date->makenewDate($cid);
		}
		else{
 			$data=array('Post',array(
 				'date_id'=>$cid,
 				'content'=>$text,
 			));
		}
	}

}