<x-testing>
    <x-slot:heading>
        About Us
    </x-slot:heading>
    <h1> <strong>{{$job['title']}} </strong></h1>
    <p>This job pays {{$job['salary']}}</p>

     @can('edit', $job)
     <p class='mt-6'>  
        <x-job-link href='/first/{{$job->id}}/edit'>  Edit Job  </x-job-link> 
       </p>  
     @endcan
      
    

</x-testing>