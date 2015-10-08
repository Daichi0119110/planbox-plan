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

	function AddPosts($text,$time,$user_id,$medias,$ido,$keido,$state,$city){
	//	var_dump($medias);
		date_default_timezone_set('Asia/Tokyo');
		App::import('Model','Couple');
		$Couple=new Couple;
		$cid=$Couple->getcidfromuid($user_id);//ユーザIDからカップルIDを持ってきます

		App::import('Model','Date');
		App::import('Model','Post');
	//		var_dump($locatenames);
		
		$Date=new Date;
		$Dateid=$Date->getRecentDate($time,$cid,$state,$city);//時間とカップルIDから入れるべきデートを検索し、なければ追加します
		$data['Post']=array(
			'date_id'=>$Dateid,
			'content'=>$text,
			'state'=>$state,
			'city'=>$city,
			);
		if($this->CheckDouble($text,$Dateid,$time)==0){return;}//多重取得の防止をしてくれてるはずです
		//	$location=$this->Getfromcoordinates($coordinates);//緯度経度からいろいろなものを取得してきます
		$this->create();
//		echo "saved!!!";
		$this->save($data);

		$mypostid=$this->GetRecentPostid($Dateid);//いま追加したばかりのpostidを拾ってきます
		App::import('Model','Photo');
		$Photo=new Photo;
		foreach ($medias as $value) {
 				$Photo->loadgraphs($mypostid,$value->media_url);//画像をもらってきます
 			}

		$Date->updatebyNewPost($time,$Dateid);//デートにポストが追加された時間を記述します
		return $mypostid;
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
		if(empty($data)){
			return 1;}
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

	function Getfromcoordinates($ido,$keido)//緯度経度から取得。今は使わず。(正確な住所まで求められるので、きちんとやれば施設名まで求められると思います。)
	{
	//	var_dump($coordinates);
	//	var_dump($coordinates->coordinates['0']);
		$url="http://maps.google.com/maps/api/geocode/json?latlng=".$ido.",".$keido."&sensor=false&language=jp";
		$json=file_get_contents($url);
		$decoded=json_decode($json, true);
		return $decoded;
	}
}