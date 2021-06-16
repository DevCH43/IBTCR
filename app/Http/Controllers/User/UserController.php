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

        $items = User::query()->orderByDesc('id')->get()->take($this->max_reg_con);
        // $items = User::query()->get();

        $user = Auth::user();

        $request->session()->put('items', $items);

        return view('layouts.User.generales._users_list',[
            'items'       => $items,
            'user'        => $user,
            'tituloTabla' => 'Listado de Usuarios',
            'newItem'     => 'newUsuario',
            'editItem'    => 'editUsuario',
            'removeItem'  => 'removeUsuario',
        ]);
    }


    protected function newItem(){

        $user = Auth::user();


        return view('layouts.User.generales._user_edit',[
            "item"     => null,
            "User"     => $user,
            "titulo"   => "Nuevo registro ",
            'Route'    => 'createUsuario',
            'Method'   => 'POST',
            'msg'      => $this->msg,
            'IsUpload' => false,
            'IsNew'    => true,
        ]);

    }

    protected function createItem(UserRequest $request) {
        //dd($request);
        $User = $request->manageUser();
        if (!isset($User)) {
            abort(404);
        }
        $user = Auth::user();

        return view('layouts.User.generales._user_edit',[
            "item"     => $User,
            "User"     => $user,
            "titulo"   => "Editando el registro: ".$User->id,
            'Route'    => 'updateUsuario',
            'Method'   => 'POST',
            'msg'      => $this->msg,
            'IsUpload' => false,
            'IsNew'    => false,
        ]);

    }


    protected function editItem($Id){

        $User = User::find($Id);
        $user = Auth::user();

        return view('layouts.User.generales._user_edit',[
            "item"     => $User,
            "User"     => $user,
            "titulo"   => "Editando el registro: ".$Id,
            'Route'    => 'updateUsuario',
            'Method'   => 'POST',
            'msg'      => $this->msg,
            'IsUpload' => false,
            'IsNew'    => false,
        ]);

    }

    protected function updateItem(UserRequest $request) {
        $User = $request->manageUser();
        if (!isset($User)) {
            abort(404);
        }
        $user = Auth::user();

        return view('layouts.User.generales._user_edit',[
            "item"     => $User,
            "User"     => $user,
            "titulo"   => "Editando el registro: ".$User->id,
            'Route'    => 'updateUsuario',
            'Method'   => 'POST',
            'msg'      => $this->msg,
            'IsUpload' => false,
            'IsNew'    => false,
        ]);

    }

















// ***************** EDITA LOS DATOS DEL USUARIO PARA ESCRITURA ++++++++++++++++++++ //
    protected function editProfile($Id)
    {

        $user = User::find($Id);
        return view('User.profile',
            [
                'item' => $user,
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

    // ***************** Devuelve el Proximo Usuario++++++++++++++++++++ //
    protected function getUsernameNext($IdType = 0){
        $data = [];
        $msg = "OK";
        //dd($Id);
        $data = User::getUsernameNext($IdType);

        return Response::json(['mensaje' => $msg, 'data' => $data, 'status' => '200'], 200);

    }


    // ***************** ELIMINA AL USUARIO VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($Id = 0, $dato1 = null, $dato2 = null){
        $code = 'OK';
        $msg = "Registro Eliminado con éxito!";
        //dd($Id);
        $user = User::withTrashed()->findOrFail($Id);
        $user->forceDelete();

        return Response::json(['mensaje' => $msg, 'data' => $code, 'status' => '200'], 200);

    }



}
