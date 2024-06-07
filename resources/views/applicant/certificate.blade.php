<x-applicant-role>
    <x-slot:heading>
        APPLICATION FORM FOR {{$terms[0]->name}} SESSION  - CERTIFICATE
    </x-slot:heading> 

    <form method="POST" action="{{ route('applicant.certificatepost') }}"  enctype="multipart/form-data">
        @csrf
    
     <div class="sm:col-span-6 mt-5">
        @if($count > 0) 
        <table
        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
        <thead
          class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
          <tr>
            
            <th scope="col" colspan="2"  class="px-6 py-4">Certificate Uploaded.</th>
            
          </tr>
          <tr class="border-b border-neutral-200 dark:border-white/10">
            <td class="whitespace-nowrap  px-6 py-4 font-medium">S/N</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Certificate Name
            </td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Certificate Grade</td>
            <td class="whitespace-nowrap  px-6 py-4 font-medium">Action
            </td>

          </tr>
        </thead>
        <tbody> 
            @foreach($certificates as $appl)
            @endforeach
            <?php 
            $data = @unserialize($appl->name);
            $data1 = @unserialize($appl->certificate);
            $data2 = @unserialize($appl->grade);
            
             ?>
             @if($data != '')
             @foreach($data as $k=>$name)
            <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$k+1}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$name}}
                </td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{@$data2[$k]}}</td>
                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                    <a href="{{ asset('uploads/' .$data1[$k])}}" download="{{$data1[$k]}}" class="btn btn-labeled ">
                        <button type="button" class="text-sm font-semibold leading-6 text-blue-900">
                            View Certificate
                        </button>
                    </a>
                </td>
                
    
              </tr>
            @endforeach
            @endif  
        </tbody>
        </table>
    </div>

    <div class="flex items-center justify-center mt-8 mb-4">
            
        <a href="/applicant/examresult">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Back</button></a>

        <x-primary-button class="ms-4">
            {{ __('Save and Continue') }}
        </x-primary-button>
    </div>
    </form>


    @else 
    <form method="POST" action="{{ route('applicant.certificatepost') }}" enctype="multipart/form-data">
        @csrf

    <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Certificate Name</label>
          <div class="mt-2">
            <select id="name" name="name[]" 
                class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                <option value="0" disabled="disabled" selected>Select Certificate</option>
                @foreach($certificates as $cert)
                <option value="{{$cert->name}}">{{$cert->name}}</option>
                @endforeach                                                              
            </select>
        
        
        </div>
        <x-form-error name="name"/>

        </div>
        
        <div class="sm:col-span-3">
          <label for="grade" class="block text-sm font-medium leading-6 text-gray-900">Certificate Grade</label>
          <div class="mt-2">           
            <select id="grade" name="grade[]" 
            class ="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
            <option value="0" disabled="disabled" selected>Select Grade</option>
            @foreach($certgrades as $certgrade)
            <option value="{{$certgrade->name}}">{{$certgrade->name}}</option>
            @endforeach                                                              
        </select>
        </div>
        </div>
    </div> 
    <x-form-error name="grade"/>



    <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Upload Certificate (Jpg, Jpeg or Png)</label>
          <div class="mt-2">        
            <input type="file" name="certificate[]" id="certificate" 
            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
        </div>        
    </div> 
    <x-form-error name="certificate"/>
            <div class="flex items-center justify-center mt-8 mb-4">
                    
                <a href="/applicant/examresult">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Back</button></a>

                <x-primary-button class="ms-4">
                    {{ __('Save and Continue') }}
                </x-primary-button>
            </div>
            </form>

  @endif

</x-applicant-role>