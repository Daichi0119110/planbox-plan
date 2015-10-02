<?php 
class Follow extends AppModel {
	public $name='Follow';
	public $useTable='follows';

	function getcoupleids($user_id){
		$status=array(
			'conditions'=>array('user_id'=>$user_id, 'fav_flg'=>1),
			'fields'=>array('couple_id')
		);
		$a = $this->find('all', $status);
		$couple_ids = array();
		foreach ($a as $b) {
			array_push($couple_ids, $b['Follow']['couple_id']);
		}
		return $couple_ids;
	}

	function change_follow_flg($couple_id,$user_id){
		$status=array(
			'conditions'=>array(
				'AND'=>array(
					'couple_id'=>$couple_id,
					'user_id'=>$user_id
				)
			)
		);
		// データベースから取得
		$a = $this->find('first',$status);

		if(!$a){
			// データがなければ
			$this->create();
			$this->save(array('fav_flg'=>1, 'couple_id'=>$couple_id, 'user_id'=>$user_id));
		} else{
			// データがあれば
			if($a['Follow']['fav_flg'] == 0){
				$this->save(array('id'=>$a['Follow']['id'], 'fav_flg'=>1));
			}else{
				$this->save(array('id'=>$a['Follow']['id'], 'fav_flg'=>0));
			}
		}
		return true;
	}
}