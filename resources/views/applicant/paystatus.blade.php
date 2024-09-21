<x-applicant-role>
  <form method="POST" action="{{route('applicants.remitapay')}}">
    @csrf
                  
      <div>
      <table
      class="min-w-max text-left text-xs font-light text-surface dark:text-white">
      <thead
        class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
        <tr>
           
          <th scope="col" colspan="10"  class="px-6 py-4">PAYMENT STATUS: You are one step, to complete your payment for School Fees. Simply click on Get Status </th>
          
        </tr>
      </thead>
      <tbody>
              
        
          <tr class="border-b border-neutral-200 dark:border-white/10">       
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>NAME</strong></td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>TRANSACTION ID</strong></td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>RRR</strong></td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>ITEM DESCRIPTION</strong></td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>SESSION</strong></td>          
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>AMOUNT</strong></td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>DATE</strong></td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>STATUS</strong></td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>Action</strong></td>
          <input type='hidden' name='orderId' value="{{$orderID}}">
        </tr>

        <tr>
          <td class="whitespace-nowrap  px-6 py-2 font-medium">{{strtoupper(Auth::user()->sname.', '.Auth::user()->fname.' '.Auth::user()->oname)}}</td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$orderID}}</td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$rrr}}</td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$items}}</td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$term}}</td>         
          <td class="whitespace-nowrap  px-6 py-2 font-medium">{{number_format($amount,2)}}</td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium">{{date('Y-m-d h:i:s',strtotime($created_at))}}</td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium">NOT PAID</td>
          <td class="whitespace-nowrap  px-6 py-2 font-medium"><button type="submit" class="bg-laravel text-cyan rounded py-2 px-4 hover:bg-blue">Get Status</button>
          </td>
          </tr>                                
          <tr><td colspan="10" class="whitespace-nowrap  px-6 py-2 font-medium">NB: If you made payment with Card and it was not successful</td></tr>
          <tr><td colspan="10" class="whitespace-nowrap  px-6 py-2 font-medium">Please confirm, that you are not debited. If yes, simply click on Get Status button. If No, please click on the Payment Status tab to start over again. </td></tr>

        
      
        
        
      </tbody>
    </table> 
    </div>

    
      
</form>
</x-applicant-role>