<div>

@include('livewire.helpers.modals',['module_code' => 'company','body' => 'company.create','modal_id' => 'createModal','action' => 'store()'])
@include('livewire.helpers.modals',['module_code' => 'company','body' => 'company.update','modal_id' => 'updateModal','action' => 'update()'])


    <div class="card">
        <div class="card-body">
            <div class="p-20">
                @can('create companies')
                <button type="button" class="btn btn-primary bottom-44" data-toggle="modal" data-target="#createModal">
                    <span>
                        <i data-toggle="tooltip" data-placement="top" title="Add" class="fa fas fa-plus"></i>
                    </span>
                </button> <br/><br/>
                @endcan
                

                <livewire:datatables.companies
                    searchable="company_name"
                    exportable
                />
            </div>
        </div>
    </div>

</div>


<script>
    
     
</script>

