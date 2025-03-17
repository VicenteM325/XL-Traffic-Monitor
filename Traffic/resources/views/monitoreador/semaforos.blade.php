@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Configuración de Semáforos</h1>
    @foreach ($semaforos as $semaforo)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Semáforo en {{ $semaforo->calle->nombre }}</h5>
            <p id="semaforo-{{ $semaforo->id }}">
                Verde: {{ $semaforo->tiempo_verde }}s,
                Amarillo: {{ $semaforo->tiempo_amarillo }}s,
                Rojo: {{ $semaforo->tiempo_rojo }}s
            </p>
            <form class="form-actualizar-tiempo" data-semaforo-id="{{ $semaforo->id }}">
                @csrf
                <div class="form-group">
                    <label for="tiempo_verde">Tiempo Verde (segundos):</label>
                    <input type="number" name="tiempo_verde" class="form-control" value="{{ $semaforo->tiempo_verde }}" required>
                </div>
                <div class="form-group">
                    <label for="tiempo_amarillo">Tiempo Amarillo (segundos):</label>
                    <input type="number" name="tiempo_amarillo" class="form-control" value="{{ $semaforo->tiempo_amarillo }}" required>
                </div>
                <div class="form-group">
                    <label for="tiempo_rojo">Tiempo Rojo (segundos):</label>
                    <input type="number" name="tiempo_rojo" class="form-control" value="{{ $semaforo->tiempo_rojo }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Tiempo</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<script>
    document.querySelectorAll('.form-actualizar-tiempo').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const semaforoId = this.getAttribute('data-semaforo-id');
            const formData = new FormData(this);

            fetch(`/monitoreador/semaforos/${semaforoId}/actualizar-tiempo`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Recargar la página para reflejar los cambios
                window.location.reload();
            });
        });
    });
</script>
@endsection