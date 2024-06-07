<x-testing>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>    
  
  <div class="space-y-4">
             @foreach ($jobs as $job)    
   
      
          <a href="/first/{{$job['id']}}" class="block px-4 py-6 border border-gray-200 rounded-lg">

            <div class="font-bold text-blue-500 text-sm">{{$job->employer->name}}</div>
            <div>
              <strong>{{$job['title']}}</strong> pays  {{$job['salary']}} per year
            </div>
          </a>               
            
  
             @endforeach     




             @if (session('status'))
          <div class="alert alert-success">          
          <p class='text-xs text-red-500 font-semibold mt-1'> {{ session('status') }} </p> 
          </div>
           @endif

           <div class="grid grid-cols-3 gap-4">
            <div class="bg-blue-900 text-white">01</div>
            <div class=" bg-blue-900 text-white">02</div>
            <div class=" bg-blue-900 text-white">03</div>
            <div class="col-span-2  bg-blue-900 text-white">04</div>
            <div class="bg-blue-900 text-white">05</div>
            <div class="bg-blue-900 text-white">06</div>
            <div class="col-span-2  bg-blue-900 text-white">07</div>
          </div>

             <div>
                {{$jobs->links()}}
             </div>
    </div>
</x-testing>