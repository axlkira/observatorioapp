<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    // Mostrar formulario de bloque dinámico
    public function show($block, Request $request)
    {
        $view = "forms.bloque_{$block}";
        if (!view()->exists($view)) {
            abort(404, 'Formulario no encontrado');
        }
        // Obtener datos previos si existen
        $registro = null;
        $tipo_documento = $request->input('tipo_documento');
        $numero_documento = $request->input('numero_documento');
        if ($tipo_documento && $numero_documento) {
            $registro = \DB::table("t_caracterizacion_bloque1")
                ->where('tipo_documento', $tipo_documento)
                ->where('numero_documento', $numero_documento)
                ->first();
        }
        return view($view, [
            'block' => $block,
            'registro' => $registro,
            'tipo_documento' => $tipo_documento,
            'numero_documento' => $numero_documento
        ]);
    }

    // Guardar datos del bloque dinámico
    public function store(Request $request)
    {
        $block = $request->input('block');
        $table = "t_caracterizacion_bloque1";
        $data = $request->except(['_token', 'block']);

        // --- Normalizar campos de selección múltiple a 1 o 0 (según checkboxes) ---
        // Orientación sexual
        $orientaciones = [
            'orientacion_lesbiana', 'orientacion_gay', 'orientacion_bisexual', 'orientacion_pansexual',
            'orientacion_asexual', 'orientacion_otra', 'orientacion_prefiere_no_responder', 'orientacion_no_aplica'
        ];
        foreach ($orientaciones as $campo) {
            $data[$campo] = $request->has($campo) ? 1 : 0;
        }
        // Grupos etarios
        $grupos = [
            'grupo_primera_infancia', 'grupo_jovenes', 'grupo_adultos', 'grupo_adultos_mayores'
        ];
        foreach ($grupos as $campo) {
            $data[$campo] = $request->has($campo) ? 1 : 0;
        }
        // Hechos victimizantes
        $hechos = [
            'hecho_homicidio', 'hecho_desaparicion', 'hecho_confinamiento', 'hecho_desplazamiento',
            'hecho_tortura', 'hecho_amenaza', 'hecho_otro'
        ];
        foreach ($hechos as $campo) {
            $data[$campo] = $request->has($campo) ? 1 : 0;
        }

        // Forzar coherencia: si "No aplica" está desmarcado en la 6, su valor debe ser 0
        if (!$request->has('hecho_no_aplica')) {
            $data['hecho_no_aplica'] = 0;
        }
        // Forzar coherencia: si "No aplica" está desmarcado en la 4, su valor debe ser 0
        if (!$request->has('orientacion_no_aplica')) {
            $data['orientacion_no_aplica'] = 0;
        }

        // Limpiar campos 'cual' SOLO si se selecciona No Aplica en la misma pregunta
        if (!$request->has('orientacion_otra') && $request->has('orientacion_no_aplica')) {
            $data['orientacion_otra_cual'] = null;
        }
        if (!$request->has('hecho_otro') && $request->has('hecho_no_aplica')) {
            $data['hecho_otro_cual'] = null;
        }

        // Validar que si se marca "otra" en pregunta 4 o 6, el campo "cual" es obligatorio
        $validator = Validator::make($data, [
            'tipo_documento' => 'required',
            'numero_documento' => 'required',
            'profesional_documento' => 'required',
            'orientacion_otra_cual' => ($request->has('orientacion_otra') && !$request->has('orientacion_no_aplica')) ? 'required' : 'nullable',
            'hecho_otro_cual' => ($request->has('hecho_otro') && !$request->has('hecho_no_aplica')) ? 'required' : 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Separar llaves primarias
        $keys = [
            'tipo_documento' => $data['tipo_documento'],
            'numero_documento' => $data['numero_documento'],
        ];

        // Verificar si ya existe el registro
        $exists = DB::table($table)
            ->where($keys)
            ->exists();
        if ($exists) {
            // Si ya existe, actualiza el registro
            $now = now();
            $data['updated_at'] = $now;
            DB::table($table)
                ->where($keys)
                ->update($data);
            return redirect()->route('form.show', ['block' => $block, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Formulario actualizado exitosamente.');
        }

        // Insertar el registro si no existe
        $now = now();
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        DB::table($table)->insert($data);

        // Redirigir a la URL con llaves primarias
        return redirect()->route('form.show', ['block' => $block, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
            ->with('success', 'Formulario guardado exitosamente.');
    }

    // Mostrar información guardada
    public function showData($block, Request $request)
    {
        $table = "t_caracterizacion_bloque1";
        $tipo_documento = $request->input('tipo_documento');
        $numero_documento = $request->input('numero_documento');
        $registro = DB::table($table)
            ->where('tipo_documento', $tipo_documento)
            ->where('numero_documento', $numero_documento)
            ->first();
        if (!$registro) {
            return back()->with('error', 'No se encontró información para este registro.');
        }
        return view("forms.bloque_{$block}_show", compact('registro'));
    }
}
