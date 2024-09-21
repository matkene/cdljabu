<x-admin-role>
    <x-slot:heading>
        Admin  - Create Account
    </x-slot:heading> 
  
    
    <form method="POST" action="{{route('admin.biodatapost')}}">
        @csrf
        
  
        <div>
            <div class="px-2 sm:px-0">              
              <p class="mt-1 max-w-2xl text-base leading-6 text-black-800 text-bold"> CREATE STUDENT RECORDS</p>
            </div>
            <div class="mt-6 border-t border-gray-100">
              <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  
  
  
                
            
  
              
              
              
              
              
              
  
              
              
              
              
  
  
                </div>
  
               
  
                            
  
                <div class="mt-6 flex items-center justify-center mr-6 gap-x-6">
                  <a href="/admin/category/"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>
  
                    <x-form-button>Create Student Account</x-form-button>
                  </div>
              </dl>
            </div>
  
  
  
            <table
        class="min-w-max text-left text-xs font-light text-surface dark:text-white">
        <thead
          class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
          <tr>
             
            <th scope="col" colspan="10"  class="px-6 py-4 text-lg">STUDENTS RECORDS </th>
            
          </tr>
        </thead>
        <tbody>
                
          
            <tr class="border-b border-neutral-200 dark:border-white/10 text-lg">       
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>S/N</strong></td>          
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>MATRIC</strong></td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>FULL NAME</strong></td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>PHONE</strong></td>          
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>EMAIL</strong></td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>SEX</strong></td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>PROGRAMME</strong></td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>LEVEL</strong></td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium"><strong>MODE</strong></td>
            
          </tr>
         @foreach($students as $key=>$student)
         <tr class="border-b border-neutral-200 dark:border-white/10 text-sm">   
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{++$key}}</td>         
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$student->matric}}</td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$student->sname.' '.$student->fname.' '.$student->oname}}</td>         
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$student->mphone}}</td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$student->email}}</td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$student->gender->name}}</td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$student->programme->progdesc}}</td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$student->level}}</td>
            <td class="whitespace-nowrap  px-6 py-2 font-medium">{{$student->mode->name}}</td>
            </td>
            </tr>
            @endforeach                                
            
            <tr><td colspan="10" class="whitespace-nowrap  px-6 py-2 font-medium"> </td></tr>
  
          
        
          
          
        </tbody>
      </table> 
          </div>
          
    </form>
  </x-admin-role>
  