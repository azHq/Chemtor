@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">

    
			
    <!-- Page Content -->
    <div class="content container-fluid">
        
        @component('components.breadcrumb')                
            @slot('title') Payments  @endslot
            @slot('li_1') Dashboard @endslot
            @slot('li_2') Payments @endslot
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
                                <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-class" data-bs-toggle="modal" data-bs-target="#add_payment">New Payment</button>
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
                                            <div class="col-md-4 mt-3 justify-content-end">
                                                
                                                <div class="input-group">
                                                    <input type="text" name="search_field" id="search_field" class="form-control" placeholder="Search by id, name, phone or class">
                                                    <button id="search_button" class="btn btn-primary" type="button">Search</button>
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
                                            <x-td><a href="{{url('students')."/".$payment->student->id}}"><p><span href="#" class="avatar flex-shrink-0"><img alt="" src="{{ $payment->student->profile_image ? asset('storage/' . $payment->student->profile_image) : URL::asset('/assets/img/profiles/avatar.jpg')}}"></span> {{$payment->student->name}} | {{$payment->student->id}}</p></a></x-td>
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
                                                    
                                                    <button class="btn btn-info btn-sm" id="update-payment-btn" data-bs-toggle="modal" data-bs-target="#edit_payment" data-payment="{{ Str::limit($payment, 65536) }}" data-id="{{ $payment->id }}"> <span class="text-white"> Edit </span> </button>
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
            
    {{-- </div>
    <!-- /Page Wrapper --> --}}
        


    {{-- ADD PAYMENT MODAL --}}
    <div class="modal fade" id="add_payment"  role="dialog" aria-hidden="true">
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
                                    <select required class="select2" id="select_student_id" name="student_id" >
                                        <option value="">Search student</option>
                                    </select>


                                    <div>
                                        <label class="col-form-label">Payment Type<x-field-required /></label>
                                        <select required class=" form-control form-select" id="select_paymenttype_id" name="paymenttype_id">
                                            <option value="">Select payment type</option>
                                            @foreach($paymenttypes as $paymenttype)
                                                    <option value="{{$paymenttype->id}}" data-course-id="{{$paymenttype->course_id}}">{{$paymenttype->course->name}} | {{$paymenttype->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label  class="col-form-label">Payable Amount</label>
                                        <input value="0.00" type="text" class="form-control" id="payable_amount" name="payable_amount" placeholder="Enter payable amount"">
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


    {{-- EDIT PAYMENT MODAL --}}
    <div class="modal fade" id="edit_payment" role="dialog" aria-hidden="true">
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
                                <select required class="select2" id="update_select_student_id" name="student_id" >
                                    <option value="">Search student</option>
                                </select>


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
                                    <label class="col-form-label">Payable Amount</label>
                                    <input value="0.00" type="text" class="form-control" id="update_payable_amount" name="payable_amount" placeholder="Select a payment type">
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

</div>
<!-- /Main Wrapper -->


<script>

    $(document).ready(function() {

        

        // Filter Values
        // -------------------

        // default values
        $('#search_field').val( "{{request()->input('search')}}");
        $('#start_date_filter').val( "{{request()->input('start_date')}}");
        $('#end_date_filter').val( "{{request()->input('end_date')}}");
        $('#status_filter').val( "{{request()->input('status')}}");


        function updateUrlAndFilter() {
            var searchVal = $('#search_field').val();
            var startDate = $('#start_date_filter').val();
            var endDate = $('#end_date_filter').val();
            var status = $('#status_filter').val();

            var url = "./payments?search=" + searchVal + "&start_date=" + startDate + "&end_date=" + endDate + "&status=" + status;
            window.location.href = url;
        }
        
        // Search
        
        $('#search_button').click(function() {
            updateUrlAndFilter();
        });

        $('#search_field').change(function() {
            updateUrlAndFilter();
        });

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

        // -------------------
        // Student Selection
        // SELECT 2
        $('#select_student_id').select2({
            dropdownParent: $("#add_payment"),
            minimumInputLength: 0,
            width: '100%',
            ajax: {
                url: '{{ route("search-students") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });

        $('#update_select_student_id').select2({
            dropdownParent: $("#edit_payment"),
            minimumInputLength: 0,
            width: '100%',
            ajax: {
                url: '{{ route("search-students") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });

        $('#select_student_id').on('select2:selecting', function(e) {
            var selectedStudentId = e.params.args.data.id;
            var selectedCourseId = e.params.args.data.course;

            var paymentTypeSelect = $('#select_paymenttype_id');
            var paymentTypes = {!! json_encode($paymenttypes) !!};
            
            // Reset payment type options
            paymentTypeSelect.val('');
            paymentTypeSelect.empty().append('<option value="">Select payment type</option>');
            
            if (selectedStudentId !== '') {
                $.each(paymentTypes, function(index, paymentType) {
                    if (paymentType.course_id == selectedCourseId) {
                        paymentTypeSelect.append('<option amount="' + paymentType.payable_amount + '" value="' + paymentType.id + '">' + paymentType.course.name + ' | ' + paymentType.name + '</option>');
                    }
                });
                // console.log(paymentTypeSelect);
            }
        });
        
        // Payment Type Selection
        $('#select_paymenttype_id').change(function() {
            // Get the selected value
            const paymenttype_id = $(this).val();
            const payable_amount = $('option:selected', this).attr('amount');;
            
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

        // update student selecetion
        $('#update_select_student_id').on('select2:selecting', function(e) {
            var selectedStudentId = e.params.args.data.id;
            var selectedCourseId = e.params.args.data.course;

            var paymentTypeSelect = $('#update_select_paymenttype_id');
            var paymentTypes = {!! json_encode($paymenttypes) !!};
            
            // Reset payment type options
            paymentTypeSelect.val('');
            paymentTypeSelect.empty().append('<option value="">Select payment type</option>');
            
            if (selectedStudentId !== '') {
                $.each(paymentTypes, function(index, paymentType) {
                    if (paymentType.course_id == selectedCourseId) {
                        paymentTypeSelect.append('<option amount="' + paymentType.payable_amount + '" value="' + paymentType.id + '">' + paymentType.course.name + ' | ' + paymentType.name + '</option>');
                    }
                });
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

    // Edit Button Click
    $(document).on('click', '#update-payment-btn', function() {
        
        
        let payment  =  $(this).data('payment');
        var id = $(this).data('id');

        var selectedStudentId;
        var selectedCourseId;


        $('#edit_payment form').prop('action', 'payments/' +  id);

        // Select Student ---------------------------------------
        var studentSelect = $('#update_select_student_id');
        $.ajax({
            type: 'GET',
            url: '/students/search?q=' + payment.student.id,
        }).then(function (data) {
            // create the option and append to Select2
            var option = new Option(data.results[0].text, data.results[0].id);
            option.setAttribute('course', data.results[0].course);
            option.setAttribute('selected', true);

            selectedStudentId = data.results[0].id;
            selectedCourseId = data.results[0].course;

            studentSelect.append(option).trigger('change');
            studentSelect.val(data.results[0].id).trigger('change');
        // });

            // Update payment type options ---------------------------------------
            var paymentTypeSelect = $('#update_select_paymenttype_id');
            var paymentTypes = {!! json_encode($paymenttypes) !!};
            
            // Reset payment type options
            paymentTypeSelect.val('');
            paymentTypeSelect.empty().append('<option value="">Select payment type</option>');
            
            if (selectedStudentId !== '') {
                $.each(paymentTypes, function(index, paymentType) {
                    if (paymentType.course_id == selectedCourseId) {
                        paymentTypeSelect.append('<option amount="' + paymentType.payable_amount + '" value="' + paymentType.id + '">' + paymentType.course.name + ' | ' + paymentType.name + '</option>');
                    }
                });
            }


            // Other values ---------------------------------------
            $('#update_select_paymenttype_id').val(payment.paymenttype.id);
            $('#update_payable_amount').val(payment.payable_amount);
            $('#update_amount_payed').val(payment.amount_payed);
            $('#update_due_amount').val(payment.due_amount);
            $('#update_payment_date').val(payment.payment_date);
            $('#update_payment_status').val(payment.payment_status);


        });
    });
</script> 

{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection