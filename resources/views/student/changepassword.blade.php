<x-student-role>
   
    <x-flash-message/> 
           
            
    <form method="POST" action="{{ route('student.updatepassword') }}">
        @csrf 
        @foreach($students as $student)
        @endforeach
            <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                
            <div class="sm:col-span-6 mt-2">                 
                <table
                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                
                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4"> CHANGE PASSWORD </th>
                  </tr>
                 </thead>
                <tbody> 
                    <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Matric
                        </td> 
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <x-form-input name="matric" value="{{$student->matric}}"  readonly/>          
                           <x-form-error name="matric"/>
                        </td> 
            
                      </tr>


                      <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Full Name
                        </td> 
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          <x-form-input name="sname" value="{{$student->sname.' '.$student->fname.' '.$student->oname}}"  readonly/>          
                            
                        </td> 
            
                      </tr>


                      <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            New Password
                        </td> 
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <x-form-input name="password" type="password" required/>
          
                             <x-form-error name="password"/>
                        </td> 
            
                      </tr>
  
                     
             
  
                </tbody>
                </table>
            </div>
  
            
                      
        
        </div>
  
        <div class="flex items-center justify-center mt-8 mb-4">
          <x-primary-button class="ms-4">
            {{ __('Click to Update') }}
        </x-primary-button>
            
        </div>
        
    </form>
  </x-student-role>