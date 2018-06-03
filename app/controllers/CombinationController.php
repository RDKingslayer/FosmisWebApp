<?php
	class CombinationController extends BaseController {
		
		
		public function CallCombination()
		{
			$current_year=$academic_yr = AcademicYear:: where('current1','=',1)->first();
			return View::make('combination.call_combination')->with('current_year',$current_year);
		}

		public function PostCallCombination($current_year = NULL)
		{
			$current_year			= AcademicYear:: where('current1','=',1)->first();
			$start_date 			= Input::get('start_date');
			$end_date 				= Input::get('end_date');
			$status					= '1';
			$batch					= Input::get('batch');
			$academic_year_id		= Input::get('ac_yr');
			
			$combination_registration = CallCombinationRegistration::where(['batch'=>$batch,'academic_year_id'=>$academic_year_id]);
			if($combination_registration){
				if((Input::has('start_date')) && (Input::has('end_date'))) 
				{
					$combination_registration = CallCombinationRegistration::where(['batch'=>$batch, 'academic_year_id'=>$academic_year_id, 'status'=>$status])->update(['start_date'=>$start_date, 'end_date'=>$end_date]);
				}
			}else{
				$combination_registration = CallCombinationRegistration::create(['batch'=>$batch, 'start_date'=>$start_date, 'end_date'=>$end_date, 'academic_year_id'=>$academic_year_id, 'status'=>$status]);
			}
			//return View::make('combination.call_combination')->with('current_year',$current_year);
		}

		public function PostRequestCombination(){
			$student_id_academic 		= $_POST['student_id_academic'];
			$array						= explode("/", $student_id_academic);
			$student_id 				= $array[0];
			$combination_id 			= $_POST['combination_id'];
			$priority					= $_POST['priority'];
			$academic_year_id			= $array[1];

			$previous_registration = RequestCombination::where(['student_id'=>$student_id, 'priority'=>$priority,'academic_year_id'=>$academic_year_id])->first();
			if($previous_registration){
				return 1;
			}else{
				$combination_registration = RequestCombination::create(['student_id'=>$student_id, 'combination_id'=>$combination_id, 'priority'=>$priority, 'academic_year_id'=>$academic_year_id]);	
				return 2;
			}
		}

		public function EditCombinationPriority(){
			$student_id 		= $_POST['name'];
			$delete_request = RequestCombination::where('student_id', '=', $student_id)->delete();
			if(!$delete_request){
				return 1;
			}else{
				return 2;
			}
		}

	}
?>