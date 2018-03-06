<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@lang('custom.common.title')</title>

<!-- Bootstrap -->
{{ Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}
<!-- Font Awesome -->
{{ Html::style('assets/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}
<!-- Ionicons -->
{{ Html::style('assets/Ionicons/css/ionicons.min.css') }}
{!! Html::style('assets/datatables.net-dt/css/jquery.dataTables.min.css') !!}
{!! Html::style('assets/iCheck/skins/square/_all.css') !!}
{!! Html::style('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}
{!! Html::style('assets/select2/dist/css/select2.min.css') !!}
{!! Html::style('assets/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css') !!}
<!-- Theme style -->
{{ Html::style('dist/css/AdminLTE.min.css') }}
<!-- AdminLTE Skins -->
{{ Html::style('dist/css/skins/_all-skins.min.css') }}
<!-- Google Font -->
{{ Html::style('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}
@stack('style')
<!-- Main css -->
{{ Html::style('css/main.css') }}
