<ol>
    <li><a href="{{ route('home') }}">Home</a></li>
    @foreach($breadcrumbs as $label => $link)
        <li><a href="{{ $link }}">{{ $label }}</a></li>
    @endforeach
</ol>
