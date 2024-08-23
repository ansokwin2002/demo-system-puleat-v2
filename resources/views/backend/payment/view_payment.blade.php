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
                    <h1>Payment</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
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
                                                        <input type="text" class="form-control datepicker" id="date">
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
                                                        @php 
                                                            $doctors = App\Models\Doctor::all();
                                                        @endphp
                                                        <select class="form-control select2" name="doctor_id" id="doctor">
                                                            <option value="" disabled>Select a Doctor</option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-8">
                                        <div class="container-fluid pl-0 pr-0">
                                        <!-- [patient-----------------------------------] -->
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
                                                            @php 
                                                                $patients = App\Models\Patient::all();
                                                                $selectedPatientId = $selectedPatientId ?? null; 
                                                            @endphp

                                                            <select id="patient-select" class="form-control select2" style="width: 100%;">
                                                                <option value="" disabled>Select a Patient</option>
                                                                @foreach ($patients as $patient)
                                                                    <option value="{{ $patient->id }}" {{ $patient->id == $selectedPatientId ? 'selected' : '' }}>
                                                                        {{ $patient->name }} ({{ $patient->telephone }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- [patient-----------------------------------] -->

                                        <!-- [cashier-----------------------------------] -->

                                            <div class="row mt-2">
                                                <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                                    <div class="title_customer">
                                                        <h6 class="pt-2">Cashier :</h6>
                                                    </div>
                                                    <div class="box_select_customer">
                                                        <div class="card_customer">
                                                            <div class="icon_customer">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                            <div class="select_customer">
                                                            @php 
                                                                $cashiers = App\Models\Cashier::all();
                                                            @endphp

                                                            <select id="cashier-select" name="cashier_id"  class="form-control select2" style="width: 100%;">
                                                                <option value="" disabled>Select a Cashier</option>
                                                                @foreach ($cashiers as $cashier)
                                                                    <option value="{{ $cashier->id }}">
                                                                        {{ $cashier->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- [cashier-----------------------------------] -->

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
                                                    @php 
                                                        $Services = App\Models\Service::all();
                                                    @endphp

                                                    <select id="serviceSelect" class="form-control select2" style="width: 100%;">
                                                        <option>Select a Service</option>
                                                        @foreach ($Services as $service)
                                                            <option value="{{ $service->id }}" 
                                                            data-name-service="{{ $service->name }}"
                                                            data-unit-service="{{ $service->unit }}"
                                                            data-price-service="{{ $service->price }}"
                                                            >
                                                                {{ $service->name }}
                                                            </option>
                                                        @endforeach
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
                                                        <thead class="bg-primary">
                                                            <tr>
                                                                <th class="text-white">#</th>
                                                                <th style="width:700px;" class="text-white">Name</th>
                                                                <th style="width:120px;" class="text-white">Unit</th>
                                                                <th class="text-white">Price</th>
                                                                <th class="text-white">Choose Discount</th>
                                                                <th style="width:120px;" class="text-white">Discount (%)</th>
                                                                <th style="width:120px;" class="text-white">Discount ($)</th>
                                                                <th style="width:160px;" class="text-white">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="serviceTableBody">
                                                            
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="7"><strong><span class="float-right">Grand Total (USD)</span></strong></td>
                                                                <td><strong id="grand_total">$ 0.00</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7"><strong><span class="float-right">Amount paid <i style="cursor: pointer;" class="fa fa-edit" 
                                                                data-toggle="modal" 
                                                                data-target="#fire-modal-4"
                                                                ></i></span></strong></td>
                                                                <td><span id="amount_paid">$ 0.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7"><strong><span class="float-right" id="unpaid">Unpaid amount</span></strong></td>
                                                                <td><span id="amount_unpaid">$ 0.00</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- [table_service-----------------------] -->
                            <div class="form-group mb-2">
                                <button class="btn btn-primary" id="save_patient_history"><i class="fa fa-save"></i> Submit</button>
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

   
    
    <!-- Modal -->
    <div class="modal fade" id="fire-modal-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Amount paid <sup class="text-danger">★</sup></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control form_paid" id="form_paid" inputmode="numeric" pattern="\d*" title="Please enter a number">
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn_paid" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection
