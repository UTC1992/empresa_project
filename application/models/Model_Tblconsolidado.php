<?php
	
	/**
	* 
	*/
	class Model_Tblconsolidado extends CI_Model
	{

		public function getByActDiarias($fecha = '', $actividad = '')
		{

			$result = $this->db->query("SELECT * from tbl_consolidado 
										WHERE n9cono = ". $actividad ." and n9feco = '" . $fecha . "';");
			if ($result->num_rows() > 0) {
				return $result;
			} else {
				return null;
			}
		}

		public function getConteoDiario()
		{
			$result = $this->db->query("SELECT * from tbl_cliente, tbl_recmanual 
										WHERE tbl_cliente.medidor = tbl_recmanual.datomanual");
			if ($result->num_rows() > 0) {
				return $result;
			} else {
				return null;
			}
		}
    }
