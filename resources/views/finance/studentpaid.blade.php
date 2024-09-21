<x-finance-role>
  <x-slot:heading>
      RECORDS FOR SCHOOL FEES FOR SESSION
  </x-slot:heading>    
  
  <x-flash-message/>

      <div>
          <div class="px-2 sm:px-0">              
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
          </div>
          <div class="mt-6 border-t border-gray-100">
              

              <div class="flex flex-col">
                  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">                      
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                      <div class="overflow-hidden">
                        
                        <table
                          class="min-w-full text-left text-base font-light text-surface dark:text-white">
                          <thead
                            class="border-b border-neutral-200 bg-neutral-50 font-bold dark:border-white/10 dark:text-neutral-600">
                            <tr>
                              <th scope="col" class=" px-6 py-4" colspan="11">LIST OF STUDENTS PAYMENTS</th>
                            </tr>
                            <tr>
                              <th scope="col" class=" px-6 py-4">S/N</th>
                              <th scope="col" class=" px-6 py-4">Matric</th>
                              <th scope="col" class=" px-6 py-4">RRR</th>
                              <th scope="col" class=" px-6 py-4">Transaction ID</th>
                              <th scope="col" class=" px-6 py-4">Full Name</th>
                              <th scope="col" class=" px-6 py-4">Programme</th>
                              <th scope="col" class=" px-6 py-4">Level</th>
                              <th scope="col" class=" px-6 py-4">Session</th>
                              <th scope="col" class=" px-6 py-4">Item</th>
                              <th scope="col" class=" px-6 py-4">Amount</th> 
                              <th scope="col" class=" px-6 py-4">Transaction Date</th>
                              
                              
                            </tr>
                          </thead>
                          <tbody>
                            <?php $total = 0;?>
                              @foreach ($feespayments as $key=>$appl)    
                                     <?php $total = $total + $appl->amtpaid ?>                               
                              
                              
                              <tr class="border-b border-neutral-200 dark:border-white/10">
                          
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->matric}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->trrr}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->pin}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium uppercase">
                                {{$appl->stsname.' '.$appl->stfname.' '.$appl->stoname}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->prog}} </td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->level}} </td>

                              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  {{$appl->term_id}}
                              </td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                {{$appl->semester}}
                            </td> 
                               <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                {{number_format($appl->amtpaid,2)}}
                            </td>   
                            <td class="whitespace-nowrap  px-6 py-4 font-medium">
                              {{$appl->created_at}}
                          </td>                  
                         
                            </tr>
                                                     
                            @endforeach
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                              <td class="whitespace-nowrap  px-6 py-4 font-medium text-base" colspan="11">Total: {{number_format($total,2)}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              
          </div>
        
     </div>
        
</x-finance-role>
