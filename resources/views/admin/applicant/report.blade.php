<x-admin-role>
  Manage Applications
    <x-slot:heading>
        
    </x-slot:heading>    
    
    <x-flash-message/>
    <form method="POST" action="{{route('admin.applreport')}}">
    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="formno" class="block text-sm font-medium leading-6 text-gray-900">Mode of Entry</label>
          <div class="mt-2">         
            <select id="mode_id" name="mode_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Mode</option>
                  @foreach ($modes as $mode)   
                  <option value="{{$mode->id}}">{{$mode->name}}</option>   
                  @endforeach
                                  
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="gender_id" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
          <div class="mt-2">         
            <select id="gender_id" name="gender_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Gender</option>
                  @foreach ($genders as $gender)   
                  <option value="{{$gender->id}}">{{$gender->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="marital_id" class="block text-sm font-medium leading-6 text-gray-900">Marital Status</label>
          <div class="mt-2">         
            <select id="marital_id" name="marital_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Gender</option>
                  @foreach ($maritals as $marital)   
                  <option value="{{$marital->id}}">{{$marital->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="religion_id" class="block text-sm font-medium leading-6 text-gray-900">Religion</label>
          <div class="mt-2">         
            <select id="religion_id" name="religion_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Gender</option>
                  @foreach ($religions as $religion)   
                  <option value="{{$religion->id}}">{{$religion->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 

    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="relationship_id" class="block text-sm font-medium leading-6 text-gray-900">Relationship</label>
          <div class="mt-2">         
            <select id="relationship_id" name="relationship_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Gender</option>
                  @foreach ($relationships as $relationship)   
                  <option value="{{$relationship->id}}">{{$relationship->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="bloodgroup_id" class="block text-sm font-medium leading-6 text-gray-900">Blood Group</label>
          <div class="mt-2">         
            <select id="bloodgroup_id" name="bloodgroup_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Blood Group</option>
                  @foreach ($bloodgroups as $bloodgroup)   
                  <option value="{{$bloodgroup->id}}">{{$bloodgroup->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="school_id" class="block text-sm font-medium leading-6 text-gray-900">School</label>
          <div class="mt-2">         
            <select id="school_id" name="school_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select School</option>
                  @foreach ($schools as $school)   
                  <option value="{{$school->id}}">{{$school->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="programme_id" class="block text-sm font-medium leading-6 text-gray-900">Programme</label>
          <div class="mt-2">         
            <select id="programme_id" name="programme_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Programme</option>
                  @foreach ($programmes as $programme)   
                  <option value="{{$programme->id}}">{{$programme->progdesc}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="certficate_id" class="block text-sm font-medium leading-6 text-gray-900">Certificate</label>
          <div class="mt-2">         
            <select id="certficate_id" name="certficate_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Certficate</option>
                  @foreach ($certificates as $certificate)   
                  <option value="{{$certificate->id}}">{{$certificate->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="exam_id" class="block text-sm font-medium leading-6 text-gray-900">Exam</label>
          <div class="mt-2">         
            <select id="exam_id" name="exam_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select Exam</option>
                  @foreach ($exams as $exam)   
                  <option value="{{$exam->id}}">{{$exam->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="state_id" class="block text-sm font-medium leading-6 text-gray-900">State</label>
          <div class="mt-2">         
            <select id="state_id" name="state_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select State</option>
                  @foreach ($states as $state)   
                  <option value="{{$state->id}}">{{$state->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="lga_id" class="block text-sm font-medium leading-6 text-gray-900">LGA</label>
          <div class="mt-2">         
            <select id="lga_id" name="lga_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value="0" disabled="disabled" selected>Select LGA</option>
                  @foreach ($lgas as $lga)   
                  <option value="{{$lga->id}}">{{$lga->name}}</option>   
                  @endforeach                                    
                </select>

          </div>
        </div>
    </div> 

    <div class="mt-6 flex items-center justify-center ml-10 gap-x-2">
        <a href="/">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Clear</button></a>

          <x-form-button>Report</x-form-button>
          

        </div>

    </form>
    

    <!-- Tabla -->
    <div class="lg:w-full lg:ml-64 px-6 py-8 text-base text-opacity-100">RECORDS ON REPORTS FOR APPLICATIONS</div>

  <div class="bg-white rounded-lg p-4 shadow-md my-4 max-w-full overflow-x-auto">
  <table class="w-full table-auto border-collapse border border-slate-400">
    <thead>
       <tr class="text-left bg-primary">
          <th
             class="w-1/12 min-w-[60px] border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             S/N
          </th>
          <th
             class="w-1/12 min-w-[140px] border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             Form No
          </th>
          <th
             class="w-1/6 min-w-[200px] border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             Name
          </th>
          <th
             class="w-1/6 min-w-[120px] border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             Email
          </th>
          <th
             class="w-1/6 min-w-[100px]  border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             Phone
          </th>
          <th
             class="w-1/6 min-w-[100px] border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             Programme
          </th>
          <th
             class="w-1/6 min-w-[80px] border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             Sex
          </th>

          <th
             class="w-1/6 min-w-[100px] border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             State
          </th>
          <th
             class="w-1/6 min-w-[160px] border border-slate-300 py-4 px-3 text-sm font-medium text-black lg:py-7 lg:px-4"
             >
             Form Status
          </th>
       </tr>
    </thead>
    <tbody>      
       
        @foreach ($applications as $key=>$appl)
       <tr>
          <td
             class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-sm font-medium"
             >
             {{++$key}}
          </td>
          <td
             class="text-dark border-b border-[#E8E8E8] bg-white dark:border-dark dark:bg-dark-2 dark:text-dark-7 py-5 px-2 text-left text-sm font-medium"
             >
             {{$appl->formno}}
          </td>
          <td
             class="text-dark border-b border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-left text-sm font-medium uppercase"
             >
             {{$appl->sname.' '.$appl->fname.' '.$appl->oname}}
          </td>
          <td
             class="text-dark border-b border-[#E8E8E8] bg-white dark:border-dark dark:bg-dark-2 dark:text-dark-7 py-5 px-2 text-left text-sm font-medium"
             >
             {{$appl->email}}
          </td>
          <td
             class="text-dark border-b border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-left text-sm font-medium"
             >
             {{$appl->mphone}}
          </td>

          <td
             class="text-dark border-b border-[#E8E8E8] bg-white dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-left text-sm font-medium"
             >
             {{$appl->programme->progdesc}}
          </td>
          <td
             class="text-dark border-b border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-left text-sm font-medium"
             >
             {{$appl->gender->name}}
          </td>
          <td
             class="text-dark border-b border-[#E8E8E8] bg-white dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-left text-sm font-medium"
             >
             {{$appl->state->name}}
          </td>
          <td
             class="text-dark border-b border-r border-[#E8E8E8] bg-[#F3F6FF] dark:border-dark dark:bg-dark-2 dark:text-dark-7 py-5 px-2 text-left text-sm font-medium"
             >
             <?php
             if($appl->submitted==1){
              echo 'Submitted';
             }else {
              echo 'Not Submitted';
             }
             ?>
             
          </td>
       </tr>
       @endforeach
       <tr class="border-b border-neutral-200 dark:border-white/10">
        <td class="whitespace-nowrap  px-6 py-4 font-medium" colspan="9">
          Total Record: {{$count}}</td>
      </tr>
    </tbody>
 </table>
</div>

</x-admin-role>
