@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-tabs mb-4" id="bloque8TabNav" role="tablist">
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
            <a class="nav-link" id="bloque6-tab" href="{{ route('form.show', ['block' => 6, 'tipo_documento' => request('tipo_documento'), 'numero_documento' => request('numero_documento')]) }}" role="tab">Bloque 6: Respeto y Comunicación</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bloque7-tab" href="{{ route('form.show', ['block' => 7, 'tipo_documento' => request('tipo_documento'), 'numero_documento' => request('numero_documento')]) }}" role="tab">Bloque 7: Participación</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="bloque8-tab" data-bs-toggle="tab" href="#bloque8-tab-pane" role="tab" aria-controls="bloque8-tab-pane" aria-selected="true">Bloque 8: Representación</a>
        </li>
    </ul>
    <div class="tab-content" id="bloque8TabsContent">
        <div class="tab-pane fade show active" id="bloque8-tab-pane" role="tabpanel" aria-labelledby="bloque8-tab">
            <div class="container">
                <h2 class="mb-4">Bloque 8: Representación</h2>
                <form method="POST" action="{{ route('form.store') }}" autocomplete="off" id="bloque8Form">
                    @csrf
                    <input type="hidden" name="block" value="8">
                    <input type="hidden" name="tipo_documento" value="{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}">
                    <input type="hidden" name="numero_documento" value="{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}">
                    <input type="hidden" name="profesional_documento" value="{{ session('profesional_documento', old('profesional_documento', isset($registro) ? $registro->profesional_documento : '0')) }}">
                    @if(isset($registro))
                        <input type="hidden" name="es_actualizacion" value="1">
                    @endif
                    <!-- Pregunta 44 -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">44. Al momento de tomar decisiones en tu núcleo familiar ¿quiénes participan?</div>
                        <div class="card-body">
                            <select class="form-select" name="p44_participacion_decisiones" required>
                                <option value="">Seleccione...</option>
                                <option value="266" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 266 ? 'selected' : '' }}>1. Pareja</option>
                                <option value="267" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 267 ? 'selected' : '' }}>2. Madre y Padre</option>
                                <option value="268" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 268 ? 'selected' : '' }}>3. Madre</option>
                                <option value="269" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 269 ? 'selected' : '' }}>4. Padre</option>
                                <option value="270" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 270 ? 'selected' : '' }}>5. Hijos/as</option>
                                <option value="271" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 271 ? 'selected' : '' }}>6. Abuelos/as</option>
                                <option value="272" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 272 ? 'selected' : '' }}>7. Todos los integrantes de la familia</option>
                                <option value="273" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 273 ? 'selected' : '' }}>8. Solo yo (Hogar unipersonal)</option>
                                <option value="274" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 274 ? 'selected' : '' }}>9. Hermanos/as</option>
                                <option value="275" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 275 ? 'selected' : '' }}>10. Amigos/as</option>
                                <option value="276" {{ old('p44_participacion_decisiones', $registro->p44_participacion_decisiones ?? '') == 276 ? 'selected' : '' }}>11. Otros familiares</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="/observatorioapp/public/form/7/{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}/{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}" class="btn btn-secondary btn-lg me-2">
                            <i class="bi bi-arrow-left-circle"></i> Anterior
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg me-2" id="guardarBtn">Guardar</button>
                        <a href="/observatorioapp/public/form/9/{{ $registro->tipo_documento ?? request('tipo_documento', request()->route('tipo_documento')) }}/{{ $registro->numero_documento ?? request('numero_documento', request()->route('numero_documento')) }}"
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
    // Activar botón Siguiente si hay registro guardado
    const siguienteBtn = document.getElementById('siguienteBtn');
    @if(isset($registro))
        if (siguienteBtn) {
            siguienteBtn.removeAttribute('disabled');
            siguienteBtn.style.pointerEvents = 'auto';
            siguienteBtn.style.opacity = '1';
        }
    @endif

    // SweetAlert de éxito
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Guardado exitosamente!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#0c6efd'
        });
    @endif

    // SweetAlert de error si existe error de usuario existente
    @if($errors->has('usuario_existente'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first('usuario_existente') }}',
            confirmButtonColor: '#d33'
        });
    @endif

    // Spinner SweetAlert al guardar
    const form = document.getElementById('bloque8Form');
    if (form) {
        form.addEventListener('submit', function(e) {
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
});
</script>
@endsection
