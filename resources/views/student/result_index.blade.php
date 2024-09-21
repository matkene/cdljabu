<x-student-role>
 


<form method="POST" action="{{route('student.resultdisplay')}}">
  @csrf
                
                @foreach($students as $student)
                @endforeach
                      
                      <input type="hidden" name="id" value="{{Auth::user()->username}}">   
                      <input type="hidden" name="level" value="{{$student->level}}">
                      <input type="hidden" name="matric" value="{{$student->matric}}"> 
                      <input type="hidden" name="programme_id" value="{{$student->programme_id}}">                 
                
                
                    

  <div>
    <table
    class="min-w-full text-left text-sm font-light text-surface dark:text-white">
    <thead
      class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
      <tr>
        
        <th scope="col" colspan="2"  class="px-6 py-4">RESULTS CONSOLE </th>
        
      </tr>
    </thead>
    <tbody>

      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Matric</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$student->matric}}
          
        </td>       
      </tr>

      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$student->sname. ' '. $student->fname .' '.$student->oname}}
          
        </td>       
      </tr>


      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Level</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
         
          {{$student->level}}
          
        </td>       
      </tr>

            
     
      
      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Session</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          <select id="term_id" name="term_id" 
            required
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
              <option value="" disabled="disabled" selected>Select Session</option>  
              @foreach($terms as $term)
              <option value="{{$term->id}}">{{$term->name}}</option>
              @endforeach
                   
              
            </select>
        </td>       
      </tr>  


      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Semester</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          <select id="semester" name="semester" 
            required
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
              <option value="" disabled="disabled" selected>Select Semester</option>  
             
              <option value="1st">First Semester</option>
              <option value="2nd">Second Semester</option>            
                   
              
            </select>
        </td>       
      </tr>  


        

      
      
      
    </tbody>
  </table> 
  </div>

  <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
    <a href="/student/methods"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

      <x-form-button>View Results</x-form-button>
    </div>
    
</form>



</x-student-role>