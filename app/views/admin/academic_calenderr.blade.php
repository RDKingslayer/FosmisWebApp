@extends('layouts.dashboard')

@section('css')
   <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
   <link href="/css/style.css" rel="stylesheet"> 
   <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />  
@stop


@section('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script><script type="text/javascript">

   $(function () {
            $("#start_date").datepicker({
            	changeMonth: true,
            	changeYear: true,
             //   numberOfMonths: 2,
                dateFormat: 'yy-mm-dd',
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() + 1);
                    $("#end_date").datepicker("option", "minDate", dt);
                }
            });
            $("#end_date").datepicker({
            	changeMonth: true,
           		changeYear: true,
               // numberOfMonths: 2,
                dateFormat: 'yy-mm-dd',
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#start_date").datepicker("option", "maxDate", dt);
                }
            });
        });


	

</script> 
		              
		        
@stop


@section('content')

<div class="span12">
   <div class="span0.5"></div>
	<div class="well span11">

	   @if(isset($current_year))	
	   <legend>Update {{$current_year->academic_year_id}} Academic Year</legend>
	   	<form class="form-horizontal" method="post" id="" action="{{ URL::Route('post_academic_calender', $current_year->academic_year_id)}}" name="" >
     	@else  
		<legend>Add New Academic Year</legend>
			<form class="form-horizontal" method="post" id="" action="{{ URL::Route('post_academic_calender')}}" name="" >
		@endif

			<!-- Academic Year -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Academic Year</label>
            </div>
	         <div class="span4 row-fluid">
	         @if(isset($current_year))
	         	<input name="academic_year" id="academic_year" class="input-large" type="text" value="{{$current_year->academic_year_id}}" readonly required>
	         @else 
               <input name="academic_year" id="academic_year" class="input-large" type="text" required>
            @endif
				</div>
        	</div>	
</br>

        	<!-- Starting Date -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Starting Date</label>
            </div>
	         <div class="span4 row-fluid">
	         @if(isset($current_year))
               <input name="start_date" id="start_date" class="input-large" type="date" value="{{$current_year->starting_date}}" required>
				@else
					<input name="start_date" id="start_date" class="input-large" type="date" required>
				@endif
				</div>
        	</div>	
</br>

        	<!-- End Date -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >End Date</label>
            </div>
	         <div class="span4 row-fluid">
	         @if(isset($current_year))
               <input name="end_date" id="end_date" class="input-large" type="date" value="{{$current_year->ending_date}}" required>
				@else
					<input name="end_date" id="end_date" class="input-large" type="date" required>
				@endif
				</div>
        	</div>	
</br>
        	<!-- submit button -->
        	<div class="row-fluid" style ="margin-bottom: 7px;">
            <div class="span6">
                <label class="control-labelme" for="submit"></label>
            </div>

            <div class="pull-left">
            @if(isset($current_year))
               <button id="submit" name="submit" class="btn btn-primary" >Update</button>
            @else
            	<button id="submit" name="submit" class="btn btn-primary" >Start</button>
            @endif
            </div>
         </div>
     </form>

			<?php
				$academic_year_details=AcademicYear::where('current1',1)->first();
				$semester=Semester::where('academic_year_id',$academic_year_details->academic_year_id)->where('status',1);
			?>




				<table id="view_academic_year" class="table table-bordered ">
    				<thead>
        				<tr>
			            <th>Current Academic Year </th>
			            <th>Start Date</th>
			            <th>End Date</th>
			            <th></th>
        				</tr>
	 				</thead>
	 				
	 				<tbody>
	 					<tr>
	 						<td>{{$academic_year_details->academic_year_id}}</td>
	 						<td>{{$academic_year_details->starting_date}}</td>
	 						<td>{{$academic_year_details->ending_date}}</td>
	 						<td><a href="{{URL::route('academic_calender', $academic_year_details->academic_year_id)}}" >
	 							<button class="btn btn-success btn-small ">Edit</button>
	 							</a>
	 						</td>
	 					</tr>
	 				</tbody>
	 			</table>

	 <?php if($semester->count()<19)  {?>                
	            <div class="alert alert-danger alert-dismissible">
	               <p>You have successfully added new Academic Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	               		<a href="{{URL::route('academic_calender_define', $academic_year_details->academic_year_id)}}" >
		               <button type="button" class="btn btn-warning btn-small">
		               	Define Academic Calender
		               </button>
		           </a>
	               </p>
	            </div>
	       <?php } ?>






    



   

       
     

   </div> 
</div>
@stop
