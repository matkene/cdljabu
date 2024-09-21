<?php

use App\Models\Job;
use App\Models\Marital;
use App\Jobs\TranslateJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LgaController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\GraderController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MaritalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\CertgradeController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\BloodgroupController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {

    //return 'Done';
    //SQL
   //$job = DB::update("update employers SET updated_at =? WHERE id =? ", ['2024-04-18 15:05:20', 101]);
   // $job = DB::insert('insert into employers(name) values(?)',[]);
   //$job = DB::select("select * from employers");
   //$job = DB::delete('delete from employers where id=101');
   //Query Builder
   // $job = DB::table('employers')->where('id',34)->value('created_at'); //value gives  only that column while all
  //  $job = DB::table('employers')->orderBy('name')->get(); //value gives  only that column while all

    /*  $job = DB::table('employers')->insert([
        'name' => 'John Lewis'
   ]);
 */  
      /* $job = DB::table('employers')->where('id',34)->update(
        [
          'name' => 'MC Lords'
        ]);  */
    // dd($job);
      //$orderpw=mt_rand(100000000, 99999999999);      
      //$inputs=array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
     
      //$rand_keys1 = array_rand($inputs, 5);
      
      //$orderid=$inputs[$rand_keys1[1]].$orderpw.$inputs[$rand_keys1[0]].$inputs[$rand_keys1[2]];
     // dd($orderpw, $inputs,$rand_keys1,$orderid);
    return view('welcome');
    
    

});

Route::get('test', function(){
  /*  
  dispatch(function(){
    logger('Hello from queue');
  })->delay(5);
   */
  // use a job create
  TranslateJob::dispatch();
  return 'Done';
});

Route::get('/work', function(){
  return view('work');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



/* Used for laravel example
Route::get('/register',[RegisterUserController::class,'create']);
Route::post('/register',[RegisterUserController::class,'store']);
Route::get('/login',[SessionController::class,'create'])->name('login');
Route::post('/login',[SessionController::class,'store']);
Route::post('/logout',[SessionController::class,'destroy']);
*/

Route::get('/applicant/paystatus',[PaymentController::class,'apaystatus'])->name('applicant.apaystatus');

//Route::get('/applicant/paystatus',[PaymentController::class.'apaystatus']);
Route::match(['get', 'post'],'/applicant/remitapay',[PaymentController::class,'remitapay'])->name('applicants.remitapay');
Route::post('/applicant/remita/',[RegisterUserController::class,'remita_transaction'])->name('applicant.remita');

Route::get('/authorize/register',[RegisterUserController::class,'create'])->name('authorize.register');
Route::post('authorize/register',[RegisterUserController::class,'storeUser']);
Route::get('/authorize/login',[SessionController::class,'create'])->name('authorize.login');
Route::post('authorize/login',[SessionController::class,'store']);
Route::post('/logout',[SessionController::class,'destroy']);
Route::get('/applicant/index',[ApplicationController::class,'index'])->name('applicant.index');


Route::get('/student/dashboard',[SessionController::class,'student_dashboard']);
Route::get('/admission/dashboard',[SessionController::class,'admission_dashboard']);



//APPLICANT
Route::get('/applicant/applhome',[ApplicationController::class,'applhome'])->name('applicant.applhome');
Route::post('/applicant/applhome',[ApplicationController::class,'postApplhome'])->name('applicant.applhome');
Route::get('/applicant/examresult',[ApplicationController::class,'examresult'])->name('applicant.examresult');
Route::match(['get', 'post'],'/applicant/examresultpost',[ApplicationController::class,'examresultpost'])->name('applicant.examresultpost');
Route::match(['get', 'post'],'/applicant/examresultpostnew',[ApplicationController::class,'examresultpostnew'])->name('applicant.examresultpostnew');
Route::post('/applicant/exampost',[ApplicationController::class,'exampost'])->name('applicant.exampost');
Route::post('/applicant/delexamresult',[ApplicationController::class,'delexamresult'])->name('applicant.delexamresult');
Route::post('/applicant/exampostnew',[ApplicationController::class,'exampostnew'])->name('applicant.exampostnew');
Route::get('/applicant/certificate',[ApplicationController::class,'certificate'])->name('applicant.certificate');
Route::post('/applicant/certificatepost',[ApplicationController::class,'certificatepost'])->name('applicant.certificatepost');
Route::match(['get', 'post'],'/applicant/employment',[ApplicationController::class,'employment'])->name('applicant.employment');
Route::post('/applicant/employmentpost',[ApplicationController::class,'employmentpost'])->name('applicant.employmentpost');
Route::match(['get', 'post'],'/applicant/sponsor',[ApplicationController::class,'sponsor'])->name('applicant.sponsor');
Route::post('/applicant/sponsorpost',[ApplicationController::class,'sponsorpost'])->name('applicant.sponsorpost');
Route::match(['get', 'post'],'/applicant/preview',[ApplicationController::class,'preview'])->name('applicant.preview');
Route::post('/applicant/previewpost',[ApplicationController::class,'previewpost'])->name('applicant.previewpost');
Route::post('/applicant/submit',[ApplicationController::class,'submitApplication'])->name('applicant.submit');
Route::get('/applicant/success',[ApplicationController::class,'success'])->name('applicant.success');
Route::match(['get', 'post'],'/applicant/printform',[ApplicationController::class,'printform'])->name('applicant.printform');


//12th June 2024
/******************************STUDENTCONTROLLER******************************************************/
//Admission Letter
Route::get('/student/sadmletter',[StudentController::class,'sadmletter'])->name('student.sadmletter');
Route::get('/student/examresult',[StudentController::class,'sexamresult'])->name('student.examresult');


Route::get('/student',[StudentController::class,'index'])->name('student.index');
Route::get('/student/biodata',[StudentController::class,'biodata'])->name('student.biodata');
Route::post('/student/editbiodata',[StudentController::class,'editbiodata'])->name('student.editbiodata');
Route::get('/student/editbiodata',[StudentController::class,'editbiodata'])->name('student.editbiodata');
Route::post('/student/create',[StudentController::class,'create'])->name('student.create');
//ADDED FOR SCHOOL FEES PAYMENTS
Route::get('/student/payadvice',[PaymentController::class,'index'])->name('student.payadvice');
Route::get('/student/payadvice_first',[PaymentController::class,'index_first'])->name('student.payadvice_first');
Route::get('/student/payadvice_second',[PaymentController::class,'index_second'])->name('student.payadvice_second');
Route::post('/student/check',[PaymentController::class,'checkpayment'])->name('student.check');
Route::get('/student/applpay',[PaymentController::class,'applpay'])->name('student.applpay');
Route::post('/student/remita',[PaymentController::class,'remita_transaction'])->name('student.remita');
Route::get('/student/remitastatus',[PaymentController::class,'remitastatus'])->name('student.remitastatus');
Route::match(['get', 'post'],'/student/remitapay',[PaymentController::class,'remita_pay'])->name('student.remita_pay');
Route::match(['get', 'post'],'/student/remitabank',[PaymentController::class,'remitabank'])->name('student.remitabank');
Route::get('/student/paystatus',[PaymentController::class,'paystatus'])->name('student.payments');
Route::get('/student/receipt',[PaymentController::class,'receipt'])->name('student.receipt');
Route::post('/student/printreceipt',[PaymentController::class,'printreceipt'])->name('student.printreceipt');
Route::get('/student/methods',[PaymentController::class,'methods'])->name('student.methods');
Route::post('/student/paymethods',[PaymentController::class,'paymethods'])->name('student.paymethods');
Route::post('/student/remitaflex',[PaymentController::class,'remita_transactionflex'])->name('student.remitaflex');

Route::get('/student/result',[ResultController::class,'getStudentResult'])->name('student.result');
Route::post('/student/resultdisplay',[ResultController::class,'displayStudentResult'])->name('student.resultdisplay');

Route::get('/exams/resultview',[ResultController::class,'resultview'])->name('exam.resultview');
Route::post('/exams/resultviewall',[ResultController::class,'resultviewall'])->name('exam.resultviewall');
Route::post('/exams/import',[ResultController::class,'import'])->name('exam.import');
Route::get('/exams/upload',[ResultController::class,'indexresult'])->name('exam.index');





Route::get('/student/course',[CourseController::class,'getStudentCourse'])->name('student.course');
Route::post('/student/coursedisplay',[CourseController::class,'displayStudentCourse'])->name('student.coursedisplay');
Route::post('/student/registerCourse',[CourseController::class,'registerCourse'])->name('student.registerCourse');
Route::get('/student/courseprint',[CourseController::class,'getStudentCoursePrint'])->name('student.courseprint');
Route::post('/student/coursep',[CourseController::class,'printStudentCourse'])->name('student.coursep');
Route::get('/student/courseprint',[CourseController::class,'getStudentCoursePrint'])->name('student.courseprint');

Route::get('/student/changepassword',[StudentController::class,'changepassword'])->name('student.changepassword');
Route::post('/student/updatepassword',[StudentController::class,'updatePassword'])->name('student.updatepassword');

//Route::get('/changepassword',['uses'=>'AuthController@changepassword','as'=>'admin.changepassword','middleware'=>'roles','roles'=>'Super Admin']);
//Route::post('/updatepassword',['uses'=>'AuthController@updatePassword','as'=>'admin.updatepassword','middleware'=>'roles','roles'=>'Super Admin']);

/*
Route::get('/student/reference',['uses'=>'PaymentController@index','as'=>'student.reference']);
Route::post('/student/check',['uses'=>'PaymentController@checkpayment','as'=>'student.check']);
Route::get('/student/lms',['uses'=>'StudentController@lms','as'=>'student.lms']);
Route::get('/student/changepassword',['uses'=>'StudentController@changepassword','as'=>'student.changepassword']);
Route::post('/student/updatepassword',['uses'=>'StudentController@updatePassword','as'=>'student.updatepassword']);
Route::get('/student/resultperstudent',['uses'=>'StudentController@resultperstudent','as'=>'student.resultperstudent']);
Route::get('/student/findResultPerStudent',['uses'=>'StudentController@findResultPerStudent','as'=>'student.findResultPerStudent']);
Route::get('/generate-docx', 'StudentController@generateDocx');
*/



//ADMIN APPLICATION
Route::get('/admin/dashboard',[AdminController::class,'admin_dashboard']);
Route::get('/admin/dashboard/application',[AdminController::class,'adminApplicationDashboard']);
Route::get('/exams/dashboard/result',[AdminController::class,'adminResultDashboard']);
Route::get('/exams/dashboard/student',[AdminController::class,'adminStudentResultDashboard']);
Route::get('/exams/dashboard/',[AdminController::class,'exam_dashboard']);
Route::get('/admin/dashboard/student',[AdminController::class,'adminStudentDashboard']);
Route::get('/admin/dashboard/setting',[AdminController::class,'adminSettingDashboard']);
Route::get('/admin/dashboard/setup',[AdminController::class,'adminSetupDashboard']);

Route::get('/cadviser/dashboard/',[AdminController::class,'cadviser_dashboard']);
Route::get('/cadviser/manage_level/',[AdminController::class,'cadviserManageLevel']);
Route::post('/cadviser/level/',[AdminController::class,'ManageLevel'])->name('cadviser.manage_level');
Route::post('/cadviser/manage_level/',[AdminController::class,'changeLevel'])->name('cadviser.level');
Route::get('/cadviser/view_course/',[AdminController::class,'cadviserViewCourse']);
Route::post('/cadviser/course/',[AdminController::class,'viewCourse'])->name('cadviser.course');

Route::get('/cadviser/manage_course/',[AdminController::class,'cadviserManageCourse']);
Route::get('/cadviser/dashboard/report',[AdminController::class,'cadviserReportdashboard']);
Route::get('/finance/dashboard/',[AdminController::class,'finance_dashboard']);
Route::get('/lsupport/dashboard/',[AdminController::class,'lsupport_dashboard']);
Route::get('/lsupport/dashboard/report',[AdminController::class,'lsupportReportdashboard']);
Route::get('/helpdesk/dashboard/',[AdminController::class,'helpdesk_dashboard']);
Route::get('/helpdesk/dashboard/report',[AdminController::class,'helpdeskReportdashboard']);
Route::get('/helpdesk/applnotpaid/',[AdminController::class,'helpdeskReportApplNotPaid']);
Route::get('/helpdesk/applnotsubmit/',[AdminController::class,'helpdeskReportApplNotSubmit']);
Route::get('/helpdesk/applnotaccept/',[AdminController::class,'helpdeskReportApplNotAccept']);


Route::get('/admin/changepassword',[AdminController::class,'changepassword'])->name('admin.changepassword');;
Route::post('/admin/updatepassword',[AdminController::class,'updatepassword'])->name('admin.updatepassword');;




Route::get('/admission/dashboard',[AdmissionController::class,'admission_dashboard']);
Route::get('/admission/dashboard/application',[AdmissionController::class,'admissionApplicationDashboard']);
Route::get('/admission/dashboard/admission',[AdmissionController::class,'manageAdmissionDashboard']);
Route::get('/admin/dashboard/student',[AdminController::class,'adminStudentDashboard']);


Route::get('/student/dashboard',[StudentController::class,'student_dashboard']);
Route::get('/student/dashboard/biodata',[StudentController::class,'studentBiodataDashboard']);
Route::get('/student/dashboard/payment',[StudentController::class,'studentPaymentDashboard']);
Route::get('/student/dashboard/registration',[StudentController::class,'studentRegistrationDashboard']);
Route::get('/student/dashboard/result',[StudentController::class,'studentResultDashboard']);

Route::get('/applicant/dashboard',[ApplicationController::class,'applicant_dashboard']);
Route::get('/applicant/dashboard/biodata',[ApplicationController::class,'applicantBiodataDashboard']);
Route::get('/applicant/dashboard/payment',[ApplicationController::class,'applicantPaymentDashboard']);
Route::get('/applicant/dashboard/admission',[ApplicationController::class,'applicantAdmissionDashboard']);

//Route::get('/admin/applicant/transaction',['uses'=>'ApplicationController@transaction','as'=>'admin.transaction','middleware'=>'roles','roles'=>'Super Admin']);
Route::get('/admin/applicant/transaction',[ApplicationController::class,'transaction'])->name('applicant.transaction');
Route::get('/admin/applicant/report',[ApplicationController::class,'getApplicantsReport'])->name('admin.applreport');
Route::post('/admin/applicant/applreport',[ApplicationController::class,'applreport'])->name('admin.applreport');

Route::get('/admin/applicant/applpaid',[ApplicationController::class,'applpaid'])->name('admin.applpaid');
Route::get('/admin/applicant/applnotpaid',[ApplicationController::class,'applnotpaid'])->name('admin.applnotpaid');

Route::get('/finance/applpaid',[ApplicationController::class,'finance_applpaid'])->name('finance.applpaid');
Route::get('/finance/studentpaid',[ApplicationController::class,'studentpaid'])->name('finance.studentpaid');


//ADMISSION
Route::get('/admission/applist',[AdmissionController::class,'getApplicationList'])->name('admission.applist');
Route::get('/admission/readmit',[AdmissionController::class,'readmit'])->name('admission.readmit');
Route::post('/admission/readmits',[AdmissionController::class,'readmits'])->name('admission.readmits');
Route::post('/admission/readmitcanditate',[AdmissionController::class,'readmitcanditate'])->name('admission.readmitcanditate');
Route::get('/admission/admitted',[AdmissionController::class,'getAdmittedList'])->name('admission.admitted');
Route::get('/admission/admittedeps',[AdmissionController::class,'getAdmittedDepart'])->name('admission.admittedeps');
Route::post('/admission/admittedep',[AdmissionController::class,'getAdmittedListDepart'])->name('admission.admittedep');
Route::match(['get','post'],'/admission/admit',[AdmissionController::class,'admit'])->name('admission.admit');
Route::post('/admission/admitnow',[AdmissionController::class,'admitnow'])->name('admission.admitnow');
Route::post('/admission/admitcanditate',[AdmissionController::class,'admitCanditate'])->name('admission.admitcanditate');
Route::get('/admission/admletter',[AdmissionController::class,'getAdmissionLetter'])->name('admission.admletter');
Route::get('/admission/admletterlist',[AdmissionController::class,'getAdmletterList'])->name('admission.admletterlist');
Route::post('/admission/padmletter',[AdmissionController::class,'admletter'])->name('admission.padmletter');
Route::get('/admission/matriclist',[AdmissionController::class,'getMatricList'])->name('admission.matriclist');
Route::get('/admission/matriclistdep',[AdmissionController::class,'getMatricDepart'])->name('admission.matriclistdep');
Route::post('/admission/matriclistdeps',[AdmissionController::class,'getMatricListDepart'])->name('admission.matriclistdeps');
Route::get('/admission/applicant',[AdmissionController::class,'getApplicant'])->name('admission.applicant');
Route::post('/admission/applicantinfo',[AdmissionController::class,'applicantinfo'])->name('admission.applicantinfo');
Route::post('/admission/createapplicant',[AdmissionController::class,'createApplicant'])->name('admission.createapplicant');
Route::get('/admission/course',[AdmissionController::class,'course'])->name('admission.course');
Route::post('/admission/coursedisplay',[AdmissionController::class,'coursedisplay'])->name('admission.coursedisplay');
Route::post('/admission/viewcourse',[AdmissionController::class,'viewcourse'])->name('admission.viewcourse');



//ADMIN BLOODGROUP
Route::get('/admin/bloodgroup/show/{bloodgroup}',[BloodgroupController::class,'show'])->name('admin.bloodgroup.show');
Route::get('/admin/bloodgroup',[BloodgroupController::class,'index'])->name('admin.bloodgroup.index');
Route::get('/admin/bloodgroup/edit/{bloodgroup}',[BloodgroupController::class,'edit'])->name('admin.bloodgroup.edit');
Route::get('/admin/bloodgroup/create',[BloodgroupController::class,'create'])->name('admin.bloodgroup.create');
Route::post('/admin/bloodgroup/store',[BloodgroupController::class,'store'])->name('admin.bloodgroup.store');
Route::patch('/admin/bloodgroup/{bloodgroup}',[BloodgroupController::class,'update'])->name('admin.bloodgroup.update');
Route::delete('/admin/bloodgroup/{bloodgroup}',[BloodgroupController::class,'destroy'])->name('admin.bloodgroup.destroy');
//ADMIN CATEGORY
Route::get('/admin/category/show/{category}',[CategoryController::class,'show'])->name('admin.category.show');
Route::get('/admin/category',[CategoryController::class,'index'])->name('admin.category.index');
Route::get('/admin/category/edit/{category}',[CategoryController::class,'edit'])->name('admin.category.edit');
Route::get('/admin/category/create',[CategoryController::class,'create'])->name('admin.category.create');
Route::post('/admin/category/store',[CategoryController::class,'store'])->name('admin.category.store');
Route::patch('/admin/category/{category}',[CategoryController::class,'update'])->name('admin.category.update');
Route::delete('/admin/category/{category}',[CategoryController::class,'destroy'])->name('admin.category.destroy');
//ADMIN CERTGRADE
Route::get('/admin/certgrade/show/{certgrade}',[CertgradeController::class,'show'])->name('admin.certgrade.show');
Route::get('/admin/certgrade',[CertgradeController::class,'index'])->name('admin.certgrade.index');
Route::get('/admin/certgrade/edit/{certgrade}',[CertgradeController::class,'edit'])->name('admin.certgrade.edit');
Route::get('/admin/certgrade/create',[CertgradeController::class,'create'])->name('admin.certgrade.create');
Route::post('/admin/certgrade/store',[CertgradeController::class,'store'])->name('admin.certgrade.store');
Route::patch('/admin/certgrade/{certgrade}',[CertgradeController::class,'update'])->name('admin.certgrade.update');
Route::delete('/admin/certgrade/{certgrade}',[CertgradeController::class,'destroy'])->name('admin.certgrade.destroy');
//ADMIN CERTIFICATE
Route::get('/admin/certificate/show/{certificate}',[CertificateController::class,'show'])->name('admin.certificate.show');
Route::get('/admin/certificate',[CertificateController::class,'index'])->name('admin.certificate.index');
Route::get('/admin/certificate/edit/{certificate}',[CertificateController::class,'edit'])->name('admin.certificate.edit');
Route::get('/admin/certificate/create',[CertificateController::class,'create'])->name('admin.certificate.create');
Route::post('/admin/certifcate/store',[CertificateController::class,'store'])->name('admin.certificate.store');
Route::patch('/admin/certificate/{certificate}',[CertificateController::class,'update'])->name('admin.certificate.update');
Route::delete('/admin/certificate/{certificate}',[CertificateController::class,'destroy'])->name('admin.certificate.destroy');

//ADMIN COURSE
Route::get('/admin/course/show/{course}',[CourseController::class,'show'])->name('admin.course.show');
Route::get('/admin/course',[CourseController::class,'index'])->name('admin.course.index');
Route::get('/admin/course/edit/{course}',[CourseController::class,'edit'])->name('admin.course.edit');
Route::get('/admin/course/create',[CourseController::class,'create'])->name('admin.course.create');
Route::post('/admin/course/store',[CourseController::class,'store'])->name('admin.course.store');
Route::patch('/admin/course/{course}',[CourseController::class,'update'])->name('admin.course.update');
Route::delete('/admin/course/{course}',[CourseController::class,'destroy'])->name('admin.course.destroy');
Route::post('/admin/course/import',[CourseController::class,'importcourse'])->name('admin.course.import');
Route::get('/admin/course/upload',[CourseController::class,'import'])->name('admin.indeximport');
//ADMIN EXAM
Route::get('/admin/exam/show/{exam}',[ExamController::class,'show'])->name('admin.exam.show');
Route::get('/admin/exam',[ExamController::class,'index'])->name('admin.exam.index');
Route::get('/admin/exam/edit/{exam}',[ExamController::class,'edit'])->name('admin.exam.edit');
Route::get('/admin/exam/create',[ExamController::class,'create'])->name('admin.exam.create');
Route::post('/admin/exam/store',[ExamController::class,'store'])->name('admin.exam.store');
Route::patch('/admin/exam/{exam}',[ExamController::class,'update'])->name('admin.exam.update');
Route::delete('/admin/exam/{exam}',[ExamController::class,'destroy'])->name('admin.exam.destroy');
//ADMIN GENDER
Route::get('/admin/gender/show/{gender}',[GenderController::class,'show'])->name('admin.gender.show');
Route::get('/admin/gender',[GenderController::class,'index'])->name('admin.gender.index');
Route::get('/admin/gender/edit/{gender}',[GenderController::class,'edit'])->name('admin.gender.edit');
Route::get('/admin/gender/create',[GenderController::class,'create'])->name('admin.gender.create');
Route::post('/admin/gender/store',[GenderController::class,'store'])->name('admin.gender.store');
Route::patch('/admin/gender/{gender}',[GenderController::class,'update'])->name('admin.gender.update');
Route::delete('/admin/gender/{gender}',[GenderController::class,'destroy'])->name('admin.gender.destroy');
//ADMIN MARITAL STATUS
Route::get('/admin/marital/show/{marital}',[MaritalController::class,'show'])->name('admin.marital.show');
Route::get('/admin/marital',[MaritalController::class,'index'])->name('admin.marital.index');
Route::get('/admin/marital/edit/{marital}',[MaritalController::class,'edit'])->name('admin.marital.edit');
Route::get('/admin/marital/create',[MaritalController::class,'create'])->name('admin.marital.create');
Route::post('/admin/marital/store',[MaritalController::class,'store'])->name('admin.marital.store');
Route::patch('/admin/marital/{marital}',[MaritalController::class,'update'])->name('admin.marital.update');
Route::delete('/admin/marital/{marital}',[MaritalController::class,'destroy'])->name('admin.marital.destroy');
//ADMIN LGA
Route::get('/admin/lga/show/{lga}',[LgaController::class,'show'])->name('admin.lga.show');
Route::get('/admin/lga',[LgaController::class,'index'])->name('admin.lga.index');
Route::get('/admin/lga/edit/{lga}',[LgaController::class,'edit'])->name('admin.lga.edit');
Route::get('/admin/lga/create',[LgaController::class,'create'])->name('admin.lga.create');
Route::post('/admin/lga/store',[LgaController::class,'store'])->name('admin.lga.store');
Route::patch('/admin/lga/{lga}',[LgaController::class,'update'])->name('admin.lga.update');
Route::delete('/admin/lga/{lga}',[LgaController::class,'destroy'])->name('admin.lga.destroy');
//ADMIN STATE
Route::get('/admin/state/show/{state}',[StateController::class,'show'])->name('admin.state.show');
Route::get('/admin/state',[StateController::class,'index'])->name('admin.state.index');
Route::get('/admin/state/edit/{state}',[StateController::class,'edit'])->name('admin.state.edit');
Route::get('/admin/state/create',[StateController::class,'create'])->name('admin.state.create');
Route::post('/admin/state/store',[StateController::class,'store'])->name('admin.state.store');
Route::patch('/admin/state/{state}',[StateController::class,'update'])->name('admin.state.update');
Route::delete('/admin/state/{state}',[StateController::class,'destroy'])->name('admin.state.destroy');
//ADMIN TITLE
Route::get('/admin/title/show/{title}',[TitleController::class,'show'])->name('admin.title.show');
Route::get('/admin/title',[TitleController::class,'index'])->name('admin.title.index');
Route::get('/admin/title/edit/{title}',[TitleController::class,'edit'])->name('admin.title.edit');
Route::get('/admin/title/create',[TitleController::class,'create'])->name('admin.title.create');
Route::post('/admin/title/store',[TitleController::class,'store'])->name('admin.title.store');
Route::patch('/admin/title/{title}',[TitleController::class,'update'])->name('admin.title.update');
Route::delete('/admin/title/{title}',[TitleController::class,'destroy'])->name('admin.title.destroy');
//ADMIN RELIGION
Route::get('/admin/religion/show/{religion}',[ReligionController::class,'show'])->name('admin.religion.show');
Route::get('/admin/religion',[ReligionController::class,'index'])->name('admin.religion.index');
Route::get('/admin/religion/edit/{religion}',[ReligionController::class,'edit'])->name('admin.religion.edit');
Route::get('/admin/religion/create',[ReligionController::class,'create'])->name('admin.religion.create');
Route::post('/admin/religion/store',[ReligionController::class,'store'])->name('admin.religion.store');
Route::patch('/admin/religion/{religion}',[ReligionController::class,'update'])->name('admin.religion.update');
Route::delete('/admin/religion/{religion}',[ReligionController::class,'destroy'])->name('admin.religion.destroy');
//ADMIN MODE
Route::get('/admin/mode/show/{mode}',[ModeController::class,'show'])->name('admin.mode.show');
Route::get('/admin/mode',[ModeController::class,'index'])->name('admin.mode.index');
Route::get('/admin/mode/edit/{mode}',[ModeController::class,'edit'])->name('admin.mode.edit');
Route::get('/admin/mode/create',[ModeController::class,'create'])->name('admin.mode.create');
Route::post('/admin/mode/store',[ModeController::class,'store'])->name('admin.mode.store');
Route::patch('/admin/mode/{mode}',[ModeController::class,'update'])->name('admin.mode.update');
Route::delete('/admin/mode/{mode}',[ModeController::class,'destroy'])->name('admin.mode.destroy');
//ADMIN RELATIONSHIP
Route::get('/admin/relationship/show/{relationship}',[RelationshipController::class,'show'])->name('admin.relationship.show');
Route::get('/admin/relationship',[RelationshipController::class,'index'])->name('admin.relationship.index');
Route::get('/admin/relationship/edit/{relationship}',[RelationshipController::class,'edit'])->name('admin.relationship.edit');
Route::get('/admin/relationship/create',[RelationshipController::class,'create'])->name('admin.relationship.create');
Route::post('/admin/relationship/store',[RelationshipController::class,'store'])->name('admin.relationship.store');
Route::patch('/admin/relationship/{relationship}',[RelationshipController::class,'update'])->name('admin.relationship.update');
Route::delete('/admin/relationship/{relationship}',[RelationshipController::class,'destroy'])->name('admin.relationship.destroy');
//ADMIN SCHOOL
Route::get('/admin/school/show/{school}',[SchoolController::class,'show'])->name('admin.school.show');
Route::get('/admin/school',[SchoolController::class,'index'])->name('admin.school.index');
Route::get('/admin/school/edit/{school}',[SchoolController::class,'edit'])->name('admin.school.edit');
Route::get('/admin/school/create',[SchoolController::class,'create'])->name('admin.school.create');
Route::post('/admin/school/store',[SchoolController::class,'store'])->name('admin.school.store');
Route::patch('/admin/school/{school}',[SchoolController::class,'update'])->name('admin.school.update');
Route::delete('/admin/school/{school}',[SchoolController::class,'destroy'])->name('admin.school.destroy');
//ADMIN PROGRAMME
Route::get('/admin/programme/show/{programme}',[ProgrammeController::class,'show'])->name('admin.programme.show');
Route::get('/admin/programme',[ProgrammeController::class,'index'])->name('admin.programme.index');
Route::get('/admin/programme/edit/{programme}',[ProgrammeController::class,'edit'])->name('admin.programme.edit');
Route::get('/admin/programme/create',[ProgrammeController::class,'create'])->name('admin.programme.create');
Route::post('/admin/programme/store',[ProgrammeController::class,'store'])->name('admin.programme.store');
Route::patch('/admin/programme/{programme}',[ProgrammeController::class,'update'])->name('admin.programme.update');
Route::delete('/admin/programme/{programme}',[ProgrammeController::class,'destroy'])->name('admin.programme.destroy');
//ADMIN SUBJECT
Route::get('/admin/subject/show/{subject}',[SubjectController::class,'show'])->name('admin.subject.show');
Route::get('/admin/subject',[SubjectController::class,'index'])->name('admin.subject.index');
Route::get('/admin/subject/edit/{subject}',[SubjectController::class,'edit'])->name('admin.subject.edit');
Route::get('/admin/subject/create',[SubjectController::class,'create'])->name('admin.subject.create');
Route::post('/admin/subject/store',[SubjectController::class,'store'])->name('admin.subject.store');
Route::patch('/admin/subject/{subject}',[SubjectController::class,'update'])->name('admin.subject.update');
Route::delete('/admin/subject/{subject}',[SubjectController::class,'destroy'])->name('admin.subject.destroy');
//ADMIN GRADER
Route::get('/admin/grader/show/{grader}',[GraderController::class,'show'])->name('admin.grader.show');
Route::get('/admin/grader',[GraderController::class,'index'])->name('admin.grader.index');
Route::get('/admin/grader/edit/{grader}',[GraderController::class,'edit'])->name('admin.grader.edit');
Route::get('/admin/grader/create',[GraderController::class,'create'])->name('admin.grader.create');
Route::post('/admin/grader/store',[GraderController::class,'store'])->name('admin.grader.store');
Route::patch('/admin/grader/{grader}',[GraderController::class,'update'])->name('admin.grader.update');
Route::delete('/admin/grader/{grader}',[GraderController::class,'destroy'])->name('admin.grader.destroy');
//ADMIN TERM
Route::get('/admin/term/show/{term}',[TermController::class,'show'])->name('admin.term.show');
Route::get('/admin/term',[TermController::class,'index'])->name('admin.term.index');
Route::get('/admin/term/edit/{term}',[TermController::class,'edit'])->name('admin.term.edit');
Route::get('/admin/term/create',[TermController::class,'create'])->name('admin.term.create');
Route::post('/admin/term/store',[TermController::class,'store'])->name('admin.term.store');
Route::patch('/admin/term/{term}',[TermController::class,'update'])->name('admin.term.update');
Route::delete('/admin/term/{term}',[TermController::class,'destroy'])->name('admin.term.destroy');
//ADMIN ROLE
Route::get('/admin/role/show/{role}',[RoleController::class,'show'])->name('admin.role.show');
Route::get('/admin/role',[RoleController::class,'index'])->name('admin.role.index');
Route::get('/admin/role/edit/{role}',[RoleController::class,'edit'])->name('admin.role.edit');
Route::get('/admin/role/create',[RoleController::class,'create'])->name('admin.role.create');
Route::post('/admin/role/store',[RoleController::class,'store'])->name('admin.role.store');
Route::patch('/admin/role/{role}',[RoleController::class,'update'])->name('admin.role.update');
Route::delete('/admin/role/{role}',[RoleController::class,'destroy'])->name('admin.role.destroy');

Route::get('/admin/registration',[AdminController::class,'adminRegistration'])->name('admin.registration');

Route::get('/admin/biodata',[AdminController::class,'adminBiodata'])->name('admin.biodata');
Route::post('/admin/biodatapost',[AdminController::class,'adminBiodataPost'])->name('admin.biodatapost');
Route::post('/admin/editbiodata',[AdminController::class,'adminEditBiodata'])->name('admin.editbiodata');

//Group them together
//Route::controller(JobController::class)->group(function () {
Route::get('/first',[JobController::class,'index']);
Route::get('/first/{job}',[JobController::class,'show']);  
//Route::get('/first/{job}/edit',[JobController::class,'edit'])->middleware(['auth','can:edit-job,job']);   
Route::get('/first/{job}/edit',[JobController::class,'edit'])->middleware('auth')->can('edit','job');   
//Route::get('/first/{job}/edit', function(Job $job){      
//Update- using patch
Route::patch('/first/{job}',[JobController::class,'update']);
//Destory- using delete without changing the url
Route::delete('/first/{id}',[JobController::class,'destroy']);
Route::get('/third',[JobController::class,'create']);
Route::get('/jobs',[JobController::class,'store']);
Route::post('/jobs', [JobController::class,'store'])->middleware('auth');
//});

// Route Resource
//Route::resource('jobs',JobController::class,['only'= > 'index','show']);