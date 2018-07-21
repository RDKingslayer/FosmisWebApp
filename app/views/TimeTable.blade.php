@extends('layouts.dashboard')

@section('css')
	<style type="text/css">
   
	    th,td
	    {
            margin: 0;
            text-align: center;
            border-collapse: collapse;
            outline: 1px solid #e3e3e3;
	    }

	    td
	    {
		    padding: 5px 10px;
	    }
        
        td.cssubs
        {
            background: #98AFC7;
        }
        
        td.matsubs
        {
            background: #ECE5B6;
        }
        
        td.fscsubs
        {
            background: #E8ADAA;
        }
        
        td.physubs
        {
            background: #99C68E;
        }

	    th
	    {
            background: #666;
            color: white;
            padding: 5px 10px;
            
	    }

	   /* td.cssubs:hover,td.matsubs:hover,td.fscsubs:hover,td.physubs:hover
	    {
            cursor: pointer;
            background: #666;
            color: white;
	    }*/
        
        .tdhoverclass
        {
            cursor: pointer;
            background: #666 !important; 
            color: white !important; 
        }
        
        .dropdown a
	    {
            
            color: black;
	    }
        
        
        #vertical-text span
        {
            display: block;
            
        }
	</style>

   
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            
            $("#timetable .dropdown-toggle").hover(function(){
                
                $(this).parent('td').addClass("tdhoverclass");
                $(this).css('color','white');
            },
            function(){
                $(this).parent('td').removeClass("tdhoverclass");
                $(this).css('color','black');
            });
});
    </script>
@stop

@section('content')
<?php
    function generateMenu($courseCode,$user_role)
    {
        switch(substr($courseCode,-1))
        {
            case "a": //for getting alpha character
                $courseCode=str_replace("a","&#945;",$courseCode);
                break;
                
            case "b": //for getting beta character
                $courseCode=str_replace("b","&#946;",$courseCode);
                break;
                
            case "d": //for getting delta character
                $courseCode=str_replace("d","&#948;",$courseCode);
                break;
                
            default:
                break;
        }
?>
        <a id={{$courseCode}} class="dropdown-toggle" href="#" data-toggle="dropdown">{{$courseCode}}</a>
                <ul class="dropdown-menu" role="menu" aria-labeledby={{$courseCode}}>
                    <li role="presentation">
                        <a href="#" role="menuitem" tabindex="-1">Add Attendance</a>
                    </li>
                     <li role="presentation">
                        <a href="#" role="menuitem" tabindex="-1">Manage Medicals</a>
                    </li>
                </ul>
<?php    
    }
?>

    <div class="well span8">
<center><h1>Semester Time Table</h1></center>
<table id="timetable">
    <tr>
        <td>&nbsp;</td>
        <th>Time</th>
        @for($i=8;$i<18;$i++)
                              <th><?php  echo $i.":00 - ".($i+1).":00 ";?></th>                  
        @endfor    
    </tr>
    <tr>
        <th rowspan="6">Monday</th>
        <th>Level I</th>
        <td class="matsubs dropdown">
            <?php generateMenu("AMT112b",Auth::user()->role);?>  
        </td>
        <td>&nbsp;</td>
        <td colspan="2" class="cssubs dropdown">
            <?php generateMenu("CSC1122",Auth::user()->role);?>  
        </td>
        <td rowspan="25" style="background:yellow">
            <h3 id="vertical-text">
                <span>L</span>
                <span>U</span>
                <span>N</span>
                <span>C</span>
                <span>H</span>
                <span>&nbsp;</span>
                <span>B</span>
                <span>R</span>
                <span>E</span>
                <span>A</span>
                <span>K</span>
            </h3>
        </td>
        <td colspan="3" class="cssubs">CSC1113</td>
        <td colspan="2">&nbsp;</td>
        
    </tr>
    <tr>
        <th rowspan="4">Level II</th>
        <td colspan="2" class="cssubs">COM212&#946;</td>
        <td colspan="2">&nbsp;</td>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td rowspan="3" class="cssubs">CCIT (T)</td>
    </tr>
    <tr>
        <td colspan="2" class="cssubs">CCIT (P)</td>
        <td>&nbsp;</td>
        <td colspan="3" class="cssubs">COM213&#945;/COM212&#946;</td>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" class="cssubs">CSC2143</td>
        <td colspan="2" class="cssubs">CSC2133</td>
        <td colspan="2" class="cssubs">CSC2123</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <th>Level III</th>
        <td colspan="2">&nbsp;</td>
        <td colspan="2" class="cssubs">COM311&#946;</td>
        <td colspan="3" class="cssubs">CSC3113</td>
        <td colspan="2" class="fscsubs">FSC3132</td>
    </tr>
    <tr>
        <th rowspan="5">Tuesday</th>
        <th>Level I</th>
        <td>&nbsp;</td>
        <td class="matsubs">MAT112&#948;</td>
        <td class="matsubs">MAT113&#948;</td>
         <td>&nbsp;</td>
        <td colspan="4" class="cssubs">CSC1153(P)</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <th rowspan="2">Level II</th>
        <td rowspan="2" colspan="2" class="cssubs">CSC2143</td>
        <td rowspan="2" colspan="2" class="matsubs">AMT212&#946;</td>
        <td rowspan="2">&nbsp;</td>
        <td colspan="2" class="cssubs">CSC2113</td>
        <td colspan="2" rowspan="2" class="fscsubs">FSC215&#945;</td>
    </tr>
    <tr>
        <td colspan="2" class="cssubs">COM213&#945;/COM212&#946;</td>
    </tr>
     
    <tr>
        <th rowspan="2">Level III</th>
        <td colspan="4" class="cssubs">CSC3142 (P)</td>
        <td colspan="2" class="cssubs">CSC3172</td>
        <td>&nbsp;</td>
        <td colspan="2" rowspan="2" class="fscsubs">FSC3122</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="3" class="cssubs">COM311&#946;(P)</td>
        <td colspan="3" class="cssubs">COM311&#946;(P)</td>
    </tr>
    <tr>
        <th rowspan="5">Wednesday</th>
        <th rowspan="2">Level I</th>
        <td rowspan="2" class="matsubs">MAT112&#948;\MAT113&#948;</td>
        <td rowspan="2" class="matsubs">AMT112&#946;</td>
        <td colspan="2" class="cssubs">COM112&#946;</td>
        <td rowspan="5" colspan="6">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" class="cssubs">CSC1113</td>
    </tr>
    <tr>
        <th rowspan="2">Level II</th>
        <td rowspan="2">&nbsp;</td>
        <td colspan="3" class="cssubs">COM213&#945;/COM212&#946;</td>
    </tr>
    <tr>
        <td colspan="3" class="cssubs">CSC2123</td>
    </tr>
    <tr>
        <th>Level III</th>
        <td colspan="3">&nbsp;</td>
        <td class="cssubs">CSC3122</td>
    </tr>
    <tr>
        <th rowspan="4">Thursday</th>
        <th rowspan="2">Level I</th>
        <td rowspan="2">&nbsp;</td>
        <td colspan="3" class="cssubs">CSC113&#945;(P)</td>
        <td colspan="2" class="cssubs">CSC1142</td>
        <td>&nbsp;</td>
        <td colspan="2" rowspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3" class="cssubs">COM112&#946;/COM113&#946;</td>
        <td colspan="3" class="cssubs">COM112&#946;/COM113&#946;</td>
    </tr>
    <tr>
        <th>Level II</th>
        <td>&nbsp;</td>
        <td colspan="2" class="matsubs">MAT211&#946;</td>
        <td class="matsubs">AMT212&#946;</td>
        <td colspan="3" class="cssubs">CSC2113 (P)</td>
        <td colspan="2" class="fscsubs">FSC215&#945;</td>
    </tr>
    <tr>
        <th>Level III</th>
        <td colspan="2" class="matsubs">MAT313&#946;</td>
        <td colspan="2" class="cssubs">CSC3132</td>
        <td colspan="2" class="cssubs">COM331&#946;</td>
        <td>&nbsp;</td>
        <td colspan="2" class="fscsubs">FSC3112</td>
    </tr>
    <tr>
        <th rowspan="4">Friday</th>
        <th rowspan="2">Level I</th>
        <td class="cssubs">CLC</td>
        <td colspan="2" class="cssubs">CLC (P)</td>
        <td>&nbsp;</td>
        <td colspan="2" class="cssubs">CLC(P)</td>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" class="cssubs">CSC1153</td>
        <td colspan="2" class="cssubs">COM113&#945;,CSC113&#945;,COM1111</td>
        <td colspan="2">&nbsp;</td>
        <td class="matsubs">AMT112&#946;</td>
        <td colspan="2">&nbsp;</td> 
    </tr>
    <tr>
        <th>Level II</th>
        <td colspan="3" class="physubs">PHY2212</td>
        <td>&nbsp;</td>
        <td class="matsubs">MAT221&#946;</td>
        <td colspan="3" class="cssubs">CSC2133(P)</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <th>Level III</th>
        <td colspan="4" class="cssubs">CSC3113</td>
        <td colspan="5">&nbsp;</td>
    </tr>
</table>
</div>

@stop
