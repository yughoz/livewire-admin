<form class="form-horizontal" >
    <div class="form-group">
        <label>Keys</label>
        <input id="update_keys" type="text" name="keys" class="form-control" placeholder="Keys" wire:model="keys" maxlength="50">
        @error('keys') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
    <div class="form-group">
        <label>Text</label>
        <textarea class="form-control classUpdate" rows="3" placeholder="Enter ..." name="text" id="text" wire:model="text"></textarea>
        @error('password') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
    <div class="form-group">
        <label>Tags</label>
        <input id="update_keys" type="text" name="tags" class="form-control" placeholder="Tags" wire:model="tags" maxlength="50">
        @error('tags') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>

    <div class="form-group">
        <label>Company</label>
        @include('livewire.company.select2-dropdown',['selectData' => $selectCompany,'model' => 'company','label' => 'company_name'])
    </div>

</form>