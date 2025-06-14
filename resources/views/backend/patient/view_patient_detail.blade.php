@extends ('backend.master')
@section('content')

@php
    $display = [
        'patient-info' => '
            <div class="patient-details">
                <form>
                    <input type="hidden" name="id" value="'.htmlspecialchars($patient->id).'">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Patient ID:</label>
                                <input type="text" name="id" value="'.htmlspecialchars($patient->id).'" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Patient Name:</label>
                                <input type="text" name="name" value="'.htmlspecialchars($patient->name).'" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="number" name="age" value="'.htmlspecialchars($patient->age).'" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sex">Sex:</label>
                                <select name="sex" class="form-control" disabled>
                                    <option value="male" '.($patient->sex == "male" ? "selected" : "").'>Male</option>
                                    <option value="female" '.($patient->sex == "female" ? "selected" : "").'>Female</option>
                                    <option value="other" '.($patient->sex == "other" ? "selected" : "").'>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date">Date Register:</label>
                                <input type="text" name="date" value="'.htmlspecialchars($patient->date).'" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="type_patient">Type Patient:</label>
                                <input type="text" name="type_patient" value="'.htmlspecialchars($patient->type_patient).'" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" value="'.htmlspecialchars($patient->address).'" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone">Telephone:</label>
                                <input type="text" name="telephone" value="'.htmlspecialchars($patient->telephone).'" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        ',
        'doctor-notedbook' => view('backend.patient.doctor-notedbook-row', compact('doctorNotebook', 'patient'))->render(),
        'treatment-planning' => view('backend.patient.treatment-planning', compact('updateCustomerInfo','completedCustomerInfo','invoice_id'))->render(),
        'treatment' => view('backend.patient.treatment',compact('updateCustomerInfo','invoice_id','completedTreatmentInfo'))->render()
    ];
@endphp

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
                    <h1>Diagnosis and Disease</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('list_Patient') }}">Patient</a></div>
                        <div class="breadcrumb-item">List Patient</div>
                    </div>
                </div>
            <!-- [header-------------------------] -->

            <!--[Patient_table-------------------------]-->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="patient-info-tab2" data-toggle="tab" href="#patient-info" role="tab" aria-controls="patient-info" aria-selected="true">Patient Information</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="doctor-notebook-tab2" data-toggle="tab" href="#doctor-notebook" role="tab" aria-controls="doctor-notebook" aria-selected="false">Doctor Notebook</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="treatment-planning-tab2" data-toggle="tab" href="#treatment-planning" role="tab" aria-controls="treatment-planning" aria-selected="false">Treatment Planning</a>
                                            </li>
                                            <li class="nav-item treatment_service">
                                                <a class="nav-link" id="treatment-tab2" data-toggle="tab" href="#treatment" role="tab" aria-controls="treatment" aria-selected="false">Treatment</a>
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a class="nav-link" id="appointment-tab2" data-toggle="tab" href="#appointment" role="tab" aria-controls="appointment" aria-selected="false">Appointment</a>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <a href="{{ route('list_Patient') }}">
                                            <button class="btn btn-primary float-right">
                                                <i class="fa-solid fa-arrow-left"></i> Back To Patient List
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade show active" id="patient-info" role="tabpanel" aria-labelledby="patient-info-tab2">
                                        {!! $display['patient-info'] !!}
                                    </div>
                                    <div class="tab-pane fade" id="doctor-notebook" role="tabpanel" aria-labelledby="doctor-notebook-tab2">
                                    <button class="btn btn-primary"  data-toggle="modal" data-target="#fire-modal-doctor-notebook" ><i class="fa fa-plus"></i> Add New Doctor Notebook</button>
                                        <div class="table-responsive mt-3">
                                            <table class="table table-striped dataTable" id="table_doctor_notebook">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th class="text-white align-middle text-center ">No.</th>
                                                        <th class="text-white align-middle text-center ">Date</th>
                                                        <th class="text-white align-middle text-center ">Doctor Name</th>
                                                        <th class="text-white align-middle ">Description</th>
                                                        <th class="text-white align-middle text-center ">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                </tbody>
                                            </table>
                                        </div>   
                                    </div>
                                    <div class="tab-pane fade" id="treatment-planning" role="tabpanel" aria-labelledby="treatment-planning-tab2">
                                        {!! $display['treatment-planning'] !!}
                                    </div>
                                    <div class="tab-pane fade" id="treatment" role="tabpanel" aria-labelledby="treatment-tab2">
                                        {!! $display['treatment'] !!}
                                    </div>
                                    <!-- <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab2">
                                        Appointment imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                                    </div> -->
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

</div>

<!-- [Model Add Doctor_Notebook-------------------------] -->
    <div class="modal fade" id="fire-modal-doctor-notebook" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-doctor-notebook">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Doctor Notebook</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="doctorNotebookForm" method="post">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="form-group">
                            <label for="date">Date :</label>
                            <input type="text" name="date" id="date" class="form-control datepicker">
                        </div>
                        <div class="form-group">
                            <label for="doctor_id">Doctor :</label>
                            @php 
                                $doctors = App\Models\Doctor::all();
                            @endphp
                            <select class="form-control" name="doctor_id" id="doctor_id">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <div class="flex-grow-1">
                                <textarea name="description" id="description" class="summernote pt-4"></textarea>
                            </div>
                            <div class="invalid-feedback">
                                Please fill Type doctor notebook!
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="addNewButton" onclick="validateDescription(event)">
                                <i class="fa fa-plus"></i> Add New
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- [Model Add Doctor_Notebook-------------------------] -->

<!-- [Model_Delete_Doctor_Notebook-----------------------------] -->
    <div class="modal fade" id="ModelDeleteDoctorNotebook" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Doctor Notebook?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Yes, Delete it!</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-times"></i> Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- [Model_Delete_Doctor_Notebook-----------------------------] -->

<!-- [Model Edit Doctor_Notebook--------------------------] -->
    <div class="modal fade" id="fire-modal-edit-doctor-notebook" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-doctor-notebook">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('doctor.notebook.update', ':id') }}" id="editDoctorNotebookForm" method="POST">
                        @csrf
                        @method('PUT') <!-- This is important for updating data -->
                        <input type="hidden" name="id" id="editDoctorNotebookId">
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        
                        <div class="form-group">
                            <label for="date">Date :</label>
                            <input type="text" name="date" id="editDate" class="form-control datepicker">
                        </div>

                        <div class="form-group">
                            <label for="doctor_id">Doctor :</label>
                            @php 
                                $doctors = App\Models\Doctor::all();
                            @endphp
                            <select class="form-control" name="doctor_id" id="editDoctor">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" 
                                        {{ old('doctor_id', $doctor->id) == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Description :</label>
                            <div class="flex-grow-1">
                                <textarea name="description" id="editDescription" class="summernote pt-4"></textarea>
                            </div>
                            <div class="invalid-feedback">
                                Please fill Type doctor notebook!
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Doctor Notebook
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- [Model Edit Doctor_Notebook--------------------------] -->

<!-- [Amount Paid-------------------------] -->
    <div class="modal fade" id="fire-modal-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Amount paid <sup class="text-danger">★</sup></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control form_paid" id="form_paid" inputmode="numeric" pattern="\d*" title="Please enter a number">
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-primary temp_btn_paid" data-dismiss="modal"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- [Amount Paid-------------------------] -->

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function validateDescription(event) {
    var description = document.getElementById('description').value;

    // Check if the description is empty
    if (!description.trim()) {
        event.preventDefault();  // Prevent form submission

        // Show SweetAlert2 popup for validation
        Swal.fire({
            icon: 'warning',
            title: 'Please fill in the description first!',
            text: 'Description cannot be empty.',
            confirmButtonText: 'OK'
        });
    }
}
 $(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if(session('active_tab') == 'doctor-notebook')
        // Activate the Doctor Notebook tab
        $('#doctor-notebook-tab2').tab('show');
    @endif

    // [Delete Doctor_Notebook----------------------------]
        $('#ModelDeleteDoctorNotebook').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes

            var form = $('#deleteForm');
            var actionUrl = "{{ route('doctor.notebook.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);

            // Update the form action attribute
            form.attr('action', actionUrl);
        });
    // [Delete Doctor_Notebook----------------------------]

    // [Edit Doctor_Notebook----------------------------]
        $('.edit-doctor-notebook').click(function () {
            let id = $(this).data('id');
            let date = $(this).data('date');
            let doctor = $(this).data('doctor');
            let description = $(this).data('description');

            // Set values in modal
            $('#editDoctorNotebookId').val(id);
            $('#editDate').val(date);
            $('#editDoctor').val(doctor).trigger('change'); // Set doctor select

            // If using summernote, use its method to set the content
            $('#editDescription').summernote('code', description);

            // Update form action with the correct URL and ID
            $('#editDoctorNotebookForm').attr('action', '{{ route("doctor.notebook.update", ":id") }}'.replace(':id', id));

            // Show modal
            $('#fire-modal-edit-doctor-notebook').modal('show');
        });
    // [Edit Doctor_Notebook----------------------------]

    // [fetch_Doctor_Noteboks----------------------------]
        let doctorNotebookTable;

        $(document).ready(function () {
            doctorNotebookTable = $('#table_doctor_notebook').DataTable({
                processing: true,
                serverSide: false,
                order: [], // Disable default sorting
                columns: [
                    { title: "No.", className: "align-middle text-center" }, 
                    { title: "Date", className: "align-middle text-center" }, 
                    { title: "Doctor Name", className: "align-middle text-center" }, 
                    { title: "Description", className: "align-middle" }, 
                    { title: "Action", className: "align-middle text-center", orderable: false }
                ]
            });

            fetchDoctorNotebooks(); // Load data on page load
        });

        function fetchDoctorNotebooks() {
            let patientId = window.location.pathname.split('/').pop();
            $.ajax({
                url: `{{ route('doctor.notebook.index', '') }}/${patientId}`,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    doctorNotebookTable.clear(); // Clear existing rows

                    data.forEach((doctor, index) => {
                        doctorNotebookTable.row.add([
                            index + 1,
                            doctor.date,
                            doctor.doctor_name,
                            `<div class="desc-text">${doctor.description}</div>`,
                            `
                            <i data-id="${doctor.id}" class="fa fa-trash text-danger delete-notebook" 
                            data-toggle="tooltip" title="Delete Doctor Notebook" style="cursor: pointer;"></i>
                            &nbsp;
                            <i data-id="${doctor.id}" data-date="${doctor.date}" data-doctor="${doctor.doctor_name}" 
                            data-description="${doctor.description}" class="fa fa-edit edit-doctor-notebook" 
                            data-toggle="tooltip" title="Edit Doctor Notebook" style="color: gold;cursor: pointer;"></i>
                            `
                        ]);
                    });

                    doctorNotebookTable.draw(); // Redraw table with new data
                    $('[data-toggle="tooltip"]').tooltip(); // Reinitialize tooltips

                    // Delete functionality
                    $('.delete-notebook').on('click', function () {
                        const notebookId = $(this).data('id');
                        
                        // Show SweetAlert confirmation before deleting
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this action!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Proceed with the delete operation
                                $.ajax({
                                    url: `{{ route('doctor.notebook.destroy', '') }}/${notebookId}`,
                                    type: "DELETE",
                                    data: {
                                        _token: '{{ csrf_token() }}', // Include CSRF token here
                                    },
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.success) {
                                            fetchDoctorNotebooks(); // Reload data after delete
                                            Swal.fire({
                                                title: 'Deleted!',
                                                text: 'The doctor notebook has been deleted successfully.',
                                                icon: 'success',
                                                timer: 1000,  // Auto-close after 2 seconds
                                                showConfirmButton: false // Hide confirm button
                                            });
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                'There was an error deleting the doctor notebook.',
                                                'error'
                                            );
                                        }
                                    },
                                    error: function (xhr) {
                                        console.error("Error deleting doctor notebook:", xhr.responseText);
                                        Swal.fire(
                                            'Error!',
                                            'There was an error deleting the doctor notebook.',
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
                    });

                // Edit functionality
                    $('.edit-doctor-notebook').on('click', function () {
                        const notebookId = $(this).data('id');
                        const date = $(this).data('date');
                        const doctorName = $(this).data('doctor');
                        const description = $(this).data('description');

                        // Populate modal with data
                        $('#fire-modal-edit-doctor-notebook #notebookId').val(notebookId);
                        $('#fire-modal-edit-doctor-notebook #date').val(date);
                        $('#fire-modal-edit-doctor-notebook #doctorName').val(doctorName);
                        $('#fire-modal-edit-doctor-notebook #description').val(description);

                        // Open modal
                        $('#fire-modal-edit-doctor-notebook').modal('show');
                    });

                    // Handle form submission for editing
                    $('#editDoctorNotebookForm').submit(function (e) {
                        e.preventDefault();

                        const notebookId = $('#notebookId').val();
                        const date = $('#date').val();
                        const doctorName = $('#doctorName').val();
                        const description = $('#description').val();

                        $.ajax({
                            url: `{{ route('doctor.notebook.update', '') }}/${notebookId}`, // Update route
                            type: "PUT",
                            data: {
                                _token: '{{ csrf_token() }}', // Include CSRF token for security
                                date: date,
                                doctor_name: doctorName,
                                description: description
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response) {
                                    // Reload table to reflect updated data
                                    fetchDoctorNotebooks();
                                    $('#fire-modal-edit-doctor-notebook').modal('hide'); // Close modal
                                    alert("Doctor notebook updated successfully.");
                                } else {
                                    alert("Error updating doctor notebook.");
                                }
                            },
                            error: function (xhr) {
                                console.error("Error updating doctor notebook:", xhr.responseText);
                                alert("Error updating doctor notebook.");
                            }
                        });
                    });

                },
                error: function (xhr) {
                    console.error("Error fetching doctor notebooks:", xhr.responseText);
                }
            });
        }
    // [fetch_Doctor_Noteboks----------------------------]

    // [Add Doctor_Notebook----------------------------]
        $('#doctorNotebookForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('doctor.notebook.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function () {
                    $('#addNewButton').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                },
                success: function (response) {
                    if (response && response.id) {
                        fetchDoctorNotebooks(); // Refresh the table data
                        $('#doctorNotebookForm')[0].reset(); // Reset the form
                        $('#fire-modal-doctor-notebook').modal('hide'); // Close modal
                        
                        // SweetAlert2 success message with auto-remove after 2 seconds (1000ms)
                        Swal.fire({
                            title: 'Success!',
                            text: 'Doctor notebook has been added successfully.',
                            icon: 'success',
                            timer: 1000,  // Auto-close after 2 seconds
                            showConfirmButton: false // Hide the confirm button
                        });
                    } else {
                        console.error('Invalid response format:', response);
                    }
                },
                error: function (xhr) {
                    console.error("Error occurred:", xhr.responseText);
                },
                complete: function () {
                    $('#addNewButton').prop('disabled', false).html('<i class="fa fa-plus"></i> Add New');
                }
            });
        });
    // [Add Doctor_Notebook----------------------------]

});
</script>
@endpush

<style>
.desc-text {
    white-space: normal;   /* Allow text to wrap */
    word-break: break-all;  /* Break words if necessary */
}
</style>