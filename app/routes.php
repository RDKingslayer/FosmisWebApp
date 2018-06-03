<?php

Route::get('/', array('as' => 'index','uses' => 'HomeController@index'));
Route::get('/', array('as' => 'home','uses' => 'AccountController@getDashboard'));

//---------------------- CSRF Protection ------------------------------------
Route::group(array('before' => 'CSRF'),function(){
Route::post('/',			array('as' =>'sign-in' ,'uses' => 'AccountController@postSign'));	
});

//Authenticated Group
Route::group(array('before' => 'auth' ),function(){

Route::get('sign-out',			array('as' => 'sign-out',		'uses' => 'AccountController@signOut'));

/****************  course units **************************/
//registre course units
Route::get('add-course-unit',	array('as'=>'add-course-unit', 'uses'=>'CourseUnitController@getCourseUnit'));
Route::post('add-course-unit',	array('as'=>'post-course-unit', 'uses'=>'CourseUnitController@postCourseUnit'));
Route::post('Prerequisites',	array('as'=>'Prerequisites', 'uses'=>'CourseUnitController@PrerequisitesCourse'));
Route::post('post-core-elective/{course?}',	array('as'=>'post-core-elective', 'uses'=>'CourseUnitController@postCoreElective'));
    
Route::post('student_course_elective',	array('as'=>'student_course_elective', 'uses'=>'StudentCourseUnitController@regElective'));
Route::post('student_course_registration',	array('as'=>'student_course_registration', 'uses'=>'StudentCourseUnitController@RegisterCourseUnit'));
//Route::post('student_course_registration2',	array('as'=>'student_course_registration2', 'uses'=>'StudentCourseUnitController@DegreeCourseUnit'));
Route::post('student_course_registration3',	array('as'=>'student_course_registration3', 'uses'=>'StudentCourseUnitController@CancelCourseUnit'));
Route::post('student_english_registration',	array('as'=>'student_english_registration', 'uses'=>'StudentCourseUnitController@EnglishCourseUnit'));
//Route::post('student_course_registration',	array('as'=>'delete_course_registration', 'uses'=>'StudentCourseUnitController@DeleteCourseUnit'));
Route::post('student_clc_registration',	array('as'=>'student_clc_registration', 'uses'=>'StudentCourseUnitController@CLCCourseUnit'));    
    
//view course units
Route::get('view-course-unit',	array('as'=>'view-course-unit', 'uses'=>'CourseUnitController@ViewCourseUnit'));
Route::get('student_course_registration',	array('as'=>'student_course_registration', 'uses'=>'StudentCourseUnitController@ViewCourseUnit'));
Route::get('view_attendence',	array('as'=>'view_attendence', 'uses'=>'StudentCourseUnitController@viewAttendence'));    

Route::get('assign-lecturer/{course_code?}',	array('as'=>'assign-lecturer', 'uses'=>'CourseUnitController@GetAssignLecturer'));

//offer course units
Route::get('offer-course-unit',	array('as'=>'offer-course-unit', 'uses'=>'CourseUnitController@OfferCourseUnit'));

//change availability
Route::post('change-availability/{course_code?}',	array('as'=>'post-change-availability', 'uses'=>'CourseUnitController@PostChangeAvailability'));

//change course units
Route::get('change-course-unit/{course_code?}',	array('as'=>'change-course-unit', 'uses'=>'CourseUnitController@getChangeCourseUnit'));
Route::post('change-course-unit',	array('as'=>'post-change-course-unit', 'uses'=>'CourseUnitController@postChangeCourseUnit'));
Route::post('NewTitle',	array('as'=>'NewTitle', 'uses'=>'CourseUnitController@NewTitleCourse'));

//change lecturer
Route::post('ChangeLecturer',	array('as'=>'ChangeLecturer', 'uses'=>'CourseUnitController@ChangeLecturerCourse'));

/***************** Administration *********************/
Route::get('academic_year/{current_year?}',	array('as'=>'academic_year', 'uses'=>'AdminController@GetAcademicYear'));
Route::post('academic_year/{current_year?}',	array('as'=>'post-academic-year', 'uses'=>'AdminController@PostAcademicYear'));
Route::post('semester',	array('as'=>'post-semester', 'uses'=>'AdminController@DefineSemester'));
//check semester 
Route::get('check-semester',	array('as'=>'check-semester', 'uses'=>'AdminController@CheckSemester'));
//update semester
Route::post('update-semester',	array('as'=>'update-semester', 'uses'=>'AdminController@UpdateSemester'));
//Student Registration
Route::get('register-students', array('as'=>'register-students', 'uses'=>'AdminController@RegisterStudents'));
//Parse CSV
Route::post('parse_csv', array('as'=>'parse_csv', 'uses'=>'AdminController@ParseCsv'));
//Register a student
    Route::get('register_a_student', array('as'=>'register_a_student', 'uses'=>'AdminController@registerAStudent'));

    Route::post('register_a_student', array('as'=>'register_a_student', 'uses'=>'AdminController@registerAStudent'));

    Route::get('register_only_one_student', array('as'=>'register_only_one_student', 'uses'=>'AdminController@registerOneStudent'));

    Route::post('register_only_one_student', array('as'=>'register_only_one_student', 'uses'=>'AdminController@registerOneStudent'));

Route::get('showTable', array('as'=>'showTable', 'uses'=>'AdminController@showTable'));
//Search students
    Route::get('search_students', array('as'=>'search_students', 'uses'=>'AdminController@searchStudents'));
    Route::post('search_students', array('as'=>'search_students', 'uses'=>'AdminController@searchStudents'));

/******************combination registration*******************************/
Route::get('call-combination/{current_year?}',	array('as'=>'call-combination', 'uses'=>'CombinationController@CallCombination'));
Route::post('edit_combination_priority',	array('as'=>'edit_combination_priority', 'uses'=>'CombinationController@EditCombinationPriority'));
Route::post('combination_priority',	array('as'=>'combination_priority', 'uses'=>'CombinationController@PostRequestCombination'));
Route::post('post-combination-registration}', array('as' =>'post-combination-registration' ,'uses'=>'CombinationController@PostCallCombination' ));


/******************attendance*******************/
Route::get('daily_attendance/{sub?}/{title?}/{cstype?}/{st_time?}/{duration?}',	array('as'=>'daily_attendance', 'uses'=>'AttendanceController@daily_attendance'));
Route::get('attendance_sheet/{sub?}/{cstype?}/{st_time?}/{duration?}',	array('as'=>'attendance_sheet', 'uses'=>'AttendanceController@attendance_sheet'));   
Route::get('edit_attendance',	array('as'=>'edit_attendance', 'uses'=>'AttendanceController@edit_attendance'));
Route::post('daily', array('as' =>'daily' ,'uses'=>'AttendanceController@daily' ));
Route::get('mark_attendance/{sub}/{title}',	array('as'=>'mark_attendance', 'uses'=>'AttendanceController@mark_attendance'));
Route::get('drafts',array('as'=>'drafts','uses'=>'AttendanceController@showMyDrafts'));
Route::get('attendance_search',array('as'=>'attendance_search','uses'=>'AttendanceController@searchAttendance'));
Route::post('attendance_search',array('as'=>'attendance_search','uses'=>'AttendanceController@postSearchAttendance'));    
Route::post('create-id/{sub}', array('as' =>'create_daily_attendance_id' ,'uses'=>'AttendanceController@daily_attendance_id_create' ));
Route::get('test',	array('as'=>'test', 'uses'=>'AttendanceController@get_course_code'));
Route::get('student_list/{sub}/{grp}/{seid}', array('as'=>'student_list','uses'=>'AttendanceController@getstudent_list'));
Route::get('print_attendance_sheet',array('as'=>'print_attendance_sheet','uses'=>'AttendanceController@printAttendanceSheet'));
//Route::get('manage_medicals',array('as'=>'manage_medicals','uses'=>'AttendanceController@add_medical_load'));
Route::get('manage_medicals',array('as'=>'manage_medicals','uses'=>'AttendanceController@add_medical_load'));
Route::post('manage_medicals',array('as'=>'manage_medicals','uses'=>'AttendanceController@add_medical_load_post'));    
Route::post('student_medical_study_sessions',array('as'=>'student_medical_study_sessions','uses'=>'AttendanceController@check_student_medical_status'));  
    
/*******************HOD*********************/
Route::get('register_new_course',array('as'=>'register_new_course','uses'=>'HodController@showNewCourseRegistration'));
Route::post('register_new_course',array('uses'=>'HodController@saveCourseUnit'));
    
Route::get('set_eligibility_cutoff',array('as'=>'set_eligibility_cutoff','uses'=>'HodController@showExamElibilityCutoff'));

Route::post('set_eligibility_cutoff',array('as'=>'set_eligibility_cutoff','uses'=>'HodController@postExamElibilityCutoff'));
    
Route::get('view_exam_eligibility',array('as'=>'view_exam_eligibility','uses'=>'HodController@viewExamEligibility'));    
    
    /************Ajax Functions***************/
Route::get('getStudentgroups',array('uses'=>'AttendanceController@getStudentGroups'));
Route::get('getCoursesBySemesterLevelandAccYear',array('uses'=>'AttendanceController@getCoursesBySemesterLevelandAccYearAjax'));
Route::get('getStartingAndEndingDates',array('uses'=>'AttendanceController@getStartingAndEndingDates')); 
Route::post('getTotalSemesterAttendance/{startDate}/{endDate}/{csUnit}/{stuno}/{cstype}',array('uses'=>'AttendanceController@getTotalSemesterAttendanceAjax'));
Route::get('getCourseUnitDetails/{csUnit}',array('uses'=>'AttendanceController@getCourseUnitDetailsAjax')); 
Route::get('getCourseUnitsDateLevel/{date}/{level}/',array('uses'=>'AttendanceController@getCourseUnitsDateLevelAjax')); 
Route::get('getStudySessionDetails/{date}/{level}/{code}',array('uses'=>'AttendanceController@getStudySessionDetailsAjax'));
Route::get('getStudentByLevelAccYear/{accyear?}/{level?}',array('uses'=>'StudentCourseUnitController@getStudentByLevelAccYearAjax'));
Route::get('isCourseUnitExist/{course}',array('uses'=>'CourseUnitController@isCourseUnitExistAjax'));
Route::get('getCourseUnitsAutoComplete',array('uses'=>'CourseUnitController@getCourseUnitsAutoComplete'));    

Route::get('remove-id', array('as'=>'remove_id','uses'=>'AttendanceController@remove_lecture_id'));



Route::post('sem_subjects',	array('as'=>'sem_subjects', 'uses'=>'AttendanceController@select_all_courses'));
Route::post('attendance_added/{sub}/{seid}',	array('as'=>'attendance_added', 'uses'=>'AttendanceController@attendance_added'));
Route::get('add_medical', array('as'=>'add_medical','uses'=>'AttendanceController@add_medical_load'));
Route::post('save_medicals',array('as'=>'save_medicals','uses'=>'AttendanceController@saveMedicals'));    

    
/*********************************************TimeTable**********************************************/    
Route::get('view_timetable',array('as'=>'view_timetable','uses'=>'TimeTableController@getTimetable'));
Route::get('show_timetable',array('as'=>'show_timetable','uses'=>'TimeTableController@showTimetable'));
    

Route::get('redirect', array('as'=>'redirect','uses'=>'AttendanceController@redirect'));


});
