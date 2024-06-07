<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CDL JABU - ADMIN</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://unpkg.com/tailwindcss@1.8.10/dist/tailwind.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
  <!-- Ionicons -->  
  <link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
</head>

<body class="h-full">

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
                        <div class="flex items-center">                            
                            <svg class="h-4 w-4 flex-none fill-blue-200 stroke-sky-500 stroke-2" stroke-linecap="round"
                             stroke-linejoin="round">
                              <circle cx="8" cy="8" r="8" />
                              <path d="M8.543 2.232a.75.75 0 0 0-1.085 0l-5.25 5.5A.75.75 0 0 0 2.75 9H4v4a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 1 1 2 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V9h1.25a.75.75 0 0 0 .543-1.268l-5.25-5.5Z" fill="none"/>
                              
                            </svg>
                            <p class="ml-0 mb-2">
                                <x-admin-link href="/login" :active="request()->is('login')">
                              DASHBOARD
                            </x-admin-link>
                            </p>                            
                          </div>                        
                    </div>

                    <div class="pb-2">                        
                        <div class="flex items-center">                            
                            <svg class="h-4 w-4 flex-none fill-blue-200 stroke-sky-500 stroke-2" stroke-linecap="round"
                             stroke-linejoin="round">
                              <circle cx="8" cy="8" r="8" />
                              <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />                              
                            </svg>
                            <p class="ml-0 mb-2">
                                <x-admin-link href="/login" :active="request()->is('login')">
                              TRANSACTIONS
                            </x-admin-link>
                            </p>                            
                          </div>                        
                    </div>

                    <div class="pb-2">                        
                        <div class="flex items-center">                            
                            <svg class="h-4 w-4 flex-none fill-blue-200 stroke-sky-500 stroke-2" stroke-linecap="round"
                             stroke-linejoin="round">
                              <circle cx="8" cy="8" r="8" />
                              <path strokeLinecap="round" strokeLinejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                                          
                            </svg>
                            <p class="ml-0 mb-2">
                                <x-admin-link href="/login" :active="request()->is('login')">
                              APPLICATIONS
                            </x-admin-link>
                            </p>                            
                          </div>                        
                    </div>

                    <div class="pb-2">                        
                        <div class="flex items-center">                            
                            <svg class="h-4 w-4 flex-none fill-blue-200 stroke-sky-500 stroke-2" stroke-linecap="round"
                             stroke-linejoin="round">
                              <circle cx="8" cy="8" r="8" />
                              <path strokeLinecap="round" strokeLinejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />                              
                            </svg>
                            <p class="ml-0 mb-2">
                                <x-admin-link href="/login" :active="request()->is('login')">
                              ADMISSIONS
                            </x-admin-link>
                            </p>                            
                          </div>                        
                    </div>
                    
                   
                    <div class="pb-2">                        
                        <div class="flex items-center">                            
                            <svg class="h-4 w-4 flex-none fill-blue-200 stroke-sky-500 stroke-2" stroke-linecap="round"
                             stroke-linejoin="round">
                              <circle cx="8" cy="8" r="8" />
                              <path strokeLinecap="round" strokeLinejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                              
                            </svg>
                            <p class="ml-0 mb-2">
                                <x-admin-link href="/login" :active="request()->is('login')">
                              STUDENTS
                            </x-admin-link>
                            </p>                            
                          </div>                        
                    </div>
                    <div class="pb-2">                        
                        <div class="flex items-center">                            
                            <svg class="h-4 w-4 flex-none fill-blue-200 stroke-sky-500 stroke-2" stroke-linecap="round"
                             stroke-linejoin="round">
                              <circle cx="8" cy="8" r="8" />
                              <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                              
                            </svg>
                            <p class="ml-0 mb-2">
                                <x-admin-link href="/login" :active="request()->is('login')">
                              SETUP
                            </x-admin-link>
                            </p>                            
                          </div>                        
                    </div>
                    <div class="pb-2">                        
                        <div class="flex items-center">                            
                            <svg class="h-4 w-4 flex-none fill-blue-200 stroke-sky-500 stroke-2" stroke-linecap="round"
                             stroke-linejoin="round">
                              <circle cx="8" cy="8" r="8" />
                              <path strokeLinecap="round" strokeLinejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                              
                            </svg>
                            <p class="ml-0 mb-2">
                                <x-admin-link href="/login" :active="request()->is('login')">
                              SETTINGS
                            </x-admin-link>
                            </p>                            
                          </div>                        
                    </div>
                    
                 </div>


                

            </div>
          </div>
        </nav>
        
        <main class="flex flex-col w-full bg-blue overflow-x-hidden overflow-y-auto mb-14">
            <header class="bg-blue">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-6 sm:flex sm:justify-between">
                  <h3 class="text-2xl font-semibold tracking-tight text-gray-900">{{$heading}}</h3>
                  @auth
                  <x-job-link  href="/third">
                      Create Job
                  </x-job-link>
                  @endauth
              </div>
              </header>
            <div class="flex w-full mx-auto px-6 py-8">
            
            <div class="flex flex-col w-full h-full text-gray-900 text-xl border-0 border-gray-900 border-dashed">
              
                {{$slot}}

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