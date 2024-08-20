@extends('backend.master')

@section('content')

<div class="main-wrapper main-wrapper-1">
    <!-- [navbar----------------------------] -->
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        @include('backend.body.navbar')
    </nav>
    <!-- [navbar----------------------------] -->

    <!-- [aside------------------------------] -->
    <div class="main-sidebar sidebar-style-2">
        @include('backend.body.aside')
    </div>
    <!-- [aside------------------------------] -->

    <!-- [main_content------------------------------] -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card_title">
                            <div class="row">
                                <h3>&nbsp;&nbsp;Patient's Bar Chart</h3>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <canvas id="myChart2" width="400" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <!-- [main_content------------------------------] -->

    <!-- [footer------------------------------] -->
    <footer class="main-footer">
        @include('backend.body.footer')
    </footer>
    <!-- [footer------------------------------] -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('myChart2').getContext('2d');

            // Define the data as a JavaScript object
            const monthlyPatientCounts = @json($monthlyPatientCounts);

            const labels = Object.keys(monthlyPatientCounts);
            const data = Object.values(monthlyPatientCounts);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Patients',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

</div>

@endsection
