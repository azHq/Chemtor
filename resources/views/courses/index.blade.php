@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
               
                @component('components.breadcrumb')                
                  @slot('title') Programs  @endslot
                  @slot('li_1') Dashboard @endslot
                  @slot('li_2') Programs @endslot
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
                                        <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-class" data-bs-toggle="modal" data-bs-target="#add_class">New Program</button>
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
                                        <thead>
                                            <tr>
                                                <th >ID</th>

                                                {{-- <th class="text-center">Name</th> --}}
                                                <x-th>Name</x-th>
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

                                            @foreach($courses as $course)
                                            <tr>
                                                <td ><p>{{$course->id}}</p></td>
                                                <x-td><p>{{$course->name}}</p></x-td>

                                                <x-td><p>{{$course->created_at}}</p></x-td>

                                                <x-td><p>{{$course->updated_at}}</p></x-td>
                                                
                                                <x-td>
                                                    <div>
                                                        <button type="button" class="btn btn-info btn-sm" id="update-class-btn" data-bs-toggle="modal" data-bs-target="#update_class" data-id="{{ $course->id }}" data-row="{{$course}}"><span class="text-white"> Edit</span></button>
                                                        <button type="button" class="btn btn-danger btn-sm" id="delete-class-btn" data-bs-toggle="modal" data-bs-target="#delete_class" data-id="{{ $course->id }}">Delete</button>
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

    {{-- ADD CLASS MODAL --}}
    <div class="modal fade" id="add_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Add Program</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('courses') }}">
                                @csrf
                                <h4>Program Details</h4>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Program Name <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="name" placeholder="Program Name">
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

    {{-- UPDATE CLASS MODAL --}}
    <div class="modal fade" id="update_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Update Program</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('courses') }}">
                                @csrf
                                @method("PUT")
                                <h4>Program Details</h4>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Program Name <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="update_name" placeholder="Program Name">
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

    {{-- DELETE CLASS MODAL --}}
    <div class="modal fade" id="delete_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete Program</h4>
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
            // Handle click event of the "Edit" button
            
            $(document).on('click', '#update-class-btn', function() {
                var id = $(this).data('id'); // Get the ID of the selected institution
                $('#update_class form').prop('action', 'courses/' +  id);

                var row  = $(this).data('row');
                $('#update_name').val(row.name);
            });

            // Handle click event of the "Delete" button
            $(document).on('click', '#delete-class-btn', function() {
                var id = $(this).data('id'); // Get the ID of the selected institution
                $('#delete_class form').prop('action', 'courses/' +  id);
            });
        });
    </script> 



{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection