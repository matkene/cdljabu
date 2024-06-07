<x-admission-role>
    <x-slot:heading>
      Admission Console

    </x-slot:heading>    
    
    <x-flash-message/>

    <form method="POST" action="{{route('admission.matriclistdeps')}}">
        @csrf

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
                                
                                <th scope="col" colspan="2"  class="px-6 py-4">Manage Lists of Matric Students </th>
                                
                              </tr>
                            </thead>
                            <tbody>
                    
                                                                
                               <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">Session</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  <select id="payment" name="payment" 
                                  class ="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                                    <option value="0" disabled="disabled" selected>Select Session</option>  
                                    @foreach($terms as $term)
                                    <option value="{{$term->id}}">{{$term->name}}</option>
                                       
                                    @endforeach
                                  </select>
                               </td>     
                               </tr>
                            
                              
                               <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">Programme</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  <select id="payment" name="payment" 
                                  class ="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                                    <option value="0" disabled="disabled" selected>Select Programme</option>  
                                    @foreach($programmes as $programme)
                                    <option value="{{$programme->id}}">{{$programme->progdesc}}</option>
                                       
                                    @endforeach   
                                    
                                  </select>
                               </td>     
                               </tr>
                              
                            </tbody>
                          </table> 
                        </div>
                      </div>
                    </div>


                    <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
                
                          <x-form-button>View Matric Lists</x-form-button>
                        </div>

                  </div>
                
            </div>
          
       </div>
    </form>
          
</x-admission-role>
