<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "Main\\MainController@index");
Route::get('/home', "Main\\MainController@index");
Route::get('/login', 'Main\\MainController@login');
Route::post('/login-validation', 'Main\\MainController@loginValidation');
Route::post('/redirect', 'Main\\MainController@redirect');


/* all this route to student*/
Route::get('/students/show', 'Student\\StudentController@showAll');
Route::get('/students/search', 'Student\\StudentController@search');
Route::get('/student/info-{id}', 'Student\\StudentController@info');
Route::post('/student/update', 'Student\\StudentController@update');
Route::get('/student/create/{accountType}', 'Student\\StudentController@create');
Route::post('/student/create/validation', 'Student\\StudentController@createValidation');
Route::post('/student/delete', 'Student\\StudentController@delete');
Route::get('/student/change-password/{id}', 'Student\\StudentController@changePassword');
Route::post('/student/change-password/validation', 'Student\\StudentController@changePasswordValidation');
Route::post('/mail/verification-email','Mail\\MailController@verificationEmail');
Route::get('/mail/send','Mail\\MailController@sendMessage');
Route::post('/student/convert-type', 'Student\\StudentController@convertStudentType');
Route::get('/student/convert-listener-to-student', 'Student\\StudentController@convertListenerToStudent');
Route::post('/student/convert-listener-to-student/Validation', 'Student\\StudentController@convertListenerToStudentValidation');

Route::get('/student/print-info','Student\\StudentController@print');

Route::get('/logout', function () {
    session_destroy();
    return redirect('/');
});


/***********************************************************************************************************/
Route::get('/courses/show', 'Course\\CourseController@showAll');
Route::post('/courses/search', 'Course\\CourseController@search');
Route::get('/course/create', 'Course\\CourseController@create');
Route::post('/course/create/validation', 'Course\\CourseController@createValidation');
Route::get('/courses/groups' , 'Course\\CourseController@showCoursesGroupByLevel');
Route::get('/course/info-{id}', 'Course\\CourseController@info');
Route::post('/course/update', 'Course\\CourseController@update');
Route::post('/course/delete', 'Course\\CourseController@delete');
/***********************************************************************************************************/
Route::get('/{courseID}/lessons', 'Lesson\\LessonController@showLessons');
Route::post('/lessons/search', 'Lesson\\LessonController@search');
Route::get('/lesson/info-{id}', 'Lesson\\LessonController@info');
Route::post('/lesson/update', 'Lesson\\LessonController@update');
Route::get('/lesson/create', 'Lesson\\LessonController@create');
Route::post('/lesson/create/validation', 'Lesson\\LessonController@createValidation');
Route::post('/lesson/delete', 'Lesson\\LessonController@delete');
/***********************************************************************************************************/
Route::get('/e-exam/add-question/{lessonID}', 'EExam\\EExamController@addQuestion');
Route::post('/e-exam/add-question/validation', 'EExam\\EExamController@questionValidation');
Route::post('/e-exam/question/delete', 'EExam\\EExamController@delete');
/***********************************************************************************************************/
Route::get('/lecturers/show', 'Lecturer\\LecturerController@showAll');
Route::post('/lecturers/search', 'Lecturer\\LecturerController@search');
Route::get('/lecturer/info-{id}', 'Lecturer\\LecturerController@info');

Route::get('/lecturer/create', 'Lecturer\\LecturerController@create');
/***********************************************************************************************************/
/***********************************************************************************************************/
Route::get('/timetable/show', 'TimeTable\\TimeTableController@show');
Route::post('/timetable/{text}/show', 'TimeTable\\TimeTableController@timeTable');
Route::post('/timetable/search', 'TimeTable\\TimeTableController@search');
Route::get('/timetable/levels', 'TimeTable\\TimeTableController@timetableForEachLevels');
Route::get('/timetable/add-lesson/{text}/{group}', 'TimeTable\\TimeTableController@addLessonToTimetable');
Route::post('/timetable/add-lesson-validate', 'TimeTable\\TimeTableController@addLessonValidation');
/***********************************************************************************************************/