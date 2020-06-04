@extends('layouts.main')
@section('contenido')
    <div class="card-header">
    <img src="https://pbs.twimg.com/media/D0rlFbOW0AIIZ4S.jpg" alt="Dificultades tecnicas" 
    class="img-responsive rounded mx-auto d-block" width="350" height="350">
    
        <p class="text-center"> Usted no tiene los permisos necesarios para realizar esa acción </p>
    </div>
    <a href="{{url()->previous()}}" class="btn btn-danger"> Volver </a>
@endsection