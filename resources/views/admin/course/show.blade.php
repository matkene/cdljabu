<x-admin-role>
  <x-slot:heading>
      Admin  - Update Course
  </x-slot:heading> 

  
     

      <div>
          <div class="px-2 sm:px-0">              
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
          </div>
          <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Programme</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                       
                    {{$course->programme->progdesc}}           
                    
                </dd>          

              
                <dt class="text-sm font-medium leading-6 text-gray-900">Session</dt>

                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                       
                  {{$course->term->name}}       
                  
              </dd>

              <dt class="text-sm font-medium leading-6 text-gray-900">Code</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    
                    {{$course->crsid}}
                </dd>

                <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    
                    {{$course->crsdesc}}
                </dd>
                <dt class="text-sm font-medium leading-6 text-gray-900">Unit</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    
                    {{$course->unit}}
                </dd>
                <dt class="text-sm font-medium leading-6 text-gray-900">Level</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    
                    {{$course->level}}
                </dd>
                <dt class="text-sm font-medium leading-6 text-gray-900">Remark</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                   
                    {{$course->remark}}
                </dd>
                <dt class="text-sm font-medium leading-6 text-gray-900">Semester</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    
                    {{$course->semester}}
                </dd>
                  </div>
              
              

              <div class="mt-6 flex items-center justify-center mr-6 gap-x-6">
                <a href="/admin/course/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>
                  
                  <x-admin-link href='/admin/course/edit/{{$course->id}}'>  Edit Course</x-admin-link> 
                </div>
            </dl>
          </div>
        </div>
        
  </form>
     </x-admin-role>
