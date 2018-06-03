<?php

class Student extends \Eloquent {

	protected $fillable = ['s_no','ssid','course_of_study','index_number_al','temporary_number','permanent_number','student_id','initials','last_name','name_in_full','dob','email','permanent_address_line1','permanent_address_line2','permanent_address_line3','permanent_address_line4',
        'gender','province','district','divisional_secretariat','grama_niladari_division','z_score','nic','telephone_number_home','selection_method','mother_name','mother_occupation','father_name','father_occupation','guardian_contact_no','informer_contact_no','school','village','race',
            'al_batch','current_batch','status','degree_id','combination_id','stream_id','date_of_registration'];
	public $timestamps =false;
	protected $table = "student";
    protected $primaryKey="student_id";
    
    
   public function CourseUnits($acc_year=null,$semester=null)
   {
       if($acc_year!=null)
       {
           if($semseter!=null)
           {
               return $this->belongsToMany("CourseUnit","course_registration","student_id","code")->where("academic_year_id",$acc_year)->where("confirm",1)->where("semester_id",$semester)->get();
           }
           else
           {
               return $this->belongsToMany("CourseUnit","course_registration","student_id","code")->where('confirm',1)->where("academic_year_id",$acc_year)->get();
           }
            
       }
       else
       {
           return $this->belongsToMany("CourseUnit","course_registration","student_id","code");
       }
   }
}