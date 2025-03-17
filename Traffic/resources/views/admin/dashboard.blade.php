@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Welcome Administradorr</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
      <a href="{{ route('register') }}" class="btn btn-primary">Registrar Nuevo Usuario</a>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop