@extends('backend.master')

@section('content')
<div class="main-wrapper main-wrapper-1">
    <!-- [main_content] -->
    <div class="main_invoice">
        <div class="box_invoice" id="invoice">
            <div class="box_logo">
                <div class="box_1">
                    <h1 class="invoice_title pb-3">គ្លីនិក ល្អប្រណីត</h1>
                    <center><img class="invoice_logo" src="{{ asset('backend/assets/img/invoice/logo.png') }}" alt=""></center>
                </div>
            </div>
            <div class="box_street">
                <p class="invoice_text">
                    <center><b style="color: black;">#59, st261, Teuklaok3, ToulKork, Phnom Penh, Tel : 078813564, 010692869</b></center>
                </p>
            </div>
            <div class="box_3">
                <div class="box_left">
                    <p style="color: black;"><span class="doctor text_font_khmer">វេជ្ជបណ្ឌិត / Doctor :</span> {{ $data->doctor->name ?? 'Unknown' }}</p>
                    <p style="color: black;" class="date_box"><span class="date text_font_khmer">កាលបរិច្ឆេទ / Date :</span> {{ $patient_payment['date'] }}</p>
                </div>
                <div class="box_right">
                    <p style="color: black;"><span class="patient text_font_khmer">អ្នកជំងឺ / Patient :</span> {{ $patient_payment['customer'] }}</p>
                    <p style="color: black;" class="box_cashier_id"><span class="cashier_id text_font_khmer">អ្នកគិតលុយ / Cashier :</span> {{ $data->cashier->name ?? 'Unknown' }}</p>
                </div>
                <div class="box_center">
                    <p style="color: black;" class="box_invoice_id"><span class="invoice_id text_font_khmer">លេខសម្គាល់វិក្កយបត្រ / Invoice ID :</span> {{ $data->invoice_id ?? '' }}</p>
                </div>
            </div>
            <div class="box_table">
            <table class="table table-bordered invoice_table">
                <thead>
                    <tr>
                        <th style="color: black;" class="text_font_khmer">#</th>
                        <th style="color: black;" class="text_font_khmer">សេវាកម្ម / Service</th>
                        <th style="color: black;" class="text_font_khmer">ចំនួន / Unit</th>
                        <th style="color: black;" class="text_font_khmer">តម្លៃ / Price</th>
                        <th style="color: black;" class="text_font_khmer">បញ្ខុះតម្លៃ(%) / Disc.</th>
                        <th style="color: black;" class="text_font_khmer">បញ្ខុះតម្លៃ($) / Disc.</th>
                        <th style="color: black;" class="text_font_khmer">ទឹកប្រាក់ / Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patient_payment['services'] as $index => $service)
                    <tr>
                        <td class="id text_font_khmer">{{ $index + 1 }}</td>
                        <td class="service_name text_font_khmer">{{ $service['service_name'] }}</td>
                        <td class="unit text_font_khmer">{{ $service['service_unit'] }}</td>
                        <td class="price text_font_khmer">${{ number_format($service['service_price'] ?? 0, 2) }}</td>
                        <td class="dis_percent text_font_khmer">{{ number_format($service['discount_percent'] ?? 0, 2) }}%</td>
                        <td class="dis_dollar text_font_khmer">${{ number_format($service['discount_dollar'] ?? 0, 2) }}</td>
                        <td class="subtotal text_font_khmer">${{ $service['subtotal'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No services available</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="color: black;"><strong><span class="float-right text_font_khmer">សរុបរួម / Total (USD)</span></strong></td>
                        <td><strong id="grand_total" class="text_font_khmer">${{ $patient_payment['grand_total'] }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="color: black;"><strong><span class="float-right text_font_khmer">ប្រាក់បានបង់​ / Amount paid </span></strong></td>
                        <td><strong id="amount_paid" class="text_font_khmer">${{ $patient_payment['amount_paid'] }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="color: black;"><strong><span class="float-right text_font_khmer" id="unpaid">ប្រាក់នៅសល់ / Unpaid amount</span></strong></td>
                        <td><strong id="amount_unpaid" class="text_font_khmer">${{ $patient_payment['amount_unpaid'] }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            </div>
            <div class="container">
                <div class="row">
                    <button class="btn btn-warning" id="printButton" style="width: 100%;"><i class="fa fa-print"></i> Print</button>
                </div>
                <div class="row mt-1">
                    <a href="{{ route('patient_service_history') }}" style="width: 100%;">
                        <button class="btn btn-success" id="printButton" style="width: 100%;"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [main_content] -->
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
            position:absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }

    /* Styling for tooltips */
    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 200px; /* Width of the tooltip */
        background-color: black;
        color: white;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -100px;
        opacity: 0;
        transition: opacity 0.5s;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
    .invoice_table .id {
        width: 10px !important;
    }
    .invoice_table .service_name {
        width: 6500px !important; /* adjust based on your layout needs */
        white-space: normal; /* allows text to wrap */
        word-wrap: break-word; /* ensures long words do not overflow */
    }
    .invoice_table tbody .unit {
        width: 20px !important;
        text-align: center;
    }
    .invoice_table tbody .price {
        width: 500px !important;
    }
    .invoice_table tbody .dis_percent {
        width: 20px !important;
    }
    .invoice_table tbody .dis_dollar {
        width: 20px !important;
    }
    .invoice_table tbody .subtotal {
        width: 1500px !important;
    }
</style>

<script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>

@endsection
