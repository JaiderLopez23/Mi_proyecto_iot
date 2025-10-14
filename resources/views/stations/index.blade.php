@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Listado de Estaciones</h2>
    <a href="{{ route('stations.create') }}" class="btn btn-primary mb-3">Nueva estación</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stations as $station)
            <tr>
                <td>{{ $station->name }}</td>
                <td>{{ $station->city->name ?? 'Sin asignar' }}</td>
                <td>{{ $station->status ? 'Activa' : 'Inactiva' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
