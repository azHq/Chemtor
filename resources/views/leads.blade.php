@extends('layout.mainlayout')
@section('content')		
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
                
                @component('components.breadcrumb')                
                  @slot('title') Leads  @endslot
                  @slot('li_1') Dashboard @endslot
                  @slot('li_2') Leads @endslot
                  @slot('li_3') <i class="feather-user"></i> @endslot
                @endcomponent
                <div class="page-header pt-3 mb-0 ">
                    <div class="row">
                        <div class="col">

                            <div class="dropdown">
                                <a class="dropdown-toggle recently-viewed" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> All Leads</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Recently Viewed</a>
                                    <a class="dropdown-item" href="#">Items I'm following</a>
                                    <a class="dropdown-item" href="#">All Leads</a>
                                    <a class="dropdown-item" href="#">All Closed Leads</a>
                                    <a class="dropdown-item" href="#">All Open Leads</a>
                                    <a class="dropdown-item" href="#">Converted Leads</a>
                                    <a class="dropdown-item" href="#">My Open Leads</a>
                                    <a class="dropdown-item" href="#">Todays Leads</a>
                                </div>
                            </div>
                        </div>
                        <div class="col text-end">
                            <ul class="list-inline-item pl-0">
                                
                                <li class="dropdown list-inline-item add-lists">
                                    <a class="dropdown-toggle recently-viewed pe-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                                        <div class="nav-profile-text">
                                          <i class="fa fa-cog" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Choose Columns</a>
                                        <a class="dropdown-item" href="#">Group Columns</a>
                                        <a class="dropdown-item" href="#">Sharing Settings</a>
                                        <a class="dropdown-item" href="#">Rename</a>
                                        <a class="dropdown-item" href="#">Clone</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </li>
                                <li class="dropdown list-inline-item add-lists">
                                    <a class="dropdown-toggle recently-viewed pe-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                                        <div class="nav-profile-text">
                                          <i class="fa fa-th" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="leads">List View</a>
                                        <a class="dropdown-item" href="leads-kanban-view">Kanban View</a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add-new-list">Add New List View</a>
                                    </div>
                                </li>
                                
                                <li class="list-inline-item">
                                    <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-bs-toggle="modal" data-bs-target="#add_lead">New Lead</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Content Starts -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="container-checkbox">
                                                          <input type="checkbox">
                                                          <span class="checkmark"></span>
                                                    </label>
                                                </th>
                                                <th>Full Name</th>
                                                <th>Title</th>
                                                <th>Company</th>
                                                <th>Phone</th>
                                                <th>Email Address</th>
                                                <th>Lead Status</th>
                                                <th>Lead Created</th>
                                                <th>Lead Owner</th>
                                                <th></th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="checkBox">
                                                    <label class="container-checkbox">
                                                          <input type="checkbox">
                                                          <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#"><span class="person-circle-a person-circle">A</span></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#leads-details">Anne Lynch</a>
                                                </td>
                                                <td>VP of Sales	</td>
                                                <td>
                                                     Umbrella		
                                                </td>
                                                <td>(406) 653-3860</td>
                                                <td>abc@gmail.com</td>
                                                <td>OPEN - NotContacted	</td>
                                                <td>03-Jun-20 1:14 AM</td>
                                                <td>John Doe</td>
                                                <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Edit This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Lead Image</a>
                                                            <a class="dropdown-item" href="#">Delete This Lead</a>
                                                            <a class="dropdown-item" href="#">Email This Lead</a>
                                                            <a class="dropdown-item" href="#">Clone This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Record Owner</a>
                                                            <a class="dropdown-item" href="#">Generate Merge Document</a>
                                                            <a class="dropdown-item" href="#">Change Lead to Contact</a>
                                                            <a class="dropdown-item" href="#">Convert Lead</a>
                                                            <a class="dropdown-item" href="#">Print This Lead</a>
                                                            <a class="dropdown-item" href="#">Merge Into Lead</a>
                                                            <a class="dropdown-item" href="#">SmartMerge Lead</a>
                                                            <a class="dropdown-item" href="#">Add Activity Set To Lead</a>
                                                            <a class="dropdown-item" href="#">Add New Event For Lead</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="checkBox">
                                                    <label class="container-checkbox">
                                                          <input type="checkbox">
                                                          <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#"><span class="person-circle-b person-circle">B</span></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#leads-details">Benneth</a>
                                                </td>
                                                <td>VP of Sales	</td>
                                                <td>
                                                    Acme Corporation		
                                                </td>
                                                <td>(406) 653-3860</td>
                                                <td>abc@gmail.com</td>
                                                <td>OPEN - NotContacted	</td>
                                                <td>03-Jun-20 1:14 AM</td>
                                                <td>John Doe</td>
                                                <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Edit This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Lead Image</a>
                                                            <a class="dropdown-item" href="#">Delete This Lead</a>
                                                            <a class="dropdown-item" href="#">Email This Lead</a>
                                                            <a class="dropdown-item" href="#">Clone This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Record Owner</a>
                                                            <a class="dropdown-item" href="#">Generate Merge Document</a>
                                                            <a class="dropdown-item" href="#">Change Lead to Contact</a>
                                                            <a class="dropdown-item" href="#">Convert Lead</a>
                                                            <a class="dropdown-item" href="#">Print This Lead</a>
                                                            <a class="dropdown-item" href="#">Merge Into Lead</a>
                                                            <a class="dropdown-item" href="#">SmartMerge Lead</a>
                                                            <a class="dropdown-item" href="#">Add Activity Set To Lead</a>
                                                            <a class="dropdown-item" href="#">Add New Event For Lead</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="checkBox">
                                                    <label class="container-checkbox">
                                                          <input type="checkbox">
                                                          <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#"><span class="person-circle-c person-circle">C</span></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#leads-details">Cravo</a>
                                                </td>
                                                <td>VP of Sales	</td>
                                                <td>
                                                    Acme Corporation	
                                                </td>
                                                <td>(406) 653-3860</td>
                                                <td>abc@gmail.com</td>
                                                <td>OPEN - NotContacted	</td>
                                                <td>03-Jun-20 1:14 AM</td>
                                                <td>John Doe</td>
                                                <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Edit This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Lead Image</a>
                                                            <a class="dropdown-item" href="#">Delete This Lead</a>
                                                            <a class="dropdown-item" href="#">Email This Lead</a>
                                                            <a class="dropdown-item" href="#">Clone This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Record Owner</a>
                                                            <a class="dropdown-item" href="#">Generate Merge Document</a>
                                                            <a class="dropdown-item" href="#">Change Lead to Contact</a>
                                                            <a class="dropdown-item" href="#">Convert Lead</a>
                                                            <a class="dropdown-item" href="#">Print This Lead</a>
                                                            <a class="dropdown-item" href="#">Merge Into Lead</a>
                                                            <a class="dropdown-item" href="#">SmartMerge Lead</a>
                                                            <a class="dropdown-item" href="#">Add Activity Set To Lead</a>
                                                            <a class="dropdown-item" href="#">Add New Event For Lead</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="checkBox">
                                                    <label class="container-checkbox">
                                                          <input type="checkbox">
                                                          <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#"><span class="person-circle-c person-circle">C</span></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#leads-details">Cravo</a>
                                                </td>
                                                <td>VP of Sales	</td>
                                                <td>
                                                     Soylent Corp	
                                                </td>
                                                <td>(406) 653-3860</td>
                                                <td>abc@gmail.com</td>
                                                <td>OPEN - Contacted	</td>
                                                <td>03-Jun-20 1:14 AM</td>
                                                <td>John Doe</td>
                                                <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Edit This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Lead Image</a>
                                                            <a class="dropdown-item" href="#">Delete This Lead</a>
                                                            <a class="dropdown-item" href="#">Email This Lead</a>
                                                            <a class="dropdown-item" href="#">Clone This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Record Owner</a>
                                                            <a class="dropdown-item" href="#">Generate Merge Document</a>
                                                            <a class="dropdown-item" href="#">Change Lead to Contact</a>
                                                            <a class="dropdown-item" href="#">Convert Lead</a>
                                                            <a class="dropdown-item" href="#">Print This Lead</a>
                                                            <a class="dropdown-item" href="#">Merge Into Lead</a>
                                                            <a class="dropdown-item" href="#">SmartMerge Lead</a>
                                                            <a class="dropdown-item" href="#">Add Activity Set To Lead</a>
                                                            <a class="dropdown-item" href="#">Add New Event For Lead</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="checkBox">
                                                    <label class="container-checkbox">
                                                          <input type="checkbox">
                                                          <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#"><span class="person-circle-d person-circle">D</span></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#leads-details">Des Ignayshun</a>
                                                </td>
                                                <td>VP of Sales	</td>
                                                <td>
                                                    Howe-Blanda LLC		
                                                </td>
                                                <td>(406) 653-3860</td>
                                                <td>abc@gmail.com</td>
                                                <td>OPEN - Contacted	</td>
                                                <td>03-Jun-20 1:14 AM</td>
                                                <td>John Doe</td>
                                                <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Edit This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Lead Image</a>
                                                            <a class="dropdown-item" href="#">Delete This Lead</a>
                                                            <a class="dropdown-item" href="#">Email This Lead</a>
                                                            <a class="dropdown-item" href="#">Clone This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Record Owner</a>
                                                            <a class="dropdown-item" href="#">Generate Merge Document</a>
                                                            <a class="dropdown-item" href="#">Change Lead to Contact</a>
                                                            <a class="dropdown-item" href="#">Convert Lead</a>
                                                            <a class="dropdown-item" href="#">Print This Lead</a>
                                                            <a class="dropdown-item" href="#">Merge Into Lead</a>
                                                            <a class="dropdown-item" href="#">SmartMerge Lead</a>
                                                            <a class="dropdown-item" href="#">Add Activity Set To Lead</a>
                                                            <a class="dropdown-item" href="#">Add New Event For Lead</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="checkBox">
                                                    <label class="container-checkbox">
                                                          <input type="checkbox">
                                                          <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#"><span class="person-circle-j person-circle">J</span></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#leads-details">Jen Tile</a>
                                                </td>
                                                <td>VP of Sales	</td>
                                                <td>
                                                    Howe-Blanda LLC		
                                                </td>
                                                <td>(406) 653-3860</td>
                                                <td>abc@gmail.com</td>
                                                <td>OPEN - NotContacted	</td>
                                                <td>03-Jun-20 1:14 AM</td>
                                                <td>John Doe</td>
                                                <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Edit This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Lead Image</a>
                                                            <a class="dropdown-item" href="#">Delete This Lead</a>
                                                            <a class="dropdown-item" href="#">Email This Lead</a>
                                                            <a class="dropdown-item" href="#">Clone This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Record Owner</a>
                                                            <a class="dropdown-item" href="#">Generate Merge Document</a>
                                                            <a class="dropdown-item" href="#">Change Lead to Contact</a>
                                                            <a class="dropdown-item" href="#">Convert Lead</a>
                                                            <a class="dropdown-item" href="#">Print This Lead</a>
                                                            <a class="dropdown-item" href="#">Merge Into Lead</a>
                                                            <a class="dropdown-item" href="#">SmartMerge Lead</a>
                                                            <a class="dropdown-item" href="#">Add Activity Set To Lead</a>
                                                            <a class="dropdown-item" href="#">Add New Event For Lead</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="checkBox">
                                                    <label class="container-checkbox">
                                                          <input type="checkbox">
                                                          <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#"><span class="person-circle-j person-circle">J</span></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#leads-details">Jacob</a>
                                                </td>
                                                <td>Sales	</td>
                                                <td>
                                                    Blanda		
                                                </td>
                                                <td>(406) 653-3860</td>
                                                <td>abc@gmail.com</td>
                                                <td>OPEN - Contacted</td>
                                                <td>08-May-19 1:14 AM</td>
                                                <td>Anderson</td>
                                                <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Edit This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Lead Image</a>
                                                            <a class="dropdown-item" href="#">Delete This Lead</a>
                                                            <a class="dropdown-item" href="#">Email This Lead</a>
                                                            <a class="dropdown-item" href="#">Clone This Lead</a>
                                                            <a class="dropdown-item" href="#">Change Record Owner</a>
                                                            <a class="dropdown-item" href="#">Generate Merge Document</a>
                                                            <a class="dropdown-item" href="#">Change Lead to Contact</a>
                                                            <a class="dropdown-item" href="#">Convert Lead</a>
                                                            <a class="dropdown-item" href="#">Print This Lead</a>
                                                            <a class="dropdown-item" href="#">Merge Into Lead</a>
                                                            <a class="dropdown-item" href="#">SmartMerge Lead</a>
                                                            <a class="dropdown-item" href="#">Add Activity Set To Lead</a>
                                                            <a class="dropdown-item" href="#">Add New Event For Lead</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
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

@component('components.modal-popup')                
@endcomponent
@component('components.theme-settings')                
@endcomponent
@endsection