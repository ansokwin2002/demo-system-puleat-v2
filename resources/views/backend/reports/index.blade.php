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
                <h1>Reports</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Report Patients</a></div>
                    <div class="breadcrumb-item">Report Patients Download</div>
                </div>
            </div>
            <!-- [header-------------------------] -->

            <!-- [Service_table-------------------------] -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card_title">
                                <div class="row">
                                    <div class="col-4"><h6>Patient</h6></div>
                                    <div class="col-4"><h6>Start Date</h6></div>
                                    <div class="col-4"><h6>End Date</h6></div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-4">
                                        <div class="box_select_customer">
                                            <div class="card_customer">
                                                <div class="icon_customer" style="width: 10%;">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <div class="select_customer" style="width: 90%;">
                                                @php 
                                                    $patients = App\Models\Patient::all();
                                                    $selectedPatientId = $selectedPatientId ?? null; 
                                                @endphp

                                                <select name="patient_id" id="patient-select" class="form-control select2" style="width: 100%;">
                                                    <option value="">All Patients</option>
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
                                    <div class="col-4">
                                        <div class="form-group mb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input name="start_date" type="text" class="form-control datepicker" id="start-date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input name="end_date" type="text" class="form-control datepicker" id="end-date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="button" class="btn btn-warning" id="search_patient_all_history">
                                    <i class="fa fa-search"></i> Search
                                </button>
                                <button type="button" class="btn btn-primary" id="export_patient_all_history">
                                    <i class="fa fa-save"></i> Export Excel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- [Service_table-------------------------] -->
            <!-- [Table All Patients After Search-----------------------------------] -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table class="table table-bordered dataTable" style="width:100%;">
                                        <thead style="background-color:#6777EF;">
                                            <tr>
                                                <th class="text-white align-middle text-center">#</th>
                                                <th class="text-white align-middle text-center">Date</th>
                                                <th class="text-white align-middle text-center">Patient Name</th>
                                                <th class="text-white align-middle text-center">Doctor Name</th>
                                                <th class="text-white align-middle text-center">Cashier Name</th>
                                                <th class="text-white align-middle text-center">Service Name</th>
                                                <th class="text-white align-middle text-center">Subtotal</th>
                                                <th class="text-white align-middle text-center">Unit</th>
                                                <th class="text-white align-middle text-center">Price</th>
                                                <th class="text-white align-middle text-center">Discount $</th>
                                                <th class="text-white align-middle text-center">Discount %</th>
                                                <th class="text-white align-middle text-center">Amount Paid</th>
                                                <th class="text-white align-middle text-center">Grand Total</th>
                                                <th class="text-white align-middle text-center">Amount Unpaid</th>
                                                <th class="text-white align-middle text-center">Type Service</th>
                                                <th class="text-white align-middle text-center">Notes</th>
                                                <th class="text-white align-middle text-center">Next Appointment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="patient-history-table-body">
                                            <!-- Dynamic Data Here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- [Table All Patients After Search-----------------------------------] -->
        </section>
    </div>
    <!-- [main_content------------------------------] -->

    <!-- [footer------------------------------] -->
        <footer class="main-footer">
            @include('backend.body.footer')
        </footer>
    <!-- [footer------------------------------] -->
    <!-- [style---------------------] -->
        <style>
            .dataTable tbody tr:nth-child(odd) {
                background-color: white;
            }
            .dataTable tbody tr:nth-child(even) {
                background-color: #f2f2f2; 
            }
            .dataTable tbody tr:hover {
                background-color: #e8e8e8; 
            }
        </style>
    <!-- [style---------------------] -->
</div>

@endsection

@push('scripts')
<script>
    // [Javascript-----------------------]
        // [formatCurrency--------------------------]
            function formatCurrency(value) {
                const floatValue = parseFloat(value);
                return !isNaN(floatValue) && floatValue !== 0 ? `$${floatValue.toFixed(2)}` : '$0.00';
            }
        // [formatCurrency--------------------------]

        // [formatPercentage--------------------------]
            function formatPercentage(value) {
                const floatValue = parseFloat(value);
                return !isNaN(floatValue) && floatValue !== 0 ? `${floatValue.toFixed(2)}%` : '0.00%';
            }
        // [formatPercentage--------------------------]

        // [displayPatientHistory--------------------------]
            function displayPatientHistory(data) {
                var tableBody = $('#patient-history-table-body');
                tableBody.empty();

                data.forEach(function(patient, index) {
                    var baseRowSpan = patient.services.length;
                    var firstService = patient.services[0];

                    var patientRow = `
                        <tr class="table_search_patient_all_history">
                            <td class="align-middle text-center" rowspan="${baseRowSpan}">${index + 1}</td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}">${patient.date}</td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}"><span class="badge badge-info">${patient.customer}</span></td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}"><span class="badge badge-dark">${patient.doctor_name}</span></td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}"><span class="badge badge-success">${patient.cashier_name}</span></td>
                            <td class="align-middle text-center"><span class="badge badge-danger">${firstService.service_name}</span></td>
                            <td class="align-middle text-center">${formatCurrency(firstService.subtotal)}</td>
                            <td class="align-middle text-center">${firstService.service_unit}</td>
                            <td class="align-middle text-center">${formatCurrency(firstService.service_price)}</td>
                            <td class="align-middle text-center">${formatCurrency(firstService.discount_dollar)}</td>
                            <td class="align-middle text-center">${formatPercentage(firstService.discount_percent)}</td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}">${formatCurrency(patient.amount_paid)}</td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}">${formatCurrency(patient.grand_total)}</td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}">${formatCurrency(patient.amount_unpaid)}</td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}">${patient.type_service}</td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}">${patient.patient_noted}</td>
                            <td class="align-middle text-center" rowspan="${baseRowSpan}">${patient.next_appointment_date}</td>
                        </tr>`;

                    tableBody.append(patientRow);

                    // Add remaining services for this patient
                    for (var i = 1; i < patient.services.length; i++) {
                        var service = patient.services[i];
                        var serviceRow = `
                            <tr class="table_search_patient_all_history">
                                <td class="align-middle text-center"><span class="badge badge-danger">${service.service_name}</span></td>
                                <td class="align-middle text-center">${formatCurrency(service.subtotal)}</td>
                                <td class="align-middle text-center">${service.service_unit}</td>
                                <td class="align-middle text-center">${formatCurrency(service.service_price)}</td>
                                <td class="align-middle text-center">${formatCurrency(service.discount_dollar)}</td>
                                <td class="align-middle text-center">${formatPercentage(service.discount_percent)}</td>
                            </tr>`;
                        tableBody.append(serviceRow);
                    }
                });
            }
        // [displayPatientHistory--------------------------]

        // [formate_date-----------------------]
            function formatDate(date) {
                const months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
                const hours = date.getHours();
                const period = hours >= 12 ? 'PM' : 'AM';
                const formattedHours = (hours % 12) || 12;
                const formattedMinutes = date.getMinutes().toString().padStart(2, '0');
                const formattedSeconds = date.getSeconds().toString().padStart(2, '0');
                return `${date.getFullYear()}_${months[date.getMonth()]}_${date.getDate()}_${formattedHours}_${formattedMinutes}_${period}`;
            }
        // [formate_date-----------------------]
    // [Javascript-----------------------]

    // [Jquery-----------------------------]
        $(document).ready(function() {
           // [start_month_day------------------------]
                function getFirstDayOfMonth() {
                    return moment().startOf('month').format('YYYY-MM-DD'); 
                }
            // [start_month_day------------------------]

            // [end_month_day------------------------]
                function getLastDayOfMonth() {
                    return moment().endOf('month').format('YYYY-MM-DD');
                }
            // [end_month_day------------------------]

            // [start_date-----------------------]
                $('#start-date').daterangepicker({
                    singleDatePicker: true,
                    startDate: getFirstDayOfMonth(),
                    timePicker: false, 
                    locale: {
                        format: 'YYYY-MM-DD' 
                    }
                });
            // [start_date-----------------------]

            // [end_date-----------------------]
                $('#end-date').daterangepicker({
                    singleDatePicker: true,
                    startDate: getLastDayOfMonth(),
                    timePicker: false, 
                    locale: {
                        format: 'YYYY-MM-DD' 
                    }
                });
            // [end_date-----------------------]

            // [export_patient_all_history------------------------]
                $('#export_patient_all_history').click(function() {
                    $('#loading-spinner').show();
                    var patientId = $('#patient-select').val();
                    var startDate = $('#start-date').val();
                    var endDate = $('#end-date').val();

                    if (!startDate || !endDate) {
                        alert('Please select a date range.');
                        $('#loading-spinner').hide();
                        return;
                    }
                    const date = new Date();
                    const formattedDate = formatDate(date);
                    const filename = `patient_history_${formattedDate}.xlsx`;
                    $.ajax({
                        url: "{{ route('export.patient.all_history') }}",
                        method: 'GET',
                        data: {
                            patient_id: patientId, // Send patient_id if selected, otherwise it will be null
                            start_date: startDate,
                            end_date: endDate
                        },
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(response) {
                            var url = window.URL.createObjectURL(response);
                            var a = document.createElement('a');
                            a.href = url;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                            document.body.removeChild(a);
                            window.URL.revokeObjectURL(url);
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 404) {
                                alert('No patient history found for the selected date range.');
                            } else {
                                console.error('An error occurred:', error);
                                alert('Failed to export data. Please check the console for details.');
                            }
                        },
                        complete: function() {
                            $('#loading-spinner').hide();
                        }
                    });
                });
            // [export_patient_all_history------------------------]

            // [search_patient_all_history------------------------]
                $('#search_patient_all_history').click(function(){
                    $('#loading-spinner').show();

                    var patientId = $('#patient-select').val();
                    var startDate = $('#start-date').val();
                    var endDate = $('#end-date').val();

                    if (!startDate || !endDate) {
                        alert('Please select a date range.');
                        $('#loading-spinner').hide();
                        return;
                    }

                    $.ajax({
                        url: "{{ route('search.patient.all_history') }}",
                        method: 'GET',
                        data: {
                            patient_id: patientId,
                            start_date: startDate,
                            end_date: endDate
                        },
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                            } else {
                                // Display data in your HTML or pass it to the Blade file
                                displayPatientHistory(response.data);
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 404) {
                                alert('No patient history found for the selected date range.');
                            } else {
                                console.error('An error occurred:', error);
                                alert('Failed to search data. Please check the console for details.');
                            }
                        },
                        complete: function() {
                            $('#loading-spinner').hide();
                        }
                    });
                });

            // [search_patient_all_history------------------------]
        });
    // [Jquery-----------------------------]
</script>
@endpush
