<x-admin-role>
    <x-slot:heading>
        Admin  - Create Course
    </x-slot:heading> 

    
    <form method="POST" action="{{route('admin.course.store')}}">
        @csrf
        

        <div>
            <div class="px-2 sm:px-0">              
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
            </div>
            <div class="mt-6 border-t border-gray-100">
              <div class="divide-y divide-gray-100">

                <dt class="text-sm font-medium leading-6 text-gray-900">Programme</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                       
                    <select id="programme_id" name="programme_id" class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                      @foreach ($programmes as $programme)   
                      <option value="{{$programme->id}}">{{$programme->progdesc}}</option>   
                      @endforeach
                      
                    </select>                  

                    <x-form-error name="programme_id"/>
                    
                </dd>
                <dt class="text-sm font-medium leading-6 text-gray-900">Session</dt>

                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                       
                  <select id="term_id" name="term_id" class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    @foreach ($terms as $term)   
                    <option value="{{$term->id}}">{{$term->name}}</option>   
                    @endforeach
                    
                  </select>                  

                  <x-form-error name="term_id"/>
                  
              </dd>

                <dt class="text-sm font-medium leading-6 text-gray-900">Code</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <x-form-input name="crsid" id="crsid" placeholder="" required/>
            
                    <x-form-error name="crsid"/>
                </dd>

                <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <x-form-input name="crsdesc" id="crsdesc" placeholder="" required/>
            
                    <x-form-error name="crsdesc"/>
                </dd>

                <dt class="text-sm font-medium leading-6 text-gray-900">Unit</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <x-form-input name="unit" id="unit" placeholder="" required/>
            
                    <x-form-error name="unit"/>
                </dd>

                <dt class="text-sm font-medium leading-6 text-gray-900">Level</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <select id="level" name="level" class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                     
                      <option value="100">100</option>   
                      <option value="200">200</option>
                      <option value="300">300</option>
                      <option value="400">400</option>
                      <option value="500">500</option>
                      <option value="600">600</option>
                      <option value="700">700</option>
                      <option value="800">800</option>       
                      
                    </select> 
            
                    <x-form-error name="level"/>
                </dd>

                <dt class="text-sm font-medium leading-6 text-gray-900">Remark</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <x-form-input name="remark" id="remark" placeholder="" required/>
            
                    <x-form-error name="remark"/>
                </dd>

                <dt class="text-sm font-medium leading-6 text-gray-900">Semester</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <select id="semester" name="semester" class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                     
                      <option value="1st">First</option>   
                      <option value="2nd">Second</option>
                            
                      
                    </select> 
            
                    <x-form-error name="semester"/>
                </dd>
              </div>   
            </div>           
                
                
                

                <div class="mt-6 flex items-center justify-center mr-6 gap-x-6">
                  <a href="/admin/course/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

                    <x-form-button>Create Course</x-form-button>
                  </div>
              </dl>
            </div>
          </div>
          
    </form>
       </x-admin-role>
