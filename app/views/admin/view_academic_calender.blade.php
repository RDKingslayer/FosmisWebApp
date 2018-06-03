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
<script type="text/javascript" src="/js/academic_calender.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>


@stop
@section('content')

		
    <?php      
                $Date =$current_year->starting_date ;
                $sem_end =date('Y-m-d', strtotime($Date. ' + 16 weeks'));
                $mid =date('Y-m-d', strtotime($Date. ' + 8 weeks'));
                $mide =date('Y-m-d', strtotime($mid. ' + 1 weeks'));

                $sl_start=date('Y-m-d', strtotime($sem_end. ' + 1 day'));
                $sl_end=date('Y-m-d', strtotime($sl_start. ' + 1 week'));
                $exam_start=date('Y-m-d', strtotime($sl_end. ' + 1 day'));
                $exam_end=date('Y-m-d', strtotime($exam_start. ' + 3 weeks'));

                $vac_start=date('Y-m-d', strtotime($exam_end. ' + 1 day'));
                $vac_end=date('Y-m-d', strtotime($vac_start. ' + 2 weeks'));


                $sem2_start =date('Y-m-d', strtotime($vac_end. ' + 1 day'));
                $sem2_end =date('Y-m-d', strtotime($sem2_start. ' + 16 weeks'));

                $mid2_start =date('Y-m-d', strtotime($sem2_start. ' + 8 weeks'));
                $mid2_end =date('Y-m-d', strtotime($mid2_start. ' + 1 weeks'));
                

                $sl2_start =date('Y-m-d', strtotime($sem2_end. ' + 1 day'));
                $sl2_end =date('Y-m-d', strtotime($sl2_start. ' + 1 weeks'));

                
                $exam2_start =date('Y-m-d', strtotime($sl2_end. ' + 1 day'));
                $exam2_end =date('Y-m-d', strtotime($exam2_start . ' + 4 weeks'));

                
                 $vac2_start=date('Y-m-d', strtotime($exam2_end. ' + 1 day'));
                $vac2_end =date('Y-m-d', strtotime($vac2_start. ' + 6 weeks'));

                ?>
<div class="span12">
   <div class="span2"></div>
	<div class="well span8">
		<?php
			$y=$current_year->academic_year_id;
			$a=strtr ($y, array ('_' => '/'));
		?>
		<center><h4>academic calendar for {{$a}} Academic Year</h4></center>

		
 <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#common" aria-controls="common" role="tab" data-toggle="tab">Common Calendar</a></li>
		    <li role="presentation"><a href="#different" aria-controls="different" role="tab" data-toggle="tab">Different Calendar</a></li>
		   </ul>


		<div class="tab-content">
		  <div role="tabpanel" class="tab-pane fade in active" id="common">
		  		
		  	 <form class="form-horizontal" method="post" id="form_registre" action="{{URL::Route('post_academic_calender_define', $current_year->academic_year_id)}}" name="form_registre" novalidate>
		  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

				  		 <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingTwo">
						      <h5 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          Academic Period
						        </a>
						      </h5>
						    </div>
						    <div id="collapseTwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingTwo">
						      <div class="panel-body">
						      	
						         @for($i = 1; $i <=2; $i++)

          							  <div class="span6">
          								
             							 <h5>Semester {{$i}}</h5> 
								          							   <!-- semester start date -->
								      
								       <div class="span10">
								                <div class="span7">
								                   <h6 >Semester start date</h6>
								                </div>
								              
								           
								    
								               <div class="span3">
								                
								                @if(isset($current_year)&&($i==1))
								                   <input name="sem_start_date{{$i}}" id="sem_start_date{{$i}}" class="input-small" type="date" value="{{$current_year->starting_date}}" required>
								                @else
								                    <input name="sem_start_date{{$i}}" id="sem_start_date{{$i}}" class="input-small" type="date" value="{{$sem2_start}}" required>
								                @endif
								            </div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Semester End Date</h6>
								                </div>
								               <div class="span3">

								                @if(isset($current_year)&&($i==1))
								                   <input name="sem_end_date{{$i}}" id="sem_end_date{{$i}}" class="input-small" type="date" value="{{$sem_end}}" required>
								               @else
								                    <input name="sem_end_date{{$i}}" id="sem_end_date{{$i}}" class="input-small" type="date" value="{{$sem2_end}}" required>
								                @endif
								            </div>
								       </div>
							
             							


								       <div class="span10">
								                <div class="span7">
								                   <h6 >Mid vacation start date</h6>
								                </div>
								              
								             
								    
								              <div class="span3">
								                
								               @if(isset($current_year)&&($i==1))
								                  <input name="mid_start_date{{$i}}" id="mid_start_date{{$i}}" class="input-small" type="date" value="{{$mid}}" required>
								                  @else
								                  <input name="mid_start_date{{$i}}" id="mid_start_date{{$i}}" class="input-small" type="date" value="{{$mid2_start}}" required>
								                @endif
											</div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Mid Vacation End Date</h6>
								                </div>
								               <div class="span3">

								               
									              @if(isset($current_year)&&($i==1))
									               
									              <input name="mid_end_date{{$i}}" id="mid_end_date{{$i}}" class="input-small" type="date"value="{{$mide}}" required>
									              @else
									               <input name="mid_end_date{{$i}}" id="mid_end_date{{$i}}" class="input-small" type="date"value="{{$mid2_end}}" required>
									            @endif
								            </div>
								       </div>
									
             							 </div>
             						 
             						 
             					 @endfor
             					 </div>
             					
						      </div>
						    </div>
		  				


				  		


				  		 <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingFour">
						      <h5 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						         Study Leave Period
						        </a>
						      </h5>
						    </div>
						    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						      <div class="panel-body">
						               @for($i = 1; $i <=2; $i++)

          							  <div class="span6">
          							
             							 <h5>Semester {{$i}}</h5> 
								          							   <!-- semester start date -->
								      
								       <div class="span10">
								                <div class="span7">
								                   <h6 >Study Leave start date</h6>
								                </div>
								              
								             
								    
								              <div class="span3">
								                
								                @if(isset($current_year)&&($i==1))
								                  <input name="study_start_date{{$i}}" id="study_start_date{{$i}}" class="input-small" type="date" value="{{$sl_start}}" required>
								                  @else
								                  <input name="study_start_date{{$i}}" id="study_start_date{{$i}}" class="input-small" type="date" value="{{$sl2_start}}" required>
								                @endif
											</div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Study Leave End Date</h6>
								                </div>
								               <div class="span3">

								               
									              @if(isset($current_year)&&($i==1))
										              <input name="study_end_date{{$i}}" id="study_end_date{{$i}}" class="input-small" type="date" value="{{$sl_end}}" required>
										               @else
										                <input name="study_end_date{{$i}}" id="study_end_date{{$i}}" class="input-small" type="date" value="{{$sl2_end}}" required>
										            @endif
								            </div>
								       </div>
							
             							 </div>
             						 
             					 @endfor 
						      </div>
						    </div>
		  				</div>


		  				 <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingFive">
						      <h5 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
						          Examination Period
						        </a>
						      </h5>
						    </div>
						    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						      <div class="panel-body">
						        	               @for($i = 1; $i <=2; $i++)

          							  <div class="span6">
          							
             							 <h5>Semester {{$i}}</h5> 
								          							   <!-- semester start date -->
								      
								       <div class="span10">
								                <div class="span7">
								                   <h6 >Examination start date</h6>
								                </div>
								              
								             
								    
								              <div class="span3">
												                
											 @if(isset($current_year)&&($i==1))
								                   <input name="exam_start_date{{$i}}" id="exam_start_date{{$i}}" class="input-small" type="date" value="{{$exam_start}}"  required>
								                @else
								                    <input name="exam_start_date{{$i}}" id="exam_start_date{{$i}}" class="input-small" type="date" value="{{$exam2_start}}"  required>
								                @endif
											</div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Examination End Date</h6>
								                </div>
								               <div class="span3">

								               
									             @if(isset($current_year)&&($i==1))
										              <input name="exam_end_date{{$i}}" id="exam_end_date{{$i}}" class="input-small" type="date" value="{{$exam_end}}" required>
										                @else
										                  <input name="exam_end_date{{$i}}" id="exam_end_date{{$i}}" class="input-small" type="date" value="{{$exam2_end}}" required>
										                @endif
								            </div>
								       </div>
							
             							 </div>
             						 
             					 @endfor 
						      </div>
						    </div>
		  				</div>


		  				 <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h5 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						         Vacation Period
						        </a>
						      </h5>
						    </div>
						    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						      <div class="panel-body">
						          @for($i = 1; $i <=2; $i++)

          							

          							  <div class="span6">
          							
             							 <h5>Semester {{$i}}</h5> 
								          							   <!-- semester start date -->
								      
								       <div class="span10">
								                <div class="span7">
								                   <h6 >Vacation start date</h6>
								                </div>
								              
								              
								             
								    
								              <div class="span3">
												                
											 @if(isset($current_year)&&($i==1))
								                   <input name="vac_start_date{{$i}}" id="vac_start_date{{$i}}" class="input-small" type="date" value="{{$vac_start}}" required>
								                @else
								                   <input name="vac_start_date{{$i}}" id="vac_start_date{{$i}}" class="input-small" type="date" value="{{$vac2_start}}" required>
								                 @endif
											</div>

             						 </div>
								  		
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Vacation End Date</h6>
								                </div>
								               <div class="span3">

								               
									             @if(isset($current_year)&&($i==1))
									              <input name="vac_end_date{{$i}}" id="vac_end_date{{$i}}" class="input-small" type="date" value="{{$vac_end}}" required>
									                @else
									                  <input name="vac_end_date{{$i}}" id="vac_end_date{{$i}}" class="input-small" type="date" value="{{$vac2_end}}" required>
									                 @endif
								            </div>
								      	 </div>
							
             						 </div>
								
             					 @endfor 
						     
		  				</div>
		  			</div>
		  				</div>
		  				
		  					 <div class="span8">
               					 <center>  <button id="submit" name="submit" class="btn btn-primary" >submit</button></center>
              				  </div>   
      				</div>

		  		</form>
		  
		  		</div>


		


		  <div role="tabpanel" class="tab-pane" id="different">

		  		<?php
              $academic=AcademicCalender::where('acc_year',$current_year->academic_year_id)->get();
           
            ?>
             	 <form class="form-horizontal" method="post" id="form_registre" action="{{URL::Route('post_defacademic_calender_define', $current_year->academic_year_id)}}" name="form_registre" novalidate>
             		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

		

             			<div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h5 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsea" aria-expanded="false" aria-controls="collapsea">
						         Degree Programs
						        </a>
						      </h5>
						    </div>
						    <div id="collapsea" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headinga">
						      <div class="panel-body">

						      	<div class="span8">
									<div class="span2"></div>
          							
								     <div class="span6">
								     			<div class="container">
													 
													  <a href="#demo1" class="collapse" data-toggle="collapse">General Degree programmes</a>
													  <div id="demo1" class="collapse">
																	<div class="span2"></div>
													  					<div class="span6">
													  						<div class="span2">
															                 <?php
															                     $academic1=AcademicCalender::where('acc_year','=',$current_year->academic_year_id)->where('degree','=','G1')->where('level_id',1)->first();
															                     $academic2=AcademicCalender::where('acc_year','=',$current_year->academic_year_id)->where('degree','=','G1')->where('level_id',2)->first();
															                    $academic3=AcademicCalender::where('acc_year','=',$current_year->academic_year_id)->where('degree','=','G1')->where('level_id',3)->first();
															                 
															             
															                  ?>

															                  
															            
															                    @if(isset($academic1)&&isset($academic2)&&isset($academic3))
															                     
															                     <input id="BSC" name="BSC" type="checkbox" class="BSC" value="BSC" font="blue" disabled="disabled" checked="checked">BSc
															                   @else  
															                      <input id="BSC" name="BSC" type="checkbox" class="BSC" value="BSC">BSc
															                     
															                      @endif 

															                  </br>

				
																	                   <?php
																	                  $academic4=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','G2')->where('level_id',1)->first();
																	                 $academic5=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','G2')->where('level_id',2)->first();
																	                 $academic6=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','G2')->where('level_id',3)->first();
																	                  ?>
																	              @if(isset($academic4)&&isset($academic5)&&isset($academic6))
																	                 
																	                     <input id="BCS" name="BCS" type="checkbox" class="BCS" value="BCS" disabled="disabled" checked="checked">BCS
																	                  @else   
																	                     <input id="BCS" name="BCS" type="checkbox" class="BCS" value="BCS">BCS
																	                  @endif
                 
                
              																	  </div>


																	                <div class="span4">
																	                
																	               
																	               

																	                  @if(isset($academic1)&&isset($academic4))
																	                 
																	                    <input id="1" name="glevel1" type="checkbox" class="level" value="1" disabled="disabled" checked="checked">Level 1
																	                  @else
																	                    <input id="1" name="glevel1" type="checkbox" class="level" value="1">Level 1

																	                  @endif
																	             </br>   
																	           
																	             
																	                  @if(isset($academic2)&&isset($academic5))
																	                    <input id="2" name="glevel2" type="checkbox" class="level" value="2" disabled="disabled" checked="checked">Level 2
																	                  @else
																	                     <input id="2" name="glevel2" type="checkbox" class="level" value="2">Level 2
																	                  @endif
																	                        
																		            </br>
																	                   @if(isset($academic3)&&isset($academic6))
																	                    <input id="3" name="glevel3" type="checkbox" class="level" value="3" disabled="disabled" checked="checked">Level 3
																	                    @else
																	                      <input id="3" name="glevel3" type="checkbox" class="level" value="3">Level 3
																	                    @endif
																	            
																	           </div>

																																               
																																                 </div>

															             </div>

													    
													  </div>
													

													<div class="container">
													 
													  <a href="#demo2" class="collapse" data-toggle="collapse">Special Degree programmes</a>
													  <div id="demo2" class="collapse">
														<div class="span2"></div>
											  					<div class="span8">
											  						<div class="span4">

																					<?php

																					$academic7=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SMAT')->where('level_id',1)->first();
																					$academic8=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SMAT')->where('level_id',2)->first();
																					?>

																					@if(isset($academic7)&&isset($academic8))
																					<input id="Mathematics" name="Mathematics" type="checkbox" class="Mathematics" value="Mathematics" disabled="disabled" checked="checked">Mathematics
																					@else
																					<input id="Mathematics" name="Mathematics" type="checkbox" class="Mathematics" value="Mathematics">Mathematics
																					@endif
																					
																				</br>
																					<?php

																					$academic9=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SPHY')->where('level_id',1)->first();
																					$academic10=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SPHY')->where('level_id',2)->first();
																					?>

																					@if(isset($academic9)&&isset($academic10))
																					<input id="Physics" name="Physics" type="checkbox" class="Physics" value="Physics" disabled="disabled" checked="checked">Physics
																					@else
																					<input id="Physics" name="Physics" type="checkbox" class="Physics" value="Physics">Physics
																					@endif
																				</br>
											

																					<?php

																					$academic11=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SCHE')->where('level_id',1)->first();
																					$academic12=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SCHE')->where('level_id',2)->first();
																					?>

																					@if(isset($academic11)&&isset($academic12))
																					<input id="Chemistry" name="Chemistry" type="checkbox" class="Chemistry" value="Chemistry"  disabled="disabled" checked="checked">Chemistry

																					@else
																					<input id="Chemistry" name="Chemistry" type="checkbox" class="Chemistry" value="Chemistry">Chemistry
																					@endif
																				



																					</br>

																					<?php

																					$academic13=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SZOO')->where('level_id',1)->first();
																					$academic14=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SZOO')->where('level_id',2)->first();
																					?>

																					@if(isset($academic13)&&isset($academic14))
																					<input id="Zoology" name="Zoology" type="checkbox" class="Zoology" value="Zoology"  disabled="disabled" checked="checked">Zoology
																					@else
																					<input id="Zoology" name="Zoology" type="checkbox" class="Zoology" value="Zoology">Zoology
																					@endif
																					


																					</br>
																					<?php

																					$academic15=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SBOT')->where('level_id',1)->first();
																					$academic16=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SBOT')->where('level_id',2)->first();
																					?>

																					@if(isset($academic15)&&isset($academic16))
																					<input id="Botany" name="Botany" type="checkbox" class="Botany" value="Botany"  disabled="disabled" checked="checked">Botany
																					@else
																					<input id="Botany" name="Botany" type="checkbox" class="Botany" value="Botany">Botany

																					@endif
																						</br>




																					  
																		                <?php
																		                  $academic17=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','S2')->where('level_id',4)->first();
																		               ?>
																		               
																		                  @if(isset($academic17))
																		                    <input id="sBCS" name="sBCS" type="checkbox" class="BCS" value="BCS" disabled="disabled" checked="checked">BCS
																		                  @else
																		                    <input id="sBCS" name="sBCS" type="checkbox" class="BCS" value="BCS">BCS
																		                  @endif
																		                
																		                
																		                  
																		              
																					
											  						</div>
											  						<div class="span4">

																                   @if(isset($academic7)&&isset($academic9)&&isset($academic11)&&isset($academic13)&&isset($academic15))
																                    <input id="1" name="slevels1" type="checkbox" class="level" value="1" disabled="disabled" checked="checked">Level 1
																                  @else
																                      <input id="1" name="slevels1" type="checkbox" class="level" value="1">Level 1
																                  @endif
																              </br>
																               @if(isset($academic8)&&isset($academic10)&&isset($academic12)&&isset($academic14)&&isset($academic16))
																                    <input id="2" name="slevels2" type="checkbox" class="level" value="2" disabled="disabled" checked="checked">Level 2
																                   @else
																                    <input id="2" name="slevels2" type="checkbox" class="level" value="2">Level 2
																                   @endif

																                  </br>
																                  @if(isset($academic17))
																		                    <input id="4" name="level4" type="checkbox" class="level" value="4" disabled="disabled" checked="checked">Level 4
																		                  @else
																		                    <input id="4" name="level4" type="checkbox" class="level" value="4">Level 4
																		                  @endif
											  						</div>

													  			


													    </div>
													  </div>
													</div>

								     </div>      
								          

								</div>
		  				</div>
		  				</div>
						</div>
					

					<div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h5 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseb" aria-expanded="false" aria-controls="collapseb">
						         Academic Calender
						        </a>
						      </h5>
						    </div>
						    <div id="collapseb" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingb">
						      <div class="panel-body">
						       
									<div class="container">
												<div class="span0.5"> </div>
												<div class="span10">
										  <a href="#demo3" class="collapse" data-toggle="collapse">Academic Period</a>
										  <div id="demo3" class="collapse">

										  		 @for($i = 1; $i <=2; $i++)

          							  <div class="span5">
          								
             							 <h5>Semester {{$i}}</h5> 
								          							   <!-- semester start date -->
								      
								       <div class="span10">
								                <div class="span7">
								                   <h6 >Semester start date</h6>
								                </div>
								              
								             
								    
								               <div class="span3">
								                
								                @if(isset($current_year)&&($i==1))
								                   <input name="sem_start_date{{$i}}" id="sem_start_dated{{$i}}" class="input-small" type="date" value="" required>
								                @else
								                    <input name="sem_start_date{{$i}}" id="sem_start_dated{{$i}}" class="input-small" type="date" value="" required>
								                @endif
								            </div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Semester End Date</h6>
								                </div>
								               <div class="span3">

								                @if(isset($current_year)&&($i==1))
								                   <input name="sem_end_date{{$i}}" id="sem_end_dated{{$i}}" class="input-small" type="date" value="" required>
								               @else
								                    <input name="sem_end_date{{$i}}" id="sem_end_dated{{$i}}" class="input-small" type="date" value="" required>
								                @endif
								            </div>
								       </div>
							
             							


								       <div class="span10">
								                <div class="span7">
								                   <h6 >Mid vacation start date</h6>
								                </div>
								              
								             
								    
								              <div class="span3">
								                
								               @if(isset($current_year)&&($i==1))
								                  <input name="mid_start_date{{$i}}" id="mid_start_dated{{$i}}" class="input-small" type="date" value="" required>
								                  @else
								                  <input name="mid_start_date{{$i}}" id="mid_start_dated{{$i}}" class="input-small" type="date" value="" required>
								                @endif
											</div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Mid Vacation End Date</h6>
								                </div>
								               <div class="span3">

								               
									              @if(isset($current_year)&&($i==1))
									               
									              <input name="mid_end_date{{$i}}" id="mid_end_dated{{$i}}" class="input-small" type="date"value="" required>
									              @else
									               <input name="mid_end_date{{$i}}" id="mid_end_dated{{$i}}" class="input-small" type="date"value="" required>
									            @endif
								            </div>
								       </div>
									
             							 </div>
             						 
             						 
             					 @endfor

             					</div>

										
							</div>	
		  				</div>

		  							<div class="container">
										<div class="span0.5"> </div>
												<div class="span10">
										  <a href="#demo4" class="collapse" data-toggle="collapse">Study Leave Period</a>
										  <div id="demo4" class="collapse">

										  		 @for($i = 1; $i <=2; $i++)

          							  <div class="span5">
          								
             							 <h5>Semester {{$i}}</h5> 
								          							   <!-- semester start date -->
								      
								       <div class="span10">
								                <div class="span7">
								                   <h6 >Study leave start date</h6>
								                </div>
								              
								             
								    
								               <div class="span3">
								                
								                 @if(isset($current_year)&&($i==1))
								                  <input name="study_start_date{{$i}}" id="study_start_dated{{$i}}" class="input-small" type="date" value="" required>
								                  @else
								                  <input name="study_start_date{{$i}}" id="study_start_dated{{$i}}" class="input-small" type="date" value="" required>
								                @endif
								            </div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Study Leave End Date</h6>
								                </div>
								               <div class="span3">

								               
									              @if(isset($current_year)&&($i==1))
										              <input name="study_end_date{{$i}}" id="study_end_dated{{$i}}" class="input-small" type="date" value="" required>
										               @else
										                <input name="study_end_date{{$i}}" id="study_end_dated{{$i}}" class="input-small" type="date" value="" required>
										            @endif
								            </div>
								       </div>
							
             							

								           
								          

									
             							 </div>
             						 
             						 
             					 @endfor

             					</div>
								</div>
									</div> 





		  							<div class="container">
										<div class="span0.5"> </div>
												<div class="span10">
										  <a href="#demo5" class="collapse" data-toggle="collapse">Examination Period</a>
										  <div id="demo5" class="collapse">

										  		 @for($i = 1; $i <=2; $i++)

          							  <div class="span5">
          								
             							 <h5>Semester {{$i}}</h5> 
								          							   <!-- semester start date -->
								      
								       <div class="span10">
								                <div class="span7">
								                   <h6 >Examination start date</h6>
								                </div>
								              
								             
								    
								               <div class="span3">
								                
								                @if(isset($current_year)&&($i==1))
								                   <input name="exam_start_date{{$i}}" id="exam_start_dated{{$i}}" class="input-small" type="date" value=""  required>
								                @else
								                    <input name="exam_start_date{{$i}}" id="exam_start_dated{{$i}}" class="input-small" type="date" value=""  required>
								                @endif
								            </div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Examination End Date</h6>
								                </div>
								               <div class="span3">

								               
									              @if(isset($current_year)&&($i==1))
										              <input name="exam_end_date{{$i}}" id="exam_end_dated{{$i}}" class="input-small" type="date" value="" required>
										                @else
										                  <input name="exam_end_date{{$i}}" id="exam_end_dated{{$i}}" class="input-small" type="date" value="" required>
										                @endif
								            </div>
								       </div>
							
             							

								           
								          

									
             							 </div>
             						 
             						 
             					 @endfor

             					</div>
								</div>
						</div>





		  							<div class="container">
										<div class="span0.5"> </div>
												<div class="span10">
										  <a href="#demo6" class="collapse" data-toggle="collapse">Vacation Period</a>
										  <div id="demo6" class="collapse">

										  		 @for($i = 1; $i <=2; $i++)

          							  <div class="span5">
          								
             							 <h5>Semester {{$i}}</h5> 
								          							   <!-- semester start date -->
								      
								       <div class="span10">
								                <div class="span7">
								                   <h6 >Vacation start date</h6>
								                </div>
								              
								             
								    
								               <div class="span3">
								                	                
											 @if(isset($current_year)&&($i==1))
								                   <input name="vac_start_date{{$i}}" id="vac_start_dated{{$i}}" class="input-small" type="date" value="" required>
								                @else
								                   <input name="vac_start_date{{$i}}" id="vac_start_dated{{$i}}" class="input-small" type="date" value="" required>
								                 @endif
								            </div>
								  		</div>
								           
								          

								</br>  
								              <!-- semester end date -->
								        <div class="span10">
								                <div class="span7">
								                   <h6 >Vacation End Date</h6>
								                </div>
								               <div class="span3">

								               
									              @if(isset($current_year)&&($i==1))
									              <input name="vac_end_date{{$i}}" id="vac_end_dated{{$i}}" class="input-small" type="date" value="" required>
									                @else
									                  <input name="vac_end_date{{$i}}" id="vac_end_dated{{$i}}" class="input-small" type="date" value="" required>
									                 @endif
								            </div>
								       </div>
							
             							

								           
								          

									
             							 </div>
             						 
             						 
             					 @endfor

             					</div>
								</div>
						</div>
						<div class="span8">
               					 <center>  <button id="submit" name="submit" class="btn btn-primary" >submit</button></center>
              				  </div>   



		  				</div>
						</div>
			
							</div>
						</div>
             	</form>
		  		 
		  </div>

		

		</div>
	</div>
</div>
@stop
