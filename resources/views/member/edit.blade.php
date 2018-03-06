@extends('layouts.app')

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
                    <h4 style="text-align: center;">Edit profile</h4>
                </div>
                @include('partials.success')
                <div class="box-body">
                    {!! Form::open([
                        'route' => ['member.update', $user->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal row',
                    ]) !!}
                        <div class="col-md-3">
                            <ul>
                                <li style="list-style: none;">
                                    <img src="{{ asset($user['avatar']) }}" id="user-image" class="img img-circle img-rounded img-thumbnail img-responsive" width="150" height="150">
                                </li>
                                <li style="list-style: none; margin-top: 5px">
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fa fa-cloud-upload"></i> Change avatar
                                    </label>
                                    <input id="file-upload" name="avatar" type="file" accept="image/*" />
                                </li>
                                <li style="list-style: none;">
                                    <p id="file-name"></p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group row">
                                <label for="email" class="control-label col-sm-3">
                                    Email
                                </label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $user['email'] }}" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="control-label col-sm-3">
                                    Name
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $user['name'] }}" required="required">
                                    @if($errors->first('name'))
                                        <p class="text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="control-label col-sm-3">
                                    Phone
                                </label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="{{ $user['phone'] }}">
                                    @if($errors->first('phone'))
                                        <p class="text-danger">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="school" class="control-label col-sm-3">
                                    School
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="school" name="school" placeholder="Enter School" value="{{ $user['school'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="organization" class="control-label col-sm-3">
                                    Organization
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="organization" name="organization" placeholder="Enter Organization" value="{{ $user['organization'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course" class="control-label col-sm-3">
                                    Course
                                </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="course" name="course" placeholder="Enter Course" value="{{ $user['course'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">
                                        <span class="fa fa-check-square-o"></span> Edit Profile
                                    </button>
                                    <a href="{{ route('member.index') }}" class="btn btn-warning">
                                        Back
                                    </a>
                                </div>
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
