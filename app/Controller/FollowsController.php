<?php 

class FollowsController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date', 'Follow','Favorite','Post');

	public function ready(){
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->autoLayout = false;

			$status=array(
				'conditions'=>array(
					'AND'=>array(
						'couple_id'=>$_POST['couple_id'],
						'user_id'=>$_POST['user_id'],
						'fav_flg'=>1
					)
				)
			);
			$a = $this->Follow->find('first',$status);
			$this->header('Content-Type: application/json');
			echo json_encode($a['Follow']['fav_flg']);
			exit();
		}
		$this->redirect(array('controller'=>'dates', 'action' => 'date'));
	}

	public function change() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			if ($this->Follow->change_follow_flg($_POST['couple_id'], $_POST['user_id'])) {
				$this->autoRender = false;
				$this->autoLayout = false;
				$this->header('Content-Type: application/json');
				echo json_encode('a');
				exit();
			}
		}
		$this->redirect(array('controller'=>'dates', 'action' => 'index'));
	}

}