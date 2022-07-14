@extends('adminlte::page')

@section('title', 'Permission')

@section('vendor-style')
@endsection

@section('content_header')
    <h1>Permission</h1>
@stop

@section('content')
     @livewire('permissions') 

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