<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importa la clase DB desde el espacio de nombres correcto

class m_selects extends Model
{
    use HasFactory;

    public function __construct()
    {
        parent::__construct();
    }

    public function traerTodosLosSexos()
    {
        $resultado = DB::select("

         SELECT * FROM cv_sexo;        
         ");

        return $resultado;
    }

    public function traerTodosLasCiudades ()
    {
        $resultado = DB::select("

         SELECT * FROM cv_ciudad;        
         ");

        return $resultado;
    }
    public function traerTodosLosEstadosCivil()
    {
        $resultado = DB::select("

         SELECT * FROM cv_estado_civil;        
         ");

        return $resultado;
    }
    public function traerTodosLosNivelesDeEscolaridad()
    {
        $resultado = DB::select("

         SELECT * FROM cv_nivel_escolaridad;        
         ");

        return $resultado;
    }
    public function traerTodosLasTallasDeCalzado()
    {
        $resultado = DB::select("

         SELECT * FROM cv_talla_callzado;        
         ");

        return $resultado;
    }

    public function traerTodosLasTallasCamisaBlusa()
    {
        $resultado = DB::select("

         SELECT * FROM cv_talla_camisa_blusa;        
         ");

        return $resultado;
    }

    public function traerTodosLasTallasDePantalon()
    {
        $resultado = DB::select("

         SELECT * FROM cv_talla_pantalon;        
         ");

        return $resultado;
    }

    function mostrarselect($tabla) {

        $data = DB::select('SELECT * FROM '.$tabla );

        $resultado = '<option value=""> SELECCIONE </option>';

        foreach($data as $opcione) {
            $resultado.= '<option value="'.$opcione -> id. '"> '.$opcione -> nombre. ' </option>';
        }

        return $resultado;
    }


}