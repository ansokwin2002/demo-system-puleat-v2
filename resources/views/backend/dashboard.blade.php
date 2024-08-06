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
                    <h1>Payment Server test</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item">Payment</div>
                    </div>
                </div>
            <!-- [header-------------------------] -->

            <!--[Service_table-------------------------]-->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card_title">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <!-- First Date Form -->
                                    <div class="form-group mb-2">
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Date :</h6>
                                            <div class="flex-grow-1">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control datepicker">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Second Form (Doctor) -->
                                    <div class="form-group mb-2">
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Doctor :</h6>
                                            <div class="flex-grow-1">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-user-md"></i>
                                                        </div>
                                                    </div>
                                                    <select class="form-control">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-8">
                                    <div class="container-fluid pl-0 pr-0">
                                        <div class="row">
                                            <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                                <div class="title_customer">
                                                    <h6 class="pt-2">Patient :</h6>
                                                </div>
                                                <div class="box_select_customer">
                                                    <div class="card_customer">
                                                        <div class="icon_customer">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <div class="select_customer">
                                                            <select class="form-control select2" style="width: 100%;">
                                                                    <option selected>Demo</option>
                                                                    <option>An Sokwin</option>
                                                                    <option>Mai Thaileang</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="" style="width: 100%;">
                            <div class="container-fluid pl-0 pr-0 mt-3">
                                <div class="row">
                                    <div class="col-12 col-sm-5 col-md-8 col-lg-12">
                                        <div class="card_service">
                                            <div class="icon_service">
                                                <button class="btn btn-primary" style="width: 100%;height:100%;">Choose Service</button>
                                            </div>
                                            <div class="select_service">
                                            
                                                <select class="form-control select2" style="width: 100%;">
                                                    
                                                        <option value="1">1</option>
                                                        <option value="1">1</option>
                                                        <option value="1">1</option>
                                                        <option value="1">1</option>
                                               
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- [table_service-----------------------] -->
                        <div class="" style="width: 100%;">
                            <div class="container-fluid pl-0 pr-0 mt-3 table_service">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Created At</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Irwansyah Saputra</td>
                                                        <td>2017-01-09</td>
                                                        <td><div class="badge badge-success">Active</div></td>
                                                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [table_service-----------------------] -->

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
