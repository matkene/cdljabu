<?php

namespace App\Http\Controllers;
use App\Models\Admission;
use App\Models\Mode;
use App\Models\Student;
use App\Models\Referencecode;
use App\Models\Exam;
use App\Models\Certificate;
use App\Models\Studentcourse;
use App\Models\User;
use App\Models\Course;
use App\Models\Grader;
use App\Models\Gender;
use App\Models\Application;
use App\Models\Title;
use App\Models\Term;
use App\Models\Award;
use App\Models\Marital;
use App\Models\Lga;
use App\Models\State;
use App\Models\Bloodgroup;
use App\Models\Relationship;
use App\Models\Religion;
use App\Models\Programme;
use App\Models\School;

use Response;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;




class AdmissionController extends Controller
{

    public function admission_dashboard(){
        return view('admission.dashboard.index');
    }

    public function admissionApplicationDashboard(){
        return view('admission.dashboard.application');
    }

    public function manageAdmissionDashboard(){
        return view('admission.dashboard.admission');
    }
   /*
    public function adminStudentDashboard(){
        return view('admin.dashboard.student');
    }
        */
    //
    public function index(){
        $admission = Admission::all();
        return view("");
    }

    public function getApplicationList(){
        $applications = Application::all();  
        //dd($applications);     
        $count = Application::count();
        return view('admission.applist',['applications'=>$applications, 'count'=>$count]);
        //->withApplications($applications);
    }

    //To create application aacount 
    public function getApplicant(){
        return view('admission.applicant');
    }
    //To create application aacount 
    public function applicantinfo(Request $request){
        //dd($request);
        $request->validate([            
         'admissionNumber'=>'required',            
          ]);
          //check if exists
        $count = DB::table('application')->where('admissionNumber',$request->input('admissionNumber'))->count();
        //echo  $count;
        //die();
        if($count == 0){
            $admissionNumber = $request->input('admissionNumber');
            $data['admissionNumber'] = $admissionNumber;
            $genders = Gender::all();
            $maritals = Marital::all();
            $states = State::all();
            $schools  = School::all();
            $awards = Award::all();
            return view('admission.applicantinfo',$data);
            /*->withMaritals($maritals)
            ->withStates($states)
            ->withSchools($schools)
            ->withAwards($awards)
            ->withGenders($genders);
            */           
        }else{
            return redirect('/admission/applicant')->with('message', 'This Admission Number exists.');            
        }
        
    }
    //To create application aacount 
    public function createApplicant(Request $request){
       //dd($request);
        //default value
        $role = 7;
        $active =1;
        $password = 123456; // convert to byrcrt
        $country ='NIGERIA';
        $session = '2024/2025';
        $passport =  $request->input('admissionNumber');
        $passports =  $passport.''.'.jpg'; 
        $admletter = 0;

        $insert = [
            'admissionNumber' => $request->input('admissionNumber'),
            'sname' => $request->input('sname'),
            'fname' => $request->input('fname'),
            'oname' => $request->input('oname'), 
            'dob' =>   $request->input('dob'),
            'gender' => $request->input('gender'),
            'mphone' => $request->input('mphone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'lga_origin' => $request->input('lga_origin'),
            'country' => $country,
            'state' => $request->input('state'),
            'mstatus' => $request->input('mstatus'),
            'place_birth' => $request->input('place_birth'),
            'sname_nok' => $request->input('sname_nok'),
            'fname_nok' => $request->input('fname_nok'),
            'oname_nok' => $request->input('oname_nok'),
            'mphone_nok' => $request->input('mphone_nok'),
            'first_school' => $request->input('school'),
            'first_programme' => $request->input('programme'),
            'second_school' => $request->input('school'),
            'second_programme' => $request->input('programme'),
            'session' => $session,
            'passport' => $passports,
            'admletter' => $admletter
            ];
            
            $insertData = DB::table('application')->insert($insert);

            $user=new User([
                'fname'=>$request->input('fname'),
                'sname'=>$request->input('sname'),
                'oname'=>$request->input('oname'),
                'username'=>$request->input('admissionNumber'),
                'email'=>$request->input('email'),
                'password'=>bcrypt($password),                
                'mphone'=>$request->input('mphone'),
                'address'=>$request->input('address'),
                'role_id'=>$role,
                'active'=>$active,                
                //'verifyToken'=>Str::random(60),
            ]);
            
           $user->save();

        return redirect('/admission/applicant')->with('message', 'Canditate details had been successfully created');
    }
    //
      public function dashboard(){
        return view('admission.dashboard');
    }
    
    public function getAdmittedList(){

        $admissions = DB::table('admissions')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('admissions.*','awards.name as aname','awards.school as aschool','awards.year as ayear')
        ->get();

        //dd($admissions);
        $count = DB::table('admissions')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('admissions.*','awards.name as aname','awards.school as aschool','awards.year as ayear')
        ->count();
        //$data['count'] = $count;
        return view('admission.admitted',['count'=>$count, 'admissions'=>$admissions]);
        /*->withAdmissions($admissions); */
    }
    

    
    public function getAdmittedDepart(){
        $schools = School::all();
        $programmes = Programme::all();
        $terms = Term::where('status','Active')->get();        
        return view('admission.admittedeps',['schools'=>$schools, 'programmes'=>$programmes,
        'terms'=>$terms]);
        /*->withSchools($schools)
        ->withProgrammes($programmes)
        ->withSesions($sesions)
        ;
        */
    }

    public function getMatricDepart(){        
        $programmes = Programme::all();
        $terms = Term::where('status','Active')->get();        
        return view('admission.matriclistdep', ['terms'=>$terms,'programmes'=>$programmes]);
        /*
        ->withSchools($schools)
        ->withSesions($sesions)        
        ;
        */
    }
    public function getAdmittedListDepart(Request $request){

        //dd($request);
        $admissions = DB::table('admissions')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        //->leftjoin('programmes','programmes.id','=','admissions.programme')

        ->select('admissions.*','awards.name as aname','awards.programme as aschool','awards.year as ayear')
        ->where('admissions.programme_id',$request->input('programme_id'))
        ->get();
        //dd($admissions);
        $count = DB::table('admissions')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('admissions.*','awards.name as aname','awards.programme as aschool','awards.year as ayear')
        ->where('admissions.programme_id',$request->input('programme_id'))
        ->count();
        //$count = $count;
        $programmes = Programme::where('id',$request->input('programme_id'))->get();
        return view('admission.admittedep',['count'=>$count,'admissions'=>$admissions,
        'programmes'=>$programmes]);
        /*
        ->withAdmissions($admissions)->withProgrammes($programmes); */
    }
    
    public function getMatricListDepart(Request $request){
        //dd($request);
        $students = DB::table('students')
        ->join('admissions','admissions.formno','=','students.applno')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->leftjoin('matricupdate','matricupdate.applno','=','students.applno')
        ->select('students.*','awards.name as aname','awards.school as aschool','awards.year as ayear','matricupdate.received_date as dategen')
        ->where('students.programme_id',$request->input('programme_id'))
        //->where()
        ->get();
        //print_r($admissions);
        //die();
        $count = DB::table('students')
        ->join('admissions','admissions.formno','=','students.applno')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->leftjoin('matricupdate','matricupdate.applno','=','students.applno')
        ->select('students.*','awards.name as aname','awards.school as aschool','awards.year as ayear','matricupdate.received_date as dategen')
        ->where('students.programme_id',$request->input('programme_id'))
        ->count();
       // $data['count'] = $count;
        return view('admission.matriclistdeps',['count'=>$count,'students'=>$students]);
        /*
        ->withAdmissions($admissions);
        */
    }
    
    public function admit(){
        $applications = DB::table('applications')
        ->leftjoin('admissions','applications.formno','=','admissions.formno')
        ->leftjoin('users','applications.email','=','users.email')
        ->leftjoin('programmes','applications.programme_id','=','programmes.id')
        ->leftjoin('genders','applications.gender_id','=','genders.id')
        ->leftjoin('states','applications.state_id','=','states.id')
        ->select('applications.*','programmes.progdesc as schoolname','genders.name as gendername',
        'states.name as statename','users.role_id as uroles')
        ->get();

        $count  =  DB::table('applications')
        ->leftjoin('admissions','applications.formno','=','admissions.formno')
        ->leftjoin('programmes','applications.programme_id','=','programmes.id')
        ->select('applications.*','programmes.progdesc as schoolname')
        ->count();        
        //$data['count'] = $count;
        return view('admission.admit',['count'=>$count, 'applications'=>$applications]);
        /*->withApplications($applications);
        */
    }
    public function admitnow(Request $request){
       //dd($request);
       $request->validate([            
          'admissionNumber'=>'required',            
          ]);
        $count  = Admission::where('formno',$request->input('admissionNumber'))->count();
        //echo  $count;
        //die();
        if($count == 0)
        //Get to where o admit
        {
            $applications  = Application::where('formno',$request->input('admissionNumber'))->get();
            //dd($applications);
            $awards = Award::all();
            $programmes = Programme::all();
            return view('admission.admitnow',['applications'=>$applications,'awards'=>$awards,
            'programmes'=>$programmes]);
            /*->withAwards($awards)
            ->withProgrammes($programmes)
            ->withApplications($applications);
            */
        }else{
            // Display a message that shows it had been admitted before
            return redirect('/admission/admit')->with('message', 'This admission number had been offered Provisional Admission before.');

        }

       
    }

    public function readmit(){
        $admissions = DB::table('admissions')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('admissions.*','awards.name as aname','awards.school as aschool','awards.year as ayear')
        ->get();
        $count = DB::table('admissions')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('admissions.*','awards.name as aname','awards.school as aschool','awards.year as ayear')
        ->count();
        $data['count'] = $count;
        return view('admission.readmit',$data);
        /*->withAdmissions($admissions);
        */
    }
    

    public function readmits(Request $request){
        //dd($request);
       
        $count  = Admission::where('admissionNumber',$request->input('admissionNumber'))->count();
        //echo  $count;
        //die();
        if($count > 0)
        //Get if matric number had generated
        {
            $application  = DB::table('application')
            ->where('admissionNumber',$request->input('admissionNumber'))
            ->get();
            
            $awards = Award::all();
            $programmes = Programme::all();
            return view('admission.readmits');
            /*
            ->withAwards($awards)
            ->withProgrammes($programmes)
            ->withApplication($application); */
        }else{
            // Display a message that shows it had been admitted before
            return redirect('/admission/readmit')->with('message', 'This Admission Number had not been offered Provisional Admission before.');

        }

       
    }

    public function readmitCanditate(Request $request){
        //dd($request);
        $request->validate([        
            'award_id'=>'required',
            'programme_id'=>'required',
            'level'=>'required'           
              ]);

              date_default_timezone_set("Africa/Lagos");
              $created_at = date('Y-m-d H:i:s');
              $updated_at = date('Y-m-d H:i:s');      
        
        // Get if  matric number is generated before      
        $count  = Student::where('applno',$request->input('admissionNumber'))->count();
        $award = Award::where('id',$request->input('award_id'))->get()->toArray();
        
        if($count > 0){

            // First Update
            $matricupdates = DB::table('matricupdate')
            ->where('admissionNumber',$request->input('admissionNumber'))
            ->get()
            ->toArray();
           //print_r($matricupdates[0]->recid);
            //print_r($matricupdates);


            //die();

            $student  = Student::where('applno',$request->input('admissionNumber'))->get()->toArray();
            $referencecode  = Referencecode::where('matric',@$student[0]['matric'])->get()->toArray();
            $user  = User::where('username',@$student[0]['matric'])->get()->toArray();
            //echo $referencecode[0]['code']; 
            // Needed to updated the ReferenceCode table instead of matric/admissionNumer
            $referencecodes=Referencecode::find(@$referencecode[0]['id']);
            $referencecodes->matric =$request->input('admissionNumber');            
            $referencecodes->updated_at = $updated_at;                          
            $referencecodes->save();
             
             //Update the users (username and the role_id)
            $roleid = 7;
            $users=User::find(@$user[0]['id']);
            $users->username =$request->input('admissionNumber');            
            $users->role_id = $roleid;                          
            $users->save();
            //Update the students (matric and applno)
            $roleid = 7;
            $students = Student::find(@$student[0]['id']);
            $students->applno = $request->input('admissionNumber').'_REMOVE';            
            $students->matric = @$student[0]['matric'].'_REMOVE';                          
            $students->save();
             //Update the MatricUpdate table
             // First Update
             $matricupdates = DB::table('matricupdate')
             ->where('admissionNumber',$request->input('admissionNumber'))
             ->get()
             ->toArray();

            DB::table('matricupdate')
            ->where('recid', @$matricupdates[0]->recid)                        
            ->update(
             [
            'matric'=> @$student[0]['matric'].'_REMOVE',
            'admissionNumber'=> $request->input('admissionNumber').'_REMOVE'
            ]);
            

             //Update the Matric table
             

             //Update the Admission table with new programme           
            $admission=Admission::where('admissionNumber',$request->input('admissionNumber'))->get()->toArray();
            $admissions=Admission::find(@$admission[0]['id']);
            $admissions->programme =$request->input('award_id');
            $admissions->programme_id =$request->input('programme_id');
            $admissions->level = $request->input('level'); 
            $admissions->year = @$award[0]['year']; 
            $admissions->updated_at = $updated_at;                          
            $admissions->save();

            return redirect('/admission/readmit')->with('status', 'Re-Admission was successful.');

        }else{
            //Update only the Admission table with new programme
            $admission=Admission::where('formno',$request->input('admissionNumber'))->get()->toArray();
            $admissions=Admission::find(@$admission[0]['id']);
            $admissions->programme =$request->input('award_id');
            $admissions->programme_id =$request->input('programme_id');
            $admissions->level = $request->input('level'); 
            $admissions->year = @$award[0]['year']; 
            $admissions->updated_at = $updated_at;                          
            if($admissions->save()) {

                return redirect('/admission/readmit')->with('status', 'Re-Admission was successful.');
            }
             
        }
        
       
    }

    

    public function admitCanditate(Request $request){
       ///dd($request->award_id);
        $request->validate([        
            'award_id'=>'required',
            'programme_id'=>'required',
            'level'=>'required'           
              ]);

         $award = Award::where('id',$request->input('award_id'))->get()->toArray();
          //echo @$award[0]['year'];
          //die();
        $applications = DB::table('applications')
        ->leftjoin('sponsors','applications.formno','=','sponsors.formno')
        ->leftjoin('programmes','applications.programme_id','=','programmes.id')
        ->leftjoin('awards','awards.programme','=','programmes.progdesc')
        ->where('applications.formno',$request->input('admissionNumber'))
        ->where('awards.level',$request->input('level'))
        ->select('applications.*','sponsors.name as sponsorname','sponsors.address as sponsoraddr',
          'sponsors.email as sponsoremail','sponsors.mphone as sponsormphone',
           'sponsors.relationship_id  as relations', 'awards.level as alevel' ,'awards.year as ayear')
        //->where('admletter',$status)        
        ->get()
        ->toArray();

        $fullname = @$applications[0]->sname.' '.@$applications[0]->fname.' '.@$applications[0]->oname;
        //echo '<pre>';
        //print_r($applications);
        //print_r(@$applications[0]->sname);
        //echo '<pre>';
       // die();

       $session = '2024/2025';      
       $terms = Term::where('name',$session)->get()->toArray();

        $sponsorname = @unserialize($applications[0]->sponsorname);
        $sponsoraddr = @unserialize($applications[0]->sponsoraddr);
        $sponsoremail = @unserialize($applications[0]->sponsoremail);
        $sponsormphone = @unserialize($applications[0]->sponsormphone);
        $relation = @unserialize($applications[0]->relations);
        $relationships = Relationship::where('name',$relation)->get()->toArray(); //Get the id
        $relations = $relationships[0]['id'];

      
       //$fullname = @$applications[0]->sname.' '.@$applications[0]->fname.' '.@$applications[0]->oname;
       //$name_nok = @$applications[0]->sname_nok.' '.@$applications[0]->fname_nok.' '.@$applications[0]->oname_nok;
        //dd($relations);
        
         $admissions=new Admission([
            'formno'=>$request->input('admissionNumber'),
            'name'=>$fullname,
            'mphone'=>$request->input('mphone'),
            'state'=>$request->input('state'),
            'lga'=>$request->input('lga'),
            'refno'=>@$award[0]['format'],
            'programme'=>$request->input('award_id'),
            'programme_id'=>$request->input('programme_id'),
            'level'=>$request->input('level'),
            'year'=>@$award[0]['year'],
            
                   ]);
        
       $admissions->save();    
       // Insert into Students table , update the applications table to be to print admission letter
       
       $student=new Student([
         'term_id'=> @$terms[0]['id'],
         'term'=> @$terms[0]['name'],
         'fname'=>$request->input('fname'),
         'sname'=>$request->input('sname'),
         'oname'=>$request->input('oname'),   
         'matric'=>$request->input('admissionNumber'),
         'applno'=>$request->input('admissionNumber'),
         'matricformat'=>@$applications[0]->formno,                       
         'email'=>$request->input('email'),
         'title_id'=>$request->input('title_id'),
         'state_id'=>$request->input('state_id'),
         'lga_id'=>$request->input('lga_id'), 
         'bloodgroup_id'=>$request->input('bloodgroup_id'),  
         'religion_id'=>$request->input('religion_id'),         
         'marital_id'=>$request->input('marital_id'),
         'mstatus'=>$request->input('marital_id'),                           
         'mphone'=>$request->input('mphone'),
         'dob'=>$request->input('dob'),
         'address'=>$request->input('address'),
         'level'=>$request->input('level'),
         'gender_id'=>$request->input('gender_id'),
         'mode_id'=> $request->input('mode_id'),                 
         'programme_id'=>$request->input('programme_id'),
         'passport'=>$request->input('passport'),
         'name_nok'=>@$sponsorname[0],
         'address_nok'=>@$sponsoraddr[0],
         'mphone_nok'=>@$sponsormphone[0],         
         'email_nok'=>@$sponsoremail[0],
         'rel_nok'=>@$relation[0], 
         'year_ofentry'=>@$terms[0]['id'],
         'course_duration'=>@$award[0]['year'],
         'country_id'=>$request->input('country_id'), 
         'religion'=>$request->input('religion_id'),
         'relationship_id'=> @$relations          
         
     ]);               
       $student->save();

       //Check if username had been updated before, if yet ignore update again

       $count = User::where('email',$request->input('admissionNumber'))->count(); 

       if($count == 0){
      
      //Update the users table 
      $enrol = 2;
      $id = User::where('username',$request->input('email'))->get()->toArray();     
      $users=User::find($id[0]['id']);
      $users->username = $request->input('admissionNumber');
      $users->role_id = $enrol;
      $users->save();
       }


      $applications = DB::table('applications')->where('formno',$request->input('admissionNumber'))        
        ->get()->toArray();
             
        $date = date('d-m-y');
        $status =1;
        
        // First Update
        DB::table('applications')
        ->where('id', @$applications[0]->id)                        
        ->update(
         [
        'printslip'=> $date,        
        'admletter' => $status
        ]); 
         
        return redirect('/admission/admit')->with('message', 'Admission was successful. Canditate can print Admission letter and perform other procedures.');
        
       
    }

     // Display all Reports for Application for admin
     public function getApplicantsReport(){
       // $applications =  Application::all();
        $applications =  DB::table('application')->get();
                //print_r($applications);
        //die();
        //$setups = Setup::all();
        $terms = Term::all();
        $bloodgroups = Bloodgroup::all();
        $certificates = Certificate::all();
        $exams = Exam::all();
        $genders = Gender::all();
        $graders = Grader::all();
        $states  = State::all();
        $lgas = Lga::all();
        $maritals = Marital::all();
        $modes = Mode::all();
        $programmes = Programme::all();
        $religions = Religion::all();
        $relationships = Relationship::all();
        return view('admin.applicant.report');
        /*
        ->withBloodgroups($bloodgroups)
        ->withCertificates($certificates)
        ->withExams($exams)
        ->withGenders($genders)
        ->withGraders($graders)
        ->withStates($states)
        ->withLgas($lgas)
        ->withMaritals($maritals)
        ->withModes($modes)
        ->withProgrammes($programmes)
        ->withReligions($religions)
        ->withRelationships($relationships)
        //->withSetups($setups)
        ->withSesions($sesions)
        ->withApplications($applications); 
        */
    }


    // Display all Reports for Application for admin
    public function applreport(Request $request){
        //dd($request);
                  
        //$setups = Setup::all();
        $terms = Term::all();
        if($request->input('mode') !=''){
        //$applications = Application::where('mode_id',$request->input('mode'))->get();
        $applications = DB::table('applications')
        ->leftjoin('programmes','applications.programme_id','=','programmes.id')
        ->leftjoin('modes','applications.mode_id','=','modes.id')
        //->leftjoin('maritals','applications.marital_id','=','maritals.id')
        //->leftjoin('genders','applications.gender_id','=','genders.id')
        ->leftjoin('states','applications.state_id','=','states.id')
        ->leftjoin('examresults','applications.admissionNumber','=','examresults.formno')
        //->leftjoin('applcerts','examresults.formno','=','applcerts.formno')                      
        ->leftjoin('exams','examresults.exam_id','=','exams.id') 
        ->leftjoin('subjects','examresults.subject_id','=','subjects.id')
        ->leftjoin('graders','examresults.grader_id','=','graders.id')   
        ->select(DB::raw('application.sname, application.fname,application.oname,
         application.admissionNumber,application.email,application.mphone, 
         maritals.name as maritalname,
        genders.name as gendername, states.name as statename, 
        applcerts.name as  applcertsname, applcerts.certificate as  applcertificate,
        applcerts.grade as  applcertsgrade,
        examresults.no_ofsitting as sitting, examresults.examno as examresultsname,
        exams.name as examname, subjects.name as subjectname, 
        graders.name as gradername,programmes.department as programmename'))
        ->where('mode_id','=',$request->input('mode')) 
        //->where('examresults.no_ofsitting','=',2)
        //->where('examresults.formno','=','A94691DS') 
        ->orderBy('applications.id') 
        ->orderBy('examresults.subject_id') 
        //->groupBy('examresults.no_ofsitting')
        //->groupBy('examresults.exam_id') 
        //->groupBy('examresults.formno')          
        ->get();
        //->toArray();

       // echo '<pre>';
       // print_r($applications);
        //echo '</pre>';
        //die();
    
        $resutltArray = [];

foreach ($applications as $result){

    if(!isset($resutltArray[$result->formno])){
        $resutltArray[$result->formno]=['sname' => $result->sname,
                                        'fname' => $result->fname,
                                        'oname' => $result->oname,
                                        'formno' => $result->formno, 
                                        'jambno' => $result->jambno, 
                                        'email' => $result->email,
                                        'mphone' => $result->mphone,
                                        'modename' => $result->modename,
                                        'maritalname' => $result->maritalname,
                                        'programmename' => $result->programmename,
                                        'gendername' => $result->gendername,
                                        'statename' => $result->statename,                                                 
                                        'no_ofsitting' => $result->sitting,
                                        'applcertsname' => $result->applcertsname,
                                        'applcertsgrade' => $result->applcertsgrade                                                                                      
                                       ];
    }

    if($result->sitting == 1 ){
   
    $resutltArray[$result->formno]['applications'][] = [                                            
                                        'subject' => $result->subjectname,
                                        'grader' => $result->gradername, 
                                        //'center' => $result->examboardcenter,
                                        'exam' => $result->examname,
                                        'examno' => $result->examresultsname,
                                        'no_ofsittings' => $result->sitting                                      

                                       ];
    }    else{         
     //if($result->sitting > 1 ){
                        $resutltArray[$result->formno]['applications'][] = [
                            'subjects' => $result->subjectname,
                            'graders' => $result->gradername, 
                            //'centers' => $result->examboardcenter,
                            'exams' => $result->examname,
                            'examnos' => $result->examresultsname,
                            'no_ofsittings' => $result->sitting                                             

                           ];

                   
                    } 
        //echo '<pre>';
        //print_r($resutltArray1);
        //echo '</pre>';
        //die();
        
   

}  
        

        
       $data['resutltArray'] = $resutltArray;
       //$data['resutltArray1'] = $resutltArray1; 

       $data['count'] =Application::where('mode_id',$request->input('mode'))->count();
        $mode = Mode::where('id', $request->input('mode'))->get()->toArray(); 
        $data['name'] = $mode[0]['name'];
        $data['id'] = $request->input('mode');
        }if($request->input('mode') !='' AND $request->input('programme_id') != ''){

            $applications = DB::table('applications')
        ->leftjoin('programmes','applications.programme_id','=','programmes.id')
        ->leftjoin('modes','applications.mode_id','=','modes.id')
        ->leftjoin('maritals','applications.marital_id','=','maritals.id')
        ->leftjoin('genders','applications.gender_id','=','genders.id')
        ->leftjoin('states','applications.state_id','=','states.id')
        ->leftjoin('examresults','applications.formno','=','examresults.formno')
        ->leftjoin('applcerts','examresults.formno','=','applcerts.formno')                      
        ->leftjoin('exams','examresults.exam_id','=','exams.id') 
        ->leftjoin('subjects','examresults.subject_id','=','subjects.id')
        ->leftjoin('graders','examresults.grader_id','=','graders.id')   
        ->select(DB::raw('applications.sname, applications.fname,applications.oname,
         applications.jambno,applications.formno,applications.email,applications.mphone, 
         modes.name as modename,maritals.name as maritalname,
        genders.name as gendername, states.name as statename, 
        applcerts.name as  applcertsname, applcerts.certificate as  applcertificate,
        applcerts.grade as  applcertsgrade,
        examresults.no_ofsitting as sitting, examresults.examno as examresultsname,
        exams.name as examname, subjects.name as subjectname, 
        graders.name as gradername,programmes.department as programmename'))
            ->where('programme_id','=',$request->input('programme_id')) 
            ->where('mode_id','=',$request->input('mode'))
            //->where('examresults.no_ofsitting','=',2)
            //->where('examresults.formno','=','A94691DS') 
            ->orderBy('applications.id') 
            ->orderBy('examresults.subject_id') 
            //->groupBy('examresults.no_ofsitting')
            //->groupBy('examresults.exam_id') 
            //->groupBy('examresults.formno')          
            ->get();
            //->toArray();

            //echo '<pre>';
            //print_r($applications);
            //echo '</pre>';
            //die();
        
            $resutltArray = [];
    
    foreach ($applications as $result){

        if(!isset($resutltArray[$result->formno])){
            $resutltArray[$result->formno]=['sname' => $result->sname,
                                            'fname' => $result->fname,
                                            'oname' => $result->oname,
                                            'formno' => $result->formno, 
                                            'jambno' => $result->jambno, 
                                            'email' => $result->email,
                                            'mphone' => $result->mphone,
                                            'modename' => $result->modename,
                                            'maritalname' => $result->maritalname,
                                            'programmename' => $result->programmename,
                                            'gendername' => $result->gendername,
                                            'statename' => $result->statename,                                                       
                                            'no_ofsitting' => $result->sitting,
                                            'applcertsname' => $result->applcertsname,
                                            'applcertsgrade' => $result->applcertsgrade                                                                                       
                                           ];
        }

        if($result->sitting == 1 ){
       
        $resutltArray[$result->formno]['applications'][] = [                                            
                                            'subject' => $result->subjectname,
                                            'grader' => $result->gradername, 
                                            //'center' => $result->examboardcenter,
                                            'exam' => $result->examname,
                                            'examno' => $result->examresultsname,
                                            'no_ofsittings' => $result->sitting                                      

                                           ];
        }    else{         
         //if($result->sitting > 1 ){
                            $resutltArray[$result->formno]['applications'][] = [
                                'subjects' => $result->subjectname,
                                'graders' => $result->gradername, 
                                //'centers' => $result->examboardcenter,
                                'exams' => $result->examname,
                                'examnos' => $result->examresultsname,
                                'no_ofsittings' => $result->sitting                                             

                               ];

                       
                        } 
                         
       
    
    }  
            

            
           $data['resutltArray'] = $resutltArray;
           //$data['resutltArray1'] = $resutltArray1; 

        //$applications = Application::where('mode_id',$request->input('mode'))
        //->where('programme_id',$request->input('programme_id'))->get();            
        $data['count'] =Application::where('mode_id',$request->input('mode'))
        ->where('programme_id',$request->input('programme_id'))            
        ->count();
        $mode = Mode::where('id', $request->input('mode'))->get()->toArray(); 
        $data['name'] = $mode[0]['name'];
        $data['id'] = $request->input('mode');
        }elseif($request->input('gender') != ''){
        $applications = Application::where('gender_id',$request->input('gender'))->get();
        $data['count'] =Application::where('gender_id',$request->input('gender'))->count();
        $gender = Gender::where('id', $request->input('gender'))->get()->toArray(); 
        $data['name'] = $gender[0]['name'];
        $data['id'] = $request->input('gender');   
        }elseif($request->input('programme_id') != ''){
            $applications = DB::table('applications')
        ->leftjoin('programmes','applications.programme_id','=','programmes.id')
        ->leftjoin('modes','applications.mode_id','=','modes.id')
        ->leftjoin('maritals','applications.marital_id','=','maritals.id')
        ->leftjoin('genders','applications.gender_id','=','genders.id')
        ->leftjoin('states','applications.state_id','=','states.id')
        ->leftjoin('examresults','applications.formno','=','examresults.formno')
        ->leftjoin('applcerts','examresults.formno','=','applcerts.formno')                      
        ->leftjoin('exams','examresults.exam_id','=','exams.id') 
        ->leftjoin('subjects','examresults.subject_id','=','subjects.id')
        ->leftjoin('graders','examresults.grader_id','=','graders.id')   
        ->select(DB::raw('applications.sname, applications.fname,applications.oname,
         applications.jambno,applications.formno,applications.email,applications.mphone, 
         modes.name as modename,maritals.name as maritalname,
        genders.name as gendername, states.name as statename, 
        applcerts.name as  applcertsname, applcerts.certificate as  applcertificate,
        applcerts.grade as  applcertsgrade,
        examresults.no_ofsitting as sitting, examresults.examno as examresultsname,
        exams.name as examname, subjects.name as subjectname, 
        graders.name as gradername,programmes.department as programmename'))
        ->where('programme_id','=',$request->input('programme_id')) 
            //->where('examresults.no_ofsitting','=',2)
            //->where('examresults.formno','=','A94691DS') 
            ->orderBy('applications.id') 
            ->orderBy('examresults.subject_id') 
            //->groupBy('examresults.no_ofsitting')
            //->groupBy('examresults.exam_id') 
            //->groupBy('examresults.formno')          
            ->get();
            //->toArray();

            //echo '<pre>';
            //print_r($applications);
            //echo '</pre>';
            //die();
        
            $resutltArray = [];
    
    foreach ($applications as $result){

        if(!isset($resutltArray[$result->formno])){
            $resutltArray[$result->formno]=['sname' => $result->sname,
                                            'fname' => $result->fname,
                                            'oname' => $result->oname,
                                            'formno' => $result->formno, 
                                            'jambno' => $result->jambno, 
                                            'email' => $result->email,
                                            'mphone' => $result->mphone,
                                            'modename' => $result->modename,
                                            'maritalname' => $result->maritalname,
                                            'programmename' => $result->programmename,
                                            'gendername' => $result->gendername,
                                            'statename' => $result->statename,
                                           // 'maritalname' => $result->maritalname,           
                                            'no_ofsitting' => $result->sitting,
                                            'applcertsname' => $result->applcertsname,
                                            'applcertsgrade' => $result->applcertsgrade                                                                                      
                                           ];
        }

        if($result->sitting == 1 ){
       
        $resutltArray[$result->formno]['applications'][] = [                                            
                                            'subject' => $result->subjectname,
                                            'grader' => $result->gradername, 
                                            //'center' => $result->examboardcenter,
                                            'exam' => $result->examname,
                                            'examno' => $result->examresultsname,
                                            'no_ofsittings' => $result->sitting                                      

                                           ];
        }    else{         
         //if($result->sitting > 1 ){
                            $resutltArray[$result->formno]['applications'][] = [
                                'subjects' => $result->subjectname,
                                'graders' => $result->gradername, 
                                //'centers' => $result->examboardcenter,
                                'exams' => $result->examname,
                                'examnos' => $result->examresultsname,
                                'no_ofsittings' => $result->sitting                                             

                               ];

                       
                        } 
                         
       
    
    }  
            

            
           $data['resutltArray'] = $resutltArray;
           //$data['resutltArray1'] = $resutltArray1; 

               
        //$applications = Application::where('programme_id',$request->input('programme_id'))->get();
        //$data['count'] =Application::where('programme_id',$request->input('programme_id'))->count();
        $programme = Programme::where('id', $request->input('programme_id'))->get()->toArray(); 
        $data['name'] = $programme[0]['progdesc'];
        $data['id'] = $request->input('programme_id');   
        }
        return view('admin.applicant.applreport',$data);
        /*
        ->withApplications($applications)
        ->withSetups($setups)
        ->withSesions($sesions); */ 

    }
    /*

    public function applreportexcel(Request $request){
        //dd($request);
        $applications = Application::select('id','formno', 'jambno','sname','fname','oname','email','mphone')->where('mode_id',$request->input('mode_id'))->get()->toArray();
        Excel::create('applicationTemplates', function($excel) use ($applications)
        
        {
         $excel->setTitle('APPLICATION');
         //use($applicationArray,$applications)
           $excel->setCreator('Matthew');
           $excel->setCompany('CDL JABU');
            $excel->setDescription('Application Download');
        
            $excel->sheet('Application', function($sheet) use ($applications)
            {
                $sheet->appendRow(['SN','FORM NO', 'JAMB NO','SURNAME','FIRST','OTHER','EMAIL','PHONE']);
                //$sheet->fromArray($applicationArray,null,'A1',false, false);
                foreach ($applications as $application) {
                    $sheet->appendRow((array)$application);
                }
               // $sheet->fromArray($applications,null,'A1',false, false);
            });        
            
            //})->download('xlsx');
        })->export('xls');
    }

    */



    public function getAdmletterList(){
        $admissions = DB::table('admissions')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('admissions.*','awards.name as aname','awards.school as aschool','awards.year as ayear')
        ->get();
        $count = DB::table('admissions')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('admissions.*','awards.name as aname','awards.school as aschool','awards.year as ayear')
        ->count();
        //$data['count'] = $count;
        return view('admission.admletterlist',['count'=>$count, 'admissions'=>$admissions]);
        /*->withAdmissions($admissions); */
    }
    
    //To print admission letter for students
    public function admletter(Request $request){
        //dd($request);
        $ids = $request->input('formno');
        $students = Student::where('applno',$ids)->get()->toArray();

        $id = @$students[0]['applno'];
        //d//ie();
        $status = 1;
        //$status = $status;
        $applno = $id;
        //join with the table of admitted candidate when given
        $applications = DB::table('students')        
        ->leftjoin('admissions','admissions.formno','=','students.applno')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('students.*', 'admissions.refno as arefno','awards.school as aschool',
        'awards.name as aname','awards.year as ayear','awards.programme as aprogramme','awards.other as aother','awards.format as formats',
        'admissions.id as ids', 'awards.other as others','awards.catprog as catergory') 
        ->where('admissions.formno',$id)        
        ->get();

        

        // update if admission letter is printed 
        
        $application = DB::table('applications')->where('formno',$id)        
        ->get()->toArray();

           
        
        return view('admission.padmletter' ,['application'=>$application, 
        'applications'=>$applications,'status'=>$status]);
        /*->withApplications($applications); */
    }



    public function getAdmissionLetter(){
        $admletter =1;
        $applications = DB::table('applications')
        ->leftjoin('admissions','admissions.formno','=','applications.formno')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('applications.*','awards.name as schoolname')
        ->where('applications.admletter',$admletter)
        ->get();
        $count = DB::table('applications')
        ->leftjoin('admissions','admissions.formno','=','applications.formno')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('applications.*','awards.name as schoolname')
        ->where('applications.admletter',$admletter)
        ->count();
        $data['count'] = $count;
        return view('admission.admletter',['applications'=>$applications]);
        /*->withApplications($applications); */
    }

    public function getMatricList(){
        $admissions = DB::table('students')
        ->join('admissions','admissions.formno','=','students.applno')        
        ->join('awards','awards.id','=','admissions.programme')
        ->join('matricupdate','matricupdate.applno','=','students.applno')
        ->select('students.*','awards.name as aname','awards.school as aschool','awards.year as ayear','matricupdate.received_date as dategen')
        ->where('students.applno','<>','students.matric')
        ->get();
        //dd($admissions);  change leftjoin to join
        //die();
        $count = DB::table('students')
        ->join('admissions','admissions.formno','=','students.applno')
        ->join('awards','awards.id','=','admissions.programme')
        ->join('matricupdate','matricupdate.applno','=','students.applno')
        ->select('students.*','awards.name as aname','awards.school as aschool','awards.year as ayear','matricupdate.received_date as dategen')
        ->count();
        //$data['count'] = $count;
        return view('admission.matriclist',['count'=>$count, 'admissions'=>$admissions]);
       
    }

    public function course(){
        $terms =  Term::all();
        $programmes = Programme::all();
       
       return view('admission.course',['terms'=>$terms,'programmes'=>$programmes]);      

    }


    public function coursedisplay(Request $request){
        //dd($request);
        $terms =  Term::where('name',$request->input('term_id'))->get();
        $programmes = Programme::where('id',$request->input('programme_id'))->get();
        $studentcourses = DB::table('students')
        ->leftjoin('studentcourses', 'students.matric','=','studentcourses.matric')       
        //->select(DB::raw(DISTINCT('students.sname, students.fname, students.oname, students.email,students.mphone'))) 
        ->select([DB::RAW('DISTINCT(students.matric)'), 'students.sname', 'students.fname','students.oname',
        'students.email','students.mphone','studentcourses.level as slevel','studentcourses.programme_id as programmeid',
        'studentcourses.term as sessions','studentcourses.semester as semesters','studentcourses.status as cstatus'])        
        ->where('studentcourses.programme_id', $request->input('programme_id'))
        ->where('studentcourses.level', $request->input('level'))
        ->where('studentcourses.semester', $request->input('semester'))
        ->where('studentcourses.term', $request->input('term_id'))
        ->get();
        $levels = $request->input('level');

        $semesters = $request->input('semester');
        if($semesters == '1st'){
            $data['semester'] = 'FIRST';
        }else{
            $data['semester'] = 'SECOND';
        }
       

       
       return view('admission.courseview',['studentcourses'=>$studentcourses,'semesters'=>$semesters,
       'levels'=>$levels, 'programmes'=>$programmes,'terms'=>$terms]);
       /*  ->withSesions($sesions)
       ->withProgrammes($programmes)
       ->withStudentcourses($studentcourses); */

    }


    public function viewcourse(Request $request){
        //dd($request);
        
        $terms =  Term::where('name',$request->input('session'))->get();
        $term =  Term::where('name',$request->input('session'))->get()->toArray();
        $programmes = Programme::where('id',$request->input('programme_id'))->get();
        $students = Student::where('matric', $request->input('matric'))->get();
        $courses = Course::where('level', '<=', $request->input('level'))
        ->where('semester', $request->input('semester'))
        ->where('sesion_id', @$term[0]['id'])
        ->get();
        $first = '1st';
        $studentcourses = Studentcourse::where('matric',$request->input('matric'))       
        ->where('programme_id', $request->input('programme_id'))
        ->where('level', $request->input('level'))
        ->where('semester', $first)
        ->where('session', $request->input('session'))
        ->get();
        $second = '2nd';  
        $studentcourse = Studentcourse::where('matric',$request->input('matric'))       
        ->where('programme_id', $request->input('programme_id'))
        ->where('level', $request->input('level'))
        ->where('semester', $second)
        ->where('session', $request->input('session'))
        ->get();
        $data['levels'] = $request->input('level');

        $semesters = $request->input('semester');
        if($semesters == '1st'){
            $data['semester'] = 'FIRST';
        }else{
            $data['semester'] = 'SECOND';
        }
       
        return view('admission.viewcourse',$data);
        /*->withSesions($sesions)
       ->withProgrammes($programmes)
       ->withStudents($students)
       ->withCourses($courses)
       ->withStudentcourse($studentcourse)
       ->withStudentcourses($studentcourses); */
    }


}
