<div>

@include('livewire.helpers.modals',['module_code' => 'users','body' => 'users.create','modal_id' => 'createModal','action' => 'store()'])
@include('livewire.helpers.modals',['module_code' => 'users','body' => 'users.update','modal_id' => 'updateModal','action' => 'update()'])
@include('livewire.helpers.modals',['module_code' => 'company','body' => 'company.selected','modal_id' => 'company_modal','action' => 'selectedAction()'])
@include('livewire.helpers.modals',['module_code' => 'role','body' => 'roles.selected','modal_id' => 'role_modal','action' => 'selectedAction()'])


<div class="card">
        <div class="card-body">
            @can('create user')        
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <span>
                    <i data-toggle="tooltip" data-placement="top" title="Add User" class="fa fas fa-user-plus"></i>
                </span>
            </button>
            @endcan            
                 
            
            <livewire:datatables.users 
                searchable="name"
                exportable
            />
        </div>
    </div>

    {{-- Start Modal Here --}}
    <div id="assignRoleToUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Give Role to <span class="title-email"></span></h4>
                    <button type="button" class="close align-right" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="formAssignRoleToUser">
                        <div class="form-group row">
                            <label for="example-search-input" class="col-4 col-form-label">Role</label>
                            <div class="col-8" wire:ignore>
                                <select class="select2 m-b-10 select2-multiple role_list" style="width: 100%" multiple="multiple" data-placeholder="Choose Role">
                                    
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="assignRoleToUserButton"">Assign Role</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Assign User to Pegawai --}}
    <div id="assignUserToPegawaiModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width: 100%">
            <div class="modal-content">
                <form id="formAssignUserToPegawai">
                    <div class="modal-header">
                        <h4 class="modal-title">Assign User to Pegawai</h4>
                        <button type="button" class="close align-right" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="example-search-input" class="col-4 col-form-label">Pegawai</label>
                            <div class="col-8" wire:ignore>
                                    <select name="pegawai_id" class="select2 pegawai_list" style="width: 100%"></select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" id="assignUserToPegawaiButton">Assign User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

