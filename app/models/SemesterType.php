<?php

class SemesterType extends \Eloquent {

	protected $fillable = ['semester_type_id','semester_name'];
	public $timestamps =false;
	protected $table = "semester_type";
}