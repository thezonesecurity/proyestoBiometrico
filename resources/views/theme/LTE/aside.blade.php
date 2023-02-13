<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="active">
                    <a href="{{ route('listar.servicio')}}">
                        <i class="glyphicon glyphicon-list-alt"></i> <span>Servicios</span>
                    </a>
                </li>
                <li class="treeview">
                    <a>
                        <i class="glyphicon glyphicon-paste"></i>
                        <span>otro</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('tabla')}}"><i class="fa fa-angle-double-right"></i> tabla</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> otro sub 2</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    
   <!--CONTENIDO-->
   <div class="col-md-2"></div>
   <div class="col-md-10">
    @yield('cuerpo')
   </div>
   <!--FIN CONTENIDO--->
</div><!-- ./wrapper -->