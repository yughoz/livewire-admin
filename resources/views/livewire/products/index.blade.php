<div>

@include('livewire.helpers.modals',['module_code' => 'products','body' => 'products.create','modal_id' => 'createModal','action' => 'store()'])
@include('livewire.helpers.modals',['module_code' => 'products','body' => 'products.update','modal_id' => 'updateModal','action' => 'update()'])


<div class="card">
    <div class="card-body">
        @can('create products')        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <span>
                <i data-toggle="tooltip" data-placement="top" title="Add User" class="fa fas fa-plus"></i>
            </span>
        </button>
        @endcan            
        
        <livewire:datatables.products
            searchable="name,local_name,shop_location"
        />
    </div>
</div>

</div>

