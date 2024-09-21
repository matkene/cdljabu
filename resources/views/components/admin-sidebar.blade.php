<!-- Barra lateral -->
<div id="sidebar" class="lg:block hidden bg-white w-64 h-screen fixed rounded-none border-none">
    <!-- Items -->
    <div class="p-4 space-y-4">
        <!-- Inicio -->
        <a href="/admin/dashboard" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-lg text-white bg-gradient-to-r from-sky-600 to-cyan-400">
            <i class="fas fa-home text-white"></i>
            <span class="-mr-1 font-medium">Dashboard</span>
        </a>
        <a href="{{url("/admin/dashboard/application")}}" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
            <i class="fas fa-gift"></i>
            <span>Application</span>
           </a>
        
        <a href="{{url("/admin/dashboard/student")}}" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
            <i class="fas fa-wallet"></i>
            <span>Students</span>
        </a>

        {{-- <a href="{{url("/admin/dashboard/result")}}" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
            <i class="fas fa-store"></i>
            <span>Result</span>
        </a> --}}

        <a href="{{url("/admin/dashboard/setup")}}" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
            <i class="fas fa-wallet"></i>
            <span>Setup</span>
        </a>        
        
        <a href="{{url("/admin/dashboard/setting")}}" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
        <i class="fas fa-sign-out-alt"></i>
        <span>Setting</span>
    </a>
    </div>
</div>
