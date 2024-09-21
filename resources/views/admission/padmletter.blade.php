<x-admission-role>
    <x-slot:heading>
        ADMISSION LETTER
    </x-slot:heading> 
    <x-flash-message/> 


    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                
        <div class="sm:col-span-6 mt-2"> 
    @foreach($applications as $student)
    @endforeach 
    
    
       
    <table width="850" border="0" align="center" class="tablecs" cellspacing="4" cellpadding="2">
        
        
        <tr>
          
          <td colspan="8"><img src="{{asset('/dist/img/0002.jpg')}}" width="900" height="170" alt="CDL" /> </td> 
                        
              
          
          
        </tr> 
        
        

          
        <tr>
        <td colspan="8"><hr/></td>    
        </tr>
        


        
        <tr>                               
        <td colspan="4"><strong> <font size="4">{{$student->applno}}</font></strong> </td>
        <td colspan="4" align="right"><strong> <font size="4">Date: &nbsp;&nbsp;<?php echo date("F j, Y");?></font></strong> </td>
           
        </tr>       

        <tr>
        <td colspan="8"><strong> <font size="4">{{ strtoupper($student->sname.', '.$student->fname.' '. $student->oname)}}</font> </strong></td>
            
        </tr>
        
        <tr>
            <td colspan="8">&nbsp;</td>    
        </tr>
        
        
             
                   
        <tr>
            <td colspan="8">&nbsp;</td>    
            </tr>
        <tr>
          <td height="20" colspan="8" align="center"><u><strong><font color="brown" size="5">OFFER OF PROVISIONAL ADMISSION</font></strong></u>
        </tr>
      
          <tr>
            
            <td colspan="8">&nbsp;</td>    
            </tr>

            <tr>                                    
        
          <td colspan="8"><font size="4">{{$student->others}}, 
            I have the pleasure to inform you that you have been offered a provisional admission to study {{$student->aprogramme}} at {{$student->level}} Level in 
            the Department of {{$student->aprogramme}}, College of Management Sciences, Joseph Ayo Babalola University, Ikeji-Arakeji.</font>
      
         </td>
        </tr>

        <tr>
            
            <td colspan="8">&nbsp;</td>    
            </tr>

            <tr>
              
              
           <tr>                                    
        
          <td colspan="8"><font size="4">Please take note of the following conditions relating to your admission and registration.</font>
      
         </td>
        </tr>   
        
       
       

        <tr>
          <td colspan="8" align="center">&nbsp;                            
              </td>
        </tr>
        <tr>
          <td colspan="8"><font size="4">(a) &nbsp;&nbsp;The programme is exclusively an online programme which requires 
            you to study synchronous or asynchronous at your location. However, you will be required to come to the University 
            campus at the end of the semester to write your examinations.	</font></td>
        </tr>

        <tr>
            <td colspan="8" align="center">&nbsp;                            
                </td>
          </tr>
          <tr>
            <td colspan="8"><font size="4">(b) &nbsp;&nbsp;	You will be required to make appropriate payment in accordance with 
              the Financial Regulations of the University as indicated online</font></td>
          </tr>


          <tr>
              <td colspan="8" align="center">&nbsp;                            
                  </td>
            </tr>
            <tr>
              <td colspan="8"><font size="4">(c) &nbsp;&nbsp; This provisional admission is subject to payment of the requisite non-refundable 
                Acceptance Fee of 
                @if($student->level < 700)
                N20,000 (Twenty Thousand Naira only)
                @else
                N50,000 (Fifty Thousand Naira only)
                @endif
                within four weeks of this offer of admission. The Acceptance Fee is however, 
                part of the fees for the programme.</font></td>
            </tr>


            <tr>
                <td colspan="8" align="center">&nbsp;                            
                    </td>
              </tr>
              @if($student->catergory == 'degree')
              <tr>
                <td colspan="8"><font size="4">(d) &nbsp;&nbsp; The total fee payable for this programme per session is N200,000 
                  (Two Hundred Thousand Naira only) broken down as follows: <br/>
                  1.&nbsp;&nbsp;Acceptance Fee	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N20,000 <br/>
2.	1st Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;N100,000 (payable before 1st semester examinations) <br/>
3.	2nd Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N100,000 (payable before 2nd semester examinations)

                </font></td>
              </tr>
            @endif
            @if($student->catergory == 'masters')
            <tr>
                <td colspan="8"><font size="4">(d) &nbsp;&nbsp; The total fee payable for this programme per session is N600,000 
                  (Six Hundred Thousand Naira only) broken down as follows: <br/>
                  1.&nbsp;&nbsp;Acceptance Fee	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N50,000 <br/>
2.	1st Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;N300,000 (payable before 1st semester examinations) <br/>
3.	2nd Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N300,000 (payable before 2nd semester examinations)

                </font></td>
              </tr>

@endif

@if($student->catergory == 'postgraduate')
            <tr>
                <td colspan="8"><font size="4">(d) &nbsp;&nbsp; The total fee payable for this programme per session is N350,000 
                  (Three Hundred and fifty Thousand Naira only) broken down as follows: <br/>
                  1.&nbsp;&nbsp;Acceptance Fee	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N50,000 <br/>
2.	1st Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;N175,000 (payable before 1st semester examinations) <br/>
3.	2nd Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N175,000 (payable before 2nd semester examinations)

                </font></td>
              </tr>

@endif

@if($student->catergory == 'diploma')
            <tr>
                <td colspan="8"><font size="4">(d) &nbsp;&nbsp; The total fee payable for this programme per session is N250,000 
                  (Two Hundred and fifty Thousand Naira only) broken down as follows: <br/>
                  1.&nbsp;&nbsp;Acceptance Fee	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N20,000 <br/>
2.	1st Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;N80,000 (payable before 1st semester examinations) <br/>
3.	2nd Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N85,000 (payable before 2nd semester examinations)
4.	3rd Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N85,000 (payable before 2nd semester examinations)

                </font></td>
              </tr>

@endif

@if($student->catergory == 'diplomaf')
            <tr>
                <td colspan="8"><font size="4">(d) &nbsp;&nbsp; The total fee payable for this programme per session is N150,000 
                  (One Hundred and fifty Thousand Naira only) broken down as follows: <br/>
                  1.&nbsp;&nbsp;Acceptance Fee	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N20,000 <br/>
2.	1st Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;N75,000 (payable before 1st semester examinations) <br/>
3.	2nd Instalment Payment	&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;N75,000 (payable before 2nd semester examinations)

                </font></td>
              </tr>

@endif
              <tr>
                  <td colspan="8" align="center">&nbsp;                            
                      </td>
                </tr>
                <tr>
                  <td colspan="8"><font size="4">(e) &nbsp;&nbsp; If you are a foreign student, you will need to start to process your visa early in order to come and write 
                    your examinations at the end of the semester. Accommodation is available in halls of residence for both local and foreign students during the end of semester examinations at affordable rates</font></td>
                </tr>


                <tr>
                    <td colspan="8" align="center">&nbsp;                            
                        </td>
                  </tr>
                  <tr>
                    <td colspan="8"><font size="4">Please note that this offer of provisional admission may be revoked 
                      if within four weeks from the date of this letter you have not complied with the conditions</font></td>
                  </tr>


                  <tr>
                      <td colspan="8" align="center">&nbsp;                            
                          </td>
                    </tr>
                    <tr>
                      <td colspan="8"><font size="4">On behalf of the Vice Chancellor, I congratulate you on your admission 
                        to the Centre for Distance Learning, Joseph Ayo Babalola University, Ikeji-Arakeji</font></td>
                    </tr>
    
  
          
         
        
              <tr>
                <td colspan="8" align="center">&nbsp;                            
                    </td>
              </tr>

              <tr>
                  <td colspan="8"><font size="4">Your sincerely,</font></td>
                </tr>

                <tr>
                    <td colspan="8" align="center">&nbsp;                            
                        </td>
                  </tr>



        
        <tr>
                
                <td colspan="8"><p>
                    <img src="{{asset('/dist/img/secretary.png')}}" width="180" height="80" alt="Institute Secretary's signature"> <br />
                    <br />
                    <strong><font size="4">Fasuyi O.S (Mr.)</font></strong><br />
                    <strong><font size="4">Centre Secretary</font></strong><br />
                 
            <i> </i></p></td>
              
        </tr>
        <tr><td> </td></tr>

        <tr>
          
            <td colspan="8"><img src="{{asset('/dist/img/0001.jpg')}}" width="900" height="80" alt="CDL" /> </td> 
                          
                
            
            
          </tr> 

        
      </table>  
    

    
</form>    
        </div>
    </div>             
</x-admission-role>