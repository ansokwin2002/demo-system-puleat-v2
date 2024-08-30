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
                                    <table class="table table-striped dataTable" id="table_patient">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">Patient's ID</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Patient's Name</th>
                                                <th class="text-white">Age</th>
                                                <th class="text-white">Sex</th>
                                                <th class="text-white">Address</th>
                                                <th class="text-white">Telephone</th>
                                                <th class="text-white">Type Patient</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php 
                                                $patients = App\Models\Patient::orderBy('created_at', 'desc')->get();
                                            @endphp
                                            @foreach ($patients as $index => $patient)
                                                <tr class="row_patient_detail">
                                                    <td>{{ $index +=1 }}</td>
                                                    <td>{{ $patient->date }}</td>
                                                    <td>{{ $patient->name }}</td>
                                                    <td>{{ $patient->age }}</td>
                                                    <td>{{ $patient->sex }}</td>
                                                    <td>{{ $patient->address }}</td>
                                                    <td>{{ $patient->telephone }}</td>
                                                    <td><span class="badge badge-secondary">{{ $patient->type_patient }}</td>
                                                    <td class="td-action">
                                                        <button class="btn btn-danger" onclick="swal('Cannot Delete', 'Patient can only be updated after creation !', 'error');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <button class="btn btn-warning btn_edit_patient"
                                                            data-toggle="modal" 
                                                            data-target="#fire-modal-patient"
                                                            data-id="{{ $patient->id }}"
                                                            data-name="{{ $patient->name }}"
                                                            data-age ="{{ $patient->age }}"
                                                            data-sex ="{{ $patient->sex }}"
                                                            data-address ="{{ $patient->address }}"
                                                            data-telephone ="{{ $patient->telephone }}"
                                                            data-type_patient ="{{ $patient->type_patient }}">
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
 <!-- [Model Edit Patient-------------------------] -->
 <div class="modal fade" id="fire-modal-patient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-service-detail">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editPatientForm" method="post">
                        @csrf
                        <input type="hidden" name="id" id="patient-id">
                        <div class="form-group">
                            <label for="name">Patient Name:</label>
                            <input type="text" name="name" id="patient-name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" name="age" id="patient-age" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="sex">Sex:</label>
                            <select name="sex" id="patient-sex" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" id="patient-address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone:</label>
                            <input type="text" name="telephone" id="patient-telephone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="type_patient">Type Patient:</label>
                            <input type="text" name="type_patient" id="patient-type_patient" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update <i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- [Model Edit Patient-------------------------] -->

</div>

@endsection
