<?php

class temp extends \Eloquent {

	protected $fillable = ['date','start_time','course_category','exp_no','hours','group'];
	public $timestamps =false;
	protected $table = "temp";
	
}