@extends('layouts.popup')

@section('css')
   <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
   <link href="/css/style.css" rel="stylesheet">  
@stop

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
    	$(function() {
        	$( "#start_date,#end_date,#sem_start_date,#sem_end_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-1:+2",
            dateFormat: 'yy-mm-dd',
        	});
      });
    });
</script>
@stop

@section('content')
<div class="span12">
   <div class="span2"></div>
	<div class="well span8">
		<legend>Define Semester for {{$academic_year_details->academic_year_id}}</legend>
			<form class="form-horizontal" method="post" id="" action="{{ URL::Route('post-semester')}}" name="" >
        			
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
		            		<input id="level" name="level[]" type="checkbox" value="1">Level 1
		            </div>
		         </div>
		         <div class="row-fluid General" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span8 row-fluid">
		            		<input id="level" name="level[]" type="checkbox" value="2">Level 2
		            </div>
		         </div>	         
		         <div class="row-fluid General" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span8 row-fluid">
		            		<input id="level" name="level[]" type="checkbox" value="3">Level 3
		            </div>
		         </div>
</br>
		        	<div class="row-fluid BSc_Special" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span4 row-fluid">
		            		<input id="level" name="level[]" type="checkbox" value="1">Level 1
		          	</div>
		         </div>
		         <div class="row-fluid BSc_Special" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span4 row-fluid">
		            		<input id="level" name="level[]" type="checkbox" value="2">Level 2
		         	</div>
		         </div>
</br>
		         <div class="row-fluid BCS_Special" style ="margin-left: 45px;" >
		            <div class="span4">
		               <label class="control-labelme" for="" ></label>
		            </div>
		            <div class="span4 row-fluid">
		            		<input id="level" name="level[]" type="checkbox" value="4">Level 4
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
   		<div class="span2"></div>
		</div>       	
@stop
