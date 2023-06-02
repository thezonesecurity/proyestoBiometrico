@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Reportes
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
<style>
  .error {
  color: red;}
</style>
@stop

@section('contenido')
<p>reporte 3</p>
  
@stop


@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>


<script>
    $(document).ready(function () {
        $('#listaExample').DataTable({
            "lengthMenu": [[5, 15 , 30, 60, -1], [5, 15 , 30, 60, "All"]]
        });
    });
</script>
@stop