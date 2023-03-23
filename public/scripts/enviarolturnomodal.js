$(document).ready(function(){

	$(document).on('click', '.edit', function(){
        console.log('item');
        
		/*
		var id=$(this).val(); console.log('id_user',id);
        var nameper=$('#nombre'+id).text();
		var ciper=$('#ci'+id).text();
        var item=$('#item'+id).text(); //console.log('item', item)
        var servicio=$('#servicio'+id).text();
        var area_per=$('#area'+id).text(); console.log('area', area_per)
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
        $('.js-example-basic-single').select2();*/
	});

    
});




$(document).ready(function() {

    $('.guardarModal').click(function() {//para limpiar el formulario  cuando cancelas
        console.log('entro');
    });
    
    $('.editBtn').click(function(){
        console.log('click en abir modal');
    });

    $('.Modal').click(function() {//para limpiar el formulario  cuando cancelas
        console.log('entros1');
    });



    /*
    $("#myTable").dynamicTable({
        
        //definimos las columnas de la tabla
        columns: [{
                text: "Nombre Completo",
                key: "name",
                disabled: true
            },
            {
                text: "Area",
                key: "area_per"
            },
            {
                text: "Item",
                key: "item_per"
            },
            {
                text: "Tipo dia",
                key: "tipod"
            },
            {
                text: "Fecha",
                key: "fec_ini"
            },
            {
                text: "Fecha fin",
                key: "fec_fin"
            },
            {
                text: "Entrada",
                key: "h_entrada"
            },
            {
                text: "Salida",
                key: "h_salida"
            },
            {
                text: "Turno",
                key: "turno_per"
            },
            {
                text: "Observacion",
                key: "obs_per"
            },
        ],
        //carga los datos d la lista
        data: [{
                name: 'Jeff Brown',
                area_per: 'dosis unitaria',
                item_per: 'Contrato',
                tipod: 'DL',
                fec_ini: '2023/05/01',
                fec_fin: '',
                h_entrada: '08:01',
                h_salida: '14:00',
                turno_per: 'Mañana',
                obs_per: '' 
            },
            {
                name: 'Jeff Brown',
                area_per: 'dosis unitaria',
                item_per: 'Contrato',
                tipod: 'DL',
                fec_ini: '2023/05/02',
                fec_fin: '',
                h_entrada: '08:02',
                h_salida: '14:00',
                turno_per: 'Mañana',
                obs_per: '' 
            },
            {
                name: 'maria jose',
                area_per: 'dosis unitaria',
                item_per: 'Contrato',
                tipod: 'V',
                fec_ini: '2023/05/01',
                fec_fin: '2023/05/15',
                h_entrada: '',
                h_salida: '',
                turno_per: '',
                obs_per: 'salio de vacacion' 
            },
        ],
        //condicionales
        getControl: function (columnKey) {
            if (columnKey == "fec_inic") {
                return '<input type="date" class="form-control" />';
            }
            if (columnKey == "h_entrada") {
                return '<input type="time" class="form-control" />';
            }
      
            if (columnKey == "item_per") {
                return '<select class="form-control"><option value="Contrato">Contrato</option><option value="Item">Item</option><option value="Tgn">Tgn</option><option value="Idh">Idh</option><option value="Ministerial">Ministerial</option></select>';
            }
      
            return '<input type="text" class="form-control" />';
        },
        //definimos los botones
        bottons:{
            editButton: '<input type="button" value="editar" class="btn btn-info" id=""/>',
            
            deleteButton: '<input type="button" value="Eliminar" class="btn btn-danger" id=""/>'
        },
        showActionColumn: true,
        
        
      });
      var data = $("#myTable").getTableData();
      */
});
