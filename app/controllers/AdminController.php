
<?php

Use Illuminate\Http\Request;
//Use App\models\Student;
Use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Validator;

//use Illuminate\Support\Facades\Redirect;

class AdminController extends BaseController {

	public function GetAcademicYear($current_year = NULL)
	{
		$current_year=AcademicYear::where('academic_year_id',$current_year)->first();	
		return View::make('admin.academic_year')->with('current_year',$current_year);
	}

	public function PostAcademicYear($current_year = NULL)
	{
			
		$Validator = Validator::make(Input::all(), array(
			'academic_year'			=>	'required',
			'start_date'			=>	'required',
			'end_date'				=>	'required'

			));

		if($Validator->fails()){
				return Redirect::route('academic_year')
					->withErrors($Validator)
					->withInput();
		}else{
			$academic_year 			= Input::get('academic_year');
			$start_date 			= Input::get('start_date');
			$end_date 				= Input::get('end_date');

			if($current_year)
			{	
				$academic_year =AcademicYear::where('academic_year_id',$current_year)->update(['starting_date'=>$start_date, 'ending_date'=>$end_date]);	
			}
			else
			{
				//deactivate current academic year
				AcademicYear::where('current1',1)->update(['current1'=>0]);
				//deactivate current semester
				Semester::where('status',1)->update(['status'=>0]);	
				$academic_year =AcademicYear::create(['academic_year_id'=>$academic_year , 'starting_date'=>$start_date, 'ending_date'=>$end_date, 'current1'=>1]);
			}
				if($academic_year)
				{
					return View::make('admin.academic_year'); 
				}
		}
	}

	public function DefineSemester()
	{
		$Validator = Validator::make(Input::all(), array(
			'semester'				=>	'required',
			'sem_start_date'		=>	'required',
			'sem_end_date'			=>	'required',
			'degree'				=>	'required'

			));

		if($Validator->fails()){
				return Redirect::route('academic_year')
					->withErrors($Validator)
					->withInput();
		}else{
			$semester 			= Input::get('semester');
			$sem_start_date 	= Input::get('sem_start_date');
			$sem_end_date		= Input::get('sem_end_date');
			$degree_name		= Input::get('degree');
			$level				= Input::get('level');



			foreach($level as $level)
				{
					$degree_id=Degree::where('Degree_name',$degree_name)->first()->Degree_id;
					$academic_yr = AcademicYear:: where('current1','=',1)->first()->academic_year_id;

					$semester_details =Semester::create(['semester_id'=>$semester , 'academic_year_id'=>$academic_yr, 'degree_id'=>$degree_id, 'level_id'=>$level, 'start_date'=>$sem_start_date,'end_date'=>$sem_end_date,'status'=>1]);		
				}

			if($semester_details)
			{
				return View::make('admin.academic_year');
			}
		}		
	}
	
	public function CheckSemester()
	{
		$new_name = $_POST['level'];
		echo $new_name;

	}
	public function UpdateSemester()
	{
		return View::make('admin.update_semester');

	}

	public function RegisterStudents()
	{
		return View::make('admin.register_students');
	}

	// A Function to Convert a CSV file into an Array
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function ParseCsv()
    {
        //Get the older values of the table before execute the function
        $table1 = Student::orderBy('student_id', 'desc')->take(10)->get();

        $path = Input::file('csv_file')->getRealPath();
        $myArray = $this->csvToArray($path);

        if(count($myArray))
        {
            for ($i = 0; $i < count($myArray); $i++)
            {
                Student::firstOrCreate($myArray[$i]);
            }
        }

        // Create the table to show
        $table2 = Student::orderBy('student_id', 'desc')->take(10)->get();

        //Check whether both tables are same
        if($table1 == $table2){
            $added = false;
        }
        else{
            $added = true;
        }

        return View::make('admin.register_students')->with('table', $table2)->with('added', $added);
    }

    public function showTable(){

	    $table = Student::orderBy('student_id', 'desc')->paginate(10);
        return View::make('admin.register_students')->with('table', $table)->with('method', 2);
    }

    public function registerAStudent()
    {
        return view::make('admin.register_one_student');

    }

    public function registerOneStudent()
        {
           $inputs=Input::all();
                $rules=array(
                    's_no'                  =>'required',
                    'ssid'                  =>'required',
                    'course_of_study'       =>'required',
                    'index_number_al'       =>'required|numeric|min:4',
                    'student_id'            =>'unique:student,student_id',
                    'initials'              =>'required',
                    'last_name'             =>'required',
                    'name_in_full'          =>'required',
                    'email'                 =>'required|email',
                    //'dob'                   =>'required',
                    'gender'                =>'required',
                    'province'              =>'required',
                    'district'              =>'required',
                    'divisional_secretariat'=>'required',
                    'grama_niladari_division'=>'required',
                    'z_score'               =>'required',
                    'nic'                   =>'required',
                    'telephone_number_home' =>'required',
                    'selection_method'      =>'required',
                    'school'                =>'required',
                    'village'               =>'required',
                    //'al_batch'              =>'required|numeric|min:4',
                    //'current_batch'         =>'required|numeric|min:4',
                    //'status'                =>'required|numeric|min:1',
                    //'stream_id'             =>'required',
                    'date_of_registration'  =>'required'
                );

                $validation = Validator::make($inputs,$rules);



                if($validation->fails())
               {

//                   $messages = $validation->messages();
//                   Session::put('validate',$messages);

                   return Redirect::back()->withInput()
                       ->withErrors($validation);


                }else{


                Student::create(array(

                    's_no' => Input::get('s_no'),
                    'ssid' => Input::get('ssid'),
                    'course_of_study' => Input::get('course_of_study'),
                    'index_number_al' => Input::get('index_number_al'),
                    'temporary_number' => Input::get('temporary_number'),
                    'permanent_number' => Input::get('student_id'),
                    'student_id' => substr(Input::get('student_id'),8,5),
                    'initials' => Input::get('initials'),
                    'last_name' => Input::get('last_name'),
                    'name_in_full' => Input::get('name_in_full'),
                    //'dob' => Input::get('dob'),
                    'email' => Input::get('email'),
                    'permanent_address_line1' => Input::get('permanent_address_line1'),
                    'permanent_address_line2' => Input::get('permanent_address_line2'),
                    'permanent_address_line3' => Input::get('permanent_address_line3'),
                    'permanent_address_line4' => Input::get('permanent_address_line4'),
                    'gender' => Input::get('gender'),
                    'province' => Input::get('province'),
                    'district' => Input::get('district'),
                    'divisional_secretariat' => Input::get('divisional_secretariat'),
                    'grama_niladari_division' => Input::get('grama_niladari_division'),
                    'z_score' => Input::get('z_score'),
                    'nic' => Input::get('nic'),
                    'telephone_number_home' => Input::get('telephone_number_home'),
                    'selection_method' => Input::get('selection_method'),
                    'mother_name' => Input::get('mother_name'),
                    'mother_occupation' => Input::get('mother_occupation'),
                    'father_name' => Input::get('father_name'),
                    'father_occupation' => Input::get('father_occupation'),
                    'guardian_contact_no' => Input::get('guardian_contact_no'),
                    'informer_contact_no' => Input::get('informer_contact_no'),
                    'school' => Input::get('school'),
                    'village' => Input::get('village'),
                    'race' => Input::get('race'),
                    //'al_batch' => Input::get('al_batch'),
                    //'current_batch' => Input::get('current_batch'),
                    //'status' => Input::get('status'),
                    //'degree_id' => Input::get('degree_id'),
                    //'combination_id' => Input::get('combination_id'),
                    //'stream_id' => Input::get('stream_id'),
                    'date_of_registration'=>Input::get('date_of_registration')

                ));
                Session::put('message',"uploaded successfully!");
                    return Redirect::route('register_a_student');

            }


    }

    public function searchStudents()
    {
        $students = Student::all();
        return View::make('admin.searchStudents')->with('students',$students);
    }
}
