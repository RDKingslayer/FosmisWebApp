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

    });

</script>

@stop

@section('content')

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
	        	<input name="start_date" id="start_date" class="input-large" type="text" value="{{ $previous->start_date }}" @if($start == 0) disabled @endif>
			
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
	        	<input name="end_date" id="end_date" class="input-large" type="text" placeholder="yyyy/mm/dd" value="{{ $previous->end_date }}" >
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
	@if($errors->has('start_date') )

			<label class="label-warning" style="text-align: center">
					{{ $errors->first('start_date') }}
			</label>

	@endif
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

			@endif
			</tbody>
		</table>
		
   	</div>
</div>


@stop