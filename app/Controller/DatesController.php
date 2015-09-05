<?php 

class DatesController extends AppController {
	public $helper = array('HTML', 'form');

	public function favorite() {

	}

	public function feed() {
		$this->set('dates',$this->Date->getdatesfromcouple(1));
	}

	public function memory() {
		
	}
}