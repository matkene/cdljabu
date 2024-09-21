<x-exam-role>
    @foreach($programmes as $programme)
    @endforeach
    @foreach($schools as $school)
    @endforeach 

    <div>
        @if($level == '100' and $semester == 'First') 
        <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        <thead
        class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
        <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-gray-300 px-4 py-2" colspan="6">
                <img src="{{asset('logo.png')}}" alt="logo" class="h-20 w-30">
            </td>
            
          </tr>

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">DATE:  {{$date}}</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">LEVEL: {{$level}}</td>
            
          </tr>


          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">SESSION: {{$term}}</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">SEMESTER: {{$semester}}</td>
            
          </tr>

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase"colspan="6">COLLEGE:  
                {{$school->name}} ({{$programme->progdesc}}) RESULT SHEET</td>            
            
          </tr>
        </thead>
        <tbody>

        <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">S/N</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">MATRIC/ COURSE</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">PREVIOUS</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">CURRENT</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">COMMULATIVE</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">REMARK</td>
            
            
          </tr>

          <?php $n=1;?>

          @foreach($resutltArray as $resultss)    
          
        <tr class="border-b border-neutral-600 dark:border-black/10">                                              
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$n}}</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{ strtoupper($resultss['sname'])}}, {{strtoupper($resultss['fname'])}} {{strtoupper($resultss['oname'])}}                       
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">

                <tr class="border border-neutral-300 dark:border-black/10">                       
                                                                                                                    
                    @foreach($resultss['results'] as $result) 
                    <?php if($result['gradeids'] == 101){$gradeids ='ABS'; $weighedpoint='ABS';}
                         elseif($result['gradeids'] == 102){$gradeids ='SICK';$weighedpoint='SICK';}
                         else{$gradeids = $result['gradeids']; $weighedpoint=$result['weighedpoint'];}
                    ?>
                    
    
                    
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> {{$result['coursecode']}} </div>
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> {{$result['courseunit']}} </div>
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> {{$gradeids}}  ({{$weighedpoint}}) </div>                    
                                      
                    
                    </td>
                    @endforeach             
                    </tr>
        
            </table>
            </td>
             
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
               <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                      <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TCP </div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TNU</div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                    </td>
               </tr>  
               <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"></div>                             
                   </td>
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"></div>                             
                   </td>
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"></div>
                   </td>
                </tr> 
                </table>                             
                </td>
   
   
               <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                   <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                   <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase">TCP </div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TNU</div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                       </td>
                     </tr>  
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase">{{$resultss['tcp']}}</div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resultss['totalUnits']}}</div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase">{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                       </td>
                     </tr> 
                   </table>                             
               </td>
                   
               <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                   <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                   <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center" >
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TCP </div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TNU</div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                       </td>
                     </tr>  
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase"></div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"></div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"></div>
                       </td>
                     </tr> 
                  </table>                             
               </td>
   
   
               <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                  <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                  <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase">PASS </div>                             
                       </td>
                       <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase">CARRYOVER</div>                             
                       </td>                             
                  </tr>  
                  <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                  @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99)
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase">GS</div>
                  @endif 
                  @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) <= 1.99)
                   <div class="border border-black-300 px-4 py-2 font-medium uppercase">AP</div>
                  @endif                             
                   </td>
               <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                       <div class="border border-black-300 px-4 py-2 font-medium uppercase">
                       @foreach($resultss['res'] as $r) 
                       @if(isset($r['coursecodes'])) 
                       {{$r['coursecodes']}}
                       @endif
                       @endforeach
                       </div>
                                                    
                       </td>
                       
                  </tr> 
                  </table>                             
               </td>
            
            </tr>
            <?php $n++ ?> 
        @endforeach
          </tbody>
        </table>

        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                 <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                 <thead>                                
                  <th class="border border-slate-400 px-4 py-2"colspan="3">KEYS</th>                                   
                  </thead>
                 <tbody>
                  <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">CODE</td=> 
                     <td class="border border-slate-400 px-4 py-2">TITLE</td>
                     <td class="border border-slate-400 px-4 py-2">UNIT</td>
                 </tr>
                 <?php $total_units= 0;?>
                 @foreach($courses as $course)
                    <?php $total_units = $total_units + $course->unit;?>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">{{$course->crsid}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{$course->crsdesc}}</td>
                     <td class="border border-slate-400 px-4 py-2">{{$course->unit}}</td>
                     </tr>
                 @endforeach 
                 <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2" colspan="2">NO OF COURSE TAKEN</td> 
                     <td class="border border-slate-400 px-4 py-2">{{$total_units}}</td>                                    
                     </tr> 
                 </tbody>
                 </table>   
                </td>
                <td class="border border-slate-400 px-4 py-2">
                     <table  class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                     <thead>                                    
                      <th class="border border-slate-400 px-4 py-2" colspan="4">GRADING SYSTEM</th>                                      
                      </thead>                                     
                     <tbody>
                         <tr class="border-b border-neutral-600 dark:border-black/10">
                            <td class="border border-slate-400 px-4 py-2">RANGE OF SCORES</td> 
                             <td class="border border-slate-400 px-4 py-2">WEIGHED POINTS</td>
                             <td class="border border-slate-400 px-4 py-2">LETTER GRADES</td>
                             <td class="border border-slate-400 px-4 py-2">REMARKS</td>
                         </tr>
                         @foreach($grades as $grade)
                    <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">{{$grade->ranges}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{$grade->weighed_point}}</td>
                     <td class="border border-slate-400 px-4 py-2">{{$grade->letter_grade}}</td>
                     <td class="border border-slate-400 px-4 py-2">{{$grade->remark}}</td>
                     </tr>
                 @endforeach  
                     </tbody>
                     </table>   
                    </td>
                 <td class="border border-slate-400 px-4 py-2">
                 <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                 <thead>                                 
                  <th class="border border-slate-400 px-4 py-2" colspan="3">RESULT ANALYSIS</th>                                  
                  </thead>
                 <tbody>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS IN CLASS</td>
                     <td class="border border-slate-400 px-4 py-2">{{$total_number_students}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITHOUT CARRY OVERS</td>
                     <td class="border border-slate-400 px-4 py-2">{{$student_withOutCarryOvers}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                     <td class="border border-slate-400 px-4 py-2">{{$student_withCarryOvers}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                     <td class="border border-slate-400 px-4 py-2">0</td> 
                     <td class="border border-slate-400 px-4 py-2">0%</td>
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">TOTAL NUMBER OF UNIT TAKEN</td> 
                     <td class="border border-slate-400 px-4 py-2" colspan="2">{{$total_units}}</td>                                     
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS THAT ARE ABSENT</td>
                     <td class="border border-slate-400 px-4 py-2" colspan="2">{{$difference}}</td> 
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                     <?php $num=0;?>
                     @foreach($resutltArray as $resultss)
                      @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99)
                      <?php $num++;?>
                      @endif
                     @endforeach
                     <td class="border border-slate-400 px-4 py-2" colspan="2">{{$num}}</td> 
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                     <?php $num=0;?>
                     @foreach($resutltArray as $resultss)
                      @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) <= 1.99)
                      <?php $num++;?>
                      @endif
                     @endforeach
                     <td class="border border-slate-400 px-4 py-2" colspan="2">{{$num}}</td> 
                     </tr>
                 </tbody>
                 </table>   
                </td>
            </tr>
        </table>
        <table class="table-auto w-full bg-white border border-gray-300">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-slate-400 px-4 py-2">
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                            <th class="border border-slate-400 px-4 py-2" colspan="2">STUDENTS WITH GOOD STANDING</th>
                        </thead>
                        <?php // Good Standing > 1.99
                        $num =1;
                        ?>
                        <tbody>
                             @foreach($resutltArray as $resultss)
                             @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99) 
                            <tr>
                                <td class="border border-slate-400 px-4 py-2">{{$num}}</td>
                                <td class="border border-slate-400 px-4 py-2">{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                
                            </tr>
                            <?php $num++;?>
                            @endif
                            
                            @endforeach
                        </tbody> 
                        
                     </table>

                </td>
                <td class="border border-gray-300 px-4 py-2">
                     <table class="table-auto w-full bg-white border border-gray-300">
                     <thead>
                            <th class="border border-slate-400 px-4 py-2" colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                        </thead>
                        <?php // Good Standing > 1.99
                        $num =1;
                        ?>
                        <tbody>
                             @foreach($resutltArray as $resultss)
                             @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) <= 1.99) 
                            <tr class="border-b border-neutral-600 dark:border-black/10">
                                <td class="border border-gray-300 px-4 py-2">{{$num}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                
                            </tr>
                            <?php $num++;?>
                            @endif
                            @endforeach
                        </tbody>  
                        
                     </table>
                </td>
            </tr>
        </table>

        <table class="table-auto w-full bg-white border border-gray-300">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-gray-300 px-4 py-2">
                     <table class="table-auto w-full bg-white border border-gray-300">
                        <thead class="border border-slate-400 px-4 py-2">
                            <th>......................................</th>
                        </thead> 
                        <tbody>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                            <td class="border border-gray-300 px-4 py-2">
                         HOD
                            </td>
                        </tr>
                        </tbody>
                     </table>

                </td>
                <td class="border border-gray-300 px-4 py-2">
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border border-slate-400 px-4 py-2">
                            <th>......................................</th>
                        </thead> 
                        <tbody>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                            <td class="border border-gray-300 px-4 py-2">
                        CENTER SECRETARY
                            </td>
                        </tr>
                        </tbody>
                     </table>

                </td>

                <td class="border border-gray-300 px-4 py-2">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                       <thead class="border border-slate-400 px-4 py-2">
                           <th>......................................</th>
                       </thead> 
                       <tbody>
                       <tr class="border-b border-neutral-600 dark:border-black/10">
                           <td class="border border-gray-300 px-4 py-2">
                       DIRECTOR
                           </td>
                       </tr>
                       </tbody>
                    </table>

               </td>
                 <td class="border border-gray-300 px-4 py-2">
                     <table class="table-auto w-full bg-white border border-gray-300">
                        <thead class="border border-slate-400 px-4 py-2">
                            <th>......................................</th>
                        </thead> 
                        <tbody>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                            <td class="border border-gray-300 px-4 py-2">
                       VICE- CHANCELLOR
                            </td>
                        </tr>
                        </tbody>
                     </table>

                </td>
            </tr>
        </table>

        @endif

        <?php // start ?>
        @if($level == '100' and $semester == 'Second')
        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <thead>
            <tr class="border-b border-neutral-600 dark:border-black/10">
             <td colspan="6"><img src="{{asset('logo.png')}}" alt="logo" class="h-20 w-30"></td>                            
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">DATE: {{$date}}</td>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">LEVEL: {{$level}}</td>                            
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
             <td  class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">SESSION : {{$term}}</td>
             <td  class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">SEMESTER: {{$semester}}</td>                            
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="6">COLLEGE OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
            </tr>
             </thead>
             <tbody> 
             <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">S/N</td>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">MATRIC NO/ COURSE OF RESULT</td>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">PREVIOUS</td>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">CURRENT</td>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">COMMULATIVE</td>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">REMARK</td>                            
            </tr>
             
            <?php $n=1;?>
            
            
             @foreach($resutltArray as $key=>$resultss) 
                                                                
            
            <tr class="border-b border-neutral-600 dark:border-black/10">                                              
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$n}}</td>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{strtoupper($resultss['matric'])}}   {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
             <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">                         
             
               
             <tr class="border-b border-neutral-600 dark:border-black/10">                    
                                                                                                                 
              
             @foreach($resultss['results'] as $result) 
             <?php if($result['gradeids'] == 101){$gradeids ='ABS'; $weighedpoint='ABS';}
                  elseif($result['gradeids'] == 102){$gradeids ='SICK';$weighedpoint='SICK';}
                  else{$gradeids = $result['gradeids']; $weighedpoint=$result['weighedpoint'];}
             ?>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
            <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> {{$result['coursecode']}} </div>
            <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> ({{$result['courseunit']}}) </div>
            <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> {{$gradeids}}  ({{$weighedpoint}}) </div>
                                           
             
             </td>
             @endforeach             
             </tr>           
                
                                                          
             </table>
             </td>
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
             <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
            
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TCP </div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TNU</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                 </td>
               </tr>  
               <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resutltArray2[$key]['tcp']}}</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resutltArray2[$key]['totalUnits']}}</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format($resutltArray2[$key]['tcp']/$resutltArray2[$key]['totalUnits'],2)}}</div>
                 </td>
               </tr> 
            </table>
                                        
                 </td>


                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
             <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TCP </div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TNU</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                 </td>
               </tr>  
               <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resultss['tcp']}}</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resultss['totalUnits']}}</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                 </td>
               </tr> 
             </table>                             
            </td>
             
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
             <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TCP </div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TNU</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                 </td>
               </tr>  
               <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resutltArray3[$key]['tcp']}}</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resutltArray3[$key]['totalUnits']}}</div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2)}}</div>
                 </td>
               </tr> 
            </table>                             
            </td>


            <td class="border border-black-300 px-4 py-2 font-medium uppercase">
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">PASS </div>                             
                 </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">CARRYOVER</div>                             
                 </td>                             
            </tr>  
            <tr class="border-b border-neutral-600 dark:border-black/10">
             <td class="border border-black-300 px-4 py-2 font-medium uppercase">
             @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) > 1.99)
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GS</div>
            @endif 
            @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) <= 1.99)
             <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">AP</div>
            @endif                                
             </td>
                 <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                 <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">
                 
                 
                 @foreach($resultss['res'] as $r) 
                 @if(isset($r['coursecodes'])) 
                 {{$r['coursecodes']}}                                               
                 @endif               
                               
                 @endforeach
                 
                 @if(isset($resultss[$key]['respr']))
                 @foreach($resultss[$key]['respr'] as $respr)                            
                 {{$respr}}                             
                 @endforeach
                 @endif
                 </div>
                                              
                 </td>
                 
            </tr> 
            </table>                             
            </td>                           
                 
                                             
            </tr>
            <?php $n++ ?>  
            @endforeach
                                     
            
             </tbody>
           </table>

           <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                 <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                 <thead>                                
                  <th colspan="3">KEYS</th>                                   
                  </thead>
                 <tbody>
                  <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">CODE</td> 
                     <td class="border border-slate-400 px-4 py-2">TITLE</td>
                     <td class="border border-slate-400 px-4 py-2">UNIT</td>
                 </tr>
                 <?php $total_units= 0;?>
                 @foreach($courses as $course)
                    <?php $total_units = $total_units + $course->unit;?>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">{{$course->crsid}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{$course->crsdesc}}</td>
                     <td class="border border-slate-400 px-4 py-2">{{$course->unit}}</td>
                     </tr>
                 @endforeach 
                 <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2" colspan="2">NO OF COURSE TAKEN</td> 
                     <td class="border border-slate-400 px-4 py-2">{{$total_units}}</td>                                    
                     </tr> 
                 </tbody>
                 </table>   
                </td>
                <td class="border border-slate-400 px-4 py-2">
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                     <thead class="border border-slate-400 px-4 py-2">                                    
                      <th class="border border-slate-400 px-4 py-2" colspan="4">GRADING SYSTEM</th>                                      
                      </thead>                                     
                     <tbody>
                         <tr class="border-b border-neutral-600 dark:border-black/10">
                            <td class="border border-slate-400 px-4 py-2">RANGE OF SCORES</td> 
                             <td class="border border-slate-400 px-4 py-2">WEIGHED POINTS</td>
                             <td class="border border-slate-400 px-4 py-2">LETTER GRADES</td>
                             <td class="border border-slate-400 px-4 py-2">REMARKS</td>
                         </tr>
                         @foreach($grades as $grade)
                       <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">{{$grade->ranges}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{$grade->weighed_point}}</td>
                     <td class="border border-slate-400 px-4 py-2">{{$grade->letter_grade}}</td>
                     <td class="border border-slate-400 px-4 py-2">{{$grade->remark}}</td>
                     </tr>
                 @endforeach  
                     </tbody>
                     </table>   
                    </td>
                 <td class="border border-slate-400 px-4 py-2">
                 <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                 <thead>                                 
                  <th class="border border-slate-400 px-4 py-2" colspan="3">RESULT ANALYSIS</th>                                  
                  </thead>
                 <tbody>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS IN CLASS</td>
                     <td class="border border-slate-400 px-4 py-2">{{$total_number_students}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                     </tr>
                     <tr>
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITHOUT CARRY OVERS</td>
                     <td class="border border-slate-400 px-4 py-2">{{$student_withOutCarryOvers}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                     <td class="border border-slate-400 px-4 py-2">{{$student_withCarryOvers}}</td> 
                     <td class="border border-slate-400 px-4 py-2">{{number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                     <td class="border border-slate-400 px-4 py-2">0</td> 
                     <td class="border border-slate-400 px-4 py-2">0%</td>
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">TOTAL NUMBER OF UNIT TAKEN</td> 
                     <td class="border border-slate-400 px-4 py-2" colspan="2">{{$total_units}}</td>                                     
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS THAT ARE ABSENT</td>
                     <td class="border border-slate-400 px-4 py-2" colspan="2">{{$difference}}</td> 
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                     <?php $num=0;?>
                     
                     @foreach($resutltArray as $key=>$resultss)
                     @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) > 1.99)
                      
                      <?php $num++;?>
                      @endif
                     @endforeach
                     <td class="border border-slate-400 px-4 py-2" colspan="2">{{$num}}</td> 
                     </tr>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                     <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                     <?php $num=0;?>
                     
                     @foreach($resutltArray as $key=>$resultss)
                     @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) <= 1.99)
                     
                      <?php $num++;?>
                      @endif
                     @endforeach
                     <td class="border border-slate-400 px-4 py-2" colspan="2">{{$num}}</td> 
                     </tr>
                 </tbody>
                 </table>   
                </td>
            </tr>
        </table>
        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-slate-400 px-4 py-2">>
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                            <th class="border border-slate-400 px-4 py-2">S/N</th>
                            <th class="border border-slate-400 px-4 py-2">MATRIC NO</th>
                            <th class="border border-slate-400 px-4 py-2">NAME</th>
                            <th class="border border-slate-400 px-4 py-2">PREVIOUS CARRY OVERS</th>
                        </thead>
                        <?php 
                        $num =1;
                        ?>
                        <tbody>
                             @foreach($resutltArray2 as $resultss)
                             @foreach($resultss['resultpre'] as $result) 
                             @if($result['gradeids'] < 40)                                         
                            <tr class="border-b border-neutral-600 dark:border-black/10">
                                <td class="border border-slate-400 px-4 py-2">{{$num}}</td>
                                <td class="border border-slate-400 px-4 py-2">{{strtoupper($resultss['matric'])}} </td>
                                <td class="border border-slate-400 px-4 py-2">{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                <td class="border border-slate-400 px-4 py-2"> 
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                            @foreach($resultss['respr'] as $r)  
                                            @if(isset($r['coursecodes'])) 
                                        <tr class="border-b border-neutral-600 dark:border-black/10">
                                        <td class="border border-slate-400 px-4 py-2">{{$r['coursecodes']}} </td>
                                        <td class="border border-slate-400 px-4 py-2">{{$r['levelss']}}</td> 
                                        <td class="border border-slate-400 px-4 py-2">{{$r['semesterss']}}</td>
                                        <td class="border border-slate-400 px-4 py-2">{{$r['sessionnamess']}}</td>    
                                        </tr>
                                        @endif 
                                        @endforeach 
                                    </table>                                                                                                           
                                </td>
                                
                            </tr>
                            <?php $num++;?>
                            @endif 
                            @endforeach
                            @endforeach
                           
                            
                            
                            
                            
                        </tbody> 
                        
                     </table>                          
                     
                </td>
            </tr>
        </table>

        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-slate-400 px-4 py-2">
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                            <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                        </thead>
                        <?php // Good Standing > 1.99
                        $num =1;
                        ?>
                        <tbody>
                            @foreach($resutltArray as $key=>$resultss)
                            @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) > 1.99) 
                            <tr class="border-b border-neutral-600 dark:border-black/10">
                                <td class="border border-slate-400 px-4 py-2">{{$num}}</td>
                                <td class="border border-slate-400 px-4 py-2">{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                
                            </tr>
                            <?php $num++;?>
                            @endif
                            
                            @endforeach
                        </tbody> 
                        
                     </table>

                </td>
                <td class="border border-slate-400 px-4 py-2">
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                     <thead class="border border-slate-400 px-4 py-2">>
                            <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                        </thead>
                        <?php // Good Standing > 1.99
                        $num =1;
                        ?>
                        <tbody>
                            @foreach($resutltArray as $key=>$resultss)
                            @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) <= 1.99)
                            <tr class="border-b border-neutral-600 dark:border-black/10">
                                <td class="border border-slate-400 px-4 py-2">{{$num}}</td>
                                <td class="border border-slate-400 px-4 py-2">{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                
                            </tr>
                            <?php $num++;?>
                            @endif
                            @endforeach
                        </tbody>  
                        
                     </table>
                </td>
            </tr>
        </table>

        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-slate-400 px-4 py-2">
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                            <th class="border border-slate-400 px-4 py-2">......................................</th>
                        </thead> 
                        <tbody>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                            <td class="border border-slate-400 px-4 py-2">
                         HOD
                            </td>
                        </tr>
                        </tbody>
                     </table>

                </td>
                <td class="border border-slate-400 px-4 py-2">
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border border-slate-400 px-4 py-2">
                            <th class="border border-slate-400 px-4 py-2">......................................</th>
                        </thead> 
                        <tbody>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                            <td class="border border-slate-400 px-4 py-2">
                        CENTER SECRETARY
                            </td>
                        </tr>
                        </tbody>
                     </table>

                </td>


                <td class="border border-slate-400 px-4 py-2">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                       <thead class="border border-slate-400 px-4 py-2">
                           <th class="border border-slate-400 px-4 py-2">......................................</th>
                       </thead> 
                       <tbody>
                       <tr class="border-b border-neutral-600 dark:border-black/10">
                           <td class="border border-slate-400 px-4 py-2">
                           DIRECTOR
                           </td>
                       </tr>
                       </tbody>
                    </table>

               </td>
                 <td class="border border-slate-400 px-4 py-2">
                     <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border border-slate-400 px-4 py-2">
                            <th class="border border-slate-400 px-4 py-2">......................................</th>
                        </thead> 
                        <tbody>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                            <td class="border border-slate-400 px-4 py-2">
                       VICE-CHANCELLOR
                            </td>
                        </tr>
                        </tbody>
                     </table>

                </td>
            </tr>
        </table>
        @endif


        @if($level == '200' and $semester == 'First')                       
                   
        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <thead>
                <tr class="border-b border-neutral-600 dark:border-black/10">
                    <td colspan="6"><img src="{{asset('logo.png')}}" alt="logo" class="h-20 w-30"></td>                            
                </tr>
               <tr>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">DATE: {{$date}}</td>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">LEVEL: {{$level}}</td>                            
               </tr>
               <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">SESSION : {{$term}}</td>
                <td  class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">SEMESTER: {{$semester}}</td>                            
               </tr>
               <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="6">COLLEGE OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
               </tr>
                </thead>
                <tbody> 
                <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">S/N</td>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">MATRIC NO/ COURSE OF RESULT</td>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">PREVIOUS</td>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">CURRENT</td>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">COMMULATIVE</td>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">REMARK</td>                            
               </tr>
                
               <?php $n=1;?>
               
                @foreach($resutltArray as $key=>$resultss)                         
                                                                    
               
               <tr class="border-b border-neutral-600 dark:border-black/10">                                              
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$n}}</td>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp;&nbsp;  {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">                         
                
                  
                <tr class="border-b border-neutral-600 dark:border-black/10">                       
                                                                                                                    
               
                @foreach($resultss['results'] as $result) 
                <?php if($result['gradeids'] == 101){$gradeids ='ABS'; $weighedpoint='ABS';}
                     elseif($result['gradeids'] == 102){$gradeids ='SICK';$weighedpoint='SICK';}
                     else{$gradeids = $result['gradeids']; $weighedpoint=$result['weighedpoint'];}
                ?>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
               <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> {{$result['coursecode']}} </div>
               <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> ({{$result['courseunit']}}) </div>
               <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center"> {{$gradeids}}  ({{$weighedpoint}}) </div>
                
                                   
                
                </td>
                @endforeach             
                </tr>           
                   
                                                             
                </table>
                </td>
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
               <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TCP </div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TNU</div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                    </td>
                  </tr>  
                  <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
               <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resutltArray3[$key]['tcp']}}</div>                             
               </td>
               <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
               <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resutltArray3[$key]['totalUnits']}}</div>                             
               </td>
               <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
               <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2)}}</div>
               </td>
             </tr> 
               </table>                             
                    </td>


                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TCP </div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TNU</div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                    </td>
                  </tr>  
                  <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resultss['tcp']}}</div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resultss['totalUnits']}}</div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                    </td>
                  </tr> 
                </table>                             
               </td>
                
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">TCP </div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center" >TNU</div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GPA</div>
                    </td>
                  </tr>  
                  <tr class="border-b border-neutral-600 dark:border-black/10">
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resutltArray3[$key]['tcp'] + $resultss['tcp']}}</div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']}}</div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2)}}</div>
                    </td>
                  </tr> 
               </table>                             
               </td>


               <td class="border border-black-300 px-4 py-2 font-medium uppercase">
               <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">PASS </div>                             
                    </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">                         
                    <div>CARRYOVER</div>                             
                    </td>                             
               </tr>  
               <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-black-300 px-4 py-2 font-medium uppercase">
               @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                <div class="border border-black-300 px-4 py-2 font-medium uppercase">GS</div> 
                @endif
                @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99)
                <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">AP</div> 
                @endif                            
                </td>
                    <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                    <div class="border border-black-300 px-4 py-2 font-medium uppercase text-center">
                    @foreach($resultss['res'] as $r) 
                    @if(isset($r['coursecodes'])) 
                    {{$r['coursecodes']}}
                    @endif
                    @endforeach
                    </div>
                                                 
                    </td>
                    
               </tr> 
               </table>                             
               </td>                           
                    
                                                
               </tr>
               <?php $n++ ?>  
               
                @endforeach                 
              
           
               
                </tbody>
              </table>

              <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
               <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td>
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                    <thead>                                
                     <th colspan="3">KEYS</th>                                   
                     </thead>
                    <tbody>
                     <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">CODE</td> 
                        <td class="border border-slate-400 px-4 py-2">TITLE</td>
                        <td class="border border-slate-400 px-4 py-2">UNIT</td>
                    </tr>
                    <?php $total_units= 0;?>
                    @foreach($courses as $course)
                       <?php $total_units = $total_units + $course->unit;?>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">{{$course->crsid}}</td> 
                        <td class="border border-slate-400 px-4 py-2">{{$course->crsdesc}}</td>
                        <td class="border border-slate-400 px-4 py-2">{{$course->unit}}</td>
                        </tr>
                    @endforeach 
                    <tr>
                        <td class="border border-slate-400 px-4 py-2" colspan="2">NO OF COURSE TAKEN</td> 
                        <td class="border border-slate-400 px-4 py-2">{{$total_units}}</td>                                    
                        </tr> 
                    </tbody>
                    </table>   
                   </td>
                   <td class="border border-slate-400 px-4 py-2">
                        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border border-slate-400 px-4 py-2">                                    
                         <th colspan="4">GRADING SYSTEM</th>                                      
                         </thead>                                     
                        <tbody>
                            <tr class="border-b border-neutral-600 dark:border-black/10">
                                <td class="border border-slate-400 px-4 py-2">RANGE OF SCORES</td> 
                                <td class="border border-slate-400 px-4 py-2">WEIGHED POINTS</td>
                                <td class="border border-slate-400 px-4 py-2">LETTER GRADES</td>
                                <td class="border border-slate-400 px-4 py-2">REMARKS</td>
                            </tr>
                            @foreach($grades as $grade)
                          <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">{{$grade->ranges}}</td> 
                        <td class="border border-slate-400 px-4 py-2">{{$grade->weighed_point}}</td>
                        <td class="border border-slate-400 px-4 py-2">{{$grade->letter_grade}}</td>
                        <td class="border border-slate-400 px-4 py-2">{{$grade->remark}}</td>
                        </tr>
                    @endforeach  
                        </tbody>
                        </table>   
                       </td>
                    <td>
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                    <thead>                                 
                     <th class="border border-slate-400 px-4 py-2" colspan="3">RESULT ANALYSIS</th>                                  
                     </thead>
                    <tbody>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS IN CLASS</td>
                        <td class="border border-slate-400 px-4 py-2">{{@$total_number_students}}</td> 
                        <td class="border border-slate-400 px-4 py-2">{{number_format((@$total_number_students * 100) / @$total_number_students,2)}}%</td>
                        </tr>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITHOUT CARRY OVERS</td>
                        <td class="border border-slate-400 px-4 py-2">{{$student_withOutCarryOvers}}</td> 
                        <td class="border border-slate-400 px-4 py-2">{{number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                        </tr>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                        <td class="border border-slate-400 px-4 py-2">{{$student_withCarryOvers}}</td> 
                        <td class="border border-slate-400 px-4 py-2">{{number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                        </tr>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                        <td class="border border-slate-400 px-4 py-2">0</td> 
                        <td class="border border-slate-400 px-4 py-2">0%</td>
                        </tr>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">TOTAL NUMBER OF UNIT TAKEN</td> 
                        <td class="border border-slate-400 px-4 py-2" colspan="2">{{$total_units}}</td>                                     
                        </tr>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS THAT ARE ABSENT</td>
                        <td  class="border border-slate-400 px-4 py-2" colspan="2">{{$difference}}</td> 
                        </tr>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                        <?php $num=0;?>
                        @foreach($resutltArray as $key=>$resultss)
                        @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                         
                         <?php $num++;?>
                         @endif
                        @endforeach
                        <td class="border border-slate-400 px-4 py-2" colspan="2">{{$num}}</td> 
                        </tr>
                        <tr class="border-b border-neutral-600 dark:border-black/10">
                        <td class="border border-slate-400 px-4 py-2">NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                        <?php $num=0;?>
                        @foreach($resutltArray as $key=>$resultss)
                        @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99)
                         
                         <?php $num++;?>
                         @endif
                        @endforeach
                        <td class="border border-slate-400 px-4 py-2" colspan="2">{{$num}}</td> 
                        </tr>
                    </tbody>
                    </table>   
                   </td>
               </tr>
           </table>
           <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
               <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-slate-400 px-4 py-2">
                        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                           <thead>
                               <th class="border border-slate-400 px-4 py-2">S/N</th>
                               <th class="border border-slate-400 px-4 py-2">MATRIC NO</th>
                               <th class="border border-slate-400 px-4 py-2">NAME</th>
                               <th class="border border-slate-400 px-4 py-2">PREVIOUS CARRY OVERS</th>
                           </thead>
                           <?php 
                           $num =1;
                           ?>
                           <tbody>
                                @foreach($resutltArray3 as $resultss)
                                @foreach($resultss['resultcum'] as $result) 
                                @if($result['gradeids'] < 40)                                         
                               <tr class="border-b border-neutral-600 dark:border-black/10">
                                   <td class="border border-slate-400 px-4 py-2">{{$num}}</td>
                                   <td class="border border-slate-400 px-4 py-2">{{strtoupper($resultss['matric'])}} </td>
                                   <td class="border border-slate-400 px-4 py-2">{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                   <td class="border border-slate-400 px-4 py-2"> 
                                       <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                                               @foreach($resultss['res'] as $r)  
                                               @if(isset($r['coursecodes'])) 
                                           <tr class="border-b border-neutral-600 dark:border-black/10">
                                           <td class="border border-slate-400 px-4 py-2">{{$r['coursecodes']}} </td>
                                           <td class="border border-slate-400 px-4 py-2">{{$r['levelss']}}</td> 
                                           <td class="border border-slate-400 px-4 py-2">{{$r['semesterss']}}</td>
                                           <td class="border border-slate-400 px-4 py-2">{{$r['sessionnamess']}}</td>    
                                           </tr>
                                           @endif 
                                           @endforeach 
                                       </table>                                                                                                           
                                   </td>
                                   
                               </tr>
                               <?php $num++;?>
                               @endif 
                               @endforeach
                               @endforeach                              
                                                                   
                               
                           </tbody> 
                           
                        </table>                          
                        
                   </td>
               </tr>
           </table>

           <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                <td class="border border-slate-400 px-4 py-2">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                               <th  class="border border-slate-400 px-4 py-2" colspan="2">STUDENTS WITH GOOD STANDING</th>
                           </thead>
                           <?php // Good Standing > 1.99
                           $num =1;
                           ?>
                           <tbody>
                                @foreach($resutltArray as $key=>$resultss)
                                @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                               <tr class="border-b border-neutral-600 dark:border-black/10">
                                   <td class="border border-slate-400 px-4 py-2">{{$num}}</td>
                                   <td class="border border-slate-400 px-4 py-2">{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                   
                               </tr>
                               <?php $num++;?>
                               @endif
                               
                               @endforeach
                           </tbody> 
                           
                        </table>

                   </td>
                   <td class="border border-slate-400 px-4 py-2">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                               <th class="border border-slate-400 px-4 py-2" colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                           </thead>
                           <?php // Good Standing > 1.99
                           $num =1;
                           ?>
                           <tbody>
                                @foreach($resutltArray as $key=>$resultss)
                                @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99) 
                               <tr class="border-b border-neutral-600 dark:border-black/10">
                                   <td class="border border-slate-400 px-4 py-2">{{$num}}</td>
                                   <td class="border border-slate-400 px-4 py-2">{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                   
                               </tr>
                               <?php $num++;?>
                               @endif
                               @endforeach
                           </tbody>  
                           
                        </table>
                   </td>
               </tr>
           </table>

           <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
            <tr class="border-b border-neutral-600 dark:border-black/10">
                   <td class="border border-slate-400 px-4 py-2">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                               <th class="border border-slate-400 px-4 py-2">......................................</th>
                           </thead> 
                           <tbody>
                           <tr class="border-b border-neutral-600 dark:border-black/10">
                               <td class="border border-slate-400 px-4 py-2">
                            HOD
                               </td>
                           </tr>
                           </tbody>
                        </table>

                   </td>
                   <td class="border border-slate-400 px-4 py-2">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                               <th class="border border-slate-400 px-4 py-2">......................................</th>
                           </thead> 
                           <tbody>
                           <tr class="border-b border-neutral-600 dark:border-black/10">
                               <td class="border border-slate-400 px-4 py-2">
                           CENTER SECRETARY
                               </td>
                           </tr>
                           </tbody>
                        </table>

                   </td>

                   <td class="border border-slate-400 px-4 py-2">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead>
                               <th class="border border-slate-400 px-4 py-2">......................................</th>
                           </thead> 
                           <tbody>
                           <tr class="border-b border-neutral-600 dark:border-black/10">
                               <td class="border border-slate-400 px-4 py-2">
                           DIRECTOR
                               </td>
                           </tr>
                           </tbody>
                        </table>

                   </td>
 
                    <td class="border border-slate-400 px-4 py-2">
                        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead>
                               <th class="border border-slate-400 px-4 py-2">......................................</th>
                           </thead> 
                           <tbody>
                           <tr class="border-b border-neutral-600 dark:border-black/10">
                               <td class="border border-slate-400 px-4 py-2">
                          VICE-CHANCELLOR
                               </td>
                           </tr>
                           </tbody>
                        </table>

                   </td>
               </tr>
           </table>
              @endif


    </div>

</x-exam-role>