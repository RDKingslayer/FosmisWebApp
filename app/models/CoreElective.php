<?php

class CoreElective extends \Eloquent {

	protected $fillable = ['id','department_id','choice_1','choice_2','choice_3','choice_4'];
	public $timestamps =false;
	protected $table = "core_elective";
	
}