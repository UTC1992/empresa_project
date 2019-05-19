<?php

set_time_limit(0);

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Controller_Consolidado extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Tblconsolidado');
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

	public function import()
	{
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 
		'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 
		'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if(isset($_FILES['file_consolidado']['name']) && in_array($_FILES['file_consolidado']['type'], $file_mimes)) 
		{
			$arr_file = explode('.', $_FILES['file_consolidado']['name']);
			$extension = end($arr_file);
			if('csv' == $extension)
			{
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $reader->load($_FILES['file_consolidado']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			echo "<pre>";
			//print_r($sheetData);

			$time = time();
			$fechaActual = date('d-m-Y', $time);
			$fechaUpdate = "00-00-0000";

			$con=0;
			$actividadArray=array();
			
			array_shift($sheetData);

			foreach($sheetData as $row => $value)
			{
				//print_r($value);
				$actividadArray[$con]['n9sepr']=$value[0];
				$actividadArray[$con]['n9cono']= $value[1];
				$actividadArray[$con]['n9cocu']= $value[2];
				$actividadArray[$con]['n9selo']= $value[3];
				$actividadArray[$con]['n9cozo']= $value[4];
				$actividadArray[$con]['n9coag']= $value[5];
				$actividadArray[$con]['n9cose']= $value[6];
				$actividadArray[$con]['n9coru']= $value[7];
				$actividadArray[$con]['n9seru']= $value[8];
				$actividadArray[$con]['n9vano']= $value[9];
				$actividadArray[$con]['n9plve']= $value[10];
				$actividadArray[$con]['n9vaca']= $value[11];
				$actividadArray[$con]['n9esta']= $value[12];
				$actividadArray[$con]['n9cocn']= $value[13];
				$actividadArray[$con]['n9fech']= $value[14];
				$actividadArray[$con]['n9meco']= $value[15];
				$actividadArray[$con]['n9seri']= $value[16];
				$actividadArray[$con]['n9feco']= $value[17];
				$actividadArray[$con]['n9leco']= $value[18];
				$actividadArray[$con]['n9manp']= $value[19];
				$actividadArray[$con]['n9cocl']= $value[20];
				$actividadArray[$con]['n9nomb']= $value[21];
				$actividadArray[$con]['n9cedu']= $value[22];
				$actividadArray[$con]['n9prin']= $value[23];
				$actividadArray[$con]['n9nrpr']= $value[24];
				$actividadArray[$con]['n9refe']= $value[25];
				$actividadArray[$con]['n9tele']= $value[26];
				$actividadArray[$con]['n9medi']= $value[27];
				$actividadArray[$con]['n9fecl']= $value[28];
				$actividadArray[$con]['n9lect']= $value[29];
				$actividadArray[$con]['n9cobs']= $value[30];
				$actividadArray[$con]['n9cob2']= $value[31];
				$actividadArray[$con]['n9ckd1']= $value[32];
				$actividadArray[$con]['n9ckd2']= $value[33];
				$actividadArray[$con]['cusecu']= $value[34];
				$actividadArray[$con]['cupost']= $value[35];
				$actividadArray[$con]['cucoon']= $value[36];
				$actividadArray[$con]['cucooe']= $value[37];
				$actividadArray[$con]['cuclas']= $value[38];
				$actividadArray[$con]['cuesta']= $value[39];
				$actividadArray[$con]['cutari']= $value[40];
				$actividadArray[$con]['createddato']= $fechaActual;
				$actividadArray[$con]['updatedato']= $fechaUpdate;
				
				$con++;
				//print_r($actividadArray);
			}

			$this->Model_Tblconsolidado->insert($actividadArray);
		}
	}
	
	function import2()
	{
		$time = time();
		$fechaActual = date('d-m-Y', $time);
		$fechaUpdate = "00-00-0000";

		$file_data = $this->csvimport->get_array($_FILES["file_consolidado"]["tmp_name"]);
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
		$datos1 = array();
		$datos2 = array();
		$datos3 = array();
		$datos4 = array();
		$datosTotal = array();

		$fecha = $this->input->post('fecha');
		//$sectorURoRU = $this->input->post('sectorURoRU');
		
		
			$fila = $this->Model_Tblconsolidado->getConteoPorSector($fecha);
		
			//llenamos el arreglo con los datos resultados de la consulta
			//BORNERA
			foreach ($fila->result() as $row) {
				$sec = $row->n9cose;
				$CB = "CB";
				$RB = "RB";
				$sectores = $this->Model_Tblconsolidado->getConteoSecYActURB($fecha, $sec, $CB, $RB);
				foreach($sectores->result_array() as $r){
					$datos1[] = $r;
				}
			}

			//POSTE
			foreach ($fila->result() as $row) {
				$sec = $row->n9cose;
				$CP = "CP";
				$RP = "RP";
				$sectores = $this->Model_Tblconsolidado->getConteoSecYActURB($fecha, $sec, $CP, $RP);
				foreach($sectores->result_array() as $r){
					$datos2[] = $r;
				}
			}


			//llenamos el arreglo con los datos resultados de la consulta
			//BORNERA
			foreach ($fila->result() as $row) {
				$sec = $row->n9cose;
				$CB = "CB";
				$RB = "RB";
				$sectores = $this->Model_Tblconsolidado->getConteoSecYActRUR($fecha, $sec, $CB, $RB);
				foreach($sectores->result_array() as $r){
					$datos3[] = $r;
				}
			}
			
			//POSTE
			foreach ($fila->result() as $row) {
				$sec = $row->n9cose;
				$CP = "CP";
				$RP = "RP";
				$sectores = $this->Model_Tblconsolidado->getConteoSecYActRUR($fecha, $sec, $CP, $RP);
				foreach($sectores->result_array() as $r){
					$datos4[] = $r;
				}
			}
			
			$datosTotal[0] = $datos1;
			$datosTotal[1] = $datos2;
			$datosTotal[2] = $datos3;
			$datosTotal[3] = $datos4;

			//convertimos en datos json nuestros datos
			$datosActividades = json_encode($datosTotal);
			//imprimiendo datos asi se puede tomar desde angular ok 
			echo $datosActividades;
	}
	
}
