<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Home extends CI_Controller {

	public function index()
	{
		$this->load->view('disenio/librerias');
		$this->load->view('home/index');
	}
}
