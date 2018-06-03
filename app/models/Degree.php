<?php

class Degree extends \Eloquent {

	protected $fillable = ['Degree_id','Degree_name','department_id','min_credits','max_credits','fsc_credits','academic_year'];
	public $timestamps =false;
	protected $table = "degree";
}
