<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
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
                            laravel: "#008B8B",
                        },
                    },
                },
            };
        </script>
        <title>CENTRE FOR DISTANCE LERANING, JOSEPH AYO BABALOLA UNIVERISTY</title>
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-4">
            <a href="/">
              <img class="h-20 w-30" src={{asset("logo.png")}} alt="CDL JABU" class="logo"
            /></a>
            <div class="flex space-x-2 align-left text-md font-bold text-cyan-700">
             
              
              
          </div>
          <div class="hidden md:block">
            
            <ul class="flex space-x-2 mr-6 text-lg">
                @auth
                <li>
                    <span class="font.bold uppercase">Welcome, {{auth()->user()->name}}</span>         
                </li>
                
                <li>
                  
                    <form method="POST" action="/logout">
                     @csrf
                     <button type="submit" alt="Logout" class='bg-white-900  text-cyan-500 hover:bg-cyan-700 hover:text-white'> <i class="fa-solid fa-sign-out"> </i> Logout</button>
                    </form>                   
                    
                </li>
                @else
                <li>
                  <x-link href="register" :active="request()->is('register')">
                    <i class="fa-solid fa-user-plus"></i> 
                    Register</x-link> 
                   
                </li>
                <li>
                    <x-link href="login" :active="request()->is('login')" alt="Login">
                      <i class="fa-solid fa-arrow-right-to-bracket"></i>
                      Login</x-link>
                </li>
                @endauth
            </ul>
          </div>
        </nav>

    <main>
    {{$slot}}
    </main>

    <footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-16 mt-24 opacity-90 md:justify-center"
>
    <p class="ml-2">Copyright &copy; 2024, CDL JABU</p>

    <a
        href="{{url('/authorize/login')}}"
        class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
        >Admin?</a>
</footer>
<x-flash-message/>
</body>
</html>
