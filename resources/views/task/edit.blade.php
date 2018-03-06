@extends('layouts.app')

@push('style')
    <style type="text/css">
        .slider-selection {
    background: #BABABA;
}
    </style>
    @endpush

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $task->task }}
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
                    {{ $task->task }}
                </li>
                <li class="active">Show</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="">
                        <a href="{{ route('project.show', ['id' => $project->id]) }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <h3">{{ $task->task }}</h3>
                    </div>
                    {!! Form::hidden(
                        null,
                        Auth::user()->id,
                        [
                            'id' => 'auth-id',
                        ]
                    ) !!}
                    @include('partials.success')
                </div>
                <div class="box-body">
                    <form action="{{ '/task/'.$task->id }}" method="post">
                        {{ csrf_field()}}
                        {{ method_field('PUT') }}
                        <?php
                        $begin = new DateTime($task->begin);
                        $end = new DateTime($task->end);
                        ?>
                        <input type="text" name="projectId" value="{{ $task->project_id }}" style="display: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <label for="task">
                                            <span class="fa fa-tasks"></span> Task
                                        </label>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="text" name="task" id="task" class="form-control" value="{{ $task->task }}" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <label for="description">
                                            <span class="fa fa-align-left"></span> Task Description
                                        </label>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <label for="">
                                            <span class="fa fa-users"></span> Who &amp; When
                                        </label>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="performers" class="control-label">
                                                    Who should do this task?
                                                </label>
                                                <select name="performers[]" id="performers" class="form-control select2" multiple="multiple" style="width: 100%">
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" @foreach($performers as $performer) {{ $performer->user_id == $user->id ? 'selected="selected"' : '' }} @endforeach>{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="begin" class="control-label">
                                                    Task Begin
                                                </label>
                                                <div class="input-group date">
                                                    <input name="begin" id="begin" type="text" class="form-control datepicker" value="{{ $begin->format('Y-m-d') }}">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="end" class="control-label">
                                                    Task End
                                                </label>
                                                <div class="input-group date">
                                                    <input name="end" id="end" type="text" class="form-control datepicker" value="{{ $end->format('Y-m-d') }}">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <label for="progress">
                                            <span class="fa fa-clock-o"></span>Progress (%)
                                        </label>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="text" name="progress" id="progress" class="form-control" value="{{ $task->progress }}" data-slider-id="progress" data-slider-min="0" data-slider-max="90" data-slider-step="10" data-slider-value="{{ $task->progress }}" style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <span class="fa fa-exclamation-circle"></span>Remid
                                    </div>
                                    <div class="box-body">
                                        <div class="funkyradio">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="funkyradio-default">
                                                        <input type="radio" name="remind" id="radio1" value="None" {{ $task->remind == 'None' ? 'checked="checked"' : '' }} />
                                                        <label for="radio1">None</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="funkyradio-primary">
                                                        <input type="radio" name="remind" id="radio2" value="Low" {{ $task->remind == 'Low' ? 'checked="checked"' : '' }} />
                                                        <label for="radio2">Low</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="funkyradio-success">
                                                        <input type="radio" name="remind" id="radio3" value="Medium" {{ $task->remind == 'Medium' ? 'checked="checked"' : '' }} />
                                                        <label for="radio3">Medium</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="funkyradio-danger">
                                                        <input type="radio" name="remind" id="radio4" value="High" {{ $task->remind == 'High' ? 'checked="checked"' : '' }} />
                                                        <label for="radio4">High</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="btn-edit-task" type="submit" {{ ($enableEdit == true) ? '' : 'disabled="disabled"' }} >
                                <span class="fa fa-check-square-o"></span> Edit Task
                            </button>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                @include('partials.errors')
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('script') 
    {!! Html::script('js/task.js') !!}

    <script type="text/javascript">
        $('.select2').select2();
        $('.datepicker').datepicker();

        $('#progress').slider({
            formatter: function(value) {
                return value + "%";
            },
            tooltip: 'always'
        });
    </script>
 @endpush
