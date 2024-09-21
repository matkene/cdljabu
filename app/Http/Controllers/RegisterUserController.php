<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Applpayment;
use App\Models\Appltransaction;
use Illuminate\Support\Facades\DB;
use App\Models\Term;
use Illuminate\Support\Str;


class RegisterUserController extends Controller
{
    //
    public function create()
    {
        
        //return view('register');
        // Create formno
        $orderpw=mt_rand(1000000, 999999999);
        $inputs=array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
        $rand_keys1 = array_rand($inputs, 3);
        $formno= $inputs[$rand_keys1[1]].$orderpw.$inputs[$rand_keys1[2]].$inputs[$rand_keys1[0]];
        
        $categories = Category::all();
        $terms =Term::where('status','Active')->get();
        
        return view('authorize.register', ['categories' => $categories, 'terms'=>$terms, 'formno'=>$formno]);
    }
    
    public function store(Request $request)
    {
       
       //Create Users Information.....
        //dd(request()->all());
        //validate   $attributes=  request()->validate([
        request()->validate([
             'first_name' => ['required','string'],
             'last_name' => ['required','string'],
             'email' => ['required','email'],
             'password' => ['required', Password::min(5),'confirmed']  //it will check for the password_confirmation
        ]);

       //create yhe user 'password' => ['required', Password::min(5)->letters(5)]
       //$user = User::create($attributes); U can used this too
       $user = User::create(
        [
           'name' => $request->first_name. ' '. $request->last_name,
           'email'=> $request->email,
           'password'=> $request->password
        ]);
        //login
        Auth::login($user);
        
        
        return redirect('/first');
    }
   
    public function storeUser(Request $request, User $user){

        //dd($request);
            
        /*
        create users account for new applicant 
        redirect the applicant after creating an account to a page   (22th April 2024)
        showing information then to select type(degree, master,diploma) so as to get correct amount
         next page will be to confirm the information then make payment.
         If payment was not made, there should be option to generate another or delete the former 
         */
        
         $request->validate([
            'fname' => 'required',
            'sname' => 'required',
            'oname' => 'required',            
            'email' => ['required','email'],
            'mphone' => 'required',  //check for option for num may  ['required', 'min:6']           
            'password' => ['required', 'min:6']//it will check for the password_confirmation
       ]);
    

      //ddd('done');
      // Create formno
      
      
      // Assume the role id for applicant is 7 and 2 for student
      $roleid = 7;
      //$address = 'CDL JABU';
      $terms =  Term::where('status','Active')->get();
       // update the user migration later
       
      User::create(
       [
          'fname' => $request->fname,
          'sname' => $request->sname,
          'oname' => $request->oname,
          'email'=>  $request->email,
          'address' => $request->address,
          'mphone' => $request->mphone,
          'password'=> $request->password,
          'remember_token'=>Str::random(60),
          'username' =>$request->email,
          'role_id' => $roleid,
          'category_id' => $request->category_id,
          'active' => 1
       ]);
       
       //dd('done');
     
       //SEND AN EMAIL FOR THE CREATON OF USER ACCOUNT
    //Insert into a data called application
   // check for the term id 
    $application= [
        'formno'=>$request->formno,
        'sname'=>$request->sname,
        'fname'=>$request->fname,
        'oname'=>$request->oname,
        'referrer'=>$request->referrer,
        'status'=>0, 
        'term_id' => $terms[0]->id,               
        'email'=>$request->email                
    ];
    
    if(!empty($application)){
        $insertData = DB::table('application')->insert($application);
    }
        
     
       return redirect('/authorize/login')->with('message','Account Created Successful. Login to continue payment of application form');

    }
     public function remita_transaction(Request $request, Applpayment $applpayment)
     {
        //Check the responseurl and the paramter to remita to get the actual value.


        //Create the pre-application information..eg Generating Reference Code
        //Validate .....Applpayment , the status value 0 from the page
        // This user is logged in, so check for the auth 
         $request->validate([            
            'sname' => ['required','string'],
            'fname' => ['required','string'],
            'oname' => ['required','string'],
            'email' => ['required','email'],
            'mphone' => ['required','string'],           
            
       ]);
       $application   = DB::table('application')
       ->where('email', $request->input('email'))->get();

       
        
       $terms =  Term::where('status','Active')->get();
       // Connect to Remita to generate RRR 
       $sname = $request->input('sname');
       $fname = $request->input('fname');
       $oname = $request->input('oname');        
       $payerName = $sname.' '.$fname.' '.$oname;
       $payerEmail = $request->input('email');
       $payerPhone = $request->input('mphone');
       $totalAmount = $request->input('amount');    
       $paymode = $request->input('payment'); // check this out

        // Records created for referenceID
        $orderpw=mt_rand(1000000000, 999999999999);
        $inputs=array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
        $rand_keys1 = array_rand($inputs, 4);
        $orderid=$inputs[$rand_keys1[0]].$orderpw.$inputs[$rand_keys1[1]].$inputs[$rand_keys1[2]];
        $orderID =  $orderid;

        //Stop here
        //dd($orderID, $application[0]['formno']);
        //dd($orderID,$application[0]->email);

        $timesammp=DATE("dmyHis"); 

        //dd($timesammp);
        
        $responseurl = route('applicants.remitapay');   
        //$responseurl = 'http://jabucdlportal.org/applicants/remitapay';
        //dd(var_dump($responseurl));

        // constant in the constant.php file
        $hash_string = MERCHANTID . SERVICETYPEID . $orderID . $totalAmount . $responseurl . APIKEY;
        $hash = hash('sha512', $hash_string);

        
        //Get a place to insert all this information
        $itemtimestamp = $timesammp;
        $itemid1= ITEMID;
        //$itemid2="654321";

        $beneficiaryName=BENEFICIALNAME; // CDL JABU ACCOUNT DETAILS
        //$beneficiaryName2="Ogunseye Mujib"; //

        $beneficiaryAccount=BENEFICIALACCOUNT;
        //$beneficiaryAccount2="0360883515";

        $bankCode=BANKCODE; // GTB
        //$bankCode2="050";// confirmt bank code of UBA

        $beneficiaryAmount = $totalAmount;
        //$beneficiaryAmount2 =200;

        $deductFeeFrom=1;
        //$deductFeeFrom2=0;

        //Enable the The JSON data.
        
        $content = '{"merchantId":"'. MERCHANTID.'"'.',
            "serviceTypeId":"'.SERVICETYPEID.'"'.",
            ".'"totalAmount":"'.$totalAmount.'",
            "hash":"'. $hash.'"'.',
            "orderId":"'.$orderID.'"'.",
            ".'"responseurl":"'.$responseurl.'",
            "payerName":"'. $payerName.'"'.',
            "payerEmail":"'.$payerEmail.'"'.",
            ".'"payerPhone":"'.$payerPhone.'","lineItems":[
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
            //dd($json_response);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $jsonData = substr($json_response, 6, -1);
            $response = json_decode($jsonData, true);
            //var_dump($response);
            //die();
            $statuscode = $response['statuscode'];
            $statusMsg = $response['status'];


       
       //then insert all the records into applypayment tables
       if($statuscode == '025'){
        $rrr = trim($response['RRR']);             
        $new_hash_string = MERCHANTID . $rrr . APIKEY;           
        $new_hash = hash('sha512', $new_hash_string);            
        $data['new_hash'] = $new_hash;
        $data['orderID'] = $orderID;
        $data['rrr'] =  $rrr;
        $data['amount'] = $totalAmount;
        $data['paymode'] = $paymode;
        $data['responseurl'] = $responseurl;
        $pay = 0;  // Not paid yet

        //save records
        $applpayment = Applpayment::create(
        [
           'fname' => $request->fname,
           'sname' => $request->sname,
           'oname' => $request->oname,
           'email'=> $request->email,
           'paymentcode' => $orderID,
           'mphone' => $request->mphone,
           'rrr'=> $rrr,
           'amount'=> $totalAmount,
           'formno' => $application[0]->formno,
           'term_id' => $terms[0]->id,
           'status' => $pay,
        ]);

      //dd("Done");  

      //dd($applpayment);
      
     // redirect to paymentpage
     return view('/applicant/applpay', ['applpayment' => $applpayment, 'responseurl' =>$responseurl, 'new_hash'=>$new_hash]);
    }
}

    public function login()
    {
        
       // return view('login'); Use this for examples in Laravel
        return view('authorize.login');
    }
}
