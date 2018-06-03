<?php

class Batch extends \Eloquent {

	protected $fillable = ['batch_id','level_id','academic_year_id'];
	public $timestamps =false;
	protected $table = "batch";
}