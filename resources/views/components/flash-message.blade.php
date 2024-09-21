{{-- @if(session()->has('message'))
<div x-data="{show:true}" x-init="setTimeout(()=> show = false,3000)" x-show="show" class="text-blue-300 mt-6 flex items-center justify-center mr-6 gap-x-6">
<p>
    {{session('message')}}
</p>
</div>    
@endif left-1/2 transform -translate-x-1/2 bg-laravel--}} 

@if(session()->has('message'))
<div x-data="{show:true}"  x-init="setTimeout(()=> show  = false, 3000)" x-show="show" class="fixed top-20 text-cyan-500 px-10 py-3">
    <p>{{session('message')}}</p>
</div>
@endif 