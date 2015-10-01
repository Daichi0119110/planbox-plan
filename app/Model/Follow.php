<?php 
class Follow extends AppModel {
	public $name='Follow';
	public $useTable='follows';

	function getcoupleid($id){
		$status=array(
			'conditions'=>
			array('user_id'=>$id),
			'fields'=>
			array('couple_id')
		);
		return $this->find('all', $status);
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