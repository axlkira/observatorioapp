<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importa la clase DB desde el espacio de nombres correcto

class m_experiencias extends Model
{
    use HasFactory;

    public function __construct()
    {
        parent::__construct();
    }

    public function m_leerExperienciasPorId($documento)
    {
        $resultado = DB::select('SELECT * FROM u723616956_maxiaseo.cv_experiencia   where informacion_basica_id=' . $documento . ';         
         ');

        return $resultado;
    }

    public function fc_delete_experiencia($id)
    {
        $resultado = DB::select("
         DELETE FROM u723616956_maxiaseo.cv_experiencia WHERE id =" . $id
        );
    }



}