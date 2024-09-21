@extends('backend.master')

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
                <h1>Patient Service History</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('patient_service_history') }}">Patient</a></div>
                    <div class="breadcrumb-item">Patient Service History</div>
                </div>
            </div>
            <!-- [header-------------------------] -->

            <!--[Patient_table-------------------------]-->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable" id="table_history">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white text-center">Invoice ID</th>
                                                <th class="text-white text-center">Date</th>
                                                <th class="text-white text-center">Doctor</th>
                                                <th class="text-white text-center">Cashier</th>
                                                <th class="text-white text-center">Patient</th>
                                                <th class="text-white text-center">Grand Total</th>
                                                <th class="text-white text-center">Amount Paid</th>
                                                <th class="text-white text-center">Amount Unpaid</th>
                                                <th class="text-white text-center">Created_at</th>
                                                <th class="text-white text-center">Updated_at</th>
                                                <th class="text-white text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patientHistories as $patientHistory)
                                                @php
                                                    $paymentData = $patientHistory->patient_payment;
                                                    $doctorName = $patientHistory->doctor->name ?? '';
                                                    $cashierName = $patientHistory->cashier->name ?? '';
                                                    $patientName = $patientHistory->patient->name ?? '';
                                                @endphp
                                                <tr class="row_service_detail" data-toggle="modal" 
                                                    data-target="#fire-modal-4" data-id="{{ $patientHistory->id }}">
                                                    <td class="align-middle text-center">{{ $patientHistory->invoice_id }}</td>
                                                    <td class="align-middle text-center">{{ $paymentData['date'] ?? '' }}</td>
                                                    <td class="align-middle text-center"><span class="badge badge-dark">{{ $doctorName }}</span></td>
                                                    <td class="align-middle text-center"><span class="badge badge-success">{{ $cashierName }}</span></td>
                                                    <td class="align-middle text-center"><span class="badge badge-info">{{ $patientName }}</span></td>
                                                    <td class="align-middle text-center">${{ $paymentData['grand_total'] ?? '' }}</td>
                                                    <td class="align-middle text-center">${{ $paymentData['amount_paid'] ?? '' }}</td>
                                                    <td class="align-middle text-center">${{ $paymentData['amount_unpaid'] ?? '' }}</td>
                                                    <td class="align-middle text-center">{{ $patientHistory['created_at'] }}</td>
                                                    <td class="align-middle text-center">{{ $patientHistory['updated_at'] }}</td>
                                                    <td class="align-middle text-center td-action">
                                                        <button class="btn btn-danger" onclick="swal('Cannot Delete', 'Patient\'s history cannot be deleted after creation!', 'error');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <button class="btn btn-warning btn_edit_history_patient" 
                                                                data-invoice-id="{{ $patientHistory->invoice_id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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

    <!-- [Model Detail Patient Service-------------------------] -->
        <div class="modal fade" id="fire-modal-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-service-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Service Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="modalServiceDetails">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-white">#</th>
                                        <th class="text-white">Service Name</th>
                                        <th class="text-white">Service Unit</th>
                                        <th class="text-white">Service Price</th>
                                        <th class="text-white">Subtotal</th>
                                        <th class="text-white">Discount (%)</th>
                                        <th class="text-white">Discount ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patientHistories as $patientHistory)
                                        @foreach ($patientHistory->patient_payment['services'] ?? [] as $index => $service)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $service['service_name'] }}</td>
                                                <td>{{ $service['service_unit'] ?? 'N/A' }}</td>
                                                <td>$ {{ $service['service_price'] ?? '0.00' }}</td>
                                                <td>$ {{ $service['subtotal'] ?? '0.00' }}</td>
                                                <td>{{ $service['discount_percent'] ?? '0' }} %</td>
                                                <td>$ {{ $service['discount_dollar'] ?? '0.00' }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <textarea class="summernote" name="" id="patientsNotedContent"></textarea> 
                    </div>
                </div>
            </div>
        </div>
    <!-- [Model Detail Patient Service-------------------------] -->

     <!-- [Model Edit History Patient Service-------------------------] -->
        <div class="modal fade" id="fire-modal-history-patient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-service-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Patient History</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="editPatientForm" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <!-- Patient Information -->
                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <input type="text" id="customer" name="customer" class="form-control">

                                <label for="date">Date</label>
                                <input type="text" id="date" name="date" class="form-control">

                                <label for="next_appointment_date">Next Appointment Date</label>
                                <input type="text" id="next_appointment_date" name="next_appointment_date" class="form-control">

                                <label for="type_service">Type of Service</label>
                                <input type="text" id="type_service" name="type_service" class="form-control">

                                <label for="amount_paid">Amount Paid</label>
                                <input type="text" id="amount_paid" name="amount_paid" class="form-control">

                                <label for="grand_total">Grand Total</label>
                                <input type="text" id="grand_total" name="grand_total" class="form-control">

                                <label for="amount_unpaid">Amount Unpaid</label>
                                <input type="text" id="amount_unpaid" name="amount_unpaid" class="form-control">
                            </div>

                            <!-- Services Table -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="servicesTable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white">Service Name</th>
                                            <th class="text-white">Service Unit</th>
                                            <th class="text-white">Service Price</th>
                                            <th class="text-white">Subtotal</th>
                                            <th class="text-white">Discount (%)</th>
                                            <th class="text-white">Discount ($)</th>
                                            <th class="text-white">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="servicesBody">
                                        <!-- Rows will be populated dynamically -->
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-success" id="addServiceRow">Add Service</button>
                            </div>

                            <!-- Patient Note -->
                            <div class="form-group">
                                <label for="patient_noted">Patient Note</label>
                                <textarea class="form-control" id="patient_noted" name="patient_noted"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- [Model Edit History Patient Service-------------------------] -->
</div>

@endsection
