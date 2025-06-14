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
                    <h1>List Appointment Patient</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('appointment_patient') }}">List Appointment Patient</a></div>
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
                                    <table class="table table-striped dataTable" id="table_appointment_patient">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white align-middle text-center ">No</th>
                                                <th class="text-white align-middle text-center ">Patient Code</th>
                                                <th class="text-white align-middle text-center ">Patient's Name</th>
                                                <th class="text-white align-middle text-center ">Sex</th>
                                                <th class="text-white align-middle text-center ">Telephone</th>
                                                <th class="text-white align-middle text-center ">Appointment Date</th>
                                                <th class="text-white align-middle text-center ">Doctor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $index => $item)
                                                <tr class="row_list_patients">
                                                    <td class="align-middle text-center">{{ $index + 1 }}</td><!-- Serial number -->
                                                    <td class="align-middle text-center">{{ $item['patient']->id }}</td><!-- Patient ID -->
                                                    <td class="align-middle text-center patient-name">
                                                        <span class="badge badge-info">{{ $item['patient']->name }}</span><!-- Patient Name -->
                                                    </td>
                                                    <td class="align-middle text-center">{{ $item['patient']->sex }}</td>
                                                    <td class="align-middle text-center">{{ $item['patient']->telephone }}</td><!-- Phone -->
                                                    <td class="align-middle text-center">{{ $item['next_appointment'] }}</td><!-- Next Appointment -->
                                                    <td class="align-middle text-center">{{ $item['doctor_name'] }}</td><!-- Doctor -->
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

            <button 
                class="btn btn-info view-patient" 
                data-id="{{ $item['patient']->id }}">View Patient's Info <i class="fa fa-eye"></i>
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
        $(document).on("click", ".view-patient", function() {
            var patientId = $(this).data("id");
            if (patientId) {
                // Generate the URL with the patient ID
                var viewPatientUrl = "{{ route('view_patient_detail', ['id' => ':id']) }}";
                viewPatientUrl = viewPatientUrl.replace(':id', patientId);
                
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