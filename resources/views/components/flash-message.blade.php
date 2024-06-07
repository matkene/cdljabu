@if(session()->has('message'))
<div x-data="{show:true}" x-init="setTimeout(()=> show = false,300)" x-show="open" class="text-blue-300 mt-6 flex items-center justify-center mr-6 gap-x-6">
<p>
    {{session('message')}}
</p>

</div>    
@endif