@extends('layouts.main')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Donaciones
                </div >
                <br>
                <input id="buscar" type="text" class="form-control" placeholder="Escriba algo para filtrar" />
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
                            Fecha 
                        </th>
                        {{-- completar --}}
                    </thead>
                    <tbody id="donaciones-tabla">
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
                            <td>
                                {{$donation->created_at->format('d-M-Y, H:i')}}
                                                        {{-- DIA-MES-AÑO, HORAS, MINUTOS --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div> 
    <script src="{{asset('js/search.js')}}"></script>
@endsection