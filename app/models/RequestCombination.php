<?php

class RequestCombination extends \Eloquent {

	protected $fillable = ['student_id','combination_id','priority','academic_year_id'];
	public $timestamps =false;
	protected $table = "request_combination";
}