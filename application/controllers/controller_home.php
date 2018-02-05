<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Home extends CI_Controller {

	public function index($mensaje = '', $fila = '')
	{
		$data = array('mensaje' => $mensaje, 'consulta' => $fila);
		$this->load->view('disenio/librerias');
		$this->load->view('layout/menu');
	}


}
