<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Laor-Prornit-Clinic-Dental</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice-container {
            width: 60%;
            margin: 20px auto;
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
            }

            #invoice, #invoice * {
                visibility: visible; /* Show only the invoice */
            }

            #invoice {
                position: absolute; /* Position the invoice */
                left: 0;
                top: 0;
                width: 100%; /* Use full width */
            }

            /* Set page size for A5 in portrait orientation */
            @page {
                size: A5 portrait; /* A5 portrait orientation */
                margin: 10mm; /* Add margins */
            }

            body {
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .invoice-container {
                width: 100%; /* Full width for printing */
            }
        }

        .service-table, .bill-to-table, .footer-table {
            border: 1px solid #ddd; /* Border around the table */
        }

        .service-table th, .service-table td, 
        .bill-to-table th, .bill-to-table td, 
        .footer-table th, .footer-table td {
            border: 1px solid #ddd; /* Border for each cell */
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
                            <td style="text-align: center;">{{ $patient_payment['date'] }}</td>
                            <td style="text-align: center;">{{ $data->invoice_id ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="header-center">
                <p class="clinic-name" style="font-size: 20px;"> <span style="font-family: Noto Sans Khmer,sans-serif;">ល្អប្រណីត</span> Dental Clinic</p>
                <p>#59, st261, Teuklaok3, ToulKork, Phnom Penh,Tel : 010692869,078813564</p>
                <p>Telegram Phone: 078813564</p>
                <p>Facebook: <span style="font-family: Noto Sans Khmer,sans-serif;">ល្អប្រណីត</span> Dental Clinic</p>
                <p style="background-color: #90EE90;padding:2px;">Treatment By Dr. {{ $data->doctor->name ?? '' }}</p>
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
                        <td style="text-align: center;"><strong>{{ $patient_info->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="background-color: #B2E0F6;"><strong>Sex</strong></td>
                        <td style="text-align: center;"><strong>{{ $patient_info->sex }}</strong></td>
                    </tr>
                    <tr>
                        <td style="background-color: #B2E0F6;"><strong>Address</strong></td>
                        <td style="text-align: center;"><strong>{{ $patient_info->address }}</strong></td>
                    </tr>
                    <tr>
                        <td style="background-color: #B2E0F6;"><strong>Phone</strong></td>
                        <td style="text-align: center;"><strong>{{ $patient_info->telephone }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Services Table -->
        <section class="services">
            <table class="service-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th style="width: 30%;">Services</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th style="background-color: #90EE90">Amount</th>
                        <th>Discount</th>
                        <th style="background-color: #90EE90">D.Amount</th>
                        <th style="background-color: #90EE90">After D.</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalPrice = 0; @endphp
                    @forelse($patient_payment['services'] as $index => $service)
                        @php 
                            $totalPrice += ($service['service_price'] ?? 0) * ($service['service_unit'] ?? 1);
                            $discountDollar = $service['discount_dollar'] ?? 0;
                            if ($discountDollar == 0 && isset($service['discount_percent']) && isset($service['service_price'])) {
                                $discountDollar = (($service['service_price'] * $service['service_unit']) * $service['discount_percent']) / 100;
                            }
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="font-family: Noto Sans Khmer,sans-serif;">{{ $service['service_name'] }}</td>
                            <td>${{ number_format($service['service_price'] ?? 0, 2) }}</td>
                            <td>{{ $service['service_unit'] }}</td>
                            <td>${{ number_format(($service['service_price'] ?? 0) * ($service['service_unit'] ?? 1), 2) }}</td>
                            <td>{{ number_format($service['discount_percent'] ?? 0, 2) }}%</td>
                            <td>${{ number_format($discountDollar, 2) }}</td> 
                            <td>${{ number_format($service['subtotal'] ?? 0, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No services available</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="background-color: #B2E0F6;text-align: center;"><strong>Total</strong></td>
                        <td style="color:#ff9f00;">${{ number_format($totalPrice, 2) }}</td>
                        <td colspan="2" style="background-color: #B2E0F6;text-align: center;">After Discount</td>
                        <td style="color:#ff9f00;">${{ $patient_payment['grand_total'] }}</td>
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
                        <th style="text-align: right;">${{ $patient_payment['amount_paid'] }} &nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #B2E0F6;text-align: left;width: 295px;"><strong>Note</strong></td>
                        <td></td>
                        <td style="background-color: #B2E0F6;text-align: left;"><strong>Due ($) &nbsp;&nbsp;&nbsp;( <span style="font-family: Noto Sans Khmer,sans-serif;">នៅសល់ ថ្លៃសេវ៉ា</span> )</strong></td>
                        <th style="text-align: right;">${{ $patient_payment['amount_unpaid'] }} &nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                    
                </tbody>
            </table>
            <br>
            <strong style="background-color: #90EE90;padding:5px 10px 5px 10px;float:right;font-size:12px;">Signature</strong>
            <br><br>
            <br>
        </footer>
    </div>

    <button id="printButton" onclick="window.print();" style="margin: 20px;">Print Invoice</button>

    <script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
