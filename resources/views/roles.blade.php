@extends('adminlte::page')

@section('title', 'Role')

@section('vendor-style')
@endsection

@section('content_header')
    <h1>Role</h1>
@stop

@section('content')
     @livewire('roles') 

    @can('add')
        <h1>endcan</h1>
    @endcan

@endsection


@section('adminlte_js')
    {{-- Page js files --}}

    {{-- Script according page start here --}}
    <script>
        

        let url = '{{ route("list.permissions-by-role") }}';
        
        var tablePermission = $('#tablePermissionByRole').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": url, 
                "type": "GET",
                "data": function ( d ) {
                    d.role_id = $('#role_id').val();
            }},
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            });


        window.livewire.on('reloadAll', () => {
            $('#createModal').modal('hide');
            $('#updateModal').modal('hide');
        });

        window.livewire.on('reloadPermission', () => {
            $('#tablePermissionByRole').DataTable().ajax.reload();
        });
        
        $('#permission_list').select2({
            placeholder: "Permission",
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('list.permission') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    </script>
@endsection