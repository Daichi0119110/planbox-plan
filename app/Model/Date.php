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

	function getcoupleid($date_ids){
		$status=array(
			'conditions'=>array('id'=>$date_ids),
			'fields'=>array('couple_id')
		);
		$a = $this->find('first',$status);
		return $a['Date']['couple_id'];
	}
}