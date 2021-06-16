<x-catalogo-list>
    @slot('tituloTabla',$tituloTabla)
    @slot('items',$items)
    @slot('user',$user)
    @slot('newItem',$newItem ?? null)
    @slot('editItem',$editItem)
    @slot('removeItem',$removeItem)
    @slot('Tabla')
        @include('share.Catalogos.User.__users_list')
    @endslot
</x-catalogo-list>
