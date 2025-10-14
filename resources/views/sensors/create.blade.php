@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Nuevo Sensor</h2>

    <form action="{{ route('sensors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Estación</label>
            <select name="id_station" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($stations as $station)
                <option value="{{ $station->id }}">{{ $station->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
