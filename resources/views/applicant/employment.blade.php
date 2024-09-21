<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{$terms[0]->name}} SESSION  - EMPLOYMENT
    </x-slot:heading> 

    <x-flash-message/> 

    @foreach($applications as $appls)
    @endforeach
    @if($count > 0)
    <form method="POST" action="{{ route('applicant.sponsor') }}">
        @csrf
    
     <div class="sm:col-span-6 mt-5">
         
        <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        <thead
          class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
          <tr>
            
            <th scope="col" colspan="2"  class="px-6 py-4">Employment Details.</th>
            
          </tr>
          <tr class="border-b border-neutral-200 dark:border-white/10">
            <td class="whitespace-nowrap  px-6 py-4 font-medium">S/N</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Employment Name
            </td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Position Held</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">From
            </td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">To
            </td>

          </tr>
        </thead>
        <tbody> 
            @foreach($employments as $appl)
            @endforeach
            <?php 
            $data = @unserialize($appl['name']);
            $data1 = @unserialize($appl['datefrom']);
            $data2 = @unserialize($appl['dateto']);
            $data3 = @unserialize($appl['position']);
                            
            ?>
            @if($data != '')
            @foreach($data as $k=>$name)
            <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$k+1}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$name}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{@$data3[$k]}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{@$data1[$k]}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{@$data2[$k]}}</td>               
    
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
    <form method="POST" action="{{ route('applicant.employmentpost') }}">
        @csrf

    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Employment Name</label>
          <div class="mt-2">        
            <input type="text" name="name[]" id="name" 
            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>       
        
        </div>
        <x-form-error name="name"/>

        <div class="sm:col-span-3">
            <label for="position" class="block text-sm font-medium leading-6 text-gray-900">Position Held</label>
            <div class="mt-2">        
              <input type="text" name="position[]" id="position" 
              class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>       
          
          </div>
          <x-form-error name="position"/>

        </div>

        
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="datefrom" class="block text-sm font-medium leading-6 text-gray-900">Date From</label>
          <div class="mt-2">           
            <select id="datefrom" name="datefrom[]" 
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
            <option value="0" disabled="disabled" selected>Select Date From</option>
            @for($i=1980;$i < 2023; $i++)                                        
            <option value="{{$i}}">{{$i}}</option>  
            @endfor                                                            
        </select>
        </div>
        </div>    
    <x-form-error name="datefrom"/>
    
        <div class="sm:col-span-3">
          <label for="dateto" class="block text-sm font-medium leading-6 text-gray-900">Date To</label>
          <div class="mt-2">        
            <select id="dateto" name="dateto[]" 
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
            <option value="0" disabled="disabled" selected>Select Date To</option>
            @for($i=1980;$i < 2024; $i++)                                        
            <option value="{{$i}}">{{$i}}</option>  
            @endfor                                                            
        </select>
            </div>
          </div>
        </div>        
    
    <x-form-error name="dateto"/>
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