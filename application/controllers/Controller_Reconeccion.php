<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Reconeccion extends CI_Controller {

	public function index($mensaje = '', $fila = '')
	{
		$data = array('mensaje' => $mensaje, 'consulta' => $fila);
		$this->load->view('disenio/librerias');
		$this->load->view('layout/menu');
		$this->load->view('home/reconecciones', $data);
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
		$table = 'tbl_recmanual';
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
		
					while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
					{
						//Insertamos los datos con los valores...
						$sql = "INSERT into tbl_recmanual (datomanual) 
									values($data[0])";
						mysql_query($sql) or die('Error: '.mysql_error());
					}
					//cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
					fclose($handle);
					//echo "Importación exitosa!";
					
					//redireccionar
					$mensaje = "1";
					$this->index($mensaje);
				}
				else
				{
					//si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
					//ver si esta separado por " , "
					//echo "Archivo invalido!";

					//redireccionar
					$mensaje = "0";
					$this->index($mensaje);
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

	public function buscar_un_medidor()
	{
		$datos = array();
		$medidor = $this->input->post('medidor');
		$fila = $this->Model_Tblrecmanual->getByUnMedidor($medidor);
		
		$mensaje = "";
		$this->index($mensaje, $fila);
	}

	public function buscar_una_cuenta()
	{
		$datos = array();
		$cuenta = $this->input->post('cuenta');
		$fila = $this->Model_Tblrecmanual->getByUnaCuenta($cuenta);
		
		$mensaje = "";
		$this->index($mensaje, $fila);
	}
}
