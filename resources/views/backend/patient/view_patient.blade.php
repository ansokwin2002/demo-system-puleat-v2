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
                                            @foreach ($patients as $index => $patient)
                                            <tr class="row_patient_all_history" 
                                                data-patient-id="{{ $patient->id }}" 
                                                data-toggle="modal" 
                                                data-target="#fire-modal-4">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $patient->date }}</td>
                                                <td>{{ $patient->name }}</td>
                                                <td>{{ $patient->age }}</td>
                                                <td>{{ $patient->sex }}</td>
                                                <td>{{ $patient->address }}</td>
                                                <td>{{ $patient->telephone }}</td>
                                                <td><span class="badge badge-secondary">{{ $patient->type_patient }}</span></td>
                                                <td class="td-action">
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

    <!-- [Model Patient All History-------------------------] -->
    <div class="modal fade" id="fire-modal-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-service-detail">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">All Patient History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered modelAllPatientHistory" id="">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">Invoice ID</th>
                                <th class="text-white">Date</th>
                                <th class="text-white">Doctor</th>
                                <th class="text-white">Cashier</th>
                                <th class="text-white">Patient</th>
                                <th class="text-white">Grand Total</th>
                                <th class="text-white">Amount Paid</th>
                                <th class="text-white">Amount Unpaid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic Content Here -->
                        </tbody>
                    </table>
                    <div id="notesSection">
                        <!-- Patient notes will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- [Model Patient All History-------------------------] -->


</div>

@endsection

@push('scripts')

<script>

$(document).on('click', '.row_patient_all_history', function() {
    var patientId = $(this).data('patient-id'); // Ensure this is correctly set in your HTML
    var modalBody = $('.modelAllPatientHistory tbody');
    var notesSection = $('#notesSection');
    
    modalBody.empty(); // Clear existing data
    notesSection.empty(); // Clear existing notes

    $.ajax({
        url: '/get-patient-history/' + patientId,
        type: 'GET',
        success: function(response) {
            console.log('AJAX Response:', response); // Log the response for debugging
            
            if (Array.isArray(response.histories) && response.histories.length > 0) {
                response.histories.forEach(function(history) {
                    var payments = history.patient_payment; // Ensure this is an object
                    
                    // Log patient_payment for debugging
                    console.log('Patient Payment Data:', payments);
                    
                    if (payments && typeof payments === 'object') {
                        // Display invoice details
                        modalBody.append(`
                            <tr class="invoice-details">
                                <td>${history.invoice_id || 'N/A'}</td>
                                <td>${payments.date || 'N/A'}</td>
                                <td>${history.doctor ? history.doctor.name : 'N/A'}</td>
                                <td>${history.cashier ? history.cashier.name : 'N/A'}</td>
                                <td>${payments.customer || 'N/A'}</td>
                                <td>${payments.grand_total || '$0.00'}</td>
                                <td>${payments.amount_paid || '$0.00'}</td>
                                <td>${payments.amount_unpaid || '$0.00'}</td> <!-- Added Data -->
                            </tr>
                        `);

                        // Process services array if available
                        if (Array.isArray(payments.services) && payments.services.length > 0) {
                            payments.services.forEach(function(service, serviceIndex) {
                                modalBody.append(`
                                    <tr class="service-row">
                                        <td colspan="8">
                                            <div>
                                                <strong>Service #${serviceIndex + 1}:</strong>
                                                <ul>
                                                    <li><strong>Service Name:</strong> ${service.service_name || 'N/A'}</li>
                                                    <li><strong>Service Unit:</strong> ${service.service_unit || 'N/A'}</li>
                                                    <li><strong>Service Price:</strong> ${service.service_price || 'N/A'}</li>
                                                    <li><strong>Subtotal:</strong> ${service.subtotal || 'N/A'}</li>
                                                    <li><strong>Discount (%)</strong> ${service.discount_percent || '0%'}</li>
                                                    <li><strong>Discount ($)</strong> ${service.discount_dollar ? `$${service.discount_dollar}` : '$0.00'}</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            modalBody.append('<tr><td colspan="8">No service data available.</td></tr>');
                        }
                        
                        // Populate the notes section with HTML content
                        notesSection.html(`
                            <h5>Patient Notes:</h5>
                            <div>${payments.patient_noted || 'No notes available.'}</div>
                        `);
                    } else {
                        modalBody.append('<tr><td colspan="8">No patient payment data available.</td></tr>');
                    }
                });
            } else {
                modalBody.append('<tr><td colspan="8">No patient history available.</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching patient history:', status, error);
            modalBody.append('<tr><td colspan="8">Error loading data.</td></tr>');
        }
    });
});



</script>

@endpush