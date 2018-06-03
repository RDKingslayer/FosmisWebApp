<?php

class TimeTableController extends \BaseController {


	public function getTimetable()
	{

		$semester=Semester::where('status',1)->first();
		$courseUnits=CourseUnit::where('department_id',1)->where('semester',$semester->semester_id)->get();

		$courseTypes=CourseUnit::where('code','CCIT')->first()->courseTypes;
		$courseTypeWithTime=CourseUnit::where('code','CCIT')->first()->courseTypesWithTime;
		
		return View::make('TimeTable')->with('courseTypes',$courseTypes)->with("cstypeTime",$courseTypeWithTime)->with("courseUnits",$courseUnits);
	}
    
    public function showTimeTable()
    {
        
        
            /*Monday Courses*/
            $MonLevelI=$this->getDepartmentCoursesDayLevel("Monday",1);
            $MonLevelII=$this->getDepartmentCoursesDayLevel("Monday",2);
            $MonLevelIII=$this->getDepartmentCoursesDayLevel("Monday",3);

            /*Tuesday Courses*/
            $TueLevelI=$this->getDepartmentCoursesDayLevel("Tuesday",1);
            $TueLevelII=$this->getDepartmentCoursesDayLevel("Tuesday",2);
            $TueLevelIII=$this->getDepartmentCoursesDayLevel("Tuesday",3);

            /*Wednesday Courses*/
            $WedLevelI=$this->getDepartmentCoursesDayLevel("Wednesday",1);
            $WedLevelII=$this->getDepartmentCoursesDayLevel("Wednesday",2);
            $WedLevelIII=$this->getDepartmentCoursesDayLevel("Wednesday",3);

            /*Thursday Courses*/
            $ThuLevelI=$this->getDepartmentCoursesDayLevel("Thursday",1);
            $ThuLevelII=$this->getDepartmentCoursesDayLevel("Thursday",2);
            $ThuLevelIII=$this->getDepartmentCoursesDayLevel("Thursday",3);

             /*Friday Courses*/
            $FriLevelI=$this->getDepartmentCoursesDayLevel("Friday",1);
            $FriLevelII=$this->getDepartmentCoursesDayLevel("Friday",2);
            $FriLevelIII=$this->getDepartmentCoursesDayLevel("Friday",3);
                
        return View::make('TestTimeTable')->with('MonLevelI',$MonLevelI)->with('MonLevelII',$MonLevelII)->with('MonLevelIII',$MonLevelIII)->with('TueLevelI',$TueLevelI)->with('TueLevelII',$TueLevelII)->with('TueLevelIII',$TueLevelIII)->with('WedLevelI',$WedLevelI)->with('WedLevelII',$WedLevelII)->with('WedLevelIII',$WedLevelIII)->with('ThuLevelI',$ThuLevelI)->with('ThuLevelII',$ThuLevelII)->with('ThuLevelIII',$ThuLevelIII)->with('FriLevelI',$FriLevelI)->with('FriLevelII',$FriLevelII)->with('FriLevelIII',$FriLevelIII);
    }
    
    private function getDepartmentCoursesDayLevel($day,$level)
    {
        $department_id=Auth::user()->depart_id;
        $subjects=[];
        switch($department_id)
        {
            case 1:
                
                $BCScourses=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"CSC"));
                $BSCcourses=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"COM"));
                $CLCcourses=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"CLC")); 
                $CCITcourses=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"CCIT"));
                
                
                
                $this->mergeResults($BCScourses,$BSCcourses);
                $this->mergeResults($BCScourses,$CLCcourses);
                $this->mergeResults($BCScourses,$CCITcourses);
                
                $subjects=$BCScourses;
                
                break;
            
            case 2:
                $MATcourses=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"MAT"));
                $AMTcourses=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"AMT"));
                $IMcourses=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"IM"));
                
                $this->mergeResults($MATcourses,$AMTcourses);
                $this->mergeResults($MATcourses,$IMcourses);
                
                $subjects=$MATcourses;
                
                break;
                
            case 3:
                $subjects=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"CHE"));
                break;
                
            case 4:
                $subjects=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"ZOO"));
                break;
                
            case 5:
                $subjects=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"BOT"));
                break;
                
            case 6:    
                $subjects=$this->sortCoursesByStartTime($this->getDegreeCoursesDayLevelPrefix($day,$level,"PHY"));
                break;
                
            default:
                break;
                
        }
        
        return $subjects;
    }
    
    private function mergeResults($source,$subs)
    {
        
        foreach($subs as $sub)
        {
            $source->add($sub);
        }
    }
    
    private function sortCoursesByStartTime($courseOb)
    {
        for($i=0;$i<sizeof($courseOb)-1;$i++)
        {
            for($j=0;$j<((sizeof($courseOb)-1)-$i);$j++)
            {
                if($courseOb[$j]->start_time > $courseOb[$j+1]->start_time)
                {
                    $temp=$courseOb[$j];
                    $courseOb[$j]=$courseOb[$j+1];
                    $courseOb[$j+1]=$temp;
                }
            }
        }
        
        return $courseOb;
    }
    
    private function getDegreeCoursesDayLevelPrefix($day,$level,$prefix)
    {
         $current_sem_id=Semester::where('status','=',1)->first();
         $sem_id=$current_sem_id->semester_id;
            
        return TimeTable::select('courseunit_category.course_code','course_title.title','course_unit.level','course_types.name','course_timetable.start_time','course_timetable.wk_day','course_timetable.duration')->join('courseunit_category','courseunit_category.cat_com_id','=','course_timetable.cat_com_id')->join('course_types','course_types.priority','=','courseunit_category.course_type')->join('course_unit','course_unit.code','=','courseunit_category.course_code')->join('course_title','course_title.code','=','course_unit.code')->where('course_unit.level',$level)->where('course_timetable.wk_day',$day)->where('course_unit.department_id',Auth::user()->depart_id)->where(function($query) use ($sem_id){return $query->where('course_unit.semester','=',$sem_id)->orwhere('course_unit.semester','=','0');})->where('courseunit_category.course_code','like',$prefix.'%')->orderBy('course_timetable.start_time')->get();
        
        
    }
    
    public static function getCoursesTimeTable($day,$level)
    {
        $current_sem_id=Semester::where('status','=',1)->first();
            
        return TimeTable::select('courseunit_category.course_code','course_title.title','course_unit.level','course_types.name','course_timetable.start_time','course_timetable.wk_day','course_timetable.duration')->join('courseunit_category','courseunit_category.cat_com_id','=','course_timetable.cat_com_id')->join('course_types','course_types.priority','=','courseunit_category.course_type')->join('course_unit','course_unit.code','=','courseunit_category.course_code')->join('course_title','course_title.code','=','course_unit.code')->where('course_unit.level',$level)->where('course_timetable.wk_day',$day)->where('course_unit.department_id',Auth::user()->depart_id)->where('course_unit.semester','=',$current_sem_id->semester_id)->orderBy('courseunit_category.course_code')->get();
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
