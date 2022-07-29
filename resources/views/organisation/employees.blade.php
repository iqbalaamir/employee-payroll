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
                            <h3>Employee Management</h3>
                            <h6>Add your organization employees</h6> 
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="icon_with_cnts"> <i class="fas fa-user-friends"></i>
                                <aside>
                                    <strong>{{ $employees->count() }}</strong> 
                                    <span> Total Employees</span> 
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
                        Showing all the employees listed down
                    </div>
                    <div class="col-sm-3">
                        <aside style="margin-left:80px;"> 
                            <button class="btn btn-dark account-btn" data-toggle="modal" data-target="#add_employee"> Add Employee </button> 
                        </aside>
                    </div>                     
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-12 mt-3">
                        @if($employees->isEmpty())
                        <div class="alert alert-warning"> <strong> There are no employees added yet! </strong> </div>
                        @else
                            <table id="dataTable" class="table table-striped table-hover custom-table">
                                <thead>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Employee Name</th>
                                        <th scope="col">Email </th>
                                        <th scope="col">Created on </th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($employees as $key => $emp)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td> {{ $emp->name }} </td>
                                        <td> {{ $emp->email }} </td>
                                        <td> {{ $emp->created_at->translatedFormat('j F Y') }} </td>
                                        <td> 
                                            <a href="#" class="text-dark" role="button" onclick="edit_Modal(this)" data-name="{{$emp->name}}" data-email="{{$emp->email}}" data-target="#editModal" data-toggle="modal" data-id="{{$emp->id}}"  data-department_id="{{$emp->department_id}}" data-designation_id="{{$emp->designation_id}}" data-level_id="{{$emp->level_id}}" data-reporting_mgr_id="{{$emp->reporting_mgr_id}}" data-age_group_id="{{$emp->age_group_id}}" data-date_of_join="{{$emp->date_of_join}}" data-date_of_join="{{$emp->date_of_join}}" data-gender_id="{{$emp->gender_id}}" data-region_id="{{$emp->region_id}}"><i class="fas fa-edit"></i></a> &nbsp; &nbsp;
                                            <a href="/employees/delete/{{$emp->id}}" class="delete-confirm-emp text-danger" data-id="{{$emp->id}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
            <div id="add_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Please add the employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('organisation/employees/add') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="emp" name="name" placeholder="Enter Employee Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" id="email" name="email" placeholder="Enter Email ID">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Department </label>
                                            <select name="department_id" class="form-select form-control">
                                                <option value="">Select Department</option>
                                                @foreach($department as $dept)
                                                <option value="{{$dept->id}}">{{$dept->name}}</option>
                                                @endforeach
                                            </select>                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Designation </label>
                                            <select name="designation_id" class="form-select form-control">
                                                <option value="">Select Designation</option>
                                                @foreach($designation as $key => $desig)
                                                <option  value="{{$desig->id}}">{{$desig->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Level </label>
                                            <select name="level_id" class="form-select form-control">
                                                <option value="">Select Level</option>
                                                @foreach($level as $key => $lev)
                                                <option value="{{$lev->id}}">{{$lev->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Date of Joining </label>
                                            <input class="form-control" type="date" name="date_of_join" placeholder="Select Date fo Joining">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Reporting Manager  </label>
                                            <select name="reporting_mgr_id" class="form-select form-control">
                                                <option value="">Select Manager</option>
                                                @foreach($reporting_mgr as $key => $mgr)
                                                <option value="{{$mgr->id}}">{{$mgr->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Age Group </label>
                                            <select name="age_group_id" class="form-select form-control">
                                                <option value="">Select Age Group</option>
                                                @foreach($age_group as $key => $age)
                                                <option value="{{$age->id}}">{{$age->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Gender </label>
                                            <select name="gender_id" class="form-select form-control">
                                                <option value="">Select Gender</option>
                                                @foreach($gender as $key => $gen)
                                                <option value="{{$gen->id}}">{{$gen->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Region </label>
                                            <select name="region_id" class="form-select form-control">
                                                <option value="">Select Region</option>
                                                @foreach($region as $key => $reg)
                                                <option value="{{$reg->id}}">{{$reg->name}}</option>
                                                @endforeach
                                            </select>
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
                            <h5 class="modal-title">Please edit the employee below</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('organisation/employees/edit') }}" method="POST">
                                {{ method_field('POST') }}
                              @csrf
                              <input type="hidden" class="form-control" id="id" name="id">
                              <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="name" name="name" placeholder="Enter Employee Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="email" name="email" readonly placeholder="Enter Email ID">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Department </label>
                                            <select name="department_id" id="department_id" class="form-select form-control">
                                                <option value="">Select Department</option>
                                                @foreach($department as $dept)
                                                <option value="{{$dept->id}}">{{$dept->name}}</option>
                                                @endforeach
                                            </select>                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Designation </label>
                                            <select id="designation_id" name="designation_id" class="form-select form-control">
                                                <option value="">Select Designation</option>
                                                @foreach($designation as $key => $desig)
                                                <option value="{{$desig->id}}">{{$desig->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Level </label>
                                            <select id="level_id" name="level_id" class="form-select form-control">
                                                <option value="">Select Level</option>
                                                @foreach($level as $key => $lev)
                                                <option value="{{$lev->id}}">{{$lev->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Date of Joining </label>
                                            <input class="form-control" type="date" id="date_of_join" name="date_of_join" placeholder="Select Date fo Joining">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Reporting Manager  </label>
                                            <select id="reporting_mgr_id" name="reporting_mgr_id" class="form-select form-control">
                                                <option value="">Select Manager</option>
                                                @foreach($reporting_mgr as $key => $mgr)
                                                <option value="{{$mgr->id}}">{{$mgr->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Age Group </label>
                                            <select id="age_group_id" name="age_group_id" class="form-select form-control">
                                                <option value="">Select Age Group</option>
                                                @foreach($age_group as $key => $age)
                                                <option value="{{$age->id}}">{{$age->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Gender </label>
                                            <select id="gender_id" name="gender_id" class="form-select form-control">
                                                <option value="">Select Gender</option>
                                                @foreach($gender as $key => $gen)
                                                <option value="{{$gen->id}}">{{$gen->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"> Region </label>
                                            <select id="region_id" name="region_id" class="form-select form-control">
                                                <option value="">Select Region</option>
                                                @foreach($region as $key => $reg)
                                                <option value="{{$reg->id}}">{{$reg->name}}</option>
                                                @endforeach
                                            </select>
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

            var name = link.data('name')
            var id = link.data('id')
            var email = link.data('email')
            var department_id = link.data('department_id')
            var designation_id = link.data('designation_id')
            var level_id = link.data('level_id')
            var reporting_mgr_id = link.data('reporting_mgr_id')
            var age_group_id = link.data('age_group_id')
            var date_of_join = link.data('date_of_join')
            var gender_id = link.data('gender_id')
            var region_id = link.data('region_id')
        
            console.log(department_id);
            
            modal.find('#name').val(name);
            modal.find('#id').val(id);
            modal.find('#email').val(email);
            modal.find('#department_id').val(department_id);
            modal.find('#designation_id').val(designation_id);
            modal.find('#level_id').val(level_id);
            modal.find('#reporting_mgr_id').val(reporting_mgr_id);
            modal.find('#age_group_id').val(age_group_id);
            modal.find('#date_of_join').val(date_of_join);
            modal.find('#gender_id').val(gender_id);
            modal.find('#region_id').val(region_id);
     
        
        }
       

        //Delete the record popup are you sure
        $('.delete-confirm-emp').on('click', function (event) {
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