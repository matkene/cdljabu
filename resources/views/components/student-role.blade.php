<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CDL JABU - STUDENTS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">

    <!-- component -->
<div class="flex h-screen bg-white-900">
    <div class="flex-1 flex flex-col overflow-hidden">
      <header class="flex justify-between items-center bg-white p-4">
        <div class="flex-shrink-0">
            <img class="h-16 w-22" src="{{asset('logo.png')}}" alt="Your Company">
           
          </div>
        <div class="flex">CENTRE FOR DISTANCE LERANING </br>JOSEPH AYO BABALOLA UNIVERISTY</div>

        <div class="flex">

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                  @guest
                  <x-link href="/login" :active="request()->is('login')">Login</x-link>
                  <x-link href="/register" :active="request()->is('register')">Register</x-link>  
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
                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                  </button>
                </div>               
                
              </div>
            </div>
        </div>
        </div>
      </header>
      
      <div class="flex h-full">
        <nav class="flex w-72 h-full bg-blue-500">
          <div class="w-full flex mx-auto px-6 py-8">
            <div class="w-full h-full flex items-center justify-center text-gray-900 text-xl">
                
                 <div class="flex flex-col">
                    <div class="pb-2"> 
                        <x-admin-link href="/login" :active="request()->is('login')">DASHBOARD</x-admin-link>
                    </div>
                    <div class="pb-2"> 
                        <x-admin-link href="/login" :active="request()->is('login')">BIODATA</x-admin-link>
                        
                    </div>
                    <div class="pb-2"> 
                        <x-admin-link href="/login" :active="request()->is('login')">PAYMENTS</x-admin-link>
                    </div>
                    <div class="pb-2"> 
                        <x-admin-link href="/login" :active="request()->is('login')">REGISTRATION</x-admin-link>
                    </div>
                    <div class="pb-2"> 
                        <x-admin-link href="/login" :active="request()->is('login')">STUDENTS</x-admin-link>
                    </div>
                    <div class="pb-2"> 
                        <x-admin-link href="/login" :active="request()->is('login')">RESULTS</x-admin-link>
                    </div>
                    <div class="pb-2"> 
                        <x-admin-link href="/login" :active="request()->is('login')">E-LEARNING</x-admin-link>
                    </div>
                    
                    
                 </div>


                

            </div>
          </div>
        </nav>
        <main class="flex flex-col w-full bg-white-blue overflow-x-hidden overflow-y-auto mb-14">
          <div class="flex w-full mx-auto px-6 py-8">
            <div class="flex flex-col w-full h-full text-gray-900 text-xl border-4 border-gray-900 border-dashed">
              <div class="flex w-full  h-60 items-center justify-center mx-auto bg-green-400 border-b border-gray-600">
                United Lincolnshire Hospitals Trust is committed to safeguarding and promoting the welfare of
        children, young people and adults, both as service users and visitors to Trust premises. All
        staff have a responsibility to safeguard and promote the welfare of children and adults. 

              </div>
              <div class="flex w-full h-60 items-center justify-center mx-auto bg-green-400 border-b border-gray-600">Post</div>
              
            </div>
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