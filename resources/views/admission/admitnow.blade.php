<x-admission-role>
    <x-slot:heading>
     Registration
    </x-slot:heading>    
    
    <x-flash-message/>

    <form method="POST" action="{{route('admission.admitcanditate')}}">
       @csrf

        <div>
            <div class="px-2 sm:px-0">              
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
            </div>
            <div class="mt-6 border-t border-gray-100">
                @foreach($applications as $appl)
                @endforeach
                        <input type="hidden" value="{{$appl->formno}}" name="admissionNumber">
                        <input type="hidden" value="{{$appl->sname}}" name="sname">
                        <input type="hidden" value="{{$appl->fname}}" name="fname">
                        <input type="hidden" value="{{$appl->oname}}" name="oname">
                        <input type="hidden" value="{{$appl->email}}" name="email">
                         <input type="hidden" value="{{$appl->title_id}}" name="title_id">
                          <input type="hidden" value="{{$appl->state_id}}" name="state_id">
                          <input type="hidden" value="{{$appl->state->name}}" name="state">
                           <input type="hidden" value="{{$appl->lga_id}}" name="lga_id">
                           <input type="hidden" value="{{$appl->lga->name}}" name="lga">
                           {{-- <input type="hidden" value="{{$appl->level}}" name="level"> --}}
                           <input type="hidden" value="{{$appl->country_id}}" name="country_id">
                          
                           <input type="hidden" value="{{$appl->religion_id}}" name="religion_id">                        
                           
                           
                           <input type="hidden" value="{{$appl->marital_id}}" name="marital_id">
                           <input type="hidden" value="{{$appl->mphone}}" name="mphone">
                           <input type="hidden" value="{{$appl->dob}}" name="dob">
                           <input type="hidden" value="{{$appl->address}}" name="address">
                           <input type="hidden" value="{{$appl->gender_id}}" name="gender_id">
                           <input type="hidden" value="{{$appl->mode_id}}" name="mode_id">
                           
                           <input type="hidden" value="{{$appl->bloodgroup_id}}" name="bloodgroup_id">
                           
                           <input type="hidden" value="{{$appl->programme_id}}" name="programme_id">
                           <input type="hidden" value="{{$appl->passport}}" name="passport">
           
                
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">                      
                      <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table
                            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                              class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                              <tr>
                                
                                <th scope="col" colspan="2"  class="px-6 py-4">Admission Console </th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                    
                                <tr class="border-b border-neutral-200 dark:border-white/10">        
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">Admission No</td>
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                      {{$appl->formno}}
                                    </td>       
                                  </tr>
                                  
                                  <tr class="border-b border-neutral-200 dark:border-white/10">        
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">Candidate Name</td>
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                        {{$appl->sname.' '.$appl->fname.' '.$appl->oname}}
                                    </td>       
                                  </tr>   
                        
                                  <tr class="border-b border-neutral-200 dark:border-white/10">        
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">Phone No</td>
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                      {{$appl->mphone}}
                                    </td>       
                                  </tr>

                                  <tr class="border-b border-neutral-200 dark:border-white/10">        
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">State of Origin</td>
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                      {{$appl->state->name}}
                                    </td>       
                                  </tr>
                               
                                  <tr class="border-b border-neutral-200 dark:border-white/10">        
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">LGA</td>
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                      {{$appl->lga->name}}
                                    </td>       
                                  </tr>
                                                                
                               <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">Programme Offered</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  <select id="programme_id" 
                                  name="programme_id" 
                                  required
                                  class ="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                                    <option value="" disabled="disabled" selected>Select Programme</option>  
                                    @foreach ($programmes as $programme)   
                                    <option value="{{$programme->id}}">{{$programme->department}}</option>   
                                    @endforeach
                                   
                                  </select>
                               </td>     
                               </tr>


                               <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">Award</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  <select 
                                  id="award_id" 
                                  name="award_id" 
                                  required
                                  class ="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                                    <option value="" disabled="disabled" selected>Select Award</option>  
                                    @foreach ($awards as $award)   
                                    <option value="{{$award->id}}">{{$award->name}}  {{$award->year}}</option>   
                                    @endforeach
                                
                                  </select>
                               </td>     
                               </tr>

                               <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">Level</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  <select id="level" name="level" 
                                  required
                                  class ="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                                    <option value="" disabled="disabled" selected>Select Level</option>  
                                     
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option> 
                                    <option value="400">400</option>
                                    <option value="500">500</option>  
                                    <option value="600">600</option>
                                     
                                  </select>
                               </td>     
                               </tr>
                            
                              
                              
                              
                            </tbody>
                          </table> 
                        </div>
                      </div>
                    </div>


                    <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
                      <a href="/admission/admit/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

                        <x-form-button>Click to Admit</x-form-button>
                      </div>

                </div>
                  </div>
                
                
            </div>
            
          
       </div>
       
    </form>   
</x-admission-role>
