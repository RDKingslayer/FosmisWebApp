<?php

class Department extends \Eloquent {

	protected $fillable = ['dept_id','dept_name'];
	public $timestamps =false;
	protected $table = "department";
    protected $primaryKey="dept_id";
}