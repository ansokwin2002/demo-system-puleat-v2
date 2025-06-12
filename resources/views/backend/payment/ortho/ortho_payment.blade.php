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
                    <h1>Payment-Ortho</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item">Payment-Ortho</div>
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
                                                                <i class="fa-solid fa-user-doctor"></i>
                                                            </div>
                                                        </div>
                                                        @php 
                                                            $doctors = App\Models\Doctor::all();
                                                        @endphp
                                                        <select class="form-control " name="doctor_id" id="doctor">
                                                            <!-- <option value="" disabled>Select a Doctor</option> -->
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
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <!-- First Date Form -->
                                        <div class="form-group mb-2">
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Next :</h6>
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="next_appointment_date" id="next_appointment_date" class="form-control datepicker">
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
                                                        <h6 class="pt-2">Type Service :</h6>
                                                    </div>
                                                    <div class="box_select_customer">
                                                        <div class="card_customer">
                                                            <div class="icon_customer">
                                                                <i class="fa fa-heart"></i>
                                                            </div>
                                                            <div class="select_customer">
                                                                <select name="type_service" id="type_service" class="form-control" disabled style="cursor:not-allowed;"> 
                                                                    <option value="Ortho" data-days="30">Ortho</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- [patient-----------------------------------] -->

                                        
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                          
                            <!-- [table_service-----------------------] -->
                                <div class="horizontal-scroll-container" style="width: 100%; overflow-x: auto;" >
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
                                                            @php 
                                                                $service = App\Models\Service::where('name', 'LIKE', '%ortho%')->first();
                                                            @endphp

                                                            @if($service)
                                                                <script>
                                                                    document.addEventListener('DOMContentLoaded', function() {
                                                                        var serviceTableBody = document.getElementById('serviceTableBody');
                                                                        var rowId = 1;
                                                                        var serviceName = '{{ $service->name }}';
                                                                        var servicePrice = parseFloat('{{ $service->price }}'); // Ensure it's a float number
                                                                        var serviceId = '{{ $service->id }}';

                                                                        // Create the new row with service details
                                                                        var newRow = `
                                                                            <tr>
                                                                                <td>${rowId}</td>
                                                                                <td style="width:700px;">${serviceName}</td>
                                                                                <td style="width:120px;"><input type="text" class="form-control unit" value="1" inputmode="numeric" pattern="\\d*" title="Please enter a number"></td>
                                                                                <td class="price"><input type="text" class="form-control price" value="${servicePrice}"></td>
                                                                                <td class="d-flex">
                                                                                    <div class="form-check form-check-lg">
                                                                                        <input class="form-check-input discount-type" type="radio" name="discount${serviceId}" id="discountPercent${serviceId}" checked>
                                                                                        <label class="form-check-label mr-4" for="discountPercent${serviceId}">%</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-lg">
                                                                                        <input class="form-check-input discount-type" type="radio" name="discount${serviceId}" id="discountDollar${serviceId}">
                                                                                        <label class="form-check-label mr-4" for="discountDollar${serviceId}">$</label>
                                                                                    </div>
                                                                                </td>
                                                                                <td style="width:120px;">
                                                                                    <input type="text" class="form-control discount-percent" id="form_discount_percent${serviceId}" inputmode="numeric" pattern="\\d*" title="Please enter a number">
                                                                                </td>
                                                                                <td style="width:120px;">
                                                                                    <input type="text" class="form-control discount-dollar" id="form_discount_dollar${serviceId}" inputmode="numeric" pattern="\\d*" title="Please enter a number">
                                                                                </td>
                                                                                <td style="width:160px;"><p class="subtotal">$ ${servicePrice}.00</p></td>
                                                                            </tr>
                                                                        `;

                                                                        // Insert the new row into the table body
                                                                        serviceTableBody.innerHTML += newRow;
                                                                        
                                                                        // Update the grand total
                                                                        updateGrandTotal(servicePrice);

                                                                        rowId++;
                                                                    });

                                                                    // Function to update the grand total
                                                                    function updateGrandTotal(price) {
                                                                        var grandTotalElement = document.getElementById('grand_total');
                                                                        var currentTotal = parseFloat(grandTotalElement.innerText.replace('$', '')) || 0; // Remove '$' and convert to number
                                                                        var newTotal = currentTotal + price; // Add the service price
                                                                        grandTotalElement.innerText = `$ ${newTotal.toFixed(2)}`; // Update the grand total
                                                                    }
                                                                </script>
                                                            @endif
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
                                <!-- [patient-noted-----------------------------------] -->
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="flex-grow-1">
                                                <textarea name="patient_noted" id="patient_noted" class="summernote"></textarea>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please fill Type Patient!
                                            </div>
                                        </div>
                                    </div>
                                <!-- [patient-noted-----------------------------------] -->
                            <!-- [table_service-----------------------] -->
                            <div class="form-group">
                                <button class="btn btn-primary" id="save_ortho_patient_history"><i class="fa fa-save"></i> Submit</button>
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

    <!-- [Amount Paid-------------------------] -->
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
                        <button type="button" class="btn btn-primary btn_paid" data-dismiss="modal"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Amount Paid-------------------------] -->


</div>

@endsection

@push('scripts')

<script>
   
    // [Submit_Patient_history------------------------------]    
        $('#save_ortho_patient_history').click(function(e) {
                e.preventDefault();

                if ($('#serviceTableBody tr').length === 0) {
                    swal('Cannot submit', 'Please add at least one service first !', 'error');
                    return; 
                }
                let amountPaid = $('#amount_paid').text().trim();
                amountPaid = amountPaid.replace('$','');
                amountPaid = parseFloat(amountPaid);
                let amountUnpaid = $('#amount_unpaid').text().trim();
                amountUnpaid = amountUnpaid.replace('$','');
                amountUnpaid = parseFloat(amountUnpaid);

                let unit = $('.unit').val();

                if (unit === '') {
                    swal('Cannot submit', 'Unit Cannot be empty !', 'error');
                    return; 
                }
                if (unit == 0) {
                    swal('Cannot submit', 'Unit Cannot be zero number !', 'error');
                    return; 
                }
                // Collect all subtotals and check if any are greater than 0
                let hasNonZeroSubtotal = false;
                $('#serviceTableBody tr').each(function() {
                    let row = $(this);
                    let subtotalRow = row.find('.subtotal').text().trim().replace('$', '');
                    let subtotal = parseFloat(subtotalRow);

                    if (subtotal > 0) {
                        hasNonZeroSubtotal = true;
                    }
                });

                // Condition to block submission if amountPaid is 0 and there's at least one non-zero subtotal
                if (amountPaid === 0 && hasNonZeroSubtotal) {
                    swal('Cannot submit', 'Amount Paid Cannot be zero number!', 'error');
                    return; 
                }
                if (amountPaid === '') {
                    swal('Cannot submit', 'Amount Paid Cannot be empty !', 'error');
                    return; 
                }
                if (amountUnpaid < 0) {
                    swal('Cannot submit', 'Amount Unpaid Cannot be negative number !', 'error');
                    return; 
                }
                if (amountUnpaid > amountUnpaid) {
                    swal('Cannot submit', 'Amount Unpaid Cannot be bigger then amount paid !', 'error');
                    return; 
                }
                // Get the CSRF token directly from the meta tag
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Get data from your form or elements
                let patientId = $('#patient-select').val();
                let date = $('#date').val();
                let doctorId = $('#doctor').val(); // Ensure this is the doctor_id
                let cashierId = $('#cashier-select').val();
                let next_appointment_date = $('#next_appointment_date').val();
                let type_service = $('#type_service').val();
                let patient_noted = $('#patient_noted').val();
                let customer = $('#patient-select option:selected').text();
                let grand_total = $('#grand_total').text().trim().replace('$', '');
                let amount_paid = $('#amount_paid').text().trim().replace('$', '');
                let amount_unpaid = $('#amount_unpaid').text().trim().replace('$', '');

                // Collect data from each row
                let services = [];
                $('#serviceTableBody tr').each(function() {
                    let row = $(this);
                    let serviceName = row.find('td').eq(1).text().trim(); 
                    let serviceUnit = row.find('.unit').val();
                    let servicePrice = row.find('.price input').val().trim() || 0;
                    let discountPercent = row.find('.discount-percent').val();
                    let discountDollar = row.find('.discount-dollar').val();
                    let subtotalRow = row.find('.subtotal').text().trim().replace('$ ', '');

                    services.push({
                        service_name: serviceName,
                        service_unit: serviceUnit,
                        service_price: servicePrice,
                        discount_percent: discountPercent,
                        discount_dollar: discountDollar,
                        subtotal: subtotalRow
                    });
                });

                // Organize data to be sent, including the CSRF token
                let paymentData = {
                    _token: csrfToken,
                    patient_id: patientId,
                    doctor_id: doctorId,
                    cashier_id: cashierId, 
                    patient_payment: {
                        patientId: patientId,
                        next_appointment_date:next_appointment_date,
                        type_service:type_service,
                        patient_noted:patient_noted,
                        date: date,
                        customer: customer,
                        grand_total: grand_total,
                        amount_paid: amount_paid,
                        amount_unpaid: amount_unpaid,
                        services: services
                    }
                };

                // Base URL for the AJAX request
                let url = '/patient-save-history';
                
                // Append query parameter if patientId is present
                if (patientId) {
                    url += `?selected_patient=${patientId}`;
                }

                // AJAX request to save patient history
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: paymentData,
                    success: function(response) {
                        window.location.href = `/invoice/${response.invoice_id}`;
                    },
                    error: function(xhr) {
                        if (xhr.status === 419) { // CSRF token mismatch
                            swal('Error', 'There was an issue with your session. Please try again.', 'error');
                        } else {
                            console.error('Error saving patient history: ', xhr.responseJSON.message);
                            swal('Error','Error saving patient history: ' + xhr.responseJSON.message, 'error');
                        }
                    }
                });
        });
        $('#table_history').on('click', '.td-action', function(event) {
            event.stopPropagation(); // Prevent the click event from reaching the row
        });
    // [Submit_Patient_history------------------------------]
    
</script>

@endpush
