<?php

set_time_limit(0);

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Consolidado extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Tblconsolidado');
		$this->load->library('csvimport');
	}

	public function index($mensaje = '', $fila = '')
	{
		$data = array('mensaje' => $mensaje, 'consulta' => $fila);
		$this->load->view('disenio/librerias');
		$this->load->view('layout/menu');
		$this->load->view('home/consultas', $data);
	}

	public function importar($mensaje = '', $fila = '')
	{
		$data = array('mensaje' => $mensaje, 'consulta' => $fila);
		$this->load->view('disenio/librerias');
		$this->load->view('layout/menu');
		$this->load->view('home/importar', $data);
	}
	
	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getDataJsonActDiarias()
	{
		//$json = new Services_JSON();

		$datos = array();
		$fecha = $this->input->post('fecha');
		$actividad = $this->input->post('actividad');
		$fila = $this->Model_Tblconsolidado->getByActDiarias($fecha, $actividad);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosActividades = json_encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosActividades;
	}

	function load_data()
	{
		$result = $this->Model_Tblconsolidado->select();
		/*
		$output = '
		 <h3 align="center">Imported User Details from CSV File</h3>
        <div class="table-responsive">
        	<table class="table table-bordered table-striped">
        		<tr>
        			<th>Sr. No</th>
        			<th></th>
        			<th>Last Name</th>
        			<th>Phone</th>
        			<th>Email Address</th>
        		</tr>
		';
		$count = 0;
		if($result->num_rows() > 0)
		{
			foreach($result->result() as $row)
			{
				$count = $count + 1;
				$output .= '
				<tr>
					<td>'.$count.'</td>
					<td>'.$row->first_name.'</td>
					<td>'.$row->last_name.'</td>
					<td>'.$row->phone.'</td>
					<td>'.$row->email.'</td>
				</tr>
				';
			}
		}
		else
		{
			$output .= '
			<tr>
	    		<td colspan="5" align="center">Data not Available</td>
	    	</tr>
			';
		}
		$output .= '</table></div>';
		echo $output;
		*/
	}

	function import()
	{
		$time = time();
		$fechaActual = date('d-m-Y', $time);
		$fechaUpdate = "00-00-0000";

		$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
		foreach($file_data as $row)
		{
			$data[] = array(
				"n9sepr"	=>	$row["n9sepr"],
				"n9cono"	=>	$row["n9cono"],
				"n9cocu"	=>	$row["n9cocu"],
				"n9selo"	=>	$row["n9selo"],
				"n9cozo"	=>	$row["n9cozo"],
				"n9coag"	=>	$row["n9coag"],
				"n9cose"	=>	$row["n9cose"],
				"n9coru"	=>	$row["n9coru"],
				"n9seru"	=>	$row["n9seru"],
				"n9vano"	=>	$row["n9vano"],
				"n9plve"	=>	$row["n9plve"],
				"n9vaca"	=>	$row["n9vaca"],
				"n9esta"	=>	$row["n9esta"],
				"n9cocn"	=>	$row["n9cocn"],
				"n9fech"	=>	$row["n9fech"],
				"n9meco"	=>	$row["n9meco"],
				"n9seri"	=>	$row["n9seri"],
				"n9feco"	=>	$row["n9feco"],
				"n9leco"	=>	$row["n9leco"],
				"n9manp"	=>	$row["n9manp"],
				"n9cocl"	=>	$row["n9cocl"],
				"n9nomb"	=>	$row["n9nomb"],
				"n9cedu"	=>	$row["n9cedu"],
				"n9prin"	=>	$row["n9prin"],
				"n9nrpr"	=>	$row["n9nrpr"],
				"n9refe"	=>	$row["n9refe"],
				"n9tele"	=>	$row["n9tele"],
				"n9medi"	=>	$row["n9medi"],
				"n9fecl"	=>	$row["n9fecl"],
				"n9lect"	=>	$row["n9lect"],
				"n9cobs"	=>	$row["n9cobs"],
				"n9cob2"	=>	$row["n9cob2"],
				"n9ckd1"	=>	$row["n9ckd1"],
				"n9ckd2"	=>	$row["n9ckd2"],
				"cusecu"	=>	$row["cusecu"],
				"cupost"	=>	$row["cupost"],
				"cucoon"	=>	$row["cucoon"],
				"cucooe"	=>	$row["cucooe"],
				"cuclas"	=>	$row["cuclas"],
				"cuesta"	=>	$row["cuesta"],
				"cutari"	=>	$row["cutari"],
				"createddato"	=>	$fechaActual,
				"updatedato"	=>	$fechaUpdate
			);

		}
		$this->Model_Tblconsolidado->insert($data);
	}

	/**
	* obtener los datos en formato json para la asignatura
	*/
	public function getJasonCantidadAct()
	{
		//$json = new Services_JSON();

		$datos = array();
		$fecha = $this->input->post('fecha');
		$actividad = $this->input->post('actividad');
		$fila = $this->Model_Tblconsolidado->getByActDiarias($fecha, $actividad);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result_array() as $row) {
			$datos[] = $row;
		}
		//convertimos en datos json nuestros datos
		$datosActividades = json_encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosActividades;
	}

	/**
	* obtener los diferentes sectores de la ruta diaria
	* y luego obtener el numero de Not, Cor y Rec diario
	*/
	public function getContarActividades()
	{
		$datos = array();
		$fecha = $this->input->post('fecha');
		$sectorURoRU = $this->input->post('sectorURoRU');
		
		$fila = $this->Model_Tblconsolidado->getConteoPorSector($fecha, $sectorURoRU);
		
		//llenamos el arreglo con los datos resultados de la consulta
		foreach ($fila->result() as $row) {
			$sec = $row->n9cose;
			$sectores = $this->Model_Tblconsolidado->getConteoSecYAct($fecha, $sec);
			foreach($sectores->result_array() as $r){
				$datos[] = $r;
			}
		}
		//convertimos en datos json nuestros datos
		$datosActividades = json_encode($datos);
		//imprimiendo datos asi se puede tomar desde angular ok 
		echo $datosActividades;
	}
	
}
