<header>
    Logo w/alt title
    
    <nav>
        <ul>
            @foreach($headerLinks as $label => $link)
                <li><a href="{{ $link }}">{{ $label }}</a></li>
            @endforeach
        </ul>
    </nav>

    Search Bar
    Toggle Dark/Light
    Mobile menu
</header>
