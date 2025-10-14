@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Nueva Estación</h2>

    <form action="{{ route('stations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ciudad</label>
            <select name="id_city" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
