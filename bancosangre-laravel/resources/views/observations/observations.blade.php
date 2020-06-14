@extends('layouts.main')
@section('contenido')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Auth::user()->hasRole('admin'))
            <div id="app">
                <observation-component :user={{ Auth::user() }} :userrole={{Auth::user()->hasRole('admin')}}> </observation-component>
            </div>
            @else
            <div id="app">
                <observation-component :user={{ Auth::user() }} :userrole=false> </observation-component>
            </div>
            @endif
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
@endsection