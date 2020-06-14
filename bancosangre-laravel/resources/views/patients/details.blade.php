@extends('layouts.main')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Detalles del paciente
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">DNI: {{$patient->dni}}</li>
                        <li class="list-group-item">Nombre: {{$patient->name}}</li>
                        <li class="list-group-item">Apellido: {{$patient->surname}}</li>
                        <li class="list-group-item">Edad: {{$patient->age}}</li>
                        <li class="list-group-item">Telefono: {{$patient->phone}}</li>
                        <li class="list-group-item">Dirección: {{$patient->adress}}</li>
                        <li class="list-group-item">Tipo de sangre: {{$patient->group}}{{$patient->factor}}</li>
                        
                    </ul>      
                </div>
                <a href="{{url()->previous()}}" class="btn btn-danger"> Volver </a> 
                {{-- URL PREVIA --}}
            </div>
        </div>
    </div>
@endsection