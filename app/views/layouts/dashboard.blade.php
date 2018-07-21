<!DOCTYPE html>
{{--Include Span 3 & 9--}}
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="" >
    <meta name="generator" content="">

    <!-- CSS -->
    <link rel="shortcut icon" href="/img/Ruhuna.ico" />
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/css/sidebar.css" rel="stylesheet">
    <style type="text/css">


        .navbar-inverse .brand
        {
            color:#ccc;
        }

        .navbar-inverse .nav li.dropdown a.dropdown-toggle
        {
            color:#ccc;
            font-weight:500;
        }

        .navbar-inverse .nav li.dropdown a.dropdown-toggle:hover
        {
            color:#fff;
        }

        .subtopic
        {
            text-transform: uppercase;
            color:#999999;
            font-weight: 600;
            font-size: 13px;

        }

    </style>

    <!-- Extra CSS -->
@yield('css')


<!-- JavaScript -->
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootbox.min.js"></script>




    <script type="text/javascript">
        $(document).ready(function(){

            $("<style>")
                .prop("type", "text/css")
                .html("\
                body {\
                  padding-top: 50px;\
              }\
              @media (max-width: 980px) {\
              body {\
                padding-top: 0;\
              }\
            }").appendTo("head");

        });
    </script>
    <!-- Extra JS -->
    @yield('js')

</head>

<body>
@if(Auth::user()->Role->role == 'system_admin')
    @include('layouts.navbar')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div  class="wrapper span3">
                    <div class="sidebar-wrapper">

                        <ul >
                            @yield('sidebar')
                        </ul>

                    </div>
                </div>
                @yield('content')
            </div>


        </div>

        <div class="row-fluid">


        </div>

    </div>

@elseif(Auth::user()->Role->role == 'C')
    @include('layouts.navbar1')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div  class="wrapper span3">
                    <div class="sidebar-wrapper">

                        @yield('sidebar')

                    </div>
                </div>
                @yield('content')
            </div>


        </div>

        <div class="row-fluid">


        </div>

    </div>

@elseif(Auth::user()->Role->role == "CAA")
    @include('layouts.navbar1')
    <div class="container-fluid">
        <div class="row-fluid">


            <div  class="span3">
                <div class="sidebar-wrapper">
                    <ul class="sidebar-nav nav-pills nav-stacked" id="menu_data_entry_op">
                        <li>
                            <a href="{{ URL::Route('daily_attendance')}}">
                                <i class="icon-book"></i>&nbsp;&nbsp;Add Attendance
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::Route('attendance_sheet')}}">
                                <i class="icon-print"></i>&nbsp;&nbsp;Print Attendance Sheet
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::route('manage_medicals')}}">
                                <i class="icon-file"></i>&nbsp;&nbsp;Manage Medicals
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::Route('attendance_search')}}">
                                <i class="icon-search"></i>&nbsp;&nbsp;Search
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            @yield('content')


        </div>

    </div>
@elseif(Auth::user()->Role->role  == 'student')
    @include('layouts.navbar2')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div  class="wrapper span3">
                    <div class="sidebar-wrapper">

                    @yield('sidebar')


                    <!--

         <h5>   <a href="#" data-toggle="collapse" data-target="#querybox1"> Course</a></h5>
         <br>
            <div id="querybox1" class="collapse">
                 <ul>
                <li><a href="{{ URL::Route('view_attendence')}}">View Attendence</a></li>
                  <br>
                <li> <a href="student_course_registration">Register Courses</a></li>
                  <br>
                <li><a href="#">View Examination Eligibility</a></li>
                  <br>
              </ul>
            </div>

            <h5>    <a href="#" data-toggle="collapse" data-target="#querybox2">  Examination</a> </h5>
              <br>
               <div id="querybox2" class="collapse">
                   <ul>
                     <li> <a href="#">View Results/GPA</a></li>
                       <br>
                      <li> <a href="#">Register Examination</a></li>
                        <br>
                   </ul>
              </div>

                <h5>   <a href="#" data-toggle="collapse" data-target="#querybox3"> Degree Requirements</a> </h5>
                  <br>
                  <div id="querybox3" class="collapse">
                 <ul>
                  <li> <a href="#">View Requirements</a></li>
                    <br>
                  <li><a href="#">Degree Status</a></li>
                    <br>
                 </ul>
              </div>  -->



                    </div>

                </div>
                @yield('content')

            </div>

        </div>

    </div>

@elseif(Auth::user()->Role->role  == 'HOD')
    @include('layouts.navbar3')
    <div class="container-fluid">
        <div class="row-fluid">

            <div class="span3">
                <div class="sidebar-wrapper">
                    <ul class="sidebar-nav nav-pills nav-stacked" id="menu_hod">
                        <li>
                            <span class="subtopic">Course Management</span>
                        </li>

                        <li>
                            <a href="{{URL::route('register_new_course')}}">
                                <i class="icon-th-list"></i>&nbsp;&nbsp;Register New Course
                            </a>
                        </li>

                        <li>
                            <span class="subtopic">Examination</span>
                        </li>

                        <li>
                            <a href="{{URL::route('set_eligibility_cutoff')}}">
                                <i class="icon-tags"></i>&nbsp;&nbsp;Set Exam Eligibility
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::route('view_exam_eligibility')}}">
                                <i class="icon-folder-open"></i>&nbsp;&nbsp;View Exam Eligibility
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @yield('content')


        </div>
    </div>
@elseif(Auth::user()->Role->role  == 'systemadmin')
    @include('layouts.navbar4')

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div  class="wrapper span3">
                    <div class="sidebar-wrapper">

                        <ul >
                            @yield('sidebar')
                        </ul>

                    </div>
                </div>
                @yield('content')
            </div>


        </div>

        <div class="row-fluid">


        </div>

    </div>
@endif


<footer class="white navbar-fixed-bottom">

    <div class="span12">
        <!-- Add Content to Footer -->
        @yield('footer')
    </div>

</footer>

</body>
</html>

