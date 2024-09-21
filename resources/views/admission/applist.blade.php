<x-admission-role>
    <x-slot:heading>
        LISTS OF APPLICATION FOR SESSION
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
                            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                              class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                              <tr>
                                
                                <th scope="col" colspan="8"  class="px-6 py-4 text-lg uppercase"> LISTS OF APPLICATION RECORDS  </th>
                                
                              </tr>
                              <tr>
                                <th scope="col" class=" px-6 py-4">S/N</th>
                                <th scope="col" class=" px-6 py-4">Admission No</th>
                                <th scope="col" class=" px-6 py-4">Surname</th>
                                <th scope="col" class=" px-6 py-4">First</th>
                                <th scope="col" class=" px-6 py-4">Other</th>
                                <th scope="col" class=" px-6 py-4">Gender</th>
                                <th scope="col" class=" px-6 py-4">State</th>
                                <th scope="col" class=" px-6 py-4">Programme</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $key=>$appl)                                   
                                
                                
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                            
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->formno}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium uppercase">{{$appl->sname}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium uppercase">
                                  {{$appl->fname}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium uppercase">{{$appl->oname}} </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    {{$appl->gender->name}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  {{$appl->state->name}}
                              </td>  
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                {{$appl->programme->progdesc}}
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
          
</x-admission-role>
