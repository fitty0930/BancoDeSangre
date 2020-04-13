@extends('layouts.main')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Nuevo Paciente
                </div>
                <div class="card-body">
                    <form action="{{route('bloodtypes.store')}}" method="POST">
                    @csrf
                    <!-- dni, name, surname, blood_id (dropdown) -->
                        <div class="form-group">
                            <label for=""> Grupo </label>
                            <input type="text" class="form-control" name="group">

                            <label for="">Factor </label>
                            <input type="text" class="form-control" name="factor">

                        </div>
                        <button type="submit" class="btn btn-primary"> Guardar </button>
                        <a href="{{route('bloodtypes')}}" class="btn btn-danger"> Cancelar </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
