<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="Chemtor">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
@if(!Route::is(['terms','tasks','tables-basic','settings','reports','register','projects','projects-kanban-view','projects-dashboard','profile','privacy-policy','mail-view','login','leads','leads-kanban-view','leads-dashboard','form-vertical','form-validation','form-mask','form-input-groups','form-horizontal','form-basic-inputs','faq','error-500','error-404','email','deals','deals-kanban-view','activities','blank-page','companies','components','contacts','data-tables','deals-dashboard']))
<title>Dashboard - Chemtor</title>
@endif
@if(Route::is(['activities']))
<title>Activities - Chemtor</title>		
@endif
@if(Route::is(['blank-page']))
<title>Blank Page - Chemtor</title>
@endif
@if(Route::is(['companies']))
<title>Companies - Chemtor</title>
@endif
@if(Route::is(['components']))
<title>Components - Chemtor</title>
@endif
@if(Route::is(['contacts']))
<title>Contacts - Chemtor</title>
@endif
@if(Route::is(['data-tables']))
<title> Data Tables - Chemtor</title>
@endif
@if(Route::is(['deals-kanban-view']))
<title>Deals Kanban View - Chemtor</title>
@endif
@if(Route::is(['deals']))
<title>Deals - Chemtor</title>
@endif
@if(Route::is(['email']))
<title>Inbox - Chemtor</title>
@endif
@if(Route::is(['error-404']))
<title>Error 404 - Chemtor</title>
@endif
@if(Route::is(['error-500']))
<title>Error 500 - Chemtor</title>
@endif
@if(Route::is(['faq']))
<title>FAQ - Chemtor</title>
@endif
@if(Route::is(['form-basic-inputs']))
<title>Form Basic Inputs - Chemtor</title>
@endif
@if(Route::is(['form-horizontal']))
<title>Horizontal Form - Chemtor</title>
@endif
@if(Route::is(['form-input-groups']))
<title>Forms Input Groups - Chemtor</title>
@endif
@if(Route::is(['form-mask']))
<title> Form Mask - Chemtor</title>
@endif
@if(Route::is(['form-validation']))
<title> Form Validation - Chemtor</title>
@endif
@if(Route::is(['form-vertical']))
<title>Vertical Form - Chemtor</title>
@endif
@if(Route::is(['leads-dashboard']))
<title>Leads Dashboard - Chemtor</title>
@endif
@if(Route::is(['leads-kanban-view']))
<title>Leads Kanban View - Chemtor</title>
@endif
@if(Route::is(['leads']))
<title>Leads - Chemtor</title>
@endif
@if(Route::is(['login']))
<title>Login - Chemtor</title>
@endif
@if(Route::is(['mail-view']))
<title>Mail view - Chemtor</title>
@endif
@if(Route::is(['privacy-policy']))
<title>Privacy Policy - Chemtor</title>
@endif
@if(Route::is(['profile']))
<title>Employee Profile - Chemtor</title>
@endif
@if(Route::is(['projects-dashboard']))
<title>Projects Dashboard - Chemtor</title>
@endif
@if(Route::is(['projects-kanban-view']))
<title>Projects Kanban View - Chemtor</title>
@endif
@if(Route::is(['projects']))
<title>Projects - Chemtor</title>
@endif
@if(Route::is(['register']))
<title>Register - Chemtor</title>
@endif
@if(Route::is(['reports']))
<title>Reports - Chemtor</title>
@endif
@if(Route::is(['settings']))
<title>Settings - Chemtor</title>
@endif
@if(Route::is(['tables-basic']))
<title> Basic Tables - Chemtor</title>
@endif
@if(Route::is(['tasks']))
<title>Tasks - Chemtor</title>
@endif
@if(Route::is(['terms']))
<title>Terms - Chemtor</title>
@endif
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{url('assets/img/favicon.png')}}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/fontawesome/css/all.min.css')}}">
<!--<link rel="stylesheet" href="{{url('assets/plugins/fontawesome/css/fontawesome.min.css')}}">-->
<link rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}">
<!-- Feathericon CSS -->
<link rel="stylesheet" href="{{url('assets/css/feather.css')}}">
<!--font style-->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
<!-- Lineawesome CSS -->
<link rel="stylesheet" href="{{url('assets/css/line-awesome.min.css')}}">
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/select2/css/select2.min.css')}}">
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{url('assets/css/bootstrap-datetimepicker.min.css')}}">
<!-- Tagsinput CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/datatables/datatables.min.css')}}">
<!-- Chart CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/morris.js/morris.css')}}">
@if(Route::is(['others-settings']))
<!-- Ck Editor -->
<link rel="stylesheet" href="{{url('assets/css/ckeditor.css')}}">
@endif
<!-- Summernote CSS -->
@if(Route::is(['mail-view','email']))
 <link rel="stylesheet" href="{{url('assets/plugins/summernote/dist/summernote-bs4.css')}}">
@endif
<!-- Theme CSS -->
<link rel="stylesheet" href="{{url('assets/css/theme-settings.css')}}">
<!-- Main CSS -->
<link rel="stylesheet" href="{{url('assets/css/style.css')}}" class="themecls">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
