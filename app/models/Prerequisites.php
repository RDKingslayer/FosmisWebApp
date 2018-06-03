<?php

class Prerequisites extends \Eloquent {

	protected $fillable = ['code','prerequisite_code'];
	public $timestamps =false;
	protected $table = "prerequisites";
}