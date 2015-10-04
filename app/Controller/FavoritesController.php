<?php 

class FavoritesController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Favorite', 'Date');

	// ページ読み込み時に起動
	public function ready() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->autoLayout = false;

			// お気に入りしているデートの取得
			$date_ids = $this->Favorite->getfavodateid($_POST['user_id']);
			$this->header('Content-Type: application/json');
			echo json_encode($date_ids);
			exit();
		}
		$this->redirect(array('controller'=>'dates', 'action' => 'index'));
	}

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

	public function post_detail(){
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->autoLayout = false;

			// view数のカウント
			$this->Date->read(null, $_POST['date_id']);
			$this->Date->set('num_view', $_POST['view']+1);
			$this->Date->save();

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
			$response = array('fav_flg'=>$a['Favorite']['fav_flg'], 'view'=>$_POST['view']+1);
			$this->header('Content-Type: application/json');
			echo json_encode($response);
			exit();
		}
		$this->redirect(array('controller'=>'posts', 'action' => 'detail'));
	}
}