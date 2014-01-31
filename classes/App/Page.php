<?php
namespace App;

/**
 * Base controller
 *
 * @property-read \App\Pixie $pixie Pixie dependency container
 */
class Page extends \PHPixie\Controller {
	
	protected $view;
	
	public function before() {
		// $this->view = $this->pixie->view('main');
		$this->view = $this->pixie->haml->get('index');
	}
	
	public function after() {
		$this->response->body = $this->view->render();
	}
	
}
