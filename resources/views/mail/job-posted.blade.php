<h2>
    {{ $job->title }}
</h2>
<p>
    Congrats!! Your job is nowlive on ur website
</p>

<a href="{{ url('/jobs/'.$job->id) }}">View your job listings</a>