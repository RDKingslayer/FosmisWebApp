<?php

class CourseTypes extends \Eloquent {

	protected $fillable = ['code','name','priority'];
	public $timestamps =false;
	protected $table = "course_types";
	protected $primaryKey="priority";
	

	public function courseUnits()
	{
		return $this->belongsToMany("CourseUnit","courseunit_category","course_type","course_code");
	}
}
