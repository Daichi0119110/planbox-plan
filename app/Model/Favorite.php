<?php 
class Favorite extends AppModel {
	public $name='Favorite';
	public $useTable='favorites';

	function date_id($date_id){
	$status=array(
			'conditions'=>
			array(
				'AND'=>array(
					'date_id'=>$date_id,
					'fav_flg'=>1)
				)
		);
	return $this->find('all',$status);
	}
}