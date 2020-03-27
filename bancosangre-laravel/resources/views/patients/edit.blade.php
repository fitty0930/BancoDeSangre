<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Editar Paciente </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
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

                            <!-- agregar dropdown sangre  -->
                        </div>
                        <button type="submit" class="btn btn-primary"> Guardar </button>
                    <a href="{{route('patients')}}" class="btn btn-danger"> Cancelar </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>