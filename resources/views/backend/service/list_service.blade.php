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
                <h1>List Service</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('view_Service') }}">Service</a></div>
                    <div class="breadcrumb-item">List Service</div>
                </div>
            </div>
            <!-- [header-------------------------] -->

            <!-- [Service_table-------------------------] -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable" id="table_service">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white align-middle text-center">#</th>
                                                <th class="text-white align-middle text-center">Service</th>
                                                <th class="text-white align-middle text-center">Unit</th>
                                                <th class="text-white align-middle text-center">Price</th>
                                                <th class="text-white align-middle text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                use App\Models\Service;
                                                $services = Service::latest('created_at')->get();
                                            @endphp

                                            @foreach ($services as $index => $item)
                                                <tr class="row_list_service">
                                                    <td class="align-middle text-center">{{ $index +=1 }}</td>
                                                    <td class="align-middle text-left"><span class="badge badge-danger">{{ $item->name }}</span></td>
                                                    <td class="align-middle text-center">{{ $item->unit }}</td>
                                                    <td class="align-middle text-center"><span class="badge badge-dark">${{ $item->price }}</span></td>
                                                    <td class="align-middle text-center">
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ModelDeleteService" data-id="{{ $item->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <button class="btn btn-warning btn_edit_service" 
                                                                data-toggle="modal" 
                                                                data-target="#fire-modal-service"
                                                                data-id="{{ $item->id }}"
                                                                data-name="{{ $item->name }}"
                                                                data-unit="{{ $item->unit }}"
                                                                data-price="{{ $item->price }}">
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
            <!-- [Service_table-------------------------] -->

        </section>
    </div>
    <!-- [main_content------------------------------] -->

    <!-- [footer------------------------------] -->
    <footer class="main-footer">
        @include('backend.body.footer')
    </footer>
    <!-- [footer------------------------------] -->
     <!-- [Model Detail Patient Service-------------------------] -->
        <div class="modal fade" id="fire-modal-service" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-service-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editServiceForm" action="{{ route('service_Update', 0) }}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="service-id">
                            <div class="form-group">
                                <label for="name">Service Name:</label>
                                <input type="text" name="name" id="service-name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit:</label>
                                <input type="text" name="unit" id="service-unit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="service-price" class="form-control" required>
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
    <!-- [Model Detail Patient Service-------------------------] -->

    <!-- [Model Delete Service--------------------------------] -->
        <div class="modal fade" id="ModelDeleteService" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this service?
                    </div>
                    <div class="modal-footer">
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-times"></i> Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Model Delete Service--------------------------------] -->


</div>

@endsection

