<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\Mode;
use App\Models\Term;
use App\Models\User;
use App\Models\Setup;
use App\Models\State;
use App\Models\Title;
use App\Models\Gender;
use App\Models\Country;
use App\Models\Marital;
use App\Models\Student;
use App\Models\Religion;
use App\Models\Examboard;
use App\Models\Bloodgroup;
use App\Models\Examresult;

use App\Models\Application;
use App\Models\Feespayment;
use App\Models\Relationship;
use App\Models\Transactcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class StudentController extends Controller
{

    public function student_dashboard(){
        return view('student.dashboard.index');
    }


    public function studentBiodataDashboard(){
        return view('student.dashboard.biodata');
    }

    public function studentPaymentDashboard(){
        return view('student.dashboard.payment');
    }

    public function studentRegistrationDashboard(){
        return view('student.dashboard.registration');
    }

    public function studentResultDashboard(){
        return view('student.dashboard.result');
    }
    public function index(){
        
        // Make a place as student to able to print admission letter
        $id = Auth::user()->username;
        $password = Auth::user()->password;
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $status =1;
        $terms = Term::where('status','Active')->get()->toArray();
        
        //Check if the student is old or new
        $student = Student::where('matric',$id)->get()->toArray();
        $matric = @$student[0]['matric'];
        $applno  = @$student[0]['applno'];
        $mode =  @$student[0]['mode_id'];
        $programme = @$student[0]['programme_id'];




        // $matric == $applno shows it is new, but otherwise is old
        if($matric != $applno){
            return view('student.index');

        }elseif($matric == $applno){

        //check if payment advice had been generated first , 0 shows no pay advice and 1 otherwise
        $payadvice = Feespayment::where('matric', $id)->count();

        //echo $payadvice;
        //die();
        
        if($payadvice == 0){
            return view('student.index');
        }else{

         // Check if payment status had been made
         $status = Feespayment::where('matric', $id)->where('relvant', $status)->count();

         if($status == 0){  
            return view('student.index');
         }else{          
        
            //Generate Matric Number
         $students = DB::table('students')
        ->leftjoin('feespayments','feespayments.matric','=','students.matric')         
        ->where('students.matric',$id)                
        ->get()
        ->toArray();
        
        $terms = Term::where('status','Active')->get()->toArray();
        
        
        //Generate matric, update users,referencecodes tables
        if(@$students[0]->programme_id == 1 AND $mode == 1){
            $matrictable="matricgen_aa"; 
            $format= 'L240401';           
        }elseif(@$students[0]->programme_id == 1 AND $mode == 2){
            $matrictable="matricgen_aa"; 
            $format= 'L240401';             
        }elseif(@$students[0]->programme_id == 1 AND $mode == 3){
            $matrictable="matricgen_aa"; 
            $format= 'L240401';            
        }elseif(@$students[0]->programme_id == 3 AND $mode == 1){
            $matrictable="matricgen_pp"; 
            $format= 'L240601';            
        }elseif(@$students[0]->programme_id == 3 AND $mode == 2){
            $matrictable="matricgen_pp"; 
            $format= 'L240604';            
        }elseif(@$students[0]->programme_id == 3 AND $mode == 3){
            $matrictable="matricgen_pp"; 
            $format= 'L240604';            
        }elseif(@$students[0]->programme_id == 2 AND $mode == 1){
            $matrictable="matricgen_cc"; 
            $format= 'L240303';            
        }elseif(@$students[0]->programme_id == 2 AND $mode == 2){
            $matrictable="matricgen_cc"; 
            $format= 'L2430303';            
        }elseif(@$students[0]->programme_id == 2 AND $mode == 3){
            $matrictable="matricgen_cc"; 
            $format= 'L240303';            
        }elseif(@$students[0]->programme_id == 4 AND $mode == 4){
            $matrictable="matricgen_bb"; 
            $format= 'L240907';            
        }
       
        
        

        $insert = [
                    'applno' => $id,
                    'sname' => @$students[0]->sname,
                    'fname' => @$students[0]->fname,
                    'mname' => @$students[0]->oname, 
                    'date' => $created_at,
                    'date1' => $updated_at,

                    ];                    
        $insertData = DB::table($matrictable)->insert($insert);

        //Select to get the Matric number
        $matric = DB::table($matrictable)
        ->where('applno',$id)
        //->where('admletter',$status)        
        ->get()
        ->toArray();

        $newmatric = $matric[0]->recid;
        $nmatric = str_pad($newmatric,3,0,STR_PAD_LEFT);

        
        // Matric matters str_split('\\/:*?"<>|') $matricno1 = str_replace('/','', $matricno);
        $matricno = @$format.$nmatric;
        $matricno1 = str_replace(str_split('\\/:*?()"<>|'),'', $matricno);
        $names = @$students[0]->sname.' '.@$students[0]->fname.' '.@$students[0]->oname;
        $name_nok = @$students[0]->sname_nok.' '.@$students[0]->fname_nok.' '.@$students[0]->oname_nok;
        //print_r($matric);
        //die();

        //Insert into matricupdate
        $inserts = [
            'applno' => $id,
            'matric' => $matricno,            
            'term' => @$students[0]->term,
            'received_date' => $updated_at,
            'phone' => @$students[0]->mphone,
            'email' => @$students[0]->email,
            'programme' => $programme,
            ];                    
$insertDatas = DB::table('matricupdate')->insert($inserts);

        // Update the users table
      $id = User::where('username',@$students[0]->matric)->get()->toArray();     
      $users=User::find($id[0]['id']);
      $users->username =$matricno;      
      $users->save();  
       // Update the Students table
      $ids = Student::where('matric',@$students[0]->matric)->get()->toArray();     
      $student=Student::find($ids[0]['id']);
      $student->matric =$matricno;      
      $student->save(); 
       //Update the Feespayments Table 
      $idss = Feespayment::where('matric',@$students[0]->matric)->get()->toArray();     
      $feespayment=Feespayment::find($idss[0]['id']);
      $feespayment->matric = $matricno; 
      $feespayment->save();
      //Update the Transactcode Table 
      $codes = Transactcode::where('matric',@$students[0]->matric)->get()->toArray();     
      $codes=Transactcode::find($codes[0]['id']);
      $codes->matric = $matricno; 
      $codes->save(); 
        
        return redirect('/authorize/login')->with('message', $names.', your Matric number is '.$matricno. '. Please write down and use next time to login.');
        
}    }
}
}
    
    public function biodata(){
        
    $id = Auth::user()->username; // Get the matric
    $students = Student::where('matric',$id)->get(); //resolve this
    //dd($students);
    return view('student.biodata',['students'=>$students]);
}
       //
       public function editbiodata(Request $request){
        
        if(empty($_POST)){
            $id = Auth::user()->username; // Get the matric
            $students = Student::where('matric',$id)->get(); //resolve this
            foreach($students as $student){
                $state_id = $student->state_id;
                $mode_id = $student->mode_id;
                $gender_id = $student->gender_id;
                $title_id = $student->title_id;
                $lga_id = $student->lga_id;
                $country_id = $student->country_id;
                $marital_id = $student->marital_id;
                $relationship_id = $student->relationship_id;
                $religion_id = $student->religion_id;
                $bloodgroup_id = $student->bloodgroup_id;
            }
            $modes = Mode::where('id','<>',$mode_id)->get();  //Exclude the state value of the student 
            $titles = Title::where('id','<>',$title_id)->get();  //Exclude the state value of the student 
            $genders = Gender::where('id','<>',$gender_id)->get();  //Exclude the state value of the student 
            $countries = Country::where('id','<>',$country_id)->get();
            $states = State::where('id','<>',$state_id)->get();  //Exclude the state value of the student 
            $lgas = Lga::where('id','<>',$lga_id)
            //->where('state_id','=',$state_id)
            ->get();  //Exclude the state value of the student
            $maritals = Marital::where('id','<>',$marital_id)->get();  //Exclude the state value of the student
            $relationships = Relationship::where('id','<>', $relationship_id)->get();  //Exclude the state value of the student
            $religions = Religion::where('id','<>',$religion_id)->get();  //Exclude the state value of the student
            $bloodgroups = Bloodgroup::where('id','<>',$bloodgroup_id)->get();
            return view('student.editbiodata',['modes'=>$modes,'bloodgroups'=>$bloodgroups,
            'religions'=>$religions,'relationships'=>$relationships,'maritals'=>$maritals,
            'countries'=>$countries,'lgas'=>$lgas,'states'=>$states,'genders'=>$genders,
            'titles'=>$titles, 'students'=>$students]);
            /*->withReligions($religions)
            ->withModes($modes)
            ->withTitles($titles)
            ->withGenders($genders)
            ->withBloodgroups($bloodgroups)
            ->withRelationships($relationships)
            ->withMaritals($maritals)
            ->withStudents($students)
            ->withStates($states)
            ->withLgas($lgas);
            */
            //die();
          }else{
              //dd($request);
            $id = Auth::user()->username; // Get the matric
            $students = Student::where('matric',$id)->get(); //resolve this -done
            foreach($students as $student){
                $studentid = $student->id;                
            }

            $request->validate([            
            'title'=>'required',
            'religion'=>'required',
            'bloodgroup'=>'required',
            'address'=>'required',
            'email'=>'required',
            'mphone'=>'required|min:11',
            'name_nok'=>'required',
            'rel_nok'=>'required',
            'address_nok'=>'required',
            'mphone_nok'=>'required|min:11',
            'email_nok'=>'required',
            'mstatus'=>'required',
                       
              ]);
              //$request->title;
    $edit= Student::find($studentid);
    $edit->title_id = $request->input('title');
    $edit->religion_id = $request->input('religion'); 
    $edit->bloodgroup_id = $request->input('bloodgroup');
    $edit->marital_id = $request->input('mstatus'); 
    $edit->spname = $request->input('spname'); 
    $edit->address = $request->input('address'); 
    $edit->email = $request->input('email');
    $edit->mphone = $request->input('mphone'); 
    $edit->name_nok = $request->input('name_nok'); 
    $edit->relationship_id = $request->input('rel_nok'); 
    $edit->rel_nok = $request->input('rel_nok'); 
    $edit->address_nok = $request->input('address_nok');
    $edit->mphone_nok = $request->input('mphone_nok'); 
    $edit->email_nok = $request->input('email_nok'); 
    $edit->save();     
       
        return redirect('/student/editbiodata')->with('message', 'Biodata Updated was successful!');
    
          }
    }


    //To print admission letter for students
    public function sadmletter(){
        $ids = Auth::user()->username; // Get the matric        
        $students = Student::where('matric',$ids)->get()->toArray(); // change from formno to matric

        $id = @$students[0]['applno'];
        
        $status = 1;
        //$data['status'] = $status;
        //$data['applno'] = $id;
        //join with the table of admitted candidate when given
        $applications = DB::table('students')        
        ->leftjoin('admissions','admissions.formno','=','students.applno')
        ->leftjoin('awards','awards.id','=','admissions.programme')
        ->select('students.*', 'admissions.refno as arefno','awards.school as aschool',
        'awards.name as aname','awards.year as ayear','awards.programme as aprogramme','awards.other as aother','awards.format as formats',
        'admissions.id as ids', 'awards.other as others','awards.catprog as catergory') 
        ->where('admissions.formno',$id)        
        ->get();  
        
        
        //dd($applications);

        // update if admission letter is printed 
        
        $application = DB::table('applications')->where('formno',$id)        
        ->get()->toArray();           
        
        return view('student.sadmletter' , ['status' =>$status, 'id'=>$id,
        'applications'=>$applications,'application'=>$application,'students'=>$students]);
        //->withApplications($applications);
    }


    public function sexamresult(){
        $id = Auth::user()->email; // Get the email of the applicant/ change to email
        //$students = Student::where('')
        $pay = 1;  // Paid status
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get();
        //->toArray();

        //$data['status'] = $application[0]->status; check for the status and submitted in the page
        //$data['submitted'] = $application[0]->submitted;  // 
        $applications =  Application::where('email', $id)->get();
        //$formno =  Application::where('email', $id)->get()->toArray();
        
        //$examboards = Examboard::all();
        $examboards = Examboard::where('formno', @$applications[0]->formno)->get();
        $examresults  =  Examresult::where('formno', $application[0]->formno)->get();
        $count = Examboard::where('formno', @$applications[0]->formno)->count();
        
        $setups      = Setup::all();
        $terms =  Term::where('status','Active')->get();
        //$examresult = Examresult::where('formno', $formno[0]['formno'])->get()->toArray();
       // echo '<pre>';
       // print_r($examboards);
       // echo '</pre>';
       // die();

        //Add Results and display download
        
        return view('student.examresult', ['applications'=>$applications, 'application'=> $application, 
        'count' => $count, 'terms'=> $terms, 'setups' => $setups, 'examboards' => $examboards,
         'examresults'=>$examresults]);
        /*
        ->withSesions($sesions)
        ->withSetups($setups)
        ->withApplications($applications)->withExamboards($examboards);
        */
    }


    public function changepassword(){
        $matric = Auth::user()->username; // Get the matric
        $students = Student::where('matric', $matric)->get();
        //dd($students);
         return view('student.changepassword',['students'=>$students]);
     }
      //
      public function updatePassword(Request $request){

        //dd($request);
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
        return redirect('/student/dashboard')->with('message', 'Status: Matric '.$users['username'].' your password had been changed successfully');
    
    }  
}
  


}
