<?php
class AttendanceController extends BaseController {


	private function getCourseNames($deptID,$level,$semid,$subPrefix)
	{
		return CourseUnit::select('course_title.code','course_title.title')
			->where('course_unit.department_id','=',$deptID)
			->join('course_title','course_title.code','=','course_unit.code')
			->where('course_unit.level','=',$level)
			->where('course_unit.code','like',$subPrefix.'%')
			->where(function($query) use ($semid){return $query->where('course_unit.semester','=',$semid)
			->orwhere('course_unit.semester','=','0');})
			->get();		
	}

    private function getDepartmentCoursesForSemeseter($departmentID,$semester)
    {
        switch($departmentID)
        {
            case 1:
				//BSC Course Units
				$subjects1["COM"]=$this->getCourseNames($departmentID,1,$semester,"COM");
				$subjects2["COM"]=$this->getCourseNames($departmentID,2,$semester,"COM");
				$subjects3["COM"]=$this->getCourseNames($departmentID,3,$semester,"COM");
				$subjects4["COM"]=$this->getCourseNames($departmentID,4,$semester,"COM");

				$clcsubject=$this->getCourseNames($departmentID,1,$semester,"CLC");
				$ccitsubject=$this->getCourseNames($departmentID,2,$semester,"CCIT");

				foreach($clcsubject as $sub)
				{
					$subjects1["COM"]->add($sub);
				}

				foreach($ccitsubject as $sub)
				{
					$subjects2["COM"]->add($sub);
				}
                

				//BCS Course Units
				$subjects1["CSC"]=$this->getCourseNames($departmentID,1,$semester,"CSC");
				$subjects2["CSC"]=$this->getCourseNames($departmentID,2,$semester,"CSC");
				$subjects3["CSC"]=$this->getCourseNames($departmentID,3,$semester,"CSC");
				$subjects4["CSC"]=$this->getCourseNames($departmentID,4,$semester,"CSC");
                
                
			break;


			case 2:

				//Pure Mathematics
				$subjects1["MAT"]=$this->getCourseNames($departmentID,1,$semester,"MAT");
				$subjects2["MAT"]=$this->getCourseNames($departmentID,2,$semester,"MAT");
				$subjects3["MAT"]=$this->getCourseNames($departmentID,3,$semester,"MAT");
				$subjects4["MAT"]=$this->getCourseNames($departmentID,4,$semester,"MSP");
                
                //Applied Mathematics
                $subjects1["AMT"]=$this->getCourseNames($departmentID,1,$semester,"AMT");
				$subjects2["AMT"]=$this->getCourseNames($departmentID,2,$semester,"AMT");
				$subjects3["AMT"]=$this->getCourseNames($departmentID,3,$semester,"AMT");
				$subjects4["AMT"]=$this->getCourseNames($departmentID,4,$semester,"AMT");
                
                //Industrical Mathematics
                $subjects1["IM"]=$this->getCourseNames($departmentID,1,$semester,"IM");
				$subjects2["IM"]=$this->getCourseNames($departmentID,2,$semester,"IM");
				$subjects3["IM"]=$this->getCourseNames($departmentID,3,$semester,"IM");
				$subjects4["IM"]=$this->getCourseNames($departmentID,4,$semester,"IM");
                
			break;

			case 3:
                
				//Chemistry Course Units
				$subjects1["CHE"]=$this->getCourseNames($departmentID,1,$semester,"CHE");
				$subjects2["CHE"]=$this->getCourseNames($departmentID,2,$semester,"CHE");
				$subjects3["CHE"]=$this->getCourseNames($departmentID,3,$semester,"CHE");
				$subjects4["CHE"]=$this->getCourseNames($departmentID,4,$semester,"CHE");

			break;

			case 4:

				//Zoology Course Units
				$subjects1["ZOO"]=$this->getCourseNames($departmentID,1,$semester,"ZOO");
				$subjects2["ZOO"]=$this->getCourseNames($departmentID,2,$semester,"ZOO");
				$subjects3["ZOO"]=$this->getCourseNames($departmentID,3,$semester,"ZOO");
				$subjects4["ZOO"]=$this->getCourseNames($departmentID,4,$semester,"ZOO");

			break;

			case 5:

				//Botany Course Units
				$subjects1["BOT"]=$this->getCourseNames($departmentID,1,$semester,"BOT");
				$subjects2["BOT"]=$this->getCourseNames($departmentID,2,$semester,"BOT");
				$subjects3["BOT"]=$this->getCourseNames($departmentID,3,$semester,"BOT");
				$subjects4["BOT"]=$this->getCourseNames($departmentID,4,$semester,"BOT");

			break;

			case 6:

				//Physics Course Units
				$subjects1["PHY"]=$this->getCourseNames($departmentID,1,$semester,"PHY");
				$subjects2["PHY"]=$this->getCourseNames($departmentID,2,$semester,"PHY");
				$subjects3["PHY"]=$this->getCourseNames($departmentID,3,$semester,"PHY");
				$subjects4["PHY"]=$this->getCourseNames($departmentID,4,$semester,"PHY");

			break;



			
			default:
			break;
        }
        
        return array("level1"=>$subjects1,"level2"=>$subjects2,"level3"=>$subjects3,"level4"=>$subjects4);
    }

	public function daily_attendance($subCode=null,$subTitle=null,$courseType=null,$startTime=null,$duration=null)
	{
		

		$current_year= AcademicYear:: where('current1','=',1)->first();
		$semester=Semester::where('status','=',1)->first();
		$year = explode("_",$current_year->academic_year_id);
		$AcademicYear=$year[0]. '/' .$year[1];
		$user = Auth::user()->user;
		$departmentID = User::where('user','=',$user)->first()->depart_id;


		$subjects=$this->getDepartmentCoursesForSemeseter($departmentID,$semester->semester_id);
        
		$Course_types = CourseTypes::select( 'course_types.name','course_types.priority' )->orderby('priority')
				->join("courseunit_category","courseunit_category.course_type","=","course_types.priority")
				->join("course_unit","course_unit.code","=","courseunit_category.course_code")
				->where("course_unit.code","=",$subCode)
				->get();
		
		$groups = Group::select('group_id')
				->where('course_code','=',$subCode)
				->where('academic_year','=',$current_year->academic_year_id)
				->orderby('group_id')
				->distinct()->get();
		


		return View:: make('attendance.daily_attendance')->with('current_year',$AcademicYear)->with('subjects1',$subjects['level1'])->with('subjects2',$subjects['level2'])->with('subjects3',$subjects['level3'])->with('subjects4',$subjects['level4'])->with('departmentID',$departmentID)->with("select_subCode",$subCode)->with("select_subTitle",$subTitle)->with('courseTypes',$Course_types)->with('stGroups',$groups)->with('courseType',$courseType)->with('startTime',$startTime)->with('duration',$duration);
		//return View::make('attendance.daily_attendance');
	}


public function daily_attendance_id_create($subCodes){

		//return $subCodes;

		$current_year= AcademicYear:: where('current1','=',1)->first();
	

		

		$type = Input::get('coursetype');
		$duration=Input::get('duration');
		$starttime=Input::get('starttime');
		$date=Input::get('date');
		$attendance_group=Input::get('typegroup');


		if($attendance_group=="")
		{
			$attendance_group=null;
		}

		StudySession::create(array(
        		'course_code'=> $subCodes,
			'date'  => $date,
        		'duration' => $duration,
        		'time'  => $starttime,
        		'type'  => $type,
        		'academic_year' => $current_year->academic_year_id,
        		'attendance_group' =>$attendance_group));

		$sessionId=StudySession::orderBy('session_id','desc')->first()->session_id;		

		
		if($attendance_group==null)
		{
			$attendance_group="none";
		}
		
		return Redirect::action('AttendanceController@getstudent_list',array("subjectCode"=>$subCodes,"group"=>$attendance_group,"sessionID"=>$sessionId));

		
}

	public function attendance_sheet($subCode=null,$select_coursetype=null,$startTime=null,$duration=null)
	{
        $semester=Semester::where('status','=',1)->first();
        $departmentID = Auth::user()->depart_id;
        
        $courseTypes=null;
        
        
        
        $subjects=$this->getDepartmentCoursesForSemeseter($departmentID,$semester->semester_id);
        
        
		
		return View::make('attendance.attendance_sheet')->with('subjects1',$subjects['level1'])->with('subjects2',$subjects['level2'])->with('subjects3',$subjects['level3'])->with('subjects4',$subjects['level4'])->with('subCode',$subCode)->with('select_coursetype',$select_coursetype)->with('startTime',$startTime)->with('duration',$duration);
	}
    
    private function formatCourseUnit($courseCode)
    {

        switch(substr($courseCode,-1))
        {
            case "a": //for getting alpha character
                $courseCode=str_replace("a","&#945;",$courseCode);
                //$courseCode=str_replace("a",html_entity_decode("\u03b1",0,'UTF-8'),$courseCode);
                return $courseCode;
                break;
                
            case "b": //for getting beta character
                $courseCode=str_replace("b","&#946;",$courseCode);
                //$courseCode=str_replace("b",html_entity_decode("\u03b2"),$courseCode);
                return $courseCode;
                break;
                
            case "d": //for getting delta character
                $courseCode=str_replace("d","&#948;",$courseCode);
                //$courseCode=str_replace("d",html_entity_decode("\u03b4",0,'UTF-8'),$courseCode);
                return $courseCode;
                break;
                
            default:
                return $courseCode;
                break;
        }
    }
    
   
    
    public function printAttendanceSheet()
    {
        function setHeadingEntities($HeadingInput,$IsGroupId=false)
        {
            if($IsGroupId!=false)
            {
                if(($HeadingInput=="") || ($HeadingInput=="leave_blank"))
                {
                    return "";
                }
                else
                {
                    return "-(Group ".$HeadingInput.")";
                }
            }
            else
            {
                if(($HeadingInput=="") || ($HeadingInput=="leave_blank"))
                {
                    return "..............";
                }
                else
                {
                    return $HeadingInput;
                }
            }
            
            
        }
        
        
         function setStudentListHeader()
        {
            return "<tr>
                            <th>NO</th>
                            <th>NAME WITH<br/>INITIALS</th>
                            <th>STUDENT<br/>NUMBER</th>
                            <th>SIGNATURE</th>
                    </tr>";
        }
        
        $current_year= AcademicYear:: where('current1','=',1)->first()->academic_year_id;
		$semester=Semester::where('status','=',1)->first()->semester_id;
        $courseUnit=CourseUnit::where('code','=',Input::get('subcode'))->first();
        $department=Auth::user()->Department->dept_name;
        $timesetting=Input::get('starttime');
        
        date_default_timezone_set("Asia/Colombo");
        
        $cur_datetime=new DateTime('now');
        
        if($timesetting=="")
        {
            $timesetting=setHeadingEntities("");
        }
        else
        {
            $timesetting=$timesetting." -".date_format(date_add(date_create($timesetting),date_interval_create_from_date_string(Input::get('duration')."hours")),'g:ia');
        }
        
        $styles="<style type='text/css'>
        
                        #printed_date
                        {
                            float:right;
                            font-size:9.5px;
                            text-align:right;
                            margin-bottom:0px;
                        }
                        
                        h5
                        {
                            font-size:12px;
                        }
        
                        #headerTable
                        {
                             margin-top:0px;
                        }
                        
                        #headerTable td
                        {
                            font-size:11px;
                            text-align:left;
                           
                        }
                        
                      
                        .container
                        {
                            margin-top:5px;
                            width:100%;
                            align:center;
                           
                        }
                        
                        
                        .container td
                        {
                             vertical-align:top;
                        }
                        
                        .student_details
                        {
                            font-size:9.5px;
                            border:1px solid black;
                            margin-top:0px;
                            border-collapse:collapse;
                            width:300px;
                            table-layout: auto;
                        }
                        
                        .student_details td
                        {
                            padding:2px 2px;
                            white-space:nowrap;
                        }
                        
                        
                       
                        
                        .student_details th
                        {
                            text-align:left;
                            padding:2px 2px;
                            white-space:nowrap;
                           
                            
                        }
                        
                        .footer
                        {
                            font-size:9.5px;
                            text-align:center;
                            position:fixed;
                            bottom:0px;
                            left:0px;
                            right:0px;
                        }
                        
                       
                       
                </style>";
    
        
        $printText="<html><head>".$styles."<meta content='text/html; charset=UTF-8' http-equiv='content-type'></head><body><div id='printed_date'>Printed Date: ".$cur_datetime->format('Y - m - d')."</div>";
        
        
        
        $heading="<center><h5>Attendance Register-Level ".$courseUnit->level."  and Semester ".$semester." of ".$current_year." Academic Year <br/> Department of ".$department."<br/><span style=' font-family:DejaVu Sans;font-size:12px;'>".$this->formatCourseUnit($courseUnit->code)."</span> - ".$courseUnit->Title->title." ".setHeadingEntities(Input::get('typegroup'),true)."</h5></center>";
        
        $headerTable="<table id='headerTable' align='center' width='70%'>
                        <tr>
                            <td>Date</td>
                            <td>:</td>
                            <td>".setHeadingEntities(Input::get('date'))."</td>
                            
                            <td>Type</td>
                            <td>:</td>
                            <td>".ucwords(setHeadingEntities(Input::get('coursetype')))."</td>
                        </tr>
                        <tr>
                            <td>Lecturer</td>
                            <td>:</td>
                            <td>".setHeadingEntities("")."</td>
                       
                            <td>Time</td>
                            <td>:</td>
                            <td>".$timesetting."</td>
                        </tr>
                    </table>";
        
        
        if((Input::get('coursetype')=='leave_blank') || (Input::get('typegroup')=='leave_blank') || (input::get('typegroup')==''))
        {
            $students=$courseUnit->Students($current_year);    
        }
        else
        {
            $students=$courseUnit->Students($current_year,Input::get('coursetype'),input::get('typegroup'));
        }
        
        
        $printText.=$heading;
        $printText.=$headerTable;
        
        $num_pages=(int)(sizeof($students)/60);
        
        $student_details="";
        
        for($page=1;$page<=($num_pages+1);$page++)
        {
                $student_details.="<table class='container'><tr>";
                $page_limit=$page*60;
            
                if($page<=$num_pages)
                {
                     $student_details.="<td><table class='student_details'  border='1' width='100%'>".setStudentListHeader();
                    
                    for($j=($page-1)*60;$j<((($page-1)*60)+30);$j++)
                    {
                        $student_details.="<tr>
                                    <td>".($j+1)."</td>".
                                    "<td>".strtoupper($students[$j]->last_name)." ".strtoupper($students[$j]->initials)."</td>".
                                    "<td>"."SC/".$students[$j]->al_batch."/".$students[$j]->student_id."</td>".
                                    "<td>&nbsp;</td>".
                                    "</tr>";
                        
                    }
                        
                    $student_details.="</table></td>";
                    
                    $student_details.="<td><table class='student_details'  border='1' width='100%'>".setStudentListHeader();
                    
                    for($j=((($page-1)*60)+30);$j<$page_limit;$j++)
                    {
                         $student_details.="<tr>
                                    <td>".($j+1)."</td>".
                                    "<td>".strtoupper($students[$j]->last_name)." ".strtoupper($students[$j]->initials)."</td>".
                                    "<td>"."SC/".$students[$j]->al_batch."/".$students[$j]->student_id."</td>".
                                    "<td>&nbsp;</td>".
                                    "</tr>";
                        
                    }
                    
                    $student_details.="</table></td>";
                      
                    
                }
                else
                {
                    
                    
                    if((sizeof($students)-($num_pages*60))>30)
                    {
                        $student_details.="<td><table class='student_details'  border='1' width='100%'>".setStudentListHeader();
                        
                        
                        
                        for($j=($page-1)*60;$j<((($page-1)*60)+30);$j++)
                        {
                              $student_details.="<tr>
                                    <td>".($j+1)."</td>".
                                    "<td>".strtoupper($students[$j]->last_name)."<br/>".strtoupper($students[$j]->initials)."</td>".
                                    "<td>"."SC/".$students[$j]->al_batch."/".$students[$j]->student_id."</td>".
                                    "<td>&nbsp;</td>".
                                    "</tr>";
                        }
                        
                         $student_details.="</table></td>";
                        
                         $student_details.="<td><table class='student_details'  border='1' width='100%'>".setStudentListHeader();
                        
                        
                        
                        for($j=((($page-1)*60)+30);$j<sizeof($students);$j++)
                        {
                               $student_details.="<tr>
                                    <td>".($j+1)."</td>".
                                    "<td>".strtoupper($students[$j]->last_name)."<br/>".strtoupper($students[$j]->initials)."</td>".
                                    "<td>"."SC/".$students[$j]->al_batch."/".$students[$j]->student_id."</td>".
                                    "<td>&nbsp;</td>".
                                    "</tr>";
                        }
                        
                        $student_details.="</table></td>";
                    }
                    else
                    {
                         $student_details.="<td><table class='student_details'  border='1' width='100%'>".setStudentListHeader();
                        
                        
                        
                        for($j=(($page-1)*60);$j<sizeof($students);$j++)
                        {
                             $student_details.="<tr>
                                    <td>".($j+1)."</td>".
                                    "<td>".strtoupper($students[$j]->last_name)."<br/>".strtoupper($students[$j]->initials)."</td>".
                                    "<td>"."SC/".$students[$j]->al_batch."/".$students[$j]->student_id."</td>".
                                    "<td>&nbsp;</td>".
                                    "</tr>";
                        }
                        
                        $student_details.="</table></td>";
                    }
                    
                    
                    
                    
                }
            
                $student_details.="</tr></table>"; 
                $student_details.="<div class='footer'>Page ".$page." of ".($num_pages+1)."&nbsp;&nbsp;<span style='margin-left:30px;'>".$cur_datetime->format('Y - m - d   g:i a')."</span></div>";
                $student_details.="<span style='page-break-after:always;'></span>";
        }
        
        
       
        
        
        $printText.=$student_details;
        $printText.="</tr></table>";
        $printText.="</body></html>";
        
       
        return PDF::load($printText, 'A4', 'portrait')->show();
        //return $printText;
        
       
    }
    
    

	public function showMyDrafts()
	{
		$mydrafts=StudySession::join('course_unit','course_unit.code','=','study_session.course_code')->where('study_session.marking_completed',0)->where('course_unit.department_id',Auth::user()->depart_id)->get();
		return View::make('attendance.drafts')->with("mydrafts",$mydrafts);
	}
	
	
	public function edit_attendance()
	{
		
		return View::make('attendance.edit_attendance');
	}

	public function attendance_year()
		{
			$current_year= AcademicYear:: where('current1','=',1)->first();
			return View::make('attendance.daily_attendance')->with('current_year',$current_year);
		}
	

	public function mark_attendance($subCode,$subTitle)
	{
		
		$Course_types = CourseTypes::select( 'course_types.name','course_types.priority' )->orderby('priority')
				->join("courseunit_category","courseunit_category.course_type","=","course_types.priority")
				->join("course_unit","course_unit.code","=","courseunit_category.course_code")
				->where("course_unit.code","=",$subCode)
				->get();
		
		$current_year = AcademicYear:: where('current1','=',1)->first();
		$groups = Group::select('group_id')
				->where('course_code','=',$subCode)
				->where('academic_year','=',$current_year->academic_year_id)
				->orderby('group_id')
				->distinct()->get();
	
				
			
		return View::make('attendance.mark_attendance')->with('subCodes',$subCode)->with('subTitles',$subTitle)->with('courseTypes',$Course_types)->with('stGroups',$groups);
		
	}


	public function getStudentGroups()
	{
		$studentgroups=CourseTypes::select('student_assignment.group_id')
				->join("courseunit_category","courseunit_category.course_type","=","course_types.priority")
				->join("course_unit","course_unit.code",'=','courseunit_category.course_code')
				->join("student_assignment","student_assignment.cat_com_id","=","courseunit_category.cat_com_id")
				->where("course_unit.code",'=',Input::get('subcode'))
				->where("course_types.name",'=',Input::get('coursetype'))
				->distinct()->get();


		return Response::json(["output"=>$studentgroups]);
	}

    
    public function getCoursesBySemesterLevelandAccYearAjax()
    {
        $courses=CourseUnit::select('course_unit.code','course_title.title')
                ->join('course_availability','course_availability.code','=','course_unit.code')
                ->join('course_title','course_title.code','=','course_unit.code')
                ->where('course_unit.semester',Input::get('semester'))
                ->where('course_unit.level',Input::get('level'))
                ->where('course_unit.department_id',Auth::user()->depart_id)
                ->where('course_availability.academic_year',Input::get('academic_year'))
                ->get();
        return Response::json(["output"=>$courses]); 
        
        
    }
    
    public function getStartingAndEndingDates()
    {
        $startingAndClosingDates=AcademicYear::select('starting_date','ending_date')->where('academic_year_id',Input::get('academic_year'))->get();
        
        return Response::json(['output'=>$startingAndClosingDates]);
    }
    
    public function getTotalSemesterAttendanceAjax($startDate,$endDate,$csunit,$stuno,$cstype)
    {
        
        $DBQueryTemp=$this->getTotalSemesterAttendance($startDate,$endDate,$csunit,$stuno);
        
        $attendanceResult=[];
        
         if((sizeof($DBQueryTemp)!=0) && ($DBQueryTemp!=""))
            {
                foreach($DBQueryTemp as $tt)
                {
                        if($tt->type==$cstype)
                        {
                            $attendanceRecord['date']=$tt->date;
                            $attendanceRecord['time']=$tt->time;
                            $attendanceRecord['type']=$tt->type;

                            $temp=Participation::where('participation.session_id',$tt->session_id)->
                              where('participation.student_id',$stuno)->get();


                            if(sizeof($temp)!=0)
                            {
                                if($temp[0]->status==1)
                                {
                                    $attendanceRecord['status']="Present";
                                }
                                else
                                {
                                    $attendanceRecord['status']="Medical";
                                }

                            }
                            else
                            {
                                $attendanceRecord['status']="Absent";
                            }




                        array_push($attendanceResult,$attendanceRecord);
                        }
                        else
                        {
                            continue;
                        }
                        
                        
                    
                       
                }
        
        return Response::json(['output'=>$attendanceResult]);
    }
}
    
    public function getCourseUnitDetailsAjax($course_code)
    {
        
        return Response::json(['output'=>CourseUnit::where('code',$course_code)->first()->courseTypes]);
    }
    
    public function getCourseUnitsDateLevelAjax($date,$level)
    {
        $current_year= AcademicYear:: where('current1','=',1)->first();
        $department_id = Auth::user()->depart_id;
        
        
        
            $subjects=StudySession::select('course_unit.code')
                ->join('course_unit','course_unit.code','=','study_session.course_code')->join('course_title','course_title.code','=','study_session.course_code')->where('course_unit.department_id','=',$department_id)->where('study_session.date','=',$date)->where('course_unit.level','=',$level)->distinct()->get();
       
    
        return Response::json(['output'=>$subjects]);
    }
    
    public function getStudySessionDetailsAjax($date,$level,$code)
    {
         $department_id = Auth::user()->depart_id;
        
         $subjects=StudySession::select('study_session.session_id','study_session.type','study_session.date','study_session.time','study_session.duration','study_session.attendance_group')->join('course_unit','course_unit.code','=','study_session.course_code')->join('course_title','course_title.code','=','study_session.course_code')->where('course_unit.department_id','=',$department_id)->where('study_session.date','=',$date)->where('course_unit.level','=',$level)->where('study_session.course_code','=',$code)->get();
        
        return Response::json(['output'=>$subjects]);
    }
    
    

	

	public function remove_lecture_id()
	{
		$Lec_id = StudySession::select( 'session_id' )->orderBy('session_id','desc')->first();
		
		$lecture = StudySession::where('session_id','=',$Lec_id->session_id);
		$lecture->delete();
		
		
		$current_year= AcademicYear:: where('current1','=',1)->first();
		

		return View::make('attendance.test');
		
	}






public function attendance_added($currentSub,$sessionId)
	{
		

		$newly_added=0;

		$Part_Students=Participation::select('student_id')->where("session_id",$sessionId)->get();

		$add_count=0;	//Keep track about added records
		$del_count=0;	//Keep track about deleted records

		$students=Input::get('stu');


		if(sizeof($Part_Students)!=0)
		{
			

			if($students!=null)
			{
				foreach($Part_Students as $stu)
				{
					if(in_array($stu->student_id,$students)!=1)
					{
					
						Participation::where('student_id',$stu->student_id)->where("session_id",$sessionId)->delete();
						$del_count++;
					}
				}

			
				foreach($students as $student)
				{
					if(!AttendanceController::isExistParticipation($student,$sessionId))
					{
						$participant=new Participation;
						$participant->session_id=$sessionId;
						$participant->student_id=$student;
						$participant->status=1;
	
						$participant->save();				
	
						$add_count++;
					}
				
				}
			}
			else
			{
				$del_count=Participation::where('session_id',$sessionId)->where('status',1)->delete();
			}


			
		}
		else
		{
			$newly_added=1;

			if($students!=null)
			{
				foreach($students as $student)
				{
                    
					$participant=new Participation;
					$participant->session_id=$sessionId;
					$participant->student_id=$student;
					$participant->status=1;

					$participant->save();	
					$add_count++;
				}
			}

			

			
		}
		
		
		$total_present=Participation::select('student_id')->where("session_id",$sessionId)->count();

		//$stsession=StudySession::where("session_id",$sessionId)->first();

		$save_status=Input::get('save');
		
		if($save_status=="permanent")
		{
			//$stsession->marking_completed=1;
			StudySession::where("session_id",$sessionId)->update(array('marking_completed'=>1));
		}
		else
		{
			StudySession::where("session_id",$sessionId)->update(array('marking_completed'=>0));;
		}

		
	
		return View::make('attendance.attendance_added')->with('added',$add_count)->with('deleted',$del_count)->with('subcode',$currentSub)->with('total_present',$total_present)->with('newly_added',$newly_added)->with('save_status',$save_status);
		///}

		//return $Part_Students;
	

	}
    
    
public function saveMedicals()
{
    $study_sessions=Input::get('medicals');
    $student_no=Input::get('student_no');
    
    foreach($study_sessions as $st_session)
    {
        if(!AttendanceController::isExistParticipation($student_no,$st_session,"medical"))
        {
           
                $participant=new Participation;
                $participant->session_id=$st_session;
                $participant->student_id=$student_no;
                $participant->status=0;

                $participant->save();	
            
            
        }
            
    }
    
    return Redirect::route('add_medical');
}


	public function select_all_courses()
	{


			return View::make('attendance/sem_subjects');
		///}

	}



    
	public function getstudent_list($subjectCode,$group,$sessionId)
	{
		$current_year= AcademicYear:: where('current1','=',1)->first();

		

		if($group!="none")
		{
			$stud=Student::select('student.student_id','student.last_name','student.initials','student.al_batch')
				->join('student_assignment','student_assignment.student_id','=','student.student_id')
				->join('courseunit_category','courseunit_category.cat_com_id','=','student_assignment.cat_com_id')
				->where('student_assignment.academic_year','=',$current_year->academic_year_id)
				->where('courseunit_category.course_code','=',$subjectCode)
				->where('student_assignment.group_id','=',$group)
				->distinct()
				->get();
		}
		else
		{
			$stud=Student::select('student.student_id','student.last_name','student.initials','student.al_batch')
				->join('student_assignment','student_assignment.student_id','=','student.student_id')
				->join('courseunit_category','courseunit_category.cat_com_id','=','student_assignment.cat_com_id')
				->where('student_assignment.academic_year','=',$current_year->academic_year_id)
				->where('courseunit_category.course_code','=',$subjectCode)
				->distinct()
				->get();
		}

		
		return View::make('attendance.student_list')->with('currentSub',$subjectCode)->with('stud_list',$stud)->with('group',$group)->with('sessionId',$sessionId);

		//return $stud;
	
	}

	public static function isExistParticipation($studentID,$sessionID,$participation_status="present")
	{
        if($participation_status=="present")
        {
            return Participation::where('student_id',$studentID)->where('session_id',$sessionID)->where('status',1)->exists();
        }
        else if($participation_status=="medical")
        {
            return Participation::where('student_id',$studentID)->where('session_id',$sessionID)->where('status',0)->exists();
        }
		
	}


    public  function searchAttendance()
    {
    
        $academicYear=CourseAvailability::select('academic_year')->orderby('academic_year','desc')->distinct()->get();
        $semester=Semester::where('status','=',1)->first()->semester_id;
        
        return View::make('attendance.attendance_search')->with('academicYear',$academicYear)->with('sem',$semester);           
    }
    
    
    public function postSearchAttendance()
    {
       
        $accYear=Input::get('academic_year');
        $semester=Input::get('semester');
        $csunit=Input::get('course_unit');
        $stuno=Input::get('student_number');
        $dateFormat=Input::get('dateFormat');
        $dateFrom=Input::get('dateFrom');
        $dateTo=Input::get('dateTo');
        
        $userInputs=[];
        $returnHeadings=[];
        
        $userInputs["Academic Year"]=$accYear;
        $userInputs["Semester"]=$semester;
        $userInputs["Level"]=Input::get("level");
        
            
        $attendanceResult=null;

        
        if($stuno=="")
        {
            $userInputs["Course Unit"]=$csunit;
            
            
           if($dateFormat=="date")
           {
               $userInputs["Date"]=$dateFrom;
               
               $attendanceResult=$this->getTotalAttendanceByDuration($csunit,$semester,$dateFrom);
               
           }
           else if($dateFormat=="duration")
           {
                
               $userInputs["From"]=$dateFrom;
               $userInputs["To"]=$dateTo;
               
               $attendanceResult=$this->getTotalAttendanceByDuration($csunit,$semester,$dateFrom,$dateTo);
           }
          
            
            $returnHeadings["student_id"]="Student Number";
            $returnHeadings["date"]="Date";
            $returnHeadings["type"]="Type";
            $returnHeadings["status"]="Attendance Status";
          
        }
        else if(($csunit=="None") && ($stuno!="")) 
        {
            $userInputs["Student Number"]=$stuno;
            
            if($dateFormat=="duration")
            {
                $userInputs["From"]=$dateFrom;
                $userInputs["To"]=$dateTo;
                
                
                $attendanceResult=$this->getStudentTotalAttendance($stuno,$semester,Auth::user()->depart_id,$accYear,$dateFrom,$dateTo);
            }
            else
            {
                
                $attendanceResult=$this->getStudentTotalAttendance($stuno,$semester,Auth::user()->depart_id,$accYear);
                
            }
                
                
            
           
           
            $returnHeadings["course_code"]="Course Code";
            $returnHeadings["type"]="Type";
            $returnHeadings["percentage"]="Percentage";
            
            //return $attendanceResult;
           
        }
        else
        {
            $userInputs["Course Unit"]=$csunit;
            $userInputs["Student Number"]=$stuno;
            
           
                          
            $DBQueryTemp="";
            
            if($dateFormat=="date")
            {
               
                
                $startAndEndDate=AcademicYear::select('starting_date','ending_date')->where('academic_year_id',Input::get('academic_year'))->first();
                
                
                
               $DBQueryTemp=$this->getTotalSemesterAttendance($startAndEndDate->starting_date,$startAndEndDate->ending_date,$csunit,$stuno);
                
               
            }
            else if($dateFormat=="duration")
            {
                $userInputs["From"]=$dateFrom;
                $userInputs["To"]=$dateTo;
                
                $DBQueryTemp=$this->getTotalSemesterAttendance($dateFrom,$dateTo,$csunit,$stuno);
               
                
            }
            
                
            
            if((sizeof($DBQueryTemp)!=0) && ($DBQueryTemp!=""))
            {
                $attendanceResult=[];
                
               
                
                foreach($DBQueryTemp as $tt)
                {
                       
                        $attendanceRecord['date']=$tt->date;
                        $attendanceRecord['time']=$tt->time;
                        $attendanceRecord['type']=$tt->type;
                    
                        $temp=Participation::where('participation.session_id',$tt->session_id)->
                          where('participation.student_id',$stuno)->get();
                    
                   
                        if(sizeof($temp)!=0)
                        {
                            
                            $attendanceRecord['status']=$temp[0]->status;
                            
                        }
                        else
                        {
                            $attendanceRecord['status']=-1;
                        }
                    
                    
                       
                        
                    array_push($attendanceResult,$attendanceRecord);
                        
                    
                       
                }
                
                
                $returnHeadings["date"]="Date";
                $returnHeadings["time"]="Time";
                $returnHeadings["type"]="Type";
                $returnHeadings["status"]="Attendance Status";
            }
        }
        
        
        $academicYear=CourseAvailability::select('academic_year')->orderby('academic_year','desc')->distinct()->get();
        $semester=Semester::where('status','=',1)->first()->semester_id;
        
        return View::make('attendance.attendance_search')->with('academicYear',$academicYear)->with('sem',$semester)->with('attendanceResult',$attendanceResult)->with("userInputs",$userInputs)->with("returnHeadings",$returnHeadings);
    }
    
    
 public function getStudentTotalAttendance($stuno,$semester,$department_id,$accYear,$dateFrom=null,$dateTo=null)
 {
     
     $attendanceResult="";
     
     $BaseQuery=DB::table('student_assignment')->select(DB::raw('courseunit_category.course_code,study_session.type,study_session.attendance_group,count(distinct study_session.session_id) as total_attendance'))
                ->join('courseunit_category','student_assignment.cat_com_id','=','courseunit_category.cat_com_id') ->join('course_types','course_types.priority','=','courseunit_category.course_type')   
                ->join('study_session','study_session.course_code','=','courseunit_category.course_code')
                ->join('course_unit','course_unit.code','=','courseunit_category.course_code')
                ->join('course_availability','course_availability.code','=','course_unit.code')
                ->join('academic_year','academic_year.academic_year_id','=','study_session.academic_year')    
                ->where(function($query){return $query->whereRaw('study_session.attendance_group=student_assignment.group_id')->orwhereNull('study_session.attendance_group');})
                ->where('course_availability.academic_year',$accYear)
                ->where('student_assignment.student_id',$stuno)
                ->where('course_unit.semester',$semester)
                ->where('course_unit.department_id',$department_id);
     
     
     if($dateTo!=null)
     {
         $DBQueryTemp=$BaseQuery->where('study_session.date','>=', $dateFrom)->where('study_session.date','<=',$dateTo)
                      ->groupBy('study_session.course_code', 'study_session.type')->get();
     }
     else
     {
         $DBQueryTemp=$BaseQuery->whereRaw('study_session.date>=academic_year.starting_date')
                      ->whereRaw('study_session.date<=academic_year.ending_date')    
                      ->groupBy('study_session.course_code', 'study_session.type')->get();
     }
     
     
     if(sizeof($DBQueryTemp)!=0)
     {
          foreach($DBQueryTemp as $tt)
          {
              if($dateTo!=null)
              {
                  $temp=Participation::select(DB::raw('study_session.course_code,study_session.type,round((((count(participation.session_id))/'.$tt->total_attendance.')*100),2) as percentage'))
                                              ->join('study_session','study_session.session_id','=','participation.session_id')->where('participation.student_id',$stuno)->where('study_session.course_code',$tt->course_code)
                                              ->where('study_session.type',$tt->type)
                                              ->where('study_session.attendance_group',$tt->attendance_group)
                                              ->where('study_session.date','>=',$dateFrom)
                                              ->where('study_session.date','<=',$dateTo)
                                              ->get(); 
              }
              else
              {
                  $temp=Participation::select(DB::raw('study_session.course_code,study_session.type,round((((count(participation.session_id))/'.$tt->total_attendance.')*100),2) as percentage'))
                                              ->join('study_session','study_session.session_id','=','participation.session_id')->where('participation.student_id',$stuno)->where('study_session.course_code',$tt->course_code)
                                              ->where('study_session.type',$tt->type)
                                              ->where('study_session.attendance_group',$tt->attendance_group)
                                              ->get(); 
              }
              
                    if($temp[0]->course_code==null)
                    {
                        $temp[0]->course_code=$tt->course_code;
                        $temp[0]->type=$tt->type;
                    }

                    if($attendanceResult=="")
                    {
                        $attendanceResult=$temp;
                    }
                    else
                    {
                        $attendanceResult->add($temp[0]);
                    }
          }
     }
     
     return $attendanceResult;
 }
    
 private function getTotalAttendanceByDuration($course_unit,$semester,$dateFrom,$dateTo=null)
 {
        $DBQueryOb=CourseUnit::select('study_session.date','study_session.type','participation.student_id','participation.status')
                          ->join('study_session','study_session.course_code','=','course_unit.code')
                          ->join('participation','participation.session_id','=','study_session.session_id')
                          ->orderBy('study_session.date','desc')
                          ->where('course_unit.code',$course_unit)
                          ->where('course_unit.semester',(int)($semester));
     
        if($dateTo!=null)
        {
            return $DBQueryOb->where('study_session.date','>=',$dateFrom)
                                 ->where('study_session.date','<=',$dateTo)
                                 ->get();
        }
        else
        {
            return $DBQueryOb->where('study_session.date','=',$dateFrom)->get();
        }
 }
    
    
public function getTotalSemesterAttendance($startDate,$endDate,$csunit,$stuno)
{
        $DBQueryTemp="";
        
        $AttendanceGroups=CourseTypes::select("courseunit_category.course_code","student_assignment.group_id")
                            ->join("courseunit_category","courseunit_category.course_type","=","course_types.priority")
                            ->join("student_assignment","student_assignment.cat_com_id","=","courseunit_category.cat_com_id")
                              ->where("student_assignment.student_id",$stuno)
                              ->where("courseunit_category.course_code",$csunit)
                              ->get();
        
        foreach($AttendanceGroups as $attendance)
        {
             $Temp=StudySession::select('session_id','date','time','type','attendance_group')
                        ->where('course_code',$csunit)->where("study_session.attendance_group",$attendance->group_id)->where('study_session.date','>=',$startDate)
                                 ->where('study_session.date','<=',$endDate)->orderBy('date','desc')->get();
            
            if(sizeof($Temp)!=0)
                {
                    if($DBQueryTemp=="")
                    {
                       
                      
                            $DBQueryTemp=$Temp;
                        
                    }
                    else
                    {
                        
                            foreach($Temp as $tt)
                            {
                                $DBQueryTemp->add($tt);
                            }
                            
                        
                    }
                }
            
        }
        return $DBQueryTemp;
    }
    
    
public function add_medical_load()
	{

		return View::make('attendance.add_medical_load');
	}
    
public function add_medical_load_post()
{
    
     $student=Input::get('student_number');
     $st_date=Input::get('date');
     $duration=Input::get('duration');
    
    
     $department_id = Auth::user()->depart_id;  
     $current_year= AcademicYear:: where('current1','=',1)->first()->academic_year_id;
     $semester=Semester::where('status','=',1)->first()->semester_id;
    
     $end_date=date('Y-m-d',strtotime("+".$duration." days",strtotime($st_date)));
    
     $study_sessions=Student::select('study_session.session_id','study_session.course_code','study_session.date','study_session.type','study_session.attendance_group')
                     ->join('course_registration','course_registration.student_id','=','student.student_id')
                     ->join('study_session','study_session.course_code','=','course_registration.code')
                     ->join('course_unit','course_unit.code','=','course_registration.code')
                     ->join('courseunit_category','courseunit_category.course_code','=','course_unit.code')
                     ->join('course_types','course_types.priority','=','courseunit_category.course_type')
                     ->join('student_assignment','student_assignment.cat_com_id','=','courseunit_category.cat_com_id')
                     ->whereRaw("student_assignment.student_id=student.student_id")
                     ->where(function($query){return $query->whereRaw('study_session.attendance_group=student_assignment.group_id')->orwhereNull('study_session.attendance_group');})
                     ->whereRaw("study_session.type=course_types.name")
                     ->where('student.student_id',$student)
                     ->where('course_unit.department_id',$department_id)
                     ->where('course_registration.academic_year_id',$current_year)
                     ->where('course_unit.semester',$semester)
                     ->where('study_session.date','>=',$st_date)
                     ->where('study_session.date','<=',$end_date)
                     ->get();
    
    return View::make('attendance.add_medical_load')->with('study_sessions',$study_sessions)->with('student_no',$student);
    
    
}    
public function check_student_medical_status()
{
    
     $student=Input::get('student_number');
     $st_date=Input::get('date');
     $duration=Input::get('duration');
    
    
     $department_id = Auth::user()->depart_id;  
     $current_year= AcademicYear:: where('current1','=',1)->first()->academic_year_id;
     $semester=Semester::where('status','=',1)->first()->semester_id;
    
     $end_date=date('Y-m-d',strtotime("+".$duration." days",strtotime($st_date)));
    
     $study_sessions=Student::select('study_session.session_id','study_session.course_code','study_session.date','study_session.type','study_session.attendance_group')
                     ->join('course_registration','course_registration.student_id','=','student.student_id')
                     ->join('study_session','study_session.course_code','=','course_registration.code')
                     ->join('course_unit','course_unit.code','=','course_registration.code')
                     ->join('courseunit_category','courseunit_category.course_code','=','course_unit.code')
                     ->join('course_types','course_types.priority','=','courseunit_category.course_type')
                     ->join('student_assignment','student_assignment.cat_com_id','=','courseunit_category.cat_com_id')
                     ->whereRaw("student_assignment.student_id=student.student_id")
                     ->where(function($query){return $query->whereRaw('study_session.attendance_group=student_assignment.group_id')->orwhereNull('study_session.attendance_group');})
                     ->whereRaw("study_session.type=course_types.name")
                     ->where('student.student_id',$student)
                     ->where('course_unit.department_id',$department_id)
                     ->where('course_registration.academic_year_id',$current_year)
                     ->where('course_unit.semester',$semester)
                     ->where('study_session.date','>=',$st_date)
                     ->where('study_session.date','<=',$end_date)
                     ->get();
    
    return View::make('attendance.student_medical_study_session')->with('study_sessions',$study_sessions)->with('student_no',$student);
    
    
}

private function get_abscent_students($session_id)
{
        $current_year= AcademicYear:: where('current1','=',1)->first()->academic_year_id;
    
    
        $study_session=StudySession::where('session_id','=',$session_id)->first();
    
        
        $course_unit_students=CourseUnit::where('code','=',$study_session->course_code)->first()->Students($current_year,$study_session->type,$study_session->attendance_group);
        
    
        $students=$study_session->Students("present");
    
        return $course_unit_students->diff($students);
}
    
    
public function get_abscent_student_list($session_id)
{
       
        return View::make('attendance.medical_student_list')->with('students',$this->get_abscent_students($session_id))->with('sessionId',$session_id);
}



public function redirect(){
	return Redirect::back()->withInput();
		
}



}



?>



	

