@extends('layouts.app')

@section('title', 'Bloque 3: Trabajo Digno')

@section('content')
<div class="container">
    <h2 class="mb-4">Bloque 3: Trabajo Digno</h2>
    <ul class="nav nav-tabs mb-4" id="bloque3TabNav" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque1-tab" href="{{ route('form.show', ['block' => 1, 'tipo_documento' => $tipo_documento, 'numero_documento' => $numero_documento]) }}" role="tab">Bloque 1: Caracterización Familiar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque2-tab" href="{{ route('form.show', ['block' => 2, 'tipo_documento' => $tipo_documento, 'numero_documento' => $numero_documento]) }}" role="tab">Bloque 2: Vida Digna</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="bloque3-tab" data-bs-toggle="tab" href="#bloque3-tab-pane" role="tab" aria-controls="bloque3-tab-pane" aria-selected="true">Bloque 3: Trabajo Digno</a>
        </li>
    </ul>
    <div class="tab-content" id="bloque3TabsContent">
        <div class="tab-pane fade show active" id="bloque3-tab-pane" role="tabpanel" aria-labelledby="bloque3-tab">
            <form method="POST" action="{{ route('form.store') }}" autocomplete="off" id="bloque3Form">
                @csrf
                <input type="hidden" name="block" value="3">
                @if(isset($registro))
                    <input type="hidden" name="es_actualizacion" value="1">
                @endif
                <input type="hidden" name="tipo_documento" value="{{ $tipo_documento }}">
                <input type="hidden" name="numero_documento" value="{{ $numero_documento }}">
                <input type="hidden" name="profesional_documento" value="{{ session('profesional_documento', old('profesional_documento', isset($registro) ? $registro->profesional_documento : '0')) }}">
                <!-- Pregunta 20 -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">20. ¿Cuáles son las fuentes de ingreso de tu núcleo familiar?</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="fuente_empleo_formal" id="fuente_empleo_formal" value="1" {{ old('fuente_empleo_formal', $registro->fuente_empleo_formal ?? 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fuente_empleo_formal">Empleo formal</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="fuente_empleo_informal" id="fuente_empleo_informal" value="1" {{ old('fuente_empleo_informal', $registro->fuente_empleo_informal ?? 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fuente_empleo_informal">Empleo informal</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="fuente_independiente" id="fuente_independiente" value="1" {{ old('fuente_independiente', $registro->fuente_independiente ?? 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fuente_independiente">Independiente</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="fuente_apoyo_familia_amigos" id="fuente_apoyo_familia_amigos" value="1" {{ old('fuente_apoyo_familia_amigos', $registro->fuente_apoyo_familia_amigos ?? 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fuente_apoyo_familia_amigos">Apoyo de familiares y amigos</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="fuente_pension" id="fuente_pension" value="1" {{ old('fuente_pension', $registro->fuente_pension ?? 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fuente_pension">Pensión</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="fuente_subsidios_gobierno" id="fuente_subsidios_gobierno" value="1" {{ old('fuente_subsidios_gobierno', $registro->fuente_subsidios_gobierno ?? 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fuente_subsidios_gobierno">Subsidios del gobierno</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="fuente_ninguna" id="fuente_ninguna" value="1" {{ old('fuente_ninguna', $registro->fuente_ninguna ?? 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fuente_ninguna">Ninguna</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pregunta 21 -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">21. ¿Considera que los integrantes de tu núcleo familiar tienen un equilibrio entre la vida laboral y familiar para compartir o tener espacios de recreación?</div>
                    <div class="card-body">
                        <select class="form-select" name="equilibrio_vida_laboral" required>
                            <option value="">Seleccione...</option>
                            <option value="1" {{ old('equilibrio_vida_laboral', $registro->equilibrio_vida_laboral ?? '') == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('equilibrio_vida_laboral', $registro->equilibrio_vida_laboral ?? '') == 0 ? 'selected' : '' }}>No</option>
                            <option value="145" {{ old('equilibrio_vida_laboral', $registro->equilibrio_vida_laboral ?? '') == 145 ? 'selected' : '' }}>No sabe</option>
                            <option value="59" {{ old('equilibrio_vida_laboral', $registro->equilibrio_vida_laboral ?? '') == 59 ? 'selected' : '' }}>No aplica</option>
                        </select>
                    </div>
                </div>
                <!-- Pregunta 22 -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">22. ¿El trabajo interfiere en la capacidad de cuidar a los niños/as, adultos mayores o personas con discapacidad de tu núcleo familiar?</div>
                    <div class="card-body">
                        <select class="form-select" name="interfiere_cuidado" required>
                            <option value="">Seleccione...</option>
                            <option value="1" {{ old('interfiere_cuidado', $registro->interfiere_cuidado ?? '') == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('interfiere_cuidado', $registro->interfiere_cuidado ?? '') == 0 ? 'selected' : '' }}>No</option>
                            <option value="145" {{ old('interfiere_cuidado', $registro->interfiere_cuidado ?? '') == 145 ? 'selected' : '' }}>No sabe</option>
                            <option value="161" {{ old('interfiere_cuidado', $registro->interfiere_cuidado ?? '') == 161 ? 'selected' : '' }}>No tenemos personas que requieran cuidado</option>
                        </select>
                    </div>
                </div>
                <!-- Pregunta 23 -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">23. ¿Los trabajos de cuidado y domésticos le impiden acceder a tu familia a trabajos remunerados?</div>
                    <div class="card-body">
                        <select class="form-select" name="trabajos_domesticos_impiden" required>
                            <option value="">Seleccione...</option>
                            <option value="1" {{ old('trabajos_domesticos_impiden', $registro->trabajos_domesticos_impiden ?? '') == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('trabajos_domesticos_impiden', $registro->trabajos_domesticos_impiden ?? '') == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                <!-- Pregunta 24 -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">24. ¿Cuál es el principal medio a través del cual tu núcleo familiar obtiene los alimentos?</div>
                    <div class="card-body">
                        <select class="form-select" name="medio_obtencion_alimentos" required>
                            <option value="">Seleccione...</option>
                            <option value="164" {{ old('medio_obtencion_alimentos', $registro->medio_obtencion_alimentos ?? '') == 164 ? 'selected' : '' }}>Compras en almacenes</option>
                            <option value="165" {{ old('medio_obtencion_alimentos', $registro->medio_obtencion_alimentos ?? '') == 165 ? 'selected' : '' }}>Bonos y paquetes alimentarios del gobierno</option>
                            <option value="166" {{ old('medio_obtencion_alimentos', $registro->medio_obtencion_alimentos ?? '') == 166 ? 'selected' : '' }}>Bonos de la empresa</option>
                            <option value="167" {{ old('medio_obtencion_alimentos', $registro->medio_obtencion_alimentos ?? '') == 167 ? 'selected' : '' }}>Cultivos propios</option>
                            <option value="168" {{ old('medio_obtencion_alimentos', $registro->medio_obtencion_alimentos ?? '') == 168 ? 'selected' : '' }}>Redes comunitarias</option>
                        </select>
                    </div>
                </div>

                <!-- Pregunta 25 -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">25. ¿Tu núcleo familiar cuenta con algún patrimonio que les permita solventarse ante una eventualidad o crisis?</div>
                    <div class="card-body">
                        <select class="form-select" name="patrimonio" id="patrimonio" required>
                            <option value="">Seleccione...</option>
                            <option value="1" {{ old('patrimonio', $registro->patrimonio ?? '') == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('patrimonio', $registro->patrimonio ?? '') == 0 ? 'selected' : '' }}>No</option>
                            <option value="145" {{ old('patrimonio', $registro->patrimonio ?? '') == 145 ? 'selected' : '' }}>No sabe</option>
                        </select>
                    </div>
                </div>

                <!-- Pregunta 26 -->
                <div class="card mb-4 shadow-sm" id="pregunta26Card" style="display: none;">
                    <div class="card-header bg-primary text-white">26. Si la respuesta anterior es afirmativa, ¿Por cuánto tiempo dispondrías de ese patrimonio para solventar una eventualidad o crisis?</div>
                    <div class="card-body">
                        <select class="form-select" name="tiempo_patrimonio_crisis" id="tiempo_patrimonio_crisis">
                            <option value="">Seleccione...</option>
                            <option value="172" {{ old('tiempo_patrimonio_crisis', $registro->tiempo_patrimonio_crisis ?? '') == 172 ? 'selected' : '' }}>Tres meses o menos</option>
                            <option value="173" {{ old('tiempo_patrimonio_crisis', $registro->tiempo_patrimonio_crisis ?? '') == 173 ? 'selected' : '' }}>Seis meses</option>
                            <option value="174" {{ old('tiempo_patrimonio_crisis', $registro->tiempo_patrimonio_crisis ?? '') == 174 ? 'selected' : '' }}>Un año</option>
                            <option value="175" {{ old('tiempo_patrimonio_crisis', $registro->tiempo_patrimonio_crisis ?? '') == 175 ? 'selected' : '' }}>Más de un año</option>
                        </select>
                        
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('form.show', ['block' => 2, 'tipo_documento' => $tipo_documento, 'numero_documento' => $numero_documento]) }}" class="btn btn-secondary btn-lg me-2">
                        <i class="bi bi-arrow-left-circle"></i> Anterior
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg me-2">Guardar</button>
                    <button id="btnSiguienteBloque4" type="button" class="btn btn-success btn-lg" {{ !isset($registro) ? 'disabled' : '' }}>
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

    // Mostrar SweetAlert de error si existe error de usuario existente
    @if($errors->has('usuario_existente'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first('usuario_existente') }}',
            confirmButtonColor: '#d33'
        });
    @endif

    // Validación: al menos una fuente de ingreso seleccionada
    const form = document.getElementById('bloque3Form');
    form.addEventListener('submit', function(e) {
        let checks = [
            'fuente_empleo_formal',
            'fuente_empleo_informal',
            'fuente_independiente',
            'fuente_apoyo_familia_amigos',
            'fuente_pension',
            'fuente_subsidios_gobierno',
            'fuente_ninguna'
        ];
        let checkedCount = 0;
        for (let id of checks) {
            if (document.getElementById(id).checked) checkedCount++;
        }
        if (checkedCount === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Campo obligatorio',
                text: 'Debes seleccionar al menos una opción en: 20. ¿Cuáles son las fuentes de ingreso de tu núcleo familiar?',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: true,
                showConfirmButton: true,
                showCancelButton: false,
                showLoaderOnConfirm: false
            });
            return false;
        }
        // Si la validación pasa, mostrar spinner
        Swal.fire({
            title: 'Guardando...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });
    });

    // Lógica: Si seleccionan "Ninguna", desmarcar las demás y viceversa
    let ninguna = document.getElementById('fuente_ninguna');
    let otros = [
        'fuente_empleo_formal',
        'fuente_empleo_informal',
        'fuente_independiente',
        'fuente_apoyo_familia_amigos',
        'fuente_pension',
        'fuente_subsidios_gobierno'
    ];
    ninguna.addEventListener('change', function() {
        if (ninguna.checked) {
            for (let id of otros) document.getElementById(id).checked = false;
        }
    });
    for (let id of otros) {
        document.getElementById(id).addEventListener('change', function() {
            if (this.checked) ninguna.checked = false;
        });
    }

    // Lógica para mostrar/ocultar pregunta 26 según respuesta de pregunta 25
    const patrimonioSelect = document.getElementById('patrimonio');
    const pregunta26Card = document.getElementById('pregunta26Card');
    const tiempoPatrimonioCrisisSelect = document.getElementById('tiempo_patrimonio_crisis');
    
    // Función para actualizar la visibilidad y comportamiento de la pregunta 26
    function actualizarPregunta26() {
        if (patrimonioSelect.value === '1') {
            pregunta26Card.style.display = 'block';
            tiempoPatrimonioCrisisSelect.required = true;
            // No establecemos valor por defecto, debe ser elegido por el usuario
        } else {
            pregunta26Card.style.display = 'none';
            tiempoPatrimonioCrisisSelect.required = false;
            tiempoPatrimonioCrisisSelect.value = '3'; // Valor por defecto cuando no se muestra
        }
    }
    
    // Verificar estado inicial al cargar la página
    actualizarPregunta26();
    
    // Escuchar cambios en la selección
    patrimonioSelect.addEventListener('change', actualizarPregunta26);

    // Lógica para el botón Siguiente
    const btnSiguiente = document.getElementById('btnSiguienteBloque4');
    @if(isset($registro))
        btnSiguiente.disabled = false;
        btnSiguiente.addEventListener('click', function() {
            const tipo_documento = '{{ $registro->tipo_documento ?? $tipo_documento }}';
            const numero_documento = '{{ $registro->numero_documento ?? $numero_documento }}';
            // Construye la URL relativa correcta
            window.location.href = "/observatorioapp/public/form/4/" + tipo_documento + "/" + numero_documento;
        });
    @else
        btnSiguiente.disabled = true;
    @endif
});
</script>
@endsection
