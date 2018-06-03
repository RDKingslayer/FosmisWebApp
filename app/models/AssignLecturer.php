<?php

class AssignLecturer extends \Eloquent {

	protected $fillable = ['lecturer_id','code','academic_year'];
	public $timestamps =false;
	protected $table = "assign_lecturer";
}