<?php

set_time_limit(0);

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Writer\IWriter;
use \PhpOffice\PhpSpreadsheet\IOFactory;

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
	
	/**
	 * generar excel mensual de detalle de actividades
	 */
	public function generarExcelDetalleMensual()
	{
		try {
			
			$type="xlsx";
			$fecha = $this->input->post('fecha');
			$actividad = $this->input->post('actividad');

			$datos4 = array();
			$filaFechas = $this->Model_Tblconsolidado->getFechasMes();
			foreach ($filaFechas->result_array() as $row) {
				$datos4[] = $row;
			}

			//inicializar
			$spreadsheet = new Spreadsheet();
			$indexSheet=0;

			foreach ($datos4 as $key => $fechas)
			{
				$datos1 = array();
				$datos2 = array();
				$datos3 = array();
				
				$fila = $this->Model_Tblconsolidado->getByActDiarias($fechas['n9fech'], '010');
				
				//llenamos el arreglo con los datos resultados de la consulta
				foreach ($fila->result_array() as $row) {
					$datos1[] = $row;
				}

				$fila = $this->Model_Tblconsolidado->getByActDiarias($fechas['n9fech'], '030');
				
				//llenamos el arreglo con los datos resultados de la consulta
				foreach ($fila->result_array() as $row) {
					$datos2[] = $row;
				}

				$fila = $this->Model_Tblconsolidado->getByActDiarias($fechas['n9fech'], '040');
				
				//llenamos el arreglo con los datos resultados de la consulta
				foreach ($fila->result_array() as $row) {
					$datos3[] = $row;
				}
			
			
				//$dataArray = json_encode($datos, true);
				$dataNOT=array();
				$dataCOR=array();
				$dataREC=array();
		
				$cont_not=0;
				$cont_cor=0;
				$cont_rec=0;
				//echo "<pre>";
				//print_r($datos3);
			
				foreach ($datos1 as $key => $value) 
				{	
					if($value['n9coag'] == 6 || $value['n9coag'] == 95 || $value['n9coag'] == 7 ){
						$dataNOT[$cont_not]["N"]=$cont_not+1;
						$dataNOT[$cont_not]["n9coag"]=$value['n9coag'];
						$dataNOT[$cont_not]["n9cocl"]=$value['n9cocl'];
						$dataNOT[$cont_not]["n9cocu"]=$value['n9cocu'];
						$dataNOT[$cont_not]["n9meco"]=$value['n9meco'];
						$dataNOT[$cont_not]["n9coru"]=$value['n9coru'];
						$dataNOT[$cont_not]["n9cose"]=$value['n9cose'];
						$dataNOT[$cont_not]["n9nomb"]=$value['n9nomb'];
						$dataNOT[$cont_not]["n9refe"]=$value['n9refe'];
						$cont_not++;
					}
					
				}
				
				foreach ($datos2 as $key => $value) 
				{	
					if($value['n9coag'] == 6 || $value['n9coag'] == 95 || $value['n9coag'] == 7 ){
						$dataCOR[$cont_cor]["N"]=$cont_cor+1;
						$dataCOR[$cont_cor]["n9coag"]=$value['n9coag'];
						$dataCOR[$cont_cor]["n9cocl"]=$value['n9cocl'];
						$dataCOR[$cont_cor]["n9cocu"]=$value['n9cocu'];
						$dataCOR[$cont_cor]["n9meco"]=$value['n9meco'];
						$dataCOR[$cont_cor]["n9coru"]=$value['n9coru'];
						$dataCOR[$cont_cor]["n9cose"]=$value['n9cose'];
						$dataCOR[$cont_cor]["n9nomb"]=$value['n9nomb'];
						$dataCOR[$cont_cor]["n9refe"]=$value['n9refe'];
						$cont_cor++;
					}
				}

				foreach ($datos3 as $key => $value) 
				{	
					if($value['n9coag'] == 6 || $value['n9coag'] == 95 || $value['n9coag'] == 7 ){
						$dataREC[$cont_rec]["N"]=$cont_rec+1;
						$dataREC[$cont_rec]["n9coag"]=$value['n9coag'];
						$dataREC[$cont_rec]["n9cocl"]=$value['n9cocl'];
						$dataREC[$cont_rec]["n9cocu"]=$value['n9cocu'];
						$dataREC[$cont_rec]["n9meco"]=$value['n9meco'];
						$dataREC[$cont_rec]["n9coru"]=$value['n9coru'];
						$dataREC[$cont_rec]["n9cose"]=$value['n9cose'];
						$dataREC[$cont_rec]["n9nomb"]=$value['n9nomb'];
						$dataREC[$cont_rec]["n9refe"]=$value['n9refe'];
						$cont_rec++;
					}
				}
				
				$spreadsheet->getActiveSheet()->setTitle("S$indexSheet");
				$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(40);
				$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);

				$styleArray = [
					'borders' => [
						'outline' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
							'color' => ['argb' => '000000'],
						],
					],
				];

				$x=0;
				if(count($dataNOT)>0){
					$spreadsheet->getActiveSheet()->mergeCells('A1:I1');
					$spreadsheet->getActiveSheet()->getStyle("A1:I1")
						->applyFromArray($styleArray);
					$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A1","NOTIFICACIONES");
					$spreadsheet->getActiveSheet()->getStyle("A1")
					->getAlignment()
					->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
					$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A2",'N°')
								->setCellValue("B2",'AGENCIA')
								->setCellValue("C2",'CLIENTE')
								->setCellValue("D2",'CUENTA')
								->setCellValue("E2",'MEDIDOR')
								->setCellValue("F2",'RUTA')
								->setCellValue("G2",'SECTOR')
								->setCellValue("H2",'NOMBRE')
								->setCellValue("I2",'DIRECCION');
					$spreadsheet->getActiveSheet()->getStyle("A2")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("B2")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("C2")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("D2")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("E2")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("F2")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("G2")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("H2")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("I2")
					->applyFromArray($styleArray);

					$x= 3;
					foreach($dataNOT as $item){
						$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A$x",$item["N"])
								->setCellValue("B$x",$item["n9coag"])
								->setCellValue("C$x",$item["n9cocl"])
								->setCellValue("D$x",$item["n9cocu"])
								->setCellValue("E$x",$item["n9meco"])
								->setCellValue("F$x",$item["n9coru"])
								->setCellValue("G$x",$item["n9cose"])
								->setCellValue("H$x",$item["n9nomb"])
								->setCellValue("I$x",$item["n9refe"]);
						//ajustar texto
						$spreadsheet->getActiveSheet()->getStyle("H$x")
								->getAlignment()->setWrapText(true);
						$spreadsheet->getActiveSheet()->getStyle("I$x")
								->getAlignment()->setWrapText(true);
						//delinear bordes
						$spreadsheet->getActiveSheet()->getStyle("A$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("A$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("B$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("C$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("D$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("E$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("F$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("G$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("H$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("I$x")
						->applyFromArray($styleArray);

					$x++;
					}
				}
			
				if(count($dataCOR)>0){
					$spreadsheet->getActiveSheet()->mergeCells("A$x:I$x");
					$spreadsheet->getActiveSheet()->getStyle("A$x")
						->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("A$x")
					->getAlignment()
					->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
					$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A$x","CORTES");
					$x++;
					$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A$x",'N°')
								->setCellValue("B$x",'AGENCIA')
								->setCellValue("C$x",'CLIENTE')
								->setCellValue("D$x",'CUENTA')
								->setCellValue("E$x",'MEDIDOR')
								->setCellValue("F$x",'RUTA')
								->setCellValue("G$x",'SECTOR')
								->setCellValue("H$x",'NOMBRE')
								->setCellValue("I$x",'DIRECCION');
					$spreadsheet->getActiveSheet()->getStyle("A$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("B$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("C$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("D$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("E$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("F$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("G$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("H$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("I$x")
					->applyFromArray($styleArray);

					$x++;
					foreach($dataCOR as $item){
						$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A$x",$item["N"])
								->setCellValue("B$x",$item["n9coag"])
								->setCellValue("C$x",$item["n9cocl"])
								->setCellValue("D$x",$item["n9cocu"])
								->setCellValue("E$x",$item["n9meco"])
								->setCellValue("F$x",$item["n9coru"])
								->setCellValue("G$x",$item["n9cose"])
								->setCellValue("H$x",$item["n9nomb"])
								->setCellValue("I$x",$item["n9refe"]);
						//ajustar texto
						$spreadsheet->getActiveSheet()->getStyle("H$x")
								->getAlignment()->setWrapText(true);
						$spreadsheet->getActiveSheet()->getStyle("I$x")
								->getAlignment()->setWrapText(true);
						//delinear bordes
						$spreadsheet->getActiveSheet()->getStyle("A$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("A$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("B$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("C$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("D$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("E$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("F$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("G$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("H$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("I$x")
						->applyFromArray($styleArray);

					$x++;
					}
				}
			
				if(count($dataREC)>0){
					$spreadsheet->getActiveSheet()->mergeCells("A$x:I$x");
					$spreadsheet->getActiveSheet()->getStyle("A$x")
						->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("A$x")
					->getAlignment()
					->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
					$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A$x","RECONEXIONES");
					$x++;
					$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A$x",'N°')
								->setCellValue("B$x",'AGENCIA')
								->setCellValue("C$x",'CLIENTE')
								->setCellValue("D$x",'CUENTA')
								->setCellValue("E$x",'MEDIDOR')
								->setCellValue("F$x",'RUTA')
								->setCellValue("G$x",'SECTOR')
								->setCellValue("H$x",'NOMBRE')
								->setCellValue("I$x",'DIRECCION');
					$spreadsheet->getActiveSheet()->getStyle("A$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("B$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("C$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("D$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("E$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("F$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("G$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("H$x")
					->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle("I$x")
					->applyFromArray($styleArray);

					$x++;
					foreach($dataREC as $item){
						$spreadsheet->setActiveSheetIndex($indexSheet)
								->setCellValue("A$x",$item["N"])
								->setCellValue("B$x",$item["n9coag"])
								->setCellValue("C$x",$item["n9cocl"])
								->setCellValue("D$x",$item["n9cocu"])
								->setCellValue("E$x",$item["n9meco"])
								->setCellValue("F$x",$item["n9coru"])
								->setCellValue("G$x",$item["n9cose"])
								->setCellValue("H$x",$item["n9nomb"])
								->setCellValue("I$x",$item["n9refe"]);
						//ajustar texto
						$spreadsheet->getActiveSheet()->getStyle("H$x")
								->getAlignment()->setWrapText(true);
						$spreadsheet->getActiveSheet()->getStyle("I$x")
								->getAlignment()->setWrapText(true);
						//delinear bordes
						$spreadsheet->getActiveSheet()->getStyle("A$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("A$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("B$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("C$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("D$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("E$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("F$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("G$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("H$x")
						->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle("I$x")
						->applyFromArray($styleArray);

					$x++;
					}
				}
				
				$spreadsheet->createSheet();
				$indexSheet++;
				
			}
			
			$spreadsheet->setActiveSheetIndex(0);
			//nombre del EXCEL descargado
			//$vector = explode("-",$mes);
			$fileName = 'CONSOLIDADO_LECTURAS';
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename='.$fileName.".".$type);
			$writer->save("php://output");
			exit;
			
			
		} catch (\Exception $e) {
			return response()->json($e);
		}
	}
}
