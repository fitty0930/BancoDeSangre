@extends('layouts.main')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Donaciones
                </div >
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
                        {{-- completar --}}
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                        <tr>
                            <td>
                                {{$donation->dni}}
                            </td>
                            <td>
                                {{$donation->name}}
                            </td>
                            <td>
                                {{$donation->surname}}
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