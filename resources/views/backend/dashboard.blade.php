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
            <!-- [Bar Chart Patient-------------------------] -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card_title">
                                <div class="row">
                                    <h3>&nbsp;&nbsp;Patient's Bar Chart ({{ $year }})</h3>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <canvas id="patient_bar_chart" width="400" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- [Bar Chart Patient-------------------------] -->

            <!-- [Type Service-------------------------] -->
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card_title">
                                <div class="row">
                                    <h3>&nbsp;&nbsp;Service's Bar Chart ({{ $year }})</h3>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <canvas id="service_bar_chart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- [Type Service-------------------------] -->

            <!-- [Doctor-------------------------] -->
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card_title">
                                <div class="row">
                                    <h3>&nbsp;&nbsp;Doctor's Bar Chart ({{ $year }})</h3>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <canvas id="doctor_earnings_bar_chart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- [Doctor-------------------------] -->


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
        // [Patient-----------------------------------------]
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('patient_bar_chart').getContext('2d');

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
        // [Patient-----------------------------------------]

        // [Service-----------------------------------------]
            document.addEventListener('DOMContentLoaded', function () {
                const serviceCtx = document.getElementById('service_bar_chart').getContext('2d');

                // Ordered array of month names from January to December
                const months = Object.values(@json($months)); // Original months array

                // Custom order to ensure months go from January to December
                const orderedMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                // Sort the months array based on the custom order
                const sortedMonths = orderedMonths.filter(month => months.includes(month));

                // Data arrays passed from the server
                const generalData = @json($generalData); // Should have month names as keys
                const implantData = @json($implantData); // Should have month names as keys
                const orthoData = @json($orthoData); // Should have month names as keys

                // Calculate the combined data for each month
                const combinedData = sortedMonths.map(month => {
                    return (generalData[month] || 0) + (implantData[month] || 0) + (orthoData[month] || 0);
                });

                // Map the data for each service to the corresponding month name
                const datasets = [
                    {
                        label: 'General Service',
                        data: sortedMonths.map(month => generalData[month] || 0), // Ensure data is matched to the correct month
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Implant Service',
                        data: sortedMonths.map(month => implantData[month] || 0),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Ortho Service',
                        data: sortedMonths.map(month => orthoData[month] || 0),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Combined Service',
                        data: combinedData, // Data for combined services
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ];

                // Initialize the chart
                new Chart(serviceCtx, {
                    type: 'bar',
                    data: {
                        labels: sortedMonths, // Sorted month names as labels
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                       scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString(); 
                                    }
                                }
                            }
                        }
                    }
                });
            });
        // [Service-----------------------------------------]

        // [Doctor---------------------------------------------]
            document.addEventListener('DOMContentLoaded', function () {
                const doctorCtx = document.getElementById('doctor_earnings_bar_chart').getContext('2d');

                // Ordered array of month names from January to December
                const months = Object.values(@json($months)); // Original months array

                // Custom order to ensure months go from January to December
                const orderedMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                // Sort the months array based on the custom order
                const sortedMonths = orderedMonths.filter(month => months.includes(month));

                // Data arrays passed from the server
                const doctorData = @json($doctorData); // Dynamic doctor data

                console.log('Doctor Data:', doctorData); // Debugging line to check the data

                // Prepare datasets for each doctor
                const datasets = [];
                let combinedData = {};

                Object.keys(doctorData).forEach(doctorName => {
                    if (doctorName === 'Combined') {
                        // Skip "Combined" in the loop, we'll add it last
                        return;
                    }

                    // Prepare dataset for each doctor
                    datasets.push({
                        label: doctorName,
                        data: sortedMonths.map(month => doctorData[doctorName][month] || 0),
                        backgroundColor: getRandomColor(), // Generate random colors for each doctor
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    });

                    // Calculate the combined total for each month
                    sortedMonths.forEach(month => {
                        combinedData[month] = (combinedData[month] || 0) + (doctorData[doctorName][month] || 0);
                    });
                });

                // Add the combined dataset with a specific color
                datasets.push({
                    label: 'Combined',
                    data: sortedMonths.map(month => combinedData[month] || 0),
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Customize colors as needed
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                });

                // Initialize the chart
                new Chart(doctorCtx, {
                    type: 'bar',
                    data: {
                        labels: sortedMonths, // Sorted month names as labels
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString(); 
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // Function to generate random colors
            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

        // [Doctor---------------------------------------------]

            
    </script>

</div>

@endsection
