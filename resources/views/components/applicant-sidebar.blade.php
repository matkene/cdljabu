<?php $count = \App\Models\Applpayment::where('email', Auth::user()->email)->where('status', 1)->count();
$num = \App\Models\Application::where('email', Auth::user()->email)->count(); ?>
<!--  -->

<div id="sidebar" class="lg:block hidden bg-white w-64 h-screen fixed rounded-none border-none">
    <!-- Items -->
    @if($num > 0)
    <div class="p-4 space-y-4">
       
        <!-- Inicio -->
        <a href="/applicant/dashboard" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-lg text-white bg-gradient-to-r from-sky-600 to-cyan-400">
            <i class="fas fa-home text-white"></i>
            <span class="-mr-1 font-medium">Dashboard</span>
        </a>
        <a href="/applicant/dashboard/payment" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
            <i class="fas fa-gift"></i>
            <span>Payments</span>
        </a>
        
        @if($count > 0)
        <a href="/applicant/dashboard/biodata" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
            <i class="fas fa-store"></i>
            <span>Biodata</span>
        </a>       
        @endif
        <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
        <i class="fas fa-sign-out-alt"></i>
        <span>Setting</span>
        </a>
        <a href="/applicant/dashboard/admission" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
            <i class="fas fa-wallet"></i>
            <span>Admission</span>
        </a>
    
    </div>
    @else
    <a href="/applicant/index" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-lg text-white bg-gradient-to-r from-sky-600 to-cyan-400">
        <i class="fas fa-home text-white"></i>
        <span class="-mr-1 font-medium">Dashboard</span>
    </a>

    <a href="/applicant/dashboard/payment" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
        <i class="fas fa-gift"></i>
        <span>Payments</span>
    </a>
    
    @endif
</div>

