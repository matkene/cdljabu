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
                <dt class="text-sm font-medium leading-6 text-gray-900">Session </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <select id="term_id" name="term_id" 
                 class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                 <option value="" disabled="disabled" selected>Select Session</option>
                @foreach ($terms as $term)   
                <option value="{{$term->id}}">{{$term->name}}</option>   
                @endforeach
                
                </select>
                  
              </dd>


              <dt class="text-sm font-medium leading-6 text-gray-900">Role </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <select id="role_id" name="role_id" 
                 class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                 <option value="" disabled="disabled" selected>Select Role</option>
                @foreach ($roles as $role)   
                <option value="{{$role->id}}">{{$role->name}}</option>   
                @endforeach
                
                </select>
                  
              </dd>


              <dt class="text-sm font-medium leading-6 text-gray-900">Category </dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <select id="category_id" name="category_id"
                required 
               class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
               <option value="" disabled="disabled" selected>Select Category</option>
              @foreach ($categories as $category)   
              <option value="{{$category->id}}">{{$category->name}}</option>   
              @endforeach
              
              </select>
                
            </dd>


            <dt class="text-sm font-medium leading-6 text-gray-900">Entry Mode </dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <select id="mode_id" name="mode_id"
                required 
               class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
               <option value="" disabled="disabled" selected>Select Mode</option>
              @foreach ($modes as $mode)   
              <option value="{{$mode->id}}">{{$mode->name}}</option>   
              @endforeach
              
              </select>
                
            </dd>




              <dt class="text-sm font-medium leading-6 text-gray-900">Matric</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <x-form-input name="matric" id="matric" placeholder="" required/>
        
                <x-form-error name="matric"/>
            </dd>


            <dt class="text-sm font-medium leading-6 text-gray-900">Surname</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <x-form-input name="sname" id="sname" placeholder="" required/>
        
                <x-form-error name="sname"/>
            </dd>


            
            <dt class="text-sm font-medium leading-6 text-gray-900">First Name</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <x-form-input name="fname" id="fname" placeholder="" required/>
        
                <x-form-error name="fname"/>
            </dd>

            <dt class="text-sm font-medium leading-6 text-gray-900">Other Name</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <x-form-input name="oname" id="oname" placeholder="" required/>
        
                <x-form-error name="oname"/>
            </dd>

            <dt class="text-sm font-medium leading-6 text-gray-900">Gender</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <select id="gender_id" name="gender_id" 
                required
                 class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                 <option value="" disabled="disabled" selected>Select Gender</option>
                @foreach ($genders as $gender)   
                <option value="{{$gender->id}}">{{$gender->name}}</option>   
                @endforeach
                
                </select>
            </dd>

            <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <x-form-input name="mphone" placeholder="" required/>
        
                <x-form-error name="mphone"/>
            </dd>

            <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <x-form-input name="address" placeholder="" required/>
        
                <x-form-error name="address"/>
            </dd>

            <dt class="text-sm font-medium leading-6 text-gray-900">Programme</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <select id="programme_id" name="programme_id" 
                required
                 class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                 <option value="" disabled="disabled" selected>Select Programme</option>
                @foreach ($programmes as $programme)   
                <option value="{{$programme->id}}">{{$programme->progdesc}}</option>   
                @endforeach
                
                </select>
            </dd>


            <dt class="text-sm font-medium leading-6 text-gray-900">Level</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <select name="level" 
                required
                 class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                 <option value="" disabled="disabled" selected>Select Level</option>                  
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>  
                </select> 
                
            </dd>        
            
            
            
            <dt class="text-sm font-medium leading-6 text-gray-900">Email Address</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <x-form-input name="email" placeholder="" required/>
        
                <x-form-error name="email"/>
              
              </dd>


              <dt class="text-sm font-medium leading-6 text-gray-900">Password</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                <x-form-input type='password' name="password" required/>
        
                <x-form-error name="password"/>
              
              </dd>

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
