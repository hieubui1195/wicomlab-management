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
                    <h4 style="text-align: center;">Add New Member</h4>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('member.store') }}" class="col-8 offset-2">
                        {{ csrf_field() }}
                        
                        <div class="form-group row">
                            <label for="email" class="control-form-label col-4">
                                Email
                            </label>
                            <div class="col-6">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required="required">
                                @if($errors->first('email'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="control-form-label col-4">
                                Name
                            </label>
                            <div class="col-6">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required="required">
                                @if($errors->first('name'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="control-form-label col-4">
                                Permission
                            </label>
                            <div class="col-6">
                                <select class="form-control" name="level" required="required">
                                    <option>--Select Permission--</option>
                                    <option value="0">Admin</option>
                                    <option value="2">Member</option>
                                </select>
                                @if($errors->first('level'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6 offset-4">
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-check-square-o"></span> Add
                                </button>
                                <a href="{{ route('member.index') }}" class="btn btn-warning">
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
