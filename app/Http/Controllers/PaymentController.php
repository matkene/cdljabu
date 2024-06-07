<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Setup;
use Illuminate\Support\Facades\DB;
use App\Models\Applpayment;
use App\Models\Appltransaction;
use App\Models\Term;
use App\Models\Fee;
use App\Models\Transactcode;
use App\Models\Transactionlog;
use App\Models\Feespayment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;



class PaymentController extends Controller
{   
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

         
      //Connect to Remita to receive payment details for application of form
        public function remitapay(Request $request){
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
          // die();
   
                   
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
        
        $beneficiaryAccount="0242416701";
    
        $beneficiaryAmount = $totalAmount;
    
        $bankCode="058"; // GTB
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
            $data['new_hash'] = $new_hash;
            $data['orderID'] = $orderID;
            $data['rrr'] =  $rrr;
            $data['amount'] = $amount;
            $data['paymode'] = $paymode;
            $data['responseurl'] = $responseurl;
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
           $data['status'] = 0;
           $data['submitted'] = 0;
           $data['paymode'] = $paymode;
           $data['items'] = $items;
        $feespayments = Feespayment::where('matric',$matric)->where('relvant', $pay)->get();
        return view('student.applpay', $data);
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
     'session'=>'required',    
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
     //print_r($sesions);
     //echo '<br/>';
     //die();
 
 
 
     //Get Type of Student Old or New
 
     if($level == 100){ $type = 'new' ;}  // To get the type of student either new or old
     elseif($level == 200 && $applno == $matric ){$type = 'new';}
     elseif($level == 200 && $applno != $matric ){$type = 'old';}
     elseif($level == 300){$type = 'old';}
     elseif($level == 400){$type = 'old';}
     elseif($level == 500){$type = 'old';}
 
     $fees = Fee::where('sesion_id', $request->input('session'))
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
     $beneficiaryName="JABU CDL"; // CDL JABU ACCOUNT DETAIlL    
     
     $beneficiaryAccount="0242416701";
 
     $beneficiaryAmount = $totalAmount;
 
     $bankCode="058"; // GTB
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
         $data['new_hash'] = $new_hash;
         $data['orderID'] = $orderID;
         $data['rrr'] =  $rrr;
         $data['amount'] = $amount;
         $data['paymode'] = $paymode;
         $data['responseurl'] = $responseurl;
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
             'mphone'=>$request->input('mphone'),
             'term_id'=>@$terms[0]['name'],
             'pin'=>$orderID,
             'rrr'=> $rrr,
             'status'=>$pay,
             'amount'=>$amount,                      
             ]);
 
             $transactcodes->save();
 
     
    if ($feespayments->save()){        
        $data['status'] = 0;
        $data['submitted'] = 0;
        $data['paymode'] = $paymode;
        $data['items'] = $items;
     $feespayments = Feespayment::where('matric',$matric)->where('relvant', $pay)->get();
     return view('student.applpay', $data);
     /*
     ->withFeespayments($feespayments);
     */
    }      
 
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
            //dd($request); 
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
                  
                   $data['response_message'] =  $response_message;
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
                   return redirect()->route('student.course')->with('status', 'Payment Successful. Continue to Register your course');
                   }
               }
           }else{
               return redirect()->route('student.course')->with('status', 'Payment Successful. Continue to Register your course');
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
                                
               
               return redirect()->route('student.index')->with('status', 'Payment Pending. Kindly try again!'); 
               
           }
           }
           //Your Transaction was not Successful
           else{
               
               return redirect()->route('student.index')->with('status', 'Something went wrong. Kindly try again!');
               //}
           }
         
        
       }
        // For student to print receipt
       public function receipt(){
        $id = Auth::user()->username;
        $status = 1; // Payment Successful
        $students = Student::where('matric',$id)->get();        
        $feespayments = Feespayment::where('matric',$id)->where('relvant', $status)->get();
        //echo '<pre/>';
        //print_r($feespayments);
        //echo '</pre>';
        //die();
        return view('student.receipt');
        /*
        ->withStudents($students)->withFeespayments($feespayments);
        */

    }

    public function applpaid(){
        // Display all users that had paid for the form for admin/finance ..rewrite it
       /*
        $status =1;       
        $applpayments = DB::table('applpayments')
        ->leftjoin('application', 'applpayments.formno' ,'=', 'application.formno')
        ->select('applpayments.*','application.referrer as referrers')
        ->where('applpayments.status',$status)
        ->get();
       
        $setups = Setup::all();
        $sesions = Term::all();
        return view('admin.applicant.applpaid')
        ->withSetups($setups)
        ->withSesions($sesions)
        ->withApplpayments($applpayments); 
        */
    }
    
    
    public function applnotpaid(){
        // Display all users that had not paid for the form for admin
     /*
        $status =0;
        $applpayments = DB::table('applpayments')
        ->leftjoin('application', 'applpayments.formno' ,'=', 'application.formno')
        ->select('applpayments.*','application.referrer as referrers')
        ->where('applpayments.status',$status)
        ->get();
        //$applpayments = Applpayment::where('status',$status)->get();
        //$appltransactions =  Appltransaction::all();
        $setups = Setup::all();
        $sesions = Sesion::all();
        return view('admin.applicant.applnotpaid')
        ->withSetups($setups)
        ->withSesions($sesions)
        ->withApplpayments($applpayments); 
       */ 
    }
    
     public function transaction(){
         // Display all transactions including both successful and not suuccesful for admin
       /*
        $appltransactions =  Appltransaction::all();
        $setups = Setup::all();
        $sesions = Sesion::all();
        return view('admin.applicant.transaction')
        ->withSetups($setups)
        ->withSesions($sesions)
        ->withAppltransactions($appltransactions); 
        */
    }

      
      public function getApplicantsPayment(){
        // Display all Successful Payments for Application for admin
       /*
        $appltransactions =  Appltransaction::where('transact_info','=','Approved');
        $setups = Setup::all();
        $sesions = Sesion::all();
        return view('admin.applicant.payment')
        ->withSetups($setups)
        ->withSesions($sesions)
        ->withAppltransactions($appltransactions); 
        */
    }



}
