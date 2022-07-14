<form class="form-horizontal"  action="#" wire:submit.prevent="store" wire:init="get_data">
    <div class="form-group">
        <label>link</label>
        <input id="update_link" type="text" name="link" class="form-control" placeholder="Link" wire:model="link" maxlength="50">
        @error('link') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>

    <div class="form-group">
        <label>Json</label>
        <textarea class="form-control classUpdate" rows="3" placeholder="Enter ..." name="json" id="json" wire:model="json"></textarea>
        @error('json') <span class="text-danger">{{ $message }}</span> @enderror																
    </div>
</form>