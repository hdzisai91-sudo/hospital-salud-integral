@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">👁️ Detalle de Solicitud</h2>

    <div class="card p-3 shadow">

        <p><strong>ID:</strong> {{ $solicitud->id }}</p>
        <p><strong>Título:</strong> {{ $solicitud->titulo }}</p>
        <p><strong>Área:</strong> {{ $solicitud->area }}</p>
        <p><strong>Prioridad:</strong> {{ $solicitud->prioridad }}</p>
        <p><strong>Estado:</strong> {{ $solicitud->estado }}</p>
        <p><strong>Fecha:</strong> {{ $solicitud->created_at }}</p>

    </div>

</div>

@endsection