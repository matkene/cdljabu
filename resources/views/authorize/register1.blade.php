<x-login>
    <x-slot:heading>
        Register Prospective Applicant for {{$terms[0]->name}} Session by creating an account
  </x-slot:heading>
    <form method="POST" action="{{ route('authorize.register') }}">
        @csrf

        <div class="mt-0 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="formno" class="block text-sm font-medium leading-6 text-gray-900">Form Number</label>
              <div class="mt-2">
                <input type="text" name="formno" id="formno" 
                value="{{$formno}}"
                readonly
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>              
            </div>
    
            <div class="sm:col-span-3">
              <label for="referrer" class="block text-sm font-medium leading-6 text-gray-900">Name of Referer</label>
              <div class="mt-2">
                <input type="text" name="referrer" id="referrer" 
                :value="old('referrer')"
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <x-form-error name="referrer"/>
            </div>
        </div> 

        <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="fname" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
              <div class="mt-2">
                <input type="text" name="fname" id="fname" 
                :value = "old('fname')" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <x-form-error name="fname"/>
            </div>
    
            <div class="sm:col-span-3">
              <label for="sname" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
              <div class="mt-2">
                <input type="text" name="sname" id="sname" 
                :value = "old('sname')" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <x-form-error name="sname"/>
            </div>
            
        </div> 


        <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="oname" class="block text-sm font-medium leading-6 text-gray-900">Other name</label>
              <div class="mt-2">
                <input type="text" name="oname" id="oname" 
                :value = "old('oname')" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <x-form-error name="oname"/>
            </div>
    
            <div class="sm:col-span-3">
              <label for="mphone" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
              <div class="mt-2">
                <input type="text" name="mphone" id="mphone" 
                :value = "old('mphone')" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <x-form-error name="mphone"/>
            </div>
        </div> 


        <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
              <div class="mt-2">
                <input type="email" name="email" id="email" 
                :value = "old('email')" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <x-form-error name="email"/>
            </div>
    
            <div class="sm:col-span-3">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
              <div class="mt-2">

                <input type="password" name="password" id="password" 
                :value = "old('password')" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <x-form-error name="password"/>
            </div>
        </div> 


        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
              <div class="mt-2">
                
                <select id="category_id" name="category_id" 
                class ="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                  @foreach ($categories as $category)   
                  <option value="{{$category->id}}">{{$category->name}}</option>   
                  @endforeach
                  
                </select>
                
              
              </div>
              <x-form-error name="category_id"/>
            </div>
    
            <div class="sm:col-span-3">
              <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
              <div class="mt-2">
                <input type="text" name="address" id="address" 
                :value = "old('address')" 
                required
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <x-form-error name="address"/>
            </div>
        </div> 

                

       

        <div class="flex items-center justify-end mt-4 mb-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-login>
