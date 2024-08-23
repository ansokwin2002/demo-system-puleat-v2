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
                    <h1>Add Doctor</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="#">Doctor</a></div>
                        <div class="breadcrumb-item">Add Doctor</div>
                    </div>
                </div>
            <!-- [header-------------------------] -->

            <!--[Doctor_table-------------------------]-->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card_title">
                            <div class="row">
                                <div class="card-body">
                                    <form action="{{ route('doctor.create') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <h6 class="col-sm-3 col-form-label">Doctor's Name :</h6>
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
                                                Please fill doctor name !
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <h6 class="col-sm-3 col-form-label">Specialization :</h6>
                                            <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="specialization" class="form-control" required="">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please fill specialization !
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <h6 class="col-sm-3 col-form-label">Phone :</h6>
                                            <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="phone" class="form-control" required="">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please fill phone !
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <h6 class="col-sm-3 col-form-label">Email :</h6>
                                            <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="email" class="form-control" required="">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please fill email !
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

            <!--[Doctor_table-------------------------]-->

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
