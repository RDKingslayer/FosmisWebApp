@extends('layouts.dashboard')

@section('css')
	<link href="/css/jquery.dataTables.css" rel="stylesheet">  
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />   

    <style>

    	#G1,#G2,#S2,#SMAT,#SPHY,#SCHE,#SZOO,#SBOT  {
   				 display:none
				}
		.btn {background-color:green}
		
		td {text-align: center}

    </style>

@stop


@section('js')
<script type="text/javascript" src="/js/jquery.dataTables.js"></script>


<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<script type="text/javascript">
   	$(document).ready(function(){
		
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

  		$('.tabled').DataTable();


  	  	     	});











			   		$( document ).ready(function() {
			   			 $("#ReferredBy").change(function(){

				     		if ($(this).val()=="BSc (General)" ){

				          			$('#G1').show();
				          		
				          			
				     		 }
				    		 else{
				         			 $('#G1').hide();
							 }

							 if ($(this).val()=="BCS (General)" ){
				          			$('#G2').show();
				     		 }
				    		 else{
				         			 $('#G2').hide();
							 }

							 if ($(this).val()=="BCS (Special)" ){
				          			$('#S2').show();
				     		 }
				    		 else{
				         			 $('#S2').hide();
							 }
							 if ($(this).val()=="BSc (Special) in Physics" ){
				          			$('#SPHY').show();
				     		 }
				    		 else{
				         			 $('#SPHY').hide();
							 }
							 if ($(this).val()=="BSc (Special) in Chemistry" ){
				          			$('#SCHE').show();
				     		 }
				    		 else{
				         			 $('#SCHE').hide();
							 }
							 if ($(this).val()=="BSc (Special) in Mathematics" ){
				          			$('#SMAT').show();
				     		 }
				    		 else{
				         			 $('#SMAT').hide();
							 }
							 if ($(this).val()=="BSc (Special) in Zoology" ){
				          			$('#SZOO').show();
				     		 }
				    		 else{
				         			 $('#SZOO').hide();
							 }
							 if ($(this).val()=="BSc (Special) in Botany" ){
				          			$('#SBOT').show();
				     		 }
				    		 else{
				         			 $('#SBOT').hide();
							 }




						})
				});
</script>

<script type="text/javascript">



$.fn.inlineEdit = function(replaceWith, connectWith) {

    $(this).hover(function() {
        $(this).addClass('hover');
    }, function() {
        $(this).removeClass('hover');
    });

    $(this).click(function() {

        var elem = $(this);

        elem.hide();
        elem.after(replaceWith);
        replaceWith.focus();

        replaceWith.blur(function() {

            if ($(this).val() != "") {
                connectWith.val($(this).val()).change();
                elem.text($(this).val());
            }

            $(this).remove();
            elem.show();
        });
    });
};





</script>

<!--
<script type="text/javascript">

$( document ).ready(function() {

$(".btn[data-target='#myModal']").click(function() {
       var columnHeadings = $("thead th").map(function() {
                 return $(this).text();
              }).get();
       columnHeadings.pop();
       var columnValues = $(this).parent().siblings().map(function() {
                 return $(this).text();
       }).get();
  var modalBody = $('<div id="modalContent" class="modal-body"></div>');
  var modalForm = $('<form role="form" name="modalForm" action="updatecalander.php" method="post"></form>');
  $.each(columnHeadings, function(i, columnHeader) {
       var formGroup = $('<div class="form-group"></div>');
       formGroup.append('<label for="'+columnHeader+'">'+columnHeader+'</label>');
       formGroup.append('<input class="form-control" name="'+columnHeader+i+'" id="'+columnHeader+i+'" value="'+columnValues[i]+'" />'); 
       modalForm.append(formGroup);
  });
  modalBody.append(modalForm);
  $('.modal-body').html(modalBody);
});
$('.modal-footer .btn-primary').click(function() {
   $('form[name="modalForm"]').submit();
});
});



</script>

-->


@stop



@section('content')


<div class="span12">
   <div class="span1"></div>
	<div class="well span10">

	  		<?php

  				$academic_year = AcademicYear:: where('current1','=',1)->first()->academic_year_id;
  				$degree_name= DB::table('degree')->get();
  				$academic=AcademicCalender::where('acc_year','=',$academic_year)->where('degree','=','ALL')->where('level_id','=',5)->first();
	  				
				$y=$academic_year;
				$a=strtr ($y, array ('_' => '/'));
			?>

		<div>
			<center><h4><i>academic calendar for {{$a}} Academic Year</i></h4></center>
			<legend></legend>
		</br>
		</div>
		@if(isset($academic)&&isset($academic_year))
				<div>





							
					  					<?php
						
											$mid1=$academic->midvac1_start;
											$half1_end=date('Y-m-d', strtotime($mid1. ' - 1 day'));

											$mid1_end=$academic->midvac1_end;
											$half2_Start=date('Y-m-d', strtotime($mid1_end. ' + 1 day'));

											$mid2=$academic->midvac2_start;
											$half21_end=date('Y-m-d', strtotime($mid2. ' - 1 day'));

											$mid2_end=$academic->midvac2_end;
											$half21_Start=date('Y-m-d', strtotime($mid2_end. ' + 1 day'));





										  $daylen = 60*60*24*7;

											  	
											  	$def1=round((strtotime($half1_end)-strtotime($academic->sem1_start))/$daylen);
											 	$def2=round((strtotime($academic->midvac1_end)-strtotime($academic->midvac1_start))/$daylen);
											 	$def3=round((strtotime($academic->sem1_end)-strtotime($half2_Start))/$daylen);
											 	$def4=round((strtotime($academic->study_leave1_end)-strtotime($academic->study_leave1_start))/$daylen);
											 	$def5=round((strtotime($academic->exam1_end)-strtotime($academic->exam1_start))/$daylen);
											 	$def6=round((strtotime($academic->vacation1_end)-strtotime($academic->vacation1_start))/$daylen);
											 	$def7=round((strtotime($half21_end)-strtotime($academic->sem2_start))/$daylen);
											 	$def8=round((strtotime($academic->midvac2_end)-strtotime($academic->midvac2_start))/$daylen);
											 	$def9=round((strtotime($academic->sem2_end)-strtotime($half21_Start))/$daylen);
											 	$def10=round((strtotime($academic->study_leave2_end)-strtotime($academic->study_leave2_start))/$daylen);
											  	$def11=round((strtotime($academic->exam2_end)-strtotime($academic->exam2_start))/$daylen);
				?>
					
							<table class="tabled table-bordered table-striped" id="view_courses" >
							    <thead>
							        <tr>
							            <th>Duration</th>
							            <th>Number of Weeks</th>
							            <th>Description</th>
							        	<th></th>
							        </tr>
								 </thead>

								<tbody>

											

									<tr>

							            <td>{{$academic->sem1_start}}   <i>to</i>   {{$half1_end}}</td>
							            <td>{{$def1}} @if($def1==1) week @else weeks @endif</td>
							            <td>First half of Semester I</td>
										<td><button class="btn btn-success" data-toggle="modal"  data-target="#myModal">Edit</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic->midvac1_start}}   <i>to</i>   {{$academic->midvac1_end}}</td>
							            <td>{{$def2}} @if($def2==1) week @else weeks @endif</td>
							            <td>Semester break</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$half2_Start}}   <i>to</i>   {{$academic->sem1_end}}</td>
							            <td>{{$def3}} @if($def3==1) week @else weeks @endif</td>
							            <td>Second half of Semester I</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic->study_leave1_start}}   <i>to</i>   {{$academic->study_leave1_end}}</td>
							            <td>{{$def4}} @if($def4==1) week @else weeks @endif</td>
							            <td>Study leave</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic->exam1_start}}   <i>to</i>   {{$academic->exam1_end}}</td>
							            <td>{{$def5}} @if($def5==1) week @else weeks @endif</td>
							            <td>Examination Semester I</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>		
							        	</tr>


							        <tr>
									
							            <td>{{$academic->vacation1_start}}   <i>to</i>   {{$academic->vacation1_end}}</td>
							            <td>{{$def6}} @if($def6==1) week @else weeks @endif</td>
							            <td>Vacation</td>
							       		<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>
							        </tr>



									<tr>

							            <td>{{$academic->sem2_start}}   <i>to</i>   {{$half21_end}}</td>
							            <td>{{$def7}} @if($def7==1) week @else weeks @endif</td>
							            <td>First half of Semester II</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic->midvac2_start}}   <i>to</i>   {{$academic->midvac2_end}}</td>
							            <td>{{$def8}} @if($def8==1) week @else weeks @endif</td>
							            <td>Semester break</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$half21_Start}}   <i>to</i>   {{$academic->sem2_end}}</td>
							            <td>{{$def9}} @if($def9==1) week @else weeks @endif</td>
							            <td>Second half of Semester II</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic->study_leave2_start}}   <i>to</i>   {{$academic->study_leave2_end}}</td>
							            <td>{{$def10}} @if($def10==1) week @else weeks @endif</td>
							            <td>Study leave</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic->exam2_start}}   <i>to</i>   {{$academic->exam2_end}}</td>
							            <td>{{$def11}} @if($def11==1) week @else weeks @endif</td>
							            <td>Examination Semester II</td>
							        	<td><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit</button></td>	
							        </tr>

								 
								</tbody>
							</table>
							<div id="editor"></div>
									<button id="cmd">generate PDF</button>


										<form>
										    <input type="hidden" name="hiddenField" />
										</form>

										<script type="text/javascript">
											var replaceWith = $('<input name="temp" type="text" />'),
											    connectWith = $('input[name="hiddenField"]');

											$('th').inlineEdit(replaceWith, connectWith);
											</script>
										<!--

										
													<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal" aria-hidden="true">
												
													    <div class="modal-dialog modal-sm">
													        <div class="modal-content"></div>
													    </div>
													    <div class="modal-dialog">
													        <div class="modal-content"></div>
													    </div>
													    <div class="modal-dialog modal-sm">
													        <div class="modal-content">
													            <div class="modal-header">
													                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×</span>

													                </button>
													                 <h4 class="modal-title" id="myModalLabel">edit</h4>

													            </div>
													            <div class="modal-body">
													            	
													            </div>
													            <div class="modal-footer">
													                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													                <button type="button" class="btn btn-primary">Save changes</button>
													            </div>
													        </div>
													    </div>
													</div>-->





				</div>

		@elseif(($academic!=5) && ($academic!=NULL))
		
			











				
			<center>
			Select Degree Programme : <select id="ReferredBy">
						  <option></option>
					@foreach($degree_name as $degree_name)
					    
					    <option>{{$degree_name->Degree_name}}</option>
					@endforeach  
			</select>
			



		</center>
		
		<div>

			<?php   	
			$degree_name= DB::table('degree')->get();  
			?>
					@foreach($degree_name as $degree_name)
					<?php
						$i=$degree_name->Degree_id; 
						$k=$degree_name->Degree_name;
						$j=$degree_name->Degree_id;
					?>
					
		
				
				<div id="{{$i}}">
						</br>
					<center><h5>{{$k}} Degree Programme</h5> </center>
				

					
				<?php 
					if($i='{{$j}}'){
						 $academic1=AcademicCalender::where('acc_year','=',$academic_year)->where('degree','=',$j)->get();
							?>
										




				
				@foreach($academic1 as $academic1)
				
						<?php $p=$academic1->level_id; ?>
						<div class="span11">
   
					        <div class="content">
					            <div class="panel-group" id="accordion">
					                <div class="panel panel-default">
					                    <div class="panel-heading">	
					                    	<a href="#{{$p}}{{$j}}" class="collapse" data-toggle="collapse">Level {{$p}}</a>
					                    	
											</div>
										 
										  <div id="{{$p}}{{$j}}" class="panel-collapse collapse">
                       					 <div class="panel-body">


					  					<?php
						
											$mid1=$academic1->midvac1_start;
											$half1_end=date('Y-m-d', strtotime($mid1. ' - 1 day'));

											$mid1_end=$academic1->midvac1_end;
											$half2_Start=date('Y-m-d', strtotime($mid1_end. ' + 1 day'));

											$mid2=$academic1->midvac2_start;
											$half21_end=date('Y-m-d', strtotime($mid2. ' - 1 day'));

											$mid2_end=$academic1->midvac2_end;
											$half21_Start=date('Y-m-d', strtotime($mid2_end. ' + 1 day'));





										  $daylen = 60*60*24*7;

											  	
											  	$def1=round((strtotime($half1_end)-strtotime($academic1->sem1_start))/$daylen);
											 	$def2=round((strtotime($academic1->midvac1_end)-strtotime($academic1->midvac1_start))/$daylen);
											 	$def3=round((strtotime($academic1->sem1_end)-strtotime($half2_Start))/$daylen);
											 	$def4=round((strtotime($academic1->study_leave1_end)-strtotime($academic1->study_leave1_start))/$daylen);
											 	$def5=round((strtotime($academic1->exam1_end)-strtotime($academic1->exam1_start))/$daylen);
											 	$def6=round((strtotime($academic1->vacation1_end)-strtotime($academic1->vacation1_start))/$daylen);
											 	$def7=round((strtotime($half21_end)-strtotime($academic1->sem2_start))/$daylen);
											 	$def8=round((strtotime($academic1->midvac2_end)-strtotime($academic1->midvac2_start))/$daylen);
											 	$def9=round((strtotime($academic1->sem2_end)-strtotime($half21_Start))/$daylen);
											 	$def10=round((strtotime($academic1->study_leave2_end)-strtotime($academic1->study_leave2_start))/$daylen);
											  	$def11=round((strtotime($academic1->exam2_end)-strtotime($academic1->exam2_start))/$daylen);
				?>
					
							<table id="view_courses" class="tabled table-bordered table-striped">
							    <thead>
							        <tr>
							            <th>Duration</th>
							            <th>Number of Weeks</th>
							            <th>Description</th>
							        	<th></th>
							        </tr>
								 </thead>

								<tbody>

											

									<tr>

							            <td>{{$academic1->sem1_start}}  <i>to</i>  {{$half1_end}}</td>
							            <td>{{$def1}} @if($def1==1) week @else weeks @endif</td>
							            <td>First half of Semester I</td>
										<td><button type="button" data-id="1" class="btn btn-default editButton">Change</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic1->midvac1_start}}  <i>to</i>  {{$academic1->midvac1_end}}</td>
							            <td>{{$def2}} @if($def2==1) week @else weeks @endif</td>
							            <td>Semester break</td>
							        	<td><button type="button" data-id="2" class="btn btn-default editButton">Change</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$half2_Start}}  <i>to</i>  {{$academic1->sem1_end}}</td>
							            <td>{{$def3}} @if($def3==1) week @else weeks @endif</td>
							            <td>Second half of Semester I</td>
							        	<td><button type="button" data-id="3" class="btn btn-default editButton">Change</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic1->study_leave1_start}}  <i>to</i>  {{$academic1->study_leave1_end}}</td>
							            <td>{{$def4}}@if($def4==1) week @else weeks @endif</td>
							            <td>Study leave</td>
							        	<td><button type="button" data-id="4" class="btn btn-default editButton">Change</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic1->exam1_start}}  <i>to</i>  {{$academic1->exam1_end}}</td>
							            <td>{{$def5}} @if($def5==1) week @else weeks @endif</td>
							            <td>Examination Semester I</td>
							        	<td><button type="button" data-id="5" class="btn btn-default editButton">Change</button></td>		
							        	</tr>


							        <tr>
									
							            <td>{{$academic1->vacation1_start}}  <i>to</i>  {{$academic1->vacation1_end}}</td>
							            <td>{{$def6}} @if($def6==1) week @else weeks @endif</td>
							            <td>Vacation</td>
							       		<td><button type="button" data-id="6" class="btn btn-default editButton">Change</button></td>
							        </tr>



									<tr>

							            <td>{{$academic1->sem2_start}}  <i>to</i>  {{$half21_end}}</td>
							            <td>{{$def7}} @if($def7==1) week @else weeks @endif</td>
							            <td>First half of Semester II</td>
							        	<td><button type="button" data-id="7" class="btn btn-default editButton">Change</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic1->midvac2_start}}  <i>to</i>  {{$academic1->midvac2_end}}</td>
							            <td>{{$def8}}@if($def8==1) week @else weeks @endif</td>
							            <td>Semester break</td>
							        	<td><button type="button" data-id="8" class="btn btn-default editButton">Change</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$half21_Start}}  <i>to</i>  {{$academic1->sem2_end}}</td>
							            <td>{{$def9}} @if($def9==1) week @else weeks @endif</td>
							            <td>Second half of Semester II</td>
							        	<td><button type="button" data-id="9" class="btn btn-default editButton">Change</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic1->study_leave2_start}}  <i>to</i>  {{$academic1->study_leave2_end}}</td>
							            <td>{{$def10}} @if($def10==1) week @else weeks @endif</td>
							            <td>Study leave</td>
							        	<td><button type="button" data-id="10" class="btn btn-default editButton">Change</button></td>
							        </tr>

							        <tr>
									
							            <td>{{$academic1->exam2_start}}  <i>to</i>  {{$academic1->exam2_end}}</td>
							            <td>{{$def11}} @if($def11==1) week @else weeks @endif</td>
							            <td>Examination Semester II</td>
							        	<td><button type="button" data-id="11" class="btn btn-default editButton">Change</button></td>	
							        </tr>

								 
								</tbody>
							</table>
									<button id="cmd">generate PDF</button>

									
													<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													    <div class="modal-dialog">
													        <div class="modal-content"></div>
													    </div>
													    <div class="modal-dialog">
													        <div class="modal-content"></div>
													    </div>
													    <div class="modal-dialog">
													        <div class="modal-content">
													            <div class="modal-header">
													                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>

													                </button>
													                 <h4 class="modal-title" id="myModalLabel">edit</h4>

													            </div>
													            <div class="modal-body">
													            	
													            </div>
													            <div class="modal-footer">
													                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													                <button type="button" class="btn btn-primary">Save changes</button>
													            </div>
													        </div>
													    </div>
													</div>

						</div>
						</div>
						</div>
						</div>
						</div>
						</div>





									<!-- The form which is used to populate the item data -->
<form id="userForm" method="post" class="form-horizontal" style="display: none;">
    <div class="form-group">
        <label class="col-xs-3 control-label">Duration</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="id" disabled="disabled" />
        </div>
    </div>




    <div class="form-group">
        <div class="col-xs-5 col-xs-offset-3">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>
					
			
					@endforeach
				
					<?php }?>	

				</div>
				@endforeach
			</div>
		
			@else

				<center><h5><font color='red'>Academic calender is not define.</font></h5></center>

			@endif
		</div> 
</div>






@stop

