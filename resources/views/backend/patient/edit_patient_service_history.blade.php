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
                <h1>Edit Payment</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Edit Payment</div>
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
                                        <!-- Date Form -->
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
                                                        <input type="text" class="form-control datepicker" id="date" value="{{ $patientPaymentData['date'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Doctor Form -->
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
                                                        <select class="form-control" name="doctor_id" id="doctor">
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}" {{ $doctor->id == $patientHistory->doctor_id ? 'selected' : '' }}>
                                                                    {{ $doctor->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-8">
                                        <div class="container-fluid pl-0 pr-0">
                                            <!-- Patient Form -->
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
                                                                <select id="patient-select" class="form-control select2" style="width: 100%;">
                                                                    <option value="" disabled>Select a Patient</option>
                                                                    @foreach ($patients as $patient)
                                                                        <option value="{{ $patient->id }}" {{ $patient->id == $patientHistory->patient_id ? 'selected' : '' }}>
                                                                            {{ $patient->name }} ({{ $patient->telephone }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Cashier Form -->
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
                                                                <select id="cashier-select" name="cashier_id" class="form-control select2" style="width: 100%;">
                                                                    <option value="" disabled>Select a Cashier</option>
                                                                    @foreach ($cashiers as $cashier)
                                                                        <option value="{{ $cashier->id }}" {{ $cashier->id == $patientHistory->cashier_id ? 'selected' : '' }}>
                                                                            {{ $cashier->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <!-- Next Appointment Date Form -->
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
                                                        <input type="text" name="next_appointment_date" id="next_appointment_date" class="form-control datepicker" value="{{ $patientPaymentData['next_appointment_date'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-8">
                                        <div class="container-fluid pl-0 pr-0">
                                            <!-- Type Service Form -->
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
                                                                <select name="type_service" id="type_service" class="form-control">
                                                                    <option value="General" {{ $patientPaymentData['type_service'] == 'General' ? 'selected' : '' }}>General</option>
                                                                    <option value="Implant" {{ $patientPaymentData['type_service'] == 'Implant' ? 'selected' : '' }}>Implant</option>
                                                                    <option value="Ortho" {{ $patientPaymentData['type_service'] == 'Ortho' ? 'selected' : '' }}>Ortho</option>
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
                            <!-- Service Selection -->
                            <div class="" style="width: 100%;">
                                <div class="container-fluid pl-0 pr-0 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-sm-5 col-md-8 col-lg-12">
                                            <div class="card_service">
                                                <div class="icon_service">
                                                    <button class="btn btn-primary" style="width: 100%;height:100%;">Services</button>
                                                </div>
                                                <div class="select_service">
                                                    <select id="serviceSelect" class="form-control select2" style="width: 100%;">
                                                        @php 
                                                            use App\Models\Service;
                                                            $services = Service::latest('created_at')->get();
                                                        @endphp
                                                        <option>Select a Service</option>
                                                        @foreach ($services as $service)
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
                            <!-- Service Table -->
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
                                                        @foreach ($patientPaymentData['services'] as $key => $service)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td style="width:700px;">
                                                                    {{ $service['service_name'] }}
                                                                    <button class="btn btn-danger remove-row float-right">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                                <td style="width:120px;">
                                                                    <input type="text" id="unit" class="form-control unit" value="{{ $service['service_unit'] }}">
                                                                </td>
                                                                <td class="price">
                                                                    <p>$ {{ number_format($service['service_price'], 2) }}</p>
                                                                </td>
                                                                <td class="d-flex">
                                                                    <div class="form-check form-check-lg">
                                                                        <input class="form-check-input discount-type" type="radio" name="discount{{ $key }}" id="discountPercent{{ $key }}" value="percent" checked>
                                                                        <label class="form-check-label mr-4" for="discountPercent{{ $key }}">%</label>
                                                                    </div>
                                                                    <div class="form-check form-check-lg">
                                                                        <input class="form-check-input discount-type" type="radio" name="discount{{ $key }}" id="discountDollar{{ $key }}" value="dollar">
                                                                        <label class="form-check-label mr-4" for="discountDollar{{ $key }}">$</label>
                                                                    </div>
                                                                </td>
                                                                <td style="width:120px;">
                                                                    <input type="text" class="form-control discount-percent" id="form_discount_percent{{ $key }}" value="{{ $service['discount_percent'] ?? '' }}" inputmode="numeric" pattern="\d*" title="Please enter a number">
                                                                </td>
                                                                <td style="width:120px;">
                                                                    <input type="text" class="form-control discount-dollar" id="form_discount_dollar{{ $key }}" value="{{ $service['discount_dollar'] ?? '' }}" inputmode="numeric" pattern="\d*" title="Please enter a number">
                                                                </td>
                                                                <td style="width:160px;">
                                                                    <p class="subtotal">$ {{ number_format($service['subtotal'], 2) }}</p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>

                                                    <tbody>
                                                        <tr>
                                                            <td colspan="7"><strong><span class="float-right">Grand Total (USD)</span></strong></td>
                                                            <td><strong id="grand_total">$ 0.00</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7"><strong><span class="float-right">Amount paid <i style="cursor: pointer;" class="fa fa-edit" 
                                                            data-toggle="modal" 
                                                            data-target="#fire-modal-4"></i></span></strong></td>
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
                                <div class="form-group">
                                    <button class="btn btn-primary" id="update_patient_history"><i class="fa fa-save"></i> Update</button>
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

    $(document).ready(function() {
        
        // [Select_Service---------------------]
            $('#serviceSelect').off('change', function() {
                const selectedOption = $(this).find('option:selected');
                const serviceName = selectedOption.data('name-service');
                const serviceUnit = selectedOption.data('unit-service');
                const servicePrice = selectedOption.data('price-service');  
                const serviceId = Date.now(); // Unique ID based on timestamp

                const tableRow = `
                    <tr>
                        <td></td>
                        <td style="width:700px;">${serviceName}<button class="btn btn-danger remove-row float-right"><i class="fa fa-trash"></i></button></td>
                        <td style="width:120px;"><input type="text" class="form-control unit" inputmode="numeric" pattern="\d*" title="Please enter a number"></td>
                        <td class="price"><p>$ ${servicePrice}</p></td>
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
                            <input type="text" class="form-control discount-percent" id="form_discount_percent${serviceId}" inputmode="numeric" pattern="\d*" title="Please enter a number">
                        </td>
                        <td style="width:120px;">
                            <input type="text" class="form-control discount-dollar" id="form_discount_dollar${serviceId}" inputmode="numeric" pattern="\d*" title="Please enter a number">
                        </td>
                        <td style="width:160px;"><p class="subtotal">$0.00</p></td>
                    </tr>
                `;

                $('#serviceTableBody').append(tableRow);
                updateRowNumbers(); 
                updateInputState();
                calculateSubtotal();
                updateGrandTotal();
            });

            function calculateSubtotal() {
                $('#serviceTableBody').find('tr').each(function() {
                    const servicePrice = parseFloat($(this).find('.price p').text().replace('$ ', ''));
                    const unit = parseFloat($(this).find('.unit').val()) || 0;
                    const discountPercent = parseFloat($(this).find('.discount-percent').val()) || 0;
                    const discountDollar = parseFloat($(this).find('.discount-dollar').val()) || 0;

                    let subtotal = servicePrice * unit;

                    // Apply discount based on the selected type
                    const isPercentChecked = $(this).find('input.discount-type:checked').attr('id').includes('Percent');
                    
                    if (isPercentChecked) {
                        subtotal = subtotal - (subtotal * (discountPercent / 100));
                    } else {
                        subtotal = subtotal - discountDollar;
                    }

                    // Ensure subtotal does not go below zero
                    subtotal = Math.max(subtotal, 0);

                    $(this).find('.subtotal').text('$ ' + subtotal.toFixed(2));
                });
            }

            $('#serviceTableBody').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
                updateRowNumbers(); 
            });

            function updateRowNumbers() {
                $('#serviceTableBody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1); 
                });
            }

            function updateInputState() {
                $('#serviceTableBody').find('tr').each(function() {
                    var isPercentChecked = $(this).find('input.discount-type:checked').attr('id').includes('Percent');
                    
                    if (isPercentChecked) {
                        $(this).find('.discount-percent').removeClass('disabled-input').attr('readonly', false);
                        $(this).find('.discount-dollar').addClass('disabled-input').attr('readonly', true);
                    } else {
                        $(this).find('.discount-percent').addClass('disabled-input').attr('readonly', true);
                        $(this).find('.discount-dollar').removeClass('disabled-input').attr('readonly', false);
                    }
                });
            }

            // Event handlers for discount changes
            $('#serviceTableBody').on('change', 'input.discount-type', function() {
                updateInputState();
                calculateSubtotal();
                updateGrandTotal();
            });

            // Event handlers for input changes
            $('#serviceTableBody').on('input', '.unit, .discount-percent, .discount-dollar', function() {
                calculateSubtotal();
                updateGrandTotal();
            });

        // [Select_Service---------------------]

        // [Update Grand Total------------------------]
            function updateGrandTotal() {
                let grandTotal = 0;

                $('#serviceTableBody').find('tr').each(function() {
                    const subtotalText = $(this).find('.subtotal').text().replace('$ ', '');
                    const subtotal = parseFloat(subtotalText) || 0;
                    grandTotal += subtotal;
                });
                // $('#grand_total').closest('tr').find('td:last').html('<strong>$ ' + grandTotal.toFixed(2) + '</strong>');
                $('#grand_total').html('<strong>$ ' + grandTotal.toFixed(2) + '</strong>');
            }

            $('#serviceTableBody').on('click', '.remove-row', function() {
                $(this).closest('tr').remove(); 
                updateRowNumbers();
                updateGrandTotal();
                $('#amount_paid').text('$ 0.00');
                $('#amount_unpaid').text('$ 0.00');
            });
        // [Update Grand Total------------------------]

        // [Unit-----------------------]
            $('#serviceTableBody').on('keyup', '#unit', function() {
                var $row = $(this).closest('tr'); 
                var unit = parseFloat($(this).val()); 
                var priceText = $row.find('#price').text();
                var price = parseFloat(priceText.replace('$', '').trim());
                
                if (!isNaN(unit) && !isNaN(price)) { 
                    var total = unit * price; 
                    $row.find('#subtotal').text('$ ' + total.toFixed(2)); 
                } else {
                    $row.find('#subtotal').text('$ 0.00'); 
                }
                $('#amount_paid').text('$ 0.00');
                $('#amount_unpaid').text('$ 0.00');
            });
        // [Unit-----------------------]

        // [Validation_Unit---------------------]
            $('#serviceTableBody').on('input', '.unit, .discount-percent, .discount-dollar', function() {
                var value = $(this).val();
                var numericValue = value.replace(/[^0-9.]/g, ''); 

                if (value !== numericValue) {
                    $(this).val(numericValue); 
                }
                $('#amount_paid').text('$ 0.00');
                $('#amount_unpaid').text('$ 0.00');
            });

            $('#serviceTableBody').on('blur', '.unit, .discount-percent, .discount-dollar', function() {
                var value = $(this).val();
                if (isNaN(value) || value.trim() === '') {
                    $(this).val(''); 
                }
            });
        // [Validation_Unit---------------------]

        // [Validation Form paid--------------------]
            $(document).on('input', '.form_paid', function() {
                var value = $(this).val();
                var numericValue = value.replace(/[^0-9.]/g, ''); 

                if (value !== numericValue) {
                    $(this).val(numericValue); 
                }
            });

            $(document).on('blur', '.form_paid', function() {
                var value = $(this).val();
                if (isNaN(value) || value.trim() === '') {
                    $(this).val(''); 
                }
            });
        // [Validation Form paid--------------------]

        // [getInvoiceIdFromUrl----------------------------]
            function getInvoiceIdFromUrl() {
                let urlPath = window.location.pathname; 
                let segments = urlPath.split('/');
                return segments[segments.length - 1];
            }
        // [getInvoiceIdFromUrl----------------------------]

        // [Submit_Patient_history------------------------------]    
   
            $('#update_patient_history').click(function(e) {
                e.preventDefault();
                if ($('#serviceTableBody tr').length === 0) {
                    swal('Cannot submit', 'Please add at least one service first.', 'error');
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
                if (amountPaid === 0) {
                    swal('Cannot submit', 'Amount Paid Cannot be zero number !', 'error');
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
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let patientId = $('#patient-select').val();
                let date = $('#date').val();
                let doctorId = $('#doctor').val();
                let cashierId = $('#cashier-select').val();
                let next_appointment_date = $('#next_appointment_date').val();
                let type_service = $('#type_service').val();
                let patient_noted = $('#patient_noted').val();
                let grand_total = $('#grand_total').text().trim().replace('$', '');
                let amount_paid = $('#amount_paid').text().trim().replace('$', '');
                let amount_unpaid = $('#amount_unpaid').text().trim().replace('$', '');
                let customer = $('#patient-select option:selected').text(); 
                if (!patientId || !doctorId || !cashierId || !date) {
                    swal('Error', 'Please fill in all required fields.', 'error');
                    return;
                }
                let services = [];
                $('#serviceTableBody tr').each(function() {
                    let row = $(this);
                    let serviceName = row.find('td').eq(1).text().trim();
                    let serviceUnit = row.find('.unit').val();
                    let servicePrice = row.find('.price p').text().trim().replace('$ ', '');
                    let discountPercent = row.find('.discount-percent').val();
                    let discountDollar = row.find('.discount-dollar').val();
                    let subtotalRow = row.find('.subtotal').text().trim().replace('$ ', '');

                    services.push({
                        service_name: serviceName,
                        service_unit: serviceUnit,
                        service_price: servicePrice,
                        discount_percent: discountPercent || 0,
                        discount_dollar: discountDollar || 0,
                        subtotal: subtotalRow
                    });
                });
                let invoiceId = getInvoiceIdFromUrl(); 
                let paymentData = {
                    _token: csrfToken,
                    patient_id: patientId,
                    doctor_id: doctorId,
                    cashier_id: cashierId,
                    patient_payment: {
                        patientId: patientId, 
                        next_appointment_date: next_appointment_date,
                        type_service: type_service,
                        patient_noted: patient_noted,
                        date: date,
                        customer: customer,
                        grand_total: grand_total,
                        amount_paid: amount_paid,
                        amount_unpaid: amount_unpaid,
                        services: services
                    }
                };
                let url = `/edit-patient-all-history/${invoiceId}`;
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: paymentData,
                    success: function(response) {
                        if (response.invoice_id) {
                            window.location.href = `/invoice/${response.invoice_id}`;
                        } else {
                            swal('Error', 'Unexpected response from the server. Please try again.', 'error');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 419) { // CSRF token mismatch
                            swal('Error', 'There was an issue with your session. Please try again.', 'error');
                        } else if (xhr.status === 422) { // Validation errors
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = 'Please fix the following errors:\n';
                            $.each(errors, function(key, value) {
                                errorMessage += `- ${value}\n`;
                            });
                            swal('Error', errorMessage, 'error');
                        } else {
                            swal('Error', 'Error saving patient history: ' + xhr.responseJSON.message, 'error');
                        }
                    }
                });
            });
        // [Submit_Patient_history------------------------------]

        // [Button Paid---------------------------]
            $('.btn_paid').on('click', function() {
                if ($('#grand_total').length > 0) {
                    let grandTotalText = $('#grand_total').text().replace('$', '').trim();
                    let grandTotal = parseFloat(grandTotalText) || 0;
                    let amountPaid = parseFloat($('#form_paid').val()) || 0;
                    $('#amount_paid').text('$ ' + amountPaid.toFixed(2));

                    const amountUnpaid = grandTotal - amountPaid;
                    $('#amount_unpaid').text('$ ' + amountUnpaid.toFixed(2)); 
                } else {
                    alert('Element #grand_total not found or it is empty.');
                }
                $('#fire-modal-4').modal('hide');
            });
            $('.close, .btn-secondary').on('click', function() {
                $('#fire-modal-4').modal('hide');
            });
        // [Button Paid---------------------------]

        // [Summernote---------------------------]
            $('.summernote').summernote({
                height: 200, // Set the height of the editor
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            // Set the content of Summernote with existing data
            var patientNoted = @json($patientPaymentData['patient_noted']);
            $('.summernote').summernote('code', patientNoted);
        // [Summernote---------------------------]

        // [grand_total-amount_paid-amount_unpaid---------------------------]
            var patientPaymentData = @json($patientPaymentData);
            $('#grand_total').text('$ ' + patientPaymentData.grand_total);
            $('#amount_paid').text('$ ' + patientPaymentData.amount_paid);
            $('#amount_unpaid').text('$ ' + patientPaymentData.amount_unpaid);
        // [grand_total-amount_paid-amount_unpaid---------------------------]

    });
</script>


@endpush