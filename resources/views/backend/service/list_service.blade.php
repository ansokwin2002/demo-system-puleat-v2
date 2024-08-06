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
                <h1>Service</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Service</a></div>
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
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php 
                                       $services = App\Models\Service::all();
                                    @endphp
                                    @foreach ($services as $index => $item)
                                        <tr>
                                            <td>{{ $item->id}}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                <button class="btn btn-warning" data-toggle="modal" data-target="#fire-modal-4">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button> 
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
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
</div>

@include('backend.service.edit_Model')

@endsection
