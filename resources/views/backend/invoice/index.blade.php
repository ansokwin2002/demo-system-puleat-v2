@extends ('backend.master')
@section('content')

<div class="main-wrapper main-wrapper-1">

    <!-- [main_content------------------------------] -->
    <div class="main_invoice">
       <center>
            <section class="section" id="part_to_print">
                <h1>Invoice ID: {{ $data['invoice_id'] ?? 'N/A' }}</h1>
                
                @if(isset($data['patient_payment']))
                    <h1>Invoice for {{ $data['patient_payment']['customer'] }}</h1>
                    <p>Patient ID: {{ $data['patient_payment']['patientId'] }}</p>
                    <p>Date: {{ $data['patient_payment']['date'] }}</p>
                    <p>Doctor: {{ $data['patient_payment']['doctor'] }}</p>
                    <p>Grand Total: ${{ $data['patient_payment']['grand_total'] }}</p>
                    <p>Amount Paid: ${{ $data['patient_payment']['amount_paid'] }}</p>
                    <p>Amount Unpaid: ${{ $data['patient_payment']['amount_unpaid'] }}</p>

                    <h2>Services</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">No.</th>
                                <th class="text-white">Service Name</th>
                                <th class="text-white">Service Unit</th>
                                <th class="text-white">Service Price</th>
                                <th class="text-white">Discount Percent</th>
                                <th class="text-white">Discount Dollar</th>
                                <th class="text-white">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['patient_payment']['services'] as $index => $service)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Display row number starting from 1 -->
                                <td>{{ $service['service_name'] }}</td>
                                <td>{{ $service['service_unit'] }}</td>
                                <td>${{ $service['service_price'] }}</td>
                                <td>{{ $service['discount_percent'] }}%</td>
                                <td>${{ $service['discount_dollar'] }}</td>
                                <td>${{ $service['subtotal'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No services available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <p>There was an error retrieving the patient payment data.</p>
                @endif

                <button onclick="printSection('part_to_print')">Print Invoice</button>
            </section>
       </center>
    </div>
    <!-- [main_content------------------------------] -->
</div>

@endsection
