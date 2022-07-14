@extends('adminlte::page')

@section('title', 'Application')

@section('vendor-style')
@endsection

@section('content_header')
    <h1>Master Company</h1>
@stop

@section('content')
     @livewire('company') 

@endsection


@section('adminlte_js')
    {{-- Page js files --}}

    {{-- Script according page start here --}}
    <script>

        window.livewire.on('reloadAll', () => {
            $('#createModal').modal('hide');
            $('#updateModal').modal('hide');
        });
        
    </script>
@endsection