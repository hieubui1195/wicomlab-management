<footer class="main-footer">
    <div class="pull-right hidden-xs" style="float: right;">
        <b>@lang('custom.footer.version')</b>
    </div>
    <strong>
        @lang('custom.footer.copyright') 
        {!! Html::link('https://adminlte.io', Lang::get('custom.footer.author')) !!}
    </strong> 
    @lang('custom.footer.reserved')
</footer>
<!-- ./wrapper -->

<!-- jQuery -->
{!! Html::script('assets/jquery/dist/jquery.min.js') !!}
<!-- Propper -->
{!! Html::script('assets/popper.js/dist/umd/popper.js') !!}
<!-- Bootstrap -->
{!! Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
<!-- Fastclick -->
{!! Html::script('assets/fastclick/lib/fastclick.js') !!}
{!! Html::script('assets/datatables.net/js/jquery.dataTables.min.js') !!}
{!! Html::script('assets/iCheck/icheck.min.js') !!}
{!! Html::script('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
{!! Html::script('assets/select2/dist/js/select2.min.js') !!}
{!! Html::script('assets/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js') !!}
<!-- AdminLTE App -->
{!! Html::script('dist/js/adminlte.min.js') !!}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{!! Html::script('dist/js/pages/dashboard.js') !!}
<!-- AdminLTE for demo purposes -->
{!! Html::script('dist/js/demo.js') !!}
@stack('script')
<!-- Main js -->
{!! Html::script('js/main.js') !!}
