<div>
    <div class="form-group">
        <label for="" class="label"></label>
        <select name="visitor_id" id="visitor_id" wire:model="visitor_id">
            <option value="">Select Visitor</option>
            @foreach ($visitors ?? [] as $visitor)
                <option value="{{ $visitor->id }}">{{ $visitor->name }}</option>
            @endforeach
        </select>
        <br>
        <button type="button" >Add</button>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVisitorModal">
            Add Visitor
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addVisitorModal" tabindex="-1" role="dialog" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addVisitorModalLabel">Add Visitor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="/visitors" method="POST" wire:submit="save">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                    <label for="name">Name</label>
                    <input required type="text" class="form-control" id="name" name="name" wire:model="name" required>
                    </div>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input required type="email" class="form-control" id="email" name="email" wire:model="email" required>
                    </div>
                    <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input required type="text" class="form-control" id="mobile" name="mobile" wire:model="mobile">
                    </div>
                    <div class="form-group">
                    <label for="address">Address</label>
                    <textarea required type="text" class="form-control" id="address" name="address" wire:model="address"></textarea>
                    </div>
                    <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input required type="text" class="form-control" id="company_name" name="company_name" wire:model="company_name">
                    </div>
                    <div class="form-group">
                    <label for="photo_url">Photo URL</label>
                    <input type="text" class="form-control" id="photo_url" name="photo_url" wire:model="photo_url">
                    </div>
                    <div class="form-group">
                    <label for="id_proof">ID Proof</label>
                    <input type="text" class="form-control" id="id_proof" name="id_proof" wire:model="id_proof">
                    </div>
                    <div class="form-group">
                    <label for="id_proof_img">ID Proof Image</label>
                    <input type="text" class="form-control" id="id_proof_img" name="id_proof_img" wire:model="id_proof_img">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
            </div>
        </div>

    </div>
</div>
<script>
Livewire.on('visitor-added', () => {
    $('.modal-backdrop').remove();
    $('#addVisitorModal').modal('hide');
    $('body').removeClass('modal-open');
});
</script>