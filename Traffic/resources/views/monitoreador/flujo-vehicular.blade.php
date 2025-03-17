@extends('adminlte::page')

@section('title', 'FlujoVehicular')

@section('content')
<div class="container">
    <h1>Flujo Vehicular</h1>
    <div class="row">
        @foreach ($flujos as $flujo)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Avenida/Calle: {{ $flujo->calle?->nombre }}</div>
                <div class="card-body">
                    <p>Intensidad: {{ $flujo->intensidad }} vehículos/hora</p>
                    <p>Clima: {{ $flujo->clima?->nombre }}</p>
                    <p>Evento: {{ $flujo->evento?->nombre }}</p>
                    <p>Tipo de Automóvil: {{ $flujo->tipo_automovil }}</p>
                    <p>Tiempo de Paso: {{ $flujo->tiempo_paso }} segundos</p>
                </div>
            </div>
            
            <!-- Contenedor de la intersección -->
            <div class="interseccion">
                <!-- Componente de animación -->
                <div class="animacion-vehiculo {{ $flujo->calle?->nombre === 'Principal14' ? 'horizontal' : 'vertical' }}" data-tiempo-paso="{{ $flujo->tiempo_paso }}">
                    <div class="vehiculo" data-delay="0"></div>
                    <div class="vehiculo" data-delay="2"></div>
                    <div class="vehiculo" data-delay="4"></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Script cargado y ejecutándose...');

        const animaciones = document.querySelectorAll('.animacion-vehiculo');

        animaciones.forEach(animacion => {
            const tiempoPaso = parseFloat(animacion.getAttribute('data-tiempo-paso')) || 3;
            const vehiculos = animacion.querySelectorAll('.vehiculo');

            console.log('Tiempo de paso:', tiempoPaso);
            console.log('Vehículos encontrados:', vehiculos.length);

            vehiculos.forEach((vehiculo, index) => {
                // Estilos para los vehículos
                vehiculo.style.width = '30px';
                vehiculo.style.height = '20px';
                vehiculo.style.backgroundColor = 'blue';
                vehiculo.style.position = 'absolute';
                vehiculo.style.left = '-40px';
                vehiculo.style.top = '50%';
                vehiculo.style.transform = 'translateY(-50%)';
                vehiculo.style.borderRadius = '5px';

                const delay = parseFloat(vehiculo.getAttribute('data-delay')) || 0;
                console.log(`Animando vehículo ${index + 1} con delay ${delay}s`);

                if (animacion.classList.contains('horizontal')) {
                    // Animación horizontal para la calle Principal14
                    gsap.to(vehiculo, {
                        duration: tiempoPaso,
                        x: '500px',  // Mueve el vehículo 500px hacia la derecha
                        ease: 'linear',
                        repeat: -1,  // Repetir infinitamente
                        delay: delay,  // Retardo para cada vehículo
                    });
                } else if (animacion.classList.contains('vertical')) {
                    // Animación vertical para la calle Principal16
                    gsap.to(vehiculo, {
                        duration: tiempoPaso,
                        y: '500px',  // Mueve el vehículo 500px hacia abajo
                        ease: 'linear',
                        repeat: -1,  // Repetir infinitamente
                        delay: delay,  // Retardo para cada vehículo
                    });
                }
            });
        });
    });
</script>
@stop

@section('css')
<style>
    .interseccion {
        position: relative;
        width: 100%;
        height: 300px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        overflow: hidden;
    }

    .animacion-vehiculo {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
    }

    .vehiculo {
        position: absolute;
        width: 30px;
        height: 20px;
        background-color: blue;
        border-radius: 5px;
    }

    .horizontal {
        width: 100%;
        height: 20px;
    }

    .vertical {
        width: 20px;
        height: 100%;
    }
</style>
@stop
