<?php
	
	/**
	* 
	*/
	class Model_Tblconsolidado extends CI_Model
	{

		public function getByActDiarias($fecha = '', $actividad = '')
		{

			$result = $this->db->query("SELECT * from tbl_consolidado 
										WHERE n9cono = '". $actividad ."' 
										and n9feco = '" . $fecha . "'
										and n9leco > 0
										;");
			return $result;
		}

		public function getConteoPorSector($fecha = '', $sectorURoRU = '')
		{
			$result = $this->db->query("SELECT n9cose
										from tbl_consolidado, tbl_sector
										WHERE n9feco = '" . $fecha . "'
										and n9leco > 0
										and n9cose = tbl_sector.nombre
										and tbl_sector.detalle = '".$sectorURoRU."'
										GROUP by n9cose
										HAVING COUNT(n9cose)>0
										ORDER BY n9cose ASC
										;");
			return $result;
		}

		public function getConteoSecYAct($fecha = '', $sector = '')
		{
			$result = $this->db->query("SELECT  n9cose, (SELECT COUNT(n9cose)
														FROM tbl_consolidado
														WHERE n9feco = '" . $fecha . "' 
														and n9cose = '".$sector."'
														and n9leco > 0
														and n9cono = '010') as Notificacion,
														(SELECT COUNT(n9cose)
														FROM tbl_consolidado
														WHERE n9feco = '" . $fecha . "' 
														and n9cose = '".$sector."'
														and n9leco > 0
														and n9cono = '030') as Corte,
														(SELECT COUNT(n9cose)
														FROM tbl_consolidado
														WHERE n9feco = '" . $fecha . "' 
														and n9cose = '".$sector."'
														and n9leco > 0
														and n9cono = '040') as Reconeccion
											FROM tbl_consolidado
											WHERE n9feco = '" . $fecha . "' 
											and n9cose = '".$sector."'
											and n9leco > 0
											GROUP by n9cose
											HAVING COUNT(n9cose)>0
											ORDER BY n9cose ASC

										;");
			return $result;
		}

		function select()
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('tbl_consolidado');
			return $query;
		}

		function insert($data)
		{
			$this->db->insert_batch('tbl_consolidado', $data);
		}
    }
