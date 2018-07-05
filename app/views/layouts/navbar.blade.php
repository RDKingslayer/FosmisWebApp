<div id="navi" class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">

            <div class="nav-collapse collapse">
               <a class="brand" href="">
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
                              <a href="{{ URL::Route('register-students')}}">
                                 <i class="icon-book icon-black">
                                 </i> Student Registration
                              </a>
                           </li>

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

               <!-- MANAGE -->
               <ul class="nav">
                   <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">MANAGE
                        <b class="caret"></b>
                     </a>
                        <ul class="dropdown-menu">
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
                              <a href="{{ URL::Route('assign_permanent_ids') }}">
                                 <i class="icon-ok icon-black">
                                 </i>Assign Permanent IDs
                              </a>
                           </li>
                        </ul>
                  </li>
               </ul>

               <!-- GENERAL -->
               <ul class="nav">
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">ADMINISTARTION
                        <b class="caret"></b>
                     </a>
                        <ul class="dropdown-menu">
                           <li>
                              <a href="{{ URL::Route('academic_year')}}">
                                 <i class="icon-plus icon-black">
                                 </i> Registre Academic Year
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
