<?php 

class DatesController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date', 'Follow','Favorite');

	public function favorite() {

	}

	public function feature() {
		$this->set('dates',$this->Date->getdatesfromcouple(1));
	}

	public function index($id = null) {
		//couple_ids,デートプランの取得
		$couple_ids = array();
		$a = $this->Follow->getcoupleid(1);
		foreach ($a as $b) {
			array_push($couple_ids, array_shift($b['Follow']));
		}
		$dates = $this->Date->getdatesfromcouple($couple_ids);

		//いいね数の取得
		for ($i=0; $i < count($dates); $i++) { 
			$dates[$i]['Date']['favo'] = $this->Favorite->getnumber($dates[$i]['Date']['id']);
		}
		$this->set('dates',$dates);

	}

	public function memory() {
		
	}

	public function recommend() {

	}
}