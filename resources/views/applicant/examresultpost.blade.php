<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{$terms[0]->name}} SESSION  - EXAM RESULTS
    </x-slot:heading> 


    <form method="POST" action="{{ route('applicant.exampost') }}" enctype="multipart/form-data">
        @csrf
          <input type="hidden" name="formno" value="{{$formno}}">

        <div class="sm:col-span-3">
            <label for="exam_id" class="block text-sm font-medium leading-6 text-gray-900">Examination</label>
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
          <x-form-error name="exam_id"/>
        
          <div class="sm:col-span-3 mt-3">
            <label for="year" class="block text-sm font-medium leading-6 text-gray-900">Examination Year</label>
            <div class="mt-2">
                <select id="year" name="year" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                
                <option value="0" disabled="disabled" selected>Select Examination Year</option>
                @for($i= 1980 ; $i < 2021; $i++)
                <option value="{{$i}}" >{{$i}}</option>
                @endfor
                
                </select>
            </div>
          </div>
          <x-form-error name="year"/>


          <div class="sm:col-span-3 mt-3">
            <label for="examno" class="block text-sm font-medium leading-6 text-gray-900">Examination No</label>
            <div class="mt-2">
                <input type="examno" name="examno" id="examno" 
                
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>
          <x-form-error name="examno"/>

          <div class="sm:col-span-3 mt-3">
            <label for="center" class="block text-sm font-medium leading-6 text-gray-900">Center/School Name</label>
            <div class="mt-2">
                <input type="center" name="center" id="center" 
                
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>
          <x-form-error name="center"/>

          <div class="sm:col-span-3 mt-3">
            <label for="certificate" class="block text-sm font-medium leading-6 text-gray-900">Upload Certificate(Jpeg or Png. Max File size: 5MB)</label>
            <div class="mt-2">
                <input type="file" name="certificate" id="certificate" 
                
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
          </div>
          <x-form-error name="certificate"/>
        
          <div class="sm:col-span-6 mt-5">
          <table
          class="min-w-full text-left text-sm font-light text-surface dark:text-white">
          <thead
            class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
            <tr>
              
              <th scope="col" colspan="2"  class="px-6 py-4">Enter Result for All Subjects</th>
              
            </tr>
          </thead>
          <tbody> 
            
            @for($i=0; $i < 5; $i++)   
            <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap  px-6 py-4 font-medium">Subject</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                    <select id="subject_id" name="subject_id[]" 
                    class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option value="0" disabled="disabled" selected>Select Subject</option>  
                    @foreach ($subjects as $subject)   
                      <option value="{{$subject->id}}">{{$subject->name}}</option>   
                      @endforeach                      
                    </select>
               </td>
               <td class="whitespace-nowrap  px-6 py-4 font-medium">Grade</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                    <select id="grader_id" name="grader_id[]" 
                    class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option value="0" disabled="disabled" selected>Select Grade</option>  
                      @foreach ($graders as $grader)   
                      <option value="{{$grader->id}}">{{$grader->name}}</option>   
                      @endforeach                      
                    </select>
               </td>     
               </tr>
                @endfor
          </tbody>
          </table>
          </div>
          <x-form-error name="grader_id"/>
          <x-form-error name="subject_id"/>
        
          <div class="flex items-center justify-center mt-8 mb-4">
            
            <a href="/applicant/examresult">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Back</button></a>

            <x-primary-button class="ms-4">
                {{ __('Save and Continue') }}
            </x-primary-button>
        </div>
    </form>
</x-login>
