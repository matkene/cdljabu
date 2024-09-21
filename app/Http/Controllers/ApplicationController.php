<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Lga;
use App\Models\Exam;
use App\Models\Mode;
use App\Models\Term;
use App\Models\User;
use App\Models\Setup;
use App\Models\State;
use App\Models\Title;
use App\Models\Gender;
use App\Models\Grader;
use App\Models\School;
use App\Models\Country;
use App\Models\Marital;
use App\Models\Sponsor;
use App\Models\Subject;
use App\Models\Religion;
use App\Models\Admission;
use App\Models\Certgrade;
use App\Models\Examboard;
use App\Models\Programme;
use App\Models\Bloodgroup;
use App\Models\Employment;
use App\Models\Examresult;
use App\Models\Application;
use App\Models\Applpayment;
use App\Models\Certificate;
use App\Models\Relationship;
use Illuminate\Http\Request;
use App\Models\Appltransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{
    //

    public function applicant_dashboard(){
        //check if any transaction had been generated
        $id  = Auth::user()->email;
        $count = Applpayment::where('email', $id)->count();
        //dd($count);
        if($count == 0)
        {
        return view('applicant/index');
        }else
        {

        return view('applicant.dashboard.index');
        }
    }


    public function applicantBiodataDashboard(){
        // $id = Auth::user()->username; // Get the email of the applicant as the username        
        // $pay = 1;
        // $application = DB::table('application')     
        // ->where('email',$id)
        // ->where('status',$pay)
        // ->get();

        // foreach($application as $appl){
        //    $status = $appl->status;
        //    $submitted = $appl->submitted; 
        // } ['status'=>$status, 'submitted'=>$submitted]
        return view('applicant.dashboard.biodata');
    }

    public function applicantPaymentDashboard(){
        return view('applicant.dashboard.payment');
    }

    public function applicantAdmissionDashboard(){
                
        return view('applicant.dashboard.admission');
    }

    public function index()
    {    
        //Get details payment of application to show the right view
        $id = Auth::user()->email;
        //Get the max value of all the generated RRR status
        $max_applpayments = Applpayment::where('email',$id)->max('status');
        $applpayments = Applpayment::where('email',$id)->get()->toArray();
        //dd($max_applpayments);
        $counts = Applpayment::where('email',$id)->count(); // Check if applicant made attempt to get Trans ID
        //dd($counts, $applpayments[0]['status']);
        if($counts == 0){
        return view('applicant.index');
        }elseif($counts > 0 AND $max_applpayments == 0){ // check if the max if 0
        return view('applicant.index');
        }else{

        $pay = 1;  // status of paid
        $application = DB::table('application')     
         ->where('email',$id)
         ->where('status',$pay)
         ->get();

         //dd($application);
    
        $applications = Application::where('email',$id)->get();
        $count = Application::where('email',$id)->count();   
            

        $countries = Country::all();
        $modes =     Mode::all();
        $titles =    Title::all();
        $genders =   Gender::all();
        $maritals =  Marital::all();
        $states =    State::all();
        $lgas =      Lga::all();
        $religions = Religion::all(); 
        $programmes = Programme::all(); 
        $schools = School::all(); 
        $bloodgroups = Bloodgroup::all();
        $setups      = Setup::all();
        $users =       User::where('email', Auth::user()->email)->get();

        

            //dd($count);
            //$data['count'] = $count;    
            
            $terms        = Term::where('status','Active')->get();
            return view('applicant.applhome', ['modes'=>$modes, 'bloodgroups'=> $bloodgroups, 
            'genders'=>$genders, 'maritals'=>$maritals, 'states' => $states, 'users' => $users, 
            'countries' => $countries, 'religions' => $religions,'programmes' =>$programmes, 
            'schools' => $schools,'setups'=>$setups, 'terms'=>$terms, 'applications'=>$applications,
             'titles' => $titles,  'lgas' => $lgas, 'count' => $count, 'application'=>$application,
             'max_applpayments' => $max_applpayments]);
        }

    }

    public function applhome()
    {
        //Personal Details, Contact Information, Proposed study with Save and continue
        $pay = 1;  // status of paid
        $id = Auth::user()->username; // Get the email of the applicant as the username
       /*
        $application = DB::table('application')
        ->leftjoin('users','users.email','=','application.email')
        ->select('application.*')
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get();
        */
        $max_applpayments = Applpayment::where('email',$id)->max('status');

        $application = DB::table('application')     
        ->where('email',$id)
        ->where('status',$pay)
        ->get();
        
        $status = $application[0]->status; // Payment of Application form
                

        //dd($status);
       // die();

        $countries = Country::all();
        $modes =     Mode::all();
        $titles =    Title::all();
        $genders =   Gender::all();
        $maritals =  Marital::all();
        $states =    State::all();
        $lgas =      Lga::all();
        $religions = Religion::all(); 
        $programmes = Programme::all(); 
        $schools = School::all(); 
        $bloodgroups = Bloodgroup::all();
        $setups      = Setup::all();
        $users =       User::where('email', Auth::user()->email)->get();
     

        

            // check if the form had been started
        $applications = Application::where('email',$id)->get();
        $count = Application::where('email',$id)->count();
        $applicant = Application::where('email',$id)->get()->toArray();
        $submitted =  @$applicant[0]['submitted']  ;
        //$data['count'] = $count;    
        
        $terms        = Term::where('status','Active')->get();
             
     return view('applicant.applhome', ['modes'=>$modes, 'bloodgroups'=> $bloodgroups, 'genders'=>$genders,
     'maritals'=>$maritals, 'states' => $states, 'users' => $users, 'countries' => $countries,
     'religions' => $religions,'programmes' =>$programmes, 'schools' => $schools,'setups'=>$setups, 
     'terms'=>$terms, 'applications'=>$applications, 'titles' => $titles,  'lgas' => $lgas, 
     'count' => $count, 'application' =>$application, 'submitted'=>$submitted, 'status'=>$status,
      'max_applpayments'=>$max_applpayments]);   

    }

    public function postApplhome(Request $request){
        
        $request->validate([            
            'title_id'=>'required',
            'gender_id' =>'required',            
            'sname'=>'required|min:1',
            'fname'=>'required|min:1', 
            'oname'=>'required|min:1', 
            'marital_id'=>'required',
            'dob'=>'required',
            'country_id'=>'required',
            'maiden'=>'required',            
            'state_id' => 'required',
            'lga_id' => 'required',
            'address'=>'required',
            'city' => 'required',
            'states' => 'required',
            'mphone'=>'required',
            'bloodgroup_id'=>'required',
            //'mphone'=>'required|unique:applications|max:11',
            'email'=>'required',
            'mode_id' => 'required',
            'programme_id' => 'required'

              ]);

              //dd(strtotime($request->input('dob')));
              //dd(date("d-m-Y", strtotime($request->input('dob'))));
          
            $check = $request->input('check');
            if($check == 1){
                  //do update instead of insert
            $id = Application::where('formno',$request->input('formno'))->get()->toArray();
            $applications=Application::find($id[0]['id']); // check if find($id)
            $applications->title_id = $request->input('title_id');
            $applications->gender_id = $request->input('gender_id');
            $applications->sname = $request->input('sname'); 
            $applications->fname = $request->input('fname'); 
            $applications->oname = $request->input('oname');
            $applications->dob = date("d-m-Y", strtotime($request->input('dob'))); 
            $applications->marital_id = $request->input('marital_id'); 
            $applications->maiden = $request->input('maiden');
            $applications->country_id = $request->input('country_id');
            $applications->state_id = $request->input('state_id');
            $applications->lga_id = $request->input('lga_id');
            $applications->address = $request->input('address'); 
            $applications->city = $request->input('city'); 
            $applications->states = $request->input('states'); 
            $applications->mphone = $request->input('mphone');
            $applications->email = $request->input('email');
            $applications->mode_id = $request->input('mode_id');
            $applications->mphone = $request->input('mphone');
            $applications->religion_id = $request->input('religion_id');
            $applications->place_ofbirth = $request->input('place_ofbirth');
            $applications->bloodgroup_id = $request->input('bloodgroup_id'); 

            if($applications->save()) {
                return redirect()->route('applicant.examresult')->with('message', 'Biodata Update successful.');
                }


              } else{
        $applications=new Application([
            'formno'=>$request->input('formno'),
            'title_id'=>$request->input('title_id'),
            'gender_id'=>$request->input('gender_id'),
            'sname'=>$request->input('sname'),
            'fname'=>$request->input('fname'),
            'oname'=>$request->input('oname'),
            'marital_id'=>$request->input('marital_id'),
            'dob'=>date("d-m-Y", strtotime($request->input('dob'))),
            'maiden'=>$request->input('maiden'),
            'country_id'=>$request->input('country_id'),
            'state_id'=>$request->input('state_id'),
            'lga_id'=>$request->input('lga_id'),
            'address'=>$request->input('address'),
            'city'=>$request->input('city'),
            'states'=>$request->input('states'),
            'mphone'=>$request->input('mphone'),
            'email'=>$request->input('email'),
            'mode_id'=>$request->input('mode_id'),
            'religion_id'=>$request->input('religion_id'),
            'place_ofbirth'=>$request->input('place_ofbirth'),
            'bloodgroup_id'=>$request->input('bloodgroup_id'),
            'programme_id'=>$request->input('programme_id'),            
            ]);
        
       if ($applications->save()){
        
        return redirect()->route('applicant.examresult')->with('message', 'Step One completed successfully!');
       }
    }
    }

    public function examresult(){
        $id = Auth::user()->username; // Get the email of the applicant
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
        $count = Examboard::where('formno', @$applications[0]->formno)->count();
        
        $setups      = Setup::all();
        $terms =  Term::where('status','Active')->get();
        //$examresult = Examresult::where('formno', $formno[0]['formno'])->get()->toArray();
       // echo '<pre>';
       // print_r($examboards);
       // echo '</pre>';
       // die();

        //Add Results and display download
        
        return view('applicant.examresult', ['applications'=>$applications, 'application'=> $application, 
        'count' => $count, 'terms'=> $terms, 'setups' => $setups, 'examboards' => $examboards]);
        /*
        ->withSesions($sesions)
        ->withSetups($setups)
        ->withApplications($applications)->withExamboards($examboards);
        */
    }

    public function examresultpost(Request $request){
        
        //dd($request);
        $ids = $request->input('id');
        $no_sitting = $request->input('no_sitting');
        
        
        $id = Auth::user()->username;
        $pay = 1;
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get()->toArray();
        //dd($application[0]->formno);

        $status = $application[0]->status;
        $formno = $application[0]->formno;
        $submitted = $application[0]->submitted;  // 
        $applications =  Application::where('email',$id)->get();         
        $setups      = Setup::all();
        $terms =  Term::where('status','Active')->get();
        //get the certificate link
        $examboards = Examboard::where('formno', $application[0]->formno)
        ->get()->toArray();
        //dd($examboards[0]);
        //$certificate= $examboards[0]->certificate;
        $examresults = Examresult::where('formno', $application[0]->formno)->get();
        $count = Examboard::where('formno', $application[0]->formno)->count();
        $counts = Examresult::where('formno', $application[0]->formno)->count();
        $exams  = Exam::all();
        $subjects = Subject::all();
        $graders = Grader::all();
        //$data['submitted'] = 0;  // Form not submitted
        $results = DB::table('examresults')
        ->leftjoin('subjects','examresults.subject_id','=','subjects.id')
        ->leftjoin('graders','examresults.grader_id','=','graders.id')
        ->select('examresults.*','subjects.name as subjectsname','graders.name as gradersname')
        ->where('examresults.formno','=',$application[0]->formno)
        //->where('examresults.no_ofsitting','=',$no_sitting)
        ->get();
        //echo '<pre>';
        //print_r($results);
        //echo '</pre>';
        //die();
        
        return view('applicant.examresultpost', ['terms' => $terms, 'exams' => $exams,
        'graders' => $graders, 'subjects' => $subjects, 'count' => $count, 'counts' => $counts,
         'examresults'=>$examresults, 'status'=>$status, 'formno' => $formno,
        'submitted' =>$submitted,'applications' =>$applications,'no_sitting'=>$no_sitting]);
       /*
        ->withResults($results)
        ->withExamresults($examresults)
        ->withSubjects($subjects)
        ->withGraders($graders)
        ->withExams($exams)
        ->withSesions($sesions)
        ->withSetups($setups)
        ->withExamboards($examboards)
        ->withApplications($applications);
        */

    }

    public function exampost(Request $request){
        //dd($request);
         $request->validate([            
             'formno'=>'required',
             'exam_id'=>'required',
             'examno'=>'required',
             'center'=>'required',                       
             'certificate'=>'required', 
             'subject_id' =>'required',
             'grader_id' =>'required',                               
             ]);
 
             $file = $request->file('certificate') ; 
             $fileName = time() . '.' . $file->getClientOriginalName();
             $destinationPath = public_path('/public/uploads/') ;           
             $file->move($destinationPath,$fileName); 
             $status =1;  
             
             $terms =  Term::where('status','Active')->get();
                        
              //dd($terms[0]->name);
             $check = Examboard::with('exam')->where('formno',$request->input('formno'))->count();
             if($check == 0){ $no_sitting = 1;} 
             else{$no_sitting = 2;}      
 
             $examboards = new Examboard([
             'formno'=>$request->input('formno'),
             'year'=>$request->input('year'),
             'examno'=>$request->input('examno'),
             'exam_id'=>$request->input('exam_id'),
             'status'=>$status, 
             'term_id' => $terms[0]->id,
             'center'=>$request->input('center'),
             'no_ofsitting'=>$no_sitting,
             'certificate'=>$fileName,                               
             ]);
             if($examboards->save()) {
             // Insert into the Examresult table
             // Get the number of the courses ticked
          $num = count($request->input('subject_id'));
          $subjectids = $request->input('subject_id');
          $graderids = $request->input('grader_id');
          $status =1;
          //var_dump($crsids);
 
             foreach($subjectids as $key=>$subjectid){ 
              $examresults = new Examresult([
             'formno'=> $request->input('formno'),
             'subject_id'=>$subjectid,
             'grader_id'=>@$graderids[$key],
             'examno'=>$request->input('examno'),            
             'exam_id'=>$request->input('exam_id'),
             'status'=>$status,
             'no_ofsitting'=>$no_sitting,         
                     ]);    
         $examresults->save();  }
             //}
             return redirect()->route('applicant.certificate')->with('message', 'Exam results added successful!');
             //}
         //}
         }
     }
       

    
    public function examresultpostnew(Request $request){
        
        $ids = $request->input('id');
        $no_sitting = $request->input('no_sitting');
        $id = Auth::user()->username;
        $pay = 1;
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get()->toArray();
        $data['status'] = $application[0]->status;
        $data['formno'] = $application[0]->formno;
        $data['submitted'] = $application[0]->submitted;  //
        $data['no_sitting'] = $no_sitting;  

        $applications =  Application::where('email',$id)->get()->toArray();         
        $setups      = Setup::all();
        $terms =  Term::where('status','Active')->get();
        //get the certificate link
        $examboards = Examboard::where('formno', $application[0]->formno)
        ->where('no_ofsitting', $no_sitting)
        ->get();
        $data['certificate'] = @$examboards[0]['certificate'];
        $examresults = Examresult::where('formno', $application[0]->formno)
        ->where('no_ofsitting', $no_sitting)
        ->get();
        $data['count'] = Examboard::where('formno', $application[0]->formno)->count();
        $data['counts'] = Examresult::where('formno', $application[0]->formno)->count();
        $exams  = Exam::all();
        $subjects = Subject::all();
        $graders = Grader::all();
        //$data['submitted'] = 0;  // Form not submitted
        $results = DB::table('examresults')
        ->leftjoin('subjects','examresults.subject_id','=','subjects.id')
        ->leftjoin('graders','examresults.grader_id','=','graders.id')
        ->select('examresults.*','subjects.name as subjectsname','graders.name as gradersname')
        ->where('examresults.formno','=',$application[0]->formno)        
        ->where('examresults.no_ofsitting','=',$no_sitting)
        ->get();
        //echo '<pre>';
        //print_r($results);
        //echo '</pre>';
        //die();
        
        
        return view('applicant.examresultpostnew', $data);
        /*
        ->withResults($results)
        ->withExamresults($examresults)
        ->withSubjects($subjects)
        ->withGraders($graders)
        ->withExams($exams)
        ->withSesions($sesions)
        ->withSetups($setups)
        ->withExamboards($examboards)
        ->withApplications($applications);
        */
    

    }

    public function exampostnew(Request $request){
        //dd($request);
         $request->validate([            
             'formno'=>'required',
             'exam_id'=>'required',
             'examno'=>'required',
             'center'=>'required',                       
             'certificate'=>'required', 
             'subject_id' =>'required',
             'grader_id' =>'required',                               
             ]);
 
             $file = $request->file('certificate') ; 
             $fileName = time() . '.' . $file->getClientOriginalName();
             $destinationPath = public_path('/public/uploads/') ;           
             $file->move($destinationPath,$fileName);         
                 
 
             // dd($request);
            /// $check = Examboard::where('formno',$request->input('formno'))->count();
             //if($check > 0){                 
            // $exam_id = $request->input('exam_id');
            $status =1;
            if($request->input('no_sitting') == 'First Sitting'){
                $no_sitting =1;
            }else{
                $no_sitting =2;
            }
             $id = Examboard::where('formno',$request->input('formno'))
             ->where('no_ofsitting', $no_sitting)
             ->get()->toArray();

             $examboards = Examboard::findOrFail($id[0]['id']);

             //$examresults = Examresult::findOrFail($id[0]['id']);
             $examboards->delete();

             $examboards = new Examboard([
             'formno'=>$request->input('formno'),
             'year'=>$request->input('year'),
             'examno'=>$request->input('examno'),
             'exam_id'=>$request->input('exam_id'),
             'status'=>$status, 
             'center'=>$request->input('center'),
             'no_ofsitting'=>$no_sitting,
             'certificate'=>$fileName,                               
             ]);
             $examboards->save();
             
             /*
             $examboards = Examboard::find($id[0]['id']);
             $examboards->year = $request->input('year');
             $examboards->examno = $request->input('examno');
             $examboards->exam_id = $request->input('exam_id');
             $examboards->center = $request->input('center'); 
             $examboards->status = $status;
             $examboards->no_ofsitting = $no_sitting; 
             $examboards->certificate = $fileName;             
             $examboards->save();
             */ 

                     $num = count($request->input('subject_id'));
                     $subjectids = $request->input('subject_id');
                     $graderids = $request->input('grader_id');
                     $examids = $request->input('exam_id');
                     
                     //$employment = Employment::where('formno',$request->input('formno'))->get()->toArray();
                     //$ids = @$employment[0]['id'];
                     //$employ = Employment::findOrFail($ids);
                     //$employ->delete();
        
                     $ids = Examresult::where('formno',$request->input('formno'))
                     ->where('no_ofsitting', $no_sitting)
                     ->get()->toArray();
                     //$examresults = Examresult::findOrFail($ids[0]['id'])->delete();
                     $examresults = Examresult::where('formno',$request->input('formno'))
                     ->where('no_ofsitting', $no_sitting)->delete();
                     //$examresults->delete();
                     
                     foreach($subjectids as $key=>$subjectid){ 
                        $examresults = new Examresult([
                       'formno'=> $request->input('formno'),
                       'subject_id'=>$subjectid,
                       'grader_id'=>$graderids[$key],
                       'examno'=>$request->input('examno'),            
                       'exam_id'=>$request->input('exam_id'),
                       'status'=>$status,
                       'no_ofsitting'=>$no_sitting,         
                               ]);    
                   $examresults->save();  }
                        
                 return redirect()->route('applicant.certificate')->with('message', 'Update successful!');
        }


    public function delexamresult(Request $request){        
        //dd($request);
        //$ids = $request->input('id');
        $no_sitting = $request->input('no_sitting');
        //$no_sitting =1;
        
        $id = Auth::user()->username;
        $pay = 1;
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get()->toArray();

        $id = Examboard::where('formno',$request->input('formno'))
        ->where('no_ofsitting', $no_sitting)
        ->get()->toArray();

        $examboards = Examboard::findOrFail($id[0]['id']);

        //$examresults = Examresult::findOrFail($id[0]['id']);
        $examboards->delete();

        $ids = Examresult::where('formno',$request->input('formno'))->where('no_ofsitting', $no_sitting)
                          ->get()->toArray();
        $examresults = Examresult::where('formno',$request->input('formno'))->where('no_ofsitting', $no_sitting)->delete();

        $data['status'] = $application[0]->status;
        $data['formno'] = $application[0]->formno;
        $data['submitted'] = $application[0]->submitted;  // 
        $applications =  Application::where('email',$id)->get()->toArray();         
        $setups      = Setup::all();
        $terms =  Term::where('status','Active')->get();
        
        $exams  = Exam::all();
        $subjects = Subject::all();
        $graders = Grader::all();
        //$data['submitted'] = 0;  // Form not submitted
        
        
        return redirect('applicant/examresult')->with('message', 'Exam Results Deleted Successfully');
        

    }


    public function certificate(){
        $id = Auth::user()->username;
        $pay = 1;
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get()->toArray();
        $status = $application[0]->status;
        $submitted = $application[0]->submitted;  // 
        
        $applications =  Application::where('email',$id)->get()->toArray();
        //dd($applications[0]['submitted']);
        //$submitted = $applications[0]['submitted'];  //added
        $certificates = Certificate::all(); //All the certificate name
        $certgrades  = Certgrade::all();
        $terms = Term::where('status','Active')->get();
        $count = DB::table('applcerts')      
        ->where('formno',$applications[0]['formno'])
        ->count();
        $certificate = DB::table('applcerts')      
        ->where('formno',$applications[0]['formno'])
        ->get()->toArray();
        //$data['submitted'] = 0;  // Form not submitted
         // Certificate changed to Applcert table
        /*
         $certificates = DB::table('certificates')      
        ->where('formno',$application[0]->formno)
        ->get()->toArray();
        *   qw/
        //echo '<pre>';
        //print_r($certificates);
        //echo '</pre>';
        //die();
        $certificate = Certificate::all(); //All the certificate name
        $certgrades  = Certgrade::all();
        //$certificate =  json_encode($certificates,TRUE);
        //$values = json_decode($certificates);
        //if(is_array($certificates)){
        //foreach( $certificates as $appl){
          //  echo $appl->name;
       // }
   // }
        
        // Upload Relvant Certificate, by attaching
        
       */
        return view('applicant.certificate',['certificates'=>$certificates,'certificate'=>$certificate, 
        'certgrades' =>$certgrades,'terms'=>$terms, 'applications' => $applications,
        'submitted'=>$submitted,  'status' =>$status,'count'=>$count]);
    }

    public function certificatepost(Request $request){
        //dd($request);
        $request->validate([            
            'name'=>'required', 
            'grade'=>'required',                                   
            'certificate'=>'required',                                  
            ]);
        $id = Auth::user()->username; // Get the email of the applicant       
        $applications =  Application::where('email', $id)->get();
        $formno =  Application::where('email', $id)->get()->toArray();       
        $formno =  $formno[0]['formno'];

           // $file = $request->file('certificate');   
            //dd($file);          
            //$fileName = time() . '.' . $file->getClientOriginalName();
            //$destinationPath = public_path('/public/uploads/') ;           
            //$file->move($destinationPath,$fileName);         
        //dd($fileName);
        //dd($request);
        //dd($request->hasFile('image'));
       if ($request->hasFile('certificate')) {
            $allowedfileExt = ['jpeg','png','jpg','gif'];
            $images = $request->file('certificate'); 

            //$certids   = $request->input('name');  
           
            foreach($images as $image ){
                $value = rand(1234,90000);
                $name=  time() . '.' .$value.$image->getClientOriginalName();
                $image->move(public_path().'/public/uploads/', $name);  
                $data[] = $name;
           
      
            $certificates[] = [                    
                'formno'=>$formno,
                'name'=>@serialize($request->input('name')),           
                'certificate'=>@serialize($data),
                'grade'=>@serialize($request->input('grade')),     
                    ];
            if(!empty($certificates)){
            $insertData = DB::table('applcerts')->insert($certificates);
                                
                }         

         }
       // }
        
       //if (!empty($insertData)){
        //Name of Sponsor. Relationship, Address  , Email, Phone     
        return redirect()->route('applicant.employment')->with('message','Certificate upload Successful');
   
}
    }

    public function employment(){
        // Display Name of Employer, From and to, Multiple
        $id = Auth::user()->username;
        $pay = 1;
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get()->toArray();      

        $formno = $application[0]->formno;
        $status = $application[0]->status;
        $submitted = $application[0]->submitted;  //        
        $setups      = Setup::all();
        $terms =  Term::where('status','Active')->get();
        $employments = Employment::where('formno',$formno)->get();
        $count = Employment::where('formno',$formno)->count();
        $applications =  Application::where('email',$id)->get()->toArray();
        //$data['submitted'] = 0;  // Form not submitted

        return view('applicant.employment', ['terms'=>$terms, 'employments'=>$employments,
        'count'=>$count, 'submitted'=>$submitted, 'status'=>$status,'applications'=>$applications]);
        /*
        ->withSesions($sesions)
        ->withEmployments($employments)
        ->withSetups($setups);
        */
    }

    public function employmentpost(Request $request){
        //dd($request);
        $request->validate([            
            'name'=>'required',                       
            'datefrom'=>'required',
            'dateto'=>'required', 
            'position'=>'required',                      
            ]);
            //dd($request);
        
       $id = Auth::user()->username; // Get the email of the applicant       
        $applications =  Application::where('email', $id)->get();
        $formno =  Application::where('email', $id)->get()->toArray();       
        $formno =  $formno[0]['formno'];
         
        $employments=new Employment([
            'formno'=>$formno,
            'name'=>@serialize($request->input('name')),
            'datefrom'=>@serialize($request->input('datefrom')),
            'dateto'=>@serialize($request->input('dateto')),
            'position'=>@serialize($request->input('position')),                    
            ]);
        
       if ($employments->save()){
        //Name of Sponsor. Relationship, Address  , Email, Phone     
        return redirect()->route('applicant.sponsor')->with('message','Employment History Added Successfully');
       }
    }

    public function sponsor(){
        // Display Name of Employer, From and to, Multiple
        $id = Auth::user()->username;
        $pay = 1;
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get()->toArray();
        $formno = $application[0]->formno;
        $status = $application[0]->status;
        $submitted = $application[0]->submitted;  // 
                
        $relationships = Relationship::all();
        $setups      = Setup::all();
        $terms =  Term::where('status','Active')->get();
        //$sponsors = Sponsor::where('formno',$formno)->get();
        $sponsors = DB::table('sponsors')
        ->leftjoin('relationships','sponsors.relationship_id','=','relationships.id')
        ->select('sponsors.*','relationships.name as relationshipname')
        ->where('sponsors.formno',$formno)
        ->get();

        $applications =  Application::where('email',$id)->get()->toArray();
       
        $count = Sponsor::where('formno',$formno)->count();
        //$data['submitted'] = 0;  // Form not submitted
        //Name of Sponsor. Relationship, Address  , Email, Phone     
        return view('applicant.sponsor',['terms'=>$terms, 'relationships'=>$relationships,
        'status'=>$status, 'submitted'=>$submitted,'count'=>$count,'sponsors'=>$sponsors,
         'applications'=>$applications]);
        /*
        ->withSponsors($sponsors)
        ->withSesions($sesions)        
        ->withSetups($setups)
        ->withRelationships($relationships);
        */
    }

    public function sponsorpost(Request $request){
        //die();
        //dd($request);
        $request->validate([            
            'name'=>'required',                       
            'address'=>'required',
            'relationship_id'=>'required', 
            'mphone'=>'required', 
            'email'=>'required'            
            ]);
            //dd($request);
        $id = Auth::user()->username; // Get the email of the applicant
        $applications =  Application::where('email', $id)->get();
        $formno =  Application::where('email', $id)->get()->toArray();
        $formno =  $formno[0]['formno'];
         
        $sponsors=new Sponsor([
            'formno'=>$formno,
            'name'=>@serialize($request->input('name')),
            'address'=>@serialize($request->input('address')),
            'mphone'=>@serialize($request->input('mphone')),
            'email'=>@serialize($request->input('email')),   
            'relationship_id'=>@serialize($request->input('relationship_id')),           
            ]);
        
       if ($sponsors->save()){
        //Name of Sponsor. Relationship, Address  , Email, Phone     
        return redirect()->route('applicant.preview')->with('message','Sponsor  Added Successfully');
       }
    }

    public function preview(){

        $pay =1;
        $id = Auth::user()->username; // Get the email of the applicant
        $applications =  Application::where('email', $id)->get();
        $formno =  Application::where('email', $id)->get()->toArray();
        
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get()->toArray();
        $formno =  $application[0]->formno;
        $formno = $application[0]->formno;
        $data['submitted'] = $application[0]->submitted;  //
        $data['status'] = $application[0]->status;
        $setups      = Setup::all();
        $terms =  Term::where('status','Active')->get();
        //$data['submitted'] = 0;  // Form not submitted
        
        return view('applicant.preview',$data);
        /*
        ->withSesions($sesions)        
        ->withSetups($setups);
        */
    }


    public function submitApplication(Request $request){
       //dd($request);
        $request->validate([            
            'accepted'=>'required',
            'passport' => 'required|mimes:jpeg,jpg,png|max:20'                
            ]);
        $pay =1;
        $id = Auth::user()->username; // Get the email of the applicant
        $applications =  Application::where('email', $id)->get();
        $formno =  Application::where('email', $id)->get()->toArray();
        //$formno =  $formno[0]['formno'];
        $ids =  $formno[0]['id'];
        $formno =  $formno[0]['formno'];


        //dd($request);
        $file = $request->file('passport'); 
        //$file->resize(100,100);
        $files = $request->file('passport')->getClientOriginalName();
        $ext = $request->passport->extension();
        $extval = strlen($request->passport->extension());
        $fileval = strlen($request->file('passport')->getClientOriginalName());
        $diff = $fileval -  $extval;
        $value = substr($file, 0, $diff);
        $value = $formno;        
        $fileName   = $value.''.'.jpg';        
        
        
        $destinationPath = public_path('passport/') ;           
        $file->move($destinationPath,$fileName);
        //die(); 
        //$file->move($destinationPath,$fileName); 
        

       
        $accepted= $request->input('accepted');
        $submitted= $request->input('submitted');
        $applicants =  Application::find($ids);
        $applicants->accepted = $accepted;
        $applicants->submitted = $submitted;
        $applicants->passport = $fileName;
        $applicants->save();
        DB::table('application')->where('email',$id)->update(['submitted' => $submitted]);

        return redirect()->route('applicant.success')->with('message','Application Submitted Successfully');

    }

    public function success(){

        $pay =1;
        $id = Auth::user()->username; // Get the email of the applicant
        $application = DB::table('application')      
        ->where('application.email',$id)
        ->where('application.status',$pay)
        ->get()->toArray();
        $status = $application[0]->status;
        $submitted = $application[0]->submitted;  // Form not submitted
        $applications =  Application::where('email', $id)->get();
        //$formnos =  Application::where('email', $id)->get()->toArray();
        //$formno =  $formnos[0]['formno'];
        $setups  = Setup::all();
        $terms = Term::where('status','Active')->get();
        //$data['submitted'] = @$formnos[0]['submitted'];  // Form not submitted
        

        return view('applicant.success', ['status'=>$status, 'submitted'=>$submitted,
        'applications'=>$applications, 'terms'=>$terms]);
        /*
        ->withApplications($applications)
        ->withSesions($sesions)
        ->withSetups($setups);
        */
             
    }

    public function printform(Request $request){
       // dd($request);
        $id = Auth::user()->username;
        $application = DB::table('application')      
        ->where('application.email',$id)        
        ->get()->toArray();
        $submitted = 1;  // Form  submitted
        $status = 1;
        $applications =  Application::where('email', $id)->get();
        $examresults  =  Examresult::where('formno', $application[0]->formno)->get();
        $examboards   =  Examboard::where('formno', $application[0]->formno)->get();
        $employments  =  Employment::where('formno', $application[0]->formno)->get();
        //dd($application, $applications, $examresults, $examboards);
        //$certificates =  Certificate::where('formno', $application[0]->formno)->get();
        $certificates = DB::table('applcerts')      
        ->where('formno',$application[0]->formno)        
        ->get()->toArray();
        $sponsors     =  Sponsor::where('formno', $application[0]->formno)->get();
        
        $setups  = Setup::all();
        $terms = Term::where('status','Active')->get();

        return view('applicant.printform', ['terms'=>$terms,'sponsors'=>$sponsors,'certificates'=>$certificates,'employments'=>$employments,
        'examboards'=>$examboards,'examresults'=>$examresults,'applications'=>$applications,
         'status'=>$status, 'submitted'=>$submitted]);
        
    }

    // Display all users that had paid for the form for admin
    public function applnotpaid(){
        $status =0;
        $applpayments = DB::table('applpayments')
        ->leftjoin('application', 'applpayments.formno' ,'=', 'application.formno')
        ->select('applpayments.*','application.referrer as referrers')
        ->where('applpayments.status',$status)
        ->get();
        //$applpayments = Applpayment::where('status',$status)->get();
        //$appltransactions =  Appltransaction::all();
        $setups = Setup::all();
        $terms = Term::all();
        return view('admin.applicant.applnotpaid',['terms'=>$terms,'applpayments'=>$applpayments,
        'setups'=>$setups]);
        //->withSetups($setups)
        //->withSesions($sesions)
        //->withApplpayments($applpayments); 
    }


   // Display all users that had paid for the form for admin
    public function applpaid(){
        $status =1;
        //$applpayments = Applpayment::where('status',$status)->get();
        $applpayments = DB::table('applpayments')
        ->leftjoin('application', 'applpayments.formno' ,'=', 'application.formno')
        ->select('applpayments.*','application.referrer as referrers')
        ->where('applpayments.status',$status)
        ->get();

        $count = DB::table('applpayments')
        ->leftjoin('application', 'applpayments.formno' ,'=', 'application.formno')
        ->select('applpayments.*','application.referrer as referrers')
        ->where('applpayments.status',$status)
        ->count();

        //dd($applpayments);
        //$appltransactions =  Appltransaction::all();
        $setups = Setup::all();
        $terms = Term::all();
        return view('admin.applicant.applpaid',['terms'=>$terms, 'applpayments'=>$applpayments,
        'setups'=>$setups,'count'=>$count]);
       // ->withSetups($setups)
        //->withSesions($sesions)
        //->withApplpayments($applpayments); 
    }


    // Display all users that had paid for the form for admin
    public function finance_applpaid(){
        $status =1;
        //$applpayments = Applpayment::where('status',$status)->get();
        $applpayments = DB::table('applpayments')
        ->leftjoin('application', 'applpayments.formno' ,'=', 'application.formno')
        ->select('applpayments.*','application.referrer as referrers')
        ->where('applpayments.status',$status)
        ->get();

        //dd($applpayments);
        //$appltransactions =  Appltransaction::all();
        $setups = Setup::all();
        $terms = Term::all();
        return view('finance.applpaid',['terms'=>$terms, 'applpayments'=>$applpayments,
        'setups'=>$setups]);
       // ->withSetups($setups)
        //->withSesions($sesions)
        //->withApplpayments($applpayments); 
    }


    public function studentpaid(){
        $status =1;
        //$applpayments = Applpayment::where('status',$status)->get();
        $feespayments = DB::table('feespayments')
        ->leftjoin('students', 'feespayments.matric' ,'=', 'students.matric')
        ->leftjoin('programmes', 'students.programme_id' ,'=', 'programmes.id')
        ->leftjoin('transactcodes', 'feespayments.pin' ,'=', 'transactcodes.pin')
        ->select('feespayments.*','students.sname as stsname', 'students.fname as stfname',
          'students.oname as stoname','programmes.progdesc as prog','transactcodes.rrr as trrr')
        ->where('feespayments.relvant',$status)
        ->where('transactcodes.tistatus',$status)
        ->get();

        //dd($applpayments);
        //$appltransactions =  Appltransaction::all();
        $setups = Setup::all();
        $terms = Term::all();
        return view('finance.studentpaid',['terms'=>$terms, 'feespayments'=>$feespayments,
        'setups'=>$setups]);
       // ->withSetups($setups)
        //->withSesions($sesions)
        //->withApplpayments($applpayments); 
    }



    // Display all transactions for admin
    public function transaction(){
        $appltransactions =  Appltransaction::all();
        $count =  Appltransaction::count();
        $setups = Setup::all();
        $terms = Term::all();
        return view('admin.applicant.transaction',['terms'=>$terms, 'appltransactions'=>$appltransactions
        ,'count'=>$count]);
     
    }

    // Display all Reports for Application for admin
    public function getApplicantsReport(){
       /* $applications = DB::table('applications')
        ->leftjoin('programmes','applications.programme_id','=','programmes.id')
         ->leftjoin('modes','applications.mode_id','=','modes.id')
        ->leftjoin('maritals','applications.marital_id','=','maritals.id')
        ->leftjoin('genders','applications.gender_id','=','genders.id')
        ->leftjoin('states','applications.state_id','=','states.id')
        ->leftjoin('examboards','applications.formno','=','examboards.formno')          
        ->select(DB::raw('applications.sname, applications.fname,applications.oname,
         applications.formno,applications.email,applications.mphone, 
         modes.name as modename,maritals.name as maritalname,
        genders.name as gendername, states.name as statename,
        examboards.certificate as ecertificate, 
        programmes.department as programmename'))
        ->get();
        */

        
        $applications =  Application::all();
        $count =  Application::count();        
        $setups = Setup::all();
        $terms = Term::all();
        $bloodgroups = Bloodgroup::all();
        $certificates = Certificate::all();
        $exams = Exam::all();
        $examboards = Examboard::all();
        $genders = Gender::all();
        $graders = Grader::all();
        $states  = State::all();
        $lgas = Lga::all();
        $maritals = Marital::all();
        $modes = Mode::all();
        $schools = School::all();
        $programmes = Programme::all();
        $religions = Religion::all();
        $relationships = Relationship::all();
        return view('admin.applicant.report',['relationships'=>$relationships,'religions'=>$religions,
        'programmes'=>$programmes, 'modes'=>$modes, 'maritals'=>$maritals,'lgas'=>$lgas, 'states'=>$states,
        'graders'=>$graders,'genders'=>$genders, 'examboards'=>$examboards, 'exams'=>$exams, 
        'certificates'=>$certificates,'bloodgroups'=>$bloodgroups, 'terms'=>$terms, 'schools' =>$schools,
        'applications'=>$applications,'count'=>$count]);
            }

      
    //Report for Applicant         
    public function applreport(Request $request){
    dd($request);
                          
    $setups = Setup::all();
    $terms = Term::all();
    if($request->input('mode') !=''){
        //$applications = Application::where('mode_id',$request->input('mode'))->get();
        $count =  Application::where('mode_id',$request->input('mode'))->count();
        $mode =   Mode::where('id', $request->input('mode'))->get()->toArray(); 
        
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
        applications.formno,applications.email,applications.mphone,  modes.name as modename,
        maritals.name as maritalname,genders.name as gendername,states.name as statename, 
        applcerts.name as  applcertsname, applcerts.certificate as applcertificate,
        applcerts.grade as  applcertsgrade,examresults.no_ofsitting as sitting, 
        examresults.examno as examresultsname,exams.name as examname, subjects.name as subjectname, 
        graders.name as gradername,programmes.department as programmename'))
        ->where('mode_id','=',$request->input('mode'))
         ->orderBy('applications.id') 
         ->orderBy('examresults.subject_id') 
         ->get();
         
        $resutltArray = [];
        
        foreach ($applications as $result){
    
            if(!isset($resutltArray[$result->formno])){
                $resutltArray[$result->formno]=['sname' => $result->sname,
                                                'fname' => $result->fname,
                                                'oname' => $result->oname,
                                                'formno' => $result->formno, 
                                                //'jambno' => $result->jambno, 
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
             
               $count = Application::where('mode_id',$request->input('mode'))->count();
                $mode = Mode::where('id', $request->input('mode'))->get()->toArray(); 
                $name = $mode[0]['name'];
                $id = $request->input('mode');
                
    
                }elseif($request->input('gender') != ''){
                $applications = Application::where('gender_id',$request->input('gender'))->get();
                $count =Application::where('gender_id',$request->input('gender'))->count();
                $gender = Gender::where('id', $request->input('gender'))->get()->toArray(); 
                $name = $gender[0]['name'];
                $id = $request->input('gender');  
                
                }
                return view('admin.applicant.applreport',['applications'=>$applications,
                'terms'=>$terms,'name'=>$name, 'id'=>$id,'count'=>$count]);
                
    
            }
      
}


