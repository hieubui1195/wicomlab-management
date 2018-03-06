@extends('layouts.app')

@push('style')
    {!! Html::style('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}
    {!! Html::style('assets/select2/dist/css/select2.min.css') !!}
@endpush

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $project->project }}
            </h1>
            <ol class="breadcrumb">
                <li>
                    {!! html_entity_decode(
                        Html::link(
                            null, 
                            '<i class="fa fa-dashboard"></i> ' . Lang::get('custom.common.home')
                        )
                    )!!}
                <li>
                    {!! Html::linkRoute(
                        'project.show',
                        $project->project,
                        $project->id
                    ) !!}
                </li>
                <li class="active">New Task</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 style="text-align: center;">Add New Task</h4>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('task.store') }}" class="form-horizontal col-md-8 col-md-offset-2">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label class="control-label col-md-4" for="task">
                                Task
                            </label>
                            <div class="col-md-8">
                                <input name="task" type="text" id="task" class="form-control" placeholder="Enter New Task" value="{{ old('task') }}" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="performers">
                                Task Performer
                            </label>
                            <div class="col-md-8">
                                <select name="performers[]" id="performers" class="form-control select2" multiple="multiple" required="required" style="width: 100%">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="begin">
                                Task Begin
                            </label>
                            <div class="col-md-8">
                                <div class="input-group date">
                                    <input name="begin" type="text" id="begin" class="form-control datepicker" required="required">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="end">
                                Task End
                            </label>
                            <div class="col-md-8">
                                <div class="input-group date">
                                    <input name="end" type="text" id="end" class="form-control datepicker" required="required">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label col-md-4">
                                Task Description
                            </label>
                            <div class="col-md-8">
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control" required="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-check-square-o"></span> Add
                                </button>
                                <a href="{{ route('project.show', ['id' => $project->id]) }}" class="btn btn-warning">
                                    Back
                                </a>
                            </div>
                        </div>
                    </form>                                                           
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
    {!! Html::script('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('assets/select2/dist/js/select2.min.js') !!}
    <script type="text/javascript">
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        })
        $('.select2').select2();
    </script>
@endpush
