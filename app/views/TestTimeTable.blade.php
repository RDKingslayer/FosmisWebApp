@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="/css/jquery.sweet-dropdown.min.css" />
<style type="text/css">
    body
    {
        font-family: arial;
    }
    
    table {
        
        border-collapse: separate;
        box-shadow: inset 0 1px 0 #fff;
        font-size: 12px;
        line-height: 24px;
        margin: 30px auto;
        text-align: left;
    }   
    
    tr
    {
        height: 30px;
        white-space: nowrap;
    }

    th,td
    {
        margin: 0;
        text-align: center;
        border-collapse: collapse;
        outline: 1px solid #d3d3d3;
        
    }
    
    

    td
    {
        padding: 2px 4px;
        border: 1px solid #bed3ab;
    
        
    }
    
    
    
    td.subs
    {
        background:#a878ae;
        color:white;
    }
    

    th
    {
        /*background: linear-gradient(#777, #444);*/
        color: #fff;
        font-weight: bold;
        position: relative; 
        background: #565051;
        padding: 2px 4px;
    }

    td.subs:hover
    {
        cursor: pointer;
        background: #666;
        color: white;
    }
    
    
    
    #timetable .dropdown-menu
    {
        padding: 0px 0px;
    }
    
    #vertical-text span
    {
            display: block;
            
    }
    </style>
@stop

@section('js')
    <script type="text/javascript" src="/js/jquery.sweet-dropdown.min.js"></script>
@stop

@section('content')

<?php

    $GLOBALS['isFirstRow']=true;
    $GLOBALS['TotalSlots']=0;
    $GLOBALS['Tot']=1;


    function formatCourseUnit($courseCode)
    {
        switch(substr($courseCode,-1))
        {
            case "a": //for getting alpha character
                $courseCode=str_replace("a","&#945;",$courseCode);
                return $courseCode;
                break;
                
            case "b": //for getting beta character
                $courseCode=str_replace("b","&#946;",$courseCode);
                return $courseCode;
                break;
                
            case "d": //for getting delta character
                $courseCode=str_replace("d","&#948;",$courseCode);
                return $courseCode;
                break;
                
            default:
                return $courseCode;
                break;
        }
    }

    function generateMenu($user_role,$subject)
    {
        switch($user_role)
        {
            case "CAA":
?>
            <ul>
                    <li><a href="{{URL::route('daily_attendance',array($subject['course_code'],$subject['title'],$subject['name'],$subject['start_time'],$subject['duration']))}}">Add Attendance</a></li>
                    <li><a href="#">Manage Medicals</a></li>
                    <li><a href="{{URL::route('attendance_sheet',array($subject['course_code'],$subject['name'],$subject['start_time'],$subject['duration']))}}">Print Attendance Sheet</a></li>
            </ul>
<?php
            break;    
        }
    }

    function getCourseType($type)
    {   
        switch($type)
        {
            case "lecture":
                return "L";
                break;
            
            case "practical":
                return "P";
                break;
                
            case "tute":
                return "T";
                break;
        }
    }

    function blankCellGenerate($numcells)
    {
?>
        @for($i=0;$i<$numcells;$i++)
                                     <td></td>                        
        @endfor                             
<?php
    }

    function setRowHeight($height)
    {
        if($height==0)
        {
            return 1;
        }
        else
        {
            return $height;
        }
        
    }

    function getTimeDifference($subject,$subtime)
    {
        $start_time=explode(":",$subject["start_time"])[0];
        return $start_time-$subtime;
    }

    function getLevelDayCourses($courseArrangement,$wkday,$level)
    {
        foreach($courseArrangement as $crs)
        {
            if(($crs->wk_day==$wkday) && ($crs->level==$level))
            {
                return $crs->courseunit_count;
            }
        }
    }

   

    function arrangeTimeSlots($Obsubjects)
    {
        
        $subjects=$Obsubjects->toArray();
        $subjectsOfRow=[];
    
        while(sizeof($subjects)!=0)
        {
            $startTime=8;
            $timePointer=0;
            $arSubjects=[];
            $arSubjectsIndex=[];
            $arsize=sizeof($subjects);
            
            $sameDegree=true;
            
            for($j=0;$j<$arsize && $sameDegree;$j++)
            {
                
                
              
                if(explode(":",$subjects[$j]["start_time"])[0]>=$startTime)
                {
                    array_push($arSubjects,$subjects[$j]);
                    array_push($arSubjectsIndex,$j);
                    $startTime=explode(":",$subjects[$j]["start_time"])[0]+$subjects[$j]["duration"];
                }
                
               if(($j+1!=$arsize) && (substr($subjects[$j]['course_code'],0,-4)!=substr($subjects[$j+1]['course_code'],0,-4)))
                {
                    $sameDegree=false;
                }
                
                
                
            }
            
            
            foreach($arSubjectsIndex as $Index)
            {
                unset($subjects[$Index]);
            }
            
            array_splice($subjects,0,0);
            
            array_push($subjectsOfRow,$arSubjects);
            
        }
        
        return $subjectsOfRow;
    }
?>
<?php
    function createTimeTableRow($subjects)
    {
        
        
            if(($GLOBALS['isFirstRow']==true) && ($subjects[0]["start_time"]>12))
            {
                $GLOBALS['isFirstRow']=false;
                blankCellGenerate(4);
        ?>
                 <td rowspan="{{$GLOBALS['TotalSlots']}}" style="background-color:#ffff77">
                        
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

        <?php
                $course_time=13;
                       
            }
            else
            {
                $course_time=8;
            }
            
            
        
            foreach($subjects as $subject)
            {
                $st_time=explode(":",$subject["start_time"])[0];
            
               
                if($st_time!=$course_time)
                {
                    
                    if(($st_time>=12) && ($course_time<=12))
                    {
?>
                        @if(12-$course_time!=0)
                            <!--<td colspan="{{12-$course_time}}">ppp</td>-->
                            <?php blankCellGenerate(12-$course_time);?>                                  
                        @endif

                        @if($st_time-13!=0)
                            <!--<td colspan="{{$st_time-13}}">ooo</td>-->
                            <?php blankCellGenerate($st_time-13);?>
                        @endif
<?php
                    }
                    else
                    {
                        $blankDiff=$st_time-$course_time;
?>
                       
                        <?php blankCellGenerate($blankDiff);?> 
<?php
                        
                    }
                    
                    $course_time=$st_time;
 
                    

            
                }
                
                
              
                
                $course_time+=$subject["duration"];

?>
                <td class="subs" colspan="{{$subject['duration']}}">
                    
                     <div data-timetbldropdown="{{'#menu'.$GLOBALS['Tot']}}"><b>{{formatCourseUnit($subject["course_code"])."(".getCourseType($subject['name']).")"}}</b></div>
                </td>

               <div class="timetbldropdown-menu timetbldropdown-anchor-top-left timetbldropdown-has-anchor dark" id="{{'menu'.$GLOBALS['Tot']}}">
                    <?php generateMenu(Auth::user()->Role->role,$subject);?>
                </div>       
                
<?php
            
                $GLOBALS['Tot']++;
                
                if(($GLOBALS['isFirstRow']==true) && ($course_time==12))
                {
                    $course_time+=1;
                    $GLOBALS['isFirstRow']=false;
                    
?>
                <td rowspan="{{$GLOBALS['TotalSlots']}}" style="background-color:#ffff77">
                        
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
<?php
                    
                }
            }
            
            if($course_time!=18)
            {
                if($course_time<=12)
                {
?>
                    <!--<td colspan="{{12-$course_time}}">kkk</td>-->
                    <?php blankCellGenerate(12-$course_time);?>
                    <?php
                        if($GLOBALS['isFirstRow']==true)
                        {
                            $GLOBALS['isFirstRow']=false;
                    ?>
                <td rowspan="{{$GLOBALS['TotalSlots']}}" style="background-color:#ffff77">
                        
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
                    <?php
                        }

                    ?>
                    <?php blankCellGenerate(5);?>
<?php
                }
                else
                {
?>  
                        <!--<td colspan="{{18-$course_time}}">mmm</td>-->
                        <?php blankCellGenerate(18-$course_time);?>
<?php
                }
            }
        
        
        
    }

    function addTimeTableRow($subjectRows)
    {
        if(sizeof($subjectRows)==0)
        {
            blankCellGenerate(9);
            return;
        }
        
        createTimeTableRow($subjectRows[0]);
?>
    </tr>
         @if(sizeof($subjectRows)>1)
           
                    @for($i=1;$i<sizeof($subjectRows);$i++)
                             <tr>                                        
                                <?php createTimeTableRow($subjectRows[$i]);?> 
                            </tr>
                    @endfor
            
        @endif
<?php
    }
?>
<div id="timetable" class="span8">
    
    <?php 

           
            
            $MonLevelIslots=arrangeTimeSlots($MonLevelI);
            $MonLevelIIslots=arrangeTimeSlots($MonLevelII);
            $MonLevelIIIslots=arrangeTimeSlots($MonLevelIII);

            $TueLevelIslots=arrangeTimeSlots($TueLevelI);
            $TueLevelIIslots=arrangeTimeSlots($TueLevelII);
            $TueLevelIIIslots=arrangeTimeSlots($TueLevelIII);

            $WedLevelIslots=arrangeTimeSlots($WedLevelI);
            $WedLevelIIslots=arrangeTimeSlots($WedLevelII);
            $WedLevelIIIslots=arrangeTimeSlots($WedLevelIII);

            $ThuLevelIslots=arrangeTimeSlots($ThuLevelI);
            $ThuLevelIIslots=arrangeTimeSlots($ThuLevelII);
            $ThuLevelIIIslots=arrangeTimeSlots($ThuLevelIII);

            $FriLevelIslots=arrangeTimeSlots($FriLevelI);
            $FriLevelIIslots=arrangeTimeSlots($FriLevelII);
            $FriLevelIIIslots=arrangeTimeSlots($FriLevelIII);




            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($MonLevelIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($MonLevelIIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($MonLevelIIIslots));

            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($TueLevelIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($TueLevelIIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($TueLevelIIIslots));

            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($WedLevelIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($WedLevelIIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($WedLevelIIIslots));

            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($ThuLevelIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($ThuLevelIIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($ThuLevelIIIslots));

            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($FriLevelIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($FriLevelIIslots));
            $GLOBALS['TotalSlots']+=setRowHeight(sizeof($FriLevelIIIslots));
          
        ?>
   <center><h1>Semester Time Table</h1></center>
    <table style="font-size:12px;">
        <thead>
            <tr>
                <td>&nbsp;</td>
                <th>Time</th>
                @for($i=8;$i<=17;$i++)
                        <th>{{$i.":00"}}-{{($i+1).":00"}}</th>                  
                @endfor
            </tr>
        </thead>
        <tr>
            <th rowspan="{{setRowHeight(sizeof($MonLevelIslots))+setRowHeight(sizeof($MonLevelIIslots))+setRowHeight(sizeof($MonLevelIIIslots))}}">
                Monday
            </th>
            <th rowspan="{{setRowHeight(sizeof($MonLevelIslots))}}">
            Level I
            </th>
                <?php addTimeTableRow($MonLevelIslots);?>
        <tr>  
            <th rowspan="{{setRowHeight(sizeof($MonLevelIIslots))}}">
            Level II
            </th>
                <?php addTimeTableRow($MonLevelIIslots);?>
       
         <tr>
            <th rowspan="{{setRowHeight(sizeof($MonLevelIIIslots))}}">
            Level III
            </th>
                <?php addTimeTableRow($MonLevelIIIslots);?>
             
        
        <tr>
            <th rowspan="{{setRowHeight(sizeof($TueLevelIslots))+setRowHeight(sizeof($TueLevelIIslots))+setRowHeight(sizeof($TueLevelIIIslots))}}">
                Tuesday
            </th>
            <th rowspan="{{setRowHeight(sizeof($TueLevelIslots))}}">
            Level I
            </th>
                <?php addTimeTableRow($TueLevelIslots);?>
        <tr>  
            <th rowspan="{{setRowHeight(sizeof($TueLevelIIslots))}}">
            Level II
            </th>
                <?php addTimeTableRow($TueLevelIIslots);?>
       
         <tr>
            <th rowspan="{{setRowHeight(sizeof($TueLevelIIIslots))}}">
            Level III
            </th>
                <?php addTimeTableRow($TueLevelIIIslots);?> 
             
         <tr>
            <th rowspan="{{setRowHeight(sizeof($WedLevelIslots))+setRowHeight(sizeof($WedLevelIIslots))+setRowHeight(sizeof($WedLevelIIIslots))}}">
                Wednesday
            </th>
            <th rowspan="{{setRowHeight(sizeof($WedLevelIslots))}}">
            Level I
            </th>
                <?php addTimeTableRow($WedLevelIslots);?>
        <tr>  
            <th rowspan="{{setRowHeight(sizeof($WedLevelIIslots))}}">
            Level II
            </th>
                <?php addTimeTableRow($WedLevelIIslots);?>
       
         <tr>
            <th rowspan="{{setRowHeight(sizeof($WedLevelIIIslots))}}">
            Level III
            </th>
                <?php addTimeTableRow($WedLevelIIIslots);?>
             
        <tr>
            <th rowspan="{{setRowHeight(sizeof($ThuLevelIslots))+setRowHeight(sizeof($ThuLevelIIslots))+setRowHeight(sizeof($ThuLevelIIIslots))}}">
                Thursday
            </th>
            <th rowspan="{{setRowHeight(sizeof($ThuLevelIslots))}}">
            Level I
            </th>
                <?php addTimeTableRow($ThuLevelIslots);?>
        <tr>  
            <th rowspan="{{setRowHeight(sizeof($ThuLevelIIslots))}}">
            Level II
            </th>
                <?php addTimeTableRow($ThuLevelIIslots);?>
       
         <tr>
            <th rowspan="{{setRowHeight(sizeof($ThuLevelIIIslots))}}">
            Level III
            </th>
                <?php addTimeTableRow($ThuLevelIIIslots);?>
        
        <tr>
            <th rowspan="{{setRowHeight(sizeof($FriLevelIslots))+setRowHeight(sizeof($FriLevelIIslots))+setRowHeight(sizeof($FriLevelIIIslots))}}">
                Friday
            </th>
            <th rowspan="{{setRowHeight(sizeof($FriLevelIslots))}}">
            Level I
            </th>
                <?php addTimeTableRow($FriLevelIslots);?>
        <tr>  
            <th rowspan="{{setRowHeight(sizeof($FriLevelIIslots))}}">
            Level II
            </th>
                <?php addTimeTableRow($FriLevelIIslots);?>
       
         <tr>
            <th rowspan="{{setRowHeight(sizeof($FriLevelIIIslots))}}">
            Level III
            </th>
                <?php addTimeTableRow($FriLevelIIIslots);?>        
        
         <tr>
            <td>&nbsp;</td>
            <th>Time</th>
            @for($i=8;$i<=17;$i++)
                    <th>{{$i.":00"}}-{{($i+1).":00"}}</th>                  
            @endfor
        </tr>     
    </table>
</div>

@stop