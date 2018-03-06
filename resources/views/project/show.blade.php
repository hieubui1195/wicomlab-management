@extends('layouts.app')

@push('style')
    <style type="text/css">
        input[type="file"] {
            display: block;
        }
    </style>
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
                    {{ $project->project }}
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
                        <a href="{{ route('project.index') }}" class="btn btn-success">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <h3">{{ $project->project }}</h3>
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
                     <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active nav-item">
                                <a href="#tasks" data-toggle="tab">
                                    Tasks
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#files" data-toggle="tab">
                                    Files
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            
                            <div class="tab-pane active" id="tasks">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <a href="{{ route('task.create') }}" class="btn btn-success {{ Auth::user()->id == $manager[0] ? "" : "disabled"}}">
                                                <span class="fa fa-plus-square"></span> New Task
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-10 col-xs-12">
                                        <ul>
                                            @foreach($tasks as $task)
                                                <li id="task_id_{{ $task->id }}" style="width: 100%">
                                                    <div class="clearfix">
                                                        <span class="pull-left">
                                                            <ul>
                                                                <li>
                                                                    <button class="btn-delete" {{ Auth::user()->id == $manager[0] ? "" : "disabled"}}>
                                                                        <span class="fa fa-trash" data-toggle="tooltip" title="Delete"></span>
                                                                        <input type="hidden" id="task-id" name="task-id" value="{{ $task->id }}">
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                        <input id="checkbox{{ $task->id }}" class="check-complete" type="checkbox" data-id="{{ $task->id }}" data-progress="{{ $task->progress }}" data-toggle="tooltip" title="Complete this task" {{ Auth::user()->id == $manager[0] ? "" : "disabled"}}>
                                                                        <label for="checkbox{{ $task->id }}">
                                                                            Complete
                                                                        </label>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('task.edit', ['id' => $task->id]) }}">
                                                                        {{ $task->task }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <small>
                                                                        {{ ' begin: '.$task->begin.' - end: '.$task->end }}
                                                                    </small>
                                                                </li>
                                                            </ul>
                                                        </span>
                                                        <small class="pull-right">
                                                            {{ $task->progress . "%"}}
                                                        </small>
                                                    </div>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-striped {{ date('Y-m-d') < $task->end ? 'progress-bar-success' : 'progress-bar-danger' }}" style="width: {{ $task->progress. "%"}}"></div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="files">
                                <div class="pull-right" style="margin: 15px 0px">
                                    <a href="" class="btn btn-success" id="btn-upload">
                                        <span class="fa fa-plus-square"></span> Upload file
                                    </a>
                                </div>
                                {{-- @foreach($files as $file) --}}
                                    {{-- @inject('service', 'App\Http\Controllers\HomeController') --}}
                                    <?php 
                                        // $user_id = $file->user_id; 
                                        // $name = $service->user($user_id)['name'];
                                    ?>
                                    <ul>
                                        <li class="file-list" style="display: inline-block; width: 100%">
                                            <div class="pull-left">
                                                <a href="" download="download">
                                                    <span class="fa"><input type="text" class="file-type" style="display: none;"></span> file name
                                                </a>
                                                <br />
                                                <p>
                                                    <blockquote>
                                                    by <a href=""></a> on  <i> </i></blockquote>
                                                </p>
                                            </div>
                                            <div class="pull-right">
                                                <ul>
                                                    <li style="display: inline-block;">
                                                        <button type="button" class="btn btn-default">
                                                            <span class="fa fa-search"></span> Preview
                                                        </button>
                                                    </li>
                                                    <li style="display: inline-block;">
                                                        <button type="button" class="btn btn-default">
                                                            <a href="" download="download">
                                                                <span class="fa fa-download"></span>
                                                            </a>
                                                        </button>
                                                    </li>
                                                    <li style="display: inline-block;">
                                                        <button class="btn btn-default btn-edit-file">
                                                            <span class="fa fa-pencil-square-o"></span> Edit
                                                            <input type="hidden" id="file-id" name="file-id" value="">
                                                            <input type="hidden" id="filename" name="filename" value="">
                                                            <input type="hidden" id="file-description" name="file-description" value="">
                                                        </button>
                                                    </li>
                                                    <li style="display: inline-block;">
                                                        <button class="btn btn-default btn-delete-file">
                                                            <span class="fa fa-trash"></span> Delete
                                                            <input type="hidden" id="file-id" name="file-id" value="">
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                {{-- @endforeach --}}
                                {{-- {{ $files->links() }}                --}}
                            </div>
                        </div>
                    </div>                                                           
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div id="modal-delete-task" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure delete this task?</h4>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="task_id">
                            <button type="button" id="delete" class="btn btn-danger" data-dismiss="modal">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal-upload-file" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Upload file to this project</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="file" class="col-md-4 control-label">
                                        File
                                    </label>
                                    <div class="col-md-6">
                                        {!! Form::file(
                                            'file',
                                            [
                                                'id' => 'file',
                                                'style' => 'display: block;',
                                            ]
                                        ) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fileDescription" class="col-md-4 control-label">
                                        File description
                                    </label>
                                    <div class="col-md-6">
                                        {!! Form::textarea(
                                            'formDescription',
                                            null,
                                            [
                                                'id' => 'formDescription',
                                                'class' => 'form-control',
                                            ]    
                                        ) !!}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="project-id" value="{{ $project->id }}">
                            <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">

                            <button type="button" id="upload" class="btn btn-success" data-dismiss="modal">Upload</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal-edit-file" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit this file?</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" class="form-horizontal">
                                <input type="hidden" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">
                                        File
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="name" name="name" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-md-4 control-label">
                                        Description
                                    </label>
                                    <div class="col-md-6">
                                        <textarea name="description" id="description" class="form-control" style="resize: none;">Description</textarea>
                                    </div>
                                </div>
                            </form> 
                        </div>
                        <div class="modal-footer">              
                            <button type="button" id="edit" class="btn btn-success" data-dismiss="modal">Edit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal-delete-file" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure delete this file?</h4>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="file_id">
                            <button type="button" id="delete-file" class="btn btn-danger" data-dismiss="modal">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('script') 
    {!! Html::script('js/task.js') !!}
 @endpush
