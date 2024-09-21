<x-course-adviser-role>
  <x-flash-message/>
    
    
       <div>
            <div class="px-2 sm:px-0">              
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
            </div>
            <div class="mt-6 border-t border-gray-100">
                

                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">                      
                      <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                          
                          <table
                            class="min-w-full text-left text-base font-light text-surface dark:text-white">
                            <thead
                              class="border-b border-neutral-200 bg-neutral-50 font-bold dark:border-white/10 dark:text-neutral-600">
                              <tr>
                                <th scope="col" class=" px-6 py-4 text-lg" colspan="9">RECORD OF STUDENTS COURSE REGSITRATION</th>
                              </tr>
                              <tr>
                                <th scope="col" class=" px-6 py-4">S/N</th>
                                <th scope="col" class=" px-6 py-4">Matric</th>                                
                                <th scope="col" class=" px-6 py-4">Full Name</th>                                
                                <th scope="col" class=" px-6 py-4">Programme</th>
                                <th scope="col" class=" px-6 py-4">Level</th>
                                <th scope="col" class=" px-6 py-4">Session</th>
                                

                                
                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php $total = 0;?>
                                @foreach ($studentcourses as $key=>$appl)    
                                                                 
                                
                                
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                            
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->matric}}</td>      
                               
                                <td class="whitespace-nowrap  px-6 py-4 font-medium uppercase">
                                  {{$appl->sname.' '.$appl->fname.' '.$appl->oname}}</td>
                                  
                                  
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->programme->progdesc}} </td>
                                
                                    
                              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                {{$appl->level}}
                            </td> 
                            
                            <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                {{$appl->level}}
                            </td> 
                            
                            
                            <td class="whitespace-nowrap  px-6 py-2 font-medium">
                                <form method="POST" action="{{route('cadviser.course')}}">
                                    @csrf
                                
                                <input type="hidden" name="matric" value="{{$appl->matric}}">
                                <button type="submit" name="changelevel" class="bg-cyan-600 hover:bg-cyan-900  text-white rounded">
                                    View Registration
                                </button>
                                </form>
                                

                           
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
       
    
</x-course-adviser-role>
