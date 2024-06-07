
<h1>
    {{$job->title}}
</h1>

<p>
    Congrats! Your job is now live on our website 
</p>

<p>
    <a href="{{url('/first/'. $job->id)}}">View your job Listings</a>
</p>
