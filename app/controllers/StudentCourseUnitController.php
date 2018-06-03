<?php
/* 	
course status table
	status 0= not available
	status 1= available
offering availability table
	status 0 = not offered
	status 1 =offered
*/
class StudentCourseUnitController extends BaseController {


	public function ViewCourseUnit()
	{
		$id=Auth::user()->user;

		$today = date('Y-m-d');
		$academicyear = AcademicYear::where('current1','=','1')->get()->first()->academic_year_id;
		//$startdate = $row1->starting_date;
		//$enddate = $row1->ending_date;
		
		$row2 = Student::where('student_id','=',substr($id, 2))->get()->first();
		$degreeid = $row2->degree_id;
		//$streamid = $row2->stream_id;
		$combinationid = $row2->combination_id;
		//$batchid = $row2->current_batch;

//		$level = Batch::where('batch_id','=',$batchid)->where('academic_year_id','=',$academicyear)->get()->first()->level_id;
		$semester = Semester::where('academic_year_id','=',$academicyear)->whereDate('start_date','<=',$today)->whereDate('end_date','>=',$today)->get()->first();

		if ($degreeid == "G1") {
			
			$row3 = TargetGroup::where('target_pathways','=',$combinationid);
			/*$sub1 = $row3->subject_id1;
			$sub2 = $row3->subject_id2;
			$sub3 = $row3->subject_id3;*/
		}
		
		
		/*$acyear = AcademicYear::whereDate('starting_date','!=', $today);
		echo $acyear;*/
		return View::make('course_units.student_course_registration')->with('id', $degreeid);
		
	}
	
	public function RegisterCourseUnit()
	{
		/*
		$tot_credit=0;
		$tot=0;	
		$id=Auth::user()->user;
		$s= substr($id, 2); 
		$b = AcademicYear::where('current1','=',1)->first();
		$semester=Semester::where('status','=',1)->where('degree_id','=','G1')->first();

		//$code	= Input::get('att');
	//	$code2 	= Input::get('op_code');
		//$cancel=Input::get('cancel');
		//$x=$myArray[0];
		$x=Input::get('att');
		//$y=Input::get($x);

		$myArray=explode(",",$_POST['hiddenCode']);	
	 $myArrayR=explode(",",$_POST['hiddenDegree']);
	$inputs = Input::get();


	if(isset($cancel)){
		
			
			$update =CourseRegistration::where('code','=',$code2)->where('student_id','=',$s)->delete();
		
		}else{

	 for ($index = 0 ; $index < count($x); $index ++) {
	 
	//echo $x[$index];
		$f= $x[$index];
	   $y=Input::get($f);
	   if($y=="Non Degree")
				    $d=0;
	   else 
		  $d=1;

	 
	
 			
        $update =CourseRegistration::create(['student_id'=>$s,'code'=>$x[$index],'degree_status'=>$d,'semester_id'=>$semester->semester_id,'academic_year_id'=>$b->academic_year_id]);
	 //	$av_o=CourseRegistration::where('code','=',$x[$index])->where('degree_status'->1)->first();

        if($update)
 		     return View::make('messages.successs');
 	

	 	$cred=CourseUnit::where('code','=',$x[$index])->first();
	 

				
					if($cred->code!="ICT2b13")
					if($cred->code!="ICT1b13")
					if($cred->code!="MAT1142"){
					$credit= $cred->credits;
				
					$tot=$tot+$credit;
					}


 } 

        $av_op=CourseRegistration::where('student_id','=',$s)->where('degree_status','=',1)->get();
        foreach($av_op as $av_op) {
            $cred=CourseUnit::where('code','=',$av_op->code)->get();
            foreach($cred as $cred) {

				
					if($cred->code!="ICT2b13")
					if($cred->code!="ICT1b13")
					if($cred->code!="MAT1142"){
					$credit= $cred->credits;
				
					$tot_credit=$tot_credit+$credit;
					}		
}



}
//else{
        $t=$tot+$tot_credit;
        echo $t;
		
	   }
		//if($update){
		*/	
				return View::make('course_units.student_course_registration')->with('id', $id);
}	
			
		
				
	
	public function DeleteCourseUnit()
	{

		$id=Auth::user()->user;
			//return "sdddc";
			
			$code2 				= Input::get('op_code');
			
			$delete =CourseRegistration::where('code','=',$code2)->where('student_id','=',$id)->delete();
			
			if($delete){
				return View::make('course_units.student_course_registration')->with('id', $id);
			}
		
		

			
	}
	
	public function EnglishCourseUnit()
	{

		$id=Auth::user()->user;
			//return "sdddc";
			
			$code2 				= Input::get('e_code');
			$reg 		= Input::get('btn3');
			
			//if($degree_status=='Degree'){
				//$deg=1;
			//}else{
				//$deg=0;
			//}
			if(isset($reg)){
			$update_eng =CourseRegistration::create(['student_id'=>$id,'code'=>$code2,'degree_status'=>1]);
			
			}else{
				$update_eng =CourseRegistration::where('code','=',$code2)->where('student_id','=',$id)->delete();
			}
			if($update_eng){
				return View::make('course_units.student_course_registration')->with('id', $id);
			}

		
		

			
	}
	public function CLCCourseUnit()
	{

		$id=Auth::user()->user;
			//return "sdddc";
			
			$code3 				= Input::get('clc_code');
			
			$reg 				= Input::get('btn5');
			
			
			
			if(isset($reg)){
			$update_clc =CourseRegistration::create(['student_id'=>$id,'code'=>$code3,'degree_status'=>1]);
			}else{
			$update_clc =CourseRegistration::where('code','=',$code3)->where('student_id','=',$id)->delete();
			}
			
			if($update_clc){
				return View::make('course_units.student_course_registration')->with('id', $id);
			}

		
		

			
	}


	public function viewAttendence()
	{

		$id=Auth::user()->user;
			//return "sdddc";
			return View::make('course_units.view_attendence')->with('id', $id);

		
		

			
	}

	public function regElective()
	{

			$id=Auth::user()->user;

			$s= substr($id, 2); 
		$b = AcademicYear::where('current1','=',1)->first();
		$semester=Semester::where('status','=',1)->where('degree_id','=','G1')->first();

            $update=0;
			for($i=1;$i<5;$i++){
                
    
				if(Input::get($i)){
				    $a=Input::get($i);
				    $update =CourseRegistration::create(['student_id'=>$s,'code'=>$a,'degree_status'=>1,'semester_id'=>$semester->semester_id,'academic_year_id'=>$b->academic_year_id,'confirm'=>1]);

				

			     }
			

			}
        
		if($update)
        {
            return View::make('course_units.student_course_registration')->with('id', $id);
        }
        else
        {
            return Input::get(0);
        }
		
		

			
	}
    
    
    public function getStudentByLevelAccYearAjax($accyear=null,$level=null)
    {
        $stinput=Input::get("term");
        
        $result=array();
        
        if(($accyear!=null) && ($level!=null))
        {
            $query=Student::select('student.student_id')
            ->join("batch","student.current_batch","=","batch.batch_id")
            ->where("batch.academic_year_id","=",$accyear)
            ->where("batch.level_id",$level)
            ->where('student.student_id','like',$stinput.'%')->get();
        }
        else
        {
            $query=Student::select('student.student_id')->where('student.student_id','like',$stinput.'%')->get();
        }
        
        
        foreach($query as $stu)
        {
            $result[]=['id'=>$stu->student_id,'value'=>$stu->student_id];
        }
        
        
        
        return Response::json($result);
    }

	
	

}
?>