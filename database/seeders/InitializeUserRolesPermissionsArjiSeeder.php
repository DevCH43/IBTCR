<?php

namespace Database\Seeders;

use App\Classes\GeneralFunctios;
use App\Models\Catalogos\Empresa;
use App\Models\User;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class InitializeUserRolesPermissionsArjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        app()['cache']->forget('spatie.permission.cache');

        $F = new GeneralFunctios();
        $ip   = 'root_init';
        $host = 'root_init';

        Empresa::query()->truncate();

        $idemp = Empresa::create([
            'razon_social' => 'arji',
            'domicilio_fiscal' => 'concoido',
            'domicilio_fiscal' => 'rfc'
        ]);

        //dd($idemp);

        $P1 = Permission::create(['name' => 'all','guard_name' => 'web']);
        $P2 = Permission::create(['name' => 'crear','guard_name' => 'web']);
        $P3 = Permission::create(['name' => 'guardar','guard_name' => 'web']);
        $P4 = Permission::create(['name' => 'editar','guard_name' => 'web']);
        $P5 = Permission::create(['name' => 'modificar','guard_name' => 'web']);
        $P6 = Permission::create(['name' => 'eliminar','guard_name' => 'web']);
        $P7 = Permission::create(['name' => 'consultar','guard_name' => 'web']);
        $P8 = Permission::create(['name' => 'imprimir','guard_name' => 'web']);
        $P9 = Permission::create(['name' => 'asignar','guard_name' => 'web']);
        $P10 = Permission::create(['name' => 'desasignar','guard_name' => 'web']);
        $P11 = Permission::create(['name' => 'sysop','guard_name' => 'web']);

        $role_admin = Role::create([
            'name' => 'ADMIN',
            'description' => 'Administrator',
            'color' => '#263238',
            'abreviatura' => 'adm',
            'guard_name' => 'web',
        ]);
        $role_admin->permissions()->attach($P1);

        $role_sysop = Role::create([
            'name' => 'SYSOP',
            'description' => 'System Operator',
            'color' => '#455a64',
            'abreviatura' => 'sys',
            'guard_name' => 'web',
        ]);
        $role_sysop->permissions()->attach($P11);

        $role_invitado = Role::create([
            'name' => 'Invitado',
            'description' => 'Invitado',
            'color' => '#607d8b',
            'abreviatura' => 'inv',
            'guard_name' => 'web',
        ]);
        $role_invitado->permissions()->attach($P7);

        $user = new User();
        $user->nombre = 'Administrador';
        $user->username = 'Admin';
        $user->email = 'sentauro@gmail.com';
        $user->password = bcrypt('secret');
        $user->genero = 1;
        $user->admin = true;
        $user->empresa_id = $idemp->id;
        $user->ip = $ip;
        $user->host = $host;
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($role_admin);
        $user->permissions()->attach($P1);
        $user->user_adress()->create();
        $user->user_data_extend()->create();
        $user->user_data_social()->create();
        $F->validImage($user,'profile','profile/');

        $user = new User();
        $user->nombre = 'System Operator';
        $user->username = 'SysOp';
        $user->email = 'sysop@example.com';
        $user->password = bcrypt('sysop');
        $user->admin = false;
        $user->empresa_id = $idemp->id;
        $user->ip = $ip;
        $user->host = $host;
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($role_sysop);
        $user->permissions()->attach($P11);
        $user->user_adress()->create();
        $user->user_data_extend()->create();
        $user->user_data_social()->create();
        $F->validImage($user,'profile','profile/');

        Role::create(['name'=>'DIRECTOR A','description'=>'Director A', 'color'=>'#FFFFFF', 'abreviatura'=>'dira', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'DIRECTOR B','description'=>'Director B', 'color'=>'#FFFFFF', 'abreviatura'=>'dirb',  'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBDIRECTOR A','description'=>'Subdirector A', 'color'=>'#FFFFFF', 'abreviatura'=>'sbda',  'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBDIRECTOR B','description'=>'Subdirector B', 'color'=>'#FFFFFF', 'abreviatura'=>'sbdb',  'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COORDINADOR A','description'=>'Coordinador A', 'color'=>'#FFFFFF', 'abreviatura'=>'crda', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COORDINADOR B','description'=>'Coordinador B', 'color'=>'#FFFFFF', 'abreviatura'=>'crdb',  'guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'JEFE','description'=>'Jefe', 'color'=>'#FFFFFF', 'abreviatura'=>'jefe', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBJEFE','description'=>'Subjefe', 'color'=>'#FFFFFF', 'abreviatura'=>'subjf', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'REPORTES','description'=>'Reportes', 'color'=>'#FFFFFF', 'abreviatura'=>'rpt', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA A','description'=>'Capturista A', 'color'=>'#FFFFFF', 'abreviatura'=>'capa', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA B','description'=>'Capturista B', 'color'=>'#FFFFFF', 'abreviatura'=>'capb',   'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA C','description'=>'Capturista C', 'color'=>'#FFFFFF',  'abreviatura'=>'capc', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ENLACE','description'=>'Enlace', 'color'=>'#FFFFFF', 'abreviatura'=>'enl', 'guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'DIRECTOR','description'=>'Director', 'color'=>'#bf360c', 'abreviatura'=>'dir', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBDIRECTOR','description'=>'Subdirector', 'color'=>'#FFFFFF', 'abreviatura'=>'sbdr', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ALUMNO','description'=>'Alumno', 'color'=>'#558b2f', 'abreviatura'=>'alu', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PROFESOR','description'=>'Profesor', 'color'=>'#dd2c00', 'abreviatura'=>'pro', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COORDINADOR','description'=>'Coordinador', 'color'=>'#FFFFFF', 'abreviatura'=>'crd', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ASESOR','description'=>'Asesor', 'color'=>'#880e4f', 'abreviatura'=>'ase', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PREFECTO','description'=>'Prefecto', 'color'=>'#e65100', 'abreviatura'=>'pref', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CONTROL ESCOLAR','description'=>'Control Escolar', 'color'=>'#ff1744', 'abreviatura'=>'ces', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COMPRAS','description'=>'Jefe de Compras', 'color'=>'#FFFFFF', 'abreviatura'=>'comp', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PROVEEDORES','description'=>'Jefe de Proveedores', 'color'=>'#FFFFFF', 'abreviatura'=>'prov', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAJERA','description'=>'Cajera', 'color'=>'#FFFFFF', 'abreviatura'=>'caja', 'guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'PERMISOS SALIDA','description'=>'Permisos de Salida', 'color'=>'#FFFFFF', 'abreviatura'=>'psal', 'guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'JEFE GRUPO','description'=>'Jefe de Grupo', 'color'=>'#FFFFFF', 'abreviatura'=>'jgpo', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'EXALUMNO','description'=>'Exalumno', 'color'=>'#33691e', 'abreviatura'=>'exal', 'guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'PADRE FAMILIA','description'=>'Padre de Familia', 'color'=>'#3d5afe', 'abreviatura'=>'pfam', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'MADRE FAMILIA','description'=>'Madre de Familia', 'color'=>'#ff80ab', 'abreviatura'=>'mfam', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'TUTOR','description'=>'Tutor', 'color'=>'#00695c', 'abreviatura'=>'tut', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'FAMILIAR','description'=>'Otro Familiar', 'color'=>'#7c4dff', 'abreviatura'=>'fam', 'guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'CONTADOR','description'=>'Contador(a)', 'color'=>'#FF00FF', 'abreviatura'=>'ctnd', 'guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CONTRALOR','description'=>'Contador(a)', 'color'=>'#FF00ee', 'abreviatura'=>'cntl', 'guard_name'=>'web'])->permissions()->attach($P7);



    }
}
