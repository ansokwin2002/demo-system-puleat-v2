@extends('backend.master')

@section('content')

<div class="main-wrapper main-wrapper-1">
    <!-- [navbar] -->
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        @include('backend.body.navbar')
    </nav>
    <!-- [navbar] -->

    <!-- [aside] -->
    <div class="main-sidebar sidebar-style-2">
        @include('backend.body.aside')
    </div>
    <!-- [aside] -->

    <!-- [main_content] -->
    <div class="main-content">
        <section class="section">
            <!-- [header] -->
            <div class="section-header">
                <h1>Upload</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Upload</a></div>
                    <div class="breadcrumb-item">Upload Patient's file</div>
                </div>
            </div>
            <!-- [header] -->

            <!-- [Patient_table] -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped dataTable" id="table_service">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white">Date</th>
                                            <th class="text-white">Doctor</th>
                                            <th class="text-white">Patient</th>
                                            <th class="text-white">Service</th>
                                            <th class="text-white">File Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patientHistories as $patientHistory)
                                            @php
                                                $paymentData = $patientHistory->patient_payment;
                                                $doctorName = $patientHistory->doctor->name ?? '';
                                                $patientName = $patientHistory->patient->name ?? '';
                                            @endphp
             
                                            @foreach ($patientHistory->patient_payment['services'] ?? [] as $service)
                                                <tr class="row_multi_image" data-toggle="modal" 
                                                    data-target="#fire-modal-4" data-invoice-id="{{ $patientHistory->invoice_id }}">
                                                    <td>{{ $paymentData['date'] ?? '' }}</td>
                                                    <td>{{ $doctorName }}</td>
                                                    <td>{{ $patientName }}</td>
                                                    <td>{{ $service['service_name'] }}</td>
                                                    <td class="td-file-upload">
                                                        <button class="btn btn-success view-images-btn" data-invoice-id="{{ $patientHistory->invoice_id }}">View Images</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Patient_table] -->

        </section>
    </div>
    <!-- [main_content] -->

    <!-- [footer] -->
    <footer class="main-footer">
        @include('backend.body.footer')
    </footer>
    <!-- [footer] -->

    <!-- [Modal Detail Patient Service] -->
        <div class="modal fade" id="fire-modal-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog custom-modal-service-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                    <span class="text-danger">*Upload Multiple Images: Select and upload multiple images at once. Drag and drop or choose files from your device*</span>
                                    </div>
                                    <div class="card-body">
                                        <form id="uploadForm" action="{{ route('uploadMultiImage.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="invoice_id" id="invoice_id">
                                            <!-- Dropzone Container -->
                                            <div id="mydropzone">
                                                <span>Drop files here to upload</span>
                                                <input type="file" id="fileInput" name="files[]" multiple accept="image/*">
                                            </div>
                                            <div class="image-preview-container"></div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-upload"></i> Upload</button>
                                                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa-solid fa-times"></i> Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Modal Detail Patient Service] -->

    <!-- [Modal View Images] -->
        <div class="modal fade" id="view-images-modal" tabindex="-1" role="dialog" aria-labelledby="viewImagesLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewImagesLabel">Patient Images</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="gallery gallery-md">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- [Modal View Images] -->


</div>

@endsection

@push('scripts')
<script>

// [model_upload_multi_image---------------------------------]
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.querySelector('.image-preview-container');

        if ($(event.target).closest('.td-file-upload').length > 0) {
            return; 
        }

        fileInput.addEventListener('change', function (event) {
            const files = event.target.files;
            previewContainer.innerHTML = ''; // Clear previous previews

            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.classList.add('image-preview');

                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Image preview">
                        <button class="image-remove-btn" data-index="${index}">&times;</button>
                        <div class="image-size">${(file.size / 1024).toFixed(2)} KB</div>
                    `;

                    previewContainer.appendChild(previewDiv);
                };

                reader.readAsDataURL(file);
            });
        });

        previewContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('image-remove-btn')) {
                const index = event.target.getAttribute('data-index');
                const files = fileInput.files;

                // Create a new DataTransfer object to manipulate the FileList
                const dataTransfer = new DataTransfer();

                // Add all files except the one to be removed
                Array.from(files).forEach((file, i) => {
                    if (i != index) {
                        dataTransfer.items.add(file);
                    }
                });

                // Update the input with the new FileList
                fileInput.files = dataTransfer.files;

                // Remove the preview from the container
                event.target.parentElement.remove();
            }
        });
    });
// [model_upload_multi_image---------------------------------]

// [get_row_multi_image---------------------------------]
    document.querySelectorAll('.row_multi_image').forEach(function(row) {
        row.addEventListener('click', function() {
            var invoiceId = this.getAttribute('data-invoice-id');
            document.getElementById('invoice_id').value = invoiceId;
        });
    });
// [get_row_multi_image---------------------------------]

// [view_all_image---------------------------------]
    // document.addEventListener('DOMContentLoaded', function () {
    //     const viewImagesModal = document.getElementById('view-images-modal');
    //     const imageGallery = viewImagesModal.querySelector('.image-gallery');

    //     // Function to open modal and load images
    //     function openModalWithImages(invoiceId) {
    //         fetch(`/get-images/${invoiceId}`)
    //             .then(response => response.json())
    //             .then(data => {
    //                 imageGallery.innerHTML = ''; // Clear previous images

    //                 data.images.forEach(image => {
    //                     const img = document.createElement('img');
    //                     img.src = image.url; // URL of the image
    //                     img.alt = 'Image';
    //                     img.style.width = '100%'; // Adjust width as needed
    //                     img.style.height = 'auto'; // Maintain aspect ratio

    //                     imageGallery.appendChild(img);
    //                 });

    //                 $(viewImagesModal).modal('show'); // Show the modal
    //             })
    //             .catch(error => console.error('Error fetching images:', error));
    //     }

    //     // Handle button click separately
    //     document.querySelectorAll('.view-images-btn').forEach(button => {
    //         button.addEventListener('click', function (event) {
    //             event.stopPropagation(); // Prevent the row click event from also triggering
    //             const invoiceId = this.getAttribute('data-invoice-id');
    //             openModalWithImages(invoiceId);
    //         });
    //     });
    // });
// [view_all_image---------------------------------]

// [view-btn-image--------------------------------]
    document.addEventListener('DOMContentLoaded', function () {
        function loadImages(invoiceId) {
            fetch(`/get-images/${invoiceId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Images data:', data);
                    const gallery = document.querySelector('.gallery.gallery-md');
                    gallery.innerHTML = '';

                    data.images.forEach((image, index) => {
                        const galleryItem = document.createElement('a');
                        galleryItem.classList.add('gallery-item');
                        galleryItem.href = image.url; // URL of the image
                        galleryItem.dataset.fancybox = "gallery"; // Fancybox attribute
                        galleryItem.dataset.caption = `Image ${index + 1}`; // Optional caption

                        const img = document.createElement('img');
                        img.src = image.url;
                        img.style.width = '100%'; // Optional: Adjust width
                        img.style.height = 'auto'; // Maintain aspect ratio
                        galleryItem.appendChild(img);

                        gallery.appendChild(galleryItem);
                    });

                    // Initialize Fancybox after adding gallery items
                    $.fancybox.open(gallery.querySelectorAll('[data-fancybox="gallery"]'), {
                        loop: true,
                        buttons: [
                            'slideShow',
                            'thumbs',
                            'close'
                        ]
                    });

                    $('#view-images-modal').modal('show');
                })
                .catch(error => console.error('Error fetching images:', error));
        }

        document.querySelectorAll('.view-images-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.stopPropagation();
                const invoiceId = this.getAttribute('data-invoice-id');
                loadImages(invoiceId);
            });
        });
    });
// [view-btn-image--------------------------------]



</script>
@endpush


