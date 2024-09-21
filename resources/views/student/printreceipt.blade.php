<x-student-role>
  <x-slot:heading>
      
</x-slot:heading>



       
   
                                
                            @foreach($students as $student)
                            @endforeach
                            @foreach($feespayments as $feespayment)
                            @endforeach 
                      
                                         

  <div>
    <table
    class="min-w-full text-left text-sm font-light text-surface dark:text-white">
    <thead
      class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
      <tr>
        
        <th scope="col" colspan="2"  class="px-6 py-4">STUDENT SCHOOL FEES RECEIPTS </th>
        
      </tr>
    </thead>
    <tbody>
            
      

      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Receipt Reference ID</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          CDL/{{$feespayment->sesion_id}}/{{$feespayment->id}}/24
        </td>       
      </tr>  

        <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Matric Number</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$student->matric}}
        </td>       
      </tr>

      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$student->sname.' '.$student->fname.' '.$student->oname}}
        </td>       
      </tr>

      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Level</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$student->level}}
        </td>       
      </tr>

      <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Programme</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{strtoupper($student->programme->progdesc)}}
       </td>     
       </tr>

       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Session</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$feespayment->term_id}}
       </td>     
       </tr>


       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Date  Paid</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$feespayment->updated_at}}
       </td>     
       </tr>

       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Amount Paid</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          N {{number_format($feespayment->amtpaid, 2)}}
       </td>     
       </tr>

       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Payment Item</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$feespayment->semester}}
       </td>     
       </tr>
       

       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Date Printed</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$feespayment->term_id}}
       </td>     
       </tr>
         

       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Treansaction ID</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$feespayment->pin}}
       </td>     
       </tr>
      
      
      
    </tbody>
  </table> 
  </div>

  <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
    <button type="button"  onclick="window.print()" class="text-sm font-semibold leading-6 text-gray-900">Print</button>

      
    </div>
    




</x-student-role>