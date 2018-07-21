<?php

class AccountController extends BaseController {


    public function postSign(){

		$Validator = Validator::make(Input::all(), array(
			'Username' 	=>  'required|max:15',
			'Password' 	=>  'required|min:6'
		));

		$fosmis = User:: where('user',input::get('Username'));

			if($Validator->fails()){
				return Redirect::route('home')
				->withErrors($Validator)
				->withInput();
			}
			elseif($fosmis->count()==0){
			return Redirect::route('home')->with('message', "username or password incorrect.");
			}
			else{

				$auth = Auth::attempt(array(
				'user' 	=> Input::get('Username'),
				'password' 	=> Input::get('Password')
				));

				if($auth){
					return Redirect::route('home'); 
				}
				else
				{
					return Redirect::route('home')->with('message',"Password incorrect");
				}
			}
	}

	public function getDashboard(){
		if(Auth::check()){
			if(Auth::user()->role == 'admin'){
				return View::make('admin.register_students'); 
			}

			elseif(Auth::user()->Role->role  == 'CAA')
			{
				//return View::make('account.data_entry_op'); 
                return Redirect::action("AttendanceController@daily_attendance");

			}
			elseif(Auth::user()->Role->role  == 'student')
			{
				return View::make('account.student'); 

			}
            elseif(Auth::user()->Role->role  == 'HOD')
            {
                return Redirect::route('register_new_course');
            }
            elseif(Auth::user()->Role->role  == 'C')
            {
               return Redirect::route('search_students1');
            }

            elseif(Auth::user()->role  == 'systemadmin')
            {
                return View::make('account.system_admin');
            }
            
		}
		else
			return View::make('login');

	}

	public function signOut(){
			Auth::logout();
			return Redirect::route('home');
	}


}

