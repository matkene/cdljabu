<x-exam-role>

<form method="POST" action="{{route('exam.resultviewall')}}">
  @csrf              
               
                      
                      <input type="hidden" name="id" value="{{Auth::user()->username}}">                    
                
                
                    

  <div>
    <table
    class="min-w-full text-left text-sm font-light text-surface dark:text-white">
    <thead
      class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
      <tr>
        
        <th scope="col" colspan="2"  class="px-6 py-4 text-lg">RESULTS CONSOLE </th>
        
      </tr>
    </thead>
    <tbody>

         
     
      
      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Session</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          <select id="term_id" name="term_id" 
            required
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
              <option value="" disabled="disabled" selected>Select Session</option>  
              @foreach($terms as $term)
              <option value="{{$term->name}}">{{$term->name}}</option>
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


      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Level</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          <select id="level" name="level" 
            required
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
              <option value="" disabled="disabled" selected>Select Level</option>  
             
              <option value="100">100</option>
              <option value="200">200</option>
              <option value="300">300</option> 
              <option value="400">400</option>
              <option value="500">500</option>
              <option value="600">600</option>

                   
              
            </select>
        </td>       
      </tr>  



      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">College</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          <select id="school_id" name="school_id" 
            required
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
              <option value="" disabled="disabled" selected>Select College</option>  
              @foreach($schools as $school)
              <option value="{{$school->id}}">{{$school->name}}</option>
              @endforeach
                   
              
            </select>
        </td>       
      </tr>  


      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Programme</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          <select id="programme_id" name="programme_id" 
            required
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
              <option value="" disabled="disabled" selected>Select Programme</option>  
              @foreach($programmes as $programme)
              <option value="{{$programme->id}}">{{$programme->progdesc}}</option>
              @endforeach
                   
              
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



</x-exam-role>