
<style>


    #sidebar-nav {
        width: 281px;
    }
.logo-side-nav {
    margin-top: 33px;
    margin-bottom: 115px;
}


.full-logo{
    width:160px;
}
.nav-item {
    height: 66px;
    width: 100%;
    padding: 12px 0 0 42px;
    /* margin-bottom: 30px !important; */
}

/* Space betweeen nav italic tag icon and th actual text */
.nav-item i {
    padding-right: 18px;
}

/* Hover on a nav-item */
.nav-item:hover {
    background: #dfe9ff;
    color: #092D85 !important;
    border-right: 4px solid #092D85;
}
.nav-item a:hover{
    color: #092D85 !important;
}


/* Nav active */
.nav-active {
    background: #dfe9ff;
    color: #092D85 !important;
    border-right: 4px solid #092D85;
}
.nav-active a{
    color: #092D85 !important;
}


@media screen and (min-width:250px) and (max-width:320px){
    #sidebar-nav {
        width: 170px;
    }
    #app-data{

    }
    .mini-logo{
        /* display: block !important; */
    }

    .full-logo{
        width: 122px;
    }

    .nav-item {
        height: 48px;
        width: 100%;
        margin-bottom: 19px !important;

    }

    .nav-link{
        padding:0 !important;
        margin-left: -13px !important;
    }

    .nav-item .fa{
        font-size: 20px !important;
    }
    .nav-item i {
        padding-right: 4px;
    }

}

@media screen and (min-width:320px) and (max-width:480px){
    #sidebar-nav {
        /* width: 65px; */
        width: 190px;
    }
    .mini-logo{
        /* display: block !important; */
    }

    .full-logo{
        /* display: none !important; */
    }

    .nav-item {
        height: 48px;
        width: 100%;
        margin-bottom: 19px !important;
    }

    .nav-link{
        padding:0 !important;
        margin-left: -13px !important;
    }

    .nav-item .fa{
        font-size: 20px !important;
    }

    .nav-item i {
        padding-right: 6px;
    }

}

@media screen and (min-width:480px) and (max-width:600px){

    #sidebar-nav {
        width: 200px;
        /* width: 70px; */
    }
    .mini-logo{
        /* display: block !important; */
    }

    .full-logo{
        /* display: none !important; */
    }

    .nav-item {
        height: 50px;
        width: 100%;
        margin-bottom: 24px !important;
    }

    .nav-link{
        padding:0 !important;
        margin-left: -13px !important;
    }

    .nav-item .fa{
        font-size: 24px !important;
    }

    .nav-item i {
        padding-right: 8px;
    }
}

@media screen and (min-width:600px) and (max-width:801px){

    #sidebar-nav {
        /* width: 70px; */
        width: 210px;

    }
    .mini-logo{
        /* display: block !important; */
    }

    .full-logo{
        /* display: none !important; */
    }

    .nav-item {
        height: 50px;
        width: 100%;
        margin-bottom: 24px !important;
    }

    .nav-link{
        padding:0 !important;
        margin-left: -13px !important;
    }

    .nav-item .fa{
        font-size: 24px !important;
    }
}

@media screen and (min-width:801px) and (max-width:1025px){
     #sidebar-nav {
        width: 240px;
    }
}

@media screen and (min-width:1025px) and (max-width:1281px){
    #sidebar-nav {
        width: 270px;
    }
}


</style>

<div class="col-auto px-0" style="background: #FFFFFF;">
    <div id="sidebar" class="collapse collapse-horizontal show border-end">
        <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
            <div class="mx-auto logo-side-nav">
                <h2 class="fw-bold " style="color:#092D85;">Activity App</h2>
                {{-- <img style="display: none;" class="mini-logo" src="assets/images/account/bhss-mini-logo.svg" alt="" srcset=""> --}}

            </div>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start nav-ul " id="menu">

                <li  class="nav-item  {{ request()->route()->named("admin.activities.dashboard") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.activities.dashboard') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-home"></i><span class="ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->route()->named("admin.users.index") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-user-circle"></i><span class="ms-1">Users</span>
                    </a>
                </li>

                  <li class="nav-item {{ request()->route()->named("admin.activities.index") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.activities.index') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-list"></i><span class="ms-1">Activities</span>
                    </a>
                </li>

{{--
                <li class="nav-item {{ request()->route()->named("admin.category.index") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.category.index') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-list"></i><span class="ms-1">Category</span>
                    </a>
                </li> --}}

                {{-- @can('manage-post')
                    <li class="nav-item {{ request()->route()->named("admin.post.article") || request()->route()->named("admin.post.video") || request()->route()->named("admin.post.audio") || request()->route()->named("admin.post.event") ? 'nav-active' : '' }}">
                        <a href="{{ route('admin.post.article') }}" class="nav-link text-truncate text-muted">
                            <i class="fa fa-rss"></i><span class="ms-1">Post</span>
                        </a>
                    </li>
                @endcan

                @can('manage-testimony')
                    <li class="nav-item {{ request()->route()->named("admin.testimonial.index") ? 'nav-active' : '' }}">
                        <a href="{{ route('admin.testimonial.index') }}" class="nav-link text-truncate text-muted">
                            <i class="fa fa-bullhorn"></i><span class="ms-1">Testimony</span>
                        </a>
                    </li>
                @endcan

                @can('manage-user')
                <li class="nav-item {{ request()->route()->named("admin.user.index") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.user.index') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-users"></i><span class="ms-1">People</span>
                    </a>
                </li>
                @endcan


                 @can('manage-livestream')
                <li class="nav-item {{ request()->route()->named("admin.liveStreaming.index") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.liveStreaming.index') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-play"></i><span class="ms-1">Live Stream</span>
                    </a>
                </li>
                @endcan


                @can('manage-service')
                 <li class="nav-item {{ request()->route()->named("admin.service.index") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.service.index') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-list"></i><span class="ms-1">Service</span>
                    </a>
                </li>
                @endcan

                  @can('manage-attendance')
                <li class="nav-item {{ request()->route()->named("admin.attendance.index") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.attendance.index') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-calendar"></i><span class="ms-1">Attendance</span>
                    </a>
                </li>
                 @endcan


                  @can('manage-role')
                <li class="nav-item {{ request()->route()->named("admin.role.index") ? 'nav-active' : '' }}">
                    <a href="{{ route('admin.role.index') }}" class="nav-link text-truncate text-muted">
                        <i class="fa fa-cogs"></i><span class="ms-1">Role</span>
                    </a>
                </li>
                 @endcan --}}

            </ul>
        </div>
    </div>
</div>
