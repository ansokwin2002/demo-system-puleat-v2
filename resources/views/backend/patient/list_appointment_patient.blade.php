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
                    <div class="container-fluid pl-0">
                        <h4 class="text-danger">🔴 Red Highlight = Appointment Today</h4>
                    </div>
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
                                            @php
                                                use Carbon\Carbon;
                                            @endphp
                                            <tbody>
                                                @foreach ($data as $index => $item)
                                                    @php
                                                        $isToday = Carbon::parse($item['next_appointment'])->isToday();
                                                    @endphp
                                                    <tr class="row_list_patients {{ $isToday ? 'bg-soft-red' : '' }}">
                                                        <td class="align-middle text-center">{{ $index + 1 }}</td>
                                                        <td class="align-middle text-center">{{ $item['patient']->id }}</td>
                                                        <td class="align-middle text-center patient-name">
                                                            <span class="badge badge-info">{{ $item['patient']->name }}</span>
                                                            <button type="button" class="btn btn-outline-secondary btn-sm patient-menu-toggle" title="Patient Actions">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="patient-menu">
                                                                <button type="button" class="btn btn-info patient-menu-view">
                                                                    View Patient's Info <i class="fa fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger" onclick="swal('Cannot Delete', 'Patient can only be updated after creation!', 'error');">
                                                                    Delete Patient's Info <i class="fa fa-trash"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning patient-menu-edit">
                                                                    Edit Patient's Info <i class="fa fa-edit"></i>
                                                                </button>
                                                            </div>
                                                            <!-- Include hidden edit button with data attributes -->
                                                            <button 
                                                                type="button" 
                                                                class="d-none btn_edit_patient"
                                                                data-id="{{ $item['patient']->id }}"
                                                                data-name="{{ $item['patient']->name }}"
                                                                data-age="{{ $item['patient']->age }}"
                                                                data-sex="{{ $item['patient']->sex }}"
                                                                data-address="{{ $item['patient']->address }}"
                                                                data-telephone="{{ $item['patient']->telephone }}"
                                                                data-type_patient="{{ $item['patient']->type_patient }}">
                                                            </button>
                                                        </td>
                                                        <td class="align-middle text-center">{{ $item['patient']->sex }}</td>
                                                        <td class="align-middle text-center">{{ $item['patient']->telephone }}</td>
                                                        <td class="align-middle text-center">{{ $item['next_appointment'] }}</td>
                                                        <td class="align-middle text-center">{{ $item['doctor_name'] }}</td>
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
                data-id="{{ $item['patient']->id ?? ''}}">View Patient's Info <i class="fa fa-eye"></i>
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

        function selectPatientFromRow(row) {
            // Get the parent row and then find the inline edit button that contains the data attributes
            var inlineEditButton = row.find("button.btn_edit_patient[data-id]").first();

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
                contextMenu.find(".view-patient").attr("data-id", selectedPatient.id);
            }
            return selectedPatient;
        }

        function openEditModal(patient) {
            if (!patient) return;
            // Populate the edit form fields with the selected patient's data
            $("#patient-id").val(patient.id);
            $("#patient-name").val(patient.name);
            $("#patient-age").val(patient.age);
            $("#patient-address").val(patient.address);
            $("#patient-telephone").val(patient.telephone);
            $("#patient-type_patient").val(patient.type_patient);

            // Set the dropdown value for sex and trigger change if needed
            $("#patient-sex").val(patient.sex).change();

            // Update the form action URL to include the patient ID
            var formAction = "{{ route('patient.update', ':id') }}";
            formAction = formAction.replace(':id', patient.id);
            $("#editPatientForm").attr("action", formAction);

            // Open the modal for editing
            $("#fire-modal-patient").modal("show");
        }

        // Delegate right-click on the patient name to show the context menu (PC)
        $(document).on("contextmenu", ".patient-name", function(e) {
            e.preventDefault();
            $(".patient-menu").removeClass("show");

            // Position the context menu as per your original design
            var rect = this.getBoundingClientRect();
            contextMenu.css({
                top: rect.bottom + window.scrollY - 30 + "px",
                left: rect.left + window.scrollX + "px",
                display: "block"
            });

            selectPatientFromRow($(this).closest("tr"));
        });

        // iPad / touch: tap the ellipsis button to open the action box directly in the column
        $(document).on("click", ".patient-menu-toggle", function(e) {
            e.stopPropagation();
            var $cell = $(this).closest(".patient-name");
            contextMenu.hide();
            $(".patient-menu").not($cell.find(".patient-menu")).removeClass("show");
            $cell.find(".patient-menu").toggleClass("show");
            selectPatientFromRow($cell.closest("tr"));
        });

        // Hide the menus when clicking anywhere else
        $(document).on("click", function() {
            contextMenu.hide();
            $(".patient-menu").removeClass("show");
        });

        // Delegate the click event on the "Edit Patient's Info" button (context menu + cell box)
        $(document).on("click", "#contextMenu .btn_edit_patient, .patient-menu-edit", function() {
            openEditModal(selectedPatient);
        });

        // When the "View Patient's Info" button (context menu) is clicked
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

        // When the "View Patient's Info" button (cell box) is clicked
        $(document).on("click", ".patient-menu-view", function() {
            if (selectedPatient) {
                var viewPatientUrl = "{{ route('view_patient_detail', ['id' => ':id']) }}";
                viewPatientUrl = viewPatientUrl.replace(':id', selectedPatient.id);
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
    .bg-soft-red {
        background-color: #f28b82 !important; /* Professional soft red */
        border: 1px solid #d9534f;           /* Subtle darker red border */
        color: #212529 !important;           /* Dark text for readability */
    }

    /* [iPad / touch: action box directly in the Patient's Name column] */
    .patient-name {
        position: relative;
    }

    .patient-menu-toggle {
        margin-left: 6px;
        padding: 2px 8px;
    }

    .patient-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 1050;
        width: 200px;
        background: white;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        padding: 10px;
        border-radius: 5px;
        text-align: left;
    }

    .patient-menu.show {
        display: block;
    }

    .patient-menu button {
        width: 100%;
        margin-bottom: 5px;
    }

    .patient-menu button:last-child {
        margin-bottom: 0;
    }

</style>