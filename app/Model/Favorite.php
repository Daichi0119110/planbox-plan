<?php 
class Favorite extends AppModel {
	public $name='Favorite';
	public $useTable='favorites';

	function date($date_id){
	$status=array(
		'conditions'=>array(
			'AND'=>array(
				'date_id'=>$date_id,
				'fav_flg'=>1
			)
		),
	);
	return $this->find('all',$status);
	}

	function getnumber($date_id){
		$status=array(
			'conditions'=>array(
				'AND'=>array(
					'date_id'=>$date_id,
					'fav_flg'=>1
				)
			),
		);
	return $this->find('count',$status);
	}

	function change_flg($date_id,$user_id){
		$status=array(
			'conditions'=>array(
				'AND'=>array(
					'date_id'=>$date_id,
					'user_id'=>$user_id
				)
			)
		);
		// データベースから取得
		$a = $this->find('first',$status);

		if(!$a){
			// データがなければ
			$this->create();
			$this->save(array('fav_flg'=>1, 'date_id'=>$date_id, 'user_id'=>$user_id));
		} else{
			// データがあれば
			if($a['Favorite']['fav_flg'] == 0){
				$this->save(array('id'=>$a['Favorite']['id'], 'fav_flg'=>1));
			}else{
				$this->save(array('id'=>$a['Favorite']['id'], 'fav_flg'=>0));
			}
		}
		return true;
	}

	function getfavodateid($user_id){
		$status=array(
			'conditions'=>array(
				'AND'=>array(
					'user_id'=>$user_id,
					'fav_flg'=>1
				)
			),
			'fields'=>array('date_id')
		);
		$a = $this->find('all',$status);
		$date_ids = array();
		foreach ($a as $b) {
			array_push($date_ids, $b['Favorite']['date_id']);
		}
		return $date_ids;
	}

	function getfavonumber($date_id){
		$status=array(
			"conditions" => array(
				'AND'=>array(
					'date_id'=>$date_id, 
					'fav_flg'=>1, 
					'modified >'=>date("Y-m-d H:i:s", strtotime('-7 day'))
				)
			)
		);
		return $this->find('count',$status);
	}

	function getuserids($date_id){
		$status=array(
			"conditions" => array(
				'AND'=>array(
					'date_id'=>$date_id, 
					'fav_flg'=>1, 
				)
			),
			"fields"=>array('user_id')
		);
		$a = $this->find("all",$status);
		$user_ids = array();
		foreach ($a as $b) {
			array_push($user_ids, $b['Favorite']['user_id']);
		}
		return $user_ids;
	}
}