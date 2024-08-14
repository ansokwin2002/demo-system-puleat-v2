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
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="#">Patient</a></div>
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
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Age :</h6>
                                                <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-hashtag"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="age" class="form-control" required="">
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient age !
                                                </div>
                                                </div>
                                            </div>

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
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                            <option>Unknown</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient sex !
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Address :</h6>
                                                <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-tags"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="address" class="form-control" required="">
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient address !
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Telephone :</h6>
                                                <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-tags"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="telephone" class="form-control" required="">
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient telephone !
                                                </div>
                                                </div>
                                            </div>

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

                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Upload Image :</h6>
                                                <div class="col-sm-9">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient image !
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
