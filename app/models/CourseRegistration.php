<?php

class CourseRegistration extends \Eloquent{

	protected $fillable = ['student_id','code','semester_id','academic_year_id','degree_status','confirm'];
	public $timestamps =false;
	protected $table = "course_registration";
}