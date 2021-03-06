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

Route::get('/', function () {
    return view('welcome');
    //return view('admin.home.home');
});



Auth::routes(['register' => false]); //for register route off

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/user-registration', [
        'uses' => 'UserRegistrationController@showRegistrationForm',
        'as'   => 'user-registration'
    ]);

    
    Route::post('/user-registration', [
        'uses' => 'UserRegistrationController@userSave',
        'as'   => 'user-save'
    ]);


    Route::get('/user-list', [
        'uses' => 'UserRegistrationController@userList',
        'as'   => 'user-list'
    ]);
    
    Route::get('/user-profile/{userId}', [
        'uses' => 'UserRegistrationController@userProfile',
        'as'   => 'user-profile'
    ]);
    
    Route::get('/change-user-info/{id}', [
        'uses' => 'UserRegistrationController@changeUserInfo',
        'as'   => 'change-user-info'
    ]);
    
    // Route::post('/user_info_update/{id}','UserRegistrationController@userInfoUpdate')->name('user_info_update');
    Route::post('/user-info-update', [
        'uses' => 'UserRegistrationController@userInfoUpdate',
        'as'   => 'user-info-update'
    ]);
    
    Route::get('/change-user-avatar/{id}','UserRegistrationController@changeUserAvatar')->name('change-user-avatar');
    Route::post('/update-user-photo/{id}','UserRegistrationController@updateUserPhoto')->name('update-user-photo');
    
    Route::get('/change-user-password/{id}','UserRegistrationController@changeUserPassword')->name('change-user-password');
    Route::post('/user-password-update/{id}','UserRegistrationController@userPasswordUpdate')->name('user-password-update');
    

    //========================= General Section =================================
    Route::get('/add-header-footer','HomePageController@addHeaderFooterForm')->name('add-header-footer');
    Route::post('/header-footer-save','HomePageController@headerFooterSave')->name('header-footer-save');
    Route::get('/manage-header-footer/{id}','HomePageController@manageHeaderFooter')->name('manage-header-footer');
    Route::post('/header-footer-update/{id}','HomePageController@headerFooterUpdate')->name('header-footer-update');
    
    //========================= Slider Section ==================================
    Route::get('/add-slide','SliderController@addSlide')->name('add-slide');
    Route::post('/upload-slide','SliderController@uploadSlide')->name('upload-slide');
    Route::get('/manage-slide','SliderController@manageSlide')->name('manage-slide');
    Route::get('/slide-unpublished/{id}','SliderController@slideUnpublished')->name('slide-unpublished');
    Route::get('/slide-published/{id}','SliderController@slidePublished')->name('slide-published');
    Route::get('/slide-edit/{id}','SliderController@slideEdit')->name('slide-edit');
    Route::post('/update-slide/{id}','SliderController@updateSlide')->name('update-slide');
    Route::get('/slide-delete/{id}','SliderController@slideDelete')->name('slide-delete');
    
    //======================== Photo Gallery Section ============================
    Route::get('/photo-gallery','SliderController@photoGallery')->name('photo-gallery');

    //======================== School Management section ========================
    Route::get('/school/add','SchoolManagementController@addSchoolForm')->name('add-school');
    Route::post('/school/add','SchoolManagementController@schoolSave')->name('school-save');
    Route::get('/school/list','SchoolManagementController@schoolList')->name('school-list');
    Route::get('/school/unpublished/{id}','SchoolManagementController@schoolUnpublished')->name('school-unpublished');
    Route::get('/school/published/{id}','SchoolManagementController@schoolPublished')->name('school-published');
    Route::get('/school/edit/{id}','SchoolManagementController@schoolEditForm')->name('school-edit');
    Route::post('/school/update/{id}','SchoolManagementController@schoolUpdate')->name('school-update');
    Route::get('/school/delete/{id}','SchoolManagementController@schoolDelete')->name('school-delete');

    //======================== Class Management section =========================
    Route::get('/class/add','ClassManagementController@addClassForm')->name('add-class');
    Route::post('/class/add','ClassManagementController@classSave')->name('class-save');
    Route::get('/class/list','ClassManagementController@classList')->name('class-list');
    Route::get('/class/unpublished/{id}','ClassManagementController@classUnpublished')->name('class-unpublished');
    Route::get('/class/published/{id}','ClassManagementController@classPublished')->name('class-published');
    Route::get('/class/edit/{id}','ClassManagementController@classEditForm')->name('class-edit');
    Route::post('/class/update/{id}','ClassManagementController@classUpdate')->name('class-update');
    Route::get('/class/delete/{id}','ClassManagementController@classDelete')->name('class-delete');

    //======================== Batch Management section =========================
    Route::get('/batch/add','BatchManagementController@addBatchForm')->name('add-batch');
    Route::get('class-wise-student-type','BatchManagementController@classWiseStudentType')->name('class-wise-student-type'); //Ajax cascading-dropdown
    Route::post('/batch/add','BatchManagementController@batchSave')->name('batch-save');
    Route::get('/batch/list','BatchManagementController@batchList')->name('batch-list');
    Route::get('/batch/list-by-ajax','BatchManagementController@batchListByAjax')->name('batch-list-by-ajax'); //Ajax for show batch list by cascading-dropdown
    Route::get('/batch/unpublished','BatchManagementController@batchUnpublished')->name('batch-unpublished'); //Unpublished by Ajax
    Route::get('/batch/published','BatchManagementController@batchPublished')->name('batch-published'); //Published by Ajax
    Route::get('/batch/delete','BatchManagementController@batchDelete')->name('batch-delete'); //Delete by Ajax
    Route::get('/batch/edit/{id}','BatchManagementController@batchEdit')->name('batch-edit'); 
    Route::post('/batch/update/{id}','BatchManagementController@batchUpdate')->name('batch-update'); 

    //======================== Student Type Management section ==================
    Route::get('/student-type','StudentTypeController@index')->name('student-type');
    Route::post('/student-type-add','StudentTypeController@studentTypeAdd')->name('student-type-add'); //Create By Ajax
    Route::get('/student-type-list','StudentTypeController@studentTypeList')->name('student-type-list'); //Read By Ajax
    Route::get('/student-type-unpublish','StudentTypeController@studentTypeUnpublish')->name('student-type-unpublish'); //unpublish By Ajax
    Route::get('/student-type-publish','StudentTypeController@studentTypePublish')->name('student-type-publish'); //publish By Ajax
    Route::post('/student-type-update','StudentTypeController@studentTypeUpdate')->name('student-type-update'); //update By Ajax
    Route::get('/student-type-delete','StudentTypeController@studentTypeDelete')->name('student-type-delete'); //delete By Ajax

    //======================== Student Registration Section =====================
    Route::get('/student-registration-form','StudentController@studentRegistrationForm')->name('student-registration-form');
    Route::get('/birng-student-type','StudentController@birngStudentType')->name('birng-student-type'); // By Ajax
    Route::get('/batch-roll-form','StudentController@batchRollForm')->name('batch-roll-form'); // By Ajax
    Route::post('/student/registration-form','StudentController@studentSave')->name('student-reg-save'); 
    //All Running Student List
    Route::get('/student/all-running-student-list','StudentController@allRunningStudentList')->name('all-running-student-list'); 
    //Class Wise Student Section
    Route::get('/student/class-selection-form','StudentController@classSelectionForm')->name('class-selection-form'); 
    Route::get('/student/class-student-type','StudentController@classStudentType')->name('class-student-type');  //Ajax
    Route::get('/student/class-and-type-wise-student','StudentController@classAndTypeWiseStudent')->name('class-and-type-wise-student'); 
    Route::get('/student/student-details/{id}','StudentController@studentDetails')->name('student-details'); 
    Route::post('/student/student-basic-info-update','StudentController@studentBasicInfoUpdate')->name('student-basic-info-update');
    //Batch Wise Student Section
    Route::get('/student/batch-selection-form','StudentController@batchSelectionForm')->name('batch-selection-form'); 
    Route::get('/student/class-and-type-wise-batch-list','StudentController@classAndTypeWiseBatchList')->name('class-and-type-wise-batch-list'); //Ajax
    Route::get('/student/batch-wise-student-list','StudentController@batchWiseStudentList')->name('batch-wise-student-list'); //Ajax

    //======================== Date Management Section ==========================
    Route::get('/date/add-year','DateManagementController@addYear')->name('add-year'); 

    
    //======================== Student Attendance Section =====================
    Route::get('/attendance/add-attendance','StudentAttendanceController@batchSelectionFormForAttendanceAdd')->name('add-attendance');
    Route::get('/attendance/batch-wise-student-list-for-attendance','StudentAttendanceController@batchWiseStudentListForAttendance')->name('batch-wise-student-list-for-attendance'); //Ajax
    Route::post('/attendance/save-student-attendance','StudentAttendanceController@saveStudentAttendance')->name('save-student-attendance'); 
    //view
    Route::get('/attendance/view-attendance','StudentAttendanceController@viewAttendance')->name('view-attendance'); 
    Route::get('/attendance/batch-wise-student-list-attendance-view','StudentAttendanceController@batchWiseStudentListAttendanceView')->name('batch-wise-student-list-attendance-view'); //Ajax
    //Edit
    Route::get('/attendance/edit-attendance','StudentAttendanceController@editAttendance')->name('edit-attendance');
    Route::get('/attendance/batch-wise-student-list-for-attendance-edit','StudentAttendanceController@batchWiseStudentListForAttendanceEdit')->name('batch-wise-student-list-for-attendance-edit'); //Ajax || //in video- "student-list-for-attendance-edit"
    Route::post('/attendance/student-attendance-update','StudentAttendanceController@studentAttendanceUpdate')->name('student-attendance-update'); //Ajax

});


