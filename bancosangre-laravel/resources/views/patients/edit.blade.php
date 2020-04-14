@extends('layouts.main')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Editar Paciente
                </div>
                <div class="card-body">
                <form action="{{route('patients.update', $patient->patient_id)}}" method="POST">
                    @method('put')
                    @csrf
                    <!-- dni, name, surname, blood_id (dropdown) -->
                        <div class="form-group">
                            <label for=""> DNI </label>
                            <input type="number" value="{{$patient->dni}}" class="form-control" name="dni">

                            <label for="">Nombre </label>
                            <input type="text" value="{{$patient->name}}" class="form-control" name="name">

                            <label for="">Apellido</label>
                            <input type="text" value="{{$patient->surname}}" class="form-control" name="surname">

                            <label for="">Edad</label>
                            <input type="number" value="{{$patient->age}}" class="form-control" name="age">
                            <!-- agregar dropdown sangre  -->
                            <label for="">Elija un tipo y factor </label>
                            <div class="input-group">
                                <select class="custom-select" name="blood_id" id="blood_id">
                                    <option selected value="{{$patient->blood_id}}" > {{$patient->group}} {{$patient->factor}}  </option>
                                    @foreach($bloodtypes as $bloodtype)
                                    <option value="{{$bloodtype->blood_id}}">{{$bloodtype->group}}{{$bloodtype->factor}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"> Guardar </button>
                    <a href="{{route('patients')}}" class="btn btn-danger"> Cancelar </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection