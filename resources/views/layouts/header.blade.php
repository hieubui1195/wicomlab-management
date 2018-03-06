<header class="main-header">
    <!-- Logo -->
    {!! html_entity_decode(
        Html::linkRoute(
            'home', 
            '<span class="logo-mini"><b>' . Lang::get("custom.common.logo") . 
            '</b></span><span class="logo-lg"><b>' . Lang::get('custom.common.title') . '</b></span>', 
            null, 
            [
                'class' => 'logo',
            ]
        )
    ) !!}

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="padding: 0px">
        <!-- Sidebar toggle button-->
        {!! html_entity_decode(
            Html::link(
                null, 
                '<i class="fa fa-bars"></i>', 
                [
                    'class' => 'sidebar-toggle', 
                    'data-toggle' => 'push-menu', 
                    'role' => 'button',
                ]
            )
        ) !!}

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu" style="padding-right: 20px;">
                    {!! html_entity_decode(
                        Html::link(
                            null, 
                            Html::image(
                                Auth::user()->avatar, 
                                'User Image', 
                                [
                                    'class' => 'user-image', 
                                ]
                            ) . '<span class="hidden-xs">' . Auth::user()->name . '</span>', 
                            [
                                'class' => 'dropdown-toggle', 
                                'data-toggle' => 'dropdown', 
                            ]
                        )
                    ) !!}
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            {!! Html::image(
                                Auth::user()->avatar, 
                                'User Image', 
                                [
                                    'class' => 'img-circle'
                                ]
                            ) !!} 
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left" style="float: left;">
                                {!! Html::link(
                                    null, 
                                    Lang::get('custom.common.profile_button'), 
                                    [
                                        'class' => 'btn btn-default btn-flat'
                                    ]
                                ) !!}                                
                            </div>
                            <div class="btn btn-default pull-right" style="float: right;">

                                {!! Html::linkRoute(
                                    'logout', 
                                    Lang::get('custom.common.logout_button'), 
                                    null, 
                                    [
                                        'onclick' => 'event.preventDefault();document.getElementById("logout-form").submit();'
                                    ]
                                ) !!}
                                
                                {!! Form::open([
                                    'id' => 'logout-form', 
                                    'method' => 'POST', 
                                    'route' => 'logout', 
                                    'style' => 'display: none;'
                                    ]
                                ) !!}
                                
                                {!! Form::close() !!}
                                
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
