<x-student-role>
  <form method="POST" action="{{GATEWAYRRRPAYMENTURL}}">
    @csrf
                  
    <input id="merchantId" name="merchantId" value="{{MERCHANTID}}" type="hidden">
   
    <input id="responseurl" name="responseurl" value="{{$responseurl}}" type="hidden">
    <input id="hash" name="hash" value="{{@$new_hash}}" type="hidden">
    <input type="hidden" name="sname" value="{{Auth::user()->sname}}">
    <input type="hidden" name="fname" value="{{Auth::user()->fname}}">
    <input type="hidden" name="oname" value="{{Auth::user()->oname}}">
    <input type="hidden" name="email" value="{{Auth::user()->email}}">
    <input type="hidden" name="mphone" value="{{Auth::user()->mphone}}">
    <input type="text"   name="rrr"    value="{{$rrr}}">
                  
                  
                      

    <div>
      <table
      class="min-w-full text-left text-sm font-light text-surface dark:text-white">
      <thead
        class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
        <tr>
          
          <th scope="col" colspan="2"  class="px-6 py-4">PAYMENT OF SCHOOL FEES FOR SESSION - DESCRIPTION OF ITEM : {{strtoupper($items)}} </th>
          
        </tr>
      </thead>
      <tbody>
              
         <tr class="border-b border-neutral-200 dark:border-white/10">        
          <td class="whitespace-nowrap  px-6 py-4 font-medium">Surname</td>
          <td class="whitespace-nowrap  px-6 py-4 font-medium">
            {{Auth::user()->sname}} 
          </td>       
        </tr>

        

        <tr class="border-b border-neutral-200 dark:border-white/10">        
          <td class="whitespace-nowrap  px-6 py-4 font-medium">First Name</td>
          <td class="whitespace-nowrap  px-6 py-4 font-medium">
            {{Auth::user()->fname}} 
          </td>       
        </tr>

        <tr class="border-b border-neutral-200 dark:border-white/10">        
          <td class="whitespace-nowrap  px-6 py-4 font-medium">Other Name</td>
          <td class="whitespace-nowrap  px-6 py-4 font-medium">
            {{Auth::user()->oname}} 
          </td>       
        </tr>


        <tr class="border-b border-neutral-200 dark:border-white/10">
          <td class="whitespace-nowrap  px-6 py-4 font-medium">Email Address</td>
          <td class="whitespace-nowrap  px-6 py-4 font-medium">
            {{Auth::user()->email}}
         </td>     
         </tr>

         <tr class="border-b border-neutral-200 dark:border-white/10">
          <td class="whitespace-nowrap  px-6 py-4 font-medium">Mobile Number</td>
          <td class="whitespace-nowrap  px-6 py-4 font-medium">
            {{Auth::user()->mphone}}
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
            ₦ {{number_format($amount,2)}}
         </td>     
         </tr>


         <tr class="border-b border-neutral-200 dark:border-white/10">
          <td class="whitespace-nowrap  px-6 py-4 font-medium">RRR</td>
          <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{@$rrr}}
         </td>     
         </tr>



         <tr class="border-b border-neutral-200 dark:border-white/10">
          <td class="whitespace-nowrap  px-6 py-4 font-medium">Transaction ID</td>
          <td class="whitespace-nowrap  px-6 py-4 font-medium">
             {{$orderID}}
         </td>     
         </tr>
         
           
         <tr class="border-b border-neutral-200 dark:border-white/10">
          <td class="whitespace-nowrap  px-6 py-4 font-medium">Remita Payment Method</td>
          <td class="whitespace-nowrap  px-6 py-4 font-medium">
            <select id="typemethods" name="paymenttype" 
            required
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
              <option value="" disabled="disabled" selected>Select Any Option</option>  
              
                <option value="REMITA_PAY"> Remita Account Transfer</option>
                <option value="Interswitch"> Verve Card</option>
                <option value="UPL"> Visa</option>
                <option value="UPL"> MasterCard</option>
                <option value="PocketMoni"> PocketMoni</option>
                <option value="RRRGEN"> POS</option>
                <option value="ATM"> ATM</option>
                <option value="BANK_BRANCH">BANK BRANCH</option>
                <option value="BANK_INTERNET">BANK INTERNET</option>
            </select> 
              
            </select>
         </td>     
         </tr>
      
        
        
      </tbody>
    </table> 
    </div>

    <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">

        <x-form-button> Click to Pay Online With Card </x-form-button>
      </div>
      
</form>
</x-student-role>