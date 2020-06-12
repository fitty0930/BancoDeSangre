@extends('layouts.main')
@section('contenido')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="app">
                <observation-component> </observation-component>
            </div>
            
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
@endsection