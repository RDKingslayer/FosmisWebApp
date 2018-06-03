<?php

class AcademicYear extends \Eloquent {

	protected $fillable = ['academic_year_id','starting_date','ending_date','current1'];
	public $timestamps =false;
	protected $table = "academic_year";
	
}