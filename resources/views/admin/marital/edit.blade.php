<x-admin-role>
  <x-slot:heading>
      Admin  - Update Marital Status
  </x-slot:heading> 

  
  <form method="POST" action="/admin/marital/{{$marital->id}}">
      @csrf
      @method('PATCH')
      

      <div>
          <div class="px-2 sm:px-0">              
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
          </div>
          <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Marital Status Name</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <x-form-input name="name" id="name" value="{{$marital->name}}" required/>
            
                  <x-form-error name="name"/>
              </dd>

              
              </div>
              
              

              <div class="mt-6 flex items-center justify-center ml-10 gap-x-6">
                <a href="/admin/marital/show/{{$marital->id}}"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

                  <x-form-button>Update Marital Status</x-form-button>
                  
                  <button  form="delete-form" class="text-red-500 bg-white-500 text-sm font-bold hover:bg-red-100 w-34 h-10"> Delete Marital Status</button>

                </div>
            </dl>
          </div>
        </div>
        
  </form>


  <form action="/admin/marital/{{$marital->id}}" method="POST" id="delete-form" class="hidden">
    @csrf
    @method('DELETE')
  </form>
     </x-admin-role>
