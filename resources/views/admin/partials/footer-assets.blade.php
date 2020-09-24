<script src="{{ asset('/public/admin-elite/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/public/admin-elite/assets/node_modules/jquery/jquery-ui.js') }}"></script>

<!-- Jquery for multi select or choose -->
<script src="{{ asset('/public/admin-elite/dist/js/chosen.jquery.js') }}"></script>

<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('/public/admin-elite/assets/node_modules/popper/popper.min.js') }}"></script>
<script src="{{ asset('/public/admin-elite/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('/public/admin-elite/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('/public/admin-elite/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('/public/admin-elite/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('/public/admin-elite/dist/js/custom.min.js') }}"></script>

<!--stickey kit -->
<script src="{{ asset('/public/admin-elite/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('/public/admin-elite/assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sweet-Alert  -->
<script src="{{ asset('/public/admin-elite/assets/node_modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('/public/admin-elite/assets/node_modules/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

<!-- switchery  -->
<script src="{{ asset('/public/admin-elite/assets/node_modules/switchery/dist/switchery.min.js') }}"></script>

<!-- Morris graph chart -->
<script src="{{ asset('/public/admin-elite/assets/node_modules/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/admin-elite/assets/node_modules/morrisjs/morris.js') }}"></script>
<script src="{{ asset('/public/admin-elite/assets/node_modules/morrisjs/raphael.min.js') }}"></script>

<!-- summernote  -->
<script src="{{ asset('/public/admin-elite/assets/node_modules/summernote/dist/summernote.min.js') }}"></script>	
<!-- tagsinput  -->
<script src="{{ asset('/public/admin-elite/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

<script src="{{ asset('/public/admin-elite/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/public/admin-elite/tinymce/tinymce_editor.js') }}"></script>

@include('admin.partials.datatable')
@include('admin.partials.goBack')
@include('admin.partials.chosen_select')
@include('admin.partials.alert_messege')
@include('admin.partials.datepicker_js')
{{-- @include('admin.partials.user_dropdown') --}}


