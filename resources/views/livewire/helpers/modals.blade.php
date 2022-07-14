<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{$modal_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal {{$module_code}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
               @include('livewire.'.$body)
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="{{$action}}" class="btn btn-primary close-modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
        function get_datas(pid) { 
            $('#updateModal').modal('show');
            @this.edit(pid)
        }

        function {{$modal_id}}_selectedAction(pid,text,modul) { 
            $('#{{$modal_id}}').modal('hide');
            console.log("selectedAction",pid,text,modul);
            @this.selectedAction(pid,text,modul)
        }
        // Remove Action
        function remove(id) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    @this.delete(id)
                    
                } 
            })
        }
</script>