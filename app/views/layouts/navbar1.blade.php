<div id="navi" class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">

            <div class="nav-collapse collapse">
                <a class="brand" href="{{ URL::Route('daily_attendance')}}">
                    <span style="text-transform: lowercase;">Fosmis</span>

                </a>
                <!-- GENERAL -->
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">GENERAL
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">

                            <li>
                                <a href="{{ URL::Route('add-course-unit')}}">
                                    <i class="icon-book icon-black">
                                    </i> Register Course Unit
                                </a>
                            </li>

                            <li>
                                <a href="{{ URL::Route('view_timetable')}}">
                                    <i class="icon-book icon-black">
                                    </i> Semester Time Table
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Attendance -->
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ATTENDANCE
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ URL::Route('daily_attendance')}}">
                                    <i class="icon-book icon-black">
                                    </i> Add Daily Attendance
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::Route('edit_attendance')}}">
                                    <i class="icon-book icon-black">
                                    </i> Edit Attendance
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::Route('add_medical')}}">
                                    <i class="icon-book icon-black">
                                    </i> Add Medical
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- MANAGE -->
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">MANAGE
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ URL::Route('attendance_sheet')}}">
                                    <i class="icon-list icon-black">
                                    </i>Attendance Sheet
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::Route('drafts')}}">
                                    <i class="icon-list icon-black">
                                    </i>My Drafts
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::Route('show_timetable')}}">
                                    <i class="icon-list icon-black">
                                    </i>Semester TimeTable
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::Route('view-course-unit')}}">
                                    <i class="icon-list icon-black">
                                    </i>Modify Details/Availability
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::Route('offer-course-unit')}}">
                                    <i class="icon-ok icon-black">
                                    </i>Modify Offering Status
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::Route('call-combination')}}">
                                    <i class="icon-ok icon-black">
                                    </i>Call Combination
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::Route('search_students1')}}">
                                    <i class="icon-ok icon-black">
                                    </i>Assign Combination
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- ADMINISTRATION -->
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ADMINISTARTION
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ URL::Route('academic_year')}}">
                                    <i class="icon-plus icon-black">
                                    </i> Register Academic Year
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- COURSES -->
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">COURSES
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ URL::Route('add-course-unit')}}">
                                    <i class="icon-plus icon-black">
                                    </i> Register Course Unit
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>


                <ul class="nav pull-right">
                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Welcome, {{ ucwords(Auth::user()->l_name)." ".Auth::user()->initials}} ({{Auth::user()->Role->name}})
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="">
                                    <i class="icon-cog">
                                    </i> Preferences
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('sign-out') }}">
                                    <i class="icon-off">
                                    </i> Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
