
    <!-- Modal -->
    <div class="modal fade" id="fire-modal-4-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('service_Update', $item->id) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Service Name:</label>
                            <input type="text" name="name" id="name-{{$item->id}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit:</label>
                            <input type="text" name="unit" id="unit-{{$item->id}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" name="price" id="price-{{$item->id}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update <i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

