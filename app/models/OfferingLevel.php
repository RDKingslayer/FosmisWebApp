<?php

class OfferingLevel extends \Eloquent {

	protected $fillable = ['code','offering_level_id','academic_year'];
	public $timestamps =false;
	protected $table = "offering_levels";
}