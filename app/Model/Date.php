<?php 
class Date extends AppModel {
	/*public $hasMany=array(
		'Post','Favorite'
	);*/
	public $name='Date';
	public $useTable='dates';

	function getdate($id){
		$status=array(
			'conditions'=>
			array('id'=>$id)
		);
		return $this->find('all',$status);
	}

	function getdatesfromcouple($couple_ids){
		$status=array(
			'conditions'=>
			array('couple_id'=>$couple_ids)
		);
		return $this->find('all',$status);
	}

	function getRecentDate($time,$couple_id){//時間とidから可能性のあるデート返す
		//var_dump($time);
		$dtime=$time;
		$status=array(
			'order'=> 'id DESC',
			'conditions'=>array(
				'post_updated <='=>$dtime->format('Y-m-d H:i:s'),
				'post_updated >='=>$dtime->modify('-1 days')->format('Y-m-d H:i:s'),
				'couple_id'=>$couple_id,
			)
		);
		$dtime->modify('+1 days');
		$data=$this->find('first',$status);
		if(empty($data)){
			$data=array();
			$this->create();
			$data['Date']=array('couple_id'=>$couple_id);
			$this->save($data);

			$status=array('order'=>'id DESC');
			$data=$this->find('first',$status);
			return ($data['Date']['id']);
		}
		else{
			return $data['Date']['id'];
		}
	}

	function makenewDate($couple_id){
		$data=array();
		$this->create();
		$data['Date']=array('couple_id'=>$couple_id);
		$this->save($data);
	}
	function updatebyNewPost($time,$date_id)
	{
		$data=array();
		$data['Date']=array('id'=>$date_id,'post_updated'=>$time->format('Y-m-d H:i:s'));
		$this->save($data);
	}
	function getnewdate(){
		$status=array(
			'conditions' => array('couple_id'=>$couple_ids),
			'order' => array('created'=> "desc"),
			'limit' => 5
		);
		return $this->find('all',$status);
	}

	function getalldateids(){
		$status=array('fields'=>'id');
		$a = $this->find('all', $status);
		$date_ids = array();
		foreach ($a as $b) {
			array_push($date_ids, $b['Date']['id']);
		}
		return $date_ids;
	}
}