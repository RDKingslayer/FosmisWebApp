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
