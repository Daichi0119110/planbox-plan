<?php 
class Favorite extends AppModel {
	public $name='Favorite';
	public $useTable='favorites';

	function date_id($date_id){
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
	return $this->find('all',$status);
	}
}