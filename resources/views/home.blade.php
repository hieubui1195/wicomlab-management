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
                <div class="box-body">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>150</h3>

                                <p>@lang('custom.homepage.order')</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                @lang('custom.homepage.more_info') <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>44</h3>

                                <p>@lang('custom.homepage.user')</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                @lang('custom.homepage.more_info') <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                            <div class="inner">
                                <h3>65</h3>

                                <p>@lang('custom.homepage.sale')</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                @lang('custom.homepage.more_info') <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
