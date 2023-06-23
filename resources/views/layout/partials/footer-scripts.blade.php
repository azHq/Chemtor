<!-- jQuery -->
<script src="{{ URL::asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core JS -->
<script src="{{ URL::asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Slimscroll JS -->
<script src="{{ URL::asset('/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- Form Validation JS -->
<script src="{{ URL::asset('/assets/js/form-validation.js')}}"></script>
<!-- Select2 JS -->
<script src="{{ URL::asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Datatable JS -->
<script src="{{ URL::asset('/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables/datatables.min.js')}}"></script>
<!-- Datetimepicker JS -->
<script src="{{ URL::asset('/assets/js/moment.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
<!-- Tagsinput JS -->
<script src="{{ URL::asset('/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/sticky-kit/sticky-kit.min.js')}}"></script>
<!-- Mask JS -->
<script src="{{ URL::asset('/assets/js/jquery.maskedinput.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/mask.js')}}"></script>
@if(Route::is(['others-settings']))
<!-- Ck Editor JS -->
<script src="{{ URL::asset('/assets/js/ckeditor.js')}}"></script>
@endif
<!-- Chart JS -->
@if(Route::is(['pagee','leads-dashboard','projects-dashboard']))
<script src="{{ URL::asset('/assets/plugins/morris.js/morris.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/chart.js')}}"></script>
<script src="{{ URL::asset('/assets/js/linebar.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/piechart.js')}}"></script>
<script src="{{ URL::asset('/assets/js/apex.min.js')}}"></script>
@endif
<!-- Summernote JS -->
@if(Route::is(['mail-view','email']))
<script src="{{ URL::asset('/assets/plugins/summernote/dist/summernote-bs4.js')}}"></script>
@endif
<!-- theme JS -->
<script src="{{ URL::asset('/assets/js/theme-settings.js')}}"></script>
<!-- Custom JS -->
<script src="{{ URL::asset('/assets/js/app.js')}}"></script>
<script src="{{ URL::asset('/assets/js/sticky.js')}}"></script>

{{-- Datatable Button --}}
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>



