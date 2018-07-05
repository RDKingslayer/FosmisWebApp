@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
   	<link href="/css/style.css" rel="stylesheet">    
@stop


@section('js')

<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
    	$(function() {
        	$( "#start_date,#end_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-1:+2",
            dateFormat: 'yy-mm-dd',
        });
            
        });
        //delete requested priority
    	$('.edit_priority').click(function() {
	        var uname = this.id;

	    	alert("You have to make choices again after click on this button!");
				$.ajax({
					url: "{{ URL::Route('edit_combination_priority')}}",
					data: {name: uname}, 
					dataType: 'json',
					type: 'POST',

					success: function (res) { 
					 	if (res == '1'){
					 		alert("Error!");
					 	}else{
						 	location.reload();
						}	
					} 
		        });
      });


    //request combination with priority
	$('.combination_priority').on('change', function (){
		var priority = $(this).val();
		if(priority==""){

		}else{
			var combination_id= this.name;
			var student_id_academic=this.id;
			$.ajax({
				url: "{{ URL::Route('combination_priority')}}",
				data: {priority: priority,combination_id: combination_id,student_id_academic: student_id_academic}, 
				dataType: 'json',
				type: 'POST',

				success: function (res) { 
				 	if (res == '1'){
				 		alert("Please delete your previous choices before submit same priority!");
				 	}else{
					 	location.reload();
					}	
				} 
	        });
		}
	});	
});

</script>

@stop

@section('content')
<?php
	$batch_get_academic=Batch::orderBy('academic_year_id','DESC')->where('level_id','=',1 )->first()->batch_id;
	$previous = CallCombinationRegistration::orderBy('batch','DESC')->where('academic_year_id','=',$current_year->academic_year_id )->first();
?>

<div class="well span8">
	   	<legend>Start Combination Registration for academic year {{$current_year->academic_year_id}}</legend>
		<form class="form-horizontal" method="post" id="" action="{{ URL::Route('post-combination-registration', $current_year->academic_year_id)}}" name="" novalidate>
	   	<!-- batch -->
	   	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Batch</label>
            </div>
	        <div class="span4 row-fluid">
	        	
            	<input name="batch" id="batch" class="input-large" type="text" value='{{$batch_get_academic}}'>
            	<input type="hidden" name="ac_yr" id="ac_yr" class="input-large" type="text" value='{{$current_year->academic_year_id}}'>
			</div>
		</div>
<br>

	   	<!-- Start Date -->
	   	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Academic Starting Date</label>
            </div>
	        <div class="span4 row-fluid">
            	<input name="academic_start_date" id="academic_start_date" class="input-large" type="date" value="{{$current_year->starting_date}}" disabled>
			</div>
		</div>
		<div class="row-fluid" style ="margin-left: 45px;" >
			<div class="span4">
               <label class="control-labelme" for="" >Registration Start Date</label>
            </div>
	        <div class="span4 row-fluid">
	        	<input name="start_date" id="start_date" class="input-large" type="date" required>
			
			</div>
        </div>	
</br>

    	<!-- End Date -->
    	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Academic End Date</label>
            </div>
         	<div class="span4 row-fluid">
        		<input name="academic_end_date" id="academic_end_date" class="input-large" type="date" value="{{$current_year->ending_date}}" disabled>
			</div>
    	</div>
    	<div class="row-fluid" style ="margin-left: 45px;" >
			<div class="span4">
               <label class="control-labelme" for="" >Registration End Date</label>
            </div>
	        <div class="span4 row-fluid">
	        	<input name="end_date" id="end_date" class="input-large" type="date" required>
			</div>
    	</div>	
</br>

    	<!-- submit button -->
    	<div class="row-fluid" style ="margin-bottom: 7px;">
	        <div class="span6">
	            <label class="control-labelme" for="submit"></label>
	        </div>
	        <div class="pull-left">
				<button id="submit" name="submit" class="btn btn-primary" >Submit </button>
	        </div>
        </div>
     </form>

     <!-- Previous Combination Registration -->
     <div class="well table-responsive" >
		<legend>Previous Details</legend>

		<table id="combination_registration" class="table table-bordered ">
		    <thead>
		        <tr>
		            <th>Batch</th>
		            <th>Academic Year</th>
		            <th>Start Date</th>
		            <th>End Date</th>
		            <th>Status</th>
		        </tr>
			 </thead>

			<tbody>
			@if($previous)
				<tr>
					<td>{{$previous->batch}}</td>
					<td>{{$previous->academic_year_id}}</td>
					<td>{{$previous->start_date}}</td>
					<td>{{$previous->end_date}}</td>
					
					@if($previous->status==1)
					<td>On</td>
					@else
					<td>Off</td>
					@endif					
				</tr>
			@else
			<?php $previous=NULL; ?>
			@endif
			</tbody>
		</table>
		
   	</div>
</div>
<!--Student -->

	<div class="well span8">
	   	<legend>Combination Registration for academic year {{$current_year->academic_year_id}}</legend>
		<form class="form-horizontal" method="" id="student_form" action="" name="" novalidate>
	   	
	   	<?php
			$today=date('Y-m-d');
			$role=Auth::user()->role;
			//$user_name=Auth::user()->user;
			$user_name="8991";
			$stream=NULL;
			$batch =NULL;
			if($role!='student'){
				$student_details=Student::where('student_id','=',$user_name )->first();
				if($student_details){
					$stream=$student_details->stream_id;
					$batch =$student_details->current_batch;
					$available_combinations=SubjectCombination::where('combination_id','LIKE',$stream.'%')->get();
					$available_combinations_count=SubjectCombination::where('combination_id','LIKE',$stream.'%')->count();

				}else{
					
				}
			}
		?>
		
		@if($previous)
			@if(($batch==$previous->batch) && ($today<=$previous->end_date) && ($previous->status==1))
				<table id="apply_combination" class="table table-bordered ">
				    <thead>
				        <tr>
				            <th>Combination</th>
				            <th>Priority</th>
				        </tr>
					 </thead>

					<tbody>
						@if($available_combinations)
							@foreach($available_combinations as $available_combinations)
								<tr>
									<td>
										<?php
											echo Subject::where('subject_id','=',$available_combinations->subject_id1)->first()->subject_name.'<br>';
											echo Subject::where('subject_id','=',$available_combinations->subject_id2)->first()->subject_name.'<br>';
											echo Subject::where('subject_id','=',$available_combinations->subject_id3)->first()->subject_name;
										?>
									</td>

									<td >
										<?php
											$id=$user_name.'/'.$current_year->academic_year_id ;
											$previous_registration = RequestCombination::where(['student_id'=>$user_name, 'combination_id'=>$available_combinations->combination_id,'academic_year_id'=>$current_year->academic_year_id])->first();
										?>
										@if($previous_registration)
											{{$previous_registration->priority}}
										@else
					                     	<select   name='{{$available_combinations->combination_id}}' id='{{$id}}' class="combination_priority" type="text" >
						                		<option></option>
						                		<?php
						                			if($available_combinations_count > 0){
							                  			for($i=1;$i<= $available_combinations_count;$i++) {
							                    				echo "<option>".$i."</option>";
							                  			}
						                			}
						                		?>
					              			</select>
				              			@endif
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="2">No need to request combination!</td>
							</tr>
						@endif					
					</tbody>
				</table>
			@else
				Combination registration is closed!
			@endif
		@endif
		<!-- Edit button -->
    	<div class="row-fluid" style ="margin-bottom: 7px;">
	        <div class="span6">
	            <label class="control-labelme" for="submit"></label>
	        </div>
	        <div class="pull-left">
				<button id="{{$user_name}}"  class="btn btn-primary edit_priority" > Edit </button>
	        </div>
        </div>
	   	</form>
	</div>

@stop