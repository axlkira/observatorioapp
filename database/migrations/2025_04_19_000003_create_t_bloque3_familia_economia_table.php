<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_bloque3_familia_economia', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 50);
            $table->string('numero_documento', 50);
            $table->unsignedTinyInteger('fuente_ingreso_formal')->nullable(); // 1=Sí, 2=No
            $table->unsignedTinyInteger('fuente_ingreso_informal')->nullable();
            $table->unsignedTinyInteger('fuente_ingreso_independiente')->nullable();
            $table->unsignedTinyInteger('fuente_ingreso_apoyo')->nullable();
            $table->unsignedTinyInteger('fuente_ingreso_pension')->nullable();
            $table->unsignedTinyInteger('fuente_ingreso_subsidio')->nullable();
            $table->unsignedTinyInteger('fuente_ingreso_ninguna')->nullable();
            $table->unsignedTinyInteger('personas_ingreso_1')->nullable();
            $table->unsignedTinyInteger('personas_ingreso_2')->nullable();
            $table->unsignedTinyInteger('personas_ingreso_3')->nullable();
            $table->unsignedTinyInteger('personas_ingreso_4')->nullable();
            $table->unsignedTinyInteger('equilibrio_vida')->nullable(); // 1=Sí, 2=No, 0=No aplica
            $table->unsignedTinyInteger('trabajo_interfiere')->nullable();
            $table->unsignedTinyInteger('trabajo_cuidado_totalmente_acuerdo')->nullable();
            $table->unsignedTinyInteger('trabajo_cuidado_acuerdo')->nullable();
            $table->unsignedTinyInteger('trabajo_cuidado_neutro')->nullable();
            $table->unsignedTinyInteger('trabajo_cuidado_desacuerdo')->nullable();
            $table->unsignedTinyInteger('trabajo_cuidado_totalmente_desacuerdo')->nullable();
            $table->unsignedTinyInteger('medio_alimentos_almacenes')->nullable();
            $table->unsignedTinyInteger('medio_alimentos_bonos_gob')->nullable();
            $table->unsignedTinyInteger('medio_alimentos_bonos_empresa')->nullable();
            $table->unsignedTinyInteger('medio_alimentos_cultivos')->nullable();
            $table->unsignedTinyInteger('medio_alimentos_redes')->nullable();
            $table->unsignedTinyInteger('patrimonio_si')->nullable();
            $table->unsignedTinyInteger('patrimonio_no')->nullable();
            $table->unsignedTinyInteger('patrimonio_no_sabe')->nullable();
            $table->timestamps();
            $table->unique(['tipo_documento', 'numero_documento']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('t_bloque3_familia_economia');
    }
};
