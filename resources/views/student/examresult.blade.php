<x-student-role>
    
    <x-flash-message/>  
      
  
        <div>
          <table
          class="min-w-full text-left text-sm font-light text-surface dark:text-white">
          <thead
            class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
            <tr class="border-b border-neutral-200 dark:border-white/10">
              
              <th scope="col" colspan="2"  class="px-6 py-4 text-base">Examination Results</th>
              
            </tr>
          </thead>
          <tbody>
            
                              
             
                     
                    @foreach($applications as $appl)
                    @endforeach    
                    <input type="hidden" name="formno" value="{{$appl->formno}}">                                   
             <tr class="border-b border-neutral-200 dark:border-white/10">
              <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Form No/Matric </td>
              <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
                {{$appl->formno}} / {{Auth::user()->username}} 
             </td>     
             </tr>

             <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
                <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
                  {{$appl->sname}}  {{$appl->fname}}  {{$appl->oname}}
               </td>     
               </tr>


               <tr class="border-b border-neutral-200 dark:border-white/10">
                    <th scope="col" colspan="1"  class="border border-black-300 px-6 py-4">S/N</th> 
                    <th scope="col" colspan="1"  class="border border-black-300 px-6 py-4">SUBJECT</th>  
                    <th scope="col" colspan="1"  class="border border-black-300 px-6 py-4">GRADE</th>                 
                   
                    
                    
                  </tr>
                 </thead>
                 @foreach($examresults as $key=>$examresult )  
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        
                        <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
                            {{$key + 1 }}
                          </td>
                        <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
                          {{$examresult->subject->name }}
                        </td>
                        <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
                            {{$examresult->grader->name }}
                        </td>
                            
                      </tr>
                @endforeach   

          </tbody>
        </table> 
        </div>
           
       


          <div>
            <table
            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <thead
              class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
              <tr>
                
                <th scope="col" colspan="2"  class="px-6 py-4">Examination Results</th>
                
              </tr>
            </thead>
            <tbody>           
               
    
               @foreach($examboards as $examboard)
                             
              <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap  px-6 py-4 font-medium"></td>
                @if($examboard->no_ofsitting == 1)
                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                First Sitting
               </td>
               @else
               <td class="whitespace-nowrap  px-6 py-4 font-medium">
                Second Sitting
               </td>
               @endif
               <td class="whitespace-nowrap  px-6 py-4 font-medium">
                
                
                
                  {{ $examboard->exam->name .', '.$examboard->year }}
                 
               </td>
               <td class="whitespace-nowrap  px-6 py-4 font-medium">
                <a href="{{ asset('/public/uploads/' .$examboard->certificate)}}" download="{{$examboard->examboard}}">
                <button type="button" class="text-sm font-semibold leading-6 text-blue-900">
                    View Certificate
                </button>
                </a>
            
               </td>
                   
               </tr>
               @endforeach
  
            </tbody>
          </table> 
          </div>
          
    
       </x-student-role>
  