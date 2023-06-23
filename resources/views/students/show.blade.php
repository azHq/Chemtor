@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">


    <style>
        /* CUSTOM */
        .cursor-default {
            cursor: default !important;
        }

        .cursor-pointer {
            cursor: pointer !important;
        }
    </style>
			
    <!-- Page Content -->
    <div class="content container-fluid">
        
        @component('components.breadcrumb')                
            @slot('title') Student Information  @endslot
            @slot('li_1') Dashboard @endslot
            @slot('li_2') Students @endslot
            @slot('li_3') <i class="feather-check-square"></i> @endslot
        @endcomponent

        {{-- CONTENT --}}
        <div class="mt-4">
            <div class="row">
                <div class="col-md-12">
                    {{-- STUDENT INFORMATION --}}
                    <div class="container">
                        <div class="row">
                                <div class="col-12">
                                    
                                    <!-- Form START -->
                                    <div class="file-upload">
                                        <div class="row mb-2 gx-5">

                                            <!-- Profile Image -->
                                            <div class="col-xxl-4" style="margin-top: 4rem;"">
                                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                                    <div class="row g-3">
                                                        
                                                        <div class="text-center">
                                                            <!-- Image -->
                                                            <div class="square position-relative display-2 mb-3">
                                                                
                                                                

                                                                {{-- <i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i> --}}
                                                                <img class="img-fluid" style="width: 250px; height: 250px; border-radius: 100%;" src="{{ $student->profile_image ? asset('storage/' . $student->profile_image) : URL::asset('/assets/img/profiles/avatar.jpg')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Contact detail -->
                                            <div class="col-xxl-8 mb-2 mb-xxl-0">
                                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                                    <div class="row g-3">
                                                        <h4 class="mb-4 mt-0"> <span class="mr-2"> Student detail </span>
                                                            <button class="btn btn-info btn-sm" id="update-student-btn" data-bs-toggle="modal" data-bs-target="#edit_student" data-student="{{ Str::limit($student, 65536) }}" data-id="{{ $student->id }}"> <i class="fas fa-pen"></i> </button>
                                                        </h4>
                                                        <!-- First Name -->
                                                        <div>
                                                            <label class="form-label">Name </label>
                                                            <input disabled type="text" class="form-control cursor-default" placeholder="" value="{{$student->name}}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Monhtly Due</label>
                                                        
                                                            @if($monthly_cleared)
                                                                <input disabled type="text" class="form-control cursor-default" style="border: 2px solid rgb(105, 216, 105)" placeholder="" value="Cleared">
                                                            @else 
                                                                <input disabled type="text" class="form-control cursor-default" style="border: 2px solid rgb(230, 90, 90)" placeholder="" value="{{ $monthly_due}}">
                                                            @endif
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">One Time Due</label>
                                                        
                                                            @if($one_time_due == 0)
                                                                <input disabled type="text" class="form-control cursor-default" style="border: 2px solid rgb(105, 216, 105)" placeholder="" value="Cleared">
                                                            @else 
                                                                <input disabled type="text" class="form-control cursor-default" style="border: 2px solid rgb(230, 90, 90)" placeholder="" value="{{$one_time_due}}">
                                                            @endif
                                                        </div>
                                                        <!-- Gender -->
                                                        
                                                        <!-- Phone number -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Phone</label>
                                                            <input disabled type="text" class="form-control cursor-default" placeholder="" aria-label="Phone number" value={{$student->phone_number}}>
                                                        </div>
                                                        <!-- Email -->
                                                        <div class="col-md-6">
                                                            <label for="inputEmail4" class="form-label">Email </label>
                                                            <input disabled type="email" class="form-control cursor-default" id="inputEmail4" value={{$student->email}}>
                                                        </div>
                                                        <!-- Parent -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Parent's Name</label>
                                                            <input disabled type="text" class="form-control cursor-default" placeholder="" aria-label="Phone number" value="{{$student->parents_name}}">
                                                        </div>

                                                        <!-- Parent's Number -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Parent's Number </label>
                                                            <input disabled type="text" class="form-control cursor-default" placeholder="" aria-label="Phone number" value="{{$student->parents_number}}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Gender</label>
                                                            <select disabled required class=" form-control cursor-default" name="gender">
                                                                <option {{$student->gender == 'Male' ? 'selected' : '' }} > Male</option>
                                                                <option {{$student->gender == 'Female' ? 'selected' : '' }}> Female</option>
                                                            </select>
                                                        </div>
                                                        <!-- Blood Group -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Gender</label>
                                                            <select disabled required class=" form-control cursor-default" name="gender">
                                                                <option {{$student->blood_group == '' ? 'selected' : '' }} value="">Select Blood Group</option>
                                                                <option {{$student->blood_group == 'A+' ? 'selected' : '' }} value="A+">A+</option>
                                                                <option {{$student->blood_group == 'A-' ? 'selected' : '' }} value="A-">A-</option>
                                                                <option {{$student->blood_group == 'B+' ? 'selected' : '' }} value="B+">B+</option>
                                                                <option {{$student->blood_group == 'B-' ? 'selected' : '' }} value="B-">B-</option>
                                                                <option {{$student->blood_group == 'O+' ? 'selected' : '' }} value="O+">O+</option>
                                                                <option {{$student->blood_group == 'O-' ? 'selected' : '' }} value="O-">O-</option>
                                                                <option {{$student->blood_group == 'AB+' ? 'selected' : '' }} value="AB+">AB+</option>
                                                                <option {{$student->blood_group == 'AB-' ? 'selected' : '' }} value="AB-">AB-</option>
                                                            </select>
                                                        </div>
                                                    </div> <!-- Row END -->
                                                </div>
                                            </div>
                                            
                                        </div> <!-- Row END -->
                        
                                        <!-- Social media detail -->
                                        <div class="row mb-5 gx-5">
                                            <div class="col-xxl-8 mb-5 mb-xxl-0">
                                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                                    <div class="row g-3">
                                                        <h4 class="mb-4 mt-0">Educational details</h4>
                                                        <!-- Instutution -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Institution</label>
                                                            <select disabled required class=" form-control cursor-default" name="institute_id">
                                                                @foreach($institutes as $institute)
                                                                <option {{$institute->id == $student->institute_id ? 'selected' : '' }} value="{{$institute->id}}">{{$institute->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Class -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Class</label>
                                                            <select disabled required class=" form-control cursor-default" name="course_id">
                                                                @foreach($courses as $course)
                                                                <option {{$course->id == $student->course_id ? 'selected' : '' }} value="{{$course->id}}">{{$course->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Version -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Version</label>
                                                            <select disabled required class=" form-control cursor-default" name="version">
                                                                <option {{$student->version == 'Bangla' ? 'selected' : '' }}> Bangla</option>
                                                                <option {{$student->version == 'English' ? 'selected' : '' }}> English</option>
                                                            </select>
                                                        </div>

                                                        <!-- Status -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Status</label>
                                                            <select disabled required class=" form-control cursor-default" name="status">
                                                                <option {{$student->status == 'Active' ? 'selected' : '' }}> Active</option>
                                                                <option {{$student->status == 'Inactive' ? 'selected' : '' }}> Inactive</option>
                                                            </select>
                                                        </div>


                                                        

                                                    </div> <!-- Row END -->
                                                </div>
                                            </div>
                        
                                            
                                        </div> <!-- Row END -->
                                        
                                    </div> <!-- Form END -->
                                </div>
                            </div>
                        </div>


                    {{-- Payment History --}}

                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4 class="pb-3">Payment History</h4>
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                                    
                                    {{-- <div class="text-end">
                                        <button id="add_payment_btn" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add_payment">Add payment</button>
                                    </div> --}}
                                    <!-- Filters -->
                                    <div class="mb-4">
                                        <div class="row">
                                            
                                            <div class="col row justify-content-start">

                                                
                                                
                                                <!-- Course -->
                                                <div class="col-md-3">
                                                    <label for="course_filter">Start Date</label>
                                                    <input id="start_date_filter" type="date" class="form-control" />
                                                </div>

                                                <!-- Instititue -->
                                                <div class="col-md-3">
                                                    <label for="institute_filter">End Date</label>
                                                    <input id="end_date_filter" type="date" class="form-control" />
                                                </div>

                                                <!-- Status -->
                                                <div class="col-md-3">
                                                    <label for="institute_filter">Status</label>
                                                    <select id="status_filter" class="form-control">
                                                        <option value="">All</option>
                                                        <option value="Paid">Paid</option>
                                                        <option value="Partial">Partial</option>
                                                        <option value="Unpaid">Unpaid</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Search -->
                                            <div class="col-md-2 mt-3 justify-content-end text-end">
                                                
                                                <div class="input-group text-end">
                                                    <button id="add_payment_btn" class="btn btn-primary text-end"  data-bs-toggle="modal" data-bs-target="#add_payment">Add payment</button>
                                                </div>
                                            </div>

                                        </div>
                                            
                                        </div>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>

                                            {{-- <th class="text-center">Name</th> --}}
                                            <x-th>Student</x-th>
                                            <x-th>Phone Number</x-th>
                                            <x-th>Payment Type</x-th>
                                            <x-th>Payable Amount</x-th>
                                            <x-th>Amount Payed</x-th>
                                            <x-th>Due Amount</x-th>
                                            <x-th>Date</x-th>
                                            <x-th>Status</x-th>
                                            <x-th>Actions</x-th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($payments as $payment)
                                        <tr>
                                            <td class="d-none"><p>{{$payment->id}}</p></td>
                                            <x-td><p>{{$payment->student->name}}</p></x-td>
                                            <x-td><p>{{$payment->student->phone_number}}</p></x-td>
                                            <x-td><p>{{$payment->paymenttype->name}}</p></x-td>
                                            <x-td><p>{{$payment->paymenttype->payable_amount}}</p></x-td>
                                            <x-td><p>{{$payment->amount_payed}}</p></x-td>
                                            <x-td><p>{{$payment->due_amount}}</p></x-td>
                                            <x-td><p>{{ date('M j, Y', strtotime($payment->payment_date)) }}</p></x-td>
                                            {{-- <x-td><p>{{$payment->payment_date}}</p></x-td> --}}
                                            <x-td><p>{{$payment->payment_status}}</p></x-td>
                                            <x-td>
                                                <div>
                                                    <button class="btn btn-info btn-sm" id="update-payment-btn" data-bs-toggle="modal" data-bs-target="#edit_payment" data-payment="{{ Str::limit($payment, 65536) }}" data-id="{{ $payment->id }}">  Edit </button>
                                                </div>
                                            </x-td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    {{-- SMS --}}

                    <div class="card mb-0 mt-5">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4 class="pb-3">Message History</h4>
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                                    
                                    <div class="text-end">
                                        <button id="send_msg_btn" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#msg_student">Send Message</button>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <x-th>Student</x-th>
                                            <x-th>Phone</x-th>
                                            <x-th>Message</x-th>
                                            <x-th>Status</x-th>
                                            <x-th>Time</x-th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($messages as $message)
                                        <tr>
                                            <td class="d-none"><p>{{$message->id}}</p></td>
                                            <x-td><p>{{$message->student->name}}</p></x-td>
                                            <x-td><p>{{$message->student->phone_number}}</p></x-td>
                                            <x-td><p>{{$message->message}}</p></x-td>
                                            <x-td><p>{{$message->status}}</p></x-td>
                                            <x-td><p>{{ date('M d, Y h:i A', strtotime($message->created_at)) }}</p></x-td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>         
        
    </div>
    <!-- /Page Content -->
            

    


    {{-- ADD PAYMENT MODAL --}}
    <div class="modal fade" id="add_payment" tabindex="-1" role="dialog" aria-modal="true">
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
                                    
                                    <input class="d-none" type="number" name="student_id" value={{$student->id}}>


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
                                            <option selected value="Unpaid">Unpaid</option>
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


    {{-- EDIT PAYMENT MODAL --}}
    <div class="modal fade" id="edit_payment" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit payment</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('payments') }}">
                                @csrf
                                @method("PUT")
                                <h4>Payment Details</h4>
                                <div class="form-group row">
                                    <div>
                                        <input id="update_student_id" class="d-none" type="number" name="student_id">
                                    </div>


                                    <div>
                                        <label class="col-form-label">Payment Type<x-field-required /></label>
                                        <select required class=" form-control form-select" id="update_select_paymenttype_id" name="paymenttype_id">
                                            <option value="">Select payment type</option>
                                            @foreach($paymenttypes as $paymenttype)
                                            <option amount="{{$paymenttype->payable_amount}}" value="{{$paymenttype->id}}">{{$paymenttype->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label  class="col-form-label">Payable Amount</label>
                                        <input type="text" class="form-control" id="update_payable_amount" name="payable_amount" placeholder="Select a payment type">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Amount Paid<x-field-required /></label>
                                        <input required value="0.00" type="text" class="form-control" id="update_amount_payed"  name="amount_payed" placeholder="Enter paid amount">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Due</label>
                                        <input required value="0.00" type="text" class="form-control" id="update_due_amount"  name="due_amount">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Date<x-field-required /></label>
                                        <input required type="date" class="form-control" id="update_select_date" name="payment_date" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Payment Status<x-field-required /></label>
                                        <select required class=" form-control form-select" id="update_payment_status" name="payment_status">
                                            
                                            
                                            <option value="Paid">Paid</option>
                                            <option value="Unpaid">Unpaid</option>
                                            <option value="Partial">Partial</option>
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                                
                                </div>

                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update</button>&nbsp;&nbsp;
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
                            <form method="POST" action="/students/msg/{{$student->id}}">
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
                                        <label class="col-form-label">Class <x-field-required /></label>
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

    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->


    <script>
        $(document).ready(function() {

            // Filter Values
            // -------------------

            // default values
            $('#start_date_filter').val( "{{request()->input('start_date')}}");
            $('#end_date_filter').val( "{{request()->input('end_date')}}");
            $('#status_filter').val( "{{request()->input('status')}}");


            function updateUrlAndFilter() {
                var startDate = $('#start_date_filter').val();
                var endDate = $('#end_date_filter').val();
                var status = $('#status_filter').val();

                var url = "./" +  {!! ($student->id) !!} + "?start_date=" + startDate + "&end_date=" + endDate + "&status=" + status;
                
                window.location.href = url;
            }
            
            // Start Date
            $('#start_date_filter').change(function() {
                updateUrlAndFilter();
            });

            // End Date
            $('#end_date_filter').change(function() {
                updateUrlAndFilter();
            });

            // End Date
            $('#status_filter').change(function() {
                updateUrlAndFilter();
            });
            
            // Payment Type Selection
            $('#select_paymenttype_id').change(function() {
                // Get the selected value
                const paymenttype_id = $(this).val();
                const payable_amount = $('option:selected', this).attr('amount');;
                // console.log("Payment type selected")
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


            // Payment Type Selection
            $('#update_select_paymenttype_id').change(function() {
                // Get the selected value
                const paymenttype_id = $(this).val();
                const payable_amount = $('option:selected', this).attr('amount');;
                
                $('#update_payable_amount').val(payable_amount);

                const paidAmount = $('#update_amount_payed').val();
                $('#update_due_amount').val(payable_amount - paidAmount);
            });

            // Amount Payed [Update]
            $('#update_amount_payed').on('keyup', function() {

                const paidAmount = $(this).val();
                const payable_amount = $('option:selected', $('#update_select_paymenttype_id')).attr('amount');
                const due_amount = payable_amount - paidAmount;
                $('#update_due_amount').val(due_amount);

                if(due_amount == 0){
                    $('#update_payment_status').val("Paid").change()
                } else if (due_amount == payable_amount){
                    $('#update_payment_status').val("Unpaid").change()
                } else if (due_amount > 0){
                    $('#update_payment_status').val("Partial").change()
                }
            });
        });

        // Payment edit Button Click
        $(document).on('click', '#update-payment-btn', function() {
            let payment  =  $(this).data('payment');
            var id = $(this).data('id');

            $('#edit_payment form').prop('action', '../payments/' +  id);
            $('#update_student_id').val(payment.student.id);
            $('#update_select_paymenttype_id').val(payment.paymenttype.id);
            $('#update_payable_amount').val(payment.payable_amount);
            $('#update_amount_payed').val(payment.amount_payed);
            $('#update_due_amount').val(payment.due_amount);
            $('#update_payment_date').val(payment.payment_date);
            $('#update_payment_status').val(payment.payment_status);
        });

        // Student edit Button Click
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

        // Update Batch when Class selected [UPDATE]   
        $(document).on('change', '#update_course_id', function() {
            var selectedCourseId = $(this).val();
            var batchSelect = $('#update_batch_id');
            var batches = {!! json_encode($batches) !!};

            // Reset Batches
            batchSelect.val('');
            batchSelect.empty().append('<option value="">Select batch</option>');

            if (selectedCourseId !== '') {
                // Filter Batches by Class
                var filteredBatches = batches.filter(function(batch) {
                    return batch.course_id == selectedCourseId;
                });

                // Append Filtered Batches
                filteredBatches.forEach(function(batch) {
                    batchSelect.append('<option value="' + batch.id + '">' + batch.name + '</option>');
                });

            }
        });
    </script> 
{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection