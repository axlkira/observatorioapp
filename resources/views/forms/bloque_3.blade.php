@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Pestañas de navegación -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('form.show', ['block' => 1, 'tipo_documento' => $tipo_documento, 'numero_documento' => $numero_documento]) }}">Bloque 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('form.show', ['block' => 2, 'tipo_documento' => $tipo_documento, 'numero_documento' => $numero_documento]) }}">Bloque 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Bloque 3</a>
        </li>
    </ul>
    <form id="bloque3Form" method="POST" action="{{ route('form.save', ['block' => 3]) }}">
        @csrf
        <input type="hidden" name="tipo_documento" value="{{ $tipo_documento }}">
        <input type="hidden" name="numero_documento" value="{{ $numero_documento }}">
        <!-- Pregunta 20 -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">20. ¿Cuál es la principal fuente de ingresos de tu núcleo familiar?</div>
            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="fuente_ingreso_formal" id="fuente_ingreso_formal" value="1" {{ old('fuente_ingreso_formal', $registro->fuente_ingreso_formal ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fuente_ingreso_formal">Empleo formal</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="fuente_ingreso_informal" id="fuente_ingreso_informal" value="1" {{ old('fuente_ingreso_informal', $registro->fuente_ingreso_informal ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fuente_ingreso_informal">Empleo informal</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="fuente_ingreso_independiente" id="fuente_ingreso_independiente" value="1" {{ old('fuente_ingreso_independiente', $registro->fuente_ingreso_independiente ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fuente_ingreso_independiente">Independiente</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="fuente_ingreso_apoyo" id="fuente_ingreso_apoyo" value="1" {{ old('fuente_ingreso_apoyo', $registro->fuente_ingreso_apoyo ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fuente_ingreso_apoyo">Apoyo de familiares y amigos</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="fuente_ingreso_pension" id="fuente_ingreso_pension" value="1" {{ old('fuente_ingreso_pension', $registro->fuente_ingreso_pension ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fuente_ingreso_pension">Pensión</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="fuente_ingreso_subsidio" id="fuente_ingreso_subsidio" value="1" {{ old('fuente_ingreso_subsidio', $registro->fuente_ingreso_subsidio ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fuente_ingreso_subsidio">Subsidios del gobierno</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="fuente_ingreso_ninguna" id="fuente_ingreso_ninguna" value="1" {{ old('fuente_ingreso_ninguna', $registro->fuente_ingreso_ninguna ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fuente_ingreso_ninguna">Ninguna</label>
                </div>
            </div>
        </div>
        <!-- Pregunta 21 -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">21. ¿Cuántas personas de tu núcleo familiar cuentan con un ingreso fijo?</div>
            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="personas_ingreso_1" id="personas_ingreso_1" value="1" {{ old('personas_ingreso_1', $registro->personas_ingreso_1 ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="personas_ingreso_1">1 integrante del núcleo familiar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="personas_ingreso_2" id="personas_ingreso_2" value="1" {{ old('personas_ingreso_2', $registro->personas_ingreso_2 ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="personas_ingreso_2">2 integrantes del núcleo familiar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="personas_ingreso_3" id="personas_ingreso_3" value="1" {{ old('personas_ingreso_3', $registro->personas_ingreso_3 ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="personas_ingreso_3">Más de 2 integrantes del núcleo familiar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="personas_ingreso_4" id="personas_ingreso_4" value="1" {{ old('personas_ingreso_4', $registro->personas_ingreso_4 ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="personas_ingreso_4">Ninguno</label>
                </div>
            </div>
        </div>
        <!-- Pregunta 22 -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">22. ¿Considera que los integrantes de tu núcleo familiar tienen un equilibrio entre la vida laboral y familiar para compartir o tener espacios de recreación?</div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="equilibrio_vida" id="equilibrio_vida_si" value="1" {{ old('equilibrio_vida', $registro->equilibrio_vida ?? '') == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="equilibrio_vida_si">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="equilibrio_vida" id="equilibrio_vida_no" value="2" {{ old('equilibrio_vida', $registro->equilibrio_vida ?? '') == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="equilibrio_vida_no">No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="equilibrio_vida" id="equilibrio_vida_no_aplica" value="0" {{ old('equilibrio_vida', $registro->equilibrio_vida ?? '') == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="equilibrio_vida_no_aplica">No aplica</label>
                </div>
            </div>
        </div>
        <!-- Pregunta 23 -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">23. ¿El trabajo interfiere en la capacidad de cuidar a los niños/as, adultos mayores o personas con discapacidad tu núcleo familiar?</div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trabajo_interfiere" id="trabajo_interfiere_si" value="1" {{ old('trabajo_interfiere', $registro->trabajo_interfiere ?? '') == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="trabajo_interfiere_si">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trabajo_interfiere" id="trabajo_interfiere_no" value="2" {{ old('trabajo_interfiere', $registro->trabajo_interfiere ?? '') == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="trabajo_interfiere_no">No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trabajo_interfiere" id="trabajo_interfiere_no_aplica" value="0" {{ old('trabajo_interfiere', $registro->trabajo_interfiere ?? '') == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="trabajo_interfiere_no_aplica">No aplica</label>
                </div>
            </div>
        </div>
        <!-- Pregunta 24 -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">24. Los trabajos de cuidado y domésticos le impiden acceder a tu familia a trabajos remunerados?</div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trabajo_cuidado" id="trabajo_cuidado_totalmente_acuerdo" value="129" {{ old('trabajo_cuidado', $registro->trabajo_cuidado ?? '') == 129 ? 'checked' : '' }}>
                    <label class="form-check-label" for="trabajo_cuidado_totalmente_acuerdo">Totalmente de acuerdo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trabajo_cuidado" id="trabajo_cuidado_acuerdo" value="130" {{ old('trabajo_cuidado', $registro->trabajo_cuidado ?? '') == 130 ? 'checked' : '' }}>
                    <label class="form-check-label" for="trabajo_cuidado_acuerdo">De acuerdo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trabajo_cuidado" id="trabajo_cuidado_neutro" value="131" {{ old('trabajo_cuidado', $registro->trabajo_cuidado ?? '') == 131 ? 'checked' : '' }}>
                    <label class="form-check-label" for="trabajo_cuidado_neutro">Ni de acuerdo, ni en desacuerdo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trabajo_cuidado" id="trabajo_cuidado_desacuerdo" value="132" {{ old('trabajo_cuidado', $registro->trabajo_cuidado ?? '') == 132 ? 'checked' : '' }}>
                    <label class="form-check-label" for="trabajo_cuidado_desacuerdo">En desacuerdo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trabajo_cuidado" id="trabajo_cuidado_totalmente_desacuerdo" value="133" {{ old('trabajo_cuidado', $registro->trabajo_cuidado ?? '') == 133 ? 'checked' : '' }}>
                    <label class="form-check-label" for="trabajo_cuidado_totalmente_desacuerdo">Totalmente en desacuerdo</label>
                </div>
            </div>
        </div>
        <!-- Pregunta 25 -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">25. ¿Cuál es el principal medio a través del cual tu núcleo familiar obtiene los alimentos?</div>
            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="medio_alimentos_almacenes" id="medio_alimentos_almacenes" value="1" {{ old('medio_alimentos_almacenes', $registro->medio_alimentos_almacenes ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="medio_alimentos_almacenes">Compras en almacenes</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="medio_alimentos_bonos_gob" id="medio_alimentos_bonos_gob" value="1" {{ old('medio_alimentos_bonos_gob', $registro->medio_alimentos_bonos_gob ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="medio_alimentos_bonos_gob">Bonos y paquetes alimentarios del gobierno</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="medio_alimentos_bonos_empresa" id="medio_alimentos_bonos_empresa" value="1" {{ old('medio_alimentos_bonos_empresa', $registro->medio_alimentos_bonos_empresa ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="medio_alimentos_bonos_empresa">Bonos de la empresa</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="medio_alimentos_cultivos" id="medio_alimentos_cultivos" value="1" {{ old('medio_alimentos_cultivos', $registro->medio_alimentos_cultivos ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="medio_alimentos_cultivos">Cultivos propios</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="medio_alimentos_redes" id="medio_alimentos_redes" value="1" {{ old('medio_alimentos_redes', $registro->medio_alimentos_redes ?? 2) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="medio_alimentos_redes">Redes comunitarias</label>
                </div>
            </div>
        </div>
        <!-- Pregunta 26 -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">26. ¿Tu núcleo familiar cuenta con algún patrimonio que les permita solventarse ante una eventualidad o crisis?</div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="patrimonio" id="patrimonio_si" value="1" {{ old('patrimonio', $registro->patrimonio ?? '') == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="patrimonio_si">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="patrimonio" id="patrimonio_no" value="2" {{ old('patrimonio', $registro->patrimonio ?? '') == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="patrimonio_no">No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="patrimonio" id="patrimonio_no_sabe" value="44" {{ old('patrimonio', $registro->patrimonio ?? '') == 44 ? 'checked' : '' }}>
                    <label class="form-check-label" for="patrimonio_no_sabe">No sabe</label>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('form.show', ['block' => 2, 'tipo_documento' => $tipo_documento, 'numero_documento' => $numero_documento]) }}" class="btn btn-secondary">Anterior</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // SweetAlert éxito
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Guardado exitosamente!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#0c6efd'
        });
    @endif
    // SweetAlert error
    @if($errors->has('usuario_existente'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first('usuario_existente') }}',
            confirmButtonColor: '#d33'
        });
    @endif
    // Spinner al guardar
    const form = document.getElementById('bloque3Form');
    if (form) {
        form.addEventListener('submit', function(e) {
            Swal.fire({
                title: 'Guardando...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });
        });
    }
});
</script>
@endsection
