<div class="flex space-x-1 justify-around">
    @can('update role')
        <a href="javascript:void(0)" onclick="get_datas('{{$id}}')" class="edit btn waves-effect waves-light btn-info">
            <i class="fa fa-edit"></i>
        </a> 
    @endcan
    @can('delete role')
        <a href="javascript:void(0)" onclick="remove('{{ $id }}')"  data-toggle="tooltip" data-placement="top" title="Delete " class="delete btn waves-effect waves-light btn-danger">
            <i class="fa fa-trash"></i>
        </a>
    @endcan
    @can('update role')
        <a href="javascript:void(0)" onclick="givePermissionToRole('{{$id}}')" title="Manage Permission" class="assign btn waves-effect waves-light btn-success">
            <i class="fa fa-sitemap"></i>
        </a> 
    @endcan
</div>