<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importa la clase DB desde el espacio de nombres correcto

class m_hojadevida extends Model
{
    use HasFactory;

    public function __construct()
    {
        parent::__construct();
    }
    public function m_leerusuariohojadevida($documento)
    {
        $resultado = DB::select('SELECT * FROM u723616956_maxiaseo.cv_informacion_basica   where cedula=' . $documento . ';         
         ');

        return $resultado;
    }

    public function m_datosBasicosParaPdf($documento)
    {
        $resultado = DB::select('
         
         SELECT
         cv.cedula,
            cv.nombre1,
             cv.nombre2,
             cv.apellido1,
             cv.apellido2,
             cv.fechanacimiento,
             cv.edad,
             b.nombre AS barrio,
             c.nombre AS ciudad,
             cv.dirCampo1,
             cv.dirCampo2,
             cv.dirCampo3,
             cv.dirCampo4,
             cv.dirCampo5,
             cv.dirCampo6,
             cv.dirCampo7,
             cv.dirCampo8,
             cv.dirCampo9,
             cv.direccion,
             cv.telefono,
             cv.correo,
             cv.fuente_reclutamiento,
             cv.fecha_creacion,
             s.nombre AS sexo,
             ec.nombre AS estado_civil,
             cv.estrato_social,
             cv.estatura,
             cv.peso,
             cv.aspiracion_salarial,
             cv.numero_hijos,
             cl.nombre AS categoria_licencia,
             ne.nombre AS nivel_escolaridad,
             tc.nombre AS talla_calzado,
             tp.nombre AS talla_pantalon,
             tcb.nombre AS talla_camisa_blusa
         FROM 
             cv_informacion_basica cv
         LEFT JOIN cv_barrio b ON cv.barrio_id = b.id
         LEFT JOIN cv_ciudad c ON cv.ciudad_id = c.id
         LEFT JOIN cv_sexo s ON cv.sexo_id = s.id
         LEFT JOIN cv_estado_civil ec ON cv.estado_civil_id = ec.id
         LEFT JOIN cv_categoria_licencia cl ON cv.categoria_licencia_id = cl.id
         LEFT JOIN cv_nivel_escolaridad ne ON cv.nivel_escolaridad_id = ne.id
         LEFT JOIN cv_talla_callzado tc ON cv.talla_callzado_id = tc.id
         LEFT JOIN cv_talla_pantalon tp ON cv.talla_pantalon_id = tp.id
         LEFT JOIN cv_talla_camisa_blusa tcb ON cv.talla_camisa_blusa_id = tcb.id
            where cv.cedula=' . $documento . ';
         
         ');

        return $resultado;
    }

    // public function m_leerbarrios()
    // {
    //     $resultado = DB::select('SELECT * FROM dbmetodologia.t_barrios;           
    //     ' );

    //     return $resultado;
    // }

    // public function m_leercomunas()
    // {
    //     $resultado = DB::select('SELECT * FROM dbmetodologia.t_comunas;           
    //     ' );

    //     return $resultado;
    // }

    // public function m_leerpaises()
    // {
    //     $resultado = DB::select('SELECT * FROM dbmetodologia.t_paises order by(pais);           
    //     ' );

    //     return $resultado;
    // }

    // public function m_leerintegrantes($folio)
    // {
    //     $resultado = DB::select('SELECT * FROM dbmetodologia.t1_integranteshogar where folio='.$folio.' order by(nombre1);           
    //     ' );

    //     return $resultado;
    // }

    // public function m_verbarrios($comuna)
    // {
    //     $resultado = DB::select('SELECT * FROM dbmetodologia.t_barrios where comuna='.$comuna.' ;           
    //     ' );

    //     return $resultado;
    // }
}
