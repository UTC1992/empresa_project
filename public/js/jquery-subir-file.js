$(document).ready(function(){
	var urlImportar = $('#url').val();

	load_data();

	function load_data()
	{
		
		$.ajax({
			url:urlImportar+'Controller_Consolidado/load_data',
			method:"POST",
			success:function(data)
			{
				$('#imported_csv_data').html(data);
			}
		})
	}

	$('#import_csv').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url:urlImportar+"Controller_Consolidado/import",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			beforeSend:function(){
				$('#import_csv_btn').html('Importing...');
			},
			success:function(data)
			{
				
				$('#import_csv')[0].reset();
				$('#import_csv_btn').attr('disabled', false);
				$('#import_csv_btn').html('Import Done');
				//$('#imported_csv_data').html(data);
				load_data();
			}
		})
	});
	
});
