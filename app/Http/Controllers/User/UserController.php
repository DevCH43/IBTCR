<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserPasswordRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;



class UserController extends Controller{




    protected $tableName = "users";
    protected $navCat = "usuarios";
    protected $msg = "";



// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //

    /**
     * UserController constructor.
     * @param string $msg
     */
    public function __construct(){
    }

    protected function index(Request $request){

        $this->lim_max_reg = config('ibt.limite_maximo_registros');
        $this->lim_min_reg = config('ibt.limite_minimo_registros');
        $this->max_reg_con = config('ibt.maximo_registros_consulta');
        $this->min_reg_con = config('ibt.minimo_registros_consulta');

        @ini_set( 'upload_max_size' , '16384M' );
        @ini_set( 'post_max_size', '16384M');
        @ini_set( 'max_execution_time', '960000' );

        $this->tableName = 'users';

//        $items = User::query()->get()->take(250);
        $items = User::query()->get();

        $user = Auth::user();

        $request->session()->put('items', $items);

        return view('layouts.User._users_list',[
            "items"       => $items,
            "user"        => $user,
            "tituloTabla" => "Listado de Usuarios",
            "editItem"    => null,
            "removeItem"  => null,
        ]);
    }

// ***************** EDITA LOS DATOS DEL USUARIO SOLO LECTURA ++++++++++++++++++++ //
    protected function editProfileReadOnly()
    {
        $user = Auth::user();
        return view('catalogos.user.profile.user_profile_edit',
            [
                'items' => $user,
                'leyenda' => 'Editando el',
                'tableName' => "Usuario ",
                'navCat' => $this->navCat,
                'user' => $user,
            ]
        );
    }

// ***************** MANDA A LLAMAR LA PANTALLA PARA NUEVO USUARIO ++++++++++++++++++++ //
    protected function newUser()
    {
        return view('catalogos.catalogo.user.user_profile_new',
            [
                'titulo_catalogo' => 'Catálogo de Usuarios',
                'titulo_header'   => 'Nuevo Usuario ',
                'postNew' => 'createUser',
            ]
        );
    }

// ***************** EDITA LOS DATOS DEL USUARIO PARA ESCRITURA ++++++++++++++++++++ //
    protected function editProfile($Id)
    {

        $user = User::find($Id);
        return view('User.profile',
            [
                'User' => $user,
                'titulo' => 'Mi Perfil',
                'Route' => 'updateProfile',
                'Method' => 'POST',
                'msg' => $this->msg,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS EN EL USUARIO ++++++++++++++++++++ //
    protected function updateProfile(UserRequest $request)
    {
//        dd($request);
        $request->manageUser();
        $User = Auth::user();
        session(['msg' => 'value']);
        return redirect()->route('editProfile',['Id'=>$User]);
    }

// ***************** GUARDA LOS CAMBIOS EN EL USUARIO ++++++++++++++++++++ //
    protected function updateUser(UserRequest $request)
    {
//        dd($request);
        $user = $request->manageUser();
        if (!isset($user)) {
            abort(404);
        }
        return view('catalogos.user.profile.user_profile_edit',
            [
                'user' => $user,
                'items' => $user,
                'titulo_catalogo' => $user->Fullname,
                'titulo_header'   => '',
                'putEdit' => 'EditUser',
            ]
        );
    }

// ***************** CREAR NUEVO USUARIO ++++++++++++++++++++ //
    protected function createUser(UserRequest $request)
    {
        $user = $request->manageUser();
        if (!isset($user)) {
            abort(404);
        }
        return view('catalogos.catalogo.user.user_profile_edit',
            [
                'user' => $user,
                'items' => $user,
                'titulo_catalogo' => $user->Fullname,
                'titulo_header'   => 'Editando..',
                'putEdit' => 'EditUser',
            ]
        );
    }

// ***************** MUESTRA LA EDICIÓMN DE FOTO ++++++++++++++++++++ //
    protected function editFotodUser()
    {
        $user = Auth::user();
        return view('User.foto', [
                'User' => $user,
                'titulo' => 'Cambiar mi password',
                'Route' => 'updateFotodUser',
                'Method' => 'POST',
                'msg' => $this->msg,
                'IsUpload' => true,
                'IsNew' => true,
            ]
        );
    }

// ***************** MUESTRA LA EDICIÓN DEL PASSWORD ++++++++++++++++++++ //
    protected function editPasswordUser()
    {

        $user = Auth::user();
        $titulo_catalogo = "";
        return view('User.password', [
                'User' => $user,
                'titulo' => 'Cambiar mi password',
                'Route' => 'updatePasswordUser',
                'Method' => 'POST',
                'msg' => $this->msg,
            ]
        );
    }

// ***************** CAMBIA EL PASSWORD ++++++++++++++++++++ //
    protected function updatePasswordUser(UserPasswordRequest $request)
    {
        $request->UserPasswordRequest();
        $User = Auth::user();
        session(['msg' => 'value']);
        return redirect()->route('editPasswordUser',['Id'=>$User]);

    }

// ***************** ELIMINA AL USUARIO VIA AJAX ++++++++++++++++++++ //
    protected function removeUser($id = 0)
    {
        $user = User::withTrashed()->findOrFail($id);
        if (isset($user)) {
            if (!$user->trashed()) {
                $user->forceDelete();
            } else {
                $user->forceDelete();
            }
            return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
        } else {
            return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
        }
    }


}
