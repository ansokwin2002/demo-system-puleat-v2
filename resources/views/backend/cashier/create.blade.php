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
                    <h1>Add Cashier</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('cashier.index') }}">Cashier</a></div>
                        <div class="breadcrumb-item">Add Cashier</div>
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
                                    <form action="{{ route('cashier.create') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <h6 class="col-sm-3 col-form-label">Cashier's Name :</h6>
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
                                                Please fill cashier name !
                                            </div>
                                            </div>
                                        </div>
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
                                        <div class="form-group row">
                                            <h6 class="col-sm-3 col-form-label">Email :</h6>
                                            <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-hashtag"></i>
                                                    </div>
                                                </div>
                                                <input type="email" name="email" class="form-control" required="">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please fill email !
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <h6 class="col-sm-3 col-form-label">Telephone :</h6>
                                            <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="telephone" class="form-control" required="">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please fill telephone !
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
