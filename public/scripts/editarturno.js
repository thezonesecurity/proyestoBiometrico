$(document).ready(function(){
    
	$(document).on('click', '.editbtn', function(){
        console.log('item');
        /*$tr = $(this).closest('tr');
        var data = $tr.children('td').map(function(){
            return $(this).text();
        });
        //recuperando los datos y mostrando en el modal
        $('#update_id').val(data[0]);
        $('#persona').val(data[1]);
        $('#tipod').val(data[2]);
        $('#fec_inicio').val(data[3]);
        $('#fec_fin').val(data[4]);
        $('#hrs_ini').val(data[5]);
        $('#hrs_fin').val(data[6]);
        $('#turno').val(data[7]);
        $('#area').val(data[8]);
        $('#obs').val(data[9]);
        */
		

		var id=$(this).val(); //console.log('id_user',id);
        var fecha =$('#fec_ini'+id).text(); //document.getElementById("fec_ini").textContent;
        console.log('fecha '+fecha);
        
        var nameper=$('#nombre'+id).text();
		var ciper=$('#ci'+id).text();
        var item=$('#item'+id).text(); //console.log('item', item)
        var servicio=$('#servicio'+id).text();
        var area_per=$('#area'+id).text(); 
        var estadoper=$('#estado'+id).text();
	
		$('#edit').modal('show');
        $('#idM').val(id);
        $('#nombreM').val(nameper);
		$('#ciM').val(ciper);
        $('#itemM').val(item);
        $('#servicioM').val(servicio);
        $('#per_areaM').val(area_per);
        $('#estadoM').val(estadoper);
        //select2
       // $('.js-example-basic-single').select2();
	});

    
});
