<?php 

class FavoritesController extends AppController {
	public $helper = array('HTML', 'form');

	public function change() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			if ($this->Favorite->change_flg($_POST['date_id'],$_POST['user_id'])) {
				$this->autoRender = false;
				$this->autoLayout = false;
				$response = array('id' => $_POST['date_id'], 'favo' => $this->Favorite->getnumber($_POST['date_id']));
				$this->header('Content-Type: application/json');
				echo json_encode($response);
				exit();
			}
		}
		$this->redirect(array('controller'=>'dates', 'action' => 'index'));
	}

	// ページ読み込み時に起動
	public function ready() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->autoLayout = false;

			// お気に入りしているデートの取得
			$date_ids = array();
			$a = $this->Favorite->getfavodateid($_POST['user_id']);
			foreach ($a as $b) {
				array_push($date_ids, array_shift($b['Favorite']));
			}

			$this->header('Content-Type: application/json');
			echo json_encode($date_ids);
			exit();
		}
		$this->redirect(array('controller'=>'dates', 'action' => 'index'));
	}

	public function post_detail(){
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->autoLayout = false;

			$status=array(
				'conditions'=>array(
					'AND'=>array(
						'date_id'=>$_POST['date_id'],
						'user_id'=>$_POST['user_id']
					)
				)
			);
			// データベースから取得
			$a = $this->Favorite->find('first',$status);

			$this->header('Content-Type: application/json');
			echo json_encode($a['Favorite']['fav_flg']);
			exit();
		}
		$this->redirect(array('controller'=>'posts', 'action' => 'detail'));
	}
}