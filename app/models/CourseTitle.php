<?php

class CourseTitle extends \Eloquent {

	protected $fillable = ['code','title','academic_year','senate_number','user_id','date'];
	public $timestamps =false;
	protected $table = "course_title";
}