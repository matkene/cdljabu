<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{@$terms[0]->name}} SESSION  - PREVIEW
    </x-slot:heading> 

    <form method="POST" action="{{ route('applicant.printform') }}">
        @csrf
    
    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
            <div class="flex items-right justify-right mt-12 mb-4">         

                <x-primary-button class="ms-4">
                    {{ __('Preview Application Form Before Submission') }}
                </x-primary-button>
            </div>     
        
        </div>
              

        </div>

    </form>

    <form method="POST" action="{{ route('applicant.submit') }}"  enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="accepted" value="1">
        <input type="hidden" name="submitted" value="1">

          <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="passport" class="block text-sm font-medium leading-6 text-gray-900">Upload Passport (Jpg, Jpeg or Png)</label>
                <div class="mt-2">        
                  <input type="file" name="passport" id="passport" 
                  class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div> 
            
            </div>
            <x-form-error name="passport"/>             
    
            </div>

            <div class="sm:col-span-6 mt-5">
                 
                <table
                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>
                    
                    <th scope="col" colspan="2"  class="px-6 py-4">READ CAREFULLY.</th>
                    
                  </tr>
                 
                </thead>
                <tbody> 
                    <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           * Please note that after submission, you will no longer be able to edit the application,<br/> 
                             make sure you confirm the correctness of the provided information before submitting
                        </td>
                                    
            
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">
                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            * I hereby confirm that the information provided above is valid and accurate and <br/>
                              can be used to process my application form.
                        </td>
                        
            
                      </tr>
                    
                </tbody>
                </table>
            </div>

            <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <div class="flex items-left justify-left mt-12 mb-4">         
        
                        <x-primary-button class="ms-4">
                            {{ __('Submit Application Form') }}
                        </x-primary-button>
                    </div>     
                
                </div>
                      
        
                </div>
        
    </form>
</x-applicant-role>