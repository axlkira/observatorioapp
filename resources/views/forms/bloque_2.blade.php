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
                    <input type="hidden" name="profesional_documento" value="{{ session('profesional_documento', old('profesional_documento', isset($registro) ? $registro->profesional_documento : '0')) }}">
                    @if(isset($registro))
                        <input type="hidden" name="es_actualizacion" value="1">
                    @endif
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">17. ¿Alguien de tu núcleo familiar ha sido víctima de algún tipo de las siguientes violencias al interior del hogar?</div>
                        <div class="card-body">
                            @php $violencia_requerida = !isset($registro); @endphp
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_sexual" id="violencia_sexual" value="1" {{ old('violencia_sexual', $registro->violencia_sexual ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_sexual">Violencia sexual</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_genero" id="violencia_genero" value="1" {{ old('violencia_genero', $registro->violencia_genero ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_genero">Violencia de género</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_psicologica" id="violencia_psicologica" value="1" {{ old('violencia_psicologica', $registro->violencia_psicologica ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_psicologica">Violencia psicológica</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_fisica" id="violencia_fisica" value="1" {{ old('violencia_fisica', $registro->violencia_fisica ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_fisica">Violencia física</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_economica" id="violencia_economica" value="1" {{ old('violencia_economica', $registro->violencia_economica ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_economica">Violencia económica</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input violencia-multiple" type="checkbox" name="violencia_ninguna" id="violencia_ninguna" value="1" {{ old('violencia_ninguna', $registro->violencia_ninguna ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="violencia_ninguna">Ninguna de las anteriores</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4" id="pregunta18Card">
                        <div class="card-header bg-primary text-white">18. En algún momento en tu familia han acudido a alguna de las siguientes instituciones por razón de violencia intrafamiliar:</div>
                        <div class="card-body">
                            @php $institucion_requerida = !isset($registro); @endphp
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_cavif" id="institucion_cavif" value="1" {{ old('institucion_cavif', $registro->institucion_cavif ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_cavif">CAVIF. Centro de Atención para la Violencia Intrafamiliar</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_ips_eps" id="institucion_ips_eps" value="1" {{ old('institucion_ips_eps', $registro->institucion_ips_eps ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_ips_eps">Institución prestadora servicios de salud IPS/EPS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_fiscalia" id="institucion_fiscalia" value="1" {{ old('institucion_fiscalia', $registro->institucion_fiscalia ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_fiscalia">Fiscalía General de la Nación</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_linea_155" id="institucion_linea_155" value="1" {{ old('institucion_linea_155', $registro->institucion_linea_155 ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_linea_155">Línea Nacional de Atención a la mujer 155</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_comisaria" id="institucion_comisaria" value="1" {{ old('institucion_comisaria', $registro->institucion_comisaria ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_comisaria">Comisaría de familia</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_inspeccion" id="institucion_inspeccion" value="1" {{ old('institucion_inspeccion', $registro->institucion_inspeccion ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_inspeccion">Inspección de policía</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_icbf" id="institucion_icbf" value="1" {{ old('institucion_icbf', $registro->institucion_icbf ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_icbf">Centro zonal ICBF</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_caivas" id="institucion_caivas" value="1" {{ old('institucion_caivas', $registro->institucion_caivas ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_caivas">CAIVAS. Centro de Atención Integral a Víctimas de Abuso Sexual</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_personeria" id="institucion_personeria" value="1" {{ old('institucion_personeria', $registro->institucion_personeria ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_personeria">Personería o Defensoría del Pueblo</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input institucion-multiple" type="checkbox" name="institucion_centros_integrales" id="institucion_centros_integrales" value="1" {{ old('institucion_centros_integrales', $registro->institucion_centros_integrales ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="institucion_centros_integrales">Centros Integrales para la Familia</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">19. En tu núcleo familiar han sido discriminados en razón de:</div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_sexo" id="discriminacion_sexo" value="1" {{ old('discriminacion_sexo', $registro->discriminacion_sexo ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_sexo">Sexo</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_genero" id="discriminacion_genero" value="1" {{ old('discriminacion_genero', $registro->discriminacion_genero ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_genero">Identidad de género</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_etnia" id="discriminacion_etnia" value="1" {{ old('discriminacion_etnia', $registro->discriminacion_etnia ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_etnia">Etnia</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_nacionalidad" id="discriminacion_nacionalidad" value="1" {{ old('discriminacion_nacionalidad', $registro->discriminacion_nacionalidad ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_nacionalidad">Nacionalidad</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_estrato" id="discriminacion_estrato" value="1" {{ old('discriminacion_estrato', $registro->discriminacion_estrato ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_estrato">Estrato</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_edad" id="discriminacion_edad" value="1" {{ old('discriminacion_edad', $registro->discriminacion_edad ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_edad">Edad</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_religion" id="discriminacion_religion" value="1" {{ old('discriminacion_religion', $registro->discriminacion_religion ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_religion">Religión</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_discapacidad" id="discriminacion_discapacidad" value="1" {{ old('discriminacion_discapacidad', $registro->discriminacion_discapacidad ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_discapacidad">Discapacidad</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_otros" id="discriminacion_otros" value="1" {{ old('discriminacion_otros', $registro->discriminacion_otros ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_otros">Otros</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_no_hemos" id="discriminacion_no_hemos" value="1" {{ old('discriminacion_no_hemos', $registro->discriminacion_no_hemos ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_no_hemos">No hemos sido discriminados</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input discriminacion-multiple" type="checkbox" name="discriminacion_no_sabe" id="discriminacion_no_sabe" value="1" {{ old('discriminacion_no_sabe', $registro->discriminacion_no_sabe ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="discriminacion_no_sabe">No sabe</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="/observatorioapp/public/form/1/{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}/{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}" class="btn btn-secondary btn-lg me-2">
                            <i class="bi bi-arrow-left-circle"></i> Anterior
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg me-2">Guardar</button>
                        <button id="btnSiguienteBloque3" type="button" class="btn btn-success btn-lg" {{ !isset($registro) ? 'disabled' : '' }}>
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
    @if($errors->any()) {
        let errorMsg = '';
        @foreach ($errors->all() as $error)
            errorMsg += '{{ $error }}\n';
        @endforeach
        Swal.fire({
            icon: 'error',
            title: 'Error en el formulario',
            text: errorMsg,
            confirmButtonColor: '#d33'
        });
    }
    @endif

    // Spinner al guardar y validación avanzada
    const form = document.getElementById('bloque2Form');
    form.addEventListener('submit', function(e) {
        // Validación amigable: solo mostrar SweetAlert para el primer campo vacío o grupo no respondido
        const campos = [
            {selector: 'select[name="entorno_seguro"]', label: '16. ¿El entorno es seguro?'},
            {selector: 'select[name="frecuencia_compartir"]', label: '18. ¿Con qué frecuencia comparten actividades?'}
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
            {name: 'violencia', className: 'violencia-multiple', label: '17. ¿Alguien ha sido víctima de violencia?', ninguna: 'violencia_ninguna'},
            {name: 'discriminacion', className: 'discriminacion-multiple', label: '19. ¿Han sido discriminados?', ninguna: 'discriminacion_no_hemos'},
            {name: 'institucion', className: 'institucion-multiple', label: '18. ¿Han acudido a instituciones por violencia?', ninguna: ''}
        ];
        for(let grupo of grupos) {
            let checks = this.querySelectorAll(`input[type=checkbox].${grupo.className}`);
            let checked = Array.from(checks).some(chk => chk.checked);
            
            // Si es el grupo "institucion" y "violencia_ninguna" está marcado, no validar
            if (grupo.name === 'institucion' && document.getElementById('violencia_ninguna').checked) {
                continue; // Saltamos la validación para este grupo
            }
            
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
            // Validar que NO obligue a seleccionar todas: si "ninguna" está marcada, ignora las otras
            let ninguna = document.getElementById(grupo.ninguna);
            if (ninguna && ninguna.checked) {
                continue;
            }
            // Si ninguna no está marcada, debe haber al menos una de las otras marcada
            let otros = Array.from(checks).filter(chk => chk.id !== grupo.ninguna);
            let otrosMarcados = otros.some(chk => chk.checked);
            if (!otrosMarcados && (!ninguna || !ninguna.checked)) {
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
        Swal.fire({
            title: 'Guardando...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });
    });
    // Lógica para el botón Siguiente
    const btnSiguiente = document.getElementById('btnSiguienteBloque3');
    @if(isset($registro))
        btnSiguiente.disabled = false;
        btnSiguiente.addEventListener('click', function() {
            const tipo_documento = '{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}';
            const numero_documento = '{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}';
            window.location.href = "/observatorioapp/public/form/3/" + tipo_documento + "/" + numero_documento;
        });
    @else
        btnSiguiente.disabled = true;
    @endif

    // Exclusividad para "Ninguna" y "No hemos asistido" en preguntas múltiples
    function exclusividadCheckboxes(grupo, idNinguna, idNoSabe = null) {
        const checks = document.querySelectorAll('.' + grupo);
        const ninguna = document.getElementById(idNinguna);
        const noSabe = idNoSabe ? document.getElementById(idNoSabe) : null;
        
        checks.forEach(chk => {
            chk.addEventListener('change', function() {
                // Si se marca "Ninguna", desmarcar todas las otras
                if (this === ninguna && this.checked) {
                    checks.forEach(otro => { 
                        if (otro !== ninguna) otro.checked = false; 
                    });
                } 
                // Si se marca "No sabe", desmarcar todas las otras
                else if (noSabe && this === noSabe && this.checked) {
                    checks.forEach(otro => { 
                        if (otro !== noSabe) otro.checked = false; 
                    });
                }
                // Si se marca cualquier otra, desmarcar "Ninguna" y "No sabe"
                else if (this.checked) {
                    ninguna.checked = false;
                    if (noSabe) noSabe.checked = false;
                }
            });
        });
    }
    exclusividadCheckboxes('violencia-multiple', 'violencia_ninguna');
    exclusividadCheckboxes('discriminacion-multiple', 'discriminacion_no_hemos', 'discriminacion_no_sabe');

    // Ocultar/mostrar pregunta 18 según la respuesta a la pregunta 17
    const pregunta17Checks = document.querySelectorAll('.violencia-multiple');
    const ninguna = document.getElementById('violencia_ninguna');
    const pregunta18Card = document.getElementById('pregunta18Card');
    const pregunta18Checks = document.querySelectorAll('.institucion-multiple');
    
    // Función para mostrar u ocultar la pregunta 18
    function actualizarVisibilidadPregunta18() {
        if (ninguna.checked) {
            pregunta18Card.style.display = 'none';
            // Desmarcar todas las opciones de la pregunta 18 cuando se oculta
            pregunta18Checks.forEach(check => {
                check.checked = false;
            });
        } else {
            const algunaViolenciaMarcada = Array.from(pregunta17Checks).some(check => 
                check !== ninguna && check.checked
            );
            
            if (algunaViolenciaMarcada) {
                pregunta18Card.style.display = 'block';
            } else {
                pregunta18Card.style.display = 'none';
            }
        }
    }
    
    // Aplicar al cargar la página
    actualizarVisibilidadPregunta18();
    
    // Aplicar cuando cambia cualquier checkbox de la pregunta 17
    pregunta17Checks.forEach(check => {
        check.addEventListener('change', actualizarVisibilidadPregunta18);
    });
});
</script>
@endsection
