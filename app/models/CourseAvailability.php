<?php

class CourseAvailability extends \Eloquent {

	protected $fillable = ['code','status','academic_year'];
	public $timestamps =false;
	protected $table = "course_availability";
}