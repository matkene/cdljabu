<x-student-role>
  <x-slot:heading>
      APPLICATION FORM FOR {{@$terms[0]->name}} SESSION 
  </x-slot:heading> 
  <x-flash-message/> 
         
          
          @foreach($students as $appl)
          @endforeach
          <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              
          <div class="sm:col-span-6 mt-2">                 
              <table
              class="min-w-full text-left text-sm font-light text-surface dark:text-white">
              
              <thead
                class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                <tr>                    
                  <th scope="col" colspan="2"  class="px-6 py-4"> PERSONAL INFORMATION</th>
                </tr>
               </thead>
              <tbody> 
                  <tr class="border-b border-neutral-200 dark:border-white/10">
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          Matric
                      </td> 
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->matric}}
                      </td>                      
          
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Title
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->title->name}}
                      </td>    
                    </tr>
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Surname
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->sname}}
                      </td>    
                    </tr>
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         First Name
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->fname}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Other Name
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->oname}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Gender
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->gender->name}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Marital Status
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->marital->name}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Maiden
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->maiden}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Date of birth
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->dob}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         State of Origin
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->state->name}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          Local Government Area
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->lga->name}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Country
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->country->name}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Blood Group
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->bloodgroup->name}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Religion
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{@$appl->religions->name}}
                      </td>    
                    </tr>

                    <thead
                class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                <tr>                    
                  <th scope="col" colspan="2"  class="px-6 py-4"> CONTACT INFORMATION</th>
                </tr>
               </thead>
                  <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Address
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->address}}
                      </td>    
                    </tr>
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Email
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->email}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Phone
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->mphone}}
                      </td>    
                    </tr>

              <thead
                class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                <tr>                    
                  <th scope="col" colspan="2"  class="px-6 py-4"> PROGRAMME OF STUDY</th>
                </tr>
               </thead>
                  <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Mode of Entry
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->mode->name}}
                      </td>    
                    </tr>
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Programme
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->programme->progdesc}}
                      </td>    
                    </tr>

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         Department
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{$appl->programme->department}}
                      </td>    
                    </tr>

                    <thead
                class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                <tr>                    
                  <th scope="col" colspan="2"  class="px-6 py-4"> NEXT-OF-KIN DETAILS</th>
                </tr>
               </thead>
   

                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        Name of Next of Kin
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          {{@$appl->name_nok}}
                      </td>    
                    </tr>


                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        Relationship to Next of Kin
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{@$appl->relationship->name}}
                      </td>    
                    </tr>


                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        Address of Next of Kin
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{@$appl->address_nok}}
                      </td>    
                    </tr>



                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        Phone of Next of Kin
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{@$appl->mphone_nok}}
                      </td>    
                    </tr>


                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        Email of Next of Kin
                      </td>
                      <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        {{@$appl->email_nok}}
                      </td>    
                    </tr>                     
             
           

              </tbody>
              </table>
          </div>

          
                    
      
      </div>

      <div class="flex items-center justify-center mt-8 mb-4">
        <button class="ms-4 text-base font-semibold leading-6 text-cyan-900" onClick="window.print()">Click to  Print</button>

          
      </div>
      
  
</x-student-role>