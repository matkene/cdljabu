<x-login>
  <x-card class="max-w-3xl mx-auto mt-24">
      <header class="text-center">
      <h2 class="text-2xl font-bold mb-1">
        Register for {{$terms[0]->name}} Session 
      </h2>
      <p class="mb-4">Prospective Applicant can create account </p>
  </header>

  <form method="POST" action="{{ route('authorize.register') }}">
    @csrf  
    <div class="mt-10 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-6">
      <div class="sm:col-span-3">
      <label for="name" class="inline-block text-md mb-1">
              Form Number
          </label>
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="formno"
              value="{{$formno}}"
              readonly
          />
          @error('formno')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
      </div>
     
      <div class="sm:col-span-3">
        <label for="referrer" class="inline-block text-md mb-1">
                Referral Full Name
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="referrer"
                value="{{old('referrer')}}" 
                required               
            /> 
            <x-form-error name="referrer"/>           
        </div>
        
    </div>


    <div class="mt-5 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-6">
      <div class="sm:col-span-3">
      <label for="sname" class="inline-block text-md mb-1">
        Last name
          </label>
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="sname"
              value="{{old('sname')}}"
              required
          />
          <x-form-error name="sname"/> 
      </div>
     
      <div class="sm:col-span-3">
        <label for="sname" class="inline-block text-md mb-1">
          First name
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="fname"
                value="{{old('fname')}}"
                required
            />
            <x-form-error name="fname"/> 
        </div>
    </div>



    <div class="mt-5 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-6">
      <div class="sm:col-span-3">
      <label for="oname" class="inline-block text-md mb-1">
        Other name
          </label>
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="oname"
              value="{{old('oname')}}"
              required
          />
          <x-form-error name="oname"/> 
      </div>
     
      <div class="sm:col-span-3">
        <label for="mphone" class="inline-block text-md mb-1">
          Phone Number
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="mphone"
                value="{{old('mphone')}}"
                required
            />
            <x-form-error name="mphone"/> 
        </div>
    </div>


    <div class="mt-5 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-6">
      <div class="sm:col-span-3">
      <label for="name" class="inline-block text-md mb-1">
        Email
          </label>
          <input
              type="email"
              class="border border-gray-200 rounded p-2 w-full"
              name="email"
              value="{{old('email')}}"
          />
          <x-form-error name="email"/> 
      </div>
     
      <div class="sm:col-span-3">
        <label for="name" class="inline-block text-md mb-1">
          Password
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password"
                value="{{old('password')}}"
            />
            <x-form-error name="password"/> 
        </div>
    </div>


    <div class="mt-5 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-6">
      <div class="sm:col-span-3">
      <label for="address" class="inline-block text-md mb-1">
        Address
          </label>
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="address"
              value="{{old('address')}}"
          />
          <x-form-error name="address"/> 
      </div>
     
      <div class="sm:col-span-3">
        <label for="category_id" class="inline-block text-md mb-1">
          Category
            </label>
           
            <select id="category_id" name="category_id" 
                class ="border border-gray-200 rounded p-2 w-full">
                  @foreach ($categories as $category)   
                  <option value="{{$category->id}}">{{$category->name}}</option>   
                  @endforeach
                  
                </select>
            @error('category_id')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
    </div>   

      <div class="mt-6 mb-6">
          <button
              type="submit"
              class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
          >
              Register
          </button>
      </div>

      <div class="mt-2">
          <p>
              Already have an account?
              <a href="/authorize/login" class="text-laravel">Login</a>
          </p>
      </div>
  </form>
</x-card>
</x-login>