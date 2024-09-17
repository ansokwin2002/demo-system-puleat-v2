<?php

namespace App\Http\Controllers\uploadMultiImage;

use App\Http\Controllers\Controller;
use App\Models\PatientHistory;
use App\Models\uploadMultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class uploadMultiImageController extends Controller
{
    public function index(){
        $patientHistories = PatientHistory::with(['doctor', 'cashier', 'patient'])->get();
        return view('backend.patient-upload-image.index',compact('patientHistories'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the request
            $request->validate([
                'invoice_id' => 'required|integer|exists:patient_histories,invoice_id',
                'files.*' => 'required|image|mimes:jpeg,png,jpg|max:10240', // 10 MB limit
            ]);

            $invoiceId = $request->input('invoice_id');
            $files = $request->file('files');

            if (empty($files)) {
                throw new \Exception('No files were uploaded.');
            }

            // Find the PatientHistory model by invoice_id
            $patientHistory = PatientHistory::where('invoice_id', $invoiceId)->first();

            if (!$patientHistory) {
                throw new \Exception('Patient history not found.');
            }

            // Process file uploads
            foreach ($files as $file) {
                // Check if file is valid
                if (!$file->isValid()) {
                    throw new \Exception('File upload is not valid.');
                }

                // Check file size
                $fileSize = $file->getSize();
                $maxFileSize = 10240 * 1024; // 10 MB in bytes

                if ($fileSize > $maxFileSize) {
                    throw new \Exception('File size exceeds the 10 MB limit.');
                }

                // Generate a unique file name
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Define the file path to public/images
                $destinationPath = public_path('images'); // Public directory path

                // Move the file to public/images
                $file->move($destinationPath, $fileName);

                // Save file information to database
                uploadMultiImage::create([
                    'invoice_id' => $invoiceId,
                    'filename' => $fileName,
                    'path' => 'images/' . $fileName, // Relative path
                ]);
            }

            DB::commit();
            toastr()->success('Upload Images Successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            // Check for specific errors
            if (str_contains($e->getMessage(), 'File size exceeds the 10 MB limit.')) {
                toastr()->error('One or more files exceed the 10 MB size limit. Please upload smaller files.');
            } elseif (str_contains($e->getMessage(), 'No files were uploaded.')) {
                toastr()->error('No files were uploaded. Please select files to upload.');
            } else {
                toastr()->error('An error occurred during the upload process: ' . $e->getMessage());
            }
            return redirect()->back();
        }
    }

    public function getImages($invoiceId)
    {
        try {
            // Fetch images from the database
            $images = uploadMultiImage::where('invoice_id', $invoiceId)->get();
            
            // Map images to include URLs
            $imageData = $images->map(function ($image) {
                return [
                    'url' => asset('images/' . $image->filename) // Correct URL for images in public/images
                ];
            });
    
            // Log the image data
            Log::info('Fetched images for invoice ID ' . $invoiceId, ['imageData' => $imageData]);
    
            // Return the image data as JSON
            return response()->json(['images' => $imageData]);
    
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error fetching images for invoice ID ' . $invoiceId . ': ' . $e->getMessage());
    
            // Return a JSON response with error
            return response()->json(['error' => 'Failed to fetch images'], 500);
        }
    }
    
    public function deleteImage(Request $request)
    {
        $request->validate([
            'url' => 'required|string',
        ]);
    
        $url = $request->input('url');
        $filename = basename($url);
        
        // Define the path to the image file in the public directory
        $filePath = 'images/' . $filename;
        $fullPath = public_path($filePath);
    
        // Initialize response
        $response = ['success' => false, 'message' => ''];
    
        // Attempt to delete the file from the public directory
        if (file_exists($fullPath)) {
            if (unlink($fullPath)) {
                $response['success'] = true;
            } else {
                $response['message'] = 'Failed to delete file from directory.';
            }
        } else {
            $response['message'] = 'File not found in directory.';
        }
    
        // Attempt to delete the image record from the database
        $image = uploadMultiImage::where('filename', $filename)->first(); // Adjust if needed to match your column name
        if ($image) {
            try {
                $image->delete();
                $response['success'] = $response['success'] && true;
            } catch (\Exception $e) {
                $response['message'] .= ' Database deletion failed: ' . $e->getMessage();
                Log::error('Error deleting image from database: ' . $e->getMessage());
            }
        } else {
            $response['message'] .= ' Image record not found in database.';
        }
    
        return response()->json($response);
    }
    

}
