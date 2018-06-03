<?php

class Participation extends \Eloquent {

	protected $fillable = ['student_id','session_id','status'];
	public $timestamps =false;
	protected $table = "participation";
}
