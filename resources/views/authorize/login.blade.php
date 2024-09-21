<x-login>
  <x-card class="max-w-3xl mx-auto mt-24">  
  <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">
          Login
      </h2>
      <p class="mb-4">Welcome! you can access your account with your credentials</p>
  </header>
  
  <form method="POST" action="{{ route('authorize.login') }}">
    
    @csrf  
    <div class="mt-10 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
      <div class="mb-6">
          <label for="username" class="inline-block text-md mb-1"
              >Username</label
          >
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="username"
              value="{{old('name')}}"
          />
          @error('username')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
      </div>

      <div class="mb-6">
          <label
              for="password"
              class="inline-block text-md mb-1"
          >
              Password
          </label>
          <input
              type="password"
              class="border border-gray-200 rounded p-2 w-full"
              name="password"
          />
          @error('password')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
      </div>

      
      <div class="mb-6">
          <button
              type="submit"
              class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
          >
              Login
          </button>
      </div>

      <div class="mt-2">
          <p>
              Are you a new user?
              <a href="/authorize/register" class="text-laravel">Register</a>
          </p>
      </div>
    </div>
  </form>
  </x-card>
</x-login>