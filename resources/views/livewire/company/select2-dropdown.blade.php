<div>

@can('all companies')
    <div wire:ignore>
        <select class="form-control" id="select2-dropdown" wire:model="{{$model}}">
            <option value="">Select Option</option>
            @foreach($selectData as $item)
            <option value="{{ $item['value'] }}">{{ $item['text'] }}</option>
            @endforeach
        </select>
    </div>
@else
    <input type="text" name="name" readonly="readonly" class="form-control" placeholder="Name" value="{{Auth::user()->details->company->company_name}}">
@endcan    

</div>        



<script>
    // $(document).ready(function () {
        // $('#select2-dropdown').select2();
        // $('#select2-dropdown').on('change', function (e) {
        //     var data = $('#select2-dropdown').select2("val");
            
        // });
    // });

</script>

