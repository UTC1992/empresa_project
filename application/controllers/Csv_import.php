<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv_import extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Tblconsolidado');
		$this->load->library('csvimport');
	}

	function index()
	{
		$this->load->view('csv_import');
	}

	function load_data()
	{
		$result = $this->Model_Tblconsolidado->select();
		echo $result;
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
		$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
		foreach($file_data as $row)
		{
			$data[] = array(
				'n9cono'	=>	$row["n9cono"],
				'n9cocu'	=>	$row["n9cocu"],
				'n9cose'	=>	$row["n9cose"],
				'n9coru'	=>	$row["n9coru"],
				'n9meco'	=>	$row["n9meco"],
				'n9feco'	=>	$row["n9feco"],
				'n9leco'	=>	$row["n9leco"],
				'n9cocl'	=>	$row["n9cocl"],
				'n9nomb'	=>	$row["n9nomb"],
				'n9refe'	=>	$row["n9refe"],
				'n9fecl'	=>	$row["n9fecl"],
				'n9lect'	=>	$row["n9lect"],
				'n9cobs'	=>	$row["n9cobs"],
				'cucoon'	=>	$row["cucoon"],
				'cucooe'	=>	$row["cucooe"],
				'createddato'	=>	$row["createddato"],
				'updatedato'	=>	$row["updatedato"]
			);
		}
		$this->Model_Tblconsolidado->insert($data);
	}
	
		
}
