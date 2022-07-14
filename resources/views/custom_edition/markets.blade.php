@extends('adminlte::page')

@section('title', 'Koin')

@section('vendor-style')
@endsection

@section('content_header')
    <h1>Master Koin</h1>
@stop

@section('content')
     @livewire('custom-edition.markets') 

@endsection


@section('adminlte_js')
    {{-- Page js files --}}

    {{-- Script according page start here --}}
    <script>

        $('#highTbl').DataTable();
        $('#example').DataTable();
        window.livewire.on('reloadAll', () => {
            $('#createModal').modal('hide');
            $('#updateModal').modal('hide');
        });
        
    </script>
@endsection