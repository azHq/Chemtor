@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
               
                @component('components.breadcrumb')                
                  @slot('title') New Student  @endslot
                  @slot('li_1') Dashboard @endslot
                  @slot('li_2') Students @endslot
                  @slot('li_3') <i class="feather-check-square"></i> @endslot
                @endcomponent

                {{-- CREATE NEW STUDENT FORM --}}
                <div class="mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{route('students_store')}}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Name  <x-field-required /> </label>
                                        <input required type="text" class="form-control"  name="name" placeholder="Student's Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Profile Image</label>
                                        <input type="file" class="form-control"  name="profile_image">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Phone <x-field-required /></label>
                                        <input required type="text" class="form-control"  name="phone_number" placeholder="Student's Phone Number">
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Email</label>
                                        <input type="email" class="form-control"  name="email" placeholder="Student's Email">
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Parent's Name</label>
                                        <input type="text" class="form-control"  name="parents_name" placeholder="Parent's Name">
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Parent's Number</label>
                                        <input type="text" class="form-control"  name="parents_number" placeholder="Parent's Phone Number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Institution <x-field-required /></label>
                                        <select required class=" form-control form-select" name="institute_id">
                                            @foreach($institutes as $institute)
                                            <option value="{{$institute->id}}">{{$institute->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-sm-6">
                                        <label class="col-form-label">Class <x-field-required /></label>
                                        <select required class=" form-control form-select" name="course_id">
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Gender <x-field-required /></label>
                                        <select required class=" form-control form-select" name="gender">
                                            
                                            <option> Male</option>
                                            <option> Female</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Version <x-field-required /></label>
                                        <select required class=" form-control form-select" name="version">
                                            
                                            <option> Bangla</option>
                                            <option> English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Blood Group</label>
                                        <select class=" form-control form-select" name="blood_group">
                                            
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
                                        <select required class=" form-control form-select" name="status">
                                            
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



                    
                
            </div>
            <!-- /Page Content -->
            
        </div>
        <!-- /Page Wrapper -->
        
    </div>
    <!-- /Main Wrapper -->

    {{-- ADD CLASS MODAL --}}
    <div class="modal fade" id="add_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Add Class</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('courses') }}">
                                @csrf
                                <h4>Class Details</h4>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Class Name <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="name" placeholder="Class Name">
                                    </div>

                                    @error('company')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    
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



{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection