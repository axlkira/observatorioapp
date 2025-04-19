<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importa la clase DB desde el espacio de nombres correcto

class m_persona extends Model
{
    use HasFactory;

    public function __construct()
    {
        parent::__construct();
    }

    public function traerPorId_y_Categoria($documento, $categoria_persona)
    {
        $resultado = DB::select("

         SELECT * FROM u723616956_maxiaseo.cv_personas  where informacion_basica_id=".$documento." and categoria_id = (
             select id from cv_persona_categoria Where nombre = '".$categoria_persona."' );        
         " );

        return $resultado;
    }

    public function traerTodasLasPersonasPorDocumento($documento)
    {
        $resultado = DB::select("

         SELECT * FROM u723616956_maxiaseo.cv_personas  where informacion_basica_id=".$documento." ;        
         " );

        return $resultado;
    }

    public function crear_persona($cedula, $data)
    {
        DB::table('cv_personas')->updateOrInsert(
            ['cedula' => $cedula], 
            $data 
        );
        
    }
    public function delete_persona($cedula)
    {

        $resultado = DB::select("
         DELETE FROM u723616956_maxiaseo.cv_personas WHERE CEDULA =".$cedula       
          );
        
    }

}