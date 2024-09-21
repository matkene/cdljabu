<x-student-role>
    
      @csrf                  
      @foreach($students as $student)
      @endforeach
         @foreach($terms as $term)
         @endforeach
                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="programme_id" value="{{$student->programme_id}}">
                        <input type="hidden" name="matric" value="{{$student->matric}}">
                        <input type="hidden" name="term" value="{{$term->name}}">
                        <input type="hidden" name="level" value="{{$student->level}}">
                        <input type="hidden" name="semester" value="{{$semester}}">
                    
                        
  
      <div>
        <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        <thead
          class="border-b border-spacing-2 border-seperate border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
          <tr  class="border-b border-neutral-200 dark:border-white/10">
            
            <th scope="col" colspan="10"  class="px-6 py-4 text-base">FIRST SEMESTER COURSE REGISTRATION </th>
            
          </tr>
        </thead>
        <tbody>
            <tr  class="border-b border-neutral-200 dark:border-white/10">
                <td rowspan="8" width=200 class="border border-black-300">
                <img src="{{asset('passport/'.$student->passport)}}" 
                alt="{{$student->passport}}" height="210" width="200">

                </td>
            </tr>
                
           <tr class="border-b border-spacing-2 border-seperate border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Matric</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$student->matric}}
            </td>       
          </tr>
  
          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Full Name</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$student->sname}}, {{$student->fname}} {{$student->oname}}
            </td>       
          </tr>
  
          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Programme</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$student->programme->progdesc}} 
            </td>       
          </tr>
  
  
          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Level</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$student->level}} 
            </td>       
          </tr>
  
  
          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Session</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$term->name}}  
            </td>       
          </tr>
  
          <tr class="border-b border-neutral-200 dark:border-white/10">        
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">Semester</td>
            <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">
              {{$semester}}
            </td>       
          </tr>
  
          
        </tbody>
      </table> 
  
  
      <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        <thead>
  
        <tr  class="border-b border-neutral-200 dark:border-white/10">
         <th class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">S/N</th>
         <th class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">COURSE CODE</th>             
         <th class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">COURSE DESCRIPTION</th>                         
         <th class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">REMARK</th>
         <th class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">UNIT</th>
         <th class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">ACTION</th>             
           
        </tr>
  </thead>
         <tbody>                                                                   
            <?php $num=1;
            $tounit=0;   
      ?>
      
      @foreach($studentcourses as $result)
      <?php  $tounit =  $tounit + $result->course->unit; ?>
      <tr class="border-b border-neutral-200 dark:border-white/10">
     <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$num++}}</td>
      <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$result->crsid}}</td>
      <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$result->course->crsdesc}}</td>                         
      <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{$result->course->remark}}</td>
      <td class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">{{@$result->course->unit}}</td>                         
      <td class="border border-black-300 col-md-2 text-black font-medium">
          @if($result->status == 0)
             REGISTERED
          @else
             APPROVED
          @endif   
         <input type="hidden" name="crsid[]" value="{{@$result->course->id}}|{{@$result->course->unit}}">
     </td>
      </tr>
      @endforeach
                   
      
      <tr  class="border-b border-neutral-200 dark:border-white/10">
        <td colspan="4" align="right" class="border border-black-300 whitespace-nowrap  px-6 py-4 font-medium">TOTAL UNITS</td><td colspan="2" align="left"><span>{{$tounit}}</span></td></tr>                         
    </tbody>
      </table>
      </div>
  
      <div class="mt-6 flex items-center mb-4 justify-center mr-6 gap-x-6">
  
          <button class="text-base font-semibold leading-6 text-cyan-900" onClick="window.print()">Click to  Print</button>
        </div>
        
  
    
  </x-student-role>