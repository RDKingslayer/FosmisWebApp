<?php

class OfferingAvailability extends \Eloquent {

	protected $fillable = ['code','status','academic_year'];
	public $timestamps =false;
	protected $table = "offering_availability";
}