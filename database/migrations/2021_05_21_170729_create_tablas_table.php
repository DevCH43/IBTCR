<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        // Rutas de las Tablas
        $tableUsers      = config('ibt.table_names.users');
        $tableCatalogos  = config('ibt.table_names.catalogos');
        $tableRelaciones = config('ibt.table_names.relaciones');

        // Catálogo de Ciclos
        Schema::create($tableCatalogos['ciclos'], function (Blueprint $table) use ($tableCatalogos, $tableUsers) {
            $table->increments('id');
            $table->string('ciclo',30)->default('');
            $table->string('inicio',25)->default('');
            $table->date('fin')->nullable();
            $table->smallInteger('predeterminado')->default(0);
            $table->integer('ciclo_anterior_id')->default(0);
            $table->string('prefijo')->default('');
            $table->string('sufijo')->default('');
            $table->smallInteger('estatus')->default(1)->comment('0=Inactivo, 1=Activo');
            $table->integer('empresa_id')->default(0);
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('empresa_id')
                ->references('id')
                ->on($tableCatalogos['empresas'])
                ->onDelete('cascade');

            $table->foreign('ciclo_anterior_id')
                ->references('id')
                ->on($tableCatalogos['ciclos'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

        });

        // Catálogo de SubCiclos
        Schema::create($tableCatalogos['subciclos'], function (Blueprint $table) use ($tableCatalogos, $tableUsers) {
            $table->increments('id');
            $table->string('subciclo',30)->default('');
            $table->string('inicio',25)->default('');
            $table->date('fin')->nullable();
            $table->smallInteger('predeterminado')->default(0);
            $table->integer('subciclo_anterior_id')->default(0);
            $table->string('prefijo')->default('');
            $table->string('sufijo')->default('');
            $table->smallInteger('estatus')->default(1)->comment('0=Inactivo, 1=Activo');
            $table->integer('ciclo_id')->default(0);
            $table->integer('empresa_id')->default(0);
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('empresa_id')
                ->references('id')
                ->on($tableCatalogos['empresas'])
                ->onDelete('cascade');

            $table->foreign('ciclo_id')
                ->references('id')
                ->on($tableCatalogos['ciclos'])
                ->onDelete('cascade');

            $table->foreign('subciclo_anterior_id')
                ->references('id')
                ->on($tableCatalogos['subciclos'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

        });

        // Catálogo de SubCiclos
        Schema::create($tableRelaciones['ciclo_subciclo'], function (Blueprint $table) use ($tableCatalogos) {
            $table->increments('id');
            $table->integer('ciclo_id')->default(0);
            $table->integer('subciclo_id')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ciclo_id')
                ->references('id')
                ->on($tableCatalogos['ciclos'])
                ->onDelete('cascade');

            $table->foreign('subciclo_id')
                ->references('id')
                ->on($tableCatalogos['subciclos'])
                ->onDelete('cascade');

        });

        // Catálogo de Niveles
        Schema::create($tableCatalogos['niveles'], function (Blueprint $table) use ($tableCatalogos, $tableUsers) {
            $table->increments('id');
            $table->string('clave',10)->default('');
            $table->string('nivel',25)->default('');
            $table->string('clave_registro_nivel',15)->default('');
            $table->string('nivel_oficial',25)->default('');
            $table->string('nivel_fiscal',25)->default('');
            $table->string('prefijo_evaluacion',10)->default('');
            $table->integer('numero_evaluaciones')->default(0);
            $table->string('fecha_actas',15)->default(0);
            $table->smallInteger('estatus')->default(1)->comment('0=Inactivo, 1=Activo');
            $table->integer('empresa_id')->default(0);
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('empresa_id')
                ->references('id')
                ->on($tableCatalogos['empresas'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

        });

        // Catálogo de Grados
        Schema::create($tableCatalogos['grados'], function (Blueprint $table) use ($tableCatalogos, $tableUsers) {
            $table->increments('id');
            $table->string('clave',10)->default('');
            $table->string('grado_interno',25)->default('');
            $table->string('grado_oficial',25)->default('');
            $table->string('prefijo',10)->default('');
            $table->integer('numero_evaluaciones')->default(0);
            $table->smallInteger('estatus')->default(1)->comment('0=Inactivo, 1=Activo');
            $table->integer('empresa_id')->default(0);
            $table->integer('nivel_id')->default(0);
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('empresa_id')
                ->references('id')
                ->on($tableCatalogos['empresas'])
                ->onDelete('cascade');

            $table->foreign('nivel_id')
                ->references('id')
                ->on($tableCatalogos['niveles'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

        });

        // Catálogo de Parentescos
        Schema::create($tableUsers['parentescos'], function (Blueprint $table) use ($tableCatalogos, $tableUsers) {
            $table->bigIncrements('id');
            $table->string('parentesco_masculino',25)->default('')->nullable();
            $table->string('parentesco_femenino',25)->default('')->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->integer('empresa_id')->default(0);
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['parentesco_masculino','parentesco_femenino']);

            $table->foreign('empresa_id')
                ->references('id')
                ->on($tableCatalogos['empresas'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');
        });

        // Catálogo de Alumnos
        Schema::create($tableCatalogos['alumnos'], function (Blueprint $table) use ($tableCatalogos, $tableUsers) {
            $table->increments('id');
            $table->string('matricula_oficial',10)->default('');
            $table->string('matricula_interna',25)->default('');
            $table->date('fecha_ingreso')->nullable();
            $table->smallInteger('num_lista')->default(0);
            $table->string('telefonos_emergencia',500)->default('');
            $table->decimal('beca_1',10,2)->default(0)->nullable()->comment('guarda el poncentaje de beca 1');
            $table->decimal('beca_2',10,2)->default(0)->nullable()->comment('guarda el poncentaje de beca 2');
            $table->decimal('beca_3',10,2)->default(0)->nullable()->comment('guarda el poncentaje de beca 3');
            $table->decimal('beca_4',10,2)->default(0)->nullable()->comment('guarda el poncentaje de beca 4');
            $table->decimal('beca_5',10,2)->default(0)->nullable()->comment('guarda el poncentaje de beca 5');
            $table->smallInteger('estatus')->default(1)->comment('0=Inactivo, 1=Activo');
            $table->integer('empresa_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('empresa_id')
                ->references('id')
                ->on($tableCatalogos['empresas'])
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on($tableCatalogos['users'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

        });

        // Catálogo de Familias
        Schema::create($tableCatalogos['familias'], function (Blueprint $table) use ($tableCatalogos, $tableUsers) {
            $table->increments('id');
            $table->string('familia',250)->default('');
            $table->string('observaciones_control_escolar',500)->default('');
            $table->string('observaciones_pagos',500)->nullable();
            $table->text('convenios')->default(0);
            $table->string('emails',150)->default('');
            $table->smallInteger('estatus')->default(1)->comment('0=Inactivo, 1=Activo');
            $table->smallInteger('valid_for_admin')->default(1)->comment('0=No, 1=Si');
            $table->integer('idfamilia')->default(0)->comment('id del sistema anterior');
            $table->integer('empresa_id')->default(0);
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('empresa_id')
                ->references('id')
                ->on($tableCatalogos['empresas'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

        });

        DB::statement("ALTER TABLE familias ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE familias SET searchtext = to_tsvector('spanish', coalesce(trim(familia),'') || ' ' || coalesce(trim(emails),'') )");
        DB::statement("CREATE INDEX searchtext_familia_gin ON familias USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON familias FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'familia', 'emails')");

        //Define la Familia
        Schema::create($tableRelaciones['familia_familiar_user'], function (Blueprint $table) use ($tableUsers, $tableCatalogos){
            $table->increments('id');
            $table->unsignedInteger('familia_id')->default(0)->index();
            $table->unsignedInteger('alumno_id')->default(0)->index();
            $table->unsignedInteger('familiar_id')->default(0)->index();
            $table->unsignedInteger('tutor_id')->default(0)->index();
            $table->unsignedInteger('alumno_parentesco_id')->default(0)->index();
            $table->unsignedInteger('familiar_parentesco_id')->default(0)->index();
            $table->integer('idfamilia')->default(0)->comment('id del sistema anterior');
            $table->integer('empresa_id')->default(0);
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['familia_id','familiar_id', 'alumno_id','tutor_id','alumno_parentesco_id','familiar_parentesco_id']);

            $table->foreign('empresa_id')
                ->references('id')
                ->on($tableCatalogos['empresas'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

            $table->foreign('familia_id')
                ->references('id')
                ->on($tableCatalogos['familias'])
                ->onDelete('cascade');

            $table->foreign('alumno_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

            $table->foreign('familiar_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

            $table->foreign('tutor_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

            $table->foreign('alumno_parentesco_id')
                ->references('id')
                ->on($tableUsers['parentescos'])
                ->onDelete('cascade');

            $table->foreign('familiar_parentesco_id')
                ->references('id')
                ->on($tableUsers['parentescos'])
                ->onDelete('cascade');


        });



















    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableCatalogos  = config('ibt.table_names.catalogos');
        $tableRelaciones = config('ibt.table_names.relaciones');
        $tableUsers      = config('ibt.table_names.users');

        Schema::dropIfExists($tableRelaciones['ciclo_subciclo']);
        Schema::dropIfExists($tableCatalogos['subciclos']);
        Schema::dropIfExists($tableCatalogos['ciclos']);
        Schema::dropIfExists($tableCatalogos['grados']);
        Schema::dropIfExists($tableCatalogos['niveles']);
        Schema::dropIfExists($tableRelaciones['familia_familiar_user']);
        Schema::dropIfExists($tableUsers['parentescos']);
    }
}
