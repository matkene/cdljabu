<div class="lg:flex gap-4 items-stretch">
    <!-- Caja Grande -->
  <div class="bg-white md:p-2 p-6 rounded-lg border border-gray-200 mb-4 lg:mb-0 shadow-md lg:w-[35%]">
    <div class="flex justify-center items-center space-x-5 h-full">
        <div>
            <p></p>
            <h2 class="text-4xl font-bold text-gray-600"></h2>
            <p></p>
        </div>
        <img src="https://www.emprenderconactitud.com/img/Wallet.png" alt="wallet" class="h-24 md:h-20 w-38">
    </div>
</div>
<?php
$id = Auth::user()->username;
$count = \App\Models\Admission::where('formno', $id)->count();
if($count ==0){
    $astatus ='Pending';
}else{
    $astatus ='Admitted';   
}
?>
    <!-- Caja Blanca -->
    <div class="bg-white p-4 rounded-lg xs:mb-4 max-w-full shadow-md lg:w-[65%]"> 
        <!-- Cajas pequeñas -->
        <div class="flex flex-wrap justify-between h-full">
            <!-- Admission <i class="fa-solid fa-ticket-simple"></i> -->
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-ticket-simple text-white text-4xl"></i>
                <p class="text-white">Admission Status: {{$astatus}}</p>
            </div>

            <!--Letter <i class="fa-solid fa-envelope-open-text"></i> -->
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fa-solid fa-envelope-open-text text-white text-4xl"></i>
                <p class="text-white">Print Admission Letter</p>
            </div>

            
            <div class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                <i class="fas fa-qrcode text-white text-4xl"></i>
                <p class="text-white"></p>
            </div>
        </div>
    </div>
</div>