@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
   	<link href="/css/style.css" rel="stylesheet">    
@stop


@section('js')

<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript">
    
    window.open("http://www.laravel.com", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500,left=500,width=400, height=400");    
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

     $(window).load(function(){        
   $('#myModal').modal('show');
    });
    
</script>

@stop

@section('content')
<?php

	$batch_get_academic=Batch::orderBy('academic_year_id','DESC')->where('level_id','=',1 )->first()->batch_id;
    
	$previous = CallCombinationRegistration::orderBy('batch','DESC')->where('academic_year_id','=',$current_year->academic_year_id )->first();

?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Combination Registration - Academic Year: {{$current_year->academic_year_id}}</h4>
      </div>
      <div class="modal-body">
            <div class="well span11">
   
                <form class="form-horizontal" method="post" id="combi" action="{{ URL::Route('post-combination-registration', $current_year->academic_year_id)}}" name="" data-toggle="validator">


                <!-- batch -->
                <div class="row-fluid" style ="margin-left: 45px;" >
                    <div class="span4">
                       <label class="control-labelme" for="" >Batch</label>
                    </div>
                    <div class="span4 row-fluid">

                    <!--	<input name="batch" id="batch" class="input-large" type="text" value='{{$batch_get_academic}}' placeholder="eg: 2018"> -->
                        <input name="batch" id="batch" class="input-large" type="text" value='{{$combination_registration->batch}}'  disabled>
                        <input type="hidden" name="ac_yr" id="ac_yr" class="input-large" type="text" value='{{$current_year->academic_year_id}}'>
                    </div>
                </div>
                <br>

                <!-- Start Date -->
                <div class="row-fluid" style ="margin-left: 45px;" >
                    <div class="span4">
                       <label class="control-labelme" for="" >Academic Year Start Date</label>
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
                       <label class="control-labelme" for="" >Academic Year End Date</label>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
             </form>
        </div>
              </div>
    <!--          <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> -->
            </div>

          </div>
        </div>






<!--Student Part is Deleted from this View-->

@stop