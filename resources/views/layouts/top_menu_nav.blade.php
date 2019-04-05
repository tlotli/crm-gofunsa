<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="index.html">
                    <img class="brand-img" style="border-radius: 50%" width="30px" height="30px" src="{{asset('assets/dist/img/gofun.png')}}" alt="brand"/>
                    <span class="brand-text">GoFun CRM</span>
                </a>
            </div>
        </div>
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
    </div>




    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li class="dropdown alert-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge">
                        @foreach($overdue_count as $o)
                            {{$o->overdue_count}}
                        @endforeach
                    </span></a>
                <ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                    <li>
                        <div class="notification-box-head-wrap">
                            <span class="notification-box-head pull-left inline-block">notifications</span>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr ma-0">
                        </div>
                    </li>
                    <li>
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 229px;"><div class="streamline message-nicescroll-bar" style="overflow: hidden; width: auto; height: 229px;">
                                <hr class="light-grey-hr ma-0">

                                {{--@foreach($overdue_visitations as $o)--}}
                                    {{--<div class="sl-item">--}}
                                        {{--<a href="javascript:void(0)">--}}

                                            {{--<div class="sl-content">--}}
                                                {{--<span class="inline-block capitalize-font  pull-left truncate head-notifications txt-danger"><a--}}
                                                            {{--href="{{route('visitations_list' , ['id' => $o->site_id])}}">{{$o->site_name}}</a></span>--}}
                                                {{--<span class="inline-block font-11 pull-right notifications-time">{{$o->date_visited . ' days ago'}}</span>--}}
                                                {{--<div class="clearfix"></div>--}}
                                            {{--</div>--}}
                                            {{----}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--@endforeach--}}

                            </div><div class="slimScrollBar" style="background: rgb(135, 135, 135) none repeat scroll 0% 0%; width: 4px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 0px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                    </li>
                    <li>
                        <div class="notification-box-bottom-wrap">
                            <hr class="light-grey-hr ma-0">
                            <a class="block text-center read-all" href="javascript:void(0)"> view all </a>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</nav>