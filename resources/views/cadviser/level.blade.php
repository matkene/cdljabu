<x-course-adviser-role>
    <form method="POST" action="{{route('cadviser.level')}}">
      @csrf                  
      @foreach($students as $student)
      @endforeach
                          
       <input type="hidden" name="matric" value="{{$student->matric}}">
       <input type="hidden" name="programme_id" value="{{$student->programme_id}}">        
                    
                          
      <div>
        <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        <thead
          class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
          <tr>
            
            <th scope="col" colspan="2"  class="px-6 py-4 text-base">STUDENT RECORD - CHANGE LEVEL </th>
            
          </tr>
        </thead>
        <tbody>
                
           <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Matric</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$student->matric}}
            </td>       
          </tr> 
  
          
  
          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$student->sname}}  {{$student->fname}} {{$student->oname}}
            </td>       
          </tr>
  
  
          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Level</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$student->level}}
            </td>       
          </tr>

          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">New Level</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
                
                <select id="level" name="level" 
                class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                 
                  <option value="100">100</option> 
                  <option value="200">200</option>
                  <option value="300">300</option>
                  <option value="400">400</option> 
                  <option value="500">500</option> 
                  <option value="600">600</option>
                  <option value="700">700</option>
                  <option value="800">800</option>                     
                                  
                  
                </select>
            </td>       
          </tr>
  
          
          
        </tbody>
      </table> 
      </div>
  
      <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
  
          <x-form-button>Update Level </x-form-button>
        </div>
        
  </form>
    
  </x-course-adviser-role>