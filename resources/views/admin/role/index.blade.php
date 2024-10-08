<x-admin-role>
  <x-slot:heading>
      Admin  - Role
  </x-slot:heading>    
  
  <x-flash-message/>

      <div>
          <div class="px-2 sm:px-0">              
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
          </div>
          <div class="mt-6 border-t border-gray-100">
              <div class="mt-6 flex items-center justify-end">
              <form method="POST" action="{{route('admin.role.create')}}">
                  @csrf
                  @method('GET')
              <x-form-button>Create Role</x-form-button>
              </form>
              </div>

              <div class="flex flex-col">
                  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">                      
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                      <div class="overflow-hidden">
                        <table
                          class="min-w-full text-center text-sm font-light text-surface dark:text-white">
                          <thead
                            class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                            <tr>
                              <th scope="col" class=" px-6 py-4">S/N</th>
                              <th scope="col" class=" px-6 py-4 text-left">Role Name</th>
                              
                              
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($roles as $key=>$role)
                                  
                              
                              
                              <tr class="border-b border-neutral-200 dark:border-white/10">
                          
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium text-left">
                                  <a href="/admin/role/show/{{$role->id}}">{{$role->name}} </a>
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
        
  </form>
     </x-admin-role>
