<?php error_reporting(0);?>
@if(!Route::is(['email','mail-view','components']))
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
    	<form action="search" class="mobile-view">
			<input class="form-control" type="text" placeholder="Search here">
			<button class="btn" type="button"><i class="fa fa-search"></i></button>
		</form>
		<div id="sidebar-menu" class="sidebar-menu">

			<ul>
				<li class="nav-item nav-profile">
	              <a href="#" class="nav-link">
	                <div class="nav-profile-image">
	                  <img src="{{ URL::asset('/assets/img/profiles/admin-avatar.png')}}" alt="profile">
	                  
	                </div>
	                <div class="nav-profile-text d-flex flex-column">
						<span class="font-weight-bold">Admin</span>

	                  {{-- <span class="font-weight-bold mb-2">Admin</span> --}}
	                  {{-- <span class="text-white text-small">Project Manager</span> --}}
	                </div>
	                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
	              </a>
	            </li>
				
				{{-- <li class="submenu">
					<a href="#"><i class="feather-home"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
					<ul class="sub-menus">
						<li><a class="<?php if($page=="pagee") { echo 'active'; } ?>" href="{{url('index')}}">Deals Dashboard</a></li>
						<li><a class="<?php if($page=="projects-dashboard") { echo 'active'; } ?>" href="{{url('projects-dashboard')}}">Projects Dashboard</a></li>
						<li><a class="<?php if($page=="leads-dashboard") { echo 'active'; } ?>" href="{{url('leads-dashboard')}}">Leads Dashboard</a></li>
					</ul>
				</li> --}}

				<li><a class="<?php if($page=="pagee") { echo 'active'; } ?>" href="{{url('index')}}"><i class="feather-home"></i> <span>Dashboard</span></a></li>
				
				<li class="{{ Request::is('students') ? 'active' : '' }}"> 
					<a href="{{url('students')}}"><i class="feather-user"></i> <span>Students</span></a>
				</li>

				<li class="{{ Request::is('institutes') ? 'active' : '' }}"> 
					<a href="{{url('institutes')}}"><i class="feather-archive"></i> <span>Institutes</span></a>
				</li>

				<li class="{{ Request::is('courses') ? 'active' : '' }}"> 
					<a href="{{url('courses')}}"><i class="feather-check-square"></i> <span>Programs</span></a>
				</li>

				<li class="{{ Request::is('batches') ? 'active' : '' }}"> 
					<a href="{{url('batches')}}"><i class="feather-users"></i> <span>Batches</span></a>
				</li>
				
				<li class="{{ Request::is('payments') ? 'active' : '' }}"> 
					<a href="{{url('payments')}}"><i class="feather-credit-card"></i> <span>Payments</span></a>
				</li>

				<li class="{{ Request::is('parameters') ? 'active' : '' }}"> 
					<a href="{{url('parameters')}}"><i class="feather-hash"></i> <span>Fees type</span></a>
				</li>
				{{-- 

				<li class="{{ Request::is('contacts') ? 'active' : '' }}"> 
					<a href="{{url('contacts')}}"><i class="feather-smartphone"></i> <span>Contacts</span></a>
				</li>

				<li class="{{ Request::is('tasks') ? 'active' : '' }}"> 
					<a href="{{url('tasks')}}"><i class="feather-check-square"></i> <span>Tasks</span></a>
				</li>
				
				<li class="{{ Request::is('companies') ? 'active' : '' }}"> 
					<a href="{{url('companies')}}"><i class="feather-database"></i> <span>Companies</span></a>
				</li>
				<li class="{{ Request::is('leads','leads-kanban-view') ? 'active' : '' }}"> 
					<a href="{{url('leads')}}"><i class="feather-user"></i> <span>Leads</span></a>
				</li>
				
				<li class="{{ Request::is('deals','deals-kanban-view') ? 'active' : '' }}"> 
					<a href="{{url('deals')}}"><i class="feather-radio"></i> <span>Deals</span></a>
				</li>
				<li class="{{ Request::is('projects','projects-kanban-view') ? 'active' : '' }}"> 
					<a href="{{url('projects')}}"><i class="feather-grid"></i> <span>Projects</span></a>
				</li>
				<li class="{{ Request::is('reports') ? 'active' : '' }}"> 
					<a href="{{url('reports')}}"><i class="feather-bar-chart-2"></i> <span>Reports</span></a>
				</li>
				<li class="{{ Request::is('activities') ? 'active' : '' }}"> 
					<a href="{{url('activities')}}"><i class="feather-calendar"></i> <span>Activities</span></a>
				</li>
				<li class="submenu">
					<a class=" {{ Request::is('invoices') ? 'active' : '' }}" href="{{ url('invoices')}}"><i class="feather-clipboard"></i> <span> Invoices</span>
						<span class="menu-arrow"></span>
					</a>
					<ul class="sub-menus">
						<li><a class=" {{ Request::is('invoices','invoices-paid','invoices-overdue','invoices-draft','invoices-recurring','invoices-cancelled') ? 'active' : '' }}" href="{{ url('invoices')}}">Invoices List</a></li>
						<li><a class=" {{ Request::is('invoice-grid') ? 'active' : '' }}" href="{{ url('invoice-grid')}}">Invoices Grid</a></li>
						<li><a class=" {{ Request::is('add-invoice') ? 'active' : '' }}" href="{{ url('add-invoice')}}">Add Invoices</a></li>
						<li><a class=" {{ Request::is('edit-invoice') ? 'active' : '' }}" href="{{ url('edit-invoice')}}">Edit Invoices</a></li>
						<li><a class=" {{ Request::is('view-invoice') ? 'active' : '' }}" href="{{ url('view-invoice')}}">Invoices Details</a></li>
						<li><a class=" {{ Request::is('invoices-settings','tax-settings','bank-settings') ? 'active' : '' }}" href="{{ url('invoices-settings')}}">Invoices Settings</a></li>
					</ul>
				</li>
				
				<li class="{{ Request::is('email') ? 'active' : '' }}"> 
					<a href="{{url('email')}}"><i class="feather-mail"></i> <span>Email</span></a>
				</li>
				<li class="{{ Request::is('settings','localization','payment-settings','emailsettings','social-settings','social-links','seo-settings','others-settings') ? 'active' : '' }}">
					<a href="{{ url('settings') }}"><i class="feather-settings"></i> <span> Settings</span>
					</a>
				</li>
				<li class="menu-title"> 
					<span>Pages</span>
				</li>
				
				<li class="submenu">
					<a href="#"><i class="feather-alert-triangle"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
					<ul class="sub-menus">
						<li><a class="<?php if($page=="error-404") { echo 'active'; } ?>" href="{{url('error-404')}}">404 Error </a></li>
						<li><a class="<?php if($page=="error-500") { echo 'active'; } ?>" href="{{url('error-500')}}">500 Error </a></li>
					</ul>
				</li>
				
				<li class="submenu">
					<a href="#"><i class="feather-list"></i> <span> Pages </span> <span class="menu-arrow"></span></a>
					<ul class="sub-menus">
						<li><a class="<?php if($page=="faq") { echo 'active'; } ?>" href="{{url('faq')}}"> FAQ </a></li>
						<li><a class="<?php if($page=="terms") { echo 'active'; } ?>" href="{{url('terms')}}"> Terms </a></li>
						<li><a class="<?php if($page=="privacy-policy") { echo 'active'; } ?>" href="{{url('privacy-policy')}}"> Privacy Policy </a></li>
						<li><a class="<?php if($page=="blank-page") { echo 'active'; } ?>" href="{{url('blank-page')}}"> Blank Page </a></li>
					</ul>
				</li>
				<li class="menu-title"> 
					<span>UI Interface</span>
				</li>
				<li class="{{ Request::is('components') ? 'active' : '' }}"> 
					<a href="{{url('components')}}"><i class="feather-layout"></i> <span>Components</span></a>
				</li>
				<li class="submenu">
					<a href="#"><i class="feather-credit-card"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
					<ul class="sub-menus">
						<li><a class="<?php if($page=="form-basic-inputs") { echo 'active'; } ?>" href="{{url('form-basic-inputs')}}">Basic Inputs </a></li>
						<li><a class="<?php if($page=="form-input-groups") { echo 'active'; } ?>" href="{{url('form-input-groups')}}" >Input Groups </a></li>
						<li><a class="<?php if($page=="form-horizontal") { echo 'active'; } ?>" href="{{url('form-horizontal')}}">Horizontal Form </a></li>
						<li><a class="<?php if($page=="form-vertical") { echo 'active'; } ?>" href="{{url('form-vertical')}}"> Vertical Form </a></li>
						<li><a class="<?php if($page=="form-mask") { echo 'active'; } ?>" href="{{url('form-mask')}}"> Form Mask </a></li>
						<li><a class="<?php if($page=="form-validation") { echo 'active'; } ?>" href="{{url('form-validation')}}"> Form Validation </a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i class="feather-box"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
					<ul class="sub-menus">
						<li><a class="<?php if($page=="tables-basic") { echo 'active'; } ?>" href="{{url('tables-basic')}}">Basic Tables </a></li>
						<li><a class="<?php if($page=="data-tables") { echo 'active'; } ?>" href="{{url('data-tables')}}">Data Table </a></li>
					</ul>
				</li>
				<li class="menu-title"> 
					<span>Extras</span>
				</li>
				
				<li class="submenu">
					<a href="javascript:void(0);"><i class="feather-command"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
					<ul class="sub-menus">
						<li class="submenu">
							<a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
							<ul class="sub-menus">
								<li><a href="javascript:void(0);"><span>Level 2</span></a></li>
								<li class="submenu">
									<a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
									<ul class="sub-menus">
										<li><a href="javascript:void(0);">Level 3</a></li>
										<li><a href="javascript:void(0);">Level 3</a></li>
									</ul>
								</li>
								<li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
							</ul>
						</li>
						<li>
							<a href="javascript:void(0);"> <span>Level 1</span></a>
						</li>
					</ul>
				</li> --}}
			</ul>
		</div>
    </div>
</div>
<!-- /Sidebar -->
@endif
<!-- Sidebar -->
@if(Route::is(['email','mail-view']))
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
    	<form action="search" class="mobile-view">
			<input class="form-control" type="text" placeholder="Search here">
			<button class="btn" type="button"><i class="fa fa-search"></i></button>
		</form>
		<div class="sidebar-menu">
			<ul>
				<li> 
					<a href="{{url('index')}}"><i class="fa fa-home" aria-hidden="true"></i> <span>Back to Home</span></a>
				</li>
	             <li class="{{ Request::is('email','mail-view') ? 'active' : '' }}"> 
	                <a href="{{url('email')}}"><i class="fa fa-envelope menu-icon" aria-hidden="true"></i> <span>Inbox <span class="mail-count">(21)</span></span></a>
	            </li>
	            <li> 
	                <a href="#"><i class="fa fa-star menu-icon" aria-hidden="true"></i> <span>Starred</span></a>
	            </li>
	            <li> 
	                <a href="#"><i class="fa fa-paper-plane menu-icon" aria-hidden="true"></i> <span>Sent Mail</span></a>
	            </li>
	            <li> 
	                <a href="#"><i class="fa fa-trash menu-icon" aria-hidden="true"></i> <span>Trash</span></a>
	            </li>
	            <li> 
	                <a href="#"><i class="fa fa-folder-open-o menu-icon" aria-hidden="true"></i> <span>Draft <span class="mail-count">(8)</span></span></a>
	            </li>
  
				
				<li class="menu-title xs-hidden">Label <a href="#" class="label-icon"><i class="fa fa-plus"></i></a></li>
				<li class="xs-hidden"> 
					<a href="#"><i class="fa fa-circle text-success mail-label"></i> Work</a>
				</li>
				<li class="xs-hidden"> 
					<a href="#"><i class="fa fa-circle text-danger mail-label"></i> Office</a>
				</li>
				<li class="xs-hidden"> 
					<a href="#"><i class="fa fa-circle text-warning mail-label"></i> Personal</a>
				</li>
			</ul>
		</div>
    </div>
</div>
<!-- /Sidebar -->
@endif	
@if(Route::is(['components']))
<!-- Sidebar -->
<div class="sidebar stickyside" id="sidebar">
    <div class="sidebar-inner slimscroll">
    	<form action="search" class="mobile-view">
			<input class="form-control" type="text" placeholder="Search here">
			<button class="btn" type="button"><i class="fa fa-search"></i></button>
		</form>
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li> 
					<a href="{{url('index')}}">Back To Home</a>
				</li>
				<li class="menu-title"> 
					Components
				</li>
				<li> 
					<a href="#comp_alerts" class="active">Alerts</a>
				</li>
				<li> 
					<a href="#comp_breadcrumbs">Breadcrumbs</a>
				</li>
				<li> 
					<a href="#comp_buttons">Buttons</a>
				</li>
				<li> 
					<a href="#comp_cards">Cards</a>
				</li>
				<li> 
					<a href="#comp_dropdowns">Dropdowns</a>
				</li>
				<li> 
					<a href="#comp_pagination">Pagination</a>
				</li>
				<li> 
					<a href="#comp_progress">Progress</a>
				</li>
				<li> 
					<a href="#comp_tabs">Tabs</a>
				</li>
				<li> 
					<a href="#comp_typography">Typography</a>
				</li>
			</ul>
		</div>
    </div>
</div>
<!-- /Sidebar -->
@endif
