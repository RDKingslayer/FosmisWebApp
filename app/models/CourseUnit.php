<?php

class CourseUnit extends \Eloquent {

	protected $fillable = ['code','credits','type','gpa_status','department_id','lecturer_id','level','semester','degree_id','introduce_year','previous_course_code','prerequistie'];
	public $timestamps =false;
	protected $table = "course_unit";
	protected $primaryKey="code";
	

	public function courseTypes()
	{
		return $this->belongsToMany("CourseTypes","courseunit_category","course_code","course_type");
	}

	public function courseTypesWithTime()
	{
		return $this->belongsToMany("CourseTypes","courseunit_category","course_code","course_type")
			->withPivot("cat_com_id")
			->join("course_timetable","courseunit_category.cat_com_id","=","course_timetable.cat_com_id")
			->select("course_types.name","course_timetable.start_time","course_timetable.wk_day","course_timetable.duration");
	}
    
    public function Title()
    {
        return $this->hasOne('CourseTitle','code','code');
    }
    
    public function Students($academic_year=null,$type=null,$attendanceGroup=null)
    {
        if($type!=null)
        {
            return Student::join('student_assignment','student.student_id','=','student_assignment.student_id')->join('courseunit_category','student_assignment.cat_com_id','=','courseunit_category.cat_com_id')->join('course_types','courseunit_category.course_type','=','course_types.priority')->where('courseunit_category.course_code',$this->code)->where('student_assignment.academic_year','=',$academic_year)->where('student_assignment.group_id',$attendanceGroup)->where('course_types.name',$type)->get();
        }
        else
        {
             return $this->belongsToMany("Student","course_registration","code","student_id")->where('academic_year_id','=',$academic_year)->get();
        }
       
    }
    
    
}
