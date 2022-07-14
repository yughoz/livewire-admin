<form class="form-horizontal"  action="#" wire:submit.prevent="store" wire:init="get_data">
    <div class="form-group">
        <label>link</label>
        <input id="update_link" type="text" name="link" class="form-control" placeholder="Link" wire:model="link" maxlength="50">
        @error('link') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
</form>