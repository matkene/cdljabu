<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CDL JABU -ADMIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
   <div class="min-h-full">
    <nav class="fixed bottom-[calc(100vh-theme(spacing.16))] left-0 right-0 top-0 bg-blue-200">{{$heading}}
        United Lincolnshire Hospitals Trust is committed to safeguarding and promoting the welfare of
        children, young people and adults, both as service users and visitors to Trust premises. All
        staff have a responsibility to safeguard and promote the welfare of children and adults. The
        postholder, in conjunction with their line manager, will be responsible for ensuring they
        undertake the appropriate level of training relevant to their individual role and responsibilities
        and that they are aware of and work within the safeguarding policies of the Trust
    </nav> 

    
    <div class="flex min-h-screen">

        
  
    <aside class="sticky top-16 h-[calc(100vh-theme(spacing.16))] w-40 overflow-y-auto bg-red-200">
    <ul>
      <li>A</li>
      <li>B</li>
      <li>C</li>
    </ul>
  </aside>

  <main class="mt-16 flex-1 bg-yellow-200" >
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      
        {{$slot}}

        </div>  </main>
</div>
</div>
</body>
</html>