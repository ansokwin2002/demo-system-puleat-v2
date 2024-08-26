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
                <h1>Notification</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Notification</div>
                </div>
            </div>
            <!-- [header-------------------------] -->

            <!-- [Table_notification-------------------------] -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card-body">
                            <!-- Display the count of rows -->
                            <h4 class="pb-2">Today's Appointments: {{ $appointmentNotifications->count() }}</h4>

                            <!-- Check if there are any notifications -->
                            @if($appointmentNotifications->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable" id="table_service">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">#</th>
                                                <th class="text-white">Patient Name</th>
                                                <th class="text-white">Telephone</th>
                                                <th class="text-white">Doctor Name</th>
                                                <th class="text-white">Register Date</th>
                                                <th class="text-white">Next Appointment</th>
                                                <th class="text-white">Services</th>
                                                <th class="text-white">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($appointmentNotifications as $index => $notification)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $notification['patient_name'] }}</td>
                                                <td>{{ $notification['patient_phone'] }}</td>
                                                <td>{{ $notification['doctor_name'] }}</td>
                                                <td>{{ $notification['register_date'] }}</td>
                                                <td>{{ $notification['next_appointment'] }}</td>
                                                <td>
                                                    @if($notification['services']->isEmpty())
                                                        <span class="badge badge-warning">No services found.</span>
                                                    @else
                                                        @foreach($notification['services'] as $service)
                                                            <span class="badge badge-dark">{{ $service['service_name'] ?? '' }}</span><br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn_hide_notification"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    No appointments today.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Table_notification-------------------------] -->

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
