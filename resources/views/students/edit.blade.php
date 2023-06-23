@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
               
                @component('components.breadcrumb')                
                  @slot('title') Edit Student  @endslot
                  @slot('li_1') Dashboard @endslot
                  @slot('li_2') Students @endslot
                  @slot('li_3') <i class="feather-check-square"></i> @endslot
                @endcomponent

                {{-- CREATE NEW STUDENT FORM --}}
                <div class="mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{url('/students/'.$student->id."/update")}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Name  <x-field-required /> </label>
                                        <input required type="text" class="form-control"  name="name" placeholder="Student's Name" value="{{$student->name}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Profile Image</label>
                                        <input type="file" class="form-control"  name="profile_image">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Phone <x-field-required /></label>
                                        <input required type="text" class="form-control"  name="phone_number" placeholder="Student's Phone Number" value={{$student->phone_number}}>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Email</label>
                                        <input type="email" class="form-control"  name="email" placeholder="Student's Email" value={{$student->email}}>
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Parent's Name</label>
                                        <input type="text" class="form-control"  name="parents_name" placeholder="Parent's Name" value={{$student->parents_name}}>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Parent's Number</label>
                                        <input type="text" class="form-control"  name="parents_number" placeholder="Parent's Phone Number" value={{$student->parents_number}}>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Institution <x-field-required /></label>
                                        <select required class=" form-control form-select" name="institute_id">
                                            @foreach($institutes as $institute)
                                            <option {{$institute->id == $student->institute_id ? 'selected' : '' }} value="{{$institute->id}}">{{$institute->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-sm-6">
                                        <label class="col-form-label">Class <x-field-required /></label>
                                        <select required class=" form-control form-select" name="course_id">
                                            @foreach($courses as $course)
                                            <option {{$course->id == $student->course_id ? 'selected' : '' }} value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Gender <x-field-required /></label>
                                        <select required class=" form-control form-select" name="gender">
                                            
                                            <option {{$student->gender == 'Male' ? 'selected' : '' }} > Male</option>
                                            <option {{$student->gender == 'Female' ? 'selected' : '' }}> Female</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Version <x-field-required /></label>
                                        <select required class=" form-control form-select" name="version">
                                            
                                            <option {{$student->version == 'Bangla' ? 'selected' : '' }}> Bangla</option>
                                            <option {{$student->version == 'English' ? 'selected' : '' }}> English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Blood Group</label>
                                        <select class=" form-control form-select" name="blood_group">
                                            
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

                                    <div class="col-sm-6">
                                        <label class="col-form-label">Status <x-field-required /></label>
                                        <select required class=" form-control form-select" name="status">
                                            
                                            <option {{$student->status == 'Active' ? 'selected' : '' }}> Active</option>
                                            <option {{$student->status == 'Inactive' ? 'selected' : '' }}> Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="text-center py-3">
                                    <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update</button>
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



{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection