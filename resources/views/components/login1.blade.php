<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CDL JABU</title>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
          tailwind.config = {
              theme: {
                  extend: {
                      colors: {
                          laravel: "#ef3b2d",
                      },
                  },
              },
          };
      </script>


    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
  <!-- Ionicons -->  
  <link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
</head>

<body class="mb-48">

    <!-- component -->
<div class="flex h-screen bg-white-900">
    <div class="flex-1 flex flex-col overflow-hidden">
      <header class="flex justify-between items-center bg-white p-4">
        <div class="flex-shrink-0">
            <img class="h-16 w-22" src="{{asset('logo.png')}}" alt="Your Company">
           
          </div>
        <div class="flex space-x-8 text-lg font-bold text-blue-500">
            CENTRE FOR DISTANCE LERANING </br>JOSEPH AYO BABALOLA UNIVERISTY
            
        </div>

        <div class="flex">

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                  @guest
                  <x-link href="login" :active="request()->is('login')">Login</x-link>
                  <x-link href="register" :active="request()->is('register')">Register</x-link>  
                  @endguest
                  @auth
                    <form action="/logout" method="POST">
                      @csrf
                      <x-form-button>Logout</x-form-button>
                    </form>
                  @endauth
                  
            <div class="relative ml-3">
                <div>
                  <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                  </button>
                </div>               
                
              </div>
            </div>
        </div>
        </div>
      </header>
      
      <div class="flex h-full">
        
        
        <main class="flex flex-col w-full bg-blue overflow-x-hidden overflow-y-auto mb-14">
            <header class="bg-blue">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-6 sm:flex sm:justify-between">
                  <h4 class="text-2xl font-semibold tracking-tight text-gray-900">{{$heading}}</h4>
                  @auth
                  <x-job-link  href="/third">
                      Create Job
                  </x-job-link>
                  @endauth
              </div>
              </header>
            
              
              <div class="ml-8 mr-4 mt-10 mb-8 grid gap-x-6 gap-y-8 sm:grid-cols-1">
                {{$slot}}
                </div>
              

              
              
          
        </main>
        
      </div>
    </div>
  </div>
  
  <style>
  ::-webkit-scrollbar {
    width: 5px;
    height: 5px;
  }
  ::-webkit-scrollbar-thumb {
    background: linear-gradient(13deg, #7bcfeb 14%, #e685d3 64%);
    border-radius: 10px;
  }
  ::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(13deg, #c7ceff 14%, #f9d4ff 64%);
  }
  ::-webkit-scrollbar-track {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: inset 7px 10px 12px #f0f0f0;
  }
  </style>

</body>
</html>