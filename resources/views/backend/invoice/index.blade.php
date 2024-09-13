@extends ('backend.master')
@section('content')

<div class="main-wrapper main-wrapper-1">

    <!-- [main_content------------------------------]-->
    <div class="main_invoice">
       <div class="box_invoice" id="invoice">
            <div class="box_logo">
                <div class="box_1">
                    <p class="invoice_title">គ្លីនិក ល្អប្រណិត</p>
                    <center><img class="invoice_logo" src="{{ asset('backend/assets/img/invoice/logo.png') }}" alt=""></center>
                </div>
            </div>
            <div class="box_street">
                <p class="invoice_text">
                   <center><b>#59, st261 ,Teuklaok3,ToulKork,Phnom Penh , Tel : 078813564 , 010692869</b></center>
                </p>
            </div>
            <div class="box_3">
                <div class="box_left">
                    <p style="color: black;"><span class="doctor">Doctor :</span> {{ $data->doctor->name ?? 'Unknown' }}</p>
                    <p style="color: black;" class="date_box"><span class="date">Date :</span> {{ $patient_payment['date'] }}</p>
                </div>
                <div class="box_right">
                    <p style="color: black;"><span class="patient">Patient :</span> {{ $patient_payment['customer'] }}</p>
                    <!-- <p><span class="patient_id">Patient ID :</span> {{ $patient_payment['patientId'] }}</p> -->
                    <p style="color: black;" class="box_invoice_id"><span class="invoice_id">Invoice ID :</span> {{ $data->invoice_id ?? '' }}</p>
                </div>
                <div class="box_center">
                    <p style="color: black;" class="box_cashier_id"><span class="cashier_id">Cashier :</span> {{ $data->cashier->name ?? 'Unknown' }}</p>
                </div>
            </div>
            <div class="box_table">
            @if(isset($patient_payment))
                    <table class="table table-bordered invoice">
                        <thead>
                            <tr style="border-top: 3px solid black;border-bottom: 3px solid black;">
                                <th class="text_font_khmer text-center" style="width: 5%; color:black;">#</th>
                                <th class="text_font_khmer text-center" style="width: 40%; color:black;">សេវាកម្ម / Service</th>
                                <th class="text_font_khmer text-center" style="width: 5%; color:black;">ចំនួន / Unit</th>
                                <th class="text_font_khmer text-center" style="width: 15%; color:black;">តម្លៃ / Price</th>
                                <th class="text_font_khmer text-center" style="width: 5%; color:black;">បញ្ខុះតម្លៃ(%) / Discount</th>
                                <th class="text_font_khmer text-center" style="width: 5%; color:black;">បញ្ខុះតម្លៃ($) / Discount</th>
                                <th class="text_font_khmer text-center" style="width: 40%; color:black;">ទឹកប្រាក់ / Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patient_payment['services'] as $index => $service)
                            <tr>
                                <td>{{ $index + 1 }}</td> 
                                <td style="width: 100px;">{{ $service['service_name'] }}</td>
                                <td>{{ $service['service_unit'] }}</td>
                                <td>$ {{ $service['service_price'] }}</td>
                                <td>
                                    {{ $service['discount_percent'] ? $service['discount_percent'] . ' %' : '' }}
                                </td>
                                <td>
                                    {{ $service['discount_dollar'] ? '$ ' . $service['discount_dollar'] : '' }}
                                </td>
                                <td>$ {{ $service['subtotal'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No services available</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="6" style="color: black;"><strong><span class="float-right text_font_khmer">សរុបរួម / Grand Total (USD)</span></strong></td>
                                <td><strong id="grand_total">$ {{ $patient_payment['grand_total'] }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="color: black;"><strong><span class="float-right text_font_khmer">ប្រាក់បានបង់​ / Amount paid </span></strong></td>
                                <td><strong id="amount_paid">$ {{ $patient_payment['amount_paid'] }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="color: black;"><strong><span class="float-right text_font_khmer" id="unpaid">ប្រាក់នៅសល់ / Unpaid amount</span></strong></td>
                                <td><strong id="amount_unpaid">$ {{ $patient_payment['amount_unpaid'] }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>There was an error retrieving the patient payment data.</p>
                @endif

            </div>
            <div class="container">
                <div class="row">
                    <button class="btn btn-warning" id="printButton" style="width: 100%;"><i class="fa fa-print"></i> Print</button>
                </div>
                <div class="row mt-1">
                    <a href="{{ route('add_Patient') }}" style="width: 100%;">
                        <button class="btn btn-success" id="printButton" style="width: 100%;"><i class="fa fa-arrow-left"></i> Back Add Patient</button>
                    </a>
                </div>
            </div>
       </div>
    </div>
    <!-- [main_content------------------------------] -->
</div>

<style>
@media print {
    #printButton {
        display: none;
    }

    body * {
        visibility: hidden;
    }

    #invoice, #invoice * {
        visibility: visible;
    }

    #invoice {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
</style>

<script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>

@endsection
