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
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Patient</a></div>
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
                            <table class="table table-striped dataTable" id="table_appoinment">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-white">Invoice ID</th>
                                        <th class="text-white">Date</th>
                                        <th class="text-white">Doctor</th>
                                        <th class="text-white">Patient</th>
                                        <th class="text-white">Service</th>
                                        <th class="text-white">Next Appointment</th>
                                        <th class="text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($patientHistories as $patientHistory)
                                    @php
                                      
                                        $paymentData = $patientHistory->patient_payment;
                                        $doctorName = $patientHistory->doctor->name ?? '';
                                        $patientName = $patientHistory->patient->name ?? '';
                                        $services = $paymentData['services'] ?? [];
                                    @endphp
                                    <tr class="row_appointment">
                                        <td class="align-middle text-center">{{ $patientHistory->invoice_id }}</td>
                                        <td class="align-middle text-center">{{ $paymentData['date'] ?? '' }}</td>
                                        <td class="align-middle text-center"><span class="badge badge-dark">{{ $doctorName }}</span></td>
                                        <td class="align-middle text-center"><span class="badge badge-info">{{ $patientName }}</span></td>
                                        <td class="align-middle text-center">
                                            @foreach($services as $service)
                                                <span class="badge badge-success">{{ $service['service_name'] ?? 'N/A' }}</span><br><br>
                                            @endforeach
                                        </td>
                                        <td class="align-middle text-center">{{ $paymentData['next_appointment_date'] ?? '' }}</td>
                                        <td class="td-action align-middle text-center">
                                            <button class="btn btn-danger" onclick="swal('Cannot Delete', 'Appointment can only be updated after creation !', 'error');"><i class="fa fa-trash"></i></button>
                                            <button class="btn btn-warning btn_edit_appointment" 
                                                data-toggle="modal" 
                                                data-target="#fire-modal-appointment"
                                                data-id="{{ $patientHistory->id }}"
                                                data-date="{{ $paymentData['next_appointment_date'] }}">
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
    <!-- [Model Detail Patient Appointment-------------------------] -->
        <div class="modal fade" id="fire-modal-appointment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-appointment">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="editAppointmentForm" method="post">
                        @csrf
                        @method('PUT') <!-- Added method spoofing -->
                        <input type="hidden" name="id" id="appointment-id">
                        <div class="form-group">
                            <label for="name">Next Appointment:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="appointment_date" id="appointment-date" class="form-control datepicker" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    <!-- [Model Detail Patient Appointment-------------------------] -->
</div>

@endsection
