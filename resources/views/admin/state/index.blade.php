<x-admin-role>
  <x-slot:heading>
      Admin  - State
  </x-slot:heading>    
  
  <x-flash-message/>

      <div>
          <div class="px-2 sm:px-0">              
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
          </div>
          <div class="mt-6 border-t border-gray-100">
              <div class="mt-6 flex items-center justify-end">
              <form method="POST" action="{{route('admin.state.create')}}">
                  @csrf
                  @method('GET')
              <x-form-button>Create State</x-form-button>
              </form>
              </div>

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
                              <th scope="col" class=" px-6 py-4">State Name</th>
                              
                              
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($states as $key=>$state)
                                  
                              
                              
                              <tr class="border-b border-neutral-200 dark:border-white/10">
                          
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  <a href="/admin/state/show/{{$state->id}}">{{$state->name}} </a>
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
