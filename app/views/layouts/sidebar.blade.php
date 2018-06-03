

<div id="sidebar" class="well sidebar-nav fill">
	<ul class="nav nav-list">

@if(Auth::user()->role == 'admin')
			<li class="nav-header">GENERAL</li>

			<li>
				<a href="{{ URL::Route('add-course-unit')}}" >
					<i class="icon-book icon-black"></i> 
					Registre Course Units
				</a>
			</li>

		<li class="nav-header">MANAGE</li>

			<li >
				<a href="{{ URL::Route('view-course-unit')}}" >
					<i class="icon-list icon-black"></i> 
					Modify Details/Availability
				</a>
			</li>
			<li>
				<a href="{{ URL::Route('offer-course-unit')}}" >
					<i class="icon-ok icon-black"></i> 
					Modify Offering Status
				</a>
			</li>

		<li class="nav-header">Administration</li>
			<li >
				<a href="" >
					<i class="icon-list icon-black"></i> 
					Academic Year
				</a>
			</li>
@endif
	</ul>
</div><!--/.well -->