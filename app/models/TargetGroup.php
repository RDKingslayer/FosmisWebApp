<?php

class TargetGroup extends \Eloquent {

	protected $fillable = ['id','code','target_pathways','degree_id','course_status','academic_year'];
	public $timestamps =false;
	protected $table = "target_group";
}