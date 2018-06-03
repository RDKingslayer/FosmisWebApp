@extends('layouts.dashboard')

@section('css')
    <style type="text/css">
        legend
        {
            font-size: 16px;
            font-weight: bold;
        }
        
        #frmregistercourse label
        {
            font-weight: bold;
        }
        
        #frmregistercourse #cstype
        {
            width: 290px;
        }
        
        #frmregistercourse #cs_prefix
        {
            width:35px;
        }
        
        #frmregistercourse #cs_code
        {
            width: 155px;
        }
        
        #frmregistercourse #course_name
        {
            width:275px;
        }
        
        .warning
        {
            color:red;
            font-weight: bold;
        }
        
    </style>
@stop

@section('js')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
     <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
    <script type="text/javascript">
        
        
        
        function post_submit_check()
        {
            var degree_programs=[];
           $("input:checkbox[name='degree_program[]']:checked").each(function()
                                                                    {
               degree_programs.push($(this).val());
               
           });
         
            
            
            if(degree_programs.length==0)
                {
                    alert("Please select the degree program from Target Groups");
                    return false;
                }
            else if($.inArray("BSc",degree_programs)!=-1)
                {
                    
                    if($("#cs_code").val().charAt(0)!=4)
                        {
                            if(($("input:radio[name='bsc_ps']:checked").val()==undefined) && ($("input:radio[name='bsc_bs']:checked").val()==undefined))
                            {
                                alert("Please select combinations from Physical Science or Bio Science ");
                                return false;
                            }
                        }
                    else
                        {
                            var special_selected=[];
                            
                            $("input:checkbox[name='SP[]']:checked").each(function(){
                                
                                
                                special_selected.push($(this).val());
                                
                            });
                            
                            if(special_selected.length==0)
                                {
                                    alert("Please select a Special Degree Program");
                                    return false;
                                }
                            
                        }
                    
                    
                    
                }
                
            
                
            
                
                
                return true;
               
        }
        
        
        $(document).ready(function()
                         {
            
            
                $("#phy_science").hide();
                $("#bio_science").hide();
                $("#bcs_select").hide();
                $("#special_degree").hide();
                
                $("input:radio[name='bsc_ps']").prop('checked',false);
                $("input:radio[name='bsc_bs']").prop('checked',false);
                        
                $("input:checkbox[name='PS[]']").prop('disabled',true);
                $("input:checkbox[name='BS[]']").prop('disabled',true);
                        
                $("input:checkbox[name='PS[]']").prop('checked',false);
                $("input:checkbox[name='BS[]']").prop('checked',false);
            
            
            $("#cstype").change(function()
                               {
                
                $("#cs_prefix").val($("#cstype").val());
            });
            
            $("#cs_code").on('input',function()
                               {
                var codelength=$("#cs_code").val().length;
                var course_code=$("#cs_code").val();
                var course_prefix=$("#cs_prefix").val();
                
                if(codelength>=1)
                    {
                        var course_year=course_code.charAt(0);
                        $("#level").val(course_year);
                        
                        
                        $("#phy_science").hide();
                        $("#bio_science").hide();
                        $("#bcs_select").hide();
                        $("#special_degree").hide();
                        
                        $("input:checkbox[name='degree_program[]']").prop('checked',false);
                        $("input:checkbox[name='PS[]']").prop('checked',false);
                        $("input:checkbox[name='BS[]']").prop('checked',false);
                        $("input:checkbox[name='SP[]']").prop('checked',false);
                
                        
                        if(course_year==4)
                            {
                                $("label[for='bcs']").html("BCS (Special)");
                                $("label[for='bsc']").html("BSc (Special)");
                            }
                        else
                            {
                                 $("label[for='bcs']").html("BCS (General)");
                                $("label[for='bsc']").html("BSc (General)");
                            }
                    }
                
                if(codelength>=2)
                    {
                        $("#semester").val(course_code.charAt(1));
                    }
                
                if(codelength==4)
                    {
                       
                        
                        if(course_code.charAt(3)=='a')
                            {
                                   $("#credits").val("1.5");
                            }
                        else if(course_code.charAt(3)=='b')
                            {
                                $("#credits").val("2.5");
                            }
                        else if(course_code.charAt(3)=='d')
                            {
                                $("#credits").val("1.25");
                            }
                        else if(!isNaN(course_code.charAt(3)))
                            {
                                $("#credits").val(course_code.charAt(3));
                            }
                        else
                            {
                                return false;
                            }
                        
                         showExistenceStatus(course_prefix+course_code);
                        
                    }
                
            });
            
            $("#prerequisties").on('input',function()
            {
                var course=$("#prerequisties").val();
                if(course!="None" || course!="")
                    {
                        showPrerequistieStatus(course);
                    }
                    
                
                
            });
            
            $("input:checkbox[name='degree_program[]']").change(function()
            {
                var degree_program=[];
                $("input:checkbox[name='degree_program[]']:checked").each(function()
                {   
                    degree_program.push($(this).val());
                    
                });
                
                if($.inArray("BSc",degree_program)!=-1)
                {
                    if($("#cs_code").val().charAt(0)!=4)
                        {
                             $("#phy_science").show();
                             $("#bio_science").show(); 
                             $("#special_degree").hide();
                        }
                        else
                        {
                             $("#phy_science").hide();
                             $("#bio_science").hide(); 
                             $("#special_degree").show();  
                        }
                   
                        
                }
                
                else
                {
                    $("#phy_science").hide();
                    $("#bio_science").hide();
                    $("#special_degree").hide(); 
                    
                    $("input:radio[name='bsc_ps']").prop('checked',false);
                    $("input:radio[name='bsc_bs']").prop('checked',false);
                        
                    $("input:checkbox[name='PS[]']").prop('disabled',true);
                    $("input:checkbox[name='BS[]']").prop('disabled',true);
                        
                    $("input:checkbox[name='PS[]']").prop('checked',false);
                    $("input:checkbox[name='BS[]']").prop('checked',false);
                }
                
                
                if($.inArray("BCS",degree_program)!=-1)
                {
                    $("#bcs_select").show();    
                }
                else
                {
                    $("#bcs_select").hide();  
                }
                
                
            });
            
            $("input:checkbox[name='SP[]']").change(function()
                                                   {
                
                var sp_initial=["SMAT","SPHY","SCHE","SBOT","SZOO"];
                var sp_selected=[];
                
                $("input:checkbox[name='SP[]']:checked").each(function()
                                                     {
                    
                    sp_selected.push($(this).val());
                });
                
                if($.inArray($(this).val(),sp_selected)!=-1)
                    {
                        $("input:radio[name='"+$(this).val()+"'][value='core']").prop('checked',true);    
                    }
                    else
                    {
                        $("input:radio[name='"+$(this).val()+"']").prop('checked',false);    
                    }
                
            });
            
            
            $("input:radio[name='bsc_ps']").change(function()
                                                      {
                $("input:checkbox[name='PS[]']").prop('disabled',false);
                $("input:checkbox[name='PS[]']").prop('checked',true);
                    
            });
                
            $("input:radio[name='bsc_bs']").change(function()
                                                      {
                $("input:checkbox[name='BS[]']").prop('disabled',false);
                $("input:checkbox[name='BS[]']").prop('checked',true);
                    
            });
            
            
        });
        
         function validateNumber(evt)
         {
                
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                var codelength=$("#cs_code").val().length;
                //return !(charCode > 31 && (charCode < 48 || (charCode > 57)));
             
                if(codelength==1)
                {
                    return !(charCode>31 && (charCode<49 || (charCode>57 && charCode!=98)));    
                }
                else if(codelength==3)
                {
                     return !(charCode>31 && (charCode<49 || (charCode>57 && charCode<97) || (charCode==99) || (charCode>100) ));      
                }
                else
                {
                     return !(charCode > 31 && (charCode < 48 || (charCode > 57)));   
                }   
        }
        
        function isCourseExist(course,callback)
        {
            $.ajax({
                type:"GET",
                url:"isCourseUnitExist/"+course,
                dataType:'json',
                success:function(response)
                {
                    course_exist=response['output'];
                    callback(course_exist);
                }
            });
        }
        
       
        
        function showExistenceStatus(course)
        {
            var status=false;
            
            isCourseExist(course,function(status)
                         {
                
                    if(status)
                    {
                        $("#exist_warning").text("Course Already Exist");
                        $("#btnsave").prop('disabled',true);
                    }
                    else
                    {
                        $("#exist_warning").text("");
                        $("#btnsave").prop('disabled',false);
                    }
                
            });
        }
        
        function showPrerequistieStatus(course)
        {
            var status=false;
            
            isCourseExist(course,function(status)
                         {
                
                    if(status)
                    {
                        $("#prereq_warning").text("");
                        $("#btnsave").prop('disabled',false);
                    }
                    else
                    {
                        $("#prereq_warning").text("Course doesn't exist. Please Register the Course First");
                        $("#btnsave").prop('disabled',true);
                    }
                
            });
        }
        
        $(document).ready(function()
                         {
            $("#prerequisties").keypress(function()
                                        {
                $("#prerequisties").autocomplete({
                    
                    source:"getCourseUnitsAutoComplete",
                    minLength:1,
                    select: function(event, ui) {
                
	  	                $('#prerequisties').val(ui.item.value);
                        $("#prereq_warning").text("");
                        $("#btnsave").prop('disabled',false);
	               }
                });
                
            });
        });
    </script>
    <script type="text/javascript">
        
        $(document).ready(function()
        {
            $("#coursemodal").on('show.bs.modal',function(e){
    
                
                var course_code=$("#cs_prefix").val()+$("#cs_code").val();
                var course_name=$("#course_name").val();
                var course_type=$("#course_type option:selected").text();
                var level=$("#level").val();
                var credits=$("#credits").val();
                var semester=$("#semester").val();
                var prerequisties=$("#prerequisties").val();
                var target_groups="";
                
                var degree_programs=[];
                
                $("input:checkbox[name='degree_program[]']:checked").each(function()
                                                                        {
                    if($(this).val()=="BCS")
                        {
                            target_groups+=$("label[for='bcs']").html()+"-";
                            target_groups+=$("input:radio[name='bcs']:checked").val()+"<br/>";
                        }
                    
                    if($(this).val()=="BSc")
                        {
                            
                            
                            if(level!=4)
                                {
                                    target_groups+=$("label[for='bsc']").html()+"-";
                                    if($("input:radio[name='bsc_ps']:checked").val()!=undefined)
                                    {
                                        target_groups+="<br/>Physical Science-"+$("input:radio[name='bsc_ps']:checked").val();
                                        $("input:checkbox[name='PS[]']:checked").each(function()
                                        {
                                                target_groups+="<br/>"+$(this).val();    
                                        }
                                                                                                
                                        );
                                }
                            
                                    if($("input:radio[name='bsc_bs']:checked").val()!=undefined)
                                    {
                                        target_groups+="<br/>Bio Science-"+$("input:radio[name='bsc_bs']:checked").val();
                                        $("input:checkbox[name='BS[]']:checked").each(function()
                                        {
                                                target_groups+="<br/>"+$(this).val();    
                                        }
                                                                                                
                                        );
                                    }
                                }
                                else
                                {
                                     
                                     $("input:checkbox[name='SP[]']:checked").each(function()
                                                                                  {
                                          switch($(this).val())
                                              {
                                                  case "SMAT":
                                                      target_groups+="BSc(Special) in Mathematics "+$("input:radio[name='SMAT']:checked").val();
                                                      break;
                                                      
                                                  case "SPHY":
                                                      target_groups+="BSc(Special) in Physics "+$("input:radio[name='SPHY']:checked").val();
                                                      break;
                                                      
                                                  case "SBOT":
                                                      target_groups+="BSc(Special) in Botany "+$("input:radio[name='SBOT']:checked").val();
                                                      break;
                                                      
                                                  case "SCHE":
                                                      target_groups+="BSc(Special) in Chemistry "+$("input:radio[name='SMAT']:checked").val();
                                                      break;
                                                      
                                                  case "SZOO":
                                                      target_groups+="BSc(Special) in Zoology "+$("input:radio[name='SMAT']:checked").val();
                                                      break;      
                                              }
                                         
                                            target_groups+="<br/>";
                                         
                                     });   
                                }
                            
                        }
                    
                });
                
                $("#session_coursecode").html("<b>"+course_code+"</b>");
                $("#session_coursename").html("<b>"+course_name+"</b>");
                $("#session_coursetype").html("<b>"+course_type+"</b>");
                $("#session_courselevel").html("<b>"+level+"</b>");
                $("#session_coursesemeseter").html("<b>"+semester+"</b>");
                $("#session_coursecredit").html("<b>"+credits+"</b>");
                $("#session_courseprerequisties").html("<b>"+prerequisties+"</b>");
                $("#session_target_groups").html("<b>"+target_groups+"</b>");
                
            });
            
        });

    </script>
@stop

@section('content')
<div class="well span9">
    <legend>Register New Course</legend>
    {{Form::open(array("id"=>"frmregistercourse",'action'=>'HodController@saveCourseUnit','onsubmit'=>'return post_submit_check();'))}}
    
    <div class="row-fluid">
        <div class="span4">
             {{Form::label('cstype','Subject Category')}}
             {{Form::select('cstype',$sub_cat)}}
        </div>
        <div class="span4 offset4">
            {{Form::label('cs_code','Course Code')}}
            {{Form::text('cs_prefix',key($sub_cat),array('readonly'=>'readonly','id'=>'cs_prefix','required'=>'required'))}}
            {{Form::text('cs_code','',array('id'=>'cs_code','required'=>'required','title'=>'Last Digits only','maxlength'=>'4','onkeypress'=>'return validateNumber(event);'))}}
            <div id="exist_warning" class="warning"></div>
        </div>
         
    </div>
    <div class="row-fluid" style="margin-top:20px;">
        <div class="span7">
            {{Form::label('course_name',"Course Title")}}
            {{Form::text('course_name','',array('id'=>'course_name','required'=>'required'))}}
        </div>
        <div class="offset1 span2">
            {{Form::label('course_type',"Course Type")}}
            {{Form::select('course_type',['Theory'=>'Theory','Practical'=>'Practical','Theory+Practical'=>'Theory+Practical'])}}
        </div>
    </div>
    
    <div class="row-fluid" style="margin-top:20px;">
        
        <div class="span2">
            {{Form::label('level','Level')}}
            {{Form::text('level','',array('id'=>'level','readonly'=>'readonly'))}}
        </div>
        
        <div class="offset2 span2">
            {{Form::label('semester','Semester')}}
            {{Form::text('semester','',array('id'=>'semester','readonly'=>'readonly'))}}
        </div>
        
        <div class="offset2 span2">
            {{Form::label('credits','Credits')}}
            {{Form::text('credits','',array('id'=>'credits','readonly'=>'readonly'))}}
        </div>    
    </div>
    
    <div class="row-fluid" style="margin-top:20px;">
        
        <div class="span2">
            {{Form::label('prerequisties',"Prerequisties")}}
            {{Form::text('prerequisties','None',array('id'=>'prerequisties'))}}
            <div id="prereq_warning" class="warning"></div>
        </div>
        
        <div class="offset2 span8">
            {{Form::label('target groups',"Target Groups")}}
            <div class="row-fluid"> 
                
                {{Form::checkbox('degree_program[]','BCS')}}
                {{Form::label('bcs','BCS (General)',array('style'=>'display:inline'))}}
                    <div id="bcs_select" style="margin-top:5px;">
                        {{Form::radio('bcs','core',true)}}&nbsp;Core &nbsp;
                        {{Form::radio('bcs','optional')}}&nbsp;Optional
                    </div>    
                
            </div>
            
           <div class="row-fluid"  style="margin-top:15px;">
             
                {{Form::checkbox('degree_program[]','BSc')}}    
                {{Form::label('bsc','BSc (General)',array('style'=>'display:inline'))}}
                    <br/>
                    <div id="phy_science"  class="span6" style="margin-top:5px;margin-left:0px;">
                        <b>Physical Science</b><br/>
                        {{Form::radio('bsc_ps','core')}}&nbsp;Core &nbsp;&nbsp;
                        {{Form::radio('bsc_ps','optional')}}&nbsp;Optional
                        <div style="margin-top:5px;">
                            <div class="span3">
                                {{Form::checkbox('PS[]','PS1')}}&nbsp;PS 1<br/> 
                                {{Form::checkbox('PS[]','PS2')}}&nbsp;PS 2<br/> 
                                {{Form::checkbox('PS[]','PS3')}}&nbsp;PS 3<br/> 
                                {{Form::checkbox('PS[]','PS4')}}&nbsp;PS 4<br/> 
                            </div>
                            
                            <div class="span3">
                                {{Form::checkbox('PS[]','PS5')}}&nbsp;PS 5<br/>
                                {{Form::checkbox('PS[]','PS6')}}&nbsp;PS 6<br/>
                                {{Form::checkbox('PS[]','PS7')}}&nbsp;PS 7<br/>
                                {{Form::checkbox('PS[]','PS8')}}&nbsp;PS 8<br/>  
                            </div>
                           
                               
                        </div>
                        
                    </div>
             
                    <div id="bio_science" class="span4" style="margin-top:5px;">
                        <b>Bio Science</b><br/>
                        {{Form::radio('bsc_bs','core')}}&nbsp;Core &nbsp;&nbsp;
                        {{Form::radio('bsc_bs','optional')}}&nbsp;Optional
                        <div style="margin-top:5px;">
                            {{Form::checkbox('BS[]','BS1')}}&nbsp;BS 1<br/> 
                            {{Form::checkbox('BS[]','BS2')}}&nbsp;BS 2<br/> 
                            {{Form::checkbox('BS[]','BS3')}}&nbsp;BS 3<br/> 
                            {{Form::checkbox('BS[]','BS4')}}&nbsp;BS 4<br/> 
                            
                        </div>
                    </div>
               
                    <div id="special_degree" class="row-fluid" style="margin-top:5px">
                        <div class="row-fluid">
                            <div class="span6">
                                {{Form::checkbox('SP[]','SMAT')}}&nbsp;BSc(Special) in Mathematics
                            </div>
                            <div class="span4">
                                {{Form::radio('SMAT','core')}}&nbsp;Core&nbsp;
                                {{Form::radio('SMAT','optional')}}&nbsp;Optional
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            <div class="span6">
                                {{Form::checkbox('SP[]','SPHY')}}&nbsp;BSc(Special) in Physics
                            </div>
                            <div class="span4">
                                {{Form::radio('SPHY','core')}}&nbsp;Core&nbsp;
                                {{Form::radio('SPHY','optional')}}&nbsp;Optional
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            <div class="span6">
                                {{Form::checkbox('SP[]','SBOT')}}&nbsp;BSc(Special) in Botany
                            </div>
                            <div class="span4">
                                {{Form::radio('SBOT','core')}}&nbsp;Core&nbsp;
                                {{Form::radio('SBOT','optional')}}&nbsp;Optional
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            <div class="span6">
                                {{Form::checkbox('SP[]','SZOO')}}&nbsp;BSc(Special) in Zoology
                            </div>
                            <div class="span4">
                                {{Form::radio('SZOO','core')}}&nbsp;Core&nbsp;
                                {{Form::radio('SZOO','optional')}}&nbsp;Optional
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            <div class="span6">
                                {{Form::checkbox('SP[]','SCHE')}}&nbsp;BSc(Special) in Chemistry
                            </div>
                            <div class="span4">
                                {{Form::radio('SCHE','core')}}&nbsp;Core&nbsp;
                                {{Form::radio('SCHE','optional')}}&nbsp;Optional
                            </div>
                        </div>
                        
                    </div>
            
            </div>
            
        </div>    
        
    </div>
  
    
    <div class="row-fluid" style="margin-top:20px;">
        <center>{{Form::button('Save',array('id'=>'btnsave','class'=>'btn btn-primary','data-target'=>'#coursemodal','data-toggle'=>'modal'))}}</center>
    </div>
    
    <div id="coursemodal" class="modal fade" role="dialog" tabindex="-1" style="display:none">
        <div class="modal-dialog">
            
            <!--Modal Content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Course Details</h4>
                </div>
                <div class="modal-body">
                    <table style="width:800px;">
                        <tr>
                            <td>Course Code</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><div id="session_coursecode"></div></td>
                       </tr>
                        <tr>
                            <td>Course Name</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><div id="session_coursename"></div></td>   
                        </tr>
                        <tr>
                            <td>Course Type</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><div id="session_coursetype"></div></td>   
                        </tr>    
                          
                        <tr>
                            <td>Level</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><div id="session_courselevel"></div></td>
                        </tr>
                        
                        <tr>    
                            <td>Semester</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><div id="session_coursesemeseter"></div></td> 
                        </tr>    
                          
                        <tr>
                            <td>Credits</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><div id="session_coursecredit"></div></td>  
                        </tr>
                        
                        <tr>
                            <td>Prerequisties</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><div id="session_courseprerequisties"></div></td>  
                        </tr>
                        
                        <tr>
                            <td style="vertical-align:top;">Target Groups</td>
                            <td style="vertical-align:top;">&nbsp;:&nbsp;</td>
                            <td><div id="session_target_groups"></div></td>  
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    {{Form::Submit('Save',array('class'=>'btn btn-primary'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                </div>
            </div>
            
        </div>
    </div>
    
{{Form::close()}}    
@stop