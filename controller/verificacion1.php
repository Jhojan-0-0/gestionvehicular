<?php

class verificacion1 extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function render()
	{
		$this->view->Render('verificacion1/index');
	}
}