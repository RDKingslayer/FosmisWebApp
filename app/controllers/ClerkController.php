
<?php



Use Illuminate\Http\Request;
//Use App\models\Student;
Use Illuminate\Support\Facades\Input;


//use Illuminate\Support\Facades\Redirect;

class ClerkController extends BaseController {


    public function SearchStudents(){

        $studentscombination = CombinationSubmits::join('student', 'combination_submits.student_id', '=', 'student.student_id')->get();
        return View::make('clerk.searchStudents' ,['students_combination' => null])->with('comb', 'NOT SELECTED');

    }

    public function assignToStudents()
    {
        $checkbox = Input::get('checkbox');
        $comb =  Input::get('comb');

        for($i=0; $i<count($checkbox); $i++)
        {
            Student::where('student_id','=',$checkbox[$i])->update(array('combination_id' => $comb));
            CombinationSubmits::where('student_id','=',$checkbox[$i])->delete();
        }

        return Redirect::route('search_students1')->with('comb', 'PS1');
    }

//phy choices
    public function SearchPS1(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'PS1'])
            ->orWhere(['choice_2'=> 'PS1'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'PS1');
    }


    public function SearchPS2(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'PS2'])
            ->orWhere(['choice_2'=> 'PS2'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'PS2');

    }

    public function SearchPS3(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'PS3'])
            ->orWhere(['choice_2'=> 'PS3'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'PS3');
    }

    public function SearchPS4(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'PS4'])
            ->orWhere(['choice_2'=> 'PS4'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'PS4');
    }

    public function SearchPS5(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'PS5'])
            ->orWhere(['choice_2'=> 'PS5'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'PS5');
    }

    public function SearchPS6(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'PS6'])
            ->orWhere(['choice_2'=> 'PS6'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'PS6');
    }


    public function SearchPS7(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'PS7'])
            ->orWhere(['choice_2'=> 'PS7'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'PS7');
    }

    public function SearchPS8(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'PS8'])
            ->orWhere(['choice_2'=> 'PS8'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'PS8');
    }

    //BIO Combinations


    public function SearchBS1(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'BS1'])
            ->orWhere(['choice_2'=> 'BS1'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'BS1');
    }

    public function SearchBS2(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'BS2'])
            ->orWhere(['choice_2'=> 'BS2'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'BS2');
    }

    public function SearchBS3(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'BS3'])
            ->orWhere(['choice_2'=> 'BS3'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'BS3');
    }

    public function SearchBS4(){



        $studentscombination = CombinationSubmits::rightjoin('student', 'combination_submits.student_id', '=', 'student.student_id')
            ->where(['choice_1'=> 'BS4'])
            ->orWhere(['choice_2'=> 'BS4'])


            ->paginate(10);
        return View::make('clerk.searchStudents' ,['students_combination' => $studentscombination])->with('comb', 'BS4');
    }


}