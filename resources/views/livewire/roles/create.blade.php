<form class="form-horizontal"  action="#" >
    <div class="form-group">
        <label>Role Names</label>
        <input id="update_name" type="text" name="name" class="form-control" placeholder="Name" wire:model="name" maxlength="50">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
    <div class="form-group">
        <label>Company</label>
        @include('livewire.helpers.select2-dropdown',['selectData' => $selectCompany,'model' => 'company','label' => 'company_name'])
    </div>
</form>