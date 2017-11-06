<?php

set_time_limit(0);

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Consolidado extends CI_Controller {

	public function index($mensaje = '', $fila = '')
	{
		$data = array('mensaje' => $mensaje, 'consulta' => $fila);
		$this->load->view('disenio/librerias');
		$this->load->view('home/consultas', $data);
	}

	public function control()
	{
		//conexiones, conexiones everywhere
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		$db_host = 'localhost';
		$db_user = 'root';
		$db_pass = '';
		
		$database = 'empresa_db';
		$table = 'tbl_consolidado';
		if (!@mysql_connect($db_host, $db_user, $db_pass))
			die("No se pudo establecer conexión a la base de datos");
		
		if (!@mysql_select_db($database))
			die("base de datos no existe");
			if(isset($_POST['submit']))
			{
				//Aquí es donde seleccionamos nuestro csv
				$fname = $_FILES['sel_file']['name'];
				//echo 'Cargando nombre del archivo: '.$fname.' <br>';
				$chk_ext = explode(".",$fname);
		
				if(strtolower(end($chk_ext)) == "csv")
				{
					//si es correcto, entonces damos permisos de lectura para subir
					$filename = $_FILES['sel_file']['tmp_name'];
					$handle = fopen($filename, "r");
		
					while (($data = fgetcsv($handle,10000, ";")) !== FALSE)
					{
						$time = time();
						$fechaActual = date('d-m-Y', $time);
						$fechaUpdate = "00-00-0000";

						//Insertamos los datos con los valores...
						$sql = "INSERT into tbl_consolidado (	n9cono, n9cocu,
																n9cose, n9coru,
																n9meco, n9feco,
																n9leco, n9cocl,
																n9nomb, n9refe,
																n9fecl, n9lect,
																n9cobs, cucoon,
																cucooe, createddato,
																updatedato
																) 
									values(	'$data[0]','$data[1]',
											'$data[2]','$data[3]',
											'$data[4]','$data[5]',
											'$data[6]','$data[7]',
											'$data[8]','$data[9]',
											'$data[10]','$data[11]',
											'$data[12]','$data[13]',
											'$data[14]','$fechaActual',
											'$fechaUpdate'
											)";
						//mysql_query($sql) or die('Error: '.mysql_error());
						mysql_query($sql);
					}
					//cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
					fclose($handle);
					//echo "Importación exitosa!";
					
					//redireccionar
					$mensaje = "1";
					//$this->index($mensaje);
					redirect('/Controller_Consolidado/index',$mensaje);
				}
				else
				{
					//si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
					//ver si esta separado por " , "
					//echo "Archivo invalido!";

					//redireccionar
					$mensaje = "0";
					//$this->index($mensaje);
					redirect('/Controller_Consolidado/index',$mensaje);
				}
			}
	
	}

	public function vaciar_tbl_manual()
	{
		$this->Model_Tblrecmanual->truncate();
		$mensaje = "2";
		$this->index($mensaje);
	}

	public function buscar_medidor()
	{
		$datos = array();
		
		$fila = $this->Model_Tblrecmanual->getByMedidor();
		/*
		foreach ($fila->result() as $row) {
			echo $row->codigo."<br>";
		}
		*/
		$mensaje = "";
		$this->index($mensaje, $fila);
	}

	public function buscar_cuenta()
	{
		$datos = array();
		
		$fila = $this->Model_Tblrecmanual->getByCuenta();
		
		$mensaje = "";
		$this->index($mensaje, $fila);
	}
}
