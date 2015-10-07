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

	function AddPosts($text,$time,$user_id,$medias,$coordinates,$locatename){
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
			$locatenames=explode(" ", $locatename);//都道府県と市区町村に分割
	//		var_dump($locatenames);
			$data['Post']=array(
 				'date_id'=>$Dateid,
 				'content'=>$text,
 				'state'=>$locatenames['0'],
 				'city'=>$locatenames['1'],
 				);
		//	var_dump($data);
			if($this->CheckDouble($text,$Dateid,$time)==0){echo "4return";return;}
		//	$location=$this->Getfromcoordinates($coordinates);
		//var_dump($location);
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
	function Getfromcoordinates($coordinates)//緯度経度から取得。今は使わず。(正確な住所まで求められるので、きちんとやれば施設名まで求められると思います。)
	{
		var_dump($coordinates);
		var_dump($coordinates->coordinates['0']);
		$url="http://maps.google.com/maps/api/geocode/json?latlng=".$coordinates->coordinates['1'].",".$coordinates->coordinates['0']."&sensor=false&language=jp";
		$json=file_get_contents($url);
		$decoded=json_decode($json, true);
		return $decoded;
	}
}