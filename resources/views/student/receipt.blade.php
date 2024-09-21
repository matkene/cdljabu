<x-student-role>
          
      <div>
      <table
      class="min-w-max text-left text-xs font-light text-surface dark:text-white">
      <thead
        class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
        <tr class="border-b border-neutral-200 dark:border-white/10">
           
          <th scope="col" colspan="6"  class="px-6 py-4 text-base">PAYMENT STATUS: You are one step, to complete your payment for School Fees. Simply click on Get Status </th>
          
        </tr>
      </thead>
      <tbody>
              
        
          <tr class="border-b border-neutral-200 dark:border-white/10"> 
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium"><strong>FORMNO</strong></td>          
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium"><strong>MATRIC</strong></td>      
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium"><strong>PROGRAMME</strong></td>          
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium"><strong>SESSION</strong></td>
          <td class="border border-black-300whitespace-nowrap  px-6 py-4 font-medium"><strong>LEVEL</strong></td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium"><strong>ITEM</strong></td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium"><strong>AMOUNT</strong></td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium"><strong>DATE</strong></td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium"><strong>STATUS</strong></td>          
          
        </tr>
        @foreach($feespayments as $feespayment)
        <tr  class="border-b border-neutral-200 dark:border-white/10">
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$feespayment->applno}}</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$feespayment->matric}}</td>
          
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$feespayment->programme->progdesc}}</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$feespayment->term_id}}</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$feespayment->level}}</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$feespayment->semester}}</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{number_format($feespayment->amtpaid,2)}}</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{date('Y-m-d h:i:s',strtotime($feespayment->updated_at))}}</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
            <form class="form" action="{{url('/student/printreceipt')}}" method="post">
              @csrf
              <input type="hidden"  name="matric" value="{{$feespayment->matric}}" >
              <input type="hidden"  name="id" value="{{$feespayment->id}}" >
            
            <button type="submit" class="bg-laravel text-cyan rounded py-2 px-4 hover:bg-blue">View Receipt</button>
            </form>
          </td>
          </tr>    
          @endforeach                            
          <tr class="border-b border-neutral-200 dark:border-white/10">
            <td colspan="6" class="border border-black-300 whitespace-nowrap  px-6 py-2 font-medium"> </td></tr>
       
        
      </tbody>
    </table> 
    </div>

</x-student-role>