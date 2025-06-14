<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Laor-Prornit-Clinic-Dental</title>
    <link rel="icon" href="{{ asset('backend/assets/img/invoice/logo_icon.png') }}" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        .invoice-container {
            width: 60%;
            margin: 6px auto;
            background: white;
            padding: 20px;
        }

        /* Header Section */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .header-left {
            width: 30%;
        }

        .header-left h1 {
            font-size: 28px; /* Reduced size */
            color: #0066cc;
        }

        .header-center {
            text-align: center;
            width: 40%;
            font-size: 12px; /* Reduced size */
        }

        .header-right {
            text-align: right;
            width: 20%;
        }

        /* Bill To Section as Table */
        .bill-to-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Reduced size */
            margin-bottom: 20px;
        }

        /* Service Table */
        .service-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Reduced size */
        }

        /* Footer Section */
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Reduced size */
            margin-top: 20px;
        }

        @media print {
        /* Hide buttons during print */
        #printButton {
            display: none;
        }

        body * {
            visibility: hidden; /* Hide all elements by default */
            margin: 0; /* Ensure no margins */
            padding: 0; /* Ensure no padding */
        }

        body, html {
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            margin: 0; /* Remove margin */
            padding: 0; /* Remove padding */
            overflow: hidden; /* Avoid scrolling */
        }

        #invoice, #invoice * {
            visibility: visible; /* Show only the invoice */
            box-sizing: border-box; /* Include padding and borders in the element's total width and height */
        }

        #invoice {
            position: absolute; /* Position the invoice */
            left: 0;
            top: -40px;
            width: 100%; /* Use full width */
            height: auto; /* Adjust height automatically */
            margin: 0; /* No margin */
        }

        @page {
            size: A5 portrait; /* A5 portrait orientation */
            margin: 0mm; /* Remove margins */
        }

        .invoice-container {
            width: 100%; /* Full width for printing */
            min-height: 95vh; /* Min-height to cover most of the viewport height */
            margin: 0; /* Remove container margin */
            padding: 10mm; /* Add padding to match internal space if necessary */
            box-shadow: none; /* Remove shadows */
        }

        /* Ensure tables use all available width */
        .service-table, .bill-to-table, .footer-table {
            width: 100%; /* Full width */
        }
    }

    .service-table, .bill-to-table, .footer-table {
        border: 1px solid black;
    }

    .service-table th, .service-table td, 
    .bill-to-table th, .bill-to-table td, 
    .footer-table th, .footer-table td {
        border: 1px solid black;
        padding: 5px; /* Adjust padding as needed */
    }

    .service-table th {
        background-color: #f2f2f2; /* Optional: background for headers */
    }

    </style>
</head>
<body>
    <div class="invoice-container" id="invoice">
        <!-- Invoice Header Section -->
        <header>
            <div class="header-left">
                <h1>INVOICE</h1>
                <table class="bill-to-table">
                    <tbody>
                        <tr style="background-color: #B2E0F6;">
                            <td style="text-align: center;"><strong>Date</strong></td>
                            <td style="text-align: center;"><strong>Invoice NO</strong></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">{{ $patient_info['start_date'] ?? '' }}</td>
                            <td style="text-align: center;">{{ $invoice_id ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="header-center">
                <p class="clinic-name" style="font-size: 20px; color:#0066cc;"> <span style="font-family: Noto Sans Khmer,sans-serif;">ល្អប្រណីត</span> Dental Clinic</p>
                <p>#59, st261, Teuklaok3, ToulKork, Phnom Penh,Tel : 010692869,078813564</p>
                <p>Telegram Phone: 078813564</p>
                <p>Facebook: <span style="font-family: Noto Sans Khmer,sans-serif;">ល្អប្រណីត</span> Dental Clinic</p>
                <p style="background-color: #90EE90;padding:2px;">Treatment By Dr. {{ $doctor['name'] ?? '' }}</p>
            </div>
            <div class="header-right">
                <img class="invoice_logo" width="120px" src="{{ asset('backend/assets/img/invoice/logo.png') }}" alt="">
            </div>
        </header>

        <!-- Bill To Section as Table -->
        <section class="bill-to">
            <table class="bill-to-table">
                <tbody>
                    <tr style="background-color: #B2E0F6;">
                        <td><strong>Bill To</strong></td>
                        <td></td>
                    </tr>
                   <tr>
                        <td style="background-color: #B2E0F6;"><strong>Name</strong></td>
                        <td style="text-align: center;"><strong>{{ $patient['name'] ?? '' }}</strong></td>
                    </tr>
                    <tr>
                        <td style="background-color: #B2E0F6;"><strong>Sex</strong></td>
                        <td style="text-align: center;"><strong>{{ $patient['sex'] ?? '' }}</strong></td>
                    </tr>
                    <tr>
                        <td style="background-color: #B2E0F6;"><strong>Address</strong></td>
                        <td style="text-align: center;"><strong>{{ $patient['address'] ?? '' }}</strong></td>
                    </tr>
                    <tr>
                        <td style="background-color: #B2E0F6;"><strong>Phone</strong></td>
                        <td style="text-align: center;"><strong>{{ $patient['telephone'] ?? '' }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Services Table -->
        <section class="services">
            <table class="service-table">
                <thead>
                    <tr>
                        <th style="text-align: center;background-color: #B2E0F6;">NO</th>
                        <th style="width: 30%;background-color: #B2E0F6;">Services</th>
                        <th style="text-align: center;background-color: #B2E0F6;">Price</th>
                        <th style="text-align: center;background-color: #B2E0F6;">Quantity</th>
                        <th style="background-color: #90EE90;text-align: center;">Amount</th>
                        <th style="text-align: center;background-color: #B2E0F6;">Discount</th>
                        <th style="background-color: #90EE90;text-align: center;">D.Amount</th>
                        <th style="background-color: #90EE90;text-align: center;">After D.</th>
                    </tr>
                </thead>
               <tbody>
                    @forelse ($services as $index => $service)
                        @php
                            $price = floatval($service['price'] ?? 0);
                            $quantity = intval($service['quantity'] ?? 1);
                            $rawSubtotal = $price * $quantity;

                            $discountType = $service['discountType'] ?? '';
                            $discountValue = floatval($service['discountValue'] ?? 0);

                            $discount = $discountType === '$'
                                ? $discountValue
                                : ($rawSubtotal * $discountValue / 100);

                            $finalTotal = $rawSubtotal - $discount;
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td style="font-family: Noto Sans Khmer, sans-serif;">{{ $service['name'] ?? '' }}</td>
                            <td style="text-align: center;">${{ number_format($price, 2) }}</td>
                            <td style="text-align: center;">{{ $quantity }}</td>
                            <td style="text-align: center;">${{ number_format($rawSubtotal, 2) }}</td>
                            <td style="text-align: center;">
                                {{ $discountType }}{{ $discountType === '%' ? number_format($discountValue, 2) : number_format($discountValue, 2) }}
                            </td>
                            <td style="text-align: center;">
                                ${{ number_format($discount, 2) }}
                            </td>
                            <td style="text-align: center;">
                                ${{ number_format($finalTotal, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No services available</td>
                        </tr>
                    @endforelse
                </tbody>


                @php
                    $total = 0;
                    $totalDiscount = 0;

                    foreach ($services as $service) {
                        $subtotal = floatval($service['subtotal'] ?? 0);
                        $discountValue = floatval($service['discountValue'] ?? 0);
                        $discount = 0;

                        if (($service['discountType'] ?? '') === '$') {
                            $discount = $discountValue;
                        } elseif (($service['discountType'] ?? '') === '%') {
                            $discount = $subtotal * $discountValue / 100;
                        }

                        $total += $subtotal;
                        $totalDiscount += $discount;
                    }

                    $afterDiscount = $total - $totalDiscount;
                @endphp

                <tfoot>
                    <tr>
                        <td colspan="4" style="background-color: #B2E0F6;text-align: center;"><strong>Total</strong></td>
                        <td style="color:#ff9f00; text-align: center;">${{ number_format($total, 2) }}</td>
                        <td colspan="2" style="background-color: #B2E0F6;text-align: center;"><strong>After Discount</strong></td>
                        <td style="color:#ff9f00; text-align: center;">${{ number_format($afterDiscount, 2) }}</td>
                    </tr>
                </tfoot>

            </table>
        </section>

        <!-- Footer Section -->
        <footer>
            <table class="footer-table">
                <thead>
                    <tr>
                        <th style="background-color: #B2E0F6;text-align: left;width: 295px;">Received by</th>
                        <th></th>
                        <th style="background-color: #B2E0F6;text-align: left;width: 372px;">Paid ($) &nbsp;&nbsp;&nbsp;( <span style="font-family: Noto Sans Khmer,sans-serif;">បាន ថ្លៃបង់សេវ៉ា</span> )</th>
                        <th style="text-align: right;">${{ $amount_paid }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #B2E0F6;text-align: left;width: 295px;"><strong>Note</strong></td>
                        <td></td>
                        <td style="background-color: #B2E0F6;text-align: left;"><strong>Due ($) &nbsp;&nbsp;&nbsp;( <span style="font-family: Noto Sans Khmer,sans-serif;">នៅសល់ ថ្លៃសេវ៉ា</span> )</strong></td>
                        <th style="text-align: right;">${{ $amount_unpaid }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                    
                </tbody>
            </table>
            <br>
            <strong style="background-color: #90EE90;padding:5px 10px 5px 10px;float:right;font-size:12px;">Signature</strong>
            <br><br>
            <br>
        </footer>
    </div>

    <div class="container pl-0 pr-0">
        <button class="btn btn-warning mt-2 mb-1" id="printButton" onclick="window.print();" style="width:100%;"><i class="fa fa-print"></i> Print Invoice</button>
       <a id="backButton" href="#" data-route="{{ url('/view-patient-detail') }}" style="width: 100%;">
            <button class="btn btn-success" id="printButton" style="width: 100%;">
                <i class="fa fa-arrow-left"></i> Back
            </button>
        </a>
    </div>

    <script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
<script>
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const patientId = urlParams.get('patient_id');
        const baseRoute = $('#backButton').data('route');
        if (patientId && baseRoute) {
            $('#backButton').attr('href', `${baseRoute}/${patientId}`);
        }
    });
</script>