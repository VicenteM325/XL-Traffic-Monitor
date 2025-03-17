@extends('layouts.app')

@section('content')
    <h1>Dashboard del Monitoreador</h1>
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
@endsection