<?php

namespace App\Http\Requests\User;

use App\Classes\GeneralFunctios;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Database\QueryException;




class UserRequest extends FormRequest{

    protected $redirectRoute = 'editProfile';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required','min:4','unique:users,username,'.$this->id],
            'email' => ['required','email','unique:users,email,'.$this->id],
            'nombre' => ['required','min:1'],
            'ap_paterno' => ['required','min:1'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'El :attribute requiere por lo menos de 4 caracter',
            'username.unique' => 'El :attribute ya existe',

            'email.required' => 'El :attribute es obligatorio',
            'email.unique' => 'El :attribute ya existe',

            'nombre.required' => 'Se requiere el :attribute',
            'nombre.min' => 'El :attribute requiere por lo menos de 1 caracter',
            'ap_paterno.required' => 'Se requiere el :attribute',
            'ap_paterno.min' => 'El :attribute requiere por lo menos de 1 caracter',

        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'nombre' => 'Nombre',
            'ap_paterno' => 'Apellido Paterno',
        ];
    }

    public function manageUser()
    {

//        dd($this->username);

        $UserN = [
            'username' => trim($this->username),
            'email'    => trim($this->email),
            'password' => bcrypt(trim($this->username))
        ];
//        dd($UserN);
        $User = [
            'ap_paterno'       => strtoupper(trim($this->ap_paterno)),
            'ap_materno'       => strtoupper(trim($this->ap_materno)),
            'nombre'           => strtoupper(trim($this->nombre)),
            'curp'             => strtoupper(trim($this->curp)),
            'emails'           => trim($this->emails),
            'celulares'        => trim($this->celulares),
            'telefonos'        => trim($this->telefonos),
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'genero'           => $this->genero,
        ];

        $User_Adress = [
            'calle'     => strtoupper(trim($this->calle)),
            'num_ext'   => trim($this->num_ext),
            'num_int'   => trim($this->num_int),
            'colonia'   => strtoupper(trim($this->colonia)),
            'localidad' => strtoupper(trim($this->localidad)),
            'municipio' => strtoupper(trim($this->municipio)),
            'estado'    => strtoupper(trim($this->estado)),
            'pais'      => strtoupper(trim($this->pais)),
            'cp'        => trim($this->cp),
        ];

        $User_Data_Extend = [
            'lugar_nacimiento' => strtoupper(trim($this->lugar_nacimiento)),
            'ocupacion'        => strtoupper(trim($this->ocupacion)),
            'profesion'        => strtoupper(trim($this->profesion)),
        ];

        $User_Data_Social = [
            'red_social'          => strtoupper(trim($this->red_social)),
            'username_red_social' => trim($this->username_red_social),
            'alias_red_social'    => trim($this->alias_red_social),
        ];
        try {

            if ($this->id == 0) {
                $user = User::create($UserN);
                $user->update($User);
                $role_invitado = Role::findByName('Invitado');
                $user->roles()->attach($role_invitado);
                $P1 = Permission::findByName('consultar');
                $user->permissions()->attach($P1);
                $user->user_adress()->create();
                $user->user_data_extend()->create();
                $user->user_data_social()->create();
                $F = new GeneralFunctios();
                $F->validImage($user, 'profile', 'profile/');

                $user->user_adress()->create($User_Adress);
                $user->user_data_extend()->create($User_Data_Extend);
                $user->user_data_social()->create($User_Data_Social);
            } else {
                $user = User::find($this->id);
                $user->update($User);
                $user->user_adress()->update($User_Adress);
                $user->user_data_extend()->update($User_Data_Extend);
                $user->user_data_social()->update($User_Data_Social);
            }
        }catch (QueryException $e){
            return $e->getMessage();
        }
        return $user;
    }

    protected function validPhoto(User $user){
        $F = new GeneralFunctios();
        $F->validImage($user,'profile','profile/');

    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('editProfile');
        }
    }


}
