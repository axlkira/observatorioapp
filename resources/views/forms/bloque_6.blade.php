@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-tabs mb-4" id="bloque6TabNav" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque1-tab" href="{{ route('form.show', ['block' => 1, 'tipo_documento' => request('tipo_documento'), 'numero_documento' => request('numero_documento')]) }}" role="tab">Bloque 1: Caracterización Familiar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque2-tab" href="{{ route('form.show', ['block' => 2, 'tipo_documento' => request('tipo_documento'), 'numero_documento' => request('numero_documento')]) }}" role="tab">Bloque 2: Vida Digna</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque3-tab" href="{{ route('form.show', ['block' => 3, 'tipo_documento' => request('tipo_documento'), 'numero_documento' => request('numero_documento')]) }}" role="tab">Bloque 3: Trabajo Digno</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque4-tab" href="{{ route('form.show', ['block' => 4, 'tipo_documento' => request('tipo_documento'), 'numero_documento' => request('numero_documento')]) }}" role="tab">Bloque 4: Salud y Bienestar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque5-tab" href="{{ route('form.show', ['block' => 5, 'tipo_documento' => request('tipo_documento'), 'numero_documento' => request('numero_documento')]) }}" role="tab">Bloque 5: Protección</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="bloque6-tab" data-bs-toggle="tab" href="#bloque6-tab-pane" role="tab" aria-controls="bloque6-tab-pane" aria-selected="true">Bloque 6: Respeto y Comunicación</a>
        </li>
    </ul>
    <div class="tab-content" id="bloque6TabsContent">
        <div class="tab-pane fade show active" id="bloque6-tab-pane" role="tabpanel" aria-labelledby="bloque6-tab">
            <div class="container">
                <h2 class="mb-4">Bloque 6: Respeto y Comunicación</h2>
                <form method="POST" action="{{ route('form.store') }}" autocomplete="off" id="bloque6Form">
                    @csrf
                    <input type="hidden" name="block" value="6">
                    <input type="hidden" name="tipo_documento" value="{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}">
                    <input type="hidden" name="numero_documento" value="{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}">
                    <input type="hidden" name="profesional_documento" value="{{ session('profesional_documento', old('profesional_documento', isset($registro) ? $registro->profesional_documento : '0')) }}">
                    @if(isset($registro))
                        <input type="hidden" name="es_actualizacion" value="1">
                    @endif
                    <!-- Pregunta 39 -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">34. ¿Con qué frecuencia en tu núcleo familiar comparten comidas juntos?</div>
                        <div class="card-body">
                            <select class="form-select" name="p39_frecuencia_comidas" required>
                                <option value="">Seleccione...</option>
                                <option value="215" {{ old('p39_frecuencia_comidas', $registro->p39_frecuencia_comidas ?? '') == 215 ? 'selected' : '' }}>Siempre</option>
                                <option value="216" {{ old('p39_frecuencia_comidas', $registro->p39_frecuencia_comidas ?? '') == 216 ? 'selected' : '' }}>Casi siempre</option>
                                <option value="217" {{ old('p39_frecuencia_comidas', $registro->p39_frecuencia_comidas ?? '') == 217 ? 'selected' : '' }}>Algunas veces</option>
                                <option value="218" {{ old('p39_frecuencia_comidas', $registro->p39_frecuencia_comidas ?? '') == 218 ? 'selected' : '' }}>Casi nunca</option>
                                <option value="219" {{ old('p39_frecuencia_comidas', $registro->p39_frecuencia_comidas ?? '') == 219 ? 'selected' : '' }}>Nunca</option>
                                <option value="220" {{ old('p39_frecuencia_comidas', $registro->p39_frecuencia_comidas ?? '') == 220 ? 'selected' : '' }}>No aplica</option>
                            </select>
                        </div>
                    </div>
                    <!-- Pregunta 33 -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">35. ¿En tu núcleo familiar cuentan con acceso a métodos anticonceptivos para la planificación familiar?</div>
                        <div class="card-body">
                            <select class="form-select" name="p33_acceso_metodos_anticonceptivos" required>
                                <option value="">Seleccione...</option>
                                <option value="221" {{ old('p33_acceso_metodos_anticonceptivos', $registro->p33_acceso_metodos_anticonceptivos ?? '') == 221 ? 'selected' : '' }}>Sí, contamos con acceso suficiente y sin dificultades</option>
                                <option value="222" {{ old('p33_acceso_metodos_anticonceptivos', $registro->p33_acceso_metodos_anticonceptivos ?? '') == 222 ? 'selected' : '' }}>Sí, pero con algunas limitaciones</option>
                                <option value="223" {{ old('p33_acceso_metodos_anticonceptivos', $registro->p33_acceso_metodos_anticonceptivos ?? '') == 223 ? 'selected' : '' }}>No, por falta de información</option>
                                <option value="224" {{ old('p33_acceso_metodos_anticonceptivos', $registro->p33_acceso_metodos_anticonceptivos ?? '') == 224 ? 'selected' : '' }}>No, por barreras económicas o de acceso</option>
                                <option value="225" {{ old('p33_acceso_metodos_anticonceptivos', $registro->p33_acceso_metodos_anticonceptivos ?? '') == 225 ? 'selected' : '' }}>No, por razones personales, culturales o religiosas</option>
                                <option value="226" {{ old('p33_acceso_metodos_anticonceptivos', $registro->p33_acceso_metodos_anticonceptivos ?? '') == 226 ? 'selected' : '' }}>No sabe</option>
                            </select>
                        </div>
                    </div>
                    <!-- Pregunta 34 (opción múltiple) -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">36. ¿Entre cuáles integrantes de tu núcleo familiar se han presentado dificultades/tensiones generacionales respecto a la formación y educación? (Opción múltiple)</div>
                        <div class="card-body">
                            @php
                                $p34 = [
                                    'p34_ninos_adolescentes_adultos' => old('p34_ninos_adolescentes_adultos', $registro->p34_ninos_adolescentes_adultos ?? 0),
                                    'p34_ninos_adolescentes_adultos_mayores' => old('p34_ninos_adolescentes_adultos_mayores', $registro->p34_ninos_adolescentes_adultos_mayores ?? 0),
                                    'p34_jovenes_adultos' => old('p34_jovenes_adultos', $registro->p34_jovenes_adultos ?? 0),
                                    'p34_jovenes_adultos_mayores' => old('p34_jovenes_adultos_mayores', $registro->p34_jovenes_adultos_mayores ?? 0),
                                    'p34_adultos_adultos_mayores' => old('p34_adultos_adultos_mayores', $registro->p34_adultos_adultos_mayores ?? 0),
                                    'p34_nunca' => old('p34_nunca', $registro->p34_nunca ?? 0),
                                    'p34_no_sabe' => old('p34_no_sabe', $registro->p34_no_sabe ?? 0),
                                    'p34_no_aplica' => old('p34_no_aplica', $registro->p34_no_aplica ?? 0),
                                ];
                            @endphp
                            <div class="form-check form-switch">
                                <input class="form-check-input p34-switch" type="checkbox" name="p34_ninos_adolescentes_adultos" id="p34_ninos_adolescentes_adultos" value="1" {{ $p34['p34_ninos_adolescentes_adultos'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="p34_ninos_adolescentes_adultos">Niños/as, adolescentes y adultos</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input p34-switch" type="checkbox" name="p34_ninos_adolescentes_adultos_mayores" id="p34_ninos_adolescentes_adultos_mayores" value="1" {{ $p34['p34_ninos_adolescentes_adultos_mayores'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="p34_ninos_adolescentes_adultos_mayores">Niños/as, adolescentes y adultos mayores</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input p34-switch" type="checkbox" name="p34_jovenes_adultos" id="p34_jovenes_adultos" value="1" {{ $p34['p34_jovenes_adultos'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="p34_jovenes_adultos">Jóvenes y adultos</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input p34-switch" type="checkbox" name="p34_jovenes_adultos_mayores" id="p34_jovenes_adultos_mayores" value="1" {{ $p34['p34_jovenes_adultos_mayores'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="p34_jovenes_adultos_mayores">Jóvenes y adultos mayores</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input p34-switch" type="checkbox" name="p34_adultos_adultos_mayores" id="p34_adultos_adultos_mayores" value="1" {{ $p34['p34_adultos_adultos_mayores'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="p34_adultos_adultos_mayores">Adultos y adultos mayores</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input p34-switch" type="checkbox" name="p34_nunca" id="p34_nunca" value="1" {{ $p34['p34_nunca'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="p34_nunca">Nunca se ha presentado</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input p34-switch" type="checkbox" name="p34_no_sabe" id="p34_no_sabe" value="1" {{ $p34['p34_no_sabe'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="p34_no_sabe">No sabe</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input p34-switch" type="checkbox" name="p34_no_aplica" id="p34_no_aplica" value="1" {{ $p34['p34_no_aplica'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="p34_no_aplica">No aplica</label>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Checkboxes exclusivos (No aplica, No sabe, Nunca se ha presentado)
                                    const exclusiveCheckboxes = [
                                        document.getElementById('p34_no_aplica'),
                                        document.getElementById('p34_no_sabe'),
                                        document.getElementById('p34_nunca')
                                    ];
                                    
                                    // Checkboxes de opciones regulares
                                    const regularCheckboxes = [
                                        document.getElementById('p34_ninos_adolescentes_adultos'),
                                        document.getElementById('p34_ninos_adolescentes_adultos_mayores'),
                                        document.getElementById('p34_jovenes_adultos'),
                                        document.getElementById('p34_jovenes_adultos_mayores'),
                                        document.getElementById('p34_adultos_adultos_mayores')
                                    ];
                                    
                                    // Función para manejar cuando se marca un checkbox exclusivo
                                    function handleExclusiveCheckbox(checkedIndex) {
                                        // Desmarcar todos los checkboxes regulares
                                        regularCheckboxes.forEach(checkbox => {
                                            checkbox.checked = false;
                                        });
                                        
                                        // Desmarcar otros checkboxes exclusivos
                                        exclusiveCheckboxes.forEach((checkbox, index) => {
                                            if (index !== checkedIndex) {
                                                checkbox.checked = false;
                                            }
                                        });
                                    }
                                    
                                    // Función para manejar cuando se marca un checkbox regular
                                    function handleRegularCheckbox() {
                                        // Desmarcar todos los checkboxes exclusivos
                                        exclusiveCheckboxes.forEach(checkbox => {
                                            checkbox.checked = false;
                                        });
                                    }
                                    
                                    // Agregar event listeners a checkboxes exclusivos
                                    exclusiveCheckboxes.forEach((checkbox, index) => {
                                        checkbox.addEventListener('change', function() {
                                            if (this.checked) {
                                                handleExclusiveCheckbox(index);
                                            }
                                        });
                                    });
                                    
                                    // Agregar event listeners a checkboxes regulares
                                    regularCheckboxes.forEach(checkbox => {
                                        checkbox.addEventListener('change', function() {
                                            if (this.checked) {
                                                handleRegularCheckbox();
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <!-- Pregunta 35 -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">37. ¿En tu núcleo familiar han recibido orientación o asesoría sobre relaciones familiares a través de instituciones de salud, educativas, religiosas o programas comunitarios?</div>
                        <div class="card-body">
                            <select class="form-select" name="p35_orientacion_asesoria" required>
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('p35_orientacion_asesoria', $registro->p35_orientacion_asesoria ?? '') == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('p35_orientacion_asesoria', $registro->p35_orientacion_asesoria ?? '') == 0 ? 'selected' : '' }}>No</option>
                                <option value="145" {{ old('p35_orientacion_asesoria', $registro->p35_orientacion_asesoria ?? '') == 145 ? 'selected' : '' }}>No sabe</option>
                                <option value="59" {{ old('p35_orientacion_asesoria', $registro->p35_orientacion_asesoria ?? '') == 59 ? 'selected' : '' }}>No aplica</option>
                            </select>
                        </div>
                    </div>
                    <!-- Pregunta 36 -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">38. ¿Cómo describirías la calidad de la comunicación dentro de tu núcleo familiar?</div>
                        <div class="card-body">
                            <select class="form-select" name="p36_calidad_comunicacion" required>
                                <option value="">Seleccione...</option>
                                <option value="240" {{ old('p36_calidad_comunicacion', $registro->p36_calidad_comunicacion ?? '') == 240 ? 'selected' : '' }}>Fluida y efectiva</option>
                                <option value="241" {{ old('p36_calidad_comunicacion', $registro->p36_calidad_comunicacion ?? '') == 241 ? 'selected' : '' }}>Buena, pero con áreas de mejora</option>
                                <option value="242" {{ old('p36_calidad_comunicacion', $registro->p36_calidad_comunicacion ?? '') == 242 ? 'selected' : '' }}>Intermitente y poco clara</option>
                                <option value="243" {{ old('p36_calidad_comunicacion', $registro->p36_calidad_comunicacion ?? '') == 243 ? 'selected' : '' }}>Tensa o conflictiva</option>
                                <option value="244" {{ old('p36_calidad_comunicacion', $registro->p36_calidad_comunicacion ?? '') == 244 ? 'selected' : '' }}>Limitada o inexistente</option>
                                <option value="245" {{ old('p36_calidad_comunicacion', $registro->p36_calidad_comunicacion ?? '') == 245 ? 'selected' : '' }}>Mala, no hay comunicación</option>
                                <option value="246" {{ old('p36_calidad_comunicacion', $registro->p36_calidad_comunicacion ?? '') == 246 ? 'selected' : '' }}>No aplica</option>
                            </select>
                        </div>
                    </div>
                    <!-- Pregunta 37 -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">39. ¿Cuál es el principal medio de comunicación en tu núcleo familiar?</div>
                        <div class="card-body">
                            <select class="form-select" name="p37_medio_comunicacion" required>
                                <option value="">Seleccione...</option>
                                <option value="247" {{ old('p37_medio_comunicacion', $registro->p37_medio_comunicacion ?? '') == 247 ? 'selected' : '' }}>Medios digitales (grupos de whatsapp, correos, llamadas, redes sociales)</option>
                                <option value="248" {{ old('p37_medio_comunicacion', $registro->p37_medio_comunicacion ?? '') == 248 ? 'selected' : '' }}>Reuniones familiares presenciales</option>
                                <option value="249" {{ old('p37_medio_comunicacion', $registro->p37_medio_comunicacion ?? '') == 249 ? 'selected' : '' }}>Notas escritas en papel</option>
                                <option value="250" {{ old('p37_medio_comunicacion', $registro->p37_medio_comunicacion ?? '') == 250 ? 'selected' : '' }}>Comunicación verbal entre los integrantes</option>
                                <option value="251" {{ old('p37_medio_comunicacion', $registro->p37_medio_comunicacion ?? '') == 251 ? 'selected' : '' }}>Por ningún medio</option>
                                <option value="252" {{ old('p37_medio_comunicacion', $registro->p37_medio_comunicacion ?? '') == 252 ? 'selected' : '' }}>No aplica</option>
                            </select>
                        </div>
                    </div>
                    <!-- Pregunta 38 -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">40.¿Cuál de los siguientes impactos crees que ha tenido el uso de la tecnología en las dinámicas de tu núcleo familiar?</div>
                        <div class="card-body">
                            <select class="form-select" name="p38_impacto_tecnologia" required>
                                <option value="">Seleccione...</option>
                                <option value="253" {{ old('p38_impacto_tecnologia', $registro->p38_impacto_tecnologia ?? '') == 253 ? 'selected' : '' }}>Positivo, ha mejorado las relaciones</option>
                                <option value="254" {{ old('p38_impacto_tecnologia', $registro->p38_impacto_tecnologia ?? '') == 254 ? 'selected' : '' }}>Neutro, la dinámica se ha mantenido estable</option>
                                <option value="255" {{ old('p38_impacto_tecnologia', $registro->p38_impacto_tecnologia ?? '') == 255 ? 'selected' : '' }}>Negativo, ha causado conflictos</option>
                                <option value="256" {{ old('p38_impacto_tecnologia', $registro->p38_impacto_tecnologia ?? '') == 256 ? 'selected' : '' }}>Ninguno de los anteriores</option>
                                <option value="59" {{ old('p38_impacto_tecnologia', $registro->p38_impacto_tecnologia ?? '') == 59 ? 'selected' : '' }}>No aplica</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-end">
                        <a href="/observatorioapp/public/form/5/{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}/{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}" class="btn btn-secondary btn-lg me-2">
                            <i class="bi bi-arrow-left-circle"></i> Anterior
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg me-2" id="guardarBtn">Guardar</button>
                        <a href="/observatorioapp/public/form/7/{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}/{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}"
                           id="siguienteBtn"
                           class="btn btn-success btn-lg"
                           @if(!isset($registro)) disabled style="pointer-events: none; opacity: 0.6;" @endif>
                            Siguiente <i class="bi bi-arrow-right-circle"></i>
                        </a>
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

    // VALIDACIÓN ESTRICTA AL ENVIAR EL FORMULARIO
    const form = document.getElementById('bloque6Form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Pregunta 33
            const p33 = document.querySelector('[name="p33_acceso_metodos_anticonceptivos"]');
            if (!p33.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Debes seleccionar una opción en la pregunta 33.',
                    confirmButtonColor: '#7c3aed',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    showLoaderOnConfirm: false
                });
                p33.focus();
                return;
            }
            // Pregunta 34 (opción múltiple)
            const p34Checks = document.querySelectorAll('.p34-switch');
            let p34Marcada = false;
            p34Checks.forEach(chk => { if (chk.checked) p34Marcada = true; });
            if (!p34Marcada) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo obligatorio',
                    text: 'Debes seleccionar al menos una opción en la pregunta 34.',
                    confirmButtonColor: '#7c3aed',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    showLoaderOnConfirm: false
                });
                p34Checks[0].focus();
                return;
            }
            // Pregunta 35
            const p35 = document.querySelector('[name="p35_orientacion_asesoria"]');
            if (!p35.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Debes seleccionar una opción en la pregunta 35.',
                    confirmButtonColor: '#7c3aed',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    showLoaderOnConfirm: false
                });
                p35.focus();
                return;
            }
            // Pregunta 36
            const p36 = document.querySelector('[name="p36_calidad_comunicacion"]');
            if (!p36.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Debes seleccionar una opción en la pregunta 36.',
                    confirmButtonColor: '#7c3aed',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    showLoaderOnConfirm: false
                });
                p36.focus();
                return;
            }
            // Pregunta 37
            const p37 = document.querySelector('[name="p37_medio_comunicacion"]');
            if (!p37.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Debes seleccionar una opción en la pregunta 37.',
                    confirmButtonColor: '#7c3aed',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    showLoaderOnConfirm: false
                });
                p37.focus();
                return;
            }
            // Pregunta 38
            const p38 = document.querySelector('[name="p38_impacto_tecnologia"]');
            if (!p38.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Debes seleccionar una opción en la pregunta 38.',
                    confirmButtonColor: '#7c3aed',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    showLoaderOnConfirm: false
                });
                p38.focus();
                return;
            }
            // Pregunta 39
            const p39 = document.querySelector('[name="p39_frecuencia_comidas"]');
            if (!p39.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Debes seleccionar una opción en la pregunta 39.',
                    confirmButtonColor: '#7c3aed',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    showLoaderOnConfirm: false
                });
                p39.focus();
                return;
            }
            // Si todas las validaciones pasan, mostrar spinner y permitir submit
            Swal.fire({
                title: 'Guardando...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    }

    // Exclusividad de switches en pregunta 34 (opción múltiple)
    function exclusividadP34() {
        const checkboxes = document.querySelectorAll('.p34-switch');
        const nunca = document.getElementById('p34_nunca');
        const noaplica = document.getElementById('p34_no_aplica');
        checkboxes.forEach(chk => {
            chk.addEventListener('change', function() {
                if (this.checked && (this.id == 'p34_nunca' || this.id == 'p34_no_aplica')) {
                    checkboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                } else if (this.checked) {
                    nunca.checked = false;
                    noaplica.checked = false;
                }
            });
        });
    }
    exclusividadP34();

    // Activar botón Siguiente si hay registro guardado
    const siguienteBtn = document.getElementById('siguienteBtn');
    @if(isset($registro))
        if (siguienteBtn) {
            siguienteBtn.removeAttribute('disabled');
            siguienteBtn.style.pointerEvents = 'auto';
            siguienteBtn.style.opacity = '1';
        }
    @endif
});
</script>
@endsection
