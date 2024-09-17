<?php

namespace App\Http\Controllers\uploadMultiImage;

use App\Http\Controllers\Controller;
use App\Models\PatientHistory;
use App\Models\uploadMultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

                $filePath = $file->store('images', 'public'); // Store in 'public/images'

                if (!$filePath) {
                    throw new \Exception('Failed to store file.');
                }

                // Save file information to database
                uploadMultiImage::create([
                    'invoice_id' => $invoiceId,
                    'filename' => $file->getClientOriginalName(),
                    'path' => $filePath,
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
        $images = uploadMultiImage::where('invoice_id', $invoiceId)->get();

        $imageData = $images->map(function ($image) {
            return [
                'url' => asset('storage/' . $image->path) // Use asset to generate URLs
            ];
        });

        return response()->json(['images' => $imageData]);
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'url' => 'required|string',
        ]);

        $url = $request->input('url');
        $filename = basename($url);
        
        // Delete from storage
        $filePath = 'images/' . $filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        // Delete from database
        $image = uploadMultiImage::where('path', $filePath)->first();
        if ($image) {
            $image->delete();
        }

        return response()->json(['success' => true]);
    }
}
