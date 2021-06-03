
@auth()
<div id="sidebar" class="sidebar sidebar-fixed expandable sidebar-light" data-backdrop="true" data-dismiss="true" data-swipe="true">
    <div class="sidebar-inner">

        <div class="ace-scroll flex-grow-1 mt-1px" data-ace-scroll="{}">

            <!-- optional `nav` tag -->
            <nav class="pt-3" aria-label="Main">
                <ul class="nav flex-column has-active-border">
                    <li class="nav-item">
                        <a class="nav-link" href="html/dashboard.html">
                            <i class="nav-icon fa fa-home"></i>
                            <span class="nav-text fadeable">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('listaAlumnos',["Id"=>0])}}">
                            <i class="nav-icon fa fa-edit"></i>
                            <span class="nav-text fadeable">Alumnos</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div><!-- /.ace-scroll -->

    </div>
</div>
@endauth
