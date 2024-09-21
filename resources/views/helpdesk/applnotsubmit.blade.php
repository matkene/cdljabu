<x-helpdesk-role>
  <x-slot:heading>
      RECORDS FOR PRE-APPLICATION FORM FOR SESSION
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
                              <th scope="col" class=" px-6 py-4" colspan="9">LIST OF PROSPECTIVE APPLICANTS YET TO SUBMIT THE APPLICATION FORM</th>
                            </tr>
                            <tr>
                              <th scope="col" class=" px-6 py-4">S/N</th>
                              <th scope="col" class=" px-6 py-4">Form No</th>                              
                              <th scope="col" class=" px-6 py-4">Full Name</th>
                              <th scope="col" class=" px-6 py-4">Email</th>
                              <th scope="col" class=" px-6 py-4">Phone No</th>
                              <th scope="col" class=" px-6 py-4">Programme</th>
                              <th scope="col" class=" px-6 py-4">Mode Entry</th>
                              <th scope="col" class=" px-6 py-4">Sex</th>
                              <th scope="col" class=" px-6 py-4">State</th>                              
                              
                              
                              
                            </tr>
                          </thead>
                          <tbody>
                            <?php $total = 0;?>
                              @foreach ($applications as $key=>$appl)    
                                                                  
                              
                              
                              <tr class="border-b border-neutral-200 dark:border-white/10">
                          
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->formno}}</td>
                              
                              <td class="whitespace-nowrap  px-6 py-4 font-medium uppercase">
                                {{$appl->sname.' '.$appl->fname.' '.$appl->oname}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->email}} </td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  {{$appl->mphone}}
                              </td>
                               <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                {{$appl->programme->progdesc}}
                            </td>   
                            <td class="whitespace-nowrap  px-6 py-4 font-medium">
                              {{$appl->mode->name}}
                          </td>
                          <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->gender->name}}
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->state->name}}
                      </td>                  
                         
                            </tr>
                                                     
                            @endforeach
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              
          </div>
        
     </div>
        
</x-helpdesk-role>
