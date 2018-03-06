@extends('layouts.app')

@push('style')
    {!! Html::style('assets/datatables.net-dt/css/jquery.dataTables.min.css') !!}
@endpush

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('custom.common.dashboard')
            </h1>
            <ol class="breadcrumb">
                <li>
                    {!! html_entity_decode(
                        Html::link(
                            null, 
                            '<i class="fa fa-dashboard"></i> ' . Lang::get('custom.common.home')
                        )
                    )!!}
                <li class="active">@lang('custom.common.dashboard')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="container">
                        <div class="row">
                            
                            <div class="col-md 6">
                                <h3>All Members</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('member.create') }}" class="btn btn-success pull-right">
                                    <i class="fa fa-plus"></i> New Member
                                </a>
                            </div>
                        </div>
                    </div>
                    @include('partials.success')
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-hover table-reponsive scroll datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th></th>
                                <th>School</th>
                                <th>Organization</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $loop->index+1 }}
                                </td>
                                <td>
                                    {!! Form::open([
                                        'route' => ['member.destroy', $user->id],
                                        'method' => 'DELETE',
                                        'id' => 'delete-form-' . $user->id,
                                        'style' => 'display: none;',
                                    ]) !!}

                                    {!! Form::close() !!}

                                    {!! html_entity_decode(
                                        Html::link(
                                            null,
                                            '<i class="fa fa-trash"></i>',
                                            [
                                                'class' => 'btn btn-danger delete-user',
                                                'data-id' => $user->id,
                                            ]
                                        )
                                    ) !!}
                                </td>
                                <td>
                                    {!! Html::image(
                                        $user->avatar,
                                        'User Image',
                                        [
                                            'width' => '25px',
                                            'height' => '25px',
                                        ]
                                    ) !!}
                                </td>
                                <td>
                                    {{ $user->school }}
                                </td>
                                <td>
                                    {{ $user->organization }}
                                </td>
                                <td>
                                    {!! Html::linkRoute(
                                        'member.show',
                                        $user->name,
                                        [
                                            'id' => $user->id,
                                        ],
                                        [
                                            'style' => 'color: black; text-decoration: underline;',
                                        ]
                                    ) !!}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th></th>
                                <th>School</th>
                                <th>Organization</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </tfoot>
                    </table>                                                            
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('script')
    {!! Html::script('assets/datatables.net/js/jquery.dataTables.min.js') !!}
    <script type="text/javascript">
        $('.datatables').DataTable();

        $(document).ready(function() {

            var userLevel = {{ Auth::user()->level }};

            $('.delete-user').click(function() {
                event.preventDefault();
                if (userLevel == 0) {
                    if (confirm('Are you want to delete this member?')) {
                        var userId = $(this).attr('data-id');
                        $("#delete-form-" + userId).submit();
                    }
                } else {
                    alert('You are not allowed');
                }

            })
        })
    </script>
 @endpush
