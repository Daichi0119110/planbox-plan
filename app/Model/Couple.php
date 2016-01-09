<?php 
class Couple extends AppModel {

//	public $hasMany="Date";
	public $name='Couple';
	public $useTable='couples';


	function getcouple($id){
		$status=array(
			'conditions'=>
			array('id'=>$id)
		);
	return $this->find('all',$status);
	}

	function getcidfromuid($user_id){
		$status=array(
			'conditions'=>array(
				'OR'=>array(
					'male_id'=>$user_id,
					'female_id'=>$user_id,
					))
			);
		$data=$this->find('first',$status);
		return $data['Couple']['id'];
	}

	/*function makecouple($male_id,$female_id){
		$this->create();
		$data=array();
		$data['Couple']=array('male_id'=>$male_id,'female_id'=>$female_id);
		$this->save($data);
		App::import('Model',Date);
		$id=$this->getcidfromuid($male_id);
		$Date=new Date;
		$Date->makenewdate($id);

	}*/

	function makecouple(){
		$this->create();
		$data=array();
		$this->save($data);

		$thiscouple=$this->find('first',array(
			'order'=>array('Couple.id'=>'desc')
			));
		$id=$thiscouple['Couple']['id'];
		App::import('Model','Date');
		$Date=new Date;
	//	$Date->makenewdate($id);
	//	$Date_id = $Date->getLastInsertID();
		$thiscouple['Couple']['defdate']=$Date->makenewdate($id);
		$this->save($thiscouple);
		return $id;
	}


}