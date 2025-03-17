@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Calles y Semáforos</h1>
    <div class="row">
        @foreach ($calles as $calle)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">{{ $calle->nombre }}</div>
                <div class="card-body">
                    <!-- Contenedor de la animación del flujo vehicular -->
                    <div class="animacion-flujo" data-calle-id="{{ $calle->id }}">
                        <div class="flujo-vehicular" data-direccion="norte"></div> <!-- Dirección estática -->
                    </div>

                    <!-- Semáforos asociados a esta calle -->
                    @foreach ($calle->semaforos as $semaforo)
                    <div class="semaforo" data-estado="{{ $semaforo->estado }}" data-semaforo-id="{{ $semaforo->id }}" data-direccion="norte"> <!-- Dirección estática -->
                        <h5>Semáforo {{ $semaforo->id }}</h5>
                        <div class="semaforo-luz luz-roja"></div>
                        <div class="semaforo-luz luz-amarilla"></div>
                        <div class="semaforo-luz luz-verde"></div>
                        <p>Tiempo Verde: {{ $semaforo->tiempo_verde }}s</p>
                        <p>Tiempo Amarillo: {{ $semaforo->tiempo_amarillo }}s</p>
                        <p>Tiempo Rojo: {{ $semaforo->tiempo_rojo }}s</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
    .semaforo {
        text-align: center;
        margin-bottom: 20px;
    }
    .semaforo-luz {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin: 10px auto;
        opacity: 0.3;
    }
    .luz-roja { background-color: red; }
    .luz-amarilla { background-color: yellow; }
    .luz-verde { background-color: green; }
    .semaforo[data-estado="rojo"] .luz-roja { opacity: 1; }
    .semaforo[data-estado="amarillo"] .luz-amarilla { opacity: 1; }
    .semaforo[data-estado="verde"] .luz-verde { opacity: 1; }

    .animacion-flujo {
        width: 100%;
        height: 40px;
        background-color: lightgray;
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .flujo-vehicular {
        width: 30px;
        height: 20px;
        background-color: blue;
        position: absolute;
        left: -40px;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 5px;
    }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Script cargado y ejecutándose...');

        const semaforos = document.querySelectorAll('.semaforo');
        const flujos = document.querySelectorAll('.flujo-vehicular');

        console.log('Número de semáforos encontrados:', semaforos.length);
        console.log('Número de flujos vehiculares encontrados:', flujos.length);

        semaforos.forEach(semaforo => {
            const estado = semaforo.getAttribute('data-estado');
            const tiempoVerde = parseInt(semaforo.querySelector('p:nth-of-type(1)').textContent.replace('Tiempo Verde: ', '').replace('s', ''));
            const tiempoAmarillo = parseInt(semaforo.querySelector('p:nth-of-type(2)').textContent.replace('Tiempo Amarillo: ', '').replace('s', ''));
            const tiempoRojo = parseInt(semaforo.querySelector('p:nth-of-type(3)').textContent.replace('Tiempo Rojo: ', '').replace('s', ''));

            console.log(`Semáforo ${semaforo.getAttribute('data-semaforo-id')} - Estado: ${estado}`);
            console.log(`Tiempo Verde: ${tiempoVerde}s, Tiempo Amarillo: ${tiempoAmarillo}s, Tiempo Rojo: ${tiempoRojo}s`);

            setInterval(() => {
                const estadoActual = semaforo.getAttribute('data-estado');
                let nuevoEstado;

                if (estadoActual === 'verde') {
                    nuevoEstado = 'amarillo';
                } else if (estadoActual === 'amarillo') {
                    nuevoEstado = 'rojo';
                } else {
                    nuevoEstado = 'verde';
                }

                semaforo.setAttribute('data-estado', nuevoEstado);
                console.log(`Semáforo ${semaforo.getAttribute('data-semaforo-id')} cambió a ${nuevoEstado}`);
            }, estado === 'verde' ? tiempoVerde * 1000 : estado === 'amarillo' ? tiempoAmarillo * 1000 : tiempoRojo * 1000);
        });

        flujos.forEach(flujo => {
            const direccion = flujo.getAttribute('data-direccion');  // Dirección estática
            const semaforoAsociado = document.querySelector(`.semaforo[data-direccion="${direccion}"]`);

            if (semaforoAsociado) {
                const animacion = gsap.to(flujo, {
                    x: '100%',
                    duration: 5,
                    repeat: -1,
                    ease: 'linear',
                    paused: true,
                });

                semaforoAsociado.addEventListener('cambioEstado', (e) => {
                    if (e.detail.estado === 'verde') {
                        animacion.play();
                        console.log(`Flujo vehicular en dirección ${direccion} iniciado.`);
                    } else {
                        animacion.pause();
                        console.log(`Flujo vehicular en dirección ${direccion} pausado.`);
                    }
                });
            } else {
                console.error(`No se encontró el semáforo asociado a la dirección ${direccion}.`);
            }
        });
    });
</script>
@endpush
