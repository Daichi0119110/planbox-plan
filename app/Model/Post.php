<?php 
class Post extends AppModel {
	public $name='Post';
	public $useTable='posts';

	 public $hasAndBelongsToMany = array(
        'Tag' =>
            array(
                'className'              => 'Tag',
                'joinTable'              => 'posts_tags',
                'foreignKey'             => 'post_id',
                'associationForeignKey'  => 'tag_id',
                'unique'                 => false,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => '',
                'with'                   => 'PostsTag'
            )
    );
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

		// $keyInsta = 'FromInstagram';
  //       if(strpos($state, $keyInsta)!==false){
 	// 		$Photo->loadgraphs($mypostid,$medias);//画像保存fromInsta
  //       }
  //   	else{
			foreach ($medias as $value) {
 				$Photo->loadgraphs($mypostid,$value->media_url);//画像をもらってきます
 			}
		// }
		$Date->updatebyNewPost($time,$Dateid);//デートにポストが追加された時間を記述します
		return $mypostid;
	}
	function AddPostsDemo($text,$time,$user_id,$medias,$ido,$keido,$state,$city){
	//	var_dump($medias);
		// date_default_timezone_set('Asia/Tokyo');
		// App::import('Model','Couple');
		// $this->loadModel('Couple');
		// // $Couple=new Couple;
		// $cid=$this->Couple->getcidfromuid($user_id);//ユーザIDからカップルIDを持ってきます

		// App::import('Model','Date');
		// App::import('Model','Post');
	//		var_dump($locatenames);
		
		$Dateid = 100;
		// $Date=new Date;
		// $Dateid=$Date->getRecentDate($time,$cid,$state,$city);//時間とカップルIDから入れるべきデートを検索し、なければ追加します
		// if($this->CheckDouble($text,$Dateid,$time)==0){return;}//多重取得の防止をしてくれてるはずです
		//	$location=$this->Getfromcoordinates($coordinates);//緯度経度からいろいろなものを取得してきます

		// $this->loadModel('Post');
		
		$this->create();
		$data = array('Post' => array('date_id' => $Dateid, 'content' => $text, 'state' => $state, 'city' => $city));
		// 登録するフィールド
		$fields = array('date_id','content', 'state','city');
		// 更新
		$this->save($data, false, $fields);	            		            	

		$mypostid=$this->GetRecentPostid($Dateid);//いま追加したばかりのpostidを拾ってきます
		App::import('Model','Photo');
		
		$Photo=new Photo;
		$Photo->loadgraphs($mypostid,$medias);//画像保存fromInsta
        
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
				'fields'=>array('city')
				);
			$a = $this->find('first',$status);
			return $a['Post']['city'];
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
//検索機能
	public $filterArgs = array(
    array('name' => 'tag', 'type' => 'subquery', 'method' => 'findByTags', 'field' => 'Post.id'),
	);
	public function findByTags($data = array()) {
	   	$this->PostsTag->Behaviors->attach('Containable', array('autoFields' => false));
    	$this->PostsTag->Behaviors->attach('Search.Searchable');
   		/*$query = $this->PostsTag->getQuery('all',array(
        	'conditions' => array(
        	    'Tag.tag' => $data['tag']
        	),
        	'fields' => array('post_id'),
        	'contain' => array('Tag')
   		));*/
var_dump($data);
   		$query = $this->PostsTag->Find('all',array(
        	'conditions' => array(
        	    'Tag.tag' => $data
        	),
        	'fields' => array('post_id'),
        	'contain' => array('Tag')
   		));

   	 return $query;
	}
}