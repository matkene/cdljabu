@props(['active' => false ])


<a {{$attributes}} class="{{ $active ? 'bg-cyan-900 text-white':'text-cyan-600 hover:bg-cyan-700 hover:text-white'}}  rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $active ?'page':'false' }}">{{$slot}}</a>

