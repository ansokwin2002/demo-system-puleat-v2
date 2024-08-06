<form action="{{ route('service_Update',$item->id) }}" method="post">
    @csrf   
    <div class="modal fade" tabindex="-1" role="dialog" id="fire-modal-4">       
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">           
            <div class="modal-header">            
                <h5 class="modal-title">Edit Service</h5>             
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">               
                    <span aria-hidden="true">×</span>             
                </button>           
            </div>           
            <div class="modal-body">
                <form action="{{ route('create_Service') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <h6 class="col-sm-3 col-form-label">Service Name :</h6>
                        <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-heart"></i>
                                </div>
                            </div>
                            <input type="text" name="name" class="form-control" required="">
                        </div>
                        <div class="invalid-feedback">
                            Please fill service name !
                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h6 class="col-sm-3 col-form-label">Unit :</h6>
                        <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-hashtag"></i>
                                </div>
                            </div>
                            <input type="text" name="unit" class="form-control" required="">
                        </div>
                        <div class="invalid-feedback">
                            Please fill service unit !
                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h6 class="col-sm-3 col-form-label">Price :</h6>
                        <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-tags"></i>
                                </div>
                            </div>
                            <input type="text" name="price" class="form-control" required="">
                        </div>
                        <div class="invalid-feedback">
                            Please fill service price !
                        </div>
                        </div>
                    </div>
                </form>
            </div>           
            <div class="modal-footer bg-whitesmoke">           
                <button type="button" class="btn btn-success btn-shadow"><i class="fa fa-edit"></i> Update</button>
            </div>         
        </div>       
    </div>    
    </div>
</form>