<x-admission-role>
    <x-slot:heading>
      
    PRINT ADMISSION LETTER CONSOLE


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
                                <th scope="col" class=" px-6 py-4">S/N</th>
                                <th scope="col" class=" px-6 py-4">Matric</th>
                                <th scope="col" class=" px-6 py-4">Name</th>
                                <th scope="col" class=" px-6 py-4">Phone</th>                                
                                <th scope="col" class=" px-6 py-4">Level</th>
                                <th scope="col" class=" px-6 py-4">Status</th>                                
                                <th scope="col" class=" px-6 py-4">Action</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentcourses as $key=>$appl)                                   
                                
                                
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                            
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->formno}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->sname. ' '.$appl->fname.' '.$appl->oname}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->mphone}}</td>

                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  {{$appl->state->name}}</td>                                                      
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                {{$appl->programme->progdesc}}
                            </td> 
                            <td class="whitespace-nowrap  px-6 py-4 font-medium">
                              {{@$appl->year}}
                          </td> 
                          <td class="whitespace-nowrap  px-6 py-4 font-medium">
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
