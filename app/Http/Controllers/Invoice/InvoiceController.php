<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // public function createInvoice(Request $request) {
    //     $data = $request->all();
    //     $invoiceId = rand(1000, 9999);
    //     return response()->json(['invoice_id' => $invoiceId]);
    // }
    // public function showInvoice($invoice_id) {
    //     $patientHistory = PatientHistory::whereRaw("CONCAT('INV', LPAD(id, 5, '0')) = ?", [$invoiceId])->firstOrFail();

    //     return view('backend.invoice.index', ['data' => $patientHistory]);
    // }
}
