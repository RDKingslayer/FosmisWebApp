<?php

class Stream extends \Eloquent {

    protected $fillable = ['stream_id','degree_id','stream_name'];
    public $timestamps =false;
    protected $table = "stream";
}