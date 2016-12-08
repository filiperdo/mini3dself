<?php

class Home extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/**
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Principal";

		$this->view->render( "header" );
		$this->view->render( "home/index" );
		$this->view->render( "footer" );
	}




}
