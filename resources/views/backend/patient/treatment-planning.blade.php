@php
    $info = $updateCustomerInfo[0] ?? [];
@endphp
<!--[Service_table-------------------------]-->
    <div class="row">
        <div class="col-12">
            <div class="card p-4" style="border: 2px solid #6776EE;">
                <div class="form-group">
                    <button class="btn btn-primary" id="save_treatment_planning"><i class="fa fa-save"></i> Save Planning</button>
                        @php
                            use Illuminate\Support\Facades\Request;
                            use App\Models\Patient;
                            $patients = Patient::all();
                            $selectedPatientId = Request::segment(2); 
                        @endphp
                        <a href="{{ route('view_invoice', ['invoice_id' => $invoice_id, 'patient_id' => $selectedPatientId ?? '' ]) }}">
                            <button class="btn btn-warning" id="preview_invoice_treatment_planning">
                                <i class="fa fa-print"></i> Print Invoice
                            </button>
                        </a>
                    <button class="btn btn-success" id="completed_treatment_planning" style="float: right;"><i class="fa-solid fa-circle-check"></i> Completed</button>
                </div>
                <div class="card_title">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- First Date Form -->
                            <div class="form-group mb-2">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Date :</h6>
                                    <div class="flex-grow-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                            </div>

                                            <input type="text" class="form-control datepicker" id="date"  value="{{ $info['start_date'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Second Form (Doctor) -->

                            <div class="form-group mb-2">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Doctor :</h6>
                                    <div class="flex-grow-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa-solid fa-user-doctor"></i>
                                                </div>
                                            </div>
                                            @php 
                                                $doctors = App\Models\Doctor::all();
                                            @endphp
                                            <select class="form-control " name="doctor_id" id="doctor">
                                                <!-- <option value="" disabled>Select a Doctor</option> -->
                                                @foreach ($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}" {{ ($info['doctor'] ?? '') == $doctor->id ? 'selected' : '' }}>
                                                            {{ $doctor->name }}
                                                        </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-8">
                            <div class="container-fluid pl-0 pr-0">
                            <!-- [patient-----------------------------------] -->
                                <div class="row">
                                    <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                        <div class="title_customer">
                                            <h6 class="pt-2">Patient :</h6>
                                        </div>
                                        <div class="box_select_customer">
                                            <div class="card_customer">
                                                <div class="icon_customer">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <div class="select_customer">
                                                    @php
                                                        $patients = Patient::all();
                                                        $selectedPatientId = Request::segment(2); 
                                                    @endphp

                                                    <select id="patient-select" class="form-control select2" style="width: 100%;">
                                                        <option value="" disabled>Select a Patient</option>
                                                        @foreach ($patients as $patient)
                                                            <option value="{{ $patient->id }}" {{ $patient->id == $selectedPatientId ? 'selected' : '' }}>
                                                                {{ $patient->name }} ({{ $patient->telephone }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- [patient-----------------------------------] -->

                            <!-- [cashier-----------------------------------] -->

                                <div class="row mt-2">
                                    <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                        <div class="title_customer">
                                            <h6 class="pt-2">Cashier :</h6>
                                        </div>
                                        <div class="box_select_customer">
                                            <div class="card_customer">
                                                <div class="icon_customer">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <div class="select_customer">
                                                @php 
                                                    $cashiers = App\Models\Cashier::all();
                                                @endphp

                                                <select id="cashier-select" name="cashier_id"  class="form-control select2" style="width: 100%;">
                                                    <option value="" disabled>Select a Cashier</option>
                                                    @foreach ($cashiers as $cashier)
                                                        <option value="{{ $cashier->id }}" {{ ($info['cashier'] ?? '') == $cashier->id ? 'selected' : '' }}>
                                                            {{ $cashier->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- [cashier-----------------------------------] -->
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- First Date Form -->
                            <div class="form-group mb-2">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Next :</h6>
                                    <div class="flex-grow-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="next_appointment_date" id="next_appointment_date" class="form-control datepicker" value="{{ $info['next_appointment'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-8">
                            <div class="container-fluid pl-0 pr-0">
                            <!-- [patient-----------------------------------] -->
                                <div class="row">
                                    <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                        <div class="title_customer">
                                            <h6 class="pt-2">Type Service :</h6>
                                        </div>
                                        <div class="box_select_customer">
                                            <div class="card_customer">
                                                <div class="icon_customer">
                                                    <i class="fa fa-heart"></i>
                                                </div>
                                                <div class="select_customer">
                                                    <select name="type_service" id="type_service" class="form-control">
                                                        <option value="General" data-days="180" {{ ($info['type_service'] ?? '') == 'General' ? 'selected' : '' }}>General</option>
                                                        <option value="Implant" data-days="180" {{ ($info['type_service'] ?? '') == 'Implant' ? 'selected' : '' }}>Implant</option>
                                                        <option value="Ortho" data-days="30" {{ ($info['type_service'] ?? '') == 'Ortho' ? 'selected' : '' }}>Ortho</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- [patient-----------------------------------] -->

                            
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="" style="width: 100%;">
                    <div class="container-fluid pl-0 pr-0 mt-3">
                        <div class="row">
                            <div class="col-12 col-sm-5 col-md-8 col-lg-12">
                                <div class="card_service">
                                    <div class="icon_service">
                                        <button class="btn btn-primary" style="width: 100%;height:100%;">Services</button>
                                    </div>
                                    <div class="select_service">
                                        @php 
                                            $Services = App\Models\Service::all();
                                        @endphp

                                        <select id="serviceSelect" class="form-control select2" style="width: 100%;">
                                            <option>Select a Service</option>
                                            @foreach ($Services as $service)
                                                <option value="{{ $service->id }}" 
                                                data-id-service="{{$service->id}}"
                                                data-name-service="{{ $service->name }}"
                                                data-unit-service="{{ $service->unit }}"
                                                data-price-service="{{ $service->price }}"
                                                >
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- [table_service-----------------------] -->
                    <div class="horizontal-scroll-container" style="width: 100%; overflow-x: auto;" >
                        <div class="container-fluid pl-0 pr-0 mt-3 table_service">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-white">#</th>
                                                    <th style="width:500px;" class="text-white">Name</th>
                                                    <th style="width:120px;" class="text-white">Unit</th>
                                                    <th style="width:150px;" class="text-white">Price</th>
                                                    <th class="text-white">Choose Discount</th>
                                                    <th style="width:120px;" class="text-white">Discount (%)</th>
                                                    <th style="width:120px;" class="text-white">Discount ($)</th>
                                                    <th style="width:160px;" class="text-white">Amount</th>
                                                    <th style="width:100px;" class="text-white">Accepted</th>
                                                </tr>
                                            </thead>
                                            <tbody id="serviceTableBody">
                                                
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7"><strong><span class="float-right">Grand Total (USD)</span></strong></td>
                                                    <td><strong id="grand_total">$ 0.00</strong></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td colspan="7"><strong><span class="float-right">Amount paid <i style="cursor: pointer;" class="fa fa-edit" 
                                                    data-toggle="modal" 
                                                    data-target="#fire-modal-4"
                                                    ></i></span></strong></td>
                                                    <td><span id="amount_paid">$ 0.00</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7"><strong><span class="float-right" id="unpaid">Unpaid amount</span></strong></td>
                                                    <td><span id="amount_unpaid">$ 0.00</span></td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [patient-noted-----------------------------------] -->
                        <div class="form-group row d-none">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="flex-grow-1">
                                    <textarea name="patient_noted" id="patient_noted" class="summernote"></textarea>
                                </div>
                                <div class="invalid-feedback">
                                    Please fill Type Patient!
                                </div>
                            </div>
                        </div>
                    <!-- [patient-noted-----------------------------------] -->
                <!-- [table_service-----------------------] -->
            </div>
        </div>
    </div>
<!--[Service_table-------------------------]-->

@php
    $doctors = App\Models\Doctor::all();
    $patients = App\Models\Patient::all();
    $cashiers = App\Models\Cashier::all();
    $services = App\Models\Service::all();
@endphp

@foreach ($completedCustomerInfo as $index => $info)
<div class="row">
    <div class="col-12">
        <div class="card p-4" style="border: 2px solid #62EC7A; margin-bottom: 2rem;">
            <div class="form-group">
                <!-- <button class="btn btn-primary disabled" id="save_treatment_planning_{{ $index }}">
                    <i class="fa fa-save"></i> Save Planning
                </button> -->
                <button class="btn btn-warning d-none" id="preview_invoice_treatment_planning_{{ $index }}">
                    <i class="fa fa-print"></i> Print Invoice
                </button>
                <!-- <button class="btn btn-success disabled" style="float: right;" id="completed_treatment_planning_{{ $index }}">
                    <i class="fa-solid fa-circle-check"></i> Completed
                </button> -->
            </div>

            <div class="card_title">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <!-- Date -->
                        <div class="form-group mb-2">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Date :</h6>
                                <div class="flex-grow-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" disabled class="form-control datepicker" id="date_{{ $index }}" value="{{ $info['customer_info'][0]['start_date'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor -->
                        <div class="form-group mb-2">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Doctor :</h6>
                                <div class="flex-grow-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa-solid fa-user-doctor"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" disabled name="doctor_id_{{ $index }}" id="doctor_{{ $index }}">
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}" {{ ($info['customer_info'][0]['doctor'] ?? '') == $doctor->id ? 'selected' : '' }}>
                                                    {{ $doctor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-8">
                        <div class="container-fluid pl-0 pr-0">
                            <!-- Patient -->
                            <div class="row">
                                <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                    <div class="title_customer">
                                        <h6 class="pt-2">Patient :</h6>
                                    </div>
                                    <div class="box_select_customer">
                                        <div class="card_customer">
                                            <div class="icon_customer">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="select_customer">
                                               <select disabled id="patient-select_{{ $index }}" class="form-control select2" style="width: 100%;">
                                                    <option value="">Select a Patient</option>
                                                    @foreach ($patients as $patient)
                                                        <option value="{{ $patient->id }}" {{ ($info['customer_info'][0]['patient'] ?? '') == $patient->id ? 'selected' : '' }}>
                                                            {{ $patient->name }} ({{ $patient->telephone }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cashier -->
                            <div class="row mt-2">
                                <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                    <div class="title_customer">
                                        <h6 class="pt-2">Cashier :</h6>
                                    </div>
                                    <div class="box_select_customer">
                                        <div class="card_customer">
                                            <div class="icon_customer">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="select_customer">
                                                <select disabled id="cashier-select_{{ $index }}" name="cashier_id_{{ $index }}" class="form-control select2" style="width: 100%;">
                                                    <option value="" disabled>Select a Cashier</option>
                                                    @foreach ($cashiers as $cashier)
                                                        <option value="{{ $cashier->id }}" {{ ($info['customer_info'][0]['cashier'] ?? '') == $cashier->id ? 'selected' : '' }}>
                                                            {{ $cashier->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next appointment and Type Service -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group mb-2">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 mr-2" style="flex: 0 0 100px;">Next :</h6>
                                <div class="flex-grow-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" disabled name="next_appointment_date_{{ $index }}" id="next_appointment_date_{{ $index }}" class="form-control datepicker" value="{{ $info['customer_info'][0]['next_appointment'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-8">
                        <div class="container-fluid pl-0 pr-0">
                            <div class="row">
                                <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                    <div class="title_customer">
                                        <h6 class="pt-2">Type Service :</h6>
                                    </div>
                                    <div class="box_select_customer">
                                        <div class="card_customer">
                                            <div class="icon_customer">
                                                <i class="fa fa-heart"></i>
                                            </div>
                                            <div class="select_customer">
                                                <select disabled name="type_service_{{ $index }}" id="type_service_{{ $index }}" class="form-control">
                                                    <option value="General" {{ ($info['customer_info'][0]['type_service'] ?? '') == 'General' ? 'selected' : '' }}>General</option>
                                                    <option value="Implant" {{ ($info['customer_info'][0]['type_service'] ?? '') == 'Implant' ? 'selected' : '' }}>Implant</option>
                                                    <option value="Ortho" {{ ($info['customer_info'][0]['type_service'] ?? '') == 'Ortho' ? 'selected' : '' }}>Ortho</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>

                <!-- Services selection -->
                <div class="" style="width: 100%; margin-top: 1.5rem;">
                    <div class="container-fluid pl-0 pr-0">
                        <div class="row">
                            <div class="col-12 col-sm-5 col-md-8 col-lg-12 d-flex">
                                <div class="card_service">
                                    <div class="icon_service">
                                        <button class="btn btn-primary" style="width: 100%; height: 100%;">Services</button>
                                    </div>
                                    <div class="select_service">
                                        <select disabled id="serviceSelect_{{ $index }}" class="form-control select2" style="width: 100%;">
                                            <option>Select a Service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}" 
                                                    data-id-service="{{ $service->id }}"
                                                    data-name-service="{{ $service->name }}"
                                                    data-unit-service="{{ $service->unit }}"
                                                    data-price-service="{{ $service->price }}">
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services table -->
                <div class="horizontal-scroll-container" style="width: 100%; overflow-x: auto; margin-top: 1rem;">
                    <div class="container-fluid pl-0 pr-0 table_service">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">#</th>
                                                <th style="width:500px;" class="text-white">Name</th>
                                                <th style="width:120px;" class="text-white">Unit</th>
                                                <th style="width:150px;" class="text-white">Price</th>
                                                <th class="text-white">Choose Discount</th>
                                                <th style="width:120px;" class="text-white">Discount (%)</th>
                                                <th style="width:120px;" class="text-white">Discount ($)</th>
                                                <th style="width:160px;" class="text-white">Amount</th>
                                                <th style="width:100px;" class="text-white">Accepted</th>
                                            </tr>
                                        </thead>
                                        <tbody id="serviceTableBody_{{ $index }}">
                                            @php
                                                $serviceList = $info['services'] ?? [];
                                            @endphp
                                            @foreach ($serviceList as $sIndex => $service)
                                                @php
                                                    $isPercent = $service['discountType'] === '%';
                                                    $isDollar = $service['discountType'] === '$';
                                                    $discountValue = $service['discountValue'] ?? '';
                                                @endphp
                                                <tr style="background-color: #d4edda;">
                                                    <td>{{ $sIndex + 1 }}</td>
                                                    <td style="width:500px;">{{ $service['name'] }}</td>
                                                    <td style="width:120px;">
                                                        <input disabled type="text" class="form-control unit" value="{{ $service['unit'] }}">
                                                    </td>
                                                    <td style="width:150px;">
                                                        <input disabled type="text" class="form-control price" value="{{ $service['price'] }}">
                                                    </td>
                                                    <td class="d-flex">
                                                        <div class="form-check form-check-lg">
                                                            <input disabled class="form-check-input discount-type" type="radio" name="discountType{{ $index }}_{{ $sIndex }}" id="discountPercent{{ $index }}_{{ $sIndex }}" value="%" {{ $isPercent ? 'checked' : '' }}>
                                                            <label class="form-check-label mr-4" for="discountPercent{{ $index }}_{{ $sIndex }}">%</label>
                                                        </div>
                                                        <div class="form-check form-check-lg">
                                                            <input disabled class="form-check-input discount-type" type="radio" name="discountType{{ $index }}_{{ $sIndex }}" id="discountDollar{{ $index }}_{{ $sIndex }}" value="$" {{ $isDollar ? 'checked' : '' }}>
                                                            <label class="form-check-label mr-4" for="discountDollar{{ $index }}_{{ $sIndex }}">$</label>
                                                        </div>
                                                    </td>
                                                    <td style="width:120px;">
                                                        <input disabled type="text" class="form-control discount-percent" value="{{ $isPercent ? $discountValue : '' }}">
                                                    </td>
                                                    <td style="width:120px;">
                                                        <input disabled type="text" class="form-control discount-dollar" value="{{ $isDollar ? $discountValue : '' }}">
                                                    </td>
                                                    <td style="width:160px;">
                                                        <p class="subtotal">${{ number_format($service['subtotal'], 2) }}</p>
                                                    </td>
                                                    <td>
                                                        <input style="width:20px;height:20px;" type="checkbox" disabled {{ ($service['status'] ?? 'false') === 'true' ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tbody>
                                            <tr>
                                                <td colspan="7">
                                                    <strong><span class="float-right">Grand Total (USD)</span></strong>
                                                </td>
                                                <td>
                                                    <strong id="grand_total_{{ $index }}">$ {{ number_format($info['grand_total'], 2) }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient noted (hidden) -->
                <div class="form-group row d-none">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="flex-grow-1">
                            <textarea name="patient_noted_{{ $index }}" id="patient_noted_{{ $index }}" class="summernote"></textarea>
                        </div>
                        <div class="invalid-feedback">
                            Please fill Type Patient!
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endforeach

