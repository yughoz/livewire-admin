<div>

@include('livewire.helpers.modals',['module_code' => 'roles','body' => 'roles.create','modal_id' => 'createModal','action' => 'store()'])
@include('livewire.helpers.modals',['module_code' => 'roles','body' => 'roles.create','modal_id' => 'updateModal','action' => 'update()'])


<div class="card">
        <div class="card-body">
            <div class="p-20 ">
                
            </div>
            <div class="p-20">
                @can('create role')
                <button type="button" class="btn btn-primary bottom-44" data-toggle="modal" data-target="#createModal">
                    <span>
                        <i data-toggle="tooltip" data-placement="top" title="Add" class="fa fas fa-plus"></i>
                    </span>
                </button> <br/><br/>
                @endcan
                <livewire:datatables.roles
                    searchable="name"
                    exportable
                />
            </div>
        </div>
    </div>

</div>


{{-- Start Modal Here --}}
{{-- Assign Permissions to Role Modal --}}
<div id="assignPermissionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assign Permission to <span class="title-role"></span></h4>
                <button type="button" class="close align-right" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formAssignPermissionToRole">
                    
                    <div class="form-group row">
                        <div class="col-12">
                            <input id="role_id" type="hidden" >

                            <div class="table-responsive m-t-40" wire:ignore >
                                <table id="tablePermissionByRole" class="table table-bordered table-striped" style="width:100% !important;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Permission Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" id="addPermissionButton"">Assign Role</button>
            </div>
        </div>
    </div>
</div>

<script>
    function removePermission(role_id, permissionId) {
        console.log("role_id, permissionId",role_id, permissionId);
        @this.removePermission(role_id, permissionId)
    }
    function addPermission(role_id,permissionId) {
        console.log("role_id, permissionId",role_id, permissionId);
        @this.addPermission(role_id, permissionId)
        
    }

    function savePermissionOnRole(roleId) {
        permission = $('#permission_list').select2("val");
        data = {
            '_token' : "{{ csrf_token() }}",
            'permission' : permission,
            'role_id' : roleId
        }
        $.ajax({
            type: "POST",
            url: "{{ route('store.permission-role') }}",
            data: data,
            dataType: "JSON",
            success: function (response) {
                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    type: "success",
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    title: "Error!",
                    text: "Internal Server Error!",
                    type: "error",
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                });
            }
        });
    }
    function givePermissionToRole(roleId, roleName) { 
        $('#assignPermissionModal').modal('show');
        $('#role_id').val(roleId);
        $('.title-role').text(roleName);

        
        $('#tablePermissionByRole').DataTable().ajax.reload();
        

        $('#addPermissionButton').click(function (e) { 
            e.preventDefault();
            e.stopPropagation();
            savePermissionOnRole(roleId);
            setTimeout(() => {
                // $('#tablePermissionByRole').DataTable().ajax.reload();    
            }, 1000);
            $('#permission_list').select2('val', '');
        });

        $(document).on('click','.revokePermission', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).off('click');
            let permission_id = $(this).data('permission');
            let url = '{{ route("revoke.permission",":id") }}';
            url = url.replace(':id', roleId);
            data = {
                '_token' : "{{ csrf_token() }}",
                'role_id' : roleId,
                'permission_id' : permission_id
            }
            $.ajax({
                type: "PUT",
                url: url,
                data: data,
                dataType: "JSON",
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        type: "success",
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    });
                    setTimeout(() => {
                        // $('#tablePermissionByRole').DataTable().ajax.reload();    
                    }, 1000);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: "Error!",
                        text: "Internal Server Error!",
                        type: "error",
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    });
                }
            });
        });
    }
</script>

