<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('t_trabajo_digno_bloque3', function (Blueprint $table) {
            $table->unsignedTinyInteger('estado')->default(0);
        });
    }
    public function down()
    {
        Schema::table('t_trabajo_digno_bloque3', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
