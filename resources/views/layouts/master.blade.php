<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="SoengSouy Admin Template">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="SoengSouy Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Dashboard </title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/dataTables.bootstrap4.min.css') }}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
	<!-- Chart CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/plugins/morris/morris.css') }}">
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	{{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

</head>

<body>
	<style>    
		.invalid-feedback{
			font-size: 14px;
		}
	</style>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		
		<!-- Header -->
		{{-- @yield('nav') --}}
		<div class="header">
			<!-- Logo -->
			<div class="header-left">
				<a href="{{ route('home') }}" class="logo"> <img src="{{ URL::to('images/hr.png') }}" width="40" height="40" alt=""> </a>
			</div>
			<!-- /Logo -->
			<a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon"><span></span><span></span><span></span></span>
			</a>
			<!-- Header Title -->
			<div class="page-title-box">
				<h3>{{ Auth::user()->name }}</h3>
			</div>
			<!-- /Header Title -->
			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
			<!-- Header Menu -->
			<ul class="nav user-menu">

				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
						<img src="{{ URL::to('assets/img/profiles/avatar-05.jpg') }}">
						<span class="status online"></span></span>
						<span>{{ Auth::user()->name }}</span>
					</a>
					<div class="dropdown-menu">
						<form action="{{ route('logout') }}" method="POST">
							<button class="dropdown-item" type="submit">Logout</button>
						</form>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->
		</div>
		<!-- /Header -->
		<!-- Sidebar -->
		<!-- {{-- @yield('menu') --}} -->
		<div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Main</span>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('home') }}" class="noti-dot">
                            <i class="la la-dashboard"></i>
                            <span> Dashboard</span> 
                        </a>
                    </li>
                
                    <li class="menu-title"> <span>Employees</span> </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-user"></i> <span>Organization </span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a href="{{ route('organisation/employees') }}">Employees</a></li>
                            <!-- <li><a href="">Leaves </a></li> -->
							<li><a href="{{ route('organisation/age-groups') }}">Age Groups</a></li>
                            <li><a href="{{ route('organisation/departments') }}">Departments</a></li>
							<li><a href="{{ route('organisation/designations') }}">Designations</a></li>
							<li><a href="{{ route('organisation/levels') }}">Levels</a></li>
                            <li><a href="{{ route('organisation/genders') }}">Genders</a></li>
                            <li><a href="{{ route('organisation/region') }}">Region</a></li>                         
							<li><a href="{{ route('organisation/holidays') }}">Holidays</a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>HR</span> </li>
					<li class="submenu"> <a href="#"><i class="la la-money"></i>
                        <span> Payroll </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('payrolls/payroll') }}"> Employee Salary </a></li>
                            <li><a href=""> Payslip </a></li>
                            <li><a href=""> Payroll Items </a></li>
                        </ul>
                    </li>
                    <!-- <li class="submenu">
                        <a href="#">
                            <i class="la la-files-o"></i>
                            <span> Sales </span> 
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a href="estimates.html">Estimates</a></li>
                            <li><a href="">Invoices</a></li>
                            <li><a href="">Payments</a></li>
                            <li><a href="">Expenses</a></li>
                            <li><a href="">Provident Fund</a></li>
                            <li><a href="">Taxes</a></li>
                        </ul>
                    </li> -->
                  
                    <!-- <li class="submenu"> <a href="#"><i class="la la-pie-chart"></i>
                        <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href=""> Expense Report </a></li>
                            <li><a href=""> Invoice Report </a></li>
                            <li><a href=""> Payments Report </a></li>
                            <li><a href=""> Employee Report </a></li>
                            <li><a href=""> Payslip Report </a></li>
                            <li><a href=""> Attendance Report </a></li>
                            <li><a href=""> Leave Report </a></li>
                            <li><a href=""> Daily Report </a></li>
                        </ul>
                    </li> -->
                   
                </ul>
            </div>
        </div>
    </div>

		<!-- /Sidebar -->
		<!-- Page Wrapper -->
		@yield('content')
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
	<!-- Bootstrap Core JS -->
	<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
	<!-- Chart JS -->
	<script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
	<script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/chart.js') }}"></script>
	<!-- Slimscroll JS -->
	<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
	<!-- Select2 JS -->
	<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
	<!-- Datetimepicker JS -->
	<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<!-- Datatable JS -->
	<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
	<!-- Multiselect JS -->
	<script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>		
	<!-- Custom JS -->
	<script src="{{ URL::to('assets/js/app.js') }}"></script>
	
	@yield('script')
</body>
</html>