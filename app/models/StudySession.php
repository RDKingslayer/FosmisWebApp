<?php

class StudySession extends \Eloquent {

	protected $fillable = ['session_id','course_code','date','duration','time','type','attendance_group','academic_year','marking_completed'];
	public $timestamps =false;
	protected $table = "study_session";
    protected $primaryKey="session_id";

	public static $errors;

	// ...... for validations.......

	public static $rules = [
		'date' => 'required',  
		'time' => 'required',
		'type' => 'required' ,
		
		'hour' => 'required' ,
		'group'=> 'required' 
	];


	
	// ...... method to validate form controls ........

	public static function isValid($data){

		$validation = Validator::make($data,static::$rules);

		if($validation->passes())
			return true;

		static::$errors = $validation->messages();

		return false;
	}
    
    
    
    public function Students($type=null)
    {
        if($type==null)
        {
            return $this->belongsToMany("Student","participation","session_id","student_id");
        }
        else if($type=="present")
        {
            return $this->belongsToMany("Student","participation","session_id","student_id")->where("participation.status",1)->get();
        }
            
    }
    
   




	
}
