@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
               
                @component('components.breadcrumb')                
                  @slot('title') Fees  @endslot
                  @slot('li_1') Dashboard @endslot
                  @slot('li_2') Fees @endslot
                  @slot('li_3') <i class="feather-check-square"></i> @endslot
                @endcomponent
                <!-- Page Header -->
                    <div class="page-header pt-3 mb-0 ">
                        <div class="row">
                            <div class="col">
                            </div>
                            <div class="col text-end">
                                <ul class="list-inline-item ps-0">
                                    <li class="list-inline-item">
                                        <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-class" data-bs-toggle="modal" data-bs-target="#add_class">New Fee</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->


                    <!-- Content Starts -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap custom-table mb-0 datatable">

                                        <!-- Filters -->
                                        <div class="mb-4">
                                            <div class="row">
                                                

                                                <div class="col row justify-content-start"> 

                                                <!-- Course -->
                                                <div class="col-md-2">
                                                    <label for="course_filter">Filter by Program</label>
                                                    <select id="course_filter" class="form-select">
                                                        <option value="">All Programs</option>
                                                        @foreach($courses as $course)
                                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                                
                                            </div>
                                        </div>

                                        <thead>
                                            <tr>
                                                <th class="d-none">ID</th>

                                                <x-th>Name</x-th>
                                                <x-th>Program</x-th>
                                                <x-th>Category</x-th>
                                                <x-th>Amount</x-th>
                                                <x-th>Createad at</x-th>
                                                <x-th>Updated at</x-th>
                                                {{-- <th>Task Owner</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th> --}}
                                                <x-th>Actions</x-th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($paymenttypes as $paymenttype)
                                            <tr>
                                                <td class="d-none"><p>{{$paymenttype->id}}</p></td>
                                                <x-td><p>{{$paymenttype->name}}</p></x-td>
                                                <x-td><p>{{$paymenttype->course->name}}</p></x-td>
                                                <x-td><p>{{$paymenttype->category}}</p></x-td>

                                                <x-td><p>{{$paymenttype->payable_amount}}</p></x-td>

                                                <x-td><p>{{ date('M j, Y g:i A', strtotime($paymenttype->created_at)) }}</p></x-td>

                                                <x-td><p>{{ date('M j, Y g:i A', strtotime($paymenttype->updated_at)) }}</p></x-td>
                                                
                                                <x-td>
                                                    <div>
                                                        <button class="btn btn-info btn-sm" id="update-class-btn" data-bs-toggle="modal" data-bs-target="#update_class" data-id="{{ $paymenttype->id }}" data-row="{{$paymenttype}}"> <span class="text-white">Edit</span></button>
                                                        <button class="btn btn-danger btn-sm"" id="delete-class-btn" data-bs-toggle="modal" data-bs-target="#delete_class" data-id="{{ $paymenttype->id }}">Delete</button>
                                                    </div>
                                                </x-td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Content End -->
                
            </div>
            <!-- /Page Content -->
            
        </div>
        <!-- /Page Wrapper -->
        
    </div>
    <!-- /Main Wrapper -->

    {{-- ADD PARAMETER MODAL --}}
    <div class="modal fade" id="add_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Add Fee</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('parameters') }}">
                                @csrf
                                <h4>Fee Details</h4>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Fee title <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="name" placeholder="Parameter Name">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Program <x-field-required /></label>
                                        <select required class=" form-control form-select" name="course_id">
                                            <option value="">Select Program</option>
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="col-form-label">Category <x-field-required /></label>
                                        <select required class=" form-control form-select" name="category">
                                            <option value="">Select Category</option>
                                            <option value="Monthly">Monthly</option>
                                            <option value="One time">One time</option>
                                        </select>
                                    </div>

                                    <div >
                                        <label class="col-form-label">Payable Amount <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="payable_amount" id="payable_amount" placeholder="Payable Amount">
                                    </div>
                                    
                                </div>
                                
                                </div>

                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>&nbsp;&nbsp;
                                    <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-rounded">Cancel</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    {{-- UPDATE PARAMETER MODAL --}}
    <div class="modal fade" id="update_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Update Parameter</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('parameters') }}">
                                @csrf
                                @method("PUT")
                                <h4>Program Details</h4>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Parameter Name <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="update_name" placeholder="Parameter Name">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Program <x-field-required /></label>
                                        <select required class=" form-control form-select" id="update_course_id" name="course_id">
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div >
                                        <label class="col-form-label">Payable Amount <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="payable_amount" id="update_payable_amount" placeholder="Amount">
                                    </div>
                                    
                                </div>
                                
                                </div>

                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>&nbsp;&nbsp;
                                    <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-rounded">Cancel</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    {{-- DELETE PARAMETER MODAL --}}
    <div class="modal fade" id="delete_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete Parameter</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST">
                                @csrf
                                @method('DELETE')
                                
                                <div class="form-group row">
                                    <h3>Are you sure you want to delete?</h3>
                                </div>

                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Delete</button>&nbsp;&nbsp;
                                    <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-rounded">Cancel</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>


    {{-- EDIT/DELETE BUTTON ONCLICK --}}
    <script>
        $(document).ready(function() {
            // Filtered Value
            $('#course_filter').val({{ request()->input('course') }});



            // Handle click event of the "Edit" button
            $('#update-class-btn').click(function() {
                var id = $(this).data('id'); // Get the ID of the selected institution
                $('#update_class form').prop('action', 'parameters/' +  id);

                var row  = $(this).data('row');
                $('#update_name').val(row.name);
                $('#update_payable_amount').val(row.payable_amount);
                // $('#update_course_id').val(row.course->id);


            });

            // Handle click event of the "Delete" button
            $('#delete-class-btn').on('click', function() {
                var id = $(this).data('id'); // Get the ID of the selected institution         
                $('#delete_class form').prop('action', 'parameters/' +  id);
            });
        });



        // Course Filter
        $('#course_filter').change(function() {
            var selectedCourseId = $(this).val();
            window.location.href = "./parameters?course=" + selectedCourseId;
               
        });
    </script> 



{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection