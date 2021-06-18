
@auth()
<div id="sidebar" class="sidebar sidebar-fixed expandable sidebar-light" data-backdrop="true" data-dismiss="true" data-swipe="true">
    <div class="sidebar-inner">

        <div class="ace-scroll flex-grow-1 mt-1px" data-ace-scroll="{}">

            <!-- optional `nav` tag -->
            <nav class="pt-3" aria-label="Main">
                <ul class="nav flex-column has-active-border">

                    <li class="nav-item-caption">
                        <span class="fadeable pl-3">OPCIONES</span>
                        <span class="fadeinable mt-n2 text-125">&hellip;</span>
                    </li>

                    <li class="nav-item {{ url()->current() == route('home') ? 'active': '' }}">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="nav-icon fa fa-home"></i>
                            <span class="nav-text fadeable">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-item {{ url()->current() == route('listaUsuarios') ? 'active': '' }}">
                        <a class="nav-link" href="{{route('listaUsuarios')}}">
                            <i class="nav-icon fa fa-users"></i>
                            <span class="nav-text fadeable">Usuarios</span>
                        </a>
                    </li>

                </ul>
            </nav>

        </div><!-- /.ace-scroll -->

    </div>
</div>
@endauth
