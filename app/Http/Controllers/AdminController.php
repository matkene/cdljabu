<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\Mode;
use App\Models\Role;
use App\Models\Term;
use App\Models\User;
use App\Models\Setup;
use App\Models\State;
use App\Models\Title;
use App\Models\Gender;
use App\Models\Marital;
use App\Models\Student;
use App\Models\Category;
use App\Models\Religion;
use App\Models\Programme;
use App\Models\Bloodgroup;
use App\Models\Application;
use Illuminate\Support\Str;
use App\Models\Relationship;
use Illuminate\Http\Request;
use App\Models\Studentcourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function admin_dashboard(){
        return view('admin.dashboard.index');
    }
    public function applicant_dashboard(){
        return view('applicant.dashboard');
    }   
    public function admission_dashboard(){
        return view('admission.dashboard');
    }

    public function student_dashboard(){
        return view('student.dashboard');
    }

    public function adminApplicationDashboard(){
        return view('admin.dashboard.application');
    }

    
    public function adminStudentDashboard(){
        return view('admin.dashboard.student');
    }
    public function adminSettingDashboard(){
        return view('admin.dashboard.setting');
    }

    public function adminSetupDashboard(){
        return view('admin.dashboard.setup');
    }


    public function exam_dashboard(){
        return view('exams.dashboard.index');
    }
   /*
    public function adminResultDashboard(){
        return view('exams.dashboard.result');
    }
    */

    public function adminStudentResultDashboard(){
        return view('exams.dashboard.sresult');
    }

    public function examSettingDashboard(){
        return view('exam.dashboard.setting');
    }

    public function examSetupDashboard(){
        return view('exam.dashboard.setup');
    }

    public function cadviser_dashboard(){

        return view('cadviser.dashboard.index');
    }

    public function cadviserManageLevel(){

        $students = Student::all();

        return view('cadviser.manage_level',['students'=>$students]);
    }


    public function ManageLevel(Request $request){
        //dd($request);
        $matric  = $request->input('matric');
        $students = Student::where('matric', $matric)->get();
        //dd($students);

        return view('cadviser.level',['students'=>$students]);
    }


    public function changeLevel(Request $request){
        //dd($request);
        $level = $request->input('level');
        $matric  = $request->input('matric');
        $studentid = Student::where('matric',$matric)->get()->toArray();
        $edit= Student::find($studentid[0]['id']);
        $edit->level = $level;
        $edit->save();        
        //dd($students);

        return redirect('/cadviser/manage_level')->with('message', 'Level Changed for the Student');
    }

    public function cadviserViewCourse(){

        DB::statement("SET SQL_MODE=''"); //In config\database.php --> "mysql" array Set 'strict' => false to disable all.

        $studentcourses = DB::table('studentcourses')
        ->leftjoin('students', 'studentcourses.matric','=','students.matric')
        ->leftjoin('programmes', 'programmes.id','=','students.programme_id')
        ->select('students.*','studentcourses.matric','programmes.progdesc as sprogramme')
        ->groupBy('studentcourses.matric','studentcourses.term')
        ->get();
        //dd($studentcourses);

        return view('cadviser.view_course',['studentcourses'=>$studentcourses]);
    }


    public function viewCourse(Request $request){
        //dd($request);
        $matric  = $request->input('matric');
        $term  = $request->input('term');
        $students = Student::where('matric', $matric)->get();
        /*
        $studentcourses = DB::table('studentcourses')
        ->leftjoin('students', 'studentcourses.matric','=','students.matric')
        ->leftjoin('programmes', 'programmes.id','=','students.programme_id')
        ->select('students.*','studentcourses.matric','programmes.progdesc as sprogramme')
        ->where('studentcourses.matric', $matric)
        ->get(); */


        $studentcourses = Studentcourse::where('matric', $matric)       
        //->where('programme_id', $request->input('programme_id'))
        //->where('level', $request->input('level'))
        //->where('semester', $request->input('semester'))
        ->where('term', $request->input('term'))
        ->get();
        //dd($studentcourses);

        return view('cadviser.course',['students'=>$students,
        'studentcourses'=>$studentcourses,'term'=>$term]);
    }


    public function cadviserManageCourse(){

        return view('cadviser.manage_course');
    }


    public function cadviserReportdashboard(){
        return view('cadviser.dashboard.report');
    }


    public function finance_dashboard(){
        return view('finance.dashboard.index');
    }

    public function lsupport_dashboard(){
        return view('lsupport.dashboard.index');
    }


    public function lsupportReportdashboard(){
        return view('lsupport.dashboard.report');
    }

    public function helpdesk_dashboard(){
        return view('helpdesk.dashboard.index');
    }

    public function helpdeskReportdashboard(){
        return view('helpdesk.dashboard.report');
    }


    public function helpdeskReportApplNotPaid(){

        $status =0;
        $users = DB::table('users')
        ->leftjoin('application', 'users.email' ,'=', 'application.email')
        ->select('users.*','application.referrer as referrers', 'application.formno as aformno')
        ->where('application.status',$status)
        ->get();

       // dd($users);
        
        $setups = Setup::all();
        $terms = Term::all();
       
        return view('helpdesk.applnotpaid',['terms'=>$terms,'users'=>$users,
        'setups'=>$setups]);
    }

    public function helpdeskReportApplNotSubmit(){

        $status = 0;
        $applications = Application::where('submitted',$status)->get();

       //dd(vars: $applications);
        
        $setups = Setup::all();
        $terms = Term::all();

        return view('helpdesk.applnotsubmit',['terms'=>$terms,'applications'=>$applications,
        'setups'=>$setups]);
    }


    public function helpdeskReportApplNotAccept(){

        $status =0;
        $students = DB::table('students')
        ->leftjoin('admissions', 'students.applno' ,'=', 'admissions.formno')
        ->select('students.matric','students.applno','admissions.year as ayear')
        ->where('students.matric','students.applno')
        ->get();

        dd($students);

        return view('helpdesk.applnotaccept');
    }

    public function adminRegistration(){            
        $students = Student::paginate(50);
        $studentcourses = DB::table('studentcourses')
        ->leftjoin('students', 'studentcourses.matric' ,'=', 'students.matric')
        ->select('studentcourses.*','students.matric as smatric','students.sname as ssname',
         'students.fname as sfname', 'students.oname as soname', 'students as level')
        //->where('students.matric','students.applno')
        ->get();

        dd($studentcourses);
        $terms = Term::where('status','Active')->get();
        $programmes = Programme::all();
        $genders =Gender::all();
        $modes = Mode::all();
        $roles = Role::all();
        $modes = Mode::all();
        $categories = Category::all();
        return view('admin.student.index',['modes'=>$modes, 'genders'=>$genders,
        'categories'=>$categories,'terms'=>$terms, 'students'=>$students,'programmes'=>$programmes,
        'roles'=>$roles]);
     }

    public function adminBiodata(){            
        $students = Student::paginate(50);
        $terms = Term::where('status','Active')->get();
        $programmes = Programme::all();
        $genders =Gender::all();
        $modes = Mode::all();
        $roles = Role::all();
        $modes = Mode::all();
        $categories = Category::all();
        return view('admin.student.index',['modes'=>$modes, 'genders'=>$genders,'categories'=>$categories,
        'terms'=>$terms, 'students'=>$students,'programmes'=>$programmes,'roles'=>$roles]);
     } 

     //Create Users
      public function adminBiodataPost(Request $request){
    // if($request->ajax()){
        //dd($request);
         $request->validate([
             'fname'=>'required|max:255',
             'sname'=>'required|max:255',
             'email'=>'required|email|unique:students|min:9',         
             'mphone'=>'required',
             'address'=>'required',
             'programme_id'=>'required',
             'level'=>'required',
             'term_id'=>'required',
             'gender_id'=>'required',
             'mode_id'=>'required',
             'matric'=>'required|unique:students'
                          
         ]);

         $inputs=array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
         $rand_keys1 = array_rand($inputs, 2);

         $terms = Term::where('id', $request->input('term_id'))->get()->toArray();
         //echo $terms[0]['name'];
         //die();
         

         //dd($rand_keys1);
         //die();
 

         $student=new Student([
             'term_id'=>$request->input('term_id'),
             'term' => $terms[0]['name'],
             'fname'=>$request->input('fname'),
             'matric'=>$request->input('matric'),
             'applno'=>$request->input('matric'),
             'sname'=>$request->input('sname'),
             'oname'=>$request->input('oname'),                 
             'email'=>$request->input('email'),                              
             'mphone'=>$request->input('mphone'),
             'address'=>$request->input('address'),
             'level'=>$request->input('level'),
             'gender_id'=>$request->input('gender_id'),
             'mode_id'=>$request->input('mode_id'),                 
             'programme_id'=>$request->input('programme_id'),  
             'title_id' =>1,
             'dob' => '1990-10-10',
             'lga_id' =>1,
             'state_id'=>1,
             'country_id'=>1,
             'mstatus'=>1,
             'bloodgroup_id'=>1,
             'religion_id' =>1,
             'marital_id' =>1,
             'religion' =>1,          
             
         ]);

         $users = new User(
            [
               'fname' => $request->input('fname'),
               'sname' => $request->input('sname'),
               'oname' => $request->input('oname'),
               'email'=>  $request->input('matric'),
               'address' => $request->input('address'),
               'mphone' =>  $request->input('mphone'),
               'password'=> Hash::make($request->input('password')),
               'remember_token'=>Str::random(60),
               'username' =>$request->input('email'),
               'role_id' => $request->input('role_id'),
               'category_id' => $request->input('category_id'),
               'active' => 1
            ]);
     
         
        if ($student->save() && $users->save()){
         
        //
         return redirect('/admin/biodata')->with('messasge', 'Student account created successfully!');
       } 
         
     }
     

     public function adminEditBiodataPost(Request $request){        
           //dd($request);
            $id = $request->input('matric');
            $students = Student::where('matric',$id)->get(); //resolve this
            foreach($students as $student){
                $studentid = $student->id;                
            }

            $request->validate([            
            'title'=>'required',
            'sname'=>'required',
            'fname'=>'required',
            'oname'=>'required',
            'religion'=>'required',
            'sex'=>'required',
            'mode_id'=>'required',
            'dob'=>'required',
            'level'=>'required',
            'programme_id'=>'required',
            'spname'=>'required',
            'state_id'=>'required',
            'lga_id'=>'required',
            'dateofmarriage'=>'required',                
            'bloodgroup'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'mphone'=>'required|min:11',
            'name_nok'=>'required',
            'rel_nok'=>'required',
            'address_nok'=>'required',
            'mphone_nok'=>'required|min:11',
            'email_nok'=>'required|email',
            'mstatus'=>'required',
                       
              ]);
              $request->title;
    $edit= Student::find($studentid);
    $edit->title_id = $request->input('title');
    $edit->gender_id = $request->input('sex');
    $edit->mode_id = $request->input('mode_id');
    $edit->dob = $request->input('dob');
    $edit->dateofmarriage = $request->input('dateofmarriage');
    $edit->sname = $request->input('sname');
    $edit->fname = $request->input('fname');
    $edit->oname = $request->input('oname');
    $edit->level = $request->input('level');
    $edit->programme_id = $request->input('programme_id');
    $edit->state_id = $request->input('state_id');
    $edit->lga_id = $request->input('lga_id');
    $edit->religion_id = $request->input('religion'); 
    $edit->bloodgroup_id = $request->input('bloodgroup');
    $edit->marital_id = $request->input('mstatus');
    $edit->spname = $request->input('spname'); 
    $edit->address = $request->input('address');         
    $edit->email = $request->input('email');
    $edit->mphone = $request->input('mphone'); 
    $edit->name_nok = $request->input('name_nok'); 
    $edit->relationship_id = $request->input('rel_nok'); 
    $edit->address_nok = $request->input('address_nok');
    $edit->mphone_nok = $request->input('mphone_nok'); 
    $edit->email_nok = $request->input('email_nok'); 
    $edit->save();     
       
        return redirect('/admin/biodata')->with('message', 'Biodata Editing was successful!');
    
          
    }

    public function adminEditBiodata(Request $request){        
        //if(empty($_POST)){
            //dd($request);
            $id  = $request->input('matric');
            $students = Student::where('matric',$id)->get(); //resolve this
            foreach($students as $student){
                $state_id = $student->state_id;
                $lga_id = $student->lga_id;
                $mode_id = $student->mode_id;
                $gender_id = $student->gender_id;
                $title_id = $student->title_id;
                $marital_id = $student->marital_id;
                $relationship_id = $student->relationship_id;
                $religion_id = $student->religion_id;
                $bloodgroup_id = $student->bloodgroup_id;
                $programme_id = $student->programme_id;
            }
            $programmes = Programme::where('id','<>',$programme_id)->get();  //Exclude the state value of the student 
            $modes = Mode::where('id','<>',$mode_id)->get();  //Exclude the state value of the student 
            $titles = Title::where('id','<>',$title_id)->get();  //Exclude the state value of the student 
            $genders = Gender::where('id','<>',$gender_id)->get();  //Exclude the state value of the student 
            $states = State::where('id','<>',$state_id)->get();  //Exclude the state value of the student 
            $lgas = Lga::where('id','<>',$lga_id)->get();  //Exclude the state value of the student
            $maritals = Marital::where('id','<>',$marital_id)->get();  //Exclude the state value of the student
            $relationships = Relationship::where('id','<>', $relationship_id)->get();  //Exclude the state value of the student
            $religions = Religion::where('id','<>',$religion_id)->get();  //Exclude the state value of the student
            $bloodgroups = Bloodgroup::where('id','<>',$bloodgroup_id)->get();
            return view('admin.student.editbiodata',['programmes'=>$programmes,'modes'=>$modes,
            'titles'=>$titles,'religions'=>$religions,'bloodgroups'=>$bloodgroups,'maritals'=>$maritals,
            'relationships'=>$relationships,'students'=>$students,'states'=>$states,'lgas'=>$lgas]);
           /* ->withProgrammes($programmes)
             ->withModes($modes)
             ->withTitles($titles)
             ->withGenders($genders)   
            ->withReligions($religions)
            ->withBloodgroups($bloodgroups)
            ->withRelationships($relationships)
            ->withMaritals($maritals)
            ->withStudents($students)
            ->withStates($states)
            ->withLgas($lgas);
            //die();
             */
       
        
    }


    public function changepassword(){
        //$id = Auth::user()->username; // Get the matric
         return view('admin.student.changepassword');
     }
      //
      public function updatePassword(Request $request){
        $request->validate([            
            'password'=>'required',  
            'matric' => 'required'          
             ]);
       $users = User::where('username',$request->matric)->get()->toArray();
       //var_dump($users);
      $users = @$users[0];
      $id =  $users['id'];       
        
       $users = User::find($id);
       $users->password= bcrypt($request->input('password'));
       
       if ($users->save()){   
                    
        //Auth::User();
        return redirect('/admin/changepassword')->with('message', 'Status: Matric '.$users['username'].' password changed successfully');
    
    }  
}
  


}
