@extends('layouts.dashboard')
<!--<meta http-equiv="Refresh" content="2">-->

@section('css')
	<link href="/css/jquery.dataTables.css" rel="stylesheet">  
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />   

@stop


@section('js')

<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript">

</script>
<script type="text/javascript">
//$(document).ready(function () {
function updatebox2()
{
    var textbox = document.getElementById("totalx");
    var values = [];
    
     var sports2 = document.forms['att_form'].elements[ 'att_id[]' ];
     

       // var sports3 = document.forms['att_form'].elements[ 'crr[]' ]; 

       	var tot2=0;
       	
        for (var i=0, len=sports2.length; i<len; i++) {



            if(sports2[i].checked ){

            	
            	var val = sports2[i].value;
            	var val2 = val.substring(6);
            		if (val2 == 'b') {
   							 cred =2.5;
					} else if (val2 == 'a') {
   							 cred = 1.5;
					} else {
   							 cred =val2;
					}
            	//var val2[i]=  document.getElementById(val[i]);
            		tot2=tot2+parseFloat(cred);

      //  values.push(tot2);
      // totalx.text(tot2);

//values.push(tot2);

    }
    textbox.value =tot2;
     
    // values.join(" ");
}



}

//});
</script>





<script type="text/javascript">


   function att_method()
   {    var ar=[];

        var Rad=[];


    var j=0;
        var sports = document.forms['att_form'].elements[ 'att[]' ];

         


        for (var i=0,var len=sports.length; i<len; i++) {
            if(sports[i].checked)
            {
              var stnum = sports[i].value;
              //var r =   document.getElementsByName("8660");
               var RadGroup=  document.getElementsByName(stnum);

               ar[j] = sports[i].value;

              if(RadGroup[0].checked)
              {
                  Rad[j]="1";
              }
              if(RadGroup[1].checked)
              {
                  Rad[j]="0";
              }
              
             
                j=j+1;
            }
          }


         
             

           document.getElementById('hid_code').value = ar;
          // document.getElementById('hid_numStd').value = j-1;

           document.getElementById('hid_deg').value = Rad;
          // document.getElementById('hid_code_fsc').value = ar2;
         

           //document.getElementById('hid_deg_fsc').value = Rad2;

      
           
   }
</script>




<script type="text/javascript">


   function att_method2()
   {    var ar2=[];

        var Rad=[];


    var j=0;
        var sports_cancel = document.getElementsByName('op_code[]');

         


        for (var i=0,var len=sports_cancel.length; i<len; i++) {
            
              //var stnum = sports[i].value;
              //var r =   document.getElementsByName("8660");
              // var RadGroup=  document.getElementsByName(stnum);

               ar2[j] = sports[i].value;

             
            
          }


         
             

           document.getElementById('hid_code_cancel').value = ar2;
          // document.getElementById('hid_numStd').value = j-1;

          

      
           
   }


   	  $(document).ready(function(){

         $(".att_class").click(function() {
            $.ajax({
               url: "{{ URL::Route('Prerequisites')}}",
               type: 'POST',
               dataType: 'json',

               success: function (data) {
                        
                 	if(data){
                
                     var items = data.map(function(x) { return { item: x }; });

                       	$('#Prerequisite_code').selectize({
                           plugins: ['remove_button'],
                           readOnly: true, 
                           delimiter: ',',
                           persist: false,
                           minLength: 3,
                           options: items,
                           labelField: "item",
                           valueField: "item",
                           sortField: 'item',
                           searchField: 'item'
                        });
                  }
               },
            });
         });
	});
</script>

</script>
<script type="text/javascript">  
 
  </script>
<script type="text/javascript" src="/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/js/selectize.min.js"></script>
<script type="text/javascript" src="/js/course_unit_reg.js"></script>
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
</script>
<script type="text/javascript">

  	$(document).ready(function(){


  		$('#att_sbmit').click(function(){

  			$('#nd').click(function(){
  				$("#pp").hide();
  			$('#att_sbmit').hide;

  				});

  	});
});
 </script>
@stop

@section('content')


<?php

//echo "gsdfgs";
	
	$s= substr($id, 2); 

	$a = Student::where('student_id','=',$s)->first();
	//$x= $a->initials;
	//echo $s;
	//echo $x;

	$b = AcademicYear::where('current1','=',1)->first();
	//$f=substr_replace($b, '-', 0, -4); //xabcd 
	//$c= $b->academic_year_id;
	//echo $c;
	//echo $f;


	$level=Batch::where('academic_year_id','=',$b->academic_year_id)->where('batch_id','=',$a->current_batch)->first();
	//$d= $level->level_id;
	//echo $d;
    
	$subject=SubjectCombination::where('combination_id','=',$a->combination_id)->first();

	
	
	$semester=Semester::where('status','=',1)->where('degree_id','=','G1')->where('level_id','=',$level->level_id)->first();
	$course=CourseUnit::where('level','=',$level->level_id)->where('semester',$semester->semester_id)->get();
	$reg_on=CourseRegistrationCall::where('semester_id','=',$semester->semester_id)->where('academic_year_id','=',$b->academic_year_id)->first();
?>





	<div class="well span8">

<!--View Student Subject Combination-->
<h4><center>Your Subject Combination</center></h4>

<?php
	$subs=Subject::where('subject_id','=',$subject->subject_id2)->orwhere('subject_id','=',$subject->subject_id1)->orwhere('subject_id','=',$subject->subject_id3)->get();
?>
<table align="center">
	<tr>
	@foreach($subs as $sub)
		<td>
		<ul><li><b>{{$sub->subject_name}}</b></li></ul>
		</td>
	@endforeach
	</tr>
</table>

<!--View Compulsory Courses For Level I/////////////////////////////////////////////////////////////////-->

@if(($level->level_id)==1)
<br>
<table class="tabled table-bordered table-striped" id="elcourses" >
    <thead>
        <tr>
            <th>Course Code</th>
             <th>Course Title</th>
            <th>Degree/Non Degree</th>   
        </tr>
	</thead>

	<tbody>
        
		<?php $tot=0.00;?>
			@foreach($course as $course)
			<?php
				$c2=TargetGroup::where('code','=',$course->code)->where('target_pathways','=',$a->combination_id)->where('course_status','=','Core')->get();
			?>

			@foreach($c2 as $c2)
			<?php
				$c=CourseAvailability::where('code','=',$c2->code)->where('status','=',1)->get();
			?>
			@foreach($c as $c)
			<tr>
				<td>{{$c->code}}<input type='hidden' name='code' value='{{$c->code}}'></td>
				
					<?php
						$course_name=CourseTitle::where('code','=',$c->code)->get();
									
							foreach($course_name as $course_name)
							{
								echo '<td>'; 
								echo ucwords($course_name->title); 
								echo '</td>';

								
							}
					?>
							
				<td>Degree</td>		
			</tr>

		<!--Insert Registered Course to Database-->
		<?php
			$available=CourseRegistration::where('student_id','=',$s)->where('code','=',$c->code)->get();

			if(count($available)==0)
			{

			
						//echo $c->code;
					$cours=CourseUnit::where('code','=',$c->code)->get();
						foreach($cours as $cours){
						
						$update =CourseRegistration::create(['student_id'=>$s,'code'=>$cours->code,'semester_id'=>$cours->semester,'academic_year_id'=>$b->academic_year_id,'degree_status'=>1,'confirm'=>1]);
					}
					
				}
			
			
		?>
		@endforeach
		@endforeach
		@endforeach

		<!--View Compulsory Courses For Level I - Both Semester-->
		<?php
			$course2=CourseUnit::where('level','=',$level->level_id)->where('semester','=',0)->get();
		?>
		@foreach($course2 as $course2)
			<?php
				$c2=TargetGroup::where('code','=',$course2->code)->where('target_pathways','=',$a->combination_id)->where('course_status','=','Core')->get();
			?>
		@foreach($c2 as $c2)
						<tr>
					<td>{{$c2->code}}<input type='hidden' name='code' value='{{$c->code}}'></td>
					
					<?php
						$course_name=CourseTitle::where('code','=',$c2->code)->get();
									
						foreach($course_name as $course_name)
						{
							echo '<td>'; 
							echo ucwords($course_name->title); 
							echo '</td>';
							
						
						}
					?>
				<td>Degree</td>
			</tr>
					
			<?php
				$available2=CourseRegistration::where('student_id','=',$s)->where('code','=',$c2->code)->get();
				if(count($available2)==0)
				{
					$update2 =CourseRegistration::create(['student_id'=>$s,'code'=>$c2->code,'semester_id'=>0,'academic_year_id'=>$b->academic_year_id,'degree_status'=>1,'confirm'=>1]);
				}
				else
				{
					$update2 =CourseRegistration::where('code','=',$c2->code)->where('student_id','=',$s)->update(['degree_status'=>1,'confirm'=>1]);
				}
			?>
		@endforeach
		@endforeach
	</tbody>
</table>


<br>

		<?php
			$available_course=CourseRegistration::where('student_id','=',$s)->get();
				foreach($available_course as $credits)
				{
					$c2=TargetGroup::where('code','=',$credits->code)->where('course_status','=','Core')->where('target_pathways','=',$a->combination_id)->get();	
					
						foreach($c2 as $credit)
						{
							$cr=CourseUnit::where('level','=',$level->level_id)->whereIn('semester',[0,$semester->semester_id])->where('code','=',$credit->code)->where('gpa_status','=',1)->get();
							    foreach($cr as $cred)
								{

							//	if($cred->code!="ICT1b13")
							//	if($cred->code!="MAT1142")	

								// {
									$credit= $cred->credits;
									
									$tot=$tot+$credit;
								//}
							}
						}

				}
		?>

<font color="blue"><center> Registered credits for this semeter:<b><font color= "red"> <?php echo $tot;?></font></b> </center></font>

@endif




<!--///////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////-->




<!--**********************View Courses For Level II and III ***********************************-->
@if(($reg_on->status)==1)
@if(($level->level_id)==2 || ($level->level_id)==3)
   

		<div class="row-fluid" style ="margin-left: 15px;" >
            <div class="span4">
               <label class="control-labelme" for="" ><b>Course Category :</b></label>
            </div>
      
         <br>
        
           
             
           
 	 <ul class="nav nav-tabs" align="left">
			  

			   <li><a data-toggle="tab" href="#l1">Core Courses</a></li>
			   <li><a data-toggle="tab" href="#l2">Optional Courses</a></li>
										 
		</ul>								 



     
  <div class="span11"> 
   <div class="tab-content" >

          <div id="l1" class="tab-pane fade in active">




 <br>  

 <?php
 		//foreach($course as $course)	{				
					$pe= CoreElective::select('choice_1')->get();

						foreach($pe as $pe){

								$ce=TargetGroup::where('code','=',$pe->choice_1)->where('target_pathways','=',$a->combination_id)->where('course_status','=','Core')->get();
								
								if($ce){

								foreach($ce as $ce){


								
								$c=CourseAvailability::where('code','=',$ce->code)->where('status','=',1)->first();
								
							$cours=CourseUnit::where('code','=',$c->code)->where('level','=',$level->level_id)->where('semester','=',$semester->semester_id)->get();


							if($cours){


?>										
<div id="pp">
 	<form class="form-horizontal" method="post" id="at_form" name="at_form" action="{{URL::Route('student_course_elective')}}" name="form_elective">
 	
<table id="view_cour" class="table" border='1'align= "center">
	<tbody>
 			<?php
 							
					//$pe= CoreElective::select('choice_1')->get();

					

							foreach($cours as $cours){

								$i=1;

							$cp=CoreElective::where('choice_1','=',$cours->code)->get();

							foreach($cp as $cp){
								
								$available=CourseRegistration::where('student_id','=',$s)->where('code','=',$cp->choice_1)->orwhere('code','=',$cp->choice_2)->orwhere('code','=',$cp->choice_3)->orwhere('code','=',$cp->choice_4)->first();
							
							//foreach($available as $available){
								
									if(!$available){

								
									echo "select one of these course units";	
							//	echo $cp->choice_1;
							
							?>
								
						
						




							<tr>
							<td>{{$cp->choice_1}}<input type='hidden' name='code' value='{{$cp->choice_1}}'></td>
							<?php
								$course_name=CourseTitle::where('code','=',$cp->choice_1)->get();

								
									foreach($course_name as $course_name)
										{
											echo '<td>'; 
											echo ucwords($course_name->title); 
											echo '</td>';

										}
					
							?>
							<td><input type="radio"  value="{{$cp->choice_1}}" id='nd' name='{{$i}}' required></input></td>
						</tr>


						<tr>
							<td>{{$cp->choice_2}}<input type='hidden' name='code' value='{{$cp->choice_2}}'></td>
							<?php
								$course_name=CourseTitle::where('code','=',$cp->choice_2)->get();

								
									foreach($course_name as $course_name)
										{
											echo '<td>'; 
											echo ucwords($course_name->title); 
											echo '</td>';

										}
					
							?>
							<td><input type="radio"  value="{{$cp->choice_2}}" id='nd' name='{{$i}}'required></input></td>
						</tr>
						@if($cp->choice_3)
						<tr>
							<td>{{$cp->choice_3}}<input type='hidden' name='code' value='{{$cp->choice_3}}'></td>
							<?php
								$course_name=CourseTitle::where('code','=',$cp->choice_3)->get();

								
									foreach($course_name as $course_name)
										{
											echo '<td>'; 
											echo ucwords($course_name->title); 
											echo '</td>';

										}
					
							?>
							<td><input type="radio"  value="{{$cp->choice_3}}" id='nd' name='{{$i}}' required></input></td>
						</tr>
						@endif
						@if($cp->choice_4)
						<tr>
							<td>{{$cp->choice_4}}<input type='hidden' name='code' value='{{$cp->choice_4}}'></td>
							<?php
								$course_name=CourseTitle::where('code','=',$cp->choice_4)->get();

								
									foreach($course_name as $course_name)
										{
											echo '<td>'; 
											echo ucwords($course_name->title); 
											echo '</td>';

										}
					
							?>
							<td><input type="radio"  value="{{$cp->choice_4}}" id='nd' name='{{$i}}' required></input></td>
						</tr>


							@endif
</tbody>
</table>

							
							<center><input type = "submit" id="att_sbmit" name="att_submit" class="btn btn-primary" onclick="" value="select"></input></center>

						
	

						

					
				<?php		

				}
			

					else {
					
				?>

<table id="view_cou" class="table" border='1'align= "center">


		

					
			<tbody>
		
				<tr>

			
							<td>{{$available->code}}<input type='hidden' name='code' value='{{$available->code}}'></td>
							<?php
								$course_name=CourseTitle::where('code','=',$available->code)->get();

								
									foreach($course_name as $course_name)
										{
											echo '<td>'; 
											echo ucwords($course_name->title); 
											echo '</td>';

										}
					
							?>
						<td>Degree</td>
						</tr>



				<?php

			}
		

		}

			
						$i++;

			
				

					}

				
				?>
   


	</tbody>
</table>



	


</div>
<?php

}
				else
					{}//echo "thtwr";

			//echo "thtwr";

			}

			}


				else
					{}
				}
				

			
				?>

<br>
<table id="view_courses" class="tabled table-bordered core" align= "center">


    <thead>
        <tr>
            <th>Course Code</th>
            <th>Course Title</th>
            <th>Degree/Non Degree</th>           
        </tr>
	</thead>


	<tbody>

			<?php $tot=0;?>
				@foreach($course as $course)
				<?php
					$c2=TargetGroup::where('code','=',$course->code)->where('target_pathways','=',$a->combination_id)->where('course_status','=','Core')->get();
				?>

				@foreach($c2 as $c2)
				<?php
					$c=CourseAvailability::where('code','=',$c2->code)->where('status','=',1)->get();

				?>
				@foreach($c as $c)

				<?php
						$p= CoreElective::where('choice_1','=',$c2->code)->orwhere('choice_2','=',$c2->code)->orwhere('choice_3','=',$c2->code)->orwhere('choice_2','=',$c2->code)->first();
				?>

				@if(!$p)

	

				<tr>
					<td>{{$c->code}}<input type='hidden' name='code' value='{{$c->code}}'></td>
					
					<?php
						$course_name=CourseTitle::where('code','=',$c->code)->get();
									
						foreach($course_name as $course_name)
						{
							echo '<td>'; 
							echo ucwords($course_name->title); 
							echo '</td>';
							
					
						}
					?>
					<td>Degree</td>
				</tr>
				

				<?php
					$available=CourseRegistration::where('student_id','=',$s)->where('code','=',$c->code)->get();
					if(count($available)==0)
					{
						//foreach($c as $c){
						$cours=CourseUnit::where('code','=',$c->code)->get();
						foreach($cours as $cours){
						
						$update =CourseRegistration::create(['student_id'=>$s,'code'=>$c->code,'semester_id'=>$cours->semester,'degree_status'=>1,'academic_year_id'=>$b->academic_year_id,'confirm'=>1]);
					//}
				}}
					
				?>
					@endif
				@endforeach
			
	 			@endforeach
				@endforeach
				<!--both semester  -->


				<?php
					$course2=CourseUnit::where('level','=',$level->level_id)->where('semester','=',0)->get();
					//$df= $course2->code;
					//echo $df;
				?>

				@foreach($course2 as $course2)
					<?php
						$c2=TargetGroup::where('code','=',$course2->code)->where('target_pathways','=',$a->combination_id)->where('course_status','=','Core')->get();
					?>

					@foreach($c2 as $c2)
						<tr>
					<td>{{$c2->code}}<input type='hidden' name='code' value='{{$c->code}}'></td>
					
					<?php
						$course_name=CourseTitle::where('code','=',$c2->code)->get();
									
						foreach($course_name as $course_name)
						{
							echo '<td>'; 
							echo ucwords($course_name->title); 
							echo '</td>';
							
						//	$credits=CourseUnit::where('code','=',$c->code)->get();
							
						//foreach($credits as $credits)
						//	{
						//		$credit=$credits->credits;
						//		$tot=$tot+$credit;
							//}
						}
					?>
							<td>Degree</td>
						</tr>
					
						<?php
							$available2=CourseRegistration::where('student_id','=',$s)->where('code','=',$c2->code)->get();
							if(count($available2)==0)
							{
								
								$update2 =CourseRegistration::create(['student_id'=>$s,'code'=>$c2->code,'semester_id'=>0,'degree_status'=>1,'academic_year_id'=>$b->academic_year_id,'confirm'=>1]);
							}
							
						?>
					@endforeach
				@endforeach


			</tbody>
<!--gjhk-->
		</table>
		<br>

		<?php
			$available_course=CourseRegistration::where('student_id','=',$s)->get();
				foreach($available_course as $credits)
				{
					$c2=TargetGroup::where('code','=',$credits->code)->where('course_status','=','Core')->where('target_pathways','=',$a->combination_id)->get();	
					
						foreach($c2 as $credit)
						{
							$cr=CourseUnit::where('level','=',$level->level_id)->whereIn('semester',[0,$semester->semester_id])->where('code','=',$credit->code)->where('gpa_status','=',1)->get();
							    
							    foreach($cr as $cred)
								{
									//if($cred->code!="ICT2b13"){
									$credit= $cred->credits;
								
									$tot=$tot+$credit;
								//}
								}
						}

				}


				

		?>
		<div class="span10"><font color="blue"><center> registered credits for this semester: <b> <font color="red"><?php echo $tot;?></font></b></center></font></div>

					
</div>







				<!--********************View Optional Courses For Level II & III*****////////
				///////////////////////////////////////////////////////////////////
				..................................................................**********-->



			 
		
          <div id="l2" class="tab-pane fade">
			<?php $tot=0;	$i=0;?>
		<?php
		$course=CourseUnit::where('level','=',$level->level_id)->where('semester','=',$semester->semester_id)->get();
		
		?>
		
			<form class="form-horizontal" method="post" id="att_form" name="att_form" action="{{URL::Route('student_course_registration')}}" name="form_registre">
			<table class="tabled table-bordered table-striped" id="coursesr" >
		 <thead>

		
        <tr>
        	<th></th>
              <th >Course Code</th>
               <th id="f2" style ="width: 100px;">Course Title</th>
            <th>Degree/Non Degree</th>            
        </tr>
	</thead>

    <tbody>
		@foreach($course as $course)
				
				<?php
			
				$optional2=TargetGroup::where('code','=',$course->code)->where('target_pathways','=',$a->combination_id)->where('course_status','=','Optional')->get();
			
				?>
						@foreach($optional2 as $optional2)
						
			
			



	
						<?php
							$optional=CourseAvailability::where('code','=',$optional2->code)->where('status','=',1)->get();
							

						?>

						@foreach($optional as $optional)

						<tr>
						<?php
							$av_op=CourseRegistration::where('student_id','=',$s)->where('code', '=', $optional->code)->first();
							?>
				@if(count($av_op)==0 && (($reg_on->status)==1))
						<?php
						
							
						?>	
						<td><input id="att_id[]" name="att[]" type="checkbox" class = "att_class"  onclick="updatebox2()" value="{{$optional->code}}" ></td>
							
						<td><font color="blue">{{$optional->code}}</font></td>

						<?php
			
						$course_name=CourseTitle::where('code','=',$optional->code)->get();
						?>
				
					@foreach($course_name as $course_name)
						
						<td> 
								{{ucwords($course_name->title)}}
						</td>
					@endforeach





 				<td><input type='radio' value='Degree' id='d' name='{{$optional->code}}' onclick="">Degree</input><?php echo "&nbsp;&nbsp;&nbsp;";?>
 		
            		 <input type="radio"  value="Non Degree" id='nd' name='{{$optional->code}}'>Non Degree</input>
            		</td>
    
            		
			@endif


				</tr>
			
				@endforeach
				@endforeach
			@endforeach



					
</tbody>
					</table>
			<input type='hidden' id= 'hid_code' name='hiddenCode' />


        <input type='hidden' id= 'hid_deg' name='hiddenDegree' />
       

         <input type = "submit" id="at_submit" name="at_submit" class="btn btn-primary" onclick="att_method()" value="Register"></input>
			</form>
			
			
			<font color="blue"><center><font color="red"> Number of optional credits:  </font><?php echo "<input type='text' name='totalx' id='totalx' value='' style='width:30px'>";?> </center></font>
			

</div>
</div>

</div>

</div>


				
@endif
@endif
</div>
@stop



