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
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Notification</a></div>
                    <div class="breadcrumb-item">Get Notification</div>
                </div>
            </div>
            <!-- [header-------------------------] -->

            <!-- [Service_table-------------------------] -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-1">
                        <div class="card-body">
                            <!-- Display the count of rows -->
                            <h4 class="pb-2">Today's Appointments : {{ $appointmentNotifications->count() }}</h4>

                            <!-- Check if there are any notifications -->
                            @if($appointmentNotifications->isNotEmpty())
                                    <table class="table table-striped dataTable" id="table_service">
                                        <thead>
                                            <tr>
                                                <th>Patient ID</th>
                                                <th>Patient Name</th>
                                                <th>Doctor Name</th>
                                                <th>Register Date</th>
                                                <th>Next Appointment</th>
                                                <th>Services</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($appointmentNotifications as $notification)
                                                <tr>
                                                    <td>{{ $notification['patient_id'] }}</td>
                                                    <td>{{ $notification['patient_name'] }}</td>
                                                    <td>{{ $notification['doctor_name'] }}</td>
                                                    <td>{{ $notification['register_date'] }}</td>
                                                    <td>{{ $notification['next_appointment'] }}</td>
                                                    <td>
                                                        @if($notification['services']->isEmpty())
                                                            No services found.
                                                        @else
                                                            @foreach($notification['services'] as $service)
                                                                <div>
                                                                    <strong>Service Name:</strong> {{ $service['service_name'] ?? '' }}<br>
                                                                    <!-- <strong>Unit:</strong> {{ $service['service_unit'] ?? 'N/A' }}<br>
                                                                    <strong>Price:</strong> {{ $service['service_price'] ?? 'N/A' }}<br>
                                                                    <strong>Discount Percent:</strong> {{ $service['discount_percent'] ?? 'N/A' }}<br>
                                                                    <strong>Discount Dollar:</strong> {{ $service['discount_dollar'] ?? 'N/A' }}<br>
                                                                    <strong>Subtotal:</strong> {{ $service['subtotal'] ?? 'N/A' }}<br> -->
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                                <div class="alert alert-danger">
                                    No appointments today.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Service_table-------------------------] -->

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
