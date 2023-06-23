@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">

    <style>
        .export-btn {
            color: white !important;
            margin: 0px 0px 10px 0px !important;
            border: none !important;
            background:  #9a55ff !important;
        }

        .export-btn-right {
            /* width: 100vw */
            /* position: relative !important;
            float: right !important; */

            color: white !important;
            margin: 0px 0px 10px 10px !important;
            border: none !important;
            background:  #f4c017 !important;
            border: 2px  solid #000000 !important;
            /* font-size: 1rem !important; */
            font-weight: bold;

        }

        /* #totalStudentCount {
            color: white !important;
            margin: 0px 0px 10px 0px !important;
            border: none !important;
            background:  #55beff !important;
        }

        table.my-buttons {
            position: relative;
            float: right;
        } */

    </style>
			
    <!-- Page Content -->
    <div class="content container-fluid">
        
        @component('components.breadcrumb')                
            @slot('title') Students @endslot
            @slot('li_1') Dashboard @endslot
            @slot('li_2') Students @endslot
            @slot('li_3') <i class="feather-check-square"></i> @endslot
        @endcomponent
        <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col text-start">
                        <ul class="list-inline-item ps-0">
                            <li class="list-inline-item">
                                {{-- <a href="{{url('students/create')}}"> --}}
                                    <button data-bs-toggle="modal" data-bs-target="#add_student" class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-class">New Student</button>
                                    <button data-bs-toggle="modal" data-bs-target="#import_student" class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-class">Import Student</button>
                                {{-- </a> --}}
                            </li>
                            <li class="list-inline-item">
                                <button id="send_multiple_msg_btn" class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" data-bs-toggle="modal" data-bs-target="#msg_student_multiple">Send Messages</button>
                            </li>
                        </ul>
                    </div>
                        <!-- Search -->
                        <div class="col-md-4 text-end">
                                            
                            <div class="input-group">
                                <input type="text" name="search_field" id="search_field" class="form-control" placeholder="Enter search keyword">
                                <button id="search_button" class="btn btn-primary" type="button">Search</button>
                            </div>
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
                            <table id="student_table" class="table table-striped table-nowrap mb-0 custom-table">
                                <!-- Filters -->
                                <div class="mb-4">
                                    <div class="row">
                                        
                                        <div class="col row justify-content-start"> 
                                            <!-- Instititue -->
                                            <div class="col-md-4 mt-2">
                                                <label for="institute_filter">Filter by Institute</label>
                                                <select id="institute_filter" class="form-select">
                                                    <option value="">All Institutes</option>
                                                    @foreach($institutes as $institute)
                                                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Course -->
                                            <div class="col-md-4 mt-2">
                                                <label for="course_filter">Filter by Program</label>
                                                <select id="course_filter" class="form-select">
                                                    <option value="">All Programs</option>
                                                    @foreach($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Batch -->
                                            <div class="col-md-4 mt-2">
                                                <label for="batch_filter">Filter by Batch</label>
                                                <select id="batch_filter" class="form-select">
                                                    <option value="">All Batches</option>
                                                    @foreach($batches as $batch)
                                                    @if(request()->input('course'))
                                                        @if($batch->course_id == request()->input('course'))
                                                        <option value="{{ $batch->id }}">{{ $batch->course->name }} | {{ $batch->name }}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $batch->id }}">{{ $batch->course->name }} | {{ $batch->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Version -->
                                            <div class="col-md-4 mt-2">
                                                <label for="version_filter">Filter by Version</label>
                                                <select id="version_filter" class="form-select">
                                                    <option value="">All Version</option>
                                                    <option value="English">English</option>
                                                    <option value="Bangla">Bangla</option>
                                                </select>
                                            </div>

                                            <!-- Gender -->
                                            <div class="col-md-4 mt-2">
                                                <label for="gender_filter">Filter by Gender</label>
                                                <select id="gender_filter" class="form-select">
                                                    <option value="">All Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>

                                            <!-- Due -->
                                            {{-- <div class="col-md-4 mt-2">
                                                <label for="due_filter">Filter by fees type</label>
                                                <select id="due_filter" class="form-select">
                                                    <option value="">All</option>
                                                    <option value="Cleared">Cleared</option>
                                                    <option value="Due">Monthly Due</option>
                                                    <option value="OneTimeDue">One Time Due</option>
                                                </select>
                                            </div> --}}

                                            <!-- Fees -->
                                            <div class="col-md-4 mt-2">
                                                <label for="fee_filter">Filter by Fees</label>
                                                <select id="fee_filter" class="form-select">
                                                    <option value="">Select Fee</option>
                                                    @foreach($paymenttypes as $paymenttype)
                                                        {{-- <option value="{{ $paymenttype->id }}">{{ $paymenttype->name }}</option> --}}

                                                        @if(request()->input('course'))
                                                            @if($paymenttype->course_id == request()->input('course'))
                                                            <option value="{{ $paymenttype->id }}">{{ $paymenttype->name }} | {{ $paymenttype->course->name }}</option>
                                                            @endif
                                                        @else
                                                            <option value="{{ $paymenttype->id }}">{{ $paymenttype->name }} | {{ $paymenttype->course->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        
                                        
                                    </div>
                                </div> 

                                <!-- Total Student Count -->
                                {{-- <div class="d-flex flex-row-reverse mr-4">
                                    <div ><p class="badge badge-pill badge-info  text-lg ">Total students {{ $totalStudent }}</p></div>                                
                                </div> --}}

                                

                                <!-- Table Starts -->
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="select-all-checkbox">
                                            </div>
                                        </th>
                                        <th >ID</th>
                                        <th>Name</th>
                                        {{-- <x-th>Email</x-th> --}}
                                        <x-th>Phone</x-th>
                                        {{-- <x-th>Parents Name</x-th>
                                        <x-th>Parents Number</x-th> --}}
                                        <x-th>Institute</x-th>
                                        <x-th>Program</x-th>
                                        <x-th>Batch</x-th>
                                        <x-th>Gender</x-th>
                                        <x-th>Version</x-th>
                                        {{-- <x-th>Blood Group</x-th> --}}

                                        {{-- <x-th>Monthly Due</x-th>
                                        <x-th>One Time Due</x-th> --}}

                                        @if(request()->input('fee'))
                                            <x-th>Due</x-th>
                                        @endif 
                                        <x-th>Createad at</x-th>
                                        {{-- <x-th>Updated at</x-th> --}}
                                        <x-th>Actions</x-th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($students as $student)
                                    <tr class="student-row">
                                       
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input student-checkbox" type="checkbox" id="select-checkbox-{{$student->id}}" data-phone="{{$student->phone_number}}">
                                            </div>
                                        </td>

                                        <td class="row-clickable"><p>{{$student->id}}</p></td>
                                        <td><p class="text-left"> <a href="#" class="avatar flex-shrink-0"><img alt="" src="{{ $student->profile_image ? asset('storage/' . $student->profile_image) : URL::asset('/assets/img/profiles/avatar.png')}}"></a> <a href="{{url("students/".$student->id)}}">{{$student->name}} </a></p> </td>
                                        {{-- <x-td><p>{{$student->email}}</p></x-td> --}}
                                        <x-td><p>{{$student->phone_number}}</p></x-td>
                                        {{-- <x-td><p>{{$student->parents_name}}</p></x-td> --}}
                                        {{-- <x-td><p>{{$student->parents_number}}</p></x-td>--}}
                                        <x-td><p>{{$student->institute->name}}</p></x-td> 
                                        <x-td><p>{{$student->course->name}}</p></x-td>

                                        
                                        <x-td>
                                        @if ($student->batch)
                                            <p>{{ $student->batch->name }}</p>
                                        @else
                                            <p>Not assigned</p>
                                        @endif
                                        </x-td>
                                        <x-td><p>{{$student->gender}}</p></x-td>
                                        <x-td><p>{{$student->version}}</p></x-td>
                                        {{-- <x-td><p>{{$student->blood_group}}</p></x-td> --}}
                                        {{-- <x-td>
                                        @if ($student->monthly_cleared)
                                            <p class="badge badge-pill badge-success mb-4">Cleared</p>
                                        @else
                                            <p class="badge badge-pill badge-warning mb-4">Due {{$student->monthly_due}}</p>

                                        @endif</x-td>

                                        <x-td>
                                            @if ($student->one_time_due == 0)
                                                <p class="badge badge-pill badge-success mb-4">Cleared</p>
                                            @else
                                                <p class="badge badge-pill badge-warning mb-4">Due {{$student->one_time_due}}</p>
    
                                            @endif
                                        </x-td> --}}

                                        @if(request()->input('fee'))
                                        <x-td>
                                        @if ($student->due == 0)
                                                <p class="badge badge-pill badge-success mb-4">Cleared</p>
                                            @else
                                                <p class="badge badge-pill badge-warning mb-4">Due {{$student->due}}</p>
    
                                            @endif
                                        </x-td>
                                        @endif 


                                        <x-td><p>{{ date('M j, Y g:i A', strtotime($student->created_at)) }}</p></x-td>

                                        {{-- <x-td><p>{{$student->updated_at}}</p></x-td> --}}
                                        
                                        <x-td>
                                            <div>
                                                <button class="btn btn-secondary btn-sm" id="msg-student-btn" data-bs-toggle="modal" data-bs-target="#msg_student" data-id="{{ $student->id }}"><i class="feather-send"></i></button>
                                                <button class="text-white btn btn-warning btn-sm" data-id="{{ $student->id }}"> <a class="text-decoration-none text-white" href="{{url("students/".$student->id)}}"> Details </a></button>
                                                <button class="btn btn-info btn-sm" id="update-student-btn" data-bs-toggle="modal" data-bs-target="#edit_student" data-student="{{ Str::limit($student, 65536) }}" data-id="{{ $student->id }}"> 
                                                    {{-- <a class="text-decoration-none  text-white" href="{{url("students/".$student->id."/edit")}}"> --}}
                                                         <span class="text-white">Edit</span> 
                                                    {{-- </a>     --}}
                                                </button>
                                                <button class="btn btn-danger btn-sm" id="delete-student-btn" data-bs-toggle="modal" data-bs-target="#delete_student" data-id="{{ $student->id }}">Delete</button>
                                                
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

    {{-- ADD STUDENT MODAL --}}
    <div class="modal fade" id="add_student" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Add student</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" id="add_student_form" action="{{route('students_store')}}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Name  <x-field-required /> </label>
                                        <input required type="text" class="form-control"  name="name" placeholder="Student's Name" value="{{old('name')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Profile Image</label>
                                        <input type="file" class="form-control"  name="profile_image">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Phone <x-field-required /></label>
                                        <input required type="text" class="form-control"  name="phone_number" placeholder="Student's Phone Number"  value="{{old('phone_number')}}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Email</label>
                                        <input type="email" class="form-control"  name="email" value="{{old('email')}}" placeholder="Student's Email">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-form-label">Institution <x-field-required /></label>
                                    <select required class=" form-control form-select" name="institute_id" value="{{old('institute_id')}}">
                                        <option value="">Choose institute</option>
                                        @foreach($institutes as $institute)
                                        
                                        <option @if($institute->id == old('institute_id')) selected @endif value="{{$institute->id}}">{{$institute->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Program <x-field-required /></label>
                                        <select required class=" form-control form-select" name="course_id" id="select_course_id" value="{{old('course_id')}}">
                                            <option value="">Choose class</option>
                                            @foreach($courses as $course)
                                            <option @if($course->id == old('course_id')) selected @endif value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Batch</label>
                                        <select class=" form-control form-select" name="batch_id" id="select_batch_id" value="{{old('batch_id')}}">
                                            <option value="">Choose batch</option>
                                            @foreach($batches as $batch)                                            
                                            <option @if($batch->id == old('batch_id')) selected @endif  value="{{$batch->id}}">{{$batch->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Parent's Name</label>
                                        <input type="text" class="form-control"  name="parents_name" placeholder="Parent's Name" value="{{old('parents_name')}}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Parent's Number</label>
                                        <input type="text" class="form-control"  name="parents_number" placeholder="Parent's Phone Number" value="{{old('parents_number')}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Gender <x-field-required /></label>
                                        <select required class=" form-control form-select" name="gender" value="{{old('gender')}}">
                                            
                                            <option> Male</option>
                                            <option> Female</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Version <x-field-required /></label>
                                        <select required class=" form-control form-select" name="version" value="{{old('version')}}">
                                            
                                            <option> Bangla</option>
                                            <option> English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Blood Group</label>
                                        <select class=" form-control form-select" name="blood_group" value="{{old('blood_group')}}">
                                            
                                            <option value="">Select Blood Group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Status <x-field-required /></label>
                                        <select required class=" form-control form-select" name="status" value="{{old('status')}}">
                                            
                                            <option> Active</option>
                                            <option> Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <input type="hidden" name="new_payment" value="false">
                                </div>
                                
                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>
                                    <button type="button" id="save-and-add-payment" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save & Payment</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    {{-- UPDATE STUDENT MODAL --}}
    <div class="modal fade" id="edit_student" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Update student</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{route('students_store')}}" enctype="multipart/form-data">
                                @csrf
                                @method("PUT") 
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Name  <x-field-required /> </label>
                                        <input required type="text" class="form-control"  name="name" id="update_name" placeholder="Student's Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Profile Image</label>
                                        <input type="file" class="form-control"  name="profile_image">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Phone <x-field-required /></label>
                                        <input disabled type="text" class="form-control"  name="phone_number" id="update_phone_number" placeholder="Student's Phone Number">
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Email</label>
                                        <input type="email" class="form-control"  name="email" id="update_email" placeholder="Student's Email">
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Parent's Name</label>
                                        <input type="text" class="form-control"  name="parents_name" id="update_parents_name" placeholder="Parent's Name">
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Parent's Number</label>
                                        <input type="text" class="form-control"  name="parents_number" id="update_parents_number" placeholder="Parent's Phone Number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Institution <x-field-required /></label>
                                    <select required class=" form-control form-select" name="institute_id" id="update_institute_id">
                                        @foreach($institutes as $institute)
                                        <option value="{{$institute->id}}">{{$institute->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group row">
                                    

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Program <x-field-required /></label>
                                        <select required class=" form-control form-select" name="course_id" id="update_course_id">
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Batch</label>
                                        <select class=" form-control form-select" name="batch_id" id="update_batch_id">
                                            <option value="">Choose batch</option>
                                            @foreach($batches as $batch)
                                            <option value="{{$batch->id}}">{{$batch->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Gender <x-field-required /></label>
                                        <select required class=" form-control form-select" name="gender" id="update_gender">
                                            
                                            <option> Male</option>
                                            <option> Female</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Version <x-field-required /></label>
                                        <select required class=" form-control form-select" name="version" id="update_version">
                                            
                                            <option> Bangla</option>
                                            <option> English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Blood Group</label>
                                        <select class=" form-control form-select" name="blood_group" id="update_blood_group">
                                            
                                            <option value="">Select Blood Group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Status <x-field-required /></label>
                                        <select required class=" form-control form-select" name="status" id="update_status">
                                            
                                            <option> Active</option>
                                            <option> Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    {{-- DELETE STUDENT MODAL --}}
    <div class="modal fade" id="delete_student" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete Student</h4>
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

    {{-- MESSAGE STUDENT MODAL --}}
    <div class="modal fade" id="msg_student" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Send Message</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleTextarea">Message<x-field-required /></label>
                                    <textarea required class="form-control" id="message" name="message" rows="5"></textarea>
                                  </div>
                                

                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Send</button>&nbsp;&nbsp;
                                    <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-rounded">Cancel</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    {{-- MESSAGE MULTIPLE STUDENT MODAL --}}
    <div class="modal fade" id="msg_student_multiple" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Send Message</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                {{-- @csrf --}}

                                <div class="form-group">
                                    <label for="exampleTextarea">Message<x-field-required /></label>
                                    <textarea required class="form-control" id="message_multiple" name="message" rows="5"></textarea>
                                  </div>
                                

                                <div class="text-center py-3">
                                    <button id="msg-multiple-student-btn" type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Send</button>&nbsp;&nbsp;
                                    <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-rounded">Cancel</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    {{-- IMPORT STUDENT MODAL --}}
    <div class="modal fade" id="import_student" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Import students</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{route('students_import')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <div class="col">
                                        <label class="col-form-label">CSV File</label>
                                        <input type="file" class="form-control"  name="csv_file">
                                    </div>
                                  </div>
                                

                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Send</button>&nbsp;&nbsp;
                                    <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-rounded">Cancel</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    {{-- ADD PAYMENT MODAL --}}
    @if(session()->has('new_payment'))
    <div class="modal fade hide" id="add_payment" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Create new payment</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('payments') }}">
                                @csrf
                                <h4>Payment Details</h4>
                                <div class="form-group row">
                                    
                                    <input class="d-none" type="number" name="student_id" value={{session('studentId')}}>


                                    <div>
                                        <label class="col-form-label">Payment Type<x-field-required /></label>
                                        <select required class=" form-control form-select" id="select_paymenttype_id" name="paymenttype_id">
                                            <option value="">Select payment type</option>
                                            @foreach($paymenttypes as $paymenttype)
                                            <option amount="{{$paymenttype->payable_amount}}" value="{{$paymenttype->id}}">{{$paymenttype->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label  class="col-form-label">Payable Amount</label>
                                        <input value="0.00" type="text" class="form-control" id="payable_amount" name="payable_amount" placeholder="Select a payment type">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Amount Paid<x-field-required /></label>
                                        <input required value="0.00" type="text" class="form-control" id="amount_payed"  name="amount_payed" placeholder="Enter paid amount">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Due</label>
                                        <input required value="0.00" type="text" class="form-control" id="due_amount"  name="due_amount">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Date<x-field-required /></label>
                                        <input required type="date" class="form-control" id="select_date" name="payment_date" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Payment Status<x-field-required /></label>
                                        <select required class=" form-control form-select" name="payment_status" id="payment_status">
                                            <option value="Paid">Paid</option>
                                            <option value="Unpaid">Unpaid</option>
                                            <option value="Partial">Partial</option>
                                        </select>
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
    @endif


    {{-- EDIT/DELETE BUTTON ONCLICK --}}
    <script>
        $(document).ready(function() {
            // Filter Values
            $('#institute_filter').val({{ request()->input('institute') }});
            $('#course_filter').val({{ request()->input('course') }});
            $('#batch_filter').val({{ request()->input('batch') }});
            $('#version_filter').val("{{ request()->input('version') }}");
            $('#gender_filter').val("{{ request()->input('gender') }}");
            // $('#due_filter').val("{{request()->input('due')}}");
            $('#fee_filter').val({{ request()->input('fee') }});
            $('#search_field').val("{{request()->input('search')}}");

            // Hide Send Message Button by default
            $('#send_multiple_msg_btn').hide();         
            
            $('#student_table').DataTable( {
                dom: 'Bfrtip',
                searching: false,
                paging: true,
                scrollX: true,
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ]
                buttons: [
                    {
                    className: 'export-btn-right',
                    text: `<div id="totalStudentCount" class="float-right text-lg-left"><i  class="fas fa-users"></i> Total Student {{ $totalStudent }}</div>`
                },
                {
                    extend: 'excel',
                    className: 'export-btn',
                    text: '<i class="far fa-file-excel"></i> Export to Excel'
                }
                
            ]
            } );
        });

        // Handle click event of the "Delete" button
        $(document).on('click', '#delete-student-btn', function() {
                var id = $(this).data('id'); // Get the ID of the selected institution         
                $('#delete_student form').prop('action', 'students/' +  id);
        });

        // Handle click event of the "Send Message" button
        $(document).on('click', '#msg-student-btn', function() {
                var id = $(this).data('id'); // Get the ID of the selected institution         
                $('#msg_student form').prop('action', 'students/msg/' +  id);
        });

        function filterData() {
            var selectedInstituteId = $('#institute_filter').val();
            var selectedCourseId = $('#course_filter').val();
            var selectedBatchId = $('#batch_filter').val();
            var selectedVersion = $('#version_filter').val();
            var selectedGender = $('#gender_filter').val();
            var selectedDueFilter = $('#due_filter').val();
            var selectedFeeFilter = $('#fee_filter').val();


            window.location.href = "./students?course=" + selectedCourseId + "&institute=" + selectedInstituteId + "&batch=" + selectedBatchId + "&version=" + selectedVersion + "&gender=" + selectedGender + "&due=" + selectedDueFilter + "&fee=" + selectedFeeFilter;
        }


        // Course Filter
        $('#course_filter').change(function() {
            filterData();
               
        });

        // Instititue Filter
        $('#institute_filter').change(function() {
            filterData();
               
        });

        // Batch Filter
        $('#batch_filter').change(function() {
            filterData();
        });

        // Version Filter
        $('#version_filter').change(function() {
            filterData();
               
        });

        // Gender Filter
        $('#gender_filter').change(function() {
            filterData();
        });

        // Due Filter
        // $('#due_filter').change(function() {
        //     filterData();
        // });

        // Fee Filter
        $('#fee_filter').change(function() {
            filterData();
        });

        // Search
        $('#search_button').click(function() {
            var seachVal = $('#search_field').val();
            window.location.href = "./students?search=" + seachVal;
               
        });
        $('#search_field').change(function() {
            var seachVal = $('#search_field').val();
            window.location.href = "./students?search=" + seachVal;
        });


        // Send Message
        // Function to concatenate selected phone numbers and call the send message API
        function sendMessages() {
            var studentIds = [];
            // Loop through all the selected checkboxes with class "student-checkbox"
            $('input.student-checkbox:checked').each(function() {
                // Get the student ID from the parent <td> element
                var studentId = $(this).closest('td').prev('.d-none').find('p').text();
                // Add the student ID to the array
                studentIds.push(studentId);
            });

            // Concatenate the student IDs with commas
            var studentIdsString = studentIds.join(',');
            var message = $('#message_multiple').val();
            // Call the API with the concatenated student IDs as query parameter
            window.location.href = './students/sendmessage?id=' + studentIdsString + "&message=" + message;
        }
        

        // Attach click event to the send message button
        $('#msg-multiple-student-btn').on('click', function() {
            // console.log("HERE");
            sendMessages();
        });

        // Attach click event to the select all checkbox
        $('#select-all-checkbox').on('click', function() {
            // Get the checked status of the select all checkbox
            var isChecked = $(this).prop('checked');
            // Set the checked status of all other checkboxes to match the select all checkbox
            $('input[type="checkbox"]').prop('checked', isChecked);


            // ---- Count Checkbox
            // Find the checkbox within the row
            var checkbox = $(this).find('.student-checkbox');

            // Toggle the checkbox's checked status
            checkbox.prop('checked', !checkbox.prop('checked'));

            if ($('.student-checkbox:checked').length > 0) {
                // Show the button if at least one checkbox is checked
                $('#send_multiple_msg_btn').show();
            } else {
                // Hide the button if no checkboxes are checked
                $('#send_multiple_msg_btn').hide();
            }
        });

        // Row clickable
        $(document).on('click', '.row-clickable', function () {
            // Find the checkbox within the row
            // var checkbox = $(this).find('.student-checkbox');
            var checkbox = $(this).closest('.student-row').find('td:nth-child(2) .form-check-input');

            // Toggle the checkbox's checked status
            checkbox.prop('checked', !checkbox.prop('checked'));

            if ($('.student-checkbox:checked').length > 0) {
                // Show the button if at least one checkbox is checked
                $('#send_multiple_msg_btn').show();
            } else {
                // Hide the button if no checkboxes are checked
                $('#send_multiple_msg_btn').hide();
            }
        });

        // Checkbox Click
        $(document).on('click', '.student-checkbox', function () {
            if ($('.student-checkbox:checked').length > 0) {
                // Show the button if at least one checkbox is checked
                $('#send_multiple_msg_btn').show();
            } else {
                // Hide the button if no checkboxes are checked
                $('#send_multiple_msg_btn').hide();
            }
        });




        // Edit Button Click
        $(document).on('click', '#update-student-btn', function() {
            let student  =  $(this).data('student');
            var id = $(this).data('id');

            $('#edit_student form').prop('action', 'students/' +  id + "/update");
            $('#update_name').val(student.name);
            $('#update_phone_number').val(student.phone_number);
            $('#update_email').val(student.email);
            $('#update_parents_name').val(student.parents_name);
            $('#update_parents_number').val(student.parents_number);
            $('#update_institute_id').val(student.institute_id);
            $('#update_course_id').val(student.course_id);
            $('#update_batch_id').val(student.batch_id);
            $('#update_gender').val(student.gender);
            $('#update_version').val(student.version);
            $('#update_blood_group').val(student.blood_group);
            $('#update_status').val(student.status);
        });


        // Update Batch when Program selected [ADD]   
        $(document).on('change', '#select_course_id', function() {
            var selectedCourseId = $(this).val();
            var batchSelect = $('#select_batch_id');
            var batches = {!! json_encode($batches) !!};

            // Reset Batches
            batchSelect.val('');
            batchSelect.empty().append('<option value="">Select batch</option>');

            if (selectedCourseId !== '') {
                // Filter Batches by Program
                var filteredBatches = batches.filter(function(batch) {
                    return batch.course_id == selectedCourseId;
                });

                // Append Filtered Batches
                filteredBatches.forEach(function(batch) {
                    batchSelect.append('<option value="' + batch.id + '">' + batch.name + '</option>');
                });

            }
        });

        // Update Batch when Program selected [UPDATE]   
        $(document).on('change', '#update_course_id', function() {
            var selectedCourseId = $(this).val();
            var batchSelect = $('#update_batch_id');
            var batches = {!! json_encode($batches) !!};

            // Reset Batches
            batchSelect.val('');
            batchSelect.empty().append('<option value="">Select batch</option>');

            if (selectedCourseId !== '') {
                // Filter Batches by Program
                var filteredBatches = batches.filter(function(batch) {
                    return batch.course_id == selectedCourseId;
                });

                // Append Filtered Batches
                filteredBatches.forEach(function(batch) {
                    batchSelect.append('<option value="' + batch.id + '">' + batch.name + '</option>');
                });

            }
        });

        // Payment Section -------------------------------------------
        // Save and new Payment
        document.getElementById('save-and-add-payment').addEventListener('click', function() {
            document.querySelector('input[name="new_payment"]').value = 'true';
            document.querySelector('#add_student_form').submit();
        });
        $(document).ready(function () {
            console.log({!! session()->has('new_payment') !!})
            

            @if(session()->has('new_payment'))
                $('#add_payment').modal('show');

                @if(session()->has('studentId'))
                
                    // filter payment type
                    var selectedStudentId = {!! session('studentId') !!};
                    var selectedCourseId = {!! session('courseId') !!};

                    var paymentTypeSelect = $('#select_paymenttype_id');
                    var paymentTypes = {!! json_encode($paymenttypes) !!};
                    
                    // Reset payment type options
                    paymentTypeSelect.val('');
                    paymentTypeSelect.empty().append('<option value="">Select payment type</option>');
                    
                    if (selectedStudentId !== '') {
                        $.each(paymentTypes, function(index, paymentType) {
                            if (paymentType.course_id == selectedCourseId) {
                                paymentTypeSelect.append('<option amount="' + paymentType.payable_amount + '" value="' + paymentType.id + '">' + paymentType.name + '</option>');
                            }
                        });
                    }

                @endif
            
            @else
                $('#add_payment').modal('hide');
            @endif

        });


        // Payment Type Selection
        $('#select_paymenttype_id').change(function() {
            // Get the selected value
            const paymenttype_id = $(this).val();
            const payable_amount = $('option:selected', this).attr('amount');
            
            $('#payable_amount').val(payable_amount);

            const paidAmount = $('#amount_payed').val();
            $('#due_amount').val(payable_amount - paidAmount);
        });

        // Amount Payed
        $('#amount_payed').on('keyup', function() {
            const paidAmount = $(this).val();
            const payable_amount = $('option:selected', $('#select_paymenttype_id')).attr('amount');;

            const due_amount = payable_amount - paidAmount;
            $('#due_amount').val(due_amount);

            if(due_amount == 0){
                $('#payment_status').val("Paid").change()
            } else if (due_amount == payable_amount){
                $('#payment_status').val("Unpaid").change()
            } else if (due_amount > 0){
                $('#payment_status').val("Partial").change()
            } 

        });

        
    </script> 



{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection