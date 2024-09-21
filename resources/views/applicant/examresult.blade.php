<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{$terms[0]->name}} SESSION  - EXAM RESULTS
    </x-slot:heading> 
  
    <x-flash-message/>  
      
  
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
            <form method="POST" action="{{ route('applicant.examresultpost') }}">
                @csrf
                              
             
                     
                    @foreach($applications as $appl)
                    @endforeach    
                    <input type="hidden" name="formno" value="{{$appl->formno}}">                                   
           <tr class="border-b border-neutral-200 dark:border-white/10">
              <td class="whitespace-nowrap  px-6 py-4 font-medium">Form No</td>
              <td class="whitespace-nowrap  px-6 py-4 font-medium">
                {{$appl->formno}}
             </td>     
             </tr>

             <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                  {{$appl->sname}}  {{$appl->fname}}  {{$appl->oname}}
               </td>     
               </tr>

          </tbody>
        </table> 
        </div>
           
        @if($appl->submitted == 0)
        <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">  
            <x-form-button>  Add a New Examination Result</x-form-button>
          </div>
          @endif

        </form>


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
               @if(@$appl->submitted == 0)
               <td class="whitespace-nowrap  px-6 py-4 font-medium">
                <form class="form" action="{{ route('applicant.delexamresult') }}" method="post">
                    <input type="hidden"  name="formno" value="{{$examboard->formno}}"> 
                    <input type="hidden"  name="no_sitting" value="{{$examboard->no_ofsitting}}"> 
                    {{ csrf_field() }}<button type="submit" class="btn btn-primary">Delete</button>
                    </form>
               </td>
               @endif     
               </tr>
               @endforeach
  
            </tbody>
          </table> 
          </div>
          
    
       </x-applicant-role>
  