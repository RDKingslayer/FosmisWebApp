<?php

class Lecturer extends \Eloquent {

	protected $fillable = ['lecturer_id','user_name','title','lname','initials','designation','department_id','email','internal_no','residence','mobile'];
	public $timestamps =false;
	protected $table = "lecturer";
}