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
                        <div class="breadcrumb-item"><a href="{{ route('add_Patient') }}">Patient</a></div>
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
                                                    <input type="text" name="age" class="form-control" required="">
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
                                                    <input type="text" name="telephone" class="form-control" required="">
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
                                                        <input type="text" name="date" id="date" class="form-control datepicker">
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Patient date !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [date-----------------------------] -->

                                        <!-- [type-service------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Type Service :</h6>
                                                <div class="col-sm-9">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-heart"></i>
                                                            </div>
                                                        </div>
                                                        <select name="type_service" id="type_service" class="form-control">
                                                            <option value="General" data-days="60">General</option>
                                                            <option value="Implant" data-days="60">Implant</option>
                                                            <option value="Ortho" data-days="30">Ortho</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Type Service !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [type-service------------------------------] -->

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

                                        <!-- [doctors---------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Doctors :</h6>
                                                <div class="col-sm-9">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-heart"></i>
                                                            </div>
                                                        </div>
                                                        @php 
                                                            $doctors = App\Models\Doctor::all(); 
                                                        @endphp
                                                        <select class="form-control" name="doctor_id" id="doctor">
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please Choose Doctor !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [doctors---------------------------------] -->

                                        <!-- [next-appointment----------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Next Appointment :</h6>
                                                <div class="col-sm-9">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="next_appointment_date" id="next_appointment_date" class="form-control datepicker">
                                                        <!-- <input type="text" name="next_appointment_date" class="form-control datepicker"> -->
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please fill Next Appointment date !
                                                </div>
                                                </div>
                                            </div>
                                        <!-- [next-appointment----------------------------] -->

                                        <!-- [patient-noted-----------------------------------] -->
                                            <div class="form-group row">
                                                <h6 class="col-sm-3 col-form-label">Patient's Noted :</h6>
                                                <div class="col-sm-9">
                                                    <div class="flex-grow-1">
                                                        <textarea name="patient_noted" class="summernote"></textarea>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please fill Type Patient!
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- [patient-noted-----------------------------------] -->

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
