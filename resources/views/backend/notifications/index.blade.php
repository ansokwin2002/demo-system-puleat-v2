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

            <!-- [Inline_notification-------------------------] -->
            <div class="row mt-4">
                <div class="col-12">
                    <!-- Display the count of rows -->
                    <h4 class="pb-2">Today's Appointments : {{ $appointmentNotifications->count() }}</h4>

                    <!-- Check if there are any notifications -->
                    @if($appointmentNotifications->isNotEmpty())
                        <div class="d-flex flex-column">
                            @foreach($appointmentNotifications as $notification)
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
                                    <div class="d-inline-flex flex-wrap">
                                        <div class="mr-3 badge badge-dark"><strong>Patient Name:</strong> {{ $notification['patient_name'] }}</div>
                                        <div class="mr-3 badge badge-dark"><strong>Telephone:</strong> {{ $notification['patient_phone'] }}</div>
                                        <div class="mr-3 badge badge-dark"><strong>Doctor Name:</strong> {{ $notification['doctor_name'] }}</div>
                                        <div class="mr-3 badge badge-dark"><strong>Register Date:</strong> {{ $notification['register_date'] }}</div>
                                        <div class="mr-3 badge badge-dark"><strong>Next Appointment:</strong> {{ $notification['next_appointment'] }}</div>

                                        <!-- Services Details -->
                                        @if($notification['services']->isEmpty())
                                            <div class="mr-3 badge badge-warning">No services found.</div>
                                        @else
                                            @foreach($notification['services'] as $service)
                                                <div class="mr-3 badge badge-dark"><strong>Service Name:</strong> {{ $service['service_name'] ?? '' }}</div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <!-- Hide/Show Icons -->
                                    <div>
                                        <button type="button" class="btn btn-warning btn-sm ml-2" data-toggle="collapse" data-target="#details{{ $loop->index }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-danger">
                            No appointments today.
                        </div>
                    @endif
                </div>
            </div>
            <!-- [Inline_notification-------------------------] -->

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
