@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="/css/selectize.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />   
@stop


@section('js')

<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/js/selectize.min.js"></script>
<script type="text/javascript" src="/js/course_unit.js"></script>
<script type="text/javascript">
	  $(document).ready(function(){

         $(".selectized").click(function() {
            $.ajax({
               url: "{{ URL::Route('Prerequisites') }}",
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

@stop

@section('content')
<?php $degree=Degree::all();
		$degree_fsc=Degree::all();
?>

 
	<div class="well span8">
		<legend>Register New Course Unit</legend>

		<form class="form-horizontal" method="post" id="form_registre" action="{{URL::Route('post-course-unit')}}" name="form_registre" novalidate>

      <!-- FSC/NONFSC -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Course Category</label>
            </div>

            <div class="span4 row-fluid">
               <div class="span6">
                  <input type="radio" name='fsc' value="other" required> Subject</label>
               </div>
               <div class="span6">
                  <input type="radio" name='fsc' value="fsc" required> FSC</label>                  
               </div>
            </div>
        	</div>
</br>
      <!-- Department -->
         <div class="row-fluid dept" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Department/Unit</label>
            </div>

            <div class="span4 row-fluid">
                  <select   name='department' id='department' placeholder="Enter Department here" class="input-large" type="text" required>
                     <option></option>
                     <option>Computer Science</option>
                     <option>Chemistry</option>
                     <option>Physics</option>
                     <option>Zoology</option>
                     <option >Botany</option>
                     <option >Mathematics</option>
                     <option >English Unit</option>
                  </select>
            </div>
            <div class="span4">
               @if($errors->has('department'))
                  {{$errors->first('department')}}
                @endif
            </div>
         </div>
</br>
		<!-- Special/General -->
        	<div class="row-fluid study_program" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Study Program</label>
            </div>

            <div class="span4 row-fluid">
            	<select name="degree" id="degree" placeholder="Select Degree" class="input-large" type="text" >
            		<option value=""></option>
            		@foreach($degree as $degree)
            		<option value="{{$degree->Degree_name}}">{{$degree->Degree_name}} Degree</option>
            		@endforeach
            	</select>
            </div>
            <div class="span4 row-fluid">           	
            </div>
        	</div>
</br>
      <!-- Subjects -->
         <div class="row-fluid Maths_subject" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Subjects</label>
            </div>
            <div class="span4 row-fluid Maths_subject">
               <div class="span4">
                  <input type="radio" name='maths_subject' id='maths_subject' value="MAT"> MAT
               </div>
               <div class="span4">
                  <input type="radio" name='maths_subject' id='maths_subject' value="AMT"> AMT
               </div>
               <div class="span4">
                  <input type="radio" name="maths_subject" id='maths_subject' value="IMT"> IMT
               </div>            
            </div>
            <div class="span4">
            </div>
         </div>
</br>

        	<!-- Code -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Course Code</label>
            </div>
            <div class="span4 row-fluid">
               <input  name='code' id="code" placeholder="Enter Course Code here" class="input-large" type="text" pattern="^([COMATBZPHYSFENGI]{3})([0-8a-z]{4})" maxlength="7" required>
            </div>
            <div class="span4">         
               @if($errors->has('code'))
                  {{$errors->first('code')}}
               @endif
            </div>
        	</div>
</br>
        	<!-- Title -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Course Ttile</label>
            </div>
            <div class="span4 row-fluid">
               <input  name='title' id="title" placeholder="Enter Course Title here" class="input-xlarge" type="text" required>
            </div>
            <div class="span4">         
               @if($errors->has('title'))
                  {{$errors->first('title')}}
               @endif
            </div>
        	</div>
</br>
        	<!-- Type -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Course Type</label>
            </div>
            <div class="span4 row-fluid">
               <select  name='type' id="type" placeholder="Enter Course Type here" class="input-large" type="text" required>
               	<option></option>
               	<option>Theory</option>
               	<option>Practicle</option>
               	<option>Theory+Practicle</option>
               </select>
				</div>
        	</div>
</br>
        	<!-- Level -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Level</label>
            </div>
	         <div class="span4 row-fluid">
               <input name="level" id="level" class="input-large" type="text" disabled="">
				</div>
        	</div>	
</br>
        	<!-- Semester -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Semester</label>
            </div>
	         <div class="span4 row-fluid">
              	<input name='semester' id="semester" class="input-large" type="text" disabled="">
				</div>
        	</div>
</br>
        	<!-- Credits -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Credits</label>
            </div>
	         <div class="span4 row-fluid">
               <input name='credits' id="credits" class="input-large" type="text" disabled="">
				</div>
        	</div>
</br>
        	<!-- Prerequsite -->
        	<div class="row-fluid" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Prerequisites</label>
            </div>
	         <div class="span4 row-fluid">               
               <div class="span6">
                  <input type="radio" name='Prerequisites' value="yes" required> Yes</label>
               </div>
               <div class="span6">
                  <input type="radio" name='Prerequisites' value="no" required> No</label>
               </div>
				</div>
        	</div>
</br>        	
        	<div class="row-fluid Prerequisite_course_code" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Course Code(s)</label>
            </div>
	         <div class="span3 row-fluid">               
               <input name='Prerequisite_code' id="Prerequisite_code" class="input-large selectized" type="text" tabindex="-1" style="display: block;" required>
				</div>
            <div class="span4 row-fluid"> 
               <p class="small"></p>
            </div>
        	</div>
</br>
        	<!-- target_group General -->
        	<div class="row-fluid target_group_general" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Target Group(s)</label>
            </div>
	         <div class="span2 row-fluid">
               <div class="checkbox checkbox-primary">
						<input id="bcs" name="bcs" type="checkbox" value="G2">BCS (General)
					</div>
				 </div>
				<div class="span6 row-fluid">	 
               <div class="span4 row-fluid">  
                  <input type="radio" name='c_o_bcs' id='c_o_bcs' value="Core" > Core</label>
               </div>
               <div class="span4 row-fluid"> 
                  <input type="radio" name='c_o_bcs' id='c_o_bcs' value="Optional"  style ="margin-left: 33px;"> Optional</label>
               </div>
				</div>
         </div>

         <div class="row-fluid target_group_general" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" ></label>
            </div>
            <div class="span2 row-fluid">
               <div class="checkbox checkbox-primary">
                  <input id="bsc" name="bsc" type="checkbox" value="G1">Bsc (General)
               </div>
             </div>
            <div class="span6 row-fluid All_Stream"> 
               <div class="span6 row-fluid">
                  <div class="span4 row-fluid checkbox checkbox-primary" >
                     <input id="all_ps" name="all_ps" type="checkbox" value="All_PS">All PS
                  </div>
                  <div class="span4 row-fluid" >
                     <input type="radio" name='c_o_ps' id='c_o_ps' value="Core" > Core
                  </div>
                  <div class="span4 row-fluid" >
                     <input type="radio" name='c_o_ps' id='c_o_ps' value="Optional" > Opt.
                  </div>
               </div>
               <div class="span6 row-fluid  All_Stream">
                  <div class="span4 row-fluid checkbox checkbox-primary" >
                     <input id="all_bs" name="all_bs" type="checkbox" value="All_BS">All BS
                  </div>
                  <div class="span4 row-fluid" >
                     <input type="radio" name='c_o_bs' id='c_o_bs' value="Core" >Core
                  </div>
                  <div class="span4 row-fluid" >
                     <input type="radio" name='c_o_bs' id='c_o_bs' value="Optional" >Opt.
                  </div>
               </div>               
            </div>
         </div>

        	<!-- General Bsc catogeries -->
        	<div class="row-fluid pathways_general" style ="margin-left: 45px;" >
            <div class="span4 row-fluid">
               <label class="control-labelme" for="" ></label>
            </div>

	         <div class="span2 row-fluid">
				</div>

				<div class="span6 row-fluid">	
					<div class="span6 row-fluid">  	
						   <div class="checkbox checkbox-primary" >
							  <input id="ps1" name="ps[]" type="checkbox" value="ps1">PS1
						   </div>
						   <div class="checkbox checkbox-primary" >
							  <input id="ps2" name="ps[]" type="checkbox" value="ps2">PS2
						   </div>
						   <div class="checkbox checkbox-primary" >
							  <input id="ps3" name="ps[]" type="checkbox" value="ps3">PS3
						   </div>
						   <div class="checkbox checkbox-primary" >
							  <input id="ps4" name="ps[]" type="checkbox" value="ps4">PS4
						   </div>
					</div>

					<div class="span6 row-fluid">	
   						<div class="checkbox checkbox-primary" >
   							<input id="bs1" name="bs[]" type="checkbox" value="bs1" >BS1
   						</div>
   						<div class="checkbox checkbox-primary" >
   							<input id="bs2" name="bs[]" type="checkbox" value="bs2">BS2
   						</div>
   						<div class="checkbox checkbox-primary" >
   							<input id="bs3" name="bs[]" type="checkbox" value="bs3">BS3
   						</div>
               </div>
            </div>
         </div>

        	<!-- target_group Special -->
        	<div class="row-fluid target_group_special" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Target Group(s)</label>
            </div>

	         <div class="span3 row-fluid">
               <div class="checkbox checkbox-primary">
						<input id="bcs_spe" name="bcs_spe" type="checkbox" value="S2">BCS Spe.						
					</div>
				 </div>

				<div class="span5 row-fluid">	
               <div class="span4 row-fluid"> 
                  <input type="radio" name='c_o_bcs_spe' id='c_o_bcs_spe' value="Core" > Core
                </div>
               <div class="span4 row-fluid">  
                  <input type="radio" name='c_o_bcs_spe' id='c_o_bcs_spe' value="Optional"  style ="margin-left: 65px;"> Opt.
				  </div>
            </div>
         </div>

        	<!-- special catogeries -->

         <div class="row-fluid target_group_special" style ="margin-left: 45px;" >
            <div class="span4">
            </div>

            <div class="span2 row-fluid">
               <div class="checkbox checkbox-primary">
                  <input id="bsc_spe" name="bsc_spe" type="checkbox" >Bsc Spe.                  
               </div>
            </div>

            <div class="span6 row-fluid"> 
            </div>
         </div>
         
         <?php 
         $name='BSc (Special)';
            $special_stream = Degree::where('Degree_name', 'LIKE', '%'.$name .'%')->get();
         ?>

         @foreach($special_stream as $special_stream)
        	<div class="row-fluid pathways_special" style ="margin-left: 45px;" >
            <div class="span4">
            </div>

	         <div class="span3 row-fluid">
               <div class="checkbox checkbox-primary row-fluid" >
                  <input id="{{$special_stream->Degree_id}}" name="{{$special_stream->Degree_id}}" type="checkbox" value="{{$special_stream->Degree_id}}">{{$special_stream->Degree_name}}
               </div> 
				</div>

				<div class="span5 row-fluid">	 
               <div class="span4 row-fluid">
                  <input type="radio" name='c_o_bsc_spe{{$special_stream->Degree_id}}' id='c_o_bsc_spe{{$special_stream->Degree_id}}' value="Core" > Core
               </div>        
               <div class="span4 row-fluid"> 
                  <input type="radio" name='c_o_bsc_spe{{$special_stream->Degree_id}}' id='c_o_bsc_spe{{$special_stream->Degree_id}}' value="Optional"  style ="margin-left: 65px;"> Opt.
               </div>
				</div>
         </div>
         @endforeach

        	<!-- target_groups FSC -->
         <div class="row-fluid target_group_fsc" style ="margin-left: 45px;" >
            <div class="span4">
               <label class="control-labelme" for="" >Target Group(s)</label>
            </div>
            <div class="span4">
            </div>
            <div class="span4">
            </div>
         </div>
               @foreach($degree_fsc as $degree_fsc)
                  <div class="row-fluid target_group_fsc" style ="margin-left: 45px;" >
                    <div class="span4">
                        <label class="control-labelme" for="" ></label>
                     </div>
   	         		<div class="span4">
                  		<div class="checkbox checkbox-primary">
   								<input id="{{$degree_fsc->Degree_id}}" name="{{$degree_fsc->Degree_id}}" type="checkbox" value="{{$degree_fsc->Degree_id}}">{{$degree_fsc->Degree_name}}
                        </div>
                    </div>

                     <div class="span4 row-fluid">
                        <div class="span6 row-fluid">
                           <input type="radio" name='c_o{{$degree_fsc->Degree_id}}' id='c_o{{$degree_fsc->Degree_id}}' value="Core"> Core
                        </div>
                        <div class="span6 row-fluid">
                           <input type="radio" name='c_o{{$degree_fsc->Degree_id}}' id='c_o{{$degree_fsc->Degree_id}}' value="Optional"> Opt.
                        </div>
                     </div>
                  </div>
               @endforeach
<br>
        	<!-- submit button -->
        <div class="row-fluid" style ="margin-bottom: 7px;">
            <div class="span6">
                <label class="control-labelme" for="submit"></label>
            </div>

            <div class="pull-left">
                <button id="submit" name="submit" class="btn btn-primary" >Submit</button>
            </div>

            <div class="span4"></div>
         </div>	
      </form>
	</div>
   <div class="span2"></div>

@stop
