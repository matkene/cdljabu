<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{@$terms[0]->name}} SESSION 
    </x-slot:heading> 
    <x-flash-message/> 
           
            
            @foreach($applications as $appl)
            @endforeach
            <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                
            <div class="sm:col-span-6 mt-2">                 
                <table
                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <tr class="border-b border-neutral-200 dark:border-white/10">
                     
                    <td class="whitespace-nowrap  px-6 py-4 font-medium" colspan="2">
                    <img src="{{asset('passport/'.$appl->passport)}}" alt="{{$appl->passport}}" height="100" width="100">
                    </td>                      
        
                  </tr>


                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4"> PERSONAL INFORMATION</th>
                  </tr>
                 </thead>
                <tbody> 
                    <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Form No
                        </td> 
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->formno}}
                        </td>                      
            
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Title
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->title->name}}
                        </td>    
                      </tr>
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Surname
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->sname}}
                        </td>    
                      </tr>
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           First Name
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->fname}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Other Name
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->oname}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Gender
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->gender->name}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Marital Status
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->marital->name}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Maiden
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->maiden}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Date of birth
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->dob}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           State of Origin
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->state->name}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Local Government Area
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->lga->name}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Country
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->country->name}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Blood Group
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->bloodgroup->name}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Religion
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->religion->name}}
                        </td>    
                      </tr>

                      <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4"> CONTACT INFORMATION</th>
                  </tr>
                 </thead>
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Address
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->address}}
                        </td>    
                      </tr>
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Email
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->email}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Phone
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->mphone}}
                        </td>    
                      </tr>

                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4"> PROPOSED PROGRAMME OF STUDY</th>
                  </tr>
                 </thead>
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Mode of Entry
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->mode->name}}
                        </td>    
                      </tr>
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Programme
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->programme->progdesc}}
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Department
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$appl->programme->department}}
                        </td>    
                      </tr>

                      <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>
                    <th scope="col" colspan="1"  class="px-6 py-4">S/N</th> 
                    <th scope="col" colspan="1"  class="px-6 py-4">EXAM CENTER</th>  
                    <th scope="col" colspan="1"  class="px-6 py-4">EXAM NUMBER</th>                 
                    <th scope="col" colspan="1"  class="px-6 py-4">EXAM</th>
                    <th scope="col" colspan="1"  class="px-6 py-4">YEAR</th>
                    
                    
                  </tr>
                 </thead>
                 @foreach($examboards as $key=>$examboard )  
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$key + 1 }}
                          </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$examboard->center }}
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$examboard->examno }}
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$examboard->exam->name }}
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$examboard->year}}
                        </td>    
                      </tr>
                @endforeach   
                
                
                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>
                    <th scope="col" colspan="1"  class="px-6 py-4">S/N</th> 
                    <th scope="col" colspan="1"  class="px-6 py-4">SUBJECT</th>  
                    <th scope="col" colspan="1"  class="px-6 py-4">GRADE</th>                 
                   
                    
                    
                  </tr>
                 </thead>
                 @foreach($examresults as $key=>$examresult )  
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$key + 1 }}
                          </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$examresult->subject->name }}
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$examresult->grader->name }}
                        </td>
                            
                      </tr>
                @endforeach   


                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>
                    <th scope="col" colspan="1"  class="px-6 py-4">S/N</th> 
                    <th scope="col" colspan="1"  class="px-6 py-4">NAME</th>  
                    <th scope="col" colspan="1"  class="px-6 py-4">POSTION</th>
                    <th scope="col" colspan="1"  class="px-6 py-4">PERIOD</th>                 
                   
                    
                    
                  </tr>
                 </thead>
                 @foreach($employments as $appl)
                 @endforeach
                 <?php 
                  $data = @unserialize($appl['name']);
                  $data1 = @unserialize($appl['datefrom']);
                  $data2 = @unserialize($appl['dateto']);
                  $data3 = @unserialize($appl['position']);                                    
                  ?> 
                  @if($data != '')
                 @foreach($data as $k=>$name)    
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$k + 1 }}
                          </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$name }}
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$data3[$k]}}
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            {{$data1[$k]}}
                        </td>
                            
                      </tr>
                @endforeach
                @endif   

                <thead
                class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                <tr>
                  <th scope="col" colspan="1"  class="px-6 py-4">S/N</th> 
                  <th scope="col" colspan="1"  class="px-6 py-4">NAME</th>  
                  <th scope="col" colspan="1"  class="px-6 py-4">GRADE</th>                 
                 
                  
                  
                </tr>
               </thead>
                              @foreach($certificates as $appl)
                                 @endforeach
                                 <?php 
                                  $data = @unserialize($appl->name);
                                  $data1 = @unserialize($appl->certificate);
                                  $data2 = @unserialize($appl->grade);
                                                                      
                                  ?> 
                                  @if($data != '')
                                 @foreach($data as $k=>$name)   
                  <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$k + 1 }}
                        </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{$name }}
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$data2[$k]}}
                      </td>
                          
                    </tr>
              @endforeach
              @endif   
               
              <thead
                class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                <tr>
                  <th scope="col" colspan="1"  class="px-6 py-4">S/N</th> 
                  <th scope="col" colspan="1"  class="px-6 py-4">Sponsor Full Name</th>  
                  <th scope="col" colspan="1"  class="px-6 py-4">Relationship</th>
                  <th scope="col" colspan="1"  class="px-6 py-4">Address</th>
                  <th scope="col" colspan="1"  class="px-6 py-4">Email</th>
                  <th scope="col" colspan="1"  class="px-6 py-4">Phone</th>                 
                 
                  
                  
                </tr>
               </thead>
               @foreach($sponsors as $appl)
               @endforeach
               
               <?php 
               $data = @unserialize($appl->name);
               $data1 = @unserialize($appl->relationship_id);
               $data2 = @unserialize($appl->address);
               $data3 = @unserialize($appl->email);
               $data4 = @unserialize($appl->mphone);
               
                ?>
                @if($data != '')
                @foreach($data as $k=>$name)   
                  <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$k + 1 }}
                        </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{$name }}
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$data1[$k]}}
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{$data2[$k]}}
                    </td>
                    <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{$data3[$k]}}
                    </td>
                    <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{$data4[$k]}}
                    </td>
                          
                    </tr>
              @endforeach
              @endif   

                </tbody>
                </table>
            </div>

            
                      
        
        </div>

        <div class="flex items-center justify-center mt-8 mb-4">
          <button class="ms-4 text-base font-semibold leading-6 text-cyan-900" onClick="window.print()">Click to  Print</button>

            
        </div>
        
    
</x-applicant-role>