<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDL JABU</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@1.8.10/dist/tailwind.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>
{{-- < class="bg-gray-200 2xl:flex"> --}}

  <body class="bg-gray-200">
    <nav class="bg-white border-b border-gray-300">
        <div class="flex justify-between items-center px-9">
            <!-- Ícono de Menú -->
            <button id="menu-button" class="lg:hidden">
                <i class="fas fa-bars text-cyan-500 text-lg"></i>
            </button>
            <!-- Logo -->
            <div class="ml-1">
                <img src="{{asset('logo.png')}}" alt="logo" class="h-20 w-30">
               </div>


            <!-- Notification -->
            <div class="space-x-2">
               Welcome, {{Auth::user()->sname.' '.Auth::user()->fname}}
                @auth
            <button>
                <i class="fas fa-bell text-cyan-500 text-lg"></i>
            </button>

            <!-- Profile -->
            <button>
                <i class="fas fa-user text-cyan-500 text-lg"></i>
            </button>
            
            <!-- Logout -->
            <form method="POST" action="/logout" class="inline">
                @csrf
                <button type="submit"> <i class="fa fa-power-off text-cyan-500 text-lg"> </i> 
                </button>
            </form>
            @endauth
 

            </div>
        </div>
    </nav>

   <x-student-sidebar/>    


   <div class="lg:w-800 lg:ml-64 px-4 py-8">

    <!-- Search -->
   {{-- <x-search /> --}}

 <!-- Report Areas -->
 {{-- <x-report-area/> --}}

<!-- Tabla -->
<div class="bg-white rounded-lg p-4 shadow-md my-2">
{{$slot}}

</div>
</div>
</body>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuButton = document.getElementById('menu-button');
        var sidebar = document.getElementById('sidebar');

        menuButton.addEventListener('click', function() {
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('lg:block');
        });
    });
</script>

</html>