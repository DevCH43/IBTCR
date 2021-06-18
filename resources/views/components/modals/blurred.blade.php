<!-- Blurred background/backdrop -->
<form action="{{ route($RouteModal) }}" method="GET"  accept-charset="UTF-8" >
    @csrf

    <div class="modal-header bgc-orange-tp1 shadow-md">
        <h5 class="modal-title text-white-tp1 " >
            {{$TituloModal}}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body modal-scroll bgc-orange-l3 shadow-md">
        {{$CuerpoModal}}
    </div>

    <div class="modal-footer bgc-dark-m1">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
            Filtrar
        </button>
    </div>

</form>
