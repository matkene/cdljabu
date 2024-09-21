<?php 
$applications = \App\Models\Application::where('email', Auth::user()->email)->get();
$num = \App\Models\Application::where('email', Auth::user()->email)->count(); 


?>
@if($num > 0)

<div class="lg:flex gap-4 items-stretch">   


    <div class="bg-white p-4 rounded-lg xs:mb-4 max-w-full shadow-md lg:w-[100%]"> 
        <!--  -->
        <div class="flex flex-wrap justify-between h-full">
            <!-- Print Application <i class="fa-solid fa-house"></i> -->
            @if(@$applications[0]->submitted > 0 )
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-print text-white text-4xl"></i>
                <p class="text-white"><a href="/applicant/printform">Print Application</a></p>
            </div>           
            
            @endif
            
            
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-house text-white text-4xl"></i>
                <p class="text-white"><a href="/applicant/applhome">MyApplication Home </a></p>
            </div>
           

            <!-- Results  -->
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-square-poll-vertical text-white text-4xl"></i>
                <p class="text-white"><a href="/applicant/examresult">Examination Results</a></p>
            </div>
        </div>
    </div>
</div>


<div class="lg:flex gap-4 items-stretch">
    

    <!-- Certificate  -->
    <div class="bg-white p-4 rounded-lg xs:mb-4 max-w-full shadow-md lg:w-[100%]"> 
        <!-- Cajas pequeñas -->
        <div class="flex flex-wrap justify-between h-full">
            <!-- Caja pequeña 1 -->
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-certificate text-white text-4xl"></i>
                <p class="text-white"><a href="/applicant/certificate">Certificate(s)</a></p>
            </div>

            <!-- Employment <i class="fa-solid fa-eye"></i> -->
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-landmark text-white text-4xl"></i>
                <p class="text-white"><a href="/applicant/employment">Employment History</a></p>
            </div>

            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-asterisk text-white text-4xl"></i>
                <p class="text-white"><a href="/applicant/sponsor">Sponsors</a></p>
            </div>

            @if(@$applications[0]->submitted == 0)
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-eye text-white text-4xl"></i>
                <p class="text-white"><a href="/applicant/preview">Application Preview</a></p>
            </div>
            @endif
        </div>
    </div>
</div>
@endif