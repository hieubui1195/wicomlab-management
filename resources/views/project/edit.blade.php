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
                    <h4 style="text-align: center;">Edit Project</h4>
                </div>
                <div class="box-body">
                    {!! Form::open([
                        'route' => [
                            'project.update', 
                            $project->id
                        ],
                        'method' => 'PUT',
                        'class' => 'col-8 offset-2',
                    ]) !!}

                    <div class="form-group row">
                        <label class="control-form-label col-4" for="project">
                            Project
                        </label>
                        <div class="col-8">
                            <input name="project" type="text" id="project" class="form-control" placeholder="Enter Project" value="{{ old('project') ? old('project') : $project->project }}" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-form-label col-4" for="manager">
                            Project Manager
                        </label>
                        <div class="col-8">
                            <select name="manager" id="manager" class="form-control select2" required="required">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $project->user_id ? 'selected="selected"' : '' }} >{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-form-label col-4" for="begin">
                            Project Begin
                        </label>
                        <div class="col-8">
                            <input name="begin" type="text" id="begin" class="form-control datepicker" value="{{ old('begin') ? old('begin') : $project->begin }}" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-form-label col-4" for="end">
                            Project End
                        </label>
                        <div class="col-8">
                            <input name="end" type="text" id="end" class="form-control datepicker" value="{{ old('end') ? old('end') : $project->end }}" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-8 offset-4">
                            <button type="submit" class="btn btn-success">
                                <span class="fa fa-check-square-o"></span> Edit
                            </button>
                            <a href="{{ route('project.index') }}" class="btn btn-warning">
                                Back
                            </a>
                        </div>
                    </div>

                    {!! Form::close() !!}                                                        
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
