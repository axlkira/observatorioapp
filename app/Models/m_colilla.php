<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importa la clase DB desde el espacio de nombres correcto

class m_colilla extends Model
{
    use HasFactory;

    public function __construct()
    {
        parent::__construct();
    }

    public function traerDatosColilla($documento)
    {
        $resultado = DB::select("
        SELECT 
          ib.nombre1, 
          ib.nombre2, 
          ib.apellido1, 
          ib.apellido2, 
          cp.*
        FROM cv_informacion_basica ib
        JOIN colillasdepago cp
        ON ib.cedula = cp.documento
        WHERE cp.documento = ".$documento.";
         " );

        return $resultado;
    }

}