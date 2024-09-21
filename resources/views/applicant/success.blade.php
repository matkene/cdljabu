<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{@$terms[0]->name}} SESSION  - SUCCESS
    </x-slot:heading> 

    <x-flash-message/>

          <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-6 mt-5">                 
                <table
                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4"> Congratulations, You have completed your application form</th>
                  </tr>
                 </thead>
                <tbody> 
                    <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Click on Print Application Form  tab to  print out your form
                        </td>                      
            
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Always check your portal for your admission status
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Thank you
                        </td>    
                      </tr>
                    
                </tbody>
                </table>
            </div>

            
                      
        
        </div>
        
    
</x-applicant-role>