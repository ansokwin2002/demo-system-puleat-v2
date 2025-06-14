<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
    <a href="{{ route('dashboard') }}">Doctor System</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
    <a href="{{ route('dashboard') }}">DS</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Route::is('dashboard*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house-medical"></i> <span>Dashboard</span></a></li>   
        <li class="{{ Route::is('appointment_patient*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('appointment_patient') }}"><i class="fa-solid fa-user-plus"></i> <span>List Appointment Patient</span></a></li>   
        <li class="{{ Route::is('list_Patient*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('list_Patient') }}"><i class="fa-solid fa-user-plus"></i> <span>List Patient</span></a></li>   
        <li class="{{ Route::is('add_Patient*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('add_Patient') }}"><i class="fa-solid fa-user-plus"></i> <span>Add Patient</span></a></li>   
        <li class="{{ Route::is('view_Payment*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('view_Payment') }}"><i class="fa-solid fa-money-bill"></i> <span>Payment</span></a></li>   
        <li class="{{ Route::is('payment.ortho.index*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('payment.ortho.index') }}"><i class="fa-solid fa-money-bill"></i> <span>Payment Ortho</span></a></li>   
        <li class="{{ Route::is('notifications.index*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('notifications.index') }}"><i class="fa-solid fa-bell"></i> <span>Notification</span></a></li>   
        <li class="d-none {{ Route::is('appointments.form*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('appointments.form') }}"><i class="fa-solid fa-calendar-days"></i> <span>Appointment</span></a></li>   
        <li class="{{ Route::is('uploadMultiImage.index*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('uploadMultiImage.index') }}"><i class="fa-solid fa-upload"></i> <span>Upload Image</span></a></li>   
        
        <!-- <li class="dropdown {{ Route::is('list_Patient*','patient_service_history*','patient_ortho_service_history*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa-solid fa-user"></i>
                <span>Patient</span>
            </a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('list_Patient*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('list_Patient') }}">List Patient</a>
                </li>
                <li class="{{ Route::is('patient_service_history*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('patient_service_history') }}">History Patient</a>
                </li>
                <li class="{{ Route::is('patient_ortho_service_history*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('patient_ortho_service_history') }}">History Ortho Patient</a>
                </li>
            </ul>
        </li> -->
        <!-- [service-----------------------------------------] -->
            <li class="dropdown {{ Route::is('view_Service*', 'add_Service*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa fa-heart"></i>
                    <span>Service</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('add_Service*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('add_Service') }}">Add Service</a>
                    </li>
                    <li class="{{ Route::is('view_Service*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view_Service') }}">List Service</a>
                    </li>
                </ul>
            </li>
        <!-- [service-----------------------------------------] -->

        <!-- [doctor-------------------------------------------------] -->
            <li class="dropdown {{ Route::is('doctor.index*', 'doctor.list*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span>Doctor</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('doctor.index*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('doctor.index') }}">Add Doctor</a>
                    </li>
                    <li class="{{ Route::is('doctor.list*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('doctor.list') }}">List Doctor</a>
                    </li>
                </ul>
            </li>
        <!-- [doctor-------------------------------------------------] -->

        <!-- [cashier--------------------------------------------------] -->
            <li class="dropdown {{ Route::is('cashier.index*', 'cashier.list*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Cashier</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('cashier.index*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cashier.index') }}">Add Cashier</a>
                    </li>
                    <li class="{{ Route::is('cashier.list*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cashier.list') }}">List Cashier</a>
                    </li>
                </ul>
            </li>
        <!-- [cashier--------------------------------------------------] -->

        <!-- [report--------------------------------------------------] -->
            <li class="dropdown {{ Route::is('reports.index*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>Report</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('reports.index*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('reports.index') }}">Report Patient</a>
                    </li>
                </ul>
            </li>
        <!-- [report--------------------------------------------------] -->

        <!-- [calendar--------------------------------------------------] -->
            <!-- <li class="{{ Route::is('calendar.index*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('calendar.index') }}"><i class="fa-solid fa-calendar"></i> <span>Calendar</span></a></li>    -->
        <!-- [calendar--------------------------------------------------] -->
    </ul>
</aside>