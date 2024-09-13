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
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Patient Name</th>
                                                <th>Doctor Name</th>
                                                <th>Cashier Name</th>
                                                <th>Service Name</th>
                                                <th>Subtotal</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Discount $</th>
                                                <th>Discount %</th>
                                                <th>Amount Paid</th>
                                                <th>Grand Total</th>
                                                <th>Amount Unpaid</th>
                                                <th>Type Service</th>
                                                <th>Notes</th>
                                                <th>Next Appointment Date</th>
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


</div>

@endsection

@push('scripts')
<script>
    function formatCurrency(value) {
        // Convert value to float and check if it is greater than zero
        const floatValue = parseFloat(value);
        return floatValue > 0 ? `$${floatValue.toFixed(2)}` : '';
    }

    function formatPercentage(value) {
        // Convert value to float and check if it is greater than zero
        const floatValue = parseFloat(value);
        return floatValue > 0 ? `${floatValue.toFixed(2)}%` : '';
    }

    function displayPatientHistory(data) {
        var tableBody = $('#patient-history-table-body');
        tableBody.empty();

        data.forEach(function(patient, index) {
            var baseRowSpan = patient.services.length;
            var firstService = patient.services[0];

            var patientRow = `
                <tr class="table_search_patient_all_history">
                    <td rowspan="${baseRowSpan}">${index + 1}</td>
                    <td rowspan="${baseRowSpan}">${patient.date}</td>
                    <td rowspan="${baseRowSpan}">${patient.customer}</td>
                    <td rowspan="${baseRowSpan}">${patient.doctor_name}</td>
                    <td rowspan="${baseRowSpan}">${patient.cashier_name}</td>
                    <td>${firstService.service_name}</td>
                    <td>${formatCurrency(firstService.subtotal)}</td>
                    <td>${firstService.service_unit}</td>
                    <td>${formatCurrency(firstService.service_price)}</td>
                    <td>${formatCurrency(firstService.discount_dollar)}</td>
                    <td>${formatPercentage(firstService.discount_percent)}</td>
                    <td rowspan="${baseRowSpan}">${formatCurrency(patient.amount_paid)}</td>
                    <td rowspan="${baseRowSpan}">${formatCurrency(patient.grand_total)}</td>
                    <td rowspan="${baseRowSpan}">${formatCurrency(patient.amount_unpaid)}</td>
                    <td rowspan="${baseRowSpan}">${patient.type_service}</td>
                    <td rowspan="${baseRowSpan}">${patient.patient_noted}</td>
                    <td rowspan="${baseRowSpan}">${patient.next_appointment_date}</td>
                </tr>`;

            tableBody.append(patientRow);

            // Add remaining services for this patient
            for (var i = 1; i < patient.services.length; i++) {
                var service = patient.services[i];
                var serviceRow = `
                    <tr>
                        <td>${service.service_name}</td>
                        <td>${formatCurrency(service.subtotal)}</td>
                        <td>${service.service_unit}</td>
                        <td>${formatCurrency(service.service_price)}</td>
                        <td>${formatCurrency(service.discount_dollar)}</td>
                        <td>${formatPercentage(service.discount_percent)}</td>
                    </tr>`;
                tableBody.append(serviceRow);
            }
        });
    }

    $(document).ready(function() {
        function getFirstDayOfMonth() {
            return moment().startOf('month').startOf('day').format('YYYY-MM-DD HH:mm'); 
        }
        function getLastDayOfMonth() {
            return moment().endOf('month').endOf('day').format('YYYY-MM-DD HH:mm');
        }

        $('#start-date').daterangepicker({
            singleDatePicker: true,
            startDate: getFirstDayOfMonth(),
            timePicker: true, 
            timePicker24Hour: true, 
            locale: {
                format: 'YYYY-MM-DD HH:mm' 
            }
        });

        $('#end-date').daterangepicker({
            singleDatePicker: true,
            startDate: getLastDayOfMonth(),
            timePicker: true, 
            timePicker24Hour: true, 
            locale: {
                format: 'YYYY-MM-DD HH:mm'
            }
        });

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
                        a.download = 'patient_history.xlsx';
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

</script>
@endpush
