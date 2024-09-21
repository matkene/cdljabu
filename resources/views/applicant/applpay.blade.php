<x-applicant-role>
    <x-slot:heading>
        Applicant Information
    </x-slot:heading> 
    <x-flash-message/> 
    
    <form method="POST" action="{{GATEWAYRRRPAYMENTURL}}">
        @csrf
        <input id="merchantId" name="merchantId" value="{{MERCHANTID}}" type="hidden"/>
        <input id="rrr" name="rrr" value="{{$applpayment->rrr}}" type="hidden"/>
        <input id="responseurl" name="responseurl" value="{{$responseurl}}" type="hidden"/>
        <input id="hash" name="hash" value="{{$new_hash}}" type="hidden"/>
        <input type="hidden" name="sname" value="{{$applpayment->sname}}">
        <input type="hidden" name="fname" value="{{$applpayment->fname}}">
        <input type="hidden" name="oname" value="{{$applpayment->oname}}">
        <input type="hidden" name="email" value="{{$applpayment->email}}">
        <input type="hidden" name="mphone" value="{{$applpayment->mphone}}">
                      
                      
                          
  
        <div>
          <table
          class="min-w-full text-left text-sm font-light text-surface dark:text-white">
          <thead
            class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
            <tr>
              
              <th scope="col" colspan="2"  class="px-6 py-4">PREAPPLICATION FOR APPLICATION FORM FOR {{$applpayment->term->name}}  SESSION</th>
              
            </tr>
          </thead>
          <tbody>
                            
          
  
            

            <tr class="border-b border-neutral-200 dark:border-white/10">        
                <td class="whitespace-nowrap  px-6 py-4 font-medium">Form Number</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                  {{$applpayment->formno }} 
  
                </td>       
              </tr>
  
              <tr class="border-b border-neutral-200 dark:border-white/10">        
              <td class="whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                {{$applpayment->sname.' '.$applpayment->fname.' '.$applpayment->oname }} 

              </td>       
            </tr>
  
            <tr class="border-b border-neutral-200 dark:border-white/10">
              <td class="whitespace-nowrap  px-6 py-4 font-medium">Email Address</td>
              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                {{$applpayment->email }} 

             </td>     
             </tr>
  
             <tr class="border-b border-neutral-200 dark:border-white/10">
              <td class="whitespace-nowrap  px-6 py-4 font-medium">Mobile Number</td>
              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                {{$applpayment->mphone }}
             </td>     
             </tr>
             <?php $categories = \App\Models\Category::where('id', Auth::user()->category_id)->get() ?>
             <tr class="border-b border-neutral-200 dark:border-white/10">
              <td class="whitespace-nowrap  px-6 py-4 font-medium">Category</td>
              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                {{$categories[0]->name}}
             </td>     
             </tr>
             <tr class="border-b border-neutral-200 dark:border-white/10">
              <td class="whitespace-nowrap  px-6 py-4 font-medium">Amount</td>
              <td class="whitespace-nowrap  px-6 py-4 font-medium">
               {{$applpayment->amount}}
             </td>     
             </tr>

             <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap  px-6 py-4 font-medium">Transaction ID </td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                 {{$applpayment->paymentcode}}
               </td>     
               </tr>
               
               <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap  px-6 py-4 font-medium">RRR</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                    {{$applpayment->rrr}}
               </td>     
               </tr>

             <tr class="border-b border-neutral-200 dark:border-white/10">
              <td class="whitespace-nowrap  px-6 py-4 font-medium">Remita</td>
              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                <select id="payment" name="payment" 
                class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                 
                  <option value=""> -- Select Payment Channel --</option>                 
                  <option value="Interswitch"> Verve Card</option>
                  <option value="UPL"> Visa</option>
                  <option value="UPL"> MasterCard</option>                 
                  
                </select>
             </td>     
             </tr>
          
            
            
          </tbody>
        </table> 
        </div>
  
        <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
          <a href="/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>
  
            <x-form-button>Make Payment</x-form-button>
          </div>
          
    </form>
       </x-applicant-role>
  