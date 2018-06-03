<?php

class SubjectCombination extends \Eloquent {

	protected $fillable = ['combination_id','subject_id1','subject_id2','subject_id3'];
	public $timestamps =false;
	protected $table = "subject_combination";
}