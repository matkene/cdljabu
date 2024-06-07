<x-admin-role>
    <x-slot:heading>
        Admin  - Create LGA
    </x-slot:heading> 

    
    <form method="POST" action="{{route('admin.lga.store')}}">
        @csrf
        

        <div>
            <div class="px-2 sm:px-0">              
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
            </div>
            <div class="mt-6 border-t border-gray-100">
              <div class="divide-y divide-gray-100">

                <dt class="text-sm font-medium leading-6 text-gray-900">State Name</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                       
                    <select id="state_id" name="state_id" class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                      @foreach ($states as $state)   
                      <option value="{{$state->id}}">{{$state->name}}</option>   
                      @endforeach
                      
                    </select>                  

                    <x-form-error name="state_id"/>
                    
                </dd>
              </div>   
            </div>

            <div class="mt-6 border-t border-gray-100">    
                <div class="divide-y divide-gray-100">
                  <dt class="text-sm font-medium leading-6 text-gray-900">LGA Name</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <x-form-input name="name" id="name" placeholder="" required/>
            
                    <x-form-error name="name"/>
                </dd>
              </div>
                
                
                

                <div class="mt-6 flex items-center justify-center mr-6 gap-x-6">
                  <a href="/admin/lga/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

                    <x-form-button>Create LGA</x-form-button>
                  </div>
              </dl>
            </div>
          </div>
          
    </form>
       </x-admin-role>
