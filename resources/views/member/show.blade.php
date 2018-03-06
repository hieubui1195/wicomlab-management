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
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div style="width: 100px; height: 100px; margin: 0 auto" data-toggle="tooltip">
                                <a href="" title="Click to edit avatar">
                                    <img src="{{ asset($user->avatar) }}" width="100px" height="100px" class="profile-user-img img-circle" data-toggle="tooltip" title="User profile picture" alt="User profile picture">
                                </a>
                            </div>
                            <h3 class="profile-username text-center">
                                {{ $user->name }}
                            </h3>
                            <p class="text-muted text-center">
                                @if ($team != null)
                                    {{ $team->team }}
                                @endif
                            </p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-12">
                                            <b>Email</b>
                                        </div>
                                        <div class="col-md-9 col-xs-12">
                                            <a href="">{{ $user->email }}</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-12">
                                            <b>Phone</b>
                                        </div>
                                        <div class="col-md-9 col-xs-12">
                                            <a href=""> {{ $user->phone }}</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <!-- Button edit profile -->
                            <a href="{{ route('member.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-block {{ Auth::user()->id == $user->id ? "" : "disabled"}} " id="edit-profile" >
                                <span class="fa fa-pencil-square-o"></span> <b>Edit profile</b>
                            </a>
                        </div>
                    </div>

                    <!-- About me box-->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3>Information</h3>
                        </div>

                        <div class="box-body">
                            <strong>
                                <i class="fa fa-book margin-r-5"></i> Education
                            </strong>
                            <p class="text-muted">
                                {{ $user->school }}
                            </p>

                            <strong>
                                <i class="fa fa-book margin-r-5"></i> Organization
                            </strong>
                            <p class="text-muted">
                                {{ $user->organization }}
                            </p>

                            <strong>
                                <i class="fa fa-book margin-r-5"></i> Course
                            </strong>
                            <p class="text-muted">
                                @if ($user->course != 0)
                                    {{ $user->course }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                    <ul id="tasks">
                    {{-- @foreach($task_ids as $task_id)
                        @inject('service', 'App\Http\Controllers\HomeController') --}}
                        <?php 
                        // $task_id = $task_id->task_id; 
                        // $task = $service->task($task_id)['task'];
                        // $begin = new DateTime($service->task($task_id)['begin']);
                        // $end = new DateTime($service->task($task_id)['end']);
                        // $progress = $service->task($task_id)['progress'];
                        // $today = date('Y-m-d');
                        ?>
                        <li id="task_id_{{-- {{ $task_id }} --}}" style="width: 100%">
                            <div class="clearfix">
                                <span class="pull-left">
                                    <ul>
                                        <li>
                                            <button class="btn-delete">
                                                <span class="fa fa-trash" data-toggle="tooltip" title="Delete"></span>
                                                <input type="hidden" id="task-id" name="task-id" value="{{-- {{ $task_id }} --}}">
                                            </button>
                                        </li>
                                        <li>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox{{-- {{ $task_id }} --}}" class="check-complete" type="checkbox" data-id="{{-- {{ $task_id }} --}}" data-progress="{{-- {{ $progress }} --}}">
                                                <label for="checkbox{{-- {{ $task_id }} --}}">
                                                    Complete
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="{{-- {{ '/task/'.$task_id.'/edit' }} --}}">
                                                {{-- {{ $task }} --}}
                                            </a>
                                        </li>
                                        <li>
                                            <small>
                                                {{-- {{ ' begin: './$begin->format("Y-m-d").' - end: '.$end->format("Y-m-d")}} --}}
                                            </small>
                                        </li>
                                    </ul>
                                </span>
                                <small class="pull-right">
                                    {{-- {{ $progress.' %'}} --}}
                                </small>
                            </div>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-striped {{-- {{ $today < $end->format('Y-m-d')? 'progress-bar-success' : 'progress-bar-danger' }} --}}" style="width: {{ '%'}}"></div>
                            </div>
                        </li>
                    {{-- @endforeach --}}
                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
