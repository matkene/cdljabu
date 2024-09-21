<x-student-role>
    
    <x-flash-message/> 
           
    <form method="POST" action="{{ route('student.editbiodata') }}">
        @csrf 
            @foreach($students as $student)
            @endforeach
            <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                
            <div class="sm:col-span-6 mt-2">                 
                <table
                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                
                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4">EDIT BIODATA - PERSONAL INFORMATION</th>
                  </tr>
                 </thead>
                <tbody> 
                    <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Matric
                        </td> 
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="matric" type="text" class="form-control" 
                            value="{{strtoupper($student['matric'])}}" readonly="readonly">
                        </td>                      
            
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Title
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        <select class="form-control" name="title" id="title">                             
                         <option value="{{$student->title_id}}" selected>
                        {{ $student->title->name}}
                         </option>
                         @foreach($titles as $title)
                         <option value="{{$title['id']}}">{{$title['name']}}</option>                             
                         @endforeach
                         </select> 
                        </td>    
                      </tr>
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Surname
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="sname" type="text" class="form-control" 
                            value="{{ $student['sname']}}" readonly="readonly">
                        </td>    
                      </tr>
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           First Name
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="fname" type="text" class="form-control" 
                            value="{{ $student['fname']}}" readonly="readonly">
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Other Name
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="oname" type="text" class="form-control" 
                            value="{{ $student['oname']}}" readonly="readonly">
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Gender
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="sex" type="text" class="form-control" 
                            value="{{ $student->gender->name}}" readonly="readonly">
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Marital Status
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        <select class="form-control" name="mstatus" id="mstatus">                             
                         <option value="{{$student->marital_id}}" selected>{{ $student->marital->name}}</option>
                         @foreach($maritals as $marital)
                         <option value="{{$marital['id']}}">{{$marital['name']}}</option>                             
                         @endforeach
                         </select> 
                        </td>    
                      </tr>
  
                      
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Date of birth
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="dob" type="text" class="form-control" 
                            value="{{ $student['dob']}}" readonly="readonly">
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           State of Origin
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        <select class="form-control" name="state_id" id="state_id">                             
                         <option value="{{ $student->state->id}}" selected>{{ $student->state->name}}</option>
                         @foreach($states as $state)
                         <option value="{{$state['id']}}">{{$state['name']}}</option>                             
                         @endforeach
                         </select>
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            Local Government Area
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        <select class="form-control" name="lga_id" id="lga_id">                             
                         <option value="{{ $student->lga->id}}" selected>{{ $student->lga->name}}</option>
                         @foreach($lgas as $lga)
                         <option value="{{$lga['id']}}">{{$lga['name']}}</option>                             
                         @endforeach
                         </select> 
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Country
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           <select class="form-control" name="country_id" id="country_id">                             
                         <option value="{{ $student->country->id}}" selected>{{ $student->country->name}}</option>
                         @foreach($countries as $country)
                         <option value="{{$country['id']}}">{{$country['name']}}</option>                             
                         @endforeach
                         </select>
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Blood Group
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        <select class="form-control" name="bloodgroup" id="bloodgroup">                             
                         <option value="{{$student->bloodgroup_id}}" selected>{{ $student->bloodgroup->name}}</option>
                         @foreach($bloodgroups as $bloodgroup)
                         <option value="{{$bloodgroup['id']}}">{{$bloodgroup['name']}}</option>                             
                         @endforeach
                         </select> 
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Religion
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                        <select class="form-control" name="religion" id="religion">                             
                         <option value="{{@$student->religion_id}}" selected>{{@$student->religions->name}}</option>
                         @foreach($religions as $religion)
                         <option value="{{@$religion['id']}}">{{@$religion['name']}}</option>                             
                         @endforeach
                         </select> 
                        </td>    
                      </tr>
  
                      <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4"> CONTACT INFORMATION</th>
                  </tr>
                 </thead>
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Address
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                 <input id="address" name="address" type="text" 
                 class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                 value="{{ $student['address']}}">
                        </td>    
                      </tr>
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Email
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="email" name="email" type="text" 
                            readonly
                            class="form-control"
                            value="{{ $student['email']}}">
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Phone
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="mphone" maxlength="11" name="mphone" type="text"  
                            class="form-control" value="{{ $student['mphone']}}">
                        </td>    
                      </tr>
  
                <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4"> PROGRAMME OF STUDY</th>
                  </tr>
                 </thead>
                    <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Mode of Entry
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="mode_id" type="text" class="form-control" value="{{ $student->mode->name}}" readonly="readonly">
                        </td>    
                      </tr>
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Programme
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="programme_id" type="text" class="form-control" 
                            value="{{ $student->programme->progdesc}}" readonly="readonly">
                        </td>    
                      </tr>
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Department
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="department_id" type="text" class="form-control" 
                            value="{{ $student->programme->progdesc}}" readonly="readonly">
                        </td>    
                      </tr>

                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                           Level
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="level" type="text" class="form-control" value="{{ $student['level']}}" readonly="readonly">
                        </td>    
                      </tr>
  
                      <thead
                  class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
                  <tr>                    
                    <th scope="col" colspan="2"  class="px-6 py-4"> NEXT-OF-KIN DETAILS</th>
                  </tr>
                 </thead>
     
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          Name of Next of Kin
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="name_nok" name="name_nok" type="text" class="form-control" 
                            value="{{ @$student['name_nok']}}">
                        </td>    
                      </tr>
  
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          Relationship to Next of Kin
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                         <select class="form-control" name="rel_nok" id="rel_nok">                             
                         <option value="{{@$student->relationship_id}}" selected>{{ @$student->relationship->name}}</option>
                         @foreach($relationships as $relationship)
                         <option value="{{@$relationship['id']}}">{{@$relationship['name']}}</option>                             
                         @endforeach
                         </select> 
                        </td>    
                      </tr>
  
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          Address of Next of Kin
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="address_nok" name="address_nok" type="text" class="form-control" 
                            value="{{ $student['address_nok']}}">
                        </td>    
                      </tr>
  
  
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          Phone of Next of Kin
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="mphone_nok" maxlength="11" name="mphone_nok" type="text" class="form-control" 
                            value="{{ @$student['mphone_nok']}}">
                        </td>    
                      </tr>
  
  
                      <tr class="border-b border-neutral-200 dark:border-white/10">                        
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                          Email of Next of Kin
                        </td>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">
                            <input id="email_nok" name="email_nok" type="text" 
                            class="form-control" value="{{ @$student['email_nok']}}">
                        </td>    
                      </tr>                     
               
             
  
                </tbody>
                </table>
            </div>
  
            
                      
        
        </div>
  
        <div class="flex items-center justify-center mt-8 mb-4">
            
            <x-primary-button class="ms-4">
                {{ __('Click to Update') }}
            </x-primary-button>
        </div>
    </form>
        
    
  </x-student-role>