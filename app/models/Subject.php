<?php

class Subject extends \Eloquent {

	protected $fillable = ['subject_id','subject_name'];
	public $timestamps =false;
	protected $table = "subject";
}