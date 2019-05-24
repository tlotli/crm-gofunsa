<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="ti-stats-up mr-20"></i><span class="right-nav-text">Reports</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="dashboard_dr" class="collapse collapse-level-1">
                <li>
                    <a  href="{{route('site_reports')}}">Site</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="{{route('view_calendar')}}"><div class="pull-left"><i class="ti-calendar mr-20"></i><span class="right-nav-text">Calendar</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>


        <li>
            <a href="{{route('site_map')}}"><div class="pull-left"><i class="ti-location-pin mr-20"></i><span class="right-nav-text">Site Locations</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>

        <li><hr class="light-grey-hr mb-10"/></li>

        <li class="navigation-header">
            <span>Customers</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="ti-briefcase mr-20 "></i><span class="right-nav-text">Customer Management</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="ui_dr" class="collapse collapse-level-1 two-col-list">

                {{--@can('business_owners.view' , \Illuminate\Support\Facades\Auth::user())--}}
                    {{--<li>--}}
                        {{--<a  href="{{route('business_owner.index')}}">Business Owners</a>--}}
                    {{--</li>--}}
                {{--@endcan--}}

                    {{--@can('franchises.view' , \Illuminate\Support\Facades\Auth::user())--}}
                        {{--<li>--}}
                            {{--<a  href="{{route('franchise.index')}}">Manage Franchises</a>--}}
                        {{--</li>--}}
                    {{--@endcan--}}

                {{--@can('business_groups.view' , \Illuminate\Support\Facades\Auth::user())--}}
                    {{--<li>--}}
                        {{--<a  href="{{route('business_group.index')}}">Manage Retail Groups</a>--}}
                    {{--</li>--}}
                {{--@endcan--}}

                @can('sites.view' , \Illuminate\Support\Facades\Auth::user())
                    <li>
                        <a  href="{{route('business_sites.index')}}">Site Management</a>
                    </li>
                @endcan

            </ul>
        </li>

        @can('events.view' , \Illuminate\Support\Facades\Auth::user())
        <li><hr class="light-grey-hr mb-10"/></li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_ev"><div class="pull-left"><i class="ti-calendar mr-20 "></i><span class="right-nav-text">Customer Contact</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                <ul id="ui_ev" class="collapse collapse-level-1 two-col-list">
                    <li>
                        <a  href="{{route('events.index')}}">Customer Contact</a>
                    </li>
                </ul>
            </li>
        @endcan

        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_ta"><div class="pull-left"><i class="ti-archive mr-20 "></i><span class="right-nav-text">Task Manager</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="ui_ta" class="collapse collapse-level-1 two-col-list">
                <li>
                    @can('tasks.visitations_not_assigned' , \Illuminate\Support\Facades\Auth::user())
                        <a  href="{{route('overdue_visitations_without_tasks')}}">Visitations Not Assigned Tasks</a>
                    @endcan

                    @can('tasks.visitations_assigned' , \Illuminate\Support\Facades\Auth::user())
                        <a  href="{{route('overdue_visitations_with_tasks')}}">Assigned Tasks</a>
                    @endcan
                    <a  href="{{route('tasks_assigned_to_users')}}">My Tasks</a>
                </li>
            </ul>
        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_price"><div class="pull-left"><i class="ti-bolt mr-20 "></i><span class="right-nav-text">Quick Access</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="ui_price" class="collapse collapse-level-1 two-col-list">
                <li>
                    {{--@can('business_owners.view' , \Illuminate\Support\Facades\Auth::user())--}}
                        {{--<a  href="{{route('get_all_contacts')}}">Contacts</a>--}}
                    {{--@endcan--}}

                    <a  href="{{route('get_all_visitations')}}">Visitations</a>

                    @can('invoices.view' , \Illuminate\Support\Facades\Auth::user())
                        <a  href="{{route('get_all_invoices')}}">Invoices</a>
                    @endcan
                </li>
            </ul>
        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_upload"><div class="pull-left"><i class="ti-upload mr-20 "></i><span class="right-nav-text">Manage Uploads</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="ui_upload" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a  href="{{route('sites_uploads_view')}}">Bulk Upload Sites</a>
                    {{--<a  href="{{route('file_export_view')}}">Bulk Upload Stock Quantity</a>--}}
                </li>
            </ul>
        </li>

        <li class="navigation-header">
            <span>Settings</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#user_dr"><div class="pull-left"><i class=" ti-user mr-20 "></i><span class="right-nav-text ">User Management</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="user_dr" class="collapse collapse-level-1 two-col-list">
                @can('users.view_users' , \Illuminate\Support\Facades\Auth::user())
                    <li>
                        <a href="{{route('users.index')}}">Users</a>
                    </li>
                @endcan

                @can('roles.view' , \Illuminate\Support\Facades\Auth::user())
                    <li>
                        <a href="{{route('roles.index')}}">Roles</a>
                    </li>
                @endcan

                {{--<li>--}}
                    {{--<a href="{{route('permissions.index')}}">Permissions</a>--}}
                {{--</li>--}}
            </ul>
        </li>

        @can('set_date_flag.view' , \Illuminate\Support\Facades\Auth::user())
            <li><hr class="light-grey-hr mb-10"/></li>
            <li>
                <a href="{{route('validateSetDate')}}"><div class="pull-left"><i class=" ti-alarm-clock mr-20"></i><span class="right-nav-text">Set Visitation Date Flag</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
            </li>
        @endcan


        @can('sites.restore_sites' , \Illuminate\Support\Facades\Auth::user())
            <li><hr class="light-grey-hr mb-10"/></li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#restore"><div class="pull-left"><i class="icon-reload mr-20 "></i><span class="right-nav-text ">Restore Management</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                <ul id="restore" class="collapse collapse-level-1 two-col-list">
                        <li>
                            <a href="{{route('deleted_sites')}}">Restore Sites</a>
                        </li>
                </ul>
            </li>
        @endcan


        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a  href="{{route('franchise.index')}}"><div class="pull-left"><i class="  ti-world mr-20"></i><span class="right-nav-text">Manage Franchises </span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>


        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#activity_dr"><div class="pull-left"><i class=" ti-clipboard mr-20  "></i><span class="right-nav-text">View Activities</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="activity_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="{{route('activity_log')}}">Activity Log</a>
                </li>

            </ul>
        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="{{route('logout_user')}}"><div class="pull-left"><i class="ti-lock mr-20"></i><span class="right-nav-text">Logout</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>

    </ul>
</div>