
@extends('layouts.apps')

@section('content')
<div class="container">
@if(count($errors)>0)
<div class="alert alert-danger">
  @foreach($errors->all() as $error)
  <p>{{$error}}</p>
  @endforeach
</div>
@endif
@if (session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
 @endif
 </div>
<div class="content-wrapper">
<section class="content-header">
        <h1>
           
            <small></small>
        </h1>
    </section>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('student.resultdisplay') }}">
                        {{ csrf_field() }}
                        @foreach($programmes as $programme)
                        @endforeach
                        @foreach($schools as $school)
                        @endforeach
                        
                        <input type="hidden" name="id" value="{{Auth::user()->username}}">
                        @if($level == '100' and $semester == 'First')                       
                            
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <thead>
                        <tr align="center">
                         <td colspan="6">LAGOS STATE COLLEGE OF HEALTH TECHNOLOGY</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">DATE: {{$date}}</td>
                         <td colspan="3" align="right">LEVEL: {{$level}}</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">SESSION : {{$session}}</td>
                         <td colspan="3" align="right">SEMESTER: {{$semester}}</td>                            
                        </tr>
                        <tr align="center">
                         <td colspan="6">SCHOOL OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
                        </tr>
						 </thead>
                         <tbody> 
                         <tr>
                         <td>S/N</td>
                         <td>MATRIC NO/ COURSE OF RESULT</td>
                         <td>PREVIOUS</td>
                         <td>CURRENT</td>
                         <td>COMMULATIVE</td>
                         <td>REMARK</td>                            
                        </tr>
                         
                        <?php $n=1;?>
                        
                         @foreach($resutltArray as $resultss)
                                                                             
                        
                        <tr>                                              
                         <td>{{$n}}</td>
                         <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                         <table class="table table-striped table-hover table-bordered table-condensed">                         
                         
                           
                         <tr>                       
                                                                                                                             
                         @foreach($resultss['results'] as $result) 
                         <?php if($result['gradeids'] == 101){$gradeids ='ABS'; $weighedpoint='ABS';}
                              elseif($result['gradeids'] == 102){$gradeids ='SICK';$weighedpoint='SICK';}
                              else{$gradeids = $result['gradeids']; $weighedpoint=$result['weighedpoint'];}
                         ?>
                         

                         
                         <td>
                        <div align="center"> {{$result['coursecode']}} </div>
                        <div align="center"> ({{$result['courseunit']}}) </div>
                        <div align="center"> {{$gradeids}}  ({{$weighedpoint}}) </div>
                         
                                            
                         
                         </td>
                         @endforeach             
                         </tr>           
                            
                                                                      
                         </table>
                         </td>
                         <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div></div>                             
                             </td>
                             <td>                         
                             <div></div>                             
                             </td>
                             <td>                         
                             <div></div>
                             </td>
                           </tr> 
                        </table>                             
                             </td>


                             <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                         </table>                             
                        </td>
                         
                         <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div></div>                             
                             </td>
                             <td>                         
                             <div></div>                             
                             </td>
                             <td>                         
                             <div></div>
                             </td>
                           </tr> 
                        </table>                             
                        </td>


                        <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                         <td>
                         <div>PASS </div>                             
                             </td>
                             <td>                         
                             <div>CARRYOVER</div>                             
                             </td>                             
                        </tr>  
                        <tr>
                         <td>
                        @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99)
                         <div>GS</div>
                        @endif 
                        @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) <= 1.99)
                         <div>AP</div>
                        @endif                             
                         </td>
                             <td>
                             <div>
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
                       
                       <table class="table table-striped table-hover table-bordered table-condensed">
                           <tr>
                               <td>
                                <table class="table table-striped table-hover table-bordered table-condensed">
                                <thead>                                
                                 <th colspan="3">KEYS</th>                                   
                                 </thead>
                                <tbody>
                                 <tr>
                                    <td>CODE</td> 
                                    <td>TITLE</td>
                                    <td>UNIT</td>
                                </tr>
                                <?php $total_units= 0;?>
                                @foreach($courses as $course)
                                   <?php $total_units = $total_units + $course->unit;?>
                                    <tr>
                                    <td>{{$course->crsid}}</td> 
                                    <td>{{$course->crsdesc}}</td>
                                    <td>{{$course->unit}}</td>
                                    </tr>
                                @endforeach 
                                <tr>
                                    <td colspan="2">NO OF COURSE TAKEN</td> 
                                    <td>{{$total_units}}</td>                                    
                                    </tr> 
                                </tbody>
                                </table>   
                               </td>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>                                    
                                     <th colspan="4">GRADING SYSTEM</th>                                      
                                     </thead>                                     
                                    <tbody>
                                        <tr><td>RANGE OF SCORES</td> 
                                            <td>WEIGHED POINTS</td>
                                            <td>LETTER GRADES</td>
                                            <td>REMARKS</td>
                                        </tr>
                                        @foreach($grades as $grade)
                                      <tr>
                                    <td>{{$grade->ranges}}</td> 
                                    <td>{{$grade->weighed_point}}</td>
                                    <td>{{$grade->letter_grade}}</td>
                                    <td>{{$grade->remark}}</td>
                                    </tr>
                                @endforeach  
                                    </tbody>
                                    </table>   
                                   </td>
                                <td>
                                <table border=1 class="table table-striped table-hover table-bordered table-condensed">
                                <thead>                                 
                                 <th>RESULT ANALYSIS</th>                                  
                                 </thead>
                                <tbody>
                                    <tr>
                                    <td>NO OF STUDENTS IN CLASS</td>
                                    <td>{{$total_number_students}}</td> 
                                    <td>{{number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITHOUT CARRY OVERS</td>
                                    <td>{{$student_withOutCarryOvers}}</td> 
                                    <td>{{number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                                    <td>{{$student_withCarryOvers}}</td> 
                                    <td>{{number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                                    <td>0</td> 
                                    <td>0%</td>
                                    </tr>
                                    <tr>
                                    <td>TOTAL NUMBER OF UNIT TAKEN</td> 
                                    <td colspan="2">{{$total_units}}</td>                                     
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS THAT ARE ABSENT</td>
                                    <td colspan="2">{{$difference}}</td> 
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                                    <?php $num=0;?>
                                    @foreach($resutltArray as $resultss)
                                     @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99)
                                     <?php $num++;?>
                                     @endif
                                    @endforeach
                                    <td colspan="2">{{$num}}</td> 
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                                    <?php $num=0;?>
                                    @foreach($resutltArray as $resultss)
                                     @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) <= 1.99)
                                     <?php $num++;?>
                                     @endif
                                    @endforeach
                                    <td colspan="2">{{$num}}</td> 
                                    </tr>
                                </tbody>
                                </table>   
                               </td>
                           </tr>
                       </table>
                       <table class="table table-striped table-hover table-bordered table-condensed">
                           <tr>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                                       </thead>
                                       <?php // Good Standing > 1.99
                                       $num =1;
                                       ?>
                                       <tbody>
                                            @foreach($resutltArray as $resultss)
                                            @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99) 
                                           <tr>
                                               <td>{{$num}}</td>
                                               <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                               
                                           </tr>
                                           <?php $num++;?>
                                           @endif
                                           
                                           @endforeach
                                       </tbody> 
                                       
                                    </table>

                               </td>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                           <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                                       </thead>
                                       <?php // Good Standing > 1.99
                                       $num =1;
                                       ?>
                                       <tbody>
                                            @foreach($resutltArray as $resultss)
                                            @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) <= 1.99) 
                                           <tr>
                                               <td>{{$num}}</td>
                                               <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                               
                                           </tr>
                                           <?php $num++;?>
                                           @endif
                                           @endforeach
                                       </tbody>  
                                       
                                    </table>
                               </td>
                           </tr>
                       </table>

                       <table class="table table-striped table-hover table-bordered table-condensed">
                           <tr>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th>......................................</th>
                                       </thead> 
                                       <tbody>
                                       <tr>
                                           <td>
                                        PROVOST
                                           </td>
                                       </tr>
                                       </tbody>
                                    </table>

                               </td>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th>......................................</th>
                                       </thead> 
                                       <tbody>
                                       <tr>
                                           <td>
                                       ACADEMIC BOARD SECRETARY / REGISTRAR
                                           </td>
                                       </tr>
                                       </tbody>
                                    </table>

                               </td>
                                <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th>......................................</th>
                                       </thead> 
                                       <tbody>
                                       <tr>
                                           <td>
                                      HEAD OF SCHOOL
                                           </td>
                                       </tr>
                                       </tbody>
                                    </table>

                               </td>
                           </tr>
                       </table>

                       @endif

                       @if($level == '100' and $semester == 'Second')                       
                            
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <thead>
                        <tr align="center">
                         <td colspan="6">LAGOS STATE COLLEGE OF HEALTH TECHNOLOGY</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">DATE: {{$date}}</td>
                         <td colspan="3" align="right">LEVEL: {{$level}}</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">SESSION : {{$session}}</td>
                         <td colspan="3" align="right">SEMESTER: {{$semester}}</td>                            
                        </tr>
                        <tr align="center">
                         <td colspan="6">SCHOOL OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
                        </tr>
						 </thead>
                         <tbody> 
                         <tr>
                         <td>S/N</td>
                         <td>MATRIC NO/ COURSE OF RESULT</td>
                         <td>PREVIOUS</td>
                         <td>CURRENT</td>
                         <td>COMMULATIVE</td>
                         <td>REMARK</td>                            
                        </tr>
                         
                        <?php $n=1;?>
                        
                        
                         @foreach($resutltArray as $key=>$resultss) 
                                                                            
                        
                        <tr>                                              
                         <td>{{$n}}</td>
                         <td>{{strtoupper($resultss['matric'])}}   {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                         <table class="table table-striped table-hover table-bordered table-condensed">                         
                         
                           
                         <tr>                       
                                                                                                                             
                          
                         @foreach($resultss['results'] as $result) 
                         <?php if($result['gradeids'] == 101){$gradeids ='ABS'; $weighedpoint='ABS';}
                              elseif($result['gradeids'] == 102){$gradeids ='SICK';$weighedpoint='SICK';}
                              else{$gradeids = $result['gradeids']; $weighedpoint=$result['weighedpoint'];}
                         ?>
                         <td>
                        <div align="center"> {{$result['coursecode']}} </div>
                        <div align="center"> ({{$result['courseunit']}}) </div>
                        <div align="center"> {{$gradeids}}  ({{$weighedpoint}}) </div>
                         
                                            
                         
                         </td>
                         @endforeach             
                         </tr>           
                            
                                                                      
                         </table>
                         </td>
                         <td align="bottom">
                         
                        <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                        
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray2[$key]['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray2[$key]['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resutltArray2[$key]['tcp']/$resutltArray2[$key]['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                        </table>
                                                    
                             </td>


                             <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                         </table>                             
                        </td>
                         
                         <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray3[$key]['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray3[$key]['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                        </table>                             
                        </td>


                        <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                         <td>
                         <div>PASS </div>                             
                             </td>
                             <td>                         
                             <div>CARRYOVER</div>                             
                             </td>                             
                        </tr>  
                        <tr>
                         <td>
                         @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) > 1.99)
                         <div>GS</div>
                        @endif 
                        @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) <= 1.99)
                         <div>AP</div>
                        @endif                                
                         </td>
                             <td>
                             <div>
                             
                             
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

                       <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                             <table class="table table-striped table-hover table-bordered table-condensed">
                             <thead>                                
                              <th colspan="3">KEYS</th>                                   
                              </thead>
                             <tbody>
                              <tr>
                                 <td>CODE</td> 
                                 <td>TITLE</td>
                                 <td>UNIT</td>
                             </tr>
                             <?php $total_units= 0;?>
                             @foreach($courses as $course)
                                <?php $total_units = $total_units + $course->unit;?>
                                 <tr>
                                 <td>{{$course->crsid}}</td> 
                                 <td>{{$course->crsdesc}}</td>
                                 <td>{{$course->unit}}</td>
                                 </tr>
                             @endforeach 
                             <tr>
                                 <td colspan="2">NO OF COURSE TAKEN</td> 
                                 <td>{{$total_units}}</td>                                    
                                 </tr> 
                             </tbody>
                             </table>   
                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                    
                                  <th colspan="4">GRADING SYSTEM</th>                                      
                                  </thead>                                     
                                 <tbody>
                                     <tr><td>RANGE OF SCORES</td> 
                                         <td>WEIGHED POINTS</td>
                                         <td>LETTER GRADES</td>
                                         <td>REMARKS</td>
                                     </tr>
                                     @foreach($grades as $grade)
                                   <tr>
                                 <td>{{$grade->ranges}}</td> 
                                 <td>{{$grade->weighed_point}}</td>
                                 <td>{{$grade->letter_grade}}</td>
                                 <td>{{$grade->remark}}</td>
                                 </tr>
                             @endforeach  
                                 </tbody>
                                 </table>   
                                </td>
                             <td>
                             <table border=1 class="table table-striped table-hover table-bordered table-condensed">
                             <thead>                                 
                              <th>RESULT ANALYSIS</th>                                  
                              </thead>
                             <tbody>
                                 <tr>
                                 <td>NO OF STUDENTS IN CLASS</td>
                                 <td>{{$total_number_students}}</td> 
                                 <td>{{number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITHOUT CARRY OVERS</td>
                                 <td>{{$student_withOutCarryOvers}}</td> 
                                 <td>{{number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                                 <td>{{$student_withCarryOvers}}</td> 
                                 <td>{{number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                                 <td>0</td> 
                                 <td>0%</td>
                                 </tr>
                                 <tr>
                                 <td>TOTAL NUMBER OF UNIT TAKEN</td> 
                                 <td colspan="2">{{$total_units}}</td>                                     
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS THAT ARE ABSENT</td>
                                 <td colspan="2">{{$difference}}</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                                 <?php $num=0;?>
                                 
                                 @foreach($resutltArray as $key=>$resultss)
                                 @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) > 1.99)
                                  
                                  <?php $num++;?>
                                  @endif
                                 @endforeach
                                 <td colspan="2">{{$num}}</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                                 <?php $num=0;?>
                                 
                                 @foreach($resutltArray as $key=>$resultss)
                                 @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) <= 1.99)
                                 
                                  <?php $num++;?>
                                  @endif
                                 @endforeach
                                 <td colspan="2">{{$num}}</td> 
                                 </tr>
                             </tbody>
                             </table>   
                            </td>
                        </tr>
                    </table>
                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>S/N</th>
                                        <th>MATRIC NO</th>
                                        <th>NAME</th>
                                        <th>PREVIOUS CARRY OVERS</th>
                                    </thead>
                                    <?php 
                                    $num =1;
                                    ?>
                                    <tbody>
                                         @foreach($resutltArray2 as $resultss)
                                         @foreach($resultss['resultpre'] as $result) 
                                         @if($result['gradeids'] < 60)                                         
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} </td>
                                            <td>{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            <td> 
                                                <table class="table table-striped table-hover table-bordered table-condensed">
                                                        @foreach($resultss['respr'] as $r)  
                                                        @if(isset($r['coursecodes'])) 
                                                    <tr>
                                                    <td>{{$r['coursecodes']}} </td>
                                                    <td>{{$r['levelss']}}</td> 
                                                    <td>{{$r['semesterss']}}</td>
                                                    <td>{{$r['sessionnamess']}}</td>    
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

                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                                    </thead>
                                    <?php // Good Standing > 1.99
                                    $num =1;
                                    ?>
                                    <tbody>
                                        @foreach($resutltArray as $key=>$resultss)
                                        @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) > 1.99) 
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            
                                        </tr>
                                        <?php $num++;?>
                                        @endif
                                        
                                        @endforeach
                                    </tbody> 
                                    
                                 </table>

                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>
                                        <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                                    </thead>
                                    <?php // Good Standing > 1.99
                                    $num =1;
                                    ?>
                                    <tbody>
                                        @foreach($resutltArray as $key=>$resultss)
                                        @if(number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2) <= 1.99)
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            
                                        </tr>
                                        <?php $num++;?>
                                        @endif
                                        @endforeach
                                    </tbody>  
                                    
                                 </table>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                     PROVOST
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                    ACADEMIC BOARD SECRETARY / REGISTRAR
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                             <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                   HEAD OF SCHOOL
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                        </tr>
                    </table>
                       @endif                      
                        
                       @if($level == '200' and $semester == 'First')                       
                            
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <thead>
                        <tr align="center">
                         <td colspan="6">LAGOS STATE COLLEGE OF HEALTH TECHNOLOGY</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">DATE: {{$date}}</td>
                         <td colspan="3" align="right">LEVEL: {{$level}}</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">SESSION : {{$session}}</td>
                         <td colspan="3" align="right">SEMESTER: {{$semester}}</td>                            
                        </tr>
                        <tr align="center">
                         <td colspan="6">SCHOOL OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
                        </tr>
						 </thead>
                         <tbody> 
                         <tr>
                         <td>S/N</td>
                         <td>MATRIC NO/ COURSE OF RESULT</td>
                         <td>PREVIOUS</td>
                         <td>CURRENT</td>
                         <td>COMMULATIVE</td>
                         <td>REMARK</td>                            
                        </tr>
                         
                        <?php $n=1;?>
                        
                         @foreach($resutltArray as $key=>$resultss)                         
                                                                             
                        
                        <tr>                                              
                         <td>{{$n}}</td>
                         <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp;&nbsp;  {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                         <table class="table table-striped table-hover table-bordered table-condensed">                         
                         
                           
                         <tr>                       
                                                                                                                             
                        
                         @foreach($resultss['results'] as $result) 
                         <?php if($result['gradeids'] == 101){$gradeids ='ABS'; $weighedpoint='ABS';}
                              elseif($result['gradeids'] == 102){$gradeids ='SICK';$weighedpoint='SICK';}
                              else{$gradeids = $result['gradeids']; $weighedpoint=$result['weighedpoint'];}
                         ?>
                         <td>
                        <div align="center"> {{$result['coursecode']}} </div>
                        <div align="center"> ({{$result['courseunit']}}) </div>
                        <div align="center"> {{$gradeids}}  ({{$weighedpoint}}) </div>
                         
                                            
                         
                         </td>
                         @endforeach             
                         </tr>           
                            
                                                                      
                         </table>
                         </td>
                         <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                        <div>{{$resutltArray3[$key]['tcp']}}</div>                             
                        </td>
                        <td>                         
                        <div>{{$resutltArray3[$key]['totalUnits']}}</div>                             
                        </td>
                        <td>                         
                        <div>{{number_format($resutltArray3[$key]['tcp']/$resutltArray3[$key]['totalUnits'],2)}}</div>
                        </td>
                      </tr> 
                        </table>                             
                             </td>


                             <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                         </table>                             
                        </td>
                         
                         <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray3[$key]['tcp'] + $resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2)}}</div>
                             </td>
                           </tr> 
                        </table>                             
                        </td>


                        <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                         <td>
                         <div>PASS </div>                             
                             </td>
                             <td>                         
                             <div>CARRYOVER</div>                             
                             </td>                             
                        </tr>  
                        <tr>
                         <td>
                        @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                         <div>GS</div> 
                         @endif
                         @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99)
                         <div>AP</div> 
                         @endif                            
                         </td>
                             <td>
                             <div>
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

                       <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                             <table class="table table-striped table-hover table-bordered table-condensed">
                             <thead>                                
                              <th colspan="3">KEYS</th>                                   
                              </thead>
                             <tbody>
                              <tr>
                                 <td>CODE</td> 
                                 <td>TITLE</td>
                                 <td>UNIT</td>
                             </tr>
                             <?php $total_units= 0;?>
                             @foreach($courses as $course)
                                <?php $total_units = $total_units + $course->unit;?>
                                 <tr>
                                 <td>{{$course->crsid}}</td> 
                                 <td>{{$course->crsdesc}}</td>
                                 <td>{{$course->unit}}</td>
                                 </tr>
                             @endforeach 
                             <tr>
                                 <td colspan="2">NO OF COURSE TAKEN</td> 
                                 <td>{{$total_units}}</td>                                    
                                 </tr> 
                             </tbody>
                             </table>   
                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                    
                                  <th colspan="4">GRADING SYSTEM</th>                                      
                                  </thead>                                     
                                 <tbody>
                                     <tr><td>RANGE OF SCORES</td> 
                                         <td>WEIGHED POINTS</td>
                                         <td>LETTER GRADES</td>
                                         <td>REMARKS</td>
                                     </tr>
                                     @foreach($grades as $grade)
                                   <tr>
                                 <td>{{$grade->ranges}}</td> 
                                 <td>{{$grade->weighed_point}}</td>
                                 <td>{{$grade->letter_grade}}</td>
                                 <td>{{$grade->remark}}</td>
                                 </tr>
                             @endforeach  
                                 </tbody>
                                 </table>   
                                </td>
                             <td>
                             <table border=1 class="table table-striped table-hover table-bordered table-condensed">
                             <thead>                                 
                              <th>RESULT ANALYSIS</th>                                  
                              </thead>
                             <tbody>
                                 <tr>
                                 <td>NO OF STUDENTS IN CLASS</td>
                                 <td>{{$total_number_students}}</td> 
                                 <td>{{number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITHOUT CARRY OVERS</td>
                                 <td>{{$student_withOutCarryOvers}}</td> 
                                 <td>{{number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                                 <td>{{$student_withCarryOvers}}</td> 
                                 <td>{{number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                                 <td>0</td> 
                                 <td>0%</td>
                                 </tr>
                                 <tr>
                                 <td>TOTAL NUMBER OF UNIT TAKEN</td> 
                                 <td colspan="2">{{$total_units}}</td>                                     
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS THAT ARE ABSENT</td>
                                 <td colspan="2">{{$difference}}</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                                 <?php $num=0;?>
                                 @foreach($resutltArray as $key=>$resultss)
                                 @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                                  
                                  <?php $num++;?>
                                  @endif
                                 @endforeach
                                 <td colspan="2">{{$num}}</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                                 <?php $num=0;?>
                                 @foreach($resutltArray as $key=>$resultss)
                                 @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99)
                                  
                                  <?php $num++;?>
                                  @endif
                                 @endforeach
                                 <td colspan="2">{{$num}}</td> 
                                 </tr>
                             </tbody>
                             </table>   
                            </td>
                        </tr>
                    </table>
                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>S/N</th>
                                        <th>MATRIC NO</th>
                                        <th>NAME</th>
                                        <th>PREVIOUS CARRY OVERS</th>
                                    </thead>
                                    <?php 
                                    $num =1;
                                    ?>
                                    <tbody>
                                         @foreach($resutltArray3 as $resultss)
                                         @foreach($resultss['resultcum'] as $result) 
                                         @if($result['gradeids'] < 60)                                         
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} </td>
                                            <td>{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            <td> 
                                                <table class="table table-striped table-hover table-bordered table-condensed">
                                                        @foreach($resultss['res'] as $r)  
                                                        @if(isset($r['coursecodes'])) 
                                                    <tr>
                                                    <td>{{$r['coursecodes']}} </td>
                                                    <td>{{$r['levelss']}}</td> 
                                                    <td>{{$r['semesterss']}}</td>
                                                    <td>{{$r['sessionnamess']}}</td>    
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

                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                                    </thead>
                                    <?php // Good Standing > 1.99
                                    $num =1;
                                    ?>
                                    <tbody>
                                         @foreach($resutltArray as $key=>$resultss)
                                         @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            
                                        </tr>
                                        <?php $num++;?>
                                        @endif
                                        
                                        @endforeach
                                    </tbody> 
                                    
                                 </table>

                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>
                                        <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                                    </thead>
                                    <?php // Good Standing > 1.99
                                    $num =1;
                                    ?>
                                    <tbody>
                                         @foreach($resutltArray as $key=>$resultss)
                                         @if(number_format(($resutltArray3[$key]['tcp'] + $resultss['tcp'])/($resutltArray3[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99) 
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            
                                        </tr>
                                        <?php $num++;?>
                                        @endif
                                        @endforeach
                                    </tbody>  
                                    
                                 </table>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                     PROVOST
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                    ACADEMIC BOARD SECRETARY / REGISTRAR
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                             <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                   HEAD OF SCHOOL
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                        </tr>
                    </table>
                       @endif

                       
                       @if($level == '200' and $semester == 'Second')                       
                            
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <thead>
                        <tr align="center">
                         <td colspan="6">LAGOS STATE COLLEGE OF HEALTH TECHNOLOGY</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">DATE: {{$date}}</td>
                         <td colspan="3" align="right">LEVEL: {{$level}}</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">SESSION : {{$session}}</td>
                         <td colspan="3" align="right">SEMESTER: {{$semester}}</td>                            
                        </tr>
                        <tr align="center">
                         <td colspan="6">SCHOOL OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
                        </tr>
						 </thead>
                         <tbody> 
                         <tr>
                         <td>S/N</td>
                         <td>MATRIC NO/ COURSE OF RESULT</td>
                         <td>PREVIOUS</td>
                         <td>CURRENT</td>
                         <td>COMMULATIVE</td>
                         <td>REMARK</td>                            
                        </tr>
                         
                        <?php $n=1;?>
                        
                        
                         @foreach($resutltArray as $key=>$resultss) 
                                                                            
                        
                        <tr>                                              
                         <td>{{$n}}</td>
                         <td>{{strtoupper($resultss['matric'])}}   {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                         <table class="table table-striped table-hover table-bordered table-condensed">                         
                         
                           
                         <tr>                       
                                                                                                                             
                          
                         @foreach($resultss['results'] as $result) 
                         <?php if($result['gradeids'] == 101){$gradeids ='ABS'; $weighedpoint='ABS';}
                              elseif($result['gradeids'] == 102){$gradeids ='SICK';$weighedpoint='SICK';}
                              else{$gradeids = $result['gradeids']; $weighedpoint=$result['weighedpoint'];}
                         ?>
                         <td>
                        <div align="center"> {{$result['coursecode']}} </div>
                        <div align="center"> ({{$result['courseunit']}}) </div>
                        <div align="center"> {{$gradeids}}  ({{$weighedpoint}}) </div>
                         
                                            
                         
                         </td>
                         @endforeach             
                         </tr>           
                            
                                                                      
                         </table>
                         </td>
                         <td align="bottom">
                         
                        <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                        
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray2[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray2[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format(($resutltArray2[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray2[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2)}}</div>
                             </td>
                           </tr> 
                        </table>
                                                    
                             </td>


                             <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                         </table>                             
                        </td>
                         
                         <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray3[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2)}}</div>
                             </td>
                           </tr> 
                        </table>                             
                        </td>


                        <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                         <td>
                         <div>PASS </div>                             
                             </td>
                             <td>                         
                             <div>CARRYOVER</div>                             
                             </td>                             
                        </tr>  
                        <tr>
                         <td>
                         @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) > 1.99)
                         <div>GS</div> 
                         @endif
                         @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) <= 1.99)
                         <div>AP</div> 
                         @endif                             
                         </td>
                             <td>
                             <div>
                             
                             @foreach($resultss['res'] as $keys=>$r) 
                             @if(isset($r['coursecodes'])) 
                             {{$r['coursecodes']}}                             
                             @endif
                             @if(isset($resutltArray2[$keys]['coursecodes'])) 
                              {{$resutltArray2[$keys]['coursecodes']}}
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

                       <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                             <table class="table table-striped table-hover table-bordered table-condensed">
                             <thead>                                
                              <th colspan="3">KEYS</th>                                   
                              </thead>
                             <tbody>
                              <tr>
                                 <td>CODE</td> 
                                 <td>TITLE</td>
                                 <td>UNIT</td>
                             </tr>
                             <?php $total_units= 0;?>
                             @foreach($courses as $course)
                                <?php $total_units = $total_units + $course->unit;?>
                                 <tr>
                                 <td>{{$course->crsid}}</td> 
                                 <td>{{$course->crsdesc}}</td>
                                 <td>{{$course->unit}}</td>
                                 </tr>
                             @endforeach 
                             <tr>
                                 <td colspan="2">NO OF COURSE TAKEN</td> 
                                 <td>{{$total_units}}</td>                                    
                                 </tr> 
                             </tbody>
                             </table>   
                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                    
                                  <th colspan="4">GRADING SYSTEM</th>                                      
                                  </thead>                                     
                                 <tbody>
                                     <tr><td>RANGE OF SCORES</td> 
                                         <td>WEIGHED POINTS</td>
                                         <td>LETTER GRADES</td>
                                         <td>REMARKS</td>
                                     </tr>
                                     @foreach($grades as $grade)
                                   <tr>
                                 <td>{{$grade->ranges}}</td> 
                                 <td>{{$grade->weighed_point}}</td>
                                 <td>{{$grade->letter_grade}}</td>
                                 <td>{{$grade->remark}}</td>
                                 </tr>
                             @endforeach  
                                 </tbody>
                                 </table>   
                                </td>
                             <td>
                             <table border=1 class="table table-striped table-hover table-bordered table-condensed">
                             <thead>                                 
                              <th>RESULT ANALYSIS</th>                                  
                              </thead>
                             <tbody>
                                 <tr>
                                 <td>NO OF STUDENTS IN CLASS</td>
                                 <td>{{$total_number_students}}</td> 
                                 <td>{{number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITHOUT CARRY OVERS</td>
                                 <td>{{$student_withOutCarryOvers}}</td> 
                                 <td>{{number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                                 <td>{{$student_withCarryOvers}}</td> 
                                 <td>{{number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                                 <td>0</td> 
                                 <td>0%</td>
                                 </tr>
                                 <tr>
                                 <td>TOTAL NUMBER OF UNIT TAKEN</td> 
                                 <td colspan="2">{{$total_units}}</td>                                     
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS THAT ARE ABSENT</td>
                                 <td colspan="2">{{$difference}}</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                                 <?php $num=0;?>
                                 @foreach($resutltArray as $key=>$resultss)
                                 @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) > 1.99)
                                  
                                  <?php $num++;?>
                                  @endif
                                 @endforeach
                                 <td colspan="2">{{$num}}</td> 
                                 </tr>
                                 <tr>
                                 <td>NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                                 <?php $num=0;?>
                                 @foreach($resutltArray as $key=>$resultss)
                                 @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) <= 1.99)
                                  
                                  <?php $num++;?>
                                  @endif
                                 @endforeach
                                 <td colspan="2">{{$num}}</td> 
                                 </tr>
                             </tbody>
                             </table>   
                            </td>
                        </tr>
                    </table>
                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>S/N</th>
                                        <th>MATRIC NO</th>
                                        <th>NAME</th>
                                        <th>PREVIOUS CARRY OVERS</th>
                                    </thead>
                                    <?php 
                                    $num =1;
                                    ?>
                                    <tbody>
                                         @foreach($resutltArray6 as $resultss)                                      
                                                                                
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} </td>
                                            <td>{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            <td> 
                                                <table class="table table-striped table-hover table-bordered table-condensed">
                                                        
                                                        @foreach($resultss['resultpre3'] as $result) 
                                                        @if(isset($result['coursecode'])) 
                                                    <tr>
                                                    <td>{{$result['coursecode']}} </td>
                                                    <td>{{$result['levelss']}}</td> 
                                                    <td>{{$result['semesterss']}}</td>
                                                    <td>{{$result['sessionnamess']}}</td>    
                                                    </tr>
                                                    @endif 
                                                    @endforeach                                                                              

                                                    
                                                </table>                                                                                                           
                                            </td>
                                            
                                        </tr>
                                        <?php 
                                    $num++;
                                    ?>                   
                                        
                                    @endforeach                         
                                        
                                                                   
                                                                            
                                        
                                    </tbody> 
                                    
                                 </table>                          
                                 
                            </td>
                        </tr>
                    </table>

                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                                    </thead>
                                    <?php // Good Standing > 1.99
                                    $num =1;
                                    ?>
                                    <tbody>
                                         @foreach($resutltArray as $key=>$resultss)
                                         @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) > 1.99)
                                         
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            
                                        </tr>
                                        <?php $num++;?>
                                        @endif
                                        
                                        @endforeach
                                    </tbody> 
                                    
                                 </table>

                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>
                                        <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                                    </thead>
                                    <?php // Good Standing > 1.99
                                    $num =1;
                                    ?>
                                    <tbody>
                                         @foreach($resutltArray as $key=>$resultss)
                                         @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) <= 1.99)
                                         
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                            
                                        </tr>
                                        <?php $num++;?>
                                        @endif
                                        @endforeach
                                    </tbody>  
                                    
                                 </table>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                     PROVOST
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                            <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                    ACADEMIC BOARD SECRETARY / REGISTRAR
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                             <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                        <th>......................................</th>
                                    </thead> 
                                    <tbody>
                                    <tr>
                                        <td>
                                   HEAD OF SCHOOL
                                        </td>
                                    </tr>
                                    </tbody>
                                 </table>

                            </td>
                        </tr>
                    </table>
                       @endif

                       @if($level == '300' and $semester == 'First')                       
                            
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <thead>
                        <tr align="center">
                         <td colspan="6">LAGOS STATE COLLEGE OF HEALTH TECHNOLOGY</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">DATE: {{$date}}</td>
                         <td colspan="3" align="right">LEVEL: {{$level}}</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">SESSION : {{$session}}</td>
                         <td colspan="3" align="right">SEMESTER: {{$semester}}</td>                            
                        </tr>
                        <tr align="center">
                         <td colspan="6">SCHOOL OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
                        </tr>
						 </thead>
                         <tbody> 
                         <tr>
                         <td>S/N</td>
                         <td>MATRIC NO/ COURSE OF RESULT</td>
                         <td>PREVIOUS</td>
                         <td>CURRENT</td>
                         <td>COMMULATIVE</td>
                         <td>REMARK</td>                            
                        </tr>
                         
                        <?php $n=1;?>
                        
                         @foreach($resutltArray as $key=>$resultss)                         
                                                                             
                        
                        <tr>                                              
                         <td>{{$n}}</td>
                         <td>{{strtoupper($resultss['matric'])}}   {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                         <table class="table table-striped table-hover table-bordered table-condensed">                         
                         
                           
                         <tr>                       
                                                                                                                             
                         @foreach($resultss['results'] as $result) 
                         <td>
                        <div align="center"> {{$result['coursecode']}} </div>
                        <div align="center"> ({{$result['courseunit']}}) </div>
                        <div align="center"> {{$result['gradeids']}}  ({{$result['weighedpoint']}}) </div>
                         
                                            
                         
                         </td>
                         @endforeach             
                         </tr>           
                            
                                                                      
                         </table>
                         </td>
                         <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                        <div>{{$resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp']}}</div>                             
                        </td>
                        <td>                         
                        <div>{{$resutltArray3[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits']}}</div>                             
                        </td>
                        <td>                         
                        <div>{{number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits']),2)}}</div>
                        </td>
                      </tr> 
                        </table>                             
                             </td>


                             <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                         </table>                             
                        </td>
                         
                         <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray3[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2)}}</div>
                             </td>
                           </tr> 
                        </table>                             
                        </td>


                        <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                         <td>
                         <div>PASS </div>                             
                             </td>
                             <td>                         
                             <div>CARRYOVER</div>                             
                             </td>                             
                        </tr>  
                        <tr>
                         <td>
                         @if(number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                         <div>GS</div> 
                         @endif
                         @if(number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99)
                         <div>AP</div>
                         @endif                             
                         </td>
                             <td>
                             <div>
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


                       <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                
                                  <th colspan="3">KEYS</th>                                   
                                  </thead>
                                 <tbody>
                                  <tr>
                                     <td>CODE</td> 
                                     <td>TITLE</td>
                                     <td>UNIT</td>
                                 </tr>
                                 <?php $total_units= 0;?>
                                 @foreach($courses as $course)
                                    <?php $total_units = $total_units + $course->unit;?>
                                     <tr>
                                     <td>{{$course->crsid}}</td> 
                                     <td>{{$course->crsdesc}}</td>
                                     <td>{{$course->unit}}</td>
                                     </tr>
                                 @endforeach 
                                 <tr>
                                     <td colspan="2">NO OF COURSE TAKEN</td> 
                                     <td>{{$total_units}}</td>                                    
                                     </tr> 
                                 </tbody>
                                 </table>   
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                     <thead>                                    
                                      <th colspan="4">GRADING SYSTEM</th>                                      
                                      </thead>                                     
                                     <tbody>
                                         <tr><td>RANGE OF SCORES</td> 
                                             <td>WEIGHED POINTS</td>
                                             <td>LETTER GRADES</td>
                                             <td>REMARKS</td>
                                         </tr>
                                         @foreach($grades as $grade)
                                       <tr>
                                     <td>{{$grade->ranges}}</td> 
                                     <td>{{$grade->weighed_point}}</td>
                                     <td>{{$grade->letter_grade}}</td>
                                     <td>{{$grade->remark}}</td>
                                     </tr>
                                 @endforeach  
                                     </tbody>
                                     </table>   
                                    </td>
                                 <td>
                                 <table border=1 class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                 
                                  <th>RESULT ANALYSIS</th>                                  
                                  </thead>
                                 <tbody>
                                     <tr>
                                     <td>NO OF STUDENTS IN CLASS</td>
                                     <td>{{$total_number_students}}</td> 
                                     <td>{{@number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITHOUT CARRY OVERS</td>
                                     <td>{{$student_withOutCarryOvers}}</td> 
                                     <td>{{@number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                                     <td>{{$student_withCarryOvers}}</td> 
                                     <td>{{@number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                                     <td>0</td> 
                                     <td>0%</td>
                                     </tr>
                                     <tr>
                                     <td>TOTAL NUMBER OF UNIT TAKEN</td> 
                                     <td colspan="2">{{$total_units}}</td>                                     
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS THAT ARE ABSENT</td>
                                     <td colspan="2">{{$difference}}</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                                     <?php $num=0;?>
                                     @foreach($resutltArray as $key=>$resultss)
                                     @if(number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                                      
                                      <?php $num++;?>
                                      @endif
                                     @endforeach
                                     <td colspan="2">{{$num}}</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                                     <?php $num=0;?>
                                     @foreach($resutltArray as $key=>$resultss)
                                     @if(number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99)
                                      
                                      <?php $num++;?>
                                      @endif
                                     @endforeach
                                     <td colspan="2">{{$num}}</td> 
                                     </tr>
                                 </tbody>
                                 </table>   
                                </td>
                            </tr>
                        </table>
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>S/N</th>
                                            <th>MATRIC NO</th>
                                            <th>NAME</th>
                                            <th>PREVIOUS CARRY OVERS</th>
                                        </thead>
                                        <?php 
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray6 as $resultss)                                      
                                                                                    
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} </td>
                                                <td>{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                <td> 
                                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                                            
                                                            @foreach($resultss['resultpre3'] as $result) 
                                                            @if(isset($result['coursecode'])) 
                                                        <tr>
                                                        <td>{{$result['coursecode']}} </td>
                                                        <td>{{$result['levelss']}}</td> 
                                                        <td>{{$result['semesterss']}}</td>
                                                        <td>{{$result['sessionnamess']}}</td>    
                                                        </tr>
                                                        @endif 
                                                        @endforeach                                                                              
    
                                                        
                                                    </table>                                                                                                           
                                                </td>
                                                
                                            </tr>
                                            <?php 
                                        $num++;
                                        ?>                   
                                            
                                        @endforeach                         
                                            
                                                                       
                                                                                
                                            
                                        </tbody> 
                                        
                                     </table>                          
                                     
                                </td>
                            </tr>
                        </table>
    
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                                        </thead>
                                        <?php // Good Standing > 1.99
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray as $key=>$resultss)
                                             @if(number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                                             
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                
                                            </tr>
                                            <?php $num++;?>
                                            @endif
                                            
                                            @endforeach
                                        </tbody> 
                                        
                                     </table>
    
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                     <thead>
                                            <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                                        </thead>
                                        <?php // Good Standing > 1.99
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray as $key=>$resultss)
                                             @if(number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99)
                                             
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                
                                            </tr>
                                            <?php $num++;?>
                                            @endif
                                            @endforeach
                                        </tbody>  
                                        
                                     </table>
                                </td>
                            </tr>
                        </table>
    
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                         PROVOST
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                        ACADEMIC BOARD SECRETARY / REGISTRAR
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                                 <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                       HEAD OF SCHOOL
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                            </tr>
                        </table>
                       @endif

                       @if($level == '300' and $semester == 'Second')                       
                            
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <thead>
                        <tr align="center">
                         <td colspan="6">LAGOS STATE COLLEGE OF HEALTH TECHNOLOGY</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">DATE: {{$date}}</td>
                         <td colspan="3" align="right">LEVEL: {{$level}}</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">SESSION : {{$session}}</td>
                         <td colspan="3" align="right">SEMESTER: {{$semester}}</td>                            
                        </tr>
                        <tr align="center">
                         <td colspan="6">SCHOOL OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
                        </tr>
						 </thead>
                         <tbody> 
                         <tr>
                         <td>S/N</td>
                         <td>MATRIC NO/ COURSE OF RESULT</td>
                         <td>PREVIOUS</td>
                         <td>CURRENT</td>
                         <td>COMMULATIVE</td>
                         <td>REMARK</td>                            
                        </tr>
                         
                        <?php $n=1;?>
                        
                        
                         @foreach($resutltArray as $key=>$resultss) 
                                                                            
                        
                        <tr>                                              
                         <td>{{$n}}</td>
                         <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp;&nbsp;   {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                         <table class="table table-striped table-hover table-bordered table-condensed">                         
                         
                           
                         <tr>                       
                                                                                                                             
                         @foreach($resultss['results'] as $result) 
                         <td>
                        <div align="center"> {{$result['coursecode']}} </div>
                        <div align="center"> ({{$result['courseunit']}}) </div>
                        <div align="center"> {{$result['gradeids']}}  ({{$result['weighedpoint']}}) </div>
                         
                                            
                         
                         </td>
                         @endforeach             
                         </tr>           
                            
                                                                      
                         </table>
                         </td>
                         <td align="bottom">
                         
                        <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                        
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray2[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray2[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format(($resutltArray2[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray2[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2)}}</div>
                             </td>
                           </tr> 
                        </table>
                                                    
                             </td>


                             <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                         </table>                             
                        </td>
                         
                         <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray3[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2)}}</div>
                             </td>
                           </tr> 
                        </table>                             
                        </td>


                        <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                         <td>
                         <div>PASS </div>                             
                             </td>
                             <td>                         
                             <div>CARRYOVER</div>                             
                             </td>                             
                        </tr>  
                        <tr>
                         <td>
                         @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) > 1.99)
                         <div>GS</div> 
                         @endif
                         @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) <= 1.99)
                         <div>AP</div>
                         @endif                              
                         </td>
                             <td>
                             <div>
                             
                             @foreach($resultss['res'] as $keys=>$r) 
                             @if(isset($r['coursecodes'])) 
                             {{$r['coursecodes']}}                             
                             @endif
                             @if(isset($resutltArray2[$keys]['coursecodes'])) 
                              {{$resutltArray2[$keys]['coursecodes']}}
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

                       <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                
                                  <th colspan="3">KEYS</th>                                   
                                  </thead>
                                 <tbody>
                                  <tr>
                                     <td>CODE</td> 
                                     <td>TITLE</td>
                                     <td>UNIT</td>
                                 </tr>
                                 <?php $total_units= 0;?>
                                 @foreach($courses as $course)
                                    <?php $total_units = $total_units + $course->unit;?>
                                     <tr>
                                     <td>{{$course->crsid}}</td> 
                                     <td>{{$course->crsdesc}}</td>
                                     <td>{{$course->unit}}</td>
                                     </tr>
                                 @endforeach 
                                 <tr>
                                     <td colspan="2">NO OF COURSE TAKEN</td> 
                                     <td>{{$total_units}}</td>                                    
                                     </tr> 
                                 </tbody>
                                 </table>   
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                     <thead>                                    
                                      <th colspan="4">GRADING SYSTEM</th>                                      
                                      </thead>                                     
                                     <tbody>
                                         <tr><td>RANGE OF SCORES</td> 
                                             <td>WEIGHED POINTS</td>
                                             <td>LETTER GRADES</td>
                                             <td>REMARKS</td>
                                         </tr>
                                         @foreach($grades as $grade)
                                       <tr>
                                     <td>{{$grade->ranges}}</td> 
                                     <td>{{$grade->weighed_point}}</td>
                                     <td>{{$grade->letter_grade}}</td>
                                     <td>{{$grade->remark}}</td>
                                     </tr>
                                 @endforeach  
                                     </tbody>
                                     </table>   
                                    </td>
                                 <td>
                                 <table border=1 class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                 
                                  <th>RESULT ANALYSIS</th>                                  
                                  </thead>
                                 <tbody>
                                     <tr>
                                     <td>NO OF STUDENTS IN CLASS</td>
                                     <td>{{$total_number_students}}</td> 
                                     <td>{{@number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITHOUT CARRY OVERS</td>
                                     <td>{{$student_withOutCarryOvers}}</td> 
                                     <td>{{@number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                                     <td>{{$student_withCarryOvers}}</td> 
                                     <td>{{@number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                                     <td>0</td> 
                                     <td>0%</td>
                                     </tr>
                                     <tr>
                                     <td>TOTAL NUMBER OF UNIT TAKEN</td> 
                                     <td colspan="2">{{$total_units}}</td>                                     
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS THAT ARE ABSENT</td>
                                     <td colspan="2">{{$difference}}</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                                     <?php $num=0;?>
                                     @foreach($resutltArray as $key=>$resultss)
                                     @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) > 1.99)
                                     <?php $num++;?>
                                      @endif
                                     @endforeach
                                     <td colspan="2">{{$num}}</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                                     <?php $num=0;?>
                                     @foreach($resutltArray as $key=>$resultss)
                                     @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) <= 1.99)
                                    
                                      <?php $num++;?>
                                      @endif
                                     @endforeach
                                     <td colspan="2">{{$num}}</td> 
                                     </tr>
                                 </tbody>
                                 </table>   
                                </td>
                            </tr>
                        </table>
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>S/N</th>
                                            <th>MATRIC NO</th>
                                            <th>NAME</th>
                                            <th>PREVIOUS CARRY OVERS</th>
                                        </thead>
                                        <?php 
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray6 as $resultss)                                      
                                                                                    
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} </td>
                                                <td>{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                <td> 
                                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                                            
                                                            @foreach($resultss['resultpre3'] as $result) 
                                                            @if(isset($result['coursecode'])) 
                                                        <tr>
                                                        <td>{{$result['coursecode']}} </td>
                                                        <td>{{$result['levelss']}}</td> 
                                                        <td>{{$result['semesterss']}}</td>
                                                        <td>{{$result['sessionnamess']}}</td>    
                                                        </tr>
                                                        @endif 
                                                        @endforeach                                                                              
    
                                                        
                                                    </table>                                                                                                           
                                                </td>
                                                
                                            </tr>
                                            <?php 
                                        $num++;
                                        ?>                   
                                            
                                        @endforeach                         
                                            
                                                                       
                                                                                
                                            
                                        </tbody> 
                                        
                                     </table>                          
                                     
                                </td>
                            </tr>
                        </table>
    
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                                        </thead>
                                        <?php // Good Standing > 1.99
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray as $key=>$resultss)
                                             @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) > 1.99)
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                
                                            </tr>
                                            <?php $num++;?>
                                            @endif
                                            
                                            @endforeach
                                        </tbody> 
                                        
                                     </table>
    
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                     <thead>
                                            <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                                        </thead>
                                        <?php // Good Standing > 1.99
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray as $key=>$resultss)
                                             @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) <= 1.99)
                         
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                
                                            </tr>
                                            <?php $num++;?>
                                            @endif
                                            @endforeach
                                        </tbody>  
                                        
                                     </table>
                                </td>
                            </tr>
                        </table>
    
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                         PROVOST
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                        ACADEMIC BOARD SECRETARY / REGISTRAR
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                                 <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                       HEAD OF SCHOOL
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                            </tr>
                        </table>
                       @endif

                       @if($level == '400' and $semester == 'First')                       
                            
                       <table class="table table-striped table-hover table-bordered table-condensed">
                       <thead>
                       <tr align="center">
                        <td colspan="6">LAGOS STATE COLLEGE OF HEALTH TECHNOLOGY</td>                            
                       </tr>
                       <tr>
                        <td colspan="3">DATE: {{$date}}</td>
                        <td colspan="3" align="right">LEVEL: {{$level}}</td>                            
                       </tr>
                       <tr>
                        <td colspan="3">SESSION : {{$session}}</td>
                        <td colspan="3" align="right">SEMESTER: {{$semester}}</td>                            
                       </tr>
                       <tr align="center">
                        <td colspan="6">SCHOOL OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
                       </tr>
                        </thead>
                        <tbody> 
                        <tr>
                        <td>S/N</td>
                        <td>MATRIC NO/ COURSE OF RESULT</td>
                        <td>PREVIOUS</td>
                        <td>CURRENT</td>
                        <td>COMMULATIVE</td>
                        <td>REMARK</td>                            
                       </tr>
                        
                       <?php $n=1;?>
                       
                        @foreach($resutltArray as $key=>$resultss)                         
                                                                            
                       
                       <tr>                                              
                        <td>{{$n}}</td>
                        <td>{{strtoupper($resultss['matric'])}}   {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                        <table class="table table-striped table-hover table-bordered table-condensed">                         
                        
                          
                        <tr>                       
                                                                                                                            
                        @foreach($resultss['results'] as $result) 
                        <td>
                       <div align="center"> {{$result['coursecode']}} </div>
                       <div align="center"> ({{$result['courseunit']}}) </div>
                       <div align="center"> {{$result['gradeids']}}  ({{$result['weighedpoint']}}) </div>
                        
                                           
                        
                        </td>
                        @endforeach             
                        </tr>           
                           
                                                                     
                        </table>
                        </td>
                        <td align="bottom">
                       <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                        <td>
                        <div>TCP </div>                             
                            </td>
                            <td>                         
                            <div>TNU</div>                             
                            </td>
                            <td>                         
                            <div>GPA</div>
                            </td>
                          </tr>  
                          <tr>
                        <td>
                       <div>{{$resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp']}}</div>                             
                       </td>
                       <td>                         
                       <div>{{$resutltArray3[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits']}}</div>                             
                       </td>
                       <td>                         
                       <div>{{number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits']),2)}}</div>
                       </td>
                     </tr> 
                       </table>                             
                            </td>


                            <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                        <td>
                        <div>TCP </div>                             
                            </td>
                            <td>                         
                            <div>TNU</div>                             
                            </td>
                            <td>                         
                            <div>GPA</div>
                            </td>
                          </tr>  
                          <tr>
                        <td>
                        <div>{{$resultss['tcp']}}</div>                             
                            </td>
                            <td>                         
                            <div>{{$resultss['totalUnits']}}</div>                             
                            </td>
                            <td>                         
                            <div>{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                            </td>
                          </tr> 
                        </table>                             
                       </td>
                        
                        <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                        <td>
                        <div>TCP </div>                             
                            </td>
                            <td>                         
                            <div>TNU</div>                             
                            </td>
                            <td>                         
                            <div>GPA</div>
                            </td>
                          </tr>  
                          <tr>
                        <td>
                        <div>{{$resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resultss['tcp']}}</div>                             
                            </td>
                            <td>                         
                            <div>{{$resutltArray3[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']}}</div>                             
                            </td>
                            <td>                         
                            <div>{{number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2)}}</div>
                            </td>
                          </tr> 
                       </table>                             
                       </td>


                       <td align="bottom">
                       <table class="table table-striped table-hover table-bordered table-condensed">
                       <tr>
                        <td>
                        <div>PASS </div>                             
                            </td>
                            <td>                         
                            <div>CARRYOVER</div>                             
                            </td>                             
                       </tr>  
                       <tr>
                        <td>
                        @if(number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2) > 1.99)
                        <div>GS</div> 
                        @endif
                        @if(number_format(($resutltArray3[$key]['tcp']+ $resutltArray4[$key]['tcp'] +  $resultss['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resultss['totalUnits']),2) <= 1.99)
                        <div>AP</div>
                        @endif                             
                        </td>
                            <td>
                            <div>
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


                      <table class="table table-striped table-hover table-bordered table-condensed">
                           <tr>
                               <td>
                                <table class="table table-striped table-hover table-bordered table-condensed">
                                <thead>                                
                                 <th colspan="3">KEYS</th>                                   
                                 </thead>
                                <tbody>
                                 <tr>
                                    <td>CODE</td> 
                                    <td>TITLE</td>
                                    <td>UNIT</td>
                                </tr>
                                <?php $total_units= 0;?>
                                @foreach($courses as $course)
                                   <?php $total_units = $total_units + $course->unit;?>
                                    <tr>
                                    <td>{{$course->crsid}}</td> 
                                    <td>{{$course->crsdesc}}</td>
                                    <td>{{$course->unit}}</td>
                                    </tr>
                                @endforeach 
                                <tr>
                                    <td colspan="2">NO OF COURSE TAKEN</td> 
                                    <td>{{$total_units}}</td>                                    
                                    </tr> 
                                </tbody>
                                </table>   
                               </td>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>                                    
                                     <th colspan="4">GRADING SYSTEM</th>                                      
                                     </thead>                                     
                                    <tbody>
                                        <tr><td>RANGE OF SCORES</td> 
                                            <td>WEIGHED POINTS</td>
                                            <td>LETTER GRADES</td>
                                            <td>REMARKS</td>
                                        </tr>
                                        @foreach($grades as $grade)
                                      <tr>
                                    <td>{{$grade->ranges}}</td> 
                                    <td>{{$grade->weighed_point}}</td>
                                    <td>{{$grade->letter_grade}}</td>
                                    <td>{{$grade->remark}}</td>
                                    </tr>
                                @endforeach  
                                    </tbody>
                                    </table>   
                                   </td>
                                <td>
                                <table border=1 class="table table-striped table-hover table-bordered table-condensed">
                                <thead>                                 
                                 <th>RESULT ANALYSIS</th>                                  
                                 </thead>
                                <tbody>
                                    <tr>
                                    <td>NO OF STUDENTS IN CLASS</td>
                                    <td>{{$total_number_students}}</td> 
                                    <td>{{@number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITHOUT CARRY OVERS</td>
                                    <td>{{$student_withOutCarryOvers}}</td> 
                                    <td>{{@number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                                    <td>{{$student_withCarryOvers}}</td> 
                                    <td>{{@number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                                    <td>0</td> 
                                    <td>0%</td>
                                    </tr>
                                    <tr>
                                    <td>TOTAL NUMBER OF UNIT TAKEN</td> 
                                    <td colspan="2">{{$total_units}}</td>                                     
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS THAT ARE ABSENT</td>
                                    <td colspan="2">{{$difference}}</td> 
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                                    <?php $num=0;?>
                                    @foreach($resutltArray as $resultss)
                                     @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99)
                                     <?php $num++;?>
                                     @endif
                                    @endforeach
                                    <td colspan="2">{{$num}}</td> 
                                    </tr>
                                    <tr>
                                    <td>NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                                    <?php $num=0;?>
                                    @foreach($resutltArray as $resultss)
                                     @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) <= 1.99)
                                     <?php $num++;?>
                                     @endif
                                    @endforeach
                                    <td colspan="2">{{$num}}</td> 
                                    </tr>
                                </tbody>
                                </table>   
                               </td>
                           </tr>
                       </table>
                       <table class="table table-striped table-hover table-bordered table-condensed">
                           <tr>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th>S/N</th>
                                           <th>MATRIC NO</th>
                                           <th>NAME</th>
                                           <th>PREVIOUS CARRY OVERS</th>
                                       </thead>
                                       <?php 
                                       $num =1;
                                       ?>
                                       <tbody>
                                            @foreach($resutltArray6 as $resultss)                                      
                                                                                   
                                           <tr>
                                               <td>{{$num}}</td>
                                               <td>{{strtoupper($resultss['matric'])}} </td>
                                               <td>{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                               <td> 
                                                   <table class="table table-striped table-hover table-bordered table-condensed">
                                                           
                                                           @foreach($resultss['resultpre3'] as $result) 
                                                           @if(isset($result['coursecode'])) 
                                                       <tr>
                                                       <td>{{$result['coursecode']}} </td>
                                                       <td>{{$result['levelss']}}</td> 
                                                       <td>{{$result['semesterss']}}</td>
                                                       <td>{{$result['sessionnamess']}}</td>    
                                                       </tr>
                                                       @endif 
                                                       @endforeach                                                                              
   
                                                       
                                                   </table>                                                                                                           
                                               </td>
                                               
                                           </tr>
                                           <?php 
                                       $num++;
                                       ?>                   
                                           
                                       @endforeach                         
                                           
                                                                      
                                                                               
                                           
                                       </tbody> 
                                       
                                    </table>                          
                                    
                               </td>
                           </tr>
                       </table>
   
                       <table class="table table-striped table-hover table-bordered table-condensed">
                           <tr>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                                       </thead>
                                       <?php // Good Standing > 1.99
                                       $num =1;
                                       ?>
                                       <tbody>
                                            @foreach($resutltArray as $resultss)
                                            @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99) 
                                           <tr>
                                               <td>{{$num}}</td>
                                               <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                               
                                           </tr>
                                           <?php $num++;?>
                                           @endif
                                           
                                           @endforeach
                                       </tbody> 
                                       
                                    </table>
   
                               </td>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                    <thead>
                                           <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                                       </thead>
                                       <?php // Good Standing > 1.99
                                       $num =1;
                                       ?>
                                       <tbody>
                                            @foreach($resutltArray as $resultss)
                                            @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) <= 1.99) 
                                           <tr>
                                               <td>{{$num}}</td>
                                               <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                               
                                           </tr>
                                           <?php $num++;?>
                                           @endif
                                           @endforeach
                                       </tbody>  
                                       
                                    </table>
                               </td>
                           </tr>
                       </table>
   
                       <table class="table table-striped table-hover table-bordered table-condensed">
                           <tr>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th>......................................</th>
                                       </thead> 
                                       <tbody>
                                       <tr>
                                           <td>
                                        PROVOST
                                           </td>
                                       </tr>
                                       </tbody>
                                    </table>
   
                               </td>
                               <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th>......................................</th>
                                       </thead> 
                                       <tbody>
                                       <tr>
                                           <td>
                                       ACADEMIC BOARD SECRETARY / REGISTRAR
                                           </td>
                                       </tr>
                                       </tbody>
                                    </table>
   
                               </td>
                                <td>
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                       <thead>
                                           <th>......................................</th>
                                       </thead> 
                                       <tbody>
                                       <tr>
                                           <td>
                                      HEAD OF SCHOOL
                                           </td>
                                       </tr>
                                       </tbody>
                                    </table>
   
                               </td>
                           </tr>
                       </table>
                      @endif

                      @if($level == '400' and $semester == 'Second')                       
                            
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <thead>
                        <tr align="center">
                         <td colspan="6">LAGOS STATE COLLEGE OF HEALTH TECHNOLOGY</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">DATE: {{$date}}</td>
                         <td colspan="3" align="right">LEVEL: {{$level}}</td>                            
                        </tr>
                        <tr>
                         <td colspan="3">SESSION : {{$session}}</td>
                         <td colspan="3" align="right">SEMESTER: {{$semester}}</td>                            
                        </tr>
                        <tr align="center">
                         <td colspan="6">SCHOOL OF {{$school->name}}({{$programme->progdesc}}) RESULT SHEET</td>                            
                        </tr>
						 </thead>
                         <tbody> 
                         <tr>
                         <td>S/N</td>
                         <td>MATRIC NO/ COURSE OF RESULT</td>
                         <td>PREVIOUS</td>
                         <td>CURRENT</td>
                         <td>COMMULATIVE</td>
                         <td>REMARK</td>                            
                        </tr>
                         
                        <?php $n=1;?>
                        
                        
                         @foreach($resutltArray as $key=>$resultss) 
                                                                            
                        
                        <tr>                                              
                         <td>{{$n}}</td>
                         <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp;&nbsp;   {{$resultss['sname']}}, {{$resultss['fname']}} {{$resultss['oname']}}                       
                         <table class="table table-striped table-hover table-bordered table-condensed">                         
                         
                           
                         <tr>                       
                                                                                                                             
                         @foreach($resultss['results'] as $result) 
                         <td>
                        <div align="center"> {{$result['coursecode']}} </div>
                        <div align="center"> ({{$result['courseunit']}}) </div>
                        <div align="center"> {{$result['gradeids']}}  ({{$result['weighedpoint']}}) </div>
                         
                                            
                         
                         </td>
                         @endforeach             
                         </tr>           
                            
                                                                      
                         </table>
                         </td>
                         <td align="bottom">
                         
                        <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                        
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray2[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray2[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format(($resutltArray2[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray2[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2)}}</div>
                             </td>
                           </tr> 
                        </table>
                                                    
                             </td>


                             <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resultss['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resultss['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</div>
                             </td>
                           </tr> 
                         </table>                             
                        </td>
                         
                         <td align="bottom">
                         <table class="table table-striped table-hover table-bordered table-condensed">
                         <tr>
                         <td>
                         <div>TCP </div>                             
                             </td>
                             <td>                         
                             <div>TNU</div>                             
                             </td>
                             <td>                         
                             <div>GPA</div>
                             </td>
                           </tr>  
                           <tr>
                         <td>
                         <div>{{$resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{$resutltArray3[$key]['totalUnits'] + $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']}}</div>                             
                             </td>
                             <td>                         
                             <div>{{number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2)}}</div>
                             </td>
                           </tr> 
                        </table>                             
                        </td>


                        <td align="bottom">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                        <tr>
                         <td>
                         <div>PASS </div>                             
                             </td>
                             <td>                         
                             <div>CARRYOVER</div>                             
                             </td>                             
                        </tr>  
                        <tr>
                         <td>
                         @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) > 1.99)
                         <div>GS</div> 
                         @endif
                         @if(number_format(($resutltArray3[$key]['tcp'] + $resutltArray4[$key]['tcp'] + $resutltArray5[$key]['tcp'])/($resutltArray3[$key]['totalUnits']+ $resutltArray4[$key]['totalUnits'] + $resutltArray5[$key]['totalUnits']),2) <= 1.99)
                         <div>AP</div>
                         @endif                              
                         </td>
                             <td>
                             <div>
                             
                             @foreach($resultss['res'] as $keys=>$r) 
                             @if(isset($r['coursecodes'])) 
                             {{$r['coursecodes']}}                             
                             @endif
                             @if(isset($resutltArray2[$keys]['coursecodes'])) 
                              {{$resutltArray2[$keys]['coursecodes']}}
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

                       <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                 <table class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                
                                  <th colspan="3">KEYS</th>                                   
                                  </thead>
                                 <tbody>
                                  <tr>
                                     <td>CODE</td> 
                                     <td>TITLE</td>
                                     <td>UNIT</td>
                                 </tr>
                                 <?php $total_units= 0;?>
                                 @foreach($courses as $course)
                                    <?php $total_units = $total_units + $course->unit;?>
                                     <tr>
                                     <td>{{$course->crsid}}</td> 
                                     <td>{{$course->crsdesc}}</td>
                                     <td>{{$course->unit}}</td>
                                     </tr>
                                 @endforeach 
                                 <tr>
                                     <td colspan="2">NO OF COURSE TAKEN</td> 
                                     <td>{{$total_units}}</td>                                    
                                     </tr> 
                                 </tbody>
                                 </table>   
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                     <thead>                                    
                                      <th colspan="4">GRADING SYSTEM</th>                                      
                                      </thead>                                     
                                     <tbody>
                                         <tr><td>RANGE OF SCORES</td> 
                                             <td>WEIGHED POINTS</td>
                                             <td>LETTER GRADES</td>
                                             <td>REMARKS</td>
                                         </tr>
                                         @foreach($grades as $grade)
                                       <tr>
                                     <td>{{$grade->ranges}}</td> 
                                     <td>{{$grade->weighed_point}}</td>
                                     <td>{{$grade->letter_grade}}</td>
                                     <td>{{$grade->remark}}</td>
                                     </tr>
                                 @endforeach  
                                     </tbody>
                                     </table>   
                                    </td>
                                 <td>
                                 <table border=1 class="table table-striped table-hover table-bordered table-condensed">
                                 <thead>                                 
                                  <th>RESULT ANALYSIS</th>                                  
                                  </thead>
                                 <tbody>
                                     <tr>
                                     <td>NO OF STUDENTS IN CLASS</td>
                                     <td>{{$total_number_students}}</td> 
                                     <td>{{@number_format(($total_number_students * 100) / $total_number_students,2)}}%</td>
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITHOUT CARRY OVERS</td>
                                     <td>{{$student_withOutCarryOvers}}</td> 
                                     <td>{{@number_format(($student_withOutCarryOvers * 100)/ $total_number_students,2)}}%</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH PRESENT CARRY OVERS</td> 
                                     <td>{{$student_withCarryOvers}}</td> 
                                     <td>{{@number_format(($student_withCarryOvers * 100)/$total_number_students,2)}}%</td>
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH PREVIOUS CARRY OVERS</td>
                                     <td>0</td> 
                                     <td>0%</td>
                                     </tr>
                                     <tr>
                                     <td>TOTAL NUMBER OF UNIT TAKEN</td> 
                                     <td colspan="2">{{$total_units}}</td>                                     
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS THAT ARE ABSENT</td>
                                     <td colspan="2">{{$difference}}</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH GOOD STANDING (GS)</td>
                                     <?php $num=0;?>
                                     @foreach($resutltArray as $resultss)
                                      @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99)
                                      <?php $num++;?>
                                      @endif
                                     @endforeach
                                     <td colspan="2">{{$num}}</td> 
                                     </tr>
                                     <tr>
                                     <td>NO OF STUDENTS WITH ACADEMIC PROBATION (AP) -WARNING</td>
                                     <?php $num=0;?>
                                     @foreach($resutltArray as $resultss)
                                      @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) < 1.99)
                                      <?php $num++;?>
                                      @endif
                                     @endforeach
                                     <td colspan="2">{{$num}}</td> 
                                     </tr>
                                 </tbody>
                                 </table>   
                                </td>
                            </tr>
                        </table>
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>S/N</th>
                                            <th>MATRIC NO</th>
                                            <th>NAME</th>
                                            <th>PREVIOUS CARRY OVERS</th>
                                        </thead>
                                        <?php 
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray6 as $resultss)                                      
                                                                                    
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} </td>
                                                <td>{{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                <td> 
                                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                                            
                                                            @foreach($resultss['resultpre3'] as $result) 
                                                            @if(isset($result['coursecode'])) 
                                                        <tr>
                                                        <td>{{$result['coursecode']}} </td>
                                                        <td>{{$result['levelss']}}</td> 
                                                        <td>{{$result['semesterss']}}</td>
                                                        <td>{{$result['sessionnamess']}}</td>    
                                                        </tr>
                                                        @endif 
                                                        @endforeach                                                                              
    
                                                        
                                                    </table>                                                                                                           
                                                </td>
                                                
                                            </tr>
                                            <?php 
                                        $num++;
                                        ?>                   
                                            
                                        @endforeach                         
                                            
                                                                       
                                                                                
                                            
                                        </tbody> 
                                        
                                     </table>                          
                                     
                                </td>
                            </tr>
                        </table>
    
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th colspan="2">STUDENTS WITH GOOD STANDING</th>
                                        </thead>
                                        <?php // Good Standing > 1.99
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray as $resultss)
                                             @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) > 1.99) 
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                
                                            </tr>
                                            <?php $num++;?>
                                            @endif
                                            
                                            @endforeach
                                        </tbody> 
                                        
                                     </table>
    
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                     <thead>
                                            <th colspan="2">STUDENTS WITH ACADEMIC PROBATION</th>
                                        </thead>
                                        <?php // Good Standing > 1.99
                                        $num =1;
                                        ?>
                                        <tbody>
                                             @foreach($resutltArray as $resultss)
                                             @if(number_format($resultss['tcp']/$resultss['totalUnits'],2) < 1.99) 
                                            <tr>
                                                <td>{{$num}}</td>
                                                <td>{{strtoupper($resultss['matric'])}} &nbsp;&nbsp;&nbsp; {{$resultss['sname']}} {{$resultss['fname']}} {{$resultss['oname']}}</td>
                                                
                                            </tr>
                                            <?php $num++;?>
                                            @endif
                                            @endforeach
                                        </tbody>  
                                        
                                     </table>
                                </td>
                            </tr>
                        </table>
    
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <tr>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                         PROVOST
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                                <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                        ACADEMIC BOARD SECRETARY / REGISTRAR
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                                 <td>
                                     <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                            <th>......................................</th>
                                        </thead> 
                                        <tbody>
                                        <tr>
                                            <td>
                                       HEAD OF SCHOOL
                                            </td>
                                        </tr>
                                        </tbody>
                                     </table>
    
                                </td>
                            </tr>
                        </table>
                       @endif



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="button" class="btn btn-primary" onclick="window.print()">
                                    Click to Print
                                </button>
                            </div>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

