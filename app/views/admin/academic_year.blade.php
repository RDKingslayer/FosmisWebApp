@extends('layouts.dashboard')

@section('css')
   <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
   <link href="/css/style.css" rel="stylesheet"> 
   <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />  
@stop


@section('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<script type="text/javascript">
	$(document).ready(function(){
		//datepicker functions
    	$(function() {
        	$( "#start_date,#end_date,#sem_start_date,#sem_end_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-1:+2",
            dateFormat: 'yy-mm-dd',
        	});
      });
		
		$(".General").hide();
		$(".BSc_Special").hide();
		$(".BCS_Special").hide();

		$('#degree').change(function(){
			var degree=$('#degree').val();

           switch(degree)
               {
               case 'BSc (General)':
               	$(".General").show();
						$(".BSc_Special").hide();
						$(".BCS_Special").hide();
               break;
               
               case 'BCS (General)':
               	$(".General").show();
						$(".BSc_Special").hide();
						$(".BCS_Special").hide(); 
               break;

               case 'BCS (Special)':
               	$(".General").hide();
						$(".BSc_Special").hide();
						$(".BCS_Special").show(); 
               break;               
               case 'BSc (Special) in Zoology':
                  $(".General").hide();
						$(".BSc_Special").show();
						$(".BCS_Special").hide(); 
               break;

               case 'BSc (Special) in Physics':
                	$(".General").hide();
						$(".BSc_Special").show();
						$(".BCS_Special").hide(); 
               break;

               case 'BSc (Special) in Chemistry':
                	$(".General").hide();
						$(".BSc_Special").show();
						$(".BCS_Special").hide(); 
               break;

               case 'BSc (Special) in Mathematics':
                	$(".General").hide();
						$(".BSc_Special").show();
						$(".BCS_Special").hide(); 
               break;

               case 'BSc (Special) in Botany':
                	$(".General").hide();
						$(".BSc_Special").show();
						$(".BCS_Special").hide(); 
               break;
               } 
		});

               $(".fancybox").fancybox();
    	
    				$(".various2").fancybox({

						maxWidth  	: 850,
				    	maxHeight 	: 350,
				    	fitToView 	: false,
				    	width     	: '70%',
				    	height    	: '70%',
				    	autoSize  	: false,
				    	closeClick  : false,
				    	openEffect  : 'none',
				    	closeEffect : 'none',
				    	afterClose	: function () { 
				        parent.location.reload(true);
				      	}
			  		});

			      // start function for onchange #new_title
		         $('.level').bind("keyup change", function() {
		         var academic_yr 	= $('#academic_yr').val();
		         var degree 			= $('#degree').val();
		         var semester 		= $('#semester').val();
		         var level 			= this.id;

		            $.ajax({
		               url: "{{ URL::Route('check-semester')}}",
		               data: {academic_yr: academic_yr, degree: degree, semester:semester, level:level}, 
		               dataType: 'json',
		               type: 'POST',
		               success: function (res) 
		               { 

			               if (res == '1'){
			                  $('#status_semester').html('<img src="/img/accepted.png" align="absmiddle">');        
			               }
			             
			                else{
			                  $('#status_semester').html('<img src="/img/error.png"><font color="red">&nbsp;semester is already existed.</font>'); 
			               }  
		            	}	
		         	});
		      	});
   });

</script>

@stop

@section('content')


	<div class="well span8">

	   @if(isset($current_year))	
	   <legend>Update {{$current_year->academic_year_id}} Academic Year</legend>
	   	<form class="form-horizontal" method="post" id="" action="{{ URL::Route('post-academic-year', $current_year->academic_year_id)}}" name="" >
     	@else  
		<legend>Add New Academic Year</legend>
			<form class="form-horizontal" method="post" id="" action="{{ URL::Route('post-academic-year')}}" name="" >
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
	 						<td><a href="{{URL::route('academic_year', $academic_year_details->academic_year_id)}}" >
	 							<button class="btn btn-success btn-small ">Edit</button>
	 							</a>
	 						</td>
	 					</tr>
	 				</tbody>
	 			</table>
				
				<?php if($semester->count()<19)  {?>                
	            <div class="alert alert-danger alert-dismissible">
	               <p>You have successfully added new Academic Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		               <button type="button" class="btn btn-warning btn-small" data-toggle="collapse" data-target="#collapse">
		               	Define Semester
		               </button>
	               </p>
	            </div>	
            <?php } else { ?>
	            <div class="alert alert-danger alert-dismissible">
	               <p>You have successfully added new Academic Year and all Semesters&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	               </p>
	            </div>

            <?php } ?> 		
				  
			  	<div id="collapse" class="collapse">
			  	<legend>Define Semester for {{$academic_year_details->academic_year_id}}</legend>
			  	<form class="form-horizontal" method="post" id="" action="{{ URL::Route('post-semester')}}" name="" >
        		
        		<input name="academic_yr" id="academic_yr" type="hidden"	value="{{$academic_year_details->academic_year_id}}">
        			<!-- semester -->
		        	<div class="row-fluid" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" >Semester</label>
		            </div>
			         <div class="span4 row-fluid">
							<select name="semester" id="semester" required>
								<option></option>
								<option>1</option>
								<option>2</option>
							</select>
						</div>
		        	</div>
</br>
			  		<!-- semester start date -->
		        	<div class="row-fluid" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" >Starting Date</label>
		            </div>
			         <div class="span4 row-fluid">
		               <input name="sem_start_date" id="sem_start_date" class="input-large" type="text" required>
						</div>
						<div class="span4" id="status_semester">
						</div>
		        	</div>	
</br>
		
        			<!-- semester end date -->
		        	<div class="row-fluid" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" >End Date</label>
		            </div>
			         <div class="span4 row-fluid">
							<input name="sem_end_date" id="sem_end_date" class="sem_start_date-large" type="date" required>
						</div>
		        	</div>	
</br>
		        	<!-- Degree -->
		        	<?php 
		        	$degree=Degree::all();
		        	?>		        	
		        	<div class="row-fluid" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" >Degree</label>
		            </div>
			         <div class="span4 row-fluid">
							<select id="degree" name="degree" required>
								<option></option>
								@foreach($degree as $degree)
								<option id="{{$degree->Degree_name}}">{{$degree->Degree_name}}</option>
								@endforeach
							</select>
						</div>
		        	</div>
</br>
		        	<div class="row-fluid General" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span8 row-fluid">
		            		<input id="1" name="level[]" type="checkbox" class="level" value="1">Level 1
		            </div>
		         </div>
		         <div class="row-fluid General" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span8 row-fluid">
		            		<input id="2" name="level[]" type="checkbox" class="level" value="2">Level 2
		            </div>
		         </div>	         
		         <div class="row-fluid General" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span8 row-fluid">
		            		<input id="3" name="level[]" type="checkbox" class="level" value="3">Level 3
		            </div>
		         </div>
</br>
		        	<div class="row-fluid BSc_Special" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span4 row-fluid">
		            		<input id="1" name="level[]" type="checkbox" class="level" value="1">Level 1
		          	</div>
		         </div>
		         <div class="row-fluid BSc_Special" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span4 row-fluid">
		            		<input id="2" name="level[]" type="checkbox" class="level" value="2">Level 2
		         	</div>
		         </div>
</br>
		         <div class="row-fluid BCS_Special" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span4 row-fluid">
		            		<input id="4" name="level[]" type="checkbox" class="level" value="4">Level 4
		         	</div>
		         </div>
</br>
		        	<!-- submit button -->
		        	<div class="row-fluid" style ="margin-bottom: 7px;">
		            <div class="span6">
		                <label class="control-labelme" for="submit"></label>
		            </div>

		            <div class="pull-left">
		            	<button id="submit" name="submit" class="btn btn-primary" >Start</button>
		            </div>
		         </div>
		     	</form>	        	
			  	</div>

			<?php
				$semester_details=Semester::where('academic_year_id',$academic_year_details->academic_year_id)->where('status',1)->get();
			?>

				<table id="view_semesters" class="table table-bordered ">
    				<thead>
        				<tr>
			            <th>Semester</th>
			            <th>Degree</th>
			            <th>Level</th>
			            <th>Start Date</th>
			            <th>End Date</th>
        				</tr>
	 				</thead>
	 				
	 				<tbody>
	 				@foreach($semester_details as $semester_details)
	 					<tr>
	 						<td>{{$semester_details->semester_id}}</td>

	 						<?php 
	 						$degree_name=Degree::where('Degree_id',$semester_details->degree_id)->first()->Degree_name;
	 						?>
	 						<td>{{$degree_name}}</td>
	 						
	 						<td>Level {{$semester_details->level_id}}</td>
	 						<td>{{$semester_details->start_date}}</td>
	 						<td>{{$semester_details->end_date}}</td>

	 						<td><a href="{{ URL::Route('update-semester')}}" class="various2 fancybox fancybox.iframe">
	 							<button class="btn btn-success btn-small ">Edit</button>
	 							</a>
	 						</td>
	 					</tr>
	 				@endforeach
	 				</tbody>
	 			</table>
		</form>
	</div>
  
@stop
