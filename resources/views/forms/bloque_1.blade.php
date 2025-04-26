@extends('layouts.app')

@section('title', 'Bloque 1: Caracterización Familiar')

@section('content')
<div class="container">
    <h2 class="mb-4">Bloque 1: Caracterización Familiar</h2>
    <ul class="nav nav-tabs mb-4" id="bloque1TabNav" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="bloque1-tab" data-bs-toggle="tab" href="#bloque1-tab-pane" role="tab" aria-controls="bloque1-tab-pane" aria-selected="true">
                Bloque 1: Caracterización Familiar
            </a>
        </li>
        @if(isset($registro))
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque2-tab" href="/observatorioapp/public/form/2/{{ $registro->tipo_documento }}/{{ $registro->numero_documento }}" role="tab" aria-controls="bloque2-tab-pane" aria-selected="false">
                Bloque 2: Vida Digna
            </a>
        </li>
        @endif
    </ul>
    <div class="tab-content" id="bloque1TabsContent">
        <div class="tab-pane fade show active" id="bloque1-tab-pane" role="tabpanel" aria-labelledby="bloque1-tab">
            <form method="POST" action="{{ route('form.store') }}" autocomplete="off" id="bloque1Form">
                @csrf
                <input type="hidden" name="block" value="1">
                @if(isset($registro))
                    <input type="hidden" name="es_actualizacion" value="1">
                @endif
                <input type="hidden" name="tipo_documento" value="{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}">
                <input type="hidden" name="numero_documento" value="{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}">
                <!-- Identificación -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">Identificación</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="tipo_documento" class="form-label">Tipo de documento</label>
                                <select class="form-select" id="tipo_documento" name="tipo_documento">
                                    <option value="">Seleccione...</option>
                                    <option value="4" {{ old('tipo_documento', isset($registro) ? $registro->tipo_documento : '') == '3' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                                    <option value="5" {{ old('tipo_documento', isset($registro) ? $registro->tipo_documento : '') == '4' ? 'selected' : '' }}>Cédula de extranjería</option>
                                    <option value="6" {{ old('tipo_documento', isset($registro) ? $registro->tipo_documento : '') == '5' ? 'selected' : '' }}>Permiso por Protección Temporal (PPT)</option>
                                </select>
                                @error('tipo_documento')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="numero_documento" class="form-label">Número de documento</label>
                                <input type="text" class="form-control" id="numero_documento" name="numero_documento" value="{{ old('numero_documento', isset($registro) ? $registro->numero_documento : '') }}">
                                @error('numero_documento')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="profesional_documento" class="form-label">Número de documento del profesional</label>
                                <input type="text" class="form-control" id="profesional_documento" name="profesional_documento" value="{{ old('profesional_documento', isset($registro) ? $registro->profesional_documento : '') }}">
                                @error('profesional_documento')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Núcleo Familiar -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">Núcleo Familiar</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">¿En qué comuna vive su núcleo familiar?</label>
                            <select class="form-select" name="comuna_nucleo_familiar">
                                <option value="">Seleccione...</option>
                                @for ($i = 7; $i <= 27; $i++)
                                    <option value="{{ $i }}" {{ old('comuna_nucleo_familiar', isset($registro) ? $registro->comuna_nucleo_familiar : '') == $i ? 'selected' : '' }}>{{ DB::table('t_diccionario_datos_observatorio')->where('id', $i)->value('descripcion') }}</option>
                                @endfor
                            </select>
                            @error('comuna_nucleo_familiar')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿Cuál es el estrato socioeconómico de la vivienda que habita tu núcleo familiar?</label>
                            <select class="form-select" name="estrato_nucleo_familiar" required>
                                <option value="">Seleccione...</option>
                                @for ($i = 28; $i <= 33; $i++)
                                    <option value="{{ $i }}" {{ old('estrato_nucleo_familiar', isset($registro) ? $registro->estrato_nucleo_familiar : '') == $i ? 'selected' : '' }}>
                                        {{ DB::table('t_diccionario_datos_observatorio')->where('id', $i)->value('descripcion') }}
                                    </option>
                                @endfor
                            </select>
                            @error('estrato_nucleo_familiar')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿Cuántas personas integran su núcleo familiar?</label>
                            <select class="form-select" name="personas_nucleo">
                                <option value="">Seleccione...</option>
                                <option value="66" {{ old('personas_nucleo', isset($registro) ? $registro->personas_nucleo : '') == '66' ? 'selected' : '' }}>1 persona</option>
                                <option value="67" {{ old('personas_nucleo', isset($registro) ? $registro->personas_nucleo : '') == '67' ? 'selected' : '' }}>2 personas</option>
                                <option value="68" {{ old('personas_nucleo', isset($registro) ? $registro->personas_nucleo : '') == '68' ? 'selected' : '' }}>Entre 3 y 5 personas</option>
                                <option value="69" {{ old('personas_nucleo', isset($registro) ? $registro->personas_nucleo : '') == '69' ? 'selected' : '' }}>Más de 5 personas</option>
                            </select>
                            @error('personas_nucleo')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">De las siguientes configuraciones familiares ¿cuál representa a tu núcleo familiar?</label>
                            <select class="form-select" name="config_familiar">
                                <option value="">Seleccione...</option>
                                @for ($i = 38; $i <= 51; $i++)
                                    <option value="{{ $i }}" {{ old('config_familiar', isset($registro) ? $registro->config_familiar : '') == $i ? 'selected' : '' }}>{{ DB::table('t_diccionario_datos_observatorio')->where('id', $i)->value('descripcion') }}</option>
                                @endfor
                            </select>
                            @error('config_familiar')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿Algún miembro del núcleo familiar se identifica con las siguientes orientaciones sexuales? (Puede seleccionar varias)</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="orientacion_lesbiana" id="orientacion_lesbiana" value="1" {{ old('orientacion_lesbiana', isset($registro) ? $registro->orientacion_lesbiana : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="orientacion_lesbiana">Lesbiana</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="orientacion_gay" id="orientacion_gay" value="1" {{ old('orientacion_gay', isset($registro) ? $registro->orientacion_gay : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="orientacion_gay">Gay</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="orientacion_bisexual" id="orientacion_bisexual" value="1" {{ old('orientacion_bisexual', isset($registro) ? $registro->orientacion_bisexual : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="orientacion_bisexual">Bisexual</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="orientacion_pansexual" id="orientacion_pansexual" value="1" {{ old('orientacion_pansexual', isset($registro) ? $registro->orientacion_pansexual : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="orientacion_pansexual">Pansexual</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="orientacion_asexual" id="orientacion_asexual" value="1" {{ old('orientacion_asexual', isset($registro) ? $registro->orientacion_asexual : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="orientacion_asexual">Asexual</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="orientacion_otra" id="orientacion_otra" value="1" {{ old('orientacion_otra', isset($registro) ? $registro->orientacion_otra : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="orientacion_otra">Otra</label>
                                    </div>
                                </div>
                                <div class="col-md-3 align-items-center d-flex">
                                    <input type="text" class="form-control ms-2" id="orientacion_otra_cual" name="orientacion_otra_cual" placeholder="¿Cuál?" value="{{ old('orientacion_otra_cual', isset($registro) ? $registro->orientacion_otra_cual : '') }}" style="display: none; max-width: 180px;">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="orientacion_prefiere_no_responder" id="orientacion_prefiere_no_responder" value="1" {{ old('orientacion_prefiere_no_responder', isset($registro) ? $registro->orientacion_prefiere_no_responder : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="orientacion_prefiere_no_responder">Prefiere no responder</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="orientacion_no_aplica" id="orientacion_no_aplica" value="1" {{ old('orientacion_no_aplica', isset($registro) ? $registro->orientacion_no_aplica : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="orientacion_no_aplica">No aplica</label>
                                    </div>
                                </div>
                            </div>
                            @error('orientacion')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿De los siguientes grupos etarios, cuáles están presentes en su núcleo familiar? (Puede seleccionar varias)</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="grupo_primera_infancia" id="grupo_60" value="1" {{ old('grupo_primera_infancia', isset($registro) ? ($registro->grupo_primera_infancia ?? '') : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="grupo_60">Primera infancia/adolescentes (0-13 años)</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="grupo_jovenes" id="grupo_61" value="1" {{ old('grupo_jovenes', isset($registro) ? ($registro->grupo_jovenes ?? '') : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="grupo_61">Jóvenes (14-28 años)</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="grupo_adultos" id="grupo_62" value="1" {{ old('grupo_adultos', isset($registro) ? ($registro->grupo_adultos ?? '') : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="grupo_62">Adultos (29- 59 años)</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="grupo_adultos_mayores" id="grupo_63" value="1" {{ old('grupo_adultos_mayores', isset($registro) ? ($registro->grupo_adultos_mayores ?? '') : '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="grupo_63">Adultos mayores (más de 60 años)</label>
                                    </div>
                                </div>
                            </div>
                            @error('grupo')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿Con cuál de las siguientes etnias se identifica tu núcleo familiar?</label>
                            <select class="form-select" name="grupo_etnico">
                                <option value="">Seleccione...</option>
                                <option value="64" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '64' ? 'selected' : '' }}>Indígena</option>
                                <option value="65" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '65' ? 'selected' : '' }}>Afrodescendiente</option>
                                <option value="66" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '66' ? 'selected' : '' }}>Mestizo</option>
                                <option value="67" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '67' ? 'selected' : '' }}>Room o Gitano</option>
                                <option value="68" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '68' ? 'selected' : '' }}>Raizal</option>
                                <option value="69" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '69' ? 'selected' : '' }}>Palenquero</option>
                                <option value="70" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '70' ? 'selected' : '' }}>Negro</option>
                                <option value="71" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '71' ? 'selected' : '' }}>Ninguno</option>
                                <option value="72" {{ old('grupo_etnico', isset($registro) ? $registro->grupo_etnico : '') == '72' ? 'selected' : '' }}>Prefiero no decirlo</option>
                            </select>
                            @error('grupo_etnico')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿Cuál es el máximo nivel educativo alcanzado por alguno de los miembros de su núcleo familiar?</label>
                            <select class="form-select" name="nivel_educativo">
                                <option value="">Seleccione...</option>
                                <option value="73" {{ old('nivel_educativo', isset($registro) ? $registro->nivel_educativo : '') == '73' ? 'selected' : '' }}>Primaria</option>
                                <option value="74" {{ old('nivel_educativo', isset($registro) ? $registro->nivel_educativo : '') == '74' ? 'selected' : '' }}>Bachiller</option>
                                <option value="75" {{ old('nivel_educativo', isset($registro) ? $registro->nivel_educativo : '') == '75' ? 'selected' : '' }}>Técnico</option>
                                <option value="76" {{ old('nivel_educativo', isset($registro) ? $registro->nivel_educativo : '') == '76' ? 'selected' : '' }}>Tecnológico</option>
                                <option value="77" {{ old('nivel_educativo', isset($registro) ? $registro->nivel_educativo : '') == '77' ? 'selected' : '' }}>Pregrado</option>
                                <option value="78" {{ old('nivel_educativo', isset($registro) ? $registro->nivel_educativo : '') == '78' ? 'selected' : '' }}>Posgrado</option>
                                <option value="79" {{ old('nivel_educativo', isset($registro) ? $registro->nivel_educativo : '') == '79' ? 'selected' : '' }}>Ninguno</option>
                            </select>
                            @error('nivel_educativo')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿La familia es migrante?</label>
                            <select class="form-select" name="familia_migrante">
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('familia_migrante', isset($registro) ? $registro->familia_migrante : '') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="2" {{ old('familia_migrante', isset($registro) ? $registro->familia_migrante : '') == '2' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('familia_migrante')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <!-- Victimización -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">Victimización</div>
                    <div class="card-body">
                    <div class="mb-3">
                            <label class="form-label">¿Algún miembro del núcleo familiar ha sido víctima del conflicto armado y/o social en Colombia?</label>
                            <select class="form-select" name="victima_conflicto">
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('victima_conflicto', isset($registro) ? $registro->victima_conflicto : '') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="2" {{ old('victima_conflicto', isset($registro) ? $registro->victima_conflicto : '') == '2' ? 'selected' : '' }}>No</option>
                                <option value="44" {{ old('victima_conflicto', isset($registro) ? $registro->victima_conflicto : '') == '44' ? 'selected' : '' }}>No sabe</option>
                            </select>
                            @error('victima_conflicto')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿Cuáles han sido los hechos victimizantes? (Seleccione todas las que apliquen)</label>
                            <div class="row">
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_homicidio" id="hecho_homicidio" value="1" {{ old('hecho_homicidio', isset($registro) ? $registro->hecho_homicidio : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_homicidio">Homicidio</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_desaparicion" id="hecho_desaparicion" value="1" {{ old('hecho_desaparicion', isset($registro) ? $registro->hecho_desaparicion : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_desaparicion">Desaparición forzada</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_confinamiento" id="hecho_confinamiento" value="1" {{ old('hecho_confinamiento', isset($registro) ? $registro->hecho_confinamiento : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_confinamiento">Confinamiento</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_desplazamiento" id="hecho_desplazamiento" value="1" {{ old('hecho_desplazamiento', isset($registro) ? $registro->hecho_desplazamiento : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_desplazamiento">Desplazamiento forzado</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_tortura" id="hecho_tortura" value="1" {{ old('hecho_tortura', isset($registro) ? $registro->hecho_tortura : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_tortura">Tortura</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_amenaza" id="hecho_amenaza" value="1" {{ old('hecho_amenaza', isset($registro) ? $registro->hecho_amenaza : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_amenaza">Amenaza</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_despojo" id="hecho_despojo" value="1" {{ old('hecho_despojo', isset($registro) ? $registro->hecho_despojo : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_despojo">Despojo forzado y/o abandono forzado de tierras</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_secuestro" id="hecho_secuestro" value="1" {{ old('hecho_secuestro', isset($registro) ? $registro->hecho_secuestro : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_secuestro">Secuestro</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_vinculacion" id="hecho_vinculacion" value="1" {{ old('hecho_vinculacion', isset($registro) ? $registro->hecho_vinculacion : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_vinculacion">Vinculación de niños, niñas y adolescentes a actividades relacionadas con grupos armados</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_perdida_bienes" id="hecho_perdida_bienes" value="1" {{ old('hecho_perdida_bienes', isset($registro) ? $registro->hecho_perdida_bienes : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_perdida_bienes">Pérdida de bienes muebles o inmuebles</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_minas" id="hecho_minas" value="1" {{ old('hecho_minas', isset($registro) ? $registro->hecho_minas : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_minas">Minas antipersonal, munición sin explotar, artefacto explosivo improvisado</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_lesiones_psicologicas" id="hecho_lesiones_psicologicas" value="1" {{ old('hecho_lesiones_psicologicas', isset($registro) ? $registro->hecho_lesiones_psicologicas : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_lesiones_psicologicas">Lesiones personales psicológicas</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_lesiones_fisicas" id="hecho_lesiones_fisicas" value="1" {{ old('hecho_lesiones_fisicas', isset($registro) ? $registro->hecho_lesiones_fisicas : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_lesiones_fisicas">Lesiones personales físicas</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_terrorismo" id="hecho_terrorismo" value="1" {{ old('hecho_terrorismo', isset($registro) ? $registro->hecho_terrorismo : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_terrorismo">Acto terrorista/ atentados/ combates/ enfrentamientos/ hostigamientos</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_delitos_sexuales" id="hecho_delitos_sexuales" value="1" {{ old('hecho_delitos_sexuales', isset($registro) ? $registro->hecho_delitos_sexuales : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_delitos_sexuales">Delitos contra la libertad e integridad sexual en el marco del conflicto armado</label></div></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_otro" id="hecho_otro" value="1" {{ old('hecho_otro', isset($registro) ? $registro->hecho_otro : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_otro">Otro</label></div></div>
                                <div class="col-md-4 align-items-center d-flex"><input type="text" class="form-control ms-2" id="hecho_otro_cual" name="hecho_otro_cual" placeholder="¿Cuál?" value="{{ old('hecho_otro_cual', isset($registro) ? $registro->hecho_otro_cual : '') }}" style="display: none; max-width: 180px;"></div>
                                <div class="col-md-4"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="hecho_no_aplica" id="hecho_no_aplica" value="1" {{ old('hecho_no_aplica', isset($registro) ? $registro->hecho_no_aplica : '') == 1 ? 'checked' : '' }}><label class="form-check-label" for="hecho_no_aplica">No aplica</label></div></div>
                            </div>
                            @error('hecho')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <!-- Configuración Familiar -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">Configuración Familiar</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">¿Quién es la jefatura o figura de representación en tu núcleo familiar?</label>
                            <select class="form-select" name="jefatura_nucleo" required>
                                <option value="">Seleccione...</option>
                                <option value="107" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '107' ? 'selected' : '' }}>Pareja</option>
                                <option value="108" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '108' ? 'selected' : '' }}>Madre y Padre</option>
                                <option value="109" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '109' ? 'selected' : '' }}>Madre</option>
                                <option value="110" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '110' ? 'selected' : '' }}>Padre</option>
                                <option value="111" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '111' ? 'selected' : '' }}>Hijos/as</option>
                                <option value="112" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '112' ? 'selected' : '' }}>Abuelos/as</option>
                                <option value="113" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '113' ? 'selected' : '' }}>Todos los integrantes de la familia</option>
                                <option value="114" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '114' ? 'selected' : '' }}>Solo yo (Hogar unipersonal)</option>
                                <option value="115" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '115' ? 'selected' : '' }}>Hermanos/as</option>
                                <option value="116" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '116' ? 'selected' : '' }}>Otros familiares</option>
                                <option value="117" {{ old('jefatura_nucleo', isset($registro) ? $registro->jefatura_nucleo : '') == '117' ? 'selected' : '' }}>No hay jefatura</option>
                            </select>
                            @error('jefatura_nucleo')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">¿En tu familia hay personas que requieren cuidado permanente?</label>
                            <select class="form-select" name="personas_cuidado">
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('personas_cuidado', isset($registro) ? $registro->personas_cuidado : '') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="2" {{ old('personas_cuidado', isset($registro) ? $registro->personas_cuidado : '') == '2' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('personas_cuidado')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Guardar
                    </button>
                    <button type="button" class="btn btn-success btn-lg ms-2" id="btnSiguiente"  {{ isset($registro) ? '' : 'disabled' }}>
                        Siguiente <i class="bi bi-arrow-right-circle"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar SweetAlert de éxito si existe mensaje en sesión
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Guardado exitosamente!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#0c6efd'
            });
        @endif

        // Lógica para el botón Siguiente
        const btnSiguiente = document.getElementById('btnSiguiente');
        @if(isset($registro))
            btnSiguiente.disabled = false;
            btnSiguiente.addEventListener('click', function() {
                // Usar SIEMPRE las llaves del registro guardado para URL limpia
                const tipo_documento = '{{ $registro->tipo_documento }}';
                const numero_documento = '{{ $registro->numero_documento }}';
                window.location.href = "/observatorioapp/public/form/2/" + tipo_documento + "/" + numero_documento;
            });
        @endif

        // Mostrar SweetAlert de error si existe error de usuario existente
        @if($errors->has('usuario_existente'))
            Swal.fire({
                icon: 'error',
                title: 'Usuario ya existe',
                text: 'Este usuario ya existe, solo puedes ingresar usuarios nuevos.',
                confirmButtonColor: '#d33'
            });
        @endif

        // Mostrar/ocultar campo CUAL en pregunta 4
        const chkOtraOrientacion = document.getElementById('orientacion_otra');
        const txtOtraOrientacion = document.getElementById('orientacion_otra_cual');
        if(chkOtraOrientacion) {
            function toggleOtraOrientacion() {
                txtOtraOrientacion.style.display = chkOtraOrientacion.checked ? 'block' : 'none';
            }
            chkOtraOrientacion.addEventListener('change', toggleOtraOrientacion);
            toggleOtraOrientacion();
        }
        // Exclusividad No aplica en pregunta 4
        const chkNoAplicaOrientacion = document.getElementById('orientacion_no_aplica');
        const orientacionChecks = document.querySelectorAll('input[name^="orientacion_"]:not(#orientacion_no_aplica)');
        if(chkNoAplicaOrientacion) {
            chkNoAplicaOrientacion.addEventListener('change', function() {
                if(this.checked) {
                    orientacionChecks.forEach(chk => { if(chk.id !== 'orientacion_no_aplica') chk.checked = false; });
                    if(chkOtraOrientacion) txtOtraOrientacion.style.display = 'none';
                }
            });
        }
        orientacionChecks.forEach(chk => {
            chk.addEventListener('change', function() {
                if(this.checked && chkNoAplicaOrientacion.checked) chkNoAplicaOrientacion.checked = false;
            });
        });

        // Mostrar/ocultar campo CUAL en pregunta 6
        const chkHechoOtro = document.getElementById('hecho_otro');
        const txtHechoOtro = document.getElementById('hecho_otro_cual');
        if(chkHechoOtro) {
            function toggleHechoOtro() {
                txtHechoOtro.style.display = chkHechoOtro.checked ? 'block' : 'none';
            }
            chkHechoOtro.addEventListener('change', toggleHechoOtro);
            toggleHechoOtro();
        }
        // Exclusividad No aplica en pregunta 6
        const chkNoAplicaHecho = document.getElementById('hecho_no_aplica');
        const hechoChecks = document.querySelectorAll('input[name^="hecho_"]:not(#hecho_no_aplica)');
        if(chkNoAplicaHecho) {
            chkNoAplicaHecho.addEventListener('change', function() {
                if(this.checked) {
                    hechoChecks.forEach(chk => { if(chk.id !== 'hecho_no_aplica') chk.checked = false; });
                    if(chkHechoOtro) txtHechoOtro.style.display = 'none';
                }
            });
        }
        hechoChecks.forEach(chk => {
            chk.addEventListener('change', function() {
                if(this.checked && chkNoAplicaHecho.checked) chkNoAplicaHecho.checked = false;
            });
        });

        // Spinner al guardar
        const form = document.getElementById('bloque1Form');
        form.addEventListener('submit', function(e) {
            // Validación amigable: solo mostrar SweetAlert para el primer campo vacío
            const campos = [
                {selector: '#tipo_documento', label: 'Tipo de documento'},
                {selector: '#numero_documento', label: 'Número de documento'},
                {selector: '#profesional_documento', label: 'Número de documento del profesional'},
                {selector: 'select[name="comuna_nucleo_familiar"]', label: 'Comuna núcleo familiar'},
                {selector: 'select[name="familia_migrante"]', label: '¿La familia es migrante?'},
                {selector: 'select[name="grupo_etnico"]', label: 'Grupo étnico'},
                {selector: 'select[name="victima_conflicto"]', label: '¿Ha sido víctima del conflicto armado?'},
                {selector: 'select[name="nivel_educativo"]', label: 'Nivel educativo'},
                {selector: 'select[name="personas_nucleo"]', label: 'Personas en el núcleo familiar'},
                {selector: 'select[name="config_familiar"]', label: 'Configuración familiar'},
                {selector: 'select[name="personas_cuidado"]', label: '¿Requieren cuidado permanente?'}
            ];
            for(let campo of campos) {
                let el = document.querySelector(campo.selector);
                if(el && (el.value === '' || el.value === null)) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo obligatorio',
                        text: `Debes llenar el campo: ${campo.label}`,
                        confirmButtonColor: '#0c6efd'
                    });
                    el.focus();
                    return false;
                }
            }
            // Validar selección múltiple: al menos uno marcado
            const grupos = [
                {name: 'orientación sexual', prefix: 'orientacion_', label: '¿Algún miembro del núcleo familiar se identifica con las siguientes orientaciones sexuales?'},
                {name: 'grupo etario', prefix: 'grupo_', label: '¿De los siguientes grupos etarios, cuáles están presentes en su núcleo familiar?'},
                {name: 'hechos victimizantes', prefix: 'hecho_', label: '¿Cuáles han sido los hechos victimizantes?'}
            ];
            for(let grupo of grupos) {
                let checks = this.querySelectorAll(`input[type=checkbox][name^='${grupo.prefix}']`);
                let checked = Array.from(checks).some(chk => chk.checked);
                if(!checked) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo obligatorio',
                        text: `Debes seleccionar al menos una opción en: ${grupo.label}`,
                        confirmButtonColor: '#0c6efd'
                    });
                    checks[0].focus();
                    return false;
                }
            }
            // Validación campo "¿Cuál?" pregunta 4
            const chkOtraOrientacion = document.getElementById('orientacion_otra');
            const chkNoAplicaOrientacion = document.getElementById('orientacion_no_aplica');
            const txtOtraOrientacion = document.getElementById('orientacion_otra_cual');
            if(chkOtraOrientacion && chkOtraOrientacion.checked && (!chkNoAplicaOrientacion || !chkNoAplicaOrientacion.checked)) {
                if(txtOtraOrientacion && txtOtraOrientacion.value.trim() === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo obligatorio',
                        text: 'Debes llenar el campo: ¿Cuál? (especifica la orientación sexual)',
                        confirmButtonColor: '#0c6efd'
                    });
                    txtOtraOrientacion.focus();
                    return false;
                }
            }
            // Validación campo "¿Cuál?" pregunta 6
            const chkHechoOtro = document.getElementById('hecho_otro');
            const chkNoAplicaHecho = document.getElementById('hecho_no_aplica');
            const txtHechoOtro = document.getElementById('hecho_otro_cual');
            if(chkHechoOtro && chkHechoOtro.checked && (!chkNoAplicaHecho || !chkNoAplicaHecho.checked)) {
                if(txtHechoOtro && txtHechoOtro.value.trim() === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo obligatorio',
                        text: 'Debes llenar el campo: ¿Cuál? (especifica el hecho victimizante)',
                        confirmButtonColor: '#0c6efd'
                    });
                    txtHechoOtro.focus();
                    return false;
                }
            }
            // Mostrar spinner sobre el formulario
            let spinner = document.createElement('div');
            spinner.id = 'loadingSpinner';
            spinner.style.position = 'fixed';
            spinner.style.top = '0';
            spinner.style.left = '0';
            spinner.style.width = '100vw';
            spinner.style.height = '100vh';
            spinner.style.background = 'rgba(255,255,255,0.7)';
            spinner.style.display = 'flex';
            spinner.style.alignItems = 'center';
            spinner.style.justifyContent = 'center';
            spinner.style.zIndex = '9999';
            spinner.innerHTML = `<div class='spinner-border text-primary' style='width: 4rem; height: 4rem;' role='status'><span class='visually-hidden'>Cargando...</span></div>`;
            document.body.appendChild(spinner);
        });
    });
</script>
@endsection
