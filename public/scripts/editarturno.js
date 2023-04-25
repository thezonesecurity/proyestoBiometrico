$(document).ready(function(){
    
	$(document).on('click', '.editbtn', function(e){
        e.preventDefault();
       // console.log('item');
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
        var persona =$('#persona'+id).text();
        var servicio =$('#servicio'+id).text();// console.log('id_user -> ',servicio); // $('#servicio'+id).text();
        var gestion =$('#gestion'+id).text();     //   console.log('gestion '+gestion);
        var area =$('#area'+id).text();
        var tdia =$('#tdia'+id).text();
        var f_ini =$('#f_ini'+id).text();
        var f_fin =$('#f_fin'+id).text();
        var h_ini =$('#h_ini'+id).text(); 
        var h_fin =$('#h_fin'+id).text();//document.getElementById("fec_ini").textContent;
        var turno =$('#turno'+id).text();
        var obs =$('#obs'+id).text();
	
		$('#editModal').modal('show');
        $('#idM').val(id);
		$('#personaM').val(persona);
        $('#servicioMo').val(servicio);
        $('#gestion').val(gestion);
        $('#areaM').val(area);
        $('#tdiaM').val(tdia);
        $('#f_iniM').val(f_ini);
        $('#f_finM').val(f_fin);
        $('#h_iniM').val(h_ini);
        $('#h_finM').val(h_fin);
        $('#turnoM').val(turno);
        $('#obsM').val(obs);
       // console.log('gestionM '+$('#gestionM').val(gestion));
        //console.log('areaM '+tdia);
        if(tdia == 'DL'){
            $('#laboralM').prop("checked", true);
         //  $('#descansoM').prop("readonly", true);
            $('#f_iniM').prop("disabled", false);
            $('#f_finM').prop("disabled", true);
            $('#h_iniM').prop("disabled", false);
            $('#h_finM').prop("disabled", false);
            $('#turnoM').prop("disabled", false);
            //$('#areaM').prop("disabled", false);
            $('#laboralM').show();
            $('#descansoM').hide();
        }else{
           // $('#laboralM').prop("checked", false);
            $('#descansoM').prop("checked", true);
            $('#f_iniM').prop("disabled", false);
            $('#f_finM').prop("disabled", false);
            $('#h_iniM').prop("disabled", true);
            $('#h_finM').prop("disabled", true);
            $('#turnoM').prop("readonly", true);
           //$('#areaM').prop("disabled", false);
            $('#laboralM').hide();
            $('#descansoM').show();
        }
	});

     //PROCESO PARA SABER K AREA PERTENECE A K SERVICIO
     $(document).ready(function(){
        $('#servicio').change(function() {
            const area_per = $('#areaM');
            $.ajax({
                url: "{{ route('areas.servi') }}",
                data: { servicio: $('#servicio'+id).text() },
                success: function(data){
                    area_per.html('<option value="" selected disabled > Selecione una opcion </option>');
                    $.each(data, function(id, value) {
                        area_per.append('<option value="' + id + '">' + value + '</option>');
                    });
                }
            });
        });
      });
});
