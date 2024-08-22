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
                <h1>Appointments</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Appointments</a></div>
                    <div class="breadcrumb-item">Set Appointments</div>
                </div>
            </div>
            <!-- [header-------------------------] -->

            <!-- [Service_table-------------------------] -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <form action="{{ route('appointments.set') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="patient">Select Patient</label>
                                        <select name="patient_id" id="patient" class="form-control select2" required>
                                            <option value="">Select a Patient</option>
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}">{{ $patient->name }} ({{ $patient->telephone }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="appointment_date">Appointment Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="appointment_date" class="form-control datepicker" id="date" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Set Appointment</button>
                                </form>
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
