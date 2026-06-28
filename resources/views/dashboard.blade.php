@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">🏥 Dashboard</h2>

    <!-- TARJETAS RESUMEN -->
    <div class="row mb-4">

        <!-- TOTAL -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5>Total Solicitudes</h5>
                    <h2>{{ $totalSolicitudes ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- PENDIENTES -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5>Pendientes</h5>
                    <h2>{{ $pendientes ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- EN PROCESO -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5>En Proceso</h5>
                    <h2>{{ $enProceso ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- FINALIZADAS -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5>Finalizadas</h5>
                    <h2>{{ $finalizadas ?? 0 }}</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- GRÁFICO SIMULADO -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>📊 Estado de Solicitudes</h5>

            <div class="progress mt-3" style="height: 25px;">
                <div class="progress-bar bg-warning"
                     style="width: {{ $pendientes ?? 0 }}%">
                    Pendientes
                </div>

                <div class="progress-bar bg-info"
                     style="width: {{ $enProceso ?? 0 }}%">
                    En Proceso
                </div>

                <div class="progress-bar bg-success"
                     style="width: {{ $finalizadas ?? 0 }}%">
                    Finalizadas
                </div>
            </div>

        </div>
    </div>

    <!-- ÚLTIMAS SOLICITUDES -->
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            Últimas Solicitudes
        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Área</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($ultimasSolicitudes as $s)

                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->titulo }}</td>
                        <td>{{ $s->area }}</td>

                        <td>
                            @if($s->estado == 'Pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @elseif($s->estado == 'En Proceso')
                                <span class="badge bg-info">En Proceso</span>
                            @else
                                <span class="badge bg-success">Finalizada</span>
                            @endif
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center py-3 text-muted">
                            No hay solicitudes recientes
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection