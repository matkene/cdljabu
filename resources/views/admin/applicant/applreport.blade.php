<x-admin-role>
    <x-slot:heading>
        TOTAL RECORDS ON REPORTS FOR APPLICATIONS
    </x-slot:heading>    
    
    <x-flash-message/>



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
                                <th scope="col" class=" px-6 py-4">Form No</th>
                                <th scope="col" class=" px-6 py-4">Full Name</th>
                                <th scope="col" class=" px-6 py-4">Email</th>
                                <th scope="col" class=" px-6 py-4">Phone</th>
                                <th scope="col" class=" px-6 py-4">Programme</th>
                                <th scope="col" class=" px-6 py-4">Mode</th>
                                <th scope="col" class=" px-6 py-4">Gender</th>
                                <th scope="col" class=" px-6 py-4">State</th>
                                <th scope="col" class=" px-6 py-4">Certficate</th>
                                <th scope="col" class=" px-6 py-4">Grade</th>
                                <th scope="col" class=" px-6 py-4">Sitting</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $key=>$appl)
                                    
                                
                                
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                            
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{++$key}}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    {{$appl->formno}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    {{$appl->sname.' '.$appl->fname.' '.$appl->oname}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->email}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->mphone}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->programme->progdesc}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->mode->name}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->gender->name}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$appl->state->name}}
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">Grade
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">Sitting
                                </td>         
                                
                              </tr>                          
                              
                              @endforeach
                              <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap  px-6 py-4 font-medium" colspan="9">
                                  Total Record: {{$count}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                
            </div>
          
       </div>
          

       </x-admin-role>
