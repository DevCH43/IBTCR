<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableUsers = config('ibt.table_names.users');
        $tablePersonas     = config('ibt.table_names.personas');
        $tableUbi     = config('ibt.table_names.ubicaciones');

        Schema::create('alumnos', function (Blueprint $table) use ($tableUsers) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('matricula',50)->default('')->nullable();
            $table->smallInteger('num_lista',)->default(0)->nullable();
            $table->date('fecha_ingreso',)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on($tableUsers['users'])
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
        Schema::dropIfExists('alumnos');
    }
}
