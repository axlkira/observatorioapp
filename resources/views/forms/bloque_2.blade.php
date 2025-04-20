@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-tabs mb-4" id="bloque2TabNav" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque1-tab" href="{{ route('form.show', ['block' => 1, 'tipo_documento' => request('tipo_documento'), 'numero_documento' => request('numero_documento')]) }}" role="tab" aria-controls="bloque1-tab-pane" aria-selected="false">
                Bloque 1: Caracterización Familiar
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="bloque2-tab" data-bs-toggle="tab" href="#bloque2-tab-pane" role="tab" aria-controls="bloque2-tab-pane" aria-selected="true">
                Bloque 2: Vida Digna
            </a>
        </li>
    </ul>
    <div class="tab-content" id="bloque2TabsContent">
        <div class="tab-pane fade show active" id="bloque2-tab-pane" role="tabpanel" aria-labelledby="bloque2-tab">
            <div class="container">
                <h2 class="mb-4">Bloque 2: Vida Digna</h2>
                <form method="POST" action="{{ route('form.store') }}" autocomplete="off" id="bloque2Form">
                    @csrf
                    <input type="hidden" name="block" value="2">
                    <input type="hidden" name="tipo_documento" value="{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}">
                    <input type="hidden" name="numero_documento" value="{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}">
                    @if(isset($registro))
                        <input type="hidden" name="es_actualizacion" value="1">
                    @endif
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">15. ¿Alguien de tu núcleo familiar ha sido víctima de algún tipo de las siguientes violencias al interior del hogar?</div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_sexual" id="violencia_sexual" value="1" {{ old('violencia_sexual', $registro->violencia_sexual ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_sexual">Violencia sexual</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_genero" id="violencia_genero" value="1" {{ old('violencia_genero', $registro->violencia_genero ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_genero">Violencia de género</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_psicologica" id="violencia_psicologica" value="1" {{ old('violencia_psicologica', $registro->violencia_psicologica ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_psicologica">Violencia psicológica</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_fisica" id="violencia_fisica" value="1" {{ old('violencia_fisica', $registro->violencia_fisica ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_fisica">Violencia física</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_economica" id="violencia_economica" value="1" {{ old('violencia_economica', $registro->violencia_economica ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_economica">Violencia económica</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_ninguna" id="violencia_ninguna" value="1" {{ old('violencia_ninguna', $registro->violencia_ninguna ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_ninguna">Ninguna de las anteriores</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">16. ¿Consideras que el entorno en el que habita tu núcleo familiar es seguro?</div>
                        <div class="card-body">
                            <select class="form-select" name="entorno_seguro">
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('entorno_seguro', $registro->entorno_seguro ?? '') == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="2" {{ old('entorno_seguro', $registro->entorno_seguro ?? '') == 2 ? 'selected' : '' }}>No</option>
                                <option value="92" {{ old('entorno_seguro', $registro->entorno_seguro ?? '') == 92 ? 'selected' : '' }}>No responde</option>
                            </select>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">17. En tu núcleo familiar han sido discriminados en razón de:</div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_sexo" id="discriminacion_sexo" value="1" {{ old('discriminacion_sexo', $registro->discriminacion_sexo ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_sexo">Sexo</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_genero" id="discriminacion_genero" value="1" {{ old('discriminacion_genero', $registro->discriminacion_genero ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_genero">Identidad de género</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_etnia" id="discriminacion_etnia" value="1" {{ old('discriminacion_etnia', $registro->discriminacion_etnia ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_etnia">Etnia</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_nacionalidad" id="discriminacion_nacionalidad" value="1" {{ old('discriminacion_nacionalidad', $registro->discriminacion_nacionalidad ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_nacionalidad">Nacionalidad</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_estrato" id="discriminacion_estrato" value="1" {{ old('discriminacion_estrato', $registro->discriminacion_estrato ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_estrato">Estrato</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_edad" id="discriminacion_edad" value="1" {{ old('discriminacion_edad', $registro->discriminacion_edad ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_edad">Edad</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_religion" id="discriminacion_religion" value="1" {{ old('discriminacion_religion', $registro->discriminacion_religion ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_religion">Religión</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_discapacidad" id="discriminacion_discapacidad" value="1" {{ old('discriminacion_discapacidad', $registro->discriminacion_discapacidad ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_discapacidad">Discapacidad</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_otros" id="discriminacion_otros" value="1" {{ old('discriminacion_otros', $registro->discriminacion_otros ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_otros">Otros</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_no_hemos" id="discriminacion_no_hemos" value="1" {{ old('discriminacion_no_hemos', $registro->discriminacion_no_hemos ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_no_hemos">No hemos sido discriminados</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">18. ¿Con qué frecuencia en tu núcleo familiar dedican tiempo a compartir actividades juntos?</div>
                        <div class="card-body">
                            <select class="form-select" name="frecuencia_compartir">
                                <option value="">Seleccione...</option>
                                <option value="103" {{ old('frecuencia_compartir', $registro->frecuencia_compartir ?? '') == 103 ? 'selected' : '' }}>Muy frecuentemente</option>
                                <option value="104" {{ old('frecuencia_compartir', $registro->frecuencia_compartir ?? '') == 104 ? 'selected' : '' }}>Frecuentemente</option>
                                <option value="105" {{ old('frecuencia_compartir', $registro->frecuencia_compartir ?? '') == 105 ? 'selected' : '' }}>Con poca frecuencia</option>
                                <option value="106" {{ old('frecuencia_compartir', $registro->frecuencia_compartir ?? '') == 106 ? 'selected' : '' }}>Nunca</option>
                            </select>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">19. En algún momento en tu familia han acudido a alguna de las siguientes instituciones por razón de violencia intrafamiliar:</div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_cavif" id="institucion_cavif" value="1" {{ old('institucion_cavif', $registro->institucion_cavif ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_cavif">CAVIF. Centro de Atención para la Violencia Intrafamiliar</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_ips_eps" id="institucion_ips_eps" value="1" {{ old('institucion_ips_eps', $registro->institucion_ips_eps ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_ips_eps">Institución prestadora servicios de salud IPS/EPS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_fiscalia" id="institucion_fiscalia" value="1" {{ old('institucion_fiscalia', $registro->institucion_fiscalia ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_fiscalia">Fiscalía General de la Nación</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_linea_155" id="institucion_linea_155" value="1" {{ old('institucion_linea_155', $registro->institucion_linea_155 ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_linea_155">Línea Nacional de Atención a la mujer 155</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_comisaria" id="institucion_comisaria" value="1" {{ old('institucion_comisaria', $registro->institucion_comisaria ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_comisaria">Comisaría de familia</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_inspeccion" id="institucion_inspeccion" value="1" {{ old('institucion_inspeccion', $registro->institucion_inspeccion ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_inspeccion">Inspección de policía</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_icbf" id="institucion_icbf" value="1" {{ old('institucion_icbf', $registro->institucion_icbf ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_icbf">Centro zonal ICBF</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_caivas" id="institucion_caivas" value="1" {{ old('institucion_caivas', $registro->institucion_caivas ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_caivas">CAIVAS. Centro de Atención Integral a Víctimas de Abuso Sexual</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_personeria" id="institucion_personeria" value="1" {{ old('institucion_personeria', $registro->institucion_personeria ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_personeria">Personería o Defensoría del Pueblo</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_centros_integrales" id="institucion_centros_integrales" value="1" {{ old('institucion_centros_integrales', $registro->institucion_centros_integrales ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_centros_integrales">Centros Integrales para la Familia</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_no_hemos_asistido" id="institucion_no_hemos_asistido" value="1" {{ old('institucion_no_hemos_asistido', $registro->institucion_no_hemos_asistido ?? 2) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_no_hemos_asistido">No hemos asistido</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="/form/1/{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}/{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}" class="btn btn-secondary btn-lg me-2">
                            <i class="bi bi-arrow-left-circle"></i> Anterior
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg me-2">Guardar</button>
                        <button id="btnSiguiente" type="button" class="btn btn-success btn-lg" {{ !isset($registro) ? 'disabled' : '' }}>
                            Siguiente <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>
                </form>
            </div>
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

    // Mostrar SweetAlert de error si existe error de usuario existente
    @if($errors->has('usuario_existente'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first('usuario_existente') }}',
            confirmButtonColor: '#d33'
        });
    @endif

    // Spinner y deshabilitar botón al guardar
    const form = document.getElementById('bloque2Form');
    if (form) {
        form.addEventListener('submit', function(e) {
            Swal.fire({
                title: 'Guardando...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });
        });
    }

    // Lógica para el botón Siguiente
    const btnSiguiente = document.getElementById('btnSiguiente');
    @if(isset($registro))
        btnSiguiente.disabled = false;
        btnSiguiente.addEventListener('click', function() {
            // Redirige a bloque 3 con las llaves actuales
            const tipo_documento = '{{ $registro->tipo_documento }}';
            const numero_documento = '{{ $registro->numero_documento }}';
            window.location.href = "/form/3/" + tipo_documento + "/" + numero_documento;
        });
    @else
        btnSiguiente.disabled = true;
    @endif

    // Exclusividad para "Ninguna" y "No hemos asistido" en preguntas múltiples
    function exclusividadCheckboxes(grupo, idNinguna) {
        const checks = document.querySelectorAll('.' + grupo);
        const ninguna = document.getElementById(idNinguna);
        checks.forEach(chk => {
            chk.addEventListener('change', function() {
                if (this === ninguna && this.checked) {
                    checks.forEach(otro => { if (otro !== ninguna) otro.checked = false; });
                } else if (this.checked) {
                    ninguna.checked = false;
                }
            });
        });
    }
    exclusividadCheckboxes('violencia-multiple', 'violencia_ninguna');
    exclusividadCheckboxes('discriminacion-multiple', 'discriminacion_no_hemos');
    exclusividadCheckboxes('institucion-multiple', 'institucion_no_hemos_asistido');
});
</script>
@endsection
