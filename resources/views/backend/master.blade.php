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

  <!-- General CSS Files -->
  <link rel="stylesheet" href=" {{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

  <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/datatables.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href=" {{ asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href=" {{ asset('backend/assets/css/components.css') }}">
</head>

<style>
    .disabled-input {
        background-color: #e9ecef;
        cursor: not-allowed;
    }
</style>

<body>
  <div id="app">
     @yield('content')
  </div>
  <script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>
    <!-- [loading-----------------------] -->
        <!-- @include('backend.body.loader') -->
    <!-- [loading-----------------------] -->

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
  
  <!-- Initialize DataTable -->
  
  <script>
      $(document).ready(function() {

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
                "pageLength": 50
            });
        // [dataTable_Service---------------------]

            $('[data-toggle="modal"]').on('click', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var unit = $(this).data('unit');
                var price = $(this).data('price');

                // Set the values in the modal form fields
                $('#fire-modal-4-' + id).find('#name-' + id).val(name);
                $('#fire-modal-4-' + id).find('#unit-' + id).val(unit);
                $('#fire-modal-4-' + id).find('#price-' + id).val(price);
            });


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
            });
        // [Unit-----------------------]

        // [Validation_Unit---------------------]
            $('#serviceTableBody').on('input', '.unit, .discount-percent, .discount-dollar', function() {
                var value = $(this).val();
                var numericValue = value.replace(/[^0-9.]/g, ''); 

                if (value !== numericValue) {
                    $(this).val(numericValue); 
                }
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

        // [Submit_Patient_history------------------------------]
        
            $('#save_patient_history').click(function(e) {
                e.preventDefault();

                // Get the CSRF token directly from the meta tag
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Get data from your form or elements
                let patientId = $('#patient-select').val();
                let date = $('#date').val();
                let doctor = $('#doctor').val();
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
                    _token: csrfToken, // Include the CSRF token
                    patient_id: patientId,
                    patient_payment: {
                        patientId:patientId,
                        date: date,
                        doctor: doctor,
                        customer: customer,
                        grand_total: grand_total,
                        amount_paid:amount_paid,
                        amount_unpaid:amount_unpaid,
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
                        // window.location.href = '/patient-service-history';
                        window.location.href = `/invoice/${response.invoice_id}`;
                    },
                    error: function(xhr) {
                        if (xhr.status === 419) { // CSRF token mismatch
                            alert('There was an issue with your session. Please try again.');
                        } else {
                            console.error('Error saving patient history:', xhr.responseJSON.message);
                            alert('Error: ' + xhr.responseJSON.message);
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
                                        <td>${service.service_price}</td>
                                        <td>${service.subtotal}</td>
                                        <td>${service.discount_percent ? service.discount_percent + '%' : ''}</td>
                                        <td>${service.discount_dollar ? '$' + service.discount_dollar : ''}</td>
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


      });


      function printSection(id) {
            var printContent = document.getElementById(id).innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;

            window.print();

            document.body.innerHTML = originalContent;
        }
  </script>

  <!-- Template JS File -->
  <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    // Configure Axios to include the CSRF token in all requests
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  </script>

</body>
</html>
