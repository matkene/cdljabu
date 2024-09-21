<x-student-role>
    
      @foreach ($terms as $term)          
      @endforeach
      @foreach($programmes as $programme)
      @endforeach

    @if($level == '100' and $semester == 'First') 
    <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        
        <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-gray-300 px-4 py-2" colspan="7">
                <img src="{{asset('logo.png')}}" alt="logo" class="h-20 w-30">
            </td>
            
          </tr>
          <?php $n=1;?>
          @foreach($resutltArray as $resultss) 

          <tbody>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">Matric</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="5">{{strtoupper($resultss['matric'])}}</td>
            
          </tr>

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">NAME</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="5">{{ strtoupper($resultss['sname'])}}, {{strtoupper($resultss['fname'])}} {{strtoupper($resultss['oname'])}}</td>
            
          </tr>


          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">DEAPARTMENT</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="5">{{$programme->department}}</td>
            
          </tr>

          
          <thead
        class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">

        </thead>  
       
             
        <tr class="border-b border-neutral-600 dark:border-black/10">                                              
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="3">YEAR ONE</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="4">{{$term['name']}}</td>

        </tr>        
        
        <tr class="border-b border-neutral-600 dark:border-black/10">                                              
          <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="7">SECOND SEMSTER</td>

      </tr>

      <tr class="border-b border-neutral-600 dark:border-black/10">                                              
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">S/N</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">COURSE CODE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">COURSE TITLE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">SCORE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">UNIT</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GRADE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GRADE POINT</td>

    </tr>

    @foreach($resultss['results'] as $result) 

    <tr class="border-b border-neutral-600 dark:border-black/10">                                              
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$n}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$result['coursecode']}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$result['coursedesc']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result['gradeids']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result['courseunit']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result['weighedpoint']}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format($result['weighedpoint'] * $result['courseunit'],1)}}</td>

  </tr>
  <?php $n++ ?> 
    @endforeach

              </table>

            </td>
          </tr>

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">
              <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
               
            <tr class="border-b border-neutral-600 dark:border-black/10">
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">FIRST SEMESTER</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">100 LEVEL</td>
            
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">TCP</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">{{$resultss['tcp']}}</td>
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">TNU</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">{{$resultss['totalUnits']}}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">GPA</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">TOTAL</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">{{$resultss['tcp']}}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">AVERAGE</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">{{$resultss['totalUnits']}}</td>
              
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">CCGA</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</td>
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">REMARK</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2"></td>
            </tr>

            </table>
            </td>
            <td>
              <tr>

              <td class="border border-black-300 px-4 py-2 font-medium uppercase">
                <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                  <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">RANGE OF SCORES</td> 
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">WEIGHED POINTS</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">LETTER GRADES</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">REMARKS</td>
                </tr>
                @foreach($grades as $grade)
                <tr class="border-b border-neutral-600 dark:border-black/10">
                  <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$grade->ranges}}</td> 
                  <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$grade->weighed_point}}</td>
                  <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$grade->letter_grade}}</td>
                  <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$grade->remark}}</td>
                    </tr>
                    @endforeach
                </table>
              </td>
            </tr>


            </td>

            

          </tr>
          @endforeach
        </tbody>
       
    </table>
    @elseif($level == '100' and $semester == 'Second') 

    <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        
        <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-gray-300 px-4 py-2" colspan="2">
                <img src="{{asset('logo.png')}}" alt="logo" class="h-20 w-30">
            </td>
            
          </tr>
          <?php $n=1;?>
          @foreach($resutltArray as $key=>$resultss) 
          
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">
                <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="1">Matric</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="1">{{strtoupper($resultss['matric'])}}</td>
            
          </tr>

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="1">NAME</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="1">{{ strtoupper($resultss['sname'])}}, {{strtoupper($resultss['fname'])}} {{strtoupper($resultss['oname'])}}</td>
            
          </tr>

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="1">DEAPARTMENT</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="1">{{$programme->department}}</td>
            
          </tr>
          
        <thead
        class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">

        </thead> 
             
        <tr class="border-b border-neutral-600 dark:border-black/10">                                              
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="1">YEAR ONE</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="1">{{$term['name']}}</td>

        </tr> 
     @foreach($resutltArray2 as $resultsss) 

    <?php  // Put a table ?>
        <tr class="border-b border-neutral-600 dark:border-black/10">

          <td class="border border-black-300 px-4 py-2 font-medium">

            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        
        <tr class="border-b border-neutral-600 dark:border-black/10">                                              
          <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="7">FIRST SEMSTER</td>

      </tr>

      <tr class="border-b border-neutral-600 dark:border-black/10">                                              
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">S/N</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">COURSE CODE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">COURSE TITLE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">SCORE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">UNIT</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GRADE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GRADE POINT</td>

    </tr>

    @foreach($resultsss['resultpre'] as $result2) 

    <tr class="border-b border-neutral-600 dark:border-black/10">                                              
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$n++}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$result2['coursecode']}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$result2['coursedesc']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result2['gradeids']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result2['courseunit']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result2['weighedpoint']}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format($result2['weighedpoint'] * $result2['courseunit'],1)}}</td>

  </tr>
  @endforeach
            </table>
       </td>
      
      <td class="border border-black-300 px-4 py-2 font-medium align-top">

        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        
        <tr class="border-b border-neutral-600 dark:border-black/10">                                              
          <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="7">SECOND SEMSTER</td>

      </tr>

      <tr class="border-b border-neutral-600 dark:border-black/10">                                              
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">S/N</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">COURSE CODE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase">COURSE TITLE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">SCORE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">UNIT</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GRADE</td>
        <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">GRADE POINT</td>

    </tr>
    
    @foreach($resultss['results'] as $keys=>$result)
    <tr class="border-b border-neutral-600 dark:border-black/10">                                              
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$keys + 1}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$result['coursecode']}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$result['coursedesc']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result['gradeids']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result['courseunit']}} </td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{$result['weighedpoint']}}</td>
      <td class="border border-black-300 px-4 py-2 font-medium uppercase text-center">{{number_format($result['weighedpoint'] * $result['courseunit'],1)}}</td>

  </tr>
  @endforeach
            </table>
          </td>

        
  <?php $n++ ?> 
    @endforeach
   
       </table>

            </td>
          </tr>
         

          <tr class="border-b border-neutral-600 dark:border-black/10">
            
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">
              <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
               
            <tr class="border-b border-neutral-600 dark:border-black/10">
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">FIRST SEMESTER</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">100 LEVEL</td>
            
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">TCP</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" >{{$resutltArray2[$key]['tcp']}}</td>
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">TNU</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" >{{$resutltArray2[$key]['totalUnits']}}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">GPA</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{number_format($resutltArray2[$key]['tcp']/$resultss['totalUnits'],2)}}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">TOTAL</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$resutltArray2[$key]['tcp']}}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">AVERAGE</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$resutltArray2[$key]['totalUnits']}}</td>
              
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">CCGA</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{number_format($resutltArray2[$key]['tcp']/$resutltArray2[$key]['totalUnits'],2)}}</td>
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">REMARK</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase"></td>
            </tr>

            </table>
            </td>

            <td class="border border-black-300 px-4 py-2 font-medium uppercase">
              <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
               
            <tr class="border-b border-neutral-600 dark:border-black/10">
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">SECOND SEMESTER</td>
            <td class="border border-black-300 px-4 py-2 font-medium uppercase">100 LEVEL</td>
            
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">TCP</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" >{{$resultss['tcp']}}</td>
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">TNU</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" >{{$resultss['totalUnits']}}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">GPA</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" >{{number_format($resultss['tcp']/$resultss['totalUnits'],2)}}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">CTCP</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" >{{$resultss['tcp'] + $resutltArray2[$key]['tcp'] }}</td>
            </tr>
            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">AVERAGE</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" >{{$resultss['totalUnits'] + $resutltArray2[$key]['totalUnits']}}</td>
              
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">CCGA</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{number_format(($resultss['tcp'] + $resutltArray2[$key]['tcp'])/($resultss['totalUnits'] + $resutltArray2[$key]['totalUnits']),2)}}</td>
            </tr>

            <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">REMARK</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase" ></td>
            </tr>

            </table>
            </td>


            <td class="border border-black-300 px-4 py-2 font-medium uppercase">
              <tr class="border-b border-neutral-600 dark:border-black/10">

              <td class="border border-black-300 px-4 py-2 font-medium uppercase" colspan="2">
                <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                  <tr class="border-b border-neutral-600 dark:border-black/10">
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">RANGE OF SCORES</td> 
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">WEIGHED POINTS</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">LETTER GRADES</td>
              <td class="border border-black-300 px-4 py-2 font-medium uppercase">REMARKS</td>
                </tr>
                @foreach($grades as $grade)
                <tr class="border-b border-neutral-600 dark:border-black/10">
                  <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$grade->ranges}}</td> 
                  <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$grade->weighed_point}}</td>
                  <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$grade->letter_grade}}</td>
                  <td class="border border-black-300 px-4 py-2 font-medium uppercase">{{$grade->remark}}</td>
                    </tr>
                    @endforeach
                </table>
              </td>
            </tr>


            </td>

            
            


          </tr>
          @endforeach
       
    </table>
    @endif

  
</x-student-role>