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
		return $this->find('first',$status);
	}

	function getdatesfromcouple($couple_ids){
		$status=array(
			'conditions'=>
			array('couple_id'=>$couple_ids)
		);
		return $this->find('all',$status);
	}

	function getRecentDate($time,$couple_id){//時間とidから可能性のあるデート返す
		$status=array(
			'order'=> 'id DESC',
			'conditions'=>array(
				'modified <='=>$formated,
				'modified >='=>strtotime('1 day',$formated),
				'couple_id'=>$myid,
			)
		);
		$data=$this->find('first',$status);
		if(empty($data)){
			return -1;
		}
		else{
			return $data['Date']['id'];
		}
	}

	function makenewDate($couple_id){
		$data=array('Date',array('couple_id'=>$couple_id));
		$this->User->save($data);
	}
}