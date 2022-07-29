@extends('layouts.master')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>



<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="cmn_card_view mb-4 cmn_ttl_sec">
                <div class="row">
                    <div class="col-md-6 lft">
                        <h3>Employee Details</h3>
                        <h6>Below are the employee payroll details </h6> 
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <div class="icon_with_cnts"> <i class="fas fa-user-friends"></i>
                            <aside>
                                <strong>{{ $full_details->name }}</strong> 
                                <span> Employee Name</span> 
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Page Body -->
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div style="border-radius:15px;" class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-building-o"></i></span>
                        <div class="text-dark pt-1">
                            <h4>{{$full_details->departments->name }}</h4> <span>Department</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div style="border-radius:15px;" class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"> <i class="fa fa-diamond"></i> </span>
                        <div class="text-dark pt-1">
                            <h4>{{$full_details->designations->name }}</h4> <span>Designation</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div style="border-radius:15px;" class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-level-up"></i></span>
                        <div class="text-dark pt-1">
                            <h4>{{ $full_details->levels->name }}</h4> <span>Level</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div style="border-radius:15px;" class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                        <div class="text-dark pt-1">
                            <h4>{{ $full_details->age_groups->name }}</h4> <span>Age Group</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cmn_card_view">
            <a href="/payroll" data-toggle="tooltip" data-placement="top" title="Back to Payroll"><i class="fa fa-arrow-left"></i> Back </a> 
            <h4>Payroll details of {{ $full_details->name }}</h4>
    

                <input type="hidden" id="basic" value="{{$employee_detials->basic}}">
                <input type="hidden" id="hra" value="{{$employee_detials->hra}}">
                <input type="hidden" id="allowance" value="{{$employee_detials->allowance}}">
                <input type="hidden" id="medical_allowance" value="{{$employee_detials->medical_allowance}}">
                <input type="hidden" id="pf" value="{{$employee_detials->pf}}">
            <div class="text-center">
                <canvas id="payrollChart" style="width:100%;max-width:400px"></canvas>
            </div>
        </div>

    </div>

    <script type="text/javascript">

setTimeout(function() {

    var basic = document.getElementById("basic").value;
    var hra = document.getElementById("hra").value;
    var allowance = document.getElementById("allowance").value;
    var medical_allowance = document.getElementById("medical_allowance").value;
    var pf = document.getElementById("pf").value;

    console.log(basic);

    var xValues = ['Basic','HRA','Allowances','Medical Allowances','Provident Fund'];
    var yValues = [ basic, hra, allowance, medical_allowance, pf];

    console.log(yValues);

    var barColors = [
        '#CD59E7',
        'Blue',
        'Yellow',
        '#8AF33C',
        'Red',
    ];

    new Chart("payrollChart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      }
    });
   
},1000);

</script>


</div>
@endsection