<x-student-role>
  <x-flash-message/>
  <form method="POST" action="{{route('student.registerCourse')}}">
    @csrf                  
    @foreach($students as $student)
    @endforeach
    <input type="hidden" name="id" value="{{Auth::user()->id}}">
    <input type="hidden" name="programme_id" value="{{$student->programme_id}}">
    <input type="hidden" name="matric" value="{{$student->matric}}">
    <input type="hidden" name="term" value="{{$term}}">
    <input type="hidden" name="level" value="{{$student->level}}">
    <input type="hidden" name="semester" value="{{$semester}}">
                  
                      

    <div>
      <table
      class="min-w-full text-left text-sm font-light text-surface dark:text-white">
      <thead
        class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
        <tr>
          
          <th scope="col" colspan="2"  class="px-6 py-4 text-base">COURSE REGISTRATION CONSOLE </th>
          
        </tr>
      </thead>
      <tbody>
              
         <tr class="border-b border-neutral-600 dark:border-black/10">        
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Matric</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
            {{$student->matric}}
          </td>       
        </tr>

        <tr class="border-b border-neutral-600 dark:border-black/10">        
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
            {{$student->sname}}, {{$student->fname}} {{$student->oname}}
          </td>       
        </tr>

        <tr class="border-b border-neutral-600 dark:border-black/10">        
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Programme</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
            {{$student->programme->progdesc}} 
          </td>       
        </tr>


        <tr class="border-b border-neutral-600 dark:border-black/10">        
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Level</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
            {{$student->level}} 
          </td>       
        </tr>


        <tr class="border-b border-neutral-600 dark:border-black/10">        
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Session</td>
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
            {{$term}}  
          </td>       
        </tr>

        <tr class="border-b border-neutral-600 dark:border-black/10">        
          <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Semester</td>
          <td class="border border-black-300whitespace-nowrap  px-6 py-4 font-medium">
            {{$semester}}
          </td>       
        </tr>

        
      </tbody>
    </table> 


    <table class="table table-striped table-hover table-bordered table-condensed min-w-full">
      <thead>

      <tr align="left" class="border-b border-neutral-600 dark:border-black/10">
       <th class="border border-black-300 whitespace-nowrap  px-6 py-1 text-base">S/N</th>
       <th class="border border-black-300 whitespace-nowrap  px-6 py-4 text-base">COURSE CODE</th>             
       <th class="border border-black-300 whitespace-nowrap  px-5 py-4 text-base">COURSE DESCRIPTION</th>                         
       <th class="border border-black-300whitespace-nowrap  px-6 py-1 text-base">REMARK</th>
       <th class="border border-black-300 whitespace-nowrap  px-6 py-1 text-base">UNIT</th>
       <th class="border border-black-300 whitespace-nowrap  px-2 py-2 text-base">ACTION</th>             
         
      </tr>
</thead>
       <tbody>                                                                   
       <?php $num=1?>
       
       
       @foreach($courses as $course)
       <tr class="id{{$course->id}} border-b border-neutral-600 dark:border-black/10">
       <td class="border border-black-300 whitespace-nowrap  px-5 py-1 text-base">{{$num++}}</td>
       <td class="border border-black-300 whitespace-nowrap  px-6 py-1 text-base">{{$course->crsid}}</td>
       <td class="border border-black-300 pwhitespace-nowrap px-6 py-1 text-base">{{$course->crsdesc}}</td>                         
       <td class="border border-black-300 whitespace-nowrap  px-6 py-1 text-base">{{$course->remark}}</td>
       <td class="border border-black-300 whitespace-nowrap  px-6 py-1 text-base">{{$course->unit}}            
        </td>
       <td class="border border-black-300 whitespace-nowrap  px-6 py-1 text-base"><input type="checkbox" name="crsid[]" value="{{$course->id}}"></td>
                           

       </tr>
       @endforeach
       <tr><td colspan="4" align="right">Total</td><td colspan="2" align="left"><span id="sum">0</span></td></tr>
       </tbody>
       </table>
    </div>

    <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">

        <x-form-button> Register </x-form-button>
      </div>
      
</form>
  
</x-student-role>