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

	public function ready_date(){
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

	public function ready_couple() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->autoLayout = false;

			// お気に入りしているデートの取得
			$couple_ids = $this->Follow->getcoupleids($_POST['user_id']);
			$this->header('Content-Type: application/json');
			echo json_encode($couple_ids);
			exit();
		}
		$this->redirect(array('controller'=>'couples', 'action' => 'couple'));
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

	public function change_date() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			if ($this->Follow->change_follow_flg($_POST['couple_id'], $_POST['user_id'])) {
				$this->autoRender = false;
				$this->autoLayout = false;
				$response = array('follow' => $this->Follow->getnumber($_POST['couple_id']));
				$this->header('Content-Type: application/json');
				echo json_encode($response);
				exit();
			}
		}
		$this->redirect(array('controller'=>'dates', 'action' => 'index'));
	}

	public function change_couple() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			if ($this->Follow->change_follow_flg($_POST['couple_id'], $_POST['user_id'])) {
				$this->autoRender = false;
				$this->autoLayout = false;
				$response = array('id' => $_POST['couple_id'], 'follow' => $this->Follow->getnumber($_POST['couple_id']));
				$this->header('Content-Type: application/json');
				echo json_encode($response);
				exit();
			}
		}
		$this->redirect(array('controller'=>'couple', 'action' => 'couple'));
	}

	public function change_mypage() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			if ($this->Follow->change_follow_flg($_POST['couple_id'], $_POST['user_id'])) {
				$this->autoRender = false;
				$this->autoLayout = false;
				$this->header('Content-Type: application/json');
				echo json_encode($_POST['couple_id']);
				exit();
			}
		}
		$this->redirect(array('controller'=>'dates', 'action' => 'index'));
	}

}