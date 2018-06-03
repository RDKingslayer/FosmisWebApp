<?php

class OfferingSemester extends \Eloquent {

	protected $fillable = ['code','offering_semester_id','academic_year'];
	public $timestamps =false;
	protected $table = "offering_semester";
}