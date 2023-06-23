@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
               
                @component('components.breadcrumb')                
                  @slot('title') Institutes  @endslot
                  @slot('li_1') Dashboard @endslot
                  @slot('li_2') Institutes @endslot
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
                                        <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-institute" data-bs-toggle="modal" data-bs-target="#add_institute">New Institute</button>
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
                                                <x-th>Name</x-th>
                                                <x-th>Type</x-th>
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

                                            @foreach($insitutes as $insitute)
                                            <tr>
                                                <td ><p>{{$insitute->id}}</p></td>
                                                <x-td><p>{{$insitute->name}}</p></x-td>

                                                <x-td><p>{{$insitute->type}}</p></x-td>

                                                <x-td><p>{{ date('M j, Y g:i A', strtotime($insitute->created_at)) }}</p></x-td>

                                                <x-td><p>{{ date('M j, Y g:i A', strtotime($insitute->updated_at)) }}</p></x-td>
                                                
                                                <x-td>
                                                    <div >
                                                        <button class="btn btn-info btn-sm" id="update-institute-btn" data-bs-toggle="modal" data-bs-target="#update_institute" data-id="{{ $insitute->id }}" data-row="{{$insitute}}"><span class="text-white">Edit</span></button>
                                                        <button class="btn btn-danger btn-sm" id="delete-institute-btn" data-bs-toggle="modal" data-bs-target="#delete_institute" data-id="{{ $insitute->id }}">Delete</button>
                                                    
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

    {{-- ADD INSTITUTION MODAL --}}

    <div class="modal fade" id="add_institute" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <button type="button"class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Add Institution</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('institutes') }}">
                                @csrf
                                <h4>Institution Details</h4>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Institution Name <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="name" placeholder="Institution Name">
                                    </div>

                                    @error('company')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    
                                </div>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Type <span class="text-danger">*</span></label>
                                        <select required class="form-control form-select" name="type" id="type">
                                            <option value="Combine">Combine</option>
                                            <option value="Girls">Girls</option>
                                            <option value="Boys">Boys</option>
                                        </select>
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


    {{-- UPDATE INSTITUTION MODAL --}}
    <div class="modal fade" id="update_institute" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Update Institution</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST">
                                @csrf
                                @method('PUT')
                                <h4>Institution Details</h4>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Institution Name <span class="text-danger">*</span></label>
                                        <input required class="form-control" type="text" name="name" id="update_name" placeholder="Institution Name">
                                    </div>

                                    @error('company')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    
                                </div>
                                <div class="form-group row">
                                    <div >
                                        <label class="col-form-label">Type <span class="text-danger">*</span></label>
                                        <select required class="form-control form-select" name="type" id="update_type">
                                            <option value="Girls">Girls</option>
                                            <option value="Boys">Boys</option>
                                            <option value="Combine">Combine</option>
                                        </select>
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


    {{-- DELETE INSTITUTION MODAL --}}
    <div class="modal fade" id="delete_institute" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <button type="button" class="btn-close md-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete Institution</h4>
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
            $('#update-institute-btn').click(function() {
                var id = $(this).data('id'); // Get the ID of the selected institution                
                $('#update_institute form').prop('action', 'institutes/' +  id);

                var row  = $(this).data('row');
                $('#update_name').val(row.name);
                $('#update_type').val(row.type);
            });

            $('#delete-institute-btn').click(function() {
                var id = $(this).data('id'); // Get the ID of the selected institution                
                $('#delete_institute form').prop('action', 'institutes/' +  id);
            });
        });
    </script>   


{{-- @component('components.theme-settings')                
@endcomponent --}}
@endsection