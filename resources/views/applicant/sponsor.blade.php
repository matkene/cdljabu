<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{$terms[0]->name}} SESSION  - SPONSOR
    </x-slot:heading> 

    <x-flash-message/>

    @foreach($applications as $appls)
    @endforeach

    @if($count > 0)
    <form method="POST" action="{{ route('applicant.preview') }}">
        @csrf
    
     <div class="sm:col-span-6 mt-5">
         
        <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        <thead
          class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
          <tr>
            
            <th scope="col" colspan="2"  class="px-6 py-4">Sponsor</th>
            
          </tr>
          <tr class="border-b border-neutral-200 dark:border-white/10">
            <td class="whitespace-nowrap  px-6 py-4 font-medium">S/N</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Sponsor FullName
            </td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Relationship</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Address
            </td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Email
            </td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Phone
            </td>

          </tr>
        </thead>
        <tbody> 
        </tr>
        @foreach($sponsors as $appl)
        @endforeach
        
        <?php 
        $data = @unserialize($appl->name);
        $data1 = @unserialize($appl->relationship_id);
        $data2 = @unserialize($appl->address);
        $data3 = @unserialize($appl->email);
        $data4 = @unserialize($appl->mphone);
        
         ?>
         @if($data != '')
         @foreach($data as $k=>$name) 
            <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$k+1}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$name}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{@$data1[$k]}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{@$data2[$k]}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{@$data3[$k]}}</td>               
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{@$data4[$k]}}</td> 
    
              </tr>
            @endforeach
            @endif  
        </tbody>
        </table>
    </div>
   @if($appls['submitted']==0)
    <div class="flex items-center justify-center mt-8 mb-4">
            
        <a href="/applicant/examresult">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Back</button></a>

        <x-primary-button class="ms-4">
            {{ __('Save and Continue') }}
        </x-primary-button>
    </div>
    @endif
    </form>


    @else 
    <form method="POST" action="{{ route('applicant.sponsorpost') }}">
        @csrf

    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Sponsor Name</label>
          <div class="mt-2">        
            <input type="text" name="name[]" id="name" 
            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>       
        
        </div>
        <x-form-error name="name"/>

        

        </div>


        <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
              <div class="mt-2">        
                <input type="text" name="email[]" id="email" 
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>       
            
            </div>
            <x-form-error name="email"/>
    
            <div class="sm:col-span-3">
                <label for="mphone" class="block text-sm font-medium leading-6 text-gray-900">Phone</label>
                <div class="mt-2">        
                  <input type="text" name="mphone[]" id="mphone" 
                  class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>       
              
              </div>
              <x-form-error name="mphone"/>
    
            </div>
    

        
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="relationship_id" class="block text-sm font-medium leading-6 text-gray-900">Relationship</label>
          <div class="mt-2">           
            <select id="relationship_id" name="relationship_id[]" 
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
            <option value="0" disabled="disabled" selected>Select Relationship</option>
            @foreach($relationships as $relationship)                                        
            <option value="{{$relationship->name}}">{{$relationship->name}}</option>  
            @endforeach                                                            
        </select>
        </div>
        </div>    
    <x-form-error name="datefrom"/>
    
        <div class="sm:col-span-3">
          <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
          <div class="mt-2">        
            <input type="text" name="address[]" id="address" 
            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
        </div>        
    
    <x-form-error name="address"/>
            <div class="flex items-center justify-center mt-12 mb-4">
                    
                <a href="/applicant/examresult">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Back</button></a>

                <x-primary-button class="ms-4">
                    {{ __('Save and Continue') }}
                </x-primary-button>
            </div>
            </form>
        </div> 
  @endif

</x-applicant-role>