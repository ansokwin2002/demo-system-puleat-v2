<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add_Service()
    {
        return view('backend.service.add_service');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_Service(Request $request) {
        $request = $request->validate([
            'name'  => 'required|string|max:255',
            'unit'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Service::create([
            'name'  => $request['name'],
            'unit'  => $request['unit'],
            'price' => $request['price'],
        ]);

        toastr()->success('Add Service Successfully!');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view_Service()
    {
        return view('backend.service.list_service');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function serviceUpdate(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'  => 'required|string|max:255',
            'unit'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
    
        $service = Service::find($id);
    
        if (!$service) {
            toastr()->error('Service not found!');
            return redirect()->back();
        }
    
        $service->name  = $validatedData['name'];
        $service->unit  = $validatedData['unit'];
        $service->price = $validatedData['price'];
        $service->save();
        
        toastr()->success('Service updated successfully!');
        return redirect()->back();
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function serviceDelete(string $id)
    {
        $service = Service::find($id);

        if (!$service) {
            toastr()->error('Service not found!');
            return redirect()->back();
        }

        $service->delete();

        toastr()->success('Service deleted successfully!');
        return redirect()->back();
    }

}
