<?php

class HodController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
    public function showNewCourseRegistration()
    {
        $departmentID=Auth::user()->Department->dept_id;
        
        switch($departmentID)
        {
            case 1:
                $sub_cat['CSC']="Bachelor of Computer Science Courses";
                $sub_cat['COM']="Bachelor of Science Courses";
                break;
                
            case 2:
                $sub_cat['MAT']="Pure Mathematics Courses";
                $sub_cat['IM']="Industrial Mathematics Courses";
                $sub_cat['AMT']="Applied Mathematics Courses";
                break;
                
            case 3:
                $sub_cat['CHE']="Chemistry";
                break;
                
            case 4:
                $sub_cat["ZOO"]="Zoology";
                break;
                
            case 5:
                $sub_cat["BOT"]="Botany";
                break;
                
            case 6:
                $sub_cat["PHY"]="Physics";
                break;    
                
        }
        
        return View::make('hod.hod_register_course')->with('sub_cat',$sub_cat);
    }
    
    public function showExamElibilityCutoff()
    {
        $depart_id=Auth::user()->depart_id;
        $semid=Semester::where('status','=',1)->first()->semester_id;
        
        if($depart_id==1)
        {
            $degree_program['BCS']="Bachelor of Computer Science";
            $degree_program['BSc']="Bachelor of Science";
        }
        else
        {
            $degree_program['BSc']="Bachelor of Science";
        }
        
        $department_courses=CourseUnit::select('course_unit.code','course_unit.type','course_unit.level')->where('department_id',$depart_id)->where(function($query) use ($semid){return $query->where('course_unit.semester','=',$semid)->orwhere('course_unit.semester','=','0');})->get();
        
        return View::make('hod.hod_exam_eligibility_cutoff')->with('degree_program',$degree_program)->with('dept_course',$department_courses);
    }
    
    public function postExamElibilityCutoff()
    {
        $current_year= AcademicYear:: where('current1','=',1)->first()->academic_year_id;
        $cut_off=Input::get('hid_cutoff');
        
        $course_code="";
        $course_type="";
        $level="";
        
        
        foreach($cut_off as $key=>$value)
        {
            $course_code=substr($key,0,$key.strlen($key)-1);
            
             
            
            if(substr($key,-1)=="T")
            {
                $course_type="Theory";
            }
            else if(substr($key,-1)=="P")
            {
                $course_type="Practical";
            }
            
           
            
            $course_unit=CourseUnitCutoff::where('course_code',$course_code)->where('type',$course_type)->first();
            
            if($course_unit==null)
            {
                $course_unit=new CourseUnitCutoff;
                $course_unit->course_code=$course_code;
                $course_unit->type=$course_type;
                $course_unit->cut_off=$value;
                $course_unit->save();
            }
            else
            {
                if($course_unit->cut_off!=$value)
                {
                    $course_unit->cut_off=$value;
                    $course_unit->save();
                }
                    
            }
           
        }
        
         return Redirect::route('set_eligibility_cutoff');
    }
    
    
    private function targetGroupsGeneral($degree_program,$course_code,$acc_year)
    {
       
        
        if(in_array("BCS",$degree_program))
        {
            $course_status=Input::get('bcs');
            
            $target_group=new TargetGroup;
            $target_group->code=$course_code;
            $target_group->target_pathways=null;
            $target_group->degree_id="G2";
            $target_group->course_status=$course_status;
            $target_group->academic_year=$acc_year;
            
            $target_group->save();
            
        }
        
        if(in_array("BSc",$degree_program))
        {
            if(Input::get('bsc_ps')!="")
            {
                $course_status=Input::get('bsc_ps');
                $pathways=Input::get("PS");
                
                if(sizeof($pathways)!=0)
                {
                    foreach($pathways as $pw)
                    {
                        $target_group=new TargetGroup;
                        $target_group->code=$course_code;
                        $target_group->target_pathways=$pw;
                        $target_group->degree_id="G1";
                        $target_group->course_status=$course_status;
                        $target_group->academic_year=$acc_year;
            
                        $target_group->save();
                    }
                }
                
            }
            
            if(Input::get('bsc_bs')!="")
            {
                $course_status=Input::get('bsc_bs');
                $pathways=Input::get("BS");
                
                if(sizeof($pathways)!=0)
                {
                    foreach($pathways as $pw)
                    {
                        $target_group=new TargetGroup;
                        $target_group->code=$course_code;
                        $target_group->target_pathways=$pw;
                        $target_group->degree_id="G1";
                        $target_group->course_status=$course_status;
                        $target_group->academic_year=$acc_year;
            
                        $target_group->save();
                    }
                }
            }
        }
    }
    
    
    private function targetGroupsSpecial($degree_program,$course_code,$acc_year)
    {
        if(in_array("BCS",$degree_program))
        {
            $course_status=Input::get('bcs');
            
            $target_group=new TargetGroup;
            $target_group->code=$course_code;
            $target_group->target_pathways=null;
            $target_group->degree_id="S2";
            $target_group->course_status=$course_status;
            $target_group->academic_year=$acc_year;
            
            $target_group->save();
            
        }
        
        if(in_array("BSc",$degree_program))
        {
            $degrees=Input::get('SP');
            
            foreach($degrees as $dg)
            {
                $target_group=new TargetGroup;
                $target_group->code=$course_code;
                $target_group->target_pathways=null;
                $target_group->degree_id=$dg;
                $target_group->course_status=Input::get($dg);
                $target_group->academic_year=$acc_year;
            
                $target_group->save();
            }
        }
    }
    
    public function saveCourseUnit()
    {
        $current_year= AcademicYear:: where('current1','=',1)->first()->academic_year_id;
        $departmentID=Auth::user()->Department->dept_id;
        
        $course_prefix=Input::get('cs_prefix');
        
        $course_code=$course_prefix.Input::get('cs_code');
        $course_category=Input::get('cs_code');
        $course_level=Input::get('level');
        $course_type=Input::get('course_type');
        $course_name=Input::get('course_name');
        $credits=Input::get('credits');
        $semester=Input::get('semester');
        $pre_requisties=Input::get('prerequisties');
        $degree_program=Input::get('degree_program');
        
        $degree_id="";
        
        
        if($course_level!=4)
        {
            if($course_prefix=="CSC")
            {
                $degree_id="G2";
            }
            else
            {
                $degree_id="G1";
            }
        }
        else
        {
            switch($course_prefix)
                {
                    case "CSC":
                        $degree_id="S2";
                        break;
                        
                    case "MAT":
                    case "IM":
                    case "AMT":    
                        $degree_id="SMAT";
                        break;
                        
                    case "BOT":
                        $degree_id="SBOT";
                        break;
                        
                    case "ZOO":
                        $degree_id="SZOO";
                        break; 
                        
                    case "PHY":
                        $degree_id="SPHY";
                        break;  
                        
                    case "CHE":
                        $degree_id="SCHE";
                        break;    
                }
        }
           
        
        $course_unit=new CourseUnit;
        $course_unit->code=$course_code;
        $course_unit->credits=$credits;
        $course_unit->type=$course_type;
        $course_unit->department_id=$departmentID;
        $course_unit->level=$course_level;
        $course_unit->gpa_status=1;
        $course_unit->semester=$semester;
        $course_unit->degree_id=$degree_id;
        
        if($pre_requisties=="None")
        {
            $course_unit->prerequistie=null;
        }
        else
        {
            $course_unit->prerequistie=$pre_requisties;
        }
        
        $course_unit->save();
        
        $course_title=new CourseTitle;
        $course_title->code=$course_code;
        $course_title->user_id=Auth::user()->id;
        $course_title->title=$course_name;
        $course_title->academic_year=$current_year;
        $course_title->date=date('Y-m-d');
        
        $course_title->save();
        
        
       /* foreach($dg as $degree_program)
        {
            if($dg=="BSc")
            {
                $course_status=Input::get('bsc_ps');
                
                if($course_status!="")
                {
                    $target_groups=Input::get('PS');
                    
                }
            }
        }*/
        
        if($course_level!=4)
        {
            $this->targetGroupsGeneral($degree_program,$course_code,$current_year);
        }
        else
        {
            $this->targetGroupsSpecial($degree_program,$course_code,$current_year);
        }
        
         return Redirect::route('register_new_course');
        
        //return $pre_requisties;
        
       
    }
    
    public function viewExamEligibility()
    {
        return View::make('hod.hod_view_exam_eligibility');
    }
    
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
