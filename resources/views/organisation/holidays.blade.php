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
                            <h3>Holidays Management</h3>
                            <h6>Add the holidays</h6> 
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="icon_with_cnts"> <i class="fas fa-user-friends"></i>
                                <aside>
                                    <strong>{{ $holidays->count() }}</strong> 
                                    <span> Total Holidays</span> 
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
                        Showing all the holidays listed down
                    </div>
                    <div class="col-sm-3">
                        <aside style="margin-left:80px;"> 
                            <button class="btn btn-dark account-btn" data-toggle="modal" data-target="#add_holiday"> Add Holiday </button> 
                        </aside>
                    </div>                     
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-12 mt-3">
                        @if($holidays->isEmpty())
                        <div class="alert alert-warning"> <strong> There are no holidays added yet! </strong> </div>
                        @else
                            <table id="dataTable" class="table table-striped table-hover custom-table">
                                <thead>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Holiday</th>
                                        <th scope="col">Date </th>
                                        <th scope="col">Day </th>                           
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($holidays as $key => $holi)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td> {{ $holi->name }} </td>
                                        <td> {{ Carbon\Carbon::parse($holi->holiday_date)->format('j F Y') }} </td>
                                        <td> {{ Carbon\Carbon::parse($holi->holiday_date)->format('l') }} </td>                          
                                        <td> 
                                            <a href="#" class="text-dark" role="button" onclick="edit_Modal(this)" data-name="{{$holi->name}}" data-holiday_date="{{$holi->holiday_date}}" data-target="#editModal" data-toggle="modal" data-id="{{$holi->id}}"><i class="fas fa-edit"></i></a> &nbsp; &nbsp;
                                            <a href="/holidays/delete/{{$holi->id}}" class="delete-confirm-holi text-danger" data-id="{{$holi->id}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
            <div id="add_holiday" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Please add the holiday</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('organisation/holidays/add') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Holiday Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="holi" name="name" placeholder="Enter Holiday Name">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Holiday Date <span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" name="holiday_date" placeholder="Enter Holiday Date">
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
                            <h5 class="modal-title">Please edit the holiday</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('organisation/holidays/edit') }}" method="POST">
                                {{ method_field('POST') }}
                              @csrf
                              <input type="hidden" class="form-control" id="id" name="id">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Holiday Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"  id="name" name="name">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Holiday Date <span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" id="holiday_date" name="holiday_date" placeholder="Enter Holiday Date">
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
            var holiday_date = link.data('holiday_date')
      
            console.log(holiday_date);

            modal.find('#name').val(name);
            modal.find('#id').val(id);
            modal.find('#date').val(date);

        }

        //Delete the record popup are you sure
        $('.delete-confirm-holi').on('click', function (event) {
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