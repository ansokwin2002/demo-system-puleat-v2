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
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('list_Patient') }}">Patient</a></div>
                        <div class="breadcrumb-item">List Patient</div>
                    </div>
                </div>
            <!-- [header-------------------------] -->

            <!--[Patient_table-------------------------]-->
            <button class="btn btn-primary"  
                    data-toggle="modal" 
                    data-target="#fire-modal-appointment-patient" ><i class="fa-solid fa-user-plus"></i> Add Patient</button>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable" id="table_patient">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white align-middle text-center ">Patient's ID</th>
                                                <th class="text-white align-middle text-center ">Date</th>
                                                <th class="text-white align-middle text-center ">Patient's Name</th>
                                                <th class="text-white align-middle text-center ">Age</th>
                                                <th class="text-white align-middle text-center ">Sex</th>
                                                <th class="text-white align-middle text-center ">Address</th>
                                                <th class="text-white align-middle text-center ">Telephone</th>
                                                <th class="text-white align-middle text-center ">Type Patient</th>
                                                <th class="text-white align-middle text-center ">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                use App\Models\Patient;
                                                $patients = Patient::latest('created_at')->get();
                                            @endphp
                                            @foreach ($patients as $index => $patient)
                                            <tr class="row_list_patients">
                                                <td class="align-middle text-center">{{ $index + 1 }}</td>
                                                <td class="align-middle text-center">{{ $patient->date }}</td>
                                                <td class="align-middle text-center patient-name"><span class="badge badge-info">{{ $patient->name }}</span></td>
                                                <td class="align-middle text-center">{{ $patient->age }}</td>
                                                <td class="align-middle text-center">{{ $patient->sex }}</td>
                                                <td class="align-middle text-center">{{ $patient->address }}</td>
                                                <td class="align-middle text-center">{{ $patient->telephone }}</td>
                                                <td class="align-middle text-center"><span class="badge badge-secondary">{{ $patient->type_patient }}</span></td>
                                                <td class="align-middle text-center" class="td-action">
                                                    <button class="btn btn-danger" onclick="swal('Cannot Delete', 'Patient can only be updated after creation!', 'error');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button class="btn btn-warning btn_edit_patient" 
                                                        data-toggle="modal" 
                                                        data-target="#fire-modal-patient" 
                                                        data-id="{{ $patient->id }}" 
                                                        data-name="{{ $patient->name }}" 
                                                        data-age="{{ $patient->age }}" 
                                                        data-sex="{{ $patient->sex }}" 
                                                        data-address="{{ $patient->address }}" 
                                                        data-telephone="{{ $patient->telephone }}" 
                                                        data-type_patient="{{ $patient->type_patient }}">
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

    <!-- [Context_Menu-------------------------]-->
        <div id="contextMenu" class="context-menu">
            <button class="btn btn-info btn_view_patient" id="viewPatientBtn">
                View Patient's Info <i class="fa fa-eye"></i>
            </button>
            <button class="btn btn-danger" onclick="swal('Cannot Delete', 'Patient can only be updated after creation!', 'error');">
                Delete Patient's Info <i class="fa fa-trash"></i>
            </button>
            <button class="btn btn-warning btn_edit_patient">
                Edit Patient's Info <i class="fa fa-edit"></i>
            </button>
        </div>
    <!-- [Context_Menu-------------------------]-->

    <!-- [footer------------------------------] -->
        <footer class="main-footer">
            @include('backend.body.footer')
        </footer>
    <!-- [footer------------------------------] -->

    
    <!-- [Model Add Patient-------------------------] -->
        <div class="modal fade" id="fire-modal-appointment-patient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-service-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                     <div class="card-body">
                        <form action="{{ route('create_Patient') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        <!-- [name----------------------------------] -->
                            <div class="form-group row">
                                <h6 class="col-sm-3 col-form-label">Patient's Name :</h6>
                                <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-heart"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="name" class="form-control" required="">
                                </div>
                                <div class="invalid-feedback">
                                    Please fill Patient name !
                                </div>
                                </div>
                            </div>
                        <!-- [name----------------------------------] -->

                        <!-- [age-------------------------------------] -->
                            <div class="form-group row">
                                <h6 class="col-sm-3 col-form-label">Age :</h6>
                                <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-hashtag"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="age" class="form-control age" required="">
                                </div>
                                <div class="invalid-feedback">
                                    Please fill Patient age !
                                </div>
                                </div>
                            </div>
                        <!-- [age-------------------------------------] -->

                        <!-- [sex-------------------------------------] -->
                            <div class="form-group row">
                                <h6 class="col-sm-3 col-form-label">Sex :</h6>
                                <div class="col-sm-9">
                                <div class="flex-grow-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user-md"></i>
                                            </div>
                                        </div>
                                        <select name="sex" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Please fill Patient sex !
                                </div>
                                </div>
                            </div>
                        <!-- [sex-------------------------------------] -->

                        <!-- [address----------------------------------] -->
                            <div class="form-group row">
                                <h6 class="col-sm-3 col-form-label">Address :</h6>
                                <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="address" class="form-control" required="">
                                </div>
                                <div class="invalid-feedback">
                                    Please fill Patient address !
                                </div>
                                </div>
                            </div>
                        <!-- [address----------------------------------] -->

                        <!-- [telephone-------------------------------------] -->
                            <div class="form-group row">
                                <h6 class="col-sm-3 col-form-label">Telephone :</h6>
                                <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="telephone" class="form-control tel" required="">
                                </div>
                                <div class="invalid-feedback">
                                    Please fill Patient telephone !
                                </div>
                                </div>
                            </div>
                        <!-- [telephone-------------------------------------] -->

                        <!-- [date-----------------------------] -->
                            <div class="form-group row">
                                <h6 class="col-sm-3 col-form-label">Date :</h6>
                                <div class="col-sm-9">
                                <div class="flex-grow-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="date" class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Please fill Patient date !
                                </div>
                                </div>
                            </div>
                        <!-- [date-----------------------------] -->

                        <!-- [type-patient----------------------------------] -->
                            <div class="form-group row">
                                <h6 class="col-sm-3 col-form-label">Type Patient :</h6>
                                <div class="col-sm-9">
                                    <div class="flex-grow-1">
                                        <div class="input-group" id="type-patient-wrapper">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" id="type-patient-icon">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            <select name="type_patient" class="form-control" id="type-patient-select">
                                                <option value="Walk-in">Walk-in</option>
                                                <option value="Customize">Customize</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please fill Type Patient!
                                    </div>
                                </div>
                            </div>
                        <!-- [type-patient----------------------------------] -->       
                            
                        <!-- [type-payment----------------------------------] -->
                            <div class="form-group row d-none">
                                <h6 class="col-sm-3 col-form-label">Type Payment :</h6>
                                <div class="col-sm-9">
                                    <input type="radio" value="general_implant" name="type_payment" checked>
                                    <strong>General / Implant</strong>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="ortho" name="type_payment">
                                    <strong>Ortho</strong>   
                                </div>
                            </div>
                        <!-- [type-payment----------------------------------] -->     

                        <!-- [button-save------------------------------------] -->
                            <div class="form-group mb-0 row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </div>
                        <!-- [button-save------------------------------------] -->
                        </form>
                    </div>   
                </div>
            </div>
        </div>
    <!-- [Model Add Patient-------------------------] -->


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
                                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Model Edit Patient-------------------------] -->

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var selectedPatient = null;
        var contextMenu = $("#contextMenu");

        // Delegate right-click on the patient name to show the context menu
        $(document).on("contextmenu", ".patient-name", function(e) {
            e.preventDefault();
            
            // Position the context menu as per your original design
            var rect = this.getBoundingClientRect();
            contextMenu.css({
                top: rect.bottom + window.scrollY - 30 + "px",
                left: rect.left + window.scrollX + "px",
                display: "block"
            });
            
            // Get the parent row and then find the inline edit button that contains the data attributes
            var row = $(this).closest("tr");
            var inlineEditButton = row.find("button.btn_edit_patient").first();
            
            if (inlineEditButton.length) {
                // Update selectedPatient with the latest data from this row
                selectedPatient = {
                    id: inlineEditButton.data("id"),
                    name: inlineEditButton.data("name"),
                    age: inlineEditButton.data("age"),
                    sex: inlineEditButton.data("sex"),
                    address: inlineEditButton.data("address"),
                    telephone: inlineEditButton.data("telephone"),
                    type_patient: inlineEditButton.data("type_patient")
                };
            }
        });

        // Hide the context menu when clicking anywhere else
        $(document).on("click", function() {
            contextMenu.hide();
        });
        
        // Delegate the click event on the context menu "Edit Patient's Info" button
        $(document).on("click", "#contextMenu .btn_edit_patient", function() {
            if (selectedPatient) {
                // Populate the edit form fields with the selected patient's data
                $("#patient-id").val(selectedPatient.id);
                $("#patient-name").val(selectedPatient.name);
                $("#patient-age").val(selectedPatient.age);
                $("#patient-address").val(selectedPatient.address);
                $("#patient-telephone").val(selectedPatient.telephone);
                $("#patient-type_patient").val(selectedPatient.type_patient);
                
                // Set the dropdown value for sex and trigger change if needed
                $("#patient-sex").val(selectedPatient.sex).change();
                
                // Update the form action URL to include the patient ID
                var formAction = "{{ route('patient.update', ':id') }}";
                formAction = formAction.replace(':id', selectedPatient.id);
                $("#editPatientForm").attr("action", formAction);
                
                // Open the modal for editing
                $("#fire-modal-patient").modal("show");
            }
        });
        console.log("Bootstrap Modal Function:", typeof $.fn.modal);
        // When the "View Patient's Info" button is clicked
        $(document).on("click", "#viewPatientBtn", function() {
            if (selectedPatient) {
                // Generate the URL with the patient ID
                var viewPatientUrl = "{{ route('view_patient_detail', ['id' => ':id']) }}";
                viewPatientUrl = viewPatientUrl.replace(':id', selectedPatient.id);
                
                // Redirect to the patient detail page
                window.location.href = viewPatientUrl;
            }
        });
    });

</script>
@endpush

<style scoped lang="css">
    .context-menu {
        width: 200px;
        position: absolute;
        background: white;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        padding: 10px;
        border-radius: 5px;
        display: none;
        z-index: 1000;
    }

    .context-menu.show {
        display: block;
    }

    .context-menu button {
        width: 100%;
        margin-bottom: 5px;
    }
</style>