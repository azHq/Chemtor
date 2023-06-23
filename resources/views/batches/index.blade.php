@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
               
                @component('components.breadcrumb')                
                  @slot('title') Batches  @endslot
                  @slot('li_1') Dashboard @endslot
                  @slot('li_2') Batches @endslot
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
                                        <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-class" data-bs-toggle="modal" data-bs-target="#add_class">New Batch</button>
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
                                                <th class="d-none">ID</th>

                                                {{-- <th class="text-center">Name</th> --}}
                                                <x-th>Name</x-th>
                                                <x-th>Program</x-th>
                                                <x-th>Capacity</x-th>
                                                <x-th>Time</x-th>
                                                <x-th>Version</x-th>

                                                <x-th>Updated at</x-th>
                                                {{-- <th>Task Owner</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th> --}}
                                                <x-th>Actions</x-th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($batches as $batch)
                                            <tr>
                                                <td class="d-none"><p>{{$batch->id}}</p></td>
                                                <x-td><p>{{$batch->name}}</p></x-td>
                                                <x-td><p>{{$batch->course->name}}</p></x-td>
                                                <x-td><p>{{$batch->capacity}}</p></x-td>

                                                <x-td><p>{{$batch->batch_time}}</p></x-td>
                                                <x-td><p>{{$batch->version}}</p></x-td>


                                                <x-td><p>{{$batch->updated_at}}</p></x-td>
                                                
                                                <x-td>
                                                    <div>
                                                        <button type="button" class="btn btn-info btn-sm" id="update-class-btn" data-bs-toggle="modal" data-bs-target="#update_class" data-id="{{ $batch->id }}" data-row="{{$batch}}"><span class="text-white"> Edit</span></button>
                                                        <button type="button" class="btn btn-danger btn-sm" id="delete-class-btn" data-bs-toggle="modal" data-bs-target="#delete_class" data-id="{{ $batch->id }}">Delete</button>
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
                    <h4 class="modal-title text-center">Add Batch</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('batches') }}">
                                @csrf
                                <h4>Batch Details</h4>
                                <div class="form-group row">
                                    <div>
                                        <label class="col-form-label">Batch Name <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="name" placeholder="Batch Name">
                                    </div>

                                    <div class="col">
                                        <label class="col-form-label">Program <x-field-required /></label>
                                        <select required class=" form-control form-select" name="course_id">
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="col-form-label">Capacity </label>
                                        <input class="form-control" type="number" name="capacity" id="capacity" placeholder="Capacity">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Batch time </label>
                                        <input class="form-control" type="text" name="batch_time" id="batch_time" placeholder="Batch time" value="">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Version </label>
                                        <select class=" form-control form-select" name="version">
                                            <option value=""> Select Version</option>
                                            <option value="Bangla"> Bangla</option>
                                            <option value="English"> English</option>
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

    {{-- UPDATE BACTH MODAL --}}
    <div class="modal fade" id="update_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Update Batch</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('batches') }}">
                                @csrf
                                @method("PUT")
                                <h4>Batch Details</h4>
                                <div class="form-group row">
                                    <div>
                                        <label class="col-form-label">Batch Name <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="update_name" placeholder="Batch Name">
                                    </div>

                                    <div class="col">
                                        <label class="col-form-label">Program <x-field-required /></label>
                                        <select required class=" form-control form-select" name="course_id" id="update_course_id">
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="col-form-label">Capacity </label>
                                        <input class="form-control" type="number" name="capacity" id="update_capacity" placeholder="Capacity">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Batch time </label>
                                        <input class="form-control" type="text" name="batch_time" id="update_batch_time" placeholder="Batch time" value="">
                                    </div>

                                    <div>
                                        <label class="col-form-label">Version </label>
                                        <select class=" form-control form-select" name="version" id="update_version">
                                            <option value=""> Select Version</option>
                                            <option value="Bangla"> Bangla</option>
                                            <option value="English"> English</option>
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

    {{-- DELETE CLASS MODAL --}}
    <div class="modal fade" id="delete_class" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete Batch</h4>
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
                $('#update_class form').prop('action', 'batches/' +  id);

                var row  = $(this).data('row');
                $('#update_name').val(row.name);
                $('#update_course_id').val(row.course_id);
                $('#update_capacity').val(row.capacity);
                $('#update_batch_time').val(row.batch_time);
                $('#update_version').val(row.version);

            });

            // Handle click event of the "Delete" button
            $(document).on('click', '#delete-class-btn', function() {
                var id = $(this).data('id'); // Get the ID of the selected institution
                $('#delete_class form').prop('action', 'batches/' +  id);
            });
        });
    </script> 



{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection