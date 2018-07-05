<?php
	class CombinationController extends BaseController {
		
		
		public function CallCombination()
		{
			$current_year=$academic_yr = AcademicYear:: where('current1','=',1)->first();
			return View::make('combination.call_combination')->with('current_year',$current_year);
		}

        /*public function CallStudentCourseRegistrationcheck()
        {
            $today = date('Y-m-d');
            $acadamic_year_id= AcademicYear:: where('current1','=',1)->first();
            $true= AcademicYear:: where('academic_year_id','=', $acadamic_year_id)->whereDate('start_date','<=',$today)->whereDate('end_date','>=',$today)->count('batch');
            return View::make('student.combination_registration')->with('true',$true);
        }*/

        public function CheckRegistration()
        {
            $i=Auth::user()->user;
            $today = date('Y-m-d');
            $b = CombinationSubmits::where('student_id','=',$i)->first();
            $batch = Student::where('student_id','=',$i)->first();
            $acadamic_year= AcademicYear:: where('current1','=',1)->first();
            $true= CallCombinationRegistration:: where('academic_year_id','=', $acadamic_year->academic_year_id)->where('batch','=',$batch->current_batch)->whereDate('start_date','<=',$today)->whereDate('end_date','>=',$today)->count('batch');

            $ps_subject_table=Subject::where('physical_science','=','1')->get();
            $bs_subject_table=Subject::where('bio_science','=','1')->get();

            if($true>0) {
                if (count($b) == 0) {
                    return View::make('student.combination_registration')->with('ps_subject_table',$ps_subject_table)->with('bs_subject_table',$bs_subject_table);;
                } else {
                    $ch1 = combination::where('combination_id', '=', $b->choice_1)->first();
                    $ch2 = combination::where('combination_id', '=', $b->choice_2)->first();

                    return View::make('student.registered_combination')->with('ch1', $ch1)->with('ch2', $ch2)->with('ps_subject_table',$ps_subject_table)->with('bs_subject_table',$bs_subject_table);;
                }
            }
            else{
                return View::make('student.registration_close');
            }
        }

        public function EditCombinationRegistration()
        {
            $i=Auth::user()->user;

            $ps_subject_table=Subject::where('physical_science','=','1')->get();
            $bs_subject_table=Subject::where('bio_science','=','1')->get();

            $b = CombinationSubmits::where('student_id','=',$i)->delete();

            return View::make('student.combination_registration')->with('ps_subject_table',$ps_subject_table)->with('bs_subject_table',$bs_subject_table);;
        }
        public function CallStudentCourseRegistration()
        {
            return View::make('student.combination_registration');
        }

        /*Student combination registration*/
        public function SubmitStudentCourseRegistration()
        {
            $inputs=Input::all();
            $rules=array(
                'choice_1' => 'required',
                'choice_2' => 'required',
            );

            $validation = Validator::make($inputs,$rules);

            if($validation->fails())
            {

//                   $messages = $validation->messages();
//                   Session::put('validate',$messages);

                return Redirect::back()->withInput()
                    ->withErrors($validation);


            }else{
                $choice_1= Input::get('choice_1');
                $choice_2= Input::get('choice_2');

                if ( $choice_1=='0' || $choice_2=='0')
                {
                    Session::put('CombinationErrorMessage1',"Combinations not selected!");
                    return Redirect::back()->withInput();
                }
                elseif($choice_1==$choice_2)
                {
                    Session::put('CombinationErrorMessage1',"Cannot select the same combination for both choices!");
                    return Redirect::back()->withInput();
                }
                else
                {

                   // CombinationSubmits::where('student_id','=',$i)->update(['choice_1' => $choice_1, 'choice_2' => $choice_2,]);
                  CombinationSubmits::create(array(

                        'student_id' => Input::get('student_id'),
                        'choice_1' => $choice_1,
                        'choice_2' => $choice_2,
                    ));
                    //Session::put('message',"uploaded successfully!");
                    return Redirect::route('show_registered_combination');
                }

            }
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