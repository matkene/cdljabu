<?php

namespace App\Http\Controllers;

//use File;
//use Excel;
use App\Models\Term;

use App\Models\Grade;
use App\Models\Course;

use App\Models\Result;
use App\Models\School;
use App\Models\Student;
use App\Models\Programme;
use App\Models\Employment;
//use App\Imports\UsersImport;
use App\Imports\UsersImport;
//use Maatwebsite\Excel\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rules\File;
//use ZipStream\File;
//use Illuminate\Support\Facades\File;
//use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\File;


class ResultController extends Controller
{
    // display results page for a student
    public function getStudentResult(){
        $id = Auth::user()->username;
        $terms = Term::where('status','Active')->get();
        $students = Student::where('matric',$id)->get();
        return view('student.result_index',['terms'=>$terms,'students'=>$students]);
    }


    public function displayStudentResult(Request $request){
        
    $date = date("F j, Y"); // Date Format
    $programme_id = $request->input('programme_id'); 
    $school_id = $request->input('school_id');  
    $level = $request->input('level');
    if($request->input('semester') == '1st')
    {
        $semster ='First';}
    else{
        $semster ='Second';   
        } 
    $semester = $semster;    
    $term_id = $request->input('term_id'); 
    $terms = Term::where('id', $request->input('term_id'))->get()->toArray();

       
    $programmes = Programme::where('id', $request->input('programme_id'))->get(); 
    
    // Get the courses for the session, level, semester
    $courses = Course::where('programme_id', $request->input('programme_id'))
    ->where('level', $request->input('level'))
    ->where('term_id', @$terms[0]['id'])
    ->where('semester', $request->input('semester'))
    ->get();    
    
    

    foreach($programmes as $programme){
        $school_id = $programme->school_id;
    }
    // Get the Grades    
    //$grades = Grade::where('school_id',$school_id)->get(); 
    $grades = Grade::all();   


         //SELECT students.fname, students.sname, courses.crsid, students.matric, results.grade_ids FROM students JOIN results ON students.matric = results.matric JOIN courses on results.course_id = courses.id
 if($request->input('level') == 100 && $request->input('semester') == '1st' )
 {
  //$sessions = Session::all();
  $terms = Term::where('id', $request->input('term_id'))->get()->toArray();
  $schools = School::where('id', $request->input('school_id'))->get(); 
  $programmes = Programme::where('id', $request->input('programme_id'))->get();
  $grades = Grade::all(); 
  foreach($programmes as $programme){
      $school_id = $programme->school_id;
  }

 
DB::statement("SET SQL_MODE=''"); //In config\database.php --> "mysql" array Set 'strict' => false to disable all.
  //Number of students in class

$results = DB::table('students')    
->leftjoin('results','students.matric','=','results.matric')
->leftjoin('courses','results.course_id','=','courses.id')
->leftjoin('grades','results.grade_id','=','grades.id')
->select('students.sname','students.fname','students.oname','students.matric',
'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode',
'courses.unit as courseunit','courses.crsdesc as coursedesc','grades.weighed_point as weighedpoint')
->where('results.matric','=', $request->input('matric'))
->where('results.programme_id','=', $request->input('programme_id'))
->where('results.school_id','=', $school_id)
->where('results.semester','=', $request->input('semester'))
->where('results.level','=', $request->input('level'))
->orderBy('students.matric')
->orderBy('courses.crsid')          
->get();

//dd($results);


// For One Level
  $resutltArray = [];
  
  foreach ($results as $result){

      if(!isset($resutltArray[$result->matric])){
          $resutltArray[$result->matric]=['sname' => $result->sname,
                                          'fname' => $result->fname,
                                          'oname' => $result->oname,
                                          'matric' => $result->matric,
                                          'totalUnits' => 0,
                                          'tcp' => 0,
                                          'gpa'=>0                                             
                                         ];
      }
     
      $resutltArray[$result->matric]['results'][] = [
                                          'gradeids' => $result->gradeids,
                                          'coursecode' => $result->coursecode,
                                          'coursedesc' =>$result->coursedesc,
                                          'courseunit' => $result->courseunit,
                                          'weighedpoint' => $result->weighedpoint,
                                          'gradeid' => $result->gradeid                                             

                                         ];
      
                                      
  $resutltArray[$result->matric]['totalUnits']= $resutltArray[$result->matric]['totalUnits'] + $result->courseunit;
  $resutltArray[$result->matric]['tcp']= $resutltArray[$result->matric]['tcp'] + ($result->courseunit * $result->weighedpoint);
  $resutltArray[$result->matric]['gpa']= ($resutltArray[$result->matric]['gpa'] + ($result->courseunit * $result->weighedpoint))/($resutltArray[$result->matric]['totalUnits'] + $result->courseunit);
  }

  //dd($terms);

//echo '<pre>';
 //print_r($resutltArray);
//echo '</pre>';
   
  
 
 return view('student.result',['grades'=>$grades,'results'=>$results,
  'courses'=>$courses,'terms'=>$terms,'schools'=>$schools,'programmes'=>$programmes,
  'semester'=>$semester,'date'=>$date,'level'=>$level,'resutltArray'=>$resutltArray]);

 }        
                 /*
        return view('student.result',['students'=>$students,'results'=>$results,
        'term'=>$term,'semester'=>$semester,'num'=>$num]);
        /*->withResults($results)->withStudents($students);*/


// 2nd Semester for 100 Level
if($request->input('level') == 100 && $request->input('semester')=='2nd'){
    
    //Previous
    //$sessions = Session::all();
    $terms = Term::where('id', $request->input('term_id'))->get()->toArray();
    $schools = School::where('id', $request->input('school_id'))->get(); 
    $programmes = Programme::where('id', $request->input('programme_id'))->get();
    $grades = Grade::all(); 
    foreach($programmes as $programme){
        $school_id = $programme->school_id;
    }
  
  // Get the Grades    
  //$grades = Grade::where('school_id',$school_id)->get();
  $grades = Grade::all();
  
  DB::statement("SET SQL_MODE=''"); //In config\database.php --> "mysql" array Set 'strict' => false to disable all.
  
  
    $previous = '1st';
    $resultpre = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')  
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->leftjoin('terms','results.term_id','=','terms.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.grade_id as gradeid','results.level as levels',
    'results.semester as semesters','courses.crsid as coursecode','courses.crsdesc as coursedesc',
    'courses.unit as courseunit','grades.weighed_point as weighedpoint','terms.name as sessionname')
    ->where('results.matric','=', $request->input('matric')) 
    ->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id )
    ->where('results.semester','=', $previous)
    ->where('results.level','=', $request->input('level'))
    ->orderBy('students.matric')
   ->orderBy('courses.crsid')             
    ->get();


   
    
      // Current  Semester
     $results = DB::table('students')    
      ->leftjoin('results','students.matric','=','results.matric')
      ->leftjoin('courses','results.course_id','=','courses.id')
      //->leftjoin('grades','results.grade_ids','=','grades.ids')
      ->leftjoin('grades','results.grade_id','=','grades.id')
      ->select('students.sname','students.fname','students.oname','students.matric',
      'results.grade_ids as gradeids','results.grade_id as gradeid',
      'courses.crsid as coursecode','courses.crsdesc as coursedesc','courses.unit as courseunit',
      'grades.weighed_point as weighedpoint')
      //->where('results.programme_id','=', $request->input('programme_id'))
      ->where('results.matric','=', $request->input('matric')) 
      ->where('results.school_id','=', $school_id )
      ->where('results.programme_id','=', $request->input('programme_id'))
      ->where('results.semester','=', $request->input('semester'))
      ->where('results.level','=', $request->input('level'))
      ->orderBy('students.matric')
      ->orderBy('courses.crsid')           
      ->get(); 


      
      
  
      //Cummulative
      $resultcum = DB::table('students')    
      ->leftjoin('results','students.matric','=','results.matric')
      ->leftjoin('courses','results.course_id','=','courses.id')
      //->leftjoin('grades','results.grade_ids','=','grades.ids')
      ->leftjoin('grades','results.grade_id','=','grades.id')
      ->select('students.sname','students.fname','students.oname','students.matric',
      'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode',
      'courses.unit as courseunit','courses.crsdesc as coursedesc','grades.weighed_point as weighedpoint')
      ->where('results.matric','=', $request->input('matric')) 
      ->where('results.programme_id','=', $request->input('programme_id'))
      ->where('results.school_id','=', $school_id )
      //->where('results.semester','=', $request->input('semester'))
      ->where('results.level','=', $request->input('level'))
      ->orderBy('students.matric')
       ->orderBy('courses.crsid')           
      ->get();
     
          
      // For One Level
      $resutltArray = [];
      
      foreach ($results as $result){
  
          if(!isset($resutltArray[$result->matric])){
              $resutltArray[$result->matric]=['sname' => $result->sname,
                                              'fname' => $result->fname,
                                              'oname' => $result->oname,
                                              'matric' => $result->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray[$result->matric]['results'][] = [
                                              'gradeids' => $result->gradeids,
                                              'coursecode' => $result->coursecode,
                                              'coursedesc' =>$result->coursedesc,
                                              'courseunit' => $result->courseunit,
                                              'weighedpoint' => $result->weighedpoint
                                                                                          
  
                                             ];
                                          
      $resutltArray[$result->matric]['totalUnits']= $resutltArray[$result->matric]['totalUnits'] + $result->courseunit;
      $resutltArray[$result->matric]['tcp']= $resutltArray[$result->matric]['tcp'] + ($result->courseunit * $result->weighedpoint);
      $resutltArray[$result->matric]['gpa']= ($resutltArray[$result->matric]['gpa'] + ($result->courseunit * $result->weighedpoint))/($resutltArray[$result->matric]['totalUnits'] + $result->courseunit);
      }

      
  
      // For Previous Semester
      $resutltArray2 = [];
      
      foreach ($resultpre as $result2){
  
          if(!isset($resutltArray2[$result2->matric])){
              $resutltArray2[$result2->matric]=[
                                              'sname' => $result2->sname,
                                              'fname' => $result2->fname,
                                               'oname' => $result2->oname,
                                               'matric' => $result2->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray2[$result2->matric]['resultpre'][] = [
                                              'gradeids' => $result2->gradeids,
                                              'coursecode' => $result2->coursecode,
                                              'coursedesc' =>$result2->coursedesc,
                                              'courseunit' => $result2->courseunit,
                                              'weighedpoint' => $result2->weighedpoint                                            
  
                                             ];
          
       //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
      $resutltArray2[$result2->matric]['totalUnits']= $resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit;
      $resutltArray2[$result2->matric]['tcp']= $resutltArray2[$result2->matric]['tcp'] + ($result2->courseunit * $result2->weighedpoint);
      //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
      //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
      }

      
  
      // For Cummulative Semester
      $resutltArray3 = [];
      
      foreach ($resultcum as $result3){
  
          if(!isset($resutltArray3[$result3->matric])){
              $resutltArray3[$result3->matric]=[
                                              'sname' => $result3->sname,
                                              'fname' => $result3->fname,
                                               'oname' => $result3->oname,
                                              'matric' => $result3->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray3[$result3->matric]['resultcum'][] = [
                                              'gradeids' => $result3->gradeids,
                                              'coursecode' => $result3->coursecode,
                                              'coursedesc' =>$result3->coursedesc,
                                              'courseunit' => $result3->courseunit,
                                              'weighedpoint' => $result3->weighedpoint                                            
  
                                             ];
          if($result3->gradeid == NULL ){
              $resutltArray3[$result3->matric]['res'][] = [
                                             'gradeidss' => $result3->gradeids,
                                             'coursecodes' => $result3->coursecode,
                                             'coursedescs' =>$result3->coursedesc,
                                             'courseunits' => $result3->courseunit,
                                             'weighedpoints' => $result3->weighedpoint                                            
  
                                                           ];
  
          }else{
              $resutltArray3[$result3->matric]['res'][] = [];
          }
      //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
      $resutltArray3[$result3->matric]['totalUnits']= $resutltArray3[$result3->matric]['totalUnits'] + $result3->courseunit;
      $resutltArray3[$result3->matric]['tcp']= $resutltArray3[$result3->matric]['tcp'] + ($result3->courseunit * $result3->weighedpoint);
      //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
      //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
      
    
    }


    //dd($resutltArray3);
    
      
     
  //dd();
     return view('student.result',['grades'=>$grades,'results'=>$results,'term'=>$term_id,
     'courses'=>$courses,'terms'=>$terms,'schools'=>$schools,'programmes'=>$programmes,
     'semester'=>$semester,'date'=>$date,'level'=>$level,'resutltArray'=>$resutltArray,
      'resutltArray3'=>$resutltArray3, 'resutltArray2'=>$resutltArray2]);
      /*->withGrades($grades)->withResults($result)
      ->withCourses($courses)
      ->withProgrammes($programmes)
      ->withSessions($sessions)
      ->withSchools($schools)
      ->withResults($results); */
      
  }
  
    }
     
    // For Exam Admin
    public function resultview(){
    $terms = Term::all();
    $schools = School::all();
    $programmes = Programme::all();
    return view('exams.result_index',['schools'=>$schools, 'programmes'=>$programmes,
    'terms'=>$terms]);
    
    }


    // Upload per courses
public function indexresult(){
    $schools = School::all();
    $programmes = Programme::all();
    $courses = Course::all();
    $results =  Result::all();
    $terms =    Term::all();
            
    return view('exams.upload',['terms'=>$terms, 'results'=>$results,'schools'=>$schools,
    'programmes'=>$programmes,'courses'=>$courses]);
    /*->withSessions($sessions)->withSchools($schools)->withResults($results);*/
    
}
    public function import(Request $request){
       // dd($request);
     date_default_timezone_set("Africa/Lagos");
     $created_at = date('Y-m-d H:i:s');
     $updated_at = date('Y-m-d H:i:s');
        if($request->input('level')==100 AND $request->input('semester')=='1st'){
            $semester_id = 1;
        }
        if($request->input('level')==100 AND $request->input('semester')=='2nd'){
            $semester_id = 2;
        }
        if($request->input('level')==200 AND $request->input('semester')=='1st'){
            $semester_id = 3;
        }
        if($request->input('level')==200 AND $request->input('semester')=='2nd'){
            $semester_id = 4;
        }
        if($request->input('level')==300 AND $request->input('semester')=='1st'){
            $semester_id = 5;
        }
        if($request->input('level')==300 AND $request->input('semester')=='2nd'){
            $semester_id = 6;
        }
    
        //$dateto  = 2024;
        /*
        $crsid_id = Course::where('crsid',$request->input('crsid'))
                      ->where('level',$request->input('level'))
                      ->where('programme_id',$request->input('programme_id'))
                      ->where('semester',$request->input('semester'))
                      ->where('term_id',$request->input('term_id'))
                      ->get()
                      ->toArray();

                      $splited = @array_splice($value,4);  
                    
                    foreach($splited as $crsid=>$total){

              */        
        
        $semester = $request->input('semester');
        $programme = $request->input('programme_id');
        $level = $request->input('level');
        $term = $request->input('term_id');
        $crsid = $request->input('crsid');
        $status = 1;
        $path = $request->file->getRealPath();
        
        /*
         Due to change in version
        $table = 'results';

        $data = Excel::load($path, function ($reader) use($table) {
            $data = $reader->toArray();
            //here data has all excel data in array.
    });

       dd($data);
       */

       
        $data = Excel::toArray(new UsersImport($crsid, $updated_at,$created_at,$programme,$status,$term, $semester, $level), $path);
        //dd($data[0][0]['0-Matric']);
        $phoneNumbersData = [];
        

        foreach ($data[0] as $key => $value) {
            //$phoneNumbersData[] = $value;
             //dd($phoneNumbersData[0]);
             $splited = @array_splice($value,4); 
             
             //dd($value['0-Matric']);


            //dd($data[0]); // displays from the courses substr("Hello world",6)
                    
             foreach($splited as $crsid=>$total){
               // Get the id
                //dd(substr($crsid,-6));
                $crsid_id = Course::where('crsid', substr($crsid,-6))
               ->where('level',$request->input('level'))
               ->where('programme_id',$request->input('programme_id'))
               ->where('semester',$request->input('semester'))
               ->where('term_id',$request->input('term_id'))
               ->get()
               ->toArray();
               
              //dd(@$crsid_id[0]['id']);
               
                 //Explode the total score, into exam and ca score
                 @list($ca_score,$exam_score) = @explode('/',$total);
                   $grade_ids = $ca_score + $exam_score;
                 //Put the updates for the cpga here
                // dd($ca_score);
                if($grade_ids >= 70 OR $grade_ids <= 100 ){
                    $grade_id = 1;
                    //DB::table('results')->whereBetween('grade_ids', [70,100])->update(['grade_id' => 1, 'updated_at' => $updated_at]);
                    //$Update = DB::update('UPDATE backups SET grade_id = 1 WHERE grade_id=NULL');
                }
                if($grade_ids >= 60 OR $grade_ids < 70 ){
                    $grade_id = 2;
                    //DB::update('UPDATE backups SET grade_id = 2 WHERE grade_ids=NULL');
                   // DB::table('results')->whereBetween('grade_ids', [60,69])->update(['grade_id' => 2, 'updated_at' => $updated_at]);

                }
                if($grade_ids >= 50 OR $grade_ids < 60 ){
                    $grade_id = 3;
                    //DB::table('results')->whereBetween('grade_ids', [50,59])->update(['grade_id' => 3, 'updated_at' => $updated_at]);

                   // DB::update('UPDATE backups SET grade_id = 3 WHERE grade_id=NULL');
                }
                if($grade_ids >= 45 OR $grade_ids < 50 ){
                    $grade_id =4;
                    //DB::update('UPDATE backups SET grade_id = 4 WHERE grade_id=NULL');
                    //DB::table('results')->whereBetween('grade_ids', [45,49])->update(['grade_id' => 4, 'updated_at' => $updated_at]);

                }
                if($grade_ids >= 40 OR $grade_ids < 45 ){
                    $grade_id =5;
                   // DB::update('UPDATE backups SET grade_id = 5 WHERE grade_id=NULL');
                   //DB::table('results')->whereBetween('grade_ids', [40,44])->update(['grade_id' => 5, 'updated_at' => $updated_at]);

                }
                if($grade_ids >= 0 OR $grade_ids < 40 ){

                    $grade_id =6;
                    //DB::table('results')->whereBetween('grade_ids', [0,39])->update(['grade_id' => 6, 'updated_at' => $updated_at]);

                    
                }
             $insert[] = [
             'matric' => $value['0-Matric'],
             'grade_ids' => $ca_score + $exam_score,
             'grade_id' => $grade_id,
             'ca_score' => $ca_score,
             'mark_score' => $exam_score,
             'mark_total' => 100,
             'status' => $request->input('status'),
             'programme_id' => $request->input('programme_id'),
             'school_id' => $request->input('school_id'),
             'level' => $request->input('level'),
             'semester' => $request->input('semester'),
             'semester_id' => $semester_id,
             'term_id' => $request->input('term_id'),
             'others' => $request->input('term_id'),
             //'course_id' => $request->input('crsid'),
             'crsid' => @$crsid_id[0]['crsid'],
             'course_id' => @$crsid_id[0]['id'],                    
             'created_at' => $created_at,
             'updated_at' => $updated_at,
             ];

             }                                    
                
             
            } 

            if(!empty($insert)){    

                DB::table('results')->insert($insert);
                }
            
      

         /*
        Excel::import(new UsersImport($crsid, $updated_at,$created_at,$programme,$status,$term, $semester, $level
        ),$path);
        */
        return redirect('/exams/upload')->with('message', 'All good!');       
             
    
}


public function resultviewall(Request $request){
    //dd($request);
    
    $date = date("F j, Y"); // Date Format
    $programme_id = $request->input('programme_id'); 
    $school_id = $request->input('school_id');  
    $level = $request->input('level');
    if($request->input('semester') == '1st')
    {
        $semster ='First';}
    else{
        $semster ='Second';   
        } 
    $semester = $semster;    
    $term_id = $request->input('term_id'); 
    $terms = Term::where('name', $request->input('term_id'))->get()->toArray();
    //dd($terms);
    //$terms = Term::all();
    $schools = School::where('id', $request->input('school_id'))->get(); 
    $programmes = Programme::where('id', $request->input('programme_id'))->get(); 
    // Get the courses for the session, level, semester
    $courses = Course::where('programme_id', $request->input('programme_id'))
    ->where('level', $request->input('level'))
    ->where('term_id', @$terms[0]['id'])
    ->where('semester', $request->input('semester'))
    ->get();     
    

    foreach($programmes as $programme){
        $school_id = $programme->school_id;
    }
    // Get the Grades    
    //$grades = Grade::where('school_id',$school_id)->get(); 
    $grades = Grade::all();   

    
 //SELECT students.fname, students.sname, courses.crsid, students.matric, results.grade_ids FROM students JOIN results ON students.matric = results.matric JOIN courses on results.course_id = courses.id
 if($request->input('level') == 100 && $request->input('semester') == '1st' )
   {
    //$sessions = Session::all();
    $terms = Term::where('name', $request->input('term_id'))->get()->toArray();
    $schools = School::where('id', $request->input('school_id'))->get(); 
    $programmes = Programme::where('id', $request->input('programme_id'))->get(); 
    foreach($programmes as $programme){
        $school_id = $programme->school_id;
    }

   
 DB::statement("SET SQL_MODE=''"); //In config\database.php --> "mysql" array Set 'strict' => false to disable all.
    //Number of students in class
 $number_students_class = DB::table('results') 
 ->where('results.programme_id','=', $request->input('programme_id'))
 ->where('results.semester','=', $request->input('semester'))
 ->where('results.level','=', $request->input('level'))
 ->where('results.term_id','=', @$terms[0]['id'])
 ->distinct('results.matric') 
 ->groupBy('results.matric','results.level','results.semester')    
 ->get();

 
 $number_students = count($number_students_class);  


        
    //TotalNumber of students in class(changed to course registration records)
    $total_number_students = DB::table('students') 
    ->where('students.programme_id','=', $request->input('programme_id'))    
    ->where('students.level','=', $request->input('level'))   
    ->select('*') 
    ->get();
    $total_number_students= count($total_number_students);
    // Number of Absent Students
    $difference = $total_number_students -  $number_students;
     //Number of Students with Carry overs less than 60
     $student_withCarryOvers = DB::table('results') 
     ->where('results.programme_id','=', $request->input('programme_id'))
     ->where('results.semester','=', $request->input('semester'))
     ->where('results.level','=', $request->input('level')) 
     ->where('results.term_id','=', @$terms[0]['id'])
     ->where('results.grade_ids','<', 40)  
     ->select('results.matric')    
     ->groupBy('results.matric')    
     ->get();

     //dd($student_withCarryOvers);
    

     $student_withCarryOvers= count($student_withCarryOvers);
     $student_withOutCarryOvers= $number_students - $student_withCarryOvers;
    // dd($student_withOutCarryOvers);
    
    
 $results = DB::table('students')    
 ->leftjoin('results','students.matric','=','results.matric')
 ->leftjoin('courses','results.course_id','=','courses.id')
 ->leftjoin('grades','results.grade_id','=','grades.id')
 ->select('students.sname','students.fname','students.oname','students.matric',
 'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode',
 'courses.unit as courseunit','grades.weighed_point as weighedpoint')
 ->where('results.programme_id','=', $request->input('programme_id'))
 ->where('results.school_id','=', $school_id)
 ->where('results.semester','=', $request->input('semester'))
 ->where('results.level','=', $request->input('level'))
 ->orderBy('students.matric')
 ->orderBy('courses.crsid')          
 ->get();

// dd($results);

 
// For One Level
    $resutltArray = [];
    
    foreach ($results as $result){

        if(!isset($resutltArray[$result->matric])){
            $resutltArray[$result->matric]=['sname' => $result->sname,
                                            'fname' => $result->fname,
                                            'oname' => $result->oname,
                                            'matric' => $result->matric,
                                            'totalUnits' => 0,
                                            'tcp' => 0,
                                            'gpa'=>0                                             
                                           ];
        }
       
        $resutltArray[$result->matric]['results'][] = [
                                            'gradeids' => $result->gradeids,
                                            'coursecode' => $result->coursecode,
                                            'courseunit' => $result->courseunit,
                                            'weighedpoint' => $result->weighedpoint,
                                            'gradeid' => $result->gradeid                                             

                                           ];
        if($result->gradeids < 40 ){
            $resutltArray[$result->matric]['res'][] = [
                                           'gradeidss' => $result->gradeids,
                                           'coursecodes' => $result->coursecode,
                                           'courseunits' => $result->courseunit,
                                           'weighedpoints' => $result->weighedpoint,
                                           'grade_idss' => $result->gradeid                                             

                                                         ];

        }else{
            $resutltArray[$result->matric]['res'][] = [];
        }
                                        
    $resutltArray[$result->matric]['totalUnits']= $resutltArray[$result->matric]['totalUnits'] + $result->courseunit;
    $resutltArray[$result->matric]['tcp']= $resutltArray[$result->matric]['tcp'] + ($result->courseunit * $result->weighedpoint);
    $resutltArray[$result->matric]['gpa']= ($resutltArray[$result->matric]['gpa'] + ($result->courseunit * $result->weighedpoint))/($resutltArray[$result->matric]['totalUnits'] + $result->courseunit);
    }

  //echo '<pre>';
  // print_r($resutltArray);
  //echo '</pre>';
  //echo '<pre>';
  //print_r($resutltArray2);
  //echo '</pre>';
  //die();
     
    
   $data['resutltArray'] = $resutltArray;
   $data['total_number_students']= $total_number_students;
   $data['difference']= $difference;
   $data['student_withCarryOvers'] = $student_withCarryOvers;
   $data['student_withOutCarryOvers'] = $student_withOutCarryOvers;
 
    
   
   return view('exams.result_viewall',['grades'=>$grades,'results'=>$results,'term'=>$term_id,
    'courses'=>$courses,'terms'=>$terms,'schools'=>$schools,'programmes'=>$programmes,
    'semester'=>$semester,'date'=>$date,'level'=>$level,'resutltArray'=>$resutltArray,
    'total_number_students'=>$total_number_students,'difference'=>$difference,
     'student_withCarryOvers'=>$student_withCarryOvers,'student_withOutCarryOvers'=>$student_withOutCarryOvers]);
   /*
   ->withGrades($grades)->withResults($results)
   ->withCourses($courses)->withProgrammes($programmes)
   ->withSessions($sessions)->withSchools($schools)
   ->withResults($results);
   */
}
// 2nd Semester for 100 Level
if($request->input('level') == 100 && $request->input('semester')=='2nd'){
  //Previous
  //$sessions = Session::all();
  $term_id = $request->input('term_id'); 
  $terms = Term::where('name', $request->input('term_id'))->get()->toArray();
  //$terms = Term::where('name', $request->input('term_id'))->get()->toArray();
  $schools = School::where('id', $request->input('school_id'))->get(); 
  $programmes = Programme::where('id', $request->input('programme_id'))->get(); 
  foreach($programmes as $programme){
    $school_id = $programme->school_id;
}
// Get the Grades    
//$grades = Grade::where('school_id',$school_id)->get();
$grades = Grade::all();

DB::statement("SET SQL_MODE=''"); //In config\database.php --> "mysql" array Set 'strict' => false to disable all.
//Number of students in class
$number_students_class = DB::table('results') 
->where('results.programme_id','=', $request->input('programme_id'))
 ->where('results.semester','=', $request->input('semester'))
->where('results.level','=', $request->input('level'))
->where('results.term_id','=', @$terms[0]['id'])
->distinct('results.matric') 
->groupBy('results.matric')    
->get();
$number_students = count($number_students_class);  
   
       
   //TotalNumber of students in class
   $total_number_students = DB::table('students') 
   ->where('students.programme_id','=', $request->input('programme_id'))    
   ->where('students.level','=', $request->input('level'))   
   ->select('*') 
   ->get();
   $total_number_students= count($total_number_students);
   // Number of Absent Students
   $difference = $total_number_students -  $number_students;
    //Number of Students with Carry overs less than 60
    $student_withCarryOvers = DB::table('results') 
    ->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.semester','=', $request->input('semester'))
    ->where('results.term_id','=', @$terms[0]['id'])
    ->where('results.level','=', $request->input('level')) 
    ->where('results.grade_ids','<', 40)  
    ->select('results.matric')    
    ->groupBy('results.matric')    
    ->get();
    $student_withCarryOvers= count($student_withCarryOvers);
    //Number of Students without Carry overs greater than or equal to 60
    
    //$student_withOutCarryOvers= count($student_withOutCarryOvers);
    $student_withOutCarryOvers= $number_students - $student_withCarryOvers;

  $previous = '1st';
  $resultpre = DB::table('students')    
  ->leftjoin('results','students.matric','=','results.matric')
  ->leftjoin('courses','results.course_id','=','courses.id')  
  ->leftjoin('grades','results.grade_id','=','grades.id')
  ->leftjoin('terms','results.term_id','=','terms.id')
  ->select('students.sname','students.fname','students.oname','students.matric',
  'results.grade_ids as gradeids','results.grade_id as gradeid','results.level as levels',
  'results.semester as semesters','courses.crsid as coursecode','courses.unit as courseunit',
  'grades.weighed_point as weighedpoint','terms.name as sessionname')
   ->where('results.school_id','=', $school_id )
  ->where('results.semester','=', $previous)
  ->where('results.level','=', $request->input('level'))
  ->orderBy('students.matric')
 ->orderBy('courses.crsid')             
  ->get();
  
    // Current  Semester
   $results = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.grade_id as gradeid',
    'courses.crsid as coursecode','courses.unit as courseunit',
    'grades.weighed_point as weighedpoint')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id )
    ->where('results.semester','=', $request->input('semester'))
    ->where('results.level','=', $request->input('level'))
    ->orderBy('students.matric')
    ->orderBy('courses.crsid')           
    ->get(); 
    

    //Cummulative
    $resultcum = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode','courses.unit as courseunit','grades.weighed_point as weighedpoint')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id )
    //->where('results.semester','=', $request->input('semester'))
    ->where('results.level','=', $request->input('level'))
    ->orderBy('students.matric')
     ->orderBy('courses.crsid')           
    ->get();
   
    // For One Level
    $resutltArray = [];
    
    foreach ($results as $result){

        if(!isset($resutltArray[$result->matric])){
            $resutltArray[$result->matric]=['sname' => $result->sname,
                                            'fname' => $result->fname,
                                            'oname' => $result->oname,
                                            'matric' => $result->matric,
                                            'totalUnits' => 0,
                                            'tcp' => 0,
                                            'gpa'=>0                                             
                                           ];
        }
       
        $resutltArray[$result->matric]['results'][] = [
                                            'gradeids' => $result->gradeids,
                                            'coursecode' => $result->coursecode,
                                            'courseunit' => $result->courseunit,
                                            'weighedpoint' => $result->weighedpoint
                                                                                        

                                           ];
        if($result->gradeids < 40 ){
            $resutltArray[$result->matric]['res'][] = [
                                           'gradeidss' => $result->gradeids,
                                           'coursecodes' => $result->coursecode,
                                           'courseunits' => $result->courseunit,
                                           'weighedpoints' => $result->weighedpoint
                                                                                      

                                                         ];

        }else{
            $resutltArray[$result->matric]['res'][] = [];
        }
                                        
    $resutltArray[$result->matric]['totalUnits']= $resutltArray[$result->matric]['totalUnits'] + $result->courseunit;
    $resutltArray[$result->matric]['tcp']= $resutltArray[$result->matric]['tcp'] + ($result->courseunit * $result->weighedpoint);
    $resutltArray[$result->matric]['gpa']= ($resutltArray[$result->matric]['gpa'] + ($result->courseunit * $result->weighedpoint))/($resutltArray[$result->matric]['totalUnits'] + $result->courseunit);
    }

    // For Previous Semester
    $resutltArray2 = [];
    
    foreach ($resultpre as $result2){

        if(!isset($resutltArray2[$result2->matric])){
            $resutltArray2[$result2->matric]=[
                                            'sname' => $result2->sname,
                                            'fname' => $result2->fname,
                                             'oname' => $result2->oname,
                                            'matric' => $result2->matric,
                                            'totalUnits' => 0,
                                            'tcp' => 0,
                                            'gpa'=>0                                             
                                           ];
        }
       
        $resutltArray2[$result2->matric]['resultpre'][] = [
                                            'gradeids' => $result2->gradeids,
                                            'coursecode' => $result2->coursecode,
                                            'courseunit' => $result2->courseunit,
                                            'weighedpoint' => $result2->weighedpoint                                            

                                           ];
        if($result2->gradeids < 40 ){
            $resutltArray2[$result2->matric]['respr'][] = [
                                           'gradeidss' => $result2->gradeids,
                                           'coursecodes' => $result2->coursecode,
                                           'courseunits' => $result2->courseunit,
                                           'weighedpoints' => $result2->weighedpoint,
                                           'levelss' => $result2->levels,
                                           'semesterss' => $result2->semesters,                                                                
                                           'sessionnamess' => $result2->sessionname                    

                                                         ];

        }else{
            $resutltArray2[$result2->matric]['respr'][] = [];
        }
     //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
    $resutltArray2[$result2->matric]['totalUnits']= $resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit;
    $resutltArray2[$result2->matric]['tcp']= $resutltArray2[$result2->matric]['tcp'] + ($result2->courseunit * $result2->weighedpoint);
    //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
    //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
    }

    // For Cummulative Semester
    $resutltArray3 = [];
    
    foreach ($resultcum as $result3){

        if(!isset($resutltArray3[$result3->matric])){
            $resutltArray3[$result3->matric]=[
                                            'sname' => $result3->sname,
                                            'fname' => $result3->fname,
                                             'oname' => $result3->oname,
                                            'matric' => $result3->matric,
                                            'totalUnits' => 0,
                                            'tcp' => 0,
                                            'gpa'=>0                                             
                                           ];
        }
       
        $resutltArray3[$result3->matric]['resultcum'][] = [
                                            'gradeids' => $result3->gradeids,
                                            'coursecode' => $result3->coursecode,
                                            'courseunit' => $result3->courseunit,
                                            'weighedpoint' => $result3->weighedpoint                                            

                                           ];
        if($result3->gradeid == NULL ){
            $resutltArray3[$result3->matric]['res'][] = [
                                           'gradeidss' => $result3->gradeids,
                                           'coursecodes' => $result3->coursecode,
                                           'courseunits' => $result3->courseunit,
                                           'weighedpoints' => $result3->weighedpoint                                            

                                                         ];

        }else{
            $resutltArray3[$result3->matric]['res'][] = [];
        }
    //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
    $resutltArray3[$result3->matric]['totalUnits']= $resutltArray3[$result3->matric]['totalUnits'] + $result3->courseunit;
    $resutltArray3[$result3->matric]['tcp']= $resutltArray3[$result3->matric]['tcp'] + ($result3->courseunit * $result3->weighedpoint);
    //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
    //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
    }
  
    
   $data['resutltArray'] = $resutltArray;
   $data['resutltArray2'] = $resutltArray2;
   $data['resutltArray3'] = $resutltArray3;
   $data['total_number_students']= $total_number_students;
   $data['difference']= $difference;
   $data['student_withCarryOvers'] = $student_withCarryOvers;
   $data['student_withOutCarryOvers'] = $student_withOutCarryOvers;  

   return view('exams.result_viewall',['grades'=>$grades,'results'=>$results,'term'=>$term_id,
   'courses'=>$courses,'terms'=>$terms,'schools'=>$schools,'programmes'=>$programmes,
   'semester'=>$semester,'date'=>$date,'level'=>$level,'resutltArray'=>$resutltArray,
    'resutltArray3'=>$resutltArray3, 'resutltArray2'=>$resutltArray2,
   'total_number_students'=>$total_number_students,'difference'=>$difference,
    'student_withCarryOvers'=>$student_withCarryOvers,
    'student_withOutCarryOvers'=>$student_withOutCarryOvers]);
    /*->withGrades($grades)->withResults($result)
    ->withCourses($courses)
    ->withProgrammes($programmes)
    ->withSessions($sessions)
    ->withSchools($schools)
    ->withResults($results); */
    
}
 //SELECT students.fname, students.sname, courses.crsid, students.matric, results.grade_ids FROM students JOIN results ON students.matric = results.matric JOIN courses on results.course_id = courses.id
 if($request->input('level') == 200 && $request->input('semester') == '1st' )
 {
 // $sessions = Session::all();
  $terms = Term::where('name', $request->input('term_id'))->get()->toArray();
  $schools = School::where('id', $request->input('school_id'))->get(); 
  $programmes = Programme::where('id', $request->input('programme_id'))->get(); 
  foreach($programmes as $programme){
    $school_id = $programme->school_id;
}
//$grades = Grade::where('school_id',$school_id)->get();
$grades = Grade::all();


DB::statement("SET SQL_MODE=''"); //In config\database.php --> "mysql" array Set 'strict' => false to disable all.

//Number of students in class
$number_students_class = DB::table('results') 
->where('results.programme_id','=', $request->input('programme_id'))
->where('results.semester','=', $request->input('semester'))
->where('results.level','=', $request->input('level'))
->where('results.term_id','=', @$terms[0]['id'])
->distinct('results.matric') 
->groupBy('results.matric','results.level','results.semester')    
->get();
$number_students = count($number_students_class); 

   
       
   //TotalNumber of students in class
   $total_number_students = DB::table('students') 
   ->where('students.programme_id','=', $request->input('programme_id'))    
   ->where('students.level','=', $request->input('level'))   
   ->select('*') 
   ->get();
   $total_number_students= count($total_number_students);
   
   // Number of Absent Students
   $difference = $number_students -  $number_students;
   

    //Number of Students with Carry overs less than 60
    $student_withCarryOvers = DB::table('results') 
    ->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.semester','=', $request->input('semester'))
    ->where('results.level','=', $request->input('level'))
    ->where('results.term_id','=', @$terms[0]['id']) 
    ->where('results.grade_ids','<', 40)  
    ->select('results.matric')    
    ->groupBy('results.matric')    
    ->get();    
    $student_withCarryOvers= count($student_withCarryOvers);

    //Number of Students without Carry overs greater than or equal to 60
   
    $student_withOutCarryOvers= $number_students - $student_withCarryOvers;
    

    

  $results = DB::table('students')    
->leftjoin('results','students.matric','=','results.matric')
->leftjoin('courses','results.course_id','=','courses.id')
//->leftjoin('grades','results.grade_ids','=','grades.ids')
->leftjoin('grades','results.grade_id','=','grades.id')
->select('students.sname','students.fname','students.oname','students.matric',
'results.grade_ids as gradeids','results.grade_id as gradeid',
'courses.crsid as coursecode','courses.unit as courseunit',
'grades.weighed_point as weighedpoint')
//->where('results.programme_id','=', $request->input('programme_id'))
->where('results.school_id','=', $school_id)
->where('results.semester','=', $request->input('semester'))
//->orWhere('results.level','=', $request->input('level'))
->where('results.level','=', $request->input('level'))
->orderBy('courses.crsid') 
->orderBy('students.matric')         
->get();

//echo '<pre/>';
//print_r($results);
//echo '</pre>';
//die();


//Cummulative for 100L both 1st and 2nd Semester
$resultcum = DB::table('students')    
->leftjoin('results','students.matric','=','results.matric')
->leftjoin('courses','results.course_id','=','courses.id')
//->leftjoin('grades','results.grade_ids','=','grades.ids')
->leftjoin('grades','results.grade_id','=','grades.id')
->leftjoin('terms','results.term_id','=','terms.id')
->select('students.sname','students.fname','students.oname','students.matric',
'results.grade_ids as gradeids','results.grade_id as gradeid',
'courses.crsid as coursecode','courses.unit as courseunit',
'grades.weighed_point as weighedpoint','results.level as levels',
'results.semester as semesters','terms.name as sessionname')
//->where('results.programme_id','=', $request->input('programme_id'))
->where('results.school_id','=', $school_id )
//->where('results.semester','=', $request->input('semester'))
//->where('results.level','=', $request->input('level'))
->where('results.level','=', $request->input('level')-100)
->orderBy('courses.crsid')  
->orderBy('students.matric')        
->get();

// For One Level
  $resutltArray = [];
  
  foreach ($results as $result){

      if(!isset($resutltArray[$result->matric])){
          $resutltArray[$result->matric]=['sname' => $result->sname,
                                          'fname' => $result->fname,
                                          'oname' => $result->oname,
                                          'matric' => $result->matric,
                                          'totalUnits' => 0,
                                          'tcp' => 0,
                                          'gpa'=>0                                             
                                         ];
      }
     
      $resutltArray[$result->matric]['results'][] = [
                                          'gradeids' => $result->gradeids,
                                          'coursecode' => $result->coursecode,
                                          'courseunit' => $result->courseunit,
                                          'weighedpoint' => $result->weighedpoint                                            

                                         ];
      if($result->gradeids < 40 ){
          $resutltArray[$result->matric]['res'][] = [
                                         'gradeidss' => $result->gradeids,
                                         'coursecodes' => $result->coursecode,
                                         'courseunits' => $result->courseunit,
                                         'weighedpoints' => $result->weighedpoint                                            

                                                       ];

      }else{
          $resutltArray[$result->matric]['res'][] = [];
      }
                                      
  $resutltArray[$result->matric]['totalUnits']= $resutltArray[$result->matric]['totalUnits'] + $result->courseunit;
  $resutltArray[$result->matric]['tcp']= $resutltArray[$result->matric]['tcp'] + ($result->courseunit * $result->weighedpoint);
  $resutltArray[$result->matric]['gpa']= ($resutltArray[$result->matric]['gpa'] + ($result->courseunit * $result->weighedpoint))/($resutltArray[$result->matric]['totalUnits'] + $result->courseunit);
  }


  // print_r(get_class_methods($results));
  //die();

  // For Cummulative 100L both 1st and 2nd Semester
  $resutltArray3 = [];
    
  foreach ($resultcum as $result3){

      if(!isset($resutltArray3[$result3->matric])){
          $resutltArray3[$result3->matric]=[
                                          'sname' => $result3->sname,
                                          'fname' => $result3->fname,
                                           'oname' => $result3->oname,
                                          'matric' => $result3->matric,
                                          'totalUnits' => 0,
                                          'tcp' => 0,
                                          'gpa'=>0                                             
                                         ];
      }
     
      $resutltArray3[$result3->matric]['resultcum'][] = [
                                          'gradeids' => $result3->gradeids,
                                          'coursecode' => $result3->coursecode,
                                          'courseunit' => $result3->courseunit,
                                          'weighedpoint' => $result3->weighedpoint                                            

                                         ];
      if($result3->gradeids < 40 ){
          $resutltArray3[$result3->matric]['res'][] = [
                                         'gradeidss' => $result3->gradeids,
                                         'coursecodes' => $result3->coursecode,
                                         'courseunits' => $result3->courseunit,
                                         'weighedpoints' => $result3->weighedpoint,
                                         'levelss' => $result3->levels,
                                         'semesterss' => $result3->semesters,                                                                
                                         'sessionnamess' => $result3->sessionname                                            

                                                       ];

      }else{
          $resutltArray3[$result3->matric]['res'][] = [];
      }
  //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
  $resutltArray3[$result3->matric]['totalUnits']= $resutltArray3[$result3->matric]['totalUnits'] + $result3->courseunit;
  $resutltArray3[$result3->matric]['tcp']= $resutltArray3[$result3->matric]['tcp'] + ($result3->courseunit * $result3->weighedpoint);
  }
  
  
 $data['resutltArray'] = $resutltArray;
 $data['resutltArray3'] = $resutltArray3; 
 //$data['resutltArray2'] = $resutltArray2;
$data['total_number_students']= $total_number_students;
$data['difference']= $difference;
$data['student_withCarryOvers'] = $student_withCarryOvers;
$data['student_withOutCarryOvers'] = $student_withOutCarryOvers;
  
 
return view('exams.result_viewall',['grades'=>$grades,'results'=>$results,'term'=>$term_id,
'courses'=>$courses,'terms'=>$terms,'schools'=>$schools,'programmes'=>$programmes,
'semester'=>$semester,'date'=>$date,'level'=>$level,'resutltArray'=>$resutltArray,
 'resutltArray3'=>$resutltArray3,'total_number_students'=>$total_number_students,
 'difference'=>$difference, 'student_withCarryOvers'=>$student_withCarryOvers,
 'student_withOutCarryOvers'=>$student_withOutCarryOvers]);
 /*->withGrades($grades)
 ->withResults($result)
 ->withCourses($courses)
 ->withProgrammes($programmes)
 ->withSessions($sessions)
 ->withSchools($schools)
 ->withResults($results);
 */
}

// 2nd Semester for 200 Level
if($request->input('level') == 200 && $request->input('semester')=='2nd'){
    //Previous
    //$sessions = Session::all();
    $terms = Term::where('name', $request->input('term_id'))->get()->toArray();
    $schools = School::where('id', $request->input('school_id'))->get(); 
    $programmes = Programme::where('id', $request->input('programme_id'))->get(); 
    foreach($programmes as $programme){
        $school_id = $programme->school_id;
    }
    //$grades = Grade::where('school_id',$school_id)->get();
    $grades = Grade::all();

    //Number of students in class
$number_students_class = DB::table('results') 
->where('results.programme_id','=', $request->input('programme_id'))
->where('results.semester','=', $request->input('semester'))
->where('results.level','=', $request->input('level'))
->where('results.term_id','=', @$terms[0]['id'])
->distinct('results.matric') 
->groupBy('results.matric','results.level','results.semester')    
->get();
$number_students = count($number_students_class);  
   
       
   //TotalNumber of students in class
   $total_number_students = DB::table('students') 
   ->where('students.programme_id','=', $request->input('programme_id'))    
   ->where('students.level','=', $request->input('level'))   
   ->select('*') 
   ->get();
   $total_number_students= count($total_number_students);
   
   // Number of Absent Students
   $difference = $number_students -  $number_students;

    //Number of Students with Carry overs less than 40
    $student_withCarryOvers = DB::table('results') 
    ->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.semester','=', $request->input('semester'))
    ->where('results.level','=', $request->input('level')) 
    ->where('results.term_id','=', @$terms[0]['id'])
    ->where('results.grade_ids','<', 40)  
    ->select('results.matric')    
    ->groupBy('results.matric')    
    ->get();    
    $student_withCarryOvers= count($student_withCarryOvers);

    //Number of Students without Carry overs greater than or equal to 40
    
    $student_withOutCarryOvers= $number_students - $student_withCarryOvers;

    //$previous = '1st';
    // 1st Semester 200L, 100L 1ST AND 2ND SEMESTER
    $id = 4;  // 1- 100L 1ST, 2- 100 2ND, 3 - 200 1ST , 4 -200 2ND
    $resultpre3 = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->leftjoin('terms','results.term_id','=','terms.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.level as levels',
    'results.semester as semesters','results.grade_id as gradeid',
    'courses.crsid as coursecode','courses.unit as courseunit',
    'grades.weighed_point as weighedpoint','terms.name as sessionname')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    ->where('results.semester_id','<', $id)
    ->where('results.grade_ids','<', 40)
    ->orderBy('courses.crsid')
    ->orderBy('results.matric')
    //->groupBy('students.matric')          
    ->get();
    
    $previous = '1st';
    // 1st Semester 200L
    $resultpre = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->leftjoin('terms','results.term_id','=','terms.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.level as levels',
    'results.semester as semesters','results.grade_id as gradeid',
    'courses.crsid as coursecode','courses.unit as courseunit',
    'grades.weighed_point as weighedpoint','sessions.name as sessionname')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    ->where('results.semester','=', $previous)
    ->where('results.level','=', $request->input('level'))
    ->orderBy('courses.crsid')
    ->orderBy('students.matric')
    //->groupBy('students.matric')          
    ->get();
    
      // Current   
     $results = DB::table('students')    
      ->leftjoin('results','students.matric','=','results.matric')
      ->leftjoin('courses','results.course_id','=','courses.id')
     // ->leftjoin('grades','results.grade_ids','=','grades.ids')
      ->leftjoin('grades','results.grade_id','=','grades.id')
      ->select('students.sname','students.fname','students.oname','students.matric',
      'results.grade_ids as gradeids','results.grade_id as gradeid',
      'courses.crsid as coursecode','courses.unit as courseunit',
      'grades.weighed_point as weighedpoint')
      ->where('results.programme_id','=', $request->input('programme_id'))
      ->where('results.semester','=', $request->input('semester'))
      ->where('results.level','=', $request->input('level'))
      ->orderBy('courses.crsid')
      ->orderBy('students.matric')          
      ->get(); 
      
  
      //Cummulative of 200L both 1st and 2nd Semester
      $resultcum = DB::table('students')    
      ->leftjoin('results','students.matric','=','results.matric')
      ->leftjoin('courses','results.course_id','=','courses.id')
      ->leftjoin('grades','results.grade_id','=','grades.id')
      ->select('students.sname','students.fname','students.oname','students.matric',
      'results.grade_ids as gradeids','results.grade_id as gradeid',
      'courses.crsid as coursecode','courses.unit as courseunit',
      'grades.weighed_point as weighedpoint')
      ->where('results.programme_id','=', $request->input('programme_id'))
      //->where('results.semester','=', $request->input('semester'))
      ->where('results.level','=', $request->input('level'))
      ->orderBy('courses.crsid') 
      ->orderBy('students.matric')        
      ->get();

    //100L 1st semester
    $resultpre1 = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->leftjoin('terms','results.term_id','=','terms.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.grade_id as gradeid',
    'results.level as levels','results.semester as semesters',
    'courses.crsid as coursecode','courses.unit as courseunit',
    'grades.weighed_point as weighedpoint','sessions.name as sessionname')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    ->where('results.semester','=', $previous)
    ->where('results.level','=', $request->input('level') - 100)
    ->orderBy('courses.crsid')
    ->orderBy('students.matric')
    //->groupBy('students.matric')          
    ->get();

    //100L 1st semester
    $previous1 ='2nd';
    $resultpre2 = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->leftjoin('terms','results.term_id','=','terms.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.grade_id as gradeid',
    'courses.crsid as coursecode','courses.unit as courseunit',
    'results.level as levels','results.semester as semesters',
    'grades.weighed_point as weighedpoint','terms.name as sessionname')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    ->where('results.semester','=', $previous1)
    ->where('results.level','=', $request->input('level') - 100)
    ->orderBy('courses.crsid')
    ->orderBy('students.matric')          
    ->get();
     
      // For One Level
      $resutltArray = [];
      
      foreach ($results as $result){
  
          if(!isset($resutltArray[$result->matric])){
              $resutltArray[$result->matric]=['sname' => $result->sname,
                                              'fname' => $result->fname,
                                              'oname' => $result->oname,
                                              'matric' => $result->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray[$result->matric]['results'][] = [
                                              'gradeids' => $result->gradeids,
                                              'coursecode' => $result->coursecode,
                                              'courseunit' => $result->courseunit,
                                              'weighedpoint' => $result->weighedpoint                                            
  
                                             ];
          if($result->gradeids < 40 ){
              $resutltArray[$result->matric]['res'][] = [
                                             'gradeidss' => $result->gradeids,
                                             'coursecodes' => $result->coursecode,
                                             'courseunits' => $result->courseunit,
                                             'weighedpoints' => $result->weighedpoint                                            
  
                                                           ];
  
          }else{
              $resutltArray[$result->matric]['res'][] = [];
          }
                                          
      $resutltArray[$result->matric]['totalUnits']= $resutltArray[$result->matric]['totalUnits'] + $result->courseunit;
      $resutltArray[$result->matric]['tcp']= $resutltArray[$result->matric]['tcp'] + ($result->courseunit * $result->weighedpoint);
      $resutltArray[$result->matric]['gpa']= ($resutltArray[$result->matric]['gpa'] + ($result->courseunit * $result->weighedpoint))/($resutltArray[$result->matric]['totalUnits'] + $result->courseunit);
      }
  
      // For Previous Semester for 200L i.e 1st
      $resutltArray2 = [];
      
      foreach ($resultpre as $result2){
  
          if(!isset($resutltArray2[$result2->matric])){
              $resutltArray2[$result2->matric]=[
                                              'sname' => $result2->sname,
                                              'fname' => $result2->fname,
                                               'oname' => $result2->oname,
                                              'matric' => $result2->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray2[$result2->matric]['resultpre'][] = [
                                              'gradeids' => $result2->gradeids,
                                              'coursecode' => $result2->coursecode,
                                              'courseunit' => $result2->courseunit,
                                              'weighedpoint' => $result2->weighedpoint                                            
  
                                             ];
          if($result2->gradeids < 60 ){
              $resutltArray2[$result2->matric]['respre'][] = [
                                             'gradeidss' => $result2->gradeids,
                                             'coursecodes' => $result2->coursecode,
                                             'courseunits' => $result2->courseunit,
                                             'weighedpoints' => $result2->weighedpoint,
                                              'levelss' => $result2->levels,
                                              'semesterss' => $result2->semesters,                                                                
                                              'sessionnamess' => $result2->sessionname                                            
  
                                                           ];
  
          }else{
              $resutltArray2[$result2->matric]['respre'][] = [];
          }
       $tcp = $result2->courseunit * $result2->weighedpoint;                                  
      $resutltArray2[$result2->matric]['totalUnits']= $resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit;
      $resutltArray2[$result2->matric]['tcp']= $resutltArray2[$result2->matric]['tcp'] + ($result2->courseunit * $result2->weighedpoint);
      //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
      //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
      }
  
      // For Cummulative Semester
      $resutltArray3 = [];
      
      foreach ($resultcum as $result3){
  
          if(!isset($resutltArray3[$result3->matric])){
              $resutltArray3[$result3->matric]=[
                                              'sname' => $result3->sname,
                                              'fname' => $result3->fname,
                                               'oname' => $result3->oname,
                                              'matric' => $result3->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray3[$result3->matric]['resultcum'][] = [
                                              'gradeids' => $result3->gradeids,
                                              'coursecode' => $result3->coursecode,
                                              'courseunit' => $result3->courseunit,
                                              'weighedpoint' => $result3->weighedpoint                                            
  
                                             ];
          if($result3->gradeids < 60 ){
              $resutltArray3[$result3->matric]['res'][] = [
                                             'gradeidss' => $result3->gradeids,
                                             'coursecodes' => $result3->coursecode,
                                             'courseunits' => $result3->courseunit,
                                             'weighedpoints' => $result3->weighedpoint                                            
  
                                                           ];
  
          }else{
              $resutltArray3[$result3->matric]['res'][] = [];
          }
      //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
      $resutltArray3[$result3->matric]['totalUnits']= $resutltArray3[$result3->matric]['totalUnits'] + $result3->courseunit;
      $resutltArray3[$result3->matric]['tcp']= $resutltArray3[$result3->matric]['tcp'] + ($result3->courseunit * $result3->weighedpoint);
      //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
      //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
      }

      // 100L ...1st Semester
      $resutltArray4 = [];
      
      foreach ($resultpre1 as $result4){
  
          if(!isset($resutltArray4[$result4->matric])){
              $resutltArray4[$result4->matric]=[
                                              'sname' => $result4->sname,
                                              'fname' => $result4->fname,
                                               'oname' => $result4->oname,
                                              'matric' => $result4->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray4[$result4->matric]['resultpre1'][] = [
                                              'gradeids' => $result4->gradeids,
                                              'coursecode' => $result4->coursecode,
                                              'courseunit' => $result4->courseunit,
                                              'weighedpoint' => $result4->weighedpoint                                            
  
                                             ];
          if($result4->gradeids < 60 ){
              $resutltArray4[$result4->matric]['respre1'][] = [
                                             'gradeidss' => $result4->gradeids,
                                             'coursecodes' => $result4->coursecode,
                                             'courseunits' => $result4->courseunit,
                                             'weighedpoints' => $result4->weighedpoint,
                                             'levelss' => $result4->levels,
                                              'semesterss' => $result4->semesters,                                                                
                                              'sessionnamess' => $result4->sessionname                                             
  
                                                           ];
  
          }else{
              $resutltArray4[$result4->matric]['respre1'][] = [];
          }
       $tcp = $result4->courseunit * $result4->weighedpoint;                                  
      $resutltArray4[$result4->matric]['totalUnits']= $resutltArray4[$result4->matric]['totalUnits'] + $result4->courseunit;
      $resutltArray4[$result4->matric]['tcp']= $resutltArray4[$result4->matric]['tcp'] + ($result4->courseunit * $result4->weighedpoint);
      //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
      //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
      }


      // 100L ...2nd Semester
      $resutltArray5 = [];
      
      foreach ($resultpre2 as $result5){
  
          if(!isset($resutltArray5[$result5->matric])){
              $resutltArray5[$result5->matric]=[
                                              'sname' => $result5->sname,
                                              'fname' => $result5->fname,
                                               'oname' => $result5->oname,
                                              'matric' => $result5->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray5[$result5->matric]['resultpre2'][] = [
                                              'gradeids' => $result5->gradeids,
                                              'coursecode' => $result5->coursecode,
                                              'courseunit' => $result5->courseunit,
                                              'weighedpoint' => $result5->weighedpoint                                            
  
                                             ];
          if($result5->gradeids < 60 ){
              $resutltArray5[$result5->matric]['respre2'][] = [
                                             'gradeidss' => $result5->gradeids,
                                             'coursecodes' => $result5->coursecode,
                                             'courseunits' => $result5->courseunit,
                                             'weighedpoints' => $result5->weighedpoint,
                                             'levelss' => $result5->levels,
                                              'semesterss' => $result5->semesters,                                                                
                                              'sessionnamess' => $result5->sessionname                                             
  
                                                           ];
  
          }else{
              $resutltArray5[$result5->matric]['respre2'][] = [];
          }
       $tcp = $result5->courseunit * $result5->weighedpoint;                                  
      $resutltArray5[$result5->matric]['totalUnits']= $resutltArray5[$result5->matric]['totalUnits'] + $result5->courseunit;
      $resutltArray5[$result5->matric]['tcp']= $resutltArray5[$result5->matric]['tcp'] + ($result5->courseunit * $result5->weighedpoint);
      }

      // For FIRST SEMETSER 200L, 100L FIRST AND SECOND SEMESTER
      $resutltArray6 = [];
      
      foreach ($resultpre3 as $result6){
  
          if(!isset($resutltArray6[$result6->matric])){
              $resutltArray6[$result6->matric]=['sname' => $result6->sname,
                                              'fname' => $result6->fname,
                                              'oname' => $result6->oname,
                                              'matric' => $result6->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray6[$result6->matric]['resultpre3'][] = [
                                              'gradeids' => $result6->gradeids,
                                              'coursecode' => $result6->coursecode,
                                              'courseunit' => $result6->courseunit,
                                              'weighedpoint' => $result6->weighedpoint, 
                                              'levelss' => $result6->levels,
                                              'semesterss' => $result6->semesters,                                                                
                                              'sessionnamess' => $result6->sessionname                                             
  
                                             ];
          
                                          
      $resutltArray6[$result6->matric]['totalUnits']= $resutltArray6[$result6->matric]['totalUnits'] + $result6->courseunit;
      $resutltArray6[$result6->matric]['tcp']= $resutltArray6[$result6->matric]['tcp'] + ($result6->courseunit * $result6->weighedpoint);
      $resutltArray6[$result6->matric]['gpa']= ($resutltArray6[$result6->matric]['gpa'] + ($result6->courseunit * $result6->weighedpoint))/($resutltArray6[$result6->matric]['totalUnits'] + $result6->courseunit);
      }

    
      
     $data['resutltArray'] = $resutltArray;
     $data['resutltArray2'] = $resutltArray2;
     $data['resutltArray3'] = $resutltArray3;
     $data['resutltArray4'] = $resutltArray4;
     $data['resutltArray5'] = $resutltArray5; 
     $data['resutltArray6'] = $resutltArray6; 
     $data['total_number_students']= $total_number_students;
     $data['difference']= $difference;
     $data['student_withCarryOvers'] = $student_withCarryOvers;
     $data['student_withOutCarryOvers'] = $student_withOutCarryOvers;      
      return view('admin.result.result_viewall',['grades'=>$grades,'result'=>$result,
      'courses'=>$courses,'programmes'=>$programmes,'terms'=>$terms,'schools'=>$schools,
      'results'=>$results]);
      /*
      ->withGrades($grades)
      ->withResults($result)
      ->withCourses($courses)
      ->withProgrammes($programmes)
      ->withSessions($sessions)
      ->withSchools($schools)
      ->withResults($results);
      */
      
  }


  //SELECT students.fname, students.sname, courses.crsid, students.matric, results.grade_ids FROM students JOIN results ON students.matric = results.matric JOIN courses on results.course_id = courses.id
 if($request->input('level') == 300 && $request->input('semester') == '1st' )
 {
  //$sessions = Session::all();
  $terms = Term::where('name', $request->input('term_id'))->get()->toArray();
  $schools = School::where('id', $request->input('school_id'))->get(); 
  $programmes = Programme::where('id', $request->input('programme_id'))->get(); 
  foreach($programmes as $programme){
    $school_id = $programme->school_id;
}
//$grades = Grade::where('school_id',$school_id)->get();
$grades = Grade::all();

//Number of students in class
$number_students_class = DB::table('results') 
->where('results.programme_id','=', $request->input('programme_id'))
->where('results.semester','=', $request->input('semester'))
->where('results.level','=', $request->input('level'))
->where('results.term_id','=', $terms[0]['id'])
->distinct('results.matric') 
->groupBy('results.matric','results.level','results.semester')    
->get();
$number_students = count($number_students_class);  
   
       
   //TotalNumber of students in class(change to course registration)
   $total_number_students = DB::table('students') 
   ->where('students.programme_id','=', $request->input('programme_id'))    
   ->where('students.level','=', $request->input('level'))   
   ->select('*') 
   ->get();
   $total_number_students= count($total_number_students);
   
   // Number of Absent Students
   $difference = $number_students -  $number_students;

    //Number of Students with Carry overs less than 45
    $student_withCarryOvers = DB::table('results') 
    ->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.semester','=', $request->input('semester'))
    ->where('results.level','=', $request->input('level')) 
    ->where('results.grade_ids','<', 45)  
    ->select('results.matric')    
    ->groupBy('results.matric')    
    ->get();    
    $student_withCarryOvers= count($student_withCarryOvers);

    //Number of Students without Carry overs greater than or equal to 45
    $student_withOutCarryOvers= $number_students - $student_withCarryOvers;


//$previous = '1st';
    // 1st AND 2ND Semester 200L, 100L 1ST AND 2ND SEMESTER
    $id = 5;  // 1- 100L 1ST, 2- 100 2ND, 3 - 200 1ST , 4 -200 2ND
    $resultpre3 = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->leftjoin('terms','results.term_id','=','terms.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.level as levels',
    'results.semester as semesters','results.grade_id as gradeid',
    'courses.crsid as coursecode','courses.unit as courseunit',
    'grades.weighed_point as weighedpoint','terms.name as sessionname')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    ->where('results.semester_id','<', $id)
    ->where('results.grade_ids','<', 40)
    ->orderBy('courses.crsid')
    ->orderBy('students.matric')
    //->groupBy('students.matric')          
    ->get();

$results = DB::table('students')    
->leftjoin('results','students.matric','=','results.matric')
->leftjoin('courses','results.course_id','=','courses.id')
->leftjoin('grades','results.grade_id','=','grades.id')
->leftjoin('terms','results.term_id','=','terms.id')
->select('students.sname','students.fname','students.oname','students.matric',
'results.grade_ids as gradeids','results.grade_id as gradeid',
'courses.crsid as coursecode','courses.unit as courseunit',
'grades.weighed_point as weighedpoint','terms.name as sessionname')
->where('results.school_id','=', $school_id)
->where('results.semester','=', $request->input('semester'))
->where('results.level','=', $request->input('level'))
->orderBy('courses.crsid') 
->orderBy('students.matric')         
->get();

//Cummulative for 200L both 1st and 2nd Semester
$resultcum = DB::table('students')    
->leftjoin('results','students.matric','=','results.matric')
->leftjoin('courses','results.course_id','=','courses.id')
//->leftjoin('grades','results.grade_ids','=','grades.ids')
->leftjoin('grades','results.grade_id','=','grades.id')
->select('students.sname','students.fname','students.oname','students.matric',
'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode','courses.unit as courseunit','grades.weighed_point as weighedpoint')
//->where('results.programme_id','=', $request->input('programme_id'))
->where('results.school_id','=', $school_id )
//->where('results.semester','=', $request->input('semester'))
//->where('results.level','=', $request->input('level'))
->where('results.level','=', $request->input('level')-100)
->orderBy('courses.crsid')
->orderBy('students.matric')          
->get();

//Cummulative for 100L both 1st and 2nd Semester
$resultcum1 = DB::table('students')    
->leftjoin('results','students.matric','=','results.matric')
->leftjoin('courses','results.course_id','=','courses.id')
//->leftjoin('grades','results.grade_ids','=','grades.ids')
->leftjoin('grades','results.grade_id','=','grades.id')
->select('students.sname','students.fname','students.oname','students.matric',
'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode','courses.unit as courseunit','grades.weighed_point as weighedpoint')
//->where('results.programme_id','=', $request->input('programme_id'))
->where('results.school_id','=', $school_id )
//->where('results.semester','=', $request->input('semester'))
//->where('results.level','=', $request->input('level'))
->where('results.level','=', $request->input('level')-200)
->orderBy('courses.crsid') 
->orderBy('students.matric')         
->get();

// For One Level
  $resutltArray = [];
  
  foreach ($results as $result){

      if(!isset($resutltArray[$result->matric])){
          $resutltArray[$result->matric]=['sname' => $result->sname,
                                          'fname' => $result->fname,
                                          'oname' => $result->oname,
                                          'matric' => $result->matric,
                                          'totalUnits' => 0,
                                          'tcp' => 0,
                                          'gpa'=>0                                             
                                         ];
      }
     
      $resutltArray[$result->matric]['results'][] = [
                                          'gradeids' => $result->gradeids,
                                          'coursecode' => $result->coursecode,
                                          'courseunit' => $result->courseunit,
                                          'weighedpoint' => $result->weighedpoint                                            

                                         ];
      if($result->gradeids < 60 ){
          $resutltArray[$result->matric]['res'][] = [
                                         'gradeidss' => $result->gradeids,
                                         'coursecodes' => $result->coursecode,
                                         'courseunits' => $result->courseunit,
                                         'weighedpoints' => $result->weighedpoint                                            

                                                       ];

      }else{
          $resutltArray[$result->matric]['res'][] = [];
      }
                                      
  $resutltArray[$result->matric]['totalUnits']= $resutltArray[$result->matric]['totalUnits'] + $result->courseunit;
  $resutltArray[$result->matric]['tcp']= $resutltArray[$result->matric]['tcp'] + ($result->courseunit * $result->weighedpoint);
  $resutltArray[$result->matric]['gpa']= ($resutltArray[$result->matric]['gpa'] + ($result->courseunit * $result->weighedpoint))/($resutltArray[$result->matric]['totalUnits'] + $result->courseunit);
  }

  // For Cummulative 200L both 1st and 2nd Semester
  $resutltArray3 = [];
    
  foreach ($resultcum as $result3){

      if(!isset($resutltArray3[$result3->matric])){
          $resutltArray3[$result3->matric]=[
                                          'sname' => $result3->sname,
                                          'fname' => $result3->fname,
                                           'oname' => $result3->oname,
                                          'matric' => $result3->matric,
                                          'totalUnits' => 0,
                                          'tcp' => 0,
                                          'gpa'=>0                                             
                                         ];
      }
     
      $resutltArray3[$result3->matric]['resultcum'][] = [
                                          'gradeids' => $result3->gradeids,
                                          'coursecode' => $result3->coursecode,
                                          'courseunit' => $result3->courseunit,
                                          'weighedpoint' => $result3->weighedpoint                                            

                                         ];
      if($result3->gradeids < 40 ){
          $resutltArray3[$result3->matric]['res'][] = [
                                         'gradeidss' => $result3->gradeids,
                                         'coursecodes' => $result3->coursecode,
                                         'courseunits' => $result3->courseunit,
                                         'weighedpoints' => $result3->weighedpoint                                            

                                                       ];

      }else{
          $resutltArray3[$result3->matric]['res'][] = [];
      }
  //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
  $resutltArray3[$result3->matric]['totalUnits']= $resutltArray3[$result3->matric]['totalUnits'] + $result3->courseunit;
  $resutltArray3[$result3->matric]['tcp']= $resutltArray3[$result3->matric]['tcp'] + ($result3->courseunit * $result3->weighedpoint);
  }

  // For Cummulative 100L both 1st and 2nd Semester
  $resutltArray4 = [];
    
  foreach ($resultcum1 as $result4){

      if(!isset($resutltArray4[$result4->matric])){
          $resutltArray4[$result4->matric]=[
                                          'sname' => $result4->sname,
                                          'fname' => $result4->fname,
                                           'oname' => $result4->oname,
                                          'matric' => $result4->matric,
                                          'totalUnits' => 0,
                                          'tcp' => 0,
                                          'gpa'=>0                                             
                                         ];
      }
     
      $resutltArray4[$result4->matric]['resultcum'][] = [
                                          'gradeids' => $result4->gradeids,
                                          'coursecode' => $result4->coursecode,
                                          'courseunit' => $result4->courseunit,
                                          'weighedpoint' => $result4->weighedpoint                                            

                                         ];
      if($result4->gradeids < 40 ){
          $resutltArray4[$result4->matric]['res'][] = [
                                         'gradeidss' => $result4->gradeids,
                                         'coursecodes' => $result4->coursecode,
                                         'courseunits' => $result4->courseunit,
                                         'weighedpoints' => $result4->weighedpoint                                            

                                                       ];

      }else{
          $resutltArray4[$result4->matric]['res'][] = [];
      }
  //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
  $resutltArray4[$result4->matric]['totalUnits']= $resutltArray4[$result4->matric]['totalUnits'] + $result4->courseunit;
  $resutltArray4[$result4->matric]['tcp']= $resutltArray4[$result4->matric]['tcp'] + ($result4->courseunit * $result4->weighedpoint);
  }

  // For FIRST AND SECOND SEMETSER 200L, 100L FIRST AND SECOND SEMESTER
  $resutltArray6 = [];
      
  foreach ($resultpre3 as $result6){

      if(!isset($resutltArray6[$result6->matric])){
          $resutltArray6[$result6->matric]=['sname' => $result6->sname,
                                          'fname' => $result6->fname,
                                          'oname' => $result6->oname,
                                          'matric' => $result6->matric,
                                          'totalUnits' => 0,
                                          'tcp' => 0,
                                          'gpa'=>0                                             
                                         ];
      }
     
      $resutltArray6[$result6->matric]['resultpre3'][] = [
                                          'gradeids' => $result6->gradeids,
                                          'coursecode' => $result6->coursecode,
                                          'courseunit' => $result6->courseunit,
                                          'weighedpoint' => $result6->weighedpoint, 
                                          'levelss' => $result6->levels,
                                          'semesterss' => $result6->semesters,                                                                
                                          'sessionnamess' => $result6->sessionname                                             

                                         ];
      
                                      
  $resutltArray6[$result6->matric]['totalUnits']= $resutltArray6[$result6->matric]['totalUnits'] + $result6->courseunit;
  $resutltArray6[$result6->matric]['tcp']= $resutltArray6[$result6->matric]['tcp'] + ($result6->courseunit * $result6->weighedpoint);
  $resutltArray6[$result6->matric]['gpa']= ($resutltArray6[$result6->matric]['gpa'] + ($result6->courseunit * $result6->weighedpoint))/($resutltArray6[$result6->matric]['totalUnits'] + $result6->courseunit);
  }
  
  
 $data['resutltArray'] = $resutltArray;
 $data['resutltArray3'] = $resutltArray3; 
 $data['resutltArray4'] = $resutltArray4; 
 $data['resutltArray6'] = $resutltArray6;
 $data['total_number_students']= $total_number_students;
 $data['difference']= $difference;
 $data['student_withCarryOvers'] = $student_withCarryOvers;
 $data['student_withOutCarryOvers'] = $student_withOutCarryOvers;
 
 return view('admin.result.result_viewall',['grades'=>$grades,'result'=>$result,
 'courses'=>$courses,'programmes'=>$programmes,'terms'=>$terms,'schools'=>$schools,
 'results'=>$results]);
 /*
 ->withGrades($grades)
 ->withResults($result)
 ->withCourses($courses)
 ->withProgrammes($programmes)
 ->withSessions($sessions)
 ->withSchools($schools)
 ->withResults($results);
 */
}

// 2nd Semester for 300 Level
if($request->input('level') == 300 && $request->input('semester')=='2nd'){
    //Previous
    //$sessions = Session::all();
    $terms = Term::where('name', $request->input('session'))->get()->toArray();
    $schools = School::where('id', $request->input('school_id'))->get(); 
    $programmes = Programme::where('id', $request->input('programme_id'))->get(); 
    foreach($programmes as $programme){
        $school_id = $programme->school_id;
    }
    $grades = Grade::where('school_id',$school_id)->get();

    //Number of students in class
$number_students_class = DB::table('results') 
->where('results.programme_id','=', $request->input('programme_id'))
->where('results.semester','=', $request->input('semester'))
->where('results.level','=', $request->input('level'))
->where('results.term_id','=', @$terms[0]['id'])
->distinct('results.matric') 
->groupBy('results.matric','results.level','results.semester')    
->get();
//var_dump($number_students_class);

$number_students = count($number_students_class);  
   
       
   //TotalNumber of students in class(change to course registration)
   $total_number_students = DB::table('students') 
   ->where('students.programme_id','=', $request->input('programme_id'))    
   ->where('students.level','=', $request->input('level'))   
   ->select('*') 
   ->get();
   $total_number_students= count($total_number_students);   
   
   // Number of Absent Students
   $difference = $number_students -  $number_students;

    //Number of Students with Carry overs less than 40
    $student_withCarryOvers = DB::table('results') 
    ->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.semester','=', $request->input('semester'))
    ->where('results.level','=', $request->input('level')) 
    ->where('results.term_id','=', @$terms[0]['id'])
    ->where('results.grade_ids','<', 40)  
    ->select('results.matric')    
    ->groupBy('results.matric')    
    ->get();    
    $student_withCarryOvers= count($student_withCarryOvers);

    //Number of Students without Carry overs greater than or equal to 60   
    $student_withOutCarryOvers= $number_students - $student_withCarryOvers;


//$previous = '1st';
    // 1ST SEMESTER 300L 1st AND 2ND Semester 200L, 100L 1ST AND 2ND SEMESTER
    $id = 6;  // 1- 100L 1ST, 2- 100 2ND, 3 - 200 1ST , 4 -200 2ND
    $resultpre3 = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->leftjoin('terms','results.term_id','=','terms.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.level as levels',
    'results.semester as semesters','results.grade_id as gradeid',
    'courses.crsid as coursecode','courses.unit as courseunit',
    'grades.weighed_point as weighedpoint','terms.name as sessionname')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    ->where('results.semester_id','<', $id)
    ->where('results.grade_ids','<', 40)
    ->orderBy('courses.crsid')
    ->orderBy('results.matric')
    ->orderBy('students.matric')
    //->groupBy('students.matric')          
    ->get();

    $previous = '1st';
    // 1st Semester 300L
    $resultpre = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode',
    'courses.unit as courseunit','grades.weighed_point as weighedpoint')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    ->where('results.semester','=', $previous)
    ->where('results.level','=', $request->input('level'))
    ->orderBy('courses.crsid')
    ->orderBy('students.matric')
    //->groupBy('students.matric')          
    ->get();
    
      // Current   300L i.e 2nd Semester
     $results = DB::table('students')    
      ->leftjoin('results','students.matric','=','results.matric')
      ->leftjoin('courses','results.course_id','=','courses.id')
     // ->leftjoin('grades','results.grade_ids','=','grades.ids')
      ->leftjoin('grades','results.grade_id','=','grades.id')
      ->select('students.sname','students.fname','students.oname','students.matric',
      'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode','courses.unit as courseunit','grades.weighed_point as weighedpoint')
      ->where('results.programme_id','=', $request->input('programme_id'))
      ->where('results.semester','=', $request->input('semester'))
      ->where('results.level','=', $request->input('level'))
      ->orderBy('courses.crsid') 
      ->orderBy('students.matric')         
      ->get(); 
      
  
      //Cummulative of 300L both 1st and 2nd Semester
      $resultcum = DB::table('students')    
      ->leftjoin('results','students.matric','=','results.matric')
      ->leftjoin('courses','results.course_id','=','courses.id')
      ->leftjoin('grades','results.grade_id','=','grades.id')
      ->select('students.sname','students.fname','students.oname','students.matric',
      'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode',
      'courses.unit as courseunit','grades.weighed_point as weighedpoint')
      ->where('results.programme_id','=', $request->input('programme_id'))
      //->where('results.semester','=', $request->input('semester'))
      ->where('results.level','=', $request->input('level'))
      ->orderBy('courses.crsid') 
      ->orderBy('students.matric')         
      ->get();

    //200L 1st semester and 2nd Semester
    $resultpre1 = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode','courses.unit as courseunit','grades.weighed_point as weighedpoint')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    //->where('results.semester','=', $previous)
    ->where('results.level','=', $request->input('level') - 100)
    ->orderBy('courses.crsid')
    ->orderBy('students.matric')
    //->groupBy('students.matric')          
    ->get();

    //100L 1st semester and Semester
    //$previous1 ='2nd';
    $resultpre2 = DB::table('students')    
    ->leftjoin('results','students.matric','=','results.matric')
    ->leftjoin('courses','results.course_id','=','courses.id')
    //->leftjoin('grades','results.grade_ids','=','grades.ids')
    ->leftjoin('grades','results.grade_id','=','grades.id')
    ->select('students.sname','students.fname','students.oname','students.matric',
    'results.grade_ids as gradeids','results.grade_id as gradeid','courses.crsid as coursecode',
    'courses.unit as courseunit','grades.weighed_point as weighedpoint')
    //->where('results.programme_id','=', $request->input('programme_id'))
    ->where('results.school_id','=', $school_id)
    //->where('results.semester','=', $previous1)
    ->where('results.level','=', $request->input('level') - 200)
    ->orderBy('courses.crsid')
    ->orderBy('students.matric')
    //->groupBy('students.matric')          
    ->get();
     
      // For 300L 2nd Semester
      $resutltArray = [];
      
      foreach ($results as $result){
  
          if(!isset($resutltArray[$result->matric])){
              $resutltArray[$result->matric]=['sname' => $result->sname,
                                              'fname' => $result->fname,
                                              'oname' => $result->oname,
                                              'matric' => $result->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray[$result->matric]['results'][] = [
                                              'gradeids' => $result->gradeids,
                                              'coursecode' => $result->coursecode,
                                              'courseunit' => $result->courseunit,
                                              'weighedpoint' => $result->weighedpoint                                            
  
                                             ];
          if($result->gradeids < 40 ){
              $resutltArray[$result->matric]['res'][] = [
                                             'gradeidss' => $result->gradeids,
                                             'coursecodes' => $result->coursecode,
                                             'courseunits' => $result->courseunit,
                                             'weighedpoints' => $result->weighedpoint                                            
  
                                                           ];
  
          }else{
              $resutltArray[$result->matric]['res'][] = [];
          }
                                          
      $resutltArray[$result->matric]['totalUnits']= $resutltArray[$result->matric]['totalUnits'] + $result->courseunit;
      $resutltArray[$result->matric]['tcp']= $resutltArray[$result->matric]['tcp'] + ($result->courseunit * $result->weighedpoint);
      $resutltArray[$result->matric]['gpa']= ($resutltArray[$result->matric]['gpa'] + ($result->courseunit * $result->weighedpoint))/($resutltArray[$result->matric]['totalUnits'] + $result->courseunit);
      }
  
      // For Previous Semester for 200L i.e 1st Ignore 
      $resutltArray2 = [];
      
      foreach ($resultpre as $result2){
  
          if(!isset($resutltArray2[$result2->matric])){
              $resutltArray2[$result2->matric]=[
                                              'sname' => $result2->sname,
                                              'fname' => $result2->fname,
                                               'oname' => $result2->oname,
                                              'matric' => $result2->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray2[$result2->matric]['resultpre'][] = [
                                              'gradeids' => $result2->gradeids,
                                              'coursecode' => $result2->coursecode,
                                              'courseunit' => $result2->courseunit,
                                              'weighedpoint' => $result2->weighedpoint                                            
  
                                             ];
          if($result2->gradeids < 40 ){
              $resutltArray2[$result2->matric]['respre'][] = [
                                             'gradeidss' => $result2->gradeids,
                                             'coursecodes' => $result2->coursecode,
                                             'courseunits' => $result2->courseunit,
                                             'weighedpoints' => $result2->weighedpoint                                            
  
                                                           ];
  
          }else{
              $resutltArray2[$result2->matric]['respre'][] = [];
          }
       $tcp = $result2->courseunit * $result2->weighedpoint;                                  
      $resutltArray2[$result2->matric]['totalUnits']= $resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit;
      $resutltArray2[$result2->matric]['tcp']= $resutltArray2[$result2->matric]['tcp'] + ($result2->courseunit * $result2->weighedpoint);
      //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
      //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
      }
  
      // For Cummulative Semester 300L 1st and 2nd Semester
      $resutltArray3 = [];
      
      foreach ($resultcum as $result3){
  
          if(!isset($resutltArray3[$result3->matric])){
              $resutltArray3[$result3->matric]=[
                                              'sname' => $result3->sname,
                                              'fname' => $result3->fname,
                                               'oname' => $result3->oname,
                                              'matric' => $result3->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray3[$result3->matric]['resultcum'][] = [
                                              'gradeids' => $result3->gradeids,
                                              'coursecode' => $result3->coursecode,
                                              'courseunit' => $result3->courseunit,
                                              'weighedpoint' => $result3->weighedpoint                                            
  
                                             ];
          if($result3->gradeids < 40 ){
              $resutltArray3[$result3->matric]['res'][] = [
                                             'gradeidss' => $result3->gradeids,
                                             'coursecodes' => $result3->coursecode,
                                             'courseunits' => $result3->courseunit,
                                             'weighedpoints' => $result3->weighedpoint                                            
  
                                                           ];
  
          }else{
              $resutltArray3[$result3->matric]['res'][] = [];
          }
      //$tcp = $result2->courseunit * $result2->weighedpoint;                                  
      $resutltArray3[$result3->matric]['totalUnits']= $resutltArray3[$result3->matric]['totalUnits'] + $result3->courseunit;
      $resutltArray3[$result3->matric]['tcp']= $resutltArray3[$result3->matric]['tcp'] + ($result3->courseunit * $result3->weighedpoint);
      //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
      //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
      }

      // 200L ...1st Semester and 2nd Semester
      $resutltArray4 = [];
      
      foreach ($resultpre1 as $result4){
  
          if(!isset($resutltArray4[$result4->matric])){
              $resutltArray4[$result4->matric]=[
                                              'sname' => $result4->sname,
                                              'fname' => $result4->fname,
                                               'oname' => $result4->oname,
                                              'matric' => $result4->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray4[$result4->matric]['resultpre1'][] = [
                                              'gradeids' => $result4->gradeids,
                                              'coursecode' => $result4->coursecode,
                                              'courseunit' => $result4->courseunit,
                                              'weighedpoint' => $result4->weighedpoint                                            
  
                                             ];
          if($result4->gradeids < 40 ){
              $resutltArray4[$result4->matric]['respre1'][] = [
                                             'gradeidss' => $result4->gradeids,
                                             'coursecodes' => $result4->coursecode,
                                             'courseunits' => $result4->courseunit,
                                             'weighedpoints' => $result4->weighedpoint                                            
  
                                                           ];
  
          }else{
              $resutltArray4[$result4->matric]['respre1'][] = [];
          }
       $tcp = $result4->courseunit * $result4->weighedpoint;                                  
      $resutltArray4[$result4->matric]['totalUnits']= $resutltArray4[$result4->matric]['totalUnits'] + $result4->courseunit;
      $resutltArray4[$result4->matric]['tcp']= $resutltArray4[$result4->matric]['tcp'] + ($result4->courseunit * $result4->weighedpoint);
      //$resutltArray2[$result2->matric]['gpa']= ($resutltArray2[$result2->matric]['gpa'] + ($result2->courseunit * $result2->weighedpoint))/($resutltArray2[$result2->matric]['totalUnits'] + $result2->courseunit);
      //$resutltArray2[$result2->matric]['gpa']= ($result2->courseunit * $result2->weighedpoint) / $result2->courseunit + $resutltArray2[$result2->matric]['gpa'];
      }


      // 100L ...1st and 2nd Semester
      $resutltArray5 = [];
      
      foreach ($resultpre2 as $result5){
  
          if(!isset($resutltArray5[$result5->matric])){
              $resutltArray5[$result5->matric]=[
                                              'sname' => $result5->sname,
                                              'fname' => $result5->fname,
                                               'oname' => $result5->oname,
                                              'matric' => $result5->matric,
                                              'totalUnits' => 0,
                                              'tcp' => 0,
                                              'gpa'=>0                                             
                                             ];
          }
         
          $resutltArray5[$result5->matric]['resultpre2'][] = [
                                              'gradeids' => $result5->gradeids,
                                              'coursecode' => $result5->coursecode,
                                              'courseunit' => $result5->courseunit,
                                              'weighedpoint' => $result5->weighedpoint                                            
  
                                             ];
          if($result5->gradeids < 40 ){
              $resutltArray5[$result5->matric]['respre2'][] = [
                                             'gradeidss' => $result4->gradeids,
                                             'coursecodes' => $result4->coursecode,
                                             'courseunits' => $result4->courseunit,
                                             'weighedpoints' => $result4->weighedpoint                                            
  
                                                           ];
  
          }else{
              $resutltArray5[$result5->matric]['respre2'][] = [];
          }
       $tcp = $result5->courseunit * $result5->weighedpoint;                                  
      $resutltArray5[$result5->matric]['totalUnits']= $resutltArray5[$result5->matric]['totalUnits'] + $result5->courseunit;
      $resutltArray5[$result5->matric]['tcp']= $resutltArray5[$result5->matric]['tcp'] + ($result5->courseunit * $result5->weighedpoint);
      }


      // For  FIRST SEMESTER 300L, FIRST AND SECOND SEMETSER 200L, 100L FIRST AND SECOND SEMESTER
  $resutltArray6 = [];
      
  foreach ($resultpre3 as $result6){

      if(!isset($resutltArray6[$result6->matric])){
          $resutltArray6[$result6->matric]=['sname' => $result6->sname,
                                          'fname' => $result6->fname,
                                          'oname' => $result6->oname,
                                          'matric' => $result6->matric,
                                          'totalUnits' => 0,
                                          'tcp' => 0,
                                          'gpa'=>0                                             
                                         ];
      }
     
      $resutltArray6[$result6->matric]['resultpre3'][] = [
                                          'gradeids' => $result6->gradeids,
                                          'coursecode' => $result6->coursecode,
                                          'courseunit' => $result6->courseunit,
                                          'weighedpoint' => $result6->weighedpoint, 
                                          'levelss' => $result6->levels,
                                          'semesterss' => $result6->semesters,                                                                
                                          'sessionnamess' => $result6->sessionname                                             

                                         ];
      
                                      
  $resutltArray6[$result6->matric]['totalUnits']= $resutltArray6[$result6->matric]['totalUnits'] + $result6->courseunit;
  $resutltArray6[$result6->matric]['tcp']= $resutltArray6[$result6->matric]['tcp'] + ($result6->courseunit * $result6->weighedpoint);
  $resutltArray6[$result6->matric]['gpa']= ($resutltArray6[$result6->matric]['gpa'] + ($result6->courseunit * $result6->weighedpoint))/($resutltArray6[$result6->matric]['totalUnits'] + $result6->courseunit);
  }
  

    
      
     $data['resutltArray'] = $resutltArray;
     $data['resutltArray2'] = $resutltArray2;
     $data['resutltArray3'] = $resutltArray3;
     $data['resutltArray4'] = $resutltArray4;
     $data['resutltArray5'] = $resutltArray5; 
     $data['resutltArray6'] = $resutltArray6;
     $data['total_number_students']= $total_number_students;
     $data['difference']= $difference;
     $data['student_withCarryOvers'] = $student_withCarryOvers;
     $data['student_withOutCarryOvers'] = $student_withOutCarryOvers;
     
      return view('admin.result.result_viewall',['grades'=>$grades,'result'=>$result,
      'courses'=>$courses,'programmes'=>$programmes,'schools'=>$schools,'results'=>$results,
       'terms'=>$terms]);
      /*
      ->withGrades($grades)
      ->withResults($result)
      ->withCourses($courses)
      ->withProgrammes($programmes)
      ->withSessions($sessions)
      ->withSchools($schools)
      ->withResults($results);
      */
      
  }



} 
 


    /***
    public function import(Request $request){
    // To Export a template of results

    //dd($request);
    //echo $request->file->extension();
    //die();
    if($request->input('option_id') == 2){
        $request->validate([
        'option_id'      => 'required',
        'semester'  => 'required',
        'others'  => 'required',
        'level'  => 'required',
        'school_id'  => 'required',        
        'programme_id'  => 'required',
        'term_id'  => 'required'
    ]);
  

    
    $courses = Course::select('crsid')
    ->where('programme_id', $request->input('programme_id'))
    ->where('level', $request->input('level')) 
    ->where('semester', $request->input('semester'))   
    ->get();
    

    $students = Student::select('matric','sname','fname','oname')
    ->where('programme_id', $request->input('programme_id'))
    ->where('level', $request->input('level'))    
    ->get();
    

    $studentsArray = [];
    $coursesArray = [];
    

    $studentsArray[] = ['Matric','Surname','First Name','Other Name','Courses'];
    $coursesArray[] = ['Courses'];

    foreach($students as $student){
        $studentsArray[] = $student->toArray();    
    }
    
    // To convert the columns courses to rows       
    foreach ($courses as $course => $columns) {
           foreach ($columns as $row2 => $column2) {
            //$coursesArray[$row2][$course] = @$columns->toArray()['crsid'];                                
           } 
           $coursesArray[$row2][$course] = @$columns->toArray()['crsid']; 
                    
         }   
    
    Excel::create('resultsTemplates', function($excel) 
    use($studentsArray,$coursesArray){
        $excel->setTitle('RESULTS');
        $excel->setCreator('Matthew')->setCompany('CDL JABU');
        $excel->setDescription('Templates for Results upload');
        $excel->sheet('MatricAndNames', function($sheet) use ($studentsArray,$coursesArray)
        {
            // $sheet->fromArray($studentsArray,null,'A1',false, false,
                  // $coursesArray,null,'E1',false,false);
             $sheet->fromArray($studentsArray,null,'A1',false, false);
             //$sheet->fromArray($coursesArray,null,'A1',false, false);
        }); 
        $excel->sheet('Courses', function($sheet) use ($coursesArray)
        {
             $sheet->fromArray($coursesArray,null,'A1',false, false);
        });        
        
        //})->download('xlsx');
    })->export('xls');
    
    } else{
        set_time_limit(0);
    //dd($request);
    // To Upload Results
    $request->validate([
        'option_id' => 'required',        
        'file' => 'required|mimes:csv,xlsx,xls|max:2048',
        'semester'  => 'required',
        //'others'  => 'required',
        'level'  => 'required',
        'school_id'  => 'required',
        'programme_id'  => 'required',
        'term_id'  => 'required'
    ]);

    

    //Added the grade_id and semester_id
    if($request->input('level')==100 AND $request->input('semester')=='1st'){
        $semester_id = 1;
    }
    if($request->input('level')==100 AND $request->input('semester')=='2nd'){
        $semester_id = 2;
    }
    if($request->input('level')==200 AND $request->input('semester')=='1st'){
        $semester_id = 3;
    }
    if($request->input('level')==200 AND $request->input('semester')=='2nd'){
        $semester_id = 4;
    }
    if($request->input('level')==300 AND $request->input('semester')=='1st'){
        $semester_id = 5;
    }
    if($request->input('level')==300 AND $request->input('semester')=='2nd'){
        $semester_id = 6;
    }

    date_default_timezone_set("Africa/Lagos");
     $created_at = date('Y-m-d H:i:s');
     $updated_at = date('Y-m-d H:i:s');
     //Check if results was uploaded before
    $results  = Result::where('programme_id', $request->input('programme_id'))
    ->where('level',$request->input('level'))
    ->where('semester',$request->input('semester'))
    ->where('term_id',$request->input('term_id'))
    ->count();
    //echo  $results;
    //die();
    if($results > 0){
      return redirect('/upload')->with('message', 'Results already exists');

    }else{

    if($request->hasFile('file')){
        
        //$extension = File::extension($request->file->getClientOriginalName());
        dd($request->file('file')->getClientOriginalExtension() );
        $extension = $request->file->extension();
        if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

            $path = $request->file->getRealPath();
            //dd($path);
            
           $data = Excel::import($import,$path); // change load to toArray
           

           //dd($data);
           
           $datas = Excel::load($path, function($reader) {
            })->get()->toArray(); 
            $datas = Excel::import($import, $path);

            //dd($datas);
            if(!empty($data)){
              
                  
                foreach ($datas as $key => $value) {
                    // Spilt the array to start from the courses
                    $splited = @array_splice($value,4);  
                    
                    foreach($splited as $crsid=>$total){
                      // Get the id
                       $crsid_id = Course::where('crsid',$crsid)
                      ->where('level',$request->input('level'))
                      ->where('programme_id',$request->input('programme_id'))
                      ->where('semester',$request->input('semester'))
                      ->where('term_id',$request->input('term_id'))
                      ->get()
                      ->toArray();  
                      
                        //Explode the total score, into exam and ca score
                        @list($ca_score,$exam_score) = @explode('/',$total);
                        //Put the updates for the cpga here
                        dd($ca_score);
                    $insert[] = [
                    'matric' => str_replace('/','', $value['matric']),
                    'grade_ids' => $ca_score + $exam_score,
                    'ca_score' => $ca_score,
                    'exam_score' => $exam_score,
                    'mark_total' => $request->input('mark_total'),
                    'status' => $request->input('status'),
                    'programme_id' => $request->input('programme_id'),
                    'school_id' => $request->input('school_id'),
                    'level' => $request->input('level'),
                    'semester' => $request->input('semester'),
                    'semester_id' => $semester_id,
                    'term_id' => $request->input('term_id'),
                    //'others' => $request->input('others'),
                    //'course_id' => $request->input('crsid'),
                    'course_id' => @$crsid_id[0]['id'],                    
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                    ];

                    }
                                    
                       
                   
                   }                
                    
                    
                }

                if(!empty($insert)){

                    $insertData = DB::table('results')->insert($insert);
                    //die();
                    // Update the grade_id in the table where it has not grade id before
                    $results = DB::table('results')->where('grade_id','=',NULL)->get();
                    foreach($results as $result){
                        $grade_ids = $result->grade_ids;
                    
                    if($grade_ids >= 70 OR $grade_ids <= 100 ){
                        DB::table('results')->whereBetween('grade_ids', [70,100])->update(['grade_id' => 1, 'updated_at' => $updated_at]);
                        //$Update = DB::update('UPDATE backups SET grade_id = 1 WHERE grade_id=NULL');
                    }
                    if($grade_ids >= 60 OR $grade_ids < 70 ){
                        //DB::update('UPDATE backups SET grade_id = 2 WHERE grade_ids=NULL');
                        DB::table('results')->whereBetween('grade_ids', [60,69])->update(['grade_id' => 2, 'updated_at' => $updated_at]);

                    }
                    if($grade_ids >= 50 OR $grade_ids < 60 ){
                        DB::table('results')->whereBetween('grade_ids', [50,59])->update(['grade_id' => 3, 'updated_at' => $updated_at]);

                       // DB::update('UPDATE backups SET grade_id = 3 WHERE grade_id=NULL');
                    }
                    if($grade_ids >= 45 OR $grade_ids < 50 ){
                        //DB::update('UPDATE backups SET grade_id = 4 WHERE grade_id=NULL');
                        DB::table('results')->whereBetween('grade_ids', [45,49])->update(['grade_id' => 4, 'updated_at' => $updated_at]);

                    }
                    if($grade_ids >= 40 OR $grade_ids < 45 ){
                       // DB::update('UPDATE backups SET grade_id = 5 WHERE grade_id=NULL');
                       DB::table('results')->whereBetween('grade_ids', [40,44])->update(['grade_id' => 5, 'updated_at' => $updated_at]);

                    }
                    if($grade_ids >= 0 OR $grade_ids < 40 ){

                        DB::table('results')->whereBetween('grade_ids', [0,39])->update(['grade_id' => 6, 'updated_at' => $updated_at]);

                        
                    }
                                      
                }
                    if ($insertData) {
                        return redirect('/upload')->with('success', 'Results successfully imported');
                        //Session::flash('success', 'Your Data has successfully imported');
                    }else { 
                        return redirect('/upload')->with('error', 'Error inserting the data..');                       
                       // Session::flash('error', 'Error inserting the data..');
                        //return back();
                    }
                }
            }

            //return back();

        }else {
            return redirect('/exams/upload')->with('error', 'File is a  file.!! Please upload a valid xls/csv file..!!');
            //Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
            //return back();
        }
    }
    }
}
  ***/
}
