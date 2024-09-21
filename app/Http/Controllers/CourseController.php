<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\Course;
use App\Models\School;
use App\Models\Student;
use App\Models\Programme;
use App\Models\Feespayment;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\Studentcourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rules\File;



class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::with('programme')->with('term')->paginate(10);

        $programmes = Programme::all();
        $terms = Term::all();
        return view('admin.course.index', ['courses'=> $courses,'programmes' => $programmes, 'terms'=>$terms]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course, Programme $programme)
    {
        //
         //
         $programmes = Programme::all();
         $terms = Term::all();
         return view('admin.course.create', ['course'=> $course,'programmes' => $programmes, 'terms'=>$terms]);
        }

    /**
     * Store a newly created resource in storage.
     */
    // To create a single course
    public function store(Request $request, Course $course)
    {
        //
        //dd($request);
        $request->validate(
            [            
            'programme_id'=>['required'],
            'crsid'=>['required'] ,
            'crsdesc'=>['required'] ,
            'unit'=> ['required'] ,
            'level'=> ['required'] ,
            'remark'=> ['required'] ,
            'term_id'=> ['required'] ,
            'semester'=> ['required'],            
              ]);
        $status =1;
        
        Course::create(
            [
            'programme_id'=>$request->input('programme_id'),
            'crsid'=>$request->input('crsid'),
            'crsdesc'=>$request->input('crsdesc'),
            'unit'=>$request->input('unit'),
            'level'=>$request->input('level'),
            'remark'=>$request->input('remark'),
            'term_id'=>$request->input('term_id'),
            'status'=>$status,
            'user_id'=>$status,
            'semester'=>$request->input('semester'),
           ]);

         return redirect('admin/course')->with('message','Course created Successfully');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
        $programmes = Programme::all();
        $terms = Term::all();
        return view('admin/course/show', ['course'=> $course, 'programmes' => $programmes, 'terms'=>$terms]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {

        //
        $programmes = Programme::all();
        $terms = Term::all();
        return view('admin/course/edit', ['course'=> $course, 'programmes' => $programmes, 'terms'=>$terms]);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //dd($request);
        
        request()->validate(
            [
                'programme_id'=>['required'],
                'crsid'=>['required'] ,
                'crsdesc'=>['required'] ,
                'unit'=> ['required'] ,
                'level'=> ['required'] ,
                'remark'=> ['required'] ,
                'term_id'=> ['required'] ,
                'semester'=> ['required'],         
        
            ] );  
                                
          
           $status =1;
           $course->update(
            [
            'programme_id'=>$request->input('programme_id'),
            'crsid'=>$request->input('crsid'),
            'crsdesc'=>$request->input('crsdesc'),
            'unit'=>$request->input('unit'),
            'level'=>$request->input('level'),
            'remark'=>$request->input('remark'),
            'term_id'=>$request->input('term_id'),
            'status'=>$status,
            'user_id'=>1,
            'semester'=>$request->input('semester'),
           ]);

           //dd($course);
           // redirect
           return redirect('/admin/course')->with('message','Course Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }


    public function getStudentCourse(){
        //Check the pay status of student
        $status = 1;
        $terms = Term::where('status','Active')->get(); // Active Session
        $term = Term::where('status','Active')->get()->toArray(); // Active Session
        $student = Student::where('matric', Auth::user()->username)->get()->toArray();
        $students = Student::where('matric',Auth::user()->username)->get();
        $count = Feespayment:: where('relvant', $status)
        ->where('matric', Auth::user()->username)
        ->where('term_id', @$term[0]['name'])
        ->where('level', @$student[0]['level'])        
        ->count();
        
        /*
        echo '<pre>';
        print_r($student);
        echo '</pre>';
        die();
        */
        $level  = @$student[0]['level'];
        $applno = @$student[0]['applno'];
        $matric = @$student[0]['matric'];

        if($applno == $matric AND $count == 0){
            return redirect()->route('student.index')->with('message', 'Please pay school fees to be able access registration');  
        }elseif($applno == $matric AND $count > 0){
            return redirect()->route('student.index')->with('message', 'Please note that only students with matric number can register. Make sure to login with Matric number');  

        }elseif($applno != $matric AND $count == 0){       
            return redirect()->route('student.index')->with('message', 'Please pay school fees to be able access registration');  
        }else{        
        return view('student.course_index',['terms'=>$terms, 'students'=>$students]);
        //->withSesions($sesions)->withStudents($students);
       }
    }


    public function displayStudentCourse(Request $request){

        //dd($request);
        
         $request->validate([             
            'term_id' =>'required',
            'semester' =>'required',                               
            ]);
      $terms =  Term::where('status','Active')->get();
      $term =   $request->input('term_id');
      //$term = $term_id[0]['name'];
      $semester = $request->input('semester');

      // Check if student had registered before if yes display course form if no do next
        $num = Studentcourse::where('matric', $request->id)
        ->where('semester', $request->input('semester'))
        ->where('term', $request->input('term_id'))        
        ->count();
       // dd($num);
        if($num > 0){
          $student = Student::where('matric',$request->id)->get()->toArray();
          $students = Student::where('matric',$request->id)->get();
         $studentcourses = Studentcourse::where('matric', $request->id)
          ->where('semester', $request->input('semester'))
          ->where('term', $request->input('term_id'))
          ->where('level', @$student[0]['level'])
          ->get();

         // dd($studentcourses);
          //$request->session()->flash('message', 'You have register your courses before. You can print out!');
          return view('student.coursep',['studentcourses'=>$studentcourses,
         'terms'=>$terms,'students'=>$students,'term'=>$term, 'semester'=>$semester]);
          /*->withStudentcourses($studentcourses)
          ->withSesions($sesions)
          ->withStudents($students); */
        } 
        else
        {  
        $terms =  Term::where('status','Active')->get();
        $term_id = Term::where('name', $request->input('term_id'))->get()->toArray();
        //dd($term_id[0]['name']);
        $term = $term_id[0]['name'];
        $termid = $term_id[0]['id'];
        $students = Student::where('matric',$request->id)->get();
        $courses = Course::where('programme_id', $request->programme_id)      
        ->where('semester', $request->semester)
        ->where('term_id', $termid)
        ->where('level', $request->level)
        ->get(); 
        
        //dd($courses);
       
      return view('student.course',['courses'=>$courses, 'students'=>$students,
       'term'=>$term, 'semester'=>$semester]);
      /*->withCourses($courses)->withStudents($students);*/
       }
}


  public function registerCourse(Request $request){
      //dd($request);
    $request->validate([            
        'programme_id'=>'required',
        'crsid'=>'required',
        'matric'=>'required',
        'term'=>'required',
        'level'=>'required',        
        'semester'=>'required',            
          ]);
        // Get the number of the courses ticked
         $num = count($request->input('crsid'));
          $crsids = $request->input('crsid');
          foreach($crsids as $crsid){ 
            // To get the number of unit
          $courses = Course::where('id',$crsid)->get()->toArray(); 
          //$nounit  = $nounit +  @$courses[0]['unit'];
          }
          //var_dump($crsids);

     foreach($crsids as $crsid){ 
        $courses = Course::where('id',$crsid)->get()->toArray();
    $studentcourses=new Studentcourse([
        'programme_id'=> $request->input('programme_id'),
        'crsid' => @$courses[0]['crsid'],
        'course_id'=>$crsid,
        'matric'=>$request->input('matric'),
        'term'=>$request->input('term'),
        'level'=>$request->input('level'),        
        'semester'=>$request->input('semester'),
               ]);    
    $studentcourses->save();
    }
        
   // $request->session()->flash('message', 'Course Registration was successfully!');
    //Session::flash('message', 'Course created successfully');
    //Auth::User();
    return redirect('/student/course')->with('message', 'Course Registration was successfully!');

}


public function getStudentCoursePrint(){
$status = 1;
$terms = Term::where('status','Active')->get(); // Active Session
$term = Term::where('status','Active')->get()->toArray(); // Active Session
$student = Student::where('matric',Auth::user()->username)->get()->toArray();
$students = Student::where('matric',Auth::user()->username)->get();
$count = Feespayment:: where('relvant', $status)
->where('matric', Auth::user()->username) 
->where('term_id', $term[0]['name'])
->where('level', $student[0]['level'])       
->count();

/*
echo '<pre>';
print_r($student);
echo '</pre>';
die();
*/
$level  = $student[0]['level'];
$applno = $student[0]['applno'];
$matric = $student[0]['matric'];

if($applno == $matric AND $count == 0){
    return redirect()->route('student.index')->with('message', 'Please pay school fees to be able access registration');  
}elseif($applno == $matric AND $count > 0){
    return redirect()->route('student.index')->with('message', 'Please note that only students with matric number can register. Make sure to login with Matric number');  

}elseif($applno != $matric AND $count == 0){       
    return redirect()->route('student.index')->with('message', 'Please pay school fees to be able access registration');  
}else{  

      
    return view('student.course_index1',['terms'=>$terms, 'students'=>$students]);
      //->withSesions($sesions)->withStudents($students);
}
}


public function printStudentCourse(Request $request){
    //dd($request);
    
    $terms =  Term::where('status','Active')->get();
    $term =  Term::where('status', 'Active')->get()->toArray();
    $programmes = Programme::where('id',$request->input('programme_id'))->get();
    $students = Student::where('matric', Auth::user()->username)->get();
    
    $studentcourses = Studentcourse::where('matric', Auth::user()->username)       
    ->where('programme_id', $request->input('programme_id'))
    ->where('level', $request->input('level'))
    ->where('semester', $request->input('semester'))
    ->where('term', $request->input('term_id'))
    ->get();

    $levels = $request->input('level');

    $semesters = $request->input('semester');
    if($semesters == '1st'){
        $semester = 'FIRST';
    }else{
        $semester = 'SECOND';
    }
   
   
    return view('student.coursep',['semester'=>$semester, 'programmes'=>$programmes,
    'students'=>$students, 'studentcourses'=>$studentcourses,'terms'=>$terms]);
    /*->withSesions($sesions)
   ->withProgrammes($programmes)
   ->withStudents($students)       
   ->withStudentcourses($studentcourses);*/
   
}

public function import(){
    $schools = School::all();
    $programmes = Programme::all();
    $terms =    Term::all();
            
    return view('admin.course.upload',['terms'=>$terms, 'schools'=>$schools,
    'programmes'=>$programmes]);
    /*->withSessions($sessions)->withSchools($schools)->withResults($results);*/
    
}

public function importcourse(Request $request){
    // dd($request);
  date_default_timezone_set("Africa/Lagos");
  $created_at = date('Y-m-d H:i:s');
  $updated_at = date('Y-m-d H:i:s');

 
          
     $semester = $request->input('semester');
     $programme = $request->input('programme_id');
     $level = $request->input('level');
     $term = $request->input('term_id');
     $crsid = $request->input('crsid');
     $status = 1;
     $path = $request->file->getRealPath();

     $count = Course::where('term_id', $term)
     ->where('level',$level)
     ->where('semester',$semester)
     ->count();
    
     if($count == 0 ){     
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
     //dd($data[0]);
     //$phoneNumbersData = [];
     

     foreach ($data[0] as $key => $value) {
         ///$phoneNumbersData[] = $value;
          //dd($phoneNumbersData[0]);
          //$splited = @array_splice($value,4); 
          
         //dd($data[0]); // displays from the courses substr("Hello world",6)
                 
           
           /* 
           Course::create(
            [
            'programme_id'=>$request->input('programme_id'),
            'crsid'=>$request->input('crsid'),
            'crsdesc'=>$request->input('crsdesc'),
            'unit'=>$request->input('unit'),
            'level'=>$request->input('level'),
            'remark'=>$request->input('remark'),
            'term_id'=>$request->input('term_id'),
            'status'=>$status,
            'user_id'=>$status,
            'semester'=>$request->input('semester'),
           ]);
           */
  
          $insert[] = [
          'crsid' => $value['0-Code'],
          'programme_id'=>$request->input('programme_id'),
          //'crsid'=>$request->input('crsid'), $value['3-Level'], $value['5-Semester'],
          'crsdesc'=>$value['1-Title'],
          'unit'=>$value['2-Unit'],
          'level'=>$request->input('level'),
          'remark'=>$value['4-Remark'],
          'term_id'=>$request->input('term_id'),
          'status'=>$status,
          'user_id'=>$status,
          'semester'=>$request->input('semester'),                           
          'created_at' => $created_at,
          'updated_at' => $updated_at,
          ];

          }                                    
          
         if(!empty($insert)){    

             DB::table('courses')->insert($insert);
             }
           

      /*
     Excel::import(new UsersImport($crsid, $updated_at,$created_at,$programme,$status,$term, $semester, $level
     ),$path);
     */
     return redirect('/admin/course/upload')->with('message', 'Courses Uploaded Successfully!');  
     
    }else{

        return redirect('/admin/course/upload')->with('message', 'DUPLICATE: Courses Uploaded for the Programme and Level!');
    }
          
 
}



}
