<x-applicant-role>
 

  <x-flash-message/>
  <form method="POST" action="{{route('applicant.remita')}}">
      @csrf
                    <input type="hidden" name="sname" value="{{Auth::user()->sname}}">
                    <input type="hidden" name="fname" value="{{Auth::user()->fname}}">
                    <input type="hidden" name="oname" value="{{Auth::user()->oname}}">
                    <input type="hidden" name="email" value="{{Auth::user()->email}}">
                    <input type="hidden" name="mphone" value="{{Auth::user()->mphone}}">                   
                    
                        

        
        <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        <thead
        class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
        <tr>
            
            <th scope="col" colspan="2"  class="px-6 py-4">To make payment for Online Application form, please generate a payment code </th>
            
          </tr>
        </thead>
        <tbody>
                
          <?php $terms = \App\Models\Term::where('status', 'Active')->get() ?>

          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Session</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">
              {{$terms[0]->name}} 
            </td>       
          </tr>  

            <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">
              {{Auth::user()->sname}} {{Auth::user()->fname}} {{Auth::user()->oname}}
            </td>       
          </tr>

          <tr class="border-b border-neutral-200 dark:border-white/10">
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Email Address</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">
              {{Auth::user()->email}}
           </td>     
           </tr>

           <tr class="border-b border-neutral-200 dark:border-white/10">
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Mobile Number</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">
              {{Auth::user()->mphone}}
           </td>     
           </tr>
           <?php $categories = \App\Models\Category::where('id', Auth::user()->category_id)->get() ?>
           <tr class="border-b border-neutral-200 dark:border-white/10">
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Category</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">
              {{$categories[0]->name}}
           </td>     
           </tr>
           <?php $feeschedules = \App\Models\Feeschedule::where('category_id', Auth::user()->category_id)->get() ?>
           <tr class="border-b border-neutral-200 dark:border-white/10">
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Amount</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">
              {{$feeschedules[0]->amount}}
              <input type="hidden" name="amount" value="{{$feeschedules[0]->amount}}">
           </td>     
           </tr>
             
           <tr class="border-b border-neutral-200 dark:border-white/10">
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Payment Mode</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">
              <select id="payment" name="payment" 
              class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                <option value="0" disabled="disabled" selected>Select Payment Mode</option>  
                <option value="1">Payment with Card</option>
                <option value="2">Payment in Bank</option>     
                
              </select>
           </td>     
           </tr>
        
          
          
        </tbody>
      </table> 
      

      <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
        <a href="/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

          <x-form-button>Get Payment Code</x-form-button>
        </div>
        
  </form>

     </x-applicant-role>
