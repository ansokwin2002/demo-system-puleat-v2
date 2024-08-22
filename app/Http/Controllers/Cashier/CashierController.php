<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view('backend.cashier.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|string|max:15',
            'email' => 'required|email|unique:cashiers,email',
            'telephone' => 'nullable|string|max:20',
        ]);

        $cashier = Cashier::create([
            'name' => $request->input('name'),
            'sex' => $request->input('sex'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
        ]);

        toastr()->success('Add Cashier Successfully!');
        return redirect()->back();
    }

}
