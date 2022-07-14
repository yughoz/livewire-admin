<form class="form-horizontal"  action="#" >
    <div class="form-group">
        <label>Application Name</label>
        <input type="text" name="name" class="form-control" placeholder="Name" wire:model="name" maxlength="50">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
    <!-- <div class="form-group">
        <label>URL</label>
        <input type="text" class="form-control" placeholder="Name" wire:model="url" maxlength="50">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror																
    </div> -->

</form>