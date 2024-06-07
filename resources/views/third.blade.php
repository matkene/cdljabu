<x-testing>
    <x-slot:heading>
        Create Jobs
    </x-slot:heading>
    <h1></h1>
  
<form method="POST" action="/jobs">
    @csrf
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Create a new Job</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">We just need an handful details.</p>
  
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <x-form-field>
          <x-form-label for="title">Title </x-form-label>          
          <div class="mt-2">
            <x-form-input name="title" id="title" autocomplete="title" placeholder="Shift Leader"/>
            
            <x-form-error name="title"/>
          </div>
          </x-form-field>
         
        </div>     
  
          
      </div>


      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <x-form-field>
          <x-form-label for="salary">Salary </x-form-label>
          <div class="mt-2">
              
              <x-form-input name="salary" id="salary" autocomplete="title" placeholder="$24,000"/>

              
              <x-form-error name="salary"/>
          </div>
        </x-form-field>
        </div>    
    </div>
      
      {{-- <div class='mt-10'>
      @if($errors->any())
       <ul>
         @foreach($errors->all() as $error)
         <li class='text-red-500'>{{$error}}</li>
         @endforeach
       </ul>
      @endif 

      </div>--}}
      
  
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
      <x-form-button>Save</x-form-button>
    </div>
  </form>
  
</x-testing>    