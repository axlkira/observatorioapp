<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class FormController extends Controller
{
    // Mostrar formulario de bloque dinámico
    public function show($block, $tipo_documento, $numero_documento)
    {
        $view = "forms.bloque_{$block}";
        if (!view()->exists($view)) {
            abort(404, 'Formulario no encontrado');
        }
        // Obtener datos previos si existen
        $registro = null;
        if ($block == 1) {
            $table = 't_caracterizacion_bloque1';
        } elseif ($block == 2) {
            $table = 't_vida_digna_bloque2';
        } elseif ($block == 3) {
            $table = 't_trabajo_digno_bloque3';
        } elseif ($block == 4) {
            $table = 't_salud_bloque4';
        } else {
            abort(404, 'Bloque no soportado aún');
        }
        $registro = DB::table($table)
            ->where('tipo_documento', $tipo_documento)
            ->where('numero_documento', $numero_documento)
            ->first();
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
        // Determinar tabla dinámica según bloque
        $block = $request->input('block');
        if ($block == 1) {
            $table = 't_caracterizacion_bloque1';
        } elseif ($block == 2) {
            $table = 't_vida_digna_bloque2';
        } elseif ($block == 3) {
            $table = 't_trabajo_digno_bloque3';
        } elseif ($block == 4) {
            $table = 't_salud_bloque4';
        } else {
            abort(404, 'Bloque no soportado aún');
        }
        $data = $request->except(['_token', 'block', 'es_actualizacion']);
        // Normalización dinámica de campos de selección múltiple para bloque 2
        if ($block == 2) {
            $multichecks = [
                // Pregunta 15
                'violencia_sexual', 'violencia_genero', 'violencia_psicologica', 'violencia_fisica', 'violencia_economica', 'violencia_ninguna',
                // Pregunta 17
                'discriminacion_sexo', 'discriminacion_genero', 'discriminacion_etnia', 'discriminacion_nacionalidad', 'discriminacion_estrato', 'discriminacion_edad', 'discriminacion_religion', 'discriminacion_discapacidad', 'discriminacion_otros', 'discriminacion_no_hemos',
                // Pregunta 19
                'institucion_cavif', 'institucion_ips_eps', 'institucion_fiscalia', 'institucion_linea_155', 'institucion_comisaria', 'institucion_inspeccion', 'institucion_icbf', 'institucion_caivas', 'institucion_personeria', 'institucion_centros_integrales', 'institucion_no_hemos_asistido',
            ];
            foreach ($multichecks as $field) {
                $data[$field] = $request->has($field) ? 1 : 2;
            }
        }
        // Normalización dinámica de bloque 3 (todo select, no switches)
        if ($block == 3) {
            // Todos los campos ya vienen del select, solo aseguramos que existan
            $fields = [
                'fuente_ingreso', 'ingreso_fijo', 'equilibrio_vida_laboral', 'interfiere_cuidado', 'trabajos_domesticos_impiden', 'medio_obtencion_alimentos', 'patrimonio'
            ];
            foreach ($fields as $field) {
                $data[$field] = $request->input($field, null);
            }
        } elseif ($block == 4) {
            $fields = [
                'sistema_salud',
                'enfermedad_mental',
                'acceso_espacios_recreativos',
            ];
            foreach ($fields as $field) {
                $data[$field] = $request->input($field, null);
            }
        } else {
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
        }
        // Filtrar SOLO los campos que existen en la tabla
        $columns = Schema::getColumnListing($table);
        $data = array_intersect_key($data, array_flip($columns));

        // Separar llaves primarias
        $keys = [
            'tipo_documento' => $data['tipo_documento'],
            'numero_documento' => $data['numero_documento'],
        ];

        // Verificar si ya existe el registro (solo para inserción)
        $exists = DB::table($table)
            ->where($keys)
            ->exists();
        if ($exists && !$request->has('es_actualizacion')) {
            // Si ya existe y es un intento de inserción, mostrar error
            return back()->withErrors(['usuario_existente' => 'Este usuario ya existe, solo puedes ingresar usuarios nuevos.'])->withInput();
        }

        $now = now();
        if ($exists) {
            $data['updated_at'] = $now;
            DB::table($table)
                ->where($keys)
                ->update($data);
            // Redirección solo si es NUEVO (no actualización)
            if ($block == 1 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 2, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 1 guardado exitosamente. Continúa con el Bloque 2.');
            }
            if ($block == 2 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 3, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 2 guardado exitosamente. Continúa con el Bloque 3.');
            }
            if ($block == 3 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 4, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 3 guardado exitosamente. Continúa con el Bloque 4.');
            }
            return redirect()->route('form.show', ['block' => $block, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Formulario actualizado exitosamente.');
        }
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        DB::table($table)->insert($data);
        // Redirección solo si es NUEVO (no actualización)
        if ($block == 1 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 2, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 1 guardado exitosamente. Continúa con el Bloque 2.');
        }
        if ($block == 2 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 3, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 2 guardado exitosamente. Continúa con el Bloque 3.');
        }
        if ($block == 3 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 4, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 3 guardado exitosamente. Continúa con el Bloque 4.');
        }
        // Redirigir a la URL con llaves primarias
        return redirect()->route('form.show', ['block' => $block, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
            ->with('success', 'Formulario guardado exitosamente.');
    }

    // Mostrar información guardada
    public function showData($block, Request $request)
    {
        if ($block == 1) {
            $table = 't_caracterizacion_bloque1';
        } elseif ($block == 2) {
            $table = 't_vida_digna_bloque2';
        } elseif ($block == 3) {
            $table = 't_trabajo_digno_bloque3';
        } elseif ($block == 4) {
            $table = 't_salud_bloque4';
        } else {
            abort(404, 'Bloque no soportado aún');
        }
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
