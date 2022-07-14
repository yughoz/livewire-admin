<div>

@include('livewire.helpers.modals',['module_code' => 'permissions','body' => 'permissions.create','modal_id' => 'createModal','action' => 'store()'])
@include('livewire.helpers.modals',['module_code' => 'permissions','body' => 'permissions.update','modal_id' => 'updateModal','action' => 'update()'])


<div class="card">
        <div class="card-body">
            <div class="p-20 ">
                
            </div>
            <div class="p-20">
                @can('create permission')
                <button type="button" class="btn btn-primary bottom-44" data-toggle="modal" data-target="#createModal">
                    <span>
                        <i data-toggle="tooltip" data-placement="top" title="Add" class="fa fas fa-plus"></i>
                    </span>
                </button> <br/><br/>
                @endcan
                <livewire:datatables.permissions 
                        searchable="name"
                        exportable
                    />
                    
            </div>
        </div>
    </div>

</div>



<script>
    
       
</script>

