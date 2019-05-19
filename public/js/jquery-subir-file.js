$(document).ready(function(){
	var urlImportar = $('#url').val();
	$('#mensaje').hide();
	$('#error').hide();

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
				if(data != ''){
					$('#error').hide();
					$('#import_csv')[0].reset();
					$('#import_csv_btn').attr('disabled', false);
					$('#import_csv_btn').html('Importar file');
					$('#mensaje').html('Éxito al subir');
					$('#mensaje').show();
				} else {
					$('#mensaje').hide();
					$('#import_csv_btn').html('Importar file');
					$('#error').html('Elija un archivo para subirlo.');
					$('#error').show();
				}	
				
			}
		})
		
	});
	
});
