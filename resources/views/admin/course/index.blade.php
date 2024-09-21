<x-admin-role>
    <x-slot:heading>
        Admin  - Course
    </x-slot:heading>    
    
    <x-flash-message/>

        <div>
            <div class="px-2 sm:px-0">              
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
            </div>
            <div class="mt-6 border-t border-gray-100">
                <div class="mt-6 flex items-center justify-end">
                <form method="POST" action="{{route('admin.course.create')}}">
                    @csrf
                    @method('GET')
                <x-form-button>Create Course</x-form-button>
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
                                <th scope="col" class=" px-6 py-4">Programme</th>
                                <th scope="col" class=" px-6 py-4">Code</th>
                                <th scope="col" class=" px-6 py-4">Description</th>
                                <th scope="col" class=" px-6 py-4">Unit</th>
                                <th scope="col" class=" px-6 py-4">Level</th>
                                <th scope="col" class=" px-6 py-4">Remark</th>
                                <th scope="col" class=" px-6 py-4">Session</th>
                                <th scope="col" class=" px-6 py-4">Semester</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $key=>$course)
                                    
                                
                                
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                            
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    <a href="/admin/course/show/{{$course->id}}">{{$course->programme->progdesc}} </a>
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                  <a href="/admin/course/show/{{$course->id}}">{{$course->crsid}} </a>
                              </td>
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                <a href="/admin/course/show/{{$course->id}}">{{$course->crsdesc}} </a>
                            </td>
                            <td class="whitespace-nowrap  px-6 py-4 font-medium">
                              <a href="/admin/course/show/{{$course->id}}">{{$course->unit}} </a>
                          </td>
                          <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <a href="/admin/course/show/{{$course->id}}">{{$course->level}} </a>
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          <a href="/admin/course/show/{{$course->id}}">{{$course->remark}} </a>
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        <a href="/admin/course/show/{{$course->id}}">{{$course->term->name}} </a>
                    </td>
                    <td class="whitespace-nowrap  px-6 py-4 font-medium">
                      <a href="/admin/course/show/{{$course->id}}">{{$course->semester}} </a>
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
       
       <div>
        {{$courses->links()}}
       </div>
          
    </form>
</x-admin-role>
