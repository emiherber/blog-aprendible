
@extends('admin.layout')

@section('contenido')

<h1>dashboard</h1>
<p>Usuario autenticado: {{ Auth()->user()->email }}</p>

@stop