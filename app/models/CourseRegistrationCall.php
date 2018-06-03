<?php

class CourseRegistrationCall extends \Eloquent {

	protected $fillable = ['semester_id','start_date','end_date','academic_year_id','status'];
	public $timestamps =false;
	protected $table = "course_registration_call";
	
}