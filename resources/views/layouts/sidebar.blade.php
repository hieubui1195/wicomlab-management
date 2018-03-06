<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image" style="float: left;">
                {!! Html::image(
                    Auth::user()->avatar, 
                    'User Image', 
                    [
                        'class' => 'img-circle',
                    ]
                ) !!} 
            </div>
            <div class="pull-left info" style="float: left;">
                <p>{!! Auth::user()->name !!}</p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">

                {!! html_entity_decode(Html::link(null, 
                    '<i class="fas fa-globe"></i> <span>' . 
                    Lang::get('custom.common.change_language') . 
                    '</span><span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i></span>')) !!}

                <ul class="treeview-menu">
                    <li>
                        {!! html_entity_decode(Html::linkRoute('change-language', 
                        Html::image('images/en.png') . Lang::get('custom.common.en'), 
                        [
                            'lang' => 'en'
                        ])) !!}
                    </li>
                    <li>
                        {!! html_entity_decode(Html::linkRoute('change-language', 
                        Html::image('images/vi.png') . Lang::get('custom.common.vi'), 
                        [
                            'lang' => 'vi'
                        ])) !!}
                    </li>
                </ul>
            </li>
            <li>
                {!! html_entity_decode(
                    Html::linkRoute(
                        'member.index', 
                        '<i class="fa fa-list"></i> <span>' .  Lang::get('custom.nav.member') . '</span>'
                    )
                ) !!}
            </li>
            <li>
                {!! html_entity_decode(
                    Html::linkRoute(
                        'project.index', 
                        '<i class="fab fa-product-hunt"></i> <span>' . Lang::get('custom.nav.project') . '</span>'
                    )
                ) !!}
            </li>
            <li>
                {!! html_entity_decode(
                    Html::link(
                        null, 
                        '<i class="fa fa-plus"></i> <span>' . Lang::get('custom.nav.team') . '</span>'
                    )
                ) !!}
            </li>
            
    </section>
    <!-- /.sidebar -->
</aside>
