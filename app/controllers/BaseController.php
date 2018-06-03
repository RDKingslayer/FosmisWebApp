<?php

class BaseController extends Controller {
public $academic_yr;
	 public function __construct()
	 {       
	    $academic_yr = AcademicYear:: where('current1','=',1)->first()->academic_year_id;    
	    View::share('academic_yr', $academic_yr); // Share $academic_yr with all views
	 }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
