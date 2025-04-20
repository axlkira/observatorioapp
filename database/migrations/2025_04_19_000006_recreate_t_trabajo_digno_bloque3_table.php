<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('t_trabajo_digno_bloque3');
        Schema::create('t_trabajo_digno_bloque3', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 50);
            $table->string('numero_documento', 50);
            $table->unsignedTinyInteger('fuente_ingreso'); // 118-124
            $table->unsignedTinyInteger('personas_ingreso'); // 125-128
            $table->unsignedTinyInteger('equilibrio_vida'); // 1,2,0
            $table->unsignedTinyInteger('trabajo_interfiere'); // 1,2,44
            $table->unsignedTinyInteger('trabajo_cuidado'); // 129-133
            $table->unsignedTinyInteger('medio_alimentos'); // 134-138
            $table->unsignedTinyInteger('patrimonio'); // 1,2,44
            $table->unsignedTinyInteger('estado')->default(0);
            $table->timestamps();
            $table->unique(['tipo_documento', 'numero_documento']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('t_trabajo_digno_bloque3');
    }
};
