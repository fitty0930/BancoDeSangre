@extends('layouts.main')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Sangre
                    @auth
                        @if(Auth::user()->hasRole('admin'))
                            <a href="{{route('bloodtypes.new')}}" class="btn btn-success btn-sm float-right"> Nuevo </a>
                        @endif
                    @endauth
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
                            Grupo
                        </th>
                        <th>
                            Factor
                        </th>
                        <th>
                            Acción
                        </th>
                        {{-- completar --}}
                    </thead>
                    <tbody>
                        @foreach($bloodtypes as $bloodtype)
                        <tr>
                            
                            <td>
                                {{$bloodtype->group}}
                            </td>
                            <td>
                                {{$bloodtype->factor}}
                            </td>
                            <td>
                            @auth
                            @if(Auth::user()->hasRole('admin'))
                                <a href="javascript: document.getElementById('delete-{{$bloodtype->blood_id}}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                <form id="delete-{{ $bloodtype->blood_id }}" action="{{ route('bloodtypes.delete', $bloodtype->blood_id) }}" method="POST">
                                    @method('delete')
                                    @csrf 
                                </form>
                            @endif
                            @endauth
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