@extends ('backend.master')
@section('content')

<div class="main-wrapper main-wrapper-1">
    <!-- [navbar----------------------------] -->
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        @include('backend.body.navbar')
    </nav>
    <!-- [navbar----------------------------] -->

    <!-- [aside------------------------------] -->
    <div class="main-sidebar sidebar-style-2">
        @include('backend.body.aside')
    </div>
    <!-- [aside------------------------------] -->

    <!-- [main_content------------------------------] -->
    <div class="main-content">
        <section class="section">
            <!-- [header-------------------------] -->
                <div class="section-header">
                    <h1>Add Service</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('add_Service') }}">Service</a></div>
                        <div class="breadcrumb-item">Add Service</div>
                    </div>
                </div>
            <!-- [header-------------------------] -->

            <!--[Service_table-------------------------]-->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card_title">
                            <div class="row">
                                <div class="card-body">
                                    <form action="{{ route('create_Service') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <h6 class="col-sm-3 col-form-label">Service's Name :</h6>
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
                                                <input type="text" name="unit" class="form-control service_unit" required="">
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
                                                <input type="text" name="price" class="form-control service_price" required="">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please fill service price !
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--[Service_table-------------------------]-->

        </section>
    </div>
    <!-- [main_content------------------------------] -->

    <!-- [footer------------------------------] -->
    <footer class="main-footer">
        @include('backend.body.footer')
    </footer>
    <!-- [footer------------------------------] -->

</div>

@endsection

@push('scripts')
<script>
    // [Validation_Unit_and_Price---------------------]
    $(document).on('input', '.service_unit, .service_price', function() {
        var value = $(this).val();
        var numericValue = value.replace(/[^0-9.]/g, ''); // Allow only numbers and dots

        if (value !== numericValue) {
            $(this).val(numericValue); // Replace invalid input with numeric value
        }
    });

    $(document).on('blur', '.service_unit, .service_price', function() {
        var value = $(this).val();
        if (isNaN(value) || value.trim() === '') {
            $(this).val(''); // Clear the field if the value is not valid
        }
    });
    // [Validation_Unit_and_Price---------------------]
</script>
@endpush
