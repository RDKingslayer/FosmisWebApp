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
		<legend>Define academic calender for {{$current_year->academic_year_id}} Academic Year</legend>

		

      <!-- common/defferent-->
        
                   <ul class="nav nav-tabs">
                     <li><a data-toggle="tab" href="#basic">Common Calender</a></li>
                     <li><a data-toggle="tab" href="#other">Different Calender</a></li>
                  </ul>
          
       <div class="tab-content">
          <div id="basic" class="tab-pane fade">
            <form class="form-horizontal" method="post" id="form_registre" action="{{URL::Route('post_academic_calender_define', $current_year->academic_year_id)}}" name="form_registre" novalidate>
        	<div class="row-fluid" style ="margin-left: 5px;" >
        		<div class="span12 row-fluid">

              @for($i = 1; $i <=2; $i++)
            <div class="span6">
              <legend>Semester {{$i}}</legend>

               
                   <div class="row-fluid" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" ><b>Academic Details</b></label>
                </div>
              
                  <div class="span4 row-fluid">
                    <input id="ac{{$i}}" name="ac{{$i}}" type="checkbox" class="ac{{$i}}" value="1">
              </div>
              </div>

                <!-- semester start date -->
               <div class="row-fluid Sem{{$i}}" style ="margin-left: 5px;" >
                <div class="span3">
                   <label id="sem" class="control-labelme" for="" >Semester</label>
                </div>
               </div>
          
              <div class="row-fluid Start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">

                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                
                @if(isset($current_year)&&($i==1))
                   <input name="sem_start_date{{$i}}" id="sem_start_date{{$i}}" class="input-large" type="date" value="{{$current_year->starting_date}}" required>
                @else
                    <input name="sem_start_date{{$i}}" id="sem_start_date{{$i}}" class="input-large" type="date" value="{{$sem2_start}}" required>
                @endif
            </div>
           
              </div>  

     </br>   
              <!-- semester end date -->
              <div class="row-fluid End{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">

                @if(isset($current_year)&&($i==1))
                   <input name="sem_end_date{{$i}}" id="sem_end_date{{$i}}" class="sem_start_date-large" type="date" value="{{$sem_end}}" required>
               @else
                    <input name="sem_end_date{{$i}}" id="sem_end_date{{$i}}" class="sem_start_date-large" type="date" value="{{$sem2_end}}" required>
                @endif
            </div>
              </div>  
</br>
      

              <!-- mid vacation -->
               <div class="row-fluid mid{{$i}}" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" >Mid Vacation</label>
                </div>
              </div>
        
              <div class="row-fluid mid_start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                 @if(isset($current_year)&&($i==1))
                  <input name="mid_start_date{{$i}}" id="mid_start_date{{$i}}" class="input-large" type="date" value="{{$mid}}" required>
                  @else
                  <input name="mid_start_date{{$i}}" id="mid_start_date{{$i}}" class="input-large" type="date" value="{{$mid2_start}}" required>
                @endif

            </div>
            
              </div>  

     </br>   
              <!-- semester end date -->
              <div class="row-fluid mid_end{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">

              @if(isset($current_year)&&($i==1))
               
              <input name="mid_end_date{{$i}}" id="mid_end_date{{$i}}" class="mid_end_date-large" type="date"value="{{$mide}}" required>
              @else
               <input name="mid_end_date{{$i}}" id="mid_end_date{{$i}}" class="mid_end_date-large" type="date"value="{{$mid2_end}}" required>
            @endif

            </div>
              </div>  
</br>
</br>
             <!-- Study Leave -->
               <div class="row-fluid" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" ><b>Study Leave Details</b></label>
                </div>
                   <div class="span4 row-fluid">
                    <input id="sld{{$i}}" name="sld{{$i}}" type="checkbox" class="sld{{$i}}" value="2">
              </div>
              </div>
        
              <div class="row-fluid sld_start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                 @if(isset($current_year)&&($i==1))
                   <input name="study_start_date{{$i}}" id="study_start_date{{$i}}" class="input-large" type="date" value="{{$sl_start}}" required>
                 @else
                    <input name="study_start_date{{$i}}" id="study_start_date{{$i}}" class="input-large" type="date" value="{{$sl2_start}}" required>
                  @endif
            </div>
            
              </div>  

     </br>   
              <!-- semester end date -->
              <div class="row-fluid sld_end{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">
                @if(isset($current_year)&&($i==1))
              <input name="study_end_date{{$i}}" id="study_end_date{{$i}}" class="study_start_date-large" type="date" value="{{$sl_end}}" required>
               @else
                <input name="study_end_date{{$i}}" id="study_end_date{{$i}}" class="study_start_date-large" type="date" value="{{$sl2_end}}" required>
                @endif
            </div>
              </div>  

    </br>
    </br>

             <!-- exam -->
               <div class="row-fluid" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" ><b>Exam Details</b></label>
                </div>
                 <div class="span4 row-fluid">
                    <input id="ed{{$i}}" name="ed{{$i}}" type="checkbox" class="ed{{$i}}" value="3">
              </div>
              </div>
        
              <div class="row-fluid ed_start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                 @if(isset($current_year)&&($i==1))
                   <input name="exam_start_date{{$i}}" id="exam_start_date{{$i}}" class="input-large" type="date" value="{{$exam_start}}"  required>
                @else
                    <input name="exam_start_date{{$i}}" id="exam_start_date{{$i}}" class="input-large" type="date" value="{{$exam2_start}}"  required>
                @endif
                
            </div>
            
              </div>  

     </br>   
              <!-- exam end date -->
              <div class="row-fluid ed_end{{$i}} " style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">
                @if(isset($current_year)&&($i==1))
              <input name="exam_end_date{{$i}}" id="exam_end_date{{$i}}" class="exam_start_date-large" type="date" value="{{$exam_end}}" required>
                @else
                  <input name="exam_end_date{{$i}}" id="exam_end_date{{$i}}" class="exam_start_date-large" type="date" value="{{$exam2_end}}" required>
                @endif
              
            </div>
              </div>  

    </br>
    </br>


               <!-- vacation-->
               <div class="row-fluid" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" ><b>Vacation Details</b></label>
                </div>
                 <div class="span4 row-fluid">
                    <input id="vd{{$i}}" name="vd{{$i}}" type="checkbox" class="vd{{$i}}" value="4">
              </div>
              </div>
        
              <div class="row-fluid vd_start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                @if(isset($current_year)&&($i==1))
                   <input name="vac_start_date{{$i}}" id="vac_start_date{{$i}}" class="input-large" type="date" value="{{$vac_start}}" required>
                @else
                   <input name="vac_start_date{{$i}}" id="vac_start_date{{$i}}" class="input-large" type="date" value="{{$vac2_start}}" required>
                 @endif
            </div>
            
              </div>  

     </br>   
              <!-- semester end date -->
              <div class="row-fluid vd_end{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">
                @if(isset($current_year)&&($i==1))
              <input name="vac_end_date{{$i}}" id="vac_end_date{{$i}}" class="vac_start_date-large" type="date" value="{{$vac_end}}" required>
                @else
                  <input name="vac_end_date{{$i}}" id="vac_end_date{{$i}}" class="vac_start_date-large" type="date" value="{{$vac2_end}}" required>
                 @endif
            </div>
              </div>  

    </br>
              
            </div>  
            
@endfor
           
           <div class="span8">
                <center>  <button id="submit" name="submit" class="btn btn-primary" >submit</button></center>
                </div>   
      
        		

        		
        



               </div>
               </div>
            </form>
            </div>
          

<!--/////////////////////////////different calender///////////////////////////////-->
            <div id="other" class="tab-pane fade">

            <?php
              $academic=AcademicCalender::where('acc_year',$current_year->academic_year_id)->get();
           
            ?>
              <form class="form-horizontal" method="post" id="form_registre" action="{{URL::Route('post_defacademic_calender_define', $current_year->academic_year_id)}}" name="form_registre" novalidate>
              <div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span12 row-fluid">

                
                  <div class="span8">
           
                   <label class="control-labelme" for="" ><b>General Degree Programs</b></label>
               


                  <div class="span4" style ="margin-left: 45px;" >
                
                <div class="row-fluid">
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
               
                 

                </div>
           
            </br>
                <div class=" row-fluid">
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
             </div>

                <div class="span4">
                <div class="row-fluid General" style ="margin-left: 45px;" >
               
                <div class="row-fluid">

                  @if(isset($academic1)&&isset($academic4))
                 
                    <input id="1" name="glevel1" type="checkbox" class="level" value="1" disabled="disabled" checked="checked">Level 1
                  @else
                    <input id="1" name="glevel1" type="checkbox" class="level" value="1">Level 1

                  @endif
                </div>
             </div>
             <div class="row-fluid General" style ="margin-left: 45px;" >
                
                <div class="row-fluid">
                  @if(isset($academic2)&&isset($academic5))
                    <input id="2" name="glevel2" type="checkbox" class="level" value="2" disabled="disabled" checked="checked">Level 2
                  @else
                     <input id="2" name="glevel2" type="checkbox" class="level" value="2">Level 2
                  @endif
                </div>
             </div>          
             <div class="row-fluid General" style ="margin-left: 45px;" >
                
                <div class="row-fluid">
                   @if(isset($academic3)&&isset($academic6))
                    <input id="3" name="glevel3" type="checkbox" class="level" value="3" disabled="disabled" checked="checked">Level 3
                    @else
                      <input id="3" name="glevel3" type="checkbox" class="level" value="3">Level 3
                    @endif
                </div>
             </div>
           </div>
          </div>
        
         


    </br>


         <div class="span8 row-fluid">


          <label class="control-labelme" for="" ><b>Special Degree Programs</b></label>

          <?php

               $academic7=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SMAT')->where('level_id',1)->first();
                $academic8=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SMAT')->where('level_id',2)->first();
          ?>
          
              <div class="span4" style ="margin-left: 45px;" >
                
                <div class="row-fluid">
                   @if(isset($academic7)&&isset($academic8))
                    <input id="Mathematics" name="Mathematics" type="checkbox" class="Mathematics" value="Mathematics" disabled="disabled" checked="checked">Mathematics
                  @else
                     <input id="Mathematics" name="Mathematics" type="checkbox" class="Mathematics" value="Mathematics">Mathematics
                  @endif
                </div>
                 <div class="row-fluid">

               <?php

               $academic9=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SPHY')->where('level_id',1)->first();
                $academic10=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SPHY')->where('level_id',2)->first();
               ?>

                @if(isset($academic9)&&isset($academic10))
                    <input id="Physics" name="Physics" type="checkbox" class="Physics" value="Physics" disabled="disabled" checked="checked">Physics
                @else
                    <input id="Physics" name="Physics" type="checkbox" class="Physics" value="Physics">Physics
                @endif
                </div>
             
             <div class="row-fluid">

              <?php

               $academic11=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SCHE')->where('level_id',1)->first();
                $academic12=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SCHE')->where('level_id',2)->first();
               ?>

                @if(isset($academic11)&&isset($academic12))
                    <input id="Chemistry" name="Chemistry" type="checkbox" class="Chemistry" value="Chemistry"  disabled="disabled" checked="checked">Chemistry

                @else
                    <input id="Chemistry" name="Chemistry" type="checkbox" class="Chemistry" value="Chemistry">Chemistry
                @endif
                </div>
        
               
                
                <div class="row-fluid">

              <?php

               $academic13=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SZOO')->where('level_id',1)->first();
                $academic14=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SZOO')->where('level_id',2)->first();
               ?>

                @if(isset($academic13)&&isset($academic14))
                    <input id="Zoology" name="Zoology" type="checkbox" class="Zoology" value="Zoology"  disabled="disabled" checked="checked">Zoology
                @else
                     <input id="Zoology" name="Zoology" type="checkbox" class="Zoology" value="Zoology">Zoology
                @endif
                </div>
           
            
                <div class="row-fluid">
                  <?php

               $academic15=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SBOT')->where('level_id',1)->first();
                $academic16=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','SBOT')->where('level_id',2)->first();
               ?>

                @if(isset($academic15)&&isset($academic16))
                    <input id="Botany" name="Botany" type="checkbox" class="Botany" value="Botany"  disabled="disabled" checked="checked">Botany
                @else
                     <input id="Botany" name="Botany" type="checkbox" class="Botany" value="Botany">Botany
                @endif
                </div>
                </div>


                <div class="span4">
                <div class="row-fluid Special1" style ="margin-left: 45px;" >
               
                <div class="row-fluid">
                   @if(isset($academic7)&&isset($academic9)&&isset($academic11)&&isset($academic13)&&isset($academic15))
                    <input id="1" name="slevels1" type="checkbox" class="level" value="1" disabled="disabled" checked="checked">Level 1
                  @else
                      <input id="1" name="slevels1" type="checkbox" class="level" value="1">Level 1
                  @endif
                </div>
             </div>
             <div class="row-fluid  Special1" style ="margin-left: 45px;" >
                
                <div class="row-fluid">
                   @if(isset($academic8)&&isset($academic10)&&isset($academic12)&&isset($academic14)&&isset($academic16))
                    <input id="2" name="slevels2" type="checkbox" class="level" value="2" disabled="disabled" checked="checked">Level 2
                   @else
                    <input id="2" name="slevels2" type="checkbox" class="level" value="2">Level 2
                   @endif
                </div>
             </div>          
             </div>

    

        
           </div>
         </br>
        

              <div class="span8 row-fluid">

          <label class="control-labelme" for="" ><b>BCS Special Degree Programs</b></label>
          
              <div class="span4" style ="margin-left: 45px;" >
                <?php
                  $academic17=AcademicCalender::where('acc_year',$current_year->academic_year_id)->where('degree','=','S2')->where('level_id',4)->first();
               ?>
                <div class="row-fluid">
                  @if(isset($academic17))
                    <input id="sBCS" name="sBCS" type="checkbox" class="BCS" value="BCS" disabled="disabled" checked="checked">BCS
                  @else
                    <input id="sBCS" name="sBCS" type="checkbox" class="BCS" value="BCS">BCS
                  @endif
                </div>
                 </div>
                <div class="span4">
                   <div class="row-fluid Special1" style ="margin-left: 45px;" >
               
                <div class="row-fluid">
                  @if(isset($academic17))
                    <input id="1" name="level4" type="checkbox" class="level" value="4" disabled="disabled" checked="checked">Level 4
                  @else
                    <input id="1" name="level4" type="checkbox" class="level" value="4">Level 4
                  @endif
                </div>
             </div>
            </div>

        
          
          </div>
        </div>
         

            <div class="span12">
             @for($i = 1; $i <=2; $i++)
            <div class="span6">
              <legend>Semester {{$i}}</legend>

               
                   <div class="row-fluid" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" ><b>Academic Details</b></label>
                </div>
              
                  <div class="span4 row-fluid">
                    <input id="ac{{$i}}" name="ac{{$i}}" type="checkbox" class="ac{{$i}}" value="1">
              </div>
              </div>

                <!-- semester start date -->
               <div class="row-fluid Sem{{$i}}" style ="margin-left: 5px;" >
                <div class="span6">
                   <label id="sem" class="control-labelme" for="" >Semester</label>
                </div>
               </div>
          
              <div class="row-fluid Start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">

                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                
                @if(isset($current_year)&&($i==1))
                   <input name="sem_start_date{{$i}}" id="sem_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD" required>
                @else
                    <input name="sem_start_date{{$i}}" id="sem_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD" required>
                @endif
            </div>
           
              </div>  

     </br>   
              <!-- semester end date -->
              <div class="row-fluid End{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">

                @if(isset($current_year)&&($i==1))
                   <input name="sem_end_date{{$i}}" id="sem_end_dated{{$i}}" class="sem_start_date-large" type="date" value="YYYY-MM-DD" required>
               @else
                    <input name="sem_end_date{{$i}}" id="sem_end_dated{{$i}}" class="sem_start_date-large" type="date" value="YYYY-MM-DD" required>
                @endif
            </div>
              </div>  
</br>
      

              <!-- mid vacation -->
               <div class="row-fluid mid{{$i}}" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" >Mid Vacation</label>
                </div>
              </div>
        
              <div class="row-fluid mid_start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                 @if(isset($current_year)&&($i==1))
                  <input name="mid_start_date{{$i}}" id="mid_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD" required>
                  @else
                  <input name="mid_start_date{{$i}}" id="mid_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD" required>
                @endif

            </div>
            
              </div>  

     </br>   
              <!-- semester end date -->
              <div class="row-fluid mid_end{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">

              @if(isset($current_year)&&($i==1))
               
              <input name="mid_end_date{{$i}}" id="mid_end_dated{{$i}}" class="mid_end_date-large" type="date" value="YYYY-MM-DD" required>
              @else
               <input name="mid_end_date{{$i}}" id="mid_end_dated{{$i}}" class="mid_end_date-large" type="date" value="YYYY-MM-DD" required>
            @endif

            </div>
              </div>  
</br>
</br>
             <!-- Study Leave -->
               <div class="row-fluid" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" ><b>Study Leave Details</b></label>
                </div>
                   <div class="span4 row-fluid">
                    <input id="sld{{$i}}" name="sld{{$i}}" type="checkbox" class="sld{{$i}}" value="2">
              </div>
              </div>
        
              <div class="row-fluid sld_start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                 @if(isset($current_year)&&($i==1))
                   <input name="study_start_date{{$i}}" id="study_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD" required>
                 @else
                    <input name="study_start_date{{$i}}" id="study_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD" required>
                  @endif
            </div>
            
              </div>  

     </br>   
              <!-- semester end date -->
              <div class="row-fluid sld_end{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">
                @if(isset($current_year)&&($i==1))
              <input name="study_end_date{{$i}}" id="study_end_dated{{$i}}" class="study_start_date-large" type="date" value="YYYY-MM-DD" required>
               @else
                <input name="study_end_date{{$i}}" id="study_end_dated{{$i}}" class="study_start_date-large" type="date" value="YYYY-MM-DD" required>
                @endif
            </div>
              </div>  

    </br>
    </br>

             <!-- exam -->
               <div class="row-fluid" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" ><b>Exam Details</b></label>
                </div>
                 <div class="span4 row-fluid">
                    <input id="ed{{$i}}" name="ed{{$i}}" type="checkbox" class="ed{{$i}}" value="3">
              </div>
              </div>
        
              <div class="row-fluid ed_start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                 @if(isset($current_year)&&($i==1))
                   <input name="exam_start_date{{$i}}" id="exam_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD"  required>
                @else
                    <input name="exam_start_date{{$i}}" id="exam_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD"  required>
                @endif
                
            </div>
            
              </div>  

     </br>   
              <!-- exam end date -->
              <div class="row-fluid ed_end{{$i}} " style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">
                @if(isset($current_year)&&($i==1))
                 <input name="exam_end_date{{$i}}" id="exam_end_dated{{$i}}" class="exam_start_date-large" type="date" value="YYYY-MM-DD" required>
                @else
                  <input name="exam_end_date{{$i}}" id="exam_end_dated{{$i}}" class="exam_start_date-large" type="date" value="YYYY-MM-DD" required>
                @endif
              
            </div>
              </div>  

    </br>



               <!-- vacation-->
               <div class="row-fluid" style ="margin-left: 5px;" >
                <div class="span6">
                   <label class="control-labelme" for="" ><b>Vacation Details</b></label>
                </div>
                 <div class="span4 row-fluid">
                    <input id="vd{{$i}}" name="vd{{$i}}" type="checkbox" class="vd{{$i}}" value="4">
              </div>
              </div>
        
              <div class="row-fluid vd_start{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >Starting Date</label>
                </div>
               <div class="span3 row-fluid">
                @if(isset($current_year)&&($i==1))
                   <input name="vac_start_date{{$i}}" id="vac_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD" required>
                @else
                   <input name="vac_start_date{{$i}}" id="vac_start_dated{{$i}}" class="input-large" type="date" value="YYYY-MM-DD" required>
                 @endif
            </div>
            
              </div>  

     </br>   
              <!-- semester end date -->
              <div class="row-fluid vd_end{{$i}}" style ="margin-left: 15px;" >
                <div class="span3">
                   <label class="control-labelme" for="" >End Date</label>
                </div>
               <div class="span3 row-fluid">
                @if(isset($current_year)&&($i==1))
              <input name="vac_end_date{{$i}}" id="vac_end_dated{{$i}}" class="vac_start_date-large" type="date" value="YYYY-MM-DD" required>
                @else
                  <input name="vac_end_date{{$i}}" id="vac_end_dated{{$i}}" class="vac_start_date-large" type="date" value="YYYY-MM-DD" required>
                 @endif
            </div>
              </div>  

    </br>
              
            </div>  
            
@endfor
</div>
           
           <div class="span8">
                <center>  <button id="submit" name="submit" class="btn btn-primary" >submit</button></center>
                </div> 





 </div>

        </form>
          </div>






          </div>

        
      </div>
    </div>
   @stop