<?php

namespace App\Http\Controllers\uploadMultiImage;

use App\Http\Controllers\Controller;
use App\Models\PatientHistory;
use App\Models\uploadMultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Import the Log facade
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
                'files.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $invoiceId = $request->input('invoice_id');
            $files = $request->file('files');
    
            // Log invoice_id and files
            Log::info('Invoice ID:', ['invoice_id' => $invoiceId]);
            Log::info('Received Files:', ['files' => $files]);
    
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
                if (!$file->isValid()) {
                    throw new \Exception('File upload is not valid.');
                }
    
                $filePath = $file->store('images', 'public'); // Store in 'public/images'
                
                // Log file path
                Log::info('File Path:', ['file_path' => $filePath]);
    
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
            return response()->json(['success' => 'Files uploaded successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('File upload failed:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'File upload failed. ' . $e->getMessage()], 500);
        }
    }

    public function getImages($invoiceId)
    {
        // Replace with your actual logic to get images by invoice ID
        $images = uploadMultiImage::where('invoice_id', $invoiceId)->get();

        // Format the data as needed for the front end
        $imageData = $images->map(function ($image) {
            return [
                'url' => Storage::url($image->path) // Adjust based on your storage setup
            ];
        });

        return response()->json(['images' => $imageData]);
    }

    
   

}
