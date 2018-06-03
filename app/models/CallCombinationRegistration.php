<?php

class CallCombinationRegistration extends \Eloquent {

	protected $fillable = ['batch','start_date','end_date','academic_year_id','status'];
	public $timestamps =false;
	protected $table = "call_combination_registration";
}