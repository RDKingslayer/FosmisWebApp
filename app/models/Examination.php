<?php

class Examination extends \Eloquent{
    
    protected $table="examination";
    protected $fillable=['exam_id','course_code','academic_year'];
    public $timestamps=false;
    protected $primaryKey="exam_id";
    
  
    public static function getExamCutoff($code,$type)
    {
        $current_year= AcademicYear:: where('current1','=',1)->first()->academic_year_id;
        $exam=Examination::where('course_code',$code)->where('type',$type)->where('academic_year',$current_year)->first();
        return $exam->cut_off;
    }
}