@extends('adminlte::page')

@section('title', 'Calles y Semáforos')

@section('content')
<div class="container">
    <h1>Calles y Semáforos</h1>
    
    <!-- Tabla de información de semáforos -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Calle</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Tiempo Verde</th>
                    <th>Tiempo Amarillo</th>
                    <th>Tiempo Rojo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($calles as $calle)
                    @foreach ($calle->semaforos as $semaforo)
                        <tr>
                            <td>{{ $semaforo->id }}</td>
                            <td>{{ $calle->nombre }}</td>
                            <td>{{ $semaforo->direccion }}</td>
                            <td class="estado-semaforo" data-semaforo-id="{{ $semaforo->id }}">{{ ucfirst($semaforo->estado) }}</td>
                            <td class="tiempo-verde" data-semaforo-id="{{ $semaforo->id }}">{{ $semaforo->tiempo_verde }}s</td>
                            <td class="tiempo-amarillo" data-semaforo-id="{{ $semaforo->id }}">{{ $semaforo->tiempo_amarillo }}s</td>
                            <td class="tiempo-rojo" data-semaforo-id="{{ $semaforo->id }}">{{ $semaforo->tiempo_rojo }}s</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Sección de la intersección -->
    <div class="interseccion">
        <div class="calle-vertical"></div>
        <div class="calle-horizontal"></div>

        <!-- Mostrar los semáforos en la intersección -->
        @foreach ($calles as $calle)
            @foreach ($calle->semaforos as $semaforo)
                <div class="semaforo semaforo-{{ $semaforo->id }}" 
                     data-estado="{{ $semaforo->estado }}" 
                     data-semaforo-id="{{ $semaforo->id }}" 
                     data-direccion="{{ $semaforo->direccion }}"
                     data-tiempo-verde="{{ $semaforo->tiempo_verde }}"
                     data-tiempo-amarillo="{{ $semaforo->tiempo_amarillo }}"
                     data-tiempo-rojo="{{ $semaforo->tiempo_rojo }}">
                    <div class="semaforo-luz luz-roja"></div>
                    <div class="semaforo-luz luz-amarilla"></div>
                    <div class="semaforo-luz luz-verde"></div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
@stop

@section('css')
<style>
    .interseccion {
        position: relative;
        width: 300px;
        height: 300px;
        background-color: #ddd;
        margin: auto;
        border: 5px solid black;
    }

    .calle-vertical {
        position: absolute;
        width: 50px;
        height: 100%;
        background-color: gray;
        left: 50%;
        transform: translateX(-50%);
    }

    .calle-horizontal {
        position: absolute;
        height: 50px;
        width: 100%;
        background-color: gray;
        top: 50%;
        transform: translateY(-50%);
    }

    .semaforo {
        position: absolute;
        width: 30px;
        height: 90px;
        background-color: black;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        padding: 5px;
        border-radius: 5px;
    }

    .luz-roja, .luz-amarilla, .luz-verde {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: gray;
    }

    .semaforo[data-estado="rojo"] .luz-roja {
        background-color: red;
    }

    .semaforo[data-estado="amarillo"] .luz-amarilla {
        background-color: yellow;
    }

    .semaforo[data-estado="verde"] .luz-verde {
        background-color: green;
    }

    /* Posiciones de los semáforos */
    .semaforo-1 { top: 10px; left: 45%; }
    .semaforo-2 { bottom: 10px; left: 45%; }
    .semaforo-3 { top: 45%; left: 10px; }
    .semaforo-4 { top: 45%; right: 10px; }
</style>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('Script cargado y ejecutándose...');

    const semaforos = document.querySelectorAll('.semaforo');

    semaforos.forEach(semaforo => {
        let estado = semaforo.getAttribute('data-estado');
        const semaforoID = semaforo.getAttribute('data-semaforo-id');
        const tiempoVerde = parseInt(semaforo.getAttribute('data-tiempo-verde')) * 1000;
        const tiempoAmarillo = parseInt(semaforo.getAttribute('data-tiempo-amarillo')) * 1000;
        const tiempoRojo = parseInt(semaforo.getAttribute('data-tiempo-rojo')) * 1000;
        const estadoTabla = document.querySelector(`.estado-semaforo[data-semaforo-id="${semaforoID}"]`);

        function cambiarEstado() {
            if (estado === 'verde') {
                estado = 'amarillo';
                setTimeout(cambiarEstado, tiempoAmarillo);
            } else if (estado === 'amarillo') {
                estado = 'rojo';
                setTimeout(cambiarEstado, tiempoRojo);
            } else {
                estado = 'verde';
                setTimeout(cambiarEstado, tiempoVerde);
            }

            semaforo.setAttribute('data-estado', estado);

            if (estadoTabla) {
                estadoTabla.textContent = estado.charAt(0).toUpperCase() + estado.slice(1);
            }
        }

        setTimeout(cambiarEstado, tiempoVerde);
    });
});
</script>
@stop
