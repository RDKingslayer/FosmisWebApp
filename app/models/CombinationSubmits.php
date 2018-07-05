<?php

class CombinationSubmits extends \Eloquent {

    protected $fillable = ['student_id','choice_1','choice_2'];
    public $timestamps =false;
    protected $table = "combination_submits";
}