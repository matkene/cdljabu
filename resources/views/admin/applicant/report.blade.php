<x-admin-role>
    <x-slot:heading>
        RECORDS ON REPORTS FOR APPLICATIONS
    </x-slot:heading>    
    
    <x-flash-message/>
    <form method="POST" action="{{route('admin.applreport')}}">
    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="formno" class="block text-sm font-medium leading-6 text-gray-900">Mode of Entry</label>
          <div class="mt-2">         
            <select id="mode_id" name="mode_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Mode</option>
                  @foreach ($modes as $mode)   
                  <option value="{{$mode->id}}">{{$mode->name}}</option>   
                  @endforeach
                                  
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="gender_id" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
          <div class="mt-2">         
            <select id="gender_id" name="gender_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Gender</option>
                  @foreach ($genders as $gender)   
                  <option value="{{$gender->id}}">{{$gender->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="marital_id" class="block text-sm font-medium leading-6 text-gray-900">Marital Status</label>
          <div class="mt-2">         
            <select id="marital_id" name="marital_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Gender</option>
                  @foreach ($maritals as $marital)   
                  <option value="{{$marital->id}}">{{$marital->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="religion_id" class="block text-sm font-medium leading-6 text-gray-900">Religion</label>
          <div class="mt-2">         
            <select id="religion_id" name="religion_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Gender</option>
                  @foreach ($religions as $religion)   
                  <option value="{{$religion->id}}">{{$religion->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 

    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="relationship_id" class="block text-sm font-medium leading-6 text-gray-900">Relationship</label>
          <div class="mt-2">         
            <select id="relationship_id" name="relationship_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Gender</option>
                  @foreach ($relationships as $relationship)   
                  <option value="{{$relationship->id}}">{{$relationship->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="bloodgroup_id" class="block text-sm font-medium leading-6 text-gray-900">Blood Group</label>
          <div class="mt-2">         
            <select id="bloodgroup_id" name="bloodgroup_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Blood Group</option>
                  @foreach ($bloodgroups as $bloodgroup)   
                  <option value="{{$bloodgroup->id}}">{{$bloodgroup->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="school_id" class="block text-sm font-medium leading-6 text-gray-900">School</label>
          <div class="mt-2">         
            <select id="school_id" name="school_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select School</option>
                  @foreach ($schools as $school)   
                  <option value="{{$school->id}}">{{$school->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="programme_id" class="block text-sm font-medium leading-6 text-gray-900">Programme</label>
          <div class="mt-2">         
            <select id="programme_id" name="programme_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Programme</option>
                  @foreach ($programmes as $programme)   
                  <option value="{{$programme->id}}">{{$programme->progdesc}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="certficate_id" class="block text-sm font-medium leading-6 text-gray-900">Certificate</label>
          <div class="mt-2">         
            <select id="certficate_id" name="certficate_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Certficate</option>
                  @foreach ($certificates as $certificate)   
                  <option value="{{$certificate->id}}">{{$certificate->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="exam_id" class="block text-sm font-medium leading-6 text-gray-900">Exam</label>
          <div class="mt-2">         
            <select id="exam_id" name="exam_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Exam</option>
                  @foreach ($exams as $exam)   
                  <option value="{{$exam->id}}">{{$exam->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="state_id" class="block text-sm font-medium leading-6 text-gray-900">State</label>
          <div class="mt-2">         
            <select id="state_id" name="state_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select State</option>
                  @foreach ($states as $state)   
                  <option value="{{$state->id}}">{{$state->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="lga_id" class="block text-sm font-medium leading-6 text-gray-900">LGA</label>
          <div class="mt-2">         
            <select id="lga_id" name="lga_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select LGA</option>
                  @foreach ($lgas as $lga)   
                  <option value="{{$lga->id}}">{{$lga->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 

    <div class="mt-6 flex items-center justify-center ml-10 gap-x-2">
        <a href="/">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Clear</button></a>

          <x-form-button>Report</x-form-button>
          

        </div>

    </form>








    

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
                                <th scope="col" class=" px-6 py-4">Form No</th>
                                <th scope="col" class=" px-6 py-4">Full Name</th>
                                <th scope="col" class=" px-6 py-4">Email</th>
                                <th scope="col" class=" px-6 py-4">Phone</th>
                                <th scope="col" class=" px-6 py-4">Programme</th>
                                <th scope="col" class=" px-6 py-4">Mode</th>
                                <th scope="col" class=" px-6 py-4">Gender</th>
                                <th scope="col" class=" px-6 py-4">State</th>
                                <th scope="col" class=" px-6 py-4">LGA</th>
                                <th scope="col" class=" px-6 py-4">Action</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $key=>$appl)
                                    
                                
                                
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                            
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    {{$appl->formno}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    {{$appl->sname.' '.$appl->fname.' '.$appl->oname}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->email}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->mphone}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->programme->progdesc}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->mode->name}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->gender->name}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->state->name}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->lga->name}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">DOWNLOAD
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
          
    
       </x-admin-role>
