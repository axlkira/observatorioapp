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
        } elseif ($block == 5) {
            $table = 't_proteccion_bloque5';
        } elseif ($block == 6) {
            $table = 't_respeto_bloque6';
        } elseif ($block == 7) {
            $table = 't_participacion_bloque7';
        } elseif ($block == 8) {
            $table = 't_representacion_bloque8';
        } elseif ($block == 9) {
            $table = 't_derechos_bloque9';
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
        } elseif ($block == 5) {
            $table = 't_proteccion_bloque5';
        } elseif ($block == 6) {
            $table = 't_respeto_bloque6';
        } elseif ($block == 7) {
            $table = 't_participacion_bloque7';
        } elseif ($block == 8) {
            $table = 't_representacion_bloque8';
        } elseif ($block == 9) {
            $table = 't_derechos_bloque9';
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
                $data[$field] = $request->has($field) ? 1 : 0;
            }
            // --- Lógica profesional_documento ---
            if (empty($data['profesional_documento']) || $data['profesional_documento'] === null) {
                $data['profesional_documento'] = session('profesional_documento', '0');
                if (empty($data['profesional_documento'])) {
                    $data['profesional_documento'] = '0';
                }
            }
        }
        // Normalización dinámica de bloque 3 (todo select, no switches)
        if ($block == 3) {
            // Pregunta 20: múltiples fuentes de ingreso
            $fields = [
                'fuente_empleo_formal',
                'fuente_empleo_informal',
                'fuente_independiente',
                'fuente_apoyo_familia_amigos',
                'fuente_pension',
                'fuente_subsidios_gobierno',
                'fuente_ninguna',
                'ingreso_fijo',
                'equilibrio_vida_laboral',
                'interfiere_cuidado',
                'trabajos_domesticos_impiden',
                'medio_obtencion_alimentos',
                'patrimonio',
                'tiempo_patrimonio_crisis'
            ];
            foreach ($fields as $field) {
                // Para los switches (checkbox): 1=Sí, 0=No
                if (in_array($field, [
                    'fuente_empleo_formal', 'fuente_empleo_informal', 'fuente_independiente',
                    'fuente_apoyo_familia_amigos', 'fuente_pension', 'fuente_subsidios_gobierno', 'fuente_ninguna'])) {
                    $data[$field] = $request->has($field) ? 1 : 0;
                } else {
                    $data[$field] = $request->input($field, null);
                }
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
        } elseif ($block == 5) {
            // Bloque 5: Protección
            $data['p30_vivienda'] = $request->input('p30_vivienda');
            $data['p30_vivienda_otro'] = ($request->input('p30_vivienda') == '152') ? $request->input('p30_vivienda_otro') : null;
            $data['p31_migracion'] = $request->input('p31_migracion');
            // Red de apoyo múltiple: switches individuales
            $data['red_apoyo_estado'] = $request->has('red_apoyo_estado') ? 1 : 0;
            $data['red_apoyo_organizaciones_internacionales'] = $request->has('red_apoyo_organizaciones_internacionales') ? 1 : 0;
            $data['red_apoyo_organizaciones_no_gubernamentales'] = $request->has('red_apoyo_organizaciones_no_gubernamentales') ? 1 : 0;
            $data['red_apoyo_iglesia'] = $request->has('red_apoyo_iglesia') ? 1 : 0;
            $data['red_apoyo_amigos'] = $request->has('red_apoyo_amigos') ? 1 : 0;
            $data['red_apoyo_vecinos'] = $request->has('red_apoyo_vecinos') ? 1 : 0;
            $data['red_apoyo_otros_familiares'] = $request->has('red_apoyo_otros_familiares') ? 1 : 0;
            $data['red_apoyo_otros'] = $request->has('red_apoyo_otros') ? 1 : 0;
            $data['red_apoyo_no_hemos_tenido'] = $request->has('red_apoyo_no_hemos_tenido') ? 1 : 0;
            $data['red_apoyo_no_aplica'] = $request->has('red_apoyo_no_aplica') ? 1 : 0;
            $fields = [
                'p30_vivienda',
                'p30_vivienda_otro',
                'p31_migracion',
                'entorno_seguro',
                'estado',
                'red_apoyo_estado',
                'red_apoyo_organizaciones_internacionales',
                'red_apoyo_organizaciones_no_gubernamentales',
                'red_apoyo_iglesia',
                'red_apoyo_amigos',
                'red_apoyo_vecinos',
                'red_apoyo_otros_familiares',
                'red_apoyo_otros',
                'red_apoyo_no_hemos_tenido',
                'red_apoyo_no_aplica',
                'profesional_documento'
            ];
            foreach ($fields as $field) {
                if (strpos($field, 'red_apoyo_') === 0) {
                    $data[$field] = $request->input($field, 0);
                } elseif ($field === 'estado') {
                    $data[$field] = $request->input($field, 0);
                } else {
                    $data[$field] = $request->input($field, null);
                }
            }
        } elseif ($block == 6) {
            // Bloque 6: Respeto y Comunicación Familiar
            $data['p33_acceso_metodos_anticonceptivos'] = $request->input('p33_acceso_metodos_anticonceptivos');
            // Pregunta 34: opción múltiple (cada campo 1/0)
            $data['p34_ninos_adolescentes_adultos'] = $request->has('p34_ninos_adolescentes_adultos') ? 1 : 0;
            $data['p34_ninos_adolescentes_adultos_mayores'] = $request->has('p34_ninos_adolescentes_adultos_mayores') ? 1 : 0;
            $data['p34_jovenes_adultos'] = $request->has('p34_jovenes_adultos') ? 1 : 0;
            $data['p34_jovenes_adultos_mayores'] = $request->has('p34_jovenes_adultos_mayores') ? 1 : 0;
            $data['p34_adultos_adultos_mayores'] = $request->has('p34_adultos_adultos_mayores') ? 1 : 0;
            $data['p34_nunca'] = $request->has('p34_nunca') ? 1 : 0;
            $data['p34_no_sabe'] = $request->has('p34_no_sabe') ? 1 : 0;
            $data['p34_no_aplica'] = $request->has('p34_no_aplica') ? 1 : 0;
            // Únicas respuesta
            $data['p35_orientacion_asesoria'] = $request->input('p35_orientacion_asesoria');
            $data['p36_calidad_comunicacion'] = $request->input('p36_calidad_comunicacion');
            $data['p37_medio_comunicacion'] = $request->input('p37_medio_comunicacion');
            $data['p38_impacto_tecnologia'] = $request->input('p38_impacto_tecnologia');
            $data['p39_frecuencia_comidas'] = $request->input('p39_frecuencia_comidas');
        } elseif ($block == 7) {
            // Bloque 7: Participación
            $data['p40_igualdad_oportunidades'] = $request->input('p40_igualdad_oportunidades');
            $data['p41_valoracion_posturas'] = $request->input('p41_valoracion_posturas');
            $data['p42_trabajos_cuidado'] = $request->input('p42_trabajos_cuidado');
            // Pregunta 43: opción múltiple (cada campo 1/0)
            $data['p43_subsidios_economicos'] = $request->has('p43_subsidios_economicos') ? 1 : 0;
            $data['p43_acceso_centros_cuidado'] = $request->has('p43_acceso_centros_cuidado') ? 1 : 0;
            $data['p43_atencion_medica'] = $request->has('p43_atencion_medica') ? 1 : 0;
            $data['p43_capacitacion_cuidadores'] = $request->has('p43_capacitacion_cuidadores') ? 1 : 0;
            $data['p43_paquetes_alimentarios'] = $request->has('p43_paquetes_alimentarios') ? 1 : 0;
            $data['p43_redes_apoyo_cuidadores'] = $request->has('p43_redes_apoyo_cuidadores') ? 1 : 0;
            $data['p43_incentivos_economicos'] = $request->has('p43_incentivos_economicos') ? 1 : 0;
            $data['p43_otros'] = $request->has('p43_otros') ? 1 : 0;
            $data['p43_ninguno'] = $request->has('p43_ninguno') ? 1 : 0;
            $data['p43_no_aplica'] = $request->has('p43_no_aplica') ? 1 : 0;
            // Exclusividad lógica: si "Ninguno" o "No aplica" está chequeado, los demás deben ser 0
            if ($data['p43_ninguno'] == 1 || $data['p43_no_aplica'] == 1) {
                foreach ([
                    'p43_subsidios_economicos', 'p43_acceso_centros_cuidado', 'p43_atencion_medica',
                    'p43_capacitacion_cuidadores', 'p43_paquetes_alimentarios', 'p43_redes_apoyo_cuidadores', 'p43_incentivos_economicos', 'p43_otros'
                ] as $campo) {
                    $data[$campo] = 0;
                }
            } else {
                // Si alguno de los otros está chequeado, "Ninguno" y "No aplica" deben ser 0
                if (
                    $data['p43_subsidios_economicos'] == 1 || $data['p43_acceso_centros_cuidado'] == 1 ||
                    $data['p43_atencion_medica'] == 1 || $data['p43_capacitacion_cuidadores'] == 1 ||
                    $data['p43_paquetes_alimentarios'] == 1 || $data['p43_redes_apoyo_cuidadores'] == 1 ||
                    $data['p43_incentivos_economicos'] == 1 || $data['p43_otros'] == 1
                ) {
                    $data['p43_ninguno'] = 0;
                    $data['p43_no_aplica'] = 0;
                }
            }
        } elseif ($block == 8) {
            // Bloque 8: Representación
            $data['p44_participacion_decisiones'] = $request->input('p44_participacion_decisiones');
            $data['p45_jefatura_familia'] = $request->input('p45_jefatura_familia');
        } elseif ($block == 9) {
            // Bloque 9: Derechos (opción múltiple, máximo 5)
            $campos = [
                'p46_vida_libre_violencia',
                'p46_participacion_representacion',
                'p46_trabajo_digno',
                'p46_salud_seguridad',
                'p46_educacion_igualdad',
                'p46_recreacion_cultura',
                'p46_honra_dignidad',
                'p46_igualdad',
                'p46_armonia_unidad',
                'p46_proteccion_asistencia',
                'p46_entornos_seguros',
                'p46_decidir_hijos',
                'p46_orientacion_asesoria',
                'p46_respetar_formacion_hijos',
                'p46_respeto_reciproco',
                'p46_proteccion_patrimonio',
                'p46_alimentacion_necesidades',
                'p46_bienestar',
                'p46_apoyo_estado_mayores',
                'p46_ninguno_anteriores',
            ];
            $seleccionados = 0;
            foreach ($campos as $campo) {
                if ($campo === 'p46_ninguno_anteriores') {
                    $data[$campo] = $request->has($campo) ? 1 : 0;
                } else {
                    $data[$campo] = $request->has($campo) ? 1 : 0;
                    if ($request->has($campo)) $seleccionados++;
                }
            }
            // Lógica de exclusividad para "Ninguno de los anteriores"
            if ($data['p46_ninguno_anteriores'] == 1) {
                foreach ($campos as $campo) {
                    if ($campo !== 'p46_ninguno_anteriores') {
                        $data[$campo] = 0;
                    }
                }
            }
            // Validar máximo 5 opciones
            if ($data['p46_ninguno_anteriores'] != 1 && $seleccionados > 5) {
                return back()->withErrors(['max_opciones' => 'Solo puede seleccionar hasta 5 derechos.'])->withInput();
            }
        } elseif ($block == 1) {
            // Hechos victimizantes (opción múltiple)
            $victimizantes = [
                'hecho_homicidio',
                'hecho_desaparicion',
                'hecho_confinamiento',
                'hecho_desplazamiento',
                'hecho_tortura',
                'hecho_amenaza',
                'hecho_despojo',
                'hecho_secuestro',
                'hecho_vinculacion',
                'hecho_perdida_bienes',
                'hecho_minas',
                'hecho_lesiones_psicologicas',
                'hecho_lesiones_fisicas',
                'hecho_s4ecuestro',
                'hecho_terrorismo',
                'hecho_delitos_sexuales',
                'hecho_otro',
                'hecho_no_aplica',
            ];
            foreach ($victimizantes as $campo) {
                $data[$campo] = $request->has($campo) ? 1 : 0;
            }
            $data['hecho_otro_cual'] = $request->input('hecho_otro_cual');
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
            // Grupos etarios (chequear por nombre real en DB)
            $data['grupo_primera_infancia'] = $request->has('grupo_primera_infancia') ? 1 : 0;
            $data['grupo_jovenes'] = $request->has('grupo_jovenes') ? 1 : 0;
            $data['grupo_adultos'] = $request->has('grupo_adultos') ? 1 : 0;
            $data['grupo_adultos_mayores'] = $request->has('grupo_adultos_mayores') ? 1 : 0;
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
        // Validación de llaves primarias en actualización (bloque 1)
        if ($block == 1 && $request->input('es_actualizacion')) {
            $original = DB::table($table)
                ->where('tipo_documento', $request->input('tipo_documento'))
                ->where('numero_documento', $request->input('numero_documento'))
                ->first();
            if (!$original) {
                return back()->with('error', 'No se encontró el registro original para validar las llaves primarias.');
            }
            // Si los valores enviados no coinciden con los originales, rechazar
            if ($request->input('tipo_documento') != $original->tipo_documento || $request->input('numero_documento') != $original->numero_documento) {
                return back()->with('error', 'No está permitido modificar el tipo o número de documento.');
            }
        }
        if ($block == 1) {
            $validator = Validator::make($request->all(), [
                'comuna_nucleo_familiar' => 'required',
                'estrato_nucleo_familiar' => 'required',
                // Agrega aquí otras reglas existentes si las hay
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
            if ($block == 4 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 5, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 4 guardado exitosamente. Continúa con el Bloque 5.');
            }
            if ($block == 5 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 6, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 5 guardado exitosamente. Continúa con el Bloque 6.');
            }
            if ($block == 6 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 7, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 6 guardado exitosamente. Continúa con el Bloque 7.');
            }
            if ($block == 7 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 8, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 7 guardado exitosamente. Continúa con el Bloque 8.');
            }
            if ($block == 8 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 8, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 8 guardado exitosamente.');
            }
            if ($block == 9 && !$request->has('es_actualizacion')) {
                return redirect()->route('form.show', ['block' => 9, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                    ->with('success', 'Bloque 9 guardado exitosamente.');
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
        if ($block == 4 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 5, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 4 guardado exitosamente. Continúa con el Bloque 5.');
        }
        if ($block == 5 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 6, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 5 guardado exitosamente. Continúa con el Bloque 6.');
        }
        if ($block == 6 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 7, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 6 guardado exitosamente. Continúa con el Bloque 7.');
        }
        if ($block == 7 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 8, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 7 guardado exitosamente. Continúa con el Bloque 8.');
        }
        if ($block == 8 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 8, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 8 guardado exitosamente.');
        }
        if ($block == 9 && !$request->has('es_actualizacion')) {
            return redirect()->route('form.show', ['block' => 9, 'tipo_documento' => $data['tipo_documento'], 'numero_documento' => $data['numero_documento']])
                ->with('success', 'Bloque 9 guardado exitosamente.');
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
        } elseif ($block == 5) {
            $table = 't_proteccion_bloque5';
        } elseif ($block == 6) {
            $table = 't_respeto_bloque6';
        } elseif ($block == 7) {
            $table = 't_participacion_bloque7';
        } elseif ($block == 8) {
            $table = 't_representacion_bloque8';
        } elseif ($block == 9) {
            $table = 't_derechos_bloque9';
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
