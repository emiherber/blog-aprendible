@extends('layout.layout')

@section('contenido')
<section class="pages container">
    <div class="page page-about">
        <h1 class="text-capitalize">Página no autorizada</h1>
        <p>{{ $exception->getMessage() }}</p>
        <p><a href="{{ url()->previous() }}">Regresar</a></p>
    </div>
</section>
@stop