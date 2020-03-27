<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pacientes </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
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
                            Acción
                        </th>
                        {{-- completar --}}
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
</body>
</html>