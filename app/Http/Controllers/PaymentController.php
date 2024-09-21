<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Term;
use App\Models\Setup;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Programme;
use App\Models\Applpayment;
use App\Models\Feeschedule;
use App\Models\Feespayment;
use App\Models\Transactcode;
use Illuminate\Http\Request;
use App\Models\Transactionlog;
use App\Models\Appltransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class PaymentController extends Controller
{   

    public function methods(){
        $status = 1;
        $id = Auth::user()->username;   
        $students = Student::where('matric',$id)->get();
        $student = Student::where('matric',$id)->get()->toArray();  
        $term =  Term::where('status','Active')->get()->toArray();     
        $terms = Term::where('status','Active')->get();
        
        // to get amount paid
        $feespayments = Feespayment::where('matric',$id)
        ->where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['name'])
        ->where('level',  @$student[0]['level'])
        ->where('relvant', $status)
        ->get();
        
        $tuition = 150000;
        $total = 0;
        foreach($feespayments as $payments){
        $total = $total + $payments['amtpaid'];        
        }
       
       $totalAmountPaid =  $total;
       $totalAmountleft =  $tuition - $total;

        if($tuition == $total){
            return redirect()->route('student.index')->with('message', 'Full School Fees Payments. Thank you');
        }else{
        return view('student.methods', ['terms'=>$terms, 'students'=>$students]);
        /*->withSesions($sesions)
        ->withStudents($students);*/
        }
    }
    // Select Payments Method
    public function paymethods(Request $request){
        //dd($request);
        $request->validate([            
            'term'=>'required',    
            'typemethods'=>' required'
                             
            ]);
        $id = Auth::user()->username;  
        
        //$sel_terms = $request->input('term');
                      
        $term = Term::where('status','Active')->get()->toArray();
        $method = $request->input('typemethods') ;
         // Pre-defined Payments; Acceptance, First and Second Instalments
        if($request->input('typemethods') == 'defined'){

        $id = Auth::user()->username; 
        $terms = Term::where('status','Active')->get();
        $students = Student::where('matric',$id)->get();
        $student = Student::where('matric',$id)->get()->toArray(); 
        
        $fees = Fee::where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['id'])
        ->where('level',  @$student[0]['level'])
        //->where('type', $new)
        ->get();
             
        //check if payadvice advice was generated
        $counts = Feespayment::where('matric',$id)
        ->where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['name'])
        ->where('level',  @$student[0]['level'])        
        ->count();

        $feespayments = Feespayment::where('matric',$id)
        ->where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['name'])
        ->where('level',  @$student[0]['level'])        
        ->get()
        ->toArray();

       
        $applno = @$feespayments[0]['applno'];
        $matric = @$feespayments[0]['matric'];
        $type = @$feespayments[0]['type'];
        $status = @$feespayments[0]['relevant'];
      
         return view('student.methodone',['terms'=>$terms, 'fees'=>$fees, 'students'=>$students,
                      'method' => $method]);
         /*->withSesions($sesions)
         ->withFees($fees)
         ->withStudents($students); */ 
        
         }else{
         // Flexible Payments 
        $terms = Term::where('status','Active')->get();
        $students = Student::where('matric',$id)->get();
        $student = Student::where('matric',$id)->get()->toArray(); 
        
        $fee = Fee::where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['id'])
        ->where('level',  @$student[0]['level'])
        //->where('type', $new)
        ->get()->toArray();
        /*
        echo '<pre/>';
        print_r($fee[1]['item']);
        print_r($fee[0]['amount']);
        echo '</pre>';
        die();
        */
        
        $counts = Feespayment::where('matric',$id)
        ->where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['name'])
        ->where('level',  @$student[0]['level'])        
        ->count();

        $feespayments = Feespayment::where('matric',$id)
        ->where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['name'])
        ->where('level',  @$student[0]['level'])        
        ->get()
        ->toArray();

       // echo '<pre>'; 
       // print_r($feespayments);
       // echo '</pre>';
        //die();
        $applno = @$feespayments[0]['applno'];
        $matric = @$feespayments[0]['matric'];
        $type = @$feespayments[0]['type'];
        $status = @$feespayments[0]['relevant'];
      
        //New Students, Not Generated Payadvice before and select Flexible Payments
        if( $counts == 0 && @$student[0]['applno'] == @$student[0]['matric']){
            $AcceptanceFees = $fee[0]['amount'];
            $type = 'new';
            $OPayments = '';
        }
        //Old Students, Not Generated Payadvice before and select Flexible Payments
        elseif( $counts == 0 && @$student[0]['applno']!= @$student[0]['matric']){
            $IntialPayments = $fee[1]['amount'];
            $type = 'old';
            $OPayments = '';
        }
        //New Students, Paid Acceptance Fee and select Flexible Payments
        elseif( $counts > 0 && @$student[0]['applno']!= @$student[0]['matric'] && $type == 'new'){
            $OPayments = 'Other Payment';
            $type = 'new';
        }
        //Old Students, Paid Acceptance Fee/Intial Payments and select Flexible Payments
        elseif( $counts > 0 && @$student[0]['applno']!= @$student[0]['matric'] && $type == 'old'){
            $OPayments = 'Other Payment';
            $type = 'old';
        }        
          return view('student.methodtwo', ['terms'=>$terms, 'students'=>$students,
         'OPayments'=>$OPayments, 'type'=>$type, 'IntialPayments'=>$IntialPayments,
          'AcceptanceFees'=>$AcceptanceFees]);
         /* ->withSesions($sesions)
          ->withStudents($students); */
         }      
        
    }

  
    // Payment of application form
    /*
      If payment was not made after an attempt to make payment...  there should be option to
      generate another only when  after checking the status of that reference code and it is 
      not successful or  simply bring back the former one. 
      After payment of application form, update the payment and log the applicant out with display
      information of the login details....make known information for their login details
      maybe on FAQ

      NB: Update the Applpayment and Insert into Appltransaction

      The application form enabled for the applicant to fill 
         */
      // To get information for application payment
      public function apaystatus(Request $request){
        $pay = 0;
        
        $id = Auth::user()->username; 
        //$data['sname'] = Auth::user()->sname;
        //$data['fname'] = Auth::user()->fname;
        //$data['oname'] = Auth::user()->oname;
        $term = Term::where('status','Active')->get()->toArray();
        
        //$applications = DB::table('application')->where('email',$id)->get();
        //$application = DB::table('application')->where('email',$id)->get()->toArray();

        $student = Student::where('matric',$id)->get()->toArray();
        
        

        $applpayments =  Applpayment::where('email',$id)
        ->where('term_id', $term[0]['id'])        
        ->where('status', $pay)           
        ->get()
        ->toArray();  
        
        //dd($applpayments);

       

        $status = @$applpayments[0]['status'];


        $number = Applpayment::where('email',$id)
        ->where('term_id', $term[0]['id'])        
        ->where('status', $pay)    
        ->count();

        //echo $number;
        //die();
        //->count();
        if($number == 0  AND $status==0){
            return redirect()->route('applicant.index')->with('message', 'You dont have any payment code generated!');
            // redirect to homepage to 
        }elseif($number > 0  OR $status == 0){
        $applpayments = Applpayment::where('email',$id)
        ->where('term_id', @$term[0]['id'])       
        ->where('status',  $pay)        
        ->get()->toArray();

       // dd(date('Y-m-d h:i:s',strtotime($transactcodes[0]['created_at'])));

        $amount =  @$applpayments[0]['amount'];
        $orderID =  @$applpayments[0]['paymentcode'];
        $rrr =  @$applpayments[0]['rrr'];
        $created_at = @$applpayments[0]['created_at'];  
        $items = 'Application Form Fees';
        //$level = @$transactcodes[0]['level'];
        //$term = @$applpayments[0]['term_id'];
        $term = $term[0]['name'];   
        @$new_hash_string = MERCHANTID.$applpayments[0]['rrr']. APIKEY;           
        $new_hash = hash('sha512', $new_hash_string); 
        $new_hash =  @$new_hash;
        $responseurl =  route('applicants.remitapay');
        $terms =  Term::where('status','Active')->get(); 
        $setups = Setup::all();        
        
         
        return view('applicant.paystatus',['amount'=>$amount, 'orderID'=>$orderID,
        'rrr'=>$rrr,'term'=>$term,'created_at'=>$created_at, 'items'=>$items,
        'new_hash'=>$new_hash,'responseurl'=>$responseurl,'terms'=>$terms]);
        /*->withSetups($setups)
        ->withSesions($sesions)
        ->withTransactcodes($transactcodes);
                       */
        }
        else{
            return redirect()->route('student.course')->with('message', 'Payment was Successful. Continue to register your courses');

        }
        
     }

         
      //Connect to Remita to receive payment details for application of form
        public function remitapay(Request $request){
          // dd($request); 
           ////$orderID = $id;
           $orderID = $request->input('orderId');
           $mert = MERCHANTID;
           $api_key = APIKEY;
           $concatString = $orderID . $api_key . $mert;
           $hash = hash('sha512', $concatString);
           $url = CHECKSTATUSURL . '/' . $mert . '/' . $orderID . '/' . $hash . '/' . 'orderstatus.reg';
           //  Initiate curl
           $ch = curl_init();
           // Disable SSL verification
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
           // Will return the response, if false it print the response
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           // Set the url
           curl_setopt($ch, CURLOPT_URL, $url);
           // Execute
           $result = curl_exec($ch);
           // Closing
           curl_close($ch);
           $response = json_decode($result, true);
   
           //print_r($response);
           //die();
   
                   
           //$response['orderId'];
           //$response['RRR'];
           //echo   $response['status'];
           //dd($request);
           $response_code = $response['status'];     
           $orderID = $response['orderId'];
           $rrr = $response['RRR'];
           $response_message = $response['message'];
           $data['response_message'] = $response_message;
           $transac_date = date("Y-m-d h:i:s",time());
           //Payment Successful
           if($response_code == '01' || $response_code == '00'){
               //Get the id of applpayments table to update it
               //$applpayments = Applpayment::where('paymentcode', $orderID)->get()->toArray(); 
               $applpayments = Applpayment::where('paymentcode', $orderID)->get();            
               // Get the id of application table to update it
               //$application   = DB::table('application')->where('email',$email)->get()->toArray();
               // Insert into Appltransaction
               $appltransactions=new Appltransaction([
               'formno'=>$applpayments[0]->formno,            
               'sname'=>$applpayments[0]->sname,
               'fname'=>$applpayments[0]->fname,
               'oname'=>$applpayments[0]->oname,
               'paymentcode'=>$orderID,
               'transac_response'=>$response_code,
               'transac_date'=>$transac_date,
               'rrr'=>$rrr,
               'transac_info'=>$response_message,
               'amount'=>$applpayments[0]->amount,    
               ]);
               if ($appltransactions->save()){
                  
                   $data['response_message'] =  $response_message;
                   $email = $applpayments[0]->email;
                   $id = $applpayments[0]->id;
                   $status = 1;
                    // update  the application
                    DB::table('application')->where('email',$email)->update(['status' => $status]);   
                    // update  the Applpayments             
                   $applpayments=Applpayment::find($id);
                   $applpayments->status = $status;                
                   if($applpayments->save()) {
                   //return view('applicants.applpayresponse', $data)->withAppltransactions($appltransactions);
                   return redirect()->route('applicant.index')->with('message', 'Payment Successful. Continue to fill your form!');
                   }
               }
   
           }
           //RRR Generated Successfully
           elseif($response_code == '021'){
               $response_code = $response['status'];     
               $orderID = $response['orderId'];
               $rrr = $response['RRR'];
               $response_message = $response['message'];
               //$response_message = $response['message'];
               $terms =  Term::where('status','Active')->get();
               //$applpayments = Applpayment::where('paymentcode',$orderID)->get()->toArray();
               $applpayments = Applpayment::where('paymentcode',$orderID)->get();
               //echo $response_code;
               //die();
               // Insert into Appltransaction
               $appltransactions=new Appltransaction([
               'formno'=>$applpayments[0]->formno,            
               'sname'=>$applpayments[0]->sname,
               'fname'=>$applpayments[0]->fname,
               'oname'=>$applpayments[0]->oname,
               'paymentcode'=>$orderID,
               'transac_response'=>$response_code,
               'transac_date'=>$transac_date,
               'rrr'=>$rrr,
               'transac_info'=>$response_message,
               'amount'=>$applpayments[0]->amount,    
               ]);
               //echo 'RRR Generated Successfully';
               //die();
               if ($appltransactions->save()){ 
                   // update  the application to offline, do it for online 
                   //$email = $applpayments[0]['email'];
                   //$status =2;
                   //DB::table('application')->where('email',$email)->update(['status' => $status]);              
               
               return redirect()->route('applicant.index')->with('message', 'Payment Pending. Kindly try again!'); 
               //return view('applicants.index', $data)->withSesions($sesions)->withAppltransactions($appltransactions);
               //return view('applicants.index', $data)->withSesions($sesions)->withApplpayments($applpayments)->withApplications($applications);   
           }
           }
           //Your Transaction was not Successful
           else{
               /*$applpayments = Applpayment::where('paymentcode',@$response['orderID'])->get()->toArray();
               $response_code = $response['status'];     
               $orderID = $response['orderId'];
               $rrr = $response['RRR'];
               $response_message = $response['message'];
               $appltransactions=new Appltransaction([
               'formno'=>@$applpayments[0]['formno'],            
               'sname'=>@$applpayments[0]['sname'],
               'fname'=>@$applpayments[0]['fname'],
               'oname'=>@$applpayments[0]['oname'],
               'paymentcode'=>$response['orderID'],
               'transac_response'=>$response_code,
               'transac_date'=>$transac_date,
               'rrr'=>@$response['rrr'],
               'transac_info'=>$response_message,
               'amount'=>@$applpayments[0]['amount'],    
               ]);
               if ($appltransactions->save()){ */ 
               return redirect()->route('applicant.index')->with('status', 'Something went wrong. Kindly try again!');
               //}
           }
         
           
       }     
    //Payment of school fees for new admitted students
    /*
    After the admission of student, update the applicant role privilege to be able to make payment
    for all the various options.... Acceptance, 1st, 2nd or 3rd Instalmemt and Full Payment.
    If payment was not made after an attempt to make payment...  there should be option to generate 
    another only when  after checking the status of that reference code and it is not successful or 
    simply bring back the former one. 
    After successful payment of school fees update payment....matric number generated and 
    student logout with display imformation of new log details. make known information for their 
    login details maybe on FAQ
    */

    
    // Generate RRR and Proceed to Pay for flexible Payments of School Fees
    public function remita_transactionflex(Request $request){
        //dd($request);
        $request->validate([            
        'term_id'=>'required',    
        'fee'=>'required',
        'paymentmode'=>'required',
                   
          ]);
    
        $amount = $request->input('fee'); // from 
        $item = $request->input('item'); // from 
        $sname = $request->input('sname');
        $fname = $request->input('fname');
        $oname = $request->input('oname');        
        $payerName = $sname.' '.$fname.' '.$oname;
        $payerEmail = $request->input('email');
        $payerPhone = $request->input('mphone');    
        $paymode = $request->input('paymentmode');
        $level = $request->input('level');
        $applno = $request->input('applno');
        $matric = $request->input('matric');
        $programme_id = $request->input('programme_id');
        $terms = Term::where('id',$request->input('session'))->get()->toArray();
    
        //echo '<br/>';
        //print_r($sesions);
        //echo '<br/>';
        //die();
    
    
    
        //Get Type of Student Old or New
    
        if($level == 100){ $type = 'new' ;}  // To get the type of student either new or old
        elseif($level == 200 && $applno == $matric ){$type = 'new';}
        elseif($level == 200 && $applno != $matric ){$type = 'old';}
        elseif($level == 300 && $applno == $matric ){$type = 'new';}
        elseif($level == 700 && $applno == $matric ){$type = 'new';}
        elseif($level == 300){$type = 'old';}
        elseif($level == 400){$type = 'old';}
        elseif($level == 500){$type = 'old';}
        
    
        
        $fees = Fee::where('term_id', $request->input('term_id'))
        ->where('programme_id', $request->input('programme_id'))
        ->where('level', $request->input('level'))
        ->where('type', $type)    
        ->get()
        ->toArray();
        
    
           
    
        $totalAmount = $amount ;
        //$amount = $amount ;
        $items =   $item;
      
        $orderpw=mt_rand(300000000, 88888888888);
        $inputs=array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
        $rand_keys1 = array_rand($inputs, 4);
        $orderid=$inputs[$rand_keys1[0]].$inputs[$rand_keys1[1]].$orderpw.$inputs[$rand_keys1[2]];
        //$data['formno'] = $orderid;
         $orderID  = $orderid;
    
               
        $responseurl = route('student.remitapay'); 
        
        
        $timesammp=DATE("dmyHis"); 
        
        //$responseurl = PATH. "/remitaTransactionDetails";
        //var_dump($responseurl);
    
        $hash_string = MERCHANTID . SERVICETYPEID1. $orderID . $amount . $responseurl . APIKEY;
        $hash = hash('sha512', $hash_string);
    
       // var_dump($hash_string);
    
        $itemtimestamp = $timesammp;
        $itemid1="123456";
        $itemid2="654321";
        $beneficiaryName="JABU CDL"; // CDL JABU ACCOUNT DETAIlL    
        
        $beneficiaryAccount=BENEFICIALACCOUNT; 
    
        $beneficiaryAmount = $totalAmount;
    
        $bankCode=BANKCODE; // GTB
        //$bankCode3="070";
        
        $deductFeeFrom=1;    
    
    //The JSON data.
        $content = '{"merchantId":"'. MERCHANTID
            .'"'.',"serviceTypeId":"'.SERVICETYPEID1
            .'"'.",".'"totalAmount":"'.$totalAmount
            .'","hash":"'. $hash
            .'"'.',"orderId":"'.$orderID
            .'"'.",".'"responseurl":"'.$responseurl
            .'","payerName":"'. $payerName
            .'"'.',"payerEmail":"'.$payerEmail
            .'"'.",".'"payerPhone":"'.$payerPhone
            .'","lineItems":[
                {"lineItemsId":"'.$itemid1.'","beneficiaryName":"'.$beneficiaryName.'","beneficiaryAccount":"'.$beneficiaryAccount.'","bankCode":"'.$bankCode.'","beneficiaryAmount":"'.$beneficiaryAmount.'","deductFeeFrom":"'.$deductFeeFrom.'"}
    ]}';
        
        $curl = curl_init(GATEWAYURL);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);       
        
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $jsonData = substr($json_response, 6, -1);
        $response = json_decode($jsonData, true);
        //var_dump($response);
        //die();
        
        $statuscode = $response['statuscode'];
        $statusMsg = $response['status'];
    
        
        //$statuscode = $response['statuscode'];
        //$statusMsg = $response['status'];
        //$rrr = trim($response['RRR']);
        if($statuscode == '025'){
            $rrr = trim($response['RRR']);             
            $new_hash_string = MERCHANTID . $rrr . APIKEY;           
            $new_hash = hash('sha512', $new_hash_string);            
            $new_hash = @$new_hash;
            $orderID = @$orderID;
            $rrr =  @$rrr;
            $amount = @$amount;
            $paymode = @$paymode;
            $responseurl = @$responseurl;
            $pay = 0;  // Not paid yet
    
            $feespayments=new Feespayment([
            'applno'=>$request->input('applno'),
            'matric'=>$request->input('matric'),
            'sname'=>$request->input('sname'),
            'fname'=>$request->input('fname'),
            'oname'=>$request->input('oname'),            
            'email'=>$request->input('email'),           
            'mphone'=>$request->input('mphone'),
            'term_id'=> @$terms[0]['name'],
            'level'=>$request->input('level'),
            'programme_id'=>$request->input('programme_id'),
            'semester'=>$items,
            'type'=>$type,
            'pin'=>$orderID,
            'rrr'=> $rrr,
            'relvant'=>$pay,
            'amtpaid'=>$amount, 
            'amtdue'=>$amount,           
            ]);
             
            $transactcodes =new Transactcode([
                'matric'=>$request->input('matric'),
                'level'=>$request->input('level'),
                'programme_id'=>$request->input('programme_id'),
                'semester'=>$items,            
                'type'=>$type,           
                'mphone'=>$request->input('mphone'),
                'term_id'=>@$terms[0]['name'],
                'pin'=>$orderID,
                'rrr'=> $rrr,
                'status'=>$pay,
                'amount'=>$amount,                      
                ]);
    
                $transactcodes->save();
    
        
       if ($feespayments->save()){        
           $status = 0;
           $submitted = 0;
           $paymode = @$paymode;
           $items = @$items;
        $feespayments = Feespayment::where('matric',$matric)->where('relvant', $pay)->get();
        return view('student.applpay', ['new_hash'=>$new_hash,'orderID'=>$orderID,
         'rrr '=>$rrr, 'amount'=>$amount, 'paymode' =>$paymode, 'responseurl'=>$responseurl,
         'status'=> $status, 'submitted'=>$submitted, 'items'=>$items]);
        /*
        ->withFeespayments($feespayments);
        */
       }      
    
        }      
       
    
     }


       // Proceed to Generate RRR
 public function remita_transaction(Request $request){
    //dd($request);
    $request->validate([            
     'term_id'=>'required',    
     'fee'=>'required',
     'paymentmode'=>'required',
                
       ]);
      
     $sname = $request->input('sname');
     $fname = $request->input('fname');
     $oname = $request->input('oname');        
     $payerName = $sname.' '.$fname.' '.$oname;
     $payerEmail = $request->input('email');
     $payerPhone = $request->input('mphone');    
     $paymode = $request->input('paymentmode');
     $level = $request->input('level');
     $applno = $request->input('applno');
     $matric = $request->input('matric');
     $programme_id = $request->input('programme_id');
     $terms = Term::where('id',$request->input('term_id'))->get()->toArray();
 
     //echo '<br/>';
     //print_r($terms[0]['name']);
     //echo '<br/>';
     //die();
 
 
 
     //Get Type of Student Old or New
 
     if($level == 100){ $type = 'new' ;}  // To get the type of student either new or old
     elseif($level == 200 && $applno == $matric ){$type = 'new';}
     elseif($level == 200 && $applno != $matric ){$type = 'old';}
     elseif($level == 300){$type = 'old';}
     elseif($level == 400){$type = 'old';}
     elseif($level == 500){$type = 'old';}
 
     $fees = Fee::where('term_id', $request->input('term_id'))
     ->where('programme_id', $request->input('programme_id'))
     ->where('level', $request->input('level'))
     ->where('type', @$type)    
     ->get()
     ->toArray();
 
     //Get the item : Acceptance, 1st , 2nd Instalment
     $fee = Fee::where('id', $request->input('fee'))->get()->toArray();
     
 
     $totalAmount = @$fee[0]['amount'];
     $amount = @$fee[0]['amount'];
     $items =   @$fee[0]['item'];
   
     $orderpw=mt_rand(300000000, 88888888888);
     $inputs=array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
     $rand_keys1 = array_rand($inputs, 4);
     $orderid=$inputs[$rand_keys1[0]].$inputs[$rand_keys1[1]].$orderpw.$inputs[$rand_keys1[2]];
     //$data['formno'] = $orderid;
      $orderID  = $orderid;
 
            
     $responseurl = route('student.remita_pay'); // change to remita_pay from remitapay
     
     
     $timesammp=DATE("dmyHis"); 
     
     //$responseurl = PATH. "/remitaTransactionDetails";
     //var_dump($responseurl);
 
     $hash_string = MERCHANTID . SERVICETYPEID1. $orderID . $amount . $responseurl . APIKEY;
     $hash = hash('sha512', $hash_string);
 
    //var_dump($hash_string);
 
     $itemtimestamp = $timesammp;
     $itemid1="123456";
     $itemid2="654321";
     $beneficiaryName=BENEFICIALNAME; // CDL JABU ACCOUNT DETAIlL    
     
     $beneficiaryAccount=BENEFICIALACCOUNT;
 
     $beneficiaryAmount = $totalAmount;
 
     $bankCode=BANKCODE; // GTB
     //$bankCode3="070";
     
     $deductFeeFrom=1;    
 
 //The JSON data.
     $content = '{"merchantId":"'. MERCHANTID
         .'"'.',"serviceTypeId":"'.SERVICETYPEID1
         .'"'.",".'"totalAmount":"'.$totalAmount
         .'","hash":"'. $hash
         .'"'.',"orderId":"'.$orderID
         .'"'.",".'"responseurl":"'.$responseurl
         .'","payerName":"'. $payerName
         .'"'.',"payerEmail":"'.$payerEmail
         .'"'.",".'"payerPhone":"'.$payerPhone
         .'","lineItems":[
             {"lineItemsId":"'.$itemid1.'","beneficiaryName":"'.$beneficiaryName.'","beneficiaryAccount":"'.$beneficiaryAccount.'","bankCode":"'.$bankCode.'","beneficiaryAmount":"'.$beneficiaryAmount.'","deductFeeFrom":"'.$deductFeeFrom.'"}
 ]}';
     
     $curl = curl_init(GATEWAYURL);
     curl_setopt($curl, CURLOPT_HEADER, false);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_HTTPHEADER,
         array("Content-type: application/json"));
     curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
     $json_response = curl_exec($curl);       
     
     $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
     curl_close($curl);
     $jsonData = substr($json_response, 6, -1);
     $response = json_decode($jsonData, true);
     //var_dump($response);
     //die();
     
     $statuscode = $response['statuscode'];
     $statusMsg = $response['status'];

     //dd($response['RRR']);
 
     
     //$statuscode = $response['statuscode'];
     //$statusMsg = $response['status'];
     //$rrr = trim($response['RRR']);
     if($statuscode == '025'){
         $rrr = trim($response['RRR']);             
         $new_hash_string = MERCHANTID . $rrr . APIKEY;           
         $new_hash = hash('sha512', $new_hash_string);            
         $new_hash = @$new_hash;
         $orderID = @$orderID;
         $rrr =  @$rrr;
         $amount = @$amount;
         $paymode = @$paymode;
         $responseurl = @$responseurl;
         $pay = 0;  // Not paid yet
 
         $feespayments=new Feespayment([
         'applno'=>$request->input('applno'),
         'matric'=>$request->input('matric'),
         'sname'=>$request->input('sname'),
         'fname'=>$request->input('fname'),
         'oname'=>$request->input('oname'),            
         'email'=>$request->input('email'),           
         'mphone'=>$request->input('mphone'),
         'term_id'=> @$terms[0]['name'],
         'level'=>$request->input('level'),
         'programme_id'=>$request->input('programme_id'),
         'semester'=>$items,
         'type'=>@$type,
         'pin'=>$orderID,
         'rrr'=> $rrr,
         'relvant'=>$pay,
         'amtpaid'=>$amount, 
         'amtdue'=>$amount,           
         ]);
          
         $transactcodes =new Transactcode([
             'matric'=>$request->input('matric'),
             'level'=>$request->input('level'),
             'programme_id'=>$request->input('programme_id'),
             'semester'=>$items,            
             'type'=>@$type,         
             'term_id'=>@$terms[0]['name'],
             'pin'=>$orderID,
             'rrr'=> $rrr,
             'tistatus'=>$pay,
             'amount'=>$amount,                      
             ]);
 
             $transactcodes->save();
 
     
    if ($feespayments->save()){        
        $status = 0;
        $submitted = 0;
        $paymode = @$paymode;
        $items = @$items;
        $rrr = @$rrr;        
     $feespayments = Feespayment::where('matric',$matric)->where('relvant', $pay)->get();  
     return view('student.applpay', 
     ['new_hash'=>$new_hash,'orderID'=>$orderID,'amount'=>$amount, 'paymode' =>$paymode, 
     'responseurl'=>$responseurl, 'status'=> $status, 'submitted'=>$submitted, 
     'items'=>$items, 'rrr'=>$rrr]);     
 
     }   
     /*
     ->withFeespayments($feespayments);
     
     */
    } 
         
    
 
  }
    
    
    // Payment of school fees for returning students
    /*
     students can make payment for 1st, 2nd or 3rd Instalment of School Fees not Acceptance Fees
     If payment was not made after an attempt to make payment...  there should be option to generate 
    another only when  after checking the status of that reference code and it is not successful or 
    simply bring back the former one. 
    After successful payment of school fees update payment...
    */


               // Connect to Remita to receive payment details for students
        public function remita_pay(Request $request){ // change name to remita_pay from remitapay
           // dd($request); 
           //$orderID = $id;
           
           $sname = Auth::user()->sname;
           $fname = Auth::user()->fname;
           $oname = Auth::user()->oname;
           $name =  $sname.' '.$fname.' '.$oname;
       
           $orderID = $request->input('orderId');
           $mert = MERCHANTID;
           $api_key = APIKEY;
           $concatString = $orderID . $api_key . $mert;
           $hash = hash('sha512', $concatString);
           $url = CHECKSTATUSURL . '/' . $mert . '/' . $orderID . '/' . $hash . '/' . 'orderstatus.reg';
           //  Initiate curl
           $ch = curl_init();
           // Disable SSL verification
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
           // Will return the response, if false it print the response
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           // Set the url
           curl_setopt($ch, CURLOPT_URL, $url);
           // Execute
           $result = curl_exec($ch);
           // Closing
           curl_close($ch);
           $response = json_decode($result, true);
       
           //print_r($response);
           //die();
       
           $response_code = $response['status'];
           
           //$response['orderId'];
           //$response['RRR'];
           //echo   $response['status'];
           //dd($request);
           $response_code = $response['status'];     
           $orderID = $response['orderId'];
           $rrr = $response['RRR'];
           $response_message = $response['message'];
           $data['response_message'] = $response_message;
           $transac_date = date("Y-m-d h:i:s",time());
           //Payment Successful
           if($response_code == '01' || $response_code == '00'){
               //Get the id of Feespayment table to update it        
               $feepayments = Feespayment::where('pin',$response['orderId'])->get()->toArray();  
               
               $transactionlog = Transactionlog::where('transactionid',$response['orderId'])
               ->where('transac_response', $response_code)
               ->count();
       
               if($transactionlog == 0){      
               // Insert into  Transactionlog table
               $transactionlogs = new Transactionlog([
               'matric'=>@$feepayments[0]['matric'],            
               'name'=>$name,        
               'transactionid'=>$orderID,
               'transac_response'=>$response_code,
               'transac_date'=>$transac_date,
               'remita_reference'=>$rrr,
               'response_description'=>$response_message,           
               ]);
               if ($transactionlogs->save()){
                  
                   $response_message =  @$response_message;
                   //$email = $feepayments[0]['pin'];
                   $ids = $feepayments[0]['pin'];
                   $status = 1;
                    // update  the feespayments
                    DB::table('feespayments')->where('pin',$ids)->update(['relvant' => $status]);   
                    // update  the Transactcode      
                   $transactcode = Transactcode::where('pin',$ids)->get()->toArray();            
                   $id =  @$transactcode[0]['id'];
                   $transactcodes = Transactcode::find($id);
                   $transactcodes->tistatus = $status;                
                   if($transactcodes->save()) {
                   //return view('applicants.applpayresponse', $data)->withAppltransactions($appltransactions);
                   return redirect()->route('student.course',['response_message'=>$response_message])->with('message', 'Payment Successful. Continue to Register your course');
                   }
               }
           }else{
               return redirect()->route('student.course')->with('message', 'Payment Successful. Continue to Register your course');
           }
           }
           //RRR Generated Successfully
           elseif($response_code == '021'){
               $response_code = $response['status'];     
               $orderID = $response['orderId'];
               $rrr = $response['RRR'];
               $response_message = $response['message'];
               
               $terms =  Term::where('status','Active')->get();
               $feepayments = Feespayment::where('pin',$orderID)->get()->toArray();
               //$applpayments = Applpayment::where('paymentcode',$orderID)->get()->toArray();
               //echo $response_code;
               //die();
               
              // Insert into  Transactionlog table
              $transactionlogs = new Transactionlog([
               'matric'=>@$feepayments[0]['matric'],            
               'name'=>$name,        
               'transactionid'=>$orderID,
               'transac_response'=>$response_code,
               'transac_date'=>$transac_date,
               'remita_reference'=>$rrr,
               'response_description'=>$response_message,           
               ]);
               //echo 'RRR Generated Successfully';
               //die();
               if ($transactionlogs->save()){ 
                                
               
               return redirect()->route('student.index')->with('message', 'Payment Pending. Kindly try again!'); 
               
           }
           }
           //Your Transaction was not Successful
           else{
               
               return redirect()->route('student.index')->with('message', 'Something went wrong. Kindly try again!');
               //}
           }
         
        
       }
        // For student to print receipt
       public function receipt(){
        $id = Auth::user()->username;
        $status = 1; // Payment Successful
        $students = Student::where('matric',$id)->get();        
        $feespayments = Feespayment::where('matric',$id)->where('relvant', $status)->get();
       
        return view('student.receipt',['feespayments'=>$feespayments,'students'=>$students]);
        /*
        ->withStudents($students)->withFeespayments($feespayments);
        */

    }


    public function printreceipt(Request $request){
        //dd($request);
        //$id = Auth::user()->username;
        $status = 1; // Payment Successful
        $students = Student::where('matric',$request->input('matric'))->get();  
        
        $count = Feespayment::where('id', $request->input('id'))
        ->where('matric',$request->input('matric'))
        ->where('relvant', $status)->count();

        $feespayments = Feespayment::where('id', $request->input('id'))
        ->where('matric',$request->input('matric'))
        ->where('relvant', $status)->get();
        
        
        
        //Get the exact record of payment
        $feespay = Feespayment::where('id', $request->input('id'))
        ->where('matric',$request->input('matric'))
        ->where('relvant', $status)
        ->get()
        ->toArray();
        
        /*
        $feeschedules  = Feeschedule::where('level',@$feespay[0]['level'])
        ->where('sesion_id',@$feespay[0]['sesion_id'])
        ->where('programme_id',@$feespay[0]['programme_id'])
        ->where('type',@$feespay[0]['type'])
        ->get();
        */

        //echo '<pre/>';
        //print_r($feeschedules);
        //echo '</pre>';
        //die();
        
        
        return view('student.printreceipt',['students' =>$students, 
        'feespayments'=> $feespayments]);
        /*->withStudents($students)
        ->withFeespayments($feespayments)
        ->withFeeschedules($feeschedules); */

    }

    public function applpaid(){
        // Display all users that had paid for the form for admin/finance ..rewrite it
       
        $status =1;       
        $applpayments = DB::table('applpayments')
        ->leftjoin('application', 'applpayments.formno' ,'=', 'application.formno')
        ->select('applpayments.*','application.referrer as referrers')
        ->where('applpayments.status',$status)
        ->get();
       
        $setups = Setup::all();
        $sesions = Term::all();
        return view('admin.applicant.applpaid');
        /*
        ->withSetups($setups)
        ->withSesions($sesions)
        ->withApplpayments($applpayments);  */
        
    }
    
    
    public function applnotpaid(){
        // Display all users that had not paid for the form for admin
     
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
        return view('admin.applicant.applnotpaid',['terms'=>$terms]);
        /*
        ->withSetups($setups)
        ->withSesions($sesions)
        ->withApplpayments($applpayments); */
    }
    
     public function transaction(){
         // Display all transactions including both successful and not suuccesful for admin
       
        $appltransactions =  Appltransaction::all();
        $setups = Setup::all();
        $terms = Term::all();
        return view('admin.applicant.transaction',['appltransactions'=>$appltransactions,
         'terms'=>$terms]);
        /*
        ->withSetups($setups)
        ->withSesions($sesions)
        ->withAppltransactions($appltransactions); 
        */
    }

      
      public function getApplicantsPayment(){
        // Display all Successful Payments for Application for admin
       
        $appltransactions =  Appltransaction::where('transact_info','=','Approved');
        $setups = Setup::all();
        $terms = Term::all();
        return view('admin.applicant.payment',['terms'=>$terms,'appltransactions'=>$appltransactions]);
        /*
        ->withSetups($setups)
        ->withSesions($sesions)
        ->withAppltransactions($appltransactions); */
        
    }


    public function index(){
        
        // Get the Payment Status of the student
        $id = Auth::user()->username;   
        $students = Student::where('matric',$id)->get();
        $student = Student::where('matric',$id)->get()->toArray();

        $term = Term::where('status','Active')->get()->toArray();

        $item1 = 'Acceptance Fees';

        $transactcode =  Transactcode::where('matric',$id)
        ->where('term_id', @$term[0]['name'])
        ->where('level',  @$student[0]['level'])
        ->where('semester', $item1)        
        ->get()
        ->toArray();
        
        $status = @$transactcode[0]['tistatus'];

        


        $number =  Transactcode::where('matric',$id)
        ->where('term_id', @$term[0]['name'])
        ->where('level',  @$student[0]['level'])
        ->where('semester', $item1)       
        ->count();
        
        if($number == 0  AND $status==0){             
        $terms = Term::where('status','Active')->get();
        $new = 'new';
        $fees = Fee::where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['id'])
        ->where('level',  @$student[0]['level'])
        ->where('type', $new)
        ->get();
    
        return view('student.payadvice',['terms'=>$terms,'fees'=>$fees,'students'=>$students]);
        /*->withSesions($sesions)
        ->withStudents($students)
        ->withFees($fees);*/

        }elseif($number > 0  AND $status == 0){
            $transactcodes = Transactcode::where('matric',$id)
            ->where('term_id', @$term[0]['name'])
             ->where('level',  @$student[0]['level'])
             ->where('semester', $item1)
             ->get()
             ->toArray();
            $amount =  $transactcodes[0]['amount'];
            $orderID =  $transactcodes[0]['pin'];
            $semester =  $transactcodes[0]['semester'];
            $rrr =  $transactcodes[0]['rrr'];
            $created_at = $transactcodes[0]['created_at'];
            $sname = @$student[0]['sname'];
            $fname = @$student[0]['fname'];
            $oname = @$student[0]['oname'];
            $new_hash_string = MERCHANTID.$transactcodes[0]['rrr']. APIKEY;           
            $new_hash = hash('sha512', $new_hash_string); 
            $new_hash =  @$new_hash;
            $responseurl =  route('student.remitapay');
            $terms =  Term::where('status','Active')->get(); 
            $setups = Setup::all(); 
            
            //echo '<pre>';
            //print_r($data);
            //echo '</pre>';
            //die();
            
             
            return view('student/makepayment', ['terms'=>$terms, 'transactcodes'=>$transactcodes,
            'amount'=>$amount, 'orderID'=>$orderID, 'semester'=>$semester, 'rrr'=>$rrr,
            'created_at'=>$created_at,'sname'=>$sname,'fname'=>$fname,'oname'=>$oname,
             'new_hash'=>$new_hash, 'responseurl'=>$responseurl,]);
            /*->withSetups($setups)
            ->withSesions($sesions)
            ->withTransactcodes($transactcodes);*/
    
            }elseif($number == 1  AND $status == 1){
                return redirect()->route('student.course')->with('message', 'Payment was Successful. Continue to register your courses');
    
            }

    }


    public function index_first(){
        
        // Get the Payment Status of the student
        $id = Auth::user()->username;   
        $students = Student::where('matric',$id)->get();
        $student = Student::where('matric',$id)->get()->toArray();

        $term = Term::where('status','Active')->get()->toArray();
        $item1 = 'First Instalment';

        $transactcode =  Transactcode::where('matric',$id)
        ->where('term_id', @$term[0]['name'])
        ->where('level',  @$student[0]['level'])
        ->where('semester', $item1)        
        ->get()
        ->toArray();
        $status = @$transactcode[0]['tistatus'];
        
        
        $number =  Transactcode::where('matric',$id)
        ->where('term_id', @$term[0]['name'])
        ->where('level',  @$student[0]['level'])
        ->where('semester', $item1)
        ->where('tistatus', $status) 
        ->count();        
        
        if($number == 0  AND $status==0){             
        $terms = Term::where('status','Active')->get();
        $new = 'new';
        $fees = Fee::where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['id'])
        ->where('level',  @$student[0]['level'])
        ->where('item', $item1)
        ->where('type', $new)
        ->get();
    
        return view('student.payadvice_first',['terms'=>$terms,'students'=>$students,
        'fees'=>$fees]);
        /*->withSesions($sesions)
        ->withStudents($students)
        ->withFees($fees); */

        }elseif($number > 0  AND $status == 0){
            $transactcodes = Transactcode::where('matric',$id)
            ->where('term_id', @$term[0]['name'])
            ->where('level',  @$student[0]['level'])
            ->where('semester', $item1)
            ->where('tistatus', $status)            
            ->get()->toArray();

            $amount =  $transactcodes[0]['amount'];
            $orderID =  $transactcodes[0]['pin'];
            $rrr =  $transactcodes[0]['rrr'];
            $semester =  $transactcodes[0]['semester'];
            $created_at = $transactcodes[0]['created_at'];
            $items = @$transactcodes[0]['semester'];
            $level = @$transactcodes[0]['level'];
            $term = @$transactcodes[0]['term_id']; 
            $sname = @$student[0]['sname'];
            $fname = @$student[0]['fname'];
            $oname = @$student[0]['oname'];
            $new_hash_string = MERCHANTID.$transactcodes[0]['rrr']. APIKEY;           
            $new_hash = hash('sha512', $new_hash_string); 
            $new_hash =  @$new_hash;
            $responseurl =  route('student.remitapay');
            $terms =  Term::where('status','Active')->get(); 
            $setups = Setup::all(); 
            
            //echo '<pre>';
            //print_r($data);
            //echo '</pre>';
            //die();
            
             
            //return view('student/makepayment', $data)->withSetups($setups)
            //->withSesions($sesions)
            //->withTransactcodes($transactcodes);

            return view('student.paystatus', ['amount'=>$amount, 'orderID'=>$orderID,
            'rrr'=>$rrr,'semester'=>$semester,'created_at'=>$created_at,'items'=>$items,
            'level'=>$level,'sname'=>$sname,'fname',$fname,'oname'=>$oname,
            'new_hash'=>$new_hash,'responseurl'=>$responseurl,'terms'=>$terms]);
            /*->withSetups($setups)
            ->withSesions($sesions)
            ->withTransactcodes($transactcodes);*/
    
            }elseif($number > 0  AND $status == 1){
                return redirect()->route('student.course')->with('message', 'First Instalments Payment was Successful. Continue to register your courses');
    
            }

    }

    public function index_second(){
        
        // Get the Payment Status of the student
        $id = Auth::user()->username;   
        $students = Student::where('matric',$id)->get();
        $student = Student::where('matric',$id)->get()->toArray();

        $term = Term::where('status','Active')->get()->toArray();
        $item2 = 'Second Instalment';

        $transactcode =  Transactcode::where('matric',$id)
        ->where('term_id', @$term[0]['name'])
        ->where('level',  @$student[0]['level'])
        ->where('semester', $item2)        
        ->get()
        ->toArray();
        $status = @$transactcode[0]['tistatus'];
        
        
        $number =  Transactcode::where('matric',$id)
        ->where('term_id', @$term[0]['name'])
        ->where('level',  @$student[0]['level'])
        ->where('semester', $item2)
        ->where('tistatus', $status) 
        ->count();        

        
        if($number == 0  AND $status==0){             
        $terms = Term::where('status','Active')->get();
        $new = 'new';
        $fees = Fee::where('programme_id', @$student[0]['programme_id'])
        ->where('term_id',@$term[0]['id'])
        ->where('level',  @$student[0]['level'])
        ->where('item', $item2)
        ->where('type', $new)
        ->get();
    
        return view('student.payadvice_second',['fees'=>$fees,'students'=>$students,'terms'=>$terms,
        ]);
        /*->withSesions($sesions)
        ->withStudents($students)
        ->withFees($fees); */

        }elseif($number > 0  AND $status == 0){
            $transactcodes = Transactcode::where('matric',$id)
            ->where('term_id', @$term[0]['name'])
             ->where('level',  @$student[0]['level'])
             ->where('semester', $item2)
            ->get()->toArray();
            $amount =  $transactcodes[0]['amount'];
            $orderID =  $transactcodes[0]['pin'];
            $rrr =  $transactcodes[0]['rrr'];
            $semester =  $transactcodes[0]['semester'];
            $created_at = $transactcodes[0]['created_at'];
            $items = @$transactcodes[0]['semester'];
            $level = @$transactcodes[0]['level'];
            $term = @$transactcodes[0]['term_id']; 
            $sname = @$student[0]['sname'];
            $fname = @$student[0]['fname'];
            $oname = @$student[0]['oname'];
            $new_hash_string = MERCHANTID.$transactcodes[0]['rrr']. APIKEY;           
            $new_hash = hash('sha512', $new_hash_string); 
            $new_hash =  @$new_hash;
            $responseurl =  route('student.remitapay');
            $terms =  Term::where('status','Active')->get(); 
            $setups = Setup::all(); 
            
            //echo '<pre>';
            //print_r($data);
            //echo '</pre>';
            //die();
            
             //updated
           // return view('student/makepayment', $data)->withSetups($setups)
            //->withSesions($sesions)
            //->withTransactcodes($transactcodes);

            return view('student.paystatus', ['amount'=>$amount, 'orderID'=>$orderID,
            'rrr'=>$rrr,'semester'=>$semester,'created_at'=>$created_at,'items'=>$items,
            'level'=>$level,'sname'=>$sname,'fname',$fname,'oname'=>$oname,
            'new_hash'=>$new_hash,'responseurl'=>$responseurl,'terms'=>$terms]);
            /*->withSetups($setups)
            ->withSesions($sesions)
            ->withTransactcodes($transactcodes); */
    
            }elseif($number > 0  AND $status == 1){
                return redirect()->route('student.course')->with('message', 'Second Instalments Payment was Successful. Continue to register your courses');
    
            }

    }


    public function paystatus(Request $request){
        $pay = 0;
        
        $id = Auth::user()->username; 
        //$data['sname'] = Auth::user()->sname;
        //$data['fname'] = Auth::user()->fname;
        //$data['oname'] = Auth::user()->oname;
        $term = Term::where('status','Active')->get()->toArray();
        
        //$applications = DB::table('application')->where('email',$id)->get();
        //$application = DB::table('application')->where('email',$id)->get()->toArray();

        $student = Student::where('matric',$id)->get()->toArray();
        
        $item1 = 'Acceptance Fees';
        $item2 = 'First Instalment';
        $item3 = 'Second Instalment';
        $item4 = 'Initial Payment';
        $item5= 'Other Payment';

        $transactcode =  Transactcode::where('matric',$id)
        ->where('term_id', $term[0]['name'])
        ->where('level',   $student[0]['level'])
        ->where('semester', $item1)
        ->orWhere('semester', $item2)
        ->orWhere('semester', $item3) 
        ->orWhere('semester', $item4) 
        ->orWhere('semester', $item5)      
        ->get()
        ->toArray();  
        
        //dd($transactcode);

        /*
        $transactcode =  Transactcode::where('matric',$id)
        ->where('sesion_id', @$sesion[0]['name'])        
        ->get()
        ->toArray();
        */

        $status = @$transactcode[0]['tistatus'];


        $number =  Transactcode::where('matric',$id)
        ->where('term_id', $term[0]['name'])  
        ->where('level',   $student[0]['level'])
        ->where('semester', $item1) 
        ->orWhere('semester', $item2)
        ->orWhere('semester', $item3) 
        ->orWhere('semester', $item4) 
        ->orWhere('semester', $item5)     
        ->count();

        //echo $number;
        //die();
        //->count();
        if($number == 0  AND $status==0){
            return redirect()->route('student.payadvice')->with('message', 'You dont have any payment code generated!');
            // redirect to homepage to 
        }elseif($number > 0  OR $status == 0){
        $transactcodes = Transactcode::where('matric',$id)
        ->where('term_id', @$term[0]['name'])  
        ->where('level',  @$student[0]['level'])
        ->where('tistatus',  $pay)
        //->where('semester', $item1) 
        //->where('semester', $item2)
        //->where('semester', $item3) 
        //->where('semester', $item4) 
        //->where('semester', $item5)
        ->get()->toArray();

       // dd(date('Y-m-d h:i:s',strtotime($transactcodes[0]['created_at'])));

        $amount =  @$transactcodes[0]['amount'];
        $orderID =  @$transactcodes[0]['pin'];
        $rrr =  @$transactcodes[0]['rrr'];
        $created_at = @$transactcodes[0]['created_at'];  
        $items = @$transactcodes[0]['semester'];
        $level = @$transactcodes[0]['level'];
        $term = @$transactcodes[0]['term_id'];   
        @$new_hash_string = MERCHANTID.$transactcodes[0]['rrr']. APIKEY;           
        $new_hash = hash('sha512', $new_hash_string); 
        $new_hash =  @$new_hash;
        $responseurl =  route('student.remita_pay');
        $terms =  Term::where('status','Active')->get(); 
        $setups = Setup::all();        
        
         
        return view('student.paystatus',['amount'=>$amount, 'orderID'=>$orderID,
        'rrr'=>$rrr,'term'=>$term,'created_at'=>$created_at,'items'=>$items,
        'level'=>$level,'new_hash'=>$new_hash,'responseurl'=>$responseurl,'terms'=>$terms]);
        /*->withSetups($setups)
        ->withSesions($sesions)
        ->withTransactcodes($transactcodes);
                       */
        }
        else{
            return redirect()->route('student.course')->with('message', 'Payment was Successful. Continue to register your courses');

        }
        
     }


      // For test by Remita, then later for Admin for transactions on remita
    public function remitapays(Request $request){
        //dd($request); 
       //$orderID = $id;
       $orderID = $request->input('orderId');
       $mert = MERCHANTID;
       $api_key = APIKEY;
       $concatString = $orderID . $api_key . $mert;
       $hash = hash('sha512', $concatString);
       $url = CHECKSTATUSURL . '/' . $mert . '/' . $orderID . '/' . $hash . '/' . 'orderstatus.reg';
       //  Initiate curl
       $ch = curl_init();
       // Disable SSL verification
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       // Will return the response, if false it print the response
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       // Set the url
       curl_setopt($ch, CURLOPT_URL, $url);
       // Execute
       $result = curl_exec($ch);
       // Closing
       curl_close($ch);
       $response = json_decode($result, true);

       //print_r($response);
       //die();

       $response_code = $response['status'];     
       $orderID = $response['orderId'];
       $rrr = $response['RRR'];
       $response_message = $response['message'];
       $data['response_message'] = $response_message;
       $transac_date = date("Y-m-d h:i:s",time());
       //Payment Successful
       if($response_code == '01' || $response_code == '00'){
           //Get the id of applpayments table to update it
           $applpayments = Applpayment::where('paymentcode',$orderID)->get()->toArray();             
           //Check if the payment what succesful before
           $transactions = Appltransaction::where('paymentcode',$orderID)->get()->toArray();
           if($transactions[0]['transac_response'] == '01' || $transactions[0]['transac_response']=='00'){                   
            $transaction=Appltransaction::find(@$transactions[0]['id']);
            $transaction->transac_date = $transac_date; 
            if ($transaction->save()){
            return redirect()->route('admin.transaction')->with('message', 'Payment Successful. Continue to fill your form!');
            }
           }else{            
           // Insert into Appltransaction
           //echo 
           $appltransactions=new Appltransaction([
           'formno'=>@$applpayments[0]['formno'],            
           'sname'=>@$applpayments[0]['sname'],
           'fname'=>@$applpayments[0]['fname'],
           'oname'=>@$applpayments[0]['oname'],
           'paymentcode'=>$orderID,
           'transac_response'=>$response_code,
           'transac_date'=>$transac_date,
           'rrr'=>$rrr,
           'transac_info'=>$response_message,
           'amount'=>@$applpayments[0]['amount'],    
           ]);
           if ($appltransactions->save()){
              
               $data['response_message'] =  $response_message;
               $email = $applpayments[0]['email'];
               $id = $applpayments[0]['id'];
               $status = 1;
                // update  the application
                DB::table('application')->where('email',$email)->update(['status' => $status]);   
                // update  the Applpayments             
               $applpayments=Applpayment::find($id);
               $applpayments->status = $status;                
               if($applpayments->save()) {
               //return view('applicants.applpayresponse', $data)->withAppltransactions($appltransactions);
               return redirect()->route('admin.transaction')->with('message', 'Payment Successful. Continue to fill your form!');
               }
           }
        }

       }
       //RRR Generated Successfully
       elseif($response_code == '021'){
           //print_r($response);
           //die();
       $response_code = $response['status'];     
       $orderID = $response['orderId'];
       $rrr = $response['RRR'];
       $response_message = $response['message'];
           $terms =  Term::where('status','Active')->get();
           $applpayments = Applpayment::where('paymentcode',$orderID)->get()->toArray();
           //echo $orderID;
           //print_r($applpayments);
           //die();
           // Insert into Appltransaction
           $appltransactions=new Appltransaction([
           'formno'=>@$applpayments[0]['formno'],            
           'sname'=>@$applpayments[0]['sname'],
           'fname'=>@$applpayments[0]['fname'],
           'oname'=>@$applpayments[0]['oname'],
           'paymentcode'=>$orderID,
           'transac_response'=>$response_code,
           'transac_date'=>$transac_date,
           'rrr'=>$rrr,
           'transac_info'=>$response_message,
           'amount'=>@$applpayments[0]['amount'],    
           ]);
           //echo 'RRR Generated Successfully';
           //die();
           if ($appltransactions->save()){ 
               // update  the application to offline, do it for online 
               //$email = $applpayments[0]['email'];
               //$status =2;
               //DB::table('application')->where('email',$email)->update(['status' => $status]);              
           
           return redirect()->route('admin.transaction')->with('message', 'Payment Pending. Please try again another time!'); 
           //return view('applicants.index', $data)->withSesions($sesions)->withAppltransactions($appltransactions);
           //return view('applicants.index', $data)->withSesions($sesions)->withApplpayments($applpayments)->withApplications($applications);   
       }
       }
       //Your Transaction was not Successful
       else{
        //print_r($response);
        //die();
        $response_code = $response['status'];     
       $orderID = $response['orderId'];
       $rrr = $response['RRR'];
       $response_message = $response['message'];
           $terms =  Term::where('status','Active')->get();
           $applpayments = Applpayment::where('paymentcode',$orderID)->get()->toArray();
          // print_r($applpayments);
           //die();
           $appltransactions=new Appltransaction([
           'formno'=>@$applpayments[0]['formno'],            
           'sname'=>@$applpayments[0]['sname'],
           'fname'=>@$applpayments[0]['fname'],
           'oname'=>@$applpayments[0]['oname'],
           'paymentcode'=>$orderID,
           'transac_response'=>$response_code,
           'transac_date'=>$transac_date,
           'rrr'=>$rrr,
           'transac_info'=>$response_message,
           'amount'=>@$applpayments[0]['amount'],    
           ]);
           if ($appltransactions->save()){  
           return redirect()->route('admin.transaction')->with('message', 'Something went wrong. Kindly try again!');
           }
       }
     
       //return $response;
      // return $response;
   }


   public function updateRecord(Request $request){
    //dd($request);
    $terms = Term::where('status', 'Active')->get();                
    $programmes  = Programme::all();
    //$feespayments = Feespayment::where();

 $matricno  = $request->input('matric');
 $year  = $request->input('sesion');
 $pin  = $request->input('pin');
  $add  = 'REMOVE';


  $counts = Feespayment::where('matric',$matricno)
  ->where('pin', $pin)
  ->where('sesion_id', $year)
  ->count();
  
  $ids = Feespayment::where('matric',$matricno)
  ->where('pin', $pin)
  ->where('sesion_id', $year)
  ->get()
  ->toArray();

  

  if($counts > 0){
  $feespayment= Feespayment::find(@$ids[0]['id']);
  $feespayment->matric = $matricno.$add; 
  $feespayment->pin = $pin.$add; 
  $feespayment->save();
  }
  //Update the Transactcode Table 

  $codes = Transactcode::where('matric',$matricno)
  ->where('pin', $pin)
  ->where('term_id', $year)
  ->get()
  ->toArray();

  $codes=Transactcode::find(@$codes[0]['id']);
  $codes->matric = $matricno.$add;
  $codes->pin = $pin.$add; 
  $codes->save(); 

  return redirect('/admin/student/payedit')->with('message', 'Record Removed Succesfully');

    //return view('admin.student.viewpayedit')->withSesions($sesions)        
    //->withProgrammes($programmes)
    //->withFeespayments($feespayments);
 }
  
    



}
