<?php

class Combination extends \Eloquent {

	protected $fillable = ['combination_id','description'];
	public $timestamps =false;
	protected $table = "combination";
}