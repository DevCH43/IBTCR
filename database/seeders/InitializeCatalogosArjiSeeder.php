<?php

namespace Database\Seeders;

use App\Models\Catalogos\Alumno;
use App\Models\Catalogos\Ciclo;
use App\Models\Catalogos\Empresa;
use App\Models\Catalogos\Familia;
use App\Models\Catalogos\Grado;
use App\Models\Catalogos\Nivel;
use App\Models\Catalogos\Parentesco;
use App\Models\Catalogos\Subciclo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class InitializeCatalogosArjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

     // Obtenemos el primer Usuario que debe ser el que se crea primero al generar el Seedor UserRolesPermisos
     $creado_por_id = User::find(1)->id;

     //Obtenemos los Roles
     $RoleAlumnoId = Role::select('id')->where('name','ALUMNO')->first()->id;
     $RolePapaId = Role::select('id')->where('name','PADRE FAMILIA')->first()->id;
     $RoleMamaId = Role::select('id')->where('name','MADRE FAMILIA')->first()->id;
     $RoleTutorId = Role::select('id')->where('name','TUTOR')->first()->id;


    // Se inicializa el número de la empresa wue se estará utilizando
    $empresa_id = 1;
    $Emp = Empresa::find($empresa_id);

    // Se crea el ciclo

    $C1 = Ciclo::agregarConSeeder('2020-2021','2020-07-01','2021-07-31',1,'2020','2021',1,1,$Emp->id,$creado_por_id);
    $SC1 = Subciclo::agregarConSeeder('Sep-20 - Ene-21','2020-07-01','2021-01-31',1,'2020','2021',1,1, $Emp->id, $C1->id,$creado_por_id);
    $SC2 = Subciclo::agregarConSeeder('Feb-21 - Jul-21','2021-02-01','2021-07-31',1,'2021','2021',1,1, $Emp->id, $C1->id,$creado_por_id);
    $SC1->ciclos()->attach($C1);
    $SC2->ciclos()->attach($C1);

        // Se inicializan los catálogos que se vaya a utilizar
    $N1 = Nivel::agregarConSeeder('K00','Preescolar','clave_reg','niv_ofi','','K',3,'',1,$empresa_id,$creado_por_id);
    $N2 = Nivel::agregarConSeeder('P00','Primaria','clave_reg','niv_ofi','','P',3,'',1,$empresa_id,$creado_por_id);
    $N3 = Nivel::agregarConSeeder('S00','Secundaria','clave_reg','niv_ofi','','S',3,'',1,$empresa_id,$creado_por_id);
    $N4 = Nivel::agregarConSeeder('B00','Bachillerato','clave_reg','niv_ofi','','B',3,'',1,$empresa_id,$creado_por_id);
    $N5 = Nivel::agregarConSeeder('I00','1ro Inglés','clave_reg','niv_ofi','','I',3,'',1,$empresa_id,$creado_por_id);

    $GK1 = Grado::agregarConSeeder('1ro', 'Primero','Primero','1',$N1->numero_evaluaciones,$N1->id,$Emp->id,$creado_por_id);
    $GK2 = Grado::agregarConSeeder('1ro', 'Primero','Primero','1',$N2->numero_evaluaciones,$N2->id,$Emp->id,$creado_por_id);
    $GK3 = Grado::agregarConSeeder('1ro', 'Primero','Primero','1',$N3->numero_evaluaciones,$N3->id,$Emp->id,$creado_por_id);
    $GK4 = Grado::agregarConSeeder('1ro', 'Primero','Primero','1',$N4->numero_evaluaciones,$N4->id,$Emp->id,$creado_por_id);
    $GK5 = Grado::agregarConSeeder('1ro', 'Primero','Primero','1',$N5->numero_evaluaciones,$N5->id,$Emp->id,$creado_por_id);

    $Par1 = Parentesco::agregarConSeeder('Abuelo','Abuela',$Emp->id,$creado_por_id);
    $Par2 = Parentesco::agregarConSeeder('Papá','Papá',$Emp->id,$creado_por_id);
    $Par3 = Parentesco::agregarConSeeder('Mamá','Mamá',$Emp->id,$creado_por_id);
    $Par4 = Parentesco::agregarConSeeder('Hermano','Hermana',$Emp->id,$creado_por_id);
    $Par5 = Parentesco::agregarConSeeder('Tío','Tía',$Emp->id,$creado_por_id);
    $Par6 = Parentesco::agregarConSeeder('Primo','Prima',$Emp->id,$creado_por_id);
    $Par7 = Parentesco::agregarConSeeder('Padrino','Madrina',$Emp->id,$creado_por_id);
    $Par8 = Parentesco::agregarConSeeder('Padrastro','Madrastra',$Emp->id,$creado_por_id);
    $Par9 = Parentesco::agregarConSeeder('Amigo','Amiga',$Emp->id,$creado_por_id);
    $Par10 = Parentesco::agregarConSeeder('No. Esp.','No. Esp.',$Emp->id,$creado_por_id);


/*
    $user_id_anterior = 1234;
    $UserAlu = User::agregarConSeeder('luisa','pecas','pica','alumno1','curp','correos ue tenga','celulares que tenga','telefonos que tenga','2021-05-22',0,$Emp->id,$creado_por_id,$user_id_anterior,$RoleAlumnoId);
    $Alu1 = Alumno::agregarConSeeder('a1','b1','2021-07-01',1,'escriba aquí los teléfonos y contactos de emergencia',$Emp->id,$UserAlu->id,$creado_por_id);

    $user_id_anterior = 5678;
    $UserPapa1 = User::agregarConSeeder('pepe','pecas','lopez','papa1','curp','correos ue tenga','celulares que tenga','telefonos que tenga','2021-05-19',1,$Emp->id,$creado_por_id,$user_id_anterior,$RolePapaId);

    $user_id_anterior = 9012;
    $UserMama1 = User::agregarConSeeder('luisa','lopez','pecas','mama1','curp','correos ue tenga','celulares que tenga','telefonos que tenga','2021-05-20',0,$Emp->id,$creado_por_id,$user_id_anterior,$RoleMamaId);

    $Fam1 = Familia::agregarConSeeder('pecas lopez','ninguna','ninguna','ninguno','vacío',1,1,1234,$Emp->id,$creado_por_id);

    $Fam1->alumnos()->attach($UserAlu->id,['familiar_id'=>$UserPapa1->id,'alumno_parentesco_id'=>5,'familiar_parentesco_id'=>2,'tutor_id'=>$UserPapa1->id,'empresa_id'=>$Emp->id,'creado_por_id'=>$creado_por_id,'idfamilia'=>0]);
    $Fam1->alumnos()->attach($UserAlu->id,['familiar_id'=>$UserMama1->id,'alumno_parentesco_id'=>5,'familiar_parentesco_id'=>1,'tutor_id'=>$UserPapa1->id,'empresa_id'=>$Emp->id,'creado_por_id'=>$creado_por_id,'idfamilia'=>0]);

*/


    }
}
