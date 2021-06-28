<?php

namespace Database\Seeders;

use App\Models\Catalogos\Empresa;
use App\Models\Catalogos\Familia;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class ImportFamiliasArjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){




        @ini_set( 'upload_max_size' , '32768M' );
        @ini_set( 'post_max_size', '32768M');
        @ini_set( 'max_execution_time', '256000000' );

        $creado_por_id = User::find(1)->id;
        // Se inicializa el número de la empresa wue se estará utilizando
        $empresa_id = 1;
        $Emp = Empresa::find($empresa_id);

        //Familia::query()->truncate();

        $file = 'public/familias.txt';

        $json_data = file_get_contents($file);
        $json_data = preg_split( "/\n/", $json_data );

        for ($x = 0; $x < count($json_data); $x++){

            try{

                $dupla = preg_split("/\t/", $json_data[$x], -1, PREG_SPLIT_NO_EMPTY);

                if ( $dupla ) {

                    $arr = str_getcsv($dupla[0], '|');
                    $arrFam = explode(',', $arr[0]);
                    $arrFamEmails = str_replace(';', ',', $arrFam[4]);
                    $Fam1 = Familia::agregarConSeeder($arrFam[0], $arrFam[1], $arrFam[2], $arrFam[3], $arrFamEmails, 1, 1, $arrFam[5], $Emp->id, $creado_por_id);
                    $arrAlu = User::findByIdUserAnterior($arr[1]);
                    for ($i = 2; $i <= 10; ++$i){
                        if (isset($arr[$i])) {
                            $arrF = explode(',', $arr[$i]);
                            $IdF = User::findByIdUserAnterior($arrF[0]);
                            $IdT = User::findByIdUserAnterior($arrF[2]);
                            if ( is_null($arrAlu)==false && is_null($IdF)==false && is_null($IdT)==false ){
                                $Fam1->alumnos()->attach($arrAlu->id, ['familiar_id' => $IdF->id, 'alumno_parentesco_id' => 5, 'familiar_parentesco_id' => $arrF[1], 'tutor_id' => $IdT->id, 'empresa_id' => $Emp->id, 'creado_por_id' => $creado_por_id, 'idfamilia' => $arrFam[5]]);
                            }
                        }
                    }

                }
            }catch (QueryException $e){
                Log::alert($e->getMessage() ." => ". $arr);
                continue;
            }catch (\Whoops\Exception\ErrorException $e){
                Log::alert($e->getMessage() ." => ". $arr);
                continue;
            }
        }


    }



}
