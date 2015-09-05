<?php 

class CouplesController extends AppController {
	public $helper = array('HTML', 'form');

	public function couple() {
		$this->set('couples', $this->Couple->find('all'));

	}

	public function edit() {

	}

	public function signup() {
		
	}
}