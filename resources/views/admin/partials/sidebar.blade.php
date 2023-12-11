<!-- Sidebar -->
<!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
          If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
      -->
<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-5">
            <!-- Logo -->
            <a class="fw-semibold text-white tracking-wide" href="/">

                <span class="smini-hidden">
                    ezcafe
                </span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                {{-- <!-- Toggle Sidebar Style -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </button>
                <!-- END Toggle Sidebar Style --> --}}

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times-circle"></i>
                </button>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                {{-- <li class="nav-main-item">
                    <a class="nav-main-link {{ active_class('admin.dashboard') }}" href="{{ route('admin.dashboard') }}">
                        <i class="nav-main-link-icon fa fa-house"></i>
                        <span class="nav-main-link-name">داشبورد</span>
                    </a>
                </li> --}}

                <li class="nav-main-item {{ open_class(['admin.foods.*', 'admin.categories.*']) }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-bullhorn"></i>
                        <span class="nav-main-link-name">منو</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ active_class('admin.foods.index') }}" href="{{ route('admin.foods.index') }}">
                                <span class="nav-main-link-name">لیست غذاها</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ active_class('admin.categories.*') }}" href="{{ route('admin.categories.index') }}">
                                <span class="nav-main-link-name">دسته بندی ها</span>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- <li class="nav-main-item">
                    <a class="nav-main-link {{ active_class('admin.filemanager.index') }}" href="{{ route('admin.filemanager.index') }}">
                        <i class="nav-main-link-icon fa fa-folder"></i>
                        <span class="nav-main-link-name">فایل ها</span>
                    </a>
                </li> --}}

                <li class="nav-main-item">
                    <a class="nav-main-link {{ active_class('admin.settings') }}" href="{{ route('admin.settings') }}">
                        <i class="nav-main-link-icon fa fa-cog"></i>
                        <span class="nav-main-link-name">تنظیمات</span>
                    </a>
                </li>
                <li class="nav-main-heading">دیگر</li>

                <li class="nav-main-item {{ open_class(['admin.admins.*']) }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-user-gear"></i>
                        <span class="nav-main-link-name">مدیرها</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ active_class('admin.admins.index') }}" href="{{ route('admin.admins.index') }}">
                                <span class="nav-main-link-name">لیست مدیرها</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ active_class('admin.admins.create') }}" href="{{ route('admin.admins.create') }}">
                                <span class="nav-main-link-name">افزودن مدیر</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" target="_blank" href="{{ route('log-viewer.index') }}">
                        <i class="nav-main-link-icon fa fa-bug"></i>
                        <span class="nav-main-link-name">لاگ ها</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
