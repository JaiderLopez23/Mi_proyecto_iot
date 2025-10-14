@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Listado de Sensores</h2>
    <a href="{{ route('sensors.create') }}" class="btn btn-primary mb-3">Nuevo sensor</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estación</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sensors as $sensor)
            <tr>
                <td>{{ $sensor->name }}</td>
                <td>{{ $sensor->station->name ?? 'Sin asignar' }}</td>
                <td>{{ $sensor->status ? 'Activo' : 'Inactivo' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
