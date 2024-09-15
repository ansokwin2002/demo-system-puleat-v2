<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Clinic System Puleat V2</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- [font khmer-------------------------] -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bayon&family=Khmer&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@100..900&display=swap" rel="stylesheet">

  <!-- General CSS Files -->
  <link rel="stylesheet" href=" {{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

  <!-- [editor-------------------------------] -->
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
  <!-- [editor-------------------------------] -->

  <!-- [dropzone----------------------------------] -->
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/dropzonejs/dropzone.css') }}">
  <!-- [dropzone----------------------------------] -->
  <!-- [Gallary-------------------------------------] -->
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/chocolat/dist/css/chocolat.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <!-- [Gallary-------------------------------------] -->

  <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/datatables.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href=" {{ asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href=" {{ asset('backend/assets/css/components.css') }}">

  <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />

</head>

<style>
    .disabled-input {
        background-color: #e9ecef;
        cursor: not-allowed;
    }
</style>

<body>
   
  <div id="app">
     <!-- [loading-----------------------] -->
     @include('backend.body.loader')
    <!-- [loading-----------------------] -->
        <!-- Loading spinner (initially hidden) -->
        <div id="loading-spinner" style="display: none; position: fixed; bottom: 9%; right: 3%; z-index: 1000;">
            <i class="fa fa-spinner fa-spin bg-primary p-2 text-white spinner-shadow" style="font-size: 24px; border-radius: 50%;"></i>
        </div>

     @yield('content')
  </div>
  <script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>

  <!-- General JS Scripts -->
  <script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/stisla.js') }}"></script>
  
  <!-- JS Libraries -->
  <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
  
  <!-- [editor--------------------------------------] -->
    <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <!-- [editor--------------------------------------] -->

  <!-- [dropzone---------------------------------] -->
    <script src="{{ asset('backend/assets/modules/dropzonejs/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/page/components-multiple-upload.js') }}"></script>
  <!-- [dropzone---------------------------------] -->

  <!-- [Gallary--------------------------------------] -->
    <script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <!-- [Gallary--------------------------------------] -->

  <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>

  <!-- Initialize DataTable -->

  <script>
    //[loading-------------------------------------------]
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('loader').style.display = 'none';
        });

        window.addEventListener('beforeunload', function () {
            document.getElementById('loader').style.display = 'block';
        });
    //[loading-------------------------------------------]
      
      $(document).ready(function() {

        // [appointment_date-----------------------------]
            $('#appointmentNotificationModal').modal('show');
        // [appointment_date-----------------------------]


            // // [loading-------------------------------]
            //     $('.loading').show();
            //     $(window).on('load', function() {
            //         $('.loading').fadeOut(); 
            //     });
            // // [loading-------------------------------]

            // [current_year--------------------------]
                const currentYear = new Date().getFullYear();
                document.getElementById('year').textContent = currentYear;
            // [current_year--------------------------]

            // [dataTable_Service---------------------]
                $('#table_service').DataTable({
                    "pageLength": 10,
                });
            // [dataTable_Service---------------------]

            // [dataTable_Patient---------------------]
                $('#table_patient').DataTable({
                    "pageLength": 50,
                });
            // [dataTable_Patient---------------------]

            // [dataTable_Doctor---------------------]
                $('#table_doctor').DataTable({
                    "pageLength": 50,
                });
            // [dataTable_Doctor---------------------]

            // [dataTable_Cashier---------------------]
                $('#table_cashier').DataTable({
                    "pageLength": 50,
                });
            // [dataTable_Cashier---------------------]

            // [dataTable_Appoinment---------------------]
                $('#table_appoinment').DataTable({
                    "pageLength": 50,
                });
            // [dataTable_Appoinment---------------------]

            // [dataTable_Patient_History---------------------]
                $('#table_patient_history').DataTable({
                     "pageLength": 50,
                });
            // [dataTable_Patient_History---------------------]

            // [dataTable_Patient_History---------------------]
                $('#table_patient_all_history').DataTable({
                    "pageLength": 50,
                });
            // [dataTable_Patient_History---------------------]

            // [dataTable_Patient_History---------------------]
                $('#table_notification').DataTable({
                        "pageLength": 50,
                });
            // [dataTable_Patient_History---------------------]

            // [summernote-------------------------------]
                $('.summernote').summernote({
                    height: 100 
                });
            // [summernote-------------------------------]


            // [Select_Service---------------------]
                $('#serviceSelect').on('change', function() {
                    const selectedOption = $(this).find('option:selected');
                    const serviceName = selectedOption.data('name-service');
                    const serviceUnit = selectedOption.data('unit-service');
                    const servicePrice = selectedOption.data('price-service');  
                    const serviceId = Date.now(); // Unique ID based on timestamp

                    const tableRow = `
                        <tr>
                            <td></td>
                            <td style="width:700px;">${serviceName}<button class="btn btn-danger remove-row float-right"><i class="fa fa-trash"></i></button></td>
                            <td style="width:120px;"><input type="text" class="form-control unit" value="1" inputmode="numeric" pattern="\d*" title="Please enter a number"></td>
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
                    $('#amount_paid').text('$ 0.00');
                    $('#amount_unpaid').text('$ 0.00');
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

            // [Submit_Patient_history------------------------------]    
                $('#save_patient_history').click(function(e) {
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
                        let serviceName = row.find('td').eq(1).text().trim(); // Adjust index if necessary
                        let serviceUnit = row.find('.unit').val();
                        let servicePrice = row.find('.price p').text().trim().replace('$ ', '');
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

            // [Detail_Patient_Service--------------------------]
                $('#table_service').on('click', '.row_service_detail', function(event) {
                    if ($(event.target).closest('.td-action').length > 0) {
                        return; // Exit the function if an action td-action was clicked
                    }
                    const patientId = $(this).data('id');
                    
                    // Fetch the patient details using AJAX
                    $.ajax({
                        url: `/patient-details/${patientId}`,
                        method: 'GET',
                        success: function(response) {
                            const paymentData = response.patient_payment;

                            // Clear any previous data
                            $('#modalServiceDetails tbody').empty();

                            // Populate the modal with service details
                            let i = 1;
                            if (paymentData && paymentData.services) {
                                paymentData.services.forEach(service => {
                                    $('#modalServiceDetails tbody').append(`
                                        <tr>
                                            <td>${i++}</td>
                                            <td>${service.service_name}</td>
                                            <td>${service.service_unit}</td>
                                            <td>${service.service_price ? '$ ' + service.service_price : ''}</td>
                                            <td>${service.subtotal ? '$ ' + service.subtotal : ''}</td>
                                            <td>${service.discount_percent ? service.discount_percent + ' %' : ''}</td>
                                            <td>${service.discount_dollar ? '$ ' + service.discount_dollar : ''}</td>
                                        </tr>
                                    `);
                                });
                            } else {
                                $('#modalServiceDetails tbody').append('<tr><td colspan="6">No services available</td></tr>');
                            }
                        },
                        error: function(xhr) {
                            console.error('Error fetching patient details:', xhr.responseText);
                        }
                    });
                });
                $('#table_service').on('click', '.td-action', function(event) {
                    event.stopPropagation(); // Prevent the click event from reaching the row
                });
            // [Detail_Patient_Service--------------------------]

            
            // [page-add-pateint---------------------------]

                // [type-patient----------------------------]
                    // Function to replace select with text input
                    function switchToTextInput() {
                        $('#type-patient-wrapper').html(`
                            <div class="input-group-prepend">
                                <div class="input-group-text" id="type-patient-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                            </div>
                            <input type="text" name="type_patient" class="form-control">
                        `);
                    }

                    // Function to replace text input with select
                    function switchToSelect() {
                        $('#type-patient-wrapper').html(`
                            <div class="input-group-prepend">
                                <div class="input-group-text" id="type-patient-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                            </div>
                            <select name="type_patient" class="form-control" id="type-patient-select">
                                <option value="Walk-in">Walk-in</option>
                                <option value="Customize">Customize</option>
                            </select>
                        `);

                        // Reattach event listener to the select element
                        $('#type-patient-select').on('change', function() {
                            if ($(this).val() === 'Customize') {
                                switchToTextInput();
                            }
                        });
                    }

                    // Initial event listener for select change
                    $('#type-patient-select').on('change', function() {
                        if ($(this).val() === 'Customize') {
                            switchToTextInput();
                        }
                    });

                    // Event listener for switching back to select when clicking the icon
                    $(document).on('click', '#type-patient-icon', function() {
                        switchToSelect();
                    });
                // [type-patient----------------------------]

            // [page-add-pateint---------------------------]

            // [page-list-patient-------------------------------]

                // [patient-detail-------------------------]

                    $('#table_service').on('click', '.row_service_detail', function(event) {
                        if ($(event.target).closest('.td-action').length > 0) {
                            return; // Exit the function if an action td-action was clicked
                        }

                        const patientId = $(this).data('id');

                        // Make an AJAX call to fetch the patient's noted data
                        $.ajax({
                            url: '/get-patient-noted', // Define this route in your web.php
                            method: 'GET',
                            data: { id: patientId },
                            success: function(response) {
                                console.log(response);
                                // Populate the modal with the patient's noted information
                                $('#patientsNotedContent').summernote('code', response.patient_noted);
                                // Show the modal
                                $('#fire-modal-4').modal('show');
                            },
                            error: function() {
                                alert('Failed to fetch patient notes.');
                            }
                        });
                    });

                    $('#table_service').on('click', '.td-action', function(event) {
                        event.stopPropagation(); // Prevent the click event from reaching the row
                    });


                // [patient-detail-------------------------]


            // [page-list-patient-------------------------------]

            // [page-list-service-----------------------------------]

                // [Edit Service----------------------------]
                    $('.btn_edit_service').on('click', function() {
                        var id = $(this).data('id');
                        var name = $(this).data('name');
                        var unit = $(this).data('unit');
                        var price = $(this).data('price');

                        $('#service-id').val(id);
                        $('#service-name').val(name);
                        $('#service-unit').val(unit);
                        $('#service-price').val(price);

                        // Update the form action URL to include the service ID
                        var formAction = "{{ route('service_Update', ':id') }}";
                        formAction = formAction.replace(':id', id);
                        $('#editServiceForm').attr('action', formAction);
                    });
                // [Edit Service----------------------------]

                // [Delete Service----------------------------]
                    $('#ModelDeleteService').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget); // Button that triggered the modal
                        var id = button.data('id'); // Extract info from data-* attributes

                        var form = $('#deleteForm');
                        var actionUrl = "{{ route('service_Delete', ':id') }}";
                        actionUrl = actionUrl.replace(':id', id);

                        // Update the form action attribute
                        form.attr('action', actionUrl);
                    });
                // [Delete Service----------------------------]

            // [page-list-service-----------------------------------]

            // [next-appointment-date------------------------------------]
                $('#date').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });

                function calculateNextAppointment() {
                    var typeService = $('#type_service').find(':selected').data('days');
                    var selectedDate = $('#date').val();

                    // alert('Selected Date: ' + selectedDate + '\nType Service Days: ' + typeService);
                    
                    if (typeService && selectedDate) {
                        var date = new Date(selectedDate);
                        date.setDate(date.getDate() + parseInt(typeService));
                        var day = String(date.getDate()).padStart(2, '0');
                        var month = String(date.getMonth() + 1).padStart(2, '0');
                        var year = date.getFullYear();
                        var formattedDate = `${year}-${month}-${day}`;
                        $('#next_appointment_date').val(formattedDate);
                    }
                }
                $('#type_service').on('change', function () {
                    calculateNextAppointment();
                });
                $('#date').on('apply.daterangepicker', function () {
                    calculateNextAppointment();
                });
                //-change-by-default
                calculateNextAppointment();
            // [next-appointment-date------------------------------------]

            // [page-list-doctor-----------------------------------]
                // [Edit Doctor----------------------------]
                    $('.btn_edit_doctor').on('click', function() {
                        var id = $(this).data('id');
                        var name = $(this).data('name');
                        var sex = $(this).data('sex');
                        var specialization = $(this).data('specialization');
                        var phone = $(this).data('phone');
                        var email = $(this).data('email');

                        $('#doctor-id').val(id);
                        $('#doctor-name').val(name);
                        $('#doctor-specialization').val(specialization);
                        $('#doctor-phone').val(phone);
                        $('#doctor-email').val(email);
                        $('#doctor-select').val(sex).change();

                        // Update the form action URL to include the doctor ID
                        var formAction = "{{ route('doctor.update', ':id') }}";
                        formAction = formAction.replace(':id', id);
                        $('#editDoctorForm').attr('action', formAction);
                    });
                // [Edit Doctor----------------------------]

                // [Delete Doctor----------------------------]
                    $('#ModelDeleteDoctor').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget); // Button that triggered the modal
                        var id = button.data('id'); // Extract info from data-* attributes

                        var form = $('#deleteForm');
                        var actionUrl = "{{ route('doctor.destroy', ':id') }}";
                        actionUrl = actionUrl.replace(':id', id);

                        // Update the form action attribute
                        form.attr('action', actionUrl);
                    });
                // [Delete Doctor----------------------------]

            // [page-list-doctor-----------------------------------]

            // [page-list-cashier-----------------------------------]
                // [Edit Cashier----------------------------]
                    $('.btn_edit_cashier').on('click', function() {
                        var id = $(this).data('id');
                        var name = $(this).data('name');
                        var sex = $(this).data('sex');
                        var email = $(this).data('email');
                        var telephone = $(this).data('telephone');

                        $('#cashier-id').val(id);
                        $('#cashier-name').val(name);
                        $('#cashier-sex').val(sex);
                        $('#cashier-email').val(email);
                        $('#cashier-telephone').val(telephone);
                        $('#cashier-select').val(sex).change();

                        var formAction = "{{ route('cashier.update', ':id') }}";
                        formAction = formAction.replace(':id', id);
                        $('#editCashierForm').attr('action', formAction);
                    });
                // [Edit Cashier----------------------------]
            // [page-list-cashier-----------------------------------]

            // [page-list-appointment-----------------------------------]
                // [Edit appointment----------------------------]

                $('.btn_edit_appointment').on('click', function() {
                    var id = $(this).data('id');
                    var date = $(this).data('date');
                    // Set the form values
                    $('#appointment-id').val(id);
                    $('#appointment-date').val(date);

                    // Update the form action URL
                    var formAction = "{{ route('appointments.update', ':id') }}".replace(':id', id);
                    $('#editAppointmentForm').attr('action', formAction);

                    // Show the modal
                    $('#fire-modal-appointment').modal('show');
            
                });

                // [Edit appointment----------------------------]
            // [page-list-appointment-----------------------------------]

            // [Hide_Notification---------------------------------]
                $('.btn_hide_notification').on('click', function() {
                    // Find the closest row and hide it
                    $(this).closest('tr').hide();
                    
                    // Optionally, you can send an AJAX request to mark the notification as "hidden" if needed
                    // var id = $(this).data('id');
                    // $.ajax({
                    //     url: '/path/to/your/route/' + id,
                    //     type: 'POST',
                    //     data: {
                    //         _token: '{{ csrf_token() }}',
                    //         // Additional data if needed
                    //     },
                    //     success: function(response) {
                    //         // Handle success response
                    //     },
                    //     error: function(xhr) {
                    //         // Handle error response
                    //     }
                    // });
                });
            // [Hide_Notification---------------------------------]

            // [page-list-patient-----------------------------------]

                // [Edit Patinet----------------------------]
                    $('.btn_edit_patient').on('click', function() {
                        var id = $(this).data('id');
                        var name = $(this).data('name');
                        var age = $(this).data('age');
                        var sex = $(this).data('sex');
                        var address = $(this).data('address');
                        var telephone = $(this).data('telephone');
                        var type_patient = $(this).data('type_patient');

                        $('#patient-id').val(id);
                        $('#patient-name').val(name);
                        $('#patient-age').val(age);
                        $('#patient-address').val(address);
                        $('#patient-telephone').val(telephone);
                        $('#patient-type_patient').val(type_patient);

                        // Set the selected value for the dropdown
                        $('#patient-sex').val(sex).change();

                        // Update the form action URL to include the patient ID
                        var formAction = "{{ route('patient.update', ':id') }}";
                        formAction = formAction.replace(':id', id);
                        $('#editPatientForm').attr('action', formAction);

                        // Show the modal
                        $('#fire-modal-patient').modal('show');
                    });
                // [Edit Patient----------------------------]

            // [page-list-patient-----------------------------------]

             // [page-history-patient-----------------------------------]

                // [Edit History Patinet----------------------------]
                $('.btn_edit_history_patient').on('click', function() {
                    var invoice_id = $(this).data('invoice-id');

                    $.ajax({
                        url: "{{ url('/get-patient-all-history') }}/" + invoice_id,
                        type: 'GET',
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                            } else {
                                // Example: Redirect to edit page
                                window.location.href = "{{ route('history_patient.edit', ':invoice_id') }}".replace(':invoice_id', invoice_id);
                                
                                // If you want to handle data directly without redirect
                                console.log(response.patientPaymentData);
                                // You can use this data to populate your modal or form
                            }
                        },
                        error: function(xhr) {
                            console.log('An error occurred: ' + xhr.responseText);
                        }
                    });
                });


        
        
                // [Edit History Patient----------------------------]

            // [page-history-patient-----------------------------------]
            


      });
  </script>
  <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js')  }}"></script>
  <script src="{{ asset('backend/assets/js/page/modules-sweetalert.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    // Configure Axios to include the CSRF token in all requests
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  </script>
   @stack('scripts')

</body>
</html>
