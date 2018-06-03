<?php

class TimeTable extends \Eloquent {

	protected $fillable=["cat_com_id","start_time","wk_day","duration"];
	public $timestamps=false;
	protected $table="course_timetable";

	public static function getCoursesByDayofWeek($wkday)
	{
		$semester=Semester::where('status',1)->first();
		$courseUnits=CourseUnit::where('department_id',1)->where('semester',$semester->semester_id)->get();

		
		
		return $courseUnits;
	}

	
}
