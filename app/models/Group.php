<?php

class Group extends \Eloquent {

	protected $fillable = ['student_id','course_code','group_id','academic_year'];
	public $timestamps =false;
	protected $table = "groups";
}