<x-admin-role>
  <x-slot:heading>
      Admin  - Update Programme
  </x-slot:heading> 

  
  <form method="POST" action="/admin/programme/{{$programme->id}}">
      @csrf
      @method('PATCH')
      

      <div>
          <div class="px-2 sm:px-0">              
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
          </div>
          <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">School Name</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                     
                  <select id="school_id" name="school_id" class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option value="{{$programme->school_id}}">{{$programme->school->name}}</option> 
                    @foreach ($schools as $school)   
                    <option value="{{$school->id}}">{{$school->name}}</option>   
                    @endforeach
                    
                  </select>                  

                  <x-form-error name="school_id"/>
                  
              </dd>

              <dt class="text-sm font-medium leading-6 text-gray-900">Programme Name</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <x-form-input name="progdesc" id="progdesc" value="{{$programme->progdesc}}" required/>
          
                  <x-form-error name="progdesc"/>
              </dd>

              <dt class="text-sm font-medium leading-6 text-gray-900">Department Name</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <x-form-input name="department" id="department" value="{{$programme->department}}" required/>
          
                  <x-form-error name="department"/>
              </dd>
              </div>
              
              

              <div class="mt-6 flex items-center justify-center ml-10 gap-x-6">
                <a href="/admin/programme/show/{{$programme->id}}"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

                  <x-form-button>Update Programme</x-form-button>
                  
                  <button  form="delete-form" class="text-red-500 bg-white-500 text-sm font-bold hover:bg-red-100 w-34 h-10"> Delete Programme</button>

                </div>
            </dl>
          </div>
        </div>
        
  </form>


  <form action="/admin/programme/{{$programme->id}}" method="POST" id="delete-form" class="hidden">
    @csrf
    @method('DELETE')
  </form>
     </x-admin-role>
