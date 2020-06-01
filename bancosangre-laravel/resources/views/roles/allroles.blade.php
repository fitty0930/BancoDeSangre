@extends('layouts.main')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <p> Usuarios y roles </p>
            </div>
            {{-- aca irian los roles --}}
            <div> 
                <table class="table table-hover table-sm">
                    <thead>
                        <th>
                            Usuario
                        </th>
                        <th>
                            Rol
                        </th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            @if (1==$user->role_id)
                                admin
                            @else
                                user
                            @endif
                        </td>
                        <td>
                        <a href="{{route('roles.change', $user->id)}}" class="btn btn-info btn-sm"> Cambiar permiso </a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
            </div>
        </div>
    </div>
</div>
@endsection