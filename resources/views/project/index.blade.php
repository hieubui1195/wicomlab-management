@extends('layouts.app')

@push('style')
    {!! Html::style('assets/datatables.net-dt/css/jquery.dataTables.min.css') !!}
    {!! Html::style('assets/iCheck/skins/square/_all.css') !!}
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
                            
                            <div class="pull-left">
                                <h3>All Projects</h3>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('project.create') }}" class="btn btn-success pull-right">
                                    <i class="fa fa-plus"></i> New Project
                                </a>
                            </div>
                    @include('partials.success')
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-hover table-reponsive scroll datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Project</th>
                                <th>Manager</th>
                                <th>Begin</th>
                                <th>End</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>
                                    {{ $loop->index+1 }}
                                </td>
                                <td>
                                    {!! html_entity_decode(
                                        Html::linkRoute(
                                            'project.destroy',
                                            '<i class="fa fa-trash"></i>',
                                            [
                                                'id' => $project->project_id,
                                            ],
                                            [
                                                'class' => 'btn btn-danger delete-project',
                                                'data-id' => $project->project_id,
                                                'title' => 'Delete',
                                            ]
                                        )
                                    ) !!}

                                    {!! Form::open([
                                        'route' => ['project.destroy', $project->project_id],
                                        'method' => 'DELETE',
                                        'id' => 'delete-form-' . $project->project_id,
                                        'style' => 'display: none;',
                                    ]) !!}

                                    {!! Form::close() !!}

                                    {!! html_entity_decode(
                                        Html::linkRoute(
                                            'project.edit',
                                            '<i class="fa fa-edit"></i>',
                                            [
                                                'id' => $project->project_id,
                                            ],
                                            [
                                                'class' => 'btn btn-info',
                                                'data-id' => $project->project_id,
                                                'title' => 'Edit',
                                            ]
                                        )
                                    ) !!}
                                    
                                </td>
                                <td> 
                                    {!! Html::linkRoute(
                                        'project.show',
                                        $project->project,
                                        [
                                            'id' => $project->project_id,
                                        ],
                                        [
                                            'style' => 'color: black; text-decoration: underline;',
                                            'title' => 'View Detail',
                                        ]
                                    ) !!}
                                </td>
                                <td>
                                    {!! Html::linkRoute(
                                        'member.show', 
                                        $project->name,
                                        $project->user_id,
                                        [
                                            'style' => 'color: black; text-decoration: underline;',
                                            'title' => 'View Profile',
                                        ]
                                    ) !!}
                                </td>
                                <td>
                                    {{ $project->begin }}
                                </td>
                                <td>
                                    {{ $project->end }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Project</th>
                                <th>Manager</th>
                                <th>Begin</th>
                                <th>End</th>
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
    {!! Html::script('assets/iCheck/icheck.min.js') !!}

    <script type="text/javascript">
        $('.datatables').DataTable();

        $(document).ready(function() {

            var userLevel = {{ Auth::user()->level }};
            var userId = {{ Auth::user()->id }};
            var managerId = {{ $project->user_id }};

            $('.delete-project').click(function() {
                event.preventDefault();
                if (userLevel == 0 || userId == managerId) {
                    if (confirm('Are you want to delete this project?')) {
                        var projectId = $(this).attr('data-id');
                        $("#delete-form-" + projectId).submit();
                    }
                } else {
                    alert('You are not allowed');
                }

            })
        })
    </script>
 @endpush
