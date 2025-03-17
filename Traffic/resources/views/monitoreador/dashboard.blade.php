@extends('adminlte::page')


@section('title', 'Monitor')

@section('content_header')
    <h1>Bienvenido Monitoreador</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Calles y Semáforos</div>
                <div class="card-body">
                    <a href="{{ route('monitoreador.calles') }}" class="btn btn-primary">Ver Calles y Semáforos</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Flujo Vehicular</div>
                <div class="card-body">
                    <a href="{{ route('monitoreador.flujo-vehicular') }}" class="btn btn-primary">Ver Flujo Vehicular</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop