<?php
    
    class CourseUnitCutoff extends \Eloquent
    {
        protected $table="courseunit_cutoff";
        protected $fillable=['id','course_code','type','cut_off'];
        public $timestamps=false;
        protected $primaryKey="id";
        
        public static function getCourseUnitCutoff($code,$type)
        {
            
            $course_unit=CourseUnitCutoff::where('course_code',$code)->where('type',$type)->first();
            if($course_unit!=null)
            {
                return $course_unit->cut_off;
            }
            else
            {
                return 0;
            }
            
        }
    }

    