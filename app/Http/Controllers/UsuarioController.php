<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $profesional_documento = session('profesional_documento', '0');
        // Mostrar todos los usuarios sin filtrar por profesional_documento (solo para pruebas)
        $usuarios = DB::table('t_caracterizacion_bloque1')
        ->select(
            't_caracterizacion_bloque1.tipo_documento',
            't_caracterizacion_bloque1.numero_documento',
            't_diccionario_datos_observatorio.descripcion as tipo_documento_nombre'
        )
        ->leftJoin(
            't_diccionario_datos_observatorio',
            't_caracterizacion_bloque1.tipo_documento',
            '=',
            't_diccionario_datos_observatorio.id'
        )
        ->get();
        return view('usuarios.index', compact('usuarios'));
    }
}
