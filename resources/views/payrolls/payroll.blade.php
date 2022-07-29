@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- Page Header -->
            <div class="page-header">
                <div class="cmn_card_view mb-4 cmn_ttl_sec">
                    <div class="row">
                        <div class="col-md-6 lft">
                            <h3>Employee Payroll Management</h3>
                            <h6>Add your employees payroll below</h6> 
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="icon_with_cnts"> <i class="fas fa-user-friends"></i>
                                <aside>
                                    <strong>{{ $payroll->count() }}</strong> 
                                    <span> Total Payrolls</span> 
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Page Body -->
            <div class="cmn_card_view">
                <div class="row">
                    <div class="col-sm-9">
                        Showing all the payrolls listed down
                    </div>
                    <div class="col-sm-3">
                        <aside style="margin-left:80px;"> 
                            <button class="btn btn-dark account-btn" data-toggle="modal" data-target="#add_payroll"> Add Payroll </button> 
                        </aside>
                    </div>                     
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-12 mt-3">
                        @if(empty($payroll))
                        <div class="alert alert-warning"> <strong> There are no payrolls added yet! </strong> </div>
                        @else
                            <table id="dataTable" class="table table-striped table-hover custom-table">
                                <thead>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Employee Name</th>
                                        <th scope="col">Created on </th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($payroll as $key => $pay)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td> {{ $pay->employee->name }} </td>
                                        <td> {{ $pay->created_at->translatedFormat('j F Y') }} </td>
                                        <td> 
                                            <a href="#" class="text-dark" role="button" onclick="edit_Modal(this)" data-employee_name="{{ $pay->employee->name }}" data-employee_id="{{$pay->employee_id}}" data-basic="{{$pay->basic}}" data-hra="{{$pay->hra}}" data-allowance="{{$pay->allowance}}" data-medical_allowance="{{$pay->medical_allowance}}" data-pf="{{$pay->pf}}" data-target="#editModal" data-toggle="modal" data-id="{{$pay->id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> &nbsp; &nbsp;
                                            <a href="/payroll/delete/{{$pay->id}}" class="delete-confirm-pay text-danger" data-id="{{$pay->id}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a> &nbsp; &nbsp;
                                            <a href="/payroll/view/{{$pay->id}}" class="text-info" data-id="{{$pay->id}}" data-toggle="tooltip" data-placement="top" title="View"><i class="fas fa-eye"></i></a> 
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Page Body -->
            
             <!-- Add Employee Modal -->
            <div id="add_payroll" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Please add the payroll</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('payrolls/payroll/add') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee Name <span class="text-danger">*</span></label>                    
                                            <select name="employee_id" class="form-select form-control">
                                                <option value="">Select Employee</option>
                                                @foreach($employees as $key => $emp)
                                                <option value="{{$emp->id}}">{{$emp->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Basic Pay <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="basic" name="basic" placeholder="Enter Basic Pay in ₹">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">HRA <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="hra" name="hra" placeholder="Enter HRA in ₹">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Other Allowance </label>
                                            <input class="form-control" type="text" id="allowance" name="allowance" placeholder="Enter Allowance in ₹">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Medical Allowance </label>
                                            <input class="form-control" type="text" id="medical_allowance" name="medical_allowance" placeholder="Enter Medical Allowance in ₹">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Provident Fund </label>
                                            <input class="form-control" type="text" id="pf" name="pf" placeholder="Enter Provident Fund in ₹">
                                        </div>
                                    </div>

                                </div>                          
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Employee Modal -->

             <!-- Edit Employee Modal -->
            <div id="editModal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Please edit the employee payroll</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('payrolls/payroll/edit') }}" method="POST">
                                {{ method_field('POST') }}
                              @csrf
                              <input type="hidden" class="form-control" id="id" name="id">
                                <div class="row">
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee Name <span class="text-danger">*</span></label>                    
                                            <input type="hidden" value="employee_name" id="employee_id" name="employee_id" class="form-select form-control" readonly/>   
                                            <input type="text" id="employee_name" name="employee_name" class="form-select form-control" readonly>                                           
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Basic Pay <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="basic" name="basic" placeholder="Enter Basic Pay in ₹">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">HRA <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="hra" name="hra" placeholder="Enter HRA in ₹">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Other Allowance </label>
                                            <input class="form-control" type="text" id="allowance" name="allowance" placeholder="Enter Allowance in ₹">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Medical Allowance </label>
                                            <input class="form-control" type="text" id="medical_allowance" name="medical_allowance" placeholder="Enter Medical Allowance in ₹">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Provident Fund </label>
                                            <input class="form-control" type="text" id="pf" name="pf" placeholder="Enter Provident Fund in ₹">
                                        </div>
                                    </div>
                                </div>                          
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update Record</button>
                                </div>
                            </form>
                          
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Employee Modal -->
                              

        </div> 
    </div>
    <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
    
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            //Table search and paginate filter
            var table = $('#dataTable').DataTable();  
        });

        //fetching pre-data from db for edit 
        function edit_Modal(el) {
            var link = $(el) 
            var modal = $("#editModal") //your modal id

            var id = link.data('id')
            var employee_id = link.data('employee_id')
            var basic = link.data('basic')
            var hra = link.data('hra')
            var allowance = link.data('allowance')
            var medical_allowance = link.data('medical_allowance')
            var pf = link.data('pf')
            var employee_name = link.data('employee_name')

            modal.find('#id').val(id);
            modal.find('#employee_id').val(employee_id);
            modal.find('#employee_name').val(employee_name);
            modal.find('#basic').val(basic);
            modal.find('#hra').val(hra);
            modal.find('#allowance').val(allowance);
            modal.find('#medical_allowance').val(medical_allowance);
            modal.find('#pf').val(pf);
        }

        //Delete the record popup are you sure
        $('.delete-confirm-pay').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });


    </script>
@endsection