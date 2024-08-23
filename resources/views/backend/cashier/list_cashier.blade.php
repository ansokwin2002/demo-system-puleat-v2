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
                <h1>List Cashier</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Cashier</a></div>
                    <div class="breadcrumb-item">List Cashier</div>
                </div>
            </div>
            <!-- [header-------------------------] -->

            <!-- [Cashier_table-------------------------] -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable" id="table_service">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">#</th>
                                                <th class="text-white">Cashier's Name</th>
                                                <th class="text-white">Sex</th>
                                                <th class="text-white">Email</th>
                                                <th class="text-white">Telephone</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php 
                                            $cashiers = App\Models\Cashier::all();
                                        @endphp
                                        @foreach ($cashiers as $cashier)
                                            <tr>
                                                <td>{{ $cashier->id }}</td>
                                                <td>{{ $cashier->name }}</td>
                                                <td>{{ $cashier->sex }}</td>
                                                <td>{{ $cashier->email }}</td>
                                                <td>{{ $cashier->telephone }}</td>
                                                <td>
                                                    <button class="btn btn-danger" onclick="swal('Cannot Delete', 'Cashier can only be updated after creation !', 'error');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button class="btn btn-warning btn_edit_cashier" 
                                                            data-toggle="modal" 
                                                            data-target="#fire-modal-cashier"
                                                            data-id="{{ $cashier->id }}"
                                                            data-name="{{ $cashier->name }}"
                                                            data-sex="{{ $cashier->sex }}"
                                                            data-email="{{ $cashier->email }}"
                                                            data-telephone="{{ $cashier->telephone }}">
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
            <!-- [Cashier_table-------------------------] -->

        </section>
    </div>
    <!-- [main_content------------------------------] -->

    <!-- [footer------------------------------] -->
    <footer class="main-footer">
        @include('backend.body.footer')
    </footer>
    <!-- [footer------------------------------] -->

    <!-- [Model Edit Cashier-------------------------] -->
        <div class="modal fade" id="fire-modal-cashier" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-service-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Cashier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editCashierForm" action="{{ route('cashier.update', 0) }}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="cashier-id">
                            <div class="form-group">
                                <label for="name">Cashier's Name:</label>
                                <input type="text" name="name" id="cashier-name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex:</label>
                                <select id="cashier-select" name="sex"  class="form-control select2" style="width: 100%;">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unknown">Unknown</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="cashier-email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Telephone:</label>
                                <input type="text" name="telephone" id="cashier-telephone" class="form-control" required>
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
    <!-- [Model Edit Cashier-------------------------] -->

</div>

@endsection
