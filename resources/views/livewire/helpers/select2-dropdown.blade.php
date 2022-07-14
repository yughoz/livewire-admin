<div>

    <!-- <div wire:ignore>
        <select class="form-control" id="select2-dropdown" wire:model="{{$model}}">
            <option value="">Select Option</option>
            @foreach($selectData as $item)
            <option value="{{ $item['value'] }}">{{ $item['text'] }}</option>
            @endforeach
        </select>
    </div> -->
    <!-- @can('all companies')
        <input type="text" name="name" readonly="readonly" class="form-control" placeholder="Name" wire:model="{{$model.'_label'}}"  data-toggle="modal" data-target="#{{$model.'_modal'}}">
    @else
        <input type="text" name="name" readonly="readonly" class="form-control" placeholder="Name" wire:model="{{$model.'_label'}}" >
    @endcan     -->
    @if(auth()->user()->can('all companies') || $model != 'company')
    <div class="input-group">
        <input type="text" name="name" readonly="readonly" class="form-control" placeholder="Name" wire:model="{{$model.'_label'}}" >
        <span class="input-group-append">
            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#{{$model.'_modal'}}"><i class="fas fa-search"></i></</button>
        </span>
    </div>

    @else
        <input type="text" name="name" readonly="readonly" class="form-control" placeholder="Name" value="{{Auth::user()->details->company->company_name}}">      
    @endcan     
</div>


<script>
    // $(document).ready(function () {
    //     $('#select2-dropdown').select2();
    //     $('#select2-dropdown').on('change', function (e) {
    //         var data = $('#select2-dropdown').select2("val");
            
    //     });
    // });

</script>

