<form class="form-horizontal"  action="#" >
<div class="form-group">
        <label>Company Name</label>
        <input type="text" name="name" class="form-control" placeholder="Name" wire:model="name" >
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
    <div class="form-group">
        <label>Company Sort Name</label>
        <input type="text" name="name" class="form-control" placeholder="Name" wire:model="sort_name" >
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
    <div class="form-group">
        <label>Register Date</label>
        <input type="date"  class="form-control" placeholder="Name" wire:model="register_date" >
        @error('register_date') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>

    <div class="form-group">
        <label>Address</label>
        <textarea class="form-control" placeholder="Address" wire:model="address"></textarea>
        @error('address') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
    <div class="form-group">
        <label>URL Server</label>
        <input type="text"  class="form-control" placeholder="URL Server" wire:model="url_server" >
        @error('url_server') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
</form>