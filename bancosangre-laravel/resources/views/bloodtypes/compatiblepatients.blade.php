@extends('layouts.main')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Pacientes
                    <a href="{{route('patients.new')}}" class="btn btn-success btn-sm float-right"> Nuevo paciente </a>
                </div>
                <div class="card-body">
                    @if(session('info'))
                        <div class="alert alert-success">
                            {{session('info')}}
                        </div>
                    @endif
                <table class="table table-hover table-sm">
                    <thead>
                        <th>
                            DNI
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Apellido
                        </th>
                        <th>
                            Edad
                        </th>
                        <th>
                            Grupo
                        </th>
                        <th>
                            Factor
                        </th>
                        <th>
                            Acción
                        </th>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>
                                {{$patient->dni}}
                            </td>
                            <td>
                                {{$patient->name}}
                            </td>
                            <td>
                                {{$patient->surname}}
                            </td>
                            <td>
                                {{$patient->age}}
                            </td>
                            <td>
                                {{$patient->group}}
                            </td>
                            <td>
                                {{$patient->factor}}
                            </td>
                            <td>
                            <a href="{{route('patients.edit', $patient->patient_id)}}" class="btn btn-warning btn-sm"> Editar</a>
                                <a href="javascript: document.getElementById('delete-{{$patient->patient_id}}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                <form id="delete-{{ $patient->patient_id }}" action="{{ route('patients.delete', $patient->patient_id) }}" method="POST">
                                    @method('delete')
                                    @csrf 
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection