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
                    <h1>List Patient</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="#">Patient</a></div>
                        <div class="breadcrumb-item">List Patient</div>
                    </div>
                </div>
            <!-- [header-------------------------] -->

            <!--[Patient_table-------------------------]-->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable" id="table_service">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">Patient's ID</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Patient's Name</th>
                                                <th class="text-white">Age</th>
                                                <th class="text-white">Sex</th>
                                                <th class="text-white">Address</th>
                                                <th class="text-white">Telephone</th>
                                                <th class="text-white">Type Service</th>
                                                <th class="text-white">Type Patient</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php 
                                                $patients = App\Models\Patient::all();
                                            @endphp
                                            @foreach ($patients as $patient)
                                                <tr class="row_patient_detail" data-toggle="modal" 
                                                data-target="#fire-modal-4" data-id="{{ $patient->id }}">
                                                    <td>{{ $patient->id }}</td>
                                                    <td>{{ $patient->date }}</td>
                                                    <td>{{ $patient->name }}</td>
                                                    <td>{{ $patient->age }}</td>
                                                    <td>{{ $patient->sex }}</td>
                                                    <td>{{ $patient->address }}</td>
                                                    <td>{{ $patient->telephone }}</td>
                                                    <td><span class="badge badge-dark">{{ $patient->type_service }}</span></td>
                                                    <td><span class="badge badge-secondary">{{ $patient->type_patient }}</td>

                                                    <td class="td-action">
                                                        <button class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <button class="btn btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--[Patient_table-------------------------]-->

        </section>
    </div>
    <!-- [main_content------------------------------] -->

    <!-- [footer------------------------------] -->
    <footer class="main-footer">
        @include('backend.body.footer')
    </footer>
    <!-- [footer------------------------------] -->

    <!-- [Model Detail Patient Service-------------------------] -->
        <div class="modal fade" id="fire-modal-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-service-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Patients's Noted</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <textarea class="summernote" name="" id="patientsNotedContent"></textarea> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Model Detail Patient Service-------------------------] -->

</div>

@endsection
