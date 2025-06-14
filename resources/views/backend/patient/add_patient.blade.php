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
                    <h1>Add Patient</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item">Add Patient</div>
                    </div>
                </div>
            <!-- [header-------------------------] -->

            <!--[Patient_table-------------------------]-->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card_title">
                                <div class="row">
                                    <div class="card-body">
                                        <form action="{{ route('create_Patient') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                        <!-- [name----------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Patient's Name :</h6>
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
                                                    Please fill Patient name !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [name----------------------------------] -->

                                        <!-- [age-------------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Age :</h6>
                                                <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-hashtag"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="age" class="form-control age" required="">
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient age !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [age-------------------------------------] -->

                                        <!-- [sex-------------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Sex :</h6>
                                                <div class="col-sm-9">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-user-md"></i>
                                                            </div>
                                                        </div>
                                                        <select name="sex" class="form-control">
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient sex !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [sex-------------------------------------] -->

                                        <!-- [address----------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Address :</h6>
                                                <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="address" class="form-control" required="">
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient address !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [address----------------------------------] -->

                                        <!-- [telephone-------------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Telephone :</h6>
                                                <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="telephone" class="form-control tel" required="">
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient telephone !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [telephone-------------------------------------] -->

                                        <!-- [date-----------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Date :</h6>
                                                <div class="col-sm-9">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="date" class="form-control datepicker">
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient date !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [date-----------------------------] -->

                                        <!-- [type-patient----------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Type Patient :</h6>
                                                <div class="col-sm-9">
                                                    <div class="flex-grow-1">
                                                        <div class="input-group" id="type-patient-wrapper">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text" id="type-patient-icon">
                                                                    <i class="fas fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <select name="type_patient" class="form-control" id="type-patient-select">
                                                                <option value="Walk-in">Walk-in</option>
                                                                <option value="Customize">Customize</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please fill Type Patient!
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- [type-patient----------------------------------] -->       
                                         
                                        <!-- [type-patient----------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Type Payment :</h6>
                                                <div class="col-sm-9">
                                                    <input type="radio" value="general_implant" name="type_payment" checked>
                                                    <strong>General / Implant</strong>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="radio" value="ortho" name="type_payment">
                                                    <strong>Ortho</strong>   
                                                </div>
                                            </div>
                                        <!-- [type-patient----------------------------------] -->     

                                        <!-- [button-save------------------------------------] -->
                                            <div class="form-group mb-0 row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                </div>
                                            </div>
                                        <!-- [button-save------------------------------------] -->
                                        </form>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--[Patient_table-------------------------]-->

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
    // [Validation Form paid--------------------]
        $(document).on('input', '.age, .tel', function() {
            var value = $(this).val();
            var numericValue = value.replace(/[^0-9.]/g, ''); 

            if (value !== numericValue) {
                $(this).val(numericValue); 
            }
        });

        $(document).on('blur', '.age, .tel', function() {
            var value = $(this).val();
            if (isNaN(value) || value.trim() === '') {
                $(this).val(''); 
            }
        });
    // [Validation Form paid--------------------]
</script>
@endpush