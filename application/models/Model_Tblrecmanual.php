<?php
	
	/**
	* 
	*/
	class Model_Tblrecmanual extends CI_Model
	{
		public function truncate()
		{
			$resutl = $this->db->query("TRUNCATE TABLE tbl_recmanual;");
		}

		public function getByMedidor()
		{
			$result = $this->db->query("SELECT * from tbl_cliente, tbl_recmanual 
										WHERE tbl_cliente.medidor = tbl_recmanual.datomanual");
			if ($result->num_rows() > 0) {
				return $result;
			} else {
				return null;
			}
		}

		public function getByCuenta()
		{
			$result = $this->db->query("SELECT * from tbl_cliente, tbl_recmanual 
										WHERE tbl_cliente.cuenta = tbl_recmanual.datomanual");
			if ($result->num_rows() > 0) {
				return $result;
			} else {
				return null;
			}
		}
    }
