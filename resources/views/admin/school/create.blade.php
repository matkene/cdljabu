<x-admin-role>
    <x-slot:heading>
        Admin  - Create School
    </x-slot:heading> 

    
    <form method="POST" action="{{route('admin.school.store')}}">
        @csrf
        

        <div>
            <div class="px-2 sm:px-0">              
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
            </div>
            <div class="mt-6 border-t border-gray-100">
              <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">School Name</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <x-form-input name="name" id="name" placeholder="" required/>
            
                    <x-form-error name="name"/>
                </dd>

                <dt class="text-sm font-medium leading-6 text-gray-900">School Code </dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <x-form-input name="code" id="code" placeholder="e.g S0S202" required/>
            
                    <x-form-error name="code"/>
                </dd>
                </div>
                
                

                <div class="mt-6 flex items-center justify-center mr-6 gap-x-6">
                  <a href="/admin/school/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

                    <x-form-button>Create School</x-form-button>
                  </div>
              </dl>
            </div>
          </div>
          
    </form>
       </x-admin-role>
