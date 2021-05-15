<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

/*
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
*/

        $tableUsers = config('ibt.table_names.users');
        $tablePersonas     = config('ibt.table_names.personas');
        $tableUbi     = config('ibt.table_names.ubicaciones');

        Schema::create($tableUsers['users'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',64)->unique();
            $table->string('email',250)->default('')->nullable();
            $table->string('password',64);
            $table->string('nombre',50)->nullable();
            $table->string('ap_paterno',50)->nullable();
            $table->string('ap_materno',50)->nullable();
            $table->string('curp',18)->default('')->nullable();
            $table->string('emails',500)->default('')->nullable();
            $table->string('celulares',250)->default('')->nullable();
            $table->string('telefonos',250)->default('')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->smallInteger('genero')->default(0)->nullable();
            $table->string('root',150)->default('')->nullable();
            $table->string('filename',50)->nullable();
            $table->string('filename_png',50)->nullable();
            $table->string('filename_thumb',50)->nullable();
            $table->boolean('admin')->default(false);
            $table->string('session_id')->nullable();
            $table->unsignedSmallInteger('status_user')->default(1)->nullable();
            $table->unsignedSmallInteger('empresa_id')->default(0)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->index('empresa_id');
            $table->boolean('logged')->default(false)->index();
            $table->timestamp('logged_at')->nullable()->index();
            $table->timestamp('logout_at')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create($tableUsers['user_adress'], function (Blueprint $table) use ($tableUsers) {
            $table->increments('id');
            $table->string('calle',250)->default('')->nullable();
            $table->string('num_ext',100)->default('')->nullable();
            $table->string('num_int',100)->default('')->nullable();
            $table->string('colonia',150)->default('')->nullable();
            $table->string('localidad',150)->default('')->nullable();
            $table->string('municipio',50)->default('')->nullable();
            $table->string('estado',50)->default('TABASCO')->nullable();
            $table->string('pais',25)->default('MÉXICO')->nullable();
            $table->string('cp',10)->default('')->nullable();
            $table->unsignedInteger('user_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableUsers['user_extend'], function (Blueprint $table) use ($tableUsers) {
            $table->increments('id');
            $table->string('ocupacion',250)->default('')->nullable();
            $table->string('profesion',250)->default('')->nullable();
            $table->string('lugar_trabajo',250)->default('')->nullable();
            $table->string('lugar_nacimiento',250)->default('')->nullable();
            $table->unsignedInteger('user_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableUsers['user_social'], function (Blueprint $table) use ($tableUsers) {
            $table->increments('id');
            $table->string('red_social',100)->default('')->nullable();
            $table->string('username_red_social',100)->default('')->nullable();
            $table->string('alias_red_social',100)->default('')->nullable();
            $table->unsignedInteger('user_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableUsers['categorias'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoria',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableUsers['adress_user'], function (Blueprint $table) use ($tableUsers){
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0)->index();
            $table->unsignedInteger('adress_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['user_id', 'adress_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

            $table->foreign('adress_id')
                ->references('id')
                ->on($tableUsers['user_adress'])
                ->onDelete('cascade');

        });

        Schema::create($tableUsers['extend_user'], function (Blueprint $table) use ($tableUsers){
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0)->index();
            $table->unsignedInteger('extend_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['user_id', 'extend_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

            $table->foreign('extend_id')
                ->references('id')
                ->on($tableUsers['user_extend'])
                ->onDelete('cascade');

        });

        Schema::create($tableUsers['social_user'], function (Blueprint $table) use ($tableUsers){
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0)->index();
            $table->unsignedInteger('social_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['user_id', 'social_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

            $table->foreign('social_id')
                ->references('id')
                ->on($tableUsers['user_social'])
                ->onDelete('cascade');

        });





        Schema::create($tableUbi['paises'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pais',250)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['pais']);
        });

        Schema::create($tableUbi['estados'], function (Blueprint $table) use ($tableUbi) {
            $table->bigIncrements('id');
            $table->string('estado',250)->nullable();
            $table->unsignedInteger('pais_id')->default(0)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['estado', 'pais_id']);

            $table->foreign('pais_id')
                ->references('id')
                ->on($tableUbi['paises'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['municipios'], function (Blueprint $table) use ($tableUbi) {
            $table->bigIncrements('id');
            $table->string('municipio',250)->nullable();
            $table->unsignedInteger('estado_id')->default(0)->nullable();
            $table->integer('numero_municipio')->default(0)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['numero_municipio','estado_id']);
            $table->unique(['municipio','estado_id','numero_municipio']);

            $table->foreign('estado_id')
                ->references('id')
                ->on($tableUbi['estados'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['ciudades'], function (Blueprint $table) use ($tableUbi) {
            $table->bigIncrements('id');
            $table->string('ciudad',250)->nullable();
            $table->unsignedInteger('municipio_id')->default(0)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['ciudad','municipio_id']);

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableUbi['municipios'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['localidades'], function (Blueprint $table) use ($tableUbi) {
            $table->bigIncrements('id');
            $table->string('codigo_postal',20)->nullable();
            $table->string('localidad',250)->nullable();
            $table->unsignedInteger('municipio_id')->default(0)->nullable();
            $table->string('tipo_asentamiento',100)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['localidad']);
            $table->index(['municipio_id']);
            $table->unique(['localidad','municipio_id','codigo_postal','tipo_asentamiento']);

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableUbi['municipios'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['calles'], function (Blueprint $table) use ($tableUbi) {
            $table->bigIncrements('id');
            $table->string('calle',250)->nullable();
            $table->unsignedInteger('localidad_id')->default(0)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['localidad_id']);
            $table->unique(['calle','localidad_id']);

            $table->foreign('localidad_id')
                ->references('id')
                ->on($tableUbi['localidades'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['codigospostales'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo_postal',20)->nullable();
            $table->string('zona_postal',20)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['codigo_postal','zona_postal']);
        });

        Schema::create($tableUbi['ubicaciones'], function (Blueprint $table) use ($tableUbi) {
            $table->bigIncrements('id');
            $table->unsignedInteger('calle_id')->default(0)->nullable();
            $table->string('calle',250)->default('')->nullable();
            $table->string('num_int',50)->default('')->nullable();
            $table->string('num_ext',50)->default('')->nullable();
            $table->unsignedInteger('colonia_id')->default(0)->nullable();
            $table->string('colonia',250)->default('')->nullable();
            $table->unsignedInteger('localidad_id')->default(0)->nullable();
            $table->string('localidad',250)->default('')->nullable();
            $table->unsignedInteger('ciudad_id')->default(0)->nullable();
            $table->string('ciudad',250)->default('')->nullable();
            $table->unsignedInteger('municipio_id')->default(0)->nullable();
            $table->string('municipio',250)->default('')->nullable();
            $table->unsignedInteger('estado_id')->default(0)->nullable();
            $table->string('estado',250)->default('')->nullable();
            $table->unsignedInteger('pais_id')->default(0)->nullable();
            $table->string('pais',250)->default('')->nullable();
            $table->string('cp',20)->default('')->nullable();
            $table->string('codigo_postal_id',10)->default('')->nullable();
            $table->float('latitud',4,10)->default(0)->nullable();
            $table->float('longitud',4,10)->default(0)->nullable();
            $table->float('altitud',4,10)->default(0)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index('calle_id');
            $table->index('colonia_id');
            $table->index('localidad_id');
            $table->index('ciudad_id');
            $table->index('municipio_id');

            $table->foreign('calle_id')
                ->references('id')
                ->on($tableUbi['calles'])
                ->onDelete('cascade');

            $table->foreign('colonia_id')
                ->references('id')
                ->on($tableUbi['localidades'])
                ->onDelete('cascade');

            $table->foreign('localidad_id')
                ->references('id')
                ->on($tableUbi['localidades'])
                ->onDelete('cascade');

            $table->foreign('ciudad_id')
                ->references('id')
                ->on($tableUbi['ciudades'])
                ->onDelete('cascade');

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableUbi['municipios'])
                ->onDelete('cascade');

            $table->foreign('estado_id')
                ->references('id')
                ->on($tableUbi['estados'])
                ->onDelete('cascade');

            $table->foreign('pais_id')
                ->references('id')
                ->on($tableUbi['paises'])
                ->onDelete('cascade');

        });

        DB::statement("ALTER DATABASE dbibt set default_text_search_config = 'spanish'");
        DB::statement("ALTER TABLE ubicaciones ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE ubicaciones SET searchtext = to_tsvector('spanish', coalesce(trim(calle),'') || ' ' || coalesce(trim(localidad),'') || ' ' || coalesce(trim(municipio),'') || ' ' || coalesce(trim(estado),'') )");
        DB::statement("CREATE INDEX searchtext_gin ON ubicaciones USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON ubicaciones FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'calle', 'localidad', 'municipio', 'estado')");

        DB::statement("ALTER TABLE municipios ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE municipios SET searchtext = to_tsvector('spanish', coalesce(trim(municipio),'') )");
        DB::statement("CREATE INDEX searchtext_municipio_gin ON municipios USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON municipios FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'municipio')");

        DB::statement("ALTER TABLE localidades ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE localidades SET searchtext = to_tsvector('spanish', coalesce(trim(localidad),'') )");
        DB::statement("CREATE INDEX searchtext_loc_gin ON localidades USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON localidades FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'localidad')");

        DB::statement("ALTER TABLE ciudades ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE ciudades SET searchtext = to_tsvector('spanish', coalesce(trim(ciudad),'') )");
        DB::statement("CREATE INDEX searchtext_cd_gin ON ciudades USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON ciudades FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'ciudad')");

        DB::statement("ALTER TABLE calles ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE calles SET searchtext = to_tsvector('spanish', coalesce(trim(calle),'') )");
        DB::statement("CREATE INDEX searchtext_calle_gin ON calles USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON calles FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'calle')");

        Schema::create($tableUbi['calle_ubicacion'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('calle_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['calle_id', 'ubicacion_id']);

            $table->foreign('calle_id')
                ->references('id')
                ->on($tableUbi['calles'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableUbi['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['colonia_ubicacion'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('colonia_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['colonia_id', 'ubicacion_id']);

            $table->foreign('colonia_id')
                ->references('id')
                ->on($tableUbi['localidades'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableUbi['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['localidad_ubicacion'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('localidad_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['localidad_id', 'ubicacion_id']);

            $table->foreign('localidad_id')
                ->references('id')
                ->on($tableUbi['localidades'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableUbi['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['ciudad_ubicacion'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('ciudad_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['ciudad_id', 'ubicacion_id']);

            $table->foreign('ciudad_id')
                ->references('id')
                ->on($tableUbi['ciudades'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableUbi['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['municipio_ubicacion'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('municipio_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['municipio_id', 'ubicacion_id']);

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableUbi['municipios'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableUbi['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['estado_ubicacion'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('estado_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['estado_id', 'ubicacion_id']);

            $table->foreign('estado_id')
                ->references('id')
                ->on($tableUbi['estados'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableUbi['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['pais_ubicacion'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('pais_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['pais_id', 'ubicacion_id']);

            $table->foreign('pais_id')
                ->references('id')
                ->on($tableUbi['paises'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableUbi['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['calle_localidad'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('calle_id')->default(0)->index();
            $table->unsignedInteger('localidad_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['calle_id', 'localidad_id']);

            $table->foreign('calle_id')
                ->references('id')
                ->on($tableUbi['calles'])
                ->onDelete('cascade');

            $table->foreign('localidad_id')
                ->references('id')
                ->on($tableUbi['localidades'])
                ->onDelete('cascade');
        });

        Schema::create($tableUbi['localidad_municipio'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('localidad_id')->default(0)->index();
            $table->unsignedInteger('municipio_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['localidad_id', 'municipio_id']);

            $table->foreign('localidad_id')
                ->references('id')
                ->on($tableUbi['localidades'])
                ->onDelete('cascade');

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableUbi['municipios'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['ciudad_municipio'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('ciudad_id')->default(0)->index();
            $table->unsignedInteger('municipio_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['ciudad_id', 'municipio_id']);

            $table->foreign('ciudad_id')
                ->references('id')
                ->on($tableUbi['ciudades'])
                ->onDelete('cascade');

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableUbi['municipios'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['estado_municipio'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('estado_id')->default(0)->index();
            $table->unsignedInteger('municipio_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['estado_id', 'municipio_id']);

            $table->foreign('estado_id')
                ->references('id')
                ->on($tableUbi['estados'])
                ->onDelete('cascade');

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableUbi['municipios'])
                ->onDelete('cascade');

        });

        Schema::create($tableUbi['estado_pais'], function (Blueprint $table) use ($tableUbi){
            $table->increments('id');
            $table->unsignedInteger('estado_id')->default(0)->index();
            $table->unsignedInteger('pais_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['estado_id', 'pais_id']);

            $table->foreign('estado_id')
                ->references('id')
                ->on($tableUbi['estados'])
                ->onDelete('cascade');

            $table->foreign('pais_id')
                ->references('id')
                ->on($tableUbi['paises'])
                ->onDelete('cascade');

        });





        Schema::create($tablePersonas['personas'], function (Blueprint $table)  use ($tableUbi) {
            $table->bigIncrements('id');
            $table->string('nombre',50)->nullable();
            $table->string('ap_paterno',50)->nullable();
            $table->string('ap_materno',50)->nullable();
            $table->string('curp',18)->default('')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->smallInteger('genero')->default(0)->nullable();
            $table->string('telefonos',250)->nullable();
            $table->string('celulares',250)->nullable();
            $table->string('emails',250)->nullable();
            $table->integer('estado_nacimiento_id')->default(0)->nullable();;
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->unsignedSmallInteger('status_persona')->default(1)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->index('ap_paterno');
            $table->index('ap_materno');
            $table->index('nombre');
            $table->index(['ap_paterno','ap_materno','nombre']);
            $table->index('curp');
            $table->index('estado_nacimiento_id');
            $table->index(['creado_por_id']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('estado_nacimiento_id')
                ->references('id')
                ->on($tableUbi['estados'])
                ->onDelete('cascade');


        });

        DB::statement("ALTER TABLE personas ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE personas SET searchtext = to_tsvector('spanish', coalesce(trim(ap_paterno),'') || ' ' || coalesce(trim(ap_materno),'') || ' ' || coalesce(trim(nombre),'') || ' ' || coalesce(trim(curp),'') )");
        DB::statement("CREATE INDEX searchtext_persona_gin ON personas USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON personas FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'ap_paterno', 'ap_materno', 'nombre', 'curp')");

        Schema::create($tablePersonas['imagenes'], function (Blueprint $table)  use ($tableUsers, $tablePersonas) {
            $table->bigIncrements('id');
            $table->string('root',250)->nullable();
            $table->string('filename',250)->nullable();
            $table->string('filename_png',250)->nullable();
            $table->string('filename_thumb',250)->default('')->nullable();
            $table->string('pie_de_foto',250)->default('')->nullable();
            $table->unsignedInteger('persona_id')->default(0)->nullable();
            $table->unsignedInteger('creado_por_id')->default(0)->nullable();
            $table->unsignedSmallInteger('status_imagen')->default(1)->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['persona_id']);
            $table->index(['creado_por_id']);

            $table->foreign('persona_id')
                ->references('id')
                ->on($tablePersonas['personas'])
                ->onDelete('cascade');

            $table->foreign('creado_por_id')
                ->references('id')
                ->on($tableUsers['users'])
                ->onDelete('cascade');

        });


        Schema::create($tablePersonas['imagen_persona'], function (Blueprint $table) use ($tablePersonas){
            $table->increments('id');
            $table->unsignedInteger('imagen_id')->default(0)->index();
            $table->unsignedInteger('persona_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['imagen_id', 'persona_id']);

            $table->foreign('imagen_id')
                ->references('id')
                ->on($tablePersonas['imagenes'])
                ->onDelete('cascade');

            $table->foreign('persona_id')
                ->references('id')
                ->on($tablePersonas['personas'])
                ->onDelete('cascade');

        });

        Schema::create($tablePersonas['pariente_persona'], function (Blueprint $table) use ($tablePersonas){
            $table->increments('id');
            $table->unsignedInteger('persona_id')->default(0)->index();
            $table->string('parentesco_lineal')->default('')->index();
            $table->string('parentesco_inverso')->default('')->index();
            $table->unsignedInteger('pariente_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['persona_id', 'parentesco_lineal', 'parentesco_inverso', 'pariente_id']);

            $table->foreign('persona_id')
                ->references('id')
                ->on($tablePersonas['personas'])
                ->onDelete('cascade');

            $table->foreign('pariente_id')
                ->references('id')
                ->on($tablePersonas['personas'])
                ->onDelete('cascade');

        });

        Schema::create($tablePersonas['persona_ubicacion'], function (Blueprint $table) use ($tablePersonas, $tableUbi){
            $table->increments('id');
            $table->unsignedInteger('persona_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['persona_id', 'ubicacion_id']);

            $table->foreign('persona_id')
                ->references('id')
                ->on($tablePersonas['personas'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableUbi['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tablePersonas['parentescos'], function (Blueprint $table) use ($tablePersonas) {
            $table->bigIncrements('id');
            $table->string('parentesco_masculino',25)->default('')->nullable();
            $table->string('parentesco_femenino',25)->default('')->nullable();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['parentesco_masculino','parentesco_femenino']);

        });









    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        $tableUsers = config('ibt.table_names.users');
        Schema::dropIfExists($tableUsers['adress_user']);
        Schema::dropIfExists($tableUsers['extend_user']);
        Schema::dropIfExists($tableUsers['social_user']);
        Schema::dropIfExists($tableUsers['categorias']);
        Schema::dropIfExists($tableUsers['user_adress']);
        Schema::dropIfExists($tableUsers['user_extend']);
        Schema::dropIfExists($tableUsers['user_social']);


        $tableUbi = config('ibt.table_names.ubicaciones');
        Schema::dropIfExists($tableUbi['domicilios']);
        Schema::dropIfExists($tableUbi['calle_localidad']);
        Schema::dropIfExists($tableUbi['localidad_municipio']);
        Schema::dropIfExists($tableUbi['ciudad_municipio']);
        Schema::dropIfExists($tableUbi['estado_municipio']);
        Schema::dropIfExists($tableUbi['estado_pais']);
        Schema::dropIfExists($tableUbi['calle_ubicacion']);
        Schema::dropIfExists($tableUbi['colonia_ubicacion']);
        Schema::dropIfExists($tableUbi['comunidad_ubicacion']);
        Schema::dropIfExists($tableUbi['localidad_ubicacion']);
        Schema::dropIfExists($tableUbi['ciudad_ubicacion']);
        Schema::dropIfExists($tableUbi['municipio_ubicacion']);
        Schema::dropIfExists($tableUbi['estado_ubicacion']);
        Schema::dropIfExists($tableUbi['pais_ubicacion']);
        Schema::dropIfExists($tableUbi['persona_ubicacion']);
        Schema::dropIfExists($tableUbi['ubicaciones']);
        Schema::dropIfExists($tableUbi['calles']);
        Schema::dropIfExists($tableUbi['localidades']);
        Schema::dropIfExists($tableUbi['ciudades']);
        Schema::dropIfExists($tableUbi['municipios']);
        Schema::dropIfExists($tableUbi['codigospostales']);



        $tableNames = config('ibt.table_names.personas');
        Schema::dropIfExists($tableNames['imagen_persona']);
        Schema::dropIfExists($tableNames['pariente_persona']);
        Schema::dropIfExists($tableNames['imagenes']);
        Schema::dropIfExists($tableNames['personas']);
        Schema::dropIfExists($tableNames['parentescos']);

        Schema::dropIfExists($tableUbi['estados']);
        Schema::dropIfExists($tableUbi['paises']);
        Schema::dropIfExists($tableUsers['users']);


    }
}
