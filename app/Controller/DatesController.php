<?php 

class DatesController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date', 'Follow');

	public function favorite() {

	}

	public function feature() {
		$this->set('dates',$this->Date->getdatesfromcouple(1));
	}

	public function index($id = null) {
		//couple_idsの取得
		$couple_ids = array();
		$a = $this->Follow->getcoupleid(1);
		foreach ($a as $b) {
			array_push($couple_ids, array_shift($b['Follow']));
		}

		$this->set('dates', $this->Date->getdatesfromcouple($couple_ids));
	}

	public function memory() {
		
	}

	public function recommend() {

	}
}