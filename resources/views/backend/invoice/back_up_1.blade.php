<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Laor-Prornit-Clinic-Dental</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href=" {{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">
</head>
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
    /* border: 1px solid #ddd; */
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
    font-size: 36px;
    color: #0066cc;
}

.date-invoice-no {
    margin-top: 10px;
}

.date span, .invoice-no span {
    display: inline-block;
    width: 100px;
}

.header-center {
    text-align: center;
    width: 40%;
    font-size: 14px;
}

.clinic-name {
    font-size: 20px;
    font-weight: bold;
    color: #0066cc;
}

.header-right {
    text-align: right;
    width: 20%;
}

.header-right .logo {
    width: 100px;
}

/* Bill To Section as Table */
.bill-to {
    margin-top: 20px;
}

.bill-to-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    margin-bottom: 20px;
}

.bill-to-table th, .bill-to-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.bill-to-table th {
    background-color: #f4f4f4;
}

/* Service Table */
.services {
    margin-top: 20px;
}

.service-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.service-table th, .service-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.service-table th {
    background-color: #B2E0F6;
}

tfoot td {
    font-weight: bold;
}

/* Footer Section as Table */
.footer-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    margin-top: 20px;
}

.bill-to-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    margin-bottom: 20px;
}

.bill-to-table td {
    padding: 10px; /* Padding inside each cell */
}

.bill-to-table th {
    background-color: #f4f4f4; /* Background color for header cells */
}

.service-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    table-layout: auto; /* Allows columns to adjust based on content */
}

.service-table th, .service-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    word-wrap: break-word; /* Allows long text to wrap */
}

.bill-to-table th, .bill-to-table td,
.service-table th, .service-table td,
.footer-table th, .footer-table td {
    border: 1px solid #000000; /* Change border color to black */
    padding: 10px;
    text-align: center;
}

.bill-to-table th, .service-table th {
    background-color: #B2E0F6;
}
</style>
<body>
    <div class="invoice-container" id="invoice">
        <!-- Invoice Header Section -->
        <header>
            <div class="header-left">
                <h1>INVOICE</h1>
                <table class="bill-to-table" style="margin-top: 10px; width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr style="background-color: #B2E0F6;">
                            <td style="text-align: center; border: 1px solid #000000;"><strong>Date</strong></td>
                            <td style="text-align: center; border: 1px solid #000000;"><strong>Invoice NO</strong></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #000000;">{{ $patient_payment['date'] }}</td>
                            <td style="text-align: center; border: 1px solid #000000;">{{ $data->invoice_id ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="header-center">
                <p class="clinic-name" style="font-size: 25px;"><span style="font-family: Noto Sans Khmer,sans-serif;">ល្អប្រណីត</span> Dental Clinic</p>
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
                        <td style="text-align: left;"><strong>Bill To</strong></td>
                        <td style="text-align: right; padding-left: 50px;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; background-color: #B2E0F6;"><strong>Name</strong></td>
                        <td style="text-align: center; padding-left: 50px;"><strong>{{ $patient_info->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; background-color: #B2E0F6;"><strong>Sex</strong></td>
                        <td style="text-align: center; padding-left: 50px;"><strong>{{ $patient_info->sex }}</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; background-color: #B2E0F6;"><strong>Address</strong></td>
                        <td style="text-align: center; padding-left: 50px;"><strong>{{ $patient_info->address }}</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; background-color: #B2E0F6;"><strong>Phone</strong></td>
                        <td style="text-align: center; padding-left: 50px;"><strong>{{ $patient_info->telephone }}</strong></td>
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
                    @php $totalPrice = 0; @endphp <!-- Initialize total price -->
                    @forelse($patient_payment['services'] as $index => $service)
                        @php 
                            $totalPrice += ($service['service_price'] ?? 0) * ($service['service_unit'] ?? 1);
                            $discountDollar = $service['discount_dollar'] ?? 0;
                            if ($discountDollar == 0 && isset($service['discount_percent']) && isset($service['service_price'])) {
                                $discountDollar = (($service['service_price'] * $service['service_unit']) * $service['discount_percent']) / 100;
                            }
                        @endphp

                        <tr>
                            <td class="id text_font_khmer">{{ $index + 1 }}</td>
                            <td class="service_name text_font_khmer" style="font-family: Noto Sans Khmer,sans-serif;">{{ $service['service_name'] }}</td>
                            <td class="unit text_font_khmer">${{ number_format($service['service_price'] ?? 0, 2) }}</td>
                            <td class="price text_font_khmer">{{ $service['service_unit'] }}</td>
                            <td class="dis_percent text_font_khmer">
                                ${{ number_format(($service['service_price'] ?? 0) * ($service['service_unit'] ?? 1), 2) }}
                            </td>
                            <td class="dis_dollar text_font_khmer">{{ number_format($service['discount_percent'] ?? 0, 2) }}%</td>
                            <td class="dis_dollar text_font_khmer">
                                ${{ number_format($discountDollar, 2) }} <!-- Discount based on unit and percentage -->
                            </td> 
                            <td class="subtotal text_font_khmer">
                                ${{ number_format($service['subtotal'] ?? 0, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No services available</td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4" style="background-color: #B2E0F6;"><strong>Total</strong></td>
                        <td style="color:#ff9f00 ;">${{ number_format($totalPrice, 2) }}</td> <!-- Display total price -->
                        <td colspan="2" style="background-color: #B2E0F6;">After Discount</td>
                        <td style="color:#ff9f00 ;">${{ $patient_payment['grand_total'] }}</td>
                    </tr>
                </tfoot>


            </table>
        </section>
        <!-- Footer Section as Table -->
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
            <strong style="background-color: #90EE90;padding:10px 40px 10px 40px;float:right;">Signature</strong>
            <br><br>
            <br>
        </footer>
    </div>
    <div style="position: fixed; bottom:10px; right: 10px;">
        <button class="btn btn-warning" id="printButton" style="width: 90px;">
            <i class="fa fa-print"></i> Print
        </button>
        
        <a href="{{ route('patient_service_history') }}" class="btn btn-success" style="width: 90px; display: inline-block; text-align: center;">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    </body>
</html>
<style>
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

        /* Set page size for half of A4 (A5) */
        @page {
            size: A5 landscape; /* A5 is half of A4 */
        }

        /* Adjust the container to fit the content more snugly */
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .invoice-container {
            width: 100%; /* Reduce the width slightly to accommodate any overflow */
            max-width: 100%; /* Use full width available */
            padding: 10mm; /* Add some padding around the content */
            box-sizing: border-box; /* Include padding in the width calculation */
        }

        /* Optionally adjust text sizes */
        h1, td, th, p {
            font-size: 17px; /* Reduce font size to fit better */
        }
    }
</style>



<script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>