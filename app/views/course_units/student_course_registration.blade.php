@extends('layouts.dashboard')

 @section('content')
 	<div class="wrapper">

 		<legend>Course Registration Unit</legend>

 			<div class="row-fluid">

 				<label style="text-align: center; color:green;">Registered Subjects for <span id="spanyear">2017-2018</span> Academic Year and Semester <span id="spansem">1</span></label><br>
 				<label style="text-align: center;">You have registered for <span id="spancredits" style="color:red;">0</span> (Confirm) Credits for this semester</label><br>
 					<div class="row-fluid">
 						<table class="table table-striped">
 							<thead>
 								<tr>
	 								<th>Course Code</th>
	 								<th>Course Name</th>
	 								<th>Degree Status</th>
	 								<th>Prerequisites</th>
	 								<th>Current Status</th>
	 								<th>Submit as</th>
 								</tr>
 							</thead>
 							<tbody>
 								<tr>
 									<td>{{ $id }}</td>
 								</tr>
 							</tbody>
 						</table>
 					</div>
				<div class="span4"></div>
 					
 			</div>
 	</div>
 @endsection