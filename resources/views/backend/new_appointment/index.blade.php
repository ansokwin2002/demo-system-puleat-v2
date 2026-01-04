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
                        <h1>New Appointment</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                            <div class="breadcrumb-item">New Appointment</div>
                        </div>
                    </div>
                <!-- [header-------------------------] -->

                @if(isset($today_appointments_count) && $today_appointments_count > 0)
                    <div class="alert alert-danger">
                        You have {{ $today_appointments_count }} appointment(s) scheduled for today.
                    </div>
                @endif

                <!-- [search and filter form -------------------------] -->
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" id="search" class="form-control" placeholder="Search Description...">
                        </div>
                        <div class="col-md-3">
                            <select id="patient_name_filter" class="form-control">
                                <option value="">Filter by Patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->name }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select id="doctor_name_filter" class="form-control">
                                <option value="">Filter by Doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="appointment_date_filter" class="form-control datepicker" placeholder="Filter by Date">
                        </div>
                        <div class="col-md-2 d-flex">
                            <button id="apply_filters" class="btn btn-primary mr-2">Filter</button>
                            <button id="reset_filters" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </div>
                <!-- [search and filter form -------------------------] -->

                <!--[Appointment_table-------------------------]-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped dataTable" id="new_appointment">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-white align-middle text-center ">ID</th>
                                                    <th class="text-white align-middle text-center ">Patient Name</th>
                                                    <th class="text-white align-middle text-center ">Telephone</th>
                                                    <th class="text-white align-middle text-center ">Doctor Name</th>
                                                    <th class="text-white align-middle text-center ">Appointment Date</th>
                                                    <th class="text-white align-middle text-center " style="width: 20%;">Description</th>
                                                    <th class="text-white align-middle text-center ">Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    use Carbon\Carbon;
                                                    $today = Carbon::today()->toDateString();
                                                @endphp
                                                @foreach ($appointments as $index => $appointment)
                                                @php
                                                    $isToday = $appointment->appointment_date == $today;
                                                @endphp
                                                <tr class="{{ $isToday ? 'highlight-today' : '' }}">
                                                    <td class="align-middle text-center">{{ $index + 1 }}</td>
                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('view_patient_detail', $appointment->patient->id) }}">
                                                            {{ $appointment->patient->name ?? 'N/A' }}
                                                        </a>
                                                    </td>
                                                    <td class="align-middle text-center">{{ $appointment->patient->telephone ?? 'N/A' }}</td>
                                                    <td class="align-middle text-center">{{ $appointment->doctor->name ?? 'N/A' }}</td>
                                                    <td class="align-middle text-center">{{ $appointment->appointment_date }}</td>
                                                    <td class="align-middle text-center description-cell" style="width: 20%;">{{ $appointment->description }}</td>
                                                    <td class="align-middle text-center">{{ $appointment->created_at->format('Y-m-d H:i:s') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--[Appointment_table-------------------------]-->
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

@push('styles')
<style>
    @keyframes blink-animation {
        0%, 100% { background-color: #f8d7da; border-color: #dc3545; } /* Initial light red */
        50% { background-color: #fcebeb; border-color: #f5c6cb; } /* Lighter red */
    }

    .highlight-today {
        animation: blink-animation 1.5s infinite;
        border-left: 5px solid #dc3545 !important;
        border-right: 5px solid #dc3545 !important;
    }

    .description-cell {
        white-space: normal;
        word-break: break-all;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#new_appointment').DataTable({
            "dom": 'lrtip', // This removes the default search box (f) but keeps length changing (l), table (t), info (i), and pagination (p)
            "pageLength": 25 // Set default page length to 25
        });

        $('#apply_filters').on('click', function() {
            var searchTerm = $('#search').val();
            var patientName = $('#patient_name_filter').val();
            var doctorName = $('#doctor_name_filter').val();
            var appointmentDate = $('#appointment_date_filter').val();

            table.column(5).search(searchTerm) // Search description column
                 .column(1).search(patientName)
                 .column(3).search(doctorName)
                 .column(4).search(appointmentDate)
                 .draw();
        });

        $('#reset_filters').on('click', function(){
            $('#search').val('');
            $('#patient_name_filter').val('').trigger('change');
            $('#doctor_name_filter').val('').trigger('change');
            $('#appointment_date_filter').val('');
            table.search('').columns().search('').draw();
        });

        // Initialize datepicker for the filter input
        $('#appointment_date_filter').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoApply: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>
@endpush
