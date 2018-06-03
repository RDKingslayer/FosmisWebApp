<?php

class Semester extends \Eloquent {

	protected $fillable = ['semester_id','academic_year_id','degree_id','level_id','start_date','end_date','status'];
	public $timestamps =false;
	protected $table = "semester";
}