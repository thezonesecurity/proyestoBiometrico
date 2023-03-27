$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		
		var id=$(this).val(); console.log('id_user',id);
        var nameper=$('#nombre'+id).text();
		var ciper=$('#ci'+id).text();
        var item=$('#item'+id).text(); console.log('item ', item)
        var servicio=$('#servicio'+id).text();
        var estadoper=$('#estado'+id).text();
	
		$('#edit').modal('show');
        $('#idM').val(id);
        $('#nombreM').val(nameper);
		$('#ciM').val(ciper);
        $('#itemM').val(item);
        $('#servicioM').val(servicio);
        $('#estadoM').val(estadoper);
        //select2
        $('.js-example-basic-single').select2();
	});

    
});