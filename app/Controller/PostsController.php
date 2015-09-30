<?php 

class PostsController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Post','Date','Favorite');

	public function detail(){
		$date_id = 3;
		$this->set('posts', $this->Post->getposts($date_id));
		$this->set('date', $this->Date->getdate($date_id));
		$this->set('date_id', $date_id);
		$this->set('favo', $this->Favorite->getnumber($date_id));
	}
}