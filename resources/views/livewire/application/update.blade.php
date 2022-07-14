<form class="form-horizontal"  action="#" >
    <div class="form-group">
        <label>Role Name</label>
        <input id="update_name" type="text" name="name" class="form-control" placeholder="Name" wire:model="name" maxlength="50">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
</form>