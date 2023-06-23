<?php $page="pagee";?>
@extends('layout.mainlayout')
@section('content')		
	<!-- Script -->
	<!-- Page Wrapper -->
	<div class="page-wrapper">

		<style>
			.pointer {
				cursor: pointer
			}
		</style>
	    <div class="content container-fluid">
			
			@component('components.breadcrumb')                
		      @slot('title') Dashboard  @endslot
		      @slot('li_1') Dashboard @endslot
		      @slot('li_2') Dashboard @endslot
		      @slot('li_3') <i class="la la-table" aria-hidden="true"></i> @endslot
		  	@endcomponent
			{{-- Filters --}}

			
				<div class="mb-4">
					<div class="row justify-content-start">

						{{-- Month --}}
						<div class="col-md-3">
							<label>From </label>
							<select id="month_from" class="form-control">
								<option value="00">Select Month</option>
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
						</div>

						{{-- Year --}}
						<div class="col-md-3">
							<label> </label>
							<select id="year_from" class="form-control ">
								<option value="00">Select Year</option>
								@for ($year = 2023; $year >= 2020; $year--)
									<option value="{{ $year }}">{{ $year }}</option>
								@endfor
							</select>
						</div>
						{{-- Month --}}
						<div class="col-md-3">
							<label>To </label>
							<select id="month_to" class="form-control">
								<option value="00">Select Month</option>
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
						</div>

						{{-- Year --}}
						<div class="col-md-3">
							<label> </label>
							<select id="year_to" class="form-control ">
								<option value="00">Select Year</option>
								@for ($year = 2023; $year >= 2020; $year--)
									<option value="{{ $year }}">{{ $year }}</option>
								@endfor
							</select>
						</div>

						{{-- Other Filter --}}
						
					</div>
				</div>

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
								<label for="course_filter">Filter by Class</label>
								<select id="course_filter" class="form-select">
									<option value="">All Classes</option>
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
							
							{{-- Fee --}}
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



			{{-- Payment Information --}}
			  <div class="row">
				{{-- studentCount --}}
				<div class="col-xl-3 col-sm-6 col-12">
					<a href="/students?course={{request('course')}}&institute={{request('institute')}}&batch={{request('batch')}}&version={{request('version')}}&gender={{request('gender')}}&fee={{request('fee')}}"> 
					<div class="card inovices-card pointer">
						<div class="card-body">
							<div class="inovices-widget-header">
								<span class="inovices-widget-icon">
									<img style="opacity: 0.3;" src="{{ URL::asset('/assets/img/icons/user-icon.svg')}}" alt="">
								</span>
								<div class="inovices-dash-count mr-2">
									<div class="inovices-amount">{{$studentCount}}</div>
								</div>
							</div>
							<p class="inovices-all">Total Student</p>
						</div>
					</div>
					</a>
				</div>

				{{-- Total payment --}}
				<div class="col-xl-3 col-sm-6 col-12 ">
					<a href="/students?course={{request('course')}}&institute={{request('institute')}}&batch={{request('batch')}}&version={{request('version')}}&gender={{request('gender')}}&fee={{request('fee')}}"> 
					<div class="card inovices-card pointer">
						<div class="card-body">
							<div class="inovices-widget-header">
								<span class="inovices-widget-icon">
									<img src="{{ URL::asset('/assets/img/icons/invoices-icon3.svg')}}" alt="">
								</span>
								<div class="inovices-dash-count">
									<div class="inovices-amount">{{number_format($totalPayment, 0, '.', ',')}}</div>
								</div>
							</div>
							<p class="inovices-all">Total Payment</p>
						</div>
					</div>
					</a>
				</div>

				{{-- Due Payment --}}
				<div class="col-xl-3 col-sm-6 col-12">
					<a href="/students?course={{request('course')}}&institute={{request('institute')}}&batch={{request('batch')}}&version={{request('version')}}&gender={{request('gender')}}&fee={{request('fee')}}">  
					<div class="card inovices-card pointer">
						<div class="card-body">
							<div class="inovices-widget-header">
								<span class="inovices-widget-icon">
									<img src="{{ URL::asset('/assets/img/icons/invoices-icon4.svg')}}" alt="">
								</span>
								<div class="inovices-dash-count">
									<div class="inovices-amount">
										{{number_format($totalDuePayment, 0, '.', ',')}}
									</div>
								</div>
							</div>
							<p class="inovices-all">Total Due</p>
						</div>
					</div>
					</a>
				</div>

				{{-- Subtotal --}}
				<div class="col-xl-3 col-sm-6 col-12">
					<a href="/students?course={{request('course')}}&institute={{request('institute')}}&batch={{request('batch')}}&version={{request('version')}}&gender={{request('gender')}}&fee={{request('fee')}}"> 
					<div class="card inovices-card pointer">
						<div class="card-body">
							<div class="inovices-widget-header">
								<span class="inovices-widget-icon">
									<img src="{{ URL::asset('/assets/img/icons/invoices-icon1.svg')}}" alt="">
								</span>
								<div class="inovices-dash-count">
									<div class="inovices-amount">
										{{number_format($totalDuePayment + $totalPayment, 0, '.', ',')}}
									</div>
								</div>
							</div>
							<p class="inovices-all">Subtotal</p>
						</div>
					</div>
					</a>
				</div>
			</div>

			{{-- Payment Chart --}}
			{{-- <div class="row graphs">
				<div class="col-md-6"> 
					<div class="card h-100">
	                    <div class="card-body">
	                      <h3 class="card-title">Payment per Class</h3>
	                      <canvas id="payment-per-course-chart" width="800" height="550"></canvas>
	                    </div>
	                </div>
				</div>
				<div class="col-md-6"> 
					<div class="card h-100">
	                    <div class="card-body">
	                      <h3 class="card-title">Due per Class</h3>
	                      <canvas id="due-per-course-chart" width="800" height="550"></canvas>
	                    </div>
	                </div>
				</div>
			</div> --}}
			
			

			{{-- Class Information --}}
			{{-- <div class="row">
				<div class="col-xl-3 col-sm-6 col-12">
					<a href="/students"> 
					<div class="card inovices-card pointer">
						<div class="card-body">
							<div class="inovices-widget-header">
								<span class="inovices-widget-icon">
									<img src="{{ URL::asset('/assets/img/icons/invoices-icon1.svg')}}" alt="">
								</span>
								<div class="inovices-dash-count mr-2">
									<div class="inovices-amount">{{$studentCount}}</div>
								</div>
							</div>
							<p class="inovices-all">Total Student</p>
						</div>
					</div>
					</a>
				</div>

				<div class="col-xl-3 col-sm-6 col-12">
					<a href="/courses"> 

					<div class="card inovices-card pointer">
						<div class="card-body">
							<div class="inovices-widget-header">
								<span class="inovices-widget-icon">
									<img src="{{ URL::asset('/assets/img/icons/invoices-icon2.svg')}}" alt="">
								</span>
								<div class="inovices-dash-count">
									<div class="inovices-amount">{{$courseCount}}</div>
								</div>
							</div>
							<p class="inovices-all">Total Classes</p>
						</div>
					</div>
					</a>
				</div>
			</div> --}}
			
			{{-- Class Chart --}}
			<div class="row graphs">
				<div class="col-md-6"> 
					<div class="card h-100">
	                    <div class="card-body">
	                      <h3 class="card-title">Total students per Class</h3>
	                      <canvas id="student-per-course-chart" width="800" height="550"></canvas>
	                    </div>
	                </div>
				</div>
				<div class="col-md-6"> 
					<div class="card h-100">
	                    <div class="card-body">
	                      <h3 class="card-title">Total students per Institute</h3>
	                      <canvas id="student-per-institution-chart" width="800" height="550"></canvas>
	                    </div>
	                </div>
				</div>
			</div>
			

			
			
		</div>			
	</div>
	<!-- /Page Wrapper -->

	<!-- Script -->
<script>
	$(document).ready(function() {
        // Retrieve data from PHP and convert it to JavaScript variables
        const labels = {!! json_encode($student_per_course_labels) !!};
        const data = {!! json_encode($student_per_course_data) !!};

        // Create a bar chart using Chart.js
        const ctx = document.getElementById("student-per-course-chart").getContext("2d");
        const studentPerCoursechart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Total Students",
                        data: data,
						backgroundColor: [
							"#fe7096",
							"#9a55ff",
							"#fe7096",
							"#e8c3b9",
							"#9a55ff",
							"#f5a5a5",
							"#5d6d7e",
							"#f8d7da",
							"#c3e6cb",
							"#dbe9ff",
							"#ffd2d2",
							"#bfc9ca",
							"#ffd9b3",
							"#f0e8e8",
							"#ffe6cc",
							"#c8d6e5",
							"#f9d9d9",
							"#b2bec3",
							"#fff2cc",
							"#e8f0fe"
						],
                    },
                ],
            },
            options: {
                legend: { display: false },
                title: {
                    display: false,
                    text: "Students per Course",
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 1,
						maxTicksLimit: 1
                    },
                },
            },
        });


		const institutes_labels = {!! json_encode($student_per_institute_labels) !!};
        const institutes_data = {!! json_encode($student_per_institute_data) !!};
		
		const institutionCtx = document.getElementById("student-per-institution-chart").getContext("2d");
        const studentPerInstitutionchart = new Chart(institutionCtx, {
            type: "bar",
            data: {
                labels: institutes_labels,
                datasets: [
                    {
                        label: "Total Students",
                        data: institutes_data,
						backgroundColor: [
							"#fe7096",
							"#9a55ff",
							"#fe7096",
							"#e8c3b9",
							"#9a55ff",
							"#f5a5a5",
							"#5d6d7e",
							"#f8d7da",
							"#c3e6cb",
							"#dbe9ff",
							"#ffd2d2",
							"#bfc9ca",
							"#ffd9b3",
							"#f0e8e8",
							"#ffe6cc",
							"#c8d6e5",
							"#f9d9d9",
							"#b2bec3",
							"#fff2cc",
							"#e8f0fe"
						],
                    },
                ],
            },
            options: {
                legend: { display: false },
                title: {
                    display: false,
                    text: "Students per Institution",
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 1,
						maxTicksLimit: 1
                    },
                },
            },
        });
        
		
		
		

    });


	// Filter Default Data
	$(document).ready(function() {
		var urlParams = new URLSearchParams(window.location.search);

		// Filter Values
		$('#institute_filter').val({{ request()->input('institute') }});
		$('#course_filter').val({{ request()->input('course') }});
		$('#batch_filter').val({{ request()->input('batch') }});
		$('#version_filter').val("{{ request()->input('version') }}");
		$('#gender_filter').val("{{ request()->input('gender') }}");
		// $('#due_filter').val("{{request()->input('due')}}");
		$('#fee_filter').val({{ request()->input('fee') }});
		
		var fromMonth = urlParams.get('fromMonth');
		var fromYear = urlParams.get('fromYear');

		var toMonth = urlParams.get('toMonth');
		var toYear = urlParams.get('toYear');


		var defaultFromMonth = '';
		var defaultToMonth = '';
	


		if (fromMonth) {
			defaultFromMonth = fromMonth;
		} else {
			var currentDate = new Date();
			defaultFromMonth = (new Date().getMonth() + 1).toString().padStart(2, '0'); // Add leading zero if necessary
		}

		if (toMonth) {
			defaultToMonth = toMonth;
		} else {
			var currentDate = new Date();
			defaultToMonth = (new Date().getMonth() + 1).toString().padStart(2, '0');// Add leading zero if necessary
		}

		console.log(defaultFromMonth, defaultToMonth);

		document.getElementById('month_from').value = defaultFromMonth;
		document.getElementById('month_to').value = defaultToMonth;

		var defaultFromYear = '';
		var defaultToYear = '';
	
		if (fromYear) {
			defaultFromYear = fromYear;
		} else {
			defaultFromYear = currentDate.getFullYear(); // Get current year
		}

		if (toYear) {
			defaultToYear = toYear;
		} else {
			defaultToYear = currentDate.getFullYear(); // Get current year
		}

		document.getElementById('year_from').value = defaultFromYear;
		document.getElementById('year_to').value = defaultToYear;
	});

	function updateUrlAndFilter() {
		var fromMonth = $('#month_from').val();
		var fromYear = $('#year_from').val();
		var toMonth = $('#month_to').val();
		var toYear = $('#year_to').val();

		var selectedInstituteId = $('#institute_filter').val();
		var selectedCourseId = $('#course_filter').val();
		var selectedBatchId = $('#batch_filter').val();
		var selectedVersion = $('#version_filter').val();
		var selectedGender = $('#gender_filter').val();
		var selectedDueFilter = $('#due_filter').val();
		var selectedFeeFilter = $('#fee_filter').val();

		var url = "./index?fromMonth=" + fromMonth + "&fromYear=" + fromYear + "&toMonth=" + toMonth + "&toYear=" + toYear + "&course=" + selectedCourseId + "&institute=" + selectedInstituteId + "&batch=" + selectedBatchId + "&version=" + selectedVersion + "&gender=" + selectedGender + "&due=" + selectedDueFilter + "&fee=" + selectedFeeFilter;;
		window.location.href = url;
	}
	
	// Fitler
	
	$('#month_from').change(function() {
		updateUrlAndFilter();
	});
	$('#year_from').change(function() {
		updateUrlAndFilter();
	});

	$('#month_to').change(function() {
		updateUrlAndFilter();
	});
	$('#year_to').change(function() {
		updateUrlAndFilter();
	});
	// Course Filter
	$('#course_filter').change(function() {
            updateUrlAndFilter();
               
        });

        // Instititue Filter
        $('#institute_filter').change(function() {
            updateUrlAndFilter();
               
        });

        // Batch Filter
        $('#batch_filter').change(function() {
            updateUrlAndFilter();
        });

        // Version Filter
        $('#version_filter').change(function() {
            updateUrlAndFilter();
               
        });

        // Gender Filter
        $('#gender_filter').change(function() {
            updateUrlAndFilter();
        });

        // Due Filter
        // $('#due_filter').change(function() {
        //     updateUrlAndFilter();
        // });

        // Fee Filter
        $('#fee_filter').change(function() {
            updateUrlAndFilter();
        });
</script>
	

</div>
{{-- @component('components.modal-popup')                
@endcomponent --}}
{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection


{{-- 
	
// // ------------- Payment Per Course -----------------
		// const payments_labels = {!! json_encode($payment_per_course_labels) !!};
        // const payments_data = {!! json_encode($payment_per_course_data) !!};
		
		// const paymentCtx = document.getElementById("payment-per-course-chart").getContext("2d");
        // const paymentPerCoursechart = new Chart(paymentCtx, {
        //     type: "bar",
        //     data: {
        //         labels: payments_labels,
        //         datasets: [
        //             {
        //                 label: "Total payment",
        //                 data: payments_data,
		// 				backgroundColor: [
		// 					"#fe7096",
		// 					"#9a55ff",
		// 					"#fe7096",
		// 					"#e8c3b9",
		// 					"#9a55ff",
		// 					"#f5a5a5",
		// 					"#5d6d7e",
		// 					"#f8d7da",
		// 					"#c3e6cb",
		// 					"#dbe9ff",
		// 					"#ffd2d2",
		// 					"#bfc9ca",
		// 					"#ffd9b3",
		// 					"#f0e8e8",
		// 					"#ffe6cc",
		// 					"#c8d6e5",
		// 					"#f9d9d9",
		// 					"#b2bec3",
		// 					"#fff2cc",
		// 					"#e8f0fe"
		// 				],
        //             },
        //         ],
        //     },
        //     options: {
        //         legend: { display: false },
        //         title: {
        //             display: false,
        //             text: "Payment per class",
        //         },
        //         scales: {
        //             y: {
        //                 beginAtZero: true,
        //                 precision: 1,
		// 				maxTicksLimit: 1
        //             },
        //         },
        //     },
        // });


		// // ------------- Due Per Course -----------------
		// const due_labels = {!! json_encode($due_per_course_labels) !!};
        // const due_data = {!! json_encode($due_per_course_data) !!};
		
		// const dueCtx = document.getElementById("due-per-course-chart").getContext("2d");
        // const duePerCoursechart = new Chart(dueCtx, {
        //     type: "bar",
        //     data: {
        //         labels: due_labels,
        //         datasets: [
        //             {
        //                 label: "Total Due",
        //                 data: due_data,
		// 				backgroundColor: [
		// 					"#fe7096",
		// 					"#9a55ff",
		// 					"#fe7096",
		// 					"#e8c3b9",
		// 					"#9a55ff",
		// 					"#f5a5a5",
		// 					"#5d6d7e",
		// 					"#f8d7da",
		// 					"#c3e6cb",
		// 					"#dbe9ff",
		// 					"#ffd2d2",
		// 					"#bfc9ca",
		// 					"#ffd9b3",
		// 					"#f0e8e8",
		// 					"#ffe6cc",
		// 					"#c8d6e5",
		// 					"#f9d9d9",
		// 					"#b2bec3",
		// 					"#fff2cc",
		// 					"#e8f0fe"
		// 				],
        //             },
        //         ],
        //     },
        //     options: {
        //         legend: { display: false },
        //         title: {
        //             display: false,
        //             text: "Due per class",
        //         },
        //         scales: {
        //             y: {
        //                 beginAtZero: true,
        //                 precision: 1,
		// 				maxTicksLimit: 1
        //             },
        //         },
        //     },
        // });	
--}}
