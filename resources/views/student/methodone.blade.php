<x-student-role>
  <x-slot:heading>
      
</x-slot:heading>



<form method="POST" action="{{route('student.remita')}}">
  @csrf
                
                @foreach($students as $student)
                      @endforeach
                      
                      <input type="hidden" name="id" value="{{Auth::user()->username}}">
                      <input type="hidden" name="programme_id" value="{{$student->programme_id}}">
                      <input type="hidden" name="level" value="{{$student->level}}">
                      <input type="hidden" name="sname" value="{{$student->sname}}">
                      <input type="hidden" name="fname" value="{{$student->fname}}">
                      <input type="hidden" name="oname" value="{{$student->oname}}">
                      <input type="hidden" name="email" value="{{$student->email}}">
                      <input type="hidden" name="mphone" value="{{$student->mphone}}">
                      <input type="hidden" name="applno" value="{{$student->applno}}">
                      <input type="hidden" name="matric" value="{{$student->matric}}">
                
                
                    

  <div>
    <table
    class="min-w-full text-left text-sm font-light text-surface dark:text-white">
    <thead
      class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
      <tr>
        
        <th scope="col" colspan="2"  class="px-6 py-4">SCHOOL FEES PAYMENT  CONSOLE - {{Str::upper($method)}} METHOD</th>
        
      </tr>
    </thead>
    <tbody>

      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Admission Number</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          
          <input
              type="text"
              class="border border-gray-200 rounded p-3 min-w-full"
              name="applno"
              value="{{$student->applno}}"
              readonly
          />
        </td>       
      </tr>

      <tr class="border-b border-neutral-200 dark:border-white/10">        
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          
          <input
              type="text"
              class="border border-gray-200 rounded p-2 min-w-full"
              name="fullname"
              value="{{$student->sname. ' '. $student->fname .' '.$student->oname}}"
              readonly
          />
        </td>       
      </tr>
            
     
      <?php $terms = \App\Models\Term::where('status', 'Active')->get() ?>
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
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Level</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="level"
              value="{{$student->level}}"
              readonly
          />
        </td>       
      </tr>

      <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Email Address</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="emailaddress"
              value="{{$student->email}}"
              readonly
          />
       </td>     
       </tr>

       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Mobile Number</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="phonenumber"
              value="{{$student->mphone}}"
              readonly
          />
       </td>     
       </tr>
       <?php $categories = \App\Models\Category::where('id', Auth::user()->category_id)->get() ?>
       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Category</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          {{$categories[0]->name}}
       </td>     
       </tr>
       
         
       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Payment Mode</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          <select id="paymentmode" name="paymentmode" 
          required
          class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
            <option value="" disabled="disabled" selected>Select Payment Mode</option>  
            <option value="webpay">Pay Online With Card</option>
            <option value="paydirect">Pay In Bank</option>     
            
          </select>
       </td>     
       </tr>


       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium">Payment Option</td>
        <td class="whitespace-nowrap  px-6 py-4 font-medium">
          <select  name="fee" 
          required
          class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
          <option value=" " disabled="disabled" selected>Select Payment Option</option>                         

          @foreach($fees as $fee)                            
          <option value="{{$fee->id}}">{{$fee->item}}  -  ₦ {{number_format($fee->amount,2)}} </option>                                                   
          @endforeach        
            
          </select>
       </td>     
       </tr>
    
      
      
    </tbody>
  </table> 
  </div>

  <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
    <a href="/student/methods"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

      <x-form-button>Generate Payment Advice</x-form-button>
    </div>
    
</form>



</x-student-role>