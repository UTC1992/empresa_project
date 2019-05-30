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
										and n9fech = '" . $fecha . "'
										and n9feco = '" . $fecha . "'
										and n9leco <> ''
										and n9leco > 0
										;");
			return $result;

			/*para cuando NO SE ENCUENTRE CB CP RB RP 
			$result = $this->db->query("SELECT * from tbl_consolidado 
										WHERE n9cono = '". $actividad ."' 
										and n9fech = '" . $fecha . "'
										and n9feco = '" . $fecha . "'
										and n9leco <> ''
										and n9cobs <> ''
										and n9leco > 0
										;");
			return $result;
			*/
		}

		public function getConteoPorSector($fecha = '')
		{
				$result = $this->db->query("SELECT n9cose
										from tbl_consolidado
										WHERE n9feco = '" . $fecha . "'
										and n9fech = '" . $fecha . "'
										and n9leco > 0
										and n9leco <> ''
										GROUP by n9cose
										HAVING COUNT(n9cose)>0
										ORDER BY n9cose ASC
										;");
				return $result;
			
		}

		public function getConteoPorSectorCopia($fecha = '', $sectorURoRU = '')
		{
			$result = $this->db->query("SELECT n9cose
										from tbl_consolidado, tbl_sector
										WHERE n9feco = '" . $fecha . "'
										and n9fech = '" . $fecha . "'
										and n9leco > 0
										and n9leco <> ''
										and n9cose = tbl_sector.nombre
										and tbl_sector.detalle = '".$sectorURoRU."'
										GROUP by n9cose
										HAVING COUNT(n9cose)>0
										ORDER BY n9cose ASC
										;");
			return $result;
		}
		

		public function getConteoSecYActURB($fecha = '', $sector = '', $BP1 = '', $BP2 = '')
		{
			$result = $this->db->query("SELECT  n9coag, n9cose, (SELECT COUNT(n9cose)
													FROM tbl_consolidado
													WHERE n9feco = '" . $fecha . "'
													and n9fech = '" . $fecha . "' 
													and n9cose = '".$sector."'
													and cuclas LIKE 'UR%'
													and n9leco > 0
													and n9leco <> ''
													and n9cono = '010') as Notificacion,
													(SELECT COUNT(n9cose)
													FROM tbl_consolidado
													WHERE n9feco = '" . $fecha . "'
													and n9fech = '" . $fecha . "' 
													and n9cose = '".$sector."'
													and cuclas LIKE 'UR%'
													and n9cobs = '".$BP1."'
													and n9leco > 0
													and n9leco <> ''
													and n9cono = '030') as Corte,
													(SELECT COUNT(n9cose)
													FROM tbl_consolidado
													WHERE n9feco = '" . $fecha . "' 
													and n9fech = '" . $fecha . "'
													and n9cose = '".$sector."'
													and cuclas LIKE 'UR%'
													and n9cobs = '".$BP2."'
													and n9leco > 0
													and n9leco <> ''
													and n9cono = '040') as Reconeccion
										FROM tbl_consolidado
										WHERE n9feco = '" . $fecha . "'
										and n9fech = '" . $fecha . "' 
										and n9cose = '".$sector."'
										and cuclas LIKE 'UR%'
										and n9leco > 0
										and n9leco <> ''
										GROUP by n9cose
										HAVING COUNT(n9cose)>0
										ORDER BY n9cose ASC

									;");
			return $result;
			
			
		}

		public function getConteoSecYActRUR($fecha = '', $sector = '', $BP1 = '', $BP2 = '')
		{
			
			$result = $this->db->query("SELECT  n9coag, n9cose, (SELECT COUNT(n9cose)
													FROM tbl_consolidado
													WHERE n9feco = '" . $fecha . "'
													and n9fech = '" . $fecha . "' 
													and n9cose = '".$sector."'
													and cuclas LIKE 'RU%'
													and n9leco > 0
													and n9leco <> ''
													and n9cono = '010') as Notificacion,
													(SELECT COUNT(n9cose)
													FROM tbl_consolidado
													WHERE n9feco = '" . $fecha . "'
													and n9fech = '" . $fecha . "' 
													and n9cose = '".$sector."'
													and cuclas LIKE 'RU%'
													and n9cobs = '".$BP1."'
													and n9leco > 0
													and n9leco <> ''
													and n9cono = '030') as Corte,
													(SELECT COUNT(n9cose)
													FROM tbl_consolidado
													WHERE n9feco = '" . $fecha . "' 
													and n9fech = '" . $fecha . "'
													and n9cose = '".$sector."'
													and cuclas LIKE 'RU%'
													and n9cobs = '".$BP2."'
													and n9leco > 0
													and n9leco <> ''
													and n9cono = '040') as Reconeccion
										FROM tbl_consolidado
										WHERE n9feco = '" . $fecha . "'
										and n9fech = '" . $fecha . "' 
										and n9cose = '".$sector."'
										and cuclas LIKE 'RU%'
										and n9leco > 0
										and n9leco <> ''
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

		function getFechasMes()
		{
			$result = $this->db->query("SELECT n9fech from tbl_consolidado 
										WHERE n9fech LIKE '201905%' 
										and n9leco > 0 and n9leco <> ''
										GROUP by n9fech
										ORDER BY n9fech ASC
										;");
			return $result;
			
		}

    }
