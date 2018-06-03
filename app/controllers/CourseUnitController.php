<?php
/* 	
course status table
	status 0= not available
	status 1= available
offering availability table
	status 0 = not offered
	status 1 =offered
*/
class CourseUnitController extends BaseController {


	public function getCourseUnit()
	{
		
		return View::make('course_units.registre_course');
	}

	public function postCourseUnit()
	{
		$Validator = Validator::make(Input::all(), array(
			'fsc'					=>	'required',
			'code'					=>	'required',
			'title'					=>	'required',
			'type'					=>	'required',
			'gpa'					=>  'required',
			'core'					=>  'required'
			));

	if($Validator->fails()){
					//$Validator->messages()

				return Redirect::route('add-course-unit')//->with('message','jghjgdjhgh');
				->withErrors($Validator->messages())
				->withInput();

			//	$errors = $Validator->messages();


			//	if ( ! empty( $errors ) ) {
   			//	foreach ( $errors->all() as $error ) {
       					//	 echo '<div class="error">' . $error . '</div>';
  //  }
//}
		}else{
			$fsc 				= Input::get('fsc');
			$code 				= Input::get('code');
			$title 				= Input::get('title');
			$type 				= Input::get('type');
			$degree 			= Input::get('degree');
			$gpa				= Input::get('gpa');
			$core 				= Input::get('core');

			$level 				= substr($code,3,1);
			$semester 			= substr($code,4,1);
			$credits 			= substr($code,6,1);
			
			$academic_yr = AcademicYear:: where('current1','=',1)->first()->academic_year_id;
			//query degree_id
			if(Input::get('fsc')=="fsc"){
				$degree_id ="ALL";
			}
			else{
			$degree_id=Degree::where('Degree_name','=',$degree)->first()->Degree_id;
			}

			if($credits=="b")
				$cre=2.50;
			else if($credits=="a")
				$cre=1.50;
			else if($credits=="d")
				$cre= 1.25;
			else 
				$cre=$credits;

			$course_code = CourseUnit::create(['code'=>$code, 'credits'=>$cre, 'type'=>$type, 'level'=>$level,'gpa_status'=>$gpa ,'semester'=>$semester, 'degree_id'=>$degree_id])->code;

			if(Input::has('department')){
				$department 		= Input::get('department');
				$dept=Department::where('dept_name','=',$department)->first();
				CourseUnit::where('code','=',$course_code)->update(['department_id'=>$dept->dept_id]);
			}
			
			if($course_code){
				//query current academic year
				
				$today=date('Y-m-d');
				$course_title =CourseTitle::create(['code'=>$course_code, 'title'=>$title, 'academic_year'=>$academic_yr,'user_id'=>1,'date'=>$today]);
				$course_availability =CourseAvailability::create(['code'=>$course_code, 'status'=>1, 'academic_year'=>$academic_yr]);
				$offering_availability =OfferingAvailability::create(['code'=>$course_code, 'status'=>0, 'academic_year'=>$academic_yr]);

				if(Input::has('bcs')){
					$degree 		= Input::get('bcs');
					$c_o_bcs 		= Input::get('c_o_bcs');
					$target_group	=TargetGroup::create(['code'=>$course_code, 'degree_id'=>$degree, 'course_status'=>$c_o_bcs]);
				}
				else{}

				if(Input::has('bsc')){
					$degree 		= Input::get('bsc');

					if(Input::has('ps')){
						$pathway_ps = Input::get('ps');
						$c_o_ps = Input::get('c_o_ps');
							foreach($pathway_ps as $pathway_ps)
							{
   								$target_group = TargetGroup::create(['code'=>$course_code, 'target_pathways'=>$pathway_ps, 'degree_id'=>$degree, 'course_status'=>$c_o_ps, 'academic_year'=>$academic_yr]);
							}
					}	
					else{}				

					if(Input::has('bs')){
						$pathway_bs = Input::get('bs');
						$c_o_bs = Input::get('c_o_bs');
							foreach($pathway_bs as $pathway_bs)
							{
   								$target_group = TargetGroup::create(['code'=>$course_code, 'target_pathways'=>$pathway_bs, 'degree_id'=>$degree, 'course_status'=>$c_o_bs, 'academic_year'=>$academic_yr]);
							}
					}
					else{} 
				}
				else{}

				//BCS Special Degree
				if(Input::has('bcs_spe'))
				{
					$degree 		= Input::get('bcs_spe');
					$c_o_bcs_spe 	= Input::get('c_o_bcs_spe');
					$target_group = TargetGroup::create(['code'=>$course_code, 'degree_id'=>$degree, 'course_status'=>$c_o_bcs_spe, 'academic_year'=>$academic_yr]);
				}
				else{}
				
				//BSc Special Degree
				$name='BSc (Special)';
           	 	$special_stream=Degree::where('Degree_name', 'LIKE', '%'.$name .'%')->get();
				
				foreach($special_stream as $special_stream)
				{

					if(Input::has($special_stream->Degree_id))
					{
						$degree 		= Input::get($special_stream->Degree_id);
						$c_o_bsc_spe 	= Input::get('c_o_bsc_spe'.$special_stream->Degree_id);
							
							if($degree  && $c_o_bsc_spe)
							{
   								$target_group = TargetGroup::create(['code'=>$course_code, 'degree_id'=>$degree, 'course_status'=>$c_o_bsc_spe, 'academic_year'=>$academic_yr]);
							}

					}	
				}

				$Degree = Degree::all();
				foreach($Degree as $Degree)
				{
									
					if(Input::has($Degree->Degree_id))
					{
					$degree_id 		= Input::get($Degree->Degree_id);
					$c_o	= Input::get('c_o'.$Degree->Degree_id);
					$target_group = TargetGroup::create(['code'=>$course_code, 'degree_id'=>$degree_id, 'course_status'=>$c_o, 'academic_year'=>$academic_yr]);
					}

				}

				if(Input::has('Prerequisite_code'))
				{
					$Prerequisite_code = Input::get('Prerequisite_code');	
					$arr_pre_code		=explode(',',$Prerequisite_code);
					
					foreach($arr_pre_code as $arr_pre_code)
					{
						$prerequisites = Prerequisites::create(['code'=>$course_code, 'prerequisite_code'=>$arr_pre_code, 'academic_year'=>$academic_yr]);

					}			
				}
			}

			if( $course_title && $course_availability && $target_group)


			{
				if($core==0)
					return View::make('messages.success'); 
				else
					return View::make('course_units.elective_course')->with('course', $course_code); 
			}
			else{
				echo "error";
			}

		}
	}

	public function PrerequisitesCourse()
	{

		$course = CourseUnit::select( 'code' )->orderBy('code','asc')->get();

	  	$data = array();
	   		foreach ( $course as $course ){
	    		$data[] = array($course->code);
			}
			return json_encode($data);
	}

	public function ViewCourseUnit()
	{
		$course_details=CourseUnit::orderBy('code')->get();
		return View::make('course_units.view_course_unit')->with('course_details', $course_details);

	}

	public function getChangeCourseUnit($course_code)
	{
		$course_details=CourseUnit::where('code','=',$course_code)->first();
		$level=$course_details->level;
		//$level=1;
		$course_changing_levels=Level::select('level_id')->whereNotIn('level_id',[$level] )->get();
		$course_title=CourseTitle::where('code','=',$course_code)->orderBy('academic_year', 'desc')->first();
		return View::make('course_units.change_course')->with('course_details', $course_details)->with('course_title', $course_title)->with('course_changing_levels',$course_changing_levels);
	}
	public function postChangeCourseUnit()
	{
		$Validator = Validator::make(Input::all(), array(
			'code'					=>	'required',
			'gpa'					=>  'required',
			));

		if($Validator->fails()){
				return Redirect::route('change-course-unit')
					->withErrors($Validator)
					->withInput();
		}else{
			$code 				= Input::get('code');
			$title 				= Input::get('new_title');
			$level 				= Input::get('level');
			$semester 			= Input::get('semester');
			$senate 			= Input::get('meeting');
			
			if(Request::ajax()) {
				$data=Input::all();
				$new_title=Input::get('new_title');
				$code=Input::get('code');
			
				$course = CourseUnit::select( 'code' )->orderBy('code','asc')->get();
				$course_title=CourseTitle::where('code','=',$course_code)->orderBy('academic_year', 'desc')->first();

				if($course_title==$new_title) {
					$data = 0;
				}else{
					$data = 1;
				}
				return json_encode($data);
			}
	  	
			$academic_yr = AcademicYear:: where('current1','=',1)->first()->academic_year_id;

			//change course title with academic year
			if(Input::has('new_title'))
			{
				$user_id=1;
				$today=date('Y-m-d');
				$changes_title_in_same_academic = CourseTitle:: where('code','=',$code)-> where('academic_year','=',$academic_yr)->first();
					if($changes_title_in_same_academic){
						CourseTitle::where('code','=',$code)->where('academic_year','=',$academic_yr)->update(['title'=>$title,'senate_number'=>$senate,'user_id'=>$user_id,'date'=>$today]);
					}else{
		 				CourseTitle::create(['code'=>$code, 'title'=>$title, 'academic_year'=>$academic_yr,'senate_number'=>$senate,'user_id'=>$user_id,'date'=>$today]);
					}
			}

			//change offerring semester of course with academic year
			if(Input::has('semester')){
				$semester_name_input = Input::get('semester');
				$semester_details=SemesterType::where('semester_name','=',$semester_name_input)->first();
				if($semester_details){
					$input_semester_id = $semester_details->semester_type_id;
				}
				$changes_semester_in_same_academic = OfferingSemester:: where('code','=',$code)-> where('academic_year','=',$academic_yr)->first();
				if($changes_semester_in_same_academic){
					OfferingSemester::where('code','=',$code)->where('academic_year','=',$academic_yr)->update(['offering_semester_id'=>$input_semester_id]);
				}else{
					OfferingSemester::create(['code'=>$code, 'offering_semester_id'=>$input_semester_id, 'academic_year'=>$academic_yr]);
				}
			}

			//change offering level of course with academic year
				$Level = Level::all();
				foreach($Level as $Level)
				{				
					if(Input::has($Level->level_id))
					{
						$level 	= Input::get($Level->level_id);
						$changes_level_in_same_academic = OfferingLevel:: where('code','=',$code)-> where('academic_year','=',$academic_yr)->where('offering_level_id','=',$level)->first();
						
						if(!($changes_level_in_same_academic))
						{
							OfferingLevel::create(['code'=>$code, 'offering_level_id'=>$level, 'academic_year'=>$academic_yr]);
						}
					}else{
						$changes_level_in_same_academic = OfferingLevel:: where('code','=',$code)-> where('academic_year','=',$academic_yr)->where('offering_level_id','=',$Level->level_id)->delete();
					}
				}
			
			return Redirect::route('view-course-unit');
		}
	}
	public function NewTitleCourse()
	{
		$new_title = $_POST['new_title'];
		$code = $_POST['code'];

			$check = CourseTitle::where('code','=',$code)->where('title','=',$new_title)->orderBy('academic_year', 'desc')->count();

			  	if ($check=='0'){	 
				  $response_str1 = "1";
				  return $response_str1;
			   	} else {
				  $response_str2 = "2";
				  return $response_str2;			
			   	}
	}
	
	public function OfferCourseUnit()
	{

		$course_details=CourseUnit::orderBy('code')->get();
		return View::make('course_units.offer_course')->with('course_details', $course_details);

	}

	public function PostChangeAvailability($course_code)
	{
		$Validator = Validator::make(Input::all(), array(
			'n_availability'			=>	'required'
			));

		if($Validator->fails()){
				return Redirect::route('change-course-unit', [$course_code])
					->withErrors($Validator)
					->withInput();
		}else{
			$n_availability 		= Input::get('n_availability');
			$answer 				= Input::get('answer');
			
			$academic_yr = AcademicYear:: where('current1','=',1)->first()->academic_year_id;
				
				if(Input::has('answer'))
				{					
					if($answer=='yes'){
						$status=0;
						CourseAvailability::where('code','=',$course_code)->where('academic_year','=',$academic_yr)->update(['status'=>$status]);
						return Redirect::route('change-course-unit', [$course_code]);
					}
					else{
						$status=0;
						CourseAvailability::where('code','=',$course_code)->where('academic_year','=',$academic_yr)->update(['status'=>$status]);
						return Redirect::route('change-course-unit', [$course_code]);
					}
				}
				else{
						$status=1;
						CourseAvailability::where('code','=',$course_code)->where('academic_year','=',$academic_yr)->update(['status'=>$status]);
						return Redirect::route('change-course-unit', [$course_code]);
				}
		}
	}

	public function ChangeLecturerCourse()
	{
		$academic_yr = AcademicYear:: where('current1','=',1)->first()->academic_year_id;
		
		$new_name = $_POST['new_name'];
		$name = explode(" ", $new_name);
		$filter_lecturer=Lecturer::where('title','=',$name[0])->where('initials','=',$name[1])->where('lname','=',$name[2])->first();
		
		$code = $_POST['code'];
		$previos_lecturer=AssignLecturer::where('code','=',$code)->orderBy('academic_year','desc')->first();
		if($previos_lecturer){
			if($previos_lecturer->academic_year == $academic_yr){
				$check = AssignLecturer::where('code','=',$code)->where('academic_year','=',$academic_yr)->update(['lecturer_id' =>$filter_lecturer->lecturer_id]);
			}else{
				$check = AssignLecturer::create(['code'=>$code , 'academic_year'=>$academic_yr , 'lecturer_id' =>$filter_lecturer->lecturer_id]);
			}
		}else{
			$check = AssignLecturer::create(['code'=>$code , 'academic_year'=>$academic_yr , 'lecturer_id' =>$filter_lecturer->lecturer_id]);
		}
	  	if ($check=='0'){	 
		  $response_str1 = "1";
		  return $response_str1;
	   	} else {
		  $response_str2 = "2";
		  return $response_str2;			
	   	}
	}


	public function postCoreElective($course=NULL)
	{

	
			//$choice_1				= Input::get('c1');
		//	$input = Input::all();
		
			$choice_2 				= Input::get('c2');
		
			$choice_3 				= Input::get('c3');

			$choice_4 				= Input::get('c4');
			
		//	$senate 			= Input::get('meeting');   

				//	$input = Input::all();

		
	
			  $dept=CourseUnit::where('code','=',$course)->first();

			  $check = CoreElective::create(['department_id'=>$dept->department_id , 'choice_1'=>$course , 'choice_2' =>$choice_2 ]);
		//}
			 // if((input::has('c3')) && (input::has('c4'))){
			  	if($choice_3 && $choice_4){
			  		CoreElective::where('department_id','=',$dept->department_id )->where('choice_1','=',$course)->where('choice_2','=',$choice_2)->update(['choice_3'=>$choice_3,'choice_4'=>$choice_4 ]);
			  	}

			  else if($choice_3){

			  		CoreElective::where('department_id','=',$dept->department_id )->where('choice_1','=',$course)->where('choice_2','=',$choice_2)->update(['choice_3'=>$choice_3 ]);
			  	}


			  if($check)
			  	return View::make('messages.success'); 
			}
	

    public function isCourseUnitExist($course)
    {
        return CourseUnit::where('code',$course)->exists();
    }
    
    public function isCourseUnitExistAjax($course)
    {
        return Response::json(['output'=>$this->isCourseUnitExist($course)]);
    }
    
    public function getCourseUnitsAutoComplete()
    {
        $stinput=Input::get("term");
        
        $result=array();
        
        $query=CourseUnit::select('code')->where('code','like',$stinput.'%')->get();
        
        foreach($query as $csunits)
        {
            $result[]=['id'=>$csunits->code,'value'=>$csunits->code];
        }
        
        return Response::json($result);
    }
}
