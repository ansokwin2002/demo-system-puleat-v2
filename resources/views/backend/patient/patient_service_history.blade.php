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
                                    <table class="table table-striped dataTable" id="table_service">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Doctor</th>
                                                <th class="text-white">Customer</th>
                                                <th class="text-white">Grand Total</th>
                                                <th class="text-white">Amount Paid</th>
                                                <th class="text-white">Amount Unpaid</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patientHistories as $patientHistory)
                                                @php
                                                    $paymentData = $patientHistory->patient_payment;
                                                @endphp
                                                <tr class="row_service_detail" data-toggle="modal" 
                                                data-target="#fire-modal-4" data-id="{{ $patientHistory->id }}">
                                                    <td>{{ $paymentData['date'] ?? '' }}</td>
                                                    <td>{{ $paymentData['doctor'] ?? '' }}</td>
                                                    <td>{{ $paymentData['customer'] ?? '' }}</td>
                                                    <td>{{ $paymentData['grand_total'] ?? '' }}</td>
                                                    <td>{{ $paymentData['amount_paid'] ?? '' }}</td>
                                                    <td>{{ $paymentData['amount_unpaid'] ?? '' }}</td>
                                                    <td>
                                                        <i style="cursor: pointer;" class="fa fa-eye" 
                                                        data-toggle="modal" 
                                                        data-target="#fire-modal-4"
                                                        data-id="{{ $patientHistory->id }}">
                                                        </i>
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
                            <table class="table table-striped" id="modalServiceDetails">
                                <thead>
                                    <tr>
                                        <th>Service Name</th>
                                        <th>Service Unit</th>
                                        <th>Service Price</th>
                                        <th>Subtotal</th>
                                        <th>Discount (%)</th>
                                        <th>Discount ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Service details will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Model Detail Patient Service-------------------------] -->


</div>

@endsection
