@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <style type="text/css">
         legend
        {
            font-size: 16px;
            font-weight: bold;
        }
        
        #frmcutoff label
        {
            font-weight: bold;
        }

         #dept_courses_filter
         {
             display: none;
         }
        
        
        #course_table
        {
            
            margin-left: 0%;
        }
        
        #dept_courses
        {
            width: 100%;
        }
        
        #dept_courses td
        {
            white-space: nowrap;
            
        }
        
        .search_text
        {
            width: 60%;
            margin-left: 5%;
            
        }
        

    </style>
@stop

@section('js')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function()
        {
            //$('#CSC4221').val("100");   
            var table= $('#dept_courses').DataTable();
            
            
            $("#cs_code").on('keyup change',function(){
                
                table.column(0).search(this.value).draw();
                
            });
             $("#cs_type").on('change',function(){
                
                table.column(1).search(this.value).draw();
                
            });
            
            $("#level").on('keyup change',function(){
                
                table.column(2).search(this.value).draw();
                
            });
            
            $("#cs_cut_off").on('keyup change',function(){
                
                var cutoff_value=this.value;
                 var cells = [];
                
                var rows=$("#dept_courses").dataTable().$('tr', {"filter":"applied"});
                
                    for(var i=0;i<rows.length;i++)
                        {
                            cells.push($(rows[i]).find("input[type='text']"));
                            //var cut_id=$(rows[i]).find("input[type='text']").attr('id');
                            //console.log(cut_id);
                            //document.getElementById(cut_id).value=cutoff_value;
                            var cut_id=$(rows[i]).find("input[type='text']").attr('id'); 
                            //console.log(cut_id);
                            $(rows[i]).find("#"+cut_id).val(cutoff_value);
                            
                        }
                
            });
            
            
            
            
        });
        
        function set_hidden_value(ele)
        {
            var cur_id=ele.id;
            console.log(cur_id);
            document.getElementById("hid_cutoff"+cur_id).value=ele.value; 
            
        }
        
        function check_cutoff_validity()
        {
            var breakout=true;
            $("#dept_courses").dataTable().$(".search_text").each(function()
                                  {
                if(this.value>100)
                    {
                        breakout=false;
                    }
                
               set_hidden_value(this);
                
                
            });
            
              if(!breakout)
                  {
                      alert("Invalid Cut off value");
                      return false;
                  }
                else
                    {
                        return true;
                    }
        }
        
        
        function validateNumber(event)
        {
                
           var key = window.event ? event.keyCode : event.which;
            var keyletter=String.fromCharCode( key )
            if (event.keyCode === 8 || event.keyCode === 46 || keyletter==".") {
                return true;
            }
             else if ( key < 48 || key > 57 ) {
                return false;
            } else {
    	       return true;
            }
            
        }
        
    </script>
@stop


@section('content')
<div class="well span9">
   
    <legend>Set Eligibility Cut Off</legend>
    {{Form::open(array('id'=>'frmcutoff','route'=>'set_eligibility_cutoff','onsubmit'=>'return check_cutoff_validity();'))}}
    <div class="row-fluid">
        
        <div class="span3">
            
            {{Form::label('cs_code','Course Code')}}
            {{Form::text('cs_code','',array('id'=>'cs_code','placeholder'=>'Search'))}}
        </div>
        <div class="offset1 span3">
            {{Form::label('cs_type','Course Type')}}
            <select id="cs_type" name="cs_type">
                <option value="" selected disabled hidden="">Select Course Type</option>
                <option value=" ">All</option>
                <option value="Theory">Theory</option>
                <option value="Practical">Practical</option>
            </select>
        </div>    
        <div class="offset1 span3">
            {{Form::label('level','Level')}}
            {{Form::text('level','',array('id'=>'level','placeholder'=>'Level'))}}
        </div>
    </div>
    
    <div class="row-fluid">
        <div class="span3">
            {{Form::label('cs_cut_off','Eligibility Cut Off (%)')}}
            {{Form::text('cs_cut_off','',array('id'=>'cs_cut_off','onkeypress'=>'return validateNumber(event);', 'maxlength'=>'2'))}}
        </div>
    </div>    
    
    <hr style="border-top:5px double #e3e3e3"></hr> 
   
    <div id="course_table" class="row fluid">
       
        <table id="dept_courses" class="display">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Type</th>
                    <th>Level</th>
                    <th>Eligibility CutOff (%)</th>
                </tr>
            </thead>
            @foreach($dept_course as $cs_row)
            
                @if($cs_row['type']=="Theory+Practical")
            
                    <tr>
                        <td>{{$cs_row['code']."(T)"}}</td>
                        <td>Theory</td>
                        <td>{{$cs_row['level']}}</td>
                        <td><input type="text" name="cutoff[{{$cs_row['code'].'T'}}]" class="search_text" id="{{$cs_row['code'].'T'}}" value="{{CourseUnitCutoff::getCourseUnitCutoff($cs_row['code'],'Theory')}}" onkeypress="return validateNumber(event);" maxlength="2"></td>
                    </tr>    
            
                    <tr>
                        <td>{{$cs_row['code']."(P)"}}</td>
                        <td>Practical</td>
                        <td>{{$cs_row['level']}}</td>
                        <td><input type="text" name="cutoff[{{$cs_row['code'].'P'}}]" class="search_text" id="{{$cs_row['code'].'P'}}" value="{{CourseUnitCutoff::getCourseUnitCutoff($cs_row['code'],'Practical')}}" onkeypress="return validateNumber(event);" maxlength="2"></td>
                    </tr>    
            
                @else
                     <tr>
                        <td>{{$cs_row['code']}}</td>
                        <td>{{$cs_row['type']}}</td>
                        <td>{{$cs_row['level']}}</td>
                        <td><input type="text" id="{{$cs_row['code']}}" name="cutoff[{{$cs_row['code'].substr($cs_row['type'],0,1)}}]" class="search_text" onkeypress="return validateNumber(event);" value="{{CourseUnitCutoff::getCourseUnitCutoff($cs_row['code'],$cs_row['type'])}}" maxlength="2"></td>
                    </tr>    
                
                @endif
               
            
            @endforeach
        </table>
        </div>

        @foreach($dept_course as $cs_row)
             @if($cs_row['type']=="Theory+Practical")
                 <input type="hidden" id="hid_cutoff{{$cs_row['code'].'T'}}" name="hid_cutoff[{{$cs_row['code'].'T'}}]" value="{{CourseUnitCutoff::getCourseUnitCutoff($cs_row['code'],'Theory')}}">
                 <input type="hidden" id="hid_cutoff{{$cs_row['code'].'P'}}" name="hid_cutoff[{{$cs_row['code'].'P'}}]" value="{{CourseUnitCutoff::getCourseUnitCutoff($cs_row['code'],'Practical')}}">
             @else
                <input type="hidden" id="hid_cutoff{{$cs_row['code']}}" name="hid_cutoff[{{$cs_row['code'].substr($cs_row['type'],0,1)}}]" value="{{CourseUnitCutoff::getCourseUnitCutoff($cs_row['code'],$cs_row['type'])}}">
             @endif
        @endforeach

        <div class="row-fluid">

            <center>{{Form::Submit('Save',array('class'=>'btn btn-primary'))}}</center>
        </div>
    </div>

    {{Form::close()}}
@stop