<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{$terms[0]->name}} SESSION  - PERSONAL INFORMATION
  </x-slot:heading>

  <x-flash-message/>

  @foreach($applications as $appl)
  @endforeach

  @if($count == 0 || $appl->submitted == 0)
  

    <form method="POST" action="{{ route('applicant.applhome') }}">
        @csrf
        
        @if($count > 0)
        <input name="check" type="hidden" class="form-control" value="1" readonly>
        @endif
           

        

        
       
        <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="formno" class="block text-sm font-medium leading-6 text-gray-900">Form Number </label>
              <div class="mt-2">
                <input type="text" name="formno" id="formno"                 
                value="{{($count > 0 ? $appl->formno: $application[0]->formno)}}"
                readonly
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="title_id" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
              <div class="mt-2">
                <select id="title_id" name="title_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @if($count > 0):
                <option value="{{$appl->title->id}}" selected>{{$appl->title->name}}</option>
                @foreach($titles as $title) 
                @if($title['id'] != $appl->title_id)                               
                <option value="{{$title['id']}}">{{$title['name']}}</option>
                @endif
                @endforeach
                @else
                <option value="0" disabled="disabled" selected>Select Title</option>
                @foreach ($titles as $title)   
                <option value="{{$title->id}}">{{$title->name}}</option>   
                @endforeach
                @endif
                </select>
              </div>
            </div>
        </div> 

        <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="sname" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
              <div class="mt-2">
                <input type="text" name="sname" id="sname" 
                value = "{{($count > 0 ? $appl->sname:' ')}}" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="fname" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
              <div class="mt-2">
                <input type="text" name="fname" id="fname" 
                value = "{{($count > 0 ? $appl->fname:' ')}}" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
        </div> 


        <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="oname" class="block text-sm font-medium leading-6 text-gray-900">Other name</label>
              <div class="mt-2">
                <input type="text" name="oname" id="oname" 
                value = "{{($count > 0 ? $appl->oname:' ')}}" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="mphone" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
              <div class="mt-2">
                <input type="text" name="mphone" id="mphone" 
                value = "{{($count > 0 ? $appl->mphone:' ')}}" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
        </div> 


        <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
              <div class="mt-2">
                <input type="email" name="email" id="email" 
                value = "{{Auth::user()->email}}" 
                readonly
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
              <div class="mt-2">
                <select id="gender_id" name="gender_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @if($count > 0):
                <option value="{{$appl->gender->id}}" selected>{{$appl->gender->name}}</option>
                @foreach($genders as $gender) 
                @if($gender['id'] != $appl->gender_id)                               
                <option value="{{$gender['id']}}">{{$gender['name']}}</option>
                @endif
                @endforeach
                @else
                <option value="0" disabled="disabled" selected>Select Gender</option>
                @foreach ($genders as $gender)   
                <option value="{{$gender->id}}">{{$gender->name}}</option>   
                @endforeach
                @endif
                </select>
              </div>
            </div>
        </div> 


        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="marital_id" class="block text-sm font-medium leading-6 text-gray-900">Marital Status </label>
              <div class="mt-2">                
                <select id="marital_id" name="marital_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                  @if($count > 0):
                  <option value="{{$appl->marital->id}}" selected>{{$appl->marital->name}}</option>
                  @foreach($maritals as $marital) 
                  @if($marital['id'] != $appl->marital_id)                               
                  <option value="{{$marital['id']}}">{{$marital['name']}}</option>
                  @endif
                  @endforeach
                  @else
                  <option value="0" disabled="disabled" selected>Select Marital Status</option>
                  @foreach ($maritals as $marital)   
                  <option value="{{$marital->id}}">{{$marital->name}}</option>   
                  @endforeach
                  @endif
                  
                </select>
                
              
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="maiden" class="block text-sm font-medium leading-6 text-gray-900">Maiden</label>
              <div class="mt-2">
                <input type="text" name="maiden" id="maiden" 
                value = "{{($count > 0 ? $appl->maiden:' ')}}" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
        </div> 


        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">DOB</label>
              <div class="mt-2">  
                            
                <input type="date" name="dob" id="dob" 
                value = "{{@$appl->dob}}"   
                required              
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                
              
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="place_ofbirth" class="block text-sm font-medium leading-6 text-gray-900">Place of Birth</label>
              <div class="mt-2">
                
                <input type="text" name="place_ofbirth" id="place_ofbirth" 
                value = "{{($count > 0 ? $appl->place_ofbirth:' ')}}" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                
              
              </div>
            </div>
        </div> 

        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
            <div class="mt-2">
               @foreach($users as $user)
               @endforeach
              <input type="text" name="category_id" id="category_id" 
              value = "{{$user->category->name}}" 
              readonly
              class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              
            
            </div>
          </div>
  
          <div class="sm:col-span-3">
            <label for="bloodgroup_id" class="block text-sm font-medium leading-6 text-gray-900">Bloodgroup</label>
            <div class="mt-2">
              
              <select id="bloodgroup_id" name="bloodgroup_id" 
              class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @if($count > 0):
                <option value="{{$appl->bloodgroup->id}}" selected>{{$appl->bloodgroup->name}}</option>
                @foreach($bloodgroups as $bloodgroup) 
                @if($bloodgroup['id'] != $appl->bloodgroup_id)                               
                <option value="{{$bloodgroup['id']}}">{{$bloodgroup['name']}}</option>
                @endif
                @endforeach
                @else
                <option value="0" disabled="disabled" selected>Select Bloodgroup</option>
                @foreach ($bloodgroups as $bloodgroup)   
                <option value="{{$bloodgroup->id}}">{{$bloodgroup->name}}</option>   
                @endforeach
                @endif
              </select>
           </div>
          </div>
      </div>


        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="state_id" class="block text-sm font-medium leading-6 text-gray-900">State of Origin</label>
              <div class="mt-2">
                
                <select id="state_id" name="state_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                  @if($count > 0):
                  <option value="{{$appl->state->id}}" selected>{{$appl->state->name}}</option>
                  @foreach($states as $state) 
                  @if($state['id'] != $appl->state_id)                               
                  <option value="{{$state['id']}}">{{$state['name']}}</option>
                  @endif
                  @endforeach
                  @else
                  <option value="0" disabled="disabled" selected>Select State</option>
                  @foreach ($states as $state)   
                  <option value="{{$state->id}}">{{$state->name}}</option>   
                  @endforeach
                  @endif
                  
                </select>
                
              
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="lga_id" class="block text-sm font-medium leading-6 text-gray-900">LGA</label>
              <div class="mt-2">
                
                <select id="lga_id" name="lga_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                  @if($count > 0):
                  <option value="{{$appl->lga->id}}" selected>{{$appl->lga->name}}</option>
                  @foreach($lgas as $lga) 
                  @if($lga['id'] != $appl->lga_id)                               
                  <option value="{{$lga['id']}}">{{$lga['name']}}</option>
                  @endif
                  @endforeach
                  @else
                  <option value="0" disabled="disabled" selected>Select Lga</option>
                  @foreach ($lgas as $lga)   
                  <option value="{{$lga->id}}">{{$lga->name}}</option>   
                  @endforeach
                  @endif
                  
                </select>
             </div>
            </div>
        </div>


        <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
              <div class="mt-2">
                <input type="text" name="address" id="address" 
                value = "{{($count > 0 ? $appl->address:' ')}}" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
              <div class="mt-2">
                <input type="text" name="city" id="city" 
                value = "{{($count > 0 ? $appl->city:' ')}}" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
        </div> 


        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="states" class="block text-sm font-medium leading-6 text-gray-900">State of Address</label>
              <div class="mt-2">
                
                <select id="states" name="states" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                  @if($count > 0):
                  <option value="{{$appl->states}}" selected>{{$appl->states}}</option>
                  @foreach($states as $state) 
                  @if($state['name'] != $appl->states)                               
                  <option value="{{$state['name']}}">{{$state['name']}}</option>
                  @endif
                  @endforeach
                  @else
                  <option value="0" disabled="disabled" selected>Select State of Address</option>
                  @foreach ($states as $state)   
                  <option value="{{$state->name}}">{{$state->name}}</option>   
                  @endforeach
                  @endif
                  
                </select>
                
              
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="programme_id" class="block text-sm font-medium leading-6 text-gray-900">Mode of entry</label>
              <div class="mt-2">
                
                <select id="mode_id" name="mode_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @if($count > 0):
                <option value="{{$appl->mode_id}}" selected>{{$appl->mode->name}}</option>
                @foreach($modes as $mode) 
                @if($mode['id'] != $appl->mode_id)                               
                <option value="{{$mode['id']}}">{{$mode['name']}}</option>
                @endif
                @endforeach
                @else
                <option value="0" disabled="disabled" selected>Select Mode of Entry</option>
                  @foreach ($modes as $mode)   
                  <option value="{{$mode->id}}">{{$mode->name}}</option>   
                  @endforeach
                  @endif
                </select>
             </div>
            </div>
        </div>
        
        
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="school_id" class="block text-sm font-medium leading-6 text-gray-900">School</label>
              <div class="mt-2">
                
                <select id="school_id" name="school_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @if($count > 0):
                
                @foreach($schools as $school) 
                @if($school['id'] != $appl->school_id)                               
                <option value="{{$school['id']}}">{{$school['name']}}</option>
                @endif
                @endforeach
                @else
                <option value="0" disabled="disabled" selected>Select School</option>
                 @foreach ($schools as $school)   
                  <option value="{{$school->id}}">{{$school->name}}</option>   
                  @endforeach
                  @endif
                </select>
                
              
              </div>
            </div>
    
            <div class="sm:col-span-3">
              <label for="programme_id" class="block text-sm font-medium leading-6 text-gray-900">Department/Programme </label>
              <div class="mt-2">
                
                <select id="programme_id" name="programme_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @if($count > 0):
                <option value="{{$appl->programme_id}}" selected>{{$appl->programme->department}}</option>
                @foreach($programmes as $programme) 
                @if($programme['id'] != $appl->programme_id)                               
                <option value="{{$programme['id']}}">{{$programme['department']}}</option>
                @endif
                @endforeach
                @else
                <option value="0" disabled="disabled" selected>Select Department</option>
                  @foreach ($programmes as $programme)   
                  <option value="{{$programme->id}}">{{$programme->department}}</option>   
                  @endforeach
                  @endif
                  
                </select>
             </div>
            </div>
        </div>

       
        <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="country_id" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
            <div class="mt-2">
           
              <select id="country_id" name="country_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @if($count > 0):
                <option value="{{$appl->country_id}}" selected>{{$appl->country->name}}</option>
                @foreach($countries as $country) 
                @if($country['id'] != $appl->country_id)                               
                <option value="{{$country['id']}}">{{$country['name']}}</option>
                @endif
                @endforeach
                @else
                <option value="0" disabled="disabled" selected>Select Country</option>  
                @foreach ($countries as $country)   
                  <option value="{{$country->id}}">{{$country->name}}</option>   
                  @endforeach
                  @endif
                </select>

            </div>
          </div>
  
          <div class="sm:col-span-3">
            <label for="fname" class="block text-sm font-medium leading-6 text-gray-900">Religion</label>
            <div class="mt-2">
             
              <select id="religion_id" name="religion_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @if($count > 0):
                <option value="{{$appl->religion_id}}" selected>{{$appl->religion->name}}</option>
                @foreach($religions as $religion) 
                @if($religion['id'] != $appl->religion_id)                               
                <option value="{{$religion['id']}}">{{$religion['name']}}</option>
                @endif
                @endforeach
                @else
                <option value="0" disabled="disabled" selected>Select Religion</option>
                  @foreach ($religions as $religion)   
                  <option value="{{$religion->id}}">{{$religion->name}}</option>   
                  @endforeach
                  @endif
                  
                </select>
              
            </div>
          </div>
      </div> 


        <div class="flex items-center justify-center mt-6 mb-6">            

            <x-primary-button class="ms-4">
                {{ __('Save and Continue') }}
            </x-primary-button>
        </div>
    </form>

  @else
 
  <p>  * Filling of Application form completed.  </p>
    <p>            
    <a href="/applicant/printform"> 
          <i class="fa-solid fa-print"></i> Click to Print form</a></p>

    

  
  @endif
</x-applicant-role>
