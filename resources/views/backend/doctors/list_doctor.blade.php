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
                <h1>List Doctor</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Doctor</a></div>
                    <div class="breadcrumb-item">List Doctor</div>
                </div>
            </div>
            <!-- [header-------------------------] -->

            <!-- [Doctor_table-------------------------] -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable" id="table_doctor">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white align-middle text-center">#</th>
                                                <th class="text-white align-middle text-center">Name</th>
                                                <th class="text-white align-middle text-center">Sex</th>
                                                <th class="text-white align-middle text-center">Specialization</th>
                                                <th class="text-white align-middle text-center">Phone</th>
                                                <th class="text-white align-middle text-center">Email</th>
                                                <th class="text-white align-middle text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            use App\Models\Doctor;
                                            $doctors = Doctor::latest('created_at')->get();
                                        @endphp
    
                                        @foreach ($doctors as $index => $doctor)
                                            <tr class="row_list_doctor">
                                                <td class="align-middle text-center">{{ $index +=1 }}</td>
                                                <td class="align-middle text-center"><span class="badge badge-dark">{{ $doctor->name }}</span></td>
                                                <td class="align-middle text-center">{{ $doctor->sex }}</td>
                                                <td class="align-middle text-center"><span class="badge badge-light">{{ $doctor->specialization }}</span></td>
                                                <td class="align-middle text-center">{{ $doctor->phone }}</td>
                                                <td class="align-middle text-center">{{ $doctor->email }}</td>
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-danger" onclick="swal('Cannot Delete', 'Doctor can only be updated after creation !', 'error');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <button class="btn btn-warning btn_edit_doctor" 
                                                            data-toggle="modal" 
                                                            data-target="#fire-modal-doctor"
                                                            data-id="{{ $doctor->id }}"
                                                            data-name="{{ $doctor->name }}"
                                                            data-sex="{{ $doctor->sex }}"
                                                            data-specialization="{{ $doctor->specialization }}"
                                                            data-phone="{{ $doctor->phone }}"
                                                            data-email="{{ $doctor->email }}">
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
            <!-- [Doctor_table-------------------------] -->

        </section>
    </div>
    <!-- [main_content------------------------------] -->

    <!-- [footer------------------------------] -->
    <footer class="main-footer">
        @include('backend.body.footer')
    </footer>
    <!-- [footer------------------------------] -->
    <!-- [Model Edit Doctor-------------------------] -->
        <div class="modal fade" id="fire-modal-doctor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-edit-doctor">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Doctor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editDoctorForm" action="{{ route('doctor.update', 0) }}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="doctor-id">
                            <div class="form-group">
                                <label for="name">Doctor Name:</label>
                                <input type="text" name="name" id="doctor-name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex:</label>
                                <select id="doctor-select" name="sex"  class="form-control" style="width: 100%;" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="specialization">Specialization:</label>
                                <input type="text" name="specialization" id="doctor-specialization" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" name="phone" id="doctor-phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="doctor-email" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-times"></i> Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Model Edit Doctor-------------------------] -->

    <!-- [Model Delete Doctor--------------------------------] -->
        <div class="modal fade" id="ModelDeleteDoctor" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this doctor?
                    </div>
                    <div class="modal-footer">
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Model Delete Doctor--------------------------------] -->


</div>

@endsection
