<form class="form-horizontal"  action="#" >
    <div class="form-group">
        <label>Role Name</label>
        <input id="update_name" type="text" name="name" class="form-control" placeholder="Name" wire:model="name" maxlength="50">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="customCheckbox1" wire:model="checkbox_crud" value="1">
        <label for="customCheckbox1" class="custom-control-label">Insert CRUD</label>
    </div>

</form>