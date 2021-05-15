<?php

namespace Database\Seeders;

use App\Classes\GeneralFunctios;
use App\Models\User;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Database\Seeder;

class InitializeUserRolesPermissionsSeeder extends Seeder
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
        $idemp = 1;

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
            'guard_name' => 'web',
        ]);
        $role_admin->permissions()->attach($P1);

        $role_sysop = Role::create([
            'name' => 'SYSOP',
            'description' => 'System Operator',
            'guard_name' => 'web',
        ]);
        $role_sysop->permissions()->attach($P11);

        $role_invitado = Role::create([
            'name' => 'Invitado',
            'description' => 'Invitado',
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
        $user->empresa_id = $idemp;
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
        $user->empresa_id = $idemp;
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

        Role::create(['name'=>'DIRECTOR A','description'=>'Director A','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'DIRECTOR B','description'=>'Director B','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBDIRECTOR A','description'=>'Subdirector A','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBDIRECTOR B','description'=>'Subdirector B','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COORDINADOR A','description'=>'Coordinador A','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COORDINADOR B','description'=>'Coordinador B','guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'JEFE','description'=>'Jefe','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBJEFE','description'=>'Subjefe','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'REPORTES','description'=>'Reportes','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA A','description'=>'Capturista A','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA B','description'=>'Capturista B','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA C','description'=>'Capturista C','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ENLACE','description'=>'Enlace','guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'DIRECTOR','description'=>'Director','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBDIRECTOR','description'=>'Subdirector','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ALUMNO','description'=>'Alumno','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PROFESOR','description'=>'Profesor','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COORDINADOR','description'=>'Coordinador','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ASESOR','description'=>'Asesor','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PREFECTO','description'=>'Prefecto','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CONTROL ESCOLAR','description'=>'Control Escolar','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COMPRAS','description'=>'Jefe de Compras','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PROVEEDORES','description'=>'Jefe de Proveedores','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAJERA','description'=>'Cajera','guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'PERMISOS SALIDA','description'=>'Permisos de Salida','guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'JEFE GRUPO','description'=>'Jefe de Grupo','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'EXALUMNO','description'=>'Exalumno','guard_name'=>'web'])->permissions()->attach($P7);

        Role::create(['name'=>'PADRE FAMILIA','description'=>'Padre de Familia','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'MADRE FAMILIA','description'=>'Madre de Familia','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'TUTOR','description'=>'Tutor','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'FAMILIAR','description'=>'Otro Familiar','guard_name'=>'web'])->permissions()->attach($P7);




    }
}
